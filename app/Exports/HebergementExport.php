<?php

namespace App\Exports;

use App\Models\Participants;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class HebergementExport implements FromCollection, WithHeadings, WithMapping
{
    protected $hotel;

    public function __construct($hotel)
    {
            $this->hotel = $hotel;
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        if (isset($this->hotel)) {
            return Participants::where('hotel_id', '=', $this->hotel)->get();
        }
        return Participants::whereNotNull('hotel_id')->get();
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
        try{
            $period = CarbonPeriod::create(Carbon::parse($participant->arrival_date), Carbon::parse($participant->departure_date), CarbonPeriod::EXCLUDE_END_DATE);
            $dates = array_map(function($date) {
                return $date->format('d/m/Y');
            }, $period->toArray());

        } catch (\Exception $e) {
            $period = CarbonPeriod::create($participant->arrival_date, $participant->departure_date, CarbonPeriod::EXCLUDE_END_DATE);
            $dates = array_map(function($date) {
                return $date->format('d/m/Y');
            }, $period->toArray());
        }
        $data = [
            $participant->webcode,
            $participant->access_code,
            $participant->status_name,
            $type,
            $participant->civility_name,
            $participant->first_name,
            $participant->last_name,
            $participant->function,
            $participant->theNationality ? $participant->theNationality->name_fr : '',
            $participant->hotel ? $participant->hotel->name : '',
            $period->first()->format('d/m/Y'),
            $period->last()->addDay(1)->format('d/m/Y'),
            ( preg_match('('.implode('|',$dates).')', "09/11/2019")) ? 'X' : '',
            ( preg_match('('.implode('|',$dates).')', "10/11/2019")) ? 'X' : '',
            ( preg_match('('.implode('|',$dates).')', "11/11/2019")) ? 'X' : '',
            ( preg_match('('.implode('|',$dates).')', "12/11/2019")) ? 'X' : '',
            ( preg_match('('.implode('|',$dates).')', "13/11/2019")) ? 'X' : '',
            ( preg_match('('.implode('|',$dates).')', "14/11/2019")) ? 'X' : '',
            ( preg_match('('.implode('|',$dates).')', "15/11/2019")) ? 'X' : '',
            ( preg_match('('.implode('|',$dates).')', "16/11/2019")) ? 'X' : '',
            ( preg_match('('.implode('|',$dates).')', "17/11/2019")) ? 'X' : '',
            ( preg_match('('.implode('|',$dates).')', "18/11/2019")) ? 'X' : '',
            $participant->nights_count,
            $participant->room_type_name,
            $participant->roomCategory ? $participant->roomCategory->name : '',
            $participant->has_pec == 2 ? 'Oui' : 'Non',
        ];

        foreach ($participant->comments as $comment) {
            $data[] = $comment->content;
        }

        return $data;

    }
    /**
     * @return array
     */
    public function headings(): array
    {
        $column = [
            "Web Code",
            "Access Code",
            "Statut",
            "Type Participant",
            "Civilité",
            "Prénom",
            "Nom",
            "Fonction",
            "Nationalité",
            "Hotel",
            "Date Arrivée",
            "Date Départ",
            "9/11",
            "10/11",
            "11/11",
            "12/11",
            "13/11",
            "14/11",
            "15/11",
            "16/11",
            "17/11",
            "18/11",
            "Nuitées",
            "Type de chambre",
            "Catégorie de chambre",
            "PEC",
            "Commentaire"
        ];

        return $column;
    }
}
