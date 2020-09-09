<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    protected $table = 'vehiculos';

    protected $fillable = [
        'persona_id', 'tipo', 'descripcion', 'dominio', 'estado',
    ];

    public function persona(){
		return $this->belongsTo('App\Persona', 'persona_id');
    }
}
