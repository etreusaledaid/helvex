<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreFormulariosRequest;

class FormulariosController extends Controller
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
    public function index($idprograma)
    {
        if (! Gate::allows('gestion_usuarios')) {
            return abort(401);
        }

        $formularios = DB::table('Formulario')->where('Programa_idPrograma', $idprograma)
            ->join('Programa', 'Formulario.Programa_idPrograma', '=', 'Programa.idPrograma')
            ->select('Formulario.idFormulario', 'Programa.nombre', 'Formulario.Programa_idPrograma')
            ->get();

        return view('formularios.index', compact('formularios','idprograma'));
    }

    public function indextwo($idprograma,$iduser)
    {
        if (! Gate::allows('gestion_usuarios')) {
            if (! (Gate::allows('evaluar_usuarios')||Gate::allows('auditar_usuarios')||Gate::allows('corporativo_usuarios'))) {
                return abort(401);
            }
        }

        $formularios = DB::table('Formulario')->where('Programa_idPrograma', $idprograma)
            ->join('Programa', 'Formulario.Programa_idPrograma', '=', 'Programa.idPrograma')
            ->select('Formulario.idFormulario', 'Programa.nombre', 'Formulario.Programa_idPrograma')
            ->get();
        $user = DB::table('users')->where('id', $iduser)->get();

        return view('formularios.indextwo', compact('formularios','idprograma','iduser','user'));
    }

    public function create($idprograma)
    {
        if (! Gate::allows('gestion_usuarios')) {
            return abort(401);
        }
        $programas = DB::table('Programa')->where('idPrograma', $idprograma)->get();
        return view('formularios.create', compact('programas','aplicaciones','idprograma'));
    }

    public function store(StoreFormulariosRequest $request)
    {
        if (! Gate::allows('gestion_usuarios')) {
            return abort(401);
        }

        DB::table('Formulario')->insert(['Programa_idPrograma' => $request->idPrograma]);
        return redirect()->route('admin.formularios', [$request->idPrograma]);
    }

    public function destroy($zip)
    {
        if (! Gate::allows('gestion_usuarios')) {
            return abort(401);
        }        
        $explode_id = array_map('intval', explode(',', $zip));
        $id = $explode_id[0];
        $idprograma = $explode_id[1];
        DB::table('Formulario')->where('idFormulario', '=', $id)->delete();
        return redirect()->route('admin.formularios', [$idprograma]);
    }

}