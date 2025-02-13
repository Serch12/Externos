<?php

namespace App\Listeners;

use App\Events\TorneoChangedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class TorneoListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\TorneoChangedEvent  $event
     * @return void
     */
    public function handle(TorneoChangedEvent $event)
    {
        //
    }
}
