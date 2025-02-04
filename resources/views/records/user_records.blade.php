@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between">
        <h1>Mis Antecedentes</h1>
    </div>
    <form action="{{ route('records.user_records') }}">
        <div class="row mb-4">
            <div class="col-12 col-sm-2">
                <div class="form-group">
                    <label for="">Desde:</label>
                    <input type="date" class="form-control" name="desde" value="{{ request()->desde }}">
                </div>
            </div>
            <div class="col-12 col-sm-2">
                <div class="form-group">
                    <label for="">Hasta:</label>
                    <input type="date" class="form-control" name="hasta" value="{{ request()->hasta }}">
                </div>
            </div>
            <div class="col-12 col-sm-2">
                <div class="form-group">
                    <label for="">Vehículo:</label>
                    <select name="vehicle_id" class="form-control" id="vehicle_id"></select>
                </div>
            </div>
            <div class="col-12 col-sm-2 my-auto">
                <div class="form-group">
                    <button class="btn btn-primary">Buscar</button>
                    <a href="{{ route('records.user_records') }}" class="btn btn-secondary">Ver Todo</a>
                </div>
            </div>
        </div>
    </form>

    <div class="row">
        @foreach ($records as $record)
            <div class="col-md-4">
                <div class="card mb-3 shadow-sm">
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
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#recordModal{{ $record->id }}">
                            Ver Detalles
                        </button>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="recordModal{{ $record->id }}" tabindex="-1"
                aria-labelledby="recordModalLabel{{ $record->id }}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content bg-dark text-white">
                        <div class="modal-header">
                            <h5 class="modal-title" id="recordModalLabel{{ $record->id }}">Detalles del Antecedente</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p><strong>Vehículo:</strong>
                                {{ $record->vehicle->vehicle_model->brand->name }} - {{ $record->vehicle->vehicle_model->name }}</p>
                            <p><strong>Fecha de Registro:</strong> {{ $record->date_in }}</p>
                            <p><strong>Descripción:</strong> {!! strip_tags($record->long_description, 
                                '<p><strong><em><u><ol><ul><li><table><tr><td><th><img><br><h1><h2><h3><h4><h5><h6>') !!}
                            @if ($record->images)
                                <div id="carousel{{ $record->id }}" class="carousel slide" data-bs-ride="carousel">
                                    <div class="carousel-inner">
                                        @foreach (json_decode($record->images) as $index => $image)
                                            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                                <img src="{{ Storage::url('records/' . $image) }}"
                                                    class="d-block w-100 img-thumbnail" alt="Imagen {{ $index + 1 }}">
                                            </div>
                                        @endforeach
                                    </div>
                                    <button class="carousel-control-prev" type="button"
                                        data-bs-target="#carousel{{ $record->id }}" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button"
                                        data-bs-target="#carousel{{ $record->id }}" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                </div>
                            @endif
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $records->appends(request()->query())->links('pagination::bootstrap-4') }}
    </div>

    <input type="text" hidden id="user_id" value="{{ Auth::user()->id }}">
@endsection

@push('js')
    <script>
        window.onload = () => {

            $("#vehicle_id").select2({
                theme: "bootstrap-5",
                width: "100%",
                ajax: {
                    url: "{{ route('vehicles_records') }}",
                    dataType: 'json',
                    data: (params) => ({
                        owner_id: $("#user_id").val(),
                        term: params.term
                    })
                }
            });
        }
    </script>
@endpush
