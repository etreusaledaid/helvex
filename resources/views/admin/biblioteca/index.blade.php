@extends('layouts.app')
@section('content')

@can('gestion_usuarios')
<div class="row">
@foreach ($usuarios as $usuario)
	<a class="program col-md-3" href="{{ url('admin/detalle', ['id' => $usuario->usuario]) }}">
		<div class="panel panel-default subtle-shadow-startupmexico">
			<img src="/images/file.png" style="width: 30px;"><br><br>
			<p class="program__title">{{$usuario->name}}</p>
		</div>
	</a>
@endforeach
</div>
@endcan

@cannot('gestion_usuarios')
@foreach ($archivos as $archivo)
<div class="program col-md-4">
	<div class="panel panel-default subtle-shadow-startupmexico">
        <?php
        $info = pathinfo($archivo->archivo);
          if ($info["extension"] == "pdf"){?>
            <embed src="{{$s3}}/{{$userId}}/{{$archivo->archivo}}" alt="" height="100%" width="100%" class="img-responsive" type='application/pdf'>
        <?php }else{?>
			<img src="{{$s3}}/{{$userId}}/{{$archivo->archivo}}" alt="" height="100%" width="100%" class="img-responsive"/>
        <?php }; ?>
		<p><b>Programa:</b> {{$archivo->nombre}}</p>
		<p><b>Formulario:</b> {{$archivo->formulario}}</p>
		<p><b>Pregunta:</b> {{$archivo->Pregunta}}</p>
	</div>
</div>
@endforeach
@endcan

@endsection