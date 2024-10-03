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
                            <a class="nav-link" href="{{ route('templates') }}">@lang('All Templates')</a>
                                <a class="nav-link" href="#pricing">@lang('Pricing')</a>
                                <a class="nav-link" href="{{ route('resume.index') }}"><strong>{{ $user->name }}</strong></a>
                            @else
                                <a class="nav-link" href="{{ route('templates') }}">@lang('All Templates')</a>
                                <a class="nav-link" href="#pricing">@lang('Pricing')</a>
                                <a class="nav-link" href="{{ route('login') }}">@lang('Login')</a>
                                <a class="nav-link" href="{{ route('register') }}">@lang('Register')</a>
                            @endauth
                    </nav>
                </div>
            </div>
        </header>
        
            <main class="main">
                <section class="welcome welcome-blue text-white" aria-label="Page header">
            <div class="container">
                <div class="row align-items-center justify-content-between">
                    <div class="col-lg-6 text-center text-lg-left pr-lg-5">
                        <h1 class="welcome-title">@lang("Saas The Online Resume Builder You Deserve!")</h1>
                        <p class="welcome-description">
                            @lang("Creating a Professional Resume and Cover Letter Has Never Been So Easy")
                        </p>
        
                        <div class="mt-5">
                            <a href="{{ route('login') }}"  target="_blank" class="btn btn-green">@lang("CREATE MY RESUME NOW")</a>
                        </div>
                    </div>
                    <div class="col-lg-5 pt-6 pt-lg-0">
                        <div class="welcome-image welcome-image-2">
                            <img src="{{ asset('landingpage/default/img/dashboard-preview.png') }}" alt="" class="preview-image img-responsive">
        
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <section class="section bg-light" aria-label="Base features">
            <div class="container">
                <h2 class="h3 section-title text-center mb-6">@lang("Benefits of using a resume builder")</h2>
        
                <div class="row">
                    <div class="col-md-5" >
                            <picture class="image-feature">
                                <img src="{{ asset('landingpage/default/img/features.png') }}" alt="" class="img-resume img-responsive">

                            </picture>
                    </div>
                    <div class="col-md-7">
        
                        <div class="row content_icon_resume">
                            <div class="col-12 mb-5 d-flex">
                                <div class="icon icon-gray mr-2">
                                        <svg viewBox="0 0 37 56" ><path d="M18.5 55.84c-3.34 0-6.42-.84-9.24-2.53a18.27 18.27 0 0 1-9.13-15.9c0-2.45.5-4.8 1.49-7.03a19.01 19.01 0 0 1 4.12-5.95V13.6c0-2.35.57-4.5 1.7-6.43A12.84 12.84 0 0 1 18.5.79a12.84 12.84 0 0 1 11.05 6.38 12.51 12.51 0 0 1 1.71 6.43v10.83a19.01 19.01 0 0 1 4.12 5.95 17.2 17.2 0 0 1 1.49 7.04 18.27 18.27 0 0 1-9.13 15.89 17.69 17.69 0 0 1-9.24 2.53zm9.13-42.24a8.8 8.8 0 0 0-1.24-4.56 9.33 9.33 0 0 0-3.32-3.33 8.8 8.8 0 0 0-4.57-1.24 8.8 8.8 0 0 0-4.56 1.24 9.33 9.33 0 0 0-3.33 3.33 8.8 8.8 0 0 0-1.24 4.56v8.03a17.6 17.6 0 0 1 9.13-2.47c3.3 0 6.34.82 9.13 2.47V13.6zm-9.13 9.24c-2.64 0-5.09.66-7.34 1.98a15.1 15.1 0 0 0-5.37 5.23 14.18 14.18 0 0 0-2.03 7.4c0 2.65.68 5.13 2.04 7.45a14.95 14.95 0 0 0 12.7 7.26c2.64 0 5.1-.66 7.37-1.98a14.45 14.45 0 0 0 5.33-5.28 14.47 14.47 0 0 0 2.04-7.46c0-2.66-.68-5.12-2.04-7.4a14.25 14.25 0 0 0-5.33-5.25 14.58 14.58 0 0 0-7.37-1.95zm1.82 14.19v7.81h-3.64v-7.81a3.72 3.72 0 0 1-1.81-3.25c0-1.02.35-1.88 1.04-2.58.7-.7 1.56-1.04 2.59-1.04 1.03 0 1.89.34 2.59 1.04s1.04 1.56 1.04 2.58a3.71 3.71 0 0 1-1.81 3.25z" ></path></svg>
                                </div>
                                <div>
                                    <h3 class="h5">@lang("Cover Letter Builder")</h3>
                                    <p class="text-muted m-0">
                                        @lang("Write a cover letter using the same templates as your resume.")
                                    </p>
                                </div>
                            </div>
                            
                            
                            <div class="col-12 mb-5 d-flex">
                                <div class="icon icon-gray mr-2">
                                    <i class="fe fe-download download-icon-feature"></i>
                                </div>
                                <div>
                                    <h3 class="h5">@lang("Easy export PDF")</h3>
                                    <p class="text-muted m-0">
                                        @lang("Write a cover letter using the same templates and easy export PDF")
                                    </p>
                                </div>
                            </div>
                            <div class="col-12 mb-5 d-flex">
                                <div class="icon icon-gray mr-2">
                                        <i><svg viewBox="0 0 55 56" ><path d="M55 52.16v3.68H0V.79h3.63v30.19l14.74-8.14 13.09 13.09 21.73-14.91L55 24.66 31.13 41.1 17.82 27.79 3.63 35.6v16.56" ></path></svg></i>                                </div>
                                <div>
                                    <h3 class="h5">@lang("Multi Best Resume Templates")</h3>
                                    <p class="text-muted m-0">
                                            @lang("Create a modern and professional resume and cover letter.")
                                        </p>
                                    
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
        
                <!--<div class="mb-xl-4 text-center text-lg-left">-->
                    <!--<a href="#" class="btn btn-white">See all features</a>-->
                <!--</div>-->
            </div>
        </section>
        
        
        <section class="section" id="templates">
                <div class="container text-center">
                    <h2 class="section-title mb-2">@lang("Resume templates")</h2>
                    <p class="section-description">
                            @lang("Each template is expertly designed and follows the exact “resume rules” hiring managers look for.")
    
                        </p>
                         <div class="list_teamplate">
                                <div class="row">
                                      @foreach($templates as $item)
                                      <div class="col-md-4">
                                          <a href="{{ url('resume/createresume/' . $item->id) }}" class="nav-link">
                                          <div class="card">
                                              @if($item->is_premium)
                                                <span class="resume-premium">@lang("Premium")</span>
                                              @endif
                                              <img src="{{ URL::to('/') }}/images/{{ $item->thumb }}" class="card-img-top" alt="...">
                                              <div class="card-body">
                                                <h5 class="card-title">{{ $item->name }}</h5>
                                              </div>
                                            </div>
                                          </a>
                                      </div>
                                      @endforeach                  
                                </div>
                        </div>
                        <div class="mt-5">
                            <a href="{{ route('templates') }}" class="btn btn-green">@lang("View more")</a>
                        </div>
                        <p></p>
                        
                </div>
            </section>

            <section class="section bg-light" id="pricing">
                    <div class="container text-center">
                        <h2 class="section-title mb-2">@lang("Pricing")</h2>
                        <p class="section-description">
                                @lang("We accept all major payment methods and process payments with Stripe, Paypal SSL Secure / 256-bit SSL secure checkout.")
        
                        </p>
                        <div class="row">
                                @foreach($packages as $package)
                                    <div class="col-lg-{{ 12 / count($packages) }}">
                                       
                                        <div class="card">
                                            @if ($package->is_featured)
                                                <div class="card-status bg-success"></div>
                                            @endif
                                            <div class="card-body text-center">
                                                <div class="card-category">{{ $package->title }}</div>
                                                <div class="display-4 my-4">{{ $currency_symbol }}{{ $package->wholeprice }}.{{ $package->fraction_price }}</div>
                                                <p>
                                                    <div class="h4 text-muted" >
                                                        {{$package->interval_number}} {{$package->interval}}                      
                                                    </div>
                                                </p>
                                                <ul class="list-unstyled">
                                                    <li><i class="fe fe-x text-success mr-2"></i> @lang('Unlimited resumes and cover letters')</li>
                                                    <li><i class="fe fe-x text-success mr-2"></i> @lang('Free templates and colors')</li>
                                                    <li><i class="fe fe-x text-{{ $package->settings["template_premium"] ? 'success' : 'danger' }} mr-2"></i> @lang('Premium templates and colors')</li>
                                                    <li><i class="fe fe-x text-{{ $package->settings['export_pdf'] ? 'success' : 'danger' }} mr-2"></i> @lang('Unlimited PDF downloads')</li>
                                                </ul>
                                                <div class="text-center mt-6">
                                                        <a href="{{ route('billing.package', $package) }}" class="btn btn-{{ $package->is_featured == 1 ? 'success' : 'secondary' }} btn-block">
                                                                <i class="fe fe-check mr-2"></i> @lang('Choose plan')
                                                            </a>
                                                </div>
                                            </div>
                                        </div>
                        
                                    </div>
                                @endforeach
                            </div>
                            
                            
                    </div>
        </section>

        <section class="section text-center" aria-label="">
                <div class="container">
                    <div>
                        <blockquote>
                            <div>
                                <img src="{{ asset('landingpage/default/img/default-user.png')}}" alt="" class="avatar">
                                <p>@lang("I loved the great resume templates, and I loved the fact that I can have my cover letter in the same design.")</p>
                            </div>
                            <cite><strong>@lang("Bilal Mark")
                                </strong>
                        </blockquote>
                    </div>
                </div>
            </section>
        <section class="section bg-light">
            <div class="container text-center">
                <h2 class="section-title mb-2">@lang("400,000+ users")</h2>
                <p class="section-description">
                        @lang("Create your professional cover letter in just a few simple steps. Use the same template for your cover letter and resume.")

                    </p>
                    <div class="mt-5">
                        <a href="{{ route('login') }}" target="_blank" class="btn btn-green">@lang("CREATE MY RESUME NOW")</a>
                    </div>
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