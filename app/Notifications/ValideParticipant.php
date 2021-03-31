<?php

namespace App\Notifications;

use App\Models\Participants;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ValideParticipant extends Notification
{
    use Queueable;

    protected $participant;
    protected $variables;
    protected $pec;

    const  EN_TEMPLATE = 'standard-valider-en';
    const  FR_TEMPLATE = 'standard-valider-fr';

    const  EN_TEMPLATE_PRESS = 'presse-valider-en';
    const  FR_TEMPLATE_PRESS = 'presse-valider-fr';

    const  EN_TEMPLATE_PSH = 'premium-sans-hebergement-valider-en';
    const  FR_TEMPLATE_PSH = 'premium-sans-hebergement-valider-fr';

    const  EN_TEMPLATE_PAH = 'premium-avec-hebergement-valider-en';
    const  FR_TEMPLATE_PAH = 'premium-avec-hebergement-valider-fr';


    const  EN_TEMPLATE_PM = 'partenaire-media-valider-en';
    const  FR_TEMPLATE_PM = 'partenaire-media-valider-fr';


    const  EN_TEMPLATE_S_NP_NT = 'speaker-confirmation-nopec-notransfert-en';
    const  FR_TEMPLATE_S_NP_NT = 'speaker-confirmation-nopec-notransfert-fr';

    const  EN_TEMPLATE_S_NP_T = 'speaker-confirmation-nopec-transfert-en';
    const  FR_TEMPLATE_S_NP_T = 'speaker-confirmation-nopec-transfert-fr';


    // Le mail : speaker-confirmation-pec-fr / speaker-confirmation-pec-en est envoyé une fois on importe le billet d’avion au niveau du back office.
    const  EN_TEMPLATE_S_P_CONFIRM = 'speaker-confirmation-pec-en';
    const  FR_TEMPLATE_S_P_CONFIRM = 'speaker-confirmation-pec-fr';

    const  EN_TEMPLATE_S_P = 'speaker-attente-billet-pec-en';
    const  FR_TEMPLATE_S_P = 'speaker-attente-billet-pec-fr';


    /**
     * Create a new notification instance.
     *
     * @param \App\Models\Participants $participants
     * @param bool $pec
     */
    public function __construct(Participants $participants, $pec = false)
    {
        $this->participant = $participants;
        $this->pec = $pec;
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
        try {
            $temparrdate = (!empty($this->participant->arrival_date)) ? \Carbon\Carbon::parse($this->participant->arrival_date)->format('d/m/Y') : '';
        } catch (\Exception $e) {
            $temparrdate = $this->participant->arrival_date;
        }
        try {
            $tempdepdate = (!empty($this->participant->departure_date)) ? \Carbon\Carbon::parse($this->participant->departure_date)->format('d/m/Y') : '';
        } catch (\Exception $e) {
            $tempdepdate = $this->participant->departure_date;
        }
        $this->variables = [
            "civilite"             => $this->participant->civility_name,
            "prenom"               => $this->participant->first_name,
            "nom"                  => $this->participant->last_name,
            "TYPE_CHAMBRE"         => $this->participant->room_type_name,
            "NOM_HOTEL"            => $this->participant->hotel ? $this->participant->hotel->name : '',
            "DATE_ARRIVEE"         => $temparrdate,
            "DATE_DEPART"          => $tempdepdate,
            "AEROPORT_ARRIVEE"     => $this->participant->arrival_airport,
            "HEURE_ARRIVEE"        => $this->participant->transfer_arrival_time,
            "NUMERO_DE_VOL"        => $this->participant->arrival_flight_number,
            "AEROPORT_PROVENANCE"  => $this->participant->arrival_recovery_point,
            "AEROPORT_PROVENACE"   => $this->participant->arrival_recovery_point,
            "AEROPORT_DESTINATION" => $this->participant->departure_airport,
            "webcode"              => $this->participant->webcode,
            "WEBCODE"              => $this->participant->webcode,
            "TICKET_URL"           => url($this->participant->air_ticket),
        ];

        $this->setVariables();

        // dd($this->participant);
        return (new \Coconuts\Mail\MailMessage)
            ->alias($this->getTemplate())
            ->include($this->variables);
    }

    /*
   * pec
   * desired_arrival_date
   * pec_departure_airport
   * desired_departure_date
   * pec_arrival_airport
   * desired_arrival_hour
   * desired_departure_hour
   *
     * tras
     * // arr
     * transfer_arrival_date
     * transfer_arrival_time
     * arrival_flight_number
     * arrival_airline_company
     * arrival_airport
     * arrival_recovery_point
     *  // depart
     * transfer_departure_date
     * transfer_departure_date
     * transfer_departure_time
     * departure_flight_number
     * departure_deposit_point
     * departure_airport
     *
   *
   *
   * */

    public function setVariables()
    {
        if ($this->participant->has_pec == 2 && empty($this->participant->air_ticket)) {
            try {
                $tempdepdate = (!empty($this->participant->desired_departure_date)) ? \Carbon\Carbon::parse($this->participant->desired_departure_date)->format('d/m/Y') : '';
            } catch (\Exception $e) {
                $tempdepdate = $this->participant->desired_departure_date;
            }
            try {
                $temparrdate = (!empty($this->participant->desired_arrival_date)) ? \Carbon\Carbon::parse($this->participant->desired_arrival_date)->format('d/m/Y') : '';
            } catch (\Exception $e) {
                $temparrdate = $this->participant->desired_arrival_date;
            }
            $this->variables['DATE_DEPART'] = $tempdepdate;
            $this->variables['DATE_ARRIVEE'] = $temparrdate;

            $this->variables['AEROPORT_ARRIVEE'] = $this->participant->pec_arrival_airport;
            $this->variables['AEROPORT_DESTINATION'] = $this->participant->pec_arrival_airport;

            $this->variables['AEROPORT_PROVENANCE'] = $this->participant->pec_departure_airport;
            $this->variables['AEROPORT_PROVENACE'] = $this->participant->pec_departure_airport;

            $this->variables['HEURE_ARRIVEE'] = self::getHeureValue($this->participant->desired_arrival_hour);
            $this->variables['HEURE_DEPART'] = self::getHeureValue($this->participant->desired_departure_hour);

            return true;
        } 
        if($this->participant->has_pec == 2 && !empty($this->participant->air_ticket)) {
            try {
                $tempdepdate = (!empty($this->participant->transfer_departure_date)) ? \Carbon\Carbon::parse($this->participant->transfer_departure_date)->format('d/m/Y') : '';
            } catch (\Exception $e) {
                $tempdepdate = $this->participant->transfer_departure_date;
            }
            try {
                $temparrdate = (!empty($this->participant->transfer_arrival_date)) ? \Carbon\Carbon::parse($this->participant->transfer_arrival_date)->format('d/m/Y') : '';
            } catch (\Exception $e) {
                $temparrdate = $this->participant->transfer_arrival_date;
            }
            $this->variables['DATE_DEPART'] = $tempdepdate;
            $this->variables['DATE_ARRIVEE'] = $temparrdate;

            $this->variables['AEROPORT_ARRIVEE'] = !empty($this->participant->arrival_recovery_point)&&is_numeric($this->participant->arrival_recovery_point) ? config('meDays.airports')[$this->participant->arrival_recovery_point-1]['name'] : '';
            $this->variables['AEROPORT_DESTINATION'] = $this->participant->arrival_airport;

            $this->variables['AEROPORT_PROVENANCE'] = $this->participant->arrival_airport;
            $this->variables['AEROPORT_PROVENACE'] = $this->participant->arrival_airport;

            $this->variables['HEURE_ARRIVEE'] = \Carbon\Carbon::parse($this->participant->transfer_arrival_time)->format('h:i');
            $this->variables['HEURE_DEPART'] = \Carbon\Carbon::parse($this->participant->transfer_departure_time)->format('h:i');

            $this->variables['NUMERO_DE_VOL'] = $this->participant->arrival_flight_number;
            // $this->variables['NUMERO_DE_VOL'] = $this->participant->departure_flight_number;

            return true;
        }

        if ($this->participant->has_transfert == 2 && ($this->participant->has_pec == 1 || $this->participant->has_pec == 0)) {
            try {
                $tempdepdate = (!empty($this->participant->transfer_departure_date)) ? \Carbon\Carbon::parse($this->participant->transfer_departure_date)->format('d/m/Y') : '';
            } catch (\Exception $e) {
                $tempdepdate = $this->participant->transfer_departure_date;
            }
            try {
                $temparrdate = (!empty($this->participant->transfer_arrival_date)) ? \Carbon\Carbon::parse($this->participant->transfer_arrival_date)->format('d/m/Y') : '';
            } catch (\Exception $e) {
                $temparrdate = $this->participant->transfer_arrival_date;
            }
            $this->variables['DATE_DEPART'] = $tempdepdate;
            $this->variables['DATE_ARRIVEE'] = $temparrdate;

            $this->variables['AEROPORT_ARRIVEE'] = !empty($this->participant->arrival_recovery_point)&&is_numeric($this->participant->arrival_recovery_point) ? config('meDays.airports')[$this->participant->arrival_recovery_point-1]['name'] : '';
            $this->variables['AEROPORT_DESTINATION'] = $this->participant->arrival_airport;

            $this->variables['AEROPORT_PROVENANCE'] = $this->participant->arrival_airport;
            $this->variables['AEROPORT_PROVENACE'] = $this->participant->arrival_airport;

            $this->variables['HEURE_ARRIVEE'] = \Carbon\Carbon::parse($this->participant->transfer_arrival_time)->format('h:i');
            $this->variables['HEURE_DEPART'] = \Carbon\Carbon::parse($this->participant->transfer_departure_time)->format('h:i');

            $this->variables['NUMERO_DE_VOL'] = $this->participant->arrival_flight_number;
            // $this->variables['NUMERO_DE_VOL'] = $this->participant->departure_flight_number;

            return true;
        }

        // if (($this->participant->has_transfert == 1 || $this->participant->has_transfert == 0) && ($this->participant->has_pec == 1 || $this->participant->has_pec == 0)) {
        //     $this->variables['DATE_DEPART'] = $this->participant->transfer_departure_date;
        //     $this->variables['DATE_ARRIVEE'] = $this->participant->transfer_arrival_date;

        //     $this->variables['AEROPORT_ARRIVEE'] = $this->participant->arrival_recovery_point;
        //     $this->variables['AEROPORT_DESTINATION'] = $this->participant->arrival_airport;

        //     $this->variables['AEROPORT_PROVENANCE'] = $this->participant->departure_deposit_point;
        //     $this->variables['AEROPORT_PROVENACE'] = $this->participant->departure_airport;

        //     $this->variables['HEURE_ARRIVEE'] = $this->participant->transfer_arrival_time;
        //     $this->variables['HEURE_DEPART'] = $this->participant->transfer_departure_time;

        //     $this->variables['NUMERO_DE_VOL'] = $this->participant->arrival_flight_number;
        //     $this->variables['NUMERO_DE_VOL'] = $this->participant->departure_flight_number;

        //     return true;
        // }
    }

    public function getHeureValue($val)
    {
        if ($val == 1) {
            return __('front.' . $this->participant->language . '.morning');
        }

        if ($val == 2) {
            return __('front.' . $this->participant->language . '.afterlunch');
        }

        return __('front.' . $this->participant->language . '.night');
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
                if (!empty($this->participant->air_ticket)) {
                    return $this->participant->language == 'fr' ? self::FR_TEMPLATE_S_P_CONFIRM : self::EN_TEMPLATE_S_P_CONFIRM;
                } else {
                    return $this->participant->language == 'fr' ? self::FR_TEMPLATE_S_P : self::EN_TEMPLATE_S_P;
                }
            }

        }

        if ($this->participant->type_id == 7) {
            return $this->participant->language == 'fr' ? self::FR_TEMPLATE_PRESS : self::EN_TEMPLATE_PRESS;
        }

        if ($this->participant->type_id == 8) {
            if($this->participant->has_pec == 2 && !empty($this->participant->air_ticket)) {
                return $this->participant->language == 'fr' ? self::FR_TEMPLATE_S_P_CONFIRM : self::EN_TEMPLATE_S_P_CONFIRM;
            } else {
                if($this->participant->has_pec == 2) {
                    return $this->participant->language == 'fr' ? self::FR_TEMPLATE_S_P : self::EN_TEMPLATE_S_P;
                } else {
                    return $this->participant->language == 'fr' ? self::FR_TEMPLATE_PM : self::EN_TEMPLATE_PM;
                }
            }
        }

        // SPONSOR
        if ($this->participant->type_id == 9) {
            return $this->participant->language == 'fr' ? self::FR_TEMPLATE_PAH : self::EN_TEMPLATE_PAH;
        }

        if ($this->participant->type_id == 2) {
            return $this->participant->language == 'fr' ? self::FR_TEMPLATE_PSH : self::EN_TEMPLATE_PSH;
        }

        if ($this->participant->type_id == 3) {
            return $this->participant->language == 'fr' ? self::FR_TEMPLATE_PAH : self::EN_TEMPLATE_PAH;
        }

        return $this->participant->language == 'fr' ? self::FR_TEMPLATE : self::EN_TEMPLATE;
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
