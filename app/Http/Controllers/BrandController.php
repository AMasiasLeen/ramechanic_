<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brand::all();

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
        $brand = new Brand();
        $brand->fill($request->all());

        $brand->save();

        return redirect()->route("brands.show", ["brand" => $brand]);
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
        $brand->fill($request->all());
        $brand->save();

        return redirect()->route("brands.show", ["brand" => $brand]);
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
