<!-- Pantalla de crear pregunta -->
@extends('layouts.app')

@section('content')
    <a href="{{ url('admin/forms',['id' => $id]) }}">
        <i class="fa fa-lg fa-angle-left"></i>
        <span class="backwards">@lang('global.forms.title')</span>
    </a>
    <!-- <h3 class="page-title">@lang('global.programs.title')</h3> -->
    <h3 class="page-title">Nueva pregunta</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.forms.store']]) !!}

        <div class="content-fluid">
        <div class="row form-group">
            <div class="col-md-8 ">
                <div class="panel-default subtle-shadow-startupmexico">
                    <div class="form-group">
                        <!-- {!! Form::label('Pregunta', 'Pregunta*', ['class' => 'control-label program__deadline']) !!} -->
                        {!! Form::text('Pregunta', old('Pregunta'), ['class' => 'form-control', 'placeholder' => 'Pregunta *', 'required' => '']) !!}
                        <p class="help-block"></p>
                        @if($errors->has('Pregunta'))
                            <p class="help-block">
                                {{ $errors->first('Pregunta') }}
                            </p>
                        @endif
                    </div>
                    <div class="form-group">
                        <!-- {!! Form::label('Ayuda', 'Texto de ayuda*', ['class' => 'control-label program__deadline']) !!} -->
                        {!! Form::textarea('Ayuda', old('Ayuda'), ['class' => 'form-control', 'placeholder' => 'Texto de ayuda', 'style' => 'resize: none;']) !!}
                        <p class="help-block"></p>
                        @if($errors->has('Ayuda'))
                            <p class="help-block">
                                {{ $errors->first('Ayuda') }}
                            </p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-4 ">
                <div class="panel-default subtle-shadow-startupmexico">
                    <p>Opciones</p>
                    <div class="form-group">
                        <input class="form-control" type="text" name="id" value="{{ $id }}" style="display: none;">
                        {!! Form::checkbox('titulo', false, 'value', ['hidden' => 'true']); !!}
                        <p class="help-block"></p>
                        @if($errors->has('Titulo'))
                            <p class="help-block">
                                {{ $errors->first('Titulo') }}
                            </p>
                        @endif
                    </div>
                    <div class="form-group">
                        {!! Form::label('respuesta', 'Tipo de respuesta *', ['class' => 'control-label program__deadline']) !!}
                        {!! Form::select('respuesta', array(2 => 'Campo de texto', 3 => 'Area de texto', 4 => 'Select', 5 => 'Combo', 6 => 'Númerico')) !!}
                        <p class="help-block"></p>
                        @if($errors->has('Respuesta'))
                            <p class="help-block">
                                {{ $errors->first('Respuesta') }}
                            </p>
                        @endif
                    </div>
                    <div id="array_element" class="col-xs-12 form-group"  style="display:none;">                
                        <div class="row">
                            <label class="col-xs-12 form-group">Añade la lista de opciones separadas por una coma, ejemplo: uno, dos, tres</label>
                            <div class="form-group">
                                <input class="form-control" type="text" name="opciones">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('requerido', 'Requerido*', ['class' => 'control-label program__deadline']) !!}
                        {!! Form::select('requerido', array('0' => 'No requerido', '1' => 'Requerido'), 1) !!}
                        <p class="help-block"></p>
                        @if($errors->has('requerido'))
                            <p class="help-block">
                                {{ $errors->first('requerido') }}
                            </p>
                        @endif
                    </div>
                    <div class="form-group">
                        {!! Form::label('valor', 'Valor*', ['class' => 'control-label program__deadline']) !!}
                        <input type="number" name="valor" onKeyPress="if(this.value.length==2) return false;" step="0.1" min="0" max="10">
                        <p class="help-block"></p>
                        @if($errors->has('valor'))
                            <p class="help-block">
                                {{ $errors->first('valor') }}
                            </p>
                        @endif
                    </div>
                    <div class="form-group">
                        {!! Form::label('imagen', 'Con adjunto*', ['class' => 'control-label program__deadline']) !!}
                        {!! Form::checkbox('imagen', '1', true); !!}
                        <p class="help-block"></p>
                        @if($errors->has('Imagen'))
                            <p class="help-block">
                                {{ $errors->first('Imagen') }}
                            </p>
                        @endif
                    </div>
                    <div class="row">
                        <a class="btn btn-default col-md-6" href="{{ url('admin/forms',['id' => $id]) }}">@lang('global.app_cancel')</a>
                        {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-info col-md-6']) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    {!! Form::close() !!}
    <br>

    <script type="text/javascript">
        document.getElementById("respuesta").onchange = function(e) {
            var div_select = document.getElementById("array_element");
            if(this[this.selectedIndex].text == "Select" || this[this.selectedIndex].text == "Combo"){
                div_select.style.display = "block";
            }else{
                div_select.style.display = "none";
            }
        };
    </script>
@stop