<form action="{{ route('users.index') }}">
    <div class="card mb-2">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <span>Filtros de búsqueda</span>
            <button type="button" class="btn btn-sm btn-light" id="toggleFilter">Ocultar Filtros</button>
        </div>
        <div class="card-body" id="filterBody">
            <div class="row">
                <div class="col col-sm-4">
                    <div class="form-group">
                        <label for="filter_name">Nombre</label>
                        <input type="text" class="form-control" name="filter_name" id="filter_name" value="{{ request()->filter_name }}">
                    </div>
                </div>
                <div class="col col-sm-4">
                    <div class="form-group">
                        <label for="filter_identification">Identificación</label>
                        <input type="text" class="form-control" name="filter_identification" id="filter_identification" value="{{ request()->filter_identification }}">
                    </div>  
                </div>
                <div class="col col-sm-4">
                    <div class="form-group">
                        <label for="filter_phone">Telefono</label>
                        <input type="text" class="form-control" name="filter_phone" id="filter_phone" value="{{ request()->filter_phone }}">
                    </div>
                </div>
                <div class="col col-sm-4">
                    <div class="form-group">
                        <label for="filter_email">Correo</label>
                        <input type="text" class="form-control" name="filter_email" id="filter_email" value="{{ request()->filter_email }}">
                    </div>
                </div>
                <div class="col col-sm-4">
                    <div class="form-group">
                        <label for="filter_address">Dirección</label>
                        <input type="text" class="form-control" name="filter_address" id="filter_address" value="{{ request()->filter_address }}">
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col">
                    <button type="submit" class="btn btn-primary">Buscar</button>
                    <a href="{{ route('users.index') }}" class="btn btn-secondary">Mostrar Todo</a>
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
