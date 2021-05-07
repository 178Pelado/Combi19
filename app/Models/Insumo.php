<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Insumo extends Model
{
    use HasFactory;

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
}
