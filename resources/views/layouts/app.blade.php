<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <link rel="shortcut icon" href="https://i.imgur.com/MluPAaD.png" />
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>@yield('title')</title>

  <!-- Rompe el select2 -->
  <!-- <script src="{{ asset('js/app.js') }}" defer></script> -->

  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

  <!-- Font Awesome -->
  <script src="https://kit.fontawesome.com/68f775ee85.js" crossorigin="anonymous"></script>

  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>

  <!-- Links que no sabemos qué hacen -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round|Open+Sans">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

  <!-- select2 -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" type="text/javascript"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" type="text/javascript"></script>

<style type="text/css">
  /*
*
* ==================================================
* UNNECESSARY STYLE - JUST TO MAKE IT LOOKS NICE
* ==================================================
*
*/
.countdown {
    text-transform: uppercase;
    font-weight: bold;
}

.countdown span {
    text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);
    font-size: 3rem;
    margin-left: 0.8rem;
}

.countdown span:first-of-type {
    margin-left: 0;
}

.countdown-circles {
    text-transform: uppercase;
    font-weight: bold;
}

.countdown-circles span {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.2);
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
}

.countdown-circles span:first-of-type {
    margin-left: 0;
}


/*
*
* ==================================================
* FOR DEMO PURPOSES
* ==================================================
*
*/
body {
    min-height: 100vh;
}

.bg-gradient-1 {
    background: #7f7fd5;
    background: -webkit-linear-gradient(to right, #7f7fd5, #86a8e7, #91eae4);
    background: linear-gradient(to right, #7f7fd5, #86a8e7, #91eae4);
}

.bg-gradient-2 {
    background: #654ea3;
    background: -webkit-linear-gradient(to right, #654ea3, #eaafc8);
    background: linear-gradient(to right, #654ea3, #eaafc8);
}

.bg-gradient-3 {
    background: #ff416c;
    background: -webkit-linear-gradient(to right, #ff416c, #ff4b2b);
    background: linear-gradient(to right, #ff416c, #ff4b2b);
}

.bg-gradient-4 {
    background: #007991;
    background: -webkit-linear-gradient(to right, #007991, #78ffd6);
    background: linear-gradient(to right, #007991, #78ffd6);
}

.rounded {
    border-radius: 1rem !important;
}

.btn-demo {
    padding: 0.5rem 2rem !important;
    border-radius: 30rem !important;
    background: rgba(255, 255, 255, 0.3);
    color: #fff;
    text-transform: uppercase;
    font-weight: bold !important;
}

.btn-demo:hover, .btn-demo:focus {
    color: #fff;
    background: rgba(255, 255, 255, 0.5);
}
</style>

</head>
<body>
  <div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
      <div class="container">
        @if((Auth::user() != null) && (Auth::user()->tipo == 2))
          <a class="navbar-brand" href="{{ url('chofer') }}">
            <img src="https://i.imgur.com/MluPAaD.png" alt="logo_combi19" style="height: 50px; padding-right: 10px">
          </a>
        @else 
          <a class="navbar-brand" href="{{ url('homeGeneral') }}">
            <img src="https://i.imgur.com/MluPAaD.png" alt="logo_combi19" style="height: 50px; padding-right: 10px">
          </a>
        @endif
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Left Side Of Navbar -->
          <ul class="navbar-nav mr-auto">
            @guest
            <li class="nav-item">
              <a class="nav-link" href="{{ route('buscarViajeVisitante') }}">{{ __('Buscar Viajes') }}</a>
            </li>
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
              <a class="nav-link" href="{{ route('combi19.misViajesChofer') }}">{{ __('Mis Viajes') }}</a>
            </li>
            @elseif(Auth::user()->tipo == 3)
            <li class="nav-item">
              <a class="nav-link" href="{{ route('buscarViaje') }}">{{ __('Buscar Viajes') }}</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('combi19.misViajes', Auth::user()->email) }}">{{ __('Historial de Compras') }}</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('combi19.suscripcion', Auth::user()->email) }}">{{ __('Suscripción') }}</a>
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
            @if (Auth::user()->tipo == 3)
            <li class="nav-item">
              <a class="nav-link" href="{{route('cart.checkout')}}"><i class="material-icons">&#xE8CC;</i></a>
            </li>
            @endif
            <li class="nav-item dropdown">
              <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }}
              </a>

              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                  @csrf
                </form>
                @if(Auth::user()->tipo != 1)
                  @if (Auth::user()->tipo == 2)
                    <a class="dropdown-item" href="{{ route('combi19.perfilDeChofer', Auth::user()->email) }}">
                    {{ __('Mi perfil') }}
                  </a>
                  <a class="dropdown-item" href="{{ route('combi19.modificarDatosDeCuentaChofer', Auth::user()->email) }}">
                    {{ __('Editar Datos Personales') }}
                  </a>
                  @else
                    <a class="dropdown-item" href="{{ route('combi19.perfilDePasajero', Auth::user()->email) }}">
                      {{ __('Mi perfil') }}
                    </a>
                    <a class="dropdown-item" href="{{ route('combi19.modificarDatosDeCuentaPasajero', Auth::user()->email) }}">
                      {{ __('Editar Datos Personales') }}
                    </a>
                  @endif
                @endif
                <a class="dropdown-item" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                {{ __('Cerrar sesión') }}
              </a>
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

<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script>

$('.formulario-eliminar').submit(function(event){
  event.preventDefault();

  const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
      confirmButton: 'btn btn-success',
      cancelButton: 'btn btn-danger'
    },
    buttonsStyling: false
  })

  swalWithBootstrapButtons.fire({
    title: '¿Estás seguro?',
    text: "¡Este elemento se eliminará definitivamente!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: '¡Si, eliminar!',
    cancelButtonText: '¡No, cancelar!',
    reverseButtons: true
  }).then((result) => {
    if (result.isConfirmed) {
      // swalWithBootstrapButtons.fire(
      //   '¡Eliminado!',
      //   '',
      //   'success'
      // )
      this.submit();
    } else if (
      /* Read more about handling dismissals below */
      result.dismiss === Swal.DismissReason.cancel
    ) {
      swalWithBootstrapButtons.fire(
        'Cancelado',
        '',
        'error'
      )
    }
  })

});
</script>

<script type="text/javascript">
$(document).ready(function() {
  $("#e1").select2();
  var date = new Date().toISOString().
  replace(/T/, ' ').
  replace(/\..+/, '');
  $("#fecha").val(date);
  // $("#fecha").val(cTime);
});
</script>

</body>
</html>
