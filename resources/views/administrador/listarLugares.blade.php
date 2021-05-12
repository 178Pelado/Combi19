@extends('layouts.app')

@section('title', 'Lista de lugares')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">{{ __('Lista de Lugares') }}</div>
				<div class="card-body">
					@if(Session::has('messageNO'))
						<div class="alert alert-danger alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<a href="{{route('combi19.modificarRutaConLugar', [session('ruta'), session('lugar')])}}" class="alert-link">{{Session::get('messageNO')}}</a>
						</div>
					@elseif(Session::has('messageSI'))
						<div class="alert alert-success alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							{{Session::get('messageSI')}}
						</div>
					@endif
					<table class="table table-bordered">
						@if($lugares[0] !== null)
							<thead>
								<tr>
									<th>Nombre</th>
									<th>Acciones</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($lugares as $lugar)
								<tr>
									<td>{{$lugar->nombre}}</td>
									<td>
										<a href="{{route('combi19.modificarLugar', $lugar)}}" class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
										<form action="{{route('combi19.eliminarLugar', $lugar)}}" class="formulario-eliminar" method="POST">
											@csrf
											@method('delete')
											<button class="delete" title="Delete" data-toggle="tooltip" style="border:none;background-color: Transparent;"><i class="material-icons">&#xE872;</i></button>
										</form>
									</td>
								</tr>
							@endforeach
						</tbody>
					@else
						<h1>No hay lugares activos</h1>
					@endif
				</table>
					<a href="{{route('combi19.altaLugar')}}">Alta lugar</a>
					{{$lugares->links()}}
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
