@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between mb-3">
        <a class="btn btn-secondary" href="{{ route('vehicle-models.index') }}">Regresar</a>
    </div>

    <div class="card">
        <div class="card-header">
            <h1>Agregar Nuevo</h1>
        </div>
        <div class="card-body">
            <form id="vehicleModelForm" action="{{ route('vehicle-models.store') }}" method="POST">
                @csrf
                <div class="mb-3">

                    <label for="brand_id">Marca</label>
                    <select name="brand_id" class="form-control" id="brand_id" required></select>

                    <label for="name" class="form-label">Nombre del Modelo de Vehículo:</label>
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
            // Inicializa select2 para la marca
            $("#brand_id").select2({
                theme: "bootstrap-5",
                width: "100%",
                ajax: {
                    url: "{{route('brands.index')}}"
                },
                placeholder: "Seleccione una marca",
            })

            const form = document.getElementById('vehicleModelForm');
            const submitBtn = document.getElementById('submitBtn');

            // Validación de datos
            submitBtn.addEventListener('click', function (event) {
                event.preventDefault(); // Evita el envío del formulario inmediato

                let isValid = true;

                // Validar que el select y el campo de texto estén completos
                if (!$("#brand_id").val()) {
                    isValid = false;
                }
                form.querySelectorAll('[required]').forEach(input => {
                    if (!input.value.trim()) {
                        isValid = false;
                    }
                });

                if (!isValid) {
                    Swal.fire({
                        title: "Datos incompletos",
                        text: "Por favor, complete todos los campos requeridos antes de guardar.",
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
