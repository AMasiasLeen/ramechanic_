@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-5">
        <div class="d-flex justify-content-between mb-3">
            <a class="btn btn-secondary btn-sm" href="{{ route('vehicle-models.index') }}">Regresar</a>
        </div>

        <div class="card">
            <div class="card-header p-3">
                <h5 class="mb-0">Agregar Nuevo Modelo</h5>
            </div>
            
            <div class="card-body p-3">
                <form id="vehicleModelForm" action="{{ route('vehicle-models.store') }}" method="POST">
                    @csrf
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
                                value="{{ old('name') }}" 
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

                        <!-- Botón -->
                        <div class="col-12 mt-3">
                            <button type="submit" class="btn btn-primary btn-sm px-4">GUARDAR</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script defer>
    window.onload = () => {
        // Select2 mantiene su configuración original
        $("#brand_id").select2({
            theme: "bootstrap-5",
            width: "100%",
            ajax: {
                url: "{{ route('brands.index') }}"
            },
            placeholder: "Seleccione una marca",
        });

        // Validación mejorada
        const form = document.getElementById('vehicleModelForm');
        const submitBtn = document.getElementById('submitBtn');

        submitBtn.addEventListener('click', function(event) {
            event.preventDefault();
            
            // Limpiar errores anteriores
            form.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
            
            let isValid = true;
            
            // Validar marca
            const brandSelect = document.getElementById('brand_id');
            if (!brandSelect.value) {
                brandSelect.classList.add('is-invalid');
                isValid = false;
            }

            // Validar nombre
            const nameInput = document.getElementById('name');
            if (!nameInput.value.trim()) {
                nameInput.classList.add('is-invalid');
                isValid = false;
            }

            if (!isValid) {
                Swal.fire({
                    title: "Datos incompletos",
                    text: "Complete todos los campos requeridos",
                    icon: "warning"
                });
            } else {
                form.submit();
            }
        });
    }
</script>
@endpush

{{-- @push('js')
    <script>
        window.onload = () => {
            $("#brand_id").select2({
                theme: "bootstrap-5",
                width: "100%",
                ajax: {
                    url: "{{route('brands.index')}}"
}
})
}


</script>
@endpush --}}