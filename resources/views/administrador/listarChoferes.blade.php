@extends('layouts.vistaAdministrador')

@section('title', 'Lista de choferes')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">{{ __('Lista de choferes') }}</div>
				<div class="card-body">
					<table class="table table-bordered">
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
									<a href="{{route('combi19.registroChofer')}}" class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
									<form action="{{route('combi19.eliminarChofer', $chofer)}}" method="POST">
										@csrf
										@method('delete')
										<button class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></button>
									</form>
								</td>
								@endforeach
							</tr>
						</tbody>
					</table>
					<a href="{{route('combi19.registroChofer')}}">Registro chofer</a>
					{{$choferes->links()}}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection