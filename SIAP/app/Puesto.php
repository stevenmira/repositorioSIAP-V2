<?php

namespace siap;

use Illuminate\Database\Eloquent\Model;

class Puesto extends Model
{
     protected $table = 'puesto';

    
    protected $primaryKey='idpuesto';

    protected $fillable = [
        'cargo',
        'estado',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];

    //Relacion con tabla Empleado
    public function empleado(){
        return $this->hasMany(Empleado::class);
    }
}
