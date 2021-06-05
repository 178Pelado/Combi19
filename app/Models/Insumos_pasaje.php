<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Insumos_pasaje extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function viaje(){
        return $this->belongsTo('App\Models\Pasaje', 'pasaje_id');
    }

    public function insumo(){
        return $this->belongsTo('App\Models\Insumo', 'insumo_id');
    }

    protected $fillable = [
        'pasaje_id',
        'insumos_id',
        'cantidad',
    ];
    protected $table = "insumos_pasaje";
}
