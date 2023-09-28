@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.user-work.title')</h3>
    {!! Form::model($empresas, ['method' => 'PUT', 'route' => ['admin.empresas.update', $empresas[0]->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_create')
        </div>
        
        <div class="panel-body">
        @foreach ($empresas as $empresa)
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('nombre', 'Nombre*', ['class' => 'control-label']) !!}
                    <input class="form-control" type="text" name="nombre" value="{{ $empresa->nombre }}">
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
                    {!! Form::label('status', 'Estatus*', ['class' => 'control-label']) !!}
                    <input class="form-control" type="text" name="status" value="{{ $empresa->status}}">
                    <p class="help-block"></p>
                    @if($errors->has('status'))
                        <p class="help-block">
                            {{ $errors->first('status') }}
                        </p>
                    @endif
                </div>
            </div>
            @endforeach            
        </div>
    </div>

    {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

