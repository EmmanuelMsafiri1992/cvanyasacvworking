@extends('layouts.app')

@section('title', $package->title)

@section('content')

    <div class="row">
        <div class="col-md-6 col-lg-4 order-2 order-md-1">

                <div class="card">
                        @if ($package->is_featured)
                            <div class="card-status bg-success"></div>
                        @endif
                        <div class="card-body text-center">
                            <div class="card-category">{{ $package->title }}</div>
                            <div class="display-4 my-4">{{ $currency_symbol }}{{ $package->wholeprice }}.{{ $package->fraction_price }}</div>
                            <p><div class="h4 text-muted" >
                                    {{$package->interval_number}} {{$package->interval}}                      
                                </div></p>
                            <ul class="list-unstyled">
                                <li><i class="fe fe-x text-success mr-2"></i> @lang('Unlimited resumes and cover letters')</li>
                                <li><i class="fe fe-x text-success mr-2"></i> @lang('Free templates and colors')</li>
                                <li><i class="fe fe-x text-{{ $package->settings["template_premium"] ? 'success' : 'danger' }} mr-2"></i> @lang('Premium templates and colors')</li>
                                <li><i class="fe fe-x text-{{ $package->settings['export_pdf'] ? 'success' : 'danger' }} mr-2"></i> @lang('Unlimited PDF downloads')</li>
                            </ul>
                            <div class="text-center mt-6">
                                    <a href="{{ route('billing.index') }}" class="btn btn-primary btn-block">
                                        @lang('View all plan')
                                    </a>
                            </div>
                        </div>
                </div>

        </div>
        <div class="col-md-6 col-lg-8 order-1 order-md-2">

            <div class="card">
                    <div class="card-status bg-blue"></div>
                <div class="card-header">
                    <h3 class="card-title">@lang('Choose a payment method')</h3>
                </div>
                <div class="card-body">

                    @if(config('services.stripe.key') && config('services.stripe.secret'))
                    <div class="row align-items-center">
                        <div class="col-md-6 text-center">
                            <img src="{{ asset('img/visa.svg') }}" alt="Visa">
                            <img src="{{ asset('img/mastercard.svg') }}" alt="MasterCard">
                        </div>
                        <div class="col-md-6">
                            <form action="{{ route('gateway.purchase', [$package, 'stripe']) }}" id="stripe-billing-form" method="POST">
                                @csrf
                                <button type="button" id="stripe-pay" class="btn btn-green btn-block">
                                    @lang('Pay using Stripe')
                                </button>
                            </form>
                        </div>
                    </div>

                    <hr>
                    @endif

                    @if(config('services.paypal.client_id') && config('services.paypal.secret'))
                    <div class="row align-items-center">
                        <div class="col-md-6 text-center">
                            <img src="{{ asset('img/paypal.svg') }}" alt="PayPal">
                        </div>
                        <div class="col-md-6">
                            <form action="{{ route('gateway.purchase', [$package, 'paypal']) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary btn-block">
                                    @lang('Pay using PayPal')
                                </button>
                            </form>
                        </div>
                    </div>
                    @endif

                </div>
            </div>

        </div>
    </div>

    @if(config('services.stripe.key') && config('services.stripe.secret'))
        <script src="https://checkout.stripe.com/checkout.js"></script>
        <script>
        "use strict";
        
        var handler = StripeCheckout.configure({
            key: '{{ config('services.stripe.key') }}',
            image: '{{ asset('img/secure-payment.png') }}',
            locale: 'auto',
            token: function(token) {

                var purchaseForm = document.getElementById('stripe-billing-form');

                var inputStripeToken = document.createElement('input');
                inputStripeToken.type = 'hidden';
                inputStripeToken.name = 'stripeToken';
                inputStripeToken.value = token.id;
                purchaseForm.appendChild(inputStripeToken);

                var inputStripeTokenType = document.createElement('input');
                inputStripeTokenType.type = 'hidden';
                inputStripeTokenType.name = 'stripeTokenType';
                inputStripeTokenType.value = token.type;
                purchaseForm.appendChild(inputStripeTokenType);

                var inputstripeEmail = document.createElement('input');
                inputstripeEmail.type = 'hidden';
                inputstripeEmail.name = 'stripeEmail';
                inputstripeEmail.value = token.email;
                purchaseForm.appendChild(inputstripeEmail);

                purchaseForm.submit();

            }
        });

        window.addEventListener('popstate', function() {
            handler.close();
        });

        document.getElementById('stripe-pay').addEventListener('click', function(e) {
            handler.open({
                amount: '{{ $package->price_in_cents }}',
                currency: '{{ $currency_code }}',
                email: '{{ request()->user()->email }}',
                name: '{{ $package->title }}',
                description: '@lang('saas.interval_' . $package->interval)',
            });
            e.preventDefault();
        });
        </script>
    @endif

@endsection