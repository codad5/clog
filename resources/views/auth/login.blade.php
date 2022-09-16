@extends('layouts.app')

@section('content')
    <h1>Login</h1>
    {!! Form::open(['action' => 'UsersAuthController@login', 'method' => 'POST']) !!}
        <div class="form-group">
            {{ Form::label('email', 'Email') }}
            {{ Form::email('email', '', ['class' => 'form-control', 'placeholder' => 'Email']) }}
        </div>
        <div class="form-group">
            {{ Form::label('password', 'Password') }}
            {{ Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password']) }}
        </div>
        {{ Form::submit('Submit', ['class' => 'btn btn-primary']) }}
    {!! Form::close() !!}
@endsection
    