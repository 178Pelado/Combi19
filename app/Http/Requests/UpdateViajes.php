<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Combi;

class UpdateViajes extends FormRequest
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
      'fecha' => 'viaje_distinto_fecha:' . $this->combi_id,
    ];
  }

  public function attributes()
  {
    $combi = Combi::where('id', '=', $this->combi_id)->get()->first();
    return [
      'fecha' => $combi->patente,
    ];
  }
}
