<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $formsall = null;
        $userId = Auth::id();
        $programs = DB::table('Programa')->get();
        $programas = DB::table('Programa')
        ->join('Aplicacion', 'Programa.idPrograma', '=', 'Aplicacion.Programa_idPrograma')
        ->where('Aplicacion.idusers', $userId)
        ->get();
        $applications = DB::table('Aplicacion')->where('idusers', $userId)
            ->join('Formulario', 'Aplicacion.Programa_idPrograma', '=', 'Formulario.Programa_idPrograma')
            ->join('empresa', 'Aplicacion.empresa', '=', 'empresa.id')
            ->select('Formulario.idFormulario', 'Aplicacion.idAplicacion', 'Aplicacion.empresa', 'Aplicacion.estatus', 'Aplicacion.Programa_idPrograma', 'empresa.nombre')
            ->get();
        $aplican = DB::table('Aplicacion')->get();
        $aplicantes = count($aplican);

        return view('home', compact('programs','applications','formsall','aplicantes','programas'));
    }
}