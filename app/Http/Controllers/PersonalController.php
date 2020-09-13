<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Persona;
use App\Dependiente;
use App\Vehiculo;
use App\Puesto;
use App\Trabajo;


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
	            //'fechaNac' => ['required', 'date', 'max:255'],
	            //'email' => ['required', 'email', 'unique:personas'],
	            'direccion' => ['required', 'string', 'max:255'],
                'zona' => ['required', 'string', 'max:255'],
	            'telefono' => ['required', 'string', 'max:255'],
	            //'fechaIngreso' => ['required', 'date', 'max:255'],
	            'situacionLaboral' => ['required', 'string', 'max:255'],
	            'cargo' => ['required', 'string', 'max:50'],
            ],
            [
            	//'email.unique' => 'Este correo ya existe en la Base de Datos para otro Personal',
            	'dni.unique' => 'Este N° de DNI ya existe en la Base de Datos para otro Personal',
            ]);



    	$persona->nombre = strtoupper($request->input('nombre'));
    	$persona->apellidos = strtoupper($request->input('apellidos'));
		$persona->dni = $request->input('dni');
		if (!empty($request->input('fechaNac'))) {
            $persona->fechaNac = $request->input('fechaNac');
        }
        //$persona->email = $request->input('email');
    	$persona->direccion = strtoupper($request->input('direccion'));
    	$persona->zona = strtoupper($request->input('zona'));
        $persona->telefono = $request->input('telefono');
		if (!empty($request->input('fechaIngreso'))) {
            $persona->fechaIngreso = $request->input('fechaIngreso');
        }
        $persona->situacionLaboral = $request->input('situacionLaboral');
    	$persona->cargo = strtoupper($request->input('cargo'));
    	
		$persona->save();

        if ($request->input('enlazar') != 'NADIE') {
            $dep = new Dependiente();
            $dep->coordinador_id = $request->input('enlazar');
            $dep->persona_id = $persona->id;

            $dep->save();
        }
        /*
        if (!empty($request->input('vehiculo'))) {
            $vehi = new Vehiculo();
            $vehi->persona_id = $persona->id;
            $vehi->tipo = $request->input('vehiculo');
            $vehi->descripcion = strtoupper($request->input('descripcion'));
            $vehi->dominio = $request->input('dominio');
            $vehi->save();
        }
        return redirect()->route('home')
                         ->with(['message' => 'Persona cargada correctamente', 'status' => 'success']);
    	*/
        return redirect()->route('personal.viewAuth', [$persona->id]);
                         //->with(['message' => 'Persona cargada correctamente', 'status' => 'success']);

    }

    public function update(Request $request){

        $id = $request->input('id');
        $persona = Persona::find($id);  

        $validate = $this->validate($request, [
                'nombre' => ['required', 'string', 'max:255'],
                'apellidos' => ['required', 'string', 'max:255'],
                'dni' => ['required', 'string', 'max:8', 'unique:personas,dni,'.$id],
                //'fechaNac' => ['required', 'date', 'max:255'],
                //'email' => ['required', 'email', 'unique:personas,email,'.$id],
                'direccion' => ['required', 'string', 'max:255'],
                'zona' => ['required', 'string', 'max:255'],
                'telefono' => ['required', 'string', 'max:255'],
                //'fechaIngreso' => ['required', 'date', 'max:255'],
                'situacionLaboral' => ['required', 'string', 'max:255'],
                'cargo' => ['required', 'string', 'max:50'],
            ],
            [
                //'email.unique' => 'Este correo ya existe en la Base de Datos para otro Personal',
                'dni.unique' => 'Este N° de DNI ya existe en la Base de Datos para otro Personal',
            ]);

        $persona->nombre = strtoupper($request->input('nombre'));
        $persona->apellidos = strtoupper($request->input('apellidos'));
        $persona->dni = $request->input('dni');
        $persona->fechaNac = $request->input('fechaNac');
        //$persona->email = $request->input('email');
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
        $lugares = Puesto::where('estado', 1)->get();
        return view('personal.viewAuth1', ['auth' => $auth, 'dependiente' => $personas, 'lugares' => $lugares]);
    }

    public function vehiculo(Request $request){
        $vehi = new Vehiculo();
        $vehi->persona_id = $request->input('id');
        $vehi->tipo = $request->input('vehiculo');
        $vehi->descripcion = strtoupper($request->input('descripcion'));
        $vehi->dominio = $request->input('dominio');
        $vehi->save();

        return redirect()->route('personal.viewAuth', [$vehi->persona_id])
                         ->with(['message' => 'Vehiculo cargado correctamente', 'status' => 'success']);   
    }

    public function asignarTarea(Request $request){
        $validate = $this->validate($request, [
                'persona_id' => ['required', 'integer', 'max:255'],
                'lugar' => ['required', 'integer', 'max:255'],
                'horaEntrada' => ['required', 'string', 'max:255'],
                'horaEntrada' => ['required', 'string', 'max:255'],
                'tarea' => ['required', 'string', 'max:255'],
            ],
            [
                'denominacion.unique' => 'Esta denominacion ya esta registrada',
                'direccion.unique' => 'Esta direccion ya esta registrada',
            ]);

        $tarea = new Trabajo();

        $tarea->persona_id = $request->input('persona_id');
        $tarea->puesto_id = $request->input('lugar');
        $tarea->fecha = date('Y-m-d');
        $tarea->persona_id = $request->input('persona_id');
        $tarea->horaEntrada = $request->input('horaEntrada');
        $tarea->horaSalida = $request->input('horaSalida');
        $tarea->tarea = $request->input('tarea');

        $tarea->save();

        return redirect()->route('personal.viewAuth', [$request->input('id')])
                         ->with(['message' => 'Tarea asignada correctamente', 'status' => 'success']);   
    }

    public function editTarea(Request $request){

        $validate = $this->validate($request, [
                'persona_id' => ['required', 'integer', 'max:255'],
                'lugar' => ['required', 'integer', 'max:255'],
                'horaEntrada' => ['required', 'string', 'max:255'],
                'horaEntrada' => ['required', 'string', 'max:255'],
                'tarea' => ['required', 'string', 'max:255'],
            ]);

        $tarea = Trabajo::find($request->input('idTarea'));
        
        $tarea->puesto_id = $request->input('lugar');
        $tarea->horaEntrada = $request->input('horaEntrada');
        $tarea->horaSalida = $request->input('horaSalida');
        $tarea->tarea = $request->input('tarea');

        $tarea->update();

        return redirect()->route('personal.viewAuth', [$request->input('id')])
                         ->with(['message' => 'Tarea actualizada correctamente', 'status' => 'success']);   
    }

    public function destroyTarea(Request $request){
        
        $u = $request->input('id');
        $id = $request->input('idTarea');
        $name = $request->input('name');
        $trabajo = Trabajo::find($id);
        $trabajo->delete();

        return redirect()->route('personal.viewAuth', [$u])
                         ->with(['message' => 'Se ha eliminado la tarea  de '.$name, 'status' => 'danger']);

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

create table vehiculos(
id int(255) auto_increment not null,
persona_id int(255),
tipo varchar(100),
descripcion varchar(255),
dominio varchar(150),
estado varchar(100),
created_at datetime,
updated_at datetime,
CONSTRAINT pk_vehiculos PRIMARY KEY(id),
CONSTRAINT fk_vehiculos_persona FOREIGN KEY(persona_id) REFERENCES personas(id)
)ENGINE=InnoDB;

create table puestos(
id int(255) auto_increment not null,
denominacion varchar(100),
direccion varchar(255),
estado varchar(50),
latitud varchar(100),
longitud varchar(100),
zona varchar(50),
created_at datetime,
updated_at datetime,
CONSTRAINT pk_puestos PRIMARY KEY(id)
)ENGINE=InnoDB;

create table trabajo(
id int(255) auto_increment not null,
persona_id int(255),
puesto_id int(255),
fecha date,
horaEntrada time,
horaSalida time,
tarea varchar(255),
created_at datetime,
updated_at datetime,
CONSTRAINT pk_trabajo PRIMARY KEY(id),
CONSTRAINT fk_trabajo_persona FOREIGN KEY(persona_id) REFERENCES personas(id),
CONSTRAINT fk_trabajo_puesto FOREIGN KEY(puesto_id) REFERENCES puestos(id)
)ENGINE=InnoDB;

*/