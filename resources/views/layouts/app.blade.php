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
    <div class="d-flex">

        <aside id="sidebar" class="sidebar-toggle">
            <div class="sidebar-logo">
                <a href="{{ route('home') }}">RAMECHANIC</a>
            </div>
            <!-- Sidebar Navigation -->
            <ul class="sidebar-nav p-0">
                <li class="sidebar-header">
                    Herramientas
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('landing_page') }}" class="sidebar-link">
                        <i class="fa-solid fa-house"></i>
                        <span>Pagina Principal</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('users.profile', ['user' => Auth::id()]) }}" class="sidebar-link">
                        <i class="fa-solid fa-circle-user"></i>
                        <span>Perfil</span>
                    </a>
                </li>
                @if (Auth::user()->hasRole('user'))
                    <li class="sidebar-item">
                        <a href="{{ route('records.user_records') }}" class="sidebar-link">
                            <i class="fa-solid fa-book-open"></i>
                            <span>Antecedentes</span>
                        </a>
                    </li>
                    {{-- <li class="sidebar-item">
                        <a href="{{ route('vehicles.user_vehicles') }}" class="sidebar-link">
                            <i class="fa-solid fa-book-open"></i>
                            <span>Vehiculos</span>
                        </a>
                    </li> --}}
                @endif
                @if (Auth::user()->hasRole('admin') || Auth::user()->hasRole('mecanico'))
                    <li class="sidebar-header">
                        Formularios
                    </li>
                    <li class="sidebar-item">
                        <a href="{{ route('brands.index') }}" class="sidebar-link">
                            <i class="fa-solid fa-car-side"></i>
                            <span>Marcas</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{ route('vehicle-models.index') }}" class="sidebar-link">
                            <i class="fa-solid fa-boxes-stacked"></i>
                            <span>Modelos</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{ route('vehicles.index') }}" class="sidebar-link">
                            <i class="fa-solid fa-car"></i>
                            <span>Vehículos</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{ route('records.index') }}" class="sidebar-link">
                            <i class="fa-solid fa-book-bookmark"></i>
                            <span>Antecedentes</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{ route('users.index') }}" class="sidebar-link">
                            <i class="fa-solid fa-users"></i>
                            <span>Usuarios</span>
                        </a>
                    </li>
                @endif
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                            class="fa-solid fa-arrow-right-from-bracket"></i>
                        Cerrar Sesión
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </aside>
        <!-- Sidebar Ends -->
        <!-- Main Component -->
        <div class="main">
            <nav class="navbar navbar-expand">
                <button class="toggler-btn" type="button">
                    <i class="fa-solid fa-bars"></i>
                </button>
            </nav>
            <main class="p-3">
                <div class="container-fluid">
                    <div class="mb-3">
                        @yield('content')
                    </div>
                </div>
            </main>
        </div>
    </div>

    @stack('js')

</body>

</html>
