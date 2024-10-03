@extends('layouts.app')

@section('title', __('Localization'))

@section('content')
<div class="page-header">
    <h1 class="page-title">@lang('Localization')</h1>
</div>

<div class="row">
        <div class="col-md-2">
                @include('partials.settings-sidebar')
            </div>
    <div class="col-md-10">
        
        <form role="form" method="post" action="{{ route('settings.update', 'localization') }}" autocomplete="off">
            @csrf
            @method('PUT')

            <div class="card">
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">@lang('Default language')</label>
                                <select name="settings[APP_LOCALE]" class="form-control">
                                    @foreach($languages as $code => $language)
                                        <option value="{{ $code }}" {{ $code == config('app.locale') ? 'selected' : '' }}>{{ $language['native'] }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="form-label">@lang('Currency symbol')</label>
                                <input type="text" name="settings[CURRENCY_SYMBOL]" value="{{ config('rb.CURRENCY_SYMBOL') }}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">@lang('Currency')</label>
                                <select name="settings[CURRENCY_CODE]" class="form-control">
                                    @foreach($currencies as $code => $title)
                                        <option value="{{ $code }}" {{ $code == config('rb.CURRENCY_CODE') ? 'selected' : '' }}>{{ $title }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="form-label">@lang('Timezone')</label>
                                <select name="settings[APP_TIMEZONE]" class="form-control">
                                    @foreach($time_zones as $zone)
                                        <option value="{{ $zone }}" {{ $zone == config('app.timezone') ? 'selected' : '' }}>{{ $zone }}</option>
                                    @endforeach
                                </select>
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

        </form>

    </div>
    
</div>
@stop