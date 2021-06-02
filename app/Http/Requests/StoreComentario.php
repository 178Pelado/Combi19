<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreComentario extends FormRequest
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
      'comentario' => 'required|max:140',
    ];
  }
}
