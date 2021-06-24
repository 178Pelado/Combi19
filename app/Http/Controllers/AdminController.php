<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//Necesitamos agregar el middleware que creamos anteriormente.
use Illuminate\Http\Middleware\Admin;
use App\Models\Imprevisto;
use App\Models\Pasaje;
use App\Models\Viaje;
use Session;

class AdminController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('admin', ['only' => 'index']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('home');
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

    public function listarImprevistos()
    {
        $imprevistos = Imprevisto::paginate();
        return view('administrador.listarImprevistos', compact('imprevistos'));
    }

    public function resolverImprevisto($imprevisto_id)
    {
        $imprevisto = Imprevisto::where("id", "=", $imprevisto_id)->first();
        $imprevisto->resuelto = 1;
        $imprevisto->save();
        Session::flash('messageSI','Se ha marcado el imprevisto como resuelto');
        return redirect()->route('combi19.listarImprevistos');
    }

    public function reembolsar(Pasaje $pasaje){
        $reembolso = $pasaje->reembolso;
        $reembolso->estado = 1;
        $reembolso->save();
        Session::flash('messageSI','¡Reembolso realizado con éxito!');
        return redirect()->route('combi19.listarPasajerosReembolso');
    }

    public function cobrar(Pasaje $pasaje){
        $viaje = Viaje::find($pasaje->viaje_id);
        $viaje = $viaje->id;
        $pasaje->estado_pago = 1;
        $pasaje->save();
        Session::flash('messageSI','¡Cobro realizado con éxito!');
        return redirect()->route('combi19.listadoPasajeros', compact('viaje'));
    }
}
