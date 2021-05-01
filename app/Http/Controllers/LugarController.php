<?php

namespace App\Http\Controllers;

use App\Models\Lugar;
use Illuminate\Http\Request;
use App\Http\Requests\StoreLugares;

class LugarController extends Controller
{

    public function altaLugar(){
    	return view('administrador.altaLugar');
    }

    public function storeLugar(StoreLugares $request){
    	$lugar = new Lugar();

    	$lugar->nombre = $request->nombre;

    	$lugar->save();
      return view('administrador.altaLugar');
    }

    public function listarLugares(){
    	$lugares = Lugar::paginate();
      return view('administrador.listarLugares', compact('lugares'));
    }
}
