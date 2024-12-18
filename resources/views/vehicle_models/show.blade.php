@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <a class="btn btn-secondary" href="{{ route('vehicle-models.index') }}">Regresar</a>
    <a class="btn btn-success" href="{{ route('vehicle-models.create') }}">Agregar Nuevo</a>
</div>

<div class="card">
    <div class="card-header">
        <h1>Modelo de Vehículo</h1>
    </div>
    <div class="card-body">
        <h4>Modelo</h4>
        <h3>{{ $vehicle_model->name }}</h3>
        <h4>Marca</h4>
        <h3>{{ $vehicle_model->brand->name }}</h3>
    </div>
    <div class="card-footer">
        <a class='btn btn-primary' href="{{ route('vehicle-models.edit', ['vehicle_model' => $vehicle_model]) }}">Modificar</a>
        <button id="btndel" class="btn btn-danger">Eliminar</button>
        <form id="formdel" action="{{ route('vehicle-models.destroy', ['vehicle_model'=>$vehicle_model]) }}" method="POST" style="display:inline;">
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