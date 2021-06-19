<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class Imprevisto extends Model
{
    use HasFactory;
    use SoftCascadeTrait;
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $softCascade = ['insumo_viaje2'];

    protected $table = "imprevistos";

    //define los únicos campos que un form puede modificar
    protected $fillable = [
      'patente',
      'chofer_id',
      'viaje_id',
      'fecha',
      'comentario',
    ];
}