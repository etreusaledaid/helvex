<!-- PANTALLA interior DE APLICACIONES http://127.0.0.1:8000/admin/aplicaciones/3 interior a un programa-->
@extends('layouts.app')

@section('content')
    <a href="{{ url('/admin/home') }}">
        <i class="fa fa-lg fa-angle-left"></i>
        <span class="backwards">@lang('global.app_dashboard')</span>
    </a>

    @can('gestion_usuarios')
    <h3 class="page-title">@lang('global.programs.title') {{$programa[0]->nombre}}</h3><br>
    <div class="row interior-programas-startupmexico">
        @if (count($applications) > 0)
            @foreach ($applications as $application)
                <a class="col-md-4" href="{{ route('admin.landing.edit',[$application->idLanding]) }}">
                    <div class="panel-default subtle-shadow-startupmexico">
                        <img class="landing-logo-startupmexico" src="{{$application->logo}}"> Landing
                        <div class="program__title"><p>{{$application->nombre}}</p></div>
                        <?php $zip=$id.",".$application->idLanding; ?>
                        {!! Form::open(array(
                            'style' => 'display: inline-block;',
                            'method' => 'DELETE',
                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                            'route' => ['admin.landing.destroy', $zip])) !!}
                        {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                        {!! Form::close() !!}
                    </div>
                </a>
            @endforeach
            <a class="col-md-4" href="{{ url('admin/landing/create',['idprograma' => $id]) }}">
                <div class="panel-default subtle-shadow-startupmexico">
                    <div class="program__title">Nueva landing</div>
                    <p class="no-programs-plus-startupmexico">+</p>
                </div>
            </a>
            <?php $contador=0; ?>
            @foreach ($formularios as $formulario)
                <?php $contador=$contador+1;?>
                <a class="col-md-4" href="{{ url('admin/forms',['id' => $formulario->idFormulario]) }}">
                    <div class="panel-default subtle-shadow-startupmexico">
                        <div class="program__title">Formulario <? echo $contador;?></div>
                    </div>
                </a>
            @endforeach
            <a class="col-md-4" href="{{ url('admin/formularios',['idprograma' => $id]) }}">
                <div class="panel-default subtle-shadow-startupmexico">
                    <div class="program__title">Nuevo formulario</div>
                    <p class="no-programs-plus-startupmexico">+</p>
                </div>
            </a>
            <a class="col-md-4" href="{{ url('admin/aplicantes/index',['idprograma' => $id]) }}">
                <div class="panel-default subtle-shadow-startupmexico">
                    <div class="program__title">Aplicantes</div>
                    <p class="no-programs-plus-startupmexico"><span><?php echo $aplicantes; ?></span></p>
                </div>
            </a>
        <!--p>
            <a href="{ { url('admin/aplicaciones/create',['idprograma' => $id]) }}" class="btn btn-success" >@lang('global.app_new_form')</a>
        </p-->
        @else
            <!-- <div>@lang('global.app_no_entries_in_table')</div> -->
            <div>
                <a class="col-md-4" href="{{ url('admin/landing/create',['idprograma' => $id]) }}">
                    <div class="panel-default subtle-shadow-startupmexico">
                        <div class="program__title">Nueva landing</div>
                        <p class="no-programs-plus-startupmexico">+</p>
                    </div>
                </a>
                <?php $contador=0; ?>
                @foreach ($formularios as $formulario)
                    <?php $contador=$contador+1;?>
                    <a class="col-md-4" href="{{ url('admin/forms',['id' => $formulario->idFormulario]) }}">
                        <div class="panel-default subtle-shadow-startupmexico">
                            <div class="program__title">Formulario <? echo $contador;?></div>
                        </div>
                    </a>
                @endforeach
                <a class="col-md-4" href="{{ url('admin/formularios',['idprograma' => $id]) }}">
                    <div class="panel-default subtle-shadow-startupmexico">
                        <div class="program__title">Nuevo formulario</div>
                        <p class="no-programs-plus-startupmexico">+</p>
                    </div>
                </a>
                <a class="col-md-4" href="{{ route('admin.applications.index') }}">
                    <div class="panel-default subtle-shadow-startupmexico">
                        <div class="program__title">Aplicantes</div>
                        <h3>#</h3>
                    </div>
                </a>
            </div>
            <!--p>
                <a href="{{ url('admin/aplicaciones/create',['idprograma' => $id]) }}" class="btn btn-success" >@lang('global.app_new_form')</a>
            </p-->
        @endif
    </div>
    @endcan

    @can('evaluar_usuarios') <!-- Visible to the evaluator -->
    <h3 class="page-title">Aplicaciones al programa {{$programa[0]->nombre}}</h3><br>
    <div class="row">
        @if (count($applications2) > 0)
        <!--p>
            <a href="{{ url('admin/aplicaciones/create',['idprograma' => $id]) }}" class="btn btn-success" >@lang('global.app_new_form')</a>
        </p-->
        <?php $contador="";?>
            @foreach ($applications2 as $application)
                <a id="{{ $application->idAplicacion }}" class="col-md-3" href="{{ url('admin/formularios/indextwo',['idprograma' => $application->Programa_idPrograma, 'iduser' => $application->idusers]) }}">
                    <div class="panel-default subtle-shadow-startupmexico">
                        <div class="program__title">{{ $application->nombre }}</div>
                        <div class="program__status"><span>{{ $application->estatus }}</span></div>
                        <div class="program__status-bar program__status-bar--50"></div>
                    </div>
                </a>
            @endforeach
        @else
            <div>@lang('global.app_no_entries_in_table')</div>
            <!--p>
                <a href="{{ url('admin/aplicaciones/create',['idprograma' => $id]) }}" class="btn btn-success" >@lang('global.app_new_form')</a>
            </p-->
        @endif
    </div>
    @endcan

    @can('auditar_usuarios') <!-- Visible to the auditor -->
    <h3 class="page-title">Aplicaciones al programa {{$programa[0]->nombre}}</h3><br>
    <div class="row">
        @if (count($applications2) > 0)
        <!--p>
            <a href="{{ url('admin/aplicaciones/create',['idprograma' => $id]) }}" class="btn btn-success" >@lang('global.app_new_form')</a>
        </p-->
        <?php $contador="";?>
            @foreach ($applications2 as $application)
                <a id="{{ $application->idAplicacion }}" class="col-md-3" href="{{ url('admin/formularios/indextwo',['idprograma' => $application->Programa_idPrograma, 'iduser' => $application->idusers]) }}">
                    <div class="panel-default subtle-shadow-startupmexico">
                        <div class="program__title">{{ $application->nombre }}</div>
                        <div class="program__status"><span>{{ $application->estatus }}</span></div>
                        <div class="program__status-bar program__status-bar--50"></div>
                    </div>
                </a>
            @endforeach
        @else
            <div>@lang('global.app_no_entries_in_table')</div>
            <!--p>
                <a href="{{ url('admin/aplicaciones/create',['idprograma' => $id]) }}" class="btn btn-success" >@lang('global.app_new_form')</a>
            </p-->
        @endif
    </div>
    @endcan

    @can('corporativo_usuarios') <!-- Visible to the corporativo -->
    <h3 class="page-title">Aplicaciones al programa {{$programa[0]->nombre}}</h3><br>
    <div class="row">
        @if (count($applications3) > 0)
        <!--p>
            <a href="{{ url('admin/aplicaciones/create',['idprograma' => $id]) }}" class="btn btn-success" >@lang('global.app_new_form')</a>
        </p-->
        <?php $contador="";?>
            @foreach ($applications3 as $application)
                <a id="{{ $application->idAplicacion }}" class="col-md-3" href="{{ url('admin/formularios/indextwo',['idprograma' => $application->Programa_idPrograma, 'iduser' => $application->idusers]) }}">
                    <div class="panel-default subtle-shadow-startupmexico">
                        <div class="program__title">{{ $application->nombre }}</div>
                        <div class="program__status"><span>{{ $application->estatus }}</span></div>
                        <div class="program__status-bar program__status-bar--50"></div>
                    </div>
                </a>
            @endforeach
        @else
            <div>@lang('global.app_no_entries_in_table')</div>
            <!--p>
                <a href="{{ url('admin/aplicaciones/create',['idprograma' => $id]) }}" class="btn btn-success" >@lang('global.app_new_form')</a>
            </p-->
        @endif
    </div>
    @endcan

@endsection