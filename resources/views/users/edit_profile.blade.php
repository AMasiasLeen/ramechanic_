@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h3>Editar Perfil de Usuario</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('users.update', ['user' => $user]) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-md-4 text-center">
                                    
                                    <img id="profile-picture-preview" src="{{ $user->profile_picture ? Storage::url($user->profile_picture) : asset('images/default_user.png') }}" class="img-fluid rounded-circle" alt="Imagen de perfil" style="max-width: 150px;">
                                    
                                    <div class="mt-3">
                                        <label for="profile_picture" class="form-label">Cambiar Imagen de Perfil</label>
                                        <input type="file" name="profile_picture" id="profile_picture" class="form-control" value="{{ old('profile_picture', $user->profile_picture) }}">
                                    </div>
                                </div>

                                <div class="col-md-8">
                                    
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Nombre</label>
                                        <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                                    </div>

                                    
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                                    </div>

                                    
                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Teléfono</label>
                                        <input type="text" name="phone" class="form-control" value="{{ old('phone', $user->phone) }}" required>
                                    </div>

                                    
                                    <div class="mb-3">
                                        <label for="address" class="form-label">Dirección</label>
                                        <input type="text" name="address" class="form-control" value="{{ old('address', $user->address) }}">
                                    </div>

                                    
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Contraseña</label>
                                        <input type="password" name="password" class="form-control" placeholder="Ingresa tu nueva contraseña" >
                                    </div>

                                    
                                    <div class="mb-3">
                                        <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                                        <input type="password" name="password_confirmation" class="form-control" placeholder="Confirma tu nueva contraseña" >
                                    </div>

                                    
                                    <div class="d-flex justify-content-between">
                                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                                        <a href="{{ route('users.profile',['user'=>Auth::id()]) }}" class="btn btn-secondary">Volver</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('js')
<script>
    const profilePictureInput = document.getElementById('profile_picture');
    const profilePicturePreview = document.getElementById('profile-picture-preview');

    profilePictureInput.addEventListener('change', function() {
        if (this.files && this.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                profilePicturePreview.src = e.target.result;
            };
            reader.readAsDataURL(this.files[0]);
        }
    });
</script>

@endpush
