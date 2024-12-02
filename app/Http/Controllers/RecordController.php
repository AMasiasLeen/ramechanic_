<?php

namespace App\Http\Controllers;

use App\Models\Record;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

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

        $query = Record::query();


        if (
            $request->has("filter_date")
            && $request->filter_date != null
        ) {
            $query->whereDate("date_in", $request->filter_date);
        }

        if ($request->has("filter_description")) {
            $query->where("short_description", "like", $request->filter_description . "%");
        }

        if ($request->has("filter_owner")) {
            $query->whereHas("vehicle.owner", function ($q) use ($request) {
                $q->where("name", "like", "%" . $request->filter_owner . "%");
            });
        }

        if ($request->has("filter_vehicle")) {
            $query->whereHas("vehicle", function ($q) use ($request) {
                $q->where("plate", "like", "%" . $request->filter_vehicle . "%");
            });
        }

        $records = $query->paginate(15);
        // dd($request->filter_vehicle);


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
        $record->fill($request->except(['main_image', 'images'])); // Evita las imágenes para manejarlas por separado

        // Subida de la imagen de portada
        if ($request->hasFile('main_image')) {
            $mainImagePath = $request->file('main_image')->store('public/records');
            $record->main_image = basename($mainImagePath);
        }

        // Subida de imágenes adicionales
        if ($request->hasFile('images')) {
            $imagePaths = [];
            foreach ($request->file('images') as $image) {
                $imagePath = $image->store('public/records');
                $imagePaths[] = basename($imagePath);
            }
            $record->images = json_encode($imagePaths); // Guarda las rutas de las imágenes como un JSON
        }

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

    public function show_user_record()
    {
        $record = Record::whereHas(
            "vehicle.owner",
            function ($query) {
                $query->where("id", Auth::id());
            }
        )->get();

        return view("records.user_records")->with(["records" => $record]);
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

        $record->fill($request->except(['images'])); // Evita las imágenes para manejarlas por separado
    
        // Subida de la imagen de portada
        if ($request->hasFile('main_image')) {
            $mainImagePath = $request->file('main_image')->store('public/records');
            $record->main_image = basename($mainImagePath);
        }
    
        // Subida de imágenes adicionales
        if ($request->hasFile('images')) {
            $imagePaths = [];
            foreach ($request->file('images') as $image) {
                $imagePath = $image->store('public/records');
                $imagePaths[] = basename($imagePath);
            }
            $record->images = json_encode($imagePaths); // Guarda las rutas de las imágenes como un JSON
        }
    
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
