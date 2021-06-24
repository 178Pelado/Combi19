<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Imprevisto extends Model
{
    use HasFactory;
    protected $dates = ['deleted_at'];

    protected $table = "imprevistos";

    //define los únicos campos que un form puede modificar
    protected $fillable = [
      'patente',
      'chofer_id',
      'viaje_id',
      'fecha',
      'comentario',
    ];

    public function viaje(){
      return $this->belongsTo('App\Models\Viaje', 'viaje_id');
    }

    public function chofer(){
      return $this->belongsTo('App\Models\Chofer', 'chofer_id');
    }

    public function comentario(){
      $descripcion = $this->comentario;
      $descripcion = Str::limit($descripcion, 30, '');
      return $descripcion;
    }
}
