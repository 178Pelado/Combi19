@extends('layouts.app')

@section('title', 'Lista de pasajeros')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-20">
			<div class="card">
				<div class="card-header">{{ __('Lista de pasajeros reembolsables') }}</div>
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
						@if(count($pasajes) !== 0)
						<thead>
							<tr>
								<th>Pasajero</th>
								<th>Tarjeta</th>
								<th>Fecha Cancelación</th>
								<th>Monto</th>
								<th>Estado</th>
								<th>Acciones</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($pasajes as $pasaje)
							<tr>
								<td>
									<button class="btn btn-info btn-sm shadow-none" type="button" data-toggle="modal" data-target="#pasajero{{$pasaje->id}}">MÁS INFO</button>

									<div class="modal fade" id="pasajero{{$pasaje->id}}" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
																		<div class="modal-dialog modal-dialog-centered">
																			<div class="modal-content">
																				<div class="modal-header">
																					<h5 class="modal-title" id="exampleModalToggleLabel2">Datos del pasajero</h5>
																					<button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
																				</div>
																				<div class="modal-body">
																					<div class="row">
																						<div class="form-group col-md-12">
																							<label class="col-form-label text-md-right">
																								Nombre: {{$pasaje->pasajero->nombre}}
																							</label>
																						</div>
																						<div class="form-group col-md-12">
																							<label class="col-form-label text-md-right">
																								Apellido: {{$pasaje->pasajero->apellido}}
																							</label>
																						</div>
																						<div class="form-group col-md-12">
																							<label class="col-form-label text-md-right">
																								DNI: {{$pasaje->pasajero->dni}}
																							</label>
																						</div>
																					</div>
																					<div class="modal-footer">
																					<button class="btn btn-secondary" type="button"data-dismiss="modal">Cerrar</button>
																				</div>
																									</div>
																								</div>
																							</div>
																						</div>
								</td>
								<td>{{$pasaje->tarjeta->numero}}</td>
								<td>{{$pasaje->reembolso->fecha_cancelacion}}</td>
								<td>{{$pasaje->reembolso->monto}}</td>
								<td>{{$pasaje->estados->nombre}}</td>
								<td>
									@if ($pasaje->reembolso->estado == 0)
										<form action="{{route('combi19.reembolsar', [$pasaje])}}" class="formulario-reembolsar" method="GET">
											@csrf
											<button class="btn btn-danger btn-sm shadow-none" data-toggle="tooltip">Reembolsar</button>
										</form>
									@else
										<a href="#" class="btn btn-info btn-sm shadow-none disabled" role="button" aria-disabled="true">Reembolsado</a>
									@endif
								</td>
								@endforeach
							</tr>
						</tbody>
						@else
							<h1>No hay pasajeros para reembolsar</h1>
						@endif
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<script>

$('.formulario-reembolsar').submit(function(event){
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
    text: "¡Este reembolso no se podrá deshacer en el futuro!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: '¡Si, reembolsar!',
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