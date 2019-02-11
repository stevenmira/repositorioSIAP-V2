<?php

namespace siap\Http\Requests;

use siap\Http\Requests\Request;

class CarterasFormRequest extends Request
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

            'nombre'=> 'required|max:50',
            'idejecutivo'=> 'required',
            'idsupervisor'=> 'required',
            //

        ];
    }

    public function messages()
    {
        return [

            //Ejecutivo
            'idejecutivo.required' =>'El campo -- Ejecutivo -- es obligatorio.',

            //Supervisor
            'idsupervisor.required' =>'El campo -- Supervisor -- es obligatorio.',
            
            //Nombre
            'nombre.max' =>'El campo  -- Nombres -- debe contener 50 caracteres como máximo.',
            'nombre.required' =>'El campo -- Nombre -- es obligatorio.' 
            
        ];
    }
}
