@extends('layouts.app')

@section('title', 'Lista de rutas')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-20">
			<div class="card">
				<div class="card-header">{{ __('Lista de rutas') }}</div>
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
						@if($rutas[0] !== null)
							<thead>
								<tr>
									<th>Origen</th>
									<th>Destino</th>
									<th>Descripción</th>
									<th>Distancia (km)</th>
									<th>Acciones</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($rutas as $ruta)
								<tr>
									<td>{{$ruta->origen->nombre}}</td>
									<td>{{$ruta->destino->nombre}}</td>
									<td>{{$ruta->descripcion}}</td>
									<td>{{$ruta->distancia_km}}</td>
									<td>
										<a href="{{route('combi19.modificarRuta', $ruta)}}" class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
										<form action="{{route('combi19.eliminarRuta', $ruta)}}" class="formulario-eliminar" method="POST">
											@csrf
											@method('delete')
											<button class="delete" title="Delete" data-toggle="tooltip" style="border:none;background-color: Transparent;"><i class="material-icons">&#xE872;</i></button>
										</form>
									</td>
								@endforeach
								</tr>
							</tbody>
						@else
							<h1>No hay rutas activas</h1>
						@endif
					</table>
					<a href="{{route('combi19.altaRuta')}}">Alta ruta</a>
					{{$rutas->links()}}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
