<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {

            $brands = Brand::where("name", "like", $request->term . "%")->get()->map(function (Brand $brand) {
                return ["id" => $brand->id, "text" => $brand->name];
            });

            return response()->json(["results" => $brands], 200);
        }

        if ($request->has("filter_brand")) {
            $query = Brand::where("name", "like", $request->filter_brand . "%");
        } else {
            $query = Brand::query();
        }

        $brands = $query->paginate(15);

        return view("brands.index")->with(["brands" => $brands]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("brands.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $validated = $request->validate([
        'name' => [
            'required',
            'string',
            'max:255',
            Rule::unique('brands')
        ]
    ]);

    $brand = Brand::create($validated);
    
    return redirect()->route("brands.show", $brand);
}

    /**
     * Display the specified resource.
     */
    public function show(Brand $brand)
    {
        return view("brands.show")->with(["brand" => $brand]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brand $brand)
    {
        return view("brands.edit")->with(["brand" => $brand]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Brand $brand)
{
    // Validación para actualización
    $validated = $request->validate([
        'name' => [
            'required',
            'string',
            'max:255',
            Rule::unique('brands')
                ->ignore($brand->id) // Ignora el registro actual
                
        ]
    ]);

    $brand->update($validated);
    
    return redirect()->route("brands.show", $brand);
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        $brand->delete();
        return redirect()->route("brands.index")->with(["result" => "OK"]);
    }
}
