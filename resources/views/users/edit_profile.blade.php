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
                                <img src="{{ asset('path_to_user_avatar_image') }}" class="img-fluid rounded-circle" alt="Imagen de perfil" style="max-width: 150px;">
                            </div>
                            <div class="col-md-8">
d</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection