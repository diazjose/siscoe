<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Persona;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $role = Auth::user()->role;
        if ($role == 'ADMIN') {
            $personas = Persona::all();
            return view('personal.index', ['personas' => $personas]);    
        }else{
            return redirect()->route('personal.viewAuth', [Auth::user()->persona->id]);
        }
        
    }
}
