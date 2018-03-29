<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use Illuminate\Support\Facades\Mail;
use App\Mail\Ticket as TicketMail;

class TicketMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $filepaths, $email;
    
    public function __construct($filepaths, $email) {
        $this->filepaths = $filepaths;
        $this->email = $email;
    }

    public function handle() {
        Mail::to($this->email)->send(new TicketMail($this->filepaths));
    }
}
