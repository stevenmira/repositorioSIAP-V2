<?php

namespace siap;

use Illuminate\Database\Eloquent\Model;

class Codeudor extends Model
{
    protected $table = 'codeudor';

    
    protected $primaryKey='idcodeudor';

    protected $fillable = [
        'idcliente', 'codigo', 'nombre', 'apellido', 'dui','nit','fechanacimiento',
        'direccion','telefonocel','telefonofijo', 'profesion', 'domicilio','estado', 'lugarexpedicion', 'fechaexpedicion'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];


    //Relacion con clase Codeudor
    public function codeudor(){
        return $this->belongsTo(Codeudor::class);
    }
}
