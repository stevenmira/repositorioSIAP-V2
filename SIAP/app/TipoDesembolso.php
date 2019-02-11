<?php

namespace siap;

use Illuminate\Database\Eloquent\Model;

class TipoDesembolso extends Model
{
    protected $table = 'tipo_desembolso';

    
    protected $primaryKey='idtipodesembolso';

    protected $fillable = [
        'nombre',
        'estado',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];

    //Relacion con tabla Prestamo
    public function prestamo(){
        return $this->hasMany(Prestamo::class);
    }
}
