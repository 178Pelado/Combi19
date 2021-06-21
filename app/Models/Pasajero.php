<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

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
      $pasajero = Pasajero::where('email', '=', Auth::user()->email)->first();
      $fecha1 = date_create($viaje->fecha);
      $fecha2 = date_create($pasajero->fecha_suspension);
      $diff = $fecha2->diff($fecha1);
      $dias = $diff->days;
      return ($dias > 15);
    }
}
