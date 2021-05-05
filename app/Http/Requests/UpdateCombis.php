<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCombis extends FormRequest
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
    return [
      'patente' => 'required|alpha_num_spaces|unique:combis',
      'modelo' => 'required|alpha_num_spaces',
      'cantidad_asientos' => 'required|integer|gt:0',
      'tipo' => 'required',
      'chofer_id' => 'required',
    ];
  }
}
