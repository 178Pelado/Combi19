<?php

namespace App\Http\Controllers;

use App\Models\Insumo;
use App\Models\Viaje;
use App\Models\Insumos_viaje;
use Session;
use Illuminate\Http\Request;
use App\Http\Requests\StoreInsumos;
use App\Http\Requests\UpdateInsumos;

class InsumoController extends Controller
{

    public function altaInsumo(){
    	return view('administrador.altaInsumo');
    }

    public function storeInsumo(StoreInsumos $request){
    	$insumo = new Insumo();

    	$insumo->nombre = $request->nombre;
    	$insumo->descripcion = $request->descripcion;
    	$insumo->cantidad = $request->cantidad;
    	$insumo->precio = $request->precio;

    	$insumo->save();
      return redirect()->route('combi19.listarInsumosTotal'); //vuelve a listado de insumos
    }

    public function listarInsumosTotal(){
      $insumos = Insumo::paginate();
      return view('administrador.listarInsumosTotal', compact('insumos'));
    }

    public function eliminarInsumo(Insumo $insumo){
      $viaje = Insumos_viaje::where('insumo_id', '=', $insumo->id)->get();
      for ($i=0;$i<sizeOf($viaje);$i++){
        date_default_timezone_set('America/Argentina/Buenos_Aires');
        $dt = new \DateTime();
        $dt= $dt->format('Y-m-d H:i:s');
        $elviaje = Viaje::where('id', '=', $viaje[$i]->viaje_id)->get()->first();
        if ($elviaje !== null && $elviaje->fecha > $dt) {
          Session::flash('messageNO', 'El insumo está asignado a un futuro viaje. Vuelva a intentarlo al finalizar el viaje.');
          return redirect()->route('combi19.listarInsumosTotal');
        }
      }
      $insumo->delete();
      Session::flash('messageSI', 'El insumo se eliminó correctamente');
      return redirect()->route('combi19.listarInsumosTotal');
    }

    public function modificarInsumo(Insumo $insumo){
      return view('administrador.modificarInsumo', compact('insumo'));
  }

  public function updateInsumo(UpdateInsumos $request, Insumo $insumo){
    $insumo->update($request->all());
    return redirect()->route('combi19.listarInsumosTotal');
  }
}
