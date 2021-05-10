@extends('layouts.app')

@section('title', 'Alta de ruta')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">{{ __('Alta de Ruta') }}</div>
				<div class="card-body">
					<form action="{{route('combi19.storeRuta')}}" method="POST">
						@csrf
						<div class="form-group row">
							<label class="col-md-4 col-form-label text-md-right">Ciudad origen:</label>
							<div class="col-md-6">
								<select class="form-control" name="origen_id">
									@foreach($lugares as $origen)
									<option value={{$origen->id}}>
										{{$origen->nombre}}
									</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-md-4 col-form-label text-md-right">Ciudad destino:</label>
							<div class="col-md-6">
								<select class="form-control" name="destino_id">
									@foreach($lugares as $destino)
									<option value={{$destino->id}}>
										{{$destino->nombre}}
									</option>
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
								<textarea class="form-control" name="descripcion" rows="4" cols="20" maxlength="140" style="resize: none"> {{old('descripcion')}}</textarea>
								@error('descripcion')
									<small>{{$message}}</small>
								@enderror
							</div>
						</div>
						<div class="form-group row">
							<label class="col-md-4 col-form-label text-md-right">Distancia:</label>
							<div class="col-md-6">
								<input type="number" class="form-control" name="distancia" value="{{old('distancia')}}">
								@error('distancia')
									<small>{{$message}}</small>
								@enderror
							</div>
						</div>
						<div class="form-group row mb-0">
							<div class="col-md-8 offset-md-4">
								<button type="submit"class="btn btn-primary">
									{{ __('Cargar') }}
								</button>
								</button>
								<a type="button" href="{{route('combi19.listarRutas')}}" class="btn btn-secondary">
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
