<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class HonorarioTalento extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'honorario:talento';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creacion y desactivacion de honorarios talentos';

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
        app('App\Http\Controllers\HonorariosController')->TalentoHonorario();
    }
}
