@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between mb-3">
        <a class="btn btn-secondary" href="{{ route('vehicles.index') }}">Regresar</a>
    </div>

    <div class="card">
        <div class="card-header">
            <h1>Agregar Vehículo</h1>
        </div>
        <div class="card-body">
            <form action="{{ route('vehicles.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="plate" class="form-label">Placa del Vehículo</label>
                    <input name="plate" type="text" class="form-control" id="plate" required>

                    <label for="owner_id" class="form-label">Propietario</label>
                    <input name="owner_id" type="text" class="form-control" id="owner_id" required>

                    {{-- SELECT 2 --}}
                    {{-- <label for="brand_id">Marca</label>
                    <select name="brand_id" class="form-control" id="brand_id"></select> --}}
                    {{-- <label for="brand_id" class="form-label">Marca</label>
                    <input name="brand_id" type="text" class="form-control" id="brand_id" required> --}}

                    <label for="vehicle_model_id">Modelo Vehículo</label>
                    <select name="vehicle_model_id" class="form-control" id="vehicle_model_id"></select>

                    <label for="engine_serial" class="form-label">Número Serie del Motor</label>
                    <input name="engine_serial" type="text" class="form-control" id="engine_serial" required>

                    <label for="serial_number" class="form-label">Número de Serie</label>
                    <input name="serial_number" type="text" class="form-control" id="serial_number" required>

                    <label for="color" class="form-label">Color</label>
                    <input name="color" type="text" class="form-control" id="color" required>
                </div>
                <button type="submit" class="btn btn-primary">GUARDAR</button>
            </form>
        </div>
    </div>
@endsection

@push('js')
    <script defer>
        window.onload = () => {

            // $("#brand_id").select2({
            //     theme: "bootstrap-5",
            //     width: "100%",
            //     ajax: {
            //         url: "{{ route('brands.index') }}",
            //         dataType: 'json'
            //     },
            // });

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

            // $("#brand_id").on("change", function() {
            //     $("#vehicle_model_id").val(null);
            //     $("#vehicle_model_id").trigger("change")
            // })

            // $("#vehicle_model_id").on("change", function() {
            //     axios.get("{{ url('vehicle-models') }}/" + $("#vehicle_model_id").val(), {
            //         headers: {
            //             "Content-Type": "application/json"
            //         }
            //     }).then(({
            //         data
            //     }) => {
            //         console.log(data)   

            //         if ($('#brand_id').find("option[value='" + data.id + "']").length) {
            //             $('#brand_id').val(data[0].brand.id.toString()).trigger('change');
            //         } else {
            //             // Create a DOM Option and pre-select by default
            //             var newOption = new Option(data[0].brand.name, data[0].brand.id, true, true);
            //             // Append it to the select
            //             $('#brand_id').append(newOption).trigger('change');
            //         }
            //     })

            // })



        }
    </script>
@endpush
