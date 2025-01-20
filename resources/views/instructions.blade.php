@extends('layouts.app')

@section('content')
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
                            <p class="text-muted">Fecha: </p>
                        
                            <p class="text-secondary">No hay antecedentes registrados.</p>
                        
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card border-primary">
                    <div class="card-body">
                        <h5 class="card-title">Último vehículo en recibir un antecedente</h5>
                        
                            <p class="card-text"></p>
                            <p class="text-muted">Fecha: </p>
                        
                            <p class="text-secondary">No hay vehículos con antecedentes registrados.</p>
                        
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

        <div class="row mb-4">
            <!-- Calendario de antecedentes -->
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Calendario de Antecedentes</h4>
                    </div>
                    <div class="card-body">
                        
                            <p class="text-secondary">No hay actividades registradas.</p>
                        
                            <div class="calendar-grid">
                                
                                    <div class="calendar-cell" title=" registros">
                                        <div class="cell" style="background-color: rgba(0, 123, 255, {{ min( 5, 1) }});"></div>
                                    </div>
                            </div>
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





    <!-- <div class="container py-5">
        <div class="text-center mb-4">
            <h1 class="fw-bold">Bienvenido al Dashboard</h1>
            <p class="text-secondary">Aquí puedes gestionar y visualizar tus vehículos y sus registros de antecedentes.</p>
        </div>

        <div class="row mb-4"> 
             Estadísticas rápidas
            <div class="col-lg-4">
                <div class="card border-primary">
                    <div class="card-body">
                        <h5 class="card-title">Antecedente más reciente</h5>
                        @if ($latestRecord)
                            <p class="card-text">{{ $latestRecord->short_description }}</p>
                            <p class="text-muted">Fecha: {{ $latestRecord->date_in }}</p>
                        @else
                            <p class="text-secondary">No hay antecedentes registrados.</p>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card border-primary">
                    <div class="card-body">
                        <h5 class="card-title">Último vehículo en recibir un antecedente</h5>
                        @if ($latestVehicle)
                            <p class="card-text">{{ $latestVehicle->vehicle_model->brand->name }} -
                                {{ $latestVehicle->vehicle_model->name }}</p>
                            <p class="text-muted">Fecha: {{ $latestVehicle->records->last()->date_in }}</p>
                        @else
                            <p class="text-secondary">No hay vehículos con antecedentes registrados.</p>
                        @endif
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

        <div class="row mb-4">
            Calendario de antecedentes 
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Calendario de Antecedentes</h4>
                    </div>
                    <div class="card-body">
                        @if ($recordActivity->isEmpty())
                            <p class="text-secondary">No hay actividades registradas.</p>
                        @else
                            <div class="calendar-grid">
                                @foreach ($recordActivity as $date => $count)
                                    <div class="calendar-cell" title="{{ $date }}: {{ $count }} registros">
                                        <div class="cell" style="background-color: rgba(0, 123, 255, {{ min($count / 5, 1) }});"></div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div> -->
