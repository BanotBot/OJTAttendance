<?php

namespace App\Controllers\students_ojt;

use App\Controllers\BaseController;
use App\Models\OjtAttendances;
use App\Helpers\ImageHelper;
use App\Helpers\OjtStudentsHelper;
use Dompdf\Dompdf;

class AttendanceController extends BaseController
{

    public function saveAttendance()
    {

        date_default_timezone_set("Asia/Manila");

        $imageHelpersObj = new ImageHelper();
        $attendancesModel = new OjtAttendances();
        $dbconnection = \Config\Database::connect();

        try {

            $userId = session()->get("userId");

            $ojtId = OjtStudentsHelper::getOjtId($userId);
            if ($ojtId === null) {
                return $this->response->setJSON(["success" => false, "message" => "Invalid request. Please try again or login again!"]);
            }

            $data = $this->request->getJSON(true);
            $dataFile = $data["imageFile"] ?? null;

            if ($dataFile === null) {
                return $this->response->setJSON(["success" => false, "message" => "Image file does not have a value"]);
            }

            $imageFileName = $imageHelpersObj->generateFileName($dataFile);
            $currentDate = date("Y-m-d"); // 2026-02-17
            $currentTime = date("H:i:s"); // 24 hour format

            $dbconnection->transStart();

            $attendance = $attendancesModel
                ->where("ojtId", $ojtId)
                ->where("date", $currentDate)
                ->first();

            if ($attendance && $attendance['timeOut']) {
                return $this->response->setJSON(["success" => false, "message" => "You already have an attendance today!"]);
            }

            if (!$attendance) {
                // --- TIME IN ---
                $dbconnection->table("ojt_attendances")->insert([
                    "ojtId" => $ojtId,
                    "imgTimeIn" => $imageFileName,
                    "date" => $currentDate,
                    "timeIn" => $currentTime,
                    "status" => OjtAttendances::TIME_IN
                ]);
                $message = "Successfully Time-in recorded!";

            } elseif (!$attendance["timeOut"] || $attendance["timeOut"] === "00:00:00") {
                // --- TIME OUT ---
                $dbconnection->table("ojt_attendances")
                    ->where("attendanceId", $attendance["attendanceId"])
                    ->update([
                        "imgTimeOut" => $imageFileName,
                        "timeOut" => $currentTime,
                        "status" => OjtAttendances::PRESENT_STATUS
                    ]);
                $message = "Successfully Time-out recorded!";
            }

            $dbconnection->transComplete();
            if ($dbconnection->transStatus() === FALSE) {
                return $this->response->setJSON(["success" => false, "message" => "Internal server error"]);
            }

            return $this->response->setJSON(["success" => true, "message" => $message, "imageFileName" => $imageFileName]);
        } catch (\Throwable $th) {
            // dd($th->getMessage());
            return $this->response->setJSON(["success" => false, "message" => $th->getMessage()]);
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
                ->select("ojt_attendances.attendanceId, ojt_attendances.imgTimeIn, ojt_attendances.imgTimeOut, ojt_attendances.date, ojt_attendances.timeIn, ojt_attendances.timeOut, ojt_attendances.status, ojs.firstname, ojs.middlename, ojs.lastname")
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
        try {
            $data["attendance"] = $attendancesModel
                ->select("ojt_attendances.attendanceId, ojt_attendances.imgTimeIn, ojt_attendances.imgTimeOut, ojt_attendances.date, ojt_attendances.timeIn, ojt_attendances.timeOut, ojt_attendances.status, ojs.firstname, ojs.middlename, ojs.lastname")
                ->join("ojt_students ojs", "ON ojt_attendances.ojtId = ojs.ojtId")
                ->where("ojs.ojtId", $ojtId)
                ->where("ojt_attendances.date >=", $dateFrom)
                ->where("ojt_attendances.date <=", $dateTo)
                ->orderBy("date", "DESC")
                ->findAll();

            $html = view("students_ojt/attendance_report", $data);
            $dompdf = new Dompdf();
            $dompdf->loadHtml($html);
            $dompdf->setPaper("A4", "portrait");
            $dompdf->render();

            return $this->response
                ->setContentType("application/pdf")
                ->setHeader("Content-Disposition", 'attachment; filename="attendance_report.pdf"')
                ->setBody($dompdf->output());
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }
}