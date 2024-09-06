@extends('layouts.app')

@section('content')

    <div class="d-flex justify-content-between mb-4">
        <h1>Listado de Roles</h1>
        <a class="btn btn-success" href="{{ route('roles.create') }}">Agregar Nuevo Rol</a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Rol</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($roles as $role)
                    <tr>
                        <td>{{ $role->name }}</td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Acciones">
                                <a class="btn btn-outline-warning btn-sm" href="{{ route('roles.edit', ['role' => $role]) }}"><i class="fa-solid fa-role-secret"></i>Editar</a>
                                
                                <form id="formdel{{ $role->id }}" action="{{ route('roles.destroy', ['role' => $role]) }}" method="POST" class="d-inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-outline-danger btn-sm btndel" type="button" data-id="{{ $role->id }}">Eliminar</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection

@push('js')
    <script defer>
        window.onload = () => {
            $('.btndel').click(function() {
                    console.log(this)
                    const model_id = $(this).data("id")
                Swal.fire({
                    title: "Esta seguro de eliminar",
                    text: "Esta accion no se puede deshacer",
                    icon: "warning",
                    showCancelButton: true
                }).then((result)=>{
                    if(result.value){
                        $('#formdel'+model_id).submit();
                    }
                })
            })
        }
    </script>
@endpush