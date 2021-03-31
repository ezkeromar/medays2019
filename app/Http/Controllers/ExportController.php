<?php

namespace App\Http\Controllers;

use App\Exports\ParticipantsExport;
use App\Http\Requests\ExportRequest;
use App\Exports\HebergementExport;
use App\Models\ParticipantType;
use App\Models\Hotel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{

    public function index()
    {
        $types = ParticipantType::select(['name', 'group_id', 'id'])->get()->groupBy('group_id');
        $hotels = Hotel::all();
        return view('export.index', compact('types', 'hotels'));
    }

    public function store(ExportRequest $request)
    {
        $name = 'Participants_' . $request->get('type') . '_' . Carbon::now()->toDateString() . '.xlsx';

        return Excel::download(new ParticipantsExport($request->all()), $name);
    }
    public function exportByHotel(ExportRequest $request)
    {
        $hotel = Hotel::where('id',$request->get('hotel'))->first();
        $hotelName = $hotel ? $hotel->name : $request->get('hotel');
        $name = 'Participants_Hotel_' . $hotelName  . '_' . Carbon::now()->toDateString() . '.xlsx';

        return Excel::download(new HebergementExport($request->get('hotel')), $name);
    }

}
