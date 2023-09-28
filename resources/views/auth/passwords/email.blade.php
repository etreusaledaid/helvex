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
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

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
                </div>
                <form class="form-horizontal"
                      role="form"
                      method="POST"
                      action="{{ url('password/email') }}">
                    <input type="hidden"
                           name="_token"
                           value="{{ csrf_token() }}">

                    <div class="form-input{{ $errors->has('password') ? ' has-error' : '' }}">
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus placeholder="Correo">

                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-input">
                        <button type="submit" class="btn btn-primary btn-block btn-enter-big">
                            Restablecer la contraseña
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection