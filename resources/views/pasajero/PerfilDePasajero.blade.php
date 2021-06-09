@extends('layouts.app')
@section('title', 'Perfil de pasajero')
@section('content')
<div class="container">

  <div class="main-body">
    <div class="row gutters-sm">
      <div class="col-md-4 mb-3">
        @if(Session::has('messageNO'))
        <div class="alert alert-danger alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          {{Session::get('messageNO')}}
        </div>
        @elseif(Session::has('messageSI'))
        <div class="alert alert-success alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          {{Session::get('messageSI')}}
        </div>
        @endif
        <div class="card">
          <div class="card-body">
            <div class="d-flex flex-column align-items-center text-center">
              <div class="mt-3">
                <h4>Mi perfil: {{$pasajero->nombre. ' '. $pasajero->apellido}}</h4>
              </div>
            </div>
          </div>
        </div>
        <div class="card mt-3" style="width:100%; height:50%;overflow: scroll;">
          <div class="card-header"><h4>Mis comentarios</h4></div>
          <div class="card-body">
            @if (count($comentarios) > 0)
            @foreach ($comentarios as $comentario)
            <div class="row">
              <div class="col-md-20">
                <p>
                  <strong>{{$comentario->pasajero->nombre}} {{$comentario->pasajero->apellido}}</strong>
                </p>
                <div class="clearfix"></div>
                <p>{{$comentario->texto}}</p>
              </div>
            </div>
            <hr style="width:100%;">
            @endforeach
            @else
            <h1>No hay comentarios</h1>
            @endif
          </div>
        </div>
      </div>
      <div class="col-md-8">
        <div class="card mb-3">
          <div class="card-body">
            <div class="row">
              <div class="col-sm-3">
                <h6 class="mb-0">Nombre</h6>
              </div>
              <div class="col-sm-9 text-secondary">
                {{$pasajero->nombre}}
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <h6 class="mb-0">Apellido</h6>
              </div>
              <div class="col-sm-9 text-secondary">
                {{$pasajero->apellido}}
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <h6 class="mb-0">Dni</h6>
              </div>
              <div class="col-sm-9 text-secondary">
                {{$pasajero->dni}}
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <h6 class="mb-0">Email</h6>
              </div>
              <div class="col-sm-9 text-secondary">
                {{$pasajero->email}}
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <h6 class="mb-0">Membresía gold</h6>
              </div>
              @if ($suscripcion != null)
              <div class="col-sm-9 text-secondary">
                Activa
                <a class="btn btn-info " target="" href="{{ route('combi19.suscripcion', Auth::user()->email) }}">Ver</a>
              </div>
              @else
              <div class="col-sm-9 text-secondary">
                No activa
              </div>
              @endif
            </div>
            <hr>
            @if ($suscripcion != null)
            <div class="row">
              <div class="col-sm-3">
                <h6 class="mb-0">Tarjeta de crédito</h6>
              </div>
              <div class="col-sm-9 text-secondary">
                ************{{substr($tarjeta->numero,12,15)}}
              </div>
            </div>
            <hr>
            @endif
            <div class="row">
              <div class="col-sm-12">
                <a class="btn btn-info " href="{{ route('combi19.modificarDatosDeCuentaPasajero', Auth::user()->email) }}">Editar datos</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
