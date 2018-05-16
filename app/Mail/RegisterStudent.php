<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Auth;

class RegisterStudent extends Mailable
{
    use Queueable, SerializesModels;

    public $signup_token, $by_user;

    public function __construct($signup_token, $by_user) {
        $this->signup_token = $signup_token;
        $this->by_user = $by_user;
    }

    public function build() {
        return $this->view('mails/regstudent')
            ->with([
                'url' => url('/admin/registrera/' . $this->signup_token),
                'invited_by_user' => $this->by_user
            ])
            ->from('sender@example.com')
            ->subject('Registrera dig - EP-dagen');
    }
}
