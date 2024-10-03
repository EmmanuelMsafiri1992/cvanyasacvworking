<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        @includeWhen(config('rb.GOOGLE_ANALYTICS'), 'partials.google-analytics')

        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="icon" href="{{ asset('img/favicon.png') }}" type="image/png">
        <title>{{ __(config('app.name')) }} &mdash; {{ __(config('rb.SITE_DESCRIPTION')) }}</title>
        <meta name="description" content="{{ config('rb.SITE_DESCRIPTION') }}">
        <meta name="keywords" content="{{ config('rb.SITE_KEYWORDS') }}">
        
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,600,700|Quicksand:700|Indie+Flower:400">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="{{ asset('css/app.bundle.css') }}?v={{ config('rb.version') }}">
        <link rel="stylesheet" href="{{ asset('landingpage/default/css/app.css') }}?v={{ config('rb.version') }}">


    </head>
    <body data-spy="scroll" data-target="#mainNav" data-offset="70">
                
        <div class="page">
        <header class="header js-header">
            <div class="container">
                <div class="d-flex align-items-center position-relative">
                    <a href="{{ route('landing') }}" class="logo">
                        <img src="{{ asset('img/logo.png') }}" alt="" title="">
                        <div>
                            {{ __(config('app.name')) }}
                        </div>
                    </a>
                    <nav class="ml-auto header-nav d-none d-md-block">
                            @auth
                                <a class="nav-link" href="{{ route('landing') }}">@lang('Home')</a>
                                <a class="nav-link" href="{{ route('templates') }}">@lang('All Templates')</a>
                                <a class="nav-link" href="{{ route('resume.index') }}"><strong>{{ $user->name }}</strong></a>
                            @else
                                <a class="nav-link" href="{{ route('landing') }}">@lang('Home')</a>
                                <a class="nav-link" href="{{ route('templates') }}">@lang('All Templates')</a>
                                <a class="nav-link" href="{{ route('login') }}">@lang('Login')</a>
                                <a class="nav-link" href="{{ route('register') }}">@lang('Register')</a>
                            @endauth
                    </nav>
                </div>
            </div>
        </header>
        <main class="main bg-light">
            <section class="section">
                <div class="container">
                    {!!$privacy!!}
                </div>
            </section>
        </main>
        
            <footer class="footer">
                <div class="container">
                    <div class="row text-center text-lg-left">
                        <div class="col-lg-6">
                                &copy; {{ date('Y') }} <a href="{{ config('app.url') }}" target="_blank">{{ __(config('app.name')) }}</a> &mdash; {{ __(config('rb.SITE_DESCRIPTION')) }}
                        </div>
                        <div class="col-lg-6 text-lg-right">
                            <a href="{{ route('privacy') }}">@lang('Privacy Policy')</a>
                            <a href="{{ route('terms') }}">@lang('Term and condition')</a>
                        </div>
                    </div>
                </div>
            </footer>
        
        </div>
        <a id="back-to-top" href="#" class="btn btn-light btn-lg back-to-top" role="button"><i class="fe fe-chevron-up"></i></a>
        <script src="{{ asset('js/app.bundle.js') }}?v={{ config('rb.version') }}" type="text/javascript"></script>

        <script>
        $(document).ready(function(){
            "use strict";

            $(window).scroll(function () {
                    if ($(this).scrollTop() > 50) {
                        $('#back-to-top').fadeIn();
                    } else {
                        $('#back-to-top').fadeOut();
                    }
                });
                
                // scroll body to 0px on click
                $( "#back-to-top" ).on( "click", function() {
                    $('body,html').animate({
                        scrollTop: 0
                    }, 200);
                    return false;
                });
        });
    </script>
    </body>
</html>