@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <!-- Cabecera -->
            <div class="col-md-12 mb-4">
                <div class="card shadow-sm border-0">
                    <div class="card-body bg-primary text-white">
                        <h2 class="text-center mb-0">Dashboard de Administración</h2>
                        <p class="text-center mb-0">Visualiza y gestiona las estadísticas del sistema de forma centralizada.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Estadísticas -->
            <div class="row">
                <!-- Total Vehículos -->
                <div class="col-md-3 mb-4">
                    <div class="card shadow-sm border-0">
                        <div class="card-body text-center">
                            <h5 class="text-secondary">Total Vehículos</h5>
                            <h2 class="text-dark font-weight-bold">{{ $totalVehicles }}</h2>
                        </div>
                    </div>
                </div>

                <!-- Total Modelos -->
                <div class="col-md-3 mb-4">
                    <div class="card shadow-sm border-0">
                        <div class="card-body text-center">
                            <h5 class="text-secondary">Total Modelos</h5>
                            <h2 class="text-dark font-weight-bold">{{ $totalModels }}</h2>
                        </div>
                    </div>
                </div>

                <!-- Total Marcas -->
                <div class="col-md-3 mb-4">
                    <div class="card shadow-sm border-0">
                        <div class="card-body text-center">
                            <h5 class="text-secondary">Total Marcas</h5>
                            <h2 class="text-dark font-weight-bold">{{ $totalBrands }}</h2>
                        </div>
                    </div>
                </div>

                <!-- Total Usuarios -->
                <div class="col-md-3 mb-4">
                    <div class="card shadow-sm border-0">
                        <div class="card-body text-center">
                            <h5 class="text-secondary">Total Usuarios</h5>
                            <h2 class="text-dark font-weight-bold">{{ $totalUsers }}</h2>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Gráficos -->
            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="card shadow-sm border-0">
                        <div class="card-body">
                            <h5 class="card-title text-secondary">Distribución de Vehículos por Marca</h5>
                            <canvas id="vehiclesByBrandChart"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mb-4">
                    <div class="card shadow-sm border-0">
                        <div class="card-body">
                            <h5 class="card-title text-center">Distribución de Vehículos por Modelo</h5>
                            <div style="max-width: 100%; height: 300px;">
                                <canvas id="vehiclesByModelChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Filtrar las 5 principales marcas y modelos

        const brands = {!! json_encode(array_slice($bb->toArray(), 0, 5)) !!};
        const top5VehiclesPerBrand = {!! json_encode(array_slice($vehiclesPerBrand->toArray(), 0, 5)) !!};
        const top5Models = {!! json_encode(array_slice($modelNames->toArray(), 0, 5)) !!};
        const top5VehiclesPerModel = {!! json_encode(array_slice($vehiclesPerModel->toArray(), 0, 5)) !!};

        // Gráfico de Vehículos por Marca
        const vehiclesByBrandCtx = document.getElementById('vehiclesByBrandChart').getContext('2d');
        new Chart(vehiclesByBrandCtx, {
            type: 'bar',
            data: {
                labels: brands.map(b => b.name),
                datasets: [{
                    label: 'Cantidad de Vehículos',
                    data: top5VehiclesPerBrand,
                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        const vehiclesByModelCtx = document.getElementById('vehiclesByModelChart').getContext('2d');
        new Chart(vehiclesByModelCtx, {
            type: 'pie',
            data: {
                labels: top5Models,
                datasets: [{
                    label: 'Cantidad de Vehículos',
                    data: top5VehiclesPerModel,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.6)',
                        'rgba(54, 162, 235, 0.6)',
                        'rgba(75, 192, 192, 0.6)',
                        'rgba(153, 102, 255, 0.6)',
                        'rgba(255, 159, 64, 0.6)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false, // Para que se ajuste dinámicamente
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    </script>
@endpush
