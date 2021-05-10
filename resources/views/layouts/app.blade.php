<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Combi19</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('admin') }}">
                    <img src="../logo_combi19.png" alt="logo_combi19" style="height: 50px; padding-right: 10px">
                </a>
                <a class="navbar-brand" href="{{ url('admin') }}">
                    <h1 style="margin-bottom: 0px">Combi19</h1>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        @guest
                        @else
                            @if(Auth::user()->tipo == 1)
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('combi19.listarCombis') }}">{{ __('Combis') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('combi19.listarChoferes') }}">{{ __('Choferes') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('combi19.listarViajes') }}">{{ __('Viajes') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('combi19.listarLugares') }}">{{ __('Lugares') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('combi19.listarRutas') }}">{{ __('Rutas') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('combi19.listarInsumosTotal') }}">{{ __('Insumos') }}</a>
                                </li>
                            @elseif(Auth::user()->tipo == 2)
                                <li class="nav-item">
                                    <a class="nav-link" href="#">{{ __('Viajes') }}</a>
                                </li>
                            @elseif(Auth::user()->tipo == 3)
                                <li class="nav-item">
                                    <a class="nav-link" href="#">{{ __('Buscar Viajes') }}</a>
                                </li>
                            @endif
                        @endguest
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Iniciar sesión') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Registrarme') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <!-- <a class="dropdown-item" href="/combi19/public/combi19/listarCombis">{{ __('Combis') }}</a> -->
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>

                                    @if(Auth::user()->tipo != 1)
                                        <a class="dropdown-item" href="#">
                                            {{ __('Editar Datos Personales') }}
                                        </a>
                                    @endif
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
