@extends('layouts.app')

@section('content')
    @php
        $last = $records->sortByDesc('fecha')->first();
    @endphp
    <div class="container py-5">
        <div class="text-center mb-5">
            <h1 class="fw-bold text-primary">Bienvenido al Dashboard</h1>
            <p class="text-muted">Gestiona y visualiza tus vehículos y sus registros de antecedentes.</p>
        </div>

        <div class="row mb-5">
            <!-- Tarjetas de estadísticas -->
            <div class="col-lg-4 mb-4">
                <div class="card border-primary shadow">
                    <div class="card-body text-center">
                        <h5 class="card-title text-uppercase fw-bold text-primary">Antecedente más reciente</h5>
                        @if ($last)
                            <p class="text-secondary mb-2">
                                <i class="fa fa-calendar-check"></i> Fecha: <strong>{{ $last->date_in }}</strong>
                            </p>
                            <p class="text-secondary">
                                <i class="fa fa-file-text"></i> Detalle: <strong>{{ $last->short_description }}</strong>
                            </p>
                        @else
                            <p class="text-muted">No hay antecedentes registrados aún.</p>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-lg-4 mb-4">
                <div class="card border-success shadow">
                    <div class="card-body text-center">
                        <h5 class="card-title text-uppercase fw-bold text-success">Último vehículo registrado</h5>
                        @if ($last && $last->vehicle)
                            <p class="text-secondary mb-1">
                                <i class="fa fa-truck"></i> Modelo: <strong>{{ $last->vehicle->vehicle_model->name }}</strong>
                            </p>
                            <p class="text-secondary mb-1">
                                <i class="fa fa-tags"></i> Marca: <strong>{{ $last->vehicle->vehicle_model->brand->name }}</strong>
                            </p>
                            <p class="text-secondary">
                                <i class="fa fa-window-maximize"></i> Placa: <strong>{{ $last->vehicle->plate }}</strong>
                            </p>
                        @else
                            <p class="text-muted">No hay vehículos registrados aún.</p>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-lg-4 mb-4">
                <div class="card border-info shadow">
                    <div class="card-body text-center">
                        <h5 class="card-title text-uppercase fw-bold text-info">Total de registros</h5>
                        <p class="display-4 text-primary">{{ $records->count() }}</p>
                        <p class="text-muted">Registros acumulados</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sección de acciones rápidas -->
        <div class="text-center">
            <h3 class="fw-bold mb-4 text-secondary">Acciones Rápidas</h3>
            <div class="d-flex justify-content-center gap-4">
                <a href="{{ route('records.user_records') }}" class="btn btn-success btn-lg shadow">
                    <i class="fa fa-folder-open"></i> Ver Registros
                </a>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .card {
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.15);
        }

        .btn-lg {
            padding: 15px 30px;
            font-size: 1.2rem;
        }
    </style>
@endpush
