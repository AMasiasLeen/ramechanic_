@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h3>Perfil de Usuario</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 text-center">
                                <!-- Imagen de perfil -->
                                <img src="{{ $user->profile_picture ? Storage::url($user->profile_picture) : asset('images/default_user.png') }}" class="img-fluid rounded-circle" alt="Imagen de perfil" style="max-width: 150px;">
                            </div>
                            <div class="col-md-8">
                                <!-- Información del usuario -->
                                <h4>{{ $user->name }}</h4>
                                <p><strong>Email:</strong> {{ $user->email }}</p>
                                <p><strong>Teléfono:</strong> {{ $user->phone }}</p>
                                <p><strong>Dirección:</strong> {{ $user->address }}</p>
                                <p><strong>Fecha de Registro:</strong> {{ $user->created_at->format('d-m-Y') }}</p>

                                <!-- Botones de acciones -->
                                <a href="{{ route('users.edit_profile', ['user' => $user]) }}" class="btn btn-warning">Editar Perfil</a>
                                <a href="{{ route('home') }}" class="btn btn-secondary">Regresar al Dashboard</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
