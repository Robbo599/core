<?php

namespace Tests\Unit\Training\TrainingPlace;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class TrainingPlaceListenerTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function testAcceptedNotificationListenerDispatchesNotification()
    {
        Notification::fake();

        $trainingPlaceOffer = TrainingPlaceOffer::factory()->accepted()->create();
        $event = new TrainingPlaceAccepted($trainingPlaceOffer);

        $listener = new ConfirmTrainingPlace($event);
        $listener->handle($event);

        Notification::assertSentTo($trainingPlaceOffer->account, TrainingPlaceConfirmation::class);
    }
}
