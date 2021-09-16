<?php

namespace App\Listeners\Training;

use App\Events\Training\TrainingPlaceDeclined;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

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
