<?php

namespace App\Controllers\students_ojt;

use App\Controllers\BaseController;
use App\Models\OjtAttendances;
use App\Helpers\ImageHelper;
use App\Helpers\OjtStudentsHelper;

class AttendanceController extends BaseController
{

    public function saveAttendance()
    {

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

            if (!$attendance) {
                // --- TIME IN ---
                $dbconnection->table("ojt_attendances")->insert([
                    "ojtId" => $ojtId,
                    "imgTimeIn" => $imageFileName,
                    "date" => $currentDate,
                    "timeIn" => $currentTime
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
            } else {
                $message = "Attendance already completed today!";
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
        $attendanceModel = new OjtAttendances();
        $attendances = $attendanceModel->fetchAllAttendance();
        return $this->response->setJSON($attendances);
    }

}