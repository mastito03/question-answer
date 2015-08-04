
@extends('main')

@section('content')

<div class="row">
  <div class="col-sm-9">
{!! Form::open(['url' => 'auth/login','class' => 'form-horizontal',]) !!}

    <div class="form-group">
      <label for="email">Email</label>
{!! Form::email('email',old('email'),['required','id' => 'email','class' => 'form-control',]) !!}

    </div>
    <div class="form-group">
      <label for="password">Password</label>
{!! Form::password('password',null,['required','id' => 'password','class' => 'form-control',]) !!}

    </div>
    <div class="form-group">
      <label for="remember">
{!! Form::checkbox('remember',null,null,['id' => 'remember','class' => 'form-control',]) !!}

      </label>
    </div>
{!! Form::submit('Login',['class' => 'btn btn-default',]) !!}

{!! Form::close() !!}

  </div>
</div>
@stop
