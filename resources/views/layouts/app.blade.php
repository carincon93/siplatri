<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/custom.js') }}" defer></script>
    <script src="{{ asset('js/velocity.min.js') }}" defer></script>

    <!-- Fonts -->
    {{-- <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css"> --}}

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
</head>
<body class="{{ !Auth::user() ? 'body-login' : '' }}">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel {{ !Auth::user() ? 'd-none' : '' }}">
            <div class="container">
                <a class="navbar-brand d-none d-md-block" href="{{ url('/') }}">
                    {{-- <span class="logotipo">{{ config('app.name', 'SIPLATRI') }}</span> --}}
                    <img src="{{ asset('images/logo.png') }}" alt="Sistema de programación trimestral" class="img-fluid" width="32px">
                </a>
                <button class="navbar-toggler border-0" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse d-md-none" id="navbarSupportedContent">

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto d-none d-md-block">
                        <!-- Authentication Links -->
                        @guest
                            {{-- <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Iniciar sesión') }}</a>
                            </li>
                            <li class="nav-item">
                                @if (Route::has('register'))
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Registrarse') }}</a>
                                @endif
                            </li> --}}
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle text-capitalize" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->nombre }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Cerrar sesión') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        @auth
            {{-- @can ('admin') --}}
                <aside class="aside-bar shadow">
                    {{-- <header class="p-3">
                        <img src="{{ asset('images/logo.png') }}" alt="Sistema de programación trimestral" class="img-fluid d-block m-auto">
                    </header> --}}
                    <ul class="flex-column nav pb-4 pt-4">

                        @if (!empty($trimestreActivo) && Auth::user())
                            <li class="aside-header position-relative">
                                <p class="text-left m-0"><strong>Trimestre actual:</strong> {{ $trimestreActivo->trimestre.' / '.$trimestreActivo->ano }}</p>
                                <p class="text-left m-0 small"><strong><span class="fecha">{{ $trimestreActivo->fechaInicio }}</span> / <br><span class="fecha">{{ $trimestreActivo->fechaFin }}</span></strong></p>
                                @can ('admin')
                                    <a href="{{ route('trimestres.index') }}" class="btn btn-sm border-0 position-absolute mb-2 editar-trimestre">
                                        <i class="fa fa-fw fa-edit"></i>
                                    </a>
                                @endcan
                            </li>
                        @endif
                        @can ('almacenista')
                            <li class="nav-item">
                                <a class="nav-link link-importante {{ Request::is('programaciones*') ? 'active' : '' }}" href="{{ route('programaciones.index') }}">
                                    <i class="fas fa-fw fa-calendar-alt"></i> Programaciones
                                </a>
                            </li>
                        @endcan
                        @can ('admin')
                            <li class="nav-item">
                                <a class="nav-link link-importante {{ Request::is('programaciones*') ? 'active' : '' }}" href="{{ route('programaciones.index') }}">
                                    <i class="fas fa-fw fa-calendar-alt"></i> Programaciones
                                    @if (!empty($trimestreEnProgramacion) && Auth::user())
                                        @can('admin')
                                                <p class="text-left m-0 small"><strong>Trimestre (Programando):</strong> {{ $trimestreEnProgramacion->trimestre.' / '.$trimestreEnProgramacion->ano }}</p>
                                                <p class="text-left m-0 small"><strong><span class="fecha">{{ $trimestreEnProgramacion->fechaInicio }}</span> / <br><span class="fecha">{{ $trimestreEnProgramacion->fechaFin }}</span></strong></p>
                                        @endcan
                                    @endif
                                </a>
                            </li>
                        @endcan
                        @can('admin')
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('trimestres*') ? 'active' : '' }}" href="{{ route('trimestres.index') }}">Trimestres</a>
                        </li>
                        @endcan
                        @can ('almacenista')
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('ambientes*') ? 'active' : '' }}" href="{{ route('ambientes.index') }}">Ambientes</a>
                            </li>
                        @endcan
                        @can ('admin')
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('ambientes*') ? 'active' : '' }}" href="{{ route('ambientes.index') }}">Ambientes</a>
                            </li>
                        @endcan
                        @can('admin')
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('competencias*') ? 'active' : '' }}" href="{{ route('competencias.index') }}">Competencias</a>
                        </li>
                        @endcan
                        @can('admin')
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('franjas*') ? 'active' : '' }}" href="{{ route('franjas.index') }}">Franjas</a>
                        </li>
                        @endcan
                        @can('admin')
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('municipios*') ? 'active' : '' }}" href="{{ route('municipios.index') }}">Municipios</a>
                        </li>
                        @endcan
                        @can('almacenista')
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('programas_formacion*') ? 'active' : '' }}" href="{{ route('programas_formacion.index') }}">Programas de formación</a>
                        </li>
                        @endcan
                        @can('admin')
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('programas_formacion*') ? 'active' : '' }}" href="{{ route('programas_formacion.index') }}">Programas de formación</a>
                        </li>
                        @endcan
                        @can('admin')
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('resultados_aprendizaje*') ? 'active' : '' }}" href="{{ route('resultados_aprendizaje.index') }}">Resultados de aprendizaje</a>
                        </li>
                        @endcan
                        @can ('almacenista')
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('users*') ? 'active' : '' }}" href="{{ route('users.index') }}">Instructores</a>
                            </li>
                        @endcan
                        @can ('admin')
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('users*') ? 'active' : '' }}" href="{{ route('users.index') }}">Instructores</a>
                            </li>
                        @endcan
                        @can('admin')
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('actividades*') ? 'active' : '' }}" href="{{ route('actividades.index') }}">Otras actividades</a>
                        </li>
                        @endcan
                        @can('admin')
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('filtros*') ? 'active' : '' }}" href="{{ route('filtros') }}">Búsqueda avanzada</a>
                        </li>
                        @endcan
                        @can('almacenista')
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('filtros*') ? 'active' : '' }}" href="{{ route('filtros') }}">Búsqueda avanzada</a>
                        </li>
                        @endcan
                    </ul>
                </aside>
            {{-- @endcan --}}
        @endauth

        <main class="{{ Auth::user() ? 'auth mt-5 mt-lg-0' : 'main-login d-flex justify-content-center align-items-center' }}">
            @yield('content')
        </main>
    </div>

    @stack('scripts')
</body>
</html>
