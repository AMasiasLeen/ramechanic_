@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between mb-4">
        <h1>Vehículos Registrados</h1>
        <a class="btn btn-success" href="{{ route('vehicles.create') }}">Agregar Nuevo Vehículo</a>
    </div>

    @include('vehicles.filters')

    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Propietario</th>
                    <th>Placa</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Color</th>
                    <th>Número Serie</th>
                    <th>Número Motor</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($vehicles as $vehicle)
                    <tr>
                        <td>{{ $vehicle->id }}</td>
                        <td>{{ $vehicle->owner->name }}</td>
                        <td>{{ $vehicle->plate }}</td>
                        <td>{{ $vehicle->vehicle_model->brand->name }}</td>
                        <td>{{ $vehicle->vehicle_model->name }}</td>
                        <td>{{ $vehicle->color }}</td>
                        <td>{{ $vehicle->serial_number }}</td>
                        <td>{{ $vehicle->engine_serial }}</td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Acciones">
                                <a class="btn btn-outline-warning btn-sm" href="{{ route('vehicles.edit', ['vehicle' => $vehicle]) }}">Editar</a> 
                                <form id="formdel{{ $vehicle->id }}" action="{{ route('vehicles.destroy', ['vehicle' => $vehicle]) }}" method="POST" class="d-inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-outline-danger btn-sm btndel" type="button" data-id="{{ $vehicle->id }}">Eliminar</button>
                                </form>

                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@push('js')
    <script defer>
        window.onload = () => {
            $('.btndel').click(function() {
                const model_id = $(this).data("id");
                Swal.fire({
                    title: "¿Está seguro de eliminar?",
                    text: "Esta acción no se puede deshacer",
                    icon: "warning",
                    showCancelButton: true
                }).then((result) => {
                    if (result.value) {
                        $('#formdel' + model_id).submit();
                    }
                });
            });
        }
    </script>
@endpush
