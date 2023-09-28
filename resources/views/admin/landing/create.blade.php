@extends('layouts.app')

@section('content')
    @include('layouts.messages')

    <a href="{{ url('admin/aplicaciones',['id' => $id]) }}">
        <i class="fa fa-lg fa-angle-left"></i>
        <span class="backwards">@lang('global.programs.title')</span>
    </a>
    <h3 class="page-title">@lang('global.landing.title') del programa {{$programa[0]->nombre}}</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.landing.store']], 'image/save', array('files'=> true)) !!}

    <div class="panel panel-default">
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('url', 'URL del programa * (sin usar espacios en blanco, acentos, tildes y caracteres especiales)', ['class' => 'control-label']) !!}
                    {!! Form::text('url', old('url'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('url'))
                        <p class="help-block">
                            {{ $errors->first('url') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('nombre', 'Nombre del programa *', ['class' => 'control-label']) !!}
                    {!! Form::text('nombre', old('nombre'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('nombre'))
                        <p class="help-block">
                            {{ $errors->first('nombre') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 form-group">
                    <label>Logotipo</label>
                    <input id="logo" type="text" name="logo" style="display:none;">
                    <input type='file' onchange="readURL(this);" />
                    <img style="width:auto;height:150px;" id="cargar" src="#" alt="Sin imagen" />
                    <script type="text/javascript">
                        function readURL(input) {
                              if (input.files && input.files[0]) {
                                var reader = new FileReader();
                                reader.onload = function (e) {
                                    var imagen = document.getElementById('logo');
                                    imagen.value = e.target.result;
                                    $('#cargar')
                                    .attr('src', e.target.result)
                                    .width('auto')
                                    .height(150);
                                };
                                reader.readAsDataURL(input.files[0]);
                              }
                            }
                    </script>
                    <p class="help-block"></p>
                    @if($errors->has('logo'))
                        <p class="help-block">
                            {{ $errors->first('logo') }}
                        </p>
                    @endif
                </div>
                <div class="col-md-6 form-group">
                    <label>Banner</label>
                    <input id="banner" type="text" name="banner" style="display:none;">
                    <input type='file' onchange="readURLtwo(this);" />
                    <img style="width:auto;height:150px;" id="cargartwo" src="#" alt="Sin imagen" />
                    <script type="text/javascript">
                        function readURLtwo(input) {
                              if (input.files && input.files[0]) {
                                var reader = new FileReader();
                                reader.onload = function (e) {
                                    var imagen = document.getElementById('banner');
                                    imagen.value = e.target.result;
                                    $('#cargartwo')
                                    .attr('src', e.target.result)
                                    .width('auto')
                                    .height(150);
                                };
                                reader.readAsDataURL(input.files[0]);
                              }
                            }
                    </script>
                    <p class="help-block"></p>
                    @if($errors->has('banner'))
                        <p class="help-block">
                            {{ $errors->first('banner') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('titulo', 'Titulo del programa *', ['class' => 'control-label']) !!}
                    {!! Form::text('titulo', old('titulo'), ['class' => 'form-control']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('titulo'))
                        <p class="help-block">
                            {{ $errors->first('titulo') }}
                        </p>
                    @endif
                </div>
            </div> 
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('texto', 'Descripción y bases *', ['class' => 'control-label']) !!}
                    <textarea class="form-control" rows="20" cols="50" style="resize:none" name="texto">
                    </textarea>
                    <p class="help-block"></p>
                    @if($errors->has('texto'))
                        <p class="help-block">
                            {{ $errors->first('texto') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-md-2 form-group">
                    <input type="checkbox" name="checkboxuno">
                    {!! Form::label('estatus', 'Habilitar', ['class' => 'control-label']) !!}
                </div>
                <div class="col-md-4 form-group">
                    <label>Imagen 1</label>
                    <input id="imagenuno" type="text" name="imagenuno" style="display:none;">
                    <input type='file' onchange="readURLthree(this);" />
                    <img style="width:auto;height:150px;" id="cargaruno" src="#" alt="Sin imagen" />
                    <script type="text/javascript">
                        function readURLthree(input) {
                              if (input.files && input.files[0]) {
                                var reader = new FileReader();
                                reader.onload = function (e) {
                                    var imagen = document.getElementById('imagenuno');
                                    imagen.value = e.target.result;
                                    $('#cargaruno')
                                    .attr('src', e.target.result)
                                    .width('auto')
                                    .height(150);
                                };
                                reader.readAsDataURL(input.files[0]);
                              }
                            }
                    </script>
                    <p class="help-block"></p>
                    @if($errors->has('imagenuno'))
                        <p class="help-block">
                            {{ $errors->first('imagenuno') }}
                        </p>
                    @endif
                </div>
                <div class="col-md-6 form-group">
                    {!! Form::label('textouno', 'Texto 1 *', ['class' => 'control-label']) !!}
                    <textarea class="form-control" rows="10" cols="50" style="resize:none" name="textouno">
                    </textarea>
                    <p class="help-block"></p>
                    @if($errors->has('textouno'))
                        <p class="help-block">
                            {{ $errors->first('textouno') }}
                        </p>
                    @endif
                </div>                
            </div>
            <div class="row">
                <div class="col-md-2 form-group">
                    <input type="checkbox" name="checkboxdos">
                    {!! Form::label('estatus', 'Habilitar', ['class' => 'control-label']) !!}
                </div>
                <div class="col-md-4 form-group">
                    <label>Imagen 2</label>
                    <input id="imagendos" type="text" name="imagendos" style="display:none;">
                    <input type='file' onchange="readURLfour(this);" />
                    <img style="width:auto;height:150px;" id="cargardos" src="#" alt="Sin imagen" />
                    <script type="text/javascript">
                        function readURLfour(input) {
                              if (input.files && input.files[0]) {
                                var reader = new FileReader();
                                reader.onload = function (e) {
                                    var imagen = document.getElementById('imagendos');
                                    imagen.value = e.target.result;
                                    $('#cargardos')
                                    .attr('src', e.target.result)
                                    .width('auto')
                                    .height(150);
                                };
                                reader.readAsDataURL(input.files[0]);
                              }
                            }
                    </script>
                    <p class="help-block"></p>
                    @if($errors->has('imagendos'))
                        <p class="help-block">
                            {{ $errors->first('imagendos') }}
                        </p>
                    @endif
                </div>
                <div class="col-md-6 form-group">
                    {!! Form::label('textodos', 'Texto 2 *', ['class' => 'control-label']) !!}
                    <textarea class="form-control" rows="10" cols="50" style="resize:none" name="textodos">
                    </textarea>
                    <p class="help-block"></p>
                    @if($errors->has('textodos'))
                        <p class="help-block">
                            {{ $errors->first('textodos') }}
                        </p>
                    @endif
                </div>                
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('facebook', 'Página de Facebook *', ['class' => 'control-label']) !!}
                    {!! Form::text('facebook', old('facebook'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('facebook'))
                        <p class="help-block">
                            {{ $errors->first('facebook') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('twitter', 'Perfil de Twitter *', ['class' => 'control-label']) !!}
                    {!! Form::text('twitter', old('twitter'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('twitter'))
                        <p class="help-block">
                            {{ $errors->first('twitter') }}
                        </p>
                    @endif
                </div>
            </div>           
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('website', 'Sitio web *', ['class' => 'control-label']) !!}
                    {!! Form::text('website', old('website'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('website'))
                        <p class="help-block">
                            {{ $errors->first('website') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    <input type="text" name="idPrograma" value="{{$id}}" hidden>
                    <!--select name="" hidden>
                        @ if (count($programas) > 0)
                        @ foreach ($programas as $programa)
                            < option value="{ {$programa[0]->idPrograma}}">{ {$programa->nombre}}</option>
                        @ endforeach
                        @ endif
                    </select-->
                    <p class="help-block"></p>
                    @if($errors->has('idPrograma'))
                        <p class="help-block">
                            {{ $errors->first('idPrograma') }}
                        </p>
                    @endif
                </div>
            </div>           
        </div>
    </div>

    {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-success left-space-startupmexico']) !!}
    {!! Form::close() !!}
    <a class="btn btn-danger left-space-startupmexico" href="{{ url('admin/aplicaciones',['id' => $id]) }}">@lang('global.app_cancel')</a>
@stop