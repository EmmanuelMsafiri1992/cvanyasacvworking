@extends('layouts.app')

@section('title', __('Resume Categories'))

@section('content')
<div class="page-header">
    <h1 class="page-title">@lang('Resume Categories')</h1>
    <div class="page-options">
        <form method="get" action="{{ route('settings.resumetemplatecategories.index') }}" autocomplete="off" class="d-flex">
            <div class="input-icon ml-2">
                <span class="input-icon-addon">
                    <i class="fe fe-search"></i>
                </span>

                <div class="input-group">
                    <div class="input-icon ml-2">
                        <span class="input-icon-addon">
                            <i class="fe fe-search"></i>
                        </span>
                        <input type="text" name="search" value="{{ Request::get('search') }}" class="form-control" placeholder="@lang('Search')">
                    </div>

                    <span class="input-group-btn ml-2 mr-4">
                        
                    </span>
                    <a href="{{ route('settings.resumetemplatecategories.create') }}" class="btn btn-success">
                        <i class="fe fe-plus"></i> @lang('Create')
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="row">
        <div class="col-md-2">
                @include('partials.settings-sidebar')
            </div>
    <div class="col-md-10">

        @if($data->count() > 0)
            <div class="card">
                <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap">
                        <thead class="thead-dark">
                            <tr>
                                <th>Image</th>
                                <th>@lang('Name')</th>
                                <th>@lang('Date Created')</th>
                                <th>@lang('Date Modified')</th>
                                <th>@lang('Action')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $item)
                            <tr>
                                <td><img src="{{ URL::to('/') }}/images/categories/{{ $item->thumb }}" class="img-thumbnail" style="max-width: 100px; max-height: 100px;" /></td>

                                <td>

                                    <a href="{{ route('settings.resumetemplate.edit', $item) }}">{{ $item->name }}</a>
                                </td>
                                
                               <td>
                                <div class="small text-muted">
                                        {{$item->created_at->format('M j, Y')}}
                                </div>
                                </td>
                                <td>
                                        <div class="small text-muted">
                                                {{$item->updated_at->format('M j, Y')}}
                                        </div>
                                </td>
                                
                                <td>
                                     <div class="d-flex">
                                        <div class="p-1 ">
                                             <a href="{{ route('settings.resumetemplatecategories.edit', $item) }}" class="btn btn-sm btn-primary">@lang('Edit')</a>
                                        </div>
                                        <div class="p-1 ">
                                                <form method="post" action="{{ route('settings.resumetemplatecategories.destroy', $item) }}" onsubmit="return confirm('@lang('Confirm delete?')');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger btn-clean">
                                                        @lang('Delete')
                                                    </button>
                                                </form>
                                        </div>
                                    </div>
                                   
                                    
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif

        {{ $data->appends( Request::all() )->links() }}

        @if($data->count() == 0)
            <div class="alert alert-primary text-center">
                <i class="fe fe-alert-triangle mr-2"></i> @lang('No Category found')
            </div>
        @endif

    </div>
    
</div>
@stop