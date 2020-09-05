<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Persona;
use App\Dependiente;


class PersonalController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }

    public function register(Request $request){
        $aut = Persona::where('cargo', '!=', 'PERSONAL VOLUNTARIO')->orderBy('apellidos','asc')->get();
        return view('personal.registrar', ['auth' => $aut]);
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
                'zona' => ['required', 'string', 'max:255'],
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
    	$persona->zona = strtoupper($request->input('zona'));
        $persona->telefono = $request->input('telefono');
		$persona->fechaIngreso = $request->input('fechaIngreso');
		$persona->situacionLaboral = $request->input('situacionLaboral');
    	$persona->cargo = strtoupper($request->input('cargo'));
    	
		$persona->save();

        if ($request->input('enlazar') != 'NADIE') {
            $dep = new Dependiente();
            $dep->coordinador_id = $request->input('enlazar');
            $dep->persona_id = $persona->id;

            $dep->save();
        }


    	return redirect()->route('home')
                         ->with(['message' => 'Persona cargada correctamente', 'status' => 'success']);

    }

    public function update(Request $request){

        $id = $request->input('id');
        $persona = Persona::find($id);  

        $validate = $this->validate($request, [
                'nombre' => ['required', 'string', 'max:255'],
                'apellidos' => ['required', 'string', 'max:255'],
                'dni' => ['required', 'string', 'max:8', 'unique:personas,dni,'.$id],
                'fechaNac' => ['required', 'date', 'max:255'],
                'email' => ['required', 'email', 'unique:personas,email,'.$id],
                'direccion' => ['required', 'string', 'max:255'],
                'zona' => ['required', 'string', 'max:255'],
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
        $persona->zona = strtoupper($request->input('zona'));
        $persona->telefono = $request->input('telefono');
        $persona->fechaIngreso = $request->input('fechaIngreso');
        $persona->situacionLaboral = $request->input('situacionLaboral');
        $persona->cargo = strtoupper($request->input('cargo'));
        
        $persona->update();

        $de = $request->input('enlazar');
        if ($de != 'NADIE') {
            $depende = Dependiente::where('persona_id', $id)->first();
            if ($depende) {
               if ($de != $depende->coordinador_id) {
                    $depende->coordinador_id = $de;
                    $depende->update();           
                } 
            }else{
                $dep = new Dependiente();
                $dep->coordinador_id = $request->input('enlazar');
                $dep->persona_id = $persona->id;

                $dep->save();                
            }
        }else{
            $depende = Dependiente::where('persona_id', $id)->first();
            if ($depende) {
                $depende->delete();        
            }
        }


        return redirect()->route('personal.viewAuth',[$id])
                         ->with(['message' => 'Persona Actualizada correctamente', 'status' => 'success']);

    }

    public function edit($id){
        $persona = Persona::find($id);
        $aut = Persona::where('cargo', '!=', 'PERSONAL VOLUNTARIO')->orderBy('apellidos','asc')->get();
        return view('personal.edit', ['persona' => $persona, 'auth' => $aut]);
    }

    public function listAuth(){
        $aut = Persona::where('cargo', '!=', 'PERSONAL VOLUNTARIO')->get();
        return view('personal.autoridad', ['personas' => $aut]);
    }

    public function viewAuth($id){
        $auth = Persona::where('id',$id)->first();
        $personas = Dependiente::where('coordinador_id',$id)->get();
        //var_dump($personas);
        //die();
        return view('personal.viewAuth1', ['auth' => $auth, 'dependiente' => $personas]);
    }
}


/* BATABASE


create table users(
id int(255) auto_increment not null,
name varchar(255),
surname varchar(255),
email varchar(255),
password varchar(255),
role varchar(255),
created_at datetime,
updated_at datetime,
remember_token varchar(255),
CONSTRAINT pk_users PRIMARY KEY(id)    
)ENGINE=InnoDB;

create table personas(
id int(255) auto_increment not null,
nombre varchar(255),
apellidos varchar(255),
dni varchar(20),
fechaNac date,
email varchar(255),
direccion varchar(255),
telefono varchar(50),
fechaIngreso date,
situacionLaboral varchar(255),
cargo varchar(100),
image varchar(255),
created_at datetime,
updated_at datetime,
remember_token varchar(255),
CONSTRAINT pk_users PRIMARY KEY(id)    
)ENGINE=InnoDB;

create table dependiente(
id int(255) auto_increment not null,
coordinador_id int(255),
persona_id int(255),
created_at datetime,
updated_at datetime,
CONSTRAINT pk_dependiente PRIMARY KEY(id),
CONSTRAINT fk_dependiente_coordinador FOREIGN KEY(coordinador_id) REFERENCES personas(id),    
CONSTRAINT fk_dependiente_persona FOREIGN KEY(persona_id) REFERENCES personas(id)
)ENGINE=InnoDB;

create table trabajo(
id int(255) auto_increment not null,
parsona_id int(255),
fecha date,
horaEntrada time,
hora_Salida time,
direccion int(255),
tarea varchar(255),
created_at datetime,
updated_at datetime,
CONSTRAINT pk_trabajo PRIMARY KEY(id),
CONSTRAINT fk_trabajo_persona FOREIGN KEY(parsona_id) REFERENCES personas(id)
)ENGINE=InnoDB;

*/