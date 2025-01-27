<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <title>Inicio</title>

</head>

<body>
    <div class="container-fluid px-0">

        <!-- Navbar -->
        <div class="container">
            <header
                class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between pt-3 pb-2">
                <a class="col-md-3 d-flex align-items-center mb-2 mb-md-0 h4 text-white text-decoration-none text-uppercase"
                    href="/">
                    <span class="fa-solid fa-wrench"> </span>
                    SOLOCHEVY
                </a>

                <div class="col-md-3 text-end">
                    @guest
                        <!-- Show 'Iniciar Sesión' dropdown for guests -->
                        <div class="dropdown">
                            <a href="{{ route('login') }}" class="btn btn-outline-light">Iniciar Sesión</a>
                        </div>
                    @else
                        <!-- Show user name and dropdown options for authenticated users -->
                        <div class="dropdown">
                            <button class="btn btn-outline-light dropdown-toggle" type="button" id="userDropdown"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="userDropdown">
                                <li><a class="dropdown-item"
                                        href="{{ route('users.edit_profile', ['user' => Auth::user()]) }}">Perfil</a></li>
                                @if (Auth::user()->hasRole('user'))
                                    <li><a class="dropdown-item" href="{{ route('records.user_records') }}">Antecedentes</a>
                                    </li>
                                @endif
                                @if (Auth::user()->hasRole('admin'))
                                    <li><a class="dropdown-item" href="{{ route('home') }}">DashBoard</a>
                                    </li>
                                @endif
                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        Cerrar Sesión
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @endguest
                </div>
            </header>
        </div>

        <hr class="border-secondary">

<!-- Hero Section -->
<section class="py-5">
    <div class="container px-5">
        <div class="row align-items-center">
            <!-- Texto de introducción -->
            <div class="col-lg-8 col-xl-7 col-xxl-6">
                <div class="my-5">
                    <h1 class="text-white fw-bold mb-4">
                        Gestor de Registros de Antecedentes Mecánicos
                    </h1>
                    <p class="lead text-light mb-4">
                        Bienvenido a nuestro sistema de gestión de antecedentes mecánicos. Aquí podrás llevar un
                        control completo de los registros de vehículos, sus reparaciones, mantenimientos y mucho más.
                    </p>
                    <p class="text-light mb-4">
                        Facilita el acceso rápido a la información clave de cada vehículo, con la posibilidad de
                        gestionar, visualizar y actualizar los antecedentes de cada automóvil registrado en el sistema.
                    </p>
                </div>
            </div>

            <!-- Imagen de introducción -->
            <div class="col-xl-5 col-xxl-6 d-flex justify-content-center">
                <img class="img-fluid rounded-3 shadow-lg" style="max-height: 400px; object-fit: cover;" 
                    src="{{ asset('assets/taller.jpg') }}" alt="Gestor de Antecedentes Mecánicos">
            </div>
        </div>
    </div>
</section>
<!-- End Hero Section -->


        <hr class="border-secondary">

<main>
    <!-- Antecedentes Section -->
    <section class="container px-4 py-5">
        <form action="{{ route('landing_page') }}" method="GET">
            <div class="row gy-3">
                <div class="col-12 col-sm-3">
                    <label for="start_date" class="form-label text-white">Desde:</label>
                    <input type="date" id="start_date" class="form-control" name="start_date" value="{{ request('start_date') }}">
                </div>
                <div class="col-12 col-sm-3">
                    <label for="end_date" class="form-label text-white">Hasta:</label>
                    <input type="date" id="end_date" class="form-control" name="end_date" value="{{ request('end_date') }}">
                </div>
                <div class="col-12 col-sm-6 d-flex align-items-end">
                    <button class="btn btn-primary me-2" type="submit">Buscar</button>
                    <button class="btn btn-secondary" name="reset" value="true" type="submit">Todo</button>
                </div>
            </div>
        </form>

        <h2 class="text-center text-white fw-bold pb-3 mt-4">Antecedentes</h2>

        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            @foreach ($records as $record)
                <div class="col">
                    <div class="card h-100 bg-dark text-white shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title text-center mb-3">
                                {{ $record->vehicle->vehicle_model->brand->name }} - {{ $record->vehicle->vehicle_model->name }}
                            </h5>
                            <div class="text-center mb-3">
                                <img class="img-fluid rounded" style="max-height: 150px; object-fit: cover;"
                                    src="{{ $record->vehicle->main_image ? Storage::url('vehicles/' . $record->vehicle->main_image) : asset('assets/default_car.jpg') }}"
                                    alt="Imagen del Vehículo">
                            </div>
                            <p class="card-text"><strong>Fecha Ingreso:</strong> {{ $record->date_in }}</p>
                            <p class="card-text"><strong>Descripción Corta:</strong> {{ $record->short_description }}</p>
                            <button type="button" class="btn btn-outline-light w-100 mt-2" data-bs-toggle="modal"
                                data-bs-target="#recordModal{{ $record->id }}">
                                Ver más
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="recordModal{{ $record->id }}" tabindex="-1"
                    aria-labelledby="recordModalLabel{{ $record->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content bg-dark text-white">
                            <div class="modal-header">
                                <h5 class="modal-title" id="recordModalLabel{{ $record->id }}">Detalles del Antecedente</h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p><strong>Vehículo:</strong>
                                    {{ $record->vehicle->vehicle_model->brand->name }} - {{ $record->vehicle->vehicle_model->name }}</p>
                                <p><strong>Fecha de Registro:</strong> {{ $record->date_in }}</p>
                                <p><strong>Descripción Completa:</strong> {{ $record->long_description }}</p>
                                @if ($record->images)
                                    <div id="carousel{{ $record->id }}" class="carousel slide" data-bs-ride="carousel">
                                        <div class="carousel-inner">
                                            @foreach (json_decode($record->images) as $index => $image)
                                                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                                    <img src="{{ Storage::url('records/' . $image) }}"
                                                        class="d-block w-100 img-thumbnail" alt="Imagen {{ $index + 1 }}">
                                                </div>
                                            @endforeach
                                        </div>
                                        <button class="carousel-control-prev" type="button"
                                            data-bs-target="#carousel{{ $record->id }}" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Previous</span>
                                        </button>
                                        <button class="carousel-control-next" type="button"
                                            data-bs-target="#carousel{{ $record->id }}" data-bs-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Next</span>
                                        </button>
                                    </div>
                                @endif
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $records->links('pagination::bootstrap-4') }}
        </div>
    </section>
    <!-- End Antecedentes Section -->
</main>

    </div>

    <!-- Footer -->
    <footer class="bg-dark text-secondary py-4">
    <div class="container">
        <div class="row">
            <div class="col-md-6 text-center text-md-start">
                <h5 class="text-white">Dirección del Taller</h5>
                <p>PRX2+ Calle Manuel Rivadeneira, y, Santo Domingo, Ecuador</p>
            </div>
            <div class="col-md-6 text-center text-md-end">
                <h5 class="text-white">Contacto</h5>
                <p>Teléfono: +123 456 7890</p>
                <p>Email: contacto@solochevy.com</p>
            </div>
        </div>
        <hr class="bg-secondary">
        <div class="text-center">
            <p>Copy &copy; Solo Chevy - Todos los derechos reservados.</p>
        </div>
    </div>
</footer>
    <!-- End Footer -->

</body>

</html>
