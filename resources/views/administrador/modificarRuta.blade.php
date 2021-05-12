@extends('layouts.app')

@section('title', 'Modificar ruta')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">{{ __('Modificar Ruta') }}</div>
				<div class="card-body">
					<form action="{{route('combi19.updateRuta', $ruta)}}" method="POST">
						@csrf @method('PUT')
						<div class="form-group row">
							@if (count($lugares) == 1)
								<div class="alert alert-danger alert-dismissible" role="alert">
										<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<a href="{{route('combi19.altaLugar')}}" class="alert-link">No hay suficientes lugares disponibles. Seleccione aquí para registrar uno nuevo</a>
								</div>
						 @endif
							<label class="col-md-4 col-form-label text-md-right">Ciudad origen:</label>
							<div class="col-md-6">
									<select class="form-control" name="origen_id">
										@foreach($lugares as $origen)
											@if ($origen->id == $ruta->origen_id)
												<option value={{$origen->id}} selected>
													{{$origen->nombre}}
												</option>
											@else
												<option value={{$origen->id}}>
													{{$origen->nombre}}
												</option>
											@endif
										@endforeach
									</select>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-md-4 col-form-label text-md-right">Ciudad destino:</label>
							<div class="col-md-6">
								<select class="form-control" name="destino_id">
									@foreach($lugares as $destino)
										@if ($destino->id == $ruta->destino_id)
											<option value={{$destino->id}} selected>
												{{$destino->nombre}}
											</option>
										@else
											<option value={{$destino->id}}>
												{{$destino->nombre}}
											</option>
										@endif
									@endforeach
								</select>
								@error('destino_id')
									<small>{{$message}}</small>
								@enderror
							</div>
						</div>
						<div class="form-group row">
							<label class="col-md-4 col-form-label text-md-right">Descripción:</label>
							<div class="col-md-6">
								<textarea class="form-control" name="descripcion" rows="4" cols="20" maxlength="140" style="resize: none"> {{old('descripcion', $ruta->descripcion)}}</textarea>
								@error('descripcion')
									<small>{{$message}}</small>
								@enderror
							</div>
						</div>
						<div class="form-group row">
							<label class="col-md-4 col-form-label text-md-right">Distancia:</label>
							<div class="col-md-6">
								<input type="number" class="form-control" name="distancia_km" value="{{old('distancia_km', $ruta->distancia_km)}}">
								@error('distancia_km')
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
					<a href="{{route('combi19.altaLugar')}}">Alta lugar</a>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
