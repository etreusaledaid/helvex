<?php

namespace App\Http\Controllers\Admin;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreApplicationsRequest;
use App\Http\Requests\Admin\UpdateApplicationsRequest;

class ApplicationsController extends Controller
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
        $applications = DB::table('Aplicacion')->get();
        return view('admin.applications.index', compact('applications'));
    }

    public function create()
    {
        if (! Gate::allows('gestion_usuarios')) {
            return abort(401);
        }
        return view('admin.applications.create');
    }
   
    public function store(StoreApplicationsRequest $request)
    {
        if (! Gate::allows('gestion_usuarios')) {
            return abort(401);
        }
        DB::table('Aplicacion')->insert(['lugar' => $request->empresa, 'estatus' => $request->estatus]);
        return redirect()->route('admin.applications.index');
    }

    public function edit($id)
    {
        if (! Gate::allows('gestion_usuarios')) {
            return abort(401);
        }
        $applications = DB::table('Aplicacion')->where('idAplicacion', $id)->get();
        return view('admin.applications.edit', compact('applications'));
    }

    public function update(UpdateApplicationsRequest $request, $id)
    {
        if (! Gate::allows('gestion_usuarios')) {
            return abort(401);
        }
        DB::table('Aplicacion')->where('idAplicacion', $id)->update(['lugar' => $request->lugar, 'fecha_inicio' => $request->fecha_inicio, 'fechas' => $request->fechas, 'estatus' => $request->estatus]);
        return redirect()->route('admin.applications.index');
    }

    public function destroy($id)
    {
        if (! Gate::allows('gestion_usuarios')) {
            return abort(401);
        }        
        
        $aplicacion = DB::table('Aplicacion')->where('idAplicacion', '=', $id)->delete();

        /*try{
            $message = "try";
            echo "<script type='text/javascript'>alert('$message');</script>";
        } 
        catch(\Exception $aplicacion){
            $message = "catch";
            echo "<script type='text/javascript'>alert('$message');</script>";
        }*/

        return redirect()->route('admin.applications.index');
    }

}