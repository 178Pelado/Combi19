@extends('layouts.vistaAdministrador')

@section('title', 'Lista de lugares')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">{{ __('Lista de Lugares 2') }}</div>
				<div class="card-body">
					<table class="table table-bordered">
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
									<button type="button" data-toggle="modal" data-target="#exampleModal{{$lugar->id}}"><i class="material-icons">&#xE254;</i></button>
									<form action="{{route('combi19.eliminarLugar', $lugar)}}" method="POST">
										@csrf
										@method('delete')
										<button class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></button>
									</form>
								</td>
								
							</tr>

				<!-- Modal -->
				<div class="modal fade" id="exampleModal{{$lugar->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				  <div class="modal-dialog">
				    <div class="modal-content">
				      <div class="modal-header">
				        <h5 class="modal-title" id="exampleModalLabel">Actualizar lugar</h5>
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          <span aria-hidden="true">&times;</span>
				        </button>
				      </div>
				      <div class="modal-body">

				        <form action="{{route('combi19.updateLugar', $lugar)}}" method="POST">
							@csrf
							@method('PUT')
							<div class="form-group row">
								<label class="col-md-4 col-form-label text-md-right">Nombre:</label>
								<div class="col-md-6">
									<input type="text" class="form-control" name="nombre" value="{{$lugar->nombre}}">
									@error('nombre')
										<small>{{$message}}</small>
									@enderror
								</div>
							</div>
							<div class="modal-footer">
								<button type="submit"class="btn btn-primary">
									{{ __('Actualizar') }}
								</button>
								<button type="button"class="btn btn-secondary" data-dismiss="modal">
									{{ __('Cancelar cambios') }}
								</button>
							</div>
						</form>
				      </div>
				    </div>
				  </div>
				</div>
						@endforeach
					</tbody>
				</table>
					<a href="{{route('combi19.altaLugar')}}">Alta lugar</a>
					{{$lugares->links()}}
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
