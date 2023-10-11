@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <a href="{{ url('admin/aplicaciones',['id' => $idprograma]) }}">
        <i class="fa fa-lg fa-angle-left"></i>
        <span class="title">Programa</span>
    </a>
    <h3 class="page-title">@lang('global.formularios.title')</h3>
    <br>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.formularios.store']]) !!}
    <input class="form-control" type="text" name="idPrograma" value="{{ $idprograma }}" style="display: none;">
    {!! Form::submit(trans('global.app_add_new'), ['class' => 'btn btn-success']) !!}
    {!! Form::close() !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.formularios.title')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped">                
                <thead>
                    <tr>
                        <th>Formulario</th>
                        <th>@lang('global.formularios.fields.programa')</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($formularios) > 0)<?php $contador=0;?>
                        @foreach ($formularios as $formulario)
                            <tr><?php $contador=$contador+1;?>
                                <td style="text-align:center;">{{ $contador }}</td>
                                <td>{{ $formulario->nombre }}</td>
                                <td>
                                <a class="btn btn-success" href="{{ url('admin/forms',['id' => $formulario->idFormulario]) }}" style="margin-top:-30px;">
                                @lang('global.app_view')</a>
                                <?php $zip=$formulario->idFormulario.",".$idprograma ?>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.formularios.destroy', $zip])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="9">@lang('global.app_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('javascript') 
    <!--script>
        window.route_mass_crud_entries_destroy = '{{ route('admin.forms.mass_destroy') }}';
    </script-->
@endsection