<?php

namespace siap;

use Illuminate\Database\Eloquent\Model;

class Observacion extends Model
{
    protected $table = 'observacion';

    
    protected $primaryKey='idobservacion';

    protected $fillable = [
        'idcliente',
        'fecha',
        'comentario',
        'responsable'
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
        return $this->belongsTo(Cliente::class);
    }

    //Relacion con tabla Empleado
    public function empleado(){
        return $this->belongsTo(Empleado::class);
    }
}
