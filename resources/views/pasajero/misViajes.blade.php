@extends('layouts.app')

@section('title', 'Historial de compras')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-20">
			<div class="card">
				<div class="card-header">{{ __('Historial de compras') }}</div>
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
						@if($pasajes[0] !== null)
						<thead>
							<tr>
								<th>Pasajero</th>
								<th>Estado</th> {{--del pasaje--}}
								<th>Viaje</th>
								<th>Insumos</th> {{--del pasaje--}}
								<th>Precio Viaje</th>
								<th>Precio Total</th>
								<th>Descuento Gold</th>
								<th>Precio Final</th> {{--del pasaje--}}
								<th>Acciones</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($pasajes as $pasaje)
							<?php
							$viaje = $pasaje->viaje;
							$insumos = (App\Models\Insumos_pasaje::where('pasaje_id', '=', $pasaje->id)->get());

							// calculando el precio para un viaje
							$costo_insumos = 0;
							foreach ($insumos as $insumo) {
								$costo_insumos += ($insumo->precio_al_reservar * $insumo->cantidad); //sumo lo que costaron los insumos en aquel entonces
							}
							$total = $pasaje->precio_viaje + $costo_insumos; //sumo el precio del viaje en aquel entonces + $costo_insumos
							$totalGold = $pasaje->precio; //precio Gold
							$ahorro = $total - $totalGold; //cuánto ahorré
							?>
							<tr>
								<?php
								$estado = (App\Models\Estado::where('id','=', $pasaje->estado)->get());
								$pasajeActual = (App\Models\Pasaje::where('viaje_id','=', $viaje->id)->where('pasajero_id','=', $pasajero->id)->get()->first());
								$comentario = (App\Models\Comentario::where('viaje_id','=', $viaje->id)->where('pasajero_id','=', $pasajero->id)->first());
								if($comentario !== null){
									$texto = $comentario->texto;
								}
								else {
									$texto = '';
								}
								?>
								<td>{{$pasaje->nombrePasajero()}}</td>
								<td>{{$estado[0]->nombre}}</td>
								<td>
									<button type="button" data-toggle="modal" data-target="#viajeModal{{$viaje->id}}" class="btn btn-info btn-sm">MÁS INFO</button>

									<!-- Modal -->
									<div class="modal fade" id="viajeModal{{$viaje->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title" id="exampleModalLabel">Información del viaje</h5>
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
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
																Fecha: {{$viaje->fecha_sin_segundos()}}
															</label>
														</div>
													</div>
													<div class="modal-footer btn-group" role="group">
														<button type="button" class="btn btn-secondary" data-dismiss="modal">
															{{ __('Salir') }}
														</button>
													</div>
												</div>
											</div>
										</div>
									</div>


								</td>
								<td>
									<button type="button" data-toggle="modal" data-target="#insumosModal{{$pasaje->id}}" class="btn btn-info btn-sm">MÁS INFO</button>

									<!-- The Modal -->

									<div class="modal" id="insumosModal{{$pasaje->id}}">
										<div class="modal-dialog modal-dm">
											<div class="modal-content">

												<!-- Modal Header -->
												<div class="modal-header">
													<h4 class="modal-title">Lista de insumos pasaje</h4>
													<button type="button" class="close" data-dismiss="modal">&times;</button>
												</div>

												<!-- Modal body -->
												<div class="modal-body">
													<div class="row">
														<div class="col-md-12">
															<div class="card">
																<div class="card-body">
																	<table class="table table-bordered">
																		@if(count($pasaje->insumos_asociados()) != 0)
																		<thead>
																			<tr>
																				<th>Nombre</th>
																				<th>Descripción</th>
																				<th>Cantidad</th>
																				<th>Precio</th>
																			</tr>
																		</thead>
																		<tbody>
																			@foreach ($pasaje->insumos_pasaje() as $insumo)
																			<tr>
																				<td>{{$insumo->insumo->nombre}}</td>
																				<td>{{$insumo->insumo->descripcion}}</td>
																				<td>{{$insumo->cantidad}}</td>
																				<td>{{$insumo->precio_al_reservar}}</td>
																				@endforeach
																			</tr>
																		</tbody>
																		@else
																		<h2>No hay insumos cargados</h2>
																		@endif
																	</table>
																</div>
															</div>
														</div>
													</div>

													<!-- Modal footer -->
													<div class="modal-footer btn-group" role="group">
														<button type="button" class="btn btn-secondary" data-dismiss="modal">
															{{ __('Salir') }}
														</button>
													</div>
												</td>
												<td>{{$viaje->precio}}</td>
												<td>{{$total}}</td>
												<td>{{$ahorro}}</td> {{-- si no hubo descuento gold será 0 --}}
												<td>{{$totalGold}}</td> {{-- si no hubo descuento gold será igual al total --}}
												<td>
													@if($pasaje->estado == 3 && count($pasajeActual->comentarios) == 0 && $pasaje->comprador_id == $pasaje->pasajero_id)
													<button class="btn btn-info btn-sm shadow-none" type="button" data-toggle="modal" data-target="#exampleModal{{$viaje->id}}">Realizar comentario</button>
													@endif
													@if ((count($pasajeActual->comentarios) == 1) && ($pasaje->comprador_id == $pasaje->pasajero_id))
													<div class="btn-group-vertical">
														<button class="btn btn-info btn-sm shadow-none" type="button" data-toggle="modal" data-target="#exampleModalEdit{{$viaje->id}}">Editar comentario</button>
														<form action="{{route('combi19.eliminarComentario', [$comentario, Auth::user()->email])}}" class="formulario-eliminar" method="POST">
															@csrf
															@method('delete')
															<button class="btn btn-danger btn-sm shadow-none" data-toggle="tooltip">Eliminar comentario</button>
														</form>
													</div>
													@endif
													@if($viaje->estado == 1 && $pasaje->estado == 1)
													<form action="{{route('combi19.cancelarPasaje', $pasaje)}}" class="formulario-cancelar" method="GET">
														@csrf
														<button class="btn btn-danger btn-sm shadow-none" data-toggle="tooltip">Cancelar pasaje</button>
													</form>
													@endif
												</td>

												<!-- Modal -->
												<div class="modal fade" id="exampleModal{{$viaje->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
													<div class="modal-dialog">
														<div class="modal-content">
															<div class="modal-header">
																<h5 class="modal-title" id="exampleModalLabel">Información del viaje</h5>
																<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																	<span aria-hidden="true">&times;</span>
																</button>
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
																					<form action="{{route('combi19.storeComentario', [$pasajeActual, Auth::user()->email])}}" method="POST">
																						@csrf
																						<div class="bg-light p-2">
																							<div class="d-flex flex-row align-items-start">
																								<textarea id="mensaje" class="form-control ml-1 shadow-none textarea" name='comentario' maxlength="140" rows="4" style="resize: none" placeholder="Ingrese su comentario en 140 caracteres" required></textarea>
																							</div>
																							@error('comentario')
																							<small>{{$message}}</small>
																							@enderror
																							<div class="mt-2 text-right">
																								<div id="contador"></div>
																								<br>
																								<button class="btn btn-primary" type="submit">Comentar</button>
																								<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button></div>
																							</div>
																						</form>
																					</div>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>

													<!-- Modal para editar -->
													<div class="modal fade" id="exampleModalEdit{{$viaje->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
														<div class="modal-dialog">
															<div class="modal-content">
																<div class="modal-header">
																	<h5 class="modal-title" id="exampleModalLabel">Información del viaje</h5>
																	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																		<span aria-hidden="true">&times;</span>
																	</button>
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
																				Fecha: {{$viaje->fecha_sin_segundos()}}
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
																						@if ($comentario != null)
																						<form action="{{route('combi19.updateComentario', [$comentario, Auth::user()->email])}}" method="POST">
																							@csrf @method('PUT')
																							<div class="bg-light p-2">
																								<div class="d-flex flex-row align-items-start">
																									<textarea id="mensaje2" class="form-control ml-1 shadow-none textarea" name='comentario' maxlength="140" rows="4" style="resize: none" placeholder="Ingrese su comentario en 140 caracteres" required>{{$texto}}</textarea>
																								</div>
																								@error('comentario')
																								<small>{{$message}}</small>
																								@enderror
																								<div class="mt-2 text-right">
																									<div id="contador2"></div>
																									<br>
																									<button class="btn btn-info" type="submit">Editar comentario</button>
																									<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button></div>
																								</div>
																							</form>
																							@endif
																						</div>
																					</div>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</tr>

													@endforeach
												</tbody>
												@else
												<h1>No has comprado ningún viaje</h1>
												@endif
											</table>
											@if(Session::has('message'))
											<div class="alert alert-danger alert-dismissible" role="alert">
												<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
												{{Session::get('message')}}
											</div>
											@endif
											{{$pasajes->links()}}
										</div>
									</div>
								</div>
							</div>
						</div>


						<script>
						$('.formulario-cancelar').submit(function(event){
							event.preventDefault();

							const swalWithBootstrapButtons = Swal.mixin({
								customClass: {
									confirmButton: 'btn btn-success',
									cancelButton: 'btn btn-danger'
								},
								buttonsStyling: false
							})

							swalWithBootstrapButtons.fire({
								title: '¿Estás seguro?',
								text: "¡Este pasaje se cancelará definitivamente!",
								icon: 'warning',
								showCancelButton: true,
								confirmButtonText: '¡Si, cancelar!',
								cancelButtonText: '¡No, volver!',
								reverseButtons: true
							}).then((result) => {
								if (result.isConfirmed) {
									// swalWithBootstrapButtons.fire(
									//   '¡Eliminado!',
									//   '',
									//   'success'
									// )
									this.submit();
								} else if (
									/* Read more about handling dismissals below */
									result.dismiss === Swal.DismissReason.cancel
								) {
									// swalWithBootstrapButtons.fire(
									//   'Cancelado',
									//   '',
									//   'error'
									// )
								}
							})

						});
					</script>

					<script type="text/javascript">
					const mensaje = document.getElementById('mensaje');
					const contador = document.getElementById('contador');

					mensaje.addEventListener('input', function(e) {
						const target = e.target;
						const longitudMax = target.getAttribute('maxlength');
						const longitudAct = target.value.length;
						contador.innerHTML = `${longitudAct}/${longitudMax}`;
					});
				</script>

				<script type="text/javascript">
				const mensaje2 = document.getElementById('mensaje2');
				const contador2 = document.getElementById('contador2');

				mensaje2.addEventListener('input', function(e) {
					const target2 = e.target;
					const longitudMax2 = target2.getAttribute('maxlength');
					const longitudAct2 = target2.value.length;
					contador2.innerHTML = `${longitudAct2}/${longitudMax2}`;
				});
			</script>
			@endsection
