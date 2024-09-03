@extends('layouts.auth')

@section('content')
    <div class="container mx-auto">
        <div class="row">
            <div class="col col-md-4 mx-auto">
                <div class="card my-5">
                    <div class="card-body">
                        <h1>Login</h1>
                        <div class="form-group">
                            <label for="email">Correo:</label>
                            <input type="email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="password">Contraseña:</label>
                            <input type="password" class="form-control">
                        </div>
                        <div class="form-group text-center my-4">
                            <button class="btn btn-primary btn-block">Iniciar Sesión</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
