<?php

namespace App\Http\Controllers;

use App\Models\Insumo;
use Illuminate\Http\Request;
use App\Http\Requests\StoreInsumos;

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
      return view('administrador.altaInsumo'); //vuelve a listado de insumos
    }
}
