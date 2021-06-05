<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;
use Carbon\Carbon;

class ValidateTarjeta extends FormRequest
{
  /**
  * Determine if the user is authorized to make this request.
  *
  * @return bool
  */
  public function authorize()
  {
    return true; //esto es para validar sesiones, va a servir
  }

  /**
  * Get the validation rules that apply to the request.
  *
  * @return array
  */
  public function rules()
  {
    $dt = new Carbon();
    $after = $dt->format("Y-m-d");
    return [
      'numero' => 'required|numeric|digits: 16',
      'codigo' => 'required|numeric|digits: 3',
      'fecha_vencimiento' => 'required|after:' . $after,
    ];
  }
}
