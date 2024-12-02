@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between mb-3">
        <a class="btn btn-secondary" href="{{ route('records.index') }}">Regresar</a>
        <a class="btn btn-success" href="{{ route('records.create') }}">Añadir otro Antecedente</a>
    </div>

    <div class="card">
        <div class="card-header">
            <h1>Detalles del Antecedente</h1>
        </div>
        <div class="card-body">
            <h4>Fecha de Registro</h4>
            <p>{{ $record->date_in }}</p>

            <h4>Propietario</h4>
            <ul class="list-group">
                <li class="list-group-item">
                    <strong>Nombre: </strong>{{ $record->vehicle->owner->name }}
                </li>
                <li class="list-group-item">
                    <strong>Teléfono: </strong>{{ $record->vehicle->owner->phone }}
                </li>
                <li class="list-group-item">
                    <strong>Correo: </strong>{{ $record->vehicle->owner->email }}
                </li>
            </ul>

            <h4>Vehículo</h4>
            <ul class="list-group">
                <li class="list-group-item">
                    <strong>Marca: </strong>{{ $record->vehicle->vehicle_model->brand->name }}
                </li>
                <li class="list-group-item">
                    <strong>Modelo: </strong>{{ $record->vehicle->vehicle_model->name }}
                </li>
            </ul>

            <h4>Descripción Corta</h4>
            <p>{{ $record->short_description }}</p>

            <h4>Descripción Larga</h4>
            <p>{{ $record->long_description }}</p>

            {{-- <h4>Imagen Portada</h4>
        <img src="{{ Storage::url('records/' . $record->main_image) }}" alt="Imagen principal" class="img-fluid"> --}}

            <h4>Resto de imágenes</h4>
            <!-- Carrusel de imágenes -->
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

        <div class="card-footer">
            <a class='btn btn-primary' href="{{ route('records.edit', ['record' => $record]) }}">Modificar</a>
            <button id="btndel" class="btn btn-danger">Eliminar</button>
            <form id="formdel" action="{{ route('records.destroy', ['record' => $record]) }}" method="POST"
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
