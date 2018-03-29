<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Ticket extends Mailable
{
    use Queueable, SerializesModels;

    protected $filepaths;
    
    public function __construct($filepaths)
    {
        $this->filepaths = $filepaths;
    }

    public function build()
    {
        $email = $this->markdown('mails/ticket')->from('test@epdagen.se');
        
        foreach ($this->filepaths as $key => $path) {
            $email->attach($path, [
                'as' => 'biljett' . strval($key + 1) . '.pdf'
            ]);
        }
        
        return $email;
    }
}
