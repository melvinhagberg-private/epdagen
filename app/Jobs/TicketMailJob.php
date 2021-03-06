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

    public $filepaths, $email, $name;

    public function __construct($filepaths, $email, $name) {
        $this->filepaths = $filepaths;
        $this->email = $email;
        $this->name = $name;
    }

    public function handle() {
        Mail::to($this->email)->send(new TicketMail($this->filepaths, $this->name));
    }
}
