<?php

namespace App\Http\Controllers;

use App\Models\Viaje;
use App\Models\Insumos_viaje;
use Illuminate\Http\Request;
use App\Http\Requests\StoreViajes;
use App\Http\Requests\UpdateViajes;

class ViajeController extends Controller
{

  public function altaViaje(){
    $combis = \App\Models\Combi::all();
    $rutas = \App\Models\Ruta::all();
    $insumos = \App\Models\Insumo::where('cantidad', '>', 0)->where('deleted_at', '=', null)->get();
    return view('administrador.altaViaje')->with('combis', $combis)->with('rutas', $rutas)->with('insumos', $insumos);
  }

  public function storeViaje(StoreViajes $request){
    $viaje = new Viaje();

    $viaje->combi_id = $request->combi_id;
    $viaje->ruta_id = $request->ruta_id;
    $viaje->precio = $request->precio;
    $viaje->fecha = $request->fecha;

    $viaje->save();

    if(!empty($request['insumo_id'])){
      $cant = count($request['insumo_id']);
      $i = 0;
      for ($i; $i<$cant; $i++){
        $insumo_viaje = new Insumos_viaje();
        $insumo_viaje->viaje_id = $viaje->id;
        $insumo_viaje->insumo_id = $request->insumo_id[$i];
        $insumo_viaje->save();
      }
    }
    $viajes = Viaje::paginate();
    return view('administrador.listarViajes', compact('viajes'));
  }

  public function listarViajes(){
      $viajes = Viaje::paginate();
    return view('administrador.listarViajes', compact('viajes'));
  }

  public function modificarViaje(Viaje $viaje){
    if ($viaje->combi->tipo == 'Cómoda') {
      $combis = \App\Models\Combi::where('cantidad_asientos', '>=', $viaje->combi->cantidad_asientos)->get();
    }else {
      $combis = \App\Models\Combi::where('cantidad_asientos', '>=', $viaje->combi->cantidad_asientos)->where('tipo', '=', 'Super Cómoda')->get();
    }
    $rutas = \App\Models\Ruta::all();
    $insumos_viaje = \App\Models\Insumos_viaje::where('viaje_id', '=', $viaje->id)->get();
    return view('administrador.modificarViaje', compact('viaje'))->with('combis', $combis)->with('rutas', $rutas)->with('insumos_viaje', $insumos_viaje);
  }
  
  public function updateViaje(UpdateViajes $request, Viaje $viaje){
    $viaje->update($request->all());
    return redirect()->route('combi19.listarViajes');
  }
}
