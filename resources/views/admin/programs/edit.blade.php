@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.programs.title')</h3>   

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_edit')
        </div>

        <div class="panel-body">
        @foreach ($programs as $program)
        {!! Form::model($programs, ['method' => 'PUT', 'route' => ['admin.programs.update', $program->idPrograma]]) !!}

            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('nombre', 'Nombre del programa *', ['class' => 'control-label']) !!}
                    <input class="form-control" type="text" name="nombre" value="{{ $program->nombre }}">
                    <p class="help-block"></p>
                    @if($errors->has('nombre'))
                        <p class="help-block">
                            {{ $errors->first('nombre') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('fecha_lanzamiento', 'Fecha de Lanzamiento *', ['class' => 'control-label']) !!}
                    <?php 
                    $dt = \Carbon\Carbon::now();
                    $Y = $dt->year;
                    $m = $dt->month;
                    $d = $dt->day;
                    if(strlen($d) == 1){$d = '0'.$dt->day;}
                    if(strlen($m) == 1){$m = '0'.$dt->month;}
                    ?>
                    <input type="date" name="fecha_lanzamiento" value="<?php echo($Y.'-'.$m.'-'.$d);?>">
                    <p class="help-block"></p>
                    @if($errors->has('fecha_lanzamiento'))
                        <p class="help-block">
                            {{ $errors->first('fecha_lanzamiento') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('inicio_uno', 'Inicio, 1er periodo de aplicación *', ['class' => 'control-label']) !!}
                    <?php 
                        $fecha11 = $program->inicio_uno;
                        $fecha_final11 = \Carbon\Carbon::parse($fecha11)->format('Y-m-d');
                    ?>
                    <input type="date" name="inicio_uno" value="<?php echo($fecha_final11);?>">
                    <p class="help-block"></p>
                    @if($errors->has('inicio_uno'))
                        <p class="help-block">
                            {{ $errors->first('inicio_uno') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('cierre_uno', 'Cierre, 1er periodo de aplicación *', ['class' => 'control-label']) !!}
                    <?php 
                        $fecha12 = $program->cierre_uno;
                        $fecha_final12 = \Carbon\Carbon::parse($fecha12)->format('Y-m-d');
                    ?>
                    <input type="date" name="cierre_uno" value="<?php echo($fecha_final12);?>">
                    <p class="help-block"></p>
                    @if($errors->has('cierre_uno'))
                        <p class="help-block">
                            {{ $errors->first('cierre_uno') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('inicio_dos', 'Inicio, 2º periodo de aplicación *', ['class' => 'control-label']) !!}
                    <?php 
                        $fecha21 = $program->inicio_dos;
                        $fecha_final21 = \Carbon\Carbon::parse($fecha21)->format('Y-m-d');
                    ?>
                    <input type="date" name="inicio_dos" value="<?php echo($fecha_final21);?>">
                    <p class="help-block"></p>
                    @if($errors->has('inicio_dos'))
                        <p class="help-block">
                            {{ $errors->first('inicio_dos') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('cierre_dos', 'Cierre, 2º periodo de aplicación', ['class' => 'control-label']) !!}
                    <?php 
                        $fecha22 = $program->cierre_dos;
                        $fecha_final22 = \Carbon\Carbon::parse($fecha22)->format('Y-m-d');
                    ?>
                    <input type="date" name="cierre_dos" value="<?php echo($fecha_final22);?>">
                    <p class="help-block"></p>
                    @if($errors->has('cierre_dos'))
                        <p class="help-block">
                            {{ $errors->first('cierre_dos') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('fecha_cierre', 'Clausura*', ['class' => 'control-label']) !!}
                    <?php 
                        $fecha3 = $program->fecha_cierre;
                        $fecha_final3 = \Carbon\Carbon::parse($fecha3)->format('Y-m-d');
                    ?>
                    <input type="date" name="fecha_cierre" value="<?php echo($fecha_final3);?>">
                    <p class="help-block"></p>
                    @if($errors->has('fecha_cierre'))
                        <p class="help-block">
                            {{ $errors->first('fecha_cierre') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('fecha_premiacion', 'Premiacion*', ['class' => 'control-label']) !!}
                    <?php 
                        $fecha4 = $program->fecha_premiacion;
                        $fecha_final4 = \Carbon\Carbon::parse($fecha4)->format('Y-m-d');
                    ?>
                    <input type="date" name="fecha_premiacion" value="<?php echo($fecha_final4);?>">
                    <p class="help-block"></p>
                    @if($errors->has('fecha_premiacion'))
                        <p class="help-block">
                            {{ $errors->first('fecha_premiacion') }}
                        </p>
                    @endif
                </div>
            </div>                       
            @endforeach
        </div>
    </div>

    {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-success']) !!}
    {!! Form::close() !!}
    <a class="btn btn-danger" href="{{ route('admin.home') }}">@lang('global.app_cancel')</a>
@stop