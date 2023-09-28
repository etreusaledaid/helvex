<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\User;
use Mail;

class RespuestasController extends Controller
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
    public function index($idformulario,$idprograma,$iduser)
    {        
        if (! Gate::allows('gestion_usuarios')) {
            if (! (Gate::allows('evaluar_usuarios')||Gate::allows('auditar_usuarios')||Gate::allows('corporativo_usuarios'))) {
                return abort(401);
            }
        }
        $s3 = \Storage::disk('s3')->url('Archivos');
        $applications = DB::table('Preguntas')->where('Formulario_idFormulario', $idformulario)
            ->join('Respuestas', 'Preguntas.idPreguntas', '=', 'Respuestas.Preguntas_idPreguntas')
            ->join('users', function($join) use($iduser)
            {
                $join->on('Respuestas.idusers', '=', 'users.id')
                     ->where('users.id', '=', $iduser);
            })
            ->select('users.name', 'users.email', 'Preguntas.idPreguntas', 'Preguntas.Titulo', 'Preguntas.pregunta', 'Preguntas.Imagen', 'Respuestas.respuesta', 'Respuestas.comentario', 'Respuestas.calificacion', 'Respuestas.validacion','Respuestas.idRespuestas')->distinct()
            ->get();
        $images = DB::table('Biblioteca')->where('usuario', $iduser)->get();

        return view('preguntas.index', compact('applications','idprograma','iduser','s3','images','idformulario'));
    }

    public function mandar($zip){
        //$explode_id = array_map('intval', explode(',', $zip));
        $explode_id = array_map('floatval', explode(',', $zip));
        $suma = $explode_id[0];
        $userId = $explode_id[1];
        $user = User::findOrFail($userId);

        Mail::send('emails.calificacion', ['user' => $user, 'suma' => $suma], function ($m) use ($user,$suma) {
            $m->from('no-reply@site.com', 'Evaluación de formulario');

            $m->to($user->email, $user->name, $suma)->subject('Evaluación enviada');
        });

        /*return redirect()
        ->back();*/
        $idprograma = 1;
        $iduser = $userId;
        $formularios = DB::table('Formulario')->where('Programa_idPrograma', $idprograma)
        ->join('Programa', 'Formulario.Programa_idPrograma', '=', 'Programa.idPrograma')
        ->select('Formulario.idFormulario', 'Programa.nombre', 'Formulario.Programa_idPrograma')
        ->get();
        $user = DB::table('users')->where('id', $iduser)->get();

        return view('formularios.indextwo', compact('formularios','idprograma','iduser','user'));

    }

}