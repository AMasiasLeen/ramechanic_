<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Mime\Header\IdentificationHeader;

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

    
    $users = $query->paginate(15);

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
    $request->validate([
        'identification' => 'required|numeric|digits:10|unique:users,identification',
        'name' => 'required|string|regex:/^[a-zA-Z\s]+$/|max:50',
        'email' => 'required|email|max:255|unique:users,email',
        'phone' => 'nullable|numeric|digits_between:7,15',
        'address' => 'nullable|string|max:255',
        'password' => 'required|string|min:8',
        'rol' => 'required|array',
    ],
    [
        'identification.required' => 'La identificación es obligatoria.',
        'identification.numeric' => 'La identificación debe ser un número.',
        'identification.digits' => 'La identificación debe tener exactamente 10 dígitos.',
        'identification.unique' => 'El identificador ya existe.',
        'name.required' => 'El nombre es obligatorio.',
        'name.regex' => 'El nombre solo debe contener letras y espacios.',
        'name.max' => 'El nombre no debe exceder los 50 caracteres.',
        'email.required' => 'El correo electrónico es obligatorio.',
        'email.email' => 'El correo debe ser un formato válido.',
        'email.unique' => 'El correo electrónico ya está registrado.',
        'phone.numeric' => 'El teléfono debe ser un número.',
        'phone.digits_between' => 'El teléfono debe tener entre 7 y 15 dígitos.',
        'address.max' => 'La dirección no debe exceder los 255 caracteres.',
        'password.required' => 'La contraseña es obligatoria.',
        'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
        'rol.required' => 'Debe seleccionar al menos un rol.',
    ]
);
    
    $user = new User();
    $user->fill($request->all());

   
    if ($request->hasFile('profile_picture')) {
        $path = $request->file('profile_picture')->store('public/profile_pictures');
        $user->profile_picture = str_replace('public/', '', $path);  
    } else {
       
        $user->profile_picture = 'images/userImg.png';
    }

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
        // Validar los datos del formulario
        $request->validate([
            'name' => 'required|string|max:50',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
            'password' => 'nullable|string|confirmed|min:8',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validar la imagen
        ]);
    
        // Llenar los datos del usuario
        $user->fill($request->except(['profile_picture', 'password', 'password_confirmation']));
    
        // Si se sube una nueva imagen
        if ($request->hasFile('profile_picture')) {
            // Elimina la imagen antigua si existe y no es la predeterminada
            if ($user->profile_picture && $user->profile_picture != 'images/userImg.png') {
                Storage::delete('public/' . $user->profile_picture);
            }
    
            // Guardar la nueva imagen
            $path = $request->file('profile_picture')->store('public/profile_pictures');
            $user->profile_picture = str_replace('public/', '', $path);
        }
    
        // Actualizar la contraseña si se proporciona
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
    
        // Guardar los cambios
        $user->save();
    
        // Redirigir según el rol del usuario autenticado
       
            return redirect()->route('users.show', ['user' => $user->id])->with('success', 'Usuario actualizado correctamente.');
        
    
        
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
