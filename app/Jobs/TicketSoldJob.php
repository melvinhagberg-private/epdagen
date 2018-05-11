<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;
use App\Mail\TicketSold;

class TicketSoldJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $student_email, $num, $total, $name, $email, $phone;

    public function __construct($student_email, $num, $total, $name, $email, $phone) {
        $this->student_email = $student_email;
        $this->num = $num;
        $this->total = $total;
        $this->name = $name;
        $this->email = $email;
        $this->phone = $phone;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle() {
        Mail::to($this->student_email)->send(new TicketSold($this->num, $this->total, $this->name, $this->email, $this->phone));
    }
}
