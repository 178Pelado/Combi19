@extends('layouts.app')
<?php
use App\Models\Lugar
?>
@section('title', 'Modificar viaje')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">{{ __('Modificar viaje') }}</div>
				<div class="card-body">
					<form action="{{route('combi19.updateViaje', $viaje)}}" method="POST">
						@csrf @method('PUT')
						<input type="hidden" name="id" value="{{$viaje->id}}">
						<div class="form-group row">
							<label class="col-md-4 col-form-label text-md-right">Combi:</label>
							<div class="col-md-6">
								<select name="combi_id" class="form-control">
									@foreach($combis as $combi)
									@if ($combi->id == $viaje->combi_id)
									<option value={{$combi->id}} selected>
										{{$combi->patente}}
									</option>
									@else
									<option value={{$combi->id}}>
										{{$combi->patente}}
									</option>
									@endif
									@endforeach
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-md-4 col-form-label text-md-right">Ruta:</label>
							<div class="col-md-6">
								<select name="ruta_id" class="form-control" disabled>
									@foreach($rutas as $ruta)
									{{$lugarO = Lugar::where('id', '=', $ruta->origen_id)->get()->first()}}
									{{$lugarD = Lugar::where('id', '=', $ruta->destino_id)->get()->first()}}
									@if ($ruta->id == $viaje->ruta_id)
									<option value={{$ruta->id}} selected>
										{{$lugarO->nombre}} -
										{{$lugarD->nombre}}
									</option>
									@else
									<option value={{$ruta->id}}>
										{{$lugarO->nombre}} -
										{{$lugarD->nombre}}
									</option>
									@endif
									@endforeach
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-md-4 col-form-label text-md-right">Insumos:</label>
							<div class="col-md-6">
								<select class="form-control" id="e1" multiple="multiple" name="insumo_id[]" disabled>
									@foreach($insumos_viaje as $insumo)
									<option value={{$insumo->id}} selected>
										{{$insumo->insumo->nombre}}
									</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-md-4 col-form-label text-md-right">Precio:</label>
							<div class="col-md-6">
								<input type="number" step="any" class="form-control" name="precio" value="{{$viaje->precio}}" disabled>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-md-4 col-form-label text-md-right">Fecha:</label>
							<div class="col-md-6">
								<input type="text" class="form-control" value="{{$viaje->fecha}}" disabled>
								<input type="hidden" class="form-control" value="{{$viaje->fecha}}" name="fecha">
								@error('fecha')
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
					<a href="{{route('combi19.altaCombi')}}">Alta combi</a>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
