<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \Askedio\SoftCascade\Traits\SoftCascadeTrait;

class Viaje extends Model
{
    use HasFactory;
    use SoftDeletes;
    use SoftCascadeTrait;
    protected $dates = ['deleted_at'];
    protected $softCascade = ['insumos_viaje'];

    protected $table = "viajes";

    public function combi(){
      return $this->belongsTo('App\Models\Combi', 'id');
    }

    public function insumos_viaje(){
      return $this->hasMany('App\Models\Insumos_viaje');
    }
}
