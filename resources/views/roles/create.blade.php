@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between mb-3">
        <a class="btn btn-secondary" href="{{ route('roles.index') }}">Regresar</a>
    </div>

    <div class="card">
        <div class="card-header">
            <h1>Agregar Rol</h1>
        </div>
        <div class="card-body">
            <form action="{{ route('roles.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="rol" class="form-label">Rol:</label>
                    <input name="rol" type="text" class="form-control" id="rol" required>

                </div>
                <button type="submit" class="btn btn-primary">GUARDAR</button>
            </form>
        </div>
    </div>
@endsection
