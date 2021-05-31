@extends('layouts.app')

@section('title', 'Mi Suscripción')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-20">
			<div class="card">
				<div class="card-header">{{ __('¿Cuánto ahorré?') }}</div>
				<div class="card-body">
					{{-- @if(Session::has('messageNO'))
					<div class="alert alert-danger alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						{{Session::get('messageNO')}}
					</div>
					@elseif(Session::has('messageSI'))
					<div class="alert alert-success alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						{{Session::get('messageSI')}}
					</div>
					@endif --}}
					<table class="table table-bordered">
						El precio gold está hardcodeado
						@if($misViajes[0] !== null)
							<thead>
								<tr>
									<th>Ruta</th>
									<th>Combi</th>
									<th>Insumos</th> {{-- del pasaje --}}
									<th>Fecha</th>
									<th>Precio</th> {{-- del pasaje con los costos de aquel entonces--}}
									<th>Precio Gold</th>
									<th>Ahorraste</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$totalViajes = 0;
									$totalViajesGold = 0;
									$ahorroTotal = 0;
								?>
								@foreach ($misViajes as $viaje)
									<?php
										$pasaje = (App\Models\Pasaje::where('viaje_id','=', $viaje->id)->where('pasajero_id','=',$pasajero->id)->get()); 	
										$insumos = (App\Models\Insumos_pasaje::withTrashed()->where('pasaje_id', '=', $pasaje[0]->id)->get());

										// calculando el precio para un viaje
										$costo_insumos = 0;
										foreach ($insumos as $insumo) { 
											$costo_insumos += ($insumo->precio_al_reservar * $insumo->cantidad); //sumo lo que costaron los insumos en aquel entonces
										}
										$total = $pasaje[0]->precio_viaje + $costo_insumos; //sumo el precio del viaje en aquel entonces + $costo_insumos
										$totalGold = $pasaje[0]->precio; //precio Gold
										$ahorro = $total - $totalGold; //cuánto ahorré
									?>
									@if ($ahorro > 0 && $pasaje[0]->estado == 3)
										<?php
											$totalViajes += $total; //sumo el precio del viaje al total de los viajes
											$totalViajesGold += $totalGold; //sumo el precio gold del viaje al total gold de los viajes
											$ahorroTotal += $ahorro; //sumo el ahorro del viaje al ahorro total de los viajes
										?>
										{{-- muestro el viaje --}}
										<tr>
											<td>{{$viaje->ruta->origen->nombre}} - {{$viaje->ruta->destino->nombre}}</td>
											<td>{{$viaje->combi->patente}}</td>
											<td>
												<dl class="dl-horizontal">
													@foreach ($insumos as $insumo)
														<dt>{{$insumo->insumo->nombre}} <small>(x{{$insumo->cantidad}})</small></dt>
														<dd>{{$insumo->insumo->descripcion}}</dd>
													@endforeach
												</dl>
											</td>
											<td>{{$viaje->fecha}}</td>
											<td>{{$total}}</td>
											<td>{{$totalGold}}</td>
											<td>{{$ahorro}}</td>
										</tr>
									@endif
								@endforeach	
							</tbody>
							<tfoot>
								<tr>
									<th colspan="3"></th>
									<th>Totales</th>
									<th>{{$totalViajes}}</th>
									<th>{{$totalViajesGold}}</th>
									<th>{{$ahorroTotal}}</th>
								</tr>
							</tfoot>
                        @else
						    <h1>No has realizado ningún viaje</h1>
						@endif 
                    </table>
					@if(Session::has('message'))
						<div class="alert alert-danger alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							{{Session::get('message')}}
						</div>
					@endif

					{{$misViajes->links()}}
				</div>
			</div>
            <div class="card">
                <div class="card-body">
						@if ($suscripcion->fecha_baja == null)
							<h6>Estado: 
								<strong style="color: green">Activa</strong>
							</h6>
							<form action="{{route('combi19.prepararCancelacion', Auth::user()->email)}}" class="formulario-eliminar" method="GET">
								@csrf
								<button class="btn btn-info " data-toggle="tooltip">Cancelar Suscripcion</button>
							</form>
						@else
							<h6>Estado:
								<strong style="color: rgb(0, 102, 255)">Activa hasta el {{$suscripcion->fecha_baja}} </strong>
							</h6>
						@endif
					{{-- <a class="btn btn-info " href="{{ route('combi19.modificarTarjeta', Auth::user()->email) }}">Cancelar Suscripcion</a> --}}
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h6>Tarjeta: <small>************{{substr($tarjeta->numero,12,15)}}</small>
                        <a class="btn btn-info " href="{{ route('combi19.modificarTarjeta', Auth::user()->email) }}">Modificar</a>
                    </h6>
                </div>
            </div>
		</div>
	</div>
</div>
@endsection