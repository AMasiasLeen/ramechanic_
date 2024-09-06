@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between mb-3">
        <a class="btn btn-secondary" href="{{ route('users.index') }}">Regresar</a>
    </div>

    <div class="card">
        <div class="card-header">
            <h1>Agregar Usuario</h1>
        </div>
        <div class="card-body">
            <form action="{{ route('users.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="identification" class="form-label">Identificación:</label>
                    <input name="identification" type="text" class="form-control" id="identification" required>

                    <label for="name" class="form-label">Nombre:</label>
                    <input name="name" type="text" class="form-control" id="name" required>

                    <label for="password" class="form-label">Contraseña:</label>
                    <input name="password" type="text" class="form-control" id="password" required>

                    <label for="phone" class="form-label">Telefono:</label>
                    <input name="phone" type="text" class="form-control" id="phone" required>

                    <label for="email" class="form-label">Correo:</label>
                    <input name="email" type="text" class="form-control" id="email" required>

                    <label for="address" class="form-label">Dirección:</label>
                    <input name="address" type="text" class="form-control" id="address" required>

                    <label for="rol" class="form-label">Dirección:</label>
                    <select name="rol" class="form-control" id="role_id">uwu
                        @foreach(Spatie\Permission\Models\Role::all() as $role)
                            <option value="{{$role->id}}">{{$role->name}}</option>
                        
                        @endforeach 
                    </select>


                </div>
                <button type="submit" class="btn btn-primary">GUARDAR</button>
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
                multiple:true,
                allowClear:true
            });
        }
</script>
@endpush
