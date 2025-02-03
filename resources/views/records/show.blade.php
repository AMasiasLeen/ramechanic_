@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between mb-3">
        <a class="btn btn-secondary" href="{{ route('records.index') }}">Regresar</a>
        <a class="btn btn-success" href="{{ route('records.create') }}">Agregar Nuevo</a>
    </div>

    <div class="card">
        <div class="card-header">
            <h1>Detalles del Antecedente</h1>
        </div>
        <div class="card-body">
            <div class="row">
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
                <div class="col-12 col-md-6">
                <h4>Descripción</h4>
                <div class="border p-3 rounded bg-light">
                    {!! nl2br(e($record->long_description)) !!}
                </div>
            </div>
            </div>
            <div class="row">
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

        <div class="card-footer">
            <a class='btn btn-primary' href="{{ route('records.edit', ['record' => $record]) }}">Modificar</a>
            <form id="formdel" action="{{ route('records.destroy', ['record' => $record]) }}" method="POST"
                style="display:inline;">
                @csrf
                @method('DELETE')
                <!-- <button type="submit" class="btn btn-danger">Eliminar</button> -->
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
