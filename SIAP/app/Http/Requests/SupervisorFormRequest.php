<?php

namespace siap\Http\Requests;

use siap\Http\Requests\Request;

class SupervisorFormRequest extends Request
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
            'nombre'=>'required|max:30',
            'apellido'=>'required|max:30',
            'fotografia'=>'mimes:jpeg,bmp,png,jpg',
            'dui'=>'min:10|max:10',
            #'fechanacimiento'=>'required',
            #'sexo' => 'required',
            'direccion'=>'max:255',
            'telefono'=>'min:9|max:9',
            'correo'=>'max:100',
            'comentario'=>'max:1024'
        ];
    }

    public function messages()
    {
        return [

            //Ejecutivo
            
            'nombre.max' =>'El campo  -- Nombre -- debe contener 30 caracteres como máximo.',
            'nombre.required' =>'El campo -- Nombre -- es obligatorio.',

            'apellido.max' =>'El campo  -- Apellido -- debe contener 30 caracteres como máximo.',
            'apellido.required' =>'El campo -- Apellido -- es obligatorio.',

            'fotografia.mimes' =>'El campo  -- Fotografia -- debe tener los formatos jpeg,bmp,png,jpg.',

            'dui.min' =>'El campo -- DUI -- debe tener exactamente 9 dígitos, no menos.',
            'dui.max' =>'El campo -- DUI -- debe tener exactamente 9 dígitos, no más.',

            'direccion.max' =>'El campo -- Dirección -- debe contener 255 caracteres como máximo.',

            'telefono.min' =>'El campo -- Teléfono -- debe tener exactamente 8 dígitos, no menos.',
            'telefono.max' =>'El campo -- Teléfono -- debe tener exactamente 8 dígitos, no más.', 

            'correo.max' =>'El campo -- Correo -- debe tener 100 caracteres como máximo.',

            'comentario.max' =>'El campo -- Comentario -- debe tener 1024 caracteres como máximo.' 
            
        ];
    }
}
