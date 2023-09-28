@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.user-work.title')</h3>
    <p>
        <a href="{{ route('admin.empresas.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
    </p>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($empresas) > 0 ? 'datatable' : '' }}">
                <thead>
                    <tr>
                        <th>@lang('global.works.fields.name')</th>
                        <th>@lang('global.works.fields.status')</th>
                        <th>&nbsp;</th>

                    </tr>
                </thead>
                
                <tbody>
                    @if (count($empresas) > 0)
                        @foreach ($empresas as $empresa)
                            <tr data-entry-id="{{ $empresa->id }}">
                                <td>{{ $empresa->nombre }}</td>
                                <td>{{ $empresa->status }}</td>
                                <td>
                                    <a href="{{ route('admin.empresas.edit',[$empresa->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.empresas.destroy', $empresa->id])) !!}
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