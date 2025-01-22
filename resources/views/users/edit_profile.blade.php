@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow-lg">
                    <!-- Encabezado -->
                    <div class="card-header bg-primary text-white text-center py-4">
                        <h2 class="mb-0">Editar Perfil de Usuario</h2>
                    </div>

                    <!-- Contenido -->
                    <div class="card-body">
                        <form action="{{ route('users.update', ['user' => $user]) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row align-items-center">
                                <!-- Imagen de perfil -->
                                <div class="col-md-4 text-center mb-4 mb-md-0">
                                    <div class="position-relative">
                                        <img id="profile-picture-preview" 
                                            src="{{ $user->profile_picture ? Storage::url($user->profile_picture) : asset('images/default_user.png') }}" 
                                            class="img-fluid rounded-circle shadow mb-3" 
                                            alt="Imagen de perfil" 
                                            style="max-width: 200px;">
                                        <label for="profile_picture" class="btn btn-outline-primary btn-sm shadow">
                                            <i class="fa fa-camera"></i> Cambiar Imagen
                                            <input type="file" name="profile_picture" id="profile_picture" class="form-control d-none">
                                        </label>
                                    </div>
                                </div>

                                <!-- Información del usuario -->
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="col-12 mb-3">
                                            <label for="name" class="form-label fw-bold">Nombre</label>
                                            <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                                        </div>

                                        <div class="col-12 mb-3">
                                            <label for="email" class="form-label fw-bold">Email</label>
                                            <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                                        </div>

                                        <div class="col-6 mb-3">
                                            <label for="phone" class="form-label fw-bold">Teléfono</label>
                                            <input type="text" name="phone" class="form-control" value="{{ old('phone', $user->phone) }}" required>
                                        </div>

                                        <div class="col-6 mb-3">
                                            <label for="address" class="form-label fw-bold">Dirección</label>
                                            <input type="text" name="address" class="form-control" value="{{ old('address', $user->address) }}">
                                        </div>

                                        <div class="col-6 mb-3">
                                            <label for="password" class="form-label fw-bold">Nueva Contraseña</label>
                                            <input type="password" name="password" class="form-control" placeholder="Ingresa tu nueva contraseña">
                                        </div>

                                        <div class="col-6 mb-3">
                                            <label for="password_confirmation" class="form-label fw-bold">Confirmar Contraseña</label>
                                            <input type="password" name="password_confirmation" class="form-control" placeholder="Confirma tu nueva contraseña">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Botones -->
                            <div class="d-flex justify-content-between mt-4">
                                <button type="submit" class="btn btn-primary px-4">
                                    <i class="fa fa-save"></i> Guardar Cambios
                                </button>
                                <a href="{{ route('users.profile', ['user' => Auth::id()]) }}" class="btn btn-secondary px-4">
                                    <i class="fa fa-arrow-left"></i> Volver
                                </a>
                            </div>
                        </form>
                    </div>

                    <!-- Pie -->
                    <div class="card-footer bg-light text-center">
                        <p class="text-muted mb-0">¿Tienes dudas? <a href="" class="text-primary">Contacta soporte</a>.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .card {
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.1);
        }

        .btn-outline-primary:hover {
            background-color: #0056b3;
            color: #fff;
        }

        img.shadow {
            transition: transform 0.2s ease-in-out;
        }

        img.shadow:hover {
            transform: scale(1.05);
        }
    </style>
@endpush

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
