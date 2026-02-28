<?php

namespace App\Controllers\students_ojt;

use App\Controllers\BaseController;
use App\Helpers\PdfHelper;
use App\Models\OjtAttendances;
use App\Helpers\OjtStudentsHelper;
use App\Helpers\CloudinaryHelper;

class AttendanceController extends BaseController
{

    public function saveAttendance()
    {
        date_default_timezone_set("Asia/Manila");

        $cloudinaryHelper = new CloudinaryHelper();
        $attendanceModel = new OjtAttendances();
        $db = \Config\Database::connect();

        try {

            $userId = session()->get("userId");
            $ojtId = OjtStudentsHelper::getOjtId($userId);

            if (!$ojtId) {
                return $this->response->setJSON([
                    "success" => false,
                    "message" => "Invalid session. Please login again."
                ]);
            }

            $data = $this->request->getJSON(true);
            $imageFile = $data["imageFile"] ?? null;

            if (!$imageFile) {
                return $this->response->setJSON([
                    "success" => false,
                    "message" => "Image file is required."
                ]);
            }

            $currentDate = date("Y-m-d");
            $currentTime = date("H:i:s");

            // Check if attendance already exists for today
            $attendance = $attendanceModel
                ->where("ojtId", $ojtId)
                ->where("date", $currentDate)
                ->first();

            if ($attendance && !empty($attendance["timeOut"]) && $attendance["timeOut"] !== "00:00:00") {
                return $this->response->setJSON([
                    "success" => false,
                    "message" => "You already completed attendance today."
                ]);
            }
            
            // Upload to Cloudinary
            $uploadResult = $cloudinaryHelper->upload($imageFile);
            $imageUrl = $uploadResult["secure_url"] ?? null;

            if (!$imageUrl) {
                return $this->response->setJSON([
                    "success" => false,
                    "message" => "Cloudinary upload failed.",
                    "debug" => $uploadResult
                ]);
            }
            
            $publicId = $uploadResult["public_id"] ?? null;
            $filename = $uploadResult["original_filename"] 
                            ?? pathinfo($publicId, PATHINFO_BASENAME) 
                            ?? uniqid("attendance_");

            $db->transStart();
            if (!$attendance) {
                // ================= TIME IN =================
                $db->table("ojt_attendances")->insert([
                    "ojtId" => $ojtId,
                    "imgUrlTimeIn" => $imageUrl,
                    "publicIdTimeIn" => $publicId,
                    "fileNameTimeIn" => $filename,
                    "date" => $currentDate,
                    "timeIn" => $currentTime,
                    "status" => OjtAttendances::TIME_IN
                ]);

                $message = "Successfully Time-in recorded!";
            } elseif (empty($attendance["timeOut"]) || $attendance["timeOut"] === "00:00:00") {
                // ================= TIME OUT =================
                $db->table("ojt_attendances")
                    ->where("attendanceId", $attendance["attendanceId"])
                    ->update([
                        "imgUrlTimeOut" => $imageUrl,
                        "publicIdTimeOut" => $publicId,
                        "fileNameTimeOut" => $filename,
                        "timeOut" => $currentTime,
                        "status" => OjtAttendances::PRESENT_STATUS
                    ]);
                $message = "Successfully Time-out recorded!";
            } else {
                $db->transRollback();
                return $this->response->setJSON([
                    "success" => false,
                    "message" => "You already completed attendance today."
                ]);
            }

            $db->transComplete();

            if (!$db->transStatus()) {
                $error = $db->error();
                log_message('error', json_encode($error));
                return $this->response->setJSON([
                    "success" => false,
                    "message" => "Database transaction failed.",
                    "debug" => $error
                ]);
            }

            return $this->response->setJSON([
                "success" => true,
                "message" => $message
            ]);

        } catch (\Throwable $e) {
            $db->transRollback();
            return $this->response->setJSON([
                "success" => false,
                "message" => $e->getMessage()
            ]);
        }
    }

    public function fetchAllAttendance()
    {
        $userId = session()->get("userId");
        $ojtId = OjtStudentsHelper::getOjtId($userId);

        $dateFrom = $this->request->getGet("dateFrom");
        $dateTo = $this->request->getGet("dateTo");

        $attendanceModel = new OjtAttendances();

        if ($dateFrom === null && $dateTo === null) {
            $attendances = $attendanceModel->fetchAllAttendance($ojtId);
        } else {
            $attendances = $attendanceModel
                ->select("ojt_attendances.attendanceId, ojt_attendances.fileNameTimeIn, ojt_attendances.fileNameTimeOut, ojt_attendances.date, ojt_attendances.timeIn, ojt_attendances.timeOut, ojt_attendances.status, ojs.firstname, ojs.middlename, ojs.lastname")
                ->where("date >=", $dateFrom)
                ->where("date <=", $dateTo)
                ->where("ojs.ojtId", $ojtId)
                ->join("ojt_students ojs", "ojt_attendances.ojtId = ojs.ojtId", "inner")
                ->orderBy("date", "DESC")
                ->findAll();
        }

        return $this->response->setJSON($attendances);
    }

    public function exportAttendance()
    {
        $userId = session()->get("userId");
        $ojtId = OjtStudentsHelper::getOjtId($userId);
        $dateFrom = $this->request->getGet("dateFrom");
        $dateTo = $this->request->getGet("dateTo");

        $attendancesModel = new OjtAttendances();

        if (empty($dateFrom) && empty($dateTo)) {
            $data["attendance"] = $attendancesModel->fetchAllAttendance($ojtId);
            $html = view("students_ojt/attendance_report", $data);
            $generatedPdf = PdfHelper::generateAttendancePdf($html);
            return $this->response
                ->setContentType("application/pdf")
                ->setHeader("Content-Disposition", 'attachment; filename="attendance_report.pdf"')
                ->setBody($generatedPdf->output());
        } else {
            $data["attendance"] = $attendancesModel->fetchAttendanceWDateRange($ojtId, $dateFrom, $dateTo);
            $html = view("students_ojt/attendance_report", $data);
            $generatedPdf = PdfHelper::generateAttendancePdf($html);

            return $this->response
                ->setContentType("application/pdf")
                ->setHeader("Content-Disposition", 'attachment; filename="attendance_report.pdf"')
                ->setBody($generatedPdf->output());
        }
    }

}