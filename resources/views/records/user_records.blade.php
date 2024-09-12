@extends('layouts.app')

@section('content')

    <div class="d-flex justify-content-between mb-4">
        <h1>Mis Antecedentes</h1>
    </div>

    <div class="row">
        @foreach ($records as $record)
            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="card-header bg-dark text-white">
                        <h5 class="card-title mb-0">Vehículo: {{ $record->vehicle->plate }}</h5>
                    </div>
                    <div class="card-body">
                        <h6 class="card-subtitle mb-2 text-muted">Propietario: {{ $record->vehicle->owner->name }}</h6>
                        <p class="card-text">
                            <strong>Marca:</strong> {{ $record->vehicle->vehicle_model->brand->name }}<br>
                            <strong>Modelo:</strong> {{ $record->vehicle->vehicle_model->name }}<br>
                            <strong>Descripción Corta:</strong> {{ $record->short_description }}<br>
                            <strong>Fecha de Registro:</strong> {{ $record->date_in }}
                        </p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

@endsection