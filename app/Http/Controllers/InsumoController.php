<?php

namespace App\Http\Controllers;

use App\Models\Insumo;
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
      $insumo->delete();
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
