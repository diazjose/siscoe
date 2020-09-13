<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Puesto;
use App\Trabajo;

class PuestosController extends Controller
{
    public function index(){
    	$puestos = Puesto::orderBy('estado', 'ASC')->get();
    	return view('puestos.index', ['puestos' => $puestos]);
    }

    public function register(){
    	return view('puestos.register');
    }

     public function create(Request $request){
     	
    	$validate = $this->validate($request, [
                'denominacion' => ['required', 'string', 'max:255', 'unique:puestos'],
	            'direccion' => ['required', 'string', 'max:255', 'unique:puestos'],
	        ],
	    	[
	    		'denominacion.unique' => 'Esta denominacion ya esta registrada',
	    		'direccion.unique' => 'Esta direccion ya esta registrada',
	    	]);

        $puesto = new Puesto();
        $puesto->denominacion = strtoupper($request->input('denominacion'));
		$puesto->direccion = strtoupper($request->input('direccion'));
        $puesto->estado = 1;
        if (!empty($request->input('latitud'))) {
        	$puesto->latitud = $request->input('latitud');	
        }
        if (!empty($request->input('longitud'))) {
        	$puesto->longitud = $request->input('longitud');	
        }
    	$puesto->zona = strtoupper($request->input('zona'));
		$puesto->save();

    	return redirect()->route('puesto.index')
                         ->with(['message' => 'Puesto creado correctamente', 'status' => 'success']);

    }

    public function edit($id){
    	$puesto = Puesto::find($id);
    	return view('puestos.edit', ['puesto' => $puesto]);
    }

    public function update(Request $request){

    	$id = $request->input('id');

    	$validate = $this->validate($request, [
                'denominacion' => ['required', 'string', 'max:255', 'unique:puestos,denominacion,'.$id],
	            'direccion' => ['required', 'string', 'max:255', 'unique:puestos,direccion,'.$id],
	        ],
	    	[
	    		'denominacion.unique' => 'Esta denominacion ya esta registrada',
	    		'direccion.unique' => 'Esta direccion ya esta registrada',
	    	]);

        $puesto = Puesto::find($id);

        $puesto->denominacion = strtoupper($request->input('denominacion'));
		$puesto->direccion = strtoupper($request->input('direccion'));
        $puesto->estado = $request->input('estado');
        if (!empty($request->input('latitud'))) {
        	$puesto->latitud = $request->input('latitud');	
        }
        if (!empty($request->input('longitud'))) {
        	$puesto->longitud = $request->input('longitud');	
        }
    	
		$puesto->update();

    	return redirect()->route('puesto.view', [$id])
                         ->with(['message' => 'Puesto actualizado correctamente', 'status' => 'success']);
    }

     public function view($id,$fecha=''){
        if ($fecha!='') {
            $puesto = Puesto::find($id);
            $personas = Trabajo::where('puesto_id',$id)->where('fecha', $fecha)->orderBy('horaEntrada', 'ASC')->get();
        }else{
            $puesto = Puesto::find($id);
            $personas = Trabajo::where('puesto_id',$id)->where('fecha', date('Y-m-d'))->orderBy('horaEntrada', 'ASC')->get();
            $fecha = date('Y-m-d');
        }
        
        return view('puestos.view', ['puesto' => $puesto, 'personas' => $personas, 'fecha' => $fecha]);
    }
}
