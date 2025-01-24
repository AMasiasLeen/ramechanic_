@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between mb-3">
        <a class="btn btn-secondary" href="{{ route('users.index') }}">Regresar</a>
    </div>

    <div class="card">
        <div class="card-header">
            <h1>Editar Usuario</h1>
        </div>
        <div class="card-body">
            <form id="userEditForm" action="{{ route('users.update', ['user' => $user]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-12 col-md-6">
                        <label for="identification" class="form-label">Identificación</label>
                        <input name="identification" type="text" class="form-control @error('identification') is-invalid @enderror" 
                               id="identification" value="{{ old('identification', $user->identification) }}" 
                               required maxlength="13" pattern="\d{10}" placeholder="Ingrese C.I/RUC">
                        @error('identification')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="name" class="form-label">Nombre:</label>
                        <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" 
                               id="name" value="{{ old('name', $user->name) }}" 
                               required pattern="[a-zA-Z\s]+" title="Solo letras y espacios." placeholder="Ingrese nombre">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <label for="email" class="form-label">Correo:</label>
                        <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                               id="email" value="{{ old('email', $user->email) }}" 
                               required placeholder="Ingrese correo electrónico">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="password" class="form-label">Contraseña:</label>
                        <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" 
                               id="password" placeholder="Deja en blanco si no quieres modificar">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <label for="phone" class="form-label">Teléfono:</label>
                        <input name="phone" type="text" class="form-control @error('phone') is-invalid @enderror" 
                               id="phone" value="{{ old('phone', $user->phone) }}" 
                               required pattern="\d{7,15}" title="Debe contener entre 7 y 15 dígitos numéricos." placeholder="Ingrese número">
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="address" class="form-label">Dirección:</label>
                        <input name="address" type="text" class="form-control @error('address') is-invalid @enderror" 
                               id="address" value="{{ old('address', $user->address) }}" 
                               maxlength="70" placeholder="Ingrese dirección (opcional)">
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-6">
                    <label for="rol" class="form-label">Rol:</label>
                        <select name="rol" class="form-control @error('rol') is-invalid @enderror" id="role_id">
                            <option value="" disabled selected>Seleccione un rol</option>
                            @foreach (Spatie\Permission\Models\Role::all() as $role)
                                <option value="{{ $role->name }}" 
                                    {{ old('rol', $user->roles->pluck('name')->first()) == $role->name ? 'selected' : '' }}>
                                    {{ $role->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('rol')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <button class="btn btn-primary mt-3" type="submit" id="submitBtn">Guardar</button>
            </form>
        </div>
    </div>
@endsection

@push('js')
    <script defer>
        window.onload = () => {
            const form = document.getElementById('userEditForm');
            const submitBtn = document.getElementById('submitBtn');

            submitBtn.addEventListener('click', function(event) {
                event.preventDefault(); // Evita el envío inmediato

                let isValid = true;

                // Validar campos requeridos
                form.querySelectorAll('[required]').forEach(input => {
                    if (!input.value.trim()) {
                        input.classList.add('is-invalid');
                        isValid = false;
                    } else {
                        input.classList.remove('is-invalid');
                    }
                });

                // Validar campo de teléfono
                const phoneInput = document.getElementById('phone');
                const phonePattern = /^\d{7,15}$/;
                if (!phonePattern.test(phoneInput.value.trim())) {
                    phoneInput.classList.add('is-invalid');
                    isValid = false;
                } else {
                    phoneInput.classList.remove('is-invalid');
                }

                if (!isValid) {
                    Swal.fire({
                        title: "Datos incompletos o incorrectos",
                        text: "Por favor, revise los campos marcados en rojo.",
                        icon: "warning",
                        confirmButtonText: "Entendido"
                    });
                } else {
                    form.submit();
                }
            });

            // Configuración de Select2 para roles
            $("#role_id").select2({
                theme: "bootstrap-5",
                width: "100%",
                multiple: true,
                allowClear: true,
                placeholder: "Seleccione uno o más roles"
            });
        }
    </script>
@endpush
