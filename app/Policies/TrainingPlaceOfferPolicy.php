<?php

namespace App\Policies;

use App\Models\Mship\Account;
use Illuminate\Support\Carbon;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\Training\TrainingPlace\TrainingPlaceOffer;

class TrainingPlaceOfferPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\Mship\Account  $account
     * @param  \App\Models\Training\TrainingPlace\TrainingPlaceOffer  $trainingPlaceOffer
     * @return mixed
     */
    public function view(Account $account, TrainingPlaceOffer $trainingPlaceOffer)
    {
        $offerBelongsToAccount = $account->id == $trainingPlaceOffer->account_id;
        $offerHasntExpired = Carbon::now() < $trainingPlaceOffer->expires_at;
        $offerHasNotBeenAccepted = $trainingPlaceOffer->accepted_at == null;

        return $offerBelongsToAccount && $offerHasntExpired && $offerHasNotBeenAccepted;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\Mship\Account  $account
     * @param  \App\Models\Training\TrainingPlace\TrainingPlaceOffer  $trainingPlaceOffer
     * @return mixed
     */
    public function update(Account $account, TrainingPlaceOffer $trainingPlaceOffer)
    {
        return $account->id == $trainingPlaceOffer->account_id;
    }
}
