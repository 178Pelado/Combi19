@extends('layouts.app')
<?php
use App\Models\Lugar
?>
@section('title', 'Alta de viaje')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">{{ __('Alta de Viaje') }}</div>
				<div class="card-body">
					<form action="{{route('combi19.storeViaje')}}" method="POST">
						@csrf
						<div class="form-group row">
							<label class="col-md-4 col-form-label text-md-right">Combi:</label>
							<div class="col-md-6">
								<select name="combi_id" class="form-control">
									@foreach($combis as $combi)
									<option value={{$combi->id}}>
										{{$combi->patente . ' - ' . $combi->modelo . ' - ' . $combi->tipo}}
									</option>
									@endforeach
								</select>
								@error('combi_id')
								<small>{{$message}}</small>
								@enderror
							</div>
						</div>
						<div class="form-group row">
							<label class="col-md-4 col-form-label text-md-right">Ruta:</label>
							<div class="col-md-6">
								<select name="ruta_id" class="form-control">
									@foreach($rutas as $ruta)
									{{$lugarO = Lugar::where('id', '=', $ruta->origen_id)->get()->first()}}
									{{$lugarD = Lugar::where('id', '=', $ruta->destino_id)->get()->first()}}
									<option value={{$ruta->id}}>
										{{$lugarO->nombre . ' - ' . $lugarD->nombre . ' (' . $ruta->descripcion .')'}}
									</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-md-4 col-form-label text-md-right">Insumos:</label>
							<div class="col-md-6">
								<select class="form-control" id="e1" multiple="multiple" name="insumo_id[]">
									@foreach($insumos as $insumo)
									<option value={{$insumo->id}}>
										{{$insumo->nombre . ' - ' . $insumo->descripcion}}
									</option>
									@endforeach
								</select>
							</div>
						</div>

						<div class="form-group row">
							<label class="col-md-4 col-form-label text-md-right">Precio:</label>
							<div class="col-md-6">
								<input type="number" step="any" class="form-control" name="precio" value="{{old('precio')}}">
								@error('precio')
								<small>{{$message}}</small>
								@enderror
							</div>
						</div>
						<div class="form-group row">
							<label class="col-md-4 col-form-label text-md-right">Fecha:</label>
							<div class="col-md-6">
								<?php
								date_default_timezone_set('America/Argentina/Buenos_Aires');
								$dt_min = new DateTime();
								$dt_min= $dt_min->format('Y-m-d\TH:i');

								$dt = new DateTime(); // Date object using current date and time
								$dt= $dt->format('Y-m-d\TH:i');
								?>
								<input type="datetime-local" name="fecha" min="<?php echo $dt_min; ?>" class="form-control" value="{{old('fecha')}}" name="fecha">
								@error('fecha')
								<small>{{$message}}</small>
								@enderror
							</div>
						</div>
						<div class="form-group row mb-0">
							<div class="col-md-8 offset-md-4">
								<button type="submit"class="btn btn-primary">
									{{ __('Cargar') }}
								</button>
							<a type="button" href="javascript:history.back(-1);" class="btn btn-secondary">
								{{ __('Cancelar') }}
							</a>
						</div>
					</div>
				</form>
				<a href="{{route('combi19.altaCombi')}}">Alta combi</a><br>
				<a href="{{route('combi19.altaRuta')}}">Alta ruta</a><br>
				<a href="{{route('combi19.altaInsumo')}}">Alta insumo</a>
			</div>
		</div>
	</div>
</div>
</div>

@endsection
