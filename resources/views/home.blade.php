<!-- Pantalla del Dashboard -->
@inject('request', 'Illuminate\Http\Request')
<script   src="https://code.jquery.com/jquery-3.3.1.slim.min.js"   integrity="sha256-3edrmyuQ0w65f8gfBsqowzjJe2iM6n0nKciPUp8y+7E="   crossorigin="anonymous"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row page-title">
        <span>DASHBOARD</span>
        <h3>Programas</h3>
    </div>
    @cannot('gestion_usuarios')
    @cannot('evaluar_usuarios')
    @cannot('auditar_usuarios')
    @cannot('corporativo_usuarios')
    <div class="row">
        @if (count($applications) > 0)
            @foreach ($programas as $programa)
                    <a href="formularioapp/aplicacion/<?php echo $programa->Programa_idPrograma; ?>"id="{{ $programa->idAplicacion }}" class="col-md-4">
                        <div class="panel-default subtle-shadow-startupmexico">
                            <div>
                                <div class="program__title">{{ $programa->nombre }}</div>
                                <div class="program__status"><span>APLICACIÓN {{ $programa->estatus }}</span></div>
                                <?php if($programa->estatus == 'ENVIADA'){?>
                                    <div class="program__status-bar program__status-bar--100"></div>
                                <?php }?>
                            </div>
                        </div>
                    </a>
            @endforeach
        @else
            <div>@lang('global.app_no_entries_in_table')</div>
        @endif
    </div>   
    @endcan
    @endcan
    @endcan
    @endcan
    @can('corporativo_usuarios')
    <div class="row">
        @if (count($programs) > 0)
            @foreach ($programs as $program)
                <div id="{{ $program->idPrograma }}" class="col-md-4">
                    <div class="panel-default subtle-shadow-startupmexico">
                        <a class="program" href="{{ url('admin/aplicaciones',['id' => $program->idPrograma]) }}">                            
                            <div class="program__title">{{ $program->nombre }}</div>
                            <?php 
                                $fecha = $program->fecha_lanzamiento;
                                if($fecha!=''){
                                    $fecha_final = \Carbon\Carbon::parse($fecha)->format('d.m.Y');                                        
                                }else{
                                    $fecha_final = '';
                                } 
                            ?>
                            <?php 
                                $fecha11 = $program->inicio_uno;
                                if($fecha11!=''){
                                    $fecha_final11 = \Carbon\Carbon::parse($fecha11)->format('d.m');                                        
                                }else{
                                    $fecha_final11 = '';
                                } 
                            ?>
                            <?php 
                                $fecha12 = $program->cierre_uno;
                                if($fecha12!=''){
                                    $fecha_final12 = \Carbon\Carbon::parse($fecha12)->format('d.m.Y');                                        
                                }else{
                                    $fecha_final12 = '';
                                } 
                            ?>
                            <?php 
                                $fecha21 = $program->inicio_dos;
                                if($fecha21!=''){
                                    $fecha_final21 = \Carbon\Carbon::parse($fecha21)->format('d.m.Y');                                        
                                }else{
                                    $fecha_final21 = '';
                                } 
                            ?>
                            <?php 
                                $fecha22 = $program->cierre_dos;
                                if($fecha22!=''){
                                    $fecha_final22 = \Carbon\Carbon::parse($fecha22)->format('d.m.Y');                                        
                                }else{
                                    $fecha_final22 = '';
                                } 
                            ?>
                            <?php 
                                $fecha3 = $program->fecha_cierre;
                                if($fecha3!=''){
                                    $fecha_final3 = \Carbon\Carbon::parse($fecha3)->format('d.m.Y');                                        
                                }else{
                                    $fecha_final3 = '';
                                }
                            ?>
                            <!-- <div class="program__application">FECHA INICIAL: <span><?php echo($fecha_final);?></span></div> -->
                            <div class="program__deadline row">
                                <p class="col-md-7">Cierre 1er periodo de aplicaciones:</p>
                                <span class="col-md-5"><?php echo($fecha_final11);?></span>
                            </div>
                            <div class="program__deadline row">
                                <p class="col-md-7">Cierre 2º periodo de aplicaciones:</p>
                                <span class="col-md-5"><?php echo($fecha_final21);?></span>
                            </div>
                            <div class="program__deadline row">
                                <p class="col-md-7">Clausura:</p>
                                <span class="col-md-5"><?php echo($fecha_final3);?></span>
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        @else
            <div>@lang('global.app_no_entries_in_table')</div>
        @endif
    </div>
    @endcan
    @can('auditar_usuarios')
    <div class="row">
        @if (count($programs) > 0)
            @foreach ($programs as $program)
                <div id="{{ $program->idPrograma }}" class="col-md-4">
                    <div class="panel-default subtle-shadow-startupmexico">
                        <a class="program" href="{{ url('admin/aplicaciones',['id' => $program->idPrograma]) }}">                            
                            <div class="program__title">{{ $program->nombre }}</div>
                            <?php 
                                $fecha = $program->fecha_lanzamiento;
                                if($fecha!=''){
                                    $fecha_final = \Carbon\Carbon::parse($fecha)->format('d.m.Y');                                        
                                }else{
                                    $fecha_final = '';
                                } 
                            ?>
                            <?php 
                                $fecha11 = $program->inicio_uno;
                                if($fecha11!=''){
                                    $fecha_final11 = \Carbon\Carbon::parse($fecha11)->format('d.m');                                        
                                }else{
                                    $fecha_final11 = '';
                                } 
                            ?>
                            <?php 
                                $fecha12 = $program->cierre_uno;
                                if($fecha12!=''){
                                    $fecha_final12 = \Carbon\Carbon::parse($fecha12)->format('d.m.Y');                                        
                                }else{
                                    $fecha_final12 = '';
                                } 
                            ?>
                            <?php 
                                $fecha21 = $program->inicio_dos;
                                if($fecha21!=''){
                                    $fecha_final21 = \Carbon\Carbon::parse($fecha21)->format('d.m.Y');                                        
                                }else{
                                    $fecha_final21 = '';
                                } 
                            ?>
                            <?php 
                                $fecha22 = $program->cierre_dos;
                                if($fecha22!=''){
                                    $fecha_final22 = \Carbon\Carbon::parse($fecha22)->format('d.m.Y');                                        
                                }else{
                                    $fecha_final22 = '';
                                } 
                            ?>
                            <?php 
                                $fecha3 = $program->fecha_cierre;
                                if($fecha3!=''){
                                    $fecha_final3 = \Carbon\Carbon::parse($fecha3)->format('d.m.Y');                                        
                                }else{
                                    $fecha_final3 = '';
                                }
                            ?>
                            <!-- <div class="program__application">FECHA INICIAL: <span><?php echo($fecha_final);?></span></div> -->
                            <div class="program__deadline row">
                                <p class="col-md-7">Cierre 1er periodo de aplicaciones:</p>
                                <span class="col-md-5"><?php echo($fecha_final11);?></span>
                            </div>
                            <div class="program__deadline row">
                                <p class="col-md-7">Cierre 2º periodo de aplicaciones:</p>
                                <span class="col-md-5"><?php echo($fecha_final21);?></span>
                            </div>
                            <div class="program__deadline row">
                                <p class="col-md-7">Clausura:</p>
                                <span class="col-md-5"><?php echo($fecha_final3);?></span>
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        @else
            <div>@lang('global.app_no_entries_in_table')</div>
        @endif
    </div>
    @endcan
    @can('evaluar_usuarios')
    <div class="row">
        @if (count($programs) > 0)
            @foreach ($programs as $program)
                <div id="{{ $program->idPrograma }}" class="col-md-4">
                    <div class="panel-default subtle-shadow-startupmexico">
                        <a class="program" href="{{ url('admin/aplicaciones',['id' => $program->idPrograma]) }}">                            
                            <div class="program__title">{{ $program->nombre }}</div>
                            <?php 
                                $fecha = $program->fecha_lanzamiento;
                                if($fecha!=''){
                                    $fecha_final = \Carbon\Carbon::parse($fecha)->format('d.m.Y');                                        
                                }else{
                                    $fecha_final = '';
                                } 
                            ?>
                            <?php 
                                $fecha11 = $program->inicio_uno;
                                if($fecha11!=''){
                                    $fecha_final11 = \Carbon\Carbon::parse($fecha11)->format('d.m.Y');                                        
                                }else{
                                    $fecha_final11 = '';
                                } 
                            ?>
                            <?php 
                                $fecha12 = $program->cierre_uno;
                                if($fecha12!=''){
                                    $fecha_final12 = \Carbon\Carbon::parse($fecha12)->format('d.m.Y');                                        
                                }else{
                                    $fecha_final12 = '';
                                } 
                            ?>
                            <?php 
                                $fecha21 = $program->inicio_dos;
                                if($fecha21!=''){
                                    $fecha_final21 = \Carbon\Carbon::parse($fecha21)->format('d.m.Y');                                        
                                }else{
                                    $fecha_final21 = '';
                                } 
                            ?>
                            <?php 
                                $fecha22 = $program->cierre_dos;
                                if($fecha22!=''){
                                    $fecha_final22 = \Carbon\Carbon::parse($fecha22)->format('d.m.Y');                                        
                                }else{
                                    $fecha_final22 = '';
                                } 
                            ?>
                            <?php 
                                $fecha3 = $program->fecha_cierre;
                                if($fecha3!=''){
                                    $fecha_final3 = \Carbon\Carbon::parse($fecha3)->format('d.m.Y');                                        
                                }else{
                                    $fecha_final3 = '';
                                }
                            ?>
                            <!-- <div class="program__application">FECHA INICIAL: <span><?php echo($fecha_final);?></span></div> -->
                            <div class="program__deadline row">
                                <p class="col-md-7">Cierre 1er periodo de aplicaciones:</p>
                                <span class="col-md-5"><?php echo($fecha_final11);?></span>
                            </div>
                            <div class="program__deadline row">
                                <p class="col-md-7">Cierre 2º periodo de aplicaciones:</p>
                                <span class="col-md-5"><?php echo($fecha_final21);?></span>
                            </div>
                            <div class="program__deadline row">
                                <p class="col-md-7">Clausura:</p>
                                <span class="col-md-5"><?php echo($fecha_final3);?></span>
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        @else
            <div>@lang('global.app_no_entries_in_table')</div>
        @endif
    </div>
    @endcan
    @can('gestion_usuarios')
    <div class="row">
        @if (count($programs) > 0)
            @foreach ($programs as $program)
                <div id="{{ $program->idPrograma }}" class="col-md-4">
                    <div class="panel-default subtle-shadow-startupmexico">
                        <a class="program" href="{{ url('admin/aplicaciones',['id' => $program->idPrograma]) }}">                            
                            <div class="program__title row">{{ $program->nombre }}</div>
                            <?php 
                                $fecha = $program->fecha_lanzamiento;
                                if($fecha!=''){
                                    $fecha_final = \Carbon\Carbon::parse($fecha)->format('d.m.Y');                                        
                                }else{
                                    $fecha_final = '';
                                } 
                            ?>
                            <?php 
                                $fecha11 = $program->inicio_uno;
                                if($fecha11!=''){
                                    
                                    $fecha_final11 = \Carbon\Carbon::parse($fecha11)->format('d.m.Y');                                        
                                }else{
                                    $fecha_final11 = '';
                                } 
                            ?>
                            <?php 
                                $fecha12 = $program->cierre_uno;
                                if($fecha12!=''){
                                    $fecha_final12 = \Carbon\Carbon::parse($fecha12)->format('d.m.Y');                                        
                                }else{
                                    $fecha_final12 = '';
                                } 
                            ?>
                            <?php 
                                $fecha21 = $program->inicio_dos;
                                if($fecha21!=''){
                                    $fecha_final21 = \Carbon\Carbon::parse($fecha21)->format('d.m.Y');                                        
                                }else{
                                    $fecha_final21 = '';
                                } 
                            ?>
                            <?php 
                                $fecha22 = $program->cierre_dos;
                                if($fecha22!=''){
                                    $fecha_final22 = \Carbon\Carbon::parse($fecha22)->format('d.m.Y');                                        
                                }else{
                                    $fecha_final22 = '';
                                } 
                            ?>
                            <?php 
                                $fecha3 = $program->fecha_cierre;
                                if($fecha3!=''){
                                    $fecha_final3 = \Carbon\Carbon::parse($fecha3)->format('d.m.Y');                                       
                                }else{
                                    $fecha_final3 = '';
                                }
                            ?>
                            <!-- <div class="program__application">FECHA INICIAL: <span><?php echo($fecha_final);?></span></div> -->
                            <div class="program__deadline row">
                                <p class="col-md-7">Cierre 1er periodo de aplicaciones:</p>
                                <span class="col-md-5"><?php echo($fecha_final11);?></span>
                            </div>
                            <div class="program__deadline row">
                                <p class="col-md-7">Cierre 2º periodo de aplicaciones:</p>
                                <span class="col-md-5"><?php echo($fecha_final21);?></span>
                            </div>
                            <div class="program__deadline row">
                                <p class="col-md-7">Clausura:</p>
                                <span class="col-md-5"><?php echo($fecha_final3);?></span>
                            </div>
                            <br>
                            <div class="row">
                                <a href="{{ route('admin.programs.edit',[$program->idPrograma]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                {!! Form::open(array(
                                    'style' => 'display: inline-block;',
                                    'method' => 'DELETE',
                                    'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                    'route' => ['admin.programs.destroy', $program->idPrograma])) !!}
                                {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                {!! Form::close() !!}
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
                <div id="{{ $program->idPrograma }}" class="col-md-4">
                    <div class="panel-default subtle-shadow-startupmexico">
                        <a class="program" href="{{ route('admin.programs.create') }}">
                            <div class="program__title">Nuevo programa</div>
                            <p class="no-programs-plus-startupmexico">+</p>
                        </a>
                    </div>
                </div>
<!--                 <a href="{{ route('admin.programs.create') }}" class="no-programs-startupmexico">Nuevo programa
                    <p class="no-programs-plus-startupmexico">+</p>
                </a> -->
        @else
            <div class="left-space-startupmexico">
                <div class="aplic-number-startupmexico">0</div>
                <p class="aplic-text-startupmexico">Aún no has creado programas</p>
                <!-- <div class="left-space-startupmexico">@lang('global.app_no_entries_in_table')</div> -->
                <br>
                <!-- <a href="{{ route('admin.programs.index') }}" class="no-programs-startupmexico">Nuevo programa
                    <p class="no-programs-plus-startupmexico">+</p>
                </a> -->
                <div class="col-md-4">
                    <div class="panel-default subtle-shadow-startupmexico">
                        <a class="program" href="{{ route('admin.programs.create') }}">
                            <div class="program__title">Nuevo programa</div>
                            <p class="no-programs-plus-startupmexico">+</p>
                        </a>
                    </div>
                </div>
            </div>
        @endif
    </div>
    <div class="row"><h3 class="page-title">Analítica</h3></div>
    <div class="row">
        <div class="col-md-3 dashboard-items-startupmexico">
            <div class="panel-default subtle-shadow-startupmexico">
                <p>Aplicantes a los programas</p> <span><?php echo $aplicantes; ?></span>
            </div>
        </div>
        <div class="col-md-3 dashboard-items-startupmexico">
            <div class="panel-default subtle-shadow-startupmexico">
                <p>Visitas en langing pages (E)</p> <span>54</span>
            </div>
        </div>
        <div class="col-md-3 dashboard-items-startupmexico">
            <div class="panel-default subtle-shadow-startupmexico">
                <p>KPI 3</p> <span>5</span>
            </div>
        </div>
        <div class="col-md-3 dashboard-items-startupmexico">
            <div class="panel-default subtle-shadow-startupmexico">
                <p>KPI 4</p>
                <span>7</span>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div id="graph-container" class="panel-default subtle-shadow-startupmexico" style="height: 400px;"></div>
        </div>
        <div class="col-md-4 dashboard-items-startupmexico">
            <div class="panel-default subtle-shadow-startupmexico">
                <p>Últimas startups</p>
                <table style="width:100%">
                  <tr>
                    <td>Twilio</td>
                    <td>1803</td> 
                  </tr>
                  <tr>
                    <td>Slack</td>
                    <td>9833</td> 
                  </tr>
                  <tr>
                    <td>Atlassian</td>
                    <td>3209</td> 
                  </tr>
                </table>
            </div>
        </div>
    </div>
    @endcan
</div>
<script type="text/javascript">
    Highcharts.chart('graph-container', {
        chart: {
            type: 'area'
        },
        title: {
            text: ''
        },
        subtitle: {
            text: '<a></a>' +
                ''
        },
        xAxis: {
            allowDecimals: false,
            labels: {
                formatter: function () {
                    return this.value; // clean, unformatted number for year
                }
            }
        },
        yAxis: {
            title: {
                text: 'Número de aplicantes'
            },
            labels: {
                formatter: function () {
                    return this.value ;
                }
            }
        },
        tooltip: {
            pointFormat: '{series.name} han aplicado <b>{point.y:,.0f}</b> usuarios <br/>en {point.x}'
        },
        plotOptions: {
            area: {
                pointStart: 1,
                marker: {
                    enabled: false,
                    symbol: 'circle',
                    radius: 2,
                    states: {
                        hover: {
                            enabled: true
                        }
                    }
                }
            }
        },
        series: [{
            name: 'A',
            data: [
                6, 11, 12, 34, 55, 55, 66, 77
            ]
        }, {
            name: 'B',
            data: [4, 5, 6, 7, 8, 55, 66, 77
            ]
        }]
    });
</script>
@endsection
