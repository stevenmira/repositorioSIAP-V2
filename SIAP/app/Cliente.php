<?php

namespace siap;

use Illuminate\Database\Eloquent\Model;

class cliente extends Model
{
    protected $table = 'cliente';

    
    protected $primaryKey='idcliente';

    protected $fillable = [
        'idcartera', 'idcategoria', 'codigo', 'nombre', 'apellido', 'dui','nit','fechanacimiento',
        'direccion','telefonocel','telefonofijo', 'profesion', 'domicilio','estado', 'lugarexpedicion', 'fechaexpedicion'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];


    //Relacion con clase Cartera
    public function cartera(){
        return $this->belongsTo(Cartera::class);
    }

    //Relacion con clase Categoria
    public function categoria(){
        return $this->belongsTo(Categoria::class);
    }

    //RELACION CON TABLA Negocio 
    public function negocio(){
        return $this->hasMany(Negocio::class);
    }

}
