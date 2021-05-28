@extends('layouts.app')

@section('title', 'Buscar viajes')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Buscar Viaje') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{route('buscarViajeConDatos')}}">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label class="col-form-label text-md-right">Ciudad Origen:</label>
                                <div>
                                    @if($ciudadO !== null)
                                        <input type="text" class="form-control" name="ciudadO"  value="{{$ciudadO}}">
                                    @else
                                        <input type="text" class="form-control" name="ciudadO"  value="">
                                    @endif
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="col-form-label text-md-right">Ciudad Destino:</label>
                                <div>
                                    @if($ciudadD !== null)
                                        <input type="text" class="form-control" name="ciudadD"  value="{{$ciudadD}}">
                                    @else
                                        <input type="text" class="form-control" name="ciudadD"  value="">
                                    @endif
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="col-form-label text-md-right">Precio:</label>
                                <div>
                                    @if($precio !== null)
                                        <input type="number" class="form-control" name="precio"  value="{{$precio}}">
                                    @else
                                        <input type="number" class="form-control" name="precio"  value="">
                                    @endif
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="col-form-label text-md-right">Tipo de Combi:</label>
                                <div>
                                    <select class="form-control" name="tipo_de_combi">            
                                        @if($tipo_de_combi == 'Cómoda')
                                            <option value='Super Cómoda'>
                                                Super Cómoda
                                            </option>
                                            <option value='Cómoda' selected="">
                                                Cómoda
                                            </option>
                                        @else
                                            <option value='Super Cómoda'>
                                                Super Cómoda
                                            </option>
                                            <option value='Cómoda'>
                                                Cómoda
                                            </option>
                                        @endif                                                                            
                                    </select>
                                </div>
                            </div>
                                <div class="form-group col-md-4">
                                    <label class="col-form-label text-md-right">Fecha:</label>
                                    <div>
                                        @if($fecha !== null)
                                            <input type="date" class="form-control" name="fecha"  value="{{$fecha}}">
                                        @else
                                            <input type="date" class="form-control" name="fecha"  value="">
                                        @endif
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
                            @if(count($viajes) !== 0)
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