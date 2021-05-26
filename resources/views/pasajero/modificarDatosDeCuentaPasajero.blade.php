@extends('layouts.app')
@section('title', 'Editar datos')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Editar datos personales') }}</div>

                <div class="card-body">
									<form action="{{route('combi19.updatePasajero', $pasajero)}}" method="POST">
										@csrf @method('PUT')
												<input type="hidden" name="id" value="{{$pasajero->id}}">
                        <div class="form-group row">
            							<label class="col-md-4 col-form-label text-md-right">Nombre:</label>
            							<div class="col-md-6">
            								<input type="text" class="form-control" name="nombre" value="{{old('nombre', $pasajero->nombre)}}" autofocus>
            								@error('nombre')
            								<small>{{$message}}</small>
            								@enderror
            							</div>
            						</div>
            						<div class="form-group row">
            							<label class="col-md-4 col-form-label text-md-right">Apellido:</label>
            							<div class="col-md-6">
            								<input type="text" class="form-control" name="apellido" value="{{old('apellido', $pasajero->apellido)}}">
            								@error('apellido')
            								<small>{{$message}}</small>
            								@enderror
            							</div>
            						</div>
            						<div class="form-group row">
            							<label class="col-md-4 col-form-label text-md-right">DNI:</label>
            							<div class="col-md-6">
            								<input type="text" class="form-control" name="dni" value="{{old('dni', $pasajero->dni)}}">
            								@error('dni')
            								<small>{{$message}}</small>
            								@enderror
            							</div>
            						</div>
            						<div class="form-group row">
            							<label class="col-md-4 col-form-label text-md-right">Email:</label>
            							<div class="col-md-6">
            								<input type="email" class="form-control" name="email" value="{{old('email', $pasajero->email)}}">
            								@error('email')
            								<small>{{$message}}</small>
            								@enderror
            							</div>
            						</div>
            						<div class="form-group row">
            							<label class="col-md-4 col-form-label text-md-right">Clave:</label>
            							<div class="col-md-6">
            								<input type="password" class="form-control" name="contraseña" value="{{old('contraseña', $pasajero->contraseña)}}">
            								@error('contraseña')
            								<small>{{$message}}</small>
            								@enderror
            							</div>
            						</div>
            						<div class="form-group row">
            							<label class="col-md-4 col-form-label text-md-right">Fecha de nacimiento:</label>
            							<div class="col-md-6">
            								<input type="date" class="form-control" name="fecha_de_nacimiento" value="{{old('fecha_de_nacimiento', $pasajero->fecha_de_nacimiento)}}">
            								@error('fecha_de_nacimiento')
            								<small>{{$message}}</small>
            								@enderror
            							</div>
            						</div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Guardar cambios') }}
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
