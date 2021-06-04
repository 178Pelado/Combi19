<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;
use Session;
use Auth;
use App\Models\Pasajero;
use App\Models\Insumo;
use App\Models\Viaje;
use App\Models\Pasaje;
use App\Models\Insumos_pasaje;
use App\Http\Requests\StoreInsumoPasaje;
use Carbon\Carbon;


class CartController extends Controller
{
    
    public function add(StoreInsumoPasaje $request){  
        $insumo = Insumo::find($request->insumo_id);
        $nom_desc = $insumo->nombre . ' ' . $insumo->descripcion;
        Cart::add(
            $insumo->id, 
            $nom_desc, 
            $insumo->precio, 
            $request->cantidad,           
        );
        $insumo->cantidad = $insumo->cantidad - $request->cantidad;
        $insumo->save();

        $pasaje = Pasaje::where('viaje_id', '=', $request->viaje_id)->where('pasajero_id', '=', $request->pasajero_id)->first();
        $insumo_pasaje = new Insumos_pasaje();
        $insumo_pasaje->pasaje_id = $pasaje->id;
        $insumo_pasaje->insumo_id = $insumo->id;
        $insumo_pasaje->cantidad = $request->cantidad;
        $insumo_pasaje->precio_al_reservar = $insumo->precio;
        $insumo_pasaje->deleted_at = new Carbon();
        $insumo_pasaje->save();

        Session::flash('insumoCargado', "$nom_desc ¡Se ha agregado con éxito al carrito!");
        return back();
    }

    public function addViaje($viaje_id){  
        $pasajero = Pasajero::where('email', '=', Auth::user()->email)->first();
        $viaje = Viaje::find($viaje_id);
        $nombre = $viaje->ruta->origen->nombre . ' - ' . $viaje->ruta->destino->nombre;
        Cart::add(
            $viaje->id + 100, //el 100 es para que no se choquen insumos con viajes
            $nombre, 
            $viaje->precio,
            1,
        );
        $ciudadO = null;
        $ciudadD = null;
        $precio = null;
        $tipo_de_combi = null;
        $fecha = null;
        $viajes = Viaje::where('estado', '=', 1)->get();
        $pasaje = new Pasaje();
        $pasaje->viaje_id = $viaje_id; 
        $pasaje->pasajero_id = $pasajero->id;
        $pasaje->precio_viaje = $viaje->precio;
        $pasaje->precio = $viaje->precio;
        $pasaje->estado = $viaje->estado;
        $pasaje->deleted_at = new Carbon();
        $pasaje->save();
        Session::flash('viajeCargado', "$nombre ¡Se ha agregado con éxito al carrito!");
        return view('buscarViaje', compact('viajes', 'ciudadO', 'ciudadD', 'precio', 'tipo_de_combi', 'fecha', 'viaje', 'pasajero'));
    } 

    public function cart(){
        return view('pasajero.checkout');
    }

    public function removeitem(Request $request) {
        //$producto = Producto::where('id', $request->id)->firstOrFail();
        Cart::remove([
        'id' => $request->id,
        ]);
        return back()->with('success',"Producto eliminado con éxito de su carrito.");
    }

    public function clear(){
        Cart::clear();
        return back()->with('success',"The shopping cart has successfully beed added to the shopping cart!");
    }

}