@extends('layouts.app')

@section('content')

    <div class="d-flex justify-content-between mb-4">
        <h1>Listado de Antecedentes</h1>
        <a class="btn btn-success" href="{{ route('records.create') }}">Agregar Nuevo</a>
    </div>

    @include("records.filters")

    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Propietario</th>
                    <th>Vehículo</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Descripción Corta</th>
                    <th>Fecha de Registro</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($records as $record)
                    <tr>
                        
                        <td>{{ $record->vehicle->owner->name }}</td>

                        
                        <td>{{ $record->vehicle->plate }}</td>

                        
                        <td>{{ $record->vehicle->vehicle_model->brand->name }}</td>

                        
                        <td>{{ $record->vehicle->vehicle_model->name }}</td>

                        
                        <td>{{ $record->short_description }}</td>

                        
                        <td>{{ $record->date_in}}</td>

                        <td>
                            <div class="btn-group" role="group" aria-label="Acciones">
                                <!-- Botón para editar el registro -->
                                <a class="btn btn-outline-warning btn-sm" href="{{ route('records.edit', ['record' => $record]) }}">Editar</a>
                                
                                <!-- Botón para eliminar el registro -->
                                <form id="formdel{{ $record->id }}" action="{{ route('records.destroy', ['record' => $record]) }}" method="POST" class="d-inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-outline-danger btn-sm btndel" type="button" data-id="{{ $record->id }}">Eliminar</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-center mt-4">
        {{ $records->appends(request()->query())->links('pagination::bootstrap-4') }}
    </div>

@endsection

@push('js')
    <script defer>
        window.onload = () => {
            $('.btndel').click(function() {
                const model_id = $(this).data("id");
                Swal.fire({
                    title: "¿Está seguro de eliminar?",
                    text: "Esta acción no se puede deshacer",
                    icon: "warning",
                    showCancelButton: true
                }).then((result) => {
                    if (result.value) {
                        $('#formdel' + model_id).submit();
                    }
                });
            });
        }
    </script>
@endpush