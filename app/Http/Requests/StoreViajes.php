<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreViajes extends FormRequest
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
      'combi_id' => 'required',
      'ruta_id' => 'required',
      'insumo_id[]' => 'required',
      'precio' => 'required|numeric|gt:0',
      'fecha' => 'required',
    ];
  }
}
