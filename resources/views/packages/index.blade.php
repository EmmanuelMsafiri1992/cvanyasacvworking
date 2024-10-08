@extends('layouts.app')

@section('title', __('Packages'))

@section('content')
<div class="page-header">
    <h1 class="page-title">@lang('Packages')</h1>
    <div class="page-options">
        <a href="{{ route('settings.packages.create') }}" class="btn btn-success">
            <i class="fe fe-plus"></i> @lang('Create new package')
        </a>
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
                                <th>@lang('Title')</th>
                                <th>@lang('Price')</th>
                                <th class="text-right">@lang('Action')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $item)
                            <tr>
                                <td>
                                    <a href="{{ route('settings.packages.edit', $item) }}">{{ $item->title }}</a>
                                    <div class="small text-muted">
                                            {{$item->interval_number}} {{$item->interval}}
                                    </div>
                                </td>
                              
                                <td>
                                    <span class="tag">{{ config('rb.CURRENCY_SYMBOL') }}{{ $item->price }} {{ config('rb.CURRENCY_CODE') }}</span>
                                </td>
                                <td class="text-right">
                                    <form method="post" action="{{ route('settings.packages.destroy', $item) }}" onsubmit="return confirm('@lang('Confirm delete?')');">
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
                <i class="fe fe-alert-triangle mr-2"></i> @lang('No packages found')
            </div>
        @endif

    </div>
    
</div>
@stop