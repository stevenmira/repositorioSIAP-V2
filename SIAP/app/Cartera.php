<?php

namespace siap;

use Illuminate\Database\Eloquent\Model;

class cartera extends Model
{
    protected $table = 'cartera';

    
    protected $primaryKey='idcartera';

    protected $fillable = [
        'idejecutivo',
        'idsupervisor',
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

    //Relacion con tabla Cliente
    public function cliente(){
        return $this->hasMany(Cliente::class);
    }
    //Relacion con tabla Ejecutivo
    public function ejecutivo(){
        return $this->belongsTo(Cliente::class);
    }
    //Relacion con tabla Supervisor
    public function supervisor(){
        return $this->belongsTo(Cliente::class);
    }
}
