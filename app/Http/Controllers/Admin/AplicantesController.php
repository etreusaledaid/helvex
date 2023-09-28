<?php

namespace App\Http\Controllers\Admin;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreApplicationsRequest;
use App\Http\Requests\Admin\UpdateApplicationsRequest;

class AplicantesController extends Controller
{
    /**
     * Display a listing of User.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($idprograma)
    {
        if (! Gate::allows('gestion_usuarios')) {
            return abort(401);
        }

        $applications =  DB::table('Aplicacion AS a')
        ->select(
          'e.nombre as empresa',
          'a.estatus',
          'a.idusers', 
          'a.idAplicacion',
          'u.name',
          'u.email'
        )
        ->join('users as u', 'a.idusers', '=', 'u.id')
        ->join('empresa as e', 'u.empresa_id', '=', 'e.id')
        ->where('a.Programa_idPrograma', $idprograma)
        ->get();

        return view('admin.aplicantes.index', compact('applications','idprograma'));
    }

    public function create()
    {
        if (! Gate::allows('gestion_usuarios')) {
            return abort(401);
        }
        return view('admin.aplicantes.create');
    }
   
    public function store(StoreApplicationsRequest $request)
    {
        if (! Gate::allows('gestion_usuarios')) {
            return abort(401);
        }
        DB::table('Aplicacion')->insert(['lugar' => $request->empresa, 'estatus' => $request->estatus]);
        return redirect()->route('admin.aplicantes.index');
    }

    public function edit($id)
    {
        if (! Gate::allows('gestion_usuarios')) {
            return abort(401);
        }
        $applications = DB::table('Aplicacion')->where('idAplicacion', $id)->get();
        return view('admin.aplicantes.edit', compact('applications'));
    }

    public function update(UpdateApplicationsRequest $request, $id)
    {
        if (! Gate::allows('gestion_usuarios')) {
            return abort(401);
        }
        DB::table('Aplicacion')->where('idAplicacion', $id)->update(['lugar' => $request->lugar, 'fecha_inicio' => $request->fecha_inicio, 'fechas' => $request->fechas, 'estatus' => $request->estatus]);
        return redirect()->route('admin.aplicantes.index');
    }

    public function destroy($zip)
    {
        if (! Gate::allows('gestion_usuarios')) {
            return abort(401);
        }        
        
        $explode_id = array_map('intval', explode(',', $zip));
        $id = $explode_id[0];
        $idprograma = $explode_id[1];

        $aplicacion = DB::table('Aplicacion')->where('idAplicacion', '=', $id)->delete();

        /*try{
            $message = "try";
            echo "<script type='text/javascript'>alert('$message');</script>";
        } 
        catch(\Exception $aplicacion){
            $message = "catch";
            echo "<script type='text/javascript'>alert('$message');</script>";
        }*/
        //$applications = DB::table('Aplicacion')->where('Programa_idPrograma', '=', $idprograma)->get();
        $applications =  DB::table('Aplicacion AS a')
        ->select(
          'e.nombre as empresa',
          'a.estatus',
          'a.idusers', 
          'a.idAplicacion',
          'u.name',
          'u.email'
        )
        ->join('users as u', 'a.idusers', '=', 'u.id')
        ->join('empresa as e', 'u.empresa_id', '=', 'e.id')
        ->where('a.Programa_idPrograma', $idprograma)
        ->get();

        return view('admin.aplicantes.index', compact('applications','idprograma'));
        //return redirect()->route('admin.aplicantes.index', [$idprograma]);
    }

}