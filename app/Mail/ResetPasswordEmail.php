<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPasswordEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $token;

    public function __construct($user, $token)
    {
        $this->user = $user;
        $this->token = $token;
    }

    public function build(){
        $resetUrl = url("/reset-password/{$this->token}/{$this->user->email}");
        return $this->subject('Restablece tu contraseña')
                    ->view('Email.reset-email')
                    ->with([
                       'resetUrl' => $resetUrl,
                        'user' => $this->user
                    ]);
    }
}
