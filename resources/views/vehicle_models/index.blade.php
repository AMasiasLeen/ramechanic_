@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    
    <div class="d-flex justify-content-between mb-4">
        <h1>Listado de Modelos</h1>
        <a class="btn btn-success btn-sm align-self-center" href="{{ route('vehicle-models.create') }}">Agregar Nuevo</a>
    </div>
    
    @include('vehicle_models.filters')
    
    @if($vehicle_models->isNotEmpty())
        <div class="table-responsive">
            <table class="table table-borderless table-hover align-middle">
                <thead class="border-bottom">
                    <tr>
                        <th>ID</th>
                        <th>Modelo</th>
                        <th>Marca</th>
                        <th class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($vehicle_models as $vehicle_model)
                        <tr class="border-bottom">
                            <td>{{ $vehicle_model->id }}</td>
                            <td>{{ $vehicle_model->name }}</td>
                            <td>{{ $vehicle_model->brand->name }}</td>
                            <td class="text-end">
                                <div class="d-inline-flex gap-3">
                                    <!-- Ver -->
                                    <a href="{{ route('vehicle-models.show', $vehicle_model) }}" 
                                       class="text-primary text-decoration-none">
                                        Ver
                                    </a>
                                    
                                    <!-- Editar -->
                                    <a href="{{ route('vehicle-models.edit', $vehicle_model) }}" 
                                       class="text-warning text-decoration-none">
                                        Editar
                                    </a>
                                    
                                    <!-- Eliminar -->
                                    <form id="formdel{{ $vehicle_model->id }}" 
                                          action="{{ route('vehicle-models.destroy', $vehicle_model) }}" 
                                          method="POST"
                                          class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" 
                                                class="text-danger border-0 bg-transparent p-0 btndel" 
                                                data-id="{{ $vehicle_model->id }}">
                                            Eliminar
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="alert alert-info text-center">
            No se encontraron modelos registrados
        </div>
        @endif
        
        <div class="d-flex justify-content-center mt-4">
            {{ $vehicle_models->links('pagination::bootstrap-4') }}
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
</style>
@endpush

@push('js')
<script defer>
    window.onload = () => {
        $('.btndel').click(function() {
            const model_id = $(this).data("id");
            const form = $('#formdel' + model_id);
            const brandName = $(this).closest('tr').find('td:eq(1)').text(); // Obtiene el nombre desde la tabla

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
                                : `El modelo "${brandName}" está vinculada a un vehículo y no puede eliminarse`;

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