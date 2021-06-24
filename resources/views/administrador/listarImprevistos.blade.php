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
						@if($imprevistos[0] != null)
						<thead>
							<tr>
								<th>Chofer</th>
								<th>Fecha</th>
								<th>Descripción</th>
								<th>Resuelto</th>
								<th>Acciones</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($imprevistos as $imprevisto)
							<tr>
								<td>{{$imprevisto->chofer->nombre}} {{$imprevisto->chofer->apellido}}</td>
								<td>{{$imprevisto->fecha}}</td>
								<td>{{$imprevisto->comentario()}}</td>
								@if ($imprevisto->resuelto == 1)
									<td><p style="color: green">SI</p> </td>
									<td>
										<button type="button" data-toggle="modal" data-target="#viajeModal{{$imprevisto->viaje_id}}" class="btn btn-info btn-sm">MÁS INFO</button>
										<a href="#" class="btn btn-info btn-sm shadow-none disabled" role="button" aria-disabled="true">Marcado como resuelto</a>
									</td>
								@else
									<td><p style="color: red">NO</p> </td>
									<td>
										<form action="{{route('combi19.resolverImprevisto', $imprevisto->id)}}" class="formulario-resolver" method="GET">
											@csrf
											<button type="button" data-toggle="modal" data-target="#viajeModal{{$imprevisto->viaje_id}}" class="btn btn-info btn-sm">MÁS INFO</button>
											<button class="btn btn-info btn-sm" data-toggle="tooltip">Marcar como resuelto</button>
										</form>
									</td>
								@endif

									<!-- Modal -->
									<div class="modal fade" id="viajeModal{{$imprevisto->viaje_id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title" id="exampleModalLabel">Información</h5>
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
																Patente de combi: {{$imprevisto->viaje->combi->patente}}
															</label>
														</div>
														<div class="form-group col-md-12">
															<label class="col-form-label text-md-right">
																Fecha: {{$imprevisto->viaje->fecha_sin_segundos()}}
															</label>
														</div>
														<div class="form-group col-md-12">
															<label class="col-form-label text-md-right">
																Asientos disponibles: {{$imprevisto->viaje->capacidad()}}
															</label>
														</div>
														<div class="form-group col-md-12">
															<label class="col-form-label text-md-right">
																Descripción imprevisto: 
															</label>
															{{$imprevisto->comentario}}
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

<script>

$('.formulario-resolver').submit(function(event){
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
    text: "¡Este elemento se marcará como resuelto y no se podrá deshacer!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: '¡Si, confirmar!',
    cancelButtonText: '¡No, cancelar!',
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
      swalWithBootstrapButtons.fire(
        'Cancelado',
        '',
        'error'
      )
    }
  })

});
</script>

@endsection