<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;

class UpdatePasajeros extends FormRequest
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
    $before = $dt->subYears(18)->format("Y-m-d");
    return [
      'nombre' => 'required|alpha_spaces',
      'apellido' => 'required|alpha_spaces',
      'dni' => 'required|integer|gt:0',
      'email' => 'required|email|unique:pasajeros,email,'.$this->id,
      'contraseña' => 'required|min:6',
      'fecha_de_nacimiento' => 'required|before_or_equal:' . $before,
    ];
  }
}
