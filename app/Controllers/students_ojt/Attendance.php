<?php

    namespace App\Controllers\students_ojt;
    use App\Controllers\BaseController;
    use ImageHelpers;

    class Attendance extends BaseController 
    {

        public function saveAttendance() 
        {
            $ojtId = session()->get("userId");
            $dataFile = $this->request->getPost("imageFile");

            $imageHelpersObj = new ImageHelpers();
            $imageFileName = $imageHelpersObj->generateFileName($dataFile);

            $currentDate = date("Y-m-d"); // 2026-02-17
            $currentTime = date("H:i:s"); // 24 hour format
            



            
        }
    }