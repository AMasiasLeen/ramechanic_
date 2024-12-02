@extends('layouts.auth')

@section('content')
    <div class="container mt-5 pt-5">
        <div class="mt-5 pt-5"></div>
        <div class="row pt-5 mx-auto justify-content-center">
            <div class="info-section col-4">
                <h2 class="text-primary">Sistema de Gestión de Registro</h2>
                <p class="text-light">Bienvenido al sistema de gestión de registros. Aquí podrás gestionar y controlar la
                    información de forma eficiente y segura.</p>
                <p class="text-danger"><strong>¿No tienes una cuenta?</strong></p>
                <p class="text-light">Si aún no tienes un usuario, por favor contacta al administrador para que te genere
                    un perfil, si planeas ser un usuario recurrente.</p>
            </div>
            <div class="card col-4 shadow-lg">
                <div class="card-header bg-primary text-white text-center">
                    <h3>Iniciar Sesión</h3>
                </div>
                <div class="card-body">

                    <form action="{{ route('login') }}" method="POST">
                        @csrf


                        <div class="form-group mb-3">
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


                        <div class="form-group mb-3">
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


                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">
                                Recordarme
                            </label>
                        </div>


                        <div class="d-grid mb-3">
                            <button class="btn btn-primary btn-block" type="submit">Iniciar Sesión</button>
                        </div>


                        @if (Route::has('password.request'))
                            <div class="text-center">
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    ¿Olvidaste tu contraseña?
                                </a>
                            </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
