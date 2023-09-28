@extends('layouts.app')

@section('content')
    <h3 class="page-title">Asociar aplicación a este programa</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.formularios.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_create')
        </div>
        
        <div id="formulario" class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    <input class="form-control" type="text" name="idPrograma" value="{{ $idprograma }}" style="display: none;">
                    {!! Form::label('aplicacion', 'Aplicación*', ['class' => 'control-label']) !!}
                        <select name="idAplicacion">
                            @foreach ($aplicaciones as $aplicacion)
                                <option value="{{ $aplicacion->idAplicacion }}">{{ $aplicacion->empresa }}</option>
                            @endforeach
                        </select>
                    <p class="help-block"></p>
                    @if($errors->has('aplicacion'))
                        <p class="help-block">
                            {{ $errors->first('aplicacion') }}
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!--a class="btn btn-success" href="{{ url('admin/formularios/store',['idprograma' => $idprograma, 'idaplicacion' => 1]) }}">@lang('global.app_save')</a-->
    {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-success']) !!}
    {!! Form::close() !!}
    <br>
    <a class="btn btn-danger" href="{{ url('admin/aplicaciones',['id' => $idprograma]) }}">@lang('global.app_cancel')</a>
@stop