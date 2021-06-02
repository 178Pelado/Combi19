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

    protected $fillable = [
      'combi_id',
    ];

    public function combi(){
      return $this->belongsTo('App\Models\Combi', 'combi_id')->withTrashed();
    }

    public function insumos_viaje(){
      return $this->hasMany('App\Models\Insumos_viaje', 'id')->withTrashed();
    }

    public function ruta(){
      return $this->belongsTo('App\Models\Ruta', 'ruta_id')->withTrashed();
    }

    public function asientos_ocupados(){
      return $this->hasMany('App\Models\Pasaje', 'id');
    }

    public function comentarios(){
      return $this->hasMany('App\Models\Comentario', 'viaje_id');
    }

    public function pasaje(){
      return $this->hasMany('App\Models\Pasaje', 'viaje_id');
    }
}
