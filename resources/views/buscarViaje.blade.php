@extends('layouts.app')

@section('title', 'Buscar viajes')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Buscar Viaje') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label class="col-form-label text-md-right">Ciudad Origen:</label>
                                <div>
                                    <input type="text" class="form-control" name="nombre" value="{{old('nombre')}}" autofocus>
                                </div>
                            </div>
                                    <div class="form-group col-md-4">
                                        <label class="col-form-label text-md-right">Ciudad Destino:</label>
                                        <div>
                                            <input type="text" class="form-control" name="apellido" value="{{old('apellido')}}">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="col-form-label text-md-right">Precio:</label>
                                        <div>
                                            <input type="text" class="form-control" name="dni" value="{{old('dni')}}">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="col-form-label text-md-right">Tipo de Combi:</label>
                                        <div>
                                            <input type="email" class="form-control" name="email" value="{{old('email')}}">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="col-form-label text-md-right">Fecha:</label>
                                        <div>
                                            <input type="date" class="form-control" name="fecha_nacimiento" value="{{old('fecha_nacimiento')}}">
                                        </div>
                                    </div>
                        
                            <div class="form-group col-md-4">
                                <label class="col-form-label text-md-right"></label>
                                <div>
                                    <button type="submit" class="btn btn-primary" style="margin-top: 14px">
                                        {{ __('Buscar') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>

                    <!-- Listado -->
                    <div class="listado">
                        <table class="table table-bordered">
                            @if($viajes[0] !== null)
                            <thead>
                                <tr>
                                    <th>Ciudad Origen</th>
                                    <th>Ciudad Destino</th>
                                    <th>Precio</th>
                                    <th>Combi</th>
                                    <th>Fecha</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($viajes as $viaje)
                                <tr>
                                    <td>{{$viaje->ruta->origen->nombre}}</td>
                                    <td>{{$viaje->ruta->destino->nombre}}</td>
                                    <td>{{$viaje->precio}}</td>
                                    <td>{{$viaje->combi->tipo}}</td>
                                    <td>{{$viaje->fecha}}</td>
                                    <td>
                                        agregar al carrito
                                    </td>
                                    @endforeach
                                </tr>
                            </tbody>
                            @else
                            <h1>No hay viajes disponibles</h1>
                            @endif
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection