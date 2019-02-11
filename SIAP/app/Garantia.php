<?php

namespace siap;

use Illuminate\Database\Eloquent\Model;

class Garantia extends Model
{
    protected $table = 'garantia';

    
    protected $primaryKey='idgarantia';

    protected $fillable = [
        'idprestamo',
        'descripcion',
        'marca',
        'serie',
        'otros',
        'valor',
        'tipogarante'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];


    //Relacion con clase Prestamo
    public function prestamo(){
        return $this->belongsTo(Prestamo::class);
    }
}
