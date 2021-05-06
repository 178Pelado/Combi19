<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \Askedio\SoftCascade\Traits\SoftCascadeTrait;

class Ruta extends Model
{
    use HasFactory;
    use SoftDeletes;
    use SoftCascadeTrait;
    protected $dates = ['deleted_at'];
    protected $table = "rutas";

    protected $fillable = [
      'distancia_km',
        'origen_id',

        'descripcion',
        'destino_id',
    ];

    public function origen(){
      return $this->belongsTo('App\Models\Lugar', 'origen_id');
    }

    public function destino(){
      return $this->belongsTo('App\Models\Lugar', 'destino_id');
    }
}
