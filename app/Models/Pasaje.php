<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasaje extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'viaje_id',
        'pasajero_id',
        'estado',
        'precio_viaje',
        'precio',
        'deleted_at',
    ];
    protected $table = "pasajes";

    // public function viaje(){
    //     return Viaje::where('id','=',$this->viaje_id)->get()->first();
    // }

    public function viaje(){
        return $this->belongsTo('App\Models\Viaje', 'viaje_id')->withTrashed();
    }

    public function comentarios(){
        return $this->hasMany('App\Models\Comentario', 'pasaje_id');
    }

    public function insumos_asociados(){
        $insumos_pasaje = Insumos_pasaje::where('pasaje_id', '=', $this->id)->get();
        $insumos = collect();
        foreach($insumos_pasaje as $insumo_pasaje){
            $insumos->push(Insumo::find($insumo_pasaje->insumo_id));
        }
        return $insumos;
    }

    public function insumos_pasaje(){
        $insumos_pasaje = Insumos_pasaje::where('pasaje_id', '=', $this->id)->get();
        return $insumos_pasaje;
    }

    public function buscarPasaje($pasaje_id){
        $pasaje = Pasaje::where('id', '=', $pasaje_id);
        return $pasaje;
    }

    public function nombrePasajero(){
        $pasajero = Pasajero::find($this->pasajero_id);
        $nom_ape = $pasajero->nombre . ' ' . $pasajero->apellido;
        return $nom_ape;
    }
}
