@extends('layouts.app')

@section('title', 'Comprar insumos')

@section('content')
<div class="container">
    <div>
       <div>
           @if (count(Cart::getContent()))
               <a href="{{route('cart.checkout')}}"> VER CARRITO <span class="badge badge-danger">{{count(Cart::getContent())}}</span></a>
           @endif
           @if(Session::has('insumoCargado'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    {{Session::get('insumoCargado')}}
                </div>
            @endif
            @error('cantidad')
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    {{$message}}
                </div>
            @enderror
       </div>
       <!-- class="col-sm-8" -->
       <div>
            <div class="row  justify-content-center">
                @foreach ($insumos as $insumo)
                <div class="col-6 border p-5 mt-5 text-center">
                    <h1>{{$insumo->insumo->nombre}}</h1>
                    <p>{{$insumo->insumo->descripcion}}</p>
                    <p>$ {{$insumo->insumo->precio}}</p>
                    <form action="{{route('cart.add')}}" method="post">
                        @csrf
                        <div class="form-group row">
                            <input type="hidden" name="insumo_id" value="{{$insumo->insumo->id}}">
                            <input type="hidden" name="viaje_id" value="{{$viaje_id}}">
                            <input type="hidden" name="pasajero_id" value="{{$pasajero_id}}">
                            <input type="number" name="cantidad" class="form-control" value="1">
                            
                        </div>
                        <div class="form-group row mb-0">
                            <input type="submit" name="btn"  class="btn btn-primary" value="AÑADIR AL CARRITO">
                        </div>
                        
                    </form>
                </div>
                
            @endforeach
            </div>
       </div>
    </div>
</div>
@endsection