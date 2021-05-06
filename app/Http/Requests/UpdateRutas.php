<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRutas extends FormRequest
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
      'origen_id' => 'required',
      'destino_id' => 'required|different:origen_id',
      'descripcion' => 'required',
      'distancia_km' => 'required|numeric|gt:0',
    ];
  }

  public function attributes()
  {
    return [
      'origen_id' => 'ciudad origen',
      'destino_id' => 'ciudad destino',
    ];
  }
}
