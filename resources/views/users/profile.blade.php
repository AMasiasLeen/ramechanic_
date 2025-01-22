@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow-lg">
                    <!-- Encabezado del perfil -->
                    <div class="card-header bg-primary text-white text-center py-4">
                        <h2 class="mb-0">Perfil de Usuario</h2>
                    </div>
                    
                    <div class="card-body">
                        <div class="row align-items-center">
                            <!-- Imagen de perfil -->
                            <div class="col-md-4 text-center mb-4 mb-md-0">
                                <div class="position-relative">
                                    <img src="{{ $user->profile_picture ? Storage::url($user->profile_picture) : asset('images/default_user.png') }}" 
                                        class="img-fluid rounded-circle shadow" 
                                        alt="Imagen de perfil" 
                                        style="max-width: 200px;">
                                    
                                </div>
                            </div>

                            <!-- Información del usuario -->
                            <div class="col-md-8">
                                <h3 class="fw-bold text-primary">{{ $user->name }}</h3>
                                <p class="text-muted mb-2"><i class="fa fa-envelope"></i> {{ $user->email }}</p>
                                <p class="text-muted mb-2"><i class="fa fa-phone"></i> {{ $user->phone ?? 'No registrado' }}</p>
                                <p class="text-muted mb-2"><i class="fa fa-map-marker"></i> {{ $user->address ?? 'No registrada' }}</p>
                                <p class="text-muted mb-0"><i class="fa fa-calendar"></i> Miembro desde: {{ $user->created_at->format('d-m-Y') }}</p>

                                <div class="mt-4">
                                    <a href="{{ route('users.edit_profile', ['user' => $user]) }}" class="btn btn-warning me-2">
                                        <i class="fa fa-pencil-square"></i> Editar Perfil
                                    </a>
                                    <a href="{{ route('home') }}" class="btn btn-secondary">
                                        <i class="fa fa-arrow-left"></i> Regresar al Dashboard
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pie del perfil -->
                    <div class="card-footer bg-light text-center">
                        <p class="text-muted mb-0">¿Necesitas ayuda? <a href="" class="text-primary">Contacta soporte</a>.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .card {
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.1);
        }

        .btn-outline-light:hover {
            background-color: rgba(255, 255, 255, 0.9);
        }

        .btn-outline-light i {
            font-size: 1.2rem;
        }

        .card-footer a {
            text-decoration: none;
        }

        .card-footer a:hover {
            text-decoration: underline;
        }
    </style>
@endpush
