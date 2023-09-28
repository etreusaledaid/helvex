@extends('layouts.app')

@section('content')

@foreach ($landings as $landing)
    <a href="{{ url('admin/aplicaciones',['id' => $landing->Programa_idPrograma]) }}">
        <i class="fa fa-lg fa-angle-left"></i>
        <span class="backwards">@lang('global.programs.title')</span>
    </a>
    <h3 class="page-title">@lang('global.landing.title')</h3><br>

    
    <div class="panel panel-default">
        
        <div class="panel-body">
        {!! Form::model($landings, ['method' => 'PUT', 'route' => ['admin.landing.update', $landing->idLanding]]) !!}
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('url', 'URL del programa * (sin usar espacios en blanco)', ['class' => 'control-label']) !!}
                    <input class="form-control" type="text" name="url" value="{{ $landing->url }}">
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
                    <input class="form-control" type="text" name="nombre" value="{{ $landing->nombre }}">
                    <p class="help-block"></p>
                    @if($errors->has('nombre'))
                        <p class="help-block">
                            {{ $errors->first('nombre') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    <label>Logotipo</label>
                    <input id="logo" type="text" name="logo" value="{{$landing->logo}}" style="display:none;">
                    <input type='file' onchange="readURL(this);" />
                    <img style="width:auto;height:150px;" id="cargar" src="{{$landing->logo}}" alt="Sin imagen" />
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
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    <label>Banner</label>
                    <input id="banner" type="text" name="banner" value="{{$landing->banner}}" style="display:none;">
                    <input type='file' onchange="readURLtwo(this);" />
                    <img style="width:auto;height:150px;" id="cargartwo" src="{{$landing->banner}}" alt="Sin imagen" />
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
                    <input class="form-control" type="text" name="titulo" value="{{ $landing->titulo }}">
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
                    {!! Form::label('texto', 'Descripción del programa *', ['class' => 'control-label']) !!}
                    <textarea class="form-control" rows="20" cols="50" style="resize:none" name="texto">
                        <?php echo $landing->texto ?>
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
                    <?php $checkeduno=""; if($landing->estatus_uno == 1){$checkeduno="checked";}?>
                    <input type="checkbox" name="checkboxuno" <?php echo $checkeduno; ?>>
                    {!! Form::label('estatus', 'Habilitar', ['class' => 'control-label']) !!}
                </div>
                <div class="col-md-4 form-group">
                    <label>Imagen 1</label>
                    <input id="imagenuno" type="text" name="imagenuno" value="{{$landing->imagen_uno}}" style="display:none;">
                    <input type='file' onchange="readURLthree(this);" />
                    <img style="width:auto;height:150px;" id="cargaruno" src="{{$landing->imagen_uno}}" alt="Sin imagen" />
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
                        <?php echo $landing->texto_uno ?>
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
                    <?php $checkeddos=""; if($landing->estatus_dos == 1){$checkeddos="checked";}?>
                    <input type="checkbox" name="checkboxdos" <?php echo $checkeddos; ?>>
                    {!! Form::label('estatus', 'Habilitar', ['class' => 'control-label']) !!}
                </div>
                <div class="col-md-4 form-group">
                    <label>Imagen 2</label>
                    <input id="imagendos" type="text" name="imagendos" value="{{$landing->imagen_dos}}" style="display:none;">
                    <input type='file' onchange="readURLfour(this);" />
                    <img style="width:auto;height:150px;" id="cargardos" src="{{$landing->imagen_dos}}" alt="Sin imagen" />
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
                        <?php echo $landing->texto_dos ?>
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
                    {!! Form::label('facebook', 'Facebook *', ['class' => 'control-label']) !!}
                    <input class="form-control" type="text" name="facebook" value="{{ $landing->facebook }}">
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
                    {!! Form::label('twitter', 'Twitter *', ['class' => 'control-label']) !!}
                    <input class="form-control" type="text" name="twitter" value="{{ $landing->twitter }}">
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
                    {!! Form::label('website', 'Website *', ['class' => 'control-label']) !!}
                    <input class="form-control" type="text" name="website" value="{{ $landing->website }}">
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
                    <input id="idPrograma" type="text" name="idPrograma" value="{{$id}}" hidden>
                    <!--select id="idPrograma" name="idPrograma">
                        @ if (count($programas) > 0)
                        @ foreach ($programas as $programa)
                            <option value="{ {$programa->idPrograma}}">{ {$programa->nombre}}</option>
                        @ endforeach
                        @ endif
                    </select-->
                    <script>
                        document.getElementById("idPrograma").value = "{{$landing->Programa_idPrograma}}";
                    </script>
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
    {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-success']) !!}
    {!! Form::close() !!}
    <!--a class="btn btn-danger" href="{{ route('admin.landing.index') }}">@lang('global.app_cancel')</a-->
    <a class="btn btn-danger" href="{{ url('admin/aplicaciones',['id' => $landing->Programa_idPrograma]) }}">@lang('global.app_cancel')</a>
    @endforeach           
@stop