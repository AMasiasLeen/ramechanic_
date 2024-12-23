<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Record;
use App\Models\Vehicle;
use App\Models\VehicleModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {}

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $totalVehicles = Vehicle::count();
        $totalModels = VehicleModel::count();
        $totalBrands = Brand::count();

        $brandNames = Brand::pluck('name');
        $vehiclesPerBrand = Brand::withCount(['vehicles'])->pluck('vehicles_count');

        $modelNames = VehicleModel::pluck('name');
        $vehiclesPerModel = Vehicle::selectRaw('vehicle_model_id, count(*) as total')->groupBy('vehicle_model_id')->pluck('total');

        return view('home', compact('totalVehicles', 'totalModels', 'totalBrands', 'brandNames', 'vehiclesPerBrand', 'modelNames', 'vehiclesPerModel'));
    }

    public function show_instructions()
    {
        // Extrae los vehículos y registros del usuario autenticado
        $vehicles = Vehicle::whereHas('owner', function ($query) {
            $query->where('id', Auth::id());
        })->paginate(10, ['*'], 'vehiclesPage');

        $records = Record::whereHas('vehicle.owner', function ($query) {
            $query->where('id', Auth::id());
        })->paginate(10, ['*'], 'recordsPage');

        // Retorna la vista con las variables vehicles y records
        return view('instructions')->with([
            'vehicles' => $vehicles,
            'records' => $records
        ]);
    }

    public function landing_page(Request $request)
    {
        $records = Record::query();

        if ($request->has("reset")) {
            $records = $records->paginate(15);
            return redirect()->route("landing_page");
        }

        if ($request->has("start_date") && $request->start_date != "" &&  $request->has("end_date") && $request->end_date != "") {
            $records->whereBetween("date_in", [$request->start_date, $request->end_date]);
        }

        $records = $records->paginate(15)->appends($request->query());

        return view('landing_page')->with(["records" => $records]);
    }

    public function vehicles(Request $request)
    {

        if ($request->ajax()) {
            $query = Vehicle::whereHas('records')->where("owner_id", $request->owner_id);

            $vehicles = $query->where("plate", "like", $request->term . "%")->get()->map(function (Vehicle $vehicles) {
                return ["id" => $vehicles->id, "text" => "Placa: " . $vehicles->plate];
            });

            return response()->json(["results" => $vehicles], 200);
        }
    }
}
