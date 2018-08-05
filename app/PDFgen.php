<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Ticket;
use Auth;
use Dompdf\Dompdf;

class PDFgen extends Model {

    public function main($tickets) {
        $filepaths = array();

        foreach ($tickets as $key => $ticket) {
            $ticket_id = $ticket['ticket_id'];

            $dompdf = new Dompdf();

            $qrcode = base64_encode(QrCode::format('png')->size(512)->generate('http://10.0.1.37:80/validera/' . $ticket_id));

            $html = view('pdfs.ticket', compact('qrcode'));
            $dompdf->loadHtml($html);
            $dompdf->render();
            $content = $dompdf->output();

            $path = storage_path() . '/pdfs/' . $ticket_id . '.pdf';

            file_put_contents($path, $content);
            array_push($filepaths, $path);
        }

        return $filepaths;
    }

}
