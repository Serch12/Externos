<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegistroVisoriaExitoso extends Mailable
{
    use Queueable, SerializesModels;

    public $registro;
    public $qrCodeUrl;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($registro, $qrCodeUrl) {
        $this->registro = $registro;
        $this->qrCodeUrl = $qrCodeUrl;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {
        return $this->view('Pdf.pdfRegistroVisorias')
                    ->subject('Tu código QR para las Visorias');
    }
}
