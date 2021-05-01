<?php

namespace App\Http\Controllers;

use App\Models\Viaje;
use App\Models\Insumos_viaje;
use Illuminate\Http\Request;

class ViajeController extends Controller
{

  public function altaViaje(){
    $combis = \App\Models\Combi::all();
    $rutas = \App\Models\Ruta::all();
    $insumos = \App\Models\Insumo::all();
    return view('administrador.altaViaje')->with('combis', $combis)->with('rutas', $rutas)->with('insumos', $insumos);
  }

  public function storeViaje(Request $request){
    $viaje = new Viaje();

    $viaje->combi_id = $request->combi_id;
    $viaje->ruta_id = $request->ruta_id;
    $viaje->precio = $request->precio;
    $viaje->fecha = $request->fecha;

    $viaje->save();

    $cant = count($request['insumo_id']);
    $i = 0;
    for ($i; $i<$cant; $i++){
      $insumo_viaje = new Insumos_viaje();
      $insumo_viaje->viaje_id = $viaje->id;
      $insumo_viaje->insumo_id = $request->insumo_id[$i];
      $insumo_viaje->save();
    }
    return view('administrador.registroChofer');
  }
}
