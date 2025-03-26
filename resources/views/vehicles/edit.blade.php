

@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="d-flex justify-content-between mb-3">
            <a class="btn btn-secondary btn-sm" href="{{ route('vehicles.index') }}">Regresar</a>
        </div>

        <div class="card">
            <div class="card-header p-3">
                <h5 class="mb-0">Editar Vehículo</h5>
            </div>

            <div class="card-body p-3">
                <form id="vehicleEditForm" action="{{ route('vehicles.update', $vehicle) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    
                    <div class="row">
                    <div class="col-12 col-md-6">
                        <label for="plate" class="form-label">Placa del Vehículo</label>
                        <input name="plate" type="text" class="form-control" id="plate" value="{{ $vehicle->plate }}" required>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="year" class="form-label">Año del Vehículo</label>
                        <input name="year" type="number" class="form-control" id="year" min="1900" value="{{ $vehicle->year }}" required>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-12 col-md-6">
                        <label for="owner_id" class="form-label">Propietario</label>
                        <select name="owner_id" class="form-control" id="owner_id" required>
                            <option value="{{ $vehicle->owner->id }}">
                                {{ $vehicle->owner->name }}
                            </option>
                        </select>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="vehicle_model_id" class="form-label">Modelo y Marca del Vehículo</label>
                        <select name="vehicle_model_id" class="form-control" id="vehicle_model_id" required>
                            <option value="{{ $vehicle->vehicle_model->id }}">
                                {{ $vehicle->vehicle_model->name }} - {{ $vehicle->vehicle_model->brand->name }}
                            </option>
                        </select>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-12 col-md-6">
                        <label for="engine_serial" class="form-label">Serie del Motor</label>
                        <input name="engine_serial" type="text" class="form-control" id="engine_serial" value="{{ $vehicle->engine_serial }}" >
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="serial_number" class="form-label">Número de Serie</label>
                        <input name="serial_number" type="text" class="form-control" id="serial_number" value="{{ $vehicle->serial_number }}" >
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-12 col-md-6">
                        <label for="color" class="form-label">Color</label>
                        <input name="color" type="text" class="form-control" id="color" value="{{ $vehicle->color }}" >
                    </div>

                        <!-- Sección de imagen -->
                        <div class="col-12 col-md-6">
                            <label for="main_image" class="form-label">Imagen</label>
                            <input name="main_image" type="file" 
                                   class="form-control @error('main_image') is-invalid @enderror" 
                                   id="main_image"
                                   accept="image/*">

                            <!-- Vista previa nueva imagen -->
                            <div class="mt-2" id="newPreviewContainer" style="display: none;">
                                <img id="newImagePreview" class="img-fluid mb-2" style="max-height: 200px">
                                <button type="button" class="btn btn-danger btn-sm w-100" onclick="removeNewImage()">
                                    Quitar nueva imagen
                                </button>
                            </div>

                            <!-- Imagen existente -->
                            @if($vehicle->main_image)
                            <div class="mt-3">
                                <div class="position-relative">
                                    <img src="{{ asset('storage/vehicles/' . $vehicle->main_image) }}" 
                                         class="img-fluid rounded mb-2" 
                                         style="max-height: 200px">
                                    <button type="button" 
                                            class="btn btn-danger btn-sm" 
                                            onclick="deleteExistingImage()">
                                        Eliminar imagen actual
                                    </button>
                                </div>
                            </div>
                            @endif

                            @error('main_image')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary btn-sm px-4" id="submitBtn">Guardar cambios</button>
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
            const preview = document.getElementById('newImagePreview');
            const container = document.getElementById('newPreviewContainer');
            
            reader.onload = function(e) {
                preview.src = e.target.result;
                container.style.display = 'block';
            }
            reader.readAsDataURL(this.files[0]);
        }
    });

    function removeNewImage() {
        document.getElementById('main_image').value = '';
        document.getElementById('newPreviewContainer').style.display = 'none';
        document.getElementById('newImagePreview').src = '';
    }

    // Eliminar imagen existente
    function deleteExistingImage() {
        Swal.fire({
            title: '¿Eliminar imagen permanente?',
            text: "Esta acción no se puede deshacer",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sí, eliminar'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch("{{ route('vehicles.delete-image', $vehicle) }}", {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    }
                }).then(response => {
                    if (response.ok) {
                        window.location.reload();
                    }
                });
            }
        });
    }
        window.onload = () => {

            const form = document.getElementById('vehicleEditForm');
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


            $("#owner_id").select2({
                theme: "bootstrap-5",
                width: "100%",
                ajax: {
                    url: "{{ route('users.index') }}",
                },
            });

            $("#vehicle_model_id").select2({
                theme: "bootstrap-5",
                width: "100%",
                ajax: {
                    url: "{{ route('vehicle-models.index') }}",
                    dataType: 'json',
                    data: (params) => {
                        const query = {
                            brand_id: $("#brand_id").val(),
                            term: params.term
                        }
                        return query
                    }
                },
            });
        }
    </script>
@endpush
