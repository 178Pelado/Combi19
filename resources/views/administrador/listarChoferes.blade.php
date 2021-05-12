@extends('layouts.app')

@section('title', 'Lista de choferes')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-20">
			<div class="card">
				<div class="card-header">{{ __('Lista de choferes') }}</div>
				<div class="card-body">
					@if(Session::has('messageNO'))
						<div class="alert alert-danger alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<a href="{{route('combi19.modificarCombi', session('combi'))}}" class="alert-link">{{Session::get('messageNO')}}</a>
						</div>
					@elseif(Session::has('messageSI'))
						<div class="alert alert-success alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							{{Session::get('messageSI')}}
						</div>
					@endif
					<table class="table table-bordered">
						@if($choferes[0] !== null)
							<thead>
								<tr>
									<th>Nombre</th>
									<th>Apellido</th>
									<th>Teléfono</th>
									<th>Email</th>
									<th>Acciones</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($choferes as $chofer)
									<tr>
										<td>{{$chofer->nombre}}</td>
										<td>{{$chofer->apellido}}</td>
										<td>{{$chofer->telefono}}</td>
										<td>{{$chofer->email}}</td>
										<td>
											<a href="{{route('combi19.modificarChofer', $chofer)}}" class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
											<form action="{{route('combi19.eliminarChofer', $chofer)}}" class="formulario-eliminar" method="POST">
												@csrf
												@method('delete')
												<button class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></button>
											</form>

											<!-- <a class="delete" title="Delete" data-toggle="tooltip" href="#" onclick="event.preventDefault(); document.getElementById('delete-form').submit();">
		                                        <i class="material-icons">&#xE872;</i>
		                                    </a>

		                                    <form id="delete-form" action="{{route('combi19.eliminarChofer', $chofer)}}" method="POST">
		                                        @csrf
		                                        @method('delete')
		                                        {{$chofer->id}}
		                                    </form> -->

										</td>
								@endforeach
									</tr>
							</tbody>
						@else
							<h1>No hay choferes activos</h1>
						@endif
					</table>
					<a href="{{route('combi19.registroChofer')}}">Registro chofer</a>
					{{$choferes->links()}}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
