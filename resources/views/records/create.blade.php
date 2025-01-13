@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between mb-3">
        <a class="btn btn-secondary" href="{{ route('records.index') }}">Regresar</a>
    </div>

    <div class="card">
        <div class="card-header">
            <h1>Agregar Nuevo</h1>
        </div>
        <div class="card-body">
            <form id="recordForm" action="{{ route('records.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-12 col-md-6">
                    <label for="date_in" class="form-label mt-3">Fecha de Registro</label>
                    <input name="date_in" type="date" class="form-control" id="date_in" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-6">

                        <label for="owner_id" class="form-label mt-3">Propietario</label>
                        <select name="owner_id" class="form-control" id="owner_id" required></select>

                        <ul id="owner-details" class="list-group mt-3">
                            <li class="list-group-item"><strong>Nombre: </strong><span id="sp-owner-name"></span></li>
                            <li class="list-group-item"><strong>Teléfono: </strong><span id="sp-owner-phone"></span></li>
                            <li class="list-group-item"><strong>Correo: </strong><span id="sp-owner-email"></span></li>
                        </ul>
                    
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="vehicle_id" class="form-label mt-3">Vehículo</label>
                        <select name="vehicle_id" class="form-control" id="vehicle_id" required></select>

                        <ul id="vehicle-details" class="list-group mt-3">
                            <li class="list-group-item"><strong>Marca: </strong><span id="sp-vehicle-brand"></span></li>
                            <li class="list-group-item"><strong>Modelo: </strong><span id="sp-vehicle-model"></span></li>
                        </ul>
                    </div>
                <div class="row">
                    <div class="col-12 col-md-6">
                    
                        <label for="short_description" class="form-label mt-3">Descripción Corta</label>
                        <input name="short_description" type="text" class="form-control" id="short_description" required>
                        
                    </div>
                    <div class="col-12 col-md-6">
                        
                        <label for="long_description" class="form-label mt-3">Descripción Larga</label>
                        <input name="long_description" type="text" class="form-control" id="long_description" required>
                        
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <label for="images" class="form-label mt-3">Imágenes de Proceso</label>
                        <input name="images[]" type="file" class="form-control" id="images" accept="image/*" multiple required>

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
            const form = document.getElementById('recordForm');
            const submitBtn = document.getElementById('submitBtn');

            // Configurar select2 para el propietario
            $("#owner_id").select2({
                theme: "bootstrap-5",
                width: "100%",
                ajax: {
                    url: "{{ route('users.index') }}",
                    dataType: 'json',
                    data: (params) => ({ term: params.term })
                }
            }).on("change", function () {
                const ownerId = $(this).val();
                axios.get(`{{ url('users') }}/${ownerId}`)
                    .then(res => {
                        const owner = res.data;
                        $("#sp-owner-name").text(owner.name || "N/A");
                        $("#sp-owner-phone").text(owner.phone || "N/A");
                        $("#sp-owner-email").text(owner.email || "N/A");
                    })
                    .catch(() => Swal.fire("Error", "No se pudo cargar la información del propietario.", "error"));
            });

            // Configurar select2 para el vehículo
            $("#vehicle_id").select2({
                theme: "bootstrap-5",
                width: "100%",
                ajax: {
                    url: "{{ route('vehicles.index') }}",
                    dataType: 'json',
                    data: (params) => ({
                        owner_id: $("#owner_id").val(),
                        term: params.term
                    })
                }
            }).on("change", function () {
                const vehicleId = $(this).val();
                axios.get(`{{ url('vehicles') }}/${vehicleId}`)
                    .then(res => {
                        const vehicle = res.data;
                        $("#sp-vehicle-brand").text(vehicle.vehicle_model?.brand?.name || "N/A");
                        $("#sp-vehicle-model").text(vehicle.vehicle_model?.name || "N/A");
                    })
                    .catch(() => Swal.fire("Error", "No se pudo cargar la información del vehículo.", "error"));
            });

            // Validación del formulario
            submitBtn.addEventListener('click', function (event) {
                event.preventDefault();

                let isValid = true;
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
                    form.submit();
                }
            });
        };
    </script>
@endpush



{{-- @push('js')
    <script defer>
        window.onload = () => {


            $("#owner_id").on("change", function() {
                axios.get("{{ url('users') }}/" + $("#owner_id").val(), {
                    headers: {
                        "Content-Type": "application/json"

                    }

                }).then(res => {
                    console.log(res)
                })

            });

            $("#owner_id").select2({
                theme: "bootstrap-5",
                width: "100%",
                ajax: {
                    url: "{{ route('users.index') }}",
                    dataType: 'json',
                    data: (params) => {
                        const query = {
                            term: params.term
                        }
                        return query;
                    }
                },
            });

            $("#owner_id").on("change", function() {
                const ownerId = $("#owner_id").val();

                $("#vehicle_id").select2({
                theme: "bootstrap-5",
                width: "100%",
                ajax: {
                    url: "{{ route('vehicles.index') }}",
                    dataType: 'json',
                    data: (params) => {
                        const query = {
                            owner_id: $("#owner_id").val(),
                            term: params.term
                        }
                        return query
                    }
                },
            });

   
                axios.get("{{ url('users') }}/" + ownerId, {
                    headers: {
                        "Content-Type": "application/json"
                    }
                }).then(res => {
                    const owner = res.data;
                  
                    if (owner) {
                        $("#sp-owner-name").text(owner.name);       
                        $("#sp-owner-phone").text(owner.phone);     
                        $("#sp-owner-email").text(owner.email);
                            
                    } else {
                        console.warn("No se encontraron datos para el propietario seleccionado");
                    }
                }).catch(err => {
                    console.error("Error obteniendo los datos del propietario:", err);
                });
            });


            $("#vehicle_id").on("change", function() {
                axios.get("{{ url('vehicles') }}/" + $("#vehicle_id").val(), {
                    headers: {
                        "Content-Type": "application/json"

                    }

                }).then(res => {
                    console.log(res)
                })

            });

            $("#vehicle_id").on("change", function() {
                const vehicleId = $("#vehicle_id").val();


                axios.get("{{ url('vehicles') }}/" + vehicleId, {
                    headers: {
                        "Content-Type": "application/json"
                    }
                }).then(res => {
                    const vehicle = res.data;

                    if (vehicle.vehicle_model && vehicle.vehicle_model.brand) {

                        $("#sp-vehicle-brand").text(vehicle.vehicle_model.brand.name); // Marca
                        $("#sp-vehicle-model").text(vehicle.vehicle_model.name); // Modelo
                    } else {
                        console.warn("El vehículo no tiene modelo o marca asignado");
                    }
                }).catch(err => {
                    console.error("Error obteniendo los datos del vehículo:", err);
                });
            });

        };
    </script>
@endpush --}}
