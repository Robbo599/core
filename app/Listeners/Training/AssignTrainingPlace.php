<?php

namespace App\Listeners\Training;

use App\Events\Training\TrainingPlaceAccepted;
use App\Models\Training\TrainingPlace;

class AssignTrainingPlace
{
    /**
     * Handle the event.
     *
     * @param  TrainingPlaceAccepted  $event
     * @return void
     */
    public function handle(TrainingPlaceAccepted $event): void
    {
        $offer = $event->getOffer();

        TrainingPlace::create([
            'training_position_id' => $offer->training_position_id,
            'account_id' => $offer->account_id,
            'offer_id' => $offer->offer_id,
            'accepted_at' => $offer->accepted_at,
        ]);
    }
}
