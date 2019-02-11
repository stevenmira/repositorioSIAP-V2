<?php

namespace siap;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    protected $table = 'empleado';
    
    protected $primaryKey='idempleado';

    protected $fillable = [
        'nombre',
        'apellido',
        'dui',
        'telefono',
        'comentario',
        'correo',
        'direccion',
        'fotografia',
        'cargo',
        'fechanacimiento',
        'sexo'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];
}
