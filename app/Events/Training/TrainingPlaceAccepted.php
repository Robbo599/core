<?php

namespace App\Events\Training;

use App\Models\Training\TrainingPlace\TrainingPlaceOffer;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TrainingPlaceAccepted
{
    use Dispatchable, SerializesModels;

    private $trainingPlaceOffer;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(TrainingPlaceOffer $trainingPlaceOffer)
    {
        $this->trainingPlaceOffer = $trainingPlaceOffer;
    }

    public function getOffer() : TrainingPlaceOffer
    {
        return $this->trainingPlaceOffer;
    }
}
