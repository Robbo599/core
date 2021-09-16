<?php

namespace Tests\Feature\Training\TrainingPlace;

use App\Events\Training\TrainingPlaceAccepted;
use App\Events\Training\TrainingPlaceDeclined;
use App\Models\Mship\Account;
use App\Models\Training\TrainingPlace\TrainingPlaceOffer;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class TrainingPlaceOfferUserTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function testDoesntAllowNavigationWhenOfferExpired()
    {
        $trainingPlaceOffer = TrainingPlaceOffer::factory()->create(['expires_at' => $this->knownDate->subMinutes(5), 'account_id' => $this->user->id]);

        $this->actingAs($this->user)
            ->get("training/offer/{$trainingPlaceOffer->offer_id}/view")
            ->assertStatus(403);
    }

    /** @test */
    public function testDoesntAllowNavigationToAnotherUsers()
    {
        $trainingPlaceOffer = TrainingPlaceOffer::factory()->create(['expires_at' => $this->knownDate->addHours(5), 'account_id' => $this->user->id]);

        $otherAccount = factory(Account::class)->create();
        $this->actingAs($otherAccount)
            ->get("training/offer/{$trainingPlaceOffer->offer_id}/view")
            ->assertStatus(403);
    }

    /** @test */
    public function testRendersViewWithOfferWhenAuthorized()
    {
        $trainingPlaceOffer = TrainingPlaceOffer::factory()->create(['expires_at' => $this->knownDate->addDays(1), 'account_id' => $this->user->id]);

        $this->actingAs($this->user)
            ->get("training/offer/{$trainingPlaceOffer->offer_id}/view")
            ->assertSuccessful();
    }

    /** @test */
    public function testUserCanAcceptNonExpiredTrainingPlace()
    {
        $trainingPlaceOffer = TrainingPlaceOffer::factory()->create(['expires_at' => $this->knownDate->addDays(1), 'account_id' => $this->user->id]);

        Event::fakeFor(function () use ($trainingPlaceOffer) {
            $this->actingAs($this->user)
                ->post("training/offer/{$trainingPlaceOffer->offer_id}/accept")
                ->assertRedirect(route('mship.manage.dashboard'))
                ->assertSessionHas('success');

            $this->assertEquals($trainingPlaceOffer->fresh()->accepted_at, Carbon::now());

            Event::assertDispatched(TrainingPlaceAccepted::class, function ($event) use ($trainingPlaceOffer) {
                return $event->getOffer()->offer_id == $trainingPlaceOffer->offer_id;
            });
        });
    }

    /** @test */
    public function testUserCanDeclineTrainingPlaceWithReason()
    {
        $trainingPlaceOffer = TrainingPlaceOffer::factory()->create(['expires_at' => $this->knownDate->addDays(1), 'account_id' => $this->user->id]);

        Event::fakeFor(function () use ($trainingPlaceOffer) {
            $this->actingAs($this->user)
                ->post("training/offer/{$trainingPlaceOffer->offer_id}/decline", ['declined_reason' => 'foo'])
                ->assertRedirect(route('mship.manage.dashboard'))
                ->assertSessionHas('success');

            tap($trainingPlaceOffer->fresh(), function ($offer) {
                $this->assertEquals($offer->declined_at, Carbon::now());
                $this->assertEquals($offer->declined_reason, 'foo');
            });

            Event::assertDispatched(TrainingPlaceDeclined::class, function ($event) use ($trainingPlaceOffer) {
                return $event->getOffer()->offer_id == $trainingPlaceOffer->offer_id;
            });
        });
    }

    /** @test */
    public function testValidatesDeclineReason()
    {
        $trainingPlaceOffer = TrainingPlaceOffer::factory()->create(['expires_at' => $this->knownDate->addDays(1), 'account_id' => $this->user->id]);

        $this->actingAs($this->user)
            ->post("training/offer/{$trainingPlaceOffer->offer_id}/decline", [])
            ->assertSessionHasErrors('declined_reason');
    }
}
