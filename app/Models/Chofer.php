<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \Askedio\SoftCascade\Traits\SoftCascadeTrait;

class Chofer extends Model
{
    use HasFactory;
    use SoftDeletes;
  	use SoftCascadeTrait;

  	protected $dates = ['deleted_at'];
  	protected $table = "choferes";
}
