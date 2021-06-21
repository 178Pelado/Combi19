<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
