<?php

namespace App\Notifications;

use App\Models\Participants;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class SendInvitationParticipant extends Notification
{
    use Queueable;

    protected $participant;


    const  EN_TEMPLATE_PSH = 'premium-sans-herbergement-invitation-en';
    const  FR_TEMPLATE_PSH = 'premium-sans-herbergement-invitation-fr';

    const  EN_TEMPLATE_PAH = 'premium-avec-herbergement-invitation-en';
    const  FR_TEMPLATE_PAH = 'premium-avec-herbergement-invitation-fr';

    const  EN_TEMPLATE_S_NP_NT = 'speaker-invitation-nopec-notransfert-en';
    const  FR_TEMPLATE_S_NP_NT = 'speaker-invitation-nopec-notransfert-fr';

    const  EN_TEMPLATE_S_NP_T = 'speaker-invitation-nopec-transfert-en';
    const  FR_TEMPLATE_S_NP_T = 'speaker-invitation-nopec-transfert-fr';

    const  EN_TEMPLATE_S_P = 'speaker-invitation-pec-en';
    const  FR_TEMPLATE_S_P = 'speaker-invitation-pec-fr';

    const  EN_TEMPLATE_PM = 'premium-avec-herbergement-invitation-en';
    const  FR_TEMPLATE_PM = 'premium-avec-herbergement-invitation-fr';

    // const  EN_TEMPLATE_PM = 'partenaire-media-valider-en';
    // const  FR_TEMPLATE_PM = 'partenaire-media-valider-fr';



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
        $template = $this->getTemplate();

        if ($template) {
            return (new \Coconuts\Mail\MailMessage)
                ->alias($template)
                ->include([
                    "civilite" => $this->participant->civility_name,
                    "prenom"   => $this->participant->first_name,
                    "nom"      => $this->participant->last_name,
                    "webcode"  => $this->participant->webcode,
                    "WEBCODE"  => $this->participant->webcode,
                ]);
        }

        return new MailMessage();
    }

    public function getTemplate()
    {

        // SPEAKER || delegation
        if ($this->participant->type_id == 4 || $this->participant->type_id == 6) {

            if (($this->participant->has_transfert == 1 || $this->participant->has_transfert == 0) && ($this->participant->has_pec == 1 || $this->participant->has_pec == 0)) {
                return $this->participant->language == 'fr' ? self::FR_TEMPLATE_S_NP_NT : self::EN_TEMPLATE_S_NP_NT;
            }

            if ($this->participant->has_transfert == 2 && ($this->participant->has_pec == 1 || $this->participant->has_pec == 0)) {
                return $this->participant->language == 'fr' ? self::FR_TEMPLATE_S_NP_T : self::EN_TEMPLATE_S_NP_T;
            }

            if ($this->participant->has_pec == 2) {
                return $this->participant->language == 'fr' ? self::FR_TEMPLATE_S_P : self::EN_TEMPLATE_S_P;
            }

        }

        // PSH
        if ($this->participant->type_id == 2) {
            return $this->participant->language == 'fr' ? self::FR_TEMPLATE_PSH : self::EN_TEMPLATE_PSH;
        }

        // PAH
        if ($this->participant->type_id == 3) {
            return $this->participant->language == 'fr' ? self::FR_TEMPLATE_PAH : self::EN_TEMPLATE_PAH;
        }


        // PM
        if ($this->participant->type_id == 8) {
            return $this->participant->language == 'fr' ? self::FR_TEMPLATE_PM : self::EN_TEMPLATE_PM;
        }
        // SPONSOR
        if ($this->participant->type_id == 9) {
            return $this->participant->language == 'fr' ? self::FR_TEMPLATE_PAH : self::EN_TEMPLATE_PAH;
        }

        return false;
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
