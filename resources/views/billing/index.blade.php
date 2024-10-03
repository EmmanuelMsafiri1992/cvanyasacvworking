@extends('layouts.app')

@section('title', __('Billing'))

@section('content')
    <div class="page-header">
        <h1 class="page-title">
            @lang('Billing')
        </h1>
    </div>

    @if($subscribed)
        <div class="alert text-center alert-success">
            <i class="fe fe-check mr-2"></i> @lang('Your subscription for <strong>:package</strong> package is currently active and expires in <strong>:expires_in</strong> days!', ['package' => $subscription_title, 'expires_in' => $subscription_expires_in])
        </div>
    @endif

    @if(!$subscribed)
        <div class="alert text-center alert-warning">
            <i class="fe fe-alert-triangle mr-2"></i>@lang('Your subscription has been ended. Please choose a plan and pay.')
        </div>
    @endif

    <div class="row">
        @foreach($packages as $package)
            <div class="col-sm-6 col-lg-{{ 12 / count($packages) }}">
               
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

    @if($subscribed)
        <div class="text-right">
            <form action="{{ route('billing.cancel') }}" method="POST" onsubmit="return confirm('@lang('Confirm cancel subscription?')');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-secondary btn-clean">
                    <i class="fe fe-x-circle"></i> @lang('Cancel subscription') &ndash; {{ $subscription_title }}
                </button>
            </form>
        </div>
    @endif

@endsection