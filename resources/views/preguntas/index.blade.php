@extends('layouts.app')

@section('content')

    <a href="{{ url('admin/formularios/indextwo',['idprograma' => $idprograma, 'iduser' => $iduser]) }}">
        <i class="fa fa-lg fa-angle-left"></i>
        <span class="backwards">@lang('global.app_return')</span>
    </a>
    <h3 class="page-title"><!-- @lang('global.formularios.title') -->Respuestas</h3><br>

    <div class="row">
        <div class="panel-body table-responsive">
            @if (count($applications) > 0)
                <?php $contador="";?>
                @foreach ($applications as $application)
                    <?php if($contador != $application->name){
                        $contador=$application->name; ?>
                        <p class="program__title">{{ $application->name }}</p>
                        <p class="program__title">{{ $application->email }}</p>
                    <?php }else{ $contador=$application->name; }?>
                @endforeach
            @endif

            <?php $suma=0; $contador=0;?>
                @if (count($applications) > 0)
                    
                    <?php $zip=$idformulario.",".$idprograma.",".$iduser.",".count($applications); ?>
                    @can('evaluar_usuarios')
                        {!! Form::model($applications, ['method' => 'PATCH', 'route' => ['admin.forms.updatethree',$zip]]) !!}  
                    @endcan
                    @can('auditar_usuarios')
                        {!! Form::model($applications, ['method' => 'PATCH', 'route' => ['admin.forms.updatefour',$zip]]) !!}  
                    @endcan
                    @foreach ($applications as $application)
                        <div class="col-md-12">
                            <div class="row">
                                <?php if(($application->Titulo)==1){?>
                                    <div class="col-md-12"><h3>{{ $application->pregunta }}</h3></div><hr>
                                <?php }else{?>
                                <div class="col-md-6">{{ $application->pregunta }}</div>
                                <div class="col-md-5"><b>R:</b> {{ $application->respuesta }}</div> <?php }?>
                                <div class="col-md-1">
                                <?php if(($application->Imagen)==1){?>
                                    @foreach ($images as $image)
                                    <?php if($image->pregunta == $application->idPreguntas){ ?>
                                        <a id="file<?php echo $application->idPreguntas;?>" href="{{$s3}}/{{$iduser}}/{{$image->archivo}}" download="filename">
                                            <?php
                                                $info = pathinfo($image->archivo);
                                                if($info["extension"] == "pdf"){?>
                                                <embed src="{{$s3}}/{{$iduser}}/{{$image->archivo}}" alt="" height="auto" width="auto" class="img-responsive" type='application/pdf'>
                                            <?php }else{?>
                                                <img id="file-image" src="{{$s3}}/{{$iduser}}/{{$image->archivo}}" alt="" height="auto" width="auto" class="img-responsive"/>
                                            <?php }; ?>
                                        </a>
                                        <?php }?>
                                    @endforeach
                                <?php }?>
                                </div>
                            </div>
                            <div class="row" style="margin-top: 10px;">
                                <?php if(($application->Titulo)==1){?>
                                    <div class="col-md-12"></div>
                                <?php }else{?>
                                @can('auditar_usuarios')
                                    <!--div class="col-md-3">{{ $application->calificacion }} puntos</div>
                                    <div class="col-md-3">Validación: {{ $application->validacion }}</div>
                                    <div class="col-md-3"><a href="{{ url('admin/forms/edit',['idpregunta' => $application->idPreguntas, 'idprograma' => $idprograma, 'iduser' => $iduser]) }}" class="btn btn-xs btn-info">Auditar</a></div-->
                                    <input class="form-control" type="text" name="idrespuestas<?php echo $contador;?>" value="{{ $application->idRespuestas }}" style="display: none;">
                                    <div class="col-md-3">
                                        <input type="number" name="calificacion<?php echo $contador;?>" value="{{ $application->calificacion }}" onKeyPress="if(this.value.length==2) return false;" step="0.1" min="0" max="10">Puntos                                        
                                    </div>
                                    <div class="col-md-3">
                                        <select name="validacion<?php echo $contador;?>">
                                            <option value="0" <?php if($application->validacion == 0){echo "selected";}?>>No</option>
                                            <option value="1" <?php if($application->validacion == 1){echo "selected";}?>>Si</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3"></div>
                                @endcan
                                @can('evaluar_usuarios')
                                    <!--div class="col-md-2">{{ $application->calificacion }} puntos</div>
                                    <div class="col-md-8"><b>Comentario:</b> {{ $application->comentario }}</div>
                                    <div class="col-md-2"><a href="{{ url('admin/forms/edit',['idpregunta' => $application->idPreguntas, 'idprograma' => $idprograma, 'iduser' => $iduser]) }}" class="btn btn-xs btn-info">Evaluar</a></div-->
                                    <input class="form-control" type="text" name="idrespuestas<?php echo $contador;?>" value="{{ $application->idRespuestas }}" style="display: none;">
                                    <div class="col-md-2">
                                        <input type="number" name="calificacion<?php echo $contador;?>" value="{{ $application->calificacion }}" onKeyPress="if(this.value.length==2) return false;" step="0.1" min="0" max="10">Puntos
                                    </div>
                                    <div class="col-md-8">
                                        <b>Comentario:</b>
                                        <textarea class="form-control" name="comentario<?php echo $contador;?>" style="resize: none;">{{ $application->comentario }}</textarea>
                                    </div>
                                    <div class="col-md-2"></div>
                                @endcan
                                <?php }?>
                            </div>
                            <hr>
                        </div>

                        <!-- <tr data-entry-id="{{ $application->idPreguntas }}">
                            <?php if(($application->Titulo)==1){?>
                                <td><h3>{{ $application->pregunta }}</h3></td>
                                <td></td><td></td><td></td><td></td><td></td>
                            <?php }else{?>
                                <td>{{ $application->pregunta }}</td>
                                <td>{{ $application->respuesta }}</td>
                                <td>
                                    <?php if(($application->Imagen)==1){?>
                                        @foreach ($images as $image)
                                        <?php if($image->pregunta == $application->idPreguntas){ ?>
                                            <a id="file<?php echo $application->idPreguntas;?>" href="{{$s3}}/{{$iduser}}/{{$image->archivo}}" download="filename">
                                                <img id="file-image" src="{{$s3}}/{{$iduser}}/{{$image->archivo}}" alt="" height="auto" width="180px" class="img-responsive"/>
                                            </a>
                                            <?php }?>
                                        @endforeach
                                    <?php }?>                                                            
                                </td>
                                @can('evaluar_usuarios')
                                    <td>{{ $application->calificacion }} puntos</td>
                                    <td>{{ $application->comentario }}</td>
                                    <td><a href="{{ url('admin/forms/edit',['idpregunta' => $application->idPreguntas, 'idprograma' => $idprograma, 'iduser' => $iduser]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a></td>
                                @endcan
                                @can('auditar_usuarios')
                                    <td>{{ $application->calificacion }}</td>
                                    <td>{{ $application->validacion }}</td>
                                    <td><a href="{{ url('admin/forms/edit',['idpregunta' => $application->idPreguntas, 'idprograma' => $idprograma, 'iduser' => $iduser]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a></td>
                                @endcan
                            <?php }?>       
                        </tr> -->
                        <?php $suma=$suma+$application->calificacion; $contador=$contador+1; ?>
                    @endforeach
                    @cannot('gestion_usuarios')
                    @cannot('corporativo_usuarios')
                        {!! Form::submit(trans('Calificar'), ['class' => 'btn btn-success']) !!}
                    @endcan
                    @endcan
                    {!! Form::close() !!}

                    <h3>Calificación: <?php $suma = sprintf("%.1f", $suma); echo $suma;?></h3>
                    <?php $zip=$suma.",".$iduser ?>
                    {!! Form::open(array(
                        'style' => 'display: inline-block;',
                        'method' => 'GET',
                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                        'route' => ['admin.mandar', $zip])) !!}
                    {!! Form::submit(trans('Mandar Calificación'), array('class' => 'btn btn-success')) !!}
                    {!! Form::close() !!}

                @else
                    <label>Formulario sin responder</label>
                @endif
        </div>
    </div>   
@endsection