<?php

namespace App\Http\Controllers;

use App\Models\Pasajero;
use Illuminate\Http\Request;
use App\Http\Requests\store;

class PasajeroController extends Controller
{

    public function registro(){
    	return view('pasajeros.registro');
    }

    public function store(store $request){

    	$pasajero = new Pasajero();

    	$pasajero->nombre = $request->nombre;
    	$pasajero->apellido = $request->apellido;
    	$pasajero->dni = $request->dni;
    	$pasajero->email = $request->email;
    	$pasajero->contraseña = $request->clave;
    	$pasajero->fecha_de_nacimiento = $request->fecha_nacimiento;

    	$pasajero->save();
    }
}
