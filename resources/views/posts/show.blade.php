@extends('layouts.app')


@section('adminpanel')
    <a href="/posts/create" class="btn btn-success" >Create</a>
    @if(Auth::check())
    @if(Auth::user()->id == $post->user->id)
    <a href="/posts/{{$post->id}}/edit" class="btn btn-default">Edit</a>
    
    {!! Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'pull-right']) !!}
    {{ Form::hidden('_method', 'DELETE') }}
    {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
    {!! Form::close() !!}
    @endif
    @endif
@endsection

@section('content')
<a href="/posts" class="btn btn-default" >Go back</a>
<h1>{{$post->title}}</h1>
<br>
<img style="width:100%;max-height:200px;" src="/storage/cover_image/{{$post->cover_image}}" />

<hr>


<div>
    {!! $post->body !!}
</div>
<hr/>
<small>Written on {{$post->created_at}} by {{ $post->user->name }}</small>
<hr/>

@endsection
