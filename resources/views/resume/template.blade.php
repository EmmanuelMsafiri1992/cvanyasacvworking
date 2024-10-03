@extends('layouts.app')

@section('title', __('Resume'))

@section('content')

<div class="row">
  <div class="col-sm-12">
    <div class="page-header">
      <h1 class="page-title">
      @lang('Choose a Template')
      </h1>
    </div>
    <ul class="categories-list nav border-0 flex-column flex-lg-row">
      <li class="categories-item">
          <a href="{{ url('resume/template')}}" class="categories-link {{ (request()->is('resume/template')) ? 'categories-link-isCurrent' : '' }}">@lang("All Templates")</a>
        </li>
      @foreach($categories as $item)
        <li class="categories-item">
          <a href="{{ url('resume/template/'). '/' .$item->id}}" class="categories-link {{ request()->is('resume/template/'.$item->id) ? 'categories-link-isCurrent' : '' }}">{{$item->name}}</a>
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
        <div class="row mt-5 ml-3">
    {{ $data->appends( Request::all() )->links() }}
  </div>
   <div class="row">
      <div class="col-sm-12">
     @if($data->count()== 0)
      <h1 class="page-title">Not found template</h1>
     @endif
   </div>
   </div>
       
</div>
        

        
@stop
