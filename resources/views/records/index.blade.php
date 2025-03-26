@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="d-flex justify-content-between mb-3">
            <h1>Listado de Antecedentes</h1>
            <a class="btn btn-success btn-sm align-self-center" href="{{ route('records.create') }}">Agregar Nuevo</a>
        </div>

        @include("records.filters")

        @if($records->isNotEmpty())
        <div class="table-responsive">
            <table class="table table-borderless table-hover align-middle">
                <thead class="border-bottom">
                    <tr>
                        <th>Propietario</th>
                        <th>Vehículo</th>
                        <th>Marca</th>
                        <th>Modelo</th>
                        <th>Detalle</th>
                        <th>Fecha de Registro</th>
                        <th class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($records as $record)
                        @if($record->vehicle->owner && $record->vehicle->owner->name)
                        <tr class="border-bottom">
                            <td>{{ $record->vehicle->owner->name }}</td>
                            <td>{{ $record->vehicle->plate ?? 'N/A' }}</td>
                            <td>{{ $record->vehicle->vehicle_model->brand->name ?? 'N/A' }}</td>
                            <td>{{ $record->vehicle->vehicle_model->name ?? 'N/A' }}</td>
                            <td>{{ $record->short_description }}</td>
                            <td>{{ $record->date_in}}</td>
                            <td class="text-end">
                                <div class="d-inline-flex gap-3">
                                    @if (Auth::user()->hasRole('administrador') || Auth::user()->hasRole('mecanico'))
                                    <a href="{{ route('records.show', $record) }}" 
                                       class="text-primary text-decoration-none">
                                        Ver
                                    </a>
                                    @endif

                                    @if (Auth::user()->hasRole('administrador'))
                                    <a href="{{ route('records.edit', $record) }}" 
                                       class="text-warning text-decoration-none">
                                        Editar
                                    </a>
                                    
                                    <form id="formdel{{ $record->id }}" 
                                          action="{{ route('records.destroy', $record) }}" 
                                          method="POST"
                                          class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" 
                                                class="text-danger border-0 bg-transparent p-0 btndel" 
                                                data-id="{{ $record->id }}">
                                            Eliminar
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="alert alert-info text-center">
            No se encontraron registros de antecedentes
        </div>
        @endif

        <div class="d-flex justify-content-center mt-4">
            {{ $records->appends(request()->query())->links('pagination::bootstrap-4') }}
        </div>
    </div>
</div>
@endsection

@push('css')
<style>
    .table-hover tr:hover {
        background-color: #f8f9fa;
    }
    .border-bottom {
        border-color: #dee2e6!important;
    }
    .table td, .table th {
        vertical-align: middle;
    }
</style>
@endpush

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