<form action="{{ route('vehicles.index') }}">
    <div class="card mb-2">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <span>Filtros de búsqueda</span>
            <button type="button" class="btn btn-sm btn-light" id="toggleFilter">Ocultar Filtros</button>
        </div>
        <div class="card-body" id="filterBody">
            <div class="row">
                <div class="col col-sm-4">
                    <div class="form-group">
                        <label for="filter_owner">Propietario</label>
                        <input type="text" class="form-control" name="filter_owner" id="filter_owner" value="{{ request()->filter_owner }}">
                    </div>  
                </div>
                <div class="col col-sm-4">
                    <div class="form-group">
                        <label for="filter_plate">Placa</label>
                        <input type="text" class="form-control" name="filter_plate" id="filter_plate" value="{{ request()->filter_plate }}">
                    </div>
                </div>
                <div class="col col-sm-4">
                    <div class="form-group">
                        <label for="filter_brand">Marca</label>
                        <input type="text" class="form-control" name="filter_brand" id="filter_brand" value="{{ request()->filter_brand }}">
                    </div>
                </div>
                <div class="col col-sm-4">
                    <div class="form-group">
                        <label for="filter_model">Modelo</label>
                        <input type="text" class="form-control" name="filter_model" id="filter_model" value="{{ request()->filter_model }}">
                    </div>
                </div>
                <div class="col col-sm-4">
                    <div class="form-group">
                        <label for="filter_color">Color</label>
                        <input type="text" class="form-control" name="filter_color" id="filter_color" value="{{ request()->filter_color }}">
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col">
                    <button type="submit" class="btn btn-primary">Buscar</button>
                    <a href="{{ route('vehicles.index') }}" class="btn btn-secondary">Mostrar Todo</a>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var filterBody = document.getElementById('filterBody');
        var toggleFilterButton = document.getElementById('toggleFilter');

        filterBody.style.display = "none";
        toggleFilterButton.textContent = "Mostrar Filtros";

        toggleFilterButton.addEventListener('click', function() {
            if (filterBody.style.display === "none") {
                filterBody.style.display = "block";
                this.textContent = "Ocultar Filtros";
            } else {
                filterBody.style.display = "none";
                this.textContent = "Mostrar Filtros";
            }
        });
    });
</script>