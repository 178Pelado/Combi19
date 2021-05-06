<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Insumos_viaje extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $table = "Insumos_viaje";

    public function viaje(){
      return $this->hasMany('App\Models\Viaje', 'viaje_id');
    }

    public function insumo(){
      return $this->belongsTo('App\Models\Insumo', 'insumo_id');
    }
}
