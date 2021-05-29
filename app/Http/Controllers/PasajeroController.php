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
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Requests\StorePasajeros;
use App\Http\Requests\UpdatePasajeros;
use App\Http\Requests\StoreSuscripcion;
use App\Http\Requests\StoreTarjeta;
use App\Http\Requests\StoreComentario;
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
    $pasajero->contraseña = $request->contraseñaNueva;
    $pasajero->save();
    $user->name = $request->nombre;
    $user->email = $request->email;
    $user->password = Hash::make($request['contraseñaNueva']);
    $user->save();
    return view('pasajero.perfilDePasajero', compact('pasajero'));
  }

  public function perfilDePasajero($emailPasajero){
    $pasajero = Pasajero::where('email', '=', $emailPasajero)->get()->first();
    $suscripcion = Suscripcion::where('pasajero_id', '=', $pasajero->id)->get()->first();
    if($suscripcion == null){
      return view('pasajero.perfilDePasajero', compact('pasajero', 'suscripcion'));
    }
    $tarjeta = Tarjeta::where('id','=',$suscripcion->tarjeta_id)->get()->first();
    return view('pasajero.perfilDePasajero', compact('pasajero', 'suscripcion', 'tarjeta'));
  }

  public function buscarViaje(){
    $viajes = Viaje::where('estado', '=', 1)->get();
    $ciudadO = null;
    $ciudadD = null;
    $precio = null;
    $tipo_de_combi = null;
    $fecha = null;
    $viajes = Viaje::where('estado', '=', 1)->get();
    return view('buscarViaje', compact('viajes', 'ciudadO', 'ciudadD', 'precio', 'tipo_de_combi', 'fecha'));
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
    return view('buscarViaje', compact('viajes', 'ciudadO', 'ciudadD', 'precio', 'tipo_de_combi', 'fecha'));
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
      return view('pasajero.verSuscripcion', compact('pasajero', 'misViajes', 'tarjeta'));
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

  public function misViajes($emailPasajero){
    $pasajero = Pasajero::where('email', '=', $emailPasajero)->get()->first();
    $misViajes = Viaje::whereIn('id', Pasaje::select('viaje_id')->where('pasajero_id','=',$pasajero->id))->paginate();
    // viajes realizados por el usuario
    return view('pasajero.misViajes', compact('pasajero', 'misViajes'));
  }

  public function realizarComentario(){
    return view('pasajero.realizarComentario');
  }

  public function storeComentario(StoreComentario $request, Viaje $viaje, $emailPasajero){
      $pasajero = Pasajero::where('email', '=', $emailPasajero)->get()->first();
      $comentario = new Comentario();
      $comentario->viaje_id = $viaje->id;
      $comentario->pasajero_id = $pasajero->id;
    	$comentario->texto = $request->comentario;
      $comentario->save();
      return redirect()->route('combi19.misViajes', [$emailPasajero]);
  }
}
