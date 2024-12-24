@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between mb-3">
        <a class="btn btn-secondary" href="{{ route('vehicles.index') }}">Regresar</a>
        {{-- <a class="btn btn-success" href="{{ route('vehicles.create') }}">Agregar Nuevo</a> --}}
    </div>

    <div class="card">
        <div class="card-header">
            <h1>Editar Vehículo</h1>
        </div>
        <div class="card-body">
            <form action="{{ route('vehicles.update', ['vehicle' => $vehicle]) }}" method="POST"  enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="plate" class="form-label">Placa del Vehículo</label>
                    <input name="plate" type="text" class="form-control" id="plate" value="{{ $vehicle->plate }}"
                        required>

                    <label for="owner_id" class="form-label">Propietario</label>
                    <select name="owner_id" class="form-control" id="owner_id">
                        <option value="{{ $vehicle->owner->id }}">
                            {{ $vehicle->owner->name }}
                        </option>
                    </select>

                    <label for="vehicle_model_id" class="form-label">Modelo y Marca del Vehículo</label>
                    <select name="vehicle_model_id" class="form-control" id="vehicle_model_id">
                        <option value="{{ $vehicle->vehicle_model->id }}">
                            {{ $vehicle->vehicle_model->name }} - {{ $vehicle->vehicle_model->brand->name }}
                        </option>
                    </select>

                    <label for="engine_serial" class="form-label">Serie del Motor</label>
                    <input name="engine_serial" type="text" class="form-control" id="engine_serial"
                        value="{{ $vehicle->engine_serial }}" required>

                    <label for="serial_number" class="form-label">Número de Serie</label>
                    <input name="serial_number" type="text" class="form-control" id="serial_number"
                        value="{{ $vehicle->serial_number }}" required>

                    <label for="color" class="form-label">Color</label>
                    <input name="color" type="text" class="form-control" id="color" value="{{ $vehicle->color }}"
                        required>

                        
                    <label for="main_image" class="form-label mt-3">Imagen de Portada</label>
                    <input name="main_image" type="file" class="form-control" accept="image/*" required>

                </div>
        </div>
        <div class="card-footer">
            <button class='btn btn-primary' type="submit">Guardar</button>
            </form>
            {{-- <button id="btndel" class="btn btn-danger">Eliminar</button> --}}
            <form id="formdel" action="{{ route('vehicles.destroy', ['vehicle' => $vehicle]) }}" method="POST"
                style="display:inline;">
                @csrf
                @method('DELETE')
            </form>
        </div>
    </div>
@endsection

@push('js')
    <script defer>
        window.onload = () => {
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
