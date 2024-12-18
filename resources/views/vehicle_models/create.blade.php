@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between mb-3">
        <a class="btn btn-secondary" href="{{ route('vehicle-models.index') }}">Regresar</a>
    </div>

    <div class="card">
        <div class="card-header">
            <h1>Agregar Nuevo</h1>
        </div>
        <div class="card-body">
            <form action="{{ route('vehicle-models.store') }}" method="POST">
                @csrf
                <div class="mb-3">

                    <label for="brand_id">Marca</label>
                    <select name="brand_id" class="form-control" id="brand_id"></select>

                    <label for="name" class="form-label">Nombre del Modelo de Vehículo:</label>
                    <input name="name" type="text" class="form-control" id="name" required>
                </div>
                <button type="submit" class="btn btn-primary">GUARDAR</button>
            </form>
        </div>
    </div>
@endsection

@push('js')
    <script>
        window.onload = () => {
            $("#brand_id").select2({
                theme: "bootstrap-5",
                width: "100%",
                ajax: {
                    url: "{{route('brands.index')}}"
                }
            })
        }


    </script>
@endpush
