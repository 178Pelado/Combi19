@extends('layouts.app')

@section('title', 'Mis viajes')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-20">
			<div class="card">
				<div class="card-header">{{ __('Mis viajes') }}</div>
				<div class="card-body">
					{{-- @if(Session::has('messageNO'))
					<div class="alert alert-danger alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						{{Session::get('messageNO')}}
					</div>
					@elseif(Session::has('messageSI'))
					<div class="alert alert-success alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						{{Session::get('messageSI')}}
					</div>
					@endif --}}
					<table class="table table-bordered">
						@if($misViajes[0] !== null)
						<thead>
							<tr>
								<th>Estado</th> {{--del pasaje--}}
								<th>Ruta</th>
								<th>Combi</th>
								<th>Insumos</th> {{--del pasaje--}}
								<th>Fecha</th>
								<th>Precio</th> {{--del pasaje--}}
								<th>Acciones</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($misViajes as $viaje)
							<?php
							$pasaje = (App\Models\Pasaje::where('viaje_id','=', $viaje->id)->where('pasajero_id','=',$pasajero->id)->get());
							?>
							<tr>
								<?php
								$estado = (App\Models\Estado::where('id','=', $pasaje[0]->estado)->get());
								?>
								<td>{{$estado[0]->nombre}}</td>
								<td>{{$viaje->ruta->origen->nombre}} - {{$viaje->ruta->destino->nombre}}</td>
								<td>{{$viaje->combi->patente}}</td>
								<td>
									<dl class="dl-horizontal">
										<?php
										$insumos = (App\Models\Insumos_pasaje::withTrashed()->where('pasaje_id', '=', $pasaje[0]->id)->get());
										?>
										@foreach ($insumos as $insumo)
										<dt>{{$insumo->insumo->nombre}} <small>(x{{$insumo->cantidad}})</small></dt>
										<dd>{{$insumo->insumo->descripcion}}</dd>
										@endforeach
									</dl>
								</td>
								<td>{{$viaje->fecha}}</td>
								<td>{{$pasaje[0]->precio}}</td>
								<td>
									<a href="#" class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
									<form action="#" class="formulario-eliminar" method="POST">
										@csrf
										@method('delete')
										<button class="delete" title="Delete" data-toggle="tooltip" style="border:none;background-color: Transparent;"><i class="material-icons">&#xE872;</i></button>
									</form>
									@if($viaje->estado == 3 && count($viaje->comentarios) == 0)
									<button class="btn btn-primary btn-sm shadow-none" type="button" data-toggle="modal" data-target="#exampleModal{{$viaje->id}}">Comentar</button>
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
													<div class="container mt-5">
														<div class="d-flex justify-content-center row">
															<div class="col-md-12">
																<div class="d-flex flex-column comment-section">
																	<form action="{{route('combi19.storeComentario', [$viaje, Auth::user()->email])}}" method="POST">
																		@csrf
																		<div class="bg-light p-2">
																			<div class="d-flex flex-row align-items-start">
																				<textarea class="form-control ml-1 shadow-none textarea" name='comentario'></textarea></div>
																				@error('comentario')
																				<small>{{$message}}</small>
																				@enderror
																				<div class="mt-2 text-right">
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
									</tr>
									@endforeach
								</tbody>
								@else
								<h1>No has realizado ningún viaje</h1>
								@endif
							</table>
							Las acciones serían comentar si finalizó y cancelar si está pendiente
							@if(Session::has('message'))
							<div class="alert alert-danger alert-dismissible" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								{{Session::get('message')}}
							</div>
							@endif
							{{$misViajes->links()}}
						</div>
					</div>
				</div>
			</div>
		</div>
		@endsection
