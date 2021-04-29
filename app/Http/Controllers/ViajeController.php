<?php

namespace App\Http\Controllers;

use App\Models\Viaje;
use App\Models\Insumos_viaje;
use Illuminate\Http\Request;

class ViajeController extends Controller
{

  public function altaViaje(){
    $combis = \DB::table('combis')
    ->select('combis.*')
    ->orderBy('patente')
    ->get();
    $rutas = \DB::table('rutas')
    ->select('rutas.*')
    ->get();
    $insumos = \DB::table('insumos')
    ->select('insumos.*')
    ->get();
    return view('administrador.altaViaje')->with('combis', $combis)->with('rutas', $rutas)->with('insumos', $insumos);
  }

  public function storeViaje(Request $request){
    $viaje = new Viaje();

    $viaje->combi_id = $request->combi_id;
    $viaje->ruta_id = $request->ruta_id;
    $viaje->precio = $request->precio;
    $viaje->fecha = $request->fecha;

    $viaje->save();
    $insumo_viaje = new Insumos_viaje();

    $insumo_viaje->viaje_id = $viaje->id;
    $insumo_viaje->insumo_id = $request->insumo_id;

    $insumo_viaje->save();
    return view('administrador.registroChofer');
  }
}
