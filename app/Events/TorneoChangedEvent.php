<?php

namespace App\Events;

use App\Models\Torneo;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class TorneoChangedEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $torneo;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Torneo $torneo)
    {
        $this->torneo = $torneo;

    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return ['torneo_canal.' . $this->torneo->id_torneo, 'torneo_canal'];
    }
}
