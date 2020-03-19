<?php

namespace App\Events;

use App\Flight;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class FlightDeleted
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $flight;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Flight $flight)
    {
        $this->flight = $flight;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
