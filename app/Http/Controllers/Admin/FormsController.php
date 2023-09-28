<?php

namespace App\Http\Controllers\Admin;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateAplicacionRequest;
use App\Http\Requests\Admin\StoreAplicacionRequest;
use App\Http\Requests\Admin\StoreFormulariosRequest;

class FormsController extends Controller
{
    /**
     * Display a listing of User.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        if (! Gate::allows('gestion_usuarios')) {
            return abort(401);
        }
        $forms = DB::table('Preguntas')->where('Formulario_idFormulario', $id)->orderBy('Orden', 'asc')->get();
        $formularios = DB::table('Formulario')->where('idFormulario', $id)->select('Formulario.Programa_idPrograma')->get();

        return view('admin.forms.index', compact('forms','formularios','id'));
    }

    public function indextwo($id)
    {
        if (! Gate::allows('gestion_usuarios')) {
            return abort(401);
        }
        $forms = DB::table('Preguntas')->where('Formulario_idFormulario', $id)->orderBy('Orden', 'asc')->get();
        $formularios = DB::table('Formulario')->where('idFormulario', $id)->select('Formulario.Programa_idPrograma')->get();

        return view('admin.forms.position', compact('forms','formularios','id'));
    }

    public function create($id,$idprograma)
    {
        if (! Gate::allows('gestion_usuarios')) {
            return abort(401);
        }
        return view('admin.forms.create', compact('id','idprograma'));
    }
   
       public function createtitulo($id,$idprograma)
    {
        if (! Gate::allows('gestion_usuarios')) {
            return abort(401);
        }
        return view('admin.forms.createtitulo', compact('id','idprograma'));
    }

    public function store(StoreAplicacionRequest $request)
    {
        if (! Gate::allows('gestion_usuarios')) {
            return abort(401);
        }
        if($request->titulo == true){
            $titulo = 1;
        }else{
            $titulo = 0;
        }
        $id = $request->id;
        $imagen = 0;
        if($request->imagen == true){
            $imagen = 1;
        }
        DB::table('Preguntas')->insert(['Formulario_idFormulario' => $id, 'Pregunta' => $request->Pregunta, 'Tipo_elemento_idTipo_elemento' => $request->respuesta, 'Titulo' => $titulo, 'Ayuda' => $request->Ayuda, 'Requerido' => $request->requerido, 'Valor' => $request->valor, 'Imagen' => $imagen, 'Opciones' => $request->opciones, 'Orden' => '0']);
        return redirect()->route('admin.formsindex', [$id]);
    }

    public function edit($idpregunta,$idprograma,$iduser)
    {
        if (! Gate::allows('gestion_usuarios')) {
            if (! (Gate::allows('evaluar_usuarios')||Gate::allows('auditar_usuarios')||Gate::allows('corporativo_usuarios'))) {
                return abort(401);
            }
        }
        $forms = DB::table('Preguntas')->where('idPreguntas', $idpregunta)->get();
        $respuestas = DB::table('Respuestas')->where(['Preguntas_idPreguntas' => $idpregunta, 'idusers' => $iduser])->get();

        return view('admin.forms.edit', compact('forms','respuestas','idpregunta','idprograma','iduser'));
    }

    public function update(UpdateAplicacionRequest $request, $id)
    {
        if (! Gate::allows('gestion_usuarios')) {
            return abort(401);
        }
        $formulario=$request->Formulario;

        $imagen = 0;
        if($request->imagen == true){
            $imagen = 1;
        }         
        if($request->titulo == true){
            $titulo = 1;
            DB::table('Preguntas')->where('idPreguntas', $id)->update(['Pregunta' => $request->Pregunta, 'Titulo' => $titulo, 'Ayuda' => $request->Ayuda, 'Requerido' => $request->requerido, 'Valor' => $request->requerido, 'Imagen' => $imagen, 'Opciones' => $request->opciones]);
        }else{
            $titulo = 0;
            DB::table('Preguntas')->where('idPreguntas', $id)->update(['Pregunta' => $request->Pregunta, 'Tipo_elemento_idTipo_elemento' => $request->respuesta, 'Titulo' => $titulo, 'Ayuda' => $request->Ayuda, 'Requerido' => $request->requerido, 'Valor' => $request->requerido, 'Imagen' => $imagen, 'Opciones' => $request->opciones]);
        }
 
        return redirect()->route('admin.formsindex', [$formulario]);
    }

    public function updatetwo(StoreFormulariosRequest $request, $id){
        for ($i=0; $i<=$request->idPrograma; $i++) {
            $pregunta = 'idPregunta'.$i;
            $contador = 'contador'.$i;
            DB::table('Preguntas')->where('idPreguntas', $request->$contador)->update(['Orden' =>  $i]);
        }
        return redirect()->route('admin.formsindex', [$id]);
    }

    public function updatethree(StoreFormulariosRequest $request,$zip){
        $explode_id = array_map('intval', explode(',', $zip));
        $idformulario = $explode_id[0];
        $idprograma = $explode_id[1];
        $iduser = $explode_id[2];
        $numFormularios = $explode_id[3];

        $s3 = \Storage::disk('s3')->url('Archivos');
        $images = DB::table('Biblioteca')->where('usuario', $iduser)->get();

        for($i=0; $i<$numFormularios; $i++){
            $idrespuesta = 'idrespuestas'.$i;
            $calificacion = 'calificacion'.$i;
            $comentario = 'comentario'.$i;
            DB::table('Respuestas')->where('idRespuestas', $request->$idrespuesta)->update(['calificacion' =>  $request->$calificacion, 'comentario' =>  $request->$comentario]);
        }

        $applications = DB::table('Preguntas')->where('Formulario_idFormulario', $idformulario)
        ->join('Respuestas', 'Preguntas.idPreguntas', '=', 'Respuestas.Preguntas_idPreguntas')
        ->join('users', function($join) use($iduser)
        {
            $join->on('Respuestas.idusers', '=', 'users.id')
                 ->where('users.id', '=', $iduser);
        })
        ->select('users.name', 'users.email', 'Preguntas.idPreguntas', 'Preguntas.Titulo', 'Preguntas.pregunta', 'Preguntas.Imagen', 'Respuestas.respuesta', 'Respuestas.comentario', 'Respuestas.calificacion','Respuestas.idRespuestas')->distinct()
        ->get();

        return view('preguntas.index', compact('applications','idprograma','iduser','images','s3','idformulario'));
    }

    public function updatefour(StoreFormulariosRequest $request,$zip){
        $explode_id = array_map('intval', explode(',', $zip));
        $idformulario = $explode_id[0];
        $idprograma = $explode_id[1];
        $iduser = $explode_id[2];
        $numFormularios = $explode_id[3];

        $s3 = \Storage::disk('s3')->url('Archivos');
        $images = DB::table('Biblioteca')->where('usuario', $iduser)->get();

        for($i=0; $i<$numFormularios; $i++){
            $idrespuesta = 'idrespuestas'.$i;
            $calificacion = 'calificacion'.$i;
            $validacion = 'validacion'.$i;
            DB::table('Respuestas')->where('idRespuestas', $request->$idrespuesta)->update(['calificacion' =>  $request->$calificacion, 'validacion' =>  $request->$validacion]);            
        }

        $applications = DB::table('Preguntas')->where('Formulario_idFormulario', $idformulario)
        ->join('Respuestas', 'Preguntas.idPreguntas', '=', 'Respuestas.Preguntas_idPreguntas')
        ->join('users', function($join) use($iduser)
        {
            $join->on('Respuestas.idusers', '=', 'users.id')
                 ->where('users.id', '=', $iduser);
        })
        ->select('users.name', 'users.email', 'Preguntas.idPreguntas', 'Preguntas.Titulo', 'Preguntas.pregunta', 'Preguntas.Imagen', 'Respuestas.respuesta', 'Respuestas.comentario', 'Respuestas.calificacion', 'Respuestas.validacion','Respuestas.idRespuestas')->distinct()
        ->get();

        return view('preguntas.index', compact('applications','idprograma','iduser','images','s3','idformulario'));
    }

    public function destroy($zip)
    {
        if (! Gate::allows('gestion_usuarios')) {
            return abort(401);
        }        
        $explode_id = array_map('intval', explode(',', $zip));
        $id = $explode_id[0];
        $idpregunta = $explode_id[1];
        DB::table('Preguntas')->where('idPreguntas', '=', $idpregunta)->delete();

        return redirect()->route('admin.formsindex',[$id]);
    }

    public function deletemultiple($zip)
    {
        if (! Gate::allows('gestion_usuarios')) {
            return abort(401);
        }        
        $explode_id = array_map('intval', explode(',', $zip));
        $idformulario = $explode_id[0];
        $idprograma = $explode_id[1];
        $id = $idformulario;
        
        DB::table('Respuestas')
        ->join('Preguntas', 'Respuestas.Preguntas_idPreguntas', '=', 'Preguntas.idPreguntas')
        ->join('Formulario', function($join) use($idformulario, $idprograma)
        {
            $join->on('Preguntas.Formulario_idFormulario', '=', 'Formulario.idFormulario')
                 ->where(['Formulario.idFormulario' => $idformulario, 'Formulario.Programa_idPrograma' => $idprograma]);
        })->delete();
        DB::table('Preguntas')->where('Formulario_idFormulario', '=', $idformulario)->delete();
        DB::table('Formulario')->where('idFormulario', '=', $idformulario)->delete();

        $formularios = DB::table('Formulario')->where('Programa_idPrograma', $idprograma)
            ->join('Programa', 'Formulario.Programa_idPrograma', '=', 'Programa.idPrograma')
            ->select('Formulario.idFormulario', 'Programa.nombre', 'Formulario.Programa_idPrograma')
            ->get();

        return view('formularios.index', compact('formularios','idprograma'));
    }
}