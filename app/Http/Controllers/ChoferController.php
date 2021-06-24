<?php

namespace App\Http\Controllers;

use App\Models\Chofer;
use App\Models\Combi;
use App\Models\Viaje;
use App\Models\Pasaje;
use App\Models\Pasajero;
use App\Models\Imprevisto;
use Session;
use Auth;
use Illuminate\Http\Request;
use App\Http\Requests\StoreChoferes;
use App\Http\Requests\UpdateChoferes;
use App\Http\Requests\UpdateChoferContraseña;
use App\Models\User;
use App\Http\Requests\StorePasajeroExpress;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Mail\ComprobanteMailable2;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

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

    $user = new User();
    $user->name = $request->nombre;
    $user->email = $request->email;
    $user->tipo = '2';
    $user->password = Hash::make($request->clave);
    $user->save();
    return redirect()->route('combi19.listarChoferes'); //vuelve a listado de choferes
  }

  public function listarChoferes(){
    $choferes = Chofer::paginate();
    return view('administrador.listarChoferes', compact('choferes'));
  }

  public function eliminarChofer(Chofer $chofer){
    $combi = Combi::where('chofer_id', '=', $chofer->id)->get()->first();
    if (!empty($combi)){
      Session::flash('messageNO','El chofer se encuentra asignado a una combi. Seleccione aquí para asignar un nuevo chofer.');
      return redirect()->route('combi19.listarChoferes')->with('combi', $combi);
    }
    else {
      Session::flash('messageSI','El chofer se eliminó correctamente');
      $chofer->delete();
      $user = User::where('email', '=', $chofer->email);
      $user->delete();
    }
    return redirect()->route('combi19.listarChoferes');
  }

  public function modificarChofer(Chofer $chofer){
    return view('administrador.modificarChofer', compact('chofer'));
  }

  public function updateChofer(UpdateChoferes $request, Chofer $chofer){
    $chofer->update($request->all());
    return redirect()->route('combi19.listarChoferes');
  }

  public function misViajesChofer(){
    $chofer = Chofer::where('email', '=', Auth::user()->email)->first();
    $viajes = Viaje::where('chofer_id', '=', $chofer->id)->get();
    return view('chofer.misViajes', compact('viajes'));
  }

  public function iniciarViaje($viaje_id){
    $viaje = Viaje::find($viaje_id);
    $viaje->estado = '2';
    $viaje->cambiar_estado_pasajes('2');
    $viaje->save();
    Session::flash('messageSI','El viaje se inició correctamente');
    return redirect()->route('combi19.misViajesChofer');
  }

  public function finalizarViaje($viaje_id){
    $viaje = Viaje::find($viaje_id);
    $viaje->estado = '3';
    $viaje->finalizar_viaje('3');
    $viaje->save();
    Session::flash('messageSI','El viaje se finalizó correctamente');
    return redirect()->route('combi19.misViajesChofer');
  }

  public function listaPasajeros($viaje_id){
    $pasajes = Pasaje::where('viaje_id', '=', $viaje_id)->where('estado', '!=', 4)->where('estado', '!=', 5)->get();
    return view('chofer.listaPasajeros', compact('pasajes'));
  }

  public function registroExpress($viaje){
    return view('chofer.registroExpress', compact('viaje'));
  }

  public function storeExpress(StorePasajeroExpress $request, Viaje $viaje){
    $contraseña = Str::random(6);
    $pasajeroExpress = new Pasajero();
    $pasajeroExpress->nombre = $request->nombre;
    $pasajeroExpress->apellido = $request->apellido;
    $pasajeroExpress->dni = $request->dni;
    $pasajeroExpress->email = $request->email;
    $pasajeroExpress->contraseña = $contraseña;
    $pasajeroExpress->save();

    $pasaje = new Pasaje();
    $pasaje->viaje_id = $viaje->id;
    $pasaje->pasajero_id = $pasajeroExpress->id;
    $pasaje->tarjeta_id = null;
    $pasaje->precio_viaje = $viaje->precio;
    $pasaje->precio = $viaje->precio;
    $pasaje->estado = $viaje->estado;
    $pasaje->estado_covid = 0;
    $pasaje->estado_pago = 0;
    $pasaje->reembolso_id = null;
    $pasaje->comprador_id = $pasajeroExpress->id;
    $pasaje->save();

    $usuario = new User();
    $usuario->name = $request->nombre;
    $usuario->email = $request->email;
    $usuario->tipo = 3;
    $usuario->password = Hash::make($contraseña);
    $usuario->save();

    $correo = new ComprobanteMailable2($pasajeroExpress);
    Mail::to($pasajeroExpress->email)->send($correo);
    Session::flash('messageSI','Registro express realizado exitosamente');
    return redirect()->route('combi19.misViajesChofer');
  }


  function cargarSintomas(Pasaje $pasaje){
    return view('chofer.cargarSintomas', compact('pasaje'));
  }

  function storeSintomas(Request $request){
    $pasaje = Pasaje::find($request->pasaje_id);
    if ($request->sintomas != null){
      $cantidadSintomas = count($request->sintomas);
      if ($request->fiebre > 37.5){
        $cantidadSintomas++;
      }
      if ($cantidadSintomas >= 2){
        $pasajero = Pasajero::find($pasaje->pasajero_id);
        $cantidad = $pasajero->cancelarPasajes();
        $pasaje->estado_covid = '2';
        $pasaje->estado = '6';
        $pasajero->fecha_suspension = new Carbon();
        $pasajero->save();
        if ($pasaje->estado_pago == 1){
          Session::flash('messageNO','El pasajero no está apto para viajar y su cuenta se suspenderá. Se le reembolsará el 100% del dinero por este pasaje. Pasajes suspendidos: ' . $cantidad);
        }
        else{
          Session::flash('messageNO','El pasajero no está apto para viajar y su cuenta se suspenderá. No se le reembolsará este pasaje debido a que el administrador no ha realizado el cobro. Pasajes suspendidos: ' . $cantidad);
        }
        $pasaje->save();
        return redirect()->route('combi19.listaPasajeros', $pasaje->viaje_id);
      }
    }
    $pasaje->estado_covid = 1;
    Session::flash('messageSI','El pasajero está apto para viajar');
    $pasaje->save();
    return redirect()->route('combi19.listaPasajeros', $pasaje->viaje_id);
  }

  public function modificarDatosDeCuentaChofer($emailChofer){
    $chofer = Chofer::where('email', '=', $emailChofer)->first();
    return view('chofer.modificarDatosDeCuentaChofer', compact('chofer'));
  }

  public function updateChofer2(UpdateChoferes $request, Chofer $chofer){
    $user = User::where('email', '=', $chofer->email)->get()->first();
    $chofer->update($request->all());
    $user->name = $request->nombre;
    $user->email = $request->email;
    $user->save();
    Session::flash('messageSI', '¡Datos modificados con éxito!');
    return redirect()->route('combi19.perfilDeChofer', $chofer->email);
  }

  public function updateChoferContraseña(UpdateChoferContraseña $request){
    $chofer = Chofer::find($request->id);
    $user = User::where('email', '=', $chofer->email)->get()->first();
    $chofer->contraseña = $request->contraseñaNueva;
    $chofer->save();
    $user->password = Hash::make($request['contraseñaNueva']);
    $user->save();
    Session::flash('messageSI', '¡Contraseña modificada con éxito!');
    return redirect()->route('combi19.perfilDeChofer', $chofer->email);
  }

  public function perfilDeChofer($emailChofer){
    $chofer = Chofer::where('email', '=', $emailChofer)->get()->first();
    return view('chofer.perfilDeChofer', compact('chofer'));
  }

  public function storeImprevisto(Request $request, Viaje $viaje){
    $imprevisto = new Imprevisto();
    $imprevisto->patente = $viaje->combi->patente;
    $imprevisto->chofer_id = $viaje->chofer_id;
    $imprevisto->viaje_id = $viaje->id;
    $imprevisto->fecha = new Carbon();
    $imprevisto->comentario = $request->comentario;
    $imprevisto->resuelto = false;
    $imprevisto->save();
    Session::flash('messageSI', '¡Imprevisto notificado con éxito!');
    return redirect()->route('combi19.misViajesChofer');
  }

  public function updateImprevisto(Request $request, Imprevisto $imprevisto){
    $imprevisto->comentario = $request->comentario;
    $imprevisto->save();
    Session::flash('messageSI', '¡Imprevisto actualizado con éxito!');
    return redirect()->route('combi19.misViajesChofer');
  }

  public function eliminarImprevisto(Imprevisto $imprevisto){
    $imprevisto->delete();
    Session::flash('messageSI', '¡Imprevisto eliminado con éxito!');
    return redirect()->route('combi19.misViajesChofer');
  }

}
