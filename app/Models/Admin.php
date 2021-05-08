<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

  	protected $fillable = [
        'nombre_de_usuario',
        'contraseña'
    ];

  	protected $dates = ['deleted_at'];
  	protected $table = "admins";
}