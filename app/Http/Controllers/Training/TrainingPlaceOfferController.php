<?php

namespace App\Http\Controllers\Training;

use App\Events\Training\TrainingPlaceAccepted;
use App\Events\Training\TrainingPlaceDeclined;
use App\Http\Controllers\BaseController;
use App\Models\Training\TrainingPlace\TrainingPlaceOffer;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redirect;

class TrainingPlaceOfferController extends BaseController
{
    public function view(TrainingPlaceOffer $trainingPlaceOffer)
    {
        $this->authorize('view', $trainingPlaceOffer);

        return $this->viewMake('training.training-places.offer-view')->with('offer', $trainingPlaceOffer);
    }

    public function accept(TrainingPlaceOffer $trainingPlaceOffer, Request $request)
    {
        $this->authorize('update', $trainingPlaceOffer);

        $trainingPlaceOffer->update(['accepted_at' => Carbon::now()]);

        event(new TrainingPlaceAccepted($trainingPlaceOffer));

        return Redirect::route('mship.manage.dashboard')
            ->withSuccess('Training place accepted! You will shortly receive a confirmation email.');
    }

    public function decline(TrainingPlaceOffer $trainingPlaceOffer, Request $request)
    {
        $this->authorize('update', $trainingPlaceOffer);

        $validated = $request->validate([
            'declined_reason' => 'required|string',
        ]);

        $trainingPlaceOffer->update([
            'declined_at' => Carbon::now(),
            'declined_reason' => $validated['declined_reason'],
        ]);

        event(new TrainingPlaceDeclined($trainingPlaceOffer));

        return Redirect::route('mship.manage.dashboard')
            ->withSuccess('Training place declined.');
    }
}
