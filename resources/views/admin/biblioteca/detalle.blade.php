@extends('layouts.app')
@section('content')

@foreach ($archivos as $archivo)
<div class="program col-md-4">
	<div class="panel panel-default subtle-shadow-startupmexico">
		<?php
        $info = pathinfo($archivo->archivo);
          if ($info["extension"] == "pdf"){?>
            <embed src="{{$s3}}/{{$id}}/{{$archivo->archivo}}" alt="" height="100%" width="100%" class="img-responsive" type='application/pdf'>
        <?php }else{?>
			<img src="{{$s3}}/{{$id}}/{{$archivo->archivo}}" alt="" height="100%" width="100%" class="img-responsive" />
        <?php }; ?>
		<p><b>Programa:</b> {{$archivo->nombre}}</p>
		<p><b>Formulario:</b> {{$archivo->formulario}}</p>
		<p><b>Pregunta:</b> {{$archivo->Pregunta}}</p>
	</div>
</div>
@endforeach

@endsection