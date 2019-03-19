<?php

namespace siap\Http\Requests;

use siap\Http\Requests\Request;

class GarantiaFormRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'marca'=>'max:50',
            'serie'=>'max:50',
            'descripcion'=>'required|max:1024',
            'otros'=>'max:1024'
        ];
    }

    public function messages()
    {
        return [
            
            'marca.max' =>'El campo  -- Marca -- debe contener 50 caracteres como máximo.',

            'serie.max' =>'El campo  -- Serie -- debe contener 50 caracteres como máximo.',

            'descripcion.max' =>'El campo  -- Descripcion -- debe contener 1024 caracteres como máximo.',
            'descripcion.required' =>'El campo -- Descripcion -- es obligatorio.',

            'otros.max' =>'El campo  -- Otras especificaciones -- debe contener 1024 caracteres como máximo.'
        ];
    }
}
