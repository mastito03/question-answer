
@extends('main')

@section('content')

<div class="row">
  <div class="col-sm-9">
{!! Form::open(['route' => 'tags.store',]) !!}

{!! Form::text('name',null,[]) !!}

{!! Form::textarea('description',null,[]) !!}

{!! Form::submit('Submit',['class' => 'btn btn-default',]) !!}

{!! Form::close() !!}

  </div>
@include('partials.aside')

</div>
@stop
