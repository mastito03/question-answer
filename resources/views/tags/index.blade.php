
@extends('main')

@section('content')

<div class="row">
  <div class="col-sm-12"><a href="{{ route('tags.create') }}" class="btn btn-default pull-right">New</a>
    <div class="row">
@foreach($tags as $tag)

      <div class="col-sm-6 col-md-4 col-lg-2 panel"><a href="{{ route('tags.show',$tag->id) }}">
          <h4>{{ $tag->name }}</h4></a>
        <p>{{ str_limit($tag->striped_description,200) }}</p>
      </div>
@endforeach

    </div>
    <div>{!! $tags->render() !!}</div>
  </div>
</div>
@stop
