@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between mb-3">
        <a class="btn btn-secondary" href="{{ route('vehicles.index') }}">Regresar</a>
        <a class="btn btn-success" href="{{ route('vehicles.create') }}">Añadir otro registro</a>
    </div>

    <div class="card">
        <div class="card-header">
            <h1>Vehículo</h1>
        </div>
        <div class="card-body">
            <h4>Placa</h4>
            <h3>{{ $vehicle->plate }}</h3>

            <h4>Propietario</h4>
            <h3>{{ $vehicle->owner->name }}</h3>

            <h4>Marca</h4>
            <h3>{{ $vehicle->vehicle_model->brand->name }}</h3>

            <h4>Modelo</h4>
            <h3>{{ $vehicle->vehicle_model->name }}</h3>

            <h4>Serie de Motor</h4>
            <h3>{{ $vehicle->engine_serial }}</h3>

            <h4>Número de Serie</h4>
            <h3>{{ $vehicle->serial_number }}</h3>

            <h4>Color</h4>
            <h3>{{ $vehicle->color }}</h3>

            <h4>Imagen</h4>
            <img id="main_image" src="{{ Storage::url('vehicles/' . $vehicle->main_image) }}" alt="Imágen del Vehículo">

        </div>
        <div class="card-footer">
            <a class='btn btn-primary' href="{{ route('vehicles.edit', ['vehicle' => $vehicle]) }}">Modificar</a>
            <button id="btndel" class="btn btn-danger">Eliminar</button>
            <form id="formdel" action="{{ route('vehicles.destroy', ['vehicle' => $vehicle]) }}" method="POST"
                style="display:inline;">
                @csrf
                @method('DELETE')
            </form>
        </div>
    </div>
@endsection

@push('js')
    <script defer>
        window.onload = () => {
            $('#btndel').click(function() {
                Swal.fire({
                    title: "Esta seguro de eliminar",
                    text: "Esta accion no se puede deshacer",
                    icon: "warning",
                    showCancelButton: true
                }).then((result) => {
                    if (result.value) {
                        $('#formdel').submit();
                    }
                })
            })
        }
    </script>
@endpush

@push('css')
    <style>
        #main_image {
            width: 200px
        }
    </style>
@endpush
