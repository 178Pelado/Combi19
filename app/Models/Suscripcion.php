<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Suscripcion extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pasajero_id',
        'tarjeta_id',
    ];
    protected $table = "suscripciones";

    public function estoySuscripto(){
        if (($this->fecha_baja != null) && ($this->fecha_baja >= new Carbon())){
            return true;
        }
        else {
            if ($this->fecha_baja == null){
                return true;
            }
            return false;
        }
    }
}