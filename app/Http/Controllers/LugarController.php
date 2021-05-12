<?php

namespace App\Http\Controllers;

use App\Models\Lugar;
use App\Models\Ruta;
use Session;
use Illuminate\Http\Request;
use App\Http\Requests\StoreLugares;
use App\Http\Requests\UpdateLugares;

class LugarController extends Controller
{

    public function altaLugar(){
    	return view('administrador.altaLugar');
    }

    public function storeLugar(StoreLugares $request){
    	$lugar = new Lugar();
    	$lugar->nombre = $request->nombre;
    	$lugar->save();
      return redirect()->route('combi19.listarLugares');
    }

    public function listarLugares(){
    	$lugares = Lugar::paginate();
      return view('administrador.listarLugares', compact('lugares'));
    }

    public function eliminarLugar(Lugar $lugar){
      $ruta = Ruta::where('origen_id', '=', $lugar->id)->orWhere('destino_id', '=', $lugar->id)->get()->first();
      if (!empty($ruta)){
        Session::flash('messageNO','El lugar se encuentra asignado a una ruta. Seleccione aquí para asignar un nuevo lugar.');
        return redirect()->route('combi19.listarLugares')->with('ruta', $ruta)->with('lugar', $lugar);
      }
      else {
        Session::flash('messageSI','El lugar se eliminó correctamente');
        $lugar->delete();
      }
      return redirect()->route('combi19.listarLugares');
    }

    public function modificarLugar(Lugar $lugar){
      return view('administrador.modificarLugar', compact('lugar'));
    }
    public function updateLugar(UpdateLugares $request, Lugar $lugar){
      $lugar->update($request->all());
      return redirect()->route('combi19.listarLugares');
    }
}
