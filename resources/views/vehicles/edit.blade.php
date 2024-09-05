@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between mb-3">
        <a class="btn btn-secondary" href="{{ route('vehicles.index') }}">Regresar</a>
        <a class="btn btn-success" href="{{ route('vehicles.create') }}">Añadir otro registro</a>
    </div>

    <div class="card">
        <div class="card-header">
            <h1>Editar Vehículo</h1>
        </div>
        <div class="card-body">
            <form action="{{ route('vehicles.update', ['vehicle'=>$vehicle]) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="plate" class="form-label">Placa del Vehículo</label>
                    <input name="plate" type="text" class="form-control" id="plate" value="{{ $vehicle->plate }}" required>

                    <label for="owner_id" class="form-label">Propietario</label>
                    <input name="owner_id" type="text" class="form-control" id="owner_id" value="{{ $vehicle->owner_id }}" required>

                    <label for="brand_id" class="form-label">Marca</label>
                    <input name="brand_id" type="text" class="form-control" id="brand_id" value="{{ $vehicle->brand_id }}" required>

                    <label for="vehicle_model_id" class="form-label">Modelo</label>
                    <input name="vehicle_model_id" type="text" class="form-control" id="vehicle_model_id" value="{{ $vehicle->vehicle_model_id }}" required>

                    <label for="engine_serial" class="form-label">Serie del Motor</label>
                    <input name="engine_serial" type="text" class="form-control" id="engine_serial" value="{{ $vehicle->engine_serial }}" required>
                    
                    <label for="serial_number" class="form-label">Número de Serie</label>
                    <input name="serial_number" type="text" class="form-control" id="serial_number" value="{{ $vehicle->serial_number }}" required>

                    <label for="color" class="form-label">Color</label>
                    <input name="color" type="text" class="form-control" id="color" value="{{ $vehicle->color }}" required>
                </div>
                <button type="submit" class="btn btn-primary">ACTUALIZAR</button>
            </form>
        </div>
    </div>
@endsection
