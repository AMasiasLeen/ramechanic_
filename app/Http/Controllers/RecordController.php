<?php

namespace App\Http\Controllers;

use App\Models\Record;
use Illuminate\Http\Request;

class RecordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {

            $records = Record::where("name", "like", $request->term . "%")->get()->map(function (Record $record) {
                return ["id" => $record->id, "text" => $record->name];
            });

            return response()->json(["results" => $records], 200);
        }

        $records = Record::all();

        return view("records.index")->with(["records" => $records]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("records.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $record = new Record();
        $record->fill($request->all());
        $record->save();

        return redirect()->route("records.show", ["record" => $record]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Record $record)
    {
        return view("records.show")->with(["record" => $record]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Record $record)
    {
        return view("records.edit")->with(["record" => $record]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Record $record)
    {
        $record->fill($request->all());
        $record->save();

        return redirect()->route("records.show", ["record" => $record]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Record $record)
    {
        $record->delete();
        return redirect()->route("records.index")->with(["result" => "OK"]);
    }
}