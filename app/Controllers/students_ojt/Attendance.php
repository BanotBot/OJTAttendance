<?php

    namespace App\Controllers\students_ojt;
    use App\Controllers\BaseController;
    use App\Models\OjtAttendances;

    class Attendance extends BaseController 
    {

        public function saveAttendance() 
        {
            $ojtId = session()->get("userId");
            $dataFile = $this->request->getPost("imageFile");

            $ojtAttendancesModel = new OjtAttendances();


        }
    }