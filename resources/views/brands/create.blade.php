@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-5">
        <div class="d-flex justify-content-between mb-3">
            <a class="btn btn-secondary" href="{{ route('brands.index') }}">Regresar</a>
        </div>
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Agregar Nuevo</h5>
            </div>
            <div class="card-body p-3">
                <form id="brandForm" action="{{ route('brands.store') }}" method="POST">
                    @csrf
                    <div class="row g-2">
                        <div class="col-12">
                            <label for="name" class="form-label">Nombre de Marca</label>
                            <input name="name" type="text"
                                class="form-control form-control-sm @error('name') is-invalid @enderror"
                                id="name"
                                value="{{ old('name') }}"
                                required>

                            @error('name')
                            <div class="invalid-feedback">
                                @if($message == 'The name has already been taken.')
                                La marca ya se encuentra registrada
                                @else
                                {{ $message }}
                                @endif
                            </div>
                            @enderror
                        </div>
                        <div class="col-12 mt-2">
                            <button type="submit" class="btn btn-primary btn-sm px-4" id="submitBtn">GUARDAR</button>
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
        const form = document.getElementById('brandForm');
        const submitBtn = document.getElementById('submitBtn');

        submitBtn.addEventListener('click', function(event) {
            event.preventDefault();
            
            // Limpiar errores anteriores
            form.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
            
            let isValid = true;
            
            // Validación de campo vacío
            const nameInput = document.getElementById('name');
            if (!nameInput.value.trim()) {
                nameInput.classList.add('is-invalid');
                isValid = false;
            }

            if (!isValid) {
                Swal.fire({
                    title: "Datos incompletos",
                    text: "Por favor, complete el campo requerido",
                    icon: "warning"
                });
            } else {
                form.submit();
            }
        });
    }
</script>
@endpush