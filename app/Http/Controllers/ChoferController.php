<?php

namespace App\Http\Controllers;

use App\Models\Chofer;
use App\Models\Combi;
use Session;
use Illuminate\Http\Request;
use App\Http\Requests\StoreChoferes;

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
        return redirect()->route('combi19.listarChoferes'); //vuelve a listado de choferes
    }

    public function listarChoferes(){
        $choferes = Chofer::paginate();
      return view('administrador.listarChoferes', compact('choferes'));
    }

    public function eliminarChofer(Chofer $chofer){
        $combi = Combi::where('chofer_id', '=', $chofer->id)->get()->first();
        if (!empty($combi)){
          Session::flash('message','El chofer se encuentra asignado a una combi');
          return redirect()->route('combi19.listarChoferes');
        }
        $chofer->delete();
        return redirect()->route('combi19.listarChoferes');
    }
}
