<?php

namespace App\Events\Training;

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

    public function getReason(): string
    {
        return $this->reason;
    }

    public function getTrainingPlace(): TrainingPlace
    {
        return $this->trainingPlace;
    }
}
