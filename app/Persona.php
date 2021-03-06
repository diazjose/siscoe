<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $table = 'personas';

    protected $fillable = [
        'nombre', 'apellidos', 'dni', 'email', 'direccion', 'telefono','fechaIngreso', 'situacionLaboral',
    ];

    public function depende(){
    	return $this->hasMany('App\Dependiente'); 
    }

    public function user(){
    	return $this->hasOne('App\User'); 
    }

    public function vehiculos(){
        return $this->hasMany('App\Vehiculo'); 
    }

    public function tarea(){
        return $this->hasOne('App\Trabajo')->where('fecha', date('Y-m-d'));   
    }
}
