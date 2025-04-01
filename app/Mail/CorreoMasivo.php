<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CorreoMasivo extends Mailable
{
    use Queueable, SerializesModels;
    
    public $correo;
    public $img;

    public function __construct($correo,$img)
    {
        $this->correo = $correo;
        $this->img = $img;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->correo->asunto)->view('Email.CorreoMasivo');
    }
}
