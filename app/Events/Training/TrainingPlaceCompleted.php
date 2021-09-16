<?php

namespace App\Events\Training;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TrainingPlaceCompleted
{
    use Dispatchable, SerializesModels;

    private $trainingPlace;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(TrainingPlace $trainingPlace)
    {
        $this->trainingPlace = $trainingPlace;
    }
}
