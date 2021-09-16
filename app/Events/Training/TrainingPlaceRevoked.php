<?php

namespace App\Events\Training;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TrainingPlaceRevoked
{
    use Dispatchable, SerializesModels;

    private $trainingPlace;
    private $reason;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(TrainingPlace $trainingPlace, string $reason)
    {
        $this->trainingPlace = $trainingPlace;
        $this->reason = $reason;
    }

    public function getReason() : string
    {
        return $this->reason;
    }

    public function getTrainingPlace() : TrainingPlace
    {
        return $this->trainingPlace;
    }
}
