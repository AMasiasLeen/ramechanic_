<form action="{{ route('records.index') }}">
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
                        <label for="filter_vehicle">Vehículo</label>
                        <input type="text" class="form-control" name="filter_vehicle" id="filter_vehicle" value="{{ request()->filter_vehicle }}">
                    </div>
                </div>
                <div class="col col-sm-4">
                    <div class="form-group">
                        <label for="filter_description">Descripción</label>
                        <input type="text" class="form-control" name="filter_description" id="filter_description" value="{{ request()->filter_description }}">
                    </div>
                </div>
                <div class="col col-sm-4">
                    <div class="form-group">
                        <label for="filter_date">Fecha de Registro</label>
                        <input type="date" class="form-control" name="filter_date" id="filter_date" value="{{ request()->filter_date }}">
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col">
                    <button type="submit" class="btn btn-primary">Buscar</button>
                    <a href="{{ route('records.index') }}" class="btn btn-secondary">Mostrar Todo</a>
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
