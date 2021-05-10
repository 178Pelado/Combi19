<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInsumos extends FormRequest
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
            'nombre' => 'required|nombre_descripcion2:' . $this->descripcion . ',' . $this->id,
            'descripcion' => 'required',
            'cantidad' => 'required|integer|gt:0',
            'precio' => 'required|numeric|gt:0',
        ];
    }
}
