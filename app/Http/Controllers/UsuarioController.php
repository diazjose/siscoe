<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Persona;


class UsuarioController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function index(){
    	$users = User::orderBy('role')->get();
    	return view('usuarios.index', ['usuarios' => $users]);
    }

    public function create(Request $request){

    	$validate = $this->validate($request, [
                'id' => ['required', 'integer', 'max:255'],
	            'user' => ['required', 'string', 'max:255'],
	        ]);

        $per = Persona::find($request->input('id'));
    	
        $user = new User();
        $user->persona_id = $per->id;
		$user->email = $per->email;
		$user->role = $request->input('user');
        $password = substr($per->dni, -4);
    	$user->password = Hash::make($password);
    	
		$user->save();

    	return redirect()->route('personal.viewAuth', [$per->id])
                         ->with(['message' => 'Usuario creado correctamente', 'status' => 'success']);

    }

    public function update(Request $request){
    	$id = $request->input('id');

    	$user = User::find($id);
    	$user->role = $request->input('user');
    	$user->update();

    	return redirect()->route('usuario.index')
                         ->with(['message' => 'El Usuario fue actualizado con exito', 'status' => 'success']);

    }

    public function destroy($id){
    	
    	$user = User::find($id);
        $user->delete();

    	return redirect()->route('usuario.index')
                         ->with(['message' => 'El Usuario se ha eliminado correctamente ', 'status' => 'danger']);

    }

}
