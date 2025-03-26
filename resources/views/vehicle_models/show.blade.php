@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-5">
        <div class="d-flex justify-content-between mb-3">
            <a class="btn btn-secondary btn-sm" href="{{ route('vehicle-models.index') }}">Regresar</a>
            <a class="btn btn-success btn-sm" href="{{ route('vehicle-models.create') }}">Agregar Nuevo</a>
        </div>

        <div class="card">
            <div class="card-header p-3">
                <h5 class="mb-0">Detalles del Modelo</h5>
            </div>
            
            <div class="card-body p-3">
                <div class="row g-3">
                    <!-- Detalle Modelo -->
                    <div class="col-12">
                        <label class="form-label text-muted">Modelo:</label>
                        <p class="h5">{{ $vehicle_model->name }}</p>
                    </div>

                    <!-- Detalle Marca -->
                    <div class="col-12">
                        <label class="form-label text-muted">Marca:</label>
                        <p class="h5">{{ $vehicle_model->brand->name }}</p>
                    </div>
                </div>
            </div>

            <div class="card-footer p-3 d-flex gap-2">
                <a class="btn btn-primary btn-sm px-4" 
                   href="{{ route('vehicle-models.edit', $vehicle_model) }}">
                    Modificar
                </a>
                
                <form id="deleteForm" 
                      action="{{ route('vehicle-models.destroy', $vehicle_model) }}" 
                      method="POST">
                    @csrf
                    @method('DELETE')
                    <!-- <button type="button" 
                            class="btn btn-danger btn-sm" 
                            onclick="confirmDelete()">
                        Eliminar
                    </button> -->
                </form>
            </div>
        </div>
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