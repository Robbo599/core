<?php

namespace App\Listeners\Training;

use App\Events\Training\TrainingPlaceAccepted;
use App\Notifications\Training\TrainingPlaceConfirmation;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendTrainingPlaceConfirmationMail
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  TrainingPlaceAccepted  $event
     * @return void
     */
    public function handle(TrainingPlaceAccepted $event) : void
    {
        tap($event->getOffer()->account, function ($account) use ($event) {
            $account->notify(new TrainingPlaceConfirmation($event->getOffer()));
        });
    }
}
