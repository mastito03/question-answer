
@extends('main')

@section('content')

<div class="row">
  <div class="col-sm-9">
{!! Form::open(['route' => 'questions.store',]) !!}

@include('questions.partials.form')

{!! Form::submit('Submit',['class' => 'btn btn-default',]) !!}

{!! Form::close() !!}

  </div>
@include('partials.aside')

</div>
@stop
