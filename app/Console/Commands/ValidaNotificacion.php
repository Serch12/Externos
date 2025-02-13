<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ValidaNotificacion extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'validacion:notificacion';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Envia Notificacion de Torneo';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        app('App\Http\Controllers\NotificacionController')->NotificacionAnaliza();
    }
}
