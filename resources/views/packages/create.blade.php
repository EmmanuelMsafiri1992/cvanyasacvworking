@extends('layouts.app')

@section('title', __('Create new package'))

@section('content')
<div class="page-header">
    <h1 class="page-title">@lang('Create new package')</h1>
</div>

<div class="row">
        <div class="col-md-3">
                @include('partials.settings-sidebar')
            </div>
    <div class="col-md-9">

        <form role="form" method="post" action="{{ route('settings.packages.store') }}">
            @csrf
            <div class="card">
                <div class="card-body">

                    <div class="form-group">
                        <label class="form-label">@lang('Title')</label>
                        <input type="text" required name="title" value="{{ old('title') }}" class="form-control" placeholder="@lang('Title')">
                    </div>

                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="form-label">@lang('Price')</label>
                                <input type="number" required min="0" step="0.01" name="price" value="{{ old('price') }}" class="form-control" placeholder="@lang('Price')">
                            </div>
                        </div>
                        <div class="col-sm-4">
                                <div class="form-group">
                                        <label class="form-label">@lang('Number interval')</label>
                                        <input type="number" required min="1" step="1" name="interval_number" value="{{ old('interval_number') }}" class="form-control" placeholder="@lang('Number interval')">
                                    </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="form-label">@lang('Payment interval')</label>
                                <select name="interval" class="form-control">
                                        <option value="day" {{ old('interval') == 'day' ? 'selected' : '' }}>@lang('saas.interval_day')</option>
                                        <option value="week" {{ old('interval') == 'week' ? 'selected' : '' }}>@lang('saas.interval_week')</option>
                                        <option value="month" {{ old('interval') == 'month' ? 'selected' : '' }}>@lang('saas.interval_month')</option>
                                        <option value="year" {{ old('interval') == 'year' ? 'selected' : '' }}>@lang('saas.interval_year')</option>
                                    </select>
                            </div>
                        </div>
                        
                    </div>

                 
                    <div class="row">
                            <div class="col-sm-4">
                                    <div class="form-group">
                                            <div class="form-label">@lang('Export PDF')</div>
                                            <label class="custom-switch">
                                                <input type="checkbox" name="settings[export_pdf]" value="1" class="custom-switch-input" {{ old('settings.export_pdf') ? 'checked' : '' }}>
                                                <span class="custom-switch-indicator"></span>
                                                <small class="custom-switch-description">@lang('Allow export PDF resume')</small>
                                            </label>
                                        </div>
                            </div>
                            <div class="col-sm-4">
                                    <div class="form-group">
                                            <div class="form-label">@lang('Premium template')</div>
                                            <label class="custom-switch">
                                                <input type="checkbox" name="settings[template_premium]" value="1" class="custom-switch-input" {{ old('settings.template_premium') ? 'checked' : '' }}>

                                                <span class="custom-switch-indicator"></span>
                                                <small class="custom-switch-description">@lang('Allow use premium template')</small>
                                            </label>
                                        </div>
                            </div>
                            
                            <div class="col-sm-4">
                                    <div class="form-group">
                                            <div class="form-label">@lang('Featured')</div>
                                            <label class="custom-switch">
                                                <input type="checkbox" name="is_featured" value="1" class="custom-switch-input" {{ old('is_featured') ? 'checked' : '' }}>
                                                <span class="custom-switch-indicator"></span>
                                                <small class="custom-switch-description">@lang('Highlight package')</small>
                                            </label>
                                        </div>
                                   
                            </div>
                    </div>
                   

                </div>
                <div class="card-footer">
                    <div class="d-flex">
                        <a href="{{ route('settings.packages.index') }}" class="btn btn-secondary">@lang('Cancel')</a>
                        <button class="btn btn-success ml-auto">@lang('Add package')</button>
                    </div>
                </div>
            </div>
        </form>

    </div>
    
</div>
@stop