<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use Illuminate\Support\Facades\Mail;
use App\Receipt;
use App\Mail\ReceiptMail;

class ReceiptJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tickets;

    public function __construct($tickets) {
        $this->tickets = $tickets;
    }

    public function handle() {
        $pdf = (new Receipt($this->tickets))->generate();
        Mail::to( $this->tickets[0]['email'] )->send(new ReceiptMail($pdf, ( explode(' ', $this->tickets[0]['name'])[0] )));
    }
}
