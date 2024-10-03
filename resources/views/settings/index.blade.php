@extends('layouts.app')

@section('title', __('Settings'))

@section('content')
<div class="page-header">
    <h1 class="page-title">@lang('Settings')</h1>
</div>

<div class="row">
        <div class="col-md-2">
                @include('partials.settings-sidebar')
            </div>
    <div class="col-md-10">

        <form role="form" method="post" action="{{ route('settings.update') }}" autocomplete="off">
            @csrf
            @method('PUT')

            <div class="card">
                <div class="card-status bg-blue"></div>
                <div class="card-header">
                    <h3 class="card-title"><i class="fe fe-sliders mr-2"></i> @lang('General settings')</h3>
                </div>
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">@lang('Site URL')</label>
                                <input type="text" name="settings[APP_URL]" value="{{ config('app.url') }}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">@lang('Site name')</label>
                                <input type="text" name="settings[APP_NAME]" value="{{ config('app.name') }}" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">@lang('Description')</label>
                        <textarea name="settings[SITE_DESCRIPTION]" rows="2" class="form-control">{{ config('rb.SITE_DESCRIPTION') }}</textarea>
                        <small class="help-block">@lang('Recommended length of the description is 150-160 characters')</small>
                    </div>

                    <div class="form-group">
                        <label class="form-label">@lang('Keywords')</label>
                        <textarea name="settings[SITE_KEYWORDS]" rows="3" class="form-control">{{ config('rb.SITE_KEYWORDS') }}</textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-label">@lang('Privacy Policy')</label>
                        <textarea name="settings[privacy]" id="privacy" rows="4" class="form-control">{{ config('rb.privacy') }}</textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-label">@lang('Term and condition')</label>
                        <textarea name="settings[termcondition]" id="termcondition" rows="4" class="form-control">{{ config('rb.termcondition') }}</textarea>
                        <textarea class="form-control">{{ old('resumematch') }}</textarea>

                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">@lang('Landing page item')</label>
                                <select name="settings[SITE_LANDING]" class="form-control">
                                    @foreach($landingpage as $item)
                                        <option value="{{ $item }}" {{ $item == config('rb.SITE_LANDING') ? 'selected' : '' }}>{{ $item }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">@lang('PURCHASE CODE')</label>
                                    <input type="text" name="settings[PURCHASE_CODE]" value="{{ config('rb.PURCHASE_CODE') }}" class="form-control">
                                </div>
                            </div>
                        
                       
                    </div>
                    <div class="row">
                            <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="custom-switch">
                                            <input type="checkbox" name="settings[DISABLE_LANDING]" value="1" class="custom-switch-input" {{ config('rb.DISABLE_LANDING') ? 'checked' : '' }}>
                                            <span class="custom-switch-indicator"></span>
                                            <span class="custom-switch-description">@lang('Disable landing page')</span>
                                        </label>
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

@push('scripts')
<script>
$(document).ready(function(){
  CKEDITOR.replace( 'privacy' );
    CKEDITOR.replace( 'termcondition' );
    // $('#send').click(function() {
    //     var jd = CKEDITOR.instances['termcondition'].getData();
    //     var resume = CKEDITOR.instances['privacy'].getData();
    //     // send your ajax request with value
    //     // profit!
    //     $('#jd_paste').html(jd);
    //     $('#resume_paste').html(resume);
        
    // });

});
</script>
@endpush