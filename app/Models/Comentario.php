<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
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
        'texto',
    ];
    protected $table = "comentarios";

    public function pasajero(){
      return $this->belongsTo('App\Models\Pasajero', 'pasajero_id');
    }
}
