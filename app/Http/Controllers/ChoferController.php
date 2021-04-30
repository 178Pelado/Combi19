<?php

namespace App\Http\Controllers;

use App\Models\Chofer;
use Illuminate\Http\Request;
use App\Http\Requests\StoreChoferes;

class ChoferController extends Controller
{

    public function registroChofer(){
    	return view('administrador.registroChofer');
    }

    public function storeChofer(StoreChoferes $request){
    	$chofer = new Chofer();

    	$chofer->nombre = $request->nombre;
    	$chofer->apellido = $request->apellido;
    	$chofer->telefono = $request->telefono;
    	$chofer->email = $request->email;
    	$chofer->contraseña = $request->clave;

    	$chofer->save();
      return view('administrador.registroChofer'); //vuelve a listado de choferes
    }
}
