@extends('layouts.app')

@section('title', __('E-mail Settings'))

@section('content')
<div class="page-header">
    <h1 class="page-title">@lang('E-mail Settings')</h1>
</div>

<div class="row">
        <div class="col-md-2">
                @include('partials.settings-sidebar')
            </div>
    <div class="col-md-10">

        <form role="form" method="post" action="{{ route('settings.update', 'email') }}" autocomplete="off">
            @csrf
            @method('PUT')

            <div class="card">
                    <div class="card-status bg-blue"></div>
                    <div class="card-header">
                            <h3 class="card-title"><i class="fe fe-sliders mr-2"></i> @lang('E-mail Settings')</h3>
                        </div>
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">@lang('SMTP Host')</label>
                                <input type="text" name="settings[MAIL_HOST]" value="{{ config('mail.host') }}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">@lang('SMTP Port')</label>
                                <input type="text" name="settings[MAIL_PORT]" value="{{ config('mail.port') }}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">@lang('SMTP Username')</label>
                                <input type="text" name="settings[MAIL_USERNAME]" value="{{ config('mail.username') }}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">@lang('SMTP Password')</label>
                                <input type="text" name="settings[MAIL_PASSWORD]" value="{{ config('mail.password') }}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">@lang('SMTP Encryption')</label>
                                <select name="settings[MAIL_ENCRYPTION]" class="form-control">
                                    <option value="" {{ null == config('mail.encryption') ? 'selected' : '' }}>@lang('No encryption')</option>
                                    <option value="tls" {{ 'tls' == config('mail.encryption') ? 'selected' : '' }}>@lang('TLS')</option>
                                    <option value="ssl" {{ 'ssl' == config('mail.encryption') ? 'selected' : '' }}>@lang('SSL')</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">@lang('From address')</label>
                                <input type="text" name="settings[MAIL_FROM_ADDRESS]" value="{{ config('mail.from.address') }}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">@lang('From name')</label>
                                <input type="text" name="settings[MAIL_FROM_NAME]" value="{{ config('mail.from.name') }}" class="form-control">
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