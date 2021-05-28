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
                                <th>Estado</th> {{--del pasaje--}}
								<th>Ruta</th>
								<th>Combi</th>
								<th>Insumos</th> {{--del pasaje--}}
								<th>Fecha</th>
                                <th>Precio</th> {{--del pasaje--}}
                                <th>Acciones</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($misViajes as $viaje)
								<?php
									$pasaje = (App\Models\Pasaje::where('viaje_id','=', $viaje->id)->where('pasajero_id','=',$pasajero->id)->get()); 
								?>
								<tr>
									<?php
										$estado = (App\Models\Estado::where('id','=', $pasaje[0]->estado)->get()); 	
									?>
									<td>{{$estado[0]->nombre}}</td>
									<td>{{$viaje->ruta->origen->nombre}} - {{$viaje->ruta->destino->nombre}}</td>
									<td>{{$viaje->combi->patente}}</td>
									<td>
										<dl class="dl-horizontal">
											<?php
												$insumos = (App\Models\Insumos_pasaje::withTrashed()->where('pasaje_id', '=', $pasaje[0]->id)->get());
											?>
											@foreach ($insumos as $insumo)
												<dt>{{$insumo->insumo->nombre}} <small>(x{{$insumo->cantidad}})</small></dt>
												<dd>{{$insumo->insumo->descripcion}}</dd>
											@endforeach
										</dl>
									</td>
									<td>{{$viaje->fecha}}</td>
									<td>{{$pasaje[0]->precio}}</td>
									<td>
										<a href="#" class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
										<form action="#" class="formulario-eliminar" method="POST">
											@csrf
											@method('delete')
											<button class="delete" title="Delete" data-toggle="tooltip" style="border:none;background-color: Transparent;"><i class="material-icons">&#xE872;</i></button>
										</form>
									</td>
								</tr>
							@endforeach
						</tbody>
                        @else
						    <h1>No has realizado ningún viaje</h1>
						@endif 
                    </table>
					Las acciones serían comentar si finalizó y cancelar si está pendiente
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
