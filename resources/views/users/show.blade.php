@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <a class="btn btn-secondary" href="{{ route('users.index') }}">Regresar</a>
    <a class="btn btn-success" href="{{ route('users.create') }}">Añadir otro Usuario</a>
</div>

<div class="card">
    <div class="card-header">
        <h1>Usuario</h1>
    </div>
    <div class="card-body">
        <h4>Identificación</h4>
        <h3>{{ $user->identification }}</h3>
        <h4>Nombre</h4>
        <h3>{{ $user->name }}</h3>
        <h4>Telefono</h4>
        <h3>{{ $user->phone }}</h3>
        <h4>Correo</h4>
        <h3>{{ $user->email }}</h3>
        <h4>Dirección</h4>
        <h3>{{ $user->address }}</h3>
        <h4>Rol</h4>
        @foreach($user->roles as $rol)
        <span class="badge bg-success">{{$rol->name}}</span>
        @endforeach
    </div>
    <div class="card-footer">
        <a class='btn btn-primary' href="{{ route('users.edit', ['user' => $user]) }}">Modificar</a>
        <button id="btndel" class="btn btn-danger">Eliminar</button>
        <form id="formdel" action="{{ route('users.destroy', ['user'=>$user]) }}" method="POST" style="display:inline;">
            @csrf
            @method("DELETE") 
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