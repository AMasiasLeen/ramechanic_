@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <a class="btn btn-secondary" href="{{ route('brands.index') }}">Regresar</a>
    <a class="btn btn-success" href="{{ route('brands.create') }}">Agregar Nuevo</a>
</div>

<div class="card">
    <div class="card-header">
        <h1>Marca</h1>
    </div>
    <div class="card-body">
        <h4>Nombre</h4>
        <h3>{{ $brand->name }}</h3>
    </div>
    <div class="card-footer">
        <a class='btn btn-primary' href="{{ route('brands.edit', ['brand' => $brand]) }}">Modificar</a>
        {{-- <button id="btndel" class="btn btn-danger">Eliminar</button> --}}
        <form id="formdel" action="{{ route('brands.destroy', ['brand'=>$brand]) }}" method="POST" style="display:inline;">
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
