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
        'precio'
    ];
    protected $table = "pasajes";

    public function viaje(){
        return Viaje::where('id','=',$this->id_viaje)->get()->first();
    }

    public function comentarios(){
        return $this->hasMany('App\Models\Comentario', 'pasaje_id');
    }
}
