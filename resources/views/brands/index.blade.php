@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between mb-4">
        <h1>Listado de Marcas</h1>
        <a class="btn btn-success" href="{{ route('brands.create') }}">Agregar Nueva Marca</a>
    </div>

    @include('brands.filters')

    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Marcas</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($brands as $brand)
                    <tr>
                        <td>{{ $brand->id }}</td>
                        <td>{{ $brand->name }}</td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Acciones">
                                <a class="btn btn-outline-warning btn-sm"
                                    href="{{ route('brands.edit', ['brand' => $brand]) }}">Editar</a>

                                <form id="formdel{{ $brand->id }}"
                                    action="{{ route('brands.destroy', ['brand' => $brand]) }}" method="POST"
                                    class="d-inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-outline-danger btn-sm btndel" type="button"
                                        data-id="{{ $brand->id }}">Eliminar</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-center mt-4">
        {{ $brands->links('pagination::bootstrap-4') }}
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
                }).then((result) => {
                    if (result.value) {
                        $('#formdel' + model_id).submit();
                    }
                })
            })
        }
    </script>
@endpush
