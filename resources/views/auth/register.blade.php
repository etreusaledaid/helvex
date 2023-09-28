@extends('layouts.auth')

@section('content')
<div class="login register">
    <img class="circle" src="{{ asset('images/textura.svg') }}">
    <div class="container">
        <div class="row">
            <a class="logo" href="{{ url('http://www.helvex.com.mx/') }}">
                <img src="{{ asset('images/helvex.png') }}"> <!--{{ ucfirst(config('app.name')) }}-->
                <p>Plataforma de creación de programa empresarial</p>
            </a>
            <div class="col-md-6">
                <h1 class="title">Registro</h1>
                <div class="create-account">
                    <p>¿Ya tienes una cuenta?</p>
                    <a href="{{ url('/') }}">
                        <strong>iniciar Sesión</strong>
                    </a>
                </div>

                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="form-input{{ $errors->has('empresa_id') ? ' has-error' : '' }}">
                            <select id="empresa_id" name="empresa_id" class="form-control" required>
                              <option>Selecciona tu empresa</option>
                            </select>
                            @if ($errors->has('empresa_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('empresa_id') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div id="otra-compania-container" class="form-input" style="display:none;">
                            <input 
                                id="otra-compania" 
                                type="text" 
                                class="form-control" 
                                name="otraCompania" value="empresa" 
                                required 
                                autofocus 
                                placeholder="Nombre de la compañia"
                            />
                        </div>

                        <div class="form-input{{ $errors->has('name') ? ' has-error' : '' }}">
                            <input
                                id="name"
                                type="text"
                                class="form-control"
                                name="name"
                                value="{{ old('name') }}"
                                required
                                autofocus
                                placeholder="Nombre"
                            />

                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-input{{ $errors->has('telefono') ? ' has-error' : '' }}">
                            <input
                                id="telefono"
                                type="tel"
                                class="form-control"
                                name="telefono"
                                value="{{ old('telefono') }}"
                                required
                                autofocus
                                placeholder="Telefono"
                                minlength="8"
                                maxlength="15"
                                onkeypress='return event.charCode >= 48 && event.charCode <= 57'
                            />

                            @if ($errors->has('telefono'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('telefono') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-input{{ $errors->has('email') ? ' has-error' : '' }}">
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required placeholder="Correo">

                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-input{{ $errors->has('password') ? ' has-error' : '' }}">
                            <input id="password" type="password" class="form-control" name="password" required placeholder="Contraseña" minlength="8">

                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-input">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required placeholder="Confirmar Contraseña">
                        </div>

                        <div class="form-input">
                            <div class="col-md-10 col-md-offset-1">
                                <button type="submit" class="btn btn-primary btn-block btn-enter">
                                    Registrar
                                </button>
                            </div>
                        </div>
                    </form>
            </div>
        </div>
    </div>
</div>
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script>
  $(document).ready(function(){
    $.getJSON("/catalogo/empresas", function(result) {
      var $dropdown = $("#empresa_id");
      $.each(result, function() {
        $dropdown.append($("<option />").val(this.id).text(this.nombre));
      });
      $dropdown.append($("<option />").val('otra').text('otra'));
    });
    $('#empresa_id').on('change', function() {
      if (this.value === 'otra')
        $('#otra-compania-container').css({'display': ''});
      else
        $('#otra-compania-container').css({'display': 'none'});
    });
  });
</script>
<!--
extends('layouts.app')
-->