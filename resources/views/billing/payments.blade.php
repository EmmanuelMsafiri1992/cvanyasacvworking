@extends('layouts.app')

@section('title', __('Payments'))

@section('content')
<div class="page-header">
    <h1 class="page-title">@lang('Payments')</h1>
    <div class="page-options">
        <form method="get" action="{{ route('settings.payments') }}" autocomplete="off" class="d-flex">
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
                        <button class="btn btn-primary" type="submit">
                            <i class="fe fe-filter"></i>
                        </button>
                    </span>
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
                                <th>@lang('User')</th>
                                <th>@lang('Package')</th>
                                <th>@lang('Gateway')</th>
                                <th colspan="2">@lang('Total')</th>
                                <th>@lang('Date')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $item)
                            <tr>
                                <td>
                                    {{ $item->user->name }}
                                </td>
                                <td>
                                    {{ $item->package->title }}
                                </td>
                                <td>
                                    @lang('saas.payment_' . $item->gateway)
                                    <div class="small text-muted">{{ $item->reference }}</div>
                                </td>
                                <td>
                                    {{ $item->total }}
                                    {{ $item->currency }}
                                </td>
                                <td>
                                    @if($item->is_paid)
                                        <span class="text-green"><i class="fe fe-check"></i> @lang('Paid')</span>
                                    @else
                                        <span class="text-muted"><i class="fe fe-minus"></i> @lang('Not paid')</span>
                                    @endif
                                </td>
                                <td>
                                    {{ $item->created_at->format('H:i M d, Y') }}
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
                <i class="fe fe-alert-triangle mr-2"></i> @lang('No payments found')
            </div>
        @endif

    </div>
    
</div>
@stop
