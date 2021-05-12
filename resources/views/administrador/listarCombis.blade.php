@extends('layouts.app')

@section('title', 'Lista de combis')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-20">
			<div class="card">
				<div class="card-header">{{ __('Lista de combis') }}</div>
				<div class="card-body">
					@if(Session::has('messageNO'))
						<div class="alert alert-danger alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<a href="{{route('combi19.modificarViaje', session('viaje'))}}" class="alert-link">{{Session::get('messageNO')}}</a>
						</div>
					@elseif(Session::has('messageSI'))
						<div class="alert alert-success alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							{{Session::get('messageSI')}}
						</div>
					@endif
					<table class="table table-bordered">
						@if($combis[0] !== null)
							<thead>
								<tr>
									<th>Patente</th>
									<th>Modelo</th>
									<th>Cantidad de asientos</th>
									<th>Tipo</th>
									<th>Chofer</th>
									<th>Acciones</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($combis as $combi)
								<tr>
									<td>{{$combi->patente}}</td>
									<td>{{$combi->modelo}}</td>
									<td>{{$combi->cantidad_asientos}}</td>
									<td>{{$combi->tipo}}</td>
									<td>{{$combi->chofer->nombre}}</td>
									<td>
										<a href="{{route('combi19.modificarCombi', $combi)}}" class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
										<form action="{{route('combi19.eliminarCombi', $combi)}}" class="formulario-eliminar" method="POST">
											@csrf
											@method('delete')
											<button class="delete" title="Delete" data-toggle="tooltip" style="border:none;background-color: Transparent;"><i class="material-icons">&#xE872;</i></button>
										</form>
									</td>
									@endforeach
								</tr>
							</tbody>
						@else
							<h1>No hay combis activas</h1>
						@endif
					</table>
					@if(Session::has('message'))
					<div class="alert alert-danger alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						{{Session::get('message')}}
					</div>
					@endif
					<a href="{{route('combi19.altaCombi')}}">Alta combi</a>
					{{$combis->links()}}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
