<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>

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
                    <div class="section-title">
                        <h2>@lang('Choose a Template')</h2>
                    </div>
                    <div class="row">
                    <div class="col-sm-12">
                    
                    <ul class="categories-list nav border-0 flex-column flex-lg-row">
                      <li class="categories-item">
                          <a href="{{ url('templates')}}" class="categories-link {{ (request()->is('templates')) ? 'categories-link-isCurrent' : '' }}">@lang('All Templates')</a>
                        </li>
                      @foreach($categories as $item)
                        <li class="categories-item">
                          <a href="{{ url('templates'). '/' .$item->id}}" class="categories-link {{ request()->is('templates/'.$item->id) ? 'categories-link-isCurrent' : '' }}">{{$item->name}}</a>
                        </li>
                      @endforeach
                        
                        
                    </ul>
                    
                  </div>
  
                </div>

            <div class="list_teamplate">
              <div class="row">
                @if($data->count() > 0)
                @foreach($data as $item)
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
               
                @endif
              </div>
              <div class="row mt-5">
                {{ $data->appends( Request::all() )->links() }}
              </div>
               <div class="row mt-5">
                  <div class="col-sm-12">
                 @if($data->count()== 0)
                  <h1 class="page-title">@lang('Not found template')</h1>
                 @endif
               </div>
               </div>
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
       
        <script src="{{ asset('js/app.bundle.js') }}?v={{ config('rb.version') }}" type="text/javascript"></script>

       <script type="text/javascript">
        $(document).ready(function(){
    
    // Lift card and show stats on Mouseover
    $('.product-card').hover(function(){
            $(this).addClass('animate');
            $('div.carouselNext, div.carouselPrev').addClass('visible');
            
         }, function(){
            $(this).removeClass('animate');
            $('div.carouselNext, div.carouselPrev').removeClass('visible');
    }); 
    
});
    </script>
    </body>
</html>