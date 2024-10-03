@extends('layouts.app')

@section('title', __('Users'))

@section('content')
<div class="page-header">
    <h1 class="page-title">@lang('Users')</h1>
    <div class="page-options">
        <form method="get" action="{{ route('settings.users.index') }}" autocomplete="off" class="d-flex">
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
                    <a href="{{ route('settings.users.create') }}" class="btn btn-success">
                        <i class="fe fe-plus"></i> @lang('Create new user')
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
                                <th>@lang('Name')</th>
                                <th>@lang('E-mail')</th>
                                <th class="text-right">@lang('Action')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $item)
                            <tr>
                                <td>
                                    <a href="{{ route('settings.users.edit', $item) }}">{{ $item->name }}</a>
                                </td>
                                <td>
                                    {{ $item->email }}
                                </td>
                                
                                <td class="text-right">
                                    <form method="post" action="{{ route('settings.users.destroy', $item) }}" onsubmit="return confirm('@lang('Confirm delete?')');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-secondary btn-clean">
                                            <i class="fe fe-trash"></i> @lang('Delete')
                                        </button>
                                    </form>
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
                <i class="fe fe-alert-triangle mr-2"></i> @lang('No users found')
            </div>
        @endif

    </div>
    
</div>
@stop