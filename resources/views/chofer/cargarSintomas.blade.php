@extends('layouts.app')

@section('title', 'Cargar síntomas')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">{{ __('Cargar síntomas') }}</div>
				<div class="card-body d-flex align-items-center">
					<form action="{{route('combi19.storeSintomas', [$pasaje])}}" class="formulario-sintomas" method="POST">
						@csrf
						<div class="form-group row">
							<label class="col-md-7 col-form-label">Temperatura:</label>
							<div class="col-md-7">
								<input type="text" name="fiebre" value="{{old('fiebre')}}" size="2" maxlength="4" max="50" required> °C
							</div>
						</div>
						<div class="form-check">
							<input class="form-check-input" type="checkbox" value="" id="flexCheckFiebre" name="sintomas[]">
							<label class="form-check-label" for="flexCheckFiebre">
								Fiebre en la última semana
							</label>
						</div>
						<div class="form-check">
							<input class="form-check-input" type="checkbox" value="" id="flexCheckGustoOlfato" name="sintomas[]">
							<label class="form-check-label" for="flexCheckGustoOlfato">
								Perdida de gusto u olfato
							</label>
						</div>
						<div class="form-check">
							<input class="form-check-input" type="checkbox" value="" id="flexCheckGarganta" name="sintomas[]">
							<label class="form-check-label" for="flexCheckGarganta">
								Dolor de garganta
							</label>
						</div>
						<div class="form-check">
							<input class="form-check-input" type="checkbox" value="" id="flexCheckRespiratoria" name="sintomas[]">
							<label class="form-check-label" for="flexCheckRespiratoria">
								Dificultad respiratoria
							</label>
						</div>
						<input type="hidden" name="pasaje_id" value={{$pasaje->id}}>
						<div class="form-group row mb-0">
							<div class="col-md-8 offset-md-4">
								<button type="submit"class="btn btn-primary">
									{{ __('Confirmar') }}
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<script>

$('.formulario-sintomas').submit(function(event){
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
    text: "¡Este formulario será enviado y no podrá modificarse!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: '¡Si, enviar!',
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
