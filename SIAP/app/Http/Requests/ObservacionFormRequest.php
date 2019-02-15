<?php

namespace siap\Http\Requests;

use siap\Http\Requests\Request;

class ObservacionFormRequest extends Request
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
            'fecha'=>'required',
            'responsable'=>'required|max:100',
            'comentario'=>'required|max:1024'
        ];
    }

    public function messages()
    {
        return [

            //Comentario
            'fecha.required' =>'El campo -- Fecha -- es obligatorio.',

            'responsable.max' =>'El campo  -- Responsable -- debe contener 100 caracteres como máximo.',
            'responsable.required' =>'El campo -- Responsable -- es obligatorio.',

            'comentario.max' =>'El campo  -- Comentario -- debe contener 1024 caracteres como máximo.',
            'comentario.required' =>'El campo -- Comentario -- es obligatorio.'   
            
        ];
    }
}
