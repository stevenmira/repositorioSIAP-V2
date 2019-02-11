<?php

namespace siap;

use Illuminate\Database\Eloquent\Model;

class Ejecutivo extends Model
{
    protected $table = 'ejecutivo';

    
    protected $primaryKey='idejecutivo';

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
