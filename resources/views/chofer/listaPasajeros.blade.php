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
								<th>Estado Covid</th>
								<th>Acciones</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($pasajes as $pasaje)
							<tr>
								<td>{{$pasaje->pasajero->nombre}}</td>
								<td>{{$pasaje->pasajero->apellido}}</td>
								<td>{{$pasaje->pasajero->dni}}</td>
								<td>{{$pasaje->estado_covid()}}</td>
								<td>
									@if ($pasaje->estado_covid == 0)
										<a href="{{route('combi19.cargarSintomas', [$pasaje])}}" class="btn btn-info btn-sm shadow-none" type="button">Cargar síntomas</a>
									@else
										<a href="#" class="btn btn-info btn-sm shadow-none disabled" role="button" aria-disabled="true">Síntomas cargados</a>
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
