<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use Illuminate\Support\Facades\Mail;
use App\Mail\RegisterStudent;

class InviteMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $email, $user;

    public function __construct($email, $user) {
        $this->email = $email;
        $this->by_user = $user;
    }

    public function handle() {
        Mail::to($this->email)->send(new RegisterStudent(md5($this->email), 'Melvin Hagberg'));
    }
}
