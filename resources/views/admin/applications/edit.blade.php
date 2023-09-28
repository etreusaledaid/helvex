@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.applications.title')</h3>   

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_edit')
        </div>

        <div class="panel-body">
        @foreach ($applications as $application)
        {!! Form::model($applications, ['method' => 'PUT', 'route' => ['admin.applications.update', $application->idAplicacion]]) !!}

            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('empresa', 'Empresa*', ['class' => 'control-label']) !!}
                    <input class="form-control" type="text" name="empresa" value="{{ $application->empresa }}">
                    <p class="help-block"></p>
                    @if($errors->has('empresa'))
                        <p class="help-block">
                            {{ $errors->first('empresa') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('estatus', 'Estatus*', ['class' => 'control-label']) !!}
                    {!! Form::select('estatus', array('NO ENVIADA' => 'No enviada', 'ENVIADA' => 'Enviada'), $application->estatus) !!}
                    <p class="help-block"></p>
                    @if($errors->has('estatus'))
                        <p class="help-block">
                            {{ $errors->first('estatus') }}
                        </p>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>

    {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop