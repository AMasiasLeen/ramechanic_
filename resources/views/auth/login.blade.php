@extends('layouts.auth')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-lg">
                    <div class="card-header bg-primary text-white text-center">
                        <h3>Iniciar Sesión</h3>
                    </div>
                    <div class="card-body">
                        <!-- Formulario de login -->
                        <form action="{{ route('login') }}" method="POST">
                            @csrf
                            
                            <!-- Campo de correo electrónico -->
                            <div class="form-group mb-3">
                                <label for="email" class="form-label">Correo electrónico soy gay</label>
                                <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required autofocus placeholder="Ingresa tu correo">
                                
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Campo de contraseña -->
                            <div class="form-group mb-3">
                                <label for="password" class="form-label">Contraseña</label>
                                <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" required placeholder="Ingresa tu contraseña">
                                
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Checkbox de recordar sesión -->
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">
                                    Recordarme
                                </label>
                            </div>

                            <!-- Botón de login -->
                            <div class="d-grid mb-3">
                                <button class="btn btn-primary btn-block" type="submit">Iniciar Sesión</button>
                            </div>

                            <!-- Enlace para recuperar contraseña -->
                            @if (Route::has('password.request'))
                                <div class="text-center">
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        ¿Olvidaste tu contraseña?
                                    </a>
                                </div>
                            @endif
                        </form>

                        {{-- Soy putizismo bien gay --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
