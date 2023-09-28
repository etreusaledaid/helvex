@extends('layouts.app')

@section('content')
    <div class="row">
        {!! Form::open(['method' => 'POST', 'route' => ['admin.formulario.store'], 'id' => 'autoguardado', 'files' => true]) !!}
        <div class="panel-body table-responsive">
            <h2 style="margin-left: 8px;font-size: 18px;font-weight:bold;">{{$nombreprograma}}</h2><br>
            <label  class="letter" style="margin-left: 8px;color:#A3A3A3;">Nombre de la Institución: {{$empresa[0]->nombre}} <input type="text" name="empresa" value="{{$empresa[0]->id}}" readonly hidden> </label><br><br>
            
            <table class="table">                
                <tbody>
                    @if ($direccion == "No_formulario")
                        @if (count($applications) > 0)
                            <?php $bandera=""; $contador=0;$contador2=0;?>
                            <input class="form-control" type="text" name="direccion" value="{{$direccion}}" style="display: none;">
                            <input class="form-control" type="text" name="idAplicacion" value="{{ $idaplicacion }}" style="display: none;">
                            <input class="form-control" type="text" name="idPrograma" value="{{ $idprograma }}" style="display: none;">
                            <input class="form-control" type="text" name="elementos" value="{{count($applications)}}" style="display: none;">
                            @foreach ($applications as $application)
                                <tr data-entry-id="{{ $application->idPreguntas }}">
                                   
                                    <td style="display: none;"><input class="form-control" type="text" name="idpreguntas<?php echo $contador2;?>" value="{{ $application->idPreguntas }}"><input class="form-control" type="text" name="idrespuesta<?php echo $contador2;?>" value="{{$application->idRespuestas}}" style="display: none;"></td>
                                    <?php if(($application->Titulo)==1){?>
                                        <td style="font-weight: bold;border-style:none none dashed none;border-width:1.5px;border-color:#a3a3a3;font-size: 18px;">{{ $application->pregunta }}</td>
                                    <?php }else{?>
                                        <td style="text-transform: lowercase;color:#A3A3A3; width:500px;border-style: none;" class="letter" >{!! Form::label('pregunta', $application->pregunta, ['class' => 'letter']) !!}</td>
                                        <td style="width:50px;border-style: none">
                                            <?php if($application->Ayuda != null){?>
                                            <div class="modal fade" id="Modal{{ $application->idPreguntas }}" role="dialog" data-backdrop="false">
                                                <div class="modal-dialog">

                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title">Ayuda</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>{{ $application->Ayuda }}</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                                    </div>
                                                </div>

                                                </div>
                                            </div>
                                            <button style="text-align: center;line-height: 60px;" class="quet" type="button" data-toggle="modal" data-target="#Modal{{ $application->idPreguntas }}"><img src="/images/question.png" width="27px" height="27px"></button>
                                            <?php }else{}?>
                                        </td>
                                        <td style="color:#A3A3A3;width: 250px;border-style: none;/*cajas*/" class="letter">
                                            <?php if(($application->Requerido)==1){?>
                                                <?php if(($application->Tipo_elemento_idTipo_elemento)==2){?>
                                                    <input class="form-control letter" type="text" name="respuesta<?php echo $contador2;?>" placeholder="" required="" value="<?php echo $application->Respuesta?>">
                                                <?php }else if(($application->Tipo_elemento_idTipo_elemento)==3){ ?>
                                                    <textarea style="border-color: #a3a3a3" class="form-control" name="respuesta<?php echo $contador2;?>" style="resize: none;" required=""><?php echo $application->Respuesta?></textarea>
                                                <?php }else if(($application->Tipo_elemento_idTipo_elemento)==4){ ?>
                                                    <select name="respuesta<?php echo $contador2;?>" required="">
                                                        <?php
                                                        $opciones = explode(",", $application->Opciones);
                                                        $elementos = substr_count($application->Opciones, ",");
                                                        $selected = "";
                                                        for ($i = 0; $i <= ($elementos); $i++) {
                                                            if($opciones[$i] == $application->Respuesta){$selected="selected";}else{$selected="";}?>
                                                            <option value="<?php echo $opciones[$i]; ?>" <?php echo $selected;?>><?php echo $opciones[$i]; ?></option>
                                                        <?php } 
                                                        ?>
                                                    </select>                                                
                                                <?php } else if(($application->Tipo_elemento_idTipo_elemento)==5){ ?>
                                                    <input id="check<?php echo $application->Respuesta;?>" class="form-control" type="text" name="respuesta<?php echo $contador2;?>" value="{{ $application->Respuesta }}" style="display: none;">
                                                    <?php
                                                    $opciones = explode(",", $application->Opciones);
                                                    $elementos = substr_count($application->Opciones, ",");
                                                    $checked = "";
                                                    for ($i = 0; $i <= ($elementos); $i++) {
                                                        if($opciones[$i] == $application->Respuesta){$checked="checked";}else{$checked="";}?>
                                                        <input id="checkbox<?php echo $opciones[$i]?>" type="checkbox" name="Respuestas" style="margin:5px" value="<?php echo $opciones[$i]; ?>" <?php echo $checked;?> onclick="validate<?php echo $i;?>()"><?php echo $opciones[$i]; ?><br>
                                                        <script type=text/javascript>
                                                            function validate<?php echo $i;?>(){
                                                                if (document.getElementById('checkbox<?php echo $opciones[$i]?>').checked){
                                                                    var text = document.getElementById('check<?php echo $application->Respuesta;?>');
                                                                    text.value += <?php echo "'".$opciones[$i].",'";?>;
                                                                }else{
                                                                    var text = document.getElementById('check<?php echo $application->Respuesta;?>');
                                                                    text.value = text.value.replace(<?php echo "'".$opciones[$i].",'";?>, "");;
                                                                }
                                                            }
                                                            function checked(word,texto){
                                                                var texto = document.getElementById('check<?php echo $application->Respuesta;?>').value;
                                                                var word = '<?php echo $opciones[$i];?>';
                                                                var checked = texto.split(',').some(function(w){return w === word});
                                                                if(checked == true){
                                                                    document.getElementById("checkbox<?php echo $opciones[$i]?>").checked = true;
                                                                }
                                                            }
                                                            checked();
                                                        </script>
                                                <?php } }else if(($application->Tipo_elemento_idTipo_elemento)==6){ ?>
                                                    <input class="form-control letter" type="number" step="0.01" name="respuesta<?php echo $contador2;?>" required value="<?php echo $application->Respuesta?>">
                                                <?php }?>
                                            <?php }else{?>
                                                <?php if(($application->Tipo_elemento_idTipo_elemento)==2){?>
                                                    <input class="form-control" type="text" name="respuesta<?php echo $contador2;?>" placeholder="" value="<?php echo $application->Respuesta?>">
                                                <?php }else if(($application->Tipo_elemento_idTipo_elemento)==3){ ?>
                                                    <textarea style="border-color: #a3a3a3" class="form-control" name="respuesta<?php echo $contador2;?>" style="resize: none;"><?php echo $application->Respuesta?></textarea>
                                                <?php }else if(($application->Tipo_elemento_idTipo_elemento)==4){ ?>
                                                    <select name="respuesta<?php echo $contador2;?>">
                                                        <?php
                                                        $opciones = explode(",", $application->Opciones);
                                                        $elementos = substr_count($application->Opciones, ",");
                                                        $selected = "";
                                                        for ($i = 0; $i <= ($elementos); $i++) {
                                                            if($opciones[$i] == $application->Respuesta){$selected="selected";}else{$selected="";}?>
                                                            <option value="<?php echo $opciones[$i]; ?>" <?php echo $selected;?>><?php echo $opciones[$i]; ?></option>
                                                        <?php } 
                                                        ?>
                                                    </select>
                                                <?php }else if(($application->Tipo_elemento_idTipo_elemento)==5){ ?>
                                                    <input id="check<?php echo $application->Respuesta;?>" class="form-control" type="text" name="respuesta<?php echo $contador2;?>" value="{{ $application->Respuesta }}" style="display: none;">
                                                    <?php
                                                    $opciones = explode(",", $application->Opciones);
                                                    $elementos = substr_count($application->Opciones, ",");
                                                    $checked = "";
                                                    for ($i = 0; $i <= ($elementos); $i++) {
                                                        if($opciones[$i] == $application->Respuesta){$checked="checked";}else{$checked="";}?>
                                                        <input style="margin:7px; border-color:#a3a3a3" id="checkbox<?php echo $opciones[$i]?>" type="checkbox" name="Respuestas" value="<?php echo $opciones[$i]; ?>" <?php echo $checked;?> onclick="validate<?php echo $i;?>()"><?php echo $opciones[$i]; ?><br>
                                                        <script type=text/javascript>
                                                            function validate<?php echo $i;?>(){
                                                                if (document.getElementById('checkbox<?php echo $opciones[$i]?>').checked){
                                                                    var text = document.getElementById('check<?php echo $application->Respuesta;?>');
                                                                    text.value += <?php echo "'".$opciones[$i].",'";?>;
                                                                }else{
                                                                    var text = document.getElementById('check<?php echo $application->Respuesta;?>');
                                                                    text.value = text.value.replace(<?php echo "'".$opciones[$i].",'";?>, "");;
                                                                }
                                                            }
                                                            function checked(word,texto){
                                                                var texto = document.getElementById('check<?php echo $application->Respuesta;?>').value;
                                                                var word = '<?php echo $opciones[$i];?>';
                                                                var checked = texto.split(',').some(function(w){return w === word});
                                                                if(checked == true){
                                                                    document.getElementById("checkbox<?php echo $opciones[$i]?>").checked = true;
                                                                }
                                                            }
                                                            checked();
                                                        </script>
                                            <?php } }else if(($application->Tipo_elemento_idTipo_elemento)==6){?>
                                                <input class="form-control letter" type="number" step="0.01" name="respuesta<?php echo $contador2;?>" required value="<?php echo $application->Respuesta?>">
                                            <?php } } ?>
                                        </td>
                                        <td style="width: 150px; border-style: none">
                                            <?php if(($application->Imagen)==1){?>
                                            @if(count($images) > 0)
                                                <?php $bandera=0; ?>
                                                @foreach ($images as $image)
                                                <?php if($image->pregunta == $application->idPreguntas){ $bandera=1; ?>
                                                    <input type="text" name="anterior{{$contador2}}" value="{{$image->archivo}}" readonly hidden>
                                                    <input type="text" name="idformulario" value="{{$application->idFormulario}}" readonly hidden>
                                                    <input id="file{{$contador2}}" type="text" name="file{{$contador2}}" value="{{$image->archivo}}" readonly hidden>
                                                    <?php
                                                        $info = pathinfo($image->archivo);
                                                        if($info["extension"] == "pdf"){?>
                                                        <embed src="{{$s3}}/{{$usId}}/{{$image->archivo}}" height="100%" width="100%" class="img-responsive" style="border: 1px solid #ddd" type='application/pdf'>
                                                    <?php }else{?>
                                                        <img id="file-image{{$contador2}}" src="{{$s3}}/{{$usId}}/{{$image->archivo}}" alt="" height="100%" width="100%" class="img-responsive" style="border: 1px solid #ddd" />
                                                    <?php };
                                                    ?>
                                                    <!--input class="form-control" name="image{{$contador2}}" type="file" accept="file_extension" onchange="readURL{{$contador2}}(this)" multiple="false"-->
                                                <?php } ?>
                                                @endforeach
                                                <?php if($bandera==0){ ?>
                                                    <input type="text" name="anterior{{$contador2}}" value="" readonly hidden>
                                                    <input type="text" name="idformulario" value="{{$application->idFormulario}}" readonly hidden>
                                                    <input id="file{{$contador2}}" type="text" name="file{{$contador2}}" value="" readonly hidden>
                                                    <img id="file-image{{$contador2}}" src="" alt="" height="100%" width="100%" class="img-responsive" />
                                                <?php } ?>
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#imagenModal{{$contador2}}">
                                                        Subir documentos
                                                </button>  
                                            @else
                                                <input type="text" name="anterior{{$contador2}}" value="" readonly hidden>
                                                <input type="text" name="idformulario" value="{{$application->idFormulario}}" readonly hidden>
                                                <input id="file{{$contador2}}" type="text" name="file{{$contador2}}" value="" readonly hidden>
                                                <!--@foreach ($images as $image)
                                                <?php/*
                                                    $info = pathinfo($image->archivo);
                                                    if ($info["extension"] == "pdf"){?>
                                                        <embed src="{{$s3}}/{{$usId}}/{{$image->archivo}}" height="100%" width="100%" class="img-responsive" style="border: 1px solid #ddd" type='application/pdf'>
                                                    <?php }else{?>
                                                        <img id="file-image{{$contador2}}" src="{{$s3}}/{{$usId}}/{{$image->archivo}}" alt="" height="100%" width="100%" class="img-responsive" style="border: 1px solid #ddd" />
                                                    <?php };*/
                                                ?>
                                                @endforeach-->
                                                <!--input class="form-control" name="image{{$contador2}}" type="file" accept="file_extension" onchange="readURL{{$contador2}}(this)" multiple="false"-->
                                                <img id="file-image{{$contador2}}" src="" alt="" height="100%" width="100%" class="img-responsive" />
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#imagenModal{{$contador2}}">
                                                        Subir documentos
                                                </button>
                                            @endif

                                            <div class="modal fade" id="imagenModal{{$contador2}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="false">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Documentos</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            @if(count($images) > 0)
                                                                @foreach ($images as $img)
                                                                    <input type="radio" name="documento{{$contador2}}" value="{{$img->archivo}}" onclick="library{{$contador2}}('{{$img->archivo}}')">
                                                                    <?php
                                                                    $info = pathinfo($img->archivo);
                                                                      if ($info["extension"] == "pdf"){?>
                                                                        <embed src="{{$s3}}/{{$usId}}/{{$img->archivo}}" height="100%" width="100%" class="img-responsive" style="border: 1px solid #ddd; width: 30%; display: inline;" type='application/pdf'>
                                                                    <?php }else{?>
                                                                        <img id="file-image{{$contador2}}" src="{{$s3}}/{{$usId}}/{{$img->archivo}}" alt="" height="100%" width="100%" class="img-responsive" style="border: 1px solid #ddd; width: 30%; display: inline;" />
                                                                    <?php }; ?>
                                                                @endforeach
                                                            @else
                                                                <label>No hay documentos.</label>
                                                            @endif
                                                        </div>
                                                        <div class="modal-footer">
                                                            <div class="btn-secondary">
                                                                <input id="file{{$contador2}}" class="form-control" name="image{{$contador2}}" type="file" accept="file_extension" onchange="readURL{{$contador2}}(this)" multiple="false">            
                                                            </div>
                                                            <!--input type="button" class="btn btn-primary" value="Elegir de la Biblioteca"-->
                                                            <input type="button"  class="btn btn-primary" data-dismiss="modal" value="Cerrar">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <script type="text/javascript">
                                                function readURL{{$contador2}}(input) {
                                                    if (input.files && input.files[0]) {
                                                        var reader = new FileReader();            
                                                        reader.onload = function (e) {
                                                            $('#file-image{{$contador2}}').attr('src', e.target.result);
                                                            var imgsrc = document.getElementById("file-image{{$contador2}}").src;
                                                            document.getElementById("file{{$contador2}}").value = '';
                                                            var ele = document.getElementsByName("documento{{$contador2}}");
                                                            for(var i=0;i<ele.length;i++)
                                                            ele[i].checked = false;
                                                        }
                                                        reader.readAsDataURL(input.files[0]);
                                                    }
                                                }
                                                function library{{$contador2}}(archivo) {
                                                    document.getElementById("file-image{{$contador2}}").src = "{{$s3}}/{{$usId}}/"+archivo;
                                                    document.getElementById("file{{$contador2}}").value = archivo;
                                                }
                                            </script>
                                        <?php }?>
                                        </td>
                                        <!--td style="text-align:center;line-height:60px;border-style: none" class="letter">{{$application->Valor}} puntos</td-->
                                    <?php } $contador2=$contador2+1;?>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="9">Sin responder el formulario</td>
                            </tr>
                        @endif
                    @else
                        @if (count($applications) > 0)
                            <?php $bandera=""; $contador=0;$contador2=0;?>
                            <input class="form-control" type="text" name="direccion" value="{{$direccion}}" style="display: none;">
                            <input class="form-control" type="text" name="idAplicacion" value="{{ $idaplicacion }}" style="display: none;">
                            <input class="form-control" type="text" name="idPrograma" value="{{ $idprograma }}" style="display: none;">
                            <input class="form-control" type="text" name="elementos" value="{{count($applications)}}" style="display: none;">
                            @foreach ($applications as $application)
                                <tr data-entry-id="{{ $application->idPreguntas }}">
                                    <td>
                                        <?php if($bandera != $application->idFormulario){
                                            $bandera=$application->idFormulario; $contador=$contador+1;?>
                                            <label class="letter">@lang('global.formulario.title') <?php echo $contador;?></label>
                                        <?php }else{ $bandera=$application->idFormulario;}?>
                                    </td>
                                    <td style="display: none;"><input class="form-control" type="text" name="idpreguntas<?php echo $contador2;?>" value="{{ $application->idPreguntas }}"></td>
                                    <?php if(($application->Titulo)==1){?>
                                        <td style="font-weight: bold;border-style:none none dashed none;border-width:2px;border-color:#a3a3a3;font-size: 18px;">{{ $application->pregunta }}</td>
                                    <?php }else{?>
                                        <td style="text-transform: lowercase;color:#A3A3A3; width:500px;border-style: none;" class="letter">{!! Form::label('pregunta', $application->pregunta, ['class' => 'letter']) !!}</td>
                                        <!--td class="letter"> {{$application->Valor}} puntos</td-->
                                        <td>
                                            <?php if(($application->Requerido)==1){?>
                                                <?php if(($application->Tipo_elemento_idTipo_elemento)==2){?>
                                                    <input class="form-control" type="text" name="respuesta<?php echo $contador2;?>" placeholder="" required="">
                                                <?php }else if(($application->Tipo_elemento_idTipo_elemento)==3){ ?>
                                                    <textarea class="form-control letter" name="respuesta<?php echo $contador2;?>" style="resize: none;" required=""></textarea>
                                                <?php }else if(($application->Tipo_elemento_idTipo_elemento)==4){ ?>
                                                    <select name="respuesta<?php echo $contador2;?>" required="">
                                                        <?php
                                                        $opciones = explode(",", $application->Opciones);
                                                        $elementos = substr_count($application->Opciones, ",");
                                                        for ($i = 0; $i <= ($elementos); $i++) {?>
                                                        <option value="<?php echo $opciones[$i]; ?>"><?php echo $opciones[$i]; ?></option>
                                                        <?php } 
                                                        ?>
                                                    </select>                                                
                                                <?php } else if(($application->Tipo_elemento_idTipo_elemento)==5){ ?>
                                                    <input id="check" class="form-control" type="text" name="respuesta<?php echo $contador2;?>" style="display: none;">
                                                    <?php
                                                    $opciones = explode(",", $application->Opciones);
                                                    $elementos = substr_count($application->Opciones, ",");
                                                    $checked = "";
                                                    for ($i = 0; $i <= ($elementos); $i++) {?>
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
                                                        </script>
                                                    <?php } }else if(($application->Tipo_elemento_idTipo_elemento)==6){?>
                                                        <input class="form-control letter" type="number" step="0.01" name="respuesta<?php echo $contador2;?>">
                                                    <?php } ?>
                                            <?php }else{?>
                                                <?php if(($application->Tipo_elemento_idTipo_elemento)==2){?>
                                                    <input class="form-control letter" type="text" name="respuesta<?php echo $contador2;?>" placeholder="" >
                                                <?php }else if(($application->Tipo_elemento_idTipo_elemento)==3){ ?>
                                                    <textarea class="form-control letter" name="respuesta<?php echo $contador2;?>" style="resize: none;"></textarea>
                                                <?php }else if(($application->Tipo_elemento_idTipo_elemento)==4){ ?>
                                                    <select name="respuesta<?php echo $contador2;?>">
                                                        <?php
                                                        $opciones = explode(",", $application->Opciones);
                                                        $elementos = substr_count($application->Opciones, ",");
                                                        for ($i = 0; $i <= ($elementos); $i++) {?>
                                                        <option value="<?php echo $opciones[$i]; ?>"><?php echo $opciones[$i]; ?></option>
                                                        <?php } 
                                                        ?>
                                                    </select>
                                                <?php }else if(($application->Tipo_elemento_idTipo_elemento)==5){ ?>
                                                    <input id="check" class="form-control" type="text" name="respuesta<?php echo $contador2;?>" style="display: none;">
                                                    <?php
                                                    $opciones = explode(",", $application->Opciones);
                                                    $elementos = substr_count($application->Opciones, ",");
                                                    $checked = "";
                                                    for ($i = 0; $i <= ($elementos); $i++) {?>
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
                                                        </script>
                                            <?php } }else if(($application->Tipo_elemento_idTipo_elemento)==6){?>
                                                <input class="form-control letter" type="number" step="0.01" name="respuesta<?php echo $contador2;?>" placeholder="" >
                                            <?php } } ?>
                                        </td>
                                        <td>
                                            <?php if(($application->Imagen)==1){?>
                                                <input type="text" name="idformulario" value="{{$application->idFormulario}}" readonly hidden>
                                                <input id="file{{$contador2}}" type="text" name="file{{$contador2}}" value="" readonly hidden>
                                                <img id="file-image{{$contador2}}" src="" alt="" height="100%" width="100%" class="img-responsive" style="border: 1px solid #ddd" />
                                                <!--input class="form-control" name="image{{$contador2}}" type="file" accept="file_extension" onchange="readURL{{$contador2}}(this)" multiple="false"-->
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#imagenModal{{$contador2}}">
                                                        Subir documentos
                                                </button>

                                                <div class="modal fade" id="imagenModal{{$contador2}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="false">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Documentos</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <label>No hay documentos.</label>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <div class="btn-secondary">
                                                                    <input id="file{{$contador2}}" class="form-control" name="image{{$contador2}}" type="file" accept="file_extension" onchange="readURL{{$contador2}}(this)" multiple="false">            
                                                                </div>
                                                                <!--input type="button" class="btn btn-primary" value="Elegir de la Biblioteca"-->
                                                                <input type="button"  class="btn btn-primary" data-dismiss="modal" value="Cerrar">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                <script type="text/javascript">
                                                    function readURL{{$contador2}}(input) {
                                                        if (input.files && input.files[0]) {
                                                            var reader = new FileReader();            
                                                            reader.onload = function (e) {
                                                                $('#file-image{{$contador2}}').attr('src', e.target.result);
                                                                var imgsrc = document.getElementById("file-image{{$contador2}}").src;
                                                                document.getElementById("file{{$contador2}}").value = '';
                                                                var ele = document.getElementsByName("documento{{$contador2}}");
                                                                for(var i=0;i<ele.length;i++)
                                                                ele[i].checked = false;
                                                            }
                                                            reader.readAsDataURL(input.files[0]);
                                                        }
                                                    }
                                                </script>
                                            <?php }?>
                                        </td>
                                        <td>
                                            <?php if($application->Ayuda != null){?>
                                            <div class="modal fade" id="Modal{{ $application->idPreguntas }}" role="dialog" data-backdrop="false">
                                                <div class="modal-dialog">

                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title">Ayuda</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>{{ $application->Ayuda }}</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                                    </div>
                                                </div>

                                                </div>
                                            </div>
                                            <button style="text-align: center;line-height: 60px;" class="quet" type="button" data-toggle="modal" data-target="#Modal{{ $application->idPreguntas }}"><img src="/images/question.png" width="27px" height="27px"></button>
                                            <?php }else{}?>
                                        </td>
                                    <?php } $contador2=$contador2+1;?>       
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="9">Sin responder el formulario</td>
                            </tr>
                        @endif
                    @endif
                </tbody>
            </table>
        </div>
        <br>
        <div style="display: inline-block; margin-left: 900px">
    {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-success letter']) !!}
    {!! Form::close() !!}
    @if ($direccion == "No_formulario")
    @if (count($applications) > 0)
    <?php $bandera2=0;?>
    @foreach ($applications as $application)
        <?php if($bandera2==0){?>
            <a class="btn btn-success letter" href="{{ url('admin/formulario',['idformulario' => $application->idFormulario,'idprogramas' => $idprograma]) }}">Resumen</a></div>
        <?php $bandera2=1;}?>
    @endforeach        
    @endif
    @endif
    </div>
    <script type="text/javascript">
        function autoguardado(){
            setTimeout(function(){
                document.forms["autoguardado"].submit();
            },180000);
        }
        autoguardado();
    </script>
@endsection