<?php

namespace App\Http\Controllers;

use App\Models\Lugar;
use Illuminate\Http\Request;

class LugarController extends Controller
{

    public function altaLugar(){
    	return view('administrador.altaLugar');
    }

    public function storeLugar(Request $request){
    	$lugar = new Lugar();

    	$lugar->nombre = $request->nombre;

    	$lugar->save();
      return view('administrador.altaLugar'); //vuelve a listado de choferes
    }
}
