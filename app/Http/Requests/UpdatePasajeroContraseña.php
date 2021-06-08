<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;

class UpdatePasajeroContraseña extends FormRequest
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
      'contraseña' => 'required|es_contraseña_actual:' . $this->contraseña . ',' . $this->id,
      'contraseñaNueva' => 'required|min:6|different:contraseña|same:contraseñaNuevaConfirmacion',
      'contraseñaNuevaConfirmacion' => 'required',
    ];
  }

  public function attributes()
  {
    return [
      'contraseñaNuevaConfirmacion' => 'confirmación de contraseña',
    ];
  }

  public function messages(){
    return[
      'contraseñaNueva.different' => 'La contraseña nueva debe ser diferente a la contraseña actual',
    ];
  }
}
