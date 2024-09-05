@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between mb-3">
        <a class="btn btn-secondary" href="{{ route('vehicle-models.index') }}">Regresar</a>
        <a class="btn btn-success" href="{{ route('vehicle-models.create') }}">Añadir otro registro</a>
    </div>

    <div class="card">
        <div class="card-header">
            <h1>Editar Modelo</h1>
        </div>
        <div class="card-body">
            <form action="{{ route('vehicle-models.update', ['vehicle_model'=>$vehicle_model]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="name" class="form-label">Nombre del Modelo de Vehículo</label>
                    <input name="name" type="text" class="form-control" id="name" value="{{ $vehicle_model->name }}" required>
                </div>
                <button type="submit" class="btn btn-primary">ACTUALIZAR</button>
            </form>
            <form id="formdel{{$vehicle_model->id}}" action="{{ route('vehicle-models.destroy', ['vehicle_model'=>$vehicle_model]) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="button" class="btn btn-danger btndel" data-id="{{$vehicle_model->id}}">ELIMINAR</button>
            </form>
        </div>
    </div>

@endsection

@push('js')
<script defer>
    window.onload = () => {
        $('.btndel').click(function() {
            const model_id = $(this).data("id");
            Swal.fire({
                title: "¿Está seguro de eliminar?",
                text: "Esta acción no se puede deshacer.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#formdel' + model_id).submit();
                }
            });
        });
    }
</script>
@endpush