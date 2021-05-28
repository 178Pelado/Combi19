@extends('layouts.app')

@section('title', 'Mis viajes')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-20">
			<div class="card">
				<div class="card-header">{{ __('Mis viajes') }}</div>
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
                                <th>Estado</th>
								<th>Ruta</th>
								<th>Combi</th>
								<th>Insumos</th>
								<th>Fecha</th>
                                <th>Precio</th>
                                <th>Acciones</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($misPasajes as $pasaje)
                            <tr>{{$pasaje->estado}}</tr>
							<tr>
								<td>{{$pasaje->viaje()->ruta->origen->nombre}} - {{$pasaje->viaje()->ruta->destino->nombre}}</td>
								<td>{{$pasaje->viaje()->combi->patente}}</td>
								<td>
									<dl class="dl-horizontal">
										<?php
										$insumos = (App\Models\Insumos_viaje::withTrashed()->where('viaje_id', '=', $pasaje->viaje_id)->get());
										?>
										@foreach ($insumos as $insumo)
										<dt>{{$insumo->insumo->nombre}}</dt>
										<dd>{{$insumo->insumo->descripcion}}</dd>
										@endforeach
									</dl>
								</td>
								<td>{{$pasaje->viaje()->fecha}}</td>
                                <td>{{$pasaje->precio}}</td>
                                <td>
									<a href="{{route('#', $pasaje->viaje())}}" class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
									<form action="{{route('#', $pasaje->viaje())}}" class="formulario-eliminar" method="POST">
										@csrf
										@method('delete')
										<button class="delete" title="Delete" data-toggle="tooltip" style="border:none;background-color: Transparent;"><i class="material-icons">&#xE872;</i></button>
									</form>
								</td>
								@endforeach
							</tr>
						</tbody>
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
		</div>
	</div>
</div>
@endsection
