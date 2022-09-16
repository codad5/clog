@extends('layouts.app')

@section('content')
<h1>Create Post</h1>
    {!! Form::open(['action' => 'PostsController@store', 'method' => 'post', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {!! Form::label('title', 'title') !!}
            {!! Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'title']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('body', 'body') !!}
            {!! Form::textarea('body', '', ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'body Text']) !!}
        </div>
        <div class="form-group">
            {{ Form::file('cover_image') }}
        </div>
        {{ Form::submit('Submit', ['class' => 'btn btn-primary']) }}
    {!! Form::close() !!}
@endsection
