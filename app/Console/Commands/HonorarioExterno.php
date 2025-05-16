<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class HonorarioExterno extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'honorario:externos';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creacion y desactivacion de honorarios externos';

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
        app('App\Http\Controllers\HonorariosController')->ExternoHonorario();
    }
}
