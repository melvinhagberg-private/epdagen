<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ReceiptMail extends Mailable {
    use Queueable, SerializesModels;

    public $pdf, $firstname;

    public function __construct($pdf, $firstname) {
        $this->pdf = $pdf;
        $this->firstname = $firstname;
    }

    public function build() {
        return $this->view('mails.receipt')
                    ->with('name', $this->firstname)
                    ->from('noreply@epdagen.se')
                    ->subject('Kvitto - Biljetter EP-dagen ' . date('Y'))
                    ->attach($this->pdf, [
                        'as' => 'kvitto.pdf'
                    ]);
    }
}
