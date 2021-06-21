<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Auth;

class Viaje extends Model
{
    use HasFactory;
    use SoftDeletes;
    use SoftCascadeTrait;
    protected $dates = ['deleted_at'];
    protected $softCascade = ['insumos_viaje'];

    protected $table = "viajes";

    protected $fillable = [
      'combi_id',
    ];

    public function combi(){
      return $this->belongsTo('App\Models\Combi', 'combi_id')->withTrashed();
    }

    public function insumos_viaje(){
      return $this->hasMany('App\Models\Insumos_viaje', 'id')->withTrashed();
    }

    public function ruta(){
      return $this->belongsTo('App\Models\Ruta', 'ruta_id')->withTrashed();
    }

    public function cantidad_asientos_totales(){
      return $this->combi->cantidad_asientos;
    }

    public function cantidad_asientos_ocupados(){
      $pasajes = Pasaje::where('viaje_id', '=', $this->id)->where('estado', '!=', '5')->get();
      return count($pasajes);
    }

    public function asientos_ocupados(){
      $pasajes = Pasaje::where('viaje_id', '=', $this->id)->where('estado', '!=', '5')->get();
      return ($pasajes);
    }

    public function comentarios(){
      return $this->hasMany('App\Models\Comentario', 'viaje_id');
    }

    public function imprevisto(){
      return $this->belongsTo('App\Models\Imprevisto', 'viaje_id');
    }

    public function pasaje(){
      return $this->hasMany('App\Models\Pasaje', 'viaje_id');
    }

    public function cambiar_estado_pasajes($estado){
      $pasajes = Pasaje::where('viaje_id', '=', $this->id)->where('estado', '=', '1')->update(['estado'=>$estado]);
    }

    public function fecha_sin_segundos(){
      $fecha = $this->fecha;
      $fecha = Str::limit($fecha, 16, '');
      return $fecha;
    }

    public function iniciable(){
      $fecha_ok = $this->fecha < (new Carbon());
      $estado_ok = $this->estado == 1;
      return ($fecha_ok && $estado_ok);
    }

    public function finalizable(){
      $estado_ok = $this->estado == 2;
      return ($estado_ok);
    }

    public function no_imprevistos(){
      return ($this->imprevisto == null);
    }

    public function siguiente_chofer(){
      $chofer = Chofer::where('email', '=', Auth::user()->email)->first();
      $viaje = Viaje::where('chofer_id', '=', $chofer->id)->where('estado', '=', '1')->get();
      $viaje = $viaje->sortByDesc('fecha')->last();
      return $viaje;
    }

    public function capacidad(){
      $totales = $this->cantidad_asientos_totales();
      $ocupados = $this->cantidad_asientos_ocupados();
      $string = ($totales - $ocupados) . '/' . $totales;
      return $string;
    }

    public function estado(){
      switch ($this->estado) {
        case 1:
            return "Pendiente";
        case 2:
            return "En curso";
        case 3:
            return "Finalizado";
        case 4:
            return "Suspendido";
    }
  }
}