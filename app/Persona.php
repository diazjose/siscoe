<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $table = 'personas';

    protected $fillable = [
        'nombre', 'apellidos', 'dni', 'email', 'direccion', 'telefono','fechaIngreso', 'situacionLaboral',
    ];

}
