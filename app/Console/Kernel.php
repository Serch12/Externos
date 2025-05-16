<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        'App\Console\Commands\ValidaNotificacion',
        'App\Console\Commands\ActivacionBanner',
        'App\Console\Commands\EnvioCorreoComando',
        'App\Console\Commands\HonorarioTalento',
        'App\Console\Commands\HonorarioExterno',
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {   
        $schedule->command('honorario:externos')->dailyAt('09:00');
        $schedule->command('honorario:talento')->dailyAt('09:00');
        $schedule->command('validacion:notificacion')->dailyAt('09:00');
        $schedule->command('activacion:banner')->dailyAt('09:00');
        $schedule->command('correos:programar')->dailyAt('09:00');
    }

    /**
     * Get the timezone that should be used by default for scheduled events.
     *
     * @return \DateTimeZone|string|null
     */

    protected function scheduleTimezone()
    {
        return 'America/Mexico_City';
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
