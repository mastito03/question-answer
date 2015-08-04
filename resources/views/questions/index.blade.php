
@extends('main')

@section('content')

<div class="row">
  <div class="col-sm-9">
    <nav>Question
      <ul class="nav nav-tabs pull-right">
        <li role="presentation" class="active"><a href="#">active</a></li>
        <li role="presentation"><a href="#">featured<span class="badge">5</span></a></li>
        <li role="presentation" class="hidden-sm"><a href="#">week</a></li>
        <li role="presentation" class="hidden-sm"><a href="#">month</a></li>
      </ul>
    </nav>
    <div class="clearfix">
@forelse($questions as $question)

      <hr/>
      <div class="media">
        <div class="media-left">
          <h4>{{ $question->votes }}
            <div class="glyphicon glyphicon-arrow-up"></div>
          </h4>
          <h4>{{ $question->answers_count }}
            <div class="glyphicon glyphicon-comment"></div>
          </h4>
          <h4>0
            <div class="glyphicon glyphicon-eye-open"></div>
          </h4>
        </div>
        <div class="media-body"><a href="{{ route('questions.show', $question->id) }}">
            <h4 class="media-heading">{{ $question->title }}</h4></a>
          <p>{{ str_limit($question->striped_content,200) }}</p>
          <div class="row">
            <div class="col-sm-6 col-xs-12">
@foreach($question->tags as $tag)
<span class="label label-primary">{{ $tag->name }}</span>
@endforeach

            </div>
            <div class="col-sm-3 col-xs-6">
@if(isset($question->latestRevision))

              <p><small>edited {{ $question->updated_at }}</small></p>
@endif

            </div>
            <div class="col-sm-3 col-xs-6">
              <div class="bg-primary">
                <p><small>asked at {{ $question->created_at }}</small></p><img src="http://placehold.it/25x25&amp;text=[img]"/><a href="{{ route('users.show', $question->user->id) }}">{{ $question->user->name }}</a>
              </div>
            </div>
          </div>
        </div>
      </div>
@empty

      <hr/>
      <p>tidak ada isi</p>
@endforelse

    </div>
    <div>{!! $questions->render() !!}</div>
  </div>
@include('partials.aside')

</div>
@stop
