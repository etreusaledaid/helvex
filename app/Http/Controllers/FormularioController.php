<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateFormularioRequest;
use App\Http\Requests\Admin\StoreFormulariosRequest;
use Illuminate\Support\Facades\Validator;
use App\User;
use Mail;

class FormularioController extends Controller
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

    public function index($idformulario,$idprograma)
    {
        $direccion = 'No_formulario';
        $respuestas = 1;
        $userId = Auth::id();
        $empresa = "";
        $formulario = DB::table('Formulario')->where('idFormulario', $idformulario)->get();
        $formsall = DB::table('Formulario')->where('Programa_idPrograma', $idprograma)->get();
        $programa = DB::table('Programa')->where('idPrograma', $idprograma)->get();
        $preguntas = DB::table('Formulario')->where([['idFormulario',$idformulario],['Programa_idPrograma', $idprograma]])
        ->join('Preguntas', 'Formulario.idFormulario', '=', 'Preguntas.Formulario_idFormulario')
        ->join('Respuestas', function($join)
        {
            $usId = Auth::id();
            $join->on('Preguntas.idPreguntas', '=', 'Respuestas.Preguntas_idPreguntas')
                 ->where('Respuestas.idusers', '=', $usId);
        })
        ->select('Formulario.idFormulario', 'Preguntas.idPreguntas', 'Preguntas.Pregunta', 'Preguntas.Imagen', 'Respuestas.idRespuestas', 'Respuestas.Respuesta', 'Preguntas.Titulo', 'Respuestas.calificacion')
        ->get();

        if(count($preguntas) == 0){
            $preguntas = DB::table('Formulario')->where([['idFormulario',$idformulario],['Programa_idPrograma', $idprograma]])
                    ->join('Preguntas', 'Formulario.idFormulario', '=', 'Preguntas.Formulario_idFormulario')
                    ->select('Formulario.idFormulario','Preguntas.idPreguntas', 'Preguntas.Titulo', 'Preguntas.Valor', 'Preguntas.Imagen', 'Preguntas.Pregunta', 'Preguntas.Ayuda', 'Preguntas.Requerido', 'Preguntas.Tipo_elemento_idTipo_elemento', 'Preguntas.Opciones', 'Respuestas.calificacion')
                    ->get();
            $respuestas = 0;
            $direccion = 'formulario';
        }

        $applications = DB::table('Aplicacion')->where(['idusers' => $userId, 'Programa_idPrograma' => $idprograma])->get();

        $admin = DB::table('users')
        ->join('roles', function($join)
        {
            $usId = Auth::id();
            $join->on('users.id', '=', 'roles.id')
                 ->where('roles.name', '=', 'administrator');
        })->limit(1)->get();

        $user = DB::table('users')->where(['id' => $userId])->get();

        $aplicacion = DB::table('Aplicacion')
        ->where(['Aplicacion.Programa_idPrograma' => $idprograma, 'Aplicacion.idusers' => $userId])
        ->get();

        if(count($aplicacion) !== 0){
            $idempresa = $aplicacion[0]->empresa;
        }
        $empresas = DB::table('empresa')->where(['id' => $idempresa])->get();
        $empresa = $empresas[0]->nombre;

        return view('formulario.index', compact('direccion', 'preguntas', 'respuestas', 'formsall','formulario','idformulario','idprograma','applications','admin','user','programa','empresa'));
    }

    public function edit($zip)
    {
        $explode_id = array_map('intval', explode(',', $zip));
        $id = $explode_id[0];
        $idprograma = $explode_id[1];
        $imagen = $explode_id[2];
        $idPregunta = $explode_id[3];

        $usId = Auth::id();
        $s3 = \Storage::disk('s3')->url('Archivos');

        $forms = DB::table('Respuestas')->where('idRespuestas', $id)
        ->join('Preguntas', 'Respuestas.Preguntas_idPreguntas', '=', 'Preguntas.idPreguntas')
        ->get();
        $formsall = DB::table('Formulario')->where('Programa_idPrograma', $idprograma)->get();
        $preguntas = DB::table('Preguntas')->where('idPreguntas', $idPregunta)->get();
        $images = DB::table('Biblioteca')->where('usuario', $usId)->get();

        return view('formulario.edit', compact('forms','idprograma','formsall','imagen','idPregunta','usId','preguntas','images','s3'));
    }
    
    public function updates(UpdateFormularioRequest $request)
    {
        $id = $request->Formulario;
        $idprograma = $request->idprograma;
        $imagen = $request->imagen;
        $idPregunta = $request->idpregunta;
        $usId = $request->usId;

        $zip=$id.",".$idprograma.",".$imagen.",".$idPregunta.",".$usId;

        DB::table('Respuestas')->where('idRespuestas', $id)->update(['Respuesta' => $request->Respuesta]);
        
        $image = $request->file('image');
        
        if($image ==! ''){
            $imageFileName = time() . '.' . $image->getClientOriginalExtension();
            $s3 = \Storage::disk('s3');
            $filePath = '/Archivos/'.$usId.'/' . $imageFileName;
            $s3->put($filePath, file_get_contents($image), 'public');

            if($request->anterior == ""){
                DB::table('Biblioteca')->insert(['usuario' => $usId, 'programa' => $idprograma, 'formulario' => $id, 'pregunta' => $idPregunta, 'archivo' => $imageFileName]);
            }else{
                DB::table('Biblioteca')->where('archivo',$request->anterior)->update(['archivo' => $imageFileName]);
                if(\Storage::disk('s3')->exists('Archivos/'.$usId.'/'.$request->anterior)) {
                    \Storage::disk('s3')->delete('Archivos/'.$usId.'/'.$request->anterior);
                }
            }
        }

        return redirect()->route('admin.formularioedit', compact('zip'));
    }

    public function enviar(UpdateFormularioRequest $request, $zip)
    {
        $explode_id = array_map('intval', explode(',', $zip));
        $idaplicacion = $explode_id[0];
        $idformulario = $explode_id[1];
        $idprograma = $explode_id[2];
        $adminemail = $explode_id[3];
        $useremail = $explode_id[4];

        DB::table('Aplicacion')->where('idAplicacion', $idaplicacion)->update(['estatus' => 'ENVIADA']);
        $message = "Aplicación enviada.";
        echo "<script type='text/javascript'>alert('$message');</script>";

        $user = User::findOrFail($adminemail);
        $user2 = User::findOrFail($useremail);

        Mail::send('emails.confirmationadmin', ['user' => $user, 'user2' => $user2], function ($m) use ($user,$user2) {
            $m->from('no-reply@site.com', 'Formulario enviado');

            $m->to($user->email, $user->name)->subject($user2->email);
        });

        Mail::send('emails.confirmation', ['user' => $user2], function ($m) use ($user2) {
            $m->from('no-reply@site.com', 'Formulario enviado');

            $m->to($user2->email, $user2->name)->subject('Formulario enviado');
        });

        return redirect()->route('admin.formulario',[$idformulario,$idprograma]);
    }

    public function store(StoreFormulariosRequest $request)
    {
        $usId = Auth::id();
        $numero = $request->elementos;
        $idaplicacion = $request->idAplicacion;
        $idprograma = $request->idPrograma;
        $idformulario = $request->idformulario;

    if($request->direccion == "formulario"){
        for ($i=0; $i<$numero; $i++) { 
            $respuesta = 'respuesta'.$i;
            $idpreguntas = 'idpreguntas'.$i;
            DB::table('Respuestas')->insert(['idusers' => $usId, 'Respuesta' => $request->$respuesta, 'Preguntas_idPreguntas' => $request->$idpreguntas]);
            $image = $request->file('image'.$i);
            if($image ==! ''){
                $imageFileName = time() . '.' . $image->getClientOriginalExtension();
                $s3 = \Storage::disk('s3');
                $filePath = '/Archivos/'.$usId.'/' . $imageFileName;
                $s3->put($filePath, file_get_contents($image), 'public');
                DB::table('Biblioteca')->insert(['usuario' => $usId, 'programa' => $idprograma, 'formulario' => $idformulario, 'pregunta' => $request->$idpreguntas, 'archivo' => $imageFileName]);
            }
        }
    }else{
        for ($i=0; $i<$numero; $i++) {   
            $idpreguntas = 'idpreguntas'.$i;          
            $idrespuesta = 'idrespuesta'.$i;
            $respuesta = 'respuesta'.$i;
            DB::table('Respuestas')->where('idRespuestas', $request->$idrespuesta)->update(['Respuesta' => $request->$respuesta]);
            
            $image = $request->file('image'.$i);
            if($image ==! ''){                
                $anterior = 'anterior'.$i;
                $imageFileName = time() . '.' . $image->getClientOriginalExtension();
                $s3 = \Storage::disk('s3');
                $filePath = '/Archivos/'.$usId.'/' . $imageFileName;
                $s3->put($filePath, file_get_contents($image), 'public');

                if($request->$anterior == ""){
                    DB::table('Biblioteca')->insert(['usuario' => $usId, 'programa' => $idprograma, 'formulario' => $idformulario, 'pregunta' => $request->$idpreguntas, 'archivo' => $imageFileName]);
                }else{
                    DB::table('Biblioteca')->where('pregunta',$request->$idpreguntas)->update(['archivo' => $imageFileName]);
                    if(\Storage::disk('s3')->exists('Archivos/'.$usId.'/'.$request->$anterior)) {
                        echo "<script>console.log('aca2');</script>";
                        \Storage::disk('s3')->delete('Archivos/'.$usId.'/'.$request->$anterior);
                    }
                }
            }else{
                $file = 'file'.$i;
                $anterior = 'anterior'.$i;
                if($request->$file ==! ''){
                    DB::table('Biblioteca')->where('pregunta',$request->$idpreguntas)->update(['archivo' => $request->$file]);
                    if($request->$anterior == ""){
                        DB::table('Biblioteca')->insert(['usuario' => $usId, 'programa' => $idprograma, 'formulario' => $idformulario, 'pregunta' => $request->$idpreguntas, 'archivo' => $request->$file]);
                    }
                }
            }
        }
    }
    return redirect()->route('admin.formularioapp',[$idprograma]);
    }

    public function aplicacion($idprograma)
    {
        $formsall = null;
        $usId = Auth::id();
        $direccion = null;
        $s3 = \Storage::disk('s3')->url('Archivos');
        $nombreprograma = DB::table('Programa')->where('idPrograma', $idprograma)->get();
        $nombreprograma = $nombreprograma[0]->nombre;

        $usuario = DB::table('users')->where(['id' => $usId])->get();
        $empresa = DB::table('empresa')->where(['id' => $usuario[0]->empresa_id])->get();
        $direccion = "No_formulario";

        $applications = DB::table('Formulario')->where('Programa_idPrograma', $idprograma)
            ->join('Preguntas', 'Formulario.idFormulario', '=', 'Preguntas.Formulario_idFormulario')
            ->join('Respuestas', 'Preguntas.idPreguntas', '=', 'Respuestas.Preguntas_idPreguntas')
            ->select('Formulario.idFormulario','Preguntas.idPreguntas', 'Preguntas.Titulo', 'Preguntas.Valor', 'Preguntas.Imagen', 'Preguntas.pregunta', 'Preguntas.Ayuda', 'Preguntas.Requerido', 'Preguntas.Tipo_elemento_idTipo_elemento', 'Preguntas.Opciones', 'Respuestas.idRespuestas', 'Respuestas.Respuesta')
            ->get();

        $aplicacion = DB::table('Aplicacion')
        ->where(['Aplicacion.Programa_idPrograma' => $idprograma, 'Aplicacion.idusers' => $usId])
        ->get();

        if(count($aplicacion) !== 0){
            $idempresa = $aplicacion[0]->empresa;
            $empresa = DB::table('empresa')->where(['id' => $idempresa])->get();
            $idaplicacion = $aplicacion[0]->idAplicacion;
            $direccion = "No_formulario";

            $applications = DB::table('Formulario')
            ->join('Preguntas', 'Formulario.idFormulario', '=', 'Preguntas.Formulario_idFormulario')
            ->join('Respuestas', 'Preguntas.idPreguntas', '=', 'Respuestas.Preguntas_idPreguntas')
            ->where(['Formulario.Programa_idPrograma' => $idprograma, 'Respuestas.idusers' => $usId])
            ->select('Formulario.idFormulario','Preguntas.idPreguntas', 'Preguntas.Titulo', 'Preguntas.Valor', 'Preguntas.Imagen', 'Preguntas.pregunta', 'Preguntas.Ayuda', 'Preguntas.Requerido', 'Preguntas.Tipo_elemento_idTipo_elemento', 'Preguntas.Opciones', 'Respuestas.idRespuestas', 'Respuestas.Respuesta')
            ->orderBy('Preguntas.Orden', 'asc')
            ->get();
            if(count($applications) == 0){
                $direccion = "formulario";
                $applications = DB::table('Formulario')->where('Programa_idPrograma', $idprograma)
                    ->join('Preguntas', 'Formulario.idFormulario', '=', 'Preguntas.Formulario_idFormulario')
                    ->select('Formulario.idFormulario','Preguntas.idPreguntas', 'Preguntas.Titulo', 'Preguntas.Valor', 'Preguntas.Imagen', 'Preguntas.pregunta', 'Preguntas.Ayuda', 'Preguntas.Requerido', 'Preguntas.Tipo_elemento_idTipo_elemento', 'Preguntas.Opciones')
                    ->orderBy('Preguntas.Orden', 'asc')
                    ->get();                
            }
            $images = DB::table('Biblioteca')->where('usuario', $usId)->distinct()->get();
        }else{
            if (!is_array($aplicacion) || !$aplicacion || count($aplicacion)==0){
                DB::table('Aplicacion')->insert(['empresa' => $empresa[0]->id, 'estatus' => 'NO ENVIADA', 'Programa_idPrograma' => $idprograma, 'idusers' => $usId]);
                $aplicacion = DB::table('Aplicacion')->where(['Programa_idPrograma' => $idprograma, 'idusers' => $usId])->first();
                $idaplicacion = $aplicacion->idAplicacion;                
            }
            $direccion = "formulario";

            $applications = DB::table('Formulario')->where('Programa_idPrograma', $idprograma)
                ->join('Preguntas', 'Formulario.idFormulario', '=', 'Preguntas.Formulario_idFormulario')
                ->select('Formulario.idFormulario','Preguntas.idPreguntas', 'Preguntas.Titulo', 'Preguntas.Valor', 'Preguntas.Imagen', 'Preguntas.pregunta', 'Preguntas.Ayuda', 'Preguntas.Requerido', 'Preguntas.Tipo_elemento_idTipo_elemento', 'Preguntas.Opciones')
                ->orderBy('Preguntas.Orden', 'asc')
                ->get();
            $images = "";
        }

        return view('formulario.aplicacion', compact('applications','formsall','idprograma','idaplicacion','usId','direccion','images','s3','empresa','nombreprograma'));
    }

}