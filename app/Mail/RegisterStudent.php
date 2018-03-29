<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RegisterStudent extends Mailable
{
    use Queueable, SerializesModels;

    public $signup_token;
    
    public function __construct($signup_token) {
        $this->signup_token = $signup_token;
    }

    public function build() {
        return $this->markdown('mails/regstudent')
            ->with([
                'url' => url('/admin/registrera/' . $this->signup_token)
            ])
            ->from('sender@example.com');
    }
}
