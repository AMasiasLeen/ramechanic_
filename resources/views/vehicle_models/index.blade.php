@extends('layouts.app')

@section('content')

    <div class="d-flex justify-content-between mb-4">
        <h1>Listado de Modelos de Vehículos</h1>
        <a class="btn btn-success" href="{{ route('vehicle-models.create') }}">Agregar Nuevo Modelo</a>
    </div>

    @include('vehicle_models.filters')

    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Modelos</th>
                    <th>Marca</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($vehicle_models as $vehicle_model)
                    <tr>
                        <td>{{ $vehicle_model->id }}</td>
                        <td>{{ $vehicle_model->name }}</td>
                        <td>{{ $vehicle_model->brand->name }}</td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Acciones">
                                <a class="btn btn-outline-warning btn-sm" href="{{ route('vehicle-models.edit', ['vehicle_model' => $vehicle_model]) }}">Editar</a>
                                
                                <form id="formdel{{ $vehicle_model->id }}" action="{{ route('vehicle-models.destroy', ['vehicle_model' => $vehicle_model]) }}" method="POST" class="d-inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-outline-danger btn-sm btndel" type="button" data-id="{{ $vehicle_model->id }}">Eliminar</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-center mt-4">
        {{ $vehicle_models->links('pagination::bootstrap-4') }}
    </div>

@endsection

@push('js')
    <script defer>
        window.onload = () => {
            $('.btndel').click(function() {
                    console.log(this)
                    const model_id = $(this).data("id")
                Swal.fire({
                    title: "Esta seguro de eliminar",
                    text: "Esta accion no se puede deshacer",
                    icon: "warning",
                    showCancelButton: true
                }).then((result)=>{
                    if(result.value){
                        $('#formdel'+model_id).submit();
                    }
                })
            })
        }
    </script>
@endpush