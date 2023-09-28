{{-- validation errors --}}
@if($errors->count())
    <div class="row">
        <div class="col-lg-12">
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <span class="glyphicon glyphicon-remove"></span> {{ $errors->first() }}
            </div><!-- .alert -->
        </div><!-- .col-lg-12 -->
    </div><!-- .row -->
@endif

{{-- success message --}}
@if(session()->has('success'))
    <div class="row">
        <div class="col-lg-12">
            <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <span class="glyphicon glyphicon-ok"></span> {{ session('success') }}
            </div><!-- .alert -->
        </div><!-- .col-lg-12 -->
    </div><!-- .row -->
@endif

{{-- warning message --}}
@if(session()->has('warning'))
    <div class="row">
        <div class="col-lg-12">
            <div class="alert alert-warning alert-dismissable">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <span class="glyphicon glyphicon-remove"></span> {{ session('warning') }}
            </div><!-- .alert -->
        </div><!-- .col-lg-12 -->
    </div><!-- .row -->
@endif

{{-- error message --}}
@if(session()->has('error'))
    <div class="row">
        <div class="col-lg-12">
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <span class="glyphicon glyphicon-remove"></span> {{ session('error') }}
            </div><!-- .alert -->
        </div><!-- .col-lg-12 -->
    </div><!-- .row -->
@endif

{{-- deleted message --}}
@if(session()->has('deleted'))
    <div class="row">
        <div class="col-lg-12">
            <div class="alert alert-warning alert-dismissable">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <span class="glyphicon glyphicon-warning-sign"></span> {{ session('deleted.message') }}
                {!! Form::open(['class' => 'form-link', 'url' => session('deleted.undo')]) !!}
                    <button type="submit" class="btn-link">Deshacer</button>
                {!! Form::close() !!}
            </div><!-- .alert -->
        </div><!-- .col-lg-12 -->
    </div><!-- .row -->
@endif
