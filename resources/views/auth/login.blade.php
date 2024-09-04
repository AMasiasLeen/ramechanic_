@extends('layouts.auth')

@section('content')
    <div class="container mx-auto">
        <div class="row">
            <div class="col col-md-4 mx-auto">
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="card my-5">
                        <div class="card-body">
                            <h1>Login</h1>
                            <div class="form-group">
                                <label for="email">Correo:</label>
                                <input name="email" type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password">Contraseña:</label>
                                <input name="password" type="password" class="form-control">
                            </div>
                            <div class="form-group text-center my-4">
                                <button class="btn btn-primary btn-block" type="submit">Iniciar Sesión</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
