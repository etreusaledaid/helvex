<?php

namespace App\Http\Controllers\Admin;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreEmpresasRequest;
use App\Http\Requests\Admin\UpdateEmpresasRequest;

class EmpresasController extends Controller
{
    /**
     * Display a listing of User.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empresas = DB::table('empresa')->get();
        return view('admin.empresas.index', compact('empresas'));
    }

    public function create()
    {
        return view('admin.empresas.create');
    }
   
    public function store(StoreEmpresasRequest $request)
    {
        DB::table('empresa')->insert(['nombre' => $request->nombre, 'status' => $request->status]);
        return redirect()->route('admin.empresas.index');
    }

    public function edit($id)
    {
        $empresas = DB::table('empresa')->where('id',$id)->get();
        return view('admin.empresas.edit', compact('empresas'));
    }

    public function update(UpdateEmpresasRequest $request, $id)
    {
        DB::table('empresa')->where('id',$id)->update(['nombre' => $request->nombre, 'status' => $request->status]);
        return redirect()->route('admin.empresas.index');
    }

    public function destroy($id)
    {
        DB::table('empresa')->where('id', '=', $id)->delete();
        return redirect()->route('admin.empresas.index');
    }

}