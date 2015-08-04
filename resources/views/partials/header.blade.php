
@section('title')
Ask Elsword alpha
@stop

<div class="row header">
  <div class="col-xs-5"><a href="{{ url('/') }}">
      <h1>AskElsword<small>alpha</small></h1></a></div>
  <div class="col-xs-7">
    <ul class="list-inline pull-right">
@if(Auth::guest())

      <li><a href="{{ url('/auth/login') }}">Login</a></li>
      <li><a href="{{ url('/auth/register') }}">Register</a></li>
@else

      <li> Signed in as<a href="#" class="navbar-link"> {{ Auth::user()->name }}</a></li>
      <li><a href="{{ url('/auth/logout') }}">Logout</a></li>
@endif

      <li><a href="#">Help</a></li>
      <li>
        <form role="search" class="form-inline">
          <div class="input-group input-group-sm">
            <input type="search" class="form-control input-sm"/><span class="input-group-btn">
              <button class="btn btn-default">
                <div class="glyphicon glyphicon-search"></div>
              </button></span>
          </div>
        </form>
      </li>
    </ul>
    <ul class="nav nav-pills pull-right">
      <li class="{{ strpos(Request::url(), route('questions.index')) !== false ? 'active' : '' }}"><a href="{{ route('questions.index') }}">Question</a></li>
      <li class="{{ strpos(Request::url(), route('tags.index')) !== false ? 'active' : '' }}"><a href="{{ route('tags.index') }}">Tags</a></li>
      <li class="{{ strpos(Request::url(), route('users.index')) !== false ? 'active' : '' }}"><a href="{{ route('users.index') }}">User</a></li>
      <li class="{{ strpos(Request::url(), route('questions.unanswered')) !== false ? 'active' : '' }}"><a href="{{ route('questions.unanswered') }}">Unanswered</a></li>
      <li class="{{ strpos(Request::url(), route('questions.create')) !== false ? 'active' : '' }}"><a href="{{ route('questions.create') }}">Ask Question</a></li>
    </ul>
  </div>
</div>