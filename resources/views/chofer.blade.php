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
                        <!-- Countdown 4-->
                        <div class="rounded bg-gradient-4 text-white shadow p-5 text-center mb-5">
                            <p class="mb-0 font-weight-bold text-uppercase"></p>
                            <div id="countdown" class="countdown py-4"></div>
                            <!-- Call to actions -->
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
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <?php
                $fecha = Carbon\Carbon::parse($viaje->fecha);
                $cambioHora = $fecha->addHours(3)->format('Y-m-d H:i:s');
                $fechaViaje = strtotime($cambioHora);
                $fechaViaje = $fechaViaje * 1000;
            ?>
        </div>
    </div>
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
 
    reset();
    
    if ((seconds < 0) && ({{$viaje->estado}} == 2)){
        <?php
            $viaje = new App\Models\Viaje;
            $viaje = $viaje->siguiente_chofer();
            $fecha = Carbon\Carbon::parse($viaje->fecha);
            $cambioHora = $fecha->addHours(3)->format('Y-m-d H:i:s');
            $fechaViaje = strtotime($cambioHora);
            $fechaViaje = $fechaViaje * 1000;
        ?>
        target_date = {{$fechaViaje}};
        reset();
    }

    // format countdown string + set tag value
    countdown.innerHTML = '<p>Tiempo hasta el próximo viaje</p> <p class="days">' + days +  ' <label>Días</label></p> <p class="hours">' + hours + ' <label>Horas</label></p> <p class="minutes">' + minutes + ' <label>Minutos</label></p> <p class="seconds">' + seconds + ' <label>Segundos</label></p>';
}, 1000);

const reset = function() {
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
}
</script>
@endsection