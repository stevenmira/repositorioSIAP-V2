<?php

namespace siap;

use Illuminate\Database\Eloquent\Model;

class Supervisor extends Model
{
    protected $table = 'supervisor';

    
    protected $primaryKey='idsupervisor';

    protected $fillable = [
        'nombre',
        'apellido',
        'dui',
        'telefono',
        'comentario',
        'correo',
        'direccion',
        'fotografia',
        'fechanacimiento',
        'sexo',
        'estado'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];

    //Relacion con tabla Cartera
    public function cartera(){
        return $this->hasMany(Cliente::class);
    }
}
