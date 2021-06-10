<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Viaje;
use App\Models\Combi;
use App\Models\Ruta;
use App\Models\Lugar;
use Illuminate\Support\Str;
//Necesitamos agregar el middleware que creamos anteriormente.
use Illuminate\Http\Middleware\Visitante;

class VisitanteController extends Controller
{
  public function __construct()
  {
      $this->middleware('guest')->except('logout');
  }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('visitante');
    }

    public function buscarViajeVisitante(){
      $ciudadO = null;
      $ciudadD = null;
      $precio = null;
      $tipo_de_combi = null;
      $fecha = null;
      $viajes = Viaje::where('estado', '=', 1)->get();
      return view('buscarViajeVisitante', compact('viajes', 'ciudadO', 'ciudadD', 'precio', 'tipo_de_combi', 'fecha'));
    }

    public function buscarViajeVisitanteConDatos(request $request){
      $ciudadO = $request->ciudadO;
      $ciudadD = $request->ciudadD;
      $tipo_de_combi = $request->tipo_de_combi;
      $fecha = $request->fecha;
      $precio = $request->precio;
      $viajes2 = array();
      if($tipo_de_combi == null){
        $viajes1 = Viaje::where('estado', '=', 1)
                ->whereIn('ruta_id', Ruta::select('id')->whereIn('origen_id', Lugar::select('id')->where('nombre', 'like', '%' . $ciudadO . '%')))
                ->whereIn('ruta_id', Ruta::select('id')->whereIn('destino_id', Lugar::select('id')->where('nombre', 'like', '%' . $ciudadD . '%')))
                ->get();
      } else {
        $viajes1 = Viaje::where('estado', '=', 1)
                ->whereIn('combi_id', Combi::select('id')->where('tipo', '=', $tipo_de_combi))
                ->whereIn('ruta_id', Ruta::select('id')->whereIn('origen_id', Lugar::select('id')->where('nombre', 'like', '%' . $ciudadO . '%')))
                ->whereIn('ruta_id', Ruta::select('id')->whereIn('destino_id', Lugar::select('id')->where('nombre', 'like', '%' . $ciudadD . '%')))
                ->get();
      }
      $viajes = $viajes1;
      if($precio != null){
        $viajes1 = $viajes1->where('precio', '<=', $precio);
        $viajes1 = collect([$viajes1], []);
        $viajes1 = $viajes1->collapse();
        $viajes = $viajes1;
      }
      if($fecha != null){
        for($i = 0; $i < count($viajes1); $i++){
          $soloFecha = $viajes1[$i]->fecha;
          $soloFecha = Str::limit($soloFecha, 10, '');
          if($soloFecha == $fecha){
            array_push($viajes2, $viajes1[$i]);
          }
        }
        $viajes = $viajes2;
      }
      return view('buscarViajeVisitante', compact('viajes', 'ciudadO', 'ciudadD', 'precio', 'tipo_de_combi', 'fecha'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
