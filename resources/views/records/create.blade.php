@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between mb-3">
        <a class="btn btn-secondary" href="{{ route('records.index') }}">Regresar</a>
    </div>

    <div class="card">
        <div class="card-header">
            <h1>Agregar Registro</h1>
        </div>
        <div class="card-body">
            <form action="{{ route('records.store') }}" method="POST">
                @csrf
                <div class="mb-3">

                    <label for="date_in" class="form-label mt-3">Fecha de Registro</label>
                    <input name="date_in" type="date" class="form-control" id="date_in" required>

                    <label for="owner_id" class="form-label mt-3">Propietario</label>
                    <select name="owner_id" class="form-control" id="owner_id"></select>

                    <ul id="owner-details" class="list-group mt-3">

                        <li class="list-group-item">
                            <strong>Nombre: </strong><span id="sp-owner-name"></span>
                        </li>
                        <li class="list-group-item">
                            <strong>Telefono: </strong><span id="sp-owner-phone"></span>
                        </li>
                        <li class="list-group-item">
                            <strong>Correo: </strong><span id="sp-owner-email"></span>
                        </li>

                    </ul>
                    <label for="vehicle_id" class="form-label mt-3">Vehículo</label>
                    <select name="vehicle_id" class="form-control" id="vehicle_id"></select>

                    <ul id="vehicle-details" class="list-group mt-3">

                        <li class="list-group-item">
                            <strong>Marca: </strong><span id="sp-vehicle-brand"></span>
                        </li>
                        <li class="list-group-item">
                            <strong>Modelo: </strong><span id="sp-vehicle-model"></span>
                        </li>

                    </ul>


                    <label for="short_description" class="form-label mt-3">Descrición Corta</label>
                    <input name="short_description" type="text" class="form-control" id="short_description" required>

                    <label for="long_description" class="form-label mt-3">Descripción Larga</label>
                    <input name="long_description" type="text" class="form-control" id="long_description" required>

                    <label for="main_image" class="form-label mt-3">Imagen Portada</label>
                    <input name="main_image" type="text" class="form-control" id="main_image" required>

                    <label for="images" class="form-label mt-3">Resto de imagenes</label>
                    <input name="images" type="text" class="form-control" id="images" required>

                </div>
                <button type="submit" class="btn btn-primary">GUARDAR</button>
            </form>
        </div>
    </div>
@endsection

@push('js')
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
@endpush
