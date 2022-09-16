@extends('layouts.app')

@section('content')
        <div class="jumbotron text-center">
            <h1>Welcome to CLOG</h1>
            <p>This is a laravel appliaction</p>
            <p>
                <a href="/login" class="btn btn-primary btn-lg" role="button">Login</a>
                <a href="/register" class="btn btn-primary btn-lg btn-success" role="button">Register</a>

            </p>
        </div>
@endsection
