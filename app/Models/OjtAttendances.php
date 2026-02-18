<?php

namespace App\Models;
use CodeIgniter\Model;

class OjtAttendances extends Model
{
    protected $table = "ojt_attendances";  
    protected $primaryKey = "attendanceId";

    protected $allowedFields = ["ojtId", "imgFileName", "currentDate", "currentTime"];

    public const PRESENT_STATUS = 3;
    public const ABSENT_STATUS = 4;
}