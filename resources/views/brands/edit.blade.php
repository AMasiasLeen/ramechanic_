@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-5">
        <div class="d-flex justify-content-between mb-3">
            <a class="btn btn-secondary btn-sm" href="{{ route('brands.index') }}">Regresar</a>
        </div>
        <div class="card">
            <div class="card-header p-3">
                <h5 class="mb-0">Editar Marca</h5>
            </div>
            <form action="{{ route('brands.update', $brand) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card-body p-3">
                    <div class="row g-2">
                        <div class="col-12">
                            <label for="name" class="form-label">Nombre de la Marca</label>
                            <input name="name" type="text" 
                                class="form-control form-control-sm @error('name') is-invalid @enderror" 
                                id="name" 
                                value="{{ old('name', $brand->name) }}"
                                required>
                            
                            @error('name')
                                <div class="invalid-feedback">
                                    @if($message == 'The name has already been taken.')
                                        Esta marca ya se encuentra registrada
                                    @else
                                        {{ $message }}
                                    @endif
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div class="card-footer p-3 d-flex gap-2">
                    <button class='btn btn-primary btn-sm px-4' type="submit">Guardar</button>
            </form>
                    <form method="POST" action="{{ route('brands.destroy', $brand) }}">
                        @csrf
                        @method('DELETE')
                        <!-- <button type="submit" class="btn btn-danger btn-sm">Eliminar</button> -->
                    </form>
                </div>
        </div>
    </div>
</div>
@endsection
