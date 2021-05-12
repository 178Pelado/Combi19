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
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-20">
            <div class="card">
                <div class="card-header">{{ __('Comentarios') }}</div>
                <div class="card-body">
                    <div class="form-floating">
                      <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea"></textarea>
                      <label for="floatingTextarea">Escribe tu comentario aquí</label>
                    </div> <br>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="well">
                                <p>
                                    Comentario 1 - Dominic "Dom" Toretto - Hace 5 minutos
                                </p>
                                <p>
                                    Comentario 2 - Luke Hobbs - Hace 10 minutos
                                </p>
                                <p>
                                    Comentario 3 - Roman "Rome" Pearce - Hace 15 minutos
                                </p>
                                <p>
                                    Comentario 4 - Tej Parker - Hace 20 minutos
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
