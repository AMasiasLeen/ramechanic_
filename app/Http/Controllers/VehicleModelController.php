<?php

namespace App\Http\Controllers;

use App\Models\VehicleModel;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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
                return ["id" => $vehicle_model->id, "text" => $vehicle_model->name . " - " . $vehicle_model->brand->name];
            });

            return response()->json(["results" => $vehicle_models], 200);
        }

        if ($request->has("filter_vehicle_model")) {
            $query = VehicleModel::where("name", "like", $request->filter_vehicle_model . "%");
        } else {
            $query = VehicleModel::query();
        }

        if ($request->has("filter_brand")) {
            $query = $query->whereHas("brand",function($q) use ($request){
                $q->where("name", "like",  $request->filter_brand . "%");
            });
        } 

        $vehicle_models = $query->paginate(15);

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
    $validated = $request->validate([
        'brand_id' => 'required|exists:brands,id',
        'name' => [
            'required',
            'string',
            'max:255',
            Rule::unique('vehicle_models')->where(function ($query) use ($request) {
                return $query->where('brand_id', $request->brand_id);
            })
        ]
    ]);

    $vehicleModel = VehicleModel::create($validated);
    
    return redirect()->route("vehicle-models.show", $vehicleModel);
}

    /**
     * Display the specified resource.
     */
    public function show(VehicleModel $vehicle_model, Request $request)
    {
        if ($request->ajax()) {
            return response()->json([$vehicle_model], 200);
        }
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
    $validated = $request->validate([
        'brand_id' => 'required|exists:brands,id',
        'name' => [
            'required',
            'string',
            'max:255',
            Rule::unique('vehicle_models')
                ->ignore($vehicle_model->id)
                ->where(function ($query) use ($request) {
                    return $query->where('brand_id', $request->brand_id);
                })
        ]
    ]);

    $vehicle_model->update($validated);
    
    return redirect()->route("vehicle-models.show", $vehicle_model);
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
