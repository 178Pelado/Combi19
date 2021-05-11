<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \Askedio\SoftCascade\Traits\SoftCascadeTrait;

class Lugar extends Model
{
    use HasFactory;
    use SoftDeletes;
    use SoftCascadeTrait;
    protected $dates = ['deleted_at'];
    protected $table = "lugares";

    protected $fillable = [
        'nombre'
    ];

    // public function rutas(){
    //   return $this->hasMany('App\Models\Ruta', 'origen_id');
    // }

    public function rutas2(){
      return $this->hasMany('App\Models\Ruta', 'destino_id');
    }
}
