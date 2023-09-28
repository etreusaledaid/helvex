<?php

namespace App\Http\Controllers\Admin;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreLandingsRequest;
use App\Http\Requests\Admin\UpdateLandingsRequest;

class LandingController extends Controller
{
    /**
     * Display a listing of User.
     *
     * @return \Illuminate\Http\Response
     */

	public function __construct()
    {
        $this->middleware('auth');
    }

    /*public function index(){
        if (! Gate::allows('gestion_usuarios')) {
            return abort(401);
        }
        $landings = DB::table('Landing')->get();
        return view('admin.landing.index', compact('landings'));    	
    }*/

    public function create($id)
    {
        if (! Gate::allows('gestion_usuarios')) {
            return abort(401);
        }
        $programas = DB::table('Programa')->get();
        $programa = DB::table('Programa')->where('idPrograma', $id)->get();
        return view('admin.landing.create', compact('programas','programa','id'));
    }
   
    public function store(StoreLandingsRequest $request)
    {
        if (! Gate::allows('gestion_usuarios')) {
            return abort(401);
        }

        $id = $request->idPrograma;

        $estatusuno = 0;
        $estatusdos = 0;
        if($request->checkboxuno == true){
            $estatusuno = 1;
        } 
        if($request->checkboxdos == true){
            $estatusdos = 1;
        } 

        DB::table('Landing')->insert(['url' => $request->url, 'nombre' => $request->nombre, 'logo' => $request->logo, 'banner' => $request->banner, 'titulo' => $request->titulo, 'texto' => $request->texto, 'facebook' => $request->facebook, 'twitter' => $request->twitter, 'website' => $request->website, 'Programa_idPrograma' => $request->idPrograma, 'estatus_uno' => $estatusuno, 'imagen_uno' => $request->imagenuno, 'texto_uno' => $request->textouno, 'estatus_dos' => $estatusdos, 'imagen_dos' => $request->imagendos, 'texto_dos' => $request->textodos]);

        $applications2 = DB::table('Aplicacion')->where('Programa_idPrograma', $id)
        ->join('Programa', 'Aplicacion.Programa_idPrograma', '=', 'Programa.idPrograma')
        ->select('Aplicacion.idAplicacion', 'Aplicacion.Programa_idPrograma', 'Aplicacion.empresa', 'Aplicacion.estatus', 'Aplicacion.idusers')
        ->get();

        $applications = DB::table('Landing')->where('Programa_idPrograma', $id)->get();
        $programa = DB::table('Programa')->where('idPrograma', $id)->get();
        $formularios = DB::table('Formulario')->where('Programa_idPrograma', $id)
            ->join('Programa', 'Formulario.Programa_idPrograma', '=', 'Programa.idPrograma')
            ->select('Formulario.idFormulario', 'Programa.nombre', 'Formulario.Programa_idPrograma')
            ->get();
        $aplican = DB::table('Aplicacion')->where('Programa_idPrograma', $id)->get();
        $aplicantes = count($aplican);

        return view('aplicaciones.index', compact('applications','id','programa','formularios','aplicantes','applications2'));
    }

    public function edit($id)
    {
        if (! Gate::allows('gestion_usuarios')) {
            return abort(401);
        }
        $landings = DB::table('Landing')->where('idLanding', $id)->get();
        $programas = DB::table('Programa')->get();

        return view('admin.landing.edit', compact('landings','programas','id'));
    }

    public function update(UpdateLandingsRequest $request, $id)
    {
        if (! Gate::allows('gestion_usuarios')) {
            return abort(401);
        }

        $id = $request->idPrograma;

        $estatusuno = 0;
        $estatusdos = 0;
        if($request->checkboxuno == true){
            $estatusuno = 1;
        } 
        if($request->checkboxdos == true){
            $estatusdos = 1;
        } 

        DB::table('Landing')->where('idLanding', $id)->update(['url' => $request->url, 'nombre' => $request->nombre, 'logo' => $request->logo, 'banner' => $request->banner, 'titulo' => $request->titulo, 'texto' => $request->texto, 'facebook' => $request->facebook, 'twitter' => $request->twitter, 'website' => $request->website, 'Programa_idPrograma' => $request->idPrograma, 'estatus_uno' => $estatusuno, 'imagen_uno' => $request->imagenuno, 'texto_uno' => $request->textouno, 'estatus_dos' => $estatusdos, 'imagen_dos' => $request->imagendos, 'texto_dos' => $request->textodos]);

        $applications2 = DB::table('Aplicacion')->where('Programa_idPrograma', $id)
        ->join('Programa', 'Aplicacion.Programa_idPrograma', '=', 'Programa.idPrograma')
        ->select('Aplicacion.idAplicacion', 'Aplicacion.Programa_idPrograma', 'Aplicacion.empresa', 'Aplicacion.estatus', 'Aplicacion.idusers')
        ->get();

        $applications = DB::table('Landing')->where('Programa_idPrograma', $id)->get();
        $programa = DB::table('Programa')->where('idPrograma', $id)->get();
        $formularios = DB::table('Formulario')->where('Programa_idPrograma', $id)
            ->join('Programa', 'Formulario.Programa_idPrograma', '=', 'Programa.idPrograma')
            ->select('Formulario.idFormulario', 'Programa.nombre', 'Formulario.Programa_idPrograma')
            ->get();
        $aplican = DB::table('Aplicacion')->where('Programa_idPrograma', $id)->get();
        $aplicantes = count($aplican);

        return view('aplicaciones.index', compact('applications','id','programa','formularios','aplicantes','applications2'));
    }

    public function destroy($zip)
    {
        if (! Gate::allows('gestion_usuarios')) {
            return abort(401);
        }        
        $explode_id = array_map('intval', explode(',', $zip));
        $id = $explode_id[0];
        $idlanding = $explode_id[1];
        DB::table('Landing')->where('idLanding', '=', $idlanding)->delete();

        $applications2 = DB::table('Aplicacion')->where('Programa_idPrograma', $id)
        ->join('Programa', 'Aplicacion.Programa_idPrograma', '=', 'Programa.idPrograma')
        ->select('Aplicacion.idAplicacion', 'Aplicacion.Programa_idPrograma', 'Aplicacion.empresa', 'Aplicacion.estatus', 'Aplicacion.idusers')
        ->get();

        $applications = DB::table('Landing')->where('Programa_idPrograma', $id)->get();
        $programa = DB::table('Programa')->where('idPrograma', $id)->get();
        $formularios = DB::table('Formulario')->where('Programa_idPrograma', $id)
            ->join('Programa', 'Formulario.Programa_idPrograma', '=', 'Programa.idPrograma')
            ->select('Formulario.idFormulario', 'Programa.nombre', 'Formulario.Programa_idPrograma')
            ->get();
        $aplican = DB::table('Aplicacion')->where('Programa_idPrograma', $id)->get();
        $aplicantes = count($aplican);

        return view('aplicaciones.index', compact('applications','id','programa','formularios','aplicantes','applications2'));
    }
}