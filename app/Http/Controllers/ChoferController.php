<?php

namespace App\Http\Controllers;

use App\Models\Chofer;
use App\Models\Combi;
use Session;
use Illuminate\Http\Request;
use App\Http\Requests\StoreChoferes;
use App\Http\Requests\UpdateChoferes;

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
            Session::flash('messageNO','El chofer se encuentra asignado a una combi. Seleccione aquí para asignar un nuevo chofer.');
            return redirect()->route('combi19.listarChoferes')->with('combi', $combi);
        }
        else {
            Session::flash('messageSI','El chofer se eliminó correctamente');
            $chofer->delete();
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
}
