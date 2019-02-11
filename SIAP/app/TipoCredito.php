<?php

namespace siap;

use Illuminate\Database\Eloquent\Model;

class TipoCredito extends Model
{
    protected $table = 'tipo_credito';

    
    protected $primaryKey='idtipocredito';

    protected $fillable = [
        'nombre', 'condicion','monto', 'interes','estado'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];
    //Relacion con tabla Cuenta
    public function cuenta(){
        return $this->hasMany(Cuenta::class);
    }
}
