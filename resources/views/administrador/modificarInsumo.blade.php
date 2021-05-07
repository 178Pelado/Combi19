@extends('layouts.vistaAdministrador')

@section('title', 'Modificar Insumo')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">{{ __('Modificar Insumo') }}</div>
				<div class="card-body">
					<form action="{{route('combi19.updateInsumo', $insumo)}}" method="POST">
						@csrf @method('PUT')
						<input type="hidden" name="id" value="{{$insumo->id}}">
						<div class="form-group row">
							<label class="col-md-4 col-form-label text-md-right">Nombre:</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="nombre" value="{{old('nombre', $insumo->nombre)}}">
								@error('nombre')
									<small>{{$message}}</small>
								@enderror
							</div>
						</div>
						<div class="form-group row">
							<label class="col-md-4 col-form-label text-md-right">Descripción:</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="descripcion" value="{{old('descripcion', $insumo->descripcion)}}">
								@error('descripcion')
									<small>{{$message}}</small>
								@enderror
							</div>
						</div>
						<div class="form-group row">
							<label class="col-md-4 col-form-label text-md-right">Cantidad:</label>
							<div class="col-md-6">
								<input type="number" class="form-control" name="cantidad" value="{{old('cantidad', $insumo->cantidad)}}">
								@error('cantidad')
									<small>{{$message}}</small>
								@enderror
							</div>
						</div>
						<div class="form-group row">
							<label class="col-md-4 col-form-label text-md-right">Precio:</label>
							<div class="col-md-6">
								<input type="number" step="any" class="form-control" name="precio" value="{{old('precio', $insumo->precio)}}">
								@error('precio')
									<small>{{$message}}</small>
								@enderror
							</div>
						</div>
						<div class="form-group row mb-0">
							<div class="col-md-8 offset-md-4">
								<button type="submit"class="btn btn-primary">
									{{ __('Actualizar') }}
								</button>
                                </button>
                                <a type="button" href="{{route('combi19.listarInsumosTotal')}}" class="btn btn-secondary">
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