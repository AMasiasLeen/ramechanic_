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
                    <label for="vehicle_id" class="form-label">Vehículo</label>
                    <select name="vehicle_id" class="form-control" id="vehicle_id"></select>
                        <ul>
                            <li>
                                serie:<span></span>
                            </li>
                        </ul>

                    <label for="owner_id" class="form-label">Propietario</label>
                    <select name="owner_id" class="form-control" id="owner_id"></select>

                    <label for="short_description" class="form-label">Descrición Corta</label>
                    <input name="short_description" type="text" class="form-control" id="short_description" required>

                    <label for="long_description" class="form-label">Descripción Larga</label>
                    <input name="long_description" type="text" class="form-control" id="long_description" required>

                    <label for="main_image" class="form-label">Imagen Portada</label>
                    <input name="main_image" type="text" class="form-control" id="main_image" required>

                    <label for="images" class="form-label">Resto de imagenes</label>
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

            $("#owner_id").select2({
                theme: "bootstrap-5",
                width: "100%",
                ajax: {
                    url: "{{ route('users.index') }}",
                },
            });


            $("#vehicle_id").select2({
                theme: "bootstrap-5",
                width: "100%",
                ajax: {
                    url: "{{ route('vehicles.index') }}",
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
