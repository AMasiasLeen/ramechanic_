<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {

            $roles = Role::where("name", "like", $request->term . "%")->get()->map(function (role $role) {
                return ["id" => $role->id, "text" => $role->name];
            });

            return response()->json(["results" => $roles], 200);
        }

        $roles = Role::all();

        return view("roles.index")->with(["roles" => $roles]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("roles.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $role = new Role();
        $role->fill($request->all());
        $role->save();

        return redirect()->route("roles.show", ["role" => $role]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        return view("roles.show")->with(["role" => $role]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        return view("roles.edit")->with(["role" => $role]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $role->fill($request->all());
        $role->save();

        return redirect()->route("roles.show", ["role" => $role]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route("roles.index")->with(["result" => "OK"]);
    }
}