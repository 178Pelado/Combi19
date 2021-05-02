<?php

namespace App\Http\Controllers;

use App\Models\Ruta;
use Illuminate\Http\Request;
use App\Http\Requests\StoreRutas;

class RutaController extends Controller
{

  public function altaRuta(){
    $lugares = \DB::table('lugares')
    ->select('lugares.*')
    ->orderBy('nombre')
    ->get();
    return view('administrador.altaRuta')->with('lugares', $lugares);
  }

  public function storeRuta(StoreRutas $request){
    $ruta = new Ruta();

    $ruta->origen_id = $request->origen_id;
    $ruta->destino_id = $request->destino_id;
    $ruta->descripcion = $request->descripcion;
    $ruta->distancia_km = $request->distancia;

    $ruta->save();
    return view('administrador.registroChofer');
  }

  public function listarRutas(){
    $rutas = Ruta::paginate();
    return view('administrador.listarRutas', compact('rutas'));
  }

  public function eliminarRuta(Ruta $ruta){
    $ruta->delete();
    return redirect()->route('combi19.listarRutas');
  }
}
