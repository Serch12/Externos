<?php

namespace App\Jobs;

use App\Mail\CorreoMasivo;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

class EnviarCorreoMasivo implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $correo;
    public $img;
    public $usuarios;

    public function __construct($usuarios,$correo,$img){

        $this->correo = $correo;
        $this->img = $img;
        $this->usuarios = $usuarios;
        
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(){

        Mail::to($this->usuarios->mail)->send(new CorreoMasivo($this->correo,$this->img));
    }
}
