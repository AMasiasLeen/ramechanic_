<form action="{{ route('brands.index') }}">
    <div class="card mb-2">
        <div class="card-body">
            <div class="row">
                <div class="col col-sm-4">
                    <div class="form-group">
                        <label for="">Marca</label>
                        <input type="text" class="form-control" name="filter_brand">
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col">
                    <button type="submit" class="btn btn-primary">Buscar</button>
                    <button type="submit" class="btn btn-primary">Mostrar Todo</button>
                </div>
            </div>
        </div>
    </div>

</form>
