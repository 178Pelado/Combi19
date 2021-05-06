<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Chofer;
use Illuminate\Database\Eloquent\SoftDeletes;
use \Askedio\SoftCascade\Traits\SoftCascadeTrait;

class Combi extends Model
{
  use HasFactory;
  use SoftDeletes;
  use SoftCascadeTrait;
  protected $dates = ['deleted_at'];
  protected $table = "combis";

  protected $fillable = [
    'patente',
      'modelo',
      'cantidad_asientos',
      'tipo',
      'chofer_id'
  ];

  public function chofer(){
    return $this->belongsTo('App\Models\Chofer', 'chofer_id')->withTrashed();
  }

  public function viajes(){
    return $this->hasMany('App\Models\Chofer', 'combi_id');
  }
}
