@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between mb-3">
        <a class="btn btn-secondary" href="{{ route('users.index') }}">Regresar</a>
        <a class="btn btn-success" href="{{ route('users.create') }}">Añadir otro registro</a>
    </div>

    <div class="card">
        <div class="card-header">
            <h1>Editar Usuario</h1>
        </div>
        <div class="card-body">
            <form action="{{ route('users.update', ['user' => $user]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="identification" class="form-label">Identificación</label>
                    <input name="identification" type="text" class="form-control" id="identification"
                        value="{{ $user->name }}" required>

                    <label for="name" class="form-label">Nombre:</label>
                    <input name="name" type="text" class="form-control" id="name" value="{{ $user->name }}"
                        required>

                    <label for="password" class="form-label">Contraseña:</label>
                    <input name="password" type="password" class="form-control" id="password"
                        placeholder="Deja en blanco si no quieres modificar">

                    <label for="phone" class="form-label">Telefono:</label>
                    <input name="phone" type="text" class="form-control" id="phone" value="{{ $user->phone }}"
                        required>

                    <label for="email" class="form-label">Correo:</label>
                    <input name="email" type="text" class="form-control" id="email" value="{{ $user->email }}"
                        required>

                    <label for="address" class="form-label">Dirección:</label>
                    <input name="address" type="text" class="form-control" id="address" value="{{ $user->address }}"
                        required>

                    <label for="rol" class="form-label">Rol:</label>
                    <select name="rol[]" class="form-control" id="role_id" multiple="multiple">

                        @foreach (Spatie\Permission\Models\Role::all() as $role)
                            <option @if (in_array($role->name, $user->roles->pluck('name')->toArray())) selected @endif value="{{ $role->name }}">
                                {{ $role->name }}</option>
                        @endforeach

                    </select>
                </div>
        </div>
        <div class="card-footer">
            <button class='btn btn-primary' type="submit">Modificar</button>
            </form>
            <button id="btndel" class="btn btn-danger">Eliminar</button>
            <form id="formdel" action="{{ route('users.destroy', ['user' => $user]) }}" method="POST"
                style="display:inline;">
                @csrf
                @method('DELETE')
            </form>
        </div>
    </div>
@endsection

@push('js')
    <script defer>
        window.onload = () => {

            $("#role_id").select2({
                theme: "bootstrap-5",
                width: "100%",
                multiple: true,
                allowClear: true,
                placeholder: "pone un rol"
            });
        }
    </script>
@endpush
