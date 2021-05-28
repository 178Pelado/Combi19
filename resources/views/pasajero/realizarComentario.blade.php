@extends('layouts.app')
@section('title', 'Comentar')
@section('content')
<div class="container mt-5">
  <div class="d-flex justify-content-center row">
    <div class="col-md-8">
      <div class="d-flex flex-column comment-section">
        <form action="{{route('combi19.storeComentario')}}" method="POST">
          @csrf
        <div class="bg-light p-2">
          <div class="d-flex flex-row align-items-start">
            <textarea class="form-control ml-1 shadow-none textarea" name='texto'></textarea></div>
          <div class="mt-2 text-right">
            <button class="btn btn-primary btn-sm shadow-none" type="submit">Comentar</button>
            <button class="btn btn-outline-primary btn-sm ml-1 shadow-none" type="button">Cancelar</button></div>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
