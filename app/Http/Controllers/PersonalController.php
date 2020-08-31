<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Persona;

class PersonalController extends Controller
{
    public function register(Request $request){
    	return view('personal.registrar');
    }

    public function create(Request $request){

    	$persona = new Persona;

    	$validate = $this->validate($request, [
                'nombre' => ['required', 'string', 'max:255'],
	            'apellidos' => ['required', 'string', 'max:255'],
	            'dni' => ['required', 'string', 'max:255', 'unique:personas'],
	            'fechaNac' => ['required', 'date', 'max:255'],
	            'email' => ['required', 'email', 'unique:personas'],
	            'direccion' => ['required', 'string', 'max:255'],
	            'telefono' => ['required', 'string', 'max:255'],
	            'fechaIngreso' => ['required', 'date', 'max:255'],
	            'situacionLaboral' => ['required', 'string', 'max:255'],
	            'cargo' => ['required', 'string', 'max:50'],
            ],
            [
            	'email.unique' => 'Este correo ya existe en la Base de Datos para otro Personal',
            	'dni.unique' => 'Este N° de DNI ya existe en la Base de Datos para otro Personal',
            ]);


    	$persona->nombre = strtoupper($request->input('nombre'));
    	$persona->apellidos = strtoupper($request->input('apellidos'));
		$persona->dni = $request->input('dni');
		$persona->fechaNac = $request->input('fechaNac');
    	$persona->email = $request->input('email');
    	$persona->direccion = strtoupper($request->input('direccion'));
    	$persona->telefono = $request->input('telefono');
		$persona->fechaIngreso = $request->input('fechaIngreso');
		$persona->situacionLaboral = $request->input('situacionLaboral');
    	$persona->cargo = strtoupper($request->input('cargo'));
    	
		$persona->save();

    	return redirect()->route('home')
                         ->with(['message' => 'Persona cargada correctamente', 'status' => 'success']);

    }
}
