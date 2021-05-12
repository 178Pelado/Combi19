@extends('layouts.app')

@section('title', 'Alta de combi')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Alta de Combi') }}</div>
                <div class="card-body">
                    <form action="{{route('combi19.storeCombi')}}" method="POST">
                        @csrf
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Patente:</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="patente" value="{{old('patente')}}" autofocus>
                                @error('patente')
                					<small>{{$message}}</small>
                				@enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Modelo:</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="modelo" value="{{old('modelo')}}">
                                @error('modelo')
                				    <small>{{$message}}</small>
                				@enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Cantidad de asientos:</label>
                            <div class="col-md-6">
                                <input type="number" class="form-control" name="cantidad_asientos" value="{{old('cantidad_asientos')}}">
                                @error('cantidad_asientos')
                				    <small>{{$message}}</small>
                				@enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Tipo:</label>
                            <div class="col-md-6">
                                <label>
                                    <input type="radio" name="tipo" value="Cómoda"> Cómoda
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
                                @if (count($choferes) !== 0)
                                    <select class="form-control" name="chofer_id">
                                        @foreach($choferes as $chofer)
                                            <option value={{$chofer->id}}>
                                                {{$chofer->apellido}}
                                                {{$chofer->nombre}}
                                            </option>
                                        @endforeach
                                    </select>
                                @else
                                    <div class="alert alert-danger alert-dismissible" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <a href="{{route('combi19.registroChofer')}}" class="alert-link">No hay choferes disponibles. Seleccione aquí para registrar uno nuevo</a>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit"class="btn btn-primary">
                                    {{ __('Cargar') }}
                                </button>
                                </button>
                                <a type="button" href="javascript:history.back(-1);" class="btn btn-secondary">
                                    {{ __('Cancelar') }}
                                </a>
                            </div>
                        </div>
                    </form>
                    <a href="{{route('combi19.registroChofer')}}">Alta chofer</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
