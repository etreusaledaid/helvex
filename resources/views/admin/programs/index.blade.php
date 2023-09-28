<!-- PANTALLA DE PROGRAMAS Gestión avanzada http://localhost:8000/admin/programs-->
@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.programs.title')</h3>
<!-- ELIMINADO BOTÓN DEFAULT -->
<!--     <p>
        <a href="{{ route('admin.programs.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
    </p> -->

<!--     <a href="{{ route('admin.programs.create') }}" class="no-programs-startupmexico">Nuevo programa
        <p class="no-programs-plus-startupmexico">+</p>
    </a> -->
    
    @if (count($programs) > 0)
    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($programs) > 0 ? 'datatable' : '' }} dt-select">
                <thead>
                    <tr>
                        <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        <th>@lang('global.programs.fields.nombre')</th>
                        <th>@lang('global.programs.fields.fecha_lanzamiento')</th>
                        <!-- <th>@lang('global.programs.fields.inicio_uno')</th>
                        <th>@lang('global.programs.fields.cierre_uno')</th>
                        <th>@lang('global.programs.fields.inicio_dos')</th>
                        <th>@lang('global.programs.fields.cierre_dos')</th>
                        <th>@lang('global.programs.fields.fecha_cierre')</th> -->
                        <th>@lang('global.programs.fields.fecha_premiacion')</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead> 
                <tbody>
                    @foreach ($programs as $program)
                        <tr data-entry-id="{{ $program->idPrograma }}">
                            <td></td>
                            <td>{{ $program->nombre }}</td>
                            <?php 
                                $fecha = $program->fecha_lanzamiento;
                                $fecha_final = \Carbon\Carbon::parse($fecha)->format('d-m-Y');
                            ?>
                            <!-- <td><?php echo($fecha_final);?></td> -->
                            <!-- <?php 
                                $fecha11 = $program->inicio_uno;
                                if($fecha11!=''){
                                    $fecha_final11 = \Carbon\Carbon::parse($fecha11)->format('d-m-Y');                                        
                                }else{
                                    $fecha_final11 = '';
                                }
                            ?> -->
                           <!--  <td><?php echo($fecha_final11);?></td>
                            <?php 
                                $fecha12 = $program->cierre_uno;
                                if($fecha12!=''){
                                    $fecha_final12 = \Carbon\Carbon::parse($fecha12)->format('d-m-Y');                                        
                                }else{
                                    $fecha_final12 = '';
                                }?>
                            <td><?php echo($fecha_final12);?></td>
                            <?php 
                                $fecha21 = $program->inicio_dos;
                                if($fecha21!=''){
                                    $fecha_final21 = \Carbon\Carbon::parse($fecha21)->format('d-m-Y');                                        
                                }else{
                                    $fecha_final21 = '';
                                }
                            ?>
                            <td><?php echo($fecha_final21);?></td>
                            <?php 
                                $fecha22 = $program->cierre_dos;
                                if($fecha22!=''){
                                    $fecha_final22 = \Carbon\Carbon::parse($fecha22)->format('d-m-Y');                                        
                                }else{
                                    $fecha_final22 = '';
                                }?>
                            <td><?php echo($fecha_final22);?></td> -->

                            <?php 
                                $fecha3 = $program->fecha_cierre;
                                if($fecha3!=''){
                                    $fecha_final3 = \Carbon\Carbon::parse($fecha3)->format('d-m-Y');                                        
                                }else{
                                    $fecha_final3 = '';
                                }?>
                            <td><?php echo($fecha_final3);?></td>
                            <?php 
                                $fecha4 = $program->fecha_premiacion;
                                if($fecha4!=''){
                                    $fecha_final4 = \Carbon\Carbon::parse($fecha4)->format('d-m-Y');                                        
                                }else{
                                    $fecha_final4 = '';
                                }?>
                            <td><?php echo($fecha_final4);?></td>

                            <td>
                                <a href="{{ route('admin.formularios',[$program->idPrograma]) }}" class="btn btn-xs btn-success">@lang('global.app_new_form')</a>
                                <a href="{{ route('admin.programs.edit',[$program->idPrograma]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                {!! Form::open(array(
                                    'style' => 'display: inline-block;',
                                    'method' => 'DELETE',
                                    'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                    'route' => ['admin.programs.destroy', $program->idPrograma])) !!}
                                {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
<!--                    <tr>
                        <td colspan="9">@lang('global.app_no_entries_in_table')</td>
                    </tr> -->
                </tbody>
            </table>
            
        </div>
    </div>
    @else
    <a href="{{ route('admin.programs.create') }}" class="no-programs-startupmexico">Nuevo programa
        <p class="no-programs-plus-startupmexico">+</p>
    </a>
    @endif
@stop
@section('javascript') 
    <!--script>
        window.route_mass_crud_entries_destroy = '{{ route('admin.programs.mass_destroy') }}';
    </script-->
@endsection