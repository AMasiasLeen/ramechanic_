@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-5">
        <div class="d-flex justify-content-between mb-3">
            <a class="btn btn-secondary btn-sm" href="{{ route('brands.index') }}">Regresar</a>
            @if (Auth::user()->hasRole('administrador'))
            <a class="btn btn-success btn-sm" href="{{ route('brands.create') }}">Agregar Nuevo</a>
            @endif
        </div>
        <div class="card">
            <div class="card-header p-3">
                <h5 class="mb-0">Marca</h5>
            </div>
            <div class="card-body p-3">
                <div class="row g-2">
                    <div class="col-12">
                        <h6 class="text-muted mb-1">Nombre</h6>
                        <p class="h5 mb-0">{{ $brand->name }}</p>
                    </div>
                </div>
            </div>
            <div class="card-footer p-3 d-flex gap-2">
            @if (Auth::user()->hasRole('administrador'))
                <a class='btn btn-primary btn-sm px-4' href="{{ route('brands.edit', ['brand' => $brand]) }}">Modificar</a>
                @endif
                <!-- <button id="btndel" class="btn btn-danger btn-sm">Eliminar</button> -->
                <form id="formdel" action="{{ route('brands.destroy', ['brand'=>$brand]) }}" method="POST" style="display:inline;">
                    @csrf
                    @method("DELETE") 
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
<!-- <div>
    <table>
        <tbody>
            @foreach($brand->ledgers as $brandhistory)
            <tr>
                <td>
                    {{$brandhistory->event}}

                </td>
                <td>
                    {{$brandhistory->user}}
                </td>
            </tr>

            @endforeach
        </tbody>
    </table>
</div> -->

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
