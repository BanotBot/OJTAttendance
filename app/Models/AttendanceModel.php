<?php

namespace App\Models;
use CodeIgniter\Model;

class AttendanceModel extends Model
{
    protected $table = "ojt_attendances";
    protected $primaryKey = "attendanceId";
    protected $allowedFields = ["ojtId", "imgTimeIn", "imgTimeOut", "date", "timeIn", "timeOut", "status"];

    public function countAllTotalPages($arguments)
    {
        try {
            $query = $this
            ->select("ojt_attendances.")    
            ->where("ojtId", $arguments["ojtId"]);
            if ($arguments["dateFrom"] === null && $arguments["dateTo"] === null) {
                $query = $this
                    ->where("date >=", $arguments["dateFrom"])
                    ->where("date <=", $arguments["dateTo"]);
            }
            return $query->countAllResults();
        } catch (\Throwable $th) {
            $th->getMessage();
        }
    }

    public function getAllAttendance($arguments)
    {
        try {
            return $this
                ->select("ojt_attendances.attendanceId, 
                        ojt_attendances.fileNameTimeIn, 
                        ojt_attendances.fileNameTimeOut, 
                        ojt_attendances.date,
                        ojt_attendances.timeIn, 
                        ojt_attendances.timeOut, 
                        ojt_attendances.status, 
                        ojs.firstname, 
                        ojs.middlename, 
                        ojs.lastname")
                ->join("ojt_students AS ojs", "ojt_attendances.ojtId = ojs.ojtId", "inner")
                ->where("ojs.ojtId", $arguments["ojtId"])
                ->limit($arguments["perPage"], $arguments["offset"])
                ->orderBy("date", "DESC")
                ->findAll();
        } catch (\Throwable $th) {
            $th->getMessage();
        }
    }

    public function getAttendanceWDateRange($arguments)
    {
        try {
            return $this
                ->select("ojt_attendances.attendanceId,
                      ojt_attendances.fileNameTimeIn,
                      ojt_attendances.fileNameTimeOut,
                      ojt_attendances.date,
                      ojt_attendances.timeIn,
                      ojt_attendances.timeOut,
                      ojt_attendances.status,
                      ojs.firstname,
                      ojs.middlename,
                      ojs.lastname")
                ->join("ojt_students AS ojs", "ojt_attendances.ojtId = ojs.ojtId", "inner")
                ->where("ojs.ojtId", $arguments["ojtId"])
                ->where("ojt_attendances.date >=", $arguments["dateFrom"])
                ->where("ojt_attendances.date <=", $arguments["dateTo"])
                ->limit($arguments["perPage"], $arguments["offset"])
                ->orderBy("ojt_attendances.date", "DESC")
                ->findAll();

        } catch (\Throwable $th) {
            $th->getMessage();
        }
    }

}