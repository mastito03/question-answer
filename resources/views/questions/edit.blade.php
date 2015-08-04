
@extends('main')

@section('content')

<div class="row">
  <div class="col-sm-9">
{!! Form::model($question,['method' => "PATCH",'route' => ['questions.update',$question->id],]) !!}

@include('questions.partials.form')

    <div class="form-group">
      <label>Revision message</label>
{!! Form::text('revision_message',null,['class' => 'form-control',]) !!}

    </div>
{!! Form::submit('Submit',['class' => 'btn btn-default',]) !!}

{!! Form::close() !!}

  </div>
@include('partials.aside')

</div>
@stop
