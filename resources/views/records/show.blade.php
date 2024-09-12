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
                {{-- <strong>Nombre: </strong>{{ $record->owner->name }} --}}
            </li>
            <li class="list-group-item">
                {{-- <strong>Teléfono: </strong>{{ $record->owner->phone }} --}}
            </li>
            <li class="list-group-item">
                {{-- <strong>Correo: </strong>{{ $record->owner->email }} --}}
            </li>
        </ul>

        <h4>Vehículo</h4>
        <ul class="list-group">
            <li class="list-group-item">
                {{-- <strong>Marca: </strong>{{ $record->vehicle->brand->name }} --}}
            </li>
            <li class="list-group-item">
                {{-- <strong>Modelo: </strong>{{ $record->vehicle->model }} --}}
            </li>
        </ul>

        <h4>Descripción Corta</h4>
        <p>{{ $record->short_description }}</p>

        <h4>Descripción Larga</h4>
        <p>{{ $record->long_description }}</p>

        <h4>Imagen Portada</h4>
        <img src="{{ $record->main_image }}" alt="Imagen principal" class="img-fluid">

        <h4>Resto de imágenes</h4>
        <div class="row">
            @foreach(explode(',', $record->images) as $image)
                <div class="col-3">
                    <img src="{{ $image }}" alt="Imagen secundaria" class="img-fluid">
                </div>
            @endforeach
        </div>
    </div>
    <div class="card-footer">
        <a class='btn btn-primary' href="{{ route('records.edit', ['record' => $record]) }}">Modificar</a>
        <button id="btndel" class="btn btn-danger">Eliminar</button>
        <form id="formdel" action="{{ route('records.destroy', ['record'=>$record]) }}" method="POST" style="display:inline;">
            @csrf
            @method("DELETE") 
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
                }).then((result)=>{
                    if(result.value){
                        $('#formdel').submit();
                    }
                })
            })
        }
    </script>
@endpush