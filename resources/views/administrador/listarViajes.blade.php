@extends('layouts.app')

@section('title', 'Lista de viajes')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-20">
			<div class="card">
				<div class="card-header">{{ __('Lista de viajes') }}</div>
				<div class="card-body">
					@if(Session::has('messageNO'))
					<div class="alert alert-danger alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<a href="{{route('combi19.modificarRuta', session('ruta'))}}" class="alert-link">{{Session::get('messageNO')}}</a>
					</div>
					@elseif(Session::has('messageSI'))
					<div class="alert alert-success alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						{{Session::get('messageSI')}}
					</div>
					@endif
					<table class="table table-bordered">
						@if($viajes[0] !== null)
						<thead>
							<tr>
								<th>Ruta</th>
								<th>Precio</th>
								<th>Combi</th>
								<th>Insumos</th>
								<th>Fecha</th>
								<th>Acciones</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($viajes as $viaje)
							<tr>
								<td>{{$viaje->ruta->origen->nombre}} - {{$viaje->ruta->destino->nombre}}</td>
								<td>{{$viaje->precio}}</td>
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
								<td>
									<a href="{{route('combi19.modificarViaje', $viaje)}}" class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
									<form action="{{route('combi19.eliminarViaje', $viaje)}}" class="formulario-eliminar" method="POST">
										@csrf
										@method('delete')
										<button class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></button>
									</form>
								</td>
								@endforeach
							</tr>
						</tbody>
						@else
						<h1>No hay viajes disponibles</h1>
						@endif
					</table>
					@if(Session::has('message'))
					<div class="alert alert-danger alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						{{Session::get('message')}}
					</div>
					@endif
					<a href="{{route('combi19.altaViaje')}}">Alta viaje</a>
					{{$viajes->links()}}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
