<?php

namespace App\Http\Controllers;

use App\Models\VehicleModel;
use Illuminate\Http\Request;

class VehicleModelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {


            if ($request->has('brand_id') && $request->brand_id != null) {
                $query = VehicleModel::where("brand_id", $request->brand_id);
            } else {
                $query = VehicleModel::query();
            }

            $vehicle_models = $query->where("name", "like", $request->term . "%")->get()->map(function (VehicleModel $vehicle_model) {
                return ["id" => $vehicle_model->id, "text" => $vehicle_model->name];
            });

            return response()->json(["results" => $vehicle_models], 200);
        }
        $vehicle_models = VehicleModel::all();

        return view("vehicle_models.index")->with(["vehicle_models" => $vehicle_models]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("vehicle_models.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $vehicle_model = new VehicleModel();
        $vehicle_model->fill($request->all());
        $vehicle_model->save();

        return redirect()->route("vehicle-models.show", ["vehicle_model" => $vehicle_model]);
    }

    /**
     * Display the specified resource.
     */
    public function show(VehicleModel $vehicle_model)
    {
        return view("vehicle_models.show")->with(["vehicle_model" => $vehicle_model]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(VehicleModel $vehicle_model)
    {
        return view("vehicle_models.edit")->with(["vehicle_model" => $vehicle_model]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, VehicleModel $vehicle_model)
    {
        $vehicle_model->fill($request->all());
        $vehicle_model->save();

        return redirect()->route("vehicle-models.show", ["vehicle_model" => $vehicle_model]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VehicleModel $vehicle_model)
    {
        $vehicle_model->delete();
        return redirect()->route("vehicle-models.index")->with(["result" => "OK"]);
    }
}
