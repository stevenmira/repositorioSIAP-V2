<?php

namespace siap\Http\Requests;

use siap\Http\Requests\Request;

class CodeudorFormRequest extends Request
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
            'nombre'=>'required|max:50',
            'apellido'=>'required|max:50',
            'dui'=>'required|min:10|max:10',
            'nit'=>'required|min:17|max:17',
            'fechanacimiento'=>'required',
            'direccion'=>'required|max:255',
            'telefonocel'=>'min:9|max:9',
            'telefonofijo'=>'min:9|max:9',
            'profesion'=>'max:50',
            'domicilio'=>'required|max:50',
            'lugarexpedicion'=>'required|max:50',
            'fechaexpedicion'=>'required',
        ];
    }

    public function messages()
    {
        return [

            //Codeudor
            
            'nombre.max' =>'El campo  -- Nombres -- debe contener 50 caracteres como máximo.',
            'nombre.required' =>'El campo -- Nombres -- es obligatorio.',

            'apellido.max' =>'El campo  -- Apellidos -- debe contener 50 caracteres como máximo.',
            'apellido.required' =>'El campo -- Apellidos -- es obligatorio.',

            'dui.min' =>'El campo -- DUI -- debe tener exactamente 9 dígitos, no menos.',
            'dui.max' =>'El campo -- DUI -- debe tener exactamente 9 dígitos, no más.',
            'dui.required' =>'El campo -- DUI -- es obligatorio.',

            'nit.min' =>'El campo -- NIT -- debe tener exactamente 14 dígitos, no menos.',
            'nit.max' =>'El campo -- NIT -- debe tener exactamente 14 dígitos, no más.',
            'nit.required' =>'El campo -- NIT -- es obligatorio.',

            'fechanacimiento.required' =>'El campo -- Fecha de Nacimiento -- es obligatorio.',

            'direccion.max' =>'El campo -- Dirección del cliente -- debe contener 255 caracteres como máximo.',
            'direccion.required' =>'El campo -- Dirección del cliente -- es obligatorio.',

            'telefonocel.min' =>'El campo -- Teléfono Celular -- debe tener exactamente 8 dígitos, no menos.',
            'telefonocel.max' =>'El campo -- Teléfono Celular -- debe tener exactamente 8 dígitos, no más.', 

            'telefonofijo.min' =>'El campo -- Teléfono fijo -- debe tener exactamente 8 dígitos, no menos.',
            'telefonofijo.max' =>'El campo -- Teléfono fijo -- debe tener exactamente 8 dígitos, no más.',

            'profesion.max' =>'El campo  -- Profesion -- debe contener 50 caracteres como máximo.',

            'domicilio.max' =>'El campo  -- Domicilio -- debe contener 45 caracteres como máximo.',
            'domicilio.required' =>'El campo -- Domicilio -- es obligatorio.', 

            'lugarexpedicion.max' =>'El campo  -- Lugar de Expedición (DUI) -- debe contener 50 caracteres como máximo.',
            'lugarexpedicion.required' =>'El campo -- Lugar de Expedición (DUI) -- es obligatorio.', 

            'fechaexpedicion.required' =>'El campo -- Fecha de Expedición (DUI) -- es obligatorio.' 
            
        ];
    }
}
