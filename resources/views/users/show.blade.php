@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between mb-3">
        <a class="btn btn-secondary" href="{{ route('users.index') }}">Regresar</a>
        @if (Auth::user()->hasRole('administrador'))
        <a class="btn btn-success" href="{{ route('users.create') }}">Agregar Nuevo</a>
        @endif
    </div>

    <div class="card">
        <div class="card-header">
            <h1>Detalles del Usuario</h1>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-md-6">
                    <label class="form-label fw-bold">Identificación:</label>
                    <p class="form-control-plaintext">{{ $user->identification }}</p>
                </div>
                <div class="col-12 col-md-6">
                    <label class="form-label fw-bold">Nombre:</label>
                    <p class="form-control-plaintext">{{ $user->name }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-6">
                    <label class="form-label fw-bold">Correo:</label>
                    <p class="form-control-plaintext">{{ $user->email }}</p>
                </div>
                <div class="col-12 col-md-6">
                    <label class="form-label fw-bold">Teléfono:</label>
                    <p class="form-control-plaintext">{{ $user->phone }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-6">
                    <label class="form-label fw-bold">Dirección:</label>
                    <p class="form-control-plaintext">{{ $user->address ?? 'No especificada' }}</p>
                </div>
                <div class="col-12 col-md-6">
                    <label class="form-label fw-bold">Rol:</label>
                    <p class="form-control-plaintext">
                        @foreach($user->roles as $rol)
                            <span class="badge bg-success">{{ $rol->name }}</span>
                        @endforeach
                    </p>
                </div>
            </div>
        </div>
        <div class="card-footer d-flex justify-content-between">
        @if (Auth::user()->hasRole('administrador'))
            <a class="btn btn-primary" href="{{ route('users.edit', ['user' => $user]) }}">Modificar</a>
            @endif
            <form id="formdel" action="{{ route('users.destroy', ['user' => $user]) }}" method="POST" onsubmit="return confirm('¿Está seguro de eliminar este usuario?');">
                @csrf
                @method("DELETE")
                <!-- <button type="submit" class="btn btn-danger">Eliminar</button> -->
            </form>
        </div>
    </div>
@endsection

@push('js')
    <script defer>
        window.onload = () => {
            $('#btndel').click(function() {
                Swal.fire({
                    title: "Esta seguro de eliminar",
                    text: "Esta accion no se puede deshacer",
                    icon: "warning",
                    showCancelButton: true
                }).then((result)=>{
                    if(result.value){
                        $('#formdel').submit();
                    }
                })
            })
        }
    </script>
@endpush