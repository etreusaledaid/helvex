@extends('layouts.auth')

@section('content')
<div class="login">
    <img class="circle" src="{{ asset('images/textura.svg') }}">
    <div class="container">
        <div class="row">
            <a class="logo" href="{{ url('http://www.helvex.com.mx/') }}">
                <img src="{{ asset('images/helvex.png') }}"> <!--{{ ucfirst(config('app.name')) }}-->
                <p>Plataforma de creación de programa empresarial</p>
            </a>
            <div class="col-md-6">
              @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>¡Ups!</strong> Hubo problemas con la entrada:
                        <br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <h1 class="title">Restablecer la contraseña</h1>
                <div class="create-account">
                    <p>¿Ya recordaste tu contraseña?</p>
                    <a href="{{ route('login') }}">
                        <strong>iniciar Sesión</strong>
                    </a>
                </div>

                <form class="form-horizontal"
                      role="form"
                      method="POST"
                      action="{{ url('password/reset') }}">
                      
                    <input type="hidden"
                           name="_token"
                           value="{{ csrf_token() }}">
                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="form-input{{ $errors->has('password') ? ' has-error' : '' }}">
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus placeholder="Correo">

                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-input{{ $errors->has('password') ? ' has-error' : '' }}">
                        <input id="password" type="password" class="form-control" name="password" required placeholder="Contraseña">

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
                        <button type="submit" class="btn btn-primary btn-block btn-enter">
                            Restablecer la contraseña
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection