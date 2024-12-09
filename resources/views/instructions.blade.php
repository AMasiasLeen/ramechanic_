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
                        @if ($vehicles->isEmpty())
                            <p class="text-secondary">Aún no tienes vehículos registrados.</p>
                        @else
                            <ul class="list-group">
                                @foreach ($vehicles as $vehicle)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        {{ $vehicle->vehicle_model->brand->name }} - {{ $vehicle->vehicle_model->name }}


                                    </li>
                                @endforeach
                                {{ $vehicles->appends(['recordsPage' => $records->currentPage(), 'vehiclesPage' => $vehicles->currentPage()])->links('pagination::bootstrap-4') }}
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
                        @if ($records->isEmpty())
                            <p class="text-secondary">Aún no tienes registros de antecedentes.</p>
                        @else
                            <ul class="list-group">
                                @foreach ($records as $record)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        {{ $record->vehicle->vehicle_model->brand->name }} -
                                        {{ $record->short_description }}
                                        <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#recordModal{{ $record->id }}">
                                            Ver detalles
                                        </button>
                                        <div class="modal fade" id="recordModal{{ $record->id }}" tabindex="-1"
                                            aria-labelledby="recordModalLabel{{ $record->id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content bg-dark text-white">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="recordModalLabel{{ $record->id }}">
                                                            Detalles del
                                                            Antecedente</h5>
                                                        <button type="button" class="btn-close btn-close-white"
                                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">

                                                        <p><strong>Vehículo:</strong>
                                                            {{ $record->vehicle->vehicle_model->brand->name }} -
                                                            {{ $record->vehicle->vehicle_model->name }}</p>
                                                        <p><strong>Fecha de Registro:</strong> {{ $record->date_in }}</p>
                                                        <p><strong>Descripción Completa:</strong>
                                                            {{ $record->long_description }}</p>
                                                        @if ($record->images != null)
                                                            <div id="carousel{{ $record->id }}" class="carousel slide"
                                                                data-bs-ride="carousel">
                                                                <div class="carousel-inner">

                                                                    @foreach (json_decode($record->images) as $index => $image)
                                                                        <div
                                                                            class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                                                            <img src="{{ Storage::url('records/' . $image) }}"
                                                                                class="d-block w-100 img-thumbnail"
                                                                                alt="Imagen {{ $index + 1 }}">
                                                                        </div>
                                                                    @endforeach

                                                                </div>
                                                                <button class="carousel-control-prev" type="button"
                                                                    data-bs-target="#carousel{{ $record->id }}"
                                                                    data-bs-slide="prev">
                                                                    <span class="carousel-control-prev-icon"
                                                                        aria-hidden="true"></span>
                                                                    <span class="visually-hidden">Previous</span>
                                                                </button>
                                                                <button class="carousel-control-next" type="button"
                                                                    data-bs-target="#carousel{{ $record->id }}"
                                                                    data-bs-slide="next">
                                                                    <span class="carousel-control-next-icon"
                                                                        aria-hidden="true"></span>
                                                                    <span class="visually-hidden">Next</span>
                                                                </button>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Cerrar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach

                            </ul>
                            {{ $records->appends(['recordsPage' => $records->currentPage(), 'vehiclesPage' => $vehicles->currentPage()])->links('pagination::bootstrap-4') }}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
