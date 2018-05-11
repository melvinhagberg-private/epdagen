<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TicketSold extends Mailable
{
    use Queueable, SerializesModels;

    public $num, $total, $name, $email, $phone;

    public function __construct($num, $total, $name, $email, $phone) {
        $this->num = $num;
        $this->total = $total;
        $this->name = $name;
        $this->email = $email;
        $this->phone = $phone;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails/ticketsold')->with([
            'num' => $this->num,
            'total' => $this->total,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone
        ])->from('test@epdagen.se')->subject('Ny försäljning till ' . $this->name);
    }
}
