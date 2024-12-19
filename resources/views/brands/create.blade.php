@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between mb-3">
        <a class="btn btn-secondary" href="{{ route('brands.index') }}">Regresar</a>
    </div>

    <div class="card">
        <div class="card-header">
            <h1>Agregar Nuevo</h1>
        </div>
        <div class="card-body">
            <form id="brandForm" action="{{ route('brands.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nombre de la Marca</label>
                    <input name="name" type="text" class="form-control" id="name" required>
                </div>
                <button type="submit" class="btn btn-primary" id="submitBtn">GUARDAR</button>
            </form>
        </div>
    </div>
@endsection

@push('js')
    <script defer>
        window.onload = () => {
            const form = document.getElementById('brandForm');
            const submitBtn = document.getElementById('submitBtn');

            submitBtn.addEventListener('click', function (event) {
                event.preventDefault(); // Evita el envío del formulario inmediato

                let isValid = true;

                // Validar campo requerido
                form.querySelectorAll('[required]').forEach(input => {
                    if (!input.value.trim()) {
                        isValid = false;
                    }
                });

                if (!isValid) {
                    Swal.fire({
                        title: "Datos incompletos",
                        text: "Por favor, complete el campo 'Nombre de la Marca' antes de guardar.",
                        icon: "warning",
                        confirmButtonText: "Entendido"
                    });
                } else {
                    form.submit(); // Enviar el formulario si es válido
                }
            });
        }
    </script>
@endpush
