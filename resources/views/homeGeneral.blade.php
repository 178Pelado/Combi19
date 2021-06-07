@extends('layouts.app')
@section('title', 'Menu')
@section('content')
<div class="container-fluid">
  <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="http://www.ludaturismo.com.ar/assets/img/header3_nueva.jpg?1" class="d-block w-100" alt="..." style="height: 800px; width: 800px">
        <div class="carousel-caption d-none d-md-block">
          <h5>Descubrí los beneficios de ser usuario gold</h5>
          <!-- <p>Some representative placeholder content for the first slide.</p> -->
        </div>
      </div>
      <div class="carousel-item">
        <img src="http://www.ludaturismo.com.ar/assets/img/header2_nueva.jpg?3" class="d-block w-100" alt="..." style="height: 800px; width: 800px">
        <div class="carousel-caption d-none d-md-block">
          <h5>Los mejores precios en la Argentina</h5>
          <!-- <p>Some representative placeholder content for the second slide.</p> -->
        </div>
      </div>
      <div class="carousel-item">
        <img src="http://www.ludaturismo.com.ar/assets/img/header7_nueva.jpg?4" class="d-block w-100" alt="..." style="height: 800px; width: 800px">
        <div class="carousel-caption d-none d-md-block">
          <h5>¡Disponemos de combis super cómodas!</h5>
          <!-- <p>Some representative placeholder content for the third slide.</p> -->
        </div>
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
</div>

<br>

<!-- Intento de sistema de comentarios -->
<div class="container" style="float:left">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card">
        <div class="card-header"><h4>Comentarios</h4></div>
        <div class="card-body">
          @if (count($comentarios) > 0)
          @foreach ($comentarios as $comentario)
          <div class="row">
            <div class="col-md-10">
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
  </div>
</div>

@endsection
