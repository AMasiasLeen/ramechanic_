@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="d-flex justify-content-between mb-3">
            <a class="btn btn-secondary btn-sm" href="{{ route('vehicles.index') }}">Regresar
            </a>
            @if (Auth::user()->hasRole('administrador'))
            <a class="btn btn-success btn-sm" href="{{ route('vehicles.create') }}"> Nuevo
            </a>
            @endif
        </div>

        <div class="card">
            <div class="card-header p-3">
                <h5 class="mb-0">Detalles del Vehículo</h5>
            </div>

            <div class="card-body p-3">
                <div class="row g-3">
                    <!-- Placa y Año -->
                    <div class="col-12 col-md-6">
                        <label class="form-label text-muted">Placa</label>
                        <p class="h5">{{ $vehicle->plate }}</p>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label text-muted">Año</label>
                        <p class="h5">{{ $vehicle->year }}</p>
                    </div>

                    <!-- Propietario y Modelo -->
                    <div class="col-12 col-md-6">
                        <label class="form-label text-muted">Propietario</label>
                        <p class="h5">{{ $vehicle->owner->name ?? 'N/A' }}</p>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label text-muted">Modelo/Marca</label>
                        <p class="h5">
                            {{ $vehicle->vehicle_model->brand->name ?? 'N/A' }} - 
                            {{ $vehicle->vehicle_model->name ?? 'N/A' }}
                        </p>
                    </div>

                    <!-- Series -->
                    <div class="col-12 col-md-6">
                        <label class="form-label text-muted">Serie del Motor</label>
                        <p class="h5">{{ $vehicle->engine_serial ?? 'N/A' }}</p>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label text-muted">Serie del Chasis</label>
                        <p class="h5">{{ $vehicle->serial_number ?? 'N/A' }}</p>
                    </div>

                    <!-- Color e Imagen -->
                    <div class="col-12 col-md-6">
                        <label class="form-label text-muted">Color</label>
                        <p class="h5">{{ $vehicle->color ?? 'N/A' }}</p>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label text-muted">Imagen</label>
                        <div class="ratio ratio-16x9">
                            <img src="{{ $vehicle->main_image ? asset('storage/vehicles/'.$vehicle->main_image) : asset('images/default-vehicle.jpg') }}" 
                                 class="img-fluid rounded border" 
                                 alt="Imagen del vehículo"
                                 style="object-fit: contain">
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-footer p-3 d-flex gap-2">
            @if (Auth::user()->hasRole('administrador'))
                <a href="{{ route('vehicles.edit', $vehicle) }}" 
                   class="btn btn-primary btn-sm px-4"> Modificar
                </a>
                @endif
                
                <form id="deleteForm" action="{{ route('vehicles.destroy', $vehicle) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <!-- <button type="button" 
                            class="btn btn-danger btn-sm" 
                            onclick="confirmDelete()">
                        <i class="bi bi-trash"></i> Eliminar
                    </button> -->
                </form>
            </div>
        </div>
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
