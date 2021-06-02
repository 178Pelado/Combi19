<?php

namespace App\Http\Controllers;
use App\Models\Comentario;

class HomeVisitanteController extends Controller
{

    public function homeGeneral(){
      $comentarios = Comentario::get();
    	return view('homeGeneral', compact('comentarios'));
    }
}
