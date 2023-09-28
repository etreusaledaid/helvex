<!-- Pantalla de preguntas de un formulario http://127.0.0.1:8000/admin/forms/? -->
@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')

    @foreach ($formularios as $formulario)
    <a href="{{ url('admin/aplicaciones',['idprograma' => $formulario->Programa_idPrograma]) }}">
        <i class="fa fa-lg fa-angle-left"></i>
        <span class="backwards">@lang('global.forms.title')s</span>
    </a>
    <h3 class="page-title">@lang('global.forms.title')</h3>

        <!--a href="{{ url('admin/formularios',['idprograma' => $formulario->Programa_idPrograma]) }}" class="btn btn-xs btn-success">@lang('global.app_return')</a-->

    <div class="content-fluid">
        <div class="row">

            <a href="{{ url('admin/forms/createtitulo',['id' => $id, 'idprograma' => $formulario->Programa_idPrograma]) }}" class="btn btn-primary col col-md-2"><!-- @lang('global.app_add_new') -->+ Título</a>

            <a href="{{ url('admin/forms/create',['id' => $id, 'idprograma' => $formulario->Programa_idPrograma]) }}" class="btn btn-primary col col-md-2"><!-- @lang('global.app_add_new') -->+ Pregunta</a>

            <a href="{{ url('admin/forms/position',['id' => $id]) }}" class="btn btn-default col col-md-2">@lang('global.app_position')</a>

            <?php $zip=$id.",".$formulario->Programa_idPrograma; ?>
            {!! Form::open(array(
                'method' => 'PATCH',
                'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                'route' => ['admin.forms.deletemultiple', $zip])) !!}
            {!! Form::submit(trans('Eliminar formulario'), array('class' => 'btn btn-warning col col-md-2')) !!}
            {!! Form::close() !!}

        </div>
    </div>
    @endforeach

    <div class="content-fluid">
        <div class="row">
            <div class="panel-default subtle-shadow-startupmexico">
                @if (count($forms) > 0)
                  <?php $contador=0;?>
                      @foreach ($forms as $form)
                        <?php $contador=$contador+1;?>
                        <div data-entry-id="{{ $form->idPreguntas }}" class="row" style="border-bottom: 1px solid #e1e5eb;">
                            <?php if(($form->Titulo)==1){?>
                                <div class="col-md-10" style="padding: 10px;"><h3>{{ $form->Pregunta }}</h3></div>
                                <div class="col-md-2">
                                    <a href="{{ url('admin/forms/edit',['idpregunta' => $form->idPreguntas, 'idprograma' => 0, 'iduser' => 0]) }}" class="btn btn-xs btn-info">
                                        <i class="fas fa-lg fa-pencil-alt"></i>
                                    </a>
                                    <?php $zip=$id.",".$form->idPreguntas ?>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.forms.destroy', $zip])) !!}
                                    <!-- {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!} -->
                                    {!! Form::submit(trans('Eliminar'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                </div>
                            <?php }else{?>
                                <div class="col-md-10" style="padding: 10px;">{{ $form->Pregunta }}</div>
                                <div class="col-md-2">
                                    <a href="{{ url('admin/forms/edit',['idpregunta' => $form->idPreguntas, 'idprograma' => 0, 'iduser' => 0]) }}" class="btn btn-xs btn-info">
                                        <i class="fas fa-lg fa-pencil-alt"></i>
                                    </a>
                                    <?php $zip=$id.",".$form->idPreguntas ?>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.forms.destroy', $zip])
                                        ) !!}
                                    <!-- {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!} -->
                                        {!! Form::submit(
                                            trans('Eliminar'),
                                            array('class' => 'btn btn-xs btn-danger')
                                            ) !!}
                                    {!! Form::close() !!}
                                </div>
                            <?php }?>       
                        </div>
                      @endforeach
                      <input class="form-control" type="text" name="idPrograma" value="<?php echo $contador;?>" style="display: none;">
                @else
                    <div>
                        <div colspan="9">@lang('global.app_no_entries_in_table')</div>
                    </div>
                @endif
            </div>
        </div>
    </div>   

@stop

@section('javascript') 
    <!--script>
        window.route_mass_crud_entries_destroy = '{{ route('admin.forms.mass_destroy') }}';
    </script-->
@endsection