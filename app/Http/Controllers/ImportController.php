<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImportRequest;
use App\Imports\ParticipantsImport;
use App\Jobs\NotifyUserOfCompletedImport;
use App\Models\ParticipantType;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
    public function index()
    {
        $types = ParticipantType::select(['name', 'group_id', 'id'])->get()->groupBy('group_id');

        return view('import.index', compact('types'));
    }

    public function store(ImportRequest $request)
    {
        Excel::queueImport(new ParticipantsImport($request->get('type'), $request->user()),
            $request->file('file'))->chain([
            new NotifyUserOfCompletedImport($request->user()),
        ]);;

        return redirect('export')->with('success', 'Importing file in progress');
    }
}
