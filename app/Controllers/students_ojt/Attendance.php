<?php

    namespace App\Controllers\students_ojt;

    use App\Controllers\BaseController;
    use App\Models\Users;
    use ImageHelper;
    use OjtStudentsHelper;

    class Attendance extends BaseController 
    {

        public function saveAttendance() 
        {
            $userId = session()->get("userId");
            $ojtId = OjtStudentsHelper::getOjtId($userId);
            $dataFile = $this->request->getPost("imageFile");

            $imageHelpersObj = new ImageHelper();
            $imageFileName = $imageHelpersObj->generateFileName($dataFile);

            $currentDate = date("Y-m-d"); // 2026-02-17
            $currentTime = date("H:i:s"); // 24 hour format

            $usersModel = new Users();

            

            $usersModel->insert([
                "" 
            ]);



        }
    }