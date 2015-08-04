
@extends('main')

@section('content')

<div class="row">
  <div class="col-sm-9">
    <div>{!! $question->parsed_content !!}</div>
    <hr/>
{!! Form::model($answer,['method' => "PATCH",'route' => ['questions.answers.update', $question->id, $answer->id],]) !!}

    <div class="form-group">
      <label>Content<small>required</small></label>
{!! Form::textarea('content',null,['required','id' => 'markdown','class' => 'form-control',]) !!}
<small class="error">Content is required.</small>
    </div>
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

@include('questions.partials.markdown')
