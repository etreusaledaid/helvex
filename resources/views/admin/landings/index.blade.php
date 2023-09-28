@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.landing.title')</h3>
    <!--p>
        <a href="{{ route('admin.landing.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
    </p-->

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($landings) > 0 ? 'datatable' : '' }} dt-select">
                <thead>
                    <tr>
                        <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        <td>Número landing</td>
                        <th>@lang('global.landing.fields.nombre')</th>
                        <!-- <th>@lang('global.landing.fields.logo')</th> -->
                        <!-- <th>@lang('global.landing.fields.banner')</th>
                        <th>@lang('global.landing.fields.facebook')</th>
                        <th>@lang('global.landing.fields.twitter')</th>
                        <th>@lang('global.landing.fields.website')</th>-->
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($landings) > 0)
                        @foreach ($landings as $landing)
                            <tr data-entry-id="{{ $landing->idLanding }}">
                                <td></td>
                                <td>{{ $landing->idLanding }}</td>
                                <td>{{ $landing->nombre }}</td>
                                <!-- <td><img style="width:auto;height:150px;" src="{{ $landing->logo }}" alt="Logotipo" /></td> -->
                             <!--    <td><img style="width:auto;height:150px;" src="{{ $landing->banner }}" alt="Red dot" /></td>
                                <td>{{ $landing->facebook }}</td>
                                <td>{{ $landing->twitter }}</td>
                                <td>{{ $landing->website }}</td> -->
                                <td>
                                    <a href="{{ route('admin.landing.edit',[$landing->idLanding]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.landing.destroy', $landing->idLanding])) !!}
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
@endsection