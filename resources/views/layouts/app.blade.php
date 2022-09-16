<!doctype html>
<html lang="{{ config('app.locale') }}" >
    <head>
        <meta charset="uft-8">
        <meta http-equiv="X-UA-Compatible" content="IE-edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
        <link rel="stylesheet" href="http://localhost/wemall/css/bootstrap.min.css" />
        <title>{{ config('app.name', 'CLOG') }}</title>
    </head>
    <body>
        @include('include.nav')
        <div class="container container-fluid">
            @include('include.messages')
            <hr>
            {{-- //check if user is logged in --}}
            @if(Auth::check())
                <div class="row">
                    <div class="col-md-4 col-lg-4">
                        
                        @yield('adminpanel')
                        <hr>
                    </div>
                </div>
            @endif
            @yield('content')
        </div>
{{-- <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>0 --}}
<script src="https://cdn.ckeditor.com/ckeditor5/35.1.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor
                                .create( document.querySelector( '#article-ckeditor' ) )
                                .then( editor => {
                                        console.log( editor );
                                } )
                                .catch( error => {
                                        console.error( error );
                                } );
</script>
    </body>
</html>
