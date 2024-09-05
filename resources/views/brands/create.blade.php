@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between mb-3">
        <a class="btn btn-secondary" href="{{ route('brands.index') }}">Regresar</a>
    </div>

    <div class="card">
        <div class="card-header">
            <h1>Agregar Marca</h1>
        </div>
        <div class="card-body">
            <form action="{{ route('brands.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nombre de la Marca</label>
                    <input name="name" type="text" class="form-control" id="name" required>
                </div>
                <button type="submit" class="btn btn-primary">GUARDAR</button>
            </form>
        </div>
    </div>
@endsection

