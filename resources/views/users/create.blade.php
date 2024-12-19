@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between mb-3">
        <a class="btn btn-secondary" href="{{ route('users.index') }}">Regresar</a>
    </div>

    <div class="card">
        <div class="card-header">
            <h1>Agregar Nuevo</h1>
        </div>
        <div class="card-body">
            <form id="userForm" action="{{ route('users.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="identification" class="form-label">Identificación:</label>
                    <input name="identification" type="text" class="form-control" id="identification" value="{{old('identification')}}" required>
                    @error('identification')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <label for="name" class="form-label">Nombre:</label>
                    <input name="name" type="text" class="form-control" id="name" value="{{old('name')}}" required >
                    @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <label for="password" class="form-label">Contraseña:</label>
                    <input name="password" type="text" class="form-control" id="password" value="{{old('password')}}" required>
                    @error('password')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <label for="phone" class="form-label">Teléfono:</label>
                    <input name="phone" type="text" class="form-control" id="phone" value="{{old('phone')}}" required>
                    @error('phone')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <label for="email" class="form-label">Correo:</label>
                    <input name="email" type="text" class="form-control" id="email" value="{{old('email')}}" required>
                    @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <label for="address" class="form-label">Dirección:</label>
                    <input name="address" type="text" class="form-control" id="address" value="{{old('address')}}"required>
                    @error('addres')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <label for="rol" class="form-label">Rol:</label>
                    <select name="rol[]" class="form-control" id="role_id" required>
                        @foreach(Spatie\Permission\Models\Role::all() as $role)
                            <option value="{{$role->name}}">{{$role->name}}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary" id="submitBtn">GUARDAR</button>
            </form>
        </div>
    </div>
@endsection

@push('js')
    <script defer>
        window.onload = () => {

            // Inicializa select2
            $("#role_id").select2({
                theme: "bootstrap-5",
                width: "100%",
                multiple: true,
                allowClear: true,
                placeholder: "Seleccione un rol"
            });

            // Validación del formulario
            const form = document.getElementById('userForm');
            const submitBtn = document.getElementById('submitBtn');

            submitBtn.addEventListener('click', function (event) {
                event.preventDefault(); // Evita el envío del formulario inmediato

                let isValid = true;

                // Validar campos requeridos
                form.querySelectorAll('[required]').forEach(input => {
                    if (!input.value.trim()) {
                        isValid = false;
                    }
                });

                if (!isValid) {
                    Swal.fire({
                        title: "Datos incompletos",
                        text: "Por favor, complete todos los campos requeridos antes de guardar.",
                        icon: "warning",
                        confirmButtonText: "Entendido"
                    });
                } else {
                    form.submit(); // Enviar el formulario si es válido
                }
            });
        }
    </script>
@endpush
