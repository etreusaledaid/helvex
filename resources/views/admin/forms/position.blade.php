@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')

    @foreach ($formularios as $formulario)
    <a href="{{ url('admin/forms',['id' => $id]) }}">
      <i class="fa fa-lg fa-angle-left"></i>
      <span class="backwards">@lang('global.app_return') al formulario</span>
    </a>
    @endforeach

    <h3 class="page-title">Re-ordenar @lang('global.forms.title')</h3><br>

    Arrastra los elementos a la posición deseada.

<style type="text/css">
[draggable] {
  -moz-user-select: none;
  -khtml-user-select: none;
  -webkit-user-select: none;
  user-select: none;
  /* Required to make elements draggable in old WebKit */
  -khtml-user-drag: element;
  -webkit-user-drag: element;
}

.column {
  width: 100%;
  padding-bottom: 5px;
  padding-top: 5px;
  text-align: center;
  cursor: move;
}

/*.column.dragElem {
  opacity: 0.4;
}*/
.column.over {
  border: 2px dashed #000;
  /*border-top: 2px solid blue;*/
}
</style>

    <div class="panel panel-default">
        <div class="panel-body table-responsive">
          <table class="table">                
              <tbody id="columns">
              @if (count($forms) > 0)
              {!! Form::model($forms, ['method' => 'PATCH', 'route' => ['admin.forms.updatetwo',$id]]) !!}   
                  <?php $contador=0;?>
                      @foreach ($forms as $form)
                        <?php $contador=$contador+1;?>
                        <input id="contador<?php echo $contador; ?>" class="form-control" type="text" name="contador<?php echo $contador; ?>" value="{{ $form->idPreguntas }}" style="display: none;">
                        <tr id="<?php echo $contador; ?>" class="column" draggable="true" data-entry-id="{{ $form->idPreguntas }}">
                            <?php if(($form->Titulo)==1){?>
                                <td>
                                  <h3><input id="pregunta<?php echo $contador; ?>" class="form-control" type="text" name="idPregunta<?php echo $contador; ?>" value="{{ $form->idPreguntas }}" style="display: none;">{{ $form->Pregunta }}</h3></td>
                            <?php }else{?>
                                <td><input id="pregunta<?php echo $contador; ?>" class="form-control" type="text" name="idPregunta<?php echo $contador; ?>" value="{{ $form->idPreguntas }}" style="display: none;">{{ $form->Pregunta }}</td>
                            <?php }?>
                        </tr>
                      @endforeach
                      <input id="totalConteo" class="form-control" type="text" name="idPrograma" value="<?php echo $contador;?>" style="display: none;">
                  @else
                      <tr>
                          <td colspan="9">@lang('global.app_no_entries_in_table')</td>
                      </tr>
                  @endif
              </tbody>
          </table>
          {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-success']) !!}
          {!! Form::close() !!}
        </div>
    </div>

<script>
var dragSrcEl = null;

function handleDragStart(e) {
  // Target (this) element is the source node.
  dragSrcEl = this;

  e.dataTransfer.effectAllowed = 'move';
  e.dataTransfer.setData('text/html', this.outerHTML);

  this.classList.add('dragElem');
}
function handleDragOver(e) {
  if (e.preventDefault) {
    e.preventDefault(); // Necessary. Allows us to drop.
  }
  this.classList.add('over');

  e.dataTransfer.dropEffect = 'move';  // See the section on the DataTransfer object.

  return false;
}

function handleDragEnter(e) {
  // this / e.target is the current hover target.
}

function handleDragLeave(e) {
  this.classList.remove('over');  // this / e.target is previous target element.
}

function handleDrop(e) {
  // this/e.target is current target element.

  if (e.stopPropagation) {
    e.stopPropagation(); // Stops some browsers from redirecting.
  }

  // Don't do anything if dropping the same column we're dragging.
  if (dragSrcEl != this) {
    // Set the source column's HTML to the HTML of the column we dropped on.
    //alert(this.outerHTML);
    //dragSrcEl.innerHTML = this.innerHTML;
    //this.innerHTML = e.dataTransfer.getData('text/html');
    this.parentNode.removeChild(dragSrcEl);
    var dropHTML = e.dataTransfer.getData('text/html');
    this.insertAdjacentHTML('beforebegin',dropHTML);
    var dropElem = this.previousSibling;
    addDnDHandlers(dropElem);

    var contador = document.getElementById('totalConteo').value;
    var i = +contador;
    document.getElementById('pregunta'+dragSrcEl.id).setAttribute('name','idPregunta'+this.id);
    document.getElementById('pregunta'+dragSrcEl.id).id = 'pregunta'+this.id;
    document.getElementById(dragSrcEl.id).id = this.id;

    document.getElementById('pregunta'+this.id).setAttribute('name','idPregunta'+0);
    document.getElementById('pregunta'+this.id).id = 'pregunta'+0;
    document.getElementById(this.id).id = 0;

    while(i >= 0){
      if(i==this.id && dragSrcEl.id>this.id){
        document.getElementById('pregunta'+i).setAttribute('name','idPregunta'+(i+1));
        document.getElementById('pregunta'+i).id = 'pregunta'+(i+1);
        document.getElementById(i).id = (i+1);      
      }else if(i<dragSrcEl.id && i>this.id && dragSrcEl.id>this.id){
        document.getElementById('pregunta'+i).setAttribute('name','idPregunta'+(i+1));
        document.getElementById('pregunta'+i).id = 'pregunta'+(i+1);
        document.getElementById(i).id = (i+1);
      }else if(i>dragSrcEl.id && i<this.id && dragSrcEl.id<this.id){
        document.getElementById('pregunta'+i).setAttribute('name','idPregunta'+(i-1));      
        document.getElementById('pregunta'+i).id = 'pregunta'+(i-1);
        document.getElementById(i).id = (i-1);
      }else if(dragSrcEl.id/this.id == 1){
        document.getElementById('pregunta'+0).setAttribute('name','idPregunta'+(+this.id -1));
        document.getElementById('pregunta'+0).id = 'pregunta'+(+this.id -1);
        document.getElementById(0).id = (+this.id -1);
        conteo();
      }else if(i == 0){
        if(dragSrcEl.id>this.id){
          document.getElementById('pregunta'+0).setAttribute('name','idPregunta'+(+this.id -1));
          document.getElementById('pregunta'+0).id = 'pregunta'+(+this.id -1);
          document.getElementById(0).id = (+this.id -1);
        }else if(dragSrcEl.id<this.id){
          document.getElementById('pregunta'+0).setAttribute('name','idPregunta'+(+this.id -1));
          document.getElementById('pregunta'+0).id = 'pregunta'+(+this.id -1);
          document.getElementById(0).id = (+this.id -1);
        }
      }
      i--;
    }
    conteo();
  }
  this.classList.remove('over');
  
  return false;
}

function conteo(){
  var contador = document.getElementById('totalConteo').value;
  var i = +contador;
  for (i=1; i<=contador; i++) {
    document.getElementById('contador'+i).value=document.getElementById('pregunta'+i).value;
  }
}

function handleDragEnd(e) {
  // this/e.target is the source node.
  this.classList.remove('over');

  /*[].forEach.call(cols, function (col) {
    col.classList.remove('over');
  });*/
}

function addDnDHandlers(elem) {
  elem.addEventListener('dragstart', handleDragStart, false);
  elem.addEventListener('dragenter', handleDragEnter, false)
  elem.addEventListener('dragover', handleDragOver, false);
  elem.addEventListener('dragleave', handleDragLeave, false);
  elem.addEventListener('drop', handleDrop, false);
  elem.addEventListener('dragend', handleDragEnd, false);

}

var cols = document.querySelectorAll('#columns .column');
[].forEach.call(cols, addDnDHandlers);
</script>

@stop

@section('javascript') 
    <!--script>
        window.route_mass_crud_entries_destroy = '{{ route('admin.forms.mass_destroy') }}';
    </script-->
@endsection