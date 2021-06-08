@extends('layouts.app')

@section('title', 'Mi Suscripción')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-20">
			<div class="card">
				@if($pasajes[0] !== null)
					<?php
						$ahorroTotal = 0;
						foreach ($pasajes as $pasaje){
							$insumos = (App\Models\Insumos_pasaje::where('pasaje_id', '=', $pasaje->id)->get());
							// calculando el precio para un viaje
							$costo_insumos = 0;
							foreach ($insumos as $insumo) {
								$costo_insumos += ($insumo->precio_al_reservar * $insumo->cantidad); //sumo lo que costaron los insumos en aquel entonces
							}
							$total = $pasaje->precio_viaje + $costo_insumos; //sumo el precio del viaje en aquel entonces + $costo_insumos
							$totalGold = $pasaje->precio; //precio Gold
							$ahorro = $total - $totalGold; //cuánto ahorré
							$ahorroTotal += $ahorro;
						}	
					?>
				@else
						<?php $ahorro = 0; ?>
				@endif
				<div class="card-header">{{ __('¿Cuánto ahorré? → ')}}<strong style="color: green; font-size: 18px"> ${{$ahorroTotal}}</strong></div>
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
									<th>Ruta</th>
									<th>Combi</th>
									<th>Insumos</th> {{-- del pasaje --}}
									<th>Fecha</th>
									<th>Precio</th> {{-- del pasaje con los costos de aquel entonces--}}
									<th>Precio Gold</th>
									<th>Ahorraste</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$totalViajes = 0;
									$totalViajesGold = 0;
									$ahorroTotal = 0;
								?>
								@foreach ($pasajes as $pasaje)
									<?php
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
									@if ($ahorro > 0 && $pasaje->estado == 3)
										<?php
											$totalViajes += $total; //sumo el precio del viaje al total de los viajes
											$totalViajesGold += $totalGold; //sumo el precio gold del viaje al total gold de los viajes
											$ahorroTotal += $ahorro; //sumo el ahorro del viaje al ahorro total de los viajes
										?>
										{{-- muestro el viaje --}}
										<tr>
											<td>{{$pasaje->nombrePasajero()}}</td>
											<td>{{$pasaje->viaje->ruta->origen->nombre}} - {{$pasaje->viaje->ruta->destino->nombre}}</td>
											<td>{{$pasaje->viaje->combi->patente}}</td>
											<td>
												<button type="button" data-toggle="modal" data-target="#exampleModal{{$pasaje->id}}" class="btn btn-info btn-sm">MÁS INFO</button>

<!-- The Modal -->

              <div class="modal" id="exampleModal{{$pasaje->id}}">
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
											<td>{{$pasaje->viaje->fecha_sin_segundos()}}</td>
											<td>{{$total}}</td>
											<td>{{$totalGold}}</td>
											<td>{{$ahorro}}</td>
										</tr>
									@endif

								@endforeach
							</tbody>
							{{-- <tfoot>
								<tr>
									<th colspan="3"></th>
									<th>Totales</th>
									<th>{{$totalViajes}}</th>
									<th>{{$totalViajesGold}}</th>
									<th>{{$ahorroTotal}}</th>
								</tr>
							</tfoot> --}}
                        @else
						    <h1>No has realizado ningún viaje</h1>
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
            <div class="card">
                <div class="card-body">
						@if ($suscripcion->fecha_baja == null)
							<h6>Estado:
								<strong style="color: green">Activa</strong>
							</h6>
							<form action="{{route('combi19.prepararCancelacion', Auth::user()->email)}}" class="formulario-cancelar_suscripcion" method="GET">
								@csrf
								<button class="btn btn-info" data-toggle="tooltip">Cancelar Suscripcion</button>
							</form>
						@else
							<h6>Estado:
								<strong style="color: rgb(0, 102, 255)">Activa hasta el {{$suscripcion->fecha_baja}} </strong>
							</h6>
						@endif
					{{-- <a class="btn btn-info " href="{{ route('combi19.modificarTarjeta', Auth::user()->email) }}">Cancelar Suscripcion</a> --}}
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h6>Tarjeta: <small>************{{substr($tarjeta->numero,12,15)}}</small>
                        <a class="btn btn-info " href="{{ route('combi19.modificarTarjeta', Auth::user()->email) }}">Modificar</a>
                    </h6>
                </div>
            </div>
		</div>
	</div>
</div>

<script>
$('.formulario-cancelar_suscripcion').submit(function(event){
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
    text: "¡Esta suscripción se cancelará definitivamente a fin de mes!",
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

@endsection
