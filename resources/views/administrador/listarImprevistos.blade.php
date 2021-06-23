@extends('layouts.app')

@section('title', 'Imprevistos')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-20">
			<div class="card">
				<div class="card-header">{{ __('Lista de imprevistos') }}</div>
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
						@if($imprevistos !== null)
						<thead>
							<tr>
								<th>Viaje</th>
								<th>Chofer</th>
								<th>Fecha</th>
								<th>Descripción</th>
								<th>Estado</th>
								<th>Acciones</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($imprevistos as $imprevisto)
							<tr>
								<td>
									<button type="button" data-toggle="modal" data-target="#viajeModal{{$imprevisto->viaje_id}}" class="btn btn-info btn-sm">MÁS INFO</button>

									<!-- Modal -->
									<div class="modal fade" id="viajeModal{{$imprevisto->viaje_id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
																Fecha: {{$imprevisto->viaje->fecha_sin_segundos()}}
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
								<td>{{$imprevisto->chofer->nombre}} {{$imprevisto->chofer->apellido}}</td>
								<td>{{$imprevisto->fecha}}</td>
								<td>{{$imprevisto->comentario}}</td>
								@if ($imprevisto->resuelto == 1)
									<td><p style="color: green">SI</p> </td>
									<td><a class="btn btn-secondary " href="" style="pointer-events: none">Marcar como resuelto</a></td>
								@else
									<td><p style="color: red">NO</p> </td>
									<td><a class="btn btn-info " href="{{ route('combi19.resolverImprevisto', $imprevisto->id) }}" >Marcar como resuelto</a></td>
								@endif
								@endforeach
							</tr>
						</tbody>
						@else
							<h1>No hay imprevistos en el sistema</h1>
						@endif
					</table>
					@if(Session::has('message'))
					<div class="alert alert-danger alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						{{Session::get('message')}}
					</div>
					@endif
				</div>
			</div>
		</div>
	</div>
</div>
@endsection