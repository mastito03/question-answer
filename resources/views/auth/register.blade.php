
@extends('main')

@section('content')

<div class="row">
  <div class="col-sm-9">
{!! Form::open(['url' => 'auth/register','class' => 'form-horizontal',]) !!}

    <div class="form-group">
      <label for="name">Name</label>
{!! Form::text('name',old('name'),['required','id' => 'name','class' => 'form-control',]) !!}

    </div>
    <div class="form-group">
      <label for="email">Email</label>
{!! Form::email('email',old('email'),['required','id' => 'email','class' => 'form-control',]) !!}

    </div>
    <div class="form-group">
      <label for="password">Password</label>
{!! Form::password('password',null,['required','id' => 'password','class' => 'form-control',]) !!}

    </div>
    <div class="form-group">
      <label for="password_confirmation">Password confirmation</label>
{!! Form::password('password_confirmation',null,['required','id' => 'password_confirmation','class' => 'form-control',]) !!}

    </div>
{!! Form::submit('Register',['class' => 'btn btn-default',]) !!}

{!! Form::close() !!}

  </div>
</div>
@stop
