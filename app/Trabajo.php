<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trabajo extends Model
{
	protected $table = 'trabajo';

    protected $fillable = [
        'persona_id', 'puesto_id', 'fecha', 'horaEntrada', 'horaSalida', 'tarea',
    ];
        
    public function lugar(){
        return $this->belongsTo('App\Puesto', 'puesto_id'); 
    }

    public function persona(){
        return $this->belongsTo('App\Persona', 'persona_id'); 
    }

}
