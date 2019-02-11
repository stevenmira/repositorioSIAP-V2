<?php

namespace siap;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = 'categoria';

    
    protected $primaryKey='idcategoria';

    protected $fillable = [
        'letra',
        'descripcion',
        'estado',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];

    //Relacion con tabla Cliente
    public function cliente(){
        return $this->hasMany(Cliente::class);
    }
}
