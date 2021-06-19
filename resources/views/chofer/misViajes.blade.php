@extends('layouts.app')

@section('title', 'Mis viajes')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-20">
			<div class="card">
				<div class="card-header">{{ __('Mis viajes') }}</div>
				<div class="card-body">
					@if(Session::has('messageNO'))
					<div class="alert alert-danger alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						{{Session::get('messageNO')}}
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
								<th>Combi</th>
								<th>Fecha</th>
								<th>Estado</th>
								<th>Acciones</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($viajes as $viaje)
							<tr>
								<td>{{$viaje->ruta->origen->nombre}} - {{$viaje->ruta->destino->nombre}}</td>
								<td>{{$viaje->combi->patente}}</td>
								<td>{{$viaje->fecha_sin_segundos()}}</td>
								<td>{{$viaje->estado()}}</td>
								<td>
									@if ($viaje->iniciable())
										<a href="{{route('combi19.iniciarViaje', [$viaje])}}" class="btn btn-info btn-sm shadow-none" type="button">Iniciar viaje</a>
									@elseif ($viaje->finalizable())
											<button class="btn btn-info btn-sm shadow-none" type="button" data-toggle="modal" data-target="#exampleModal{{$viaje->id}}">Finalizar viaje</button>
										@elseif (($viaje->estado == 3) && ($viaje->no_imprevistos()))
												<button class="btn btn-info btn-sm shadow-none" type="button" data-toggle="modal" data-target="#exampleModal{{$viaje->id}}">Notificar imprevisto</button>
											@elseif (($viaje->estado == 3) && (!$viaje->no_imprevistos()))
												<button class="btn btn-info btn-sm shadow-none" type="button" data-toggle="modal" data-target="#exampleModalEdit{{$viaje->id}}">Editar imprevisto</button>
												<form action="#" class="formulario-eliminar" method="POST">
													@csrf
													@method('delete')
													<button class="btn btn-danger btn-sm shadow-none" data-toggle="tooltip">Eliminar imprevisto</button>
												</form>
											@else
												<a href="#" class="btn btn-info btn-sm shadow-none disabled" role="button" aria-disabled="true">
                                                    {{ __('Iniciar viaje') }}
                                             	</a>
									@endif
								</td>
								@endforeach
							</tr>
						</tbody>
						@else
							<h1>No tienes viajes asignados</h1>
						@endif
					</table>
					@if(Session::has('message'))
					<div class="alert alert-danger alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						{{Session::get('message')}}
					</div>
					@endif
				</div>
			</div>
		</div>
	</div>
</div>
@endsection