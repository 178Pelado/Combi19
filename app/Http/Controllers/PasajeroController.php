<?php

namespace App\Http\Controllers;

use App\Models\Pasajero;
use App\Models\User;
use App\Models\Combi;
use App\Models\Ruta;
use App\Models\Lugar;
use App\Models\Viaje;
use App\Models\Pasaje;
use App\Models\Comentario;
use App\Models\Suscripcion;
use App\Models\Tarjeta;
use Session;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Requests\StorePasajeros;
use App\Http\Requests\UpdatePasajeros;
use App\Http\Requests\StoreSuscripcion;
use App\Http\Requests\StoreTarjeta;
use App\Http\Requests\StoreComentario;
use App\Http\Requests\StoreTercero;
use App\Http\Requests\ValidateTarjeta;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Str;

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

    $pasajero->save();
  }

  public function modificarDatosDeCuentaPasajero($emailPasajero){
    $pasajero = Pasajero::where('email', '=', $emailPasajero)->get()->first();
    return view('pasajero.modificarDatosDeCuentaPasajero', compact('pasajero'));
  }

  public function updatePasajero(UpdatePasajeros $request, Pasajero $pasajero){
    $user = User::where('email', '=', $pasajero->email)->get()->first();
    $pasajero->update($request->all());
    $pasajero->contraseña = $request->contraseñaNueva;
    $pasajero->save();
    $user->name = $request->nombre;
    $user->email = $request->email;
    $user->password = Hash::make($request['contraseñaNueva']);
    $user->save();
    return redirect()->route('combi19.perfilDePasajero', $pasajero->email);
  }

  public function perfilDePasajero($emailPasajero){
    $pasajero = Pasajero::where('email', '=', $emailPasajero)->get()->first();
    $suscripcion = Suscripcion::where('pasajero_id', '=', $pasajero->id)->get()->first();
    $comentarios = Comentario::where('pasajero_id', '=', $pasajero->id)->get();
    if($suscripcion == null){
      return view('pasajero.perfilDePasajero', compact('pasajero', 'suscripcion', 'comentarios'));
    }
    $tarjeta = Tarjeta::where('id','=',$suscripcion->tarjeta_id)->get()->first();
    return view('pasajero.perfilDePasajero', compact('pasajero', 'suscripcion', 'tarjeta', 'comentarios'));
  }

  public function buscarViaje(){
    $ciudadO = null;
    $ciudadD = null;
    $precio = null;
    $tipo_de_combi = null;
    $fecha = null;
    $viajes = Viaje::where('estado', '=', 1)->get();
    $pasajero = Pasajero::where('email', '=', Auth::user()->email)->first();
    return view('buscarViaje', compact('viajes', 'ciudadO', 'ciudadD', 'precio', 'tipo_de_combi', 'fecha', 'pasajero'));
  }

  public function buscarViajeConDatos(request $request){
    $ciudadO = $request->ciudadO;
    $ciudadD = $request->ciudadD;
    $tipo_de_combi = $request->tipo_de_combi;
    $fecha = $request->fecha;
    $precio = $request->precio;
    $viajes2 = array();
    $viajes1 = Viaje::where('estado', '=', 1)
              ->whereIn('combi_id', Combi::select('id')->where('tipo', '=', $tipo_de_combi))
              ->whereIn('ruta_id', Ruta::select('id')->whereIn('origen_id', Lugar::select('id')->where('nombre', 'like', '%' . $ciudadO . '%')))
              ->whereIn('ruta_id', Ruta::select('id')->whereIn('destino_id', Lugar::select('id')->where('nombre', 'like', '%' . $ciudadD . '%')))
              ->get();
    $viajes = $viajes1;
    if($precio != null){
      $viajes1 = $viajes1->where('precio', '<=', $precio);
      $viajes1 = collect([$viajes1], []);
      $viajes1 = $viajes1->collapse();
      $viajes = $viajes1;
    }
    if($fecha != null){
      for($i = 0; $i < count($viajes1); $i++){
        $soloFecha = $viajes1[$i]->fecha;
        $soloFecha = Str::limit($soloFecha, 10, '');
        if($soloFecha == $fecha){
          array_push($viajes2, $viajes1[$i]);
        }
      }
      $viajes = $viajes2;
    }
    $pasajero = Pasajero::where('email', '=', Auth::user()->email)->first();
    return view('buscarViaje', compact('viajes', 'ciudadO', 'ciudadD', 'precio', 'tipo_de_combi', 'fecha', 'pasajero'));
  }

  public function suscripcion($emailPasajero){
    $pasajero = Pasajero::where('email', '=', $emailPasajero)->get()->first();
    $suscripcion = Suscripcion::where('pasajero_id', '=', $pasajero->id)->get()->first();
    if (empty($suscripcion)){
      return view('pasajero.suscribirPasajero')->with('pasajero', $pasajero);
    } else {
      $misViajes = Viaje::whereIn('id', Pasaje::select('viaje_id')->where('pasajero_id','=',$pasajero->id))->where('estado','=',3)->paginate();
      // viajes finalizados realizados por el usuario
      $tarjeta = Tarjeta::where('id', '=', $suscripcion->tarjeta_id)->get()->first();

      $dt = new Carbon();
      $fechaActual = $dt->format("Y-m-d");
      $fechaActual = date($fechaActual); //paso la fecha de string a Date
      $fechaBD = date($suscripcion->fecha_baja);
      // si no hay una fecha de baja programada entra sin problemas
      if ($suscripcion->fecha_baja == null) {
        return view('pasajero.verSuscripcion', compact('pasajero', 'misViajes', 'tarjeta', 'suscripcion'));
      } elseif ($fechaBD>=$fechaActual) {
        // sino, si la fecha programada aún no llegó
        return view('pasajero.verSuscripcion', compact('pasajero', 'misViajes', 'tarjeta', 'suscripcion'));
      } else {
        // por ultimo, si la fecha si llegó
        return redirect()->route('combi19.eliminarSuscripcion', $pasajero->email); //elimino la suscripción
      }
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

  public function modificarTarjeta($emailPasajero){
    $pasajero = Pasajero::where('email', '=', $emailPasajero)->get()->first();
    return view('pasajero.modificarTarjeta', compact('pasajero'));
  }

  public function updateTarjeta(Request $data, Pasajero $pasajero){
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
    $tarjeta->numero = $data->numero;
    $tarjeta->codigo = $data->codigo;
    $tarjeta->fecha_de_vencimiento = $data->fecha_vencimiento;
    $tarjeta->save();

    //la suscripcion no se valida y al parecer no es necesario, pero de ser necesario habria que hacerlo en una funcion auxiliar
    //no es necesario xq un usuario suscripto nunca va a entrar a la página de suscribirse asi que el pasajero_id siempre va a ser nuevo
    //pero si de alguna forma se puede "hackear" y mandar el formulario con un id ya suscripto ahi habría que hacer la validación para evitar que se suscriba dos veces
    $suscripcion = Suscripcion::where('pasajero_id', '=', $pasajero->id)->get()->first();
    $suscripcion->tarjeta_id = $tarjeta->id;
    $suscripcion->save();

    $pasajero = $pasajero->email; //la ruta suscripcion recibe el mail
    Session::flash('messageSI', '¡Tarjeta modificada con éxito!');
    return redirect()->route('combi19.suscripcion', compact('pasajero')); //vuelve a la suscripcion del pasajero
  }

  public function prepararCancelacion($emailPasajero){
    $pasajero = Pasajero::where('email', '=', $emailPasajero)->get()->first();
    $suscripcion = Suscripcion::where('pasajero_id', '=', $pasajero->id)->get()->first();
    $dt = new Carbon();
    $fechaActual = $dt->format("Y-m-d");
    $fecha = date("Y-m-t", strtotime($fechaActual)); //ultimo dia del mes actual
    $suscripcion->fecha_baja = $fecha;
    $suscripcion->save();

    Session::flash('messageSI', 'Has cancelado tu suscripción Gold satisfactoriamente, estará activa hasta que finalice el mes');
    return redirect()->route('combi19.suscripcion', $emailPasajero); //recarga la pagina de suscripcion
  }

  public function eliminarSuscripcion($emailPasajero){
    $pasajero = Pasajero::where('email', '=', $emailPasajero)->get()->first();
    $suscripcion = Suscripcion::where('pasajero_id', '=', $pasajero->id)->get()->first();
    $suscripcion->delete();
    Session::flash('messageSI', 'Has cancelado tu suscripción Gold satisfactoriamente');
    return redirect()->route('combi19.suscripcion', $emailPasajero); //vuelve al home
  }

  public function misViajes($emailPasajero){
    $pasajero = Pasajero::where('email', '=', $emailPasajero)->get()->first();
    $misViajes = Viaje::whereIn('id', Pasaje::select('viaje_id')->where('pasajero_id','=',$pasajero->id)->where('deleted_at', '=', null))->paginate();
    // viajes realizados por el usuario
    $pasajes = Pasaje::where('estado', '=', 3)->where('pasajero_id', '=', $pasajero->id)->get();
    return view('pasajero.misViajes', compact('pasajero', 'misViajes', 'pasajes'));
  }

  public function realizarComentario(){
    return view('pasajero.realizarComentario');
  }

  public function storeComentario(StoreComentario $request, Pasaje $pasaje, $emailPasajero){
      $comentario = new Comentario();
      $comentario->viaje_id = $pasaje->viaje_id;
      $comentario->pasajero_id = $pasaje->pasajero_id;
      $comentario->pasaje_id = $pasaje->id;
    	$comentario->texto = $request->comentario;
      $comentario->save();
      Session::flash('messageSI', '¡Comentario realizado con éxito!');
      return redirect()->route('combi19.misViajes', [$emailPasajero]);
  }

  public function updateComentario(Request $request, Comentario $comentario, $emailPasajero){
    $comentario->texto = $request->comentario;
    $comentario->save();
    Session::flash('messageSI', '¡Comentario actualizado con éxito!');
    return redirect()->route('combi19.misViajes', [$emailPasajero]);
  }

  public function eliminarComentario(Comentario $comentario, $emailPasajero){
    $comentario->delete();
    Session::flash('messageSI', '¡Comentario eliminado con éxito!');
    return redirect()->route('combi19.misViajes', [$emailPasajero]);
  }

  public function cargarDatosTercero($viaje_id){
    return view('pasajero.reservarPasajeTercero', compact('viaje_id'));
  }

  public function reservarPasajeTercero(StoreTercero $request){
    $tercero = new Pasajero();
    $tercero->nombre = $request->nombre;
    $tercero->apellido = $request->apellido;
    $tercero->dni = $request->dni;
    $tercero->email = null;
    $tercero->contraseña = null;
    $tercero->save();
    return redirect()->route('cart.addViaje', [$request->viaje_id, $tercero]);
  }

  public function cargarTarjeta(){
    return view('pasajero.cargarTarjeta');
  }

  public function validarTarjeta(ValidateTarjeta $request){
      return redirect()->route('combi19.pagarPasajePobre');
  }

  public function cancelarPasaje(Pasaje $pasaje){
    $pasaje->estado = 5;
    $pasaje->save();
    return redirect()->route('combi19.misViajes', Auth::user()->email);
  }
}
