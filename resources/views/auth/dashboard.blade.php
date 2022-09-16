@extends('layouts.app')

@section('adminpanel')
<a href="/posts/create" class="btn btn-success">Create New Post</a>
@endsection

@section('content')
<h1>Welcome {{ Auth::user()->name }}</h1>
@if(count($posts) > 0)
<table class="table table-striped">
    <tr>
        <th>Title</th>
        <th></th>
        <th></th>
    </tr>
@foreach($posts as $post)
<tr>
    <td><a href="/posts/{{$post->id}}">{{$post->title}}</a></td>
    <td><a href="/posts/{{$post->id}}/edit" class="btn btn-alert">Edit</a></td>
    <td>
        {!! Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'pull-right']) !!}
        {{ Form::hidden('_method', 'DELETE') }}
        {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
        {!! Form::close() !!}
    </td>
</tr>
@endforeach
</table>
{{-- {{$posts->links()}} --}}
@else
<p>No posts to show.</p>
@endif
@endsection