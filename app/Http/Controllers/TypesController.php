<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\ParticipantType;
use App\Models\Restaurant;
use App\Models\RoomCategory;
use App\Types;
use Illuminate\Http\Request;

class TypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = ParticipantType::all();
        $hotels = Hotel::with(['room_categories'])->get();
        $room_categories = RoomCategory::all();
        $restorations = Restaurant::all();

        return view('types.index', compact('types', 'hotels', 'room_categories','restorations'));
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

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Types $types
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Types $types)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Types $types
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Types $types)
    {
        //
    }


    public function update(Request $request)
    {
        $type = ParticipantType::find($request->get('id'));

        $data = $request->except(['id','_token']);

        $type = $type->update($data);

        return response()->json($type);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Types $types
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Types $types)
    {
        //
    }
}
