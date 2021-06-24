@extends('layouts.app')
@section('title', 'Menu')
@section('content')
<script type="text/javascript">
    require('jquery-countdown');
</script>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Bienvenido chofer') }}</div>
                <div class="card-body">
                    <div class="container my-4">
                    @if ($viaje != null)
                        <?php
                            $fecha = Carbon\Carbon::parse($viaje->fecha);
                            $cambioHora = $fecha->addHours(3)->format('Y-m-d H:i:s');
                            $fechaViaje = strtotime($cambioHora);
                            $fechaViaje = $fechaViaje * 1000;
                        ?>
                        <!-- Countdown 4-->
                        <div class="rounded bg-gradient-4 text-white shadow p-5 text-center mb-5">
                            <p class="mb-0 font-weight-bold text-uppercase"></p>
                            <div id="countdown" class="countdown py-4"></div>
                            <!-- Call to actions 
                            <ul class="list-inline">
                                <li class="list-inline-item pt-2">
                                    <button id="btn-reset" type="button" class="btn btn-demo"><i class="glyphicon glyphicon-repeat"></i>Reset</button>
                                </li>
                                <li class="list-inline-item pt-2">
                                    <button id="btn-pause" type="button" class="btn btn-demo"><i class="glyphicon glyphicon-repeat"></i>Pause</button>
                                </li>
                                <li class="list-inline-item pt-2">
                                    <button id="btn-resume" type="button" class="btn btn-demo"><i class="glyphicon glyphicon-repeat"></i>Resume</button>
                                </li>
                            </ul> -->
                        </div>
                    

<script type="text/javascript">
// set the date we're counting down to
// var target_date = new Date('April, 1, 2022').getTime();
// var target_date = new Date('2021-06-15 18:00:00').getTime();

var target_date = {{$fechaViaje}};
 
// variables for time units
var days, hours, minutes, seconds;
 
// get tag element
var countdown = document.getElementById('countdown');
 
// update the tag with id "countdown" every 1 second
setInterval(function () {
 
    // find the amount of "seconds" between now and target
    current_date = new Date().getTime();
    seconds_left = (target_date - current_date) / 1000;
     
    // do some time calculations
    days = parseInt(seconds_left / 86400);
    seconds_left = seconds_left % 86400;
        
    hours = parseInt(seconds_left / 3600);
    seconds_left = seconds_left % 3600;
       
    minutes = parseInt(seconds_left / 60);
    seconds = parseInt(seconds_left % 60);
    
    if ((seconds < 0) && ({{$viaje->estado}} == 1)){
        countdown.innerHTML =   '<p>El viaje está listo para empezar</p>' +
                                '<ul class="list-inline">' + 
                                    '<li class="list-inline-item pt-2">' + 
                                        '<a id="btn-reset" type="button" class="btn btn-demo" href="{{route('combi19.iniciarViaje', [$viaje])}}"><i class="glyphicon glyphicon-repeat"></i>Iniciar viaje</a>' +
                                    '</li>';
        }
    else {
        // format countdown string + set tag value
    countdown.innerHTML = '<p>Tiempo hasta el próximo viaje</p> <p class="days">' + days +  ' <label>Días</label></p> <p class="hours">' + hours + ' <label>Horas</label></p> <p class="minutes">' + minutes + ' <label>Minutos</label></p> <p class="seconds">' + seconds + ' <label>Segundos</label></p>';
    }
    countdown.innerHTML = countdown.innerHTML + '<li class="list-inline-item pt-2">' +
                                                    '<button type="button" data-toggle="modal" data-target="#viajeModal{{$viaje->id}}" class="btn btn-demo">Info del viaje</button>' +
                                                '</li>' +
                                                '<li class="list-inline-item pt-2">' +
                                                    '<a id="btn-pause" type="button" class="btn btn-demo" href="{{ route('combi19.misViajesChofer') }}"><i class="glyphicon glyphicon-repeat"></i>Ver mis viajes</a>';
}, 1000);
</script>

                        <!-- Modal -->
                        <div class="modal fade" id="viajeModal{{$viaje->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Información del viaje</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <label class="col-form-label text-md-right">
                                                    Ruta: {{$viaje->ruta->origen->nombre}} - {{$viaje->ruta->destino->nombre}}
                                                </label>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label class="col-form-label text-md-right">
                                                    Descripción: {{$viaje->ruta->descripcion}}
                                                </label>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label class="col-form-label text-md-right">
                                                    Tipo de combi: {{$viaje->combi->tipo}}
                                                </label>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label class="col-form-label text-md-right">
                                                    Fecha: {{$viaje->fecha_sin_segundos()}}
                                                </label>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label class="col-form-label text-md-right">
                                                    Capacidad: {{$viaje->capacidad()}}
                                                </label>
                                            </div>
                                        </div>
                                        <div class="modal-footer btn-group" role="group">
                                            <a href="{{route('combi19.listaPasajeros', [$viaje->id])}}" class="btn btn-primary shadow-none" type="button">Lista de pasajeros</a>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                {{ __('Salir') }}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    @else
                        <h2>No tienes viajes pendientes</h2>
                    @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection