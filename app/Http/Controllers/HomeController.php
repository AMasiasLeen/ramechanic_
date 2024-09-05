<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Vehicle;
use App\Models\VehicleModel;
use Illuminate\Http\Request;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $totalVehicles = VehicleModel::count();
        $totalModels = VehicleModel::count();
        $totalBrands = Brand::count();

        $brandNames = Brand::pluck('name');
        $vehiclesPerBrand = Vehicle::selectRaw('brand_id, count(*) as total')->groupBy('brand_id')->pluck('total');

        $modelNames = VehicleModel::pluck('name');
        $vehiclesPerModel = Vehicle::selectRaw('vehicle_model_id, count(*) as total')->groupBy('vehicle_model_id')->pluck('total');

        return view('home', compact('totalVehicles', 'totalModels', 'totalBrands', 'brandNames', 'vehiclesPerBrand', 'modelNames', 'vehiclesPerModel'));
    }

}
