<?php

namespace App\Models;
use CodeIgniter\Model;

class OjtAttendances extends Model
{
    protected $table = "ojt_attendances";  
    protected $primaryKey = "attendanceId";
    protected $allowedFields = ["ojtId", "imgTimeIn", "imgTimeOut", "date", "timeIn", "timeOut", "status"];
    
    public const PRESENT_STATUS = 3;
    public const ABSENT_STATUS = 4;
    public const TIME_IN = 5;


    public function fetchAllAttendance()
    {
        try {
            return $this
                        ->select("ojt_attendances.attendanceId, ojt_attendances.imgTimeIn, ojt_attendances.imgTimeOut, ojt_attendances.date, ojt_attendances.timeIn, ojt_attendances.timeOut, ojt_attendances.status, ojs.firstname, ojs.middlename, ojs.lastname")
                        ->join("ojt_students ojs", "ojt_attendances.ojtId = ojs.ojtId", "inner")
                        ->orderBy("date", "DESC")
                        ->findAll();
        } catch (\Throwable $th) {
             dd($th->getMessage());
        }
    }
    
}