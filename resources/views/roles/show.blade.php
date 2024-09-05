@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <a class="btn btn-secondary" href="{{ route('roles.index') }}">Regresar</a>
    <a class="btn btn-success" href="{{ route('roles.create') }}">Añadir otro Usuario</a>
</div>

<div class="card">
    <div class="card-header">
        <h1>Usuario</h1>
    </div>
    <div class="card-body">
        <h4>Identificación</h4>
        <h3>{{ $role->identification }}</h3>
    </div>
    <div class="card-footer">
        <a class='btn btn-primary' href="{{ route('roles.edit', ['role' => $role]) }}">Modificar</a>
        <button id="btndel" class="btn btn-danger">Eliminar</button>
        <form id="formdel" action="{{ route('roles.destroy', ['role'=>$role]) }}" method="POST" style="display:inline;">
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