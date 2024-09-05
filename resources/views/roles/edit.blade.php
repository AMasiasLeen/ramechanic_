@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between mb-3">
        <a class="btn btn-secondary" href="{{ route('roles.index') }}">Regresar</a>
        <a class="btn btn-success" href="{{ route('roles.create') }}">Añadir otro Rol</a>
    </div>

    <div class="card">
        <div class="card-header">
            <h1>Editar Rol</h1>
        </div>
        <div class="card-body">
            <form action="{{ route('roles.update', ['role'=>$role]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="identification" class="form-label">Identificación</label>
                    <input name="identification" type="text" class="form-control" id="identification"  value="{{ $role->name }}" required>

                </div>
                <button type="submit" class="btn btn-primary">ACTUALIZAR</button>
            </form>
        </div>
    </div>
@endsection
