<?php

namespace App\Listeners\Training;

use App\Events\Training\TrainingPlaceOffered;
use App\Notifications\Training\TrainingPlaceOffer as TrainingPlaceOfferNotification;

class SendOfferNotification
{
    /**
     * Handle the event.
     *
     * @param  TrainingPlaceOffered  $event
     * @return void
     */
    public function handle(TrainingPlaceOffered $event)
    {
        tap($event->getTrainingPlaceOffer(), function ($offer) {
            $offer->account->notify(new TrainingPlaceOfferNotification($offer));
        });
    }
}
