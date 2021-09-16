<?php

namespace App\Events\Training;

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
