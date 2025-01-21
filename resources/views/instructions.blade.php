@extends('layouts.app')

@section('content')
    @php
        $last = $records->sortByDesc('fecha')->first();
    @endphp
    <div class="container py-5">
        <div class="text-center mb-4">
            <h1 class="fw-bold">Bienvenido al Dashboard</h1>
            <p class="text-secondary">Aquí puedes gestionar y visualizar tus vehículos y sus registros de antecedentes.</p>
        </div>

        <div class="row mb-4">
            <!-- Estadísticas rápidas -->
            <div class="col-lg-4">
                <div class="card border-primary">
                    <div class="card-body">
                        <h5 class="card-title">Antecedente más reciente</h5>

                        <p class="card-text"></p>
                        <p class="text-muted">Fecha: {{ $last->date_in }}</p>
                        <p class="text-muted">Descripción: {{ $last->short_description }}</p>

                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card border-primary">
                    <div class="card-body">
                        <h5 class="card-title">Último vehículo en recibir un antecedente</h5>

                        <p class="card-text"></p>
                        <p class="text-muted">Modelo: {{ $last->vehicle->vehicle_model->name }} </p>
                        <p class="text-muted">Marca: {{ $last->vehicle->vehicle_model->brand->name }} </p>
                        <p class="text-muted">Placa: {{ $last->vehicle->plate }} </p>
                        

                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card border-primary">
                    <div class="card-body">
                        <h5 class="card-title">Total de registros</h5>
                        <p class="display-4 text-center">{{ $records->count() }}</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('styles')
    <style>
        .calendar-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 5px;
        }

        .calendar-cell {
            width: 100%;
            aspect-ratio: 1 / 1;
        }

        .cell {
            width: 100%;
            height: 100%;
            border-radius: 3px;
        }
    </style>
@endpush
