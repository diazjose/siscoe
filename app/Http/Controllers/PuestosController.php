<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Puesto;
use App\Trabajo;
use Mapper;

class PuestosController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function index(){
    	$puestos = Puesto::orderBy('estado', 'ASC')->get();
        Mapper::map(-29.423337, -66.865371, ['zoom' => 13, 'markers' => ['title' => 'Base Operativa', 'animation' => 'DROP']]);
        //Recorremos los registros para generar las marcas
        foreach ($puestos as $pu) {
            if ($pu->latitud != null) {
                Mapper::marker($pu->latitud, $pu->longitud,['title' => $pu->denominacion." - ".$pu->direccion]);
            }
        }
        return view('puestos.index', ['puestos' => $puestos]);
    }

    public function register(){
    	//return view('puestos.register');
        //$puestos = Puesto::where('estado',1)->get();
        //var_dump($puestos);
        //die();
        
        //Inicializamos el Api
        //Mapper::map(-29.423337, -66.865371, ['zoom' => 13, 'markers' => ['title' => 'Base Operativa', 'animation' => 'DROP']]);
        //Mapper::marker(-29.423337, -66.865371, ['draggable' => true]);
        //Mapper::marker(-29.423337, -66.865371, ['draggable' => true, 'eventClick' => 'console.log("left click");']);
        
        //Recorremos los registros para generar las marcas
        /*foreach ($puestos as $pu) {
            //Mapper::circle([['latitude' => $pu->latitud, 'longitude' => $pu->longitud]],['title' => $pu->denominacion]);
            Mapper::marker($pu->latitud, $pu->longitud,['title' => $pu->denominacion." - ".$pu->direccion]);
        }*/

        //Mostramos la vista
        //return view('puestos.maps');
        //Mapper::map(-29.423296, -66.865211, ['zoom' => 15,'draggable' => true]);
        //Mapper::marker(-29.423296, -66.865211, ['draggable' => true, 'eventClick' => 'console.log("left click");']);
       // Mapper::map(-29.441765, -66.874909, ['zoom' => 15, 'markers' => ['title' => 'My Location', 'animation' => 'DROP']]);-29.423337, -66.865371

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
        $puesto->zona = $request->input('zona');
        $puesto->estado = 1;
        if (!empty($request->input('latitud'))) {
        	$puesto->latitud = $request->input('latitud');	
        }
        if (!empty($request->input('longitud'))) {
        	$puesto->longitud = $request->input('longitud');	
        }
    	
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

     public function view($id){
        
        $puesto = Puesto::find($id);
        if ($puesto->latitud != null) {
            Mapper::map($puesto->latitud, $puesto->longitud, ['zoom' => 15, 'markers' => ['title' => $puesto->denominacion.' - '.$puesto->direccion, 'animation' => 'DROP']]);
        }else{
            Mapper::map(-29.423337, -66.865371, ['zoom' => 13, 'markers' => ['title' => 'Base Operativa', 'animation' => 'DROP']]);        
        }
        $personas = Trabajo::where('puesto_id',$id)->where('fecha', date('Y-m-d'))->orderBy('horaEntrada', 'ASC')->get();
        //$lugares = Puesto::all();
        
        return view('puestos.view', ['puesto' => $puesto, 'personas' => $personas]);
    }
}
