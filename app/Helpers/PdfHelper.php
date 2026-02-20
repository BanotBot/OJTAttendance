<?php

namespace App\Helpers;
use App\Models\OjtAttendances;
use Dompdf\Dompdf;

class PdfHelper
{

    public function exportAttendance()
    {
        $attendancesModel = new OjtAttendances();
        try {
            $data["attendance"] = $attendancesModel
                                ->select("ojt_attendances.attendanceId, ojt_attendances.imgTimeIn, ojt_attendances.imgTimeOut, ojt_attendances.date, ojt_attendances.timeIn, ojt_attendances.timeOut, ojt_attendances.status, ojs.firstname, ojs.middlename, ojs.lastname")
                                ->join("ojt_students ojs", "ON ojt_attendances.ojtId = ojs.ojtId")
                                ->orderBy("date", "DESC")
                                ->findAll();

            $html = view("students_ojt/attendance_report", $data);
            $dompdf = new Dompdf();
            $dompdf->loadHtml($html);
            $dompdf->setPaper("A4", "portrait");
            $dompdf->render();
            $dompdf->stream("attendance_report.pdf", ["Attachment" => true]);
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }

}