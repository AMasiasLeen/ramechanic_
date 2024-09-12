@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <!-- Bienvenida -->
            <div class="col-md-12 mb-4">
                <div class="card text-center">
                    <div class="card-body">
                        <h1>¡Bienvenid@ al Dashboard de Administración!</h1>
                    </div>
                </div>
            </div>

            <!-- Estadísticas -->
            <div class="row">
                <!-- Total Vehículos -->
                <div class="col-md-4 mb-4">
                    <div class="card text-center bg-info text-white">
                        <div class="card-body">
                            <h4>Total Vehículos</h4>
                            <h2>{{ $totalVehicles }}</h2>
                        </div>
                    </div>
                </div>

                <!-- Total Modelos -->
                <div class="col-md-4 mb-4">
                    <div class="card text-center bg-success text-white">
                        <div class="card-body">
                            <h4>Total Modelos</h4>
                            <h2>{{ $totalModels }}</h2>
                        </div>
                    </div>
                </div>

                <!-- Total Marcas -->
                <div class="col-md-4 mb-4">
                    <div class="card text-center bg-warning text-white">
                        <div class="card-body">
                            <h4>Total Marcas</h4>
                            <h2>{{ $totalBrands }}</h2>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Gráficos -->
            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Distribución de Vehículos por Marca</h5>
                            <canvas id="vehiclesByBrandChart"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Distribución de Vehículos por Modelo</h5>
                            <canvas id="vehiclesByModelChart"></canvas>
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
    // Gráfico de Vehículos por Marca
    // const vehiclesByBrandCtx = document.getElementById('vehiclesByBrandChart').getContext('2d');
    // const vehiclesByBrandChart = new Chart(vehiclesByBrandCtx, {
    //     type: 'bar',
    //     data: {
    //         labels: {!! json_encode($brandNames) !!},
    //         datasets: [{
    //             label: 'Cantidad de Vehículos',
    //             ,
    //             backgroundColor: 'rgba(54, 162, 235, 0.6)',
    //             borderColor: 'rgba(54, 162, 235, 1)',
    //             borderWidth: 1
    //         }]
    //     },
    //     options: {
    //         scales: {
    //             y: {
    //                 beginAtZero: true
    //             }
    //         }
    //     }
    // });

    // Gráfico de Vehículos por Modelo
    const vehiclesByModelCtx = document.getElementById('vehiclesByModelChart').getContext('2d');
    const vehiclesByModelChart = new Chart(vehiclesByModelCtx, {
        type: 'pie',
        data: {
            labels: {!! json_encode($modelNames) !!},
            datasets: [{
                label: 'Cantidad de Vehículos',
                data: {!! json_encode($vehiclesPerModel) !!},
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
            responsive: true
        }
    });
</script>
@endpush
