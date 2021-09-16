<?php

namespace App\Notifications\Training;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Carbon;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Training\TrainingPlace\TrainingPlaceOffer as TrainingPlaceOfferModel;

class TrainingPlaceOffer extends Notification implements ShouldQueue
{
    use Queueable;

    private $trainingPlaceOffer;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(TrainingPlaceOfferModel $trainingPlaceOffer)
    {
        $this->trainingPlaceOffer = $trainingPlaceOffer;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->from('atc-training@vatsim.uk', 'VATSIM UK - Training Department')
                    ->subject('Training Place Offer')
                    ->view('emails.training-place.offer', [
                        'recipientName' => $notifiable->name,
                        'expiry' => Carbon::parse($this->trainingPlaceOffer->expires_at)->toRfc850String(),
                        'station' => $this->trainingPlaceOffer->trainingPosition->station,
                        'offerId' => $this->trainingPlaceOffer->offer_id
                    ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
