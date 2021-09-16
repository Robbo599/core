<?php

namespace Database\Factories\Training\TrainingPlace;

use App\Models\Mship\Account;
use App\Models\Training\TrainingPlace\TrainingPlaceOffer;
use App\Models\Training\TrainingPlace\TrainingPosition;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Ramsey\Uuid\Uuid;

class TrainingPlaceOfferFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TrainingPlaceOffer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'offer_id' => Uuid::uuid4()->toString(),
            'training_position_id' => function () {
                return TrainingPosition::factory()->create()->id;
            },
            'account_id' => factory(Account::class)->create()->id,
            'offered_by' => factory(Account::class)->create()->id,
            'expires_at' => Carbon::now()->addHours(72),
        ];
    }

    /**
     * Return an accepted TrainingPlaceOffer.
     *
     * @return array
     */
    public function accepted()
    {
        return $this->state(function () {
            return [
                'accepted_at' => Carbon::now(),
            ];
        });
    }
}
