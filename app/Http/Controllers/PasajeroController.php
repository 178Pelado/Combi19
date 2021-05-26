<?php

namespace App\Http\Controllers;

use App\Models\Pasajero;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StorePasajeros;
use App\Http\Requests\UpdatePasajeros;

class PasajeroController extends Controller
{

  public function registro(){
    return view('pasajeros.registro');
  }

  public function store(StorePasajeros $request){

    $pasajero = new Pasajero();

    $pasajero->nombre = $request->nombre;
    $pasajero->apellido = $request->apellido;
    $pasajero->dni = $request->dni;
    $pasajero->email = $request->email;
    $pasajero->contraseña = $request->clave;
    $pasajero->fecha_de_nacimiento = $request->fecha_nacimiento;

    $pasajero->save();
  }

  public function modificarDatosDeCuentaPasajero($emailPasajero){
    $pasajero = Pasajero::where('email', '=', $emailPasajero)->get()->first();
    return view('pasajero.modificarDatosDeCuentaPasajero', compact('pasajero'));
  }

  public function updatePasajero(UpdatePasajeros $request, Pasajero $pasajero){
    $pasajero->update($request->all());
    $user = User::
    return redirect()->route('homeGeneral');
  }
}
