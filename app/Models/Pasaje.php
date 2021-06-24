<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

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
        'estado_covid',
        'precio_viaje',
        'precio',
        'deleted_at',
    ];
    protected $table = "pasajes";

    // public function viaje(){
    //     return Viaje::where('id','=',$this->viaje_id)->get()->first();
    // }

    public function estados(){
        return $this->belongsTo('App\Models\Estado', 'estado');
    }

    public function pasajero(){
        return $this->belongsTo('App\Models\Pasajero', 'pasajero_id');
    }

    public function viaje(){
        return $this->belongsTo('App\Models\Viaje', 'viaje_id')->withTrashed();
    }

    public function tarjeta(){
        return $this->belongsTo('App\Models\Tarjeta', 'tarjeta_id');
    }

    public function reembolso(){
        return $this->belongsTo('App\Models\Reembolso', 'reembolso_id');
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

    public function estado_covid(){
        switch ($this->estado_covid) {
            case 0:
                return "Sin evaluar";
            case 1:
                return "Negativo";
            case 2:
                return "Positivo";
        }
    }

    public function reembolso_total(){
        $reembolso = new Reembolso();
        $reembolso->tarjeta_id = $this->tarjeta_id;
        $reembolso->fecha_cancelacion = new Carbon();
        $reembolso->estado = 0;
        $reembolso->monto = $this->precio;
        $reembolso->save();
        $this->reembolso_id = $reembolso->id;
    }

    public function reembolso_mitad(){
        $reembolso = new Reembolso();
        $reembolso->tarjeta_id = $this->tarjeta_id;
        $reembolso->fecha_cancelacion = new Carbon();
        $reembolso->estado = 0;
        $reembolso->monto = $this->precio / 2;
        $reembolso->save();
        $this->reembolso_id = $reembolso->id;
    }
}
