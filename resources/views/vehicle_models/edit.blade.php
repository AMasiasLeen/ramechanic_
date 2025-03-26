@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-5">
        <div class="d-flex justify-content-between mb-3">
            <a class="btn btn-secondary btn-sm" href="{{ route('vehicle-models.index') }}">Regresar</a>
        </div>

        <div class="card">
            <div class="card-header p-3">
                <h5 class="mb-0">Editar Modelo</h5>
            </div>
            
            <form action="{{ route('vehicle-models.update', $vehicle_model) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card-body p-3">
                    <div class="row g-2">
                        <!-- Campo Marca -->
                        <div class="col-12">
                            <label for="brand_id" class="form-label">Marca</label>
                            <select name="brand_id" 
                                class="form-control @error('brand_id') is-invalid @enderror" 
                                id="brand_id" 
                                required>
                            </select>
                            @error('brand_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Campo Nombre -->
                        <div class="col-12">
                            <label for="name" class="form-label">Nombre del Modelo</label>
                            <input name="name" 
                                type="text" 
                                class="form-control @error('name') is-invalid @enderror" 
                                id="name" 
                                value="{{ old('name', $vehicle_model->name) }}" 
                                required>
                            @error('name')
                                <div class="invalid-feedback">
                                    @if($message == 'The name has already been taken.')
                                        Este modelo ya existe para la marca seleccionada
                                    @else
                                        {{ $message }}
                                    @endif
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div class="card-footer p-3 d-flex gap-2">
                    <button type="submit" class="btn btn-primary btn-sm px-4">Guardar</button>
                </form>
                    <form method="POST" action="{{ route('vehicle-models.destroy', $vehicle_model) }}">
                        @csrf
                        @method('DELETE')
                        <!-- <button type="button" 
                                class="btn btn-danger btn-sm btndel" 
                                data-id="{{ $vehicle_model->id }}">
                            Eliminar
                        </button> -->
                    </form>
                </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script defer>
    window.onload = () => {
        // Configuración de Select2 con valor actual
        const initialBrand = {
            id: "{{ $vehicle_model->brand_id }}",
            text: "{{ $vehicle_model->brand->name }}"
        };

        $("#brand_id").select2({
            theme: "bootstrap-5",
            width: "100%",
            ajax: {
                url: "{{ route('brands.index') }}"
            },
            placeholder: "Buscar marca...",
            data: [initialBrand] // Precarga el valor actual
        });

        // Eliminación con confirmación
        $('.btndel').click(function() {
            const model_id = $(this).data("id");
            Swal.fire({
                title: "¿Eliminar modelo?",
                text: "¡Esta acción es permanente!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                confirmButtonText: "Sí, eliminar",
                cancelButtonText: "Cancelar"
            }).then((result) => {
                if (result.isConfirmed) {
                    $(this).closest('form').submit();
                }
            });
        });
    }
</script>
@endpush