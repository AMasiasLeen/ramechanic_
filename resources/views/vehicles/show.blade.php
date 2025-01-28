@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between mb-3">
        <a class="btn btn-secondary" href="{{ route('vehicles.index') }}">Regresar</a>
        <a class="btn btn-success" href="{{ route('vehicles.create') }}">Agregar Nuevo</a>
    </div>

    <div class="card">
        <div class="card-header">
            <h1>Detalles del Vehículo</h1>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-md-6">
                    <h4>Placa del Vehículo</h4>
                    <h3>{{ $vehicle->plate }}</h3>
                </div>
                <div class="col-12 col-md-6">
                    <h4>Propietario</h4>
                    <h3>{{ $vehicle->owner->name }}</h3>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-md-6">
                    <h4>Marca</h4>
                    <h3>{{ $vehicle->vehicle_model->brand->name }}</h3>
                </div>
                <div class="col-12 col-md-6">
                    <h4>Modelo</h4>
                    <h3>{{ $vehicle->vehicle_model->name }}</h3>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-md-6">
                    <h4>Serie del Motor</h4>
                    <h3>{{ $vehicle->engine_serial }}</h3>
                </div>
                <div class="col-12 col-md-6">
                    <h4>Número de Serie</h4>
                    <h3>{{ $vehicle->serial_number }}</h3>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-md-6">
                    <h4>Color</h4>
                    <h3>{{ $vehicle->color }}</h3>
                </div>
                <div class="col-12 col-md-6">
                    <h4>Imagen</h4>
                    <img id="main_image" class="img-fluid mt-2 rounded" 
                         src="{{ $vehicle->main_image ? Storage::url('vehicles/' . $vehicle->main_image) : asset('assets/default_car.jpg') }}" 
                         alt="Imagen del Vehículo">
                </div>
            </div>
        </div>
        <div class="card-footer d-flex justify-content-between">
            <a class='btn btn-primary' href="{{ route('vehicles.edit', ['vehicle' => $vehicle]) }}">Modificar</a>
            <form id="formdel" action="{{ route('vehicles.destroy', ['vehicle' => $vehicle]) }}" method="POST"
                  style="display:inline;">
                @csrf
                @method('DELETE')
                <!-- <button class="btn btn-danger" type="submit">Eliminar</button> -->
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
