@extends('layouts.app')

@section('title', 'Mi Suscripción')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-20">
			<div class="card">
				<div class="card-header">{{ __('Mi Suscripción') }}</div>
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
						@if($misViajes[0] !== null)
						<thead>
							<tr>
								<th>Ruta</th>
								<th>Combi</th>
								<th>Insumos</th>
								<th>Fecha</th>
                                <th>Precio</th>
                                <th>Precio Gold</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($misViajes as $viaje)
							<tr>
								<td>{{$viaje->ruta->origen->nombre}} - {{$viaje->ruta->destino->nombre}}</td>
								<td>{{$viaje->combi->patente}}</td>
								<td>
									<dl class="dl-horizontal">
										<?php
										$insumos = (App\Models\Insumos_viaje::withTrashed()->where('viaje_id', '=', $viaje->id)->get());
										?>
										@foreach ($insumos as $insumo)
										<dt>{{$insumo->insumo->nombre}}</dt>
										<dd>{{$insumo->insumo->descripcion}}</dd>
										@endforeach
									</dl>
								</td>
								<td>{{$viaje->fecha}}</td>
                                <td>{{$viaje->precio}}</td>
                                <td>un precio</td>
								@endforeach
							</tr>
						</tbody>
                        @else
						    <h1>No has realizado ningún viaje</h1>
						@endif 
                    </table>
                    
                    @if($misViajes[0] !== null)
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Total</th>
                                    <th>Total Gold</th>
                                    <th>Ahorraste</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>total</td>
                                    <td>total gold</td>
                                    <td>total - total gold</td>
                                </tr>
                            </tbody>
                        </table>
                    @endif 
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
                    <h6>Estado: <small>?</small></h6>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h6>Tarjeta: <small>************{{substr($tarjeta->numero,12,15)}}</small>
                        <a class="btn btn-info " href="#">Modificar</a>
                        <a class="btn btn-info " href="#">Cancelar Suscripcion</a>
                    </h6>
                </div>
            </div>
		</div>
	</div>
</div>
@endsection