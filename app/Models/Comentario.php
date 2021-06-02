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

    protected $table = "comentarios";

    protected $fillable = [
        'texto',
    ];
    
    public function pasajero(){
      return $this->belongsTo('App\Models\Pasajero', 'pasajero_id');
    }

    public function viaje(){
      return $this->belongsTo('App\Models\Viaje', 'viaje_id');
    }

    public function pasaje(){
      return $this->belongsTo('App\Models\Pasaje', 'pasaje_id');
    }
}
