@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between mb-4">
        <h1>Listado de Usuarios</h1>
        <a class="btn btn-success" href="{{ route('users.create') }}">Agregar Nuevo</a>
    </div>

    @include('users.filters')

    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Rol</th>
                    <th>Nombre</th>
                    <th>Identificación</th>
                    <th>Teléfono</th>
                    <th>Correo</th>
                    <th>Dirección</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>
                            @foreach($user->roles as $rol)
                                <span>{{$rol->name}}</span>
                            @endforeach
                        </td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->identification }}</td>
                        <td>{{ $user->phone }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->address }}</td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Acciones">
                                <a class="btn btn-outline-warning btn-sm"
                                    href="{{ route('users.edit', ['user' => $user]) }}">Editar</a>

                                <form id="formdel{{ $user->id }}"
                                    action="{{ route('users.destroy', ['user' => $user]) }}" method="POST"
                                    class="d-inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <!-- <button class="btn btn-outline-danger btn-sm btndel" type="button"
                                        data-id="{{ $user->id }}">Eliminar</button> -->
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-center mt-4">
        {{ $users->links('pagination::bootstrap-4') }}
    </div>
@endsection

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
