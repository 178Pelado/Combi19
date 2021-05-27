<?php

namespace App\Http\Controllers;

use App\Models\Pasajero;
use App\Models\User;
use App\Models\Viaje;
use Illuminate\Http\Request;
use App\Http\Requests\StorePasajeros;
use App\Http\Requests\UpdatePasajeros;
use Illuminate\Support\Facades\Hash;

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
    $user = User::where('email', '=', $pasajero->email)->get()->first();
    $pasajero->update($request->all());
    $user->name = $request->nombre;
    $user->email = $request->email;
    $user->password = Hash::make($request['contraseña']);
    $user->save();
    return view('pasajero.perfilDePasajero', compact('pasajero'));
  }

  public function perfilDePasajero($emailPasajero){
    $pasajero = Pasajero::where('email', '=', $emailPasajero)->get()->first();
    return view('pasajero.perfilDePasajero', compact('pasajero'));
  }

  public function buscarViaje(){
    $viajes = Viaje::where('estado', '=', 1)->get();
    return view('buscarViaje', compact('viajes'));
  }
}
