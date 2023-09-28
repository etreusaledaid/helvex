<!-- Pantalla de crear pregunta -->
@extends('layouts.app')

@section('content')
    <a href="{{ url('admin/forms',['id' => $id]) }}">
        <i class="fa fa-lg fa-angle-left"></i>
        <span class="backwards">@lang('global.forms.title')</span>
    </a>
    <h3 class="page-title">@lang('global.programs.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.forms.store']]) !!}

    <div class="panel panel-default">
<!--         <div class="panel-heading">
            @lang('global.app_create')
        </div> -->
        
        <div class="panel-body">
            <div class="row">
                <div class="col-md-3 form-group">
                    <input class="form-control" type="text" name="id" value="{{ $id }}" style="display: none;">
                    {!! Form::checkbox('titulo', true, 'value', ['hidden' => 'true']); !!}
                    <p class="help-block"></p>
                    @if($errors->has('Titulo'))
                        <p class="help-block">
                            {{ $errors->first('Titulo') }}
                        </p>
                    @endif
                </div>
                <div class="col-md-3 form-group" hidden>
                    {!! Form::label('valor', 'Valor*', ['class' => 'control-label']) !!}
                    <input type="number" name="valor" onKeyPress="if(this.value.length==2) return false;" step="0.1" min="0" max="10">
                    <p class="help-block"></p>
                    @if($errors->has('valor'))
                        <p class="help-block">
                            {{ $errors->first('valor') }}
                        </p>
                    @endif
                </div>
                <div class="col-md-3 form-group" hidden>
                    {!! Form::label('imagen', 'Con adjunto*', ['class' => 'control-label']) !!}
                    {!! Form::checkbox('imagen', '0', false); !!}
                    <p class="help-block"></p>
                    @if($errors->has('Imagen'))
                        <p class="help-block">
                            {{ $errors->first('Imagen') }}
                        </p>
                    @endif
                </div>
                <div class="col-md-3 form-group" hidden>
                    {!! Form::label('requerido', 'Requerido*', ['class' => 'control-label']) !!}
                    {!! Form::select('requerido', array('0' => 'No requerido', '1' => 'Requerido')) !!}
                    <p class="help-block"></p>
                    @if($errors->has('requerido'))
                        <p class="help-block">
                            {{ $errors->first('requerido') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-12 form-group">
                    {!! Form::label('Pregunta', 'Titulo*', ['class' => 'control-label']) !!}
                    {!! Form::text('Pregunta', old('Pregunta'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('Pregunta'))
                        <p class="help-block">
                            {{ $errors->first('Pregunta') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-12 form-group" hidden>
                    {!! Form::label('respuesta', 'Tipo de respuesta*', ['class' => 'control-label']) !!}
                    {!! Form::select('respuesta', array(1 => 'Sin respuesta es titulo')) !!}
                    <p class="help-block"></p>
                    @if($errors->has('Respuesta'))
                        <p class="help-block">
                            {{ $errors->first('Respuesta') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-12 form-group">
                    {!! Form::label('Ayuda', 'Texto de ayuda*', ['class' => 'control-label']) !!}
                    {!! Form::textarea('Ayuda', old('Ayuda'), ['class' => 'form-control', 'style' => 'resize: none;']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('Ayuda'))
                        <p class="help-block">
                            {{ $errors->first('Ayuda') }}
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-success left-space-startupmexico']) !!}
    {!! Form::close() !!}
    <br>
    <a class="btn btn-danger left-space-startupmexico" style="margin-top: -20px;" href="{{ url('admin/forms',['id' => $id]) }}">@lang('global.app_cancel')</a>
@stop