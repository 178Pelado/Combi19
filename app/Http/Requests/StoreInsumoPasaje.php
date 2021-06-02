<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;
use App\Models\Insumo;

class StoreInsumoPasaje extends FormRequest
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
    $insumo = Insumo::where('id', '=', $this->insumo_id)->get()->first();
    $cantidad = $insumo->cantidad;
    return [
      'cantidad' => 'numeric|gt:0|lte:' . $cantidad,
    ];
  }

  public function messages(){
    $insumo = Insumo::where('id', '=', $this->insumo_id)->get()->first();
    $cantidad = $insumo->cantidad;
    return [
      'cantidad.gt' => 'La cantidad debe ser mayor a 0',
      'cantidad.lte' => 'La cantidad pedida supera el stock disponible. Stock: ' . $cantidad,
    ];
  }
}