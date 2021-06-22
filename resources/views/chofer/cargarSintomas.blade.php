@extends('layouts.app')

@section('title', 'Cargar síntomas')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">{{ __('Cargar síntomas') }}</div>
				<div class="card-body d-flex align-items-center">
					<form action="{{route('combi19.storeSintomas', [$pasaje])}}" method="POST">
						@csrf
						<div class="form-group row">
							<label class="col-md-6 col-form-label">Fiebre:</label>
							<div class="col-md-7">
								<input type="text" name="fiebre" value="{{old('fiebre')}}" size="2" maxlength="4" max="50"> °C
							</div>
						</div>
						<div class="form-check">
							<input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" name="sintomas[]">
							<label class="form-check-label" for="flexCheckDefault">
								Tos
							</label>
						</div>
						<div class="form-check">
							<input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" name="sintomas[]">
							<label class="form-check-label" for="flexCheckDefault">
								Dificultad para respirar
							</label>
						</div>
						<div class="form-check">
							<input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" name="sintomas[]">
							<label class="form-check-label" for="flexCheckDefault">
								Dolor de cabeza
							</label>
						</div>
						<div class="form-check">
							<input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" name="sintomas[]">
							<label class="form-check-label" for="flexCheckDefault">
								Escalofríos
							</label>
						</div>
						<div class="form-check">
							<input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" name="sintomas[]">
							<label class="form-check-label" for="flexCheckDefault">
								Dolores corporales
							</label>
						</div>
						<div class="form-check">
							<input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" name="sintomas[]">
							<label class="form-check-label" for="flexCheckDefault">
								Flujo nasal
							</label>
						</div>
						<div class="form-check">
							<input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" name="sintomas[]">
							<label class="form-check-label" for="flexCheckDefault">
								Dolor de garganta
							</label>
						</div>
						<div class="form-check">
							<input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" name="sintomas[]">
							<label class="form-check-label" for="flexCheckDefault">
								Nausea
							</label>
						</div>
						<div class="form-check">
							<input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" name="sintomas[]">
							<label class="form-check-label" for="flexCheckDefault">
								Vómito
							</label>
						</div>
						<div class="form-check">
							<input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" name="sintomas[]">
							<label class="form-check-label" for="flexCheckDefault">
								Fatiga
							</label>
						</div>
						<div class="form-check">
							<input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" name="sintomas[]">
							<label class="form-check-label" for="flexCheckDefault">
								Diarrea
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
@endsection
