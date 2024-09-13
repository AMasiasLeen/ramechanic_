@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="text-center mb-4">
        <h1 class="fw-bold">Bienvenido al Dashboard</h1>
        <p class="text-secondary">Aquí puedes gestionar y visualizar tus vehículos y sus registros de antecedentes.</p>
    </div>

    <div class="row">
        <!-- Sección de Vehículos -->
        <div class="col-lg-6">
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Tus Vehículos</h4>
                </div>
                <div class="card-body">
                    @if($vehicles->isEmpty())
                        <p class="text-secondary">Aún no tienes vehículos registrados.</p>
                    @else
                        <ul class="list-group">
                            @foreach($vehicles as $vehicle)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ $vehicle->vehicle_model->brand->name }} - {{ $vehicle->model }}
                                    <a href="{{ route('vehicles.show', $vehicle->id) }}" class="btn btn-outline-primary btn-sm">Ver Detalles</a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>

        <!-- Sección de Registros de Antecedentes -->
        <div class="col-lg-6">
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Tus Registros de Antecedentes</h4>
                </div>
                <div class="card-body">
                    @if($records->isEmpty())
                        <p class="text-secondary">Aún no tienes registros de antecedentes.</p>
                    @else
                        <ul class="list-group">
                            @foreach($records as $record)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ $record->vehicle->vehicle_model->brand->name }} - {{ $record->short_description }}
                                    <a href="{{ route('records.show', $record->id) }}" class="btn btn-outline-primary btn-sm">Ver Detalles</a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
