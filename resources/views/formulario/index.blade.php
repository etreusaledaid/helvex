@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    
    {!! Form::open(['method' => 'POST', 'route' => ['admin.formulario.store'], 'id' => 'autoguardado', 'files' => true]) !!}

    <input class="form-control" type="hidden" name="idAplicacion" value="{{ $applications[0]->idAplicacion }}">
    <input class="form-control" type="hidden" name="idPrograma" value="{{ $idprograma }}">
    <input class="form-control" type="hidden" name="elementos" value="{{count($preguntas)}}">
    <input class="form-control" type="hidden" name="direccion" value="{{$direccion}}">

    <h3 class="page-title">@lang('global.formulario.title')</h3>
    <label  class="letter" style="margin-left: 8px;">Nombre de la Institución: {{$empresa}}<!--input type="text" name="empresa" value="<?php echo $empresa;?>" --></label>

        @foreach ($admin as $ad)
        <?php $adminemail=$ad->id; ?>
        @endforeach
        @foreach ($user as $us)
        <?php $useremail=$us->id; ?>        
        @endforeach

    @if (count($applications) > 0)
    @foreach ($programa as $program)
    @foreach ($applications as $application)
    
    <div class="panel panel-default">
<!--         <div class="panel-heading">
            @lang('global.app_list')
        </div> -->
        <div class="panel-body table-responsive">
            <?php $outside_aplication_period = 0; $bandera=""; $contador=0; $contador2=0; $calificacion=0; ?>
            <?php
            $dt = \Carbon\Carbon::now();
            if(($dt>$program->inicio_uno && $dt<$program->cierre_uno)||($dt>$program->inicio_dos && $dt<$program->cierre_dos)){}else{ $outside_aplication_period = 1; }
            ?>
            @foreach ($preguntas as $pregunta)
                <?php if(($pregunta->Titulo)==1){?>
                <div class="row">
                    <div class="col-xs-12 form-group">
                        <!--input class="form-control" type="text" name="Formulario" value="{{ $pregunta->idFormulario }}" style="display: none;"-->
                        <input class="form-control" type="hidden" name="idpreguntas<?php echo $contador2;?>" value="{{ $pregunta->idPreguntas }}">
                        <h3>{{ $pregunta->Pregunta }}</h3>
                        <p class="help-block"></p>
                        @if($errors->has('Pregunta'))
                            <p class="help-block">
                                {{ $errors->first('Pregunta') }}
                            </p>
                        @endif
                    </div>
                </div>
                <?php }else{?>        
                <div class="row">
                    <div class="col-xs-12 form-group">
                        <!--input class="form-control" type="text" name="Formulario" value="{{ $pregunta->idFormulario }}" style="display: none;"-->
                        <input class="form-control" type="hidden" name="idpreguntas<?php echo $contador2;?>" value="{{ $pregunta->idPreguntas }}">
                            <?php $zip2="".",".$idprograma.",".$pregunta->Imagen.",".$pregunta->idPreguntas; ?>
                            <label>P: {{ $pregunta->Pregunta }}</label><br>
                        <?php if($respuestas == 1){?>
                            <?php $zip2=$pregunta->idRespuestas.",".$idprograma.",".$pregunta->Imagen.",".$pregunta->idPreguntas; ?>
                            <label>R: {{ $pregunta->Respuesta }}</label>
                        <?php }else{?>
                            <label>R:</label>
                            <?php if(($pregunta->Tipo_elemento_idTipo_elemento)==2){?>
                                <input class="form-control letter" type="text" name="respuesta<?php echo $contador2;?>" placeholder="" <?php if($outside_aplication_period == 1){ echo "readonly"; }?>>
                            <?php }else if(($pregunta->Tipo_elemento_idTipo_elemento)==3){ ?>
                                <textarea class="form-control letter" name="respuesta<?php echo $contador2;?>" style="resize: none;" <?php if($outside_aplication_period == 1){ echo "readonly"; }?>></textarea>
                            <?php }else if(($pregunta->Tipo_elemento_idTipo_elemento)==4){ ?>
                                <select name="respuesta<?php echo $contador2;?>" <?php if($outside_aplication_period == 1){ echo "disabled"; }?>>
                                    <?php
                                    $opciones = explode(",", $pregunta->Opciones);
                                    $elementos = substr_count($pregunta->Opciones, ",");
                                    for ($i = 0; $i <= ($elementos); $i++) {?>
                                    <option value="<?php echo $opciones[$i]; ?>"><?php echo substr($opciones[$i], strpos($opciones[$i], ",")); ?></option>
                                    <?php } 
                                    ?>
                                </select>
                            <?php }else if(($pregunta->Tipo_elemento_idTipo_elemento)==5){ ?>
                                <input id="check" class="form-control" type="hidden" name="respuesta<?php echo $contador2;?>" <?php if($outside_aplication_period == 1){ echo "disabled"; }?>>
                                <?php
                                $opciones = explode(",", $pregunta->Opciones);
                                $elementos = substr_count($pregunta->Opciones, ",");
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
                            <?php } } ?>
                        <?php } ?>
                        <p class="help-block"></p>
                        @if($errors->has('Pregunta'))
                            <p class="help-block">
                                {{ $errors->first('Pregunta') }}
                            </p>
                        @endif
                    </div>
                </div>   
                <?php } $contador2=$contador2+1; $calificacion=$calificacion+$pregunta->calificacion; ?>   
            @endforeach

            <?php if($calificacion == null){ ?>
                <h3>Pendiente a evaluar</h3>
            <?php }else{?>
                <h3>Calificación <?php echo $calificacion; ?></h3>
            <?php } ?>

            <?php if($outside_aplication_period == 1){ ?>
                <label>Aplicación enviada.</label>
                <!--label>Aplicación en proceso de revisión. No es posible editar tus respuestas por el momento.</label-->
            <?php }?>

        </div>
    </div>
    @endforeach
    @endforeach
    @endif
    <?php if($outside_aplication_period ==! 1){ ?>
        <?php if($application->estatus == 'NO ENVIADA'){?>
            {!! Form::submit(trans('global.app_edit'), ['class' => 'btn btn-success letter']) !!}
        <?php }?>
    <?php }?>

    {!! Form::close() !!}

    <?php $zip = $applications[0]->idAplicacion.",".$idformulario.",".$idprograma.",".$adminemail.",".$useremail;?>
    {!! Form::model($applications, ['method' => 'PATCH', 'route' => ['formulario.enviar',$zip]]) !!}
        <?php if($application->estatus == 'NO ENVIADA'){?>
        {!! Form::submit(trans('global.app_send'), ['class' => 'btn btn-success']) !!}
        <?php }?>
    {!! Form::close() !!}

@stop

@section('javascript') 
    <!--script>
        window.route_mass_crud_entries_destroy = '{{ route('admin.programs.mass_destroy') }}';
    </script-->
@endsection