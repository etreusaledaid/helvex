<?php

namespace App\Http\Controllers\Admin;

use DB;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;

class BibliotecaController extends Controller
{
    /**
     * Display a listing of User.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $s3 = \Storage::disk('s3')->url('Archivos');
        $userId = Auth::id();
        $usuarios = DB::table('Biblioteca')
        ->join('users', 'Biblioteca.usuario', '=', 'users.id')
        ->select('Biblioteca.usuario','users.name')->distinct()
        ->get();

        $archivos = DB::table('Biblioteca')->where('usuario', $userId)
        ->join('Programa', 'Biblioteca.programa', '=', 'Programa.idPrograma')
        ->join('Preguntas', 'Biblioteca.pregunta', '=', 'Preguntas.idPreguntas')
        ->select('Biblioteca.usuario','Biblioteca.formulario','Biblioteca.pregunta','Biblioteca.archivo','Programa.nombre','Preguntas.Pregunta')
        ->get();

        $formsall = null;

        return view('admin.biblioteca.index',compact('userId','usuarios','archivos','s3','formsall'));
    }

    public function detalle($id)
    {
        $s3 = \Storage::disk('s3')->url('Archivos');
        $archivos = DB::table('Biblioteca')->where('usuario', $id)
        ->join('Programa', 'Biblioteca.programa', '=', 'Programa.idPrograma')
        ->join('Preguntas', 'Biblioteca.pregunta', '=', 'Preguntas.idPreguntas')
        ->select('Biblioteca.usuario','Biblioteca.formulario','Biblioteca.pregunta','Biblioteca.archivo','Programa.nombre','Preguntas.Pregunta')
        ->get();
        return view('admin.biblioteca.detalle',compact('id','archivos','s3'));
    }

    public function create()
    {
    }
   
    public function store(request $request)
    {
    }

    public function edit($id)
    {
    }

    public function update(request $request)
    {
    }

    public function destroy($id)
    {
    }

}