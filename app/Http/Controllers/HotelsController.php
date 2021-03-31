<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\RoomCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class HotelsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hotels = Hotel::paginate(10);

        return View('hotels.index', compact('hotels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('hotels.create');
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
        $validator = Validator::make($request->all(), [
            'name'            => 'required',
            'room_categories' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $hotel = Hotel::create([
            'name' => $request->input('name'),
        ]);

        $room_categories = explode(',', $request->get('room_categories'));

        foreach ($room_categories as $rc) {
            RoomCategory::create([
                'name'     => trim($rc),
                'hotel_id' => $hotel->id,
            ]);
        }

        return redirect('hotels')->with('success', 'hotel créé !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy($id)
    {
        $hotel = Hotel::findOrFail($id);
        $hotel->delete();

        return redirect('hotels')->with('success', 'Hotel supprimé ! ');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name'            => 'required',
            'room_categories' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $hotel = Hotel::findOrFail($id);

        $hotel->update([
            'name' => $request->get('name'),
        ]);

        $room_categories = explode(',', $request->get('room_categories'));

        $room_categories_ids_old = $hotel->room_categories->pluck('id')->toArray();
        $room_categories_new = [];

        foreach ($room_categories as $rc) {
            $room_categories_new[] = RoomCategory::firstOrCreate([
                'name'     => trim($rc),
                'hotel_id' => $hotel->id,
            ]);
        }
        $room_categories_ids_new = collect($room_categories_new)->pluck('id')->toArray();

        foreach ($room_categories_ids_old as $el) {
            if (!in_array($el, $room_categories_ids_new)) {
                RoomCategory::find($el)->delete();
            }
        }

        return redirect('hotels')->with('success', 'hotel Mis à jour avec succés !');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $hotel = Hotel::findOrFail($id);

        return view('hotels.edit', compact('hotel'));
    }

}
