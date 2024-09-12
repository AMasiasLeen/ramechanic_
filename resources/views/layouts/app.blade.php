<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @stack('css')
</head>

<body>

    <div class="wrapper">
        <aside id="sidebar">
            <div class="d-flex">
                <button class="toggle-btn" type="button">
                    <i class="fa-solid fa-bars"></i></i>
                </button>
                <div class="sidebar-logo">
                    <a href="#">Ramechanic</a>
                </div>
            </div>
            <ul class="sidebar-nav">
                <li class="sidebar-item">
                    <a href="{{ route('users.profile',['user'=>Auth::id()]) }}" class="sidebar-link">
                        <i class="fa-solid fa-circle-user"></i>
                        <span>Ver Perfil</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('records.user_records') }}" class="sidebar-link">
                        <i class="fa-solid fa-book"></i>
                        <span>Antecedentes</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                        <i class="fa-solid fa-person-chalkboard"></i>
                        <span>Instrucciones</span>
                    </a>
                </li>
                @if (Auth::user()->hasRole('admin'))
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                            data-bs-target="#multi" aria-expanded="false" aria-controls="multi">
                            <i class="fa-regular fa-clipboard"></i>
                            <span>Administración</span>
                        </a>
                        <ul id="multi" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link collapsed" data-bs-toggle="collapse"
                                    data-bs-target="#records" aria-expanded="false" aria-controls="records">
                                    Registros
                                </a>
                                <ul id="records" class="sidebar-dropdown list-unstyled collapse">
                                    <li class="sidebar-item">
                                        <a href="{{ route('brands.index') }}" class="sidebar-link"><i
                                                class="fa-solid fa-car-side"></i>Marcas</a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="{{ route('vehicle-models.index') }}" class="sidebar-link"><i
                                                class="fa-solid fa-boxes-stacked"></i>Modelos</a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="{{ route('vehicles.index') }}" class="sidebar-link"><i
                                                class="fa-solid fa-car"></i>Vehículos</a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="{{ route('records.index') }}" class="sidebar-link">Antecedentes</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        <ul id="multi" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link collapsed" data-bs-toggle="collapse"
                                    data-bs-target="#users" aria-expanded="false" aria-controls="users">
                                    Perfiles
                                </a>
                                <ul id="users" class="sidebar-dropdown list-unstyled collapse">
                                    <li class="sidebar-item">
                                        <a href="{{ route('users.index') }}" class="sidebar-link"><i
                                                class="fa-solid fa-users"></i>Usuarios</a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="{{ route('roles.index') }}" class="sidebar-link"><i
                                                class="fa-solid fa-user-shield"></i>Roles</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                @endif
                <li class="sidebar-footer"> <a href="#" class="sidebar-link">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button><i class="fa-solid fa-arrow-right-from-bracket"></i>Logout</button>

                        </form>
                    </a>
                </li>
            </ul>
            <div >

            </div>
        </aside>
        <div class="main p-3">
            <div>
                <h1>
                    @yield('content')
                </h1>
            </div>
        </div>
    </div>

    @stack('js')

</body>

</html>
