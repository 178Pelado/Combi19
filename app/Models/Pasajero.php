<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;
use Carbon\Carbon;

class Pasajero extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre',
        'apellido',
        'dni',
        'email',
        'contraseña',
        'fecha_suspension',
    ];
    protected $table = "pasajeros";

  public function tienePasaje($viaje_id, $pasajero_id){
    $pasaje = Pasaje::where('viaje_id', '=', $viaje_id)->where('pasajero_id', '=', $pasajero_id)->where('estado', '!=', '5')->first();
    return ($pasaje != null);
  }

    public function buscarPasajeComprado($viaje_id){
        $pasaje = Pasaje::where('viaje_id', '=', $viaje_id)->where('pasajero_id', '=', $this->id)->first();
        if ($pasaje->deleted_at != null){
          return false;
        }else{
          return true;
        }
    }

    public function noEstaSuspendido($viaje){
      if($this->fecha_suspension == null){
        return true;
      }
      $fecha1 = date_create($viaje->fecha);
      $fecha2 = date_create($this->fecha_suspension);
      $diff = $fecha2->diff($fecha1);
      $dias = $diff->days;
      return ($dias > 15);
    }

    public function cancelarPasajes(){
      $fecha = new Carbon();
      $fecha = $fecha->addDays(15)->format('Y-m-d H:i:s');
      $pasajes = Pasaje::where('pasajero_id', '=', $this->id)->whereIn('viaje_id', Viaje::select('id')->where('fecha', '<=', $fecha))->where('estado', '<', '3')->get();
      foreach($pasajes as $pasaje){
        if($pasaje->estado_pago == 1){
          $pasaje->reembolso_total();
        }
        $pasaje->estado = '6';
        $pasaje->estado_covid = '2';
        $pasaje->save();
      }
      return count($pasajes);
    }
}
