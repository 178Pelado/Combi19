<?php

namespace App\Http\Controllers;

use App\Models\Pasajero;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StorePasajeros;
use App\Http\Requests\UpdatePasajeros;
use App\Models\Suscripcion;
use App\Models\Tarjeta;

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

  public function suscripcion($emailPasajero){
    $pasajero = Pasajero::where('email', '=', $emailPasajero)->get()->first();
    $suscripciones = Suscripcion::where('pasajero_id', '=', $pasajero->id)->get();
    if (isEmpty($suscripciones)){
      return redirect()->route('combi19.suscribirPasajero')->with('pasajero', $pasajero);
    } else {
      return redirect()->route('combi19.verSuscripcion')->with('pasajero', $pasajero);
    }
    
  }

  public function suscribirPasajero($pasajero){
    return view('pasajero.suscribirPasajero')->with('pasajero', $pasajero);
  }

  public function verSuscripcion($pasajero){
    return view('pasajero.verSuscripcion')->with('pasajero', $pasajero);
  }

  public function storeSuscripcion(StoreSuscripcion $request, $emailPasajero){
    $tarjeta = Tarjeta::where('numero', '=', $request->numero)->get()->first();
    if (isEmpty($tarjeta)){
      $tarjeta = new Tarjeta();
      $tarjeta->numero = $request->numero;
      $tarjeta->codigo = $request->codigo;
      $tarjeta->fecha_de_vencimiento = $request->fecha_vencimiento;
      $tarjeta->save();
    }
    $pasajero = Pasajero::where('email', '=', $emailPasajero)->get()->first();
    $suscripcion = new Suscripcion();
    $suscripcion->pasajero_id = $pasajero->id;
    $suscripcion->tarjeta_id = $tarjeta->id;
    $suscripcion->save();

    return redirect()->route('homeGeneral'); //vuelve al home
  }
}
