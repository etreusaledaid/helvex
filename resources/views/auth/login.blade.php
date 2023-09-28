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
                        <strong>¡Ups!</strong> Hubo problema para acceder con ese usuario.
                        <br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <h1 class="title">Login</h1>
                <div class="create-account">
                    <p>¿No tienes una cuenta?</p>
                    <a href="{{ route('register') }}">
                        <strong>crea tu cuenta</strong>
                    </a>
                </div>

                <form class="form-horizontal"
                      role="form"
                      method="POST"
                      action="{{ url('/') }}">
                    <input type="hidden"
                           name="_token"
                           value="{{ csrf_token() }}">

                    <div class="form-input{{ $errors->has('password') ? ' has-error' : '' }}">
                        <div>
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus placeholder="Correo">

                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-input{{ $errors->has('password') ? ' has-error' : '' }}">
                        <div>
                            <input id="password" type="password" class="form-control" name="password" required placeholder="Contraseña">

                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-input">
                        <a class="btn btn-reset-pass btn-link" href="{{ route('auth.password.reset') }}">
                            ¿Olvidaste tu contraseña?
                        </a>
                        <div class="checkbox checkbox-content">
                            <label>
                                <input class="checkbox-input" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Recordar contraseña
                            </label>
                        </div>
                    </div>

                    <div class="form-input">
                        <div>
                            <button type="submit" class="btn btn-primary btn-block btn-enter">
                                Iniciar Sesión
                            </button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection