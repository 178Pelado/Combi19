@extends('layouts.app')

@section('title', 'Modificar lugar')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">{{ __('Modificar Lugar') }}</div>
				<div class="card-body">
					<form action="{{route('combi19.updateLugar', $lugar)}}" method="POST">
						@csrf @method('PUT')
						<input type="hidden" name="id" value="{{$lugar->id}}">
						<div class="form-group row">
							<label class="col-md-4 col-form-label text-md-right">Nombre:</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="nombre" value="{{old('nombre', $lugar->nombre)}}">
								@error('nombre')
									<small>{{$message}}</small>
								@enderror
							</div>
						</div>
						<div class="form-group row mb-0">
							<div class="col-md-8 offset-md-4">
								<button type="submit"class="btn btn-primary">
									{{ __('Actualizar') }}
								</button>
								<a type="button" href="javascript:history.back(-1);" class="btn btn-secondary">
									{{ __('Cancelar') }}
								</a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
