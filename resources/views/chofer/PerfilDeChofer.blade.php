@extends('layouts.app')
@section('title', 'Perfil de chofer')
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
                <h4>Mi perfil: {{$chofer->nombre. ' '. $chofer->apellido}}</h4>
              </div>
            </div>
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
                {{$chofer->nombre}}
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <h6 class="mb-0">Apellido</h6>
              </div>
              <div class="col-sm-9 text-secondary">
                {{$chofer->apellido}}
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <h6 class="mb-0">Telefono</h6>
              </div>
              <div class="col-sm-9 text-secondary">
                {{$chofer->telefono}}
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <h6 class="mb-0">Email</h6>
              </div>
              <div class="col-sm-9 text-secondary">
                {{$chofer->email}}
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-12">
                <a class="btn btn-info " href="{{ route('combi19.modificarDatosDeCuentaChofer', $chofer) }}">Editar datos</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
