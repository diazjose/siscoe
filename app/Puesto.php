<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Puesto extends Model
{
    protected $table = 'puestos';

    protected $fillable = [
        'denominacion', 'direccion', 'estado', 'latitud', 'longitud',
    ];
    /*
    public function depende(){
    	return $this->hasMany('App\Dependiente'); 
    }

    public function user(){
    	return $this->hasOne('App\User'); 
    }

    public function vehiculos(){
        return $this->hasMany('App\Vehiculo'); 
    }
    */
}
