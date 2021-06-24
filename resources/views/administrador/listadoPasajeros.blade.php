@extends('layouts.app')

@section('title', 'Lista de pasajeros')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-20">
			<div class="card">
				<div class="card-header">{{ __('Lista de pasajeros') }}</div>
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
						@if(count($pasajes) !== 0)
						<thead>
							<tr>
								<th>Nombre</th>
								<th>Apellido</th>
								<th>DNI</th>
								<th>Estado</th>
								<th>Acciones</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($pasajes as $pasaje)
							<tr>
								<td>{{$pasaje->pasajero->nombre}}</td>
								<td>{{$pasaje->pasajero->apellido}}</td>
								<td>{{$pasaje->pasajero->dni}}</td>
								<td>{{$pasaje->estados->nombre}}</td>
								<td>
									@if ($pasaje->estado_pago == 0)
										<form action="{{route('combi19.cobrar', [$pasaje])}}" class="formulario-cobrar" method="GET">
											@csrf
											<button class="btn btn-success btn-sm shadow-none" data-toggle="tooltip">Cobrar</button>
										</form>
									@else
										<a href="#" class="btn btn-info btn-sm shadow-none disabled" role="button" aria-disabled="true">Pago realizado</a>
									@endif
								</td>
								@endforeach
							</tr>
						</tbody>
						@else
							<h1>No hay pasajeros para este viaje</h1>
						@endif
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection