@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between mb-3">
        <a class="btn btn-secondary" href="{{ route('records.index') }}">Regresar</a>
        <a class="btn btn-success" href="{{ route('records.create') }}">Añadir Otro Antecedente</a>
    </div>

    <div class="card">
        <div class="card-header">
            <h1>Editar Antecedente</h1>
        </div>
        <div class="card-body">
            <form action="{{ route('records.update', ['record' => $record]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="date_in" class="form-label mt-3">Fecha de Registro</label>
                    <input name="date_in" type="date" class="form-control" id="date_in" value="{{ $record->date_in }}"
                        required>

                    <label for="owner_id" class="form-label mt-3">Propietario</label>
                    <select name="owner_id" class="form-control" id="owner_id"
                        data-selected-owner="{{ $record->owner_id }}"></select>

                    <ul id="owner-details" class="list-group mt-3">
                        <li class="list-group-item">
                            <strong>Nombre: </strong><span
                                id="sp-owner-name">{{ $record->vehicle->owner->name ?? '' }}</span>
                        </li>
                        <li class="list-group-item">
                            <strong>Teléfono: </strong><span
                                id="sp-owner-phone">{{ $record->vehicle->owner->phone ?? '' }}</span>
                        </li>
                        <li class="list-group-item">
                            <strong>Correo: </strong><span
                                id="sp-owner-email">{{ $record->vehicle->owner->email ?? '' }}</span>
                        </li>
                    </ul>

                    <label for="vehicle_id" class="form-label mt-3">Vehículo</label>
                    <select name="vehicle_id" class="form-control" id="vehicle_id"
                        data-selected-vehicle="{{ $record->vehicle_id }}"></select>

                    <ul id="vehicle-details" class="list-group mt-3">
                        <li class="list-group-item">
                            <strong>Marca: </strong><span
                                id="sp-vehicle-brand">{{ $record->vehicle->brand->name ?? '' }}</span>
                        </li>
                        <li class="list-group-item">
                            <strong>Modelo: </strong><span
                                id="sp-vehicle-model">{{ $record->vehicle->model->name ?? '' }}</span>
                        </li>
                    </ul>

                    <label for="short_description" class="form-label mt-3">Descripción Corta</label>
                    <input name="short_description" type="text" class="form-control" id="short_description"
                        value="{{ $record->short_description }}" required>

                    <label for="long_description" class="form-label mt-3">Descripción Larga</label>
                    <input name="long_description" type="text" class="form-control" id="long_description"
                        value="{{ $record->long_description }}" required>

                    <label for="main_image" class="form-label mt-3">Imagen Portada</label>
                    <input name="main_image" type="text" class="form-control" id="main_image"
                        value="{{ $record->main_image }}" required>

                    <label for="images" class="form-label mt-3">Imágenes de Proceso</label>
                    <input name="images[]" type="file" class="form-control" id="images" accept="image/*" multiple required>
                
                </div>
        </div>
        <div class="card-footer">
            <button class='btn btn-primary' type="submit">Modificar</button>
            </form>
            <button id="btndel" class="btn btn-danger">Eliminar</button>
            <form id="formdel" action="{{ route('records.destroy', ['record' => $record]) }}" method="POST"
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
            const selectedOwnerId = $('#owner_id').data('selected-owner');
            const selectedVehicleId = $('#vehicle_id').data('selected-vehicle');

            // Inicialización de select2 para el propietario
            $("#owner_id").select2({
                theme: "bootstrap-5",
                width: "100%",
                ajax: {
                    url: "{{ route('users.index') }}",
                    dataType: 'json',
                    data: (params) => {
                        return {
                            term: params.term
                        };
                    }
                }
            }).val(selectedOwnerId).trigger('change');

            // Inicialización de select2 para el vehículo
            $("#vehicle_id").select2({
                theme: "bootstrap-5",
                width: "100%",
                ajax: {
                    url: "{{ route('vehicles.index') }}",
                    dataType: 'json',
                    data: (params) => {
                        return {
                            owner_id: selectedOwnerId,
                            term: params.term
                        };
                    }
                }
            }).val(selectedVehicleId).trigger('change');

            // Cambiar propietario y actualizar detalles
            $("#owner_id").on("change", function() {
                const ownerId = $(this).val();
                updateOwnerDetails(ownerId);
                updateVehicleOptions(ownerId);
            });

            // Cambiar vehículo y actualizar detalles
            $("#vehicle_id").on("change", function() {
                const vehicleId = $(this).val();
                updateVehicleDetails(vehicleId);
            });

            // Actualizar detalles del propietario
            const updateOwnerDetails = (ownerId) => {
                axios.get("{{ url('users') }}/" + ownerId).then(res => {
                    const owner = res.data;
                    $("#sp-owner-name").text(owner.name || '');
                    $("#sp-owner-phone").text(owner.phone || '');
                    $("#sp-owner-email").text(owner.email || '');
                }).catch(err => console.error("Error obteniendo los datos del propietario:", err));
            };

            // Actualizar opciones de vehículos para el propietario
            const updateVehicleOptions = (ownerId) => {
                $("#vehicle_id").select2({
                    theme: "bootstrap-5",
                    width: "100%",
                    ajax: {
                        url: "{{ route('vehicles.index') }}",
                        dataType: 'json',
                        data: (params) => {
                            return {
                                owner_id: ownerId,
                                term: params.term
                            };
                        }
                    }
                });
            };

            // Actualizar detalles del vehículo
            const updateVehicleDetails = (vehicleId) => {
                axios.get("{{ url('vehicles') }}/" + vehicleId).then(res => {
                    const vehicle = res.data;
                    $("#sp-vehicle-brand").text(vehicle.vehicle_model?.brand?.name || '');
                    $("#sp-vehicle-model").text(vehicle.vehicle_model?.name || '');
                }).catch(err => console.error("Error obteniendo los datos del vehículo:", err));
            };

            // Inicializar detalles del propietario y vehículo en carga de la página
            if (selectedOwnerId) updateOwnerDetails(selectedOwnerId);
            if (selectedVehicleId) updateVehicleDetails(selectedVehicleId);
        };
    </script>
@endpush
