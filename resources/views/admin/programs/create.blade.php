@extends('layouts.app')

@section('content')
    <!-- <h3 class="page-title">@lang('global.programs.title')</h3> -->
    <h3 class="page-title">Creación de programas</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.programs.store']]) !!}

    <div class="panel panel-default">
        <!-- <div class="panel-heading">
            @lang('global.app_create')
        </div> -->
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('nombre', 'Nombre del programa *', ['class' => 'control-label']) !!}
                    {!! Form::text('nombre', old('nombre'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
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
                    {!! Form::label('fecha_lanzamiento', 'Fecha de lanzamiento*', ['class' => 'control-label']) !!}
                    <?php 
                    $dt = \Carbon\Carbon::now();
                    $Y = $dt->year;
                    $m = $dt->month;
                    $d = $dt->day;
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
            <hr>
            <div class="row">
                <div class="col-xs-6 form-group">
                    {!! Form::label('inicio_uno', 'Inicio, 1er periodo de aplicación *', ['class' => 'control-label']) !!}
                    <?php 
                    $dt = \Carbon\Carbon::now();
                    $Y = $dt->year;
                    $m = $dt->month;
                    $d = $dt->day;
                    ?>
                    <input type="date" name="inicio_uno" value="<?php echo($Y.'-'.$m.'-'.$d);?>">
                    <p class="help-block"></p>
                    @if($errors->has('inicio_uno'))
                        <p class="help-block">
                            {{ $errors->first('inicio_uno') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-6 form-group">
                    {!! Form::label('cierre_uno', 'Cierre, 1er periodo de aplicación *', ['class' => 'control-label']) !!}
                    <?php 
                    $dt = \Carbon\Carbon::now();
                    $Y = $dt->year;
                    $m = $dt->month;
                    $d = $dt->day;
                    ?>
                    <input type="date" name="cierre_uno" value="<?php echo($Y.'-'.$m.'-'.$d);?>">
                    <p class="help-block"></p>
                    @if($errors->has('cierre_uno'))
                        <p class="help-block">
                            {{ $errors->first('cierre_uno') }}
                        </p>
                    @endif
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-xs-6 form-group">
                    {!! Form::label('inicio_dos', 'Inicio, 2º periodo de aplicación *', ['class' => 'control-label']) !!}
                    <?php 
                    $dt = \Carbon\Carbon::now();
                    $Y = $dt->year;
                    $m = $dt->month;
                    $d = $dt->day;
                    ?>
                    <input type="date" name="inicio_dos" value="<?php echo($Y.'-'.$m.'-'.$d);?>">
                    <p class="help-block"></p>
                    @if($errors->has('inicio_dos'))
                        <p class="help-block">
                            {{ $errors->first('inicio_dos') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-6 form-group">
                    {!! Form::label('cierre_dos', 'Cierre, 2º periodo de aplicación *', ['class' => 'control-label']) !!}
                    <?php 
                    $dt = \Carbon\Carbon::now();
                    $Y = $dt->year;
                    $m = $dt->month;
                    $d = $dt->day;
                    ?>
                    <input type="date" name="cierre_dos" value="<?php echo($Y.'-'.$m.'-'.$d);?>">
                    <p class="help-block"></p>
                    @if($errors->has('cierre_dos'))
                        <p class="help-block">
                            {{ $errors->first('cierre_dos') }}
                        </p>
                    @endif
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-xs-6 form-group">
                    {!! Form::label('fecha_cierre', 'Clausura *', ['class' => 'control-label']) !!}
                    <?php 
                    $dt = \Carbon\Carbon::now();
                    $Y = $dt->year;
                    $m = $dt->month;
                    $d = $dt->day;
                    ?>
                    <input type="date" name="fecha_cierre" value="<?php echo($Y.'-'.$m.'-'.$d);?>">
                    <p class="help-block"></p>
                    @if($errors->has('fecha_cierre'))
                        <p class="help-block">
                            {{ $errors->first('fecha_cierre') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-6 form-group">
                    {!! Form::label('fecha_premiacion', 'Premiacion *', ['class' => 'control-label']) !!}
                    <?php 
                    $dt = \Carbon\Carbon::now();
                    $Y = $dt->year;
                    $m = $dt->month;
                    $d = $dt->day;
                    ?>
                    <input type="date" name="fecha_premiacion" value="<?php echo($Y.'-'.$m.'-'.$d);?>">
                    <p class="help-block"></p>
                    @if($errors->has('fecha_premiacion'))
                        <p class="help-block">
                            {{ $errors->first('fecha_premiacion') }}
                        </p>
                    @endif
                </div>
            </div>            
            <div class="row">
                <div class="col-xs-12 form-group"> * Campos requeridos </div>
            </div>
        </div>
    </div>

    <!-- {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-success btn-send-startupmexico']) !!} -->
    {!! Form::submit(trans('Guardar Programa'), ['class' => 'btn btn-success btn-send-startupmexico']) !!}
    {!! Form::close() !!}
    <a class="btn btn-danger btn-send-startupmexico" href="{{ url('/admin/home') }}">@lang('global.app_cancel')</a>
@stop