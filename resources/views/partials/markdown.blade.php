
@section('style')

<link rel="stylesheet" href="{{ url('css/bootstrap-markdown/bootstrap-markdown.min.css') }}"/>
@show

@section('script')

<script src="{{ url('js/bootstrap-markdown/bootstrap-markdown.js') }}"></script>
<script>
  $('#markdown').markdown({
      autofocus:false,
      savable:false,
      resize:'vertical',
      fullscreen:false,
  });
</script>
@show
