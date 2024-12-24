@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between mb-3">
        <a class="btn btn-secondary" href="{{ route('vehicle-models.index') }}">Regresar</a>
        {{-- <a class="btn btn-success" href="{{ route('vehicle-models.create') }}">Agregar Nuevo</a> --}}
    </div>

    <div class="card">
        <div class="card-header">
            <h1>Editar Modelo</h1>
        </div>
        <div class="card-body">
            <form action="{{ route('vehicle-models.update', ['vehicle_model' => $vehicle_model]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">

                    <label for="brand_id">Marca</label>
                    <select name="brand_id" class="form-control" id="brand_id" ></select>
                    

                    <label for="name" class="form-label">Nombre del Modelo de Vehículo</label>
                    <input name="name" type="text" class="form-control" id="name"
                        value="{{ $vehicle_model->name }}" required>
                </div>
        </div>
        <div class="card-footer">
            <button class='btn btn-primary' type="submit">Guardar</button>
        </form>
            {{-- <button id="btndel" class="btn btn-danger">Eliminar</button> --}}
            <form id="formdel" action="{{ route('vehicle-models.destroy', ['vehicle_model' => $vehicle_model]) }}"
                method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
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

            $("#brand_id").select2({
                theme: "bootstrap-5",
                width: "100%",
                ajax: {
                    url: "{{ route('brands.index') }}"
                },
                placeholder: "{{ $vehicle_model->brand->name }}",
            })
        }
    </script>
@endpush
