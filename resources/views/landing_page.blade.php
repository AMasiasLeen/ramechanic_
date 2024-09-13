<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <title>Document</title>

</head>

<body>
    <div class="container-fluid px-0">

        <!-- Navbar -->
        <div class="container">
            <header
                class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between pt-3 pb-2">
                <a class="col-md-3 d-flex align-items-center mb-2 mb-md-0 h4 text-white text-decoration-none text-uppercase"
                    href="/">
                    <span class="fa-solid fa-wrench"> ra</span>
                    mechanic
                </a>

                <div class="col-md-3 text-end">
                    @guest
                        <!-- Show 'Iniciar Sesión' dropdown for guests -->
                        <div class="dropdown">
                            <button class="btn btn-outline-light dropdown-toggle" type="button" id="loginDropdown"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Iniciar Sesión
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="loginDropdown">
                                <li><a class="dropdown-item" href="{{ route('login') }}">Login</a></li>
                            </ul>
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
                                <li><a class="dropdown-item" href="{{ route('records.user_records') }}">Antecedentes</a>
                                </li>
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

        <hr class="text-secondary">

        <!-- Hero -->
        <section class="py-5">
            <div class="container px-5">
                <div class="row align-items-center">
                    <div class="col-lg-8 col-xl-7 col-xxl-6">
                        <div class="text-center my-5">
                            <h2 class="text-white fw-bold mb-2">Lorem ipsum dolor</h2>
                            <h2 class="text-primary fw-bold mb-2">sit amet amet consectetur</h2>
                            <p class="lead text-secondary mb-4">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ut maximus nisi.
                                Suspendisse porttitor nibh lacus, sed pretium erat.
                            </p>
                            <div class="d-grid gap-2 d-sm-flex justify-content-center mb-5">
                                <button type="button"
                                    class="btn btn-primary btn-lg text-white text-uppercase px-4 me-sm-3 rounded-0">
                                    Learn More
                                    <span class="material-icons-outlined ms-2">help_outline</span>
                                </button>
                                <button type="button" id="demo"
                                    class="btn btn-outline-primary btn-lg text-uppercase px-4 me-sm-3 rounded-0">
                                    View Demo
                                    <span class="material-icons-outlined ms-2">play_circle</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-5 col-xxl-6 justify-content-center">
                        <img class="img-fluid rounded-2 my-5" src="images/hero.jpg" alt="Hero Image">
                    </div>
                </div>
            </div>
        </section>
        <!-- End Hero -->

        <hr class="text-secondary">

        <main>
            <!-- Antecedentes Section -->
            <section class="container px-4 py-5">
                <h2 class="text-center text-white fw-bold pb-2">Antecedentes</h2>

                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                    @foreach ($records as $record)
                        <div class="col">
                            <div class="card h-100 bg-dark text-white shadow-sm">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $record->vehicle->vehicle_model->brand->name }} -
                                        {{ $record->vehicle->vehicle_model->name }}</h5>
                                    <p class="card-text"><strong>Propietario:</strong>
                                        {{ $record->vehicle->owner->name }}</p>
                                    <p class="card-text"><strong>Placa:</strong> {{ $record->vehicle->plate }}</p>
                                    <p class="card-text"><strong>Descripción Corta:</strong>
                                        {{ $record->short_description }}</p>
                                    <button type="button" class="btn btn-outline-light" data-bs-toggle="modal"
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
                                        <h5 class="modal-title" id="recordModalLabel{{ $record->id }}">Detalles del
                                            Antecedente</h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p><strong>Propietario:</strong> {{ $record->vehicle->owner->name }}</p>
                                        <p><strong>Vehículo:</strong>
                                            {{ $record->vehicle->vehicle_model->brand->name }} -
                                            {{ $record->vehicle->vehicle_model->name }}</p>
                                        <p><strong>Placa:</strong> {{ $record->vehicle->plate }}</p>
                                        <p><strong>Fecha de Registro:</strong> {{ $record->date_in }}</p>
                                        <p><strong>Descripción Completa:</strong> {{ $record->long_description }}</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Cerrar</button>
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
    <footer class="text-center text-secondary py-4">
        <div class="container px-5 mb-2">
            Copy &copy; Richal siempre Richal's
        </div>
    </footer>
    <!-- End Footer -->

</body>

</html>
