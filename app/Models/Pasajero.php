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
        'fecha_de_nacimiento',
    ];
    protected $table = "pasajeros";

    public function tienePasaje($viaje_id, $pasajero_id){
        $pasaje = Pasaje::where('viaje_id', '=', $viaje_id)->where('pasajero_id', '=', $pasajero_id)->first();
        return ($pasaje != null);
    }
}
