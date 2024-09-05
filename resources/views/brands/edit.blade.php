@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between mb-3">
        <a class="btn btn-secondary" href="{{ route('brands.index') }}">Regresar</a>
        <a class="btn btn-success" href="{{ route('brands.create') }}">Añadir otro registro</a>
    </div>

    <div class="card">
        <div class="card-header">
            <h1>Editar Marca</h1>
        </div>
        <div class="card-body">
            <form action="{{ route('brands.update', ['brand'=>$brand]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="name" class="form-label">Nombre de la Marca</label>
                    <input name="name" type="text" class="form-control" id="name" value="{{ $brand->name }}" required>
                </div>
                <button type="submit" class="btn btn-primary">ACTUALIZAR</button>
            </form>
        </div>
    </div>
@endsection
