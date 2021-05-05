<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Combi;

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
      'combi_id' => 'required|viaje_distinto_fecha:' . $this->fecha,
      'ruta_id' => 'required',
      // 'insumo_id[]' => 'required',
      'precio' => 'required|numeric|gt:0',
      'fecha' => 'required',
    ];
  }

  public function attributes()
  {
    $combi = Combi::where('id', '=', $this->combi_id)->get()->first();
    return [
      'combi_id' => $combi->patente,
    ];
  }
}
