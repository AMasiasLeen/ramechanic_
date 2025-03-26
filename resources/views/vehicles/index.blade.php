@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="d-flex justify-content-between mb-3">
            <h1>Vehículos Registrados</h1>
            <a class="btn btn-success btn-sm align-self-center" href="{{ route('vehicles.create') }}"> Agregar Nuevo</a>
        </div>

        @include('vehicles.filters')

        @if($vehicles->isNotEmpty())
        <div class="table-responsive">
            <table class="table table-borderless table-hover align-middle">
                <thead class="border-bottom">
                    <tr>
                        <th>Propietario</th>
                        <th>Placa</th>
                        <th>Marca</th>
                        <th>Modelo</th>
                        <th>Color</th>
                        <th>Número Serie</th>
                        <th>Número Motor</th>
                        <th class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($vehicles as $vehicle)
                        @if($vehicle->owner && $vehicle->owner->name)
                        <tr class="border-bottom">
                            <td>{{ $vehicle->owner->name }}</td>
                            <td>{{ $vehicle->plate }}</td>
                            <td>{{ $vehicle->vehicle_model->brand->name ?? 'N/A' }}</td>
                            <td>{{ $vehicle->vehicle_model->name ?? 'N/A' }}</td>
                            <td>{{ $vehicle->color }}</td>
                            <td>{{ $vehicle->serial_number }}</td>
                            <td>{{ $vehicle->engine_serial }}</td>
                            <td class="text-end">
                                <div class="d-inline-flex gap-3">
                                    @if (Auth::user()->hasRole('administrador') || Auth::user()->hasRole('mecanico'))
                                    <a href="{{ route('vehicles.show', $vehicle) }}" 
                                       class="text-primary text-decoration-none">
                                        Ver
                                    </a>
                                    @endif
                                    
                                    @if (Auth::user()->hasRole('administrador'))
                                    <a href="{{ route('vehicles.edit', $vehicle) }}" 
                                       class="text-warning text-decoration-none">
                                        Editar
                                    </a>
                                    
                                    <form id="formdel{{ $vehicle->id }}" 
                                          action="{{ route('vehicles.destroy', $vehicle) }}" 
                                          method="POST"
                                          class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" 
                                                class="text-danger border-0 bg-transparent p-0 btndel" 
                                                data-id="{{ $vehicle->id }}">
                                            Eliminar
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="alert alert-info text-center">
            No se encontraron vehículos registrados
        </div>
        @endif

        <div class="d-flex justify-content-center mt-4">
            {{ $vehicles->appends(request()->query())->links('pagination::bootstrap-4') }}
        </div>
    </div>
</div>
@endsection

@push('css')
<style>
    .table-hover tr:hover {
        background-color: #f8f9fa;
    }
    .border-bottom {
        border-color: #dee2e6!important;
    }
    .table td, .table th {
        vertical-align: middle;
    }
</style>
@endpush


@push('js')
    <script defer>

        window.onload = () => {
        $('.btndel').click(function() {
            const model_id = $(this).data("id");
            const form = $('#formdel' + model_id);
            const brandName = $(this).closest('tr').find('td:eq(2)').text(); // Obtiene el nombre desde la tabla

            Swal.fire({
                title: "¿Eliminar marca?",
                text: `Esta acción eliminará permanentemente "${brandName}"`,
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Sí, eliminar",
                cancelButtonText: "Cancelar"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: form.attr('action'),
                        method: 'POST',
                        data: form.serialize(),
                        success: function() {
                            window.location.reload();
                        },
                        error: function(xhr) {
                            let errorMessage = xhr.status === 409 
                                ? xhr.responseJSON.message 
                                : `El vehículo "${brandName}" está vinculada a un registro y no puede eliminarse`;

                            Swal.fire({
                                title: "Error",
                                text: errorMessage,
                                icon: "error",
                                confirmButtonText: "Entendido"
                            });
                        }
                    });
                }
            });
        });
    }
    </script>
@endpush
