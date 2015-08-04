
<div class="form-group">
  <label>Title<small>required</small></label>
{!! Form::text('title',null,['required','class' => 'form-control',]) !!}
<small class="error">Title is required.</small>
</div>
<div class="form-group">
  <label>Content<small>required</small></label>
{!! Form::textarea('content',null,['required','id' => 'markdown','class' => 'form-control',]) !!}
<small class="error">Content is required.</small>
</div>
<div class="form-group">
  <label>Tags</label>
{!! Form::select('tags_list[]',$tags,null,['multiple','id' => 'tags','class' => 'form-control',]) !!}

</div>
@section('style')

<link rel="stylesheet" href="{{ url('css/select2/select2.min.css') }}"/>
@stop

@section('script')

<script src="{{ url('js/select2/select2.min.js') }}"></script>
<script>
  $('#tags').select2();
  
</script>
@stop

@include('partials.markdown')
