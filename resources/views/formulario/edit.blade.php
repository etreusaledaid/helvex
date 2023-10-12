@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.forms.title')</h3>   

    <?php $formulario=null;?>
    @foreach ($formsall as $formall)
        <a class="btn btn-xs btn-success" href="{{ url('admin/formulario',['idformulario' => $formall->idFormulario, 'idprograma' => $idprograma]) }}">@lang('global.app_return')</a>
        <?php $formulario=$formall->idFormulario;?>
    @endforeach
    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_edit')
        </div>
        <div class="panel-body">
        @foreach ($forms as $form)
        {!! Form::open(['method' => 'POST', 'route' => ['admin.formulario.updates'], 'files' => true]) !!}
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('respuesta', 'Respuesta*', ['class' => 'control-label']) !!}
                    <input type="text" name="Formulario" value="{{ $form->idRespuestas }}" readonly hidden>
                    <input type="text" name="idprograma" value="{{ $idprograma }}" readonly hidden>
                    <input type="text" name="imagen" value="{{ $imagen }}" readonly hidden>
                    <input type="text" name="idpregunta" value="{{ $idPregunta }}" readonly hidden>
                    <input type="text" name="usId" value="{{ $usId }}" readonly hidden>
                    <?php if(($form->Requerido)==1){?>
                        <?php if(($form->Tipo_elemento_idTipo_elemento)==2){?>
                            <input class="form-control" type="text" name="Respuesta" placeholder="" required="" value="{{ $form->Respuesta }}">
                        <?php }else if(($form->Tipo_elemento_idTipo_elemento)==3){ ?>
                            <textarea class="form-control" name="Respuesta" style="resize: none;" required="">{{ $form->Respuesta }}</textarea>
                        <?php }else if(($form->Tipo_elemento_idTipo_elemento)==4){ ?>
                            <select name="opciones" required="">
                                <?php
                                $opciones = explode(",", $form->Opciones);
                                $elementos = substr_count($form->Opciones, ",");
                                $selected = "";
                                for ($i = 0; $i <= ($elementos); $i++) {
                                    if($opciones[$i] == $form->Respuesta){$selected="selected";}else{$selected="";}?>
                                    <option value="<?php echo $opciones[$i]; ?>" <?php echo $selected;?>><?php echo $opciones[$i]; ?></option>
                                <?php } 
                                ?>
                            </select>                                                
                        <?php }else if(($form->Tipo_elemento_idTipo_elemento)==5){ ?>
                                <input id="check" class="form-control" type="text" name="Respuesta" value="{{ $form->Respuesta }}" style="display: none;">
                                <?php
                                $opciones = explode(",", $form->Opciones);
                                $elementos = substr_count($form->Opciones, ",");
                                $checked = "";
                                for ($i = 0; $i <= ($elementos); $i++) {
                                    if($opciones[$i] == $form->Respuesta){$checked="checked";}else{$checked="";}?>
                                    <input id="checkbox<?php echo $opciones[$i]?>" type="checkbox" name="Respuestas" value="<?php echo $opciones[$i]; ?>" <?php echo $checked;?> onclick="validate<?php echo $i;?>()"><?php echo $opciones[$i]; ?>
                                    <script type=text/javascript>
                                        function validate<?php echo $i;?>(){
                                            if (document.getElementById('checkbox<?php echo $opciones[$i]?>').checked){
                                                var text = document.getElementById('check');
                                                text.value += <?php echo "'".$opciones[$i].",'";?>;
                                            }else{
                                                var text = document.getElementById('check');
                                                text.value = text.value.replace(<?php echo "'".$opciones[$i].",'";?>, "");;
                                            }
                                        }
                                        function checked(word,texto){
                                            var texto = document.getElementById('check').value;
                                            var word = '<?php echo $opciones[$i];?>';
                                            var checked = texto.split(',').some(function(w){return w === word});
                                            if(checked == true){
                                                document.getElementById("checkbox<?php echo $opciones[$i]?>").checked = true;
                                            }
                                        }
                                        checked();
                                    </script>
                                <?php } 
                            } ?>
                    <?php }else{?>
                        <?php if(($form->Tipo_elemento_idTipo_elemento)==2){?>
                            <input class="form-control" type="text" name="Respuesta" placeholder="" value="{{ $form->Respuesta }}">
                        <?php }else if(($form->Tipo_elemento_idTipo_elemento)==3){ ?>
                            <textarea class="form-control" name="Respuesta" style="resize: none;">{{ $form->Respuesta }}</textarea>
                        <?php }else if(($form->Tipo_elemento_idTipo_elemento)==4){ ?>
                            <select name="Respuesta">
                                <?php
                                $opciones = explode(",", $form->Opciones);
                                $elementos = substr_count($form->Opciones, ",");
                                $selected = "";
                                for ($i = 0; $i <= ($elementos); $i++) {
                                    if($opciones[$i] == $form->Respuesta){$selected="selected";}else{$selected="";}?>                                
                                    <option value="<?php echo $opciones[$i]; ?>" <?php echo $selected;?>><?php echo $opciones[$i]; ?></option>
                                <?php } 
                                ?>
                            </select>
                        <?php }else if(($form->Tipo_elemento_idTipo_elemento)==5){ ?>
                                <input id="check" class="form-control" type="text" name="Respuesta" value="{{ $form->Respuesta }}" >
                                <?php
                                $opciones = explode(",", $form->Opciones);
                                $elementos = substr_count($form->Opciones, ",");
                                $checked = "";
                                for ($i = 0; $i <= ($elementos); $i++) {
                                    if($opciones[$i] == $form->Respuesta){$checked="checked";}else{$checked="";}?>
                                    <input id="checkbox<?php echo $opciones[$i]?>" type="checkbox" name="Respuestas" value="<?php echo $opciones[$i]; ?>" <?php echo $checked;?> onclick="validate<?php echo $i;?>()"><?php echo $opciones[$i]; ?>
                                    <script type=text/javascript>
                                        function validate<?php echo $i;?>(){
                                            if (document.getElementById('checkbox<?php echo $opciones[$i]?>').checked){
                                                var text = document.getElementById('check');
                                                text.value += <?php echo "'".$opciones[$i].",'";?>;
                                            }else{
                                                var text = document.getElementById('check');
                                                text.value = text.value.replace(<?php echo "'".$opciones[$i].",'";?>, "");;
                                            }
                                        }
                                        function checked(word,texto){
                                            var texto = document.getElementById('check').value;
                                            var word = '<?php echo $opciones[$i];?>';
                                            var checked = texto.split(',').some(function(w){return w === word});
                                            if(checked == true){
                                                document.getElementById("checkbox<?php echo $opciones[$i]?>").checked = true;
                                            }
                                        }
                                        checked();
                                    </script>
                                <?php } 
                            } ?>
                    <?php } ?>
                    <p class="help-block"></p>
                    @if($errors->has('Respuesta'))
                        <p class="help-block">
                            {{ $errors->first('Respuesta') }}
                        </p>
                    @endif
                    <?php if(($imagen)==1){?>
                        @if(count($images) > 0)
                            @foreach ($images as $image)
                            <?php if($image->pregunta == $idPregunta){ ?>
                                <input type="text" name="anterior" value="{{$image->archivo}}" readonly hidden>
                                <input type="text" name="idformulario" value="{{$formulario}}" readonly hidden>
                                <img id="file-image" src="{{$s3}}/{{$usId}}/{{$image->archivo}}" alt="" height="100%" width="100%" class="img-responsive" style="border: 1px solid #ddd" />
                                <input class="form-control" name="image" type="file" accept="file_extension" onchange="readURL(this)" multiple="false">
                            <?php }?>
                            @endforeach
                        @else
                            <input type="text" name="anterior" value="" readonly hidden>
                            <input type="text" name="idformulario" value="{{$formulario}}" readonly hidden>
                            <img id="file-image" src="" alt="" height="100%" width="100%" class="img-responsive" style="border: 1px solid #ddd" />
                            <input class="form-control" name="image" type="file" accept="file_extension" onchange="readURL(this)" multiple="false">
                        @endif
                        <script type="text/javascript">
                            function readURL(input) {
                                if (input.files && input.files[0]) {
                                    var reader = new FileReader();            
                                    reader.onload = function (e) {
                                        $('#file-image').attr('src', e.target.result);
                                        var imgsrc = document.getElementById("file-image").src;
                                    }
                                    reader.readAsDataURL(input.files[0]);
                                }
                            }
                        </script>
                    <?php }?>
              </div>
            </div>   
            @endforeach
        </div>
    </div>
    {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-success']) !!}
    {!! Form::close() !!}
@stop