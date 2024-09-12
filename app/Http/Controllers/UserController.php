<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {

            $users = User::where("name", "like", $request->term . "%")->get()->map(function (User $user) {
                return ["id" => $user->id, "text" => "Identificación: " . $user->identification];
            });

            return response()->json(["results" => $users], 200);
        }

        $query = User::query();

    
    if ($request->has("filter_name")) {
        $query->where("name", "like", $request->filter_name . "%");
    }

    if ($request->has("filter_identification")) {
        $query->where("identification", "like", $request->filter_identification . "%");
    }

    if ($request->has("filter_phone")) {
        $query->where("phone", "like", $request->filter_phone . "%");
    }

    if ($request->has("filter_email")) {
        $query->where("email", "like", $request->filter_email . "%");
    }

    if ($request->has("filter_address")) {
        $query->where("address", "like", $request->filter_address . "%");
    }

    
    $users = $query->get();

        return view("users.index")->with(["users" => $users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("users.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = new User();
        $user->fill($request->all());

        // Verificar si el campo de imagen está vacío y asignar una imagen predeterminada
        $user->profile_picture = 'images/userImg.png';

        if ($request->password != null) {
            $user->password = Hash::make($request->password);
        }

        $user->save();
        $user->syncRoles($request->rol);

        return redirect()->route("users.show", ["user" => $user]);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user, Request $request)
    {
        if ($request->ajax()) {
            return response()->json($user, 200);
        }

        return view("users.show")->with(["user" => $user]);
    }

    public function show_profile(User $user)
    {
        return view("users.profile")->with(["user" => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view("users.edit")->with(["user" => $user]);
    }

    public function edit_profile(User $user)
    {
        return view("users.edit_profile")->with(["user" => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $user->fill($request->all());
        if ($request->password != null) {
            $user->password = Hash::make($request->password);
        }

        

        $user->save();
        if ($request->has("rol")){
            $user->syncRoles($request->rol);
        }

        return redirect()->route("users.show", ["user" => $user]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route("users.index")->with(["result" => "OK"]);
    }
}
