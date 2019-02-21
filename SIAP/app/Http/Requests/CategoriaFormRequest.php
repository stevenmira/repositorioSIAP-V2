<?php

namespace siap\Http\Requests;

use siap\Http\Requests\Request;

class CategoriaFormRequest extends Request
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
            'letra'=>'required|max:2',
            'calificacion'=>'required|max:30',
            'descripcion'=>'max:255',
        
        ];
    }

    public function messages()
    {
        return [

            //Ejecutivo
            
            'letra.max' =>'El campo  -- Letra -- debe contener 2 caracteres como máximo.',
            'letra.required' =>'El campo -- Letra -- es obligatorio.',

            'calificacion.max' =>'El campo  -- Calificacion -- debe contener 30 caracteres como máximo.',
             
            
        ];
    }
}
