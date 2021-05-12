<?php

namespace App\Http\Controllers;

use App\Models\Ruta;
use App\Models\Lugar;
use App\Models\Viaje;
use Session;
use Illuminate\Http\Request;
use App\Http\Requests\StoreRutas;
use App\Http\Requests\UpdateRutas;

class RutaController extends Controller
{

  public function altaRuta(){
    $lugares = \App\Models\Lugar::all();
    return view('administrador.altaRuta')->with('lugares', $lugares);
  }

  public function storeRuta(StoreRutas $request){
    $ruta = new Ruta();

    $ruta->origen_id = $request->origen_id;
    $ruta->destino_id = $request->destino_id;
    $ruta->descripcion = $request->descripcion;
    $ruta->distancia_km = $request->distancia;

    $ruta->save();
    return redirect()->route('combi19.listarRutas');
  }

  public function listarRutas(){
    $rutas = Ruta::paginate();
    return view('administrador.listarRutas', compact('rutas'));
  }

  public function eliminarRuta(Ruta $ruta){
    $viaje = Viaje::where('ruta_id', '=', $ruta->id)->get();
    for ($i=0;$i<sizeOf($viaje);$i++){
      date_default_timezone_set('America/Argentina/Buenos_Aires');
      $dt = new \DateTime();
      $dt= $dt->format('Y-m-d H:i:s');
      if ($viaje[$i]->fecha > $dt) {
        Session::flash('messageNO', 'La ruta está asignada a un futuro viaje. Vuelva a intentarlo al finalizar el viaje.');
        return redirect()->route('combi19.listarRutas');
      }
    }
    $ruta->delete();
    return redirect()->route('combi19.listarRutas');
  }

  public function modificarRuta(Ruta $ruta){
    $lugares = \App\Models\Lugar::all();
    return view('administrador.modificarRuta', compact('ruta'))->with('lugares', $lugares);
  }

  public function modificarRutaConLugar(Ruta $ruta, Lugar $lugar){
    $lugares = Lugar::where('nombre', '<>', $lugar->nombre)->get();
    return view('administrador.modificarRuta', compact('ruta'))->with('lugares', $lugares);
  }

  public function updateRuta(UpdateRutas $request, Ruta $ruta){
    $ruta->update($request->all());
    return redirect()->route('combi19.listarRutas');
  }
}
