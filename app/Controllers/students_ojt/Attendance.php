<?php

    namespace App\Controllers\students_ojt;

    use App\Controllers\BaseController;
    use App\Models\OjtAttendances;
    use ImageHelper;
    use OjtStudentsHelper;

    class Attendance extends BaseController 
    {

        public function saveAttendance() 
        {

            $imageHelpersObj = new ImageHelper();
            $attendancesModel = new OjtAttendances();

            $userId = session()->get("userId");
            $ojtId = OjtStudentsHelper::getOjtId($userId);
            $dataFile = $this->request->getPost("imageFile");

            $imageFileName = $imageHelpersObj->generateFileName($dataFile);

            $currentDate = date("Y-m-d"); // 2026-02-17
            $currentTime = date("H:i:s"); // 24 hour format

            $rules = ["ojtId", "imgFileName", "currentDate", "currentTime"];

            if (!$this->validate($rules)) {
                dd($this->validator->getErrors());
                return redirect()->back()->withInput();
            }

            $timeIn = $attendancesModel
                ->select("timeIn")
                ->where(
                    [
                        "ojtId" => $ojtId,
                        "DATE(date)" => $currentDate
                    ])
                ->first();

            $message = "";   

            if (!empty($timeIn) || $timeIn !== null) {
                // --- TIME OUT ---
                $attendancesModel->insert([
                    "ojtId" => $ojtId,
                    "imgFileName" => $imageFileName,
                    "date" => $currentDate,
                    "timeOut" => $currentTime,
                    "status" => OjtAttendances::PRESENT_STATUS
                ]);

                $message .= "Time-out successfully recorded!";
            }

            // --- TIME IN ---
            $attendancesModel->insert([
                "ojtId" => $ojtId,
                "imgFileName" => $imageFileName,
                "date" => $currentDate,
                "timeIn" => $currentTime,
                "status" => OjtAttendances::PRESENT_STATUS
            ]);
            $message .= "Time-in successfully recorded!";

            return json_encode(["success" => true, "message" => $message]);

        }
    }