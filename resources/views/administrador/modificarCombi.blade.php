@extends('layouts.vistaAdministrador')

@section('title', 'Modificar Combi')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Modificar Combi') }}</div>
                <div class="card-body">
                    <form action="{{route('combi19.updateCombi', $combi)}}" method="POST">
                        @csrf @method('PUT')
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Patente:</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="patente" value="{{$combi->patente}}">
                                @error('patente')
                					<small>{{$message}}</small>
                				@enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Modelo:</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="modelo" value="{{$combi->modelo}}">
                                @error('modelo')
                				    <small>{{$message}}</small>
                				@enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Cantidad de asientos:</label>
                            <div class="col-md-6">
                                <input type="number" class="form-control" name="cantidad_asientos" value="{{$combi->cantidad_asientos}}">
                                @error('cantidad_asientos')
                				    <small>{{$message}}</small>
                				@enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Tipo:</label>
                            <div class="col-md-6">
                                <label>
                                    <input type="radio" name="tipo" value="Cómoda" checked> Cómoda
                                </label>
                                <br>
                                <label>
                                    <input type="radio" name="tipo" value="Super Cómoda"> Súper-Cómoda
                                </label>
                                <br>
                                @error('tipo')
                                  <small>{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Chofer:</label>
                            <div class="col-md-6">
                                <select class="form-control" name="chofer_id">
                                    @foreach($choferes as $chofer)
                                        <option value={{$chofer->id}} selected='selected'>
                                            {{$chofer->apellido}}
                                            {{$chofer->nombre}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit"class="btn btn-primary">
                                    {{ __('Actualizar') }}
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
