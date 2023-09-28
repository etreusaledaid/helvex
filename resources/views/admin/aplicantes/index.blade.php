@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <!-- <h3 class="page-title">@lang('global.applications.title')</h3> -->
    <a href="{{ url('admin/aplicaciones',['idprograma' => $idprograma]) }}">
        <i class="fa fa-lg fa-angle-left"></i>
        <span class="backwards">@lang('global.programs.title')</span>
    </a>
    <h3 class="page-title">Aplicantes</h3>
    <!--p>
        <a href="{{ route('admin.aplicantes.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
    </p-->

    <div class="panel panel-default">

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($applications) > 0 ? 'datatable' : '' }}">
                <thead>
                    <tr>
                        <th>@lang('global.applications.fields.nombre')</th>
                        <th>@lang('global.applications.fields.email')</th>
                        <th>@lang('global.applications.fields.empresa')</th>
                        <th>@lang('global.applications.fields.estatus')</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($applications) > 0)
                        @foreach ($applications as $application)
                            <tr data-entry-id="{{ $application->idAplicacion }}">
                                <td>{{ $application->name }}</td>
                                <td>{{ $application->email }}</td>
                                <td>{{ $application->empresa }}</td>
                                <td>{{ $application->estatus }}</td>
                                <td>
                                    <!--a href="{{ route('admin.aplicantes.edit',[$application->idAplicacion]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a-->
                                    <a href="{{ url('admin/formularios/indextwo',['idprograma' => $idprograma, 'iduser' => $application->idusers]) }}" class="btn btn-xs btn-info">@lang('global.app_view')</a>
                                    <?php $zip=$application->idAplicacion.",".$idprograma; ?>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.aplicantes.destroy', $zip])) !!}
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
        window.route_mass_crud_entries_destroy = '{{ route('admin.aplicantes.mass_destroy') }}';
    </script-->
@endsection