<?php

use App\Models\OjtAttendances;
use Dompdf\Dompdf;
use Dompdf\Helpers;

class PdfHelper extends Helpers
{

    public function exportAttendance()
    {
        $attendancesModel = new OjtAttendances();
        try {
            $data["attendance"] = $attendancesModel->findAll();

            $html = view("attendance_pdf", $data);
            $dompdf = new Dompdf();
            $dompdf->load_html($html);
            $dompdf->setPaper("A4", "portrait");
            $dompdf->render();
            $dompdf->stream("attendance_report.pdf", ["Attachement" => true]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

}