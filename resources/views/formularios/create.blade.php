@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.formulario.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.formularios.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_create')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <input class="form-control" type="text" name="idPrograma" value="{{ $idprograma }}" style="display: none;">
                @foreach ($programas as $programa)
	                <div class="col-xs-12 form-group">
	                    {!! Form::label('tituloprograma', 'Programa = ', ['class' => 'control-label']) !!}
                        {!! Form::label('textoprograma', $programa->nombre, ['class' => 'control-label']) !!}
	                </div>
                @endforeach
            </div>
        </div>
    </div>
    <!--a class="btn btn-success" href="{{ url('admin/formularios/store',['idprograma' => $idprograma]) }}">@lang('global.app_save')</a-->
    {!! Form::submit(trans('global.app_create'), ['class' => 'btn btn-success']) !!}
    {!! Form::close() !!}
    <br><br>
    <a class="btn btn-danger" href="{{ url('admin/formularios',['idprograma' => $idprograma]) }}">@lang('global.app_cancel')</a>
@stop