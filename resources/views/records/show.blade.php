@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="d-flex justify-content-between mb-3">
            <a class="btn btn-secondary btn-sm" href="{{ route('records.index') }}">Regresar</a>
            <a class="btn btn-success btn-sm" href="{{ route('records.create') }}">Agregar Nuevo</a>
        </div>

        <div class="card">
                <div class="card-header p-3">
                    <h5 class="mb-0">Detalles del Antecedente</h5>
                </div>

                <div class="card-body p-3">
                    <div class="row g-3">
                    
                <div class="col-12 col-md-6">
                    <h4>Fecha de Registro</h4>
                    <p>{{ $record->date_in }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-6">
                    <h4>Propietario</h4>
                    <ul class="list-group">
                        <li class="list-group-item"><strong>Nombre: </strong>{{ $record->vehicle->owner->name }}</li>
                        <li class="list-group-item"><strong>Teléfono: </strong>{{ $record->vehicle->owner->phone }}</li>
                        <li class="list-group-item"><strong>Correo: </strong>{{ $record->vehicle->owner->email }}</li>
                    </ul>
                </div>
                <div class="col-12 col-md-6">
                    <h4>Vehículo</h4>
                    <ul class="list-group">
                        <li class="list-group-item"><strong>Marca: </strong>{{ $record->vehicle->vehicle_model->brand->name }}</li>
                        <li class="list-group-item"><strong>Modelo: </strong>{{ $record->vehicle->vehicle_model->name }}</li>
                        <li class="list-group-item"><strong>Año: </strong>{{ $record->vehicle->year }}</li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-6">
                    <h4>Detalle</h4>
                    <p>{{ $record->short_description }}</p>
                </div>

            </div>
            <div class="row">

                <div class="col-12 col-md-6">
                    <!-- Elimina el margen inferior del título -->
                    <h4 class="mb-0">Descripción</h4> <!-- Clase "mb-0" de Bootstrap -->

                    <!-- Contenedor sin padding superior -->
                    <div class="border rounded bg-light ckeditor-content mt-2"> <!-- "mt-2" para espacio mínimo -->
                        {!! $record->long_description !!}
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <h4>Imágenes de Proceso</h4>
                    @if ($record->images)
                    <div id="carouselImages" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @foreach (json_decode($record->images) as $index => $image)
                            <div class="carousel-item @if ($index === 0) active @endif">
                                <img src="{{ Storage::url('records/' . $image) }}" class="d-block w-100"
                                    alt="Imagen adicional {{ $index + 1 }}">
                            </div>
                            @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselImages"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Anterior</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselImages"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Siguiente</span>
                        </button>
                    </div>
                    @else
                    <p>No hay imágenes adicionales disponibles.</p>
                    @endif
                </div>
            </div>

        </div>
        <div class="card-footer p-3 d-flex gap-2">
            <a href="{{ route('records.edit', $record) }}" 
               class="btn btn-primary btn-sm px-4">Modificar</a>
            
            <form id="deleteForm" action="{{ route('records.destroy', $record) }}" method="POST">
                @csrf
                @method('DELETE')
                <!-- <button type="button" 
                        class="btn btn-danger btn-sm" 
                        onclick="confirmDelete()">
                    Eliminar
                </button> -->
            </form>
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


<style>
    .ckeditor-content {
        height: 250px;
        overflow-y: auto;
        word-break: break-word;
        padding: 1rem !important;
        /* Padding uniforme */
        margin-top: 0;
        /* Elimina espacio extra */
    }

    /* Elimina márgenes de elementos internos */
    .ckeditor-content p:first-child,
    .ckeditor-content ul:first-child {
        margin-top: 0 !important;
    }
</style>

@endpush