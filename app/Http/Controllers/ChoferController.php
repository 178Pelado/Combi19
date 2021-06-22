<?php

namespace App\Http\Controllers;

use App\Models\Chofer;
use App\Models\Combi;
use App\Models\Viaje;
use App\Models\Pasaje;
use App\Models\Pasajero;
use Session;
use Auth;
use Illuminate\Http\Request;
use App\Http\Requests\StoreChoferes;
use App\Http\Requests\UpdateChoferes;
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
        $viaje->cambiar_estado_pasajes('3');
        $viaje->save();
        Session::flash('messageSI','El viaje se finalizó correctamente');
        return redirect()->route('combi19.misViajesChofer');
    }

    public function listaPasajeros($viaje_id){
        $pasajes = Pasaje::where('viaje_id', '=', $viaje_id)->get();
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
      $pasaje->precio_viaje = $viaje->precio;
      $pasaje->precio = $viaje->precio;
      $pasaje->estado = $viaje->estado;
      $pasaje->estado_covid = 0;
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
      Session::flash('messageSI','El pasajero express se cargó correctamente');
      return redirect()->route('combi19.misViajesChofer');
    }

    function cargarSintomas(Pasaje $pasaje){
      return view('chofer.cargarSintomas', compact('pasaje'));
    }

    function storeSintomas(Request $request){
      $cantidadSintomas = count($request->sintomas);
      if ($request->fiebre > 37.5){
        $cantidadSintomas++;
      }
      $pasaje = Pasaje::find($request->pasaje_id);
      if ($cantidadSintomas > 2){
        $pasajero = Pasajero::find($pasaje->pasajero_id);
        $pasaje->estado_covid = 2;
        $pasajero->fecha_suspension = new Carbon();
        $pasajero->save();
        Session::flash('messageNO','El pasajero no está apto para viajar y su cuenta se suspenderá');
      }else{
        $pasaje->estado_covid = 1;
        Session::flash('messageSI','El pasajero está apto para viajar');
      }
      $pasaje->save();
      return redirect()->route('combi19.listaPasajeros', $pasaje->viaje_id);
    }
}
