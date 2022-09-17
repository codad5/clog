@extends('layouts.app')

@section('adminpanel')
<a href="/posts/create" class="btn btn-success">Create New Post</a>
@endsection

@section('content')
        <div class="jumbotron text-center">
            <h1>Welcome to CLOG by <code> <a href="https://github.com/codad5">Codad5</a></code></h1>
            <p>This is my personal blog</p>
            <p>
                <a href="/https://twitter.com/codad5_" class="btn btn-primary btn-lg" role="button">Contact me</a>
                <a href="mailto:aniezeoformic@gmail.com" class="btn btn-primary btn-lg btn-success" role="button">Email Me</a>

            </p>
        </div>
        <h1>Recent Posts</h1>
        @if(count($posts) > 0)
        @foreach($posts as $post)
        <div class="well">
            <div class="row">
                <div class="col-md-4 col-sm-4">
                    <img style="width:100%;" src="/storage/cover_image/{{$post->cover_image}}" />
                </div>
                <div class="col-md-8 col-sm-8">
                    <h3><a href="/posts/{{$post->id}}">{{$post->title}}</a></h3>
                    <small>Written on {{$post->created_at}}</small>
                </div>
            </div>
        
        </div>
        @endforeach
        {{$posts->links()}}
        @else
        <p>No posts to show.</p>
        @endif
@endsection

