<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials.head')
</head>

<body class="hold-transition skin-blue sidebar-mini" style="background-color: #f5f6f8;">
<div id="wrapper">

@include('partials.topbar')
@include('partials.sidebar')

<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        
        <!-- Main content -->
        <section class="content">
            @if(isset($siteTitle))
                <h3 class="page-title">
                    {{ $siteTitle }}
                </h3>
            @endif

            <!-- <div class="row"> -->
                <!-- <div class="col-md-12"> -->
                    @if (Session::has('message'))
                        <div class="note note-info">
                            <p>{{ Session::get('message') }}</p>
                        </div>
                    @endif
                    @if ($errors->count() > 0)
                        <div class="note note-danger">
                            <ul class="list-unstyled">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @yield('content')
                <!-- </div> -->
            <!-- </div> -->
        </section>
        <section class="footer">
            <a href="https://www.startupmexico.com" target="_blank"><p>Hecho por startupmexico</p></a>
        </section>
    </div>
</div>

{!! Form::open(['route' => 'auth.logout', 'style' => 'display:none;', 'id' => 'logout']) !!}
<button type="submit">Cerrar sesión</button>
{!! Form::close() !!}

@include('partials.javascripts')
</body>
</html>