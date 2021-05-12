<?php

namespace App\Http\Controllers;

use App\Models\Combi;
use App\Models\Chofer;
use App\Models\Viaje;
use Session;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCombis;
use App\Http\Requests\UpdateCombis;
use DateTime;
use Illuminate\Http\Middleware\Admin;
use Illuminate\Support\Facades\DB;

class CombiController extends Controller
{
  public function altaCombi(){
    $choferes = Chofer::whereNotIn('id', Combi::select('chofer_id'))->get();
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
    return redirect()->route('combi19.listarCombis'); //vuelve a listado de combis
  }

  public function listarCombis(){
    $combis = Combi::paginate();
    return view('administrador.listarCombis', compact('combis'));
  }

  public function eliminarCombi(Combi $combi){
    $viaje = Viaje::where('combi_id', '=', $combi->id)->get();
    for ($i=0;$i<sizeOf($viaje);$i++){
      date_default_timezone_set('America/Argentina/Buenos_Aires');
      $dt = new \DateTime();
      $dt= $dt->format('Y-m-d H:i:s');
      if ($viaje[$i]->fecha > $dt) {
        Session::flash('messageNO', 'La combi está asignada a un futuro viaje. Seleccione aquí para asignar una nueva combi.');
        return redirect()->route('combi19.listarCombis')->with('viaje', $viaje[$i]);
      }
    }
    Session::flash('messageSI','La combi se eliminó correctamente');
    $combi->delete();
    return redirect()->route('combi19.listarCombis');
  }

  public function modificarCombi(Combi $combi){
    $choferes = Chofer::whereNotIn('id', Combi::select('chofer_id'))->orWhere('id', '=', $combi->chofer_id)->get();
    return view('administrador.modificarCombi', compact('combi'))->with('choferes', $choferes);
  }

  public function updateCombi(UpdateCombis $request, Combi $combi){
    $combi->update($request->all());
    return redirect()->route('combi19.listarCombis');
  }
}
