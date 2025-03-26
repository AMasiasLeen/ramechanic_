<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {
            if ($request->has('model_id')) {
                $query = Vehicle::where('model_id', '=', $request->model_id);
            } else {
                $query = Vehicle::query();
            }

            if ($request->has('owner_id')) {
                $query = $query->where("owner_id", $request->owner_id);
            }

            $vehicles = $query->where("plate", "like", $request->term . "%")->get()->map(function (Vehicle $vehicles) {
                return ["id" => $vehicles->id, "text" => "Placa: " . $vehicles->plate];
            });

            return response()->json(["results" => $vehicles], 200);
        }

        $query = Vehicle::query();


        if ($request->has("filter_plate")) {
            $query->where("plate", "like", $request->filter_plate . "%");
        }


        if ($request->has("filter_color")) {
            $query->where("color", "like", $request->filter_color . "%");
        }


        if ($request->has("filter_owner")) {
            $query->whereHas("owner", function ($q) use ($request) {
                $q->where("name", "like", $request->filter_owner . "%");
            });
        }


        if ($request->has("filter_model")) {
            $query->whereHas("vehicle_model", function ($q) use ($request) {
                $q->where("name", "like", $request->filter_model . "%");
            });
        }


        if ($request->has("filter_brand")) {
            $query->whereHas("vehicle_model.brand", function ($q) use ($request) {
                $q->where("name", "like", $request->filter_brand . "%");
            });
        }


        $vehicles = $query->paginate(15);

        return view("vehicles.index")->with(["vehicles" => $vehicles]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("vehicles.create");
    }

    /**
     * Store a newly created resource in storage.
     */

     public function store(Request $request)
     {
         $validated = $request->validate([
             'plate' => [
                 'required',
                 'string',
                 'max:15',
                 Rule::unique('vehicles')
             ],
             'year' => 'required|integer|between:1900,'.date('Y')+1,
             'owner_id' => 'required|exists:users,id',
             'vehicle_model_id' => 'required|exists:vehicle_models,id',
             'engine_serial' => 'nullable|string|max:50',
             'serial_number' => 'nullable|string|max:50',
             'color' => 'nullable|string|max:30',
             'main_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
         ], [
             'plate.unique' => 'La placa ingresada ya existe en el sistema',
             'year.between' => 'El año debe estar entre 1900 y el año actual',
             'main_image.max' => 'La imagen no debe superar los 2MB',
             'main_image.mimes' => 'Formatos permitidos: JPEG, PNG, JPG'
         ]);
     
         $vehicle = Vehicle::create($validated);
     
         if ($request->hasFile('main_image')) {
             $path = $request->file('main_image')->store('public/vehicles');
             $vehicle->update(['main_image' => basename($path)]);
         }
     
         return redirect()->route("vehicles.show", $vehicle)
                         ->with('success', 'Vehículo registrado correctamente');
     }

    /**
     * Display the specified resource.
     */
    public function show(Vehicle $vehicle, Request $request)
    {
        if ($request->ajax()) {
            return response()->json($vehicle, 200);
        }

        return view("vehicles.show")->with(["vehicle" => $vehicle]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vehicle $vehicle)
    {
        return view("vehicles.edit")->with(["vehicle" => $vehicle]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vehicle $vehicle)
    {
        $vehicle->fill($request->all());


        // Subida de la imagen de portada
        if ($request->hasFile('main_image')) {
            $mainImagePath = $request->file('main_image')->store('public/vehicles');
            $vehicle->main_image = basename($mainImagePath);
        }
        $vehicle->save();

        return redirect()->route("vehicles.show", ["vehicle" => $vehicle]);
    }

    public function deleteImage(Vehicle $vehicle)
{
    if ($vehicle->main_image) {
        Storage::delete('public/vehicles/'.$vehicle->main_image);
        $vehicle->update(['main_image' => null]);
    }

    return response()->json(['success' => true]);
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vehicle $vehicle)
    {
        $vehicle->delete();
        return redirect()->route("vehicles.index")->with(["result" => "OK"]);
    }


    public function user_vehicles(Vehicle $vehicle)
    {

        return view("vehicles.user_vehicles");
    }
}
