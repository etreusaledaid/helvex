@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    @can('gestion_usuarios')
    <a href="{{ url('admin/aplicantes/index',['id' =>  $idprograma]) }}">
        <i class="fa fa-lg fa-angle-left"></i>
        <span class="backwards">@lang('global.app_return')</span>
    </a>
    @endcan
    @cannot('gestion_usuarios')
    <a href="{{ url('admin/aplicaciones',['id' =>  $idprograma]) }}">
        <i class="fa fa-lg fa-angle-left"></i>
        <span class="backwards">@lang('global.app_return')</span>
    </a>
    @endcan
    <h3 class="page-title">@lang('global.formularios.title')</h3><br>

    <p class="backwards">{{$user[0]->name}}</p>

    <div class="row">
        <div class="col-md-12">
            <div class="row">
            @if (count($formularios) > 0)
                <?php $contador=0; ?>
                @foreach ($formularios as $formulario)
                    <?php $contador=$contador+1; ?>
                    <a id="1" class="col-md-3" href="{{ url('admin/preguntas',['idformulario' => $formulario->idFormulario, 'idprograma' => $idprograma, 'iduser' => $iduser]) }}">
                        <div class="panel-default subtle-shadow-startupmexico" style="height: 130px;">
                            <div class="program__status"><span>{{ $formulario->nombre }}</span></div>
                            <div class="program__title">{{$contador}}</div>
                            <div class="program__status-bar program__status-bar--50"></div>
                        </div>
                    </a>{!! Form::close() !!}
                @endforeach
            @else
                <p>@lang('global.app_no_entries_in_table')</p>
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