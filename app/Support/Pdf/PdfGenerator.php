<?php 

namespace App\Utils\Pdf;

use Dompdf\Dompdf;

class PdfGenerator {

    public function generate(string $html, string $filename): void {
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream($filename, ["Attachment" => true]);
    }
    
}
