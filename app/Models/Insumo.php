<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class Insumo extends Model
{
    use HasFactory;
    use SoftCascadeTrait;
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $softCascade = ['insumo_viaje2'];

    protected $table = "insumos";

    //define los únicos campos que un form puede modificar
    protected $fillable = [
      'nombre',
      'descripcion',
      'cantidad',
      'precio',
    ];

    public function insumo_viaje(){
      return $this->belongsTo('App\Models\Insumos_viaje', 'insumo_id');
    }

    public function insumo_viaje2(){
      return $this->hasMany('App\Models\Insumos_viaje');
    }
}
