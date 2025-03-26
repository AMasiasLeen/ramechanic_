@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between mb-4">
        <h1>Listado de Marcas</h1>
        <a class="btn btn-success btn-sm align-self-center" href="{{ route('brands.create') }}">Agregar Nuevo</a>
    </div>

    @include('brands.filters')

    @if($brands->isNotEmpty())
    <div class="table-responsive">
        <table class="table table-borderless table-hover align-middle">
            <thead class="border-bottom">
                <tr>
                    <th>ID</th>
                    <th>Marcas</th>
                    <th class="text-end">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($brands as $brand)
                    <tr class="border-bottom">
                        <td>{{ $brand->id }}</td>
                        <td>{{ $brand->name }}</td>
                        <td class="text-end">
                            <div class="d-inline-flex gap-3">
                                <!-- Ver -->
                                <a href="{{ route('brands.show', $brand) }}" 
                                   class="text-primary text-decoration-none">
                                    Ver
                                </a>
                                
                                <!-- Editar -->
                                <a href="{{ route('brands.edit', $brand) }}" 
                                   class="text-warning text-decoration-none">
                                    Editar
                                </a>
                                
                                <!-- Eliminar -->
                                <form id="formdel{{ $brand->id }}"
                                    action="{{ route('brands.destroy', ['brand' => $brand]) }}" method="POST"
                                    class="d-inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" 
                                            class="text-danger border-0 bg-transparent p-0 btndel" 
                                            data-id="{{ $brand->id }}">
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
        No se encontraron marcas.
    </div>
@endif
    
    <div class="d-flex justify-content-center mt-4">
        {{ $brands->links('pagination::bootstrap-4') }}
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
            const brand_id = $(this).data("id");
            const form = $('#formdel' + brand_id);
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
                                : `La marca "${brandName}" está vinculada a modelos de vehículo y no puede eliminarse`;

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

