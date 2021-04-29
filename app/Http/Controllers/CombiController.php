<?php

namespace App\Http\Controllers;

use App\Models\Combi;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCombis;

class CombiController extends Controller
{

    public function altaCombi(){
        $choferes = \DB::table('choferes')
                    ->select('choferes.*')
                    ->orderBy('apellido')
                    ->get();
    	return view('administrador.altaCombi')->with('choferes', $choferes);
    }

    public function storeCombi(StoreCombis $request){
    	$combi = new Combi();

    	$combi->patente = $request->patente;
    	$combi->modelo = $request->modelo;
    	$combi->cantidad_asientos = $request->cantidad_asientos;
    	$combi->tipo = $request->tipo;
    	$combi->chofer_id = $request->chofer_id;

    	$combi->save();
        return view('administrador.registroChofer'); //vuelve a listado de combis
    }
}
