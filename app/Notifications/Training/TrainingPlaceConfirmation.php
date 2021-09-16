<?php

namespace App\Notifications\Training;

use App\Models\Training\TrainingPlace\TrainingPlaceOffer;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TrainingPlaceConfirmation extends Notification
{
    use Queueable;

    private $trainingPlaceOffer;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(TrainingPlaceOffer $trainingPlaceOffer)
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
                    ->subject('Training Place Confirmation')
                    ->view('emails.training-place.confirmation', [
                        'recipientName' => $notifiable->name,
                        'station' => $this->trainingPlaceOffer->trainingPosition->station,
                    ]);
    }
}
