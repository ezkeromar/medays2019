<?php

namespace App\Exports;

use App\Models\Participants;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Carbon\Carbon;

class ParticipantsExport implements FromCollection, WithHeadings, WithMapping
{
    protected $type; 
    protected $level;
    protected $transfer;
    protected $dateTransfer;
    protected $airport;
    protected $formation;

    public function __construct($params)
    {
        if(isset($params['type'])) {
            if (strpos($params['type'], ".") !== false) {
                $typeLevel = explode('.', $params['type']);
                $this->level = $typeLevel[1];
                $this->type = $typeLevel[0];
            } else
                $this->type = $params['type'];
        }

        $this->dateTransfer = isset($params['dateTransfer']) ? $params['dateTransfer'] : null;
        $this->transfer = isset($params['transfer']) ? $params['transfer'] : null;
        $this->airport = isset($params['airport']) ? $params['airport'] : null;
        $this->formation = isset($params['formation_name']) ? $params['formation_name'] : null;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        if (isset($this->type)) {
            if(isset($this->level)) {
                return Participants::whereTypeId($this->type)->where('level','=', $this->level)->get();
            }
            return Participants::whereTypeId($this->type)->get();
        } else if(isset($this->transfer) && isset($this->airport)){
             if($this->transfer == 1){
                 $typeTransfer = 'arrival_recovery_point';
                 $dateTransfer = 'transfer_arrival_date';
             }else {
                 $typeTransfer = 'departure_deposit_point';
                 $dateTransfer = 'transfer_departure_date';
             }
            $participants = Participants::where($typeTransfer, '=', $this->airport);
             if(isset($this->dateTransfer))
                 $participants->whereDate($dateTransfer,'=', Carbon::createFromFormat('d/m/Y',$this->dateTransfer)->format('Y-m-d'));
             return $participants->get();
        } else if(isset($this->formation)) {
            if($this->formation == 'all')
                return Participants::where('has_formation','=',2)->get();
            return Participants::where('formation_name','=',$this->formation)->get();
        }

        return Participants::all();
    }

    /**
     * @return array
     * @var Participants $invoice
     */
    public function map($participant): array
    {

        $type = '';

        if (!empty($participant->type_id)) {
            if(!empty($participant->level)&&($participant->type_id == 4 || $participant->type_id == 6))
                $type = $participant->type->name.' - Niveau '.$participant->level;
            else
                $type = $participant->type->name;
        }
        try {
            $transtempdepdate = (!empty($participant->transfer_departure_date)) ? Carbon::parse($participant->transfer_departure_date)->format('d/m/Y') : '';
        } catch (\Exception $e) {
            $transtempdepdate = $participant->transfer_departure_date;
        }
        try {
            $transtemparrdate = (!empty($participant->transfer_arrival_date)) ? Carbon::parse($participant->transfer_arrival_date)->format('d/m/Y') : '';
        } catch (\Exception $e) {
            $transtemparrdate = $participant->transfer_arrival_date;
        }
        try {
            $pectempdepdate = (!empty($participant->desired_departure_date)) ? Carbon::parse($participant->desired_departure_date)->format('d/m/Y') : '';
        } catch (\Exception $e) {
            $pectempdepdate = $participant->desired_departure_date;
        }
        try {
            $pectempdesdate = (!empty($participant->desired_arrival_date)) ? Carbon::parse($participant->desired_arrival_date)->format('d/m/Y') : '';
        } catch (\Exception $e) {
            $pectempdesdate = $participant->desired_arrival_date;
        }
        try {
            $tempdepdate = (!empty($participant->departure_date)) ? Carbon::parse($participant->departure_date)->format('d/m/Y') : '';
        } catch (\Exception $e) {
            $tempdepdate = $participant->departure_date;
        }
        try {
            $pectemparrdate = (!empty($participant->arrival_date)) ? Carbon::parse($participant->arrival_date)->format('d/m/Y') : '';
        } catch (\Exception $e) {
            $pectemparrdate = $participant->arrival_date;
        }
        $data = [
            $participant->webcode,
            $participant->access_code,
            $participant->inscriptionDate ? Carbon::parse($participant->inscriptionDate)->format('d/m/Y') : '',
            $participant->status_name,
            $type,
            $participant->civility_name,
            $participant->first_name,
            $participant->last_name,
            $participant->chef ? $participant->full_name : '',
            $participant->birthday ? Carbon::parse($participant->birthday)->format('d/m/Y') : '',
            $participant->organization,
            $participant->function,
            $participant->theNationality ? $participant->theNationality->name_fr : '',
            $participant->identity_type_name,
            $participant->num_identity,
            $participant->theCountry ? $participant->theCountry->name_fr : '',
            $participant->city,
            $participant->email,
            $participant->pro_phone,
            $participant->mobile_phone,
            $participant->theRestoration ? $participant->theRestoration->name : '',
            $participant->hotel ? $participant->hotel->name : '',
            $pectemparrdate,
            $tempdepdate,
            $participant->nights_count,
            $participant->room_type_name,
            $participant->roomCategory ? $participant->roomCategory->name : '',
            $transtemparrdate,
            $participant->transfer_arrival_time ? Carbon::parse($participant->transfer_arrival_time)->format('H:i') : '',
            $participant->arrival_airline_company,
            $participant->arrival_flight_number,
            $participant->arrival_airport,
            $this->getAirportName($participant->arrival_recovery_point),
            $transtempdepdate,
            $participant->transfer_departure_time ? Carbon::parse($participant->transfer_departure_time)->format('H:i') : '',
            $participant->departure_airline_company,
            $participant->departure_flight_number,
            $this->getAirportName($participant->departure_deposit_point),
            $participant->departure_airport,
            $pectempdesdate,
            $this->getHourName($participant->desired_arrival_hour),
            $participant->pec_arrival_airport,
            $pectempdepdate,
            $this->getHourName($participant->desired_departure_hour),
            $participant->pec_departure_airport,
            $participant->has_pec == 2 ? 'Oui' : 'Non',
            isset($participant->formation_name) ? (($participant->formation_name == 1) ? 'Intelligence économique' : 'ZLECA : quels mécanismes et quelles opportunités pour les entreprises marocaines ?') : '',
            $participant->state_formation,
            $participant->language
        ];


        foreach ($participant->comments as $comment) {
            $data[] = $comment->content;
        }

        return $data;

    }

    /**
     * @return mixed
     */
    public function getHourName($id)
    {
        if ($id == 1) {
            return 'Matin';
        }

        if ($id == 2) {
            return 'Après-midi';
        }

        if ($id == 3) {
            return 'Soir';
        }
    }

    public function getAirportName($id)
    {
        foreach (config('meDays.airports') as $item) {
            if ($id == $item['id']) {
                return $item['name'];
            }
        }

        return $id;
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        $column = [
            "Web Code",
            "Access Code",
            "Date d'inscription",
            "Statut",
            "Type Participant",
            "Civilité",
            "Prénom",
            "Nom",
            "Chef Délégation",
            "Date de naissance",
            "Organisme",
            "Fonction",
            "Nationalité",
            "Type pièce d'identité",
            "Numéro pièce d'identité",
            "Pays",
            "Ville",
            "Email",
            "Téléphone professionnel",
            "Téléphone mobile",
            "Restaurant",
            "Hotel",
            "Date Arrivée",
            "Date Départ",
            "Nuitées",
            "Type de chambre",
            "Catégorie de chambre",
            "Date transfert arrivée",
            "Heure transfert arrivée",
            "compagnie aérienne arrivée",
            "Numéro de vol arrivée",
            "Aéroport de provenance",
            "Aéroport arrivée",
            "Date transfert départ",
            "Heure transfert départ",
            "Companie aérienne départ",
            "Numéro de vol départ",
            "Aéroport de départ",
            "Aéroport de destination",
            "Date d'arrivée souhaitée",
            "Heure d'arrivée souhaitée",
            "Aéroport de provenance",
            "Date de départ souhaitée",
            "Heure de départ souhaitée",
            "Aéroport de destination",
            "PEC",
            "Formation Souhaitée",
            "Statut paiement formation",
            "Langue",
            "Commentaire"
        ];

        return $column;
    }
}
