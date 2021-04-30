<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreChoferes extends FormRequest
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
      'nombre' => 'required|alpha_spaces',
      'apellido' => 'required|alpha_spaces',
      'telefono' => 'required|integer|gt:0',
      'email' => 'required|unique:choferes|email',
      'clave' => 'required|min:6',
    ];
  }
}
