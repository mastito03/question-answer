
@extends('main')

@section('content')

<div class="row">
  <div class="col-sm-9">
    <h3>{{ $title }}</h3>
    <div>{!! $content !!}</div>
{!! Form::open(['route' => $route,]) !!}

    <div class="form-group">
      <label>Comment<small>required</small></label>
{!! Form::text('content',null,['required','class' => 'form-control',]) !!}

    </div>
{!! Form::submit('Submit',['class' => 'btn btn-default',]) !!}

{!! Form::close() !!}

  </div>
@include('partials.aside')

</div>
@stop
