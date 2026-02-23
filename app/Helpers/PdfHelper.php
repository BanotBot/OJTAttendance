<?php

namespace App\Helpers;
use App\Models\OjtAttendances;
use Dompdf\Dompdf;

class PdfHelper 
{

    public static function generateAttendancePdf($html)
    {
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper("A4", "portrait");
        $dompdf->render();

        return $dompdf;
    }

}