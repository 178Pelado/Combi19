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
								<th>Pasajeros</th>
								<th>Asientos disponibles</th>
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
								<td><a href="{{route('combi19.listaPasajeros', [$viaje->id])}}" class="btn btn-info btn-sm shadow-none" type="button">Ver listado</a></td>
								<td>{{$viaje->cantidad_asientos_disponibles()}}</td>
								<td>
									@if ($viaje->iniciable())
									<a href="{{route('combi19.iniciarViaje', [$viaje])}}" class="btn btn-info btn-sm shadow-none" type="button">Iniciar</a>
									@elseif ($viaje->finalizable())
									<a href="{{route('combi19.finalizarViaje', [$viaje])}}" class="btn btn-info btn-sm shadow-none" type="button">Finalizar</a>
									<a href="{{route('combi19.registroExpress', [$viaje])}}" class="btn btn-info btn-sm shadow-none" type="button">Express</a>
									<button class="btn btn-info btn-sm shadow-none" type="button" data-toggle="modal" data-target="#exampleModalToggle{{$viaje->id}}">Imprevistos</button>
									@elseif ($viaje->estado == 3)
									<button class="btn btn-info btn-sm shadow-none" type="button" data-toggle="modal" data-target="#exampleModalToggle{{$viaje->id}}">Imprevistos</button>
									<div class="modal fade"id="exampleModalToggle{{$viaje->id}}" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
										<div class="modal-dialog modal-lg modal-dialog-centered">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title" id="exampleModalToggleLabel">Listado de imprevistos</h5>
													<button class="btn btn-info btn-sm shadow-none" type="button" data-toggle="modal" data-target="#agregarImprevisto{{$viaje->id}}" data-dismiss="modal" style="margin-left:10px">Agregar imprevisto</button>
													<button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
												</div>
												<div class="modal-body">

													<table class="table table-bordered">
														@if(count($viaje->imprevistos()) !== 0)
														<thead>
															<tr>
																<th>Imprevisto</th>
																<th>Fecha</th>
																<th>Resuelto</th>
																<th>Acciones</th>
															</tr>
														</thead>
														<tbody>
															@foreach ($viaje->imprevistos() as $imprevisto)
															<tr>
																<td>{{$imprevisto->comentario}}</td>
																<td>{{$imprevisto->fecha}}</td>
																<td>{{$imprevisto->resuelto}}</td>
																<td>
																	<button class="btn btn-info btn-sm shadow-none" type="button" data-toggle="modal" data-target="#editarImprevisto{{$imprevisto->id}}">Editar</button>
																	<form action="{{route('combi19.eliminarImprevisto', [$imprevisto])}}" class="formulario-eliminar" method="POST">
																		@csrf
																		@method('delete')
																		<button class="btn btn-danger btn-sm shadow-none" data-toggle="tooltip">Eliminar</button>
																	</form>
																	<div class="modal fade" id="editarImprevisto{{$imprevisto->id}}" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
																		<div class="modal-dialog modal-lg modal-dialog-centered">
																			<div class="modal-content">
																				<div class="modal-header">
																					<h5 class="modal-title" id="exampleModalToggleLabel2">Editar imprevisto</h5>
																					<button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
																				</div>
																				<div class="modal-body">
																					<div class="row">
																						<div class="form-group col-md-12">
																							<label class="col-form-label text-md-right">
																								Ruta: {{$imprevisto->viaje->ruta->origen->nombre}} - {{$imprevisto->viaje->ruta->destino->nombre}}
																							</label>
																						</div>
																						<div class="form-group col-md-12">
																							<label class="col-form-label text-md-right">
																								Descripción: {{$imprevisto->viaje->ruta->descripcion}}
																							</label>
																						</div>
																						<div class="form-group col-md-12">
																							<label class="col-form-label text-md-right">
																								Tipo de combi: {{$imprevisto->viaje->combi->tipo}}
																							</label>
																						</div>
																						<div class="form-group col-md-12">
																							<label class="col-form-label text-md-right">
																								Fecha: {{$imprevisto->viaje->fecha}}
																							</label>
																						</div>
																						<div class="form-group col-md-12">
																							<label class="col-form-label text-md-right">
																								Precio: {{$imprevisto->viaje->precio}}
																							</label>
																						</div>
																					</div>
																					<div class="modal-footer btn-group" role="group">
																						<div class="container">
																							<div class="d-flex justify-content-center row">
																								<div class="col-md-12">
																									<div class="d-flex flex-column comment-section">
																										<form action="{{route('combi19.updateImprevisto', [$imprevisto])}}" method="POST">
																											@csrf @method('PUT')
																											<div class="bg-light p-2">
																												<div class="d-flex flex-row align-items-start">
																													<textarea id="mensaje" class="form-control ml-1 shadow-none textarea" name='comentario' rows="4" style="resize: none" placeholder="Ingrese el imprevisto" required>{{$imprevisto->comentario}}</textarea>
																												</div>
																												<div class="mt-2 text-right">
																													<div id="contador"></div>
																													<br>
																													<button class="btn btn-primary" type="submit">Editar</button>
																													<button class="btn btn-secondary" type="button" data-toggle="modal" data-target="#exampleModalToggle{{$viaje->id}}" data-dismiss="modal">Cancelar</button>
																												</div>
																											</div>
																										</form>
																									</div>
																								</div>
																							</div>
																						</div>
																					</div>
																				</div>
																				<div class="modal-footer">
																				</div>
																			</div>
																		</div>
																	</div>
																</td>
																@endforeach
															</tr>
														</tbody>
														@else
														<h1>No hay imprevistos para este viaje</h1>
														@endif
													</table>
												</div>
												<div class="modal-footer">
												</div>
											</div>
										</div>
									</div>
									<div class="modal fade" id="agregarImprevisto{{$viaje->id}}" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
										<div class="modal-dialog modal-dialog-centered">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title" id="exampleModalToggleLabel2">Agregar imprevisto</h5>
													<button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
												</div>
												<div class="modal-body">

													<div class="row">
														<div class="form-group col-md-12">
															<label class="col-form-label text-md-right">
																Ruta: {{$viaje->ruta->origen->nombre}} - {{$viaje->ruta->destino->nombre}}
															</label>
														</div>
														<div class="form-group col-md-12">
															<label class="col-form-label text-md-right">
																Descripción: {{$viaje->ruta->descripcion}}
															</label>
														</div>
														<div class="form-group col-md-12">
															<label class="col-form-label text-md-right">
																Tipo de combi: {{$viaje->combi->tipo}}
															</label>
														</div>
														<div class="form-group col-md-12">
															<label class="col-form-label text-md-right">
																Fecha: {{$viaje->fecha}}
															</label>
														</div>
														<div class="form-group col-md-12">
															<label class="col-form-label text-md-right">
																Precio: {{$viaje->precio}}
															</label>
														</div>
													</div>
													<div class="modal-footer btn-group" role="group">
														<div class="container">
															<div class="d-flex justify-content-center row">
																<div class="col-md-12">
																	<div class="d-flex flex-column comment-section">
																		<form action="{{route('combi19.storeImprevisto', [$viaje])}}" method="POST">
																			@csrf
																			<div class="bg-light p-2">
																				<div class="d-flex flex-row align-items-start">
																					<textarea id="mensaje" class="form-control ml-1 shadow-none textarea" name='comentario' rows="4" style="resize: none" placeholder="Ingrese el imprevisto" required></textarea>
																				</div>
																				<div class="mt-2 text-right">
																					<div id="contador"></div>
																					<br>
																					<button class="btn btn-primary" type="submit">Agregar</button>
																					<button class="btn btn-secondary" type="button" data-toggle="modal" data-target="#exampleModalToggle{{$viaje->id}}" data-dismiss="modal">Cancelar</button>
																				</div>
																			</div>
																		</form>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
												<div class="modal-footer">
												</div>
											</div>
										</div>
									</div>

									@else
									<a href="#" class="btn btn-info btn-sm shadow-none disabled" role="button" aria-disabled="true">
										{{ __('Iniciar') }}
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
				</div>
			</div>
		</div>
	</div>
</div>
<script>
$(document).ready(function (e) {
  $('#myModal').on('show.bs.modal', function(e) {
     var id = $(e.relatedTarget).data().id;
      $(e.currentTarget).find('#lista').val(id);
  });
});
</script>
@endsection
