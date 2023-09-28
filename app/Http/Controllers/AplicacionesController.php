<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;

class AplicacionesController extends Controller
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
    public function index($id)
    {
        if (! Gate::allows('gestion_usuarios')) {
            if (! (Gate::allows('evaluar_usuarios')||Gate::allows('auditar_usuarios')||Gate::allows('corporativo_usuarios'))) {
                return abort(401);
            }
        }

        $userId = Auth::id();
        $empresa = DB::table('users')->where('id', $userId)->get();

        $applications3 = DB::table('Aplicacion')->where(['Programa_idPrograma' => $id, 'empresa' => $empresa[0]->empresa_id])
        ->join('Programa', 'Aplicacion.Programa_idPrograma', '=', 'Programa.idPrograma')
        ->join('empresa', 'Aplicacion.empresa', '=', 'empresa.id')
        ->select('Aplicacion.idAplicacion', 'Aplicacion.Programa_idPrograma', 'Aplicacion.empresa', 'Aplicacion.estatus', 'Aplicacion.idusers', 'empresa.nombre')
        ->get();

        $applications2 = DB::table('Aplicacion')->where('Programa_idPrograma', $id)
        ->join('Programa', 'Aplicacion.Programa_idPrograma', '=', 'Programa.idPrograma')
        ->join('empresa', 'Aplicacion.empresa', '=', 'empresa.id')
        ->select('Aplicacion.idAplicacion', 'Aplicacion.Programa_idPrograma', 'Aplicacion.empresa', 'Aplicacion.estatus', 'Aplicacion.idusers', 'empresa.nombre')
        ->get();

        $applications = DB::table('Landing')->where('Programa_idPrograma', $id)->get();
        $programa = DB::table('Programa')->where('idPrograma', $id)->get();
        $formularios = DB::table('Formulario')->where('Programa_idPrograma', $id)
            ->join('Programa', 'Formulario.Programa_idPrograma', '=', 'Programa.idPrograma')
            ->select('Formulario.idFormulario', 'Programa.nombre', 'Formulario.Programa_idPrograma')
            ->get();
        $aplican = DB::table('Aplicacion')->where('Programa_idPrograma', $id)->get();
        $aplicantes = count($aplican);

        return view('aplicaciones.index', compact('applications','id','programa','formularios','aplicantes','applications2','applications3'));
    }

    public function create($idprograma)
    {
        if (! Gate::allows('gestion_usuarios')) {
            return abort(401);
        }
        $programa = DB::table('Programa')->where('idPrograma', $idprograma)->get();
        $aplicaciones = DB::table('Aplicacion')->get();
        return view('aplicaciones.create', compact('programa','aplicaciones','idprograma'));
    }

}