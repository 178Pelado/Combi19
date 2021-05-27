<?php

namespace App\Http\Controllers;

use App\Models\Pasajero;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StorePasajeros;
use App\Http\Requests\UpdatePasajeros;
use App\Http\Requests\StoreSuscripcion;
use App\Http\Requests\StoreTarjeta;
use App\Models\Suscripcion;
use App\Models\Tarjeta;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

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
    return redirect()->route('homeGeneral');
  }

  public function suscripcion($emailPasajero){
    $pasajero = Pasajero::where('email', '=', $emailPasajero)->get()->first();
    $suscripcion = Suscripcion::where('pasajero_id', '=', $pasajero->id)->get()->first();
    if (empty($suscripcion)){
      return view('pasajero.suscribirPasajero')->with('pasajero', $pasajero);    
    } else {
      return view('pasajero.verSuscripcion')->with('pasajero', $pasajero);
    }
    
  }

  public function storeSuscripcion(Request $data, $pasajero){ 
    //no entiendo por qué pero en $pasajero entra su id
    $dt = new Carbon();
    $after = $dt->format("Y-m-d");
    $data-> validate([
      'numero' => 'required|numeric|digits: 16', //no es necesario verificar que sea unique xq en el if de abajo hago esa validación
      'codigo' => 'required|numeric|digits: 3',
      'fecha_vencimiento' => 'required|after:' . $after,
    ]);

    $tarjeta = Tarjeta::where('numero', '=', $data->numero)->get()->first();
    if ($tarjeta == null){
      $tarjeta = new Tarjeta();
      $tarjeta->numero = $data->numero;
      $tarjeta->codigo = $data->codigo;
      $tarjeta->fecha_de_vencimiento = $data->fecha_vencimiento;
      $tarjeta->save();
    }

    //la suscripcion no se valida y al parecer no es necesario, pero de ser necesario habria que hacerlo en una funcion auxiliar
    //no es necesario xq un usuario suscripto nunca va a entrar a la página de suscribirse asi que el pasajero_id siempre va a ser nuevo
    //pero si de alguna forma se puede "hackear" y mandar el formulario con un id ya suscripto ahi habría que hacer la validación para evitar que se suscriba dos veces
    $suscripcion = new Suscripcion();
    $suscripcion->pasajero_id = $pasajero;
    $suscripcion->tarjeta_id = $tarjeta->id;
    $suscripcion->save();

    return redirect()->route('homeGeneral'); //vuelve al home
  }
}
