<?php

namespace App\Http\Controllers;

use App\Models\Ruta;
use Illuminate\Http\Request;

class RutaController extends Controller
{

    public function altaRuta(){
        $lugares = \DB::table('lugares')
                    ->select('lugares.*')
                    ->orderBy('nombre')
                    ->get();
    	return view('administrador.altaRuta')->with('lugares', $lugares);
    }

    public function storeRuta(Request $request){
    	$ruta = new Ruta();

    	$ruta->origen_id = $request->origen_id;
    	$ruta->destino_id = $request->destino_id;
    	$ruta->descripcion = $request->descripcion;
      $ruta->distancia_km = $request->distancia;

    	$ruta->save();
        return view('administrador.registroChofer');
    }
}
