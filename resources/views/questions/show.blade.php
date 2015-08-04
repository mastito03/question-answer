
@extends('main')

@section('content')

<div class="row">
  <div class="col-sm-12">
    <div class="page-header"><a href="{{ route('questions.show', $question->id) }}">
        <h1>{{ $question->title }}</h1></a></div>
  </div>
  <div class="col-sm-12">
    <div class="row">
      <div class="col-sm-9">
        <div class="media">
          <div class="media-left">
{!! Form::open(['route' => ['questions.upvote',$question->id],]) !!}

@if($question->isUpVoted(auth()->user()))

            <button type="submit" class="btn btn-link">
              <h4 class="glyphicon glyphicon-arrow-up"></h4>
            </button>
@else

            <button type="submit">
              <h4 class="glyphicon glyphicon-arrow-up"></h4>
            </button>
@endif

{!! Form::close() !!}

            <h4>{{ $question->votes }}</h4>
{!! Form::open(['route' => ['questions.downvote',$question->id],]) !!}

@if($question->isDownVoted(auth()->user()))

            <button type="submit" class="btn btn-link">
              <h4 class="glyphicon glyphicon-arrow-down"></h4>
            </button>
@else

            <button type="submit" class="btn btn-link">
              <h4 class="glyphicon glyphicon-arrow-down"></h4>
            </button>
@endif

{!! Form::close() !!}

{!! Form::open(['route' => ['questions.favorites',$question->id],]) !!}

@if($question->isFavorited(auth()->user()))

            <button type="submit" class="btn btn-link">
              <h4 class="glyphicon glyphicon-star-empty"></h4>
            </button>
@else

            <button type="submit" class="btn btn-link">
              <h4 class="glyphicon glyphicon-star"></h4>
            </button>
@endif

{!! Form::close() !!}

            <h4>{{ $question->favorites()->count() }}</h4>
          </div>
          <div class="media-body">
            <div>{!! $question->parsed_content !!}</div>
            <div>
@foreach($question->tags as $tag)
<span class="label label-primary">{{ $tag->name }}</span>
@endforeach

            </div>
            <div class="row">
              <div class="col-sm-6 col-xs-12">
                <ul class="list-inline">
                  <li><a href="{{ route('questions.edit', $question->id) }}">Edit</a></li>
                  <li><a href="{{ route('questions.comments.create', $question->id) }}">Comment</a></li>
                </ul>
              </div>
              <div class="col-sm-3 col-xs-6">
@if(isset($question->latestRevision))

                <p><small>edited {{ $question->updated_at->diffForHumans() }}</small></p>
@endif

              </div>
              <div class="col-sm-3 col-xs-6">
                <div class="bg-primary">
                  <p><small>asked {{ $question->created_at->diffForHumans() }}</small></p><img src="http://placehold.it/25x25&amp;text=[img]"/><a href="{{ route('users.show', $question->user->id) }}">{{ $question->user->name }}</a>
                </div>
              </div>
            </div>
            <ul class="list-unstyled">
@foreach($question->comments as $comment )

              <hr/>
              <li>{!! $comment->parsed_content !!} &ndash;&nbsp;<a href="{{ route('users.show', $comment->user->id) }}">{{ $comment->user->name }} &nbsp;</a><span class="text-muted">{{ $comment->created_at->diffForHumans() }}</span></li>
@endforeach

            </ul>
          </div>
        </div>
@if($answers->count() > 0)

        <nav>{{ $question->answers()->count() }} answers
          <ul class="nav nav-tabs pull-right">
            <li role="presentation" class="{{ $sort==='votes' ? 'active' : '' }}"><a href="?sort=votes">votes</a></li>
            <li role="presentation" class="{{ $sort==='newest' ? 'active' : '' }}"><a href="?sort=newest">newest</a></li>
            <li role="presentation" class="{{ $sort==='active' ? 'active' : '' }}"><a href="?sort=active">active</a></li>
          </ul>
        </nav>
@endif

@foreach($answers as $answer)

        <hr/>
        <div class="media">
          <div class="media-left">
{!! Form::open(['route' => ['questions.answers.upvote',$question->id, $answer->id],]) !!}

            <button type="submit" class="btn btn-link">
              <h4 class="glyphicon glyphicon-arrow-up"></h4>
            </button>
{!! Form::close() !!}

            <h4>{{ $answer->votes }}</h4>
{!! Form::open(['route' => ['questions.answers.downvote',$question->id, $answer->id],]) !!}

            <button type="submit" class="btn btn-link">
              <h4 class="glyphicon glyphicon-arrow-down"></h4>
            </button>
{!! Form::close() !!}

@if($question->user === Auth::user())
<a>
              <h4 class="glyphicon glyphicon-ok"></h4></a>
@else

@if($answer->accepted)

            <h4 class="glyphicon glyphicon-ok"></h4>
@endif

@endif

          </div>
          <div class="media-body">
            <div>{!! $answer->parsed_content !!}</div>
            <div class="row">
              <div class="col-sm-6 col-xs-12">
                <ul class="list-inline">
                  <li><a href="{{ route('questions.answers.edit', [$question->id, $answer->id]) }}">Edit</a></li>
                  <li><a href="{{ route('questions.answers.comments.create', [$question->id, $answer->id]) }}">Comment</a></li>
                </ul>
              </div>
              <div class="col-sm-3 col-xs-6"></div>
              <div class="col-sm-3 col-xs-6">
                <p><a href="{{ route('users.show', $answer->user->id) }}"> {{ $answer->user->name }}</a></p>
              </div>
            </div>
            <ul class="list-unstyled">
@foreach($answer->comments as $comment )

              <hr/>
              <li>{!! $comment->parsed_content !!} &ndash;&nbsp;<a href="{{ route('users.show', $question->user->id) }}"> {{ $comment->user->name }} &nbsp;</a><span class="text-muted"> {{ $comment->created_at->diffForHumans() }}</span></li>
@endforeach

            </ul>
          </div>
        </div>
@endforeach

        <div>{!! $answers->render(); !!}</div>
        <div class="row">
          <div class="col-sm-12">
@if(Auth::user())

{!! Form::open(['route' => ["questions.answers.store",$question->id],]) !!}

            <div class="form-group">
{!! Form::textarea('content',null,['id' => 'markdown','class' => 'form-control',]) !!}

            </div>
{!! Form::submit('Submit',['class' => 'btn btn-default',]) !!}

{!! Form::close() !!}

@else

            <p>Please login to write your answer</p><a href="{{ url('auth/login') }}" class="btn btn-default">Login</a>
@endif

          </div>
        </div>
      </div>
@include('partials.aside')

    </div>
  </div>
</div>
@stop

@include('partials.markdown')
