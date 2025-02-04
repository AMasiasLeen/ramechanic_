@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between mb-3">
        <a class="btn btn-secondary" href="{{ route('records.index') }}">Regresar</a>
    </div>

    <div class="card">
        <div class="card-header">
            <h1>Editar Antecedente</h1>
        </div>
        <div class="card-body">
            <form id="recordEditForm" action="{{ route('records.update', ['record' => $record]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-12 col-md-6">
                        <label for="date_in" class="form-label mt-3">Fecha de Registro</label>
                        <input name="date_in" type="date" class="form-control" id="date_in" value="{{ $record->date_in }}" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <label for="owner_id" class="form-label mt-3">Propietario</label>
                        <select name="owner_id" class="form-control" id="owner_id" data-selected-owner="{{ $record->owner_id }}"></select>

                        <ul id="owner-details" class="list-group mt-3">
                            <li class="list-group-item"><strong>Nombre: </strong><span id="sp-owner-name">{{ $record->vehicle->owner->name ?? '' }}</span></li>
                            <li class="list-group-item"><strong>Teléfono: </strong><span id="sp-owner-phone">{{ $record->vehicle->owner->phone ?? '' }}</span></li>
                            <li class="list-group-item"><strong>Correo: </strong><span id="sp-owner-email">{{ $record->vehicle->owner->email ?? '' }}</span></li>
                        </ul>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="vehicle_id" class="form-label mt-3">Vehículo</label>
                        <select name="vehicle_id" class="form-control" id="vehicle_id" data-selected-vehicle="{{ $record->vehicle_id }}"></select>

                        <ul id="vehicle-details" class="list-group mt-3">
                            <li class="list-group-item"><strong>Marca: </strong><span id="sp-vehicle-brand">{{ $record->vehicle->brand->name ?? '' }}</span></li>
                            <li class="list-group-item"><strong>Modelo: </strong><span id="sp-vehicle-model">{{ $record->vehicle->model->name ?? '' }}</span></li>
                            <li class="list-group-item"><strong>Año: </strong><span id="sp-vehicle-year">{{ $record->vehicle->year ?? '' }}</span></li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <label for="short_description" class="form-label mt-3">Detalle</label>
                        <input name="short_description" type="text" class="form-control" id="short_description" value="{{ $record->short_description }}" required>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="images" class="form-label mt-3">Imágenes de Proceso</label>
                        <input name="images[]" type="file" class="form-control" id="images" accept="image/*" multiple>
                    </div>
                    
                    <div class="col-12 col-md-6">
                    <h4>Descripción</h4>
                    <textarea name="long_description" class="form-control" id="editor" required>
                            {!! old('long_description', $record->long_description) !!}
                        </textarea>
                    </div>
                
                </div>
                <div class="row">
                    <div class="col-12 col-md-6">
                        
                    </div>
                </div>
                
                <button type="submit" class="btn btn-primary mt-3" id="submitBtn">GUARDAR</button>
            </form>
        </div>
    </div>
@endsection

@push('js')
    <script defer>
        window.onload = () => {
            const selectedOwnerId = $('#owner_id').data('selected-owner');
            const selectedVehicleId = $('#vehicle_id').data('selected-vehicle');
            const form = document.getElementById('recordEditForm');
            const submitBtn = document.getElementById('submitBtn');

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
                    $("#sp-vehicle-year").text(vehicle.year || '');
                }).catch(err => console.error("Error obteniendo los datos del vehículo:", err));
            };

            // Inicializar detalles del propietario y vehículo en carga de la página
            if (selectedOwnerId) updateOwnerDetails(selectedOwnerId);
            if (selectedVehicleId) updateVehicleDetails(selectedVehicleId);
          
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
                    form.submit();
                }
            });

        };
    </script>
    <script src="https://cdn.ckeditor.com/ckeditor5/41.3.1/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#editor'), {
            toolbar: {
                items: [
                    'bold', 'italic', 'underline', 'strikethrough',
                    'bulletedList', 'numberedList',
                    'fontFamily', 'fontSize', 'fontColor', 'fontBackgroundColor',
                    'alignment', 'insertTable', 'horizontalLine'
                ]
            },
            height: '250px'
        })
        .catch(error => console.error(error));
</script>
@endpush
