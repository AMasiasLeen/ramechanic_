@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="d-flex justify-content-between mb-3">
            <h1>Listado de Usuarios</h1>
            <a class="btn btn-success btn-sm align-self-center" href="{{ route('users.create') }}">Agregar Nuevo
            </a>
        </div>

        @include('users.filters')

        @if($users->isNotEmpty())
        <div class="table-responsive">
            <table class="table table-borderless table-hover align-middle">
                <thead class="border-bottom">
                    <tr>
                        <th>Rol</th>
                        <th>Nombre</th>
                        <th>Identificación</th>
                        <th>Teléfono</th>
                        <th>Correo</th>
                        <th>Dirección</th>
                        <th class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr class="border-bottom">
                            <td>
                                @forelse($user->roles as $rol)
                                    <span>{{ $rol->name }}</span>
                                @empty
                                    <span class="text-muted">N/A</span>
                                @endforelse
                            </td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->identification ?? 'N/A' }}</td>
                            <td>{{ $user->phone ?? 'N/A' }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->address ?? 'N/A' }}</td>
                            <td class="text-end">
                                <div class="d-inline-flex gap-3">
                                    <!-- Ver -->

                                    @if (Auth::user()->hasRole('administrador') || Auth::user()->hasRole('mecanico'))
                                    <a href="{{ route('users.show', $user) }}" 
                                       class="text-primary text-decoration-none">
                                        Ver
                                    </a>
                                    @endif

                                    @if (Auth::user()->hasRole('administrador'))
                                    <!-- Editar -->
                                    <a href="{{ route('users.edit', $user) }}" 
                                       class="text-warning text-decoration-none">
                                        Editar
                                    </a>
                                    
                                    <!-- Eliminar -->
                                    <form id="formdel{{ $user->id }}" 
                                          action="{{ route('users.destroy', $user) }}" 
                                          method="POST"
                                          class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" 
                                                class="text-danger border-0 bg-transparent p-0 btndel" 
                                                data-id="{{ $user->id }}">
                                            Eliminar
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="alert alert-info text-center">
            No se encontraron usuarios registrados
        </div>
        @endif

        <div class="d-flex justify-content-center mt-4">
            {{ $users->appends(request()->query())->links('pagination::bootstrap-4') }}
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
                console.log(this)
                const model_id = $(this).data("id")
                Swal.fire({
                    title: "Esta seguro de eliminar",
                    text: "Esta accion no se puede deshacer",
                    icon: "warning",
                    showCancelButton: true
                }).then((result) => {
                    if (result.value) {
                        $('#formdel' + model_id).submit();
                    }
                })
            })
        }
    </script>
@endpush
