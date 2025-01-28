@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between mb-3">
        <a class="btn btn-secondary" href="{{ route('vehicles.index') }}">Regresar</a>
    </div>

    <div class="card">
        <div class="card-header">
            <h1>Editar Vehículo</h1>
        </div>

        <div class="card-body">
            <form id="vehicleEditForm" action="{{ route('vehicles.update', ['vehicle' => $vehicle]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-12 col-md-6">
                        <label for="plate" class="form-label">Placa del Vehículo</label>
                        <input name="plate" type="text" class="form-control" id="plate" value="{{ $vehicle->plate }}" required>
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
                    <div class="col-12 col-md-6">
                        <label for="main_image" class="form-label mt-3">Imagen de Portada</label>
                        <input name="main_image" type="file" class="form-control" accept="image/*">
                    </div>
                </div>
                
                <div class="card-body">
                    <button type="submit" class="btn btn-primary" id="submitBtn">GUARDAR</button>
                </div>
            </form>
        </div>
    </div>
@endsection


@push('js')
    <script defer>
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
