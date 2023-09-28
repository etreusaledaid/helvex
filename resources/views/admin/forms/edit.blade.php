@extends('layouts.app')

@section('content')
    <h3 class="page-title">Edición de @lang('global.forms.title')</h3>

    @can('gestion_usuarios')
    <div class="panel panel-default">

        <div class="panel-body">
        @foreach ($forms as $form)
        {!! Form::model($forms, ['method' => 'PUT', 'route' => ['admin.forms.update', $form->idPreguntas]]) !!}
            <?php if(($form->Titulo)==1){?>
            <div class="row">
                <div class="col-md-4 form-group">
                    {!! Form::label('requerido', 'Requerido*', ['class' => 'control-label']) !!}
                    {!! Form::select('requerido', array('0' => 'No requerido', '1' => 'Requerido'), $form->Requerido) !!}
                    <p class="help-block"></p>
                    @if($errors->has('requerido'))
                        <p class="help-block">
                            {{ $errors->first('requerido') }}
                        </p>
                    @endif
                </div>
                <div class="col-md-4 form-group">
                    {!! Form::label('valor', 'Valor de la pregunta*', ['class' => 'control-label']) !!}
                    <input type="number" name="valor" placeholder="{{$form->Valor}}" onKeyPress="if(this.value.length==2) return false;" step="0.1" min="0" max="10">
                    <p class="help-block"></p>
                    @if($errors->has('valor'))
                        <p class="help-block">
                            {{ $errors->first('valor') }}
                        </p>
                    @endif
                </div>
                <div class="col-md-4 form-group">
                    <input class="form-control" type="text" name="id" value="{{ $idprograma }}" style="display: none;">
                    {!! Form::label('titulo', 'Titulo*', ['class' => 'control-label']) !!}
                    {!! Form::checkbox('titulo', '1', 'value'); !!}
                    <p class="help-block"></p>
                    @if($errors->has('Titulo'))
                        <p class="help-block">
                            {{ $errors->first('Titulo') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">   
                <div class="col-xs-12 form-group">
                    {!! Form::label('titulo', 'Titulo*', ['class' => 'control-label']) !!}
                    <input class="form-control" type="text" name="Formulario" value="{{ $form->Formulario_idFormulario }}" style="display: none;">
                    <input class="form-control" type="text" name="Pregunta" value="{{ $form->Pregunta }}">
                    <p class="help-block"></p>
                    @if($errors->has('Pregunta'))
                        <p class="help-block">
                            {{ $errors->first('Pregunta') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">   
                <div class="col-xs-12 form-group">
                    {!! Form::label('Ayuda', 'Ayuda*', ['class' => 'control-label']) !!}
                    <textarea class="form-control" name="Ayuda" style="resize: none;">{{ $form->Ayuda }}</textarea>
                    <p class="help-block"></p>
                    @if($errors->has('Ayuda'))
                        <p class="help-block">
                            {{ $errors->first('Ayuda') }}
                        </p>
                    @endif
                </div>
            </div>
            <?php }else{?>
            <div class="row">
                <div class="col-md-4 form-group">
                    {!! Form::label('requerido', 'Requerido*', ['class' => 'control-label']) !!}
                    {!! Form::select('requerido', array('0' => 'No requerido', '1' => 'Requerido'), $form->Requerido) !!}
                    <p class="help-block"></p>
                    @if($errors->has('requerido'))
                        <p class="help-block">
                            {{ $errors->first('requerido') }}
                        </p>
                    @endif
                </div>
                <div class="col-md-4 form-group">
                    {!! Form::label('valor', 'Valor*', ['class' => 'control-label']) !!}
                    <input type="number" name="valor" value="{{$form->Valor}}" onKeyPress="if(this.value.length==2) return false;" step="0.1" min="0" max="10">
                    <p class="help-block"></p>
                    @if($errors->has('valor'))
                        <p class="help-block">
                            {{ $errors->first('valor') }}
                        </p>
                    @endif
                </div>
                <div class="col-md-4 form-group">
                    <input class="form-control" type="text" name="id" value="{{ $idprograma }}" style="display: none;">
                    {!! Form::label('titulo', 'Titulo*', ['class' => 'control-label']) !!}
                    {!! Form::checkbox('titulo', 'value'); !!}
                    <p class="help-block"></p>
                    @if($errors->has('Titulo'))
                        <p class="help-block">
                            {{ $errors->first('Titulo') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('pregunta', 'Pregunta*', ['class' => 'control-label']) !!}
                    <input class="form-control" type="text" name="Formulario" value="{{ $form->Formulario_idFormulario }}" style="display: none;">
                    <input class="form-control" type="text" name="Pregunta" value="{{ $form->Pregunta }}">
                    <p class="help-block"></p>
                    @if($errors->has('Pregunta'))
                        <p class="help-block">
                            {{ $errors->first('Pregunta') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">   
                <div class="col-xs-12 form-group">
                    {!! Form::label('respuesta', 'Tipo de respuesta*', ['class' => 'control-label']) !!}
                    {!! Form::select('respuesta', array(1 => 'Sin respuesta es titulo',2 => 'Campo de texto', 3 => 'Area de texto', 4 => 'Select', 5 => 'Combo', 6 => 'Númerico'), $form->Tipo_elemento_idTipo_elemento, array('id' => 'id_element')) !!}
                    <p class="help-block"></p>
                    @if($errors->has('Respuesta'))
                        <p class="help-block">
                            {{ $errors->first('Respuesta') }}
                        </p>
                    @endif
                </div>
            </div>
            <?php $display = 'display:none;'; if(($form->Tipo_elemento_idTipo_elemento == 4) || ($form->Tipo_elemento_idTipo_elemento == 5)){$display = 'display:block;';}?>
            <div id="array_element" class="row" style="<?php echo $display;?>">
                <label class="col-xs-12 form-group">Añadir los elementos separados por una coma, ejemplo: uno, dos, tres</label>
                <div class="col-xs-12 form-group">
                    <input class="form-control" type="text" name="opciones" value="{{ $form->Opciones }}">
                </div>
            </div>          
            <div class="row">   
                <div class="col-xs-12 form-group">
                    {!! Form::label('imagen', 'Con adjunto*', ['class' => 'control-label']) !!}
                    <?php $bool=false; if($form->Imagen == 1){$bool=true;}?>
                    {!! Form::checkbox('imagen', '{{$form->Imagen}}', $bool); !!}
                    <p class="help-block"></p>
                    @if($errors->has('Imagen'))
                        <p class="help-block">
                            {{ $errors->first('Imagen') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">   
                <div class="col-xs-12 form-group">
                    {!! Form::label('Ayuda', 'Texto de ayuda*', ['class' => 'control-label']) !!}
                    <textarea class="form-control" name="Ayuda" style="resize: none;">{{ $form->Ayuda }}</textarea>
                    <p class="help-block"></p>
                    @if($errors->has('Ayuda'))
                        <p class="help-block">
                            {{ $errors->first('Ayuda') }}
                        </p>
                    @endif
                </div>
            </div>
            <?php }?>       
            @endforeach
        </div>
    </div>

    {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-success']) !!}
    {!! Form::close() !!}
    <script type="text/javascript">
        document.getElementById("id_element").onchange = function(e) {
            var div_select = document.getElementById("array_element");
            if((this[this.selectedIndex].text == "Select") || this[this.selectedIndex].text == "Combo"){
                div_select.style.display = "block";
            }else{
                div_select.style.display = "none";
            }
        };
    </script>
    @foreach ($forms as $formulario)
        <a class="btn btn-danger left-space-startupmexico" href="{{ url('admin/forms',['id' => $formulario->Formulario_idFormulario]) }}">@lang('global.app_cancel')</a>
    @endforeach
    @endcan

    @can('evaluar_usuarios')
    @foreach ($forms as $formulario)
        <?php $zip=$formulario->Formulario_idFormulario.",".$idprograma.",".$iduser;?>
    @endforeach
    {!! Form::model($respuestas, ['method' => 'PATCH', 'route' => ['admin.forms.updatethree',$zip]]) !!}   
    @foreach ($respuestas as $respuesta)
    <div class="panel panel-default">
        <input class="form-control" type="text" name="idrespuesta" value="{{ $respuesta->idRespuestas }}" style="display: none;">
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('calificacion', 'Calificación*', ['class' => 'control-label']) !!}
                    <input type="number" name="calificacion" value="{{$respuesta->calificacion}}" onKeyPress="if(this.value.length==2) return false;" step="0.1" min="0" max="10">
                    <p class="help-block"></p>
                    @if($errors->has('calificacion'))
                        <p class="help-block">
                            {{ $errors->first('calificacion') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">   
                <div class="col-xs-12 form-group">
                    {!! Form::label('comentario', 'Comentario*', ['class' => 'control-label']) !!}
                    <textarea class="form-control" name="comentario" style="resize: none;">{{ $respuesta->comentario }}</textarea>
                    <p class="help-block"></p>
                    @if($errors->has('comentario'))
                        <p class="help-block">
                            {{ $errors->first('comentario') }}
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endforeach
    {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-success']) !!}
    {!! Form::close() !!}
    @foreach ($forms as $formulario)
        <a class="btn btn-danger left-space-startupmexico" href="{{ url('admin/preguntas',['idformulario' => $formulario->Formulario_idFormulario, 'idprograma' => $idprograma, 'iduser' => $iduser]) }}">@lang('global.app_cancel')</a>
    @endforeach
    @endcan

    @can('auditar_usuarios')
    @foreach ($forms as $formulario)
        <?php $zip=$formulario->Formulario_idFormulario.",".$idprograma.",".$iduser;?>
    @endforeach
    {!! Form::model($respuestas, ['method' => 'PATCH', 'route' => ['admin.forms.updatefour',$zip]]) !!}   
    @foreach ($respuestas as $respuesta)
    <div class="panel panel-default">
        <input class="form-control" type="text" name="idrespuesta" value="{{ $respuesta->idRespuestas }}" style="display: none;">
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('calificacion', 'Calificación*', ['class' => 'control-label']) !!}
                    <input type="number" name="calificacion" value="{{$respuesta->calificacion}}" onKeyPress="if(this.value.length==2) return false;" step="0.1" min="0" max="10">
                    <p class="help-block"></p>
                    @if($errors->has('calificacion'))
                        <p class="help-block">
                            {{ $errors->first('calificacion') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">   
                <div class="col-xs-12 form-group">
                    {!! Form::label('validacion', 'Validación*', ['class' => 'control-label']) !!}
                    {!! Form::select('validacion', array(0 => 'No',1 => 'Si'), $respuesta->validacion) !!}
                    <p class="help-block"></p>
                    @if($errors->has('validacion'))
                        <p class="help-block">
                            {{ $errors->first('validacion') }}
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endforeach
    {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-success']) !!}
    {!! Form::close() !!}
    @foreach ($forms as $formulario)
        <a class="btn btn-danger left-space-startupmexico" href="{{ url('admin/preguntas',['idformulario' => $formulario->Formulario_idFormulario, 'idprograma' => $idprograma, 'iduser' => $iduser]) }}">@lang('global.app_cancel')</a>
    @endforeach
    @endcan

@stop