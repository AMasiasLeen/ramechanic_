@extends('layouts.auth')

@section('content')
<div class="container mt-5 pt-5">
    <div class="row justify-content-center align-items-center">
        <!-- Sección de mensajes -->
        <div class="info-section col-md-5 d-none d-md-block p-4 text-center rounded shadow-lg bg-gradient-primary">
            <h2 class="text-white fw-bold">Sistema de Gestión de Registro</h2>
            <p class="text-light mt-3">
                Bienvenido al sistema de gestión de registros. Aquí podrás gestionar y controlar la información de forma eficiente y segura.
            </p>
            <p class="text-warning mt-3 fw-bold">
                ¿No tienes una cuenta?
            </p>
            <p class="text-light">
                Si aún no tienes un usuario, contacta al administrador para que te genere un perfil.
            </p>
        </div>

        <!-- Formulario de inicio de sesión -->
        <div class="col-md-7 col-lg-5">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-primary text-white text-center py-4">
                    <!-- <img src="{{ asset('assets/taller.jpg') }}" alt="Logo" class="img-fluid mb-3" style="max-height: 100px;"> -->
                    <h3 class="mb-0">Ramechanic</h3>
                </div>
                <div class="card-body px-4 py-5">
                    <form action="{{ route('login') }}" method="POST" class="animate__animated animate__fadeIn">
                        @csrf

                        <div class="form-group mb-4">
                            <label for="email" class="form-label">Correo electrónico</label>
                            <input type="email" name="email" id="email"
                                class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}"
                                required autofocus placeholder="Ingresa tu correo">

                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-4">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" name="password" id="password"
                                class="form-control @error('password') is-invalid @enderror" required
                                placeholder="Ingresa tu contraseña">

                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="d-grid mb-4">
                            <button class="btn btn-primary btn-block btn-lg shadow" type="submit">Iniciar Sesión</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    body {
        background: linear-gradient(135deg, #1e3a8a, #2563eb);
        color: #ffffff;
    }

    .bg-gradient-primary {
        background: linear-gradient(45deg, #1d4ed8, #3b82f6);
        color: #ffffff;
    }

    .btn-primary {
        background-color: #2563eb;
        border-color: #2563eb;
    }

    .btn-primary:hover {
        background-color: #1d4ed8;
        border-color: #1d4ed8;
    }

    .form-control {
        border-radius: 10px;
        box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .form-control:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 0.25rem rgba(37, 99, 235, 0.25);
    }

    .card {
        border-radius: 15px;
    }
</style>
@endpush
@endsection
