@extends('layouts.vistaAdministrador')

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
                                <input type="text" class="form-control" name="patente" autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Modelo:</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="modelo">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Cantidad de asientos:</label>
                            <div class="col-md-6">
                                <input type="number" class="form-control" name="cantidad_asientos">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Tipo:</label>
                            <div class="col-md-6">
                                <label>
                                    <input type="radio" name="tipo" value="1"> Cómoda
                                </label>
                                <br>
                                <label>
                                    <input type="radio" name="tipo" value="2"> Súper-Cómoda
                                </label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Chofer:</label>
                            <div class="col-md-6">
                                <select name="chofer_id">
                                    @foreach($choferes as $chofer)  
                                        <option value={{$chofer->id}}>
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
                                    {{ __('Registrar') }}
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