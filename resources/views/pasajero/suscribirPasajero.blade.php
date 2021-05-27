@extends('layouts.app')

@section('title', 'Suscribirse')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Ingrese los datos de su tarjeta') }}</div>
                <div class="card-body">
                    <form action="{{route('combi19.storeSuscripcion', $pasajero)}}" method="POST">
                        @csrf
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Número:</label>
                            <div class="col-md-6">
                                <input type="number" class="form-control" name="numero" value="{{old('numero')}}" autofocus>
                                @error('numero')
                					<small>{{$message}}</small>
                				@enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Código de seguridad:</label>
                            <div class="col-md-6">
                                <input type="number" class="form-control" name="codigo" value="{{old('codigo')}}">
                                @error('codigo')
                				    <small>{{$message}}</small>
                				@enderror
                            </div>
                        </div>
                        <div class="form-group row">
							<label class="col-md-4 col-form-label text-md-right">Fecha de vencimiento:</label>
							<div class="col-md-6">
								<input type="date" class="form-control" name="fecha_vencimiento" value="{{old('fecha_vencimiento')}}">
								@error('fecha_vencimiento')
								<small>{{$message}}</small>
								@enderror
							</div>
						</div>
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit"class="btn btn-primary">
                                    {{ __('Suscribirse') }}
                                </button>
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
