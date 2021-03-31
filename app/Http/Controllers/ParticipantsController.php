<?php

namespace App\Http\Controllers;


use App\Country;
use App\Models\Participants;
use App\Models\Types;
use App\Models\ParticipantType;
use App\Models\Comment;
use App\Models\Hotel;
use App\Models\Restaurant;
use App\Models\RoomCategory;
use App\Models\Action;
use App\Models\User;
use App\Notifications\DeclineParticipant;
use App\Notifications\DeleteParticipant;
use App\Notifications\RegisterParticipant;
use App\Notifications\SendInvitationParticipant;
use App\Notifications\ValideParticipant;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Validator;
use DB;

class ParticipantsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $participants = new Participants;

        if(!empty($request->all()['query'])) {
            $participants = $participants->where(function ($query) use($request) {
                $templastname = explode(' ', $request->all()['query'])[0];
                $query->where('last_name', 'like', '%'.$request->all()['query'].'%')
                    ->orWhere('first_name', 'like', '%'.$request->all()['query'].'%')
                    ->orWhere('organization', 'like', '%'.$request->all()['query'].'%')
                    ->orWhere('last_name', 'like', '%'.$templastname.'%');
            });
        }
        if(!empty($request->all()['type'])) {
            if($request->all()['type'] != 'Tous') {
                $participants = $participants->where('type_id', '=', $request->all()['type']);
            }
        }
        if(!empty($request->all()['status'])) {
            if($request->all()['status'] != 11 && $request->all()['status'] != 12) {
                $participants = $participants->where('status', '=', $request->all()['status']);
            } else {
                if($request->all()['status'] == 11) {
                    $participants = $participants->where(function($query) {
                        $query->where('type_id', '=', 4)->orWhere('type_id', '=', 5)->orWhere('type_id', '=', 6)->orWhere('type_id', '=', 8)->orWhere('type_id', '=', 9);
                    });
                    $participants = $participants->where('has_pec', '=', 2);
                }
                if($request->all()['status'] == 12) {
                    $participants = $participants->where(function($query) {
                        $query->where('type_id', '=', 4)->orWhere('type_id', '=', 5)->orWhere('type_id', '=', 6)->orWhere('type_id', '=', 8)->orWhere('type_id', '=', 9);
                    });
                    $participants = $participants->where(function($query) {
                        $query->where('has_pec', '=', 1)->orWhere('has_pec', '=', 0);
                    });
                }
            }
        }
        $participantsList = $participants->orderBy('updated_at', 'desc')->with(['theCountry'])->paginate(50);
        $participantTypes = ParticipantType::select(['name', 'group_id', 'id'])->get()->groupBy('group_id');

        return view('participants.show', ['participants' => $participantsList, 'types' => $participantTypes]);
    }

    public function showformation (Request $request) {
        $participants = new Participants;
        $participants = $participants->where('has_formation', '2');
        if(!empty($request->all()['query'])) {
            $participants = $participants->where(function ($query) use($request) {
                $query->where('last_name', 'like', '%'.$request->all()['query'].'%')
                    ->orWhere('first_name', 'like', '%'.$request->all()['query'].'%')
                    ->orWhere('organization', 'like', '%'.$request->all()['query'].'%');
            });
        }
        if(!empty($request->all()['formation'])) {
            if($request->all()['formation'] == 'ie'){
                $participants = $participants->where('formation_name', 1);
            }
            if($request->all()['formation'] == 'zlecaf'){
                $participants = $participants->where('formation_name', 2);
            }
        }
        if(!empty($request->all()['type'])) {
            if($request->all()['type'] != 'Tous') {
                $participants = $participants->where('type_id', '=', $request->all()['type']);
            }
        }
        if(!empty($request->all()['formation_state'])) {
            if($request->all()['formation_state'] != 'Tous') {
                $participants = $participants->where('formation_state', '=', $request->all()['formation_state']);
            }
        }
        $participantsList = $participants->orderBy('updated_at', 'desc')->paginate(50);
        $participantTypes = ParticipantType::select(['name', 'group_id', 'id'])->get()->groupBy('group_id');
        return view('participants.formations', ['participants' => $participantsList, 'types' => $participantTypes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function addAction($title, $participant, $column = null, $oldValue = null, $newValue = null) {
        $tempTitle = $title;
        if(!empty($column))
            $tempTitle .= " : '".$column."'";
        if(!empty($oldValue))
            $tempTitle .= "<br/><span class='redColor'>".$oldValue."</span> >> ";
        if(!empty($newValue) && empty($oldValue))
            $tempTitle .= "<br/><span class='redColor'>...</span> >> <span class='greenColor'>".$newValue."</span>";
        else if(!empty($newValue) && !empty($oldValue))
            $tempTitle .= "<span class='greenColor'>".$newValue."</span>";
        $action = new Action;
        $action->title = $tempTitle;
        $action->participant_id = $participant;
        $action->user_id = (!empty(auth()->user()->id)) ? auth()->user()->id : 0;
        $action->save();
    }

    public function multiActionFunc($action, $ids) {
        $idsarr = explode(',', $ids);
        // dd(count($idsarr));
        for ($i=0; $i < count($idsarr); $i++) {
            if (!empty($idsarr[$i])) {
                $this->actionFunc($idsarr[$i], $action);
            }
        }
        return redirect()->back();
    }

    public function actionFunc($id, $action, $params = null) {
        $status = [];
        $status[1] = 'En attente';
        $status[2] = 'Invitation envoyée';
        $status[3] = 'Validée';
        $status[4] = 'Refusée';
        $status[5] = 'Désactivé';
        $status[6] = 'Demande transport';
        $status[7] = 'Attente informations transfert';
        $status[8] = 'Badge en cours d’édition';
        $status[9] = 'Badge édité';
        $status[10] = 'Badge livré';
        $status[13] = 'Attente de validation';
        $p = Participants::where('id', $id)->first();
        switch($action) {
            case 15:
                $participants = Participants::find($id);
                $oldState = $status[$participants->status];
                $participants->status = 2;
                $participants->save();
                $participants->notify(new SendInvitationParticipant($participants, true));
                $this->addAction('Modification', $id, 'Statut', $oldState, $status[2]);
                return redirect()->back();
                break;
            case 1:
                // if($p->type_id == 1 && $p->type_id == 7) {
                    $participants = Participants::where('id', $id)->first();
                    $oldState = $status[$participants->status];
                    $participants->status = 3;
                    $participants->save();
                    $participants->notify(new ValideParticipant($participants, true));
                    $this->addAction('Modification', $id, 'Statut', $oldState, $status[3]);
                    return redirect()->back();
                // }
                break;
            case 2:
                if($p->type_id == 1 || $p->type_id == 7) {
                    $participants = Participants::where('id', $id)->first();
                    $oldState = $status[$participants->status];
                    $participants->status = 4;
                    $participants->save();
                    $participants->notify(new DeclineParticipant($participants, true));
                    $this->addAction('Modification', $id, 'Statut', $oldState, $status[4]);
                    return redirect()->back();
                }
                break;
            case 4:
                $participants = Participants::find($id);
                $oldState = $status[$participants->status];
                $participants->status = 10;
                $participants->save();
                $this->addAction('Modification', $id, 'Statut', $oldState, $status[10]);
                return redirect()->back();
                break;
            case 6:
                $participants = Participants::find($id);
                $oldState = $status[$participants->status];
                $participants->status = 5;
                $participants->save();
                $participants->notify(new DeleteParticipant($participants));
                $this->addAction('Modification', $id, 'Statut', $oldState, $status[5]);
                return back();
                break;
            case 5:
                return redirect('/participant/'.$id);
                break;
            case 3:
                return redirect('/participants');
                break;
            case 7:
                $participants = Participants::find($id);
                $oldState = ParticipantType::where('id', $participants->type_id)->value('name');
                $participants->type_id = $params;
                if (request()->has('level')) {
                    $participants->level = \request()->get('level');
                }
                $participants->save();
                $this->addAction('Modification', $id, 'Type', $oldState, ParticipantType::where('id', $params)->value('name'));
                return redirect()->back();
                break;
            case 99:
                $participants = Participants::find($id);
                $participants->delete();

                return redirect('/participants')->with('success', trans('Participant supprimé avec succès'));
                break;
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
    */

    public function registerfront ($lang = 'fr') {
        $lang = ($lang != 'fr' && $lang != 'en') ? 'fr' : $lang;
        return view('front.index', ['lang' => $lang]);
    }

    public function registerfronttow ($lang = 'fr') {
        $lang = ($lang != 'fr' && $lang != 'en') ? 'fr' : $lang;
        $countriesList = null;
        if($lang == 'fr') {
            $countriesList = Country::orderBy('name_fr')->get();
        } else {
            $countriesList = Country::orderBy('name_en')->get();
        }
        return view('front.steptow', ['countries'=> $countriesList, 'lang' => $lang]);
    }

    public function changelangofpartic ($lang, $id) {

        $participant = Participants::where('id', $id)->first();
        $countriesList = null;
        if($lang == 'fr') {
            $countriesList = Country::orderBy('name_fr')->get();
        } else {
            $countriesList = Country::orderBy('name_en')->get();
        }
        if(!empty($participant)) {
            return view('front.steptow', ['countries'=> $countriesList, 'lang' => $lang, 'id' => $participant->id, 'type_id' => $participant->type_id, 'participant' => $participant]);
        } else {
            return view('front.index', ['lang' => $lang]);
        }
    }

    public function registerfrontonestore (Request $request, $lang = 'fr') {
        $participant = Participants::where('webcode', $request->all()['webcode'])->first();

        $countriesList = null;
        if(!empty($participant)){
            if($participant->language == 'fr') {
                $countriesList = Country::orderBy('name_fr')->get();
            } else {
                $countriesList = Country::orderBy('name_en')->get();
            }
        }

        if(!empty($participant)) {
            try {
                $participant->desired_departure_date = !empty($participant->desired_departure_date) ? \Carbon\Carbon::parse($participant->desired_departure_date)->format("d/m/Y") : '';
            } catch (\Exception $e) {
            }
            try {
                $participant->desired_arrival_date = !empty($participant->desired_arrival_date) ? \Carbon\Carbon::parse($participant->desired_arrival_date)->format("d/m/Y") : '';
            } catch (\Exception $e) {
            }
            try {
                $participant->transfer_departure_date = !empty($participant->transfer_departure_date) ? \Carbon\Carbon::parse($participant->transfer_departure_date)->format("d/m/Y") : '';
            } catch (\Exception $e) {
            }
            try {
                $participant->transfer_arrival_date = !empty($participant->transfer_arrival_date) ? \Carbon\Carbon::parse($participant->transfer_arrival_date)->format("d/m/Y") : '';
            } catch (\Exception $e) {
            }
            try {
                $participant->departure_date = !empty($participant->departure_date) ? \Carbon\Carbon::parse($participant->departure_date)->format("d/m/Y") : '';
            } catch (\Exception $e) {
            }
            try {
                $participant->arrival_date = !empty($participant->arrival_date) ? \Carbon\Carbon::parse($participant->arrival_date)->format("d/m/Y") : '';
            } catch (\Exception $e) {
            }
            return view('front.steptow', ['countries'=> $countriesList, 'lang' => $participant->language, 'id' => $participant->id, 'type_id' => $participant->type_id, 'participant' => $participant]);
        } else {
            return view('front.index', ['lang' => $lang, 'codenotfound' => true])->withErrors(['message' =>'WebCode not found']);
        }
    }

    public function storePrestation(Request $request, $id = null, $front = false) {
        $data = $request->all();
        $participants = Participants::find($id);
        if(!$front && $participants->restoration && !empty($data['restoration']) && $data['restoration'] != "none" && $data['restoration'] != $participants->restoration) {
            $newHotelVal = Restaurant::where('id', $data['restoration'])->value('name');
            $oldHotelVal = Restaurant::where('id', $participants->restoration)->value('name');
            $this->addAction('Modification', $id, 'Restoration', $oldHotelVal, $newHotelVal);
        }
        if(!$front && $participants->hotel_id && !empty($data['hotel_id']) && $data['hotel_id'] != "none" && $data['hotel_id'] != 'none' && $data['hotel_id'] != $participants->hotel_id) {
            $newHotelVal = Hotel::find($data['hotel_id'])->value('name');
            $oldHotelVal = Hotel::find($participants->hotel_id)->value('name');
            $this->addAction('Modification', $id, 'Hotel', $oldHotelVal, $newHotelVal);
        }
        if(!$front && $participants->room_category_id && !empty($data['room_category_id']) && $data['room_category_id'] != "none" && $data['room_category_id'] != 'none' && $data['room_category_id'] != $participants->room_category_id) {
            $newHotelVal = RoomCategory::find($data['room_category_id'])->value('name');
            $oldHotelVal = RoomCategory::find($participants->room_category_id)->value('name');
            $this->addAction('Modification', $id, 'Chambre Catégory', $oldHotelVal, $newHotelVal);
        }
        if(!$front && $participants->room_type && !empty($data['room_type']) && $data['room_type'] != "none" && $data['room_type'] != 'none' && $data['room_type'] != $participants->room_type) {
            $newHotelVal = ($data['room_type'] == 1) ? 'Single' : 'Double';
            $oldHotelVal = ($participants->room_type == 1) ? 'Single' : 'Double';
            $this->addAction('Modification', $id, 'Chambre Type', $oldHotelVal, $newHotelVal);
        }
        if(!$front && $participants->formation_name && !empty($data['formation_name']) && $data['formation_name'] != "none" && $data['formation_name'] != 'none' && $data['formation_name'] != $participants->formation_name) {
            $newHotelVal = ($data['formation_name'] == 1) ? 'Intelligence économique' : 'ZLECA : quels mécanismes et quelles opportunités pour les entreprises marocaines ?';
            $oldHotelVal = ($participants->formation_name == 1) ? 'Intelligence économique' : 'ZLECA : quels mécanismes et quelles opportunités pour les entreprises marocaines ?';
            $this->addAction('Modification', $id, 'Titre formation', $oldHotelVal, $newHotelVal);
        }
        if(!$front && $participants->formation_state && !empty($data['formation_state']) && $data['formation_state'] != "none" && $data['formation_state'] != 'none' && $data['formation_state'] != $participants->formation_state) {
            $newHotelVal = ($data['formation_state'] == 1) ? 'Attente paiement' : ($data['formation_state'] == 2) ? 'Payée' : 'Annulée';
            $oldHotelVal = ($participants->formation_state == 1) ? 'Attente paiement' : ($data['formation_state'] == 2) ? 'Payée' : 'Annulée';
            $this->addAction('Modification', $id, 'Status formation', $oldHotelVal, $newHotelVal);
        }
        try{
            if(!$front && $participants->arrival_date && !empty($data['arrival_date']) && Carbon::createFromFormat('d/m/Y', $data['arrival_date'])->format('d/m/Y') != Carbon::parse($participants->arrival_date)->format('d/m/Y')) {
                $this->addAction('Modification', $id, "Date d'arrivé", Carbon::parse($participants->arrival_date)->format('d/m/Y'), Carbon::parse($data['arrival_date'])->format('d/m/Y'));
            }
        } catch (\Exception $exception) {
        }
        try{
            if(!$front && $participants->departure_date && !empty($data['departure_date']) && Carbon::createFromFormat('d/m/Y', $data['departure_date'])->format('d/m/Y') != Carbon::parse($participants->departure_date)->format('d/m/Y')) {
                $this->addAction('Modification', $id, 'Date de départ', Carbon::parse($participants->departure_date)->format('d/m/Y'), Carbon::createFromFormat('d/m/Y', $data['departure_date'])->format('d/m/Y'));
            }
        } catch (\Exception $exception) {
        }
        // if(!$front && !empty($data['nights_count']) && $data['nights_count'] != $participants->nights_count) {
        //     $this->addAction('Modification', $id, 'Nombre de nuit', $participants->nights_count, $data['nights_count']);
        // }
        try{
            if(!$front && $participants->transfer_arrival_date && !empty($data['transfer_arrival_date']) && Carbon::parse($participants->transfer_arrival_date)->format('d/m/Y') != Carbon::createFromFormat('d/m/Y', $data['transfer_arrival_date'])->format('d/m/Y')) {
                $this->addAction('Modification', $id, "date d'arrivé de transfer", Carbon::parse($participants->transfer_arrival_date)->format('d/m/Y'), Carbon::createFromFormat('d/m/Y', $data['transfer_arrival_date'])->format('d/m/Y'));
            }
        } catch (\Exception $exception) {
        }
        if(!$front && $participants->transfer_arrival_time && !empty($data['transfer_arrival_time']) && Carbon::parse($data['transfer_arrival_time'])->format('h:i') != Carbon::parse($participants->transfer_arrival_time)->format('h:i')) {
            $this->addAction('Modification', $id, "heure d'arrivé de transfer", Carbon::parse($participants->transfer_arrival_time)->format('h:i'), Carbon::parse($data['transfer_arrival_time'])->format('h:i'));
        }
        if(!$front && $participants->arrival_airport && !empty($data['arrival_airport']) && $data['arrival_airport'] != $participants->arrival_airport) {
            $this->addAction('Modification', $id, "Aéroport de provenance", $participants->arrival_airport, $data['arrival_airport']);
        }
        if(!$front && $participants->arrival_airline_company && !empty($data['arrival_airline_company']) && $data['arrival_airline_company'] != $participants->arrival_airline_company) {
            $this->addAction('Modification', $id, "Vol entreprise Arrivé", $participants->arrival_airline_company, $data['arrival_airline_company']);
        }
        if(!$front && $participants->arrival_flight_number && !empty($data['arrival_flight_number']) && $data['arrival_flight_number'] != $participants->arrival_flight_number) {
            $this->addAction('Modification', $id, "Vol nombre arrivé", $participants->arrival_flight_number, $data['arrival_flight_number']);
        }
        if(!$front && $participants->arrival_recovery_point && !empty($data['arrival_recovery_point']) && $data['arrival_recovery_point'] != "none" && $data['arrival_recovery_point'] != $participants->arrival_recovery_point) {
            $this->addAction('Modification', $id, "point de récupération arrivé", $participants->arrival_recovery_point, $data['arrival_recovery_point']);
        }
        if(!$front && $participants->arrival_deposit_point && !empty($data['arrival_deposit_point']) && $data['arrival_deposit_point'] != $participants->arrival_deposit_point) {
            $this->addAction('Modification', $id, "point de dépôt arrivé", $participants->arrival_deposit_point, $data['arrival_deposit_point']);
        }
        try {
            if(!$front && $participants->transfer_departure_date && !empty($data['transfer_departure_date']) && Carbon::parse($participants->transfer_departure_date)->format('d/m/Y') != Carbon::createFromFormat('d/m/Y', $data['transfer_departure_date'])->format('d/m/Y')) {
                $this->addAction('Modification', $id, "date transfer aller", Carbon::parse($participants->transfer_departure_date)->format('d/m/Y'), Carbon::createFromFormat('d/m/Y', $data['transfer_departure_date'])->format('d/m/Y'));
            }
        } catch (\Exception $exception) {
        }
        if(!$front && $participants->transfer_departure_time && !empty($data['transfer_departure_time']) && Carbon::parse($data['transfer_departure_time'])->format('h:i') != Carbon::parse($participants->transfer_departure_time)->format('h:i')) {
            $this->addAction('Modification', $id, "heure transfer aller", Carbon::parse($participants->transfer_departure_time)->format('h:i'), Carbon::parse($data['transfer_departure_time'])->format('h:i'));
        }
        if(!$front && $participants->departure_airport && !empty($data['departure_airport']) && $data['departure_airport'] != $participants->departure_airport) {
            $this->addAction('Modification', $id, "Aéroport de destination", $participants->departure_airport, $data['departure_airport']);
        }
        if(!$front && $participants->departure_airline_company && !empty($data['departure_airline_company']) && $data['departure_airline_company'] != $participants->departure_airline_company) {
            $this->addAction('Modification', $id, "Vol entreprise aller", $participants->departure_airline_company, $data['departure_airline_company']);
        }
        if(!$front && $participants->departure_flight_number && !empty($data['departure_flight_number']) && $data['departure_flight_number'] != $participants->departure_flight_number) {
            $this->addAction('Modification', $id, "Vol nombre aller", $participants->departure_flight_number, $data['departure_flight_number']);
        }
        if(!$front && $participants->departure_recovery_point && !empty($data['departure_recovery_point']) && $data['departure_recovery_point'] != "none" && $data['departure_recovery_point'] != $participants->departure_recovery_point) {
            $this->addAction('Modification', $id, "point de récupération aller", $participants->departure_recovery_point, $data['departure_recovery_point']);
        }
        if(!$front && $participants->departure_deposit_point && !empty($data['departure_deposit_point']) && $data['departure_deposit_point'] != "none" && $data['departure_deposit_point'] != $participants->departure_deposit_point) {
            $this->addAction('Modification', $id, "point de dépôt aller", $participants->departure_deposit_point, $data['departure_deposit_point']);
        }
        if(!$front && !empty($data['air_ticket']) && $request->hasFile('air_ticket')) {
            $this->addAction('Modification', $id, "Changement de vol tickét");
        }
        try {
            if(!$front && $participants->desired_arrival_date && !empty($data['desired_arrival_date']) && Carbon::parse($participants->desired_arrival_date)->format('d/m/Y') != Carbon::createFromFormat('d/m/Y', $data['desired_arrival_date'])->format('d/m/Y')) {
                $this->addAction('Modification', $id, "Date d'arrivée souhaitée", Carbon::parse($participants->desired_arrival_date)->format('d/m/Y'), Carbon::createFromFormat('d/m/Y', $data['desired_arrival_date'])->format('d/m/Y'));
            }
        } catch (\Exception $exception) {
        }
        if(!$front && $participants->desired_arrival_hour && !empty($data['desired_arrival_hour']) && $data['desired_arrival_hour'] != "none" && $data['desired_arrival_hour'] != $participants->desired_arrival_hour) {
            $this->addAction('Modification', $id, "Heure d'arrivée souhaitée", $participants->desired_arrival_hour, $data['desired_arrival_hour']);
        }
        if(!$front && $participants->pec_arrival_airport && !empty($data['pec_arrival_airport']) && $data['pec_arrival_airport'] != $participants->pec_arrival_airport) {
            $this->addAction('Modification', $id, "Aéroport de provenance Souhaitée", $participants->pec_arrival_airport, $data['pec_arrival_airport']);
        }
        try {
            if(!$front && $participants->desired_departure_date && !empty($data['desired_departure_date']) && Carbon::parse($participants->desired_departure_date)->format('d/m/Y') != Carbon::createFromFormat('d/m/Y', $data['desired_departure_date'])->format('d/m/Y')) {
                $this->addAction('Modification', $id, "Date de départ souhaitée", Carbon::parse($participants->desired_departure_date)->format('d/m/Y'), Carbon::createFromFormat('d/m/Y', $data['desired_departure_date'])->format('d/m/Y'));
            }
        } catch (\Exception $exception) {
        }
        if(!$front && $participants->desired_departure_hour && !empty($data['desired_departure_hour']) && $data['desired_departure_hour'] != "none" && $data['desired_departure_hour'] != $participants->desired_departure_hour) {
            $this->addAction('Modification', $id, "Heure de départ souhaitée", $participants->desired_departure_hour, $data['desired_departure_hour']);
        }
        if(!$front && $participants->pec_departure_airport && !empty($data['pec_departure_airport']) && $data['pec_departure_airport'] != $participants->pec_departure_airport) {
            $this->addAction('Modification', $id, "Aéroport de destination souhaitée", $participants->pec_departure_airport, $data['pec_departure_airport']);
        }
        if (!empty($data['restoration']) && $data['restoration'] != "none") {
            $participants->restoration = $data['restoration'];
        }

        if (!empty($data['hotel_id']) && $data['hotel_id'] != "none") {
            $participants->hotel_id = $data['hotel_id'];
        }

        if (!empty($data['room_category_id']) && $data['room_category_id'] != "none") {
            $participants->room_category_id = $data['room_category_id'];
        }

        if (!empty($data['room_type']) && $data['room_type'] != "none") {
            $participants->room_type = $data['room_type'];
        }

        if (!empty($data['formation_name']) && $data['formation_name'] != "none") {
            if($front) {
                $participants->formation_name = $data['formation_name'];
                $participants->has_formation = 2;
                $participants->formation_state = 1;
            } else {
                $participants->formation_name = $data['formation_name'];
            }
        }

        if (!empty($data['formation_state']) && $data['formation_state'] != "none") {
            $participants->formation_state = $data['formation_state'];
        }
        try {
            if (!empty($data['arrival_date']) && Carbon::parse($participants->arrival_date)->format('d/m/Y') != Carbon::createFromFormat('d/m/Y', $data['arrival_date'])->format('d/m/Y')) {
                $participants->arrival_date = Carbon::createFromFormat('d/m/Y', $data['arrival_date']);
            }
        } catch (\Exception $exception) {
            if (!empty($data['arrival_date']))
                $participants->arrival_date = Carbon::createFromFormat('d/m/Y', $data['arrival_date']);
            else if(!empty($participants->arrival_date))
                $participants->arrival_date = Carbon::createFromFormat('d/m/Y', $participants->arrival_date);
        }
        try {
            if (!empty($data['departure_date']) && Carbon::parse($participants->departure_date)->format('d/m/Y') != Carbon::createFromFormat('d/m/Y', $data['departure_date'])->format('d/m/Y')) {
                $participants->departure_date = Carbon::createFromFormat('d/m/Y', $data['departure_date']);
            }
        } catch (\Exception $exception) {
            if (!empty($data['departure_date']))
                $participants->departure_date = Carbon::createFromFormat('d/m/Y', $data['departure_date']);
            else if(!empty($participants->departure_date))
                $participants->departure_date = Carbon::createFromFormat('d/m/Y', $participants->departure_date);
        }

        if (!empty($data['departure_date']) && !empty($data['arrival_date'])) {
            try {
                $departure_date = Carbon::createFromFormat('d/m/Y', $data['departure_date']);
                $arrival_date = Carbon::createFromFormat('d/m/Y', $data['arrival_date']);
                $participants->nights_count = $departure_date->diffInDays($arrival_date);
            } catch (\Exception $exception) {
                \Log::error('Error in count night : ' . $exception->getMessage());
            }
        }

        if (!empty($data['nights_count'])) {
            $participants->nights_count = $data['nights_count'];
        }
        try {
            if (!empty($data['transfer_arrival_date']) && Carbon::parse($participants->transfer_arrival_date)->format('d/m/Y') != Carbon::createFromFormat('d/m/Y', $data['transfer_arrival_date'])->format('d/m/Y')) {
                $participants->transfer_arrival_date = Carbon::createFromFormat('d/m/Y', $data['transfer_arrival_date']);
            }
        } catch (\Exception $exception) {
            if (!empty($data['transfer_arrival_date']))
                $participants->transfer_arrival_date = Carbon::createFromFormat('d/m/Y', $data['transfer_arrival_date']);
            else if(!empty($participants->transfer_arrival_date))
                $participants->transfer_arrival_date = Carbon::createFromFormat('d/m/Y', $participants->transfer_arrival_date);
        }

        if (!empty($data['transfer_arrival_time'])) {
            $participants->transfer_arrival_time = Carbon::parse($data['transfer_arrival_time']);
        }

        if (!empty($data['arrival_airport'])) {
            $participants->arrival_airport = $data['arrival_airport'];
        }

        if (!empty($data['arrival_airline_company'])) {
            $participants->arrival_airline_company = $data['arrival_airline_company'];
        }

        if (!empty($data['arrival_flight_number'])) {
            $participants->arrival_flight_number = $data['arrival_flight_number'];
        }

        if (!empty($data['arrival_recovery_point']) && $data['arrival_recovery_point'] != "none") {
            $participants->arrival_recovery_point = $data['arrival_recovery_point'];
        }

        if (!empty($data['arrival_deposit_point'])) {
            $participants->arrival_deposit_point = $data['arrival_deposit_point'];
        }
        try {
            if (!empty($data['transfer_departure_date']) && Carbon::parse($participants->transfer_departure_date)->format('d/m/Y') != Carbon::createFromFormat('d/m/Y', $data['transfer_departure_date'])->format('d/m/Y')) {
                $participants->transfer_departure_date = Carbon::createFromFormat('d/m/Y', $data['transfer_departure_date']);
            }
        } catch (\Exception $exception) {
            if (!empty($data['transfer_departure_date']))
                $participants->transfer_departure_date = Carbon::createFromFormat('d/m/Y', $data['transfer_departure_date']);
            else if(!empty($participants->transfer_departure_date))
                $participants->transfer_departure_date = Carbon::createFromFormat('d/m/Y', $participants->transfer_departure_date);
        }

        if (!empty($data['transfer_departure_time'])) {
            $participants->transfer_departure_time = $data['transfer_departure_time'];
        }

        if (!empty($data['departure_airport'])) {
            $participants->departure_airport = $data['departure_airport'];
        }

        if (!empty($data['departure_airline_company'])) {
            $participants->departure_airline_company = $data['departure_airline_company'];
        }

        if (!empty($data['departure_flight_number'])) {
            $participants->departure_flight_number = $data['departure_flight_number'];
        }

        if (!empty($data['departure_recovery_point']) && $data['departure_recovery_point'] != "none") {
            $participants->departure_recovery_point = $data['departure_recovery_point'];
        }


        if (!empty($data['departure_deposit_point']) && $data['departure_deposit_point'] != "none") {
            $participants->departure_deposit_point = $data['departure_deposit_point'];
        }

        if (!empty($data['air_ticket']) && $request->hasFile('air_ticket')) {
            $file = $request->file('air_ticket');
            $name = $file->getClientOriginalName() . '.' . $file->getClientOriginalExtension();
            $image['filePath'] = $name;
            $file->move(public_path() . '/uploads/', $name);
            $participants->air_ticket = '/uploads/' . $name;
        }
        try {
            if (!empty($data['desired_arrival_date']) && Carbon::parse($participants->desired_arrival_date)->format('d/m/Y') != Carbon::createFromFormat('d/m/Y', $data['desired_arrival_date'])->format('d/m/Y')) {
                $participants->desired_arrival_date = Carbon::createFromFormat('d/m/Y', $data['desired_arrival_date']);
            }
        } catch (\Exception $exception) {
            if (!empty($data['desired_arrival_date']))
                $participants->desired_arrival_date = Carbon::createFromFormat('d/m/Y', $data['desired_arrival_date']);
            else if(!empty($participants->desired_arrival_date))
                $participants->desired_arrival_date = Carbon::createFromFormat('d/m/Y', $participants->desired_arrival_date);
        }

        if (!empty($data['desired_arrival_hour']) && $data['desired_arrival_hour'] != "none") {
            $participants->desired_arrival_hour = $data['desired_arrival_hour'];
        }
        if (!empty($data['pec_arrival_airport'])) {
            $participants->pec_arrival_airport = $data['pec_arrival_airport'];
        }
        try {
            if (!empty($data['desired_departure_date']) && Carbon::parse($participants->desired_departure_date)->format('d/m/Y') != Carbon::createFromFormat('d/m/Y', $data['desired_departure_date'])->format('d/m/Y')) {
                $participants->desired_departure_date = Carbon::createFromFormat('d/m/Y', $data['desired_departure_date']);
            }
        } catch (\Exception $exception) {
            if (!empty($data['desired_departure_date']))
                $participants->desired_departure_date = Carbon::createFromFormat('d/m/Y', $data['desired_departure_date']);
            else if(!empty($participants->desired_departure_date))
                $participants->desired_departure_date = Carbon::createFromFormat('d/m/Y', $participants->desired_departure_date);
        }
        if (!empty($data['desired_departure_hour']) && $data['desired_departure_hour'] != "none") {
            $participants->desired_departure_hour = $data['desired_departure_hour'];
        }
        if (!empty($data['pec_departure_airport'])) {
            $participants->pec_departure_airport = $data['pec_departure_airport'];
        }

        if($participants->status == 1 || $participants->status == 7 || $participants->status == 6 || $participants->status == 13) {
            if($participants->has_pec != 2 && $participants->has_transfert == 2) {
                if(empty($participants->transfer_arrival_date) && empty($participants->transfer_departure_date))
                    $participants->status = 7;
                else 
                    $participants->status = 13;
            } else if($participants->has_pec == 2) {
                if(empty($participants->air_ticket))
                    $participants->status = 6;
                else 
                    $participants->status = 13;
            }      
        }
        $participants->save();
        if($front && $participants->type_id == 1 || $front && $participants->type_id == 7) {
            $participants->notify(new RegisterParticipant($participants, true));
        }
        if($front && $participants->type_id != 1 && $front && $participants->type_id != 7) {
            $participants->notify(new ValideParticipant($participants, true));
        }
        if(!$front) {
            return redirect('/participant/'.$id.'/prestations');
        } else {
            return $participants;
        }
    }

    public function store(Request $request, $delegation = null)
    {
        $countriesList = Country::orderBy('name_fr')->get();
        $participantTypes = ParticipantType::select(['name', 'group_id', 'id'])->get()->groupBy('group_id');
        return view('participants.add', ['countries'=> $countriesList, 'types'=> $participantTypes]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function registerfronttowstore(Request $request) {

        if(!empty($request->all()['formation_name'])) {
            $request->request->add(['has_formation' => 'on']);
            $request->request->add(['formation_state' => 1]);
        }
        if(!empty($request->all()['participant_id'])) {
            $this->storeData($request, $request->all()['participant_id'], '/stepthree/'.$request->all()['language'], true);
            $participant = Participants::where('id', $request->all()['participant_id'])->first();
            $participant->status = 3;
            $participant->save();
        } else {
            $participant = $this->storeData($request, null, '/stepthree/'.$request->all()['language']);
        }
        if(!empty($request->all()['presscarte']) && $request->hasFile('presscarte')) {
            $file = $request->file('presscarte');
            $name = $file->getClientOriginalName().'.'.$file->getClientOriginalExtension();
            $image['filePath'] = $name;
            $file->move(public_path().'/uploads/', $name);
            $participant->press_cart= '/uploads/'. $name;
            $participant->save();
        }
        if (!empty($participant)) {
            $this->addAction('Inscription depuis front', $participant->id);
            $this->storePrestation($request, $participant->id, true);
        } else {
            return redirect('/');
        }
        // if($participant->has_pec == 2 && $participant->has_transfert == 2 && empty($participant->transfer_arrival_date)) {
        //     // $participant->status = 7;
        //     $participant->save();
        // }
        return redirect('/success/'.$request->all()['language'].'/'.$participant->type_id);
    }

    public function storeData(Request $request, $id = null, $front = false)
    {
        Validator::extend('olderThan', function ($attribute, $value, $parameters) {

            if (empty($value)) {
                return true;
            }

            try {
                $date = Carbon::createFromFormat('d-m-Y', $value);
            } catch (\Exception $exception) {
                \Log::error(' birthday validate issue ' . $exception->getMessage() . ' _ ' . $value);
                return true;
            }

            return Carbon::now()->diff($date)->y >= 18;
        });

        $validationArray = [
            'civility' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'language' => 'required',
            'birthday' => 'olderThan'
        ];
        $messages = array(
            'older_than' => "l'âge doit être strictement supérieur à 18 ans"
        );
        if($id == null) {
            $validationArray['type'] = 'required';
        }
        // $validatedData = $request->validate($validationArray);
        $validator = Validator::make($request->all(), $validationArray, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data                = $request->all();
        if($id == null) {
            $data['webcode']     = $this->generateRandomString(10, false);
            $data['access_code'] = $this->generateRandomString(6);
            while (!empty(Participants::where('webcode', $data['webcode'])->get()->items)) {
                $data['webcode']     = $this->generateRandomString(10, false);
            }
            while (!empty(Participants::where('access_code', $data['access_code'])->get()->items)) {
                $data['access_code']     = $this->generateRandomString(6);
            }
            $participants = new Participants;
            $participants->status = 1;
            $participants->webcode = $data['webcode'];
            $participants->access_code = $data['access_code'];
            $participants->type_id = $data['type'];
            $participants->inscriptionDate = Carbon::now('Africa/Casablanca');
            if(!empty($request->all()['ref'])) {
                $participants->level = Participants::where('id', $request->all()['ref'])->value('level');
            } else if($data['type'] == 4 && empty($data['level'])) {
                $participants->level = 1;
            }
             else {
                $participants->level = (!empty($data['level'])) ? $data['level'] : null;
            }
        } else {
            $participants = Participants::find($id);
        }
        unset($data['_token']);
        if(!empty($request->all()['ref'])) {
            $participants->parent_id = $request->all()['ref'];
        }
        if(empty($front) && !empty($id)) {
            /* if(!empty($request->all()['ref'])) {
                $participants->parent_id = $request->all()['ref'];
            } */
            if(!empty($data['press_cart']) && $request->hasFile('press_cart')) {
                $this->addAction('Modification', $id, "Changement de vol tickét");
            }
            if($data['language'] != $participants->language && $id != null) {
                $this->addAction('Modification', $id, "language", $participants->language, $data['language']);
            }
            if($data['civility'] != $participants->civility && $id != null) {
                $oldval = ($participants->civility == 1) ? "Madame" : "Monsieur";
                $newval = ($data['civility'] == 1) ? "Madame" : "Monsieur";
                $this->addAction('Modification', $id, "Civilité", $oldval, $newval);
            }
            if($data['first_name'] != $participants->first_name && $id != null) {
                $this->addAction('Modification', $id, "Prénom", $participants->first_name, $data['first_name']);
            }
            if($data['last_name'] != $participants->last_name && $id != null) {
                $this->addAction('Modification', $id, "Nom", $participants->last_name, $data['last_name']);
            }
            if($participants->birthday && !empty($data['birthday']) && Carbon::createFromFormat('d/m/Y', $data['birthday'])->format('d/m/Y') != Carbon::parse($participants->birthday)->format('d/m/Y') && $id != null) {
                $this->addAction('Modification', $id, "Date de naissance", Carbon::parse($participants->birthday)->format('d/m/Y'), Carbon::createFromFormat('d/m/Y', $data['birthday'])->format('d/m/Y'));
            }
            if($data['organization'] != $participants->organization && $id != null) {
                $this->addAction('Modification', $id, "organization", $participants->organization, $data['organization']);
            }
            if($data['function'] != $participants->function && $id != null) {
                $this->addAction('Modification', $id, "fonction", $participants->function, $data['function']);
            }
            if($data['nationality'] != $participants->nationality && $id != null) {
                $this->addAction('Modification', $id, "nationalité", $participants->nationality, $data['nationality']);
            }
            if(!empty($data['identity_type']) && $data['identity_type'] != $participants->identity_type && $id != null) {
                $oldval = ($participants->identity_type == 1) ? "CIN" : "Passport";
                $newval = ($data['identity_type'] == 1) ? "CIN" : "Passport";
                $this->addAction('Modification', $id, "Type d'identité", $oldval, $newval);
            }
            if($data['num_identity'] != $participants->num_identity && $id != null) {
                $this->addAction('Modification', $id, "Numéro d'identité", $participants->num_identity, $data['num_identity']);
            }
            if($data['country'] != $participants->country && $id != null) {
                $this->addAction('Modification', $id, "Pays", $participants->country, $data['country']);
            }
            if($data['city'] != $participants->city && $id != null) {
                $this->addAction('Modification', $id, "Ville", $participants->city, $data['city']);
            }
            if($data['mobile_phone'] != $participants->mobile_phone && $id != null) {
                $this->addAction('Modification', $id, "Téléphone mobile", $participants->mobile_phone, $data['mobile_phone']);
            }
            if($data['pro_phone'] != $participants->pro_phone && $id != null) {
                $this->addAction('Modification', $id, "Téléphone professionnel", $participants->pro_phone, $data['pro_phone']);
            }
            if($data['email'] != $participants->email && $id != null) {
                $this->addAction('Modification', $id, "E-mail", $participants->email, $data['email']);
            }
            //$this->addAction("Création Participant", $participants->id);
        }

        if (!$front) {
            if (!empty($data['has_pec']) && $data['has_pec'] == 'on') {
                $data['has_pec'] = 2;
            } else {
                $data['has_pec'] = 1;
            }
            if($data['has_pec'] != $participants->has_pec && $id != null) {
                $this->addAction('Modification', $id, "PEC", ($participants->has_pec == 1) ? 'Non' : 'Oui', ($data['has_pec'] == 1) ? 'Non' : 'Oui');
            }
            $participants->has_pec = $data['has_pec'];

            if (!empty($data['has_transfert']) && $data['has_transfert'] == 'on') {
                $data['has_transfert'] = 2;
            } else {
                $data['has_transfert'] = 1;
            }
            if($data['has_transfert'] != $participants->has_transfert && $id != null) {
                $this->addAction('Modification', $id, "Transfert", ($participants->has_transfert == 1) ? 'Non' : 'Oui', ($data['has_transfert'] == 1) ? 'Non' : 'Oui');
            }
            $participants->has_transfert = $data['has_transfert'];

            if (!empty($data['has_formation']) && $data['has_formation'] == 'on' ) {
                $data['has_formation'] = 2;
            } else {
                $data['has_formation'] = 1;
            }
            if($data['has_formation'] != $participants->has_formation && $id != null) {
                $this->addAction('Modification', $id, "Formation", ($participants->has_formation == 1) ? 'Non' : 'Oui', ($data['has_formation'] == 1) ? 'Non' : 'Oui');
            }
            $participants->has_formation = $data['has_formation'];
            
            if (!empty($data['has_hebergement']) && $data['has_hebergement'] == 'on') {
                $data['has_hebergement'] = 2;
            } else {
                $data['has_hebergement'] = 1;
            }
            if($data['has_hebergement'] != $participants->has_hebergement && $id != null) {
                $this->addAction('Modification', $id, "Hebergement", ($participants->has_hebergement == 1) ? 'Non' : 'Oui', ($data['has_hebergement'] == 1) ? 'Non' : 'Oui');
            }
            $participants->has_hebergement = $data['has_hebergement'];
            
            if (!empty($data['has_restoration']) && $data['has_restoration'] == 'on') {
                $data['has_restoration'] = 2;
            } else {
                $data['has_restoration'] = 1;
            }
            if($data['has_restoration'] != $participants->has_restoration && $id != null) {
                $this->addAction('Modification', $id, "Restoration", ($participants->has_restoration == 1) ? 'Non' : 'Oui', ($data['has_restoration'] == 1) ? 'Non': 'Oui');
            }
            $participants->has_restoration = $data['has_restoration'];
        }



        if($front && !empty($data['press_cart']) && $request->hasFile('press_cart')) {
            $file = $request->file('press_cart');
            $name = $file->getClientOriginalName().'.'.$file->getClientOriginalExtension();
            $image['filePath'] = $name;
            $file->move(public_path().'/uploads/', $name);
            $participants->press_cart= '/uploads/'. $name;
        }

        if ((!empty($data['language']))) {
            $participants->language = $data['language'];
        }
        if (!empty($data['civility'])) {
            $participants->civility = $data['civility'];
        }
        if ((!empty($data['first_name']))) {
            $participants->first_name = $data['first_name'];
        }
        if (!empty($data['last_name'])) {
            $participants->last_name = $data['last_name'];
        }
        if (!empty($data['birthday'])) {
            $participants->birthday = Carbon::createFromFormat('d/m/Y', $data['birthday']);
        }
        if (!empty($data['organization'])) {
            $participants->organization = $data['organization'];
        }
        if (!empty($data['function'])) {
            $participants->function = $data['function'];
        }
        if (!empty($data['nationality'])) {
            $participants->nationality = $data['nationality'];
        }
        if (!empty($data['identity_type'])) {
            $participants->identity_type = $data['identity_type'];
        }
        if (!empty($data['num_identity'])) {
            $participants->num_identity = $data['num_identity'];
        }
        if (!empty($data['country'])) {
            $participants->country = $data['country'];
        }
        if ((!empty($data['city']))) {
            $participants->city = $data['city'];
        }
        if (!empty($data['email'])) {
            $participants->email = $data['email'];
        }
        if (!empty($data['pro_phone'])) {
            $participants->pro_phone = $data['pro_phone'];
        }
        if (!empty($data['mobile_phone'])) {
            $participants->mobile_phone = $data['mobile_phone'];
        }
        if (!empty($data['motivation'])) {
            $participants->motivation = $data['motivation'];
        }

        if($participants->status == 1 || $participants->status == 7 || $participants->status == 6 || $participants->status == 13) {
            if($participants->has_pec != 2 && $participants->has_transfert == 2) {
                if(empty($participants->transfer_arrival_date) && empty($participants->transfer_departure_date))
                    $participants->status = 7;
                else 
                    $participants->status = 13;
            } else if($participants->has_pec == 2) {
                if(empty($participants->air_ticket))
                    $participants->status = 6;
                else 
                    $participants->status = 13;
            }      
        }

        $type = ParticipantType::find($participants->type_id);
        if ($type && $id == null) {
            $participants->restoration = $type->restoration;
            $participants->has_restoration = is_null($type->restoration) ? 1 : 2;
            $participants->has_hebergement = is_null($type->hotel_id) ? 1 : 2;
            $participants->hotel_id = $type->hotel_id;
            $participants->room_type = $type->room_type;
            $participants->room_category_id = $type->room_category_id;
        }
        $participants->save();
        if(empty($front)) {
            if(empty($id)) {
                $this->addAction('Creation depuis le back', $participants->id);
            }
            if($id == null) {
                return redirect('/participants');
            } else {
                return redirect('/participant/'.$id);
            }
        }

        if (empty($front)) {
            try{
                if ($id == null) {
                    $participants->notify(new RegisterParticipant($participants));
                } else {
                    $participants->notify(new ValideParticipant($participants));
                }
            }catch (\Exception $exception){
                \Log::error($exception->getMessage());
                \Log::error(json_encode($exception->getTrace()));
            }

        }

        return $participants;
    }

    /**
     * Generate random string for | WebCode | Access Code
     */
    private function generateRandomString($length = 10, $numberto = true) {
        $characters       = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $numbers = '0123456789';
        if($numberto)
            $characters .= $numbers;
        $charactersLength = strlen($characters);
        $randomString     = '';

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        return $randomString;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Participants  $participants
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Participants $participants, $id)
    {
        $active_link = $request->is('participant/*') ? 'profil' : null;
        $countriesList = Country::orderBy('name_fr')->get();
        $participant = Participants::find($id);
        if(!$participant)
            abort(404);
            try {
                $participant->desired_departure_date = !empty($participant->desired_departure_date) ? \Carbon\Carbon::parse($participant->desired_departure_date)->format("d/m/Y") : '';
            } catch (\Exception $e) {
            }
            try {
                $participant->desired_arrival_date = !empty($participant->desired_arrival_date) ? \Carbon\Carbon::parse($participant->desired_arrival_date)->format("d/m/Y") : '';
            } catch (\Exception $e) {
            }
            try {
                $participant->transfer_departure_date = !empty($participant->transfer_departure_date) ? \Carbon\Carbon::parse($participant->transfer_departure_date)->format("d/m/Y") : '';
            } catch (\Exception $e) {
            }
            try {
                $participant->transfer_arrival_date = !empty($participant->transfer_arrival_date) ? \Carbon\Carbon::parse($participant->transfer_arrival_date)->format("d/m/Y") : '';
            } catch (\Exception $e) {
            }
            try {
                $participant->departure_date = !empty($participant->departure_date) ? \Carbon\Carbon::parse($participant->departure_date)->format("d/m/Y") : '';
            } catch (\Exception $e) {
            }
            try {
                $participant->arrival_date = !empty($participant->arrival_date) ? \Carbon\Carbon::parse($participant->arrival_date)->format("d/m/Y") : '';
            } catch (\Exception $e) {
            }
        $type = ParticipantType::find($participant->type_id);
        $participantTypes = ParticipantType::select(['name', 'group_id', 'id'])->get()->groupBy('group_id');
        $participantParentName = '';
        if ($participant->type_id == 5 || $participant->type_id == 6) {
            $participantParentName = Participants::where('id', $participant->parent_id)->value('first_name').' '.Participants::where('id', $participant->parent_id)->value('last_name');
        }
        return view('participants.profile', ['participantParentName' => $participantParentName, 'typename' => $type->name, 'active_link' => $active_link, 'participant' => $participant, 'types' => $participantTypes, 'countries' => $countriesList]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Participants  $participants
     * @return \Illuminate\Http\Response
     */
    public function prestation(Request $request, Participants $participants, $id)
    {
        $active_link = $request->is('participant/*/prestations') ? 'prestations' : null;
        $participant = Participants::find($id);
        try {
            $participant->desired_departure_date = !empty($participant->desired_departure_date) ? \Carbon\Carbon::parse($participant->desired_departure_date)->format("d/m/Y") : '';
        } catch (\Exception $e) {
        }
        try {
            $participant->desired_arrival_date = !empty($participant->desired_arrival_date) ? \Carbon\Carbon::parse($participant->desired_arrival_date)->format("d/m/Y") : '';
        } catch (\Exception $e) {
        }
        try {
            $participant->transfer_departure_date = !empty($participant->transfer_departure_date) ? \Carbon\Carbon::parse($participant->transfer_departure_date)->format("d/m/Y") : '';
        } catch (\Exception $e) {
        }
        try {
            $participant->transfer_arrival_date = !empty($participant->transfer_arrival_date) ? \Carbon\Carbon::parse($participant->transfer_arrival_date)->format("d/m/Y") : '';
        } catch (\Exception $e) {
        }
        try {
            $participant->departure_date = !empty($participant->departure_date) ? \Carbon\Carbon::parse($participant->departure_date)->format("d/m/Y") : '';
        } catch (\Exception $e) {
        }
        try {
            $participant->arrival_date = !empty($participant->arrival_date) ? \Carbon\Carbon::parse($participant->arrival_date)->format("d/m/Y") : '';
        } catch (\Exception $e) {
        }
        $type = ParticipantType::find($participant->type_id);
        $hotels = Hotel::all();
        $roomsCategories = RoomCategory::all();
        $restaurents = Restaurant::all();
        $participantParentName = '';
        if ($participant->type_id == 5 || $participant->type_id == 6) {
            $participantParentName = Participants::where('id', $participant->parent_id)->value('first_name').' '.Participants::where('id', $participant->parent_id)->value('last_name');
        }
        return view('participants.prestation', ['restaurents' => $restaurents, 'participantParentName' => $participantParentName, 'hotels' => $hotels, 'typename' => $type->name, 'participant' => $participant, 'active_link' => $active_link, 'roomsCategories' => $roomsCategories]);
    }

    public function getRoomCats($hotelid) {
        $roomCategory = RoomCategory::where('hotel_id', '=', $hotelid)->get()->pluck('name', 'id');
        return response()->json($roomCategory);
    }

    public function emailalreadyexists ($email, $id = null) {
        $participant = Participants::where('email', $email)->where('id', '!=', $id)->get();
        $participantcount = $participant->count();
        return response()->json($participantcount);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Participants  $participants
     * @return \Illuminate\Http\Response
     */
    public function delegation(Request $request, Participants $participants, $id)
    {
        $active_link = $request->is('participant/*/delegation') ? 'delegation' : null;
        $participant = Participants::find($id);
        $type = ParticipantType::find($participant->type_id);
        $delegates = Participants::where('parent_id', '=', $id)->get();
        $participantParentName = '';
        if ($participant->type_id == 5 || $participant->type_id == 6) {
            $participantParentName = Participants::where('id', $participant->parent_id)->value('first_name').' '.Participants::where('id', $participant->parent_id)->value('last_name');
        }
        return view('participants.delegation', ['participantParentName' => $participantParentName, 'delegates' => $delegates, 'typename' => $type->name, 'participant' => $participant, 'active_link' => $active_link]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Participants  $participants
     * @return \Illuminate\Http\Response
     */
    public function history(Request $request, Participants $participants, $id)
    {
        $active_link = $request->is('participant/*/historique') ? 'historique' : null;
        $participant = Participants::find($id);
        $type = ParticipantType::find($participant->type_id);
        $actions = Action::where('participant_id', '=', $id)->orderBy('created_at', 'desc')->get();
        $participantParentName = '';
        if ($participant->type_id == 5 || $participant->type_id == 6) {
            $participantParentName = Participants::where('id', $participant->parent_id)->value('first_name').' '.Participants::where('id', $participant->parent_id)->value('last_name');
        }
        return view('participants.history', ['participantParentName' => $participantParentName, 'actions' => $actions, 'typename' => $type->name, 'participant' => $participant, 'active_link' => $active_link]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Participants  $participants
     * @return \Illuminate\Http\Response
     */
    public function comments(Request $request, Participants $participants, $id)
    {
        $active_link = $request->is('participant/*/commentaire') ? 'commentaire' : null;
        $participant = Participants::find($id);
        $type = ParticipantType::find($participant->type_id);
        $comments = Comment::where('participant_id', '=', $id)->orderBy('created_at', 'desc')->get();
        $participantParentName = '';
        if ($participant->type_id == 5 || $participant->type_id == 6) {
            $participantParentName = Participants::where('id', $participant->parent_id)->value('first_name').' '.Participants::where('id', $participant->parent_id)->value('last_name');
        }
        return view('participants.comments', ['participantParentName' => $participantParentName, 'comments' => $comments, 'typename' => $type->name, 'participant' => $participant, 'active_link' => $active_link]);
    }

    public function storecomment(Request $request, $id) {
        $comment = new Comment;
        $comment->content = $request->all()['comment'];
        $comment->participant_id = $id;
        $comment->user_id = auth()->user()->id;
        $comment->save();
        return redirect('/participant/'.$id.'/commentaire');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Participants  $participants
     * @return \Illuminate\Http\Response
     */
    public function hebergementShow(Request $request)
    {
        $participants = new Participants;
        if(!empty($request->all()['query'])) {
            $participants = $participants->where(function ($query) use($request) {
                $query->where('last_name', 'like', '%'.$request->all()['query'].'%')
                    ->orWhere('first_name', 'like', '%'.$request->all()['query'].'%')
                    ->orWhere('organization', 'like', '%'.$request->all()['query'].'%');
            });
        }
        if(!empty($request->all()['room-type'])) {
            if($request->all()['room-type'] != 'Tous') {
                $participants = $participants->where('room_type', '=', $request->all()['room-type']);
            }
        }
        if(!empty($request->all()['hotel'])) {
            if($request->all()['hotel'] != 'Tous') {
                $participants = $participants->where('hotel_id', '=', $request->all()['hotel']);
            }
        }
        if(!empty($request->all()['date'])) {
            if($request->all()['date'] == 'arrival') {
                $participants = $participants->orderBy(DB::raw("STR_TO_DATE(arrival_date,'%d/%m/%Y')"), 'ASC');
            }elseif($request->all()['date'] == 'departure') {
                $participants = $participants->orderBy(DB::raw("STR_TO_DATE(departure_date,'%d/%m/%Y')"), 'ASC');
            }
        }
        $participantsList = $participants->where('has_hebergement', 2)->with([
            'hotel',
            'roomCategory' 
        ])->paginate(50);

        $hotels = Hotel::select(['name', 'id'])->get();

        return view('participants.hebergement' , ['participants' => $participantsList, 'hotels' => $hotels]);
    }
     /**
     * Display the specified resource.
     *
     * @param  \App\Models\Participants  $participants
     * @return \Illuminate\Http\Response
     */
    public function transfertsDepart(Request $request)
    {
        $participants = new Participants;
        if(!empty($request->all()['query'])) {
            $participants = $participants->where(function ($query) use($request) {
                $query->where('last_name', 'like', '%'.$request->all()['query'].'%')
                    ->orWhere('first_name', 'like', '%'.$request->all()['query'].'%')
                    ->orWhere('organization', 'like', '%'.$request->all()['query'].'%');
            });
        }
        if(!empty($request->all()['airport'])) {
            if($request->all()['airport'] != 'Tous') {
                $participants = $participants->where('departure_deposit_point', '=', $request->all()['airport']);
            }
        }
        if(!empty($request->all()['hotel'])) {
            if($request->all()['hotel'] != 'Tous') {
                $participants = $participants->where('hotel_id', '=', $request->all()['hotel']);
            }
        }
        $participantsList = $participants->where('has_transfert', 2)
        ->orderBy(DB::raw("STR_TO_DATE(transfer_departure_date,'%d/%m/%Y')"), 'ASC')
        ->with([
            'hotel',
            'hotel.room_categories' 
        ])->paginate(50);
        $hotels = Hotel::select(['name', 'id'])->get();
        return view('participants.transferts-depart', ['participants' => $participantsList, 'hotels' => $hotels]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Participants  $participants
     * @return \Illuminate\Http\Response
     */
    public function transfertsArrivees(Request $request)
    {
        $participants = new Participants;
        if(!empty($request->all()['query'])) {
            $participants = $participants->where(function ($query) use($request) {
                $query->where('last_name', 'like', '%'.$request->all()['query'].'%')
                    ->orWhere('first_name', 'like', '%'.$request->all()['query'].'%')
                    ->orWhere('organization', 'like', '%'.$request->all()['query'].'%');
            });
        }
        if(!empty($request->all()['airport'])) {
            if($request->all()['airport'] != 'Tous') {
                $participants = $participants->where('arrival_recovery_point', '=', $request->all()['airport']);
            }
        }
        if(!empty($request->all()['hotel'])) {
            if($request->all()['hotel'] != 'Tous') {
                $participants = $participants->where('hotel_id', '=', $request->all()['hotel']);
            }
        }
        $participantsList =  $participants->where('has_transfert', 2)
        ->orderBy(DB::raw("STR_TO_DATE(transfer_arrival_date,'%d/%m/%Y')"), 'ASC')
        ->with([
            'hotel',
            'hotel.room_categories' 
        ])->paginate(50);
        
        $hotels = Hotel::select(['name', 'id'])->get();
        return view('participants.transferts-arrivees', ['participants' => $participantsList, 'hotels' => $hotels]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Participants  $participants
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $countriesList = Country::all();
        $participant = Participants::find($id);
        $participantTypes = ParticipantType::select(['name', 'group_id', 'id'])->get()->groupBy('group_id');
        dd($participant);
        return view('participants.edit', ['participant' => $participant, 'types' => $participantTypes, 'countries' => $countriesList]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Participants  $participants
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Participants $participants)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Participants  $participants
     * @return \Illuminate\Http\Response
     */
    public function destroy(Participants $participants)
    {
        //
    }
    public function commentsList() {
        $comments = Comment::all();

        return view('comments.index', ['comments' => $comments]);
        
    }
}
