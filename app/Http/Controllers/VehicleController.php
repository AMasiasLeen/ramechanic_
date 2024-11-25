<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

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
        $vehicle = new Vehicle();
        $vehicle->fill($request->except(['main_image'])); // Evita las imágenes para manejarlas por separado

        // Subida de la imagen de portada
        if ($request->hasFile('main_image')) {
            $mainImagePath = $request->file('main_image')->store('public/vehicles');
            $vehicle->main_image = basename($mainImagePath);
        }


        $vehicle->save();

        return redirect()->route("vehicles.show", ["vehicle" => $vehicle]);
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vehicle $vehicle)
    {
        $vehicle->delete();
        return redirect()->route("vehicles.index")->with(["result" => "OK"]);
    }
}
