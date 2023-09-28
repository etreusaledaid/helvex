<?php
namespace App\Http\Controllers\Admin;

use DB;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreProgramsRequest;
use App\Http\Requests\Admin\UpdateProgramsRequest;


class ProgramsController extends Controller
{
    /**
     * Display a listing of User.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('gestion_usuarios')) {
            return abort(401);
        }

        $program = DB::table('Programa')->get();

        $programs = $program;

        return view('admin.programs.index', compact('programs'));
    }

    public function create()
    {
        if (! Gate::allows('gestion_usuarios')) {
            return abort(401);
        }
        return view('admin.programs.create');
    }
   
    public function store(StoreProgramsRequest $request)
    {
        if (! Gate::allows('gestion_usuarios')) {
            return abort(401);
        }
        DB::table('Programa')->insert(['nombre' => $request->nombre, 'fecha_lanzamiento' => $request->fecha_lanzamiento, 'inicio_uno' => $request->inicio_uno, 'cierre_uno' => $request->cierre_uno, 'inicio_dos' => $request->inicio_dos, 'cierre_dos' => $request->cierre_dos, 'fecha_cierre' => $request->fecha_cierre, 'fecha_premiacion' => $request->fecha_premiacion]);

        $formsall = null;
        $userId = Auth::id();
        $programs = DB::table('Programa')->get();
        $applications = DB::table('Aplicacion')->where('idusers', $userId)
            ->join('Formulario', 'Aplicacion.Programa_idPrograma', '=', 'Formulario.Programa_idPrograma')            
            ->select('Formulario.idFormulario', 'Aplicacion.idAplicacion', 'Aplicacion.empresa', 'Aplicacion.estatus', 'Aplicacion.Programa_idPrograma')
            ->get();
        $aplican = DB::table('Aplicacion')->get();
        $aplicantes = count($aplican);
        return view('home', compact('programs','applications','formsall','aplicantes'));
    }

    public function edit($id)
    {
        if (! Gate::allows('gestion_usuarios')) {
            return abort(401);
        }
        $programs = DB::table('Programa')->where('idPrograma', $id)->get();
        return view('admin.programs.edit', compact('programs'));
    }

    public function update(UpdateProgramsRequest $request, $id)
    {
        if (! Gate::allows('gestion_usuarios')) {
            return abort(401);
        }
        DB::table('Programa')->where('idPrograma', $id)->update(['nombre' => $request->nombre, 'fecha_lanzamiento' => $request->fecha_lanzamiento, 'inicio_uno' => $request->inicio_uno, 'cierre_uno' => $request->cierre_uno, 'inicio_dos' => $request->inicio_dos, 'cierre_dos' => $request->cierre_dos, 'fecha_cierre' => $request->fecha_cierre, 'fecha_premiacion' => $request->fecha_premiacion]);

        $programs = DB::table('Programa')->where('idPrograma', $id)->get();
        return view('admin.programs.edit', compact('programs'));
    }

    public function destroy($id)
    {
        if (! Gate::allows('gestion_usuarios')) {
            return abort(401);
        }

        $aplicantes = DB::table('Aplicacion')->where('Programa_idPrograma', $id)->get();
        $formularios = DB::table('Formulario')->where('Programa_idPrograma', $id)->get();

        if(count($aplicantes) > 0){
            echo "<script>alert('Tienes ".count($aplicantes)." participando, se requiere que no exista ningún participante para eliminar el programa.');</script>";
            return redirect()->back();
        }else if(count($formularios) > 0){
            echo "<script>alert('Tienes ".count($formularios)." formulario, se requiere que no exista ningún formulario.');</script>";
            return redirect()->back();
        }else{
            $formsall = null;
            $userId = Auth::id();
            $programs = DB::table('Programa')->get();
            $applications = DB::table('Aplicacion')->where('idusers', $userId)
                ->join('Formulario', 'Aplicacion.Programa_idPrograma', '=', 'Formulario.Programa_idPrograma')            
                ->select('Formulario.idFormulario', 'Aplicacion.idAplicacion', 'Aplicacion.empresa', 'Aplicacion.estatus', 'Aplicacion.Programa_idPrograma')
                ->get();
            $aplican = DB::table('Aplicacion')->get();
            $aplicantes = count($aplican);

            DB::table('Landing')->where('Programa_idPrograma', $id)->delete();
            DB::table('Biblioteca')->where('programa', $id)->delete();
            DB::table('Programa')->where('idPrograma', $id)->delete();

            return redirect()->back();
        }
    }

}