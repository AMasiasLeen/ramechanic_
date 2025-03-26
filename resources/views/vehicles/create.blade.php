@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="d-flex justify-content-between mb-3">
            <a class="btn btn-secondary btn-sm" href="{{ route('vehicles.index') }}">Regresar</a>
        </div>

        <div class="card">
            <div class="card-header p-3">
                <h5 class="mb-0">Registrar Nuevo Vehículo</h5>
            </div>

            <div class="card-body p-3">
                <form id="vehicleForm" action="{{ route('vehicles.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row g-3">
                        <!-- Placa -->
                        <div class="col-12 col-md-6">
                            <label for="plate" class="form-label">Placa</label>
                            <input name="plate" type="text"
                                class="form-control @error('plate') is-invalid @enderror"
                                id="plate"
                                value="{{ old('plate') }}"
                                required>
                            @error('plate')
                            <div class="invalid-feedback">
                                {{ $message == 'The plate has already been taken.' ? 'Esta placa ya está registrada' : $message }}
                            </div>
                            @enderror
                        </div>

                        <!-- Año -->
                        <div class="col-12 col-md-6">
                            <label for="year" class="form-label">Año</label>
                            <input name="year" type="number"
                                class="form-control @error('year') is-invalid @enderror"
                                id="year"
                                min="1900"
                                max="{{ date('Y') + 1 }}"
                                value="{{ old('year') }}"
                                required>
                            @error('year')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Propietario -->
                        <div class="col-12 col-md-6">
                            <label for="owner_id" class="form-label">Propietario</label>
                            <select name="owner_id"
                                class="form-control @error('owner_id') is-invalid @enderror"
                                id="owner_id"
                                required></select>
                            @error('owner_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Modelo -->
                        <div class="col-12 col-md-6">
                            <label for="vehicle_model_id" class="form-label">Modelo</label>
                            <select name="vehicle_model_id"
                                class="form-control @error('vehicle_model_id') is-invalid @enderror"
                                id="vehicle_model_id"
                                required></select>
                            @error('vehicle_model_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Motor y Chasis -->
                        <div class="col-12 col-md-6">
                            <label for="engine_serial" class="form-label">Serie del Motor</label>
                            <input name="engine_serial" type="text"
                                class="form-control @error('engine_serial') is-invalid @enderror"
                                id="engine_serial"
                                value="{{ old('engine_serial') }}">
                            @error('engine_serial')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-md-6">
                            <label for="serial_number" class="form-label">Serie del Chasis</label>
                            <input name="serial_number" type="text"
                                class="form-control @error('serial_number') is-invalid @enderror"
                                id="serial_number"
                                value="{{ old('serial_number') }}">
                            @error('serial_number')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Color e Imagen -->
                        <div class="col-12 col-md-6">
                            <label for="color" class="form-label">Color</label>
                            <input name="color" type="text"
                                class="form-control @error('color') is-invalid @enderror"
                                id="color"
                                value="{{ old('color') }}">
                            @error('color')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-md-6">
                            <label for="main_image" class="form-label">Imagen</label>
                            <input name="main_image" type="file"
                                class="form-control"
                                id="main_image"
                                accept="image/*">

                            <!-- Vista previa y botón -->
                            <div class="mt-2" id="previewContainer" style="display: none;">
                                <img id="imagePreview" src="#"
                                    class="img-fluid mb-2"
                                    style="max-height: 200px">
                                <button type="button"
                                    class="btn btn-danger btn-sm w-100"
                                    onclick="removeImage()">
                                    Quitar imagen
                                </button>
                            </div>
                        </div>


                        <!-- Botón -->
                        <div class="col-12 mt-4">
                            <button type="submit" class="btn btn-primary btn-sm px-4" id="submitBtn">Guardar</button>
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
    document.getElementById('main_image').addEventListener('change', function(e) {
        if (this.files && this.files[0]) {
            const reader = new FileReader();
            const preview = document.getElementById('imagePreview');
            const container = document.getElementById('previewContainer');

            reader.onload = function(e) {
                preview.src = e.target.result;
                container.style.display = 'block';
            }
            reader.readAsDataURL(this.files[0]);
        }
    });

    // Eliminar imagen
    function removeImage() {
        const input = document.getElementById('main_image');
        const preview = document.getElementById('imagePreview');
        const container = document.getElementById('previewContainer');

        input.value = ''; // Limpia el input de archivo
        preview.src = ''; // Elimina la vista previa
        container.style.display = 'none'; // Oculta el contenedor
    }
    window.onload = () => {


        // Inicializa select2 para "Propietario"
        $("#owner_id").select2({
            theme: "bootstrap-5",
            width: "100%",
            ajax: {
                url: "{{ route('users.index') }}",
            },
            placeholder: "Seleccione un propietario"
        });

        // Inicializa select2 para "Modelo y Marca"
        $("#vehicle_model_id").select2({
            theme: "bootstrap-5",
            width: "100%",
            ajax: {
                url: "{{ route('vehicle-models.index') }}",
            },
            placeholder: "Seleccione un modelo"
        });

        const form = document.getElementById('vehicleForm');
        const submitBtn = document.getElementById('submitBtn');

        submitBtn.addEventListener('click', function(event) {
            event.preventDefault();

            // Validar campos requeridos en el cliente
            let isValid = true;

            form.querySelectorAll('[required]').forEach(input => {
                if (!input.value.trim()) {
                    input.classList.add('is-invalid');
                    isValid = false;
                } else {
                    input.classList.remove('is-invalid');
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
                form.submit(); // Enviar formulario si es válido
            }
        });
    }
</script>
@endpush