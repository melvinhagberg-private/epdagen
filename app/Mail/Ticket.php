<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Ticket extends Mailable
{
    use Queueable, SerializesModels;

    protected $filepaths, $name;

    public function __construct($filepaths, $name)
    {
        $this->filepaths = $filepaths;
        $this->name = $name;
    }

    public function build()
    {
        if (sizeof($this->filepaths) === 1) {
            $subject = 'Din biljett';
        } else {
            $subject = 'Dina biljetter';
        }

        $firstname = explode(' ', $this->name)[0];

        $email = $this->view('mails/ticket')->with('name', $firstname)->from('test@epdagen.se')->subject($subject);

        foreach ($this->filepaths as $key => $path) {
            $email->attach($path, [
                'as' => 'biljett' . strval($key + 1) . '.pdf'
            ]);
        }

        return $email;
    }
}
