<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Reembolso extends Model
{
    use HasFactory;
    protected $dates = ['deleted_at'];

    protected $table = "reembolsos";

    //define los únicos campos que un form puede modificar
    protected $fillable = [
      'tarjeta_id',
      'fecha_cancelacion',
      'monto',
      'estado',
    ];
}