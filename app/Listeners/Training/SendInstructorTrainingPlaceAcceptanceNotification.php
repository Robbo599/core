<?php

namespace App\Listeners\Training;

use App\Events\Training\TrainingPlaceAccepted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendInstructorTrainingPlaceAcceptanceNotification
{
    /**
     * Handle the event.
     *
     * @param  TrainingPlaceAccepted  $event
     * @return void
     */
    public function handle(TrainingPlaceAccepted $event)
    {
        // TODO: Send Discord notification.
        // Accept callsign/name via the station model on the training position.
        $position = $event->getOffer()->trainingPosition->station;
    }
}
