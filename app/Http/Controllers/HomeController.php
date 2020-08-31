<?php

namespace App\Http\Controllers;

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
        $personas = Persona::all();
        return view('personal.index', ['personas' => $personas]);
    }
}
