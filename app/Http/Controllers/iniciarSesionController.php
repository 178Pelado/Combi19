<?php

namespace App\Http\Controllers;

use App\Models\Pasajero;
use Illuminate\Http\Request;

class iniciarSesionController extends Controller
{

    public function iniciarSesion(){
    	return view('pasajeros.iniciarSesion');
    }

    // public function store(Request $request){
    // 	$pasajero = new Pasajero();
    //
    // 	$pasajero->nombre = $request->nombre;
    // 	$pasajero->apellido = $request->apellido;
    // 	$pasajero->dni = $request->dni;
    // 	$pasajero->email = $request->email;
    // 	$pasajero->contraseña = $request->clave;
    // 	$pasajero->fecha_de_nacimiento = $request->fecha_nacimiento;
    //
    // 	$pasajero->save();
    // }
}
