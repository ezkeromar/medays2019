<?php

namespace App\Notifications;

use App\Models\Participants;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class RegisterParticipant extends Notification
{
    use Queueable;

    protected $participant;

    const  EN_TEMPLATE = 'standard-pre-inscription-en';
    const  FR_TEMPLATE = 'standard-pre-inscription-fr';

    const  EN_TEMPLATE_PRESS = 'presse-demande-accreditation-en';
    const  FR_TEMPLATE_PRESS = 'presse-demande-accreditation-fr';

    const  EN_TEMPLATE_PSH = 'premium-sans-herbergement-invitation-en';
    const  FR_TEMPLATE_PSH = 'premium-sans-herbergement-invitation-fr';


    /**
     * Create a new notification instance.
     *
     * @param \App\Models\Participants $participants
     */
    public function __construct(Participants $participants)
    {
        $this->participant = $participants;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     *
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     *
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new \Coconuts\Mail\MailMessage)
            ->alias($this->getTemplate())
            ->include([
                "civilite" => $this->participant->civility_name,
                "prenom"   => $this->participant->first_name,
                "nom"      => $this->participant->last_name,
            ]);
    }

    public function getTemplate()
    {
        if ($this->participant->type_id == 7) {
            return ($this->participant->language == 'fr' ? self::FR_TEMPLATE_PRESS : self::EN_TEMPLATE_PRESS);
        }

        if ($this->participant->type_id == 2) {
            return ($this->participant->language == 'fr' ? self::FR_TEMPLATE_PSH : self::EN_TEMPLATE_PSH);
        }

        return ($this->participant->language == 'fr' ? self::FR_TEMPLATE : self::EN_TEMPLATE);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     *
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
