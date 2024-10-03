@extends('layouts.app')

@section('title', __('Integrations'))

@section('content')
<div class="page-header">
    <h1 class="page-title">@lang('Integrations')</h1>
</div>

<div class="row">
        <div class="col-md-2">
                @include('partials.settings-sidebar')
            </div>
    <div class="col-md-10">
        <form role="form" method="post" action="{{ route('settings.update', 'integrations') }}" autocomplete="off">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6">
                        <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title"><i class="fe fe-credit-card mr-2"></i> @lang('PayPal')</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label">@lang('Environment')</label>
                                                <select name="settings[PAYPAL_SANDBOX]" class="form-control">
                                                    <option value="0" {{ config('services.paypal.sandbox') == false ? 'selected' : '' }}>@lang('Live')</option>
                                                    <option value="1" {{ config('services.paypal.sandbox') == true ? 'selected' : '' }}>@lang('Sandbox')</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">@lang('Client ID')</label>
                                                <input type="text" name="settings[PAYPAL_CLIENT_ID]" value="{{ config('services.paypal.client_id') }}" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">@lang('Secret')</label>
                                                <input type="text" name="settings[PAYPAL_SECRET]" value="{{ config('services.paypal.secret') }}" class="form-control">
                                            </div>
                                        </div>
                                        
                                    </div>
                
                                </div>
                                <div class="card-footer text-right">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        <i class="fe fe-save mr-2"></i> @lang('Save settings')
                                    </button>
                                </div>
                            </div>
                
                            
                </div>
                <div class="col-md-6">
                        <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title"><i class="fe fe-credit-card mr-2"></i> @lang('Stripe')</h3>
                                </div>
                                <div class="card-body">
                
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label">@lang('Publishable key')</label>
                                                <input type="text" name="settings[STRIPE_KEY]" value="{{ config('services.stripe.key') }}" class="form-control" placeholder="pk_XXX">
                                            </div>
                
                                            <div class="form-group">
                                                <label class="form-label">@lang('Secret key')</label>
                                                <input type="text" name="settings[STRIPE_SECRET]" value="{{ config('services.stripe.secret') }}" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                
                                </div>
                                <div class="card-footer text-right">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        <i class="fe fe-save mr-2"></i> @lang('Save settings')
                                    </button>
                                </div>
                            </div>
                </div>
            </div>
            <div class="row">
                    <div class="col-md-6">
                            <div class="card">
                                    <div class="card-status bg-blue"></div>
                                <div class="card-header">
                                    <h3 class="card-title"><i class="fe fe-eye mr-2"></i> @lang('Google reCaptcha')</h3>
                                    
                                </div>
                                <div class="card-body">
                
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label">@lang('Site key')</label>
                                                <input type="text" name="settings[RECAPTCHA_SITE_KEY]" value="{{ config('recaptcha.api_site_key') }}" class="form-control">
                                            </div>
                
                                            <div class="form-group">
                                                <label class="form-label">@lang('Secret key')</label>
                                                <input type="text" name="settings[RECAPTCHA_SECRET_KEY]" value="{{ config('recaptcha.api_secret_key') }}" class="form-control">
                                            </div>
                                        </div>
                                        
                                    </div>
                
                                </div>
                                <div class="card-footer text-right">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        <i class="fe fe-save mr-2"></i> @lang('Save settings')
                                    </button>
                                </div>
                            </div>
                    </div>
                    <div class="col-md-6">
                            <div class="card">
                                    <div class="card-status bg-blue"></div>
                                <div class="card-header">
                                    <h3 class="card-title"><i class="fe fe-bar-chart-2 mr-2"></i> @lang('Google Analytics')</h3>
                                </div>
                                <div class="card-body">
                
                                    <div class="form-group">
                                        <label class="form-label">@lang('Property ID')</label>
                                        <input type="text" name="settings[GOOGLE_ANALYTICS]" value="{{ config('rb.GOOGLE_ANALYTICS') }}" class="form-control" placeholder="UA-XXXXX-Y">
                                        <small class="help-block">@lang('Leave this field empty if you don\'t want to enable Google Analytics')</small>
                                    </div>
                
                                </div>
                                <div class="card-footer text-right">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        <i class="fe fe-save mr-2"></i> @lang('Save settings')
                                    </button>
                                </div>
                            </div>   
                    </div>
            </div>
            <div class="row">
                    <div class="col-md-12">
                            <div class="card">
                                    <div class="card-status bg-blue"></div>
                                <div class="card-header">
                                    <h3 class="card-title"><i class="fe fe-facebook mr-2"></i> @lang('Login with Facebook')</h3>
                                </div>
                                <div class="card-body">
                
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">@lang('App ID')</label>
                                                <input type="text" name="settings[FACEBOOK_CLIENT_ID]" value="{{ config('services.facebook.client_id') }}" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">@lang('App Secret')</label>
                                                <input type="text" name="settings[FACEBOOK_CLIENT_SECRET]" value="{{ config('services.facebook.client_secret') }}" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                                <p>@lang('Get your App ID and App Secret from:') <a href="https://developers.facebook.com" target="_blank">https://developers.facebook.com</a></p>
                                                <p>@lang('Valid OAuth Redirect URI:') <a href="{{ route('login.callback', 'facebook') }}" target="_blank">{{ route('login.callback', 'facebook') }}</a></p>
                                            </div>
                                        
                                    </div>
                
                                </div>
                                <div class="card-footer text-right">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        <i class="fe fe-save mr-2"></i> @lang('Save settings')
                                    </button>
                                </div>
                            </div>   
                    </div>
                    
            </div>
            

            

            

        </form>

    </div>
    
</div>
@stop