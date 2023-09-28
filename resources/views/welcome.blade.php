<!-- landing page -->
<!doctype html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{$landings[0]->nombre}}</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <link type="text/css" rel="stylesheet" href="../../styles.css" />
    <link rel="stylesheet" type="text/css" href="css/app.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="{{ url('css/startupmexico.css') }}">
  </head>
  <body class="landings">
    @if (count($landings) > 0)
    @foreach ($landings as $landing)
    <nav>
        <div class="container">
            <img src="/images/helvex.png">
            @if (Route::has('auth.login'))
                <div class="pull-right links">
                    @if (Auth::check())
                        <a href="{{ url('/admin/home') }}">Home</a>
                        <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" style="pointer-events: none;">{{ Auth::user()->name }}</a>
                    @else
                        <a href="{{ url('/') }}">Inicio de sesión</a>
                        <a href="{{ url('/helvex/register') }}">Registro</a>
                    @endif
                </div>
            @endif   
        </div>

    </nav>
    <header style="background-image: url({{ $landing->banner }});">
        <div class="container">
            <img src="{{ $landing->logo }}"> 
            <p class="title"><?php echo $landing->nombre; ?></p>
        </div>
        <div class="curve"></div>
    </header>
    <div class="container content-body">
        <div class="row">
            <div class="col-sm-8">
                <div class="content-landing">
                    <h2><strong><?php echo $landing->titulo; ?></strong></h2>
                    <?php echo $landing->texto; ?>
                    <div class="row image-info">
                        <?php $estatusuno=""; if($landing->estatus_uno == 0){$estatusuno="hidden";}?>
                        <?php $estatusdos=""; if($landing->estatus_dos == 0){$estatusdos="hidden";}?>
                        <?php if($landing->texto_uno == ""){?>
                            <div class="col-sm-6" <?php echo $estatusuno;?>>
                               <div class="image-big image" style="background-image: url({{ $landing->imagen_uno }});"></div> 
                            </div>
                        <?php }else{?>
                            <div class="col-sm-6" <?php echo $estatusuno;?>>
                                <div class="image-small image" style="background-image: url({{ $landing->imagen_uno }});"></div>
                                <div class="text-content">
                                    <?php echo $landing->texto_uno; ?></p>
                                </div>
                            </div>
                        <?php }?>
                        <?php if($landing->texto_dos == ""){?>
                            <div class="col-sm-6" <?php echo $estatusdos;?>>
                               <div class="image-big image" style="background-image: url({{ $landing->imagen_dos }});"></div> 
                            </div>
                        <?php }else{?>
                            <div class="col-sm-6" <?php echo $estatusdos;?>>
                                <div class="image-small image" style="background-image: url({{ $landing->imagen_dos }});"></div>
                                <div class="text-content">
                                    <?php echo $landing->texto_dos; ?></p>
                                </div>
                            </div>
                        <?php }?>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 content-slider-landing">
                <div class="slider-landing">
                    @if (count($programas) > 0)
                    @foreach ($programas as $programa)
                    <h4><strong>Fecha de lanzamiento:</strong></h4>
                    <?php
                    setlocale(LC_ALL,"es_ES");
                    $string = \Carbon\Carbon::parse($programa->fecha_lanzamiento)->format('d/m/Y');
                    $date = DateTime::createFromFormat("d/m/Y", $string);
                    ?>
                    <p><?php echo strftime("%A %d de %B del %Y",$date->getTimestamp())?></p>
                    <h4><strong>Cierre de inscripciones:</strong></h4>
                    <?php
                        setlocale(LC_ALL,"es_ES");
                        $string2 = \Carbon\Carbon::parse($programa->fecha_cierre)->format('d/m/Y');
                        $date2 = DateTime::createFromFormat("d/m/Y", $string2);
                    ?>
                    <p><?php echo strftime("%A %d de %B del %Y",$date2->getTimestamp())?></p>
                    <h4><strong>Premiación:</strong></h4>
                    <?php
                        setlocale(LC_ALL,"es_ES");
                        $string3 = \Carbon\Carbon::parse($programa->fecha_premiacion)->format('d/m/Y');
                        $date3 = DateTime::createFromFormat("d/m/Y", $string3);
                    ?>
                    <p><?php echo strftime("%A %d de %B del %Y",$date3->getTimestamp())?></p>
                    @endforeach
                    @endif
                    <div class="row social-media">
                        <h4><strong>Vistanos en:</strong></h4>
                        <a class="col-xs-4" href="{{ $landing->facebook }}">
                            <img src="/images/facebook.png">
                            <p>facebook</p>
                        </a>
                        <a class="col-xs-4" href="{{ $landing->twitter }}">
                            <img src="/images/twitter.png">
                            <p>twitter</p>
                        </a>
                        <a class="col-xs-4" href="{{ $landing->website }}">
                            <img src="/images/web.png">
                            <p>website</p>
                        </a>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block"><a href="admin/formularioapp/aplicacion/<?php echo $idprograma;?>">CLICK AQUÍ PARA APLICAR</a></button>
                </div>
            </div>
        </div>
    </div>
    <footer style="background-image: url({{ asset('images/textura.svg') }});" >
        <div class="container">
            <p>
              Calzada Coltongo <strong>293</strong>, Colonia Industrial Vallejo, <strong>02300</strong> México D.F. <br>
              fundacion@helvex.com.mx <br>
              <strong>Tel.</strong> 5333 9469 <br>
            </p>            
        </div>
    </footer>
    @endforeach
    @endif    
  </body>
</html>