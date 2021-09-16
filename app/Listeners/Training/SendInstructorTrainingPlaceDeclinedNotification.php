<?php

namespace App\Listeners\Training;

use App\Events\Training\TrainingPlaceDeclined;

class SendInstructorTrainingPlaceDeclinedNotification
{
    /**
     * Handle the event.
     *
     * @param  TrainingPlaceDeclined  $event
     * @return void
     */
    public function handle(TrainingPlaceDeclined $event)
    {
        // TODO: Add discord notification to instructors.
    }
}
