<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Insumos_pasaje extends Model
{
    use HasFactory;
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function viaje(){
        return $this->belongsTo('App\Models\Pasaje', 'pasaje_id');
    }
  
    public function insumo(){
        return $this->belongsTo('App\Models\Insumo', 'insumo_id')->withTrashed();
    }
    
    protected $fillable = [
        'pasaje_id',
        'insumos_id',
        'cantidad',
    ];
    protected $table = "insumos_pasaje";
}