@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between ">
        <h1>Mis Antecedentes</h1>
    </div>
    <form action="{{ route('records.user_records') }}">
        <div class="row mb-4">
            <div class="col-12 col-sm-2">
                <div class="form-group">
                    <label for="">Desde:</label>
                    <input type="date" class="form-control" name="desde" value="{{request()->desde}}">
                </div>
            </div>
            <div class="col-12 col-sm-2">
                <div class="form-group">
                    <label for="">Hasta:</label>
                    <input type="date" class="form-control" name="hasta" value="{{request()->hasta}}">
                </div>
            </div>
            <div class="col-12 col-sm-2">
                <div class="form-group">
                    <label for="">Hasta:</label>
                    <select name="vehicle_id" class="form-control" id="vehicle_id"></select>
                </div>
            </div>
            <div class="col-12 col-sm-2 my-auto">
                <div class="form-group ">
                    <button class="btn btn-primary">Buscar</button>
                    <a href="{{ route('records.user_records') }}" class="btn btn-secondary">Mostrar Todo</a>
                </div>
            </div>

        </div>
    </form>
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
