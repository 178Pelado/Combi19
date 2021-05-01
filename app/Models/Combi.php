<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Combi extends Model
{
  use HasFactory;

  protected $table = "combis";

  public function chofer(){
    return $this->belongsTo('App\Models\Chofer', 'chofer_id');
  }
}
