

@extends('layouts.app')

@section('title', __('Update App'))

@section('content')
<div class="page-header">
    <h1 class="page-title">@lang('Update App')</h1>
</div>

<div class="row">
        <div class="col-md-2">
                @include('partials.settings-sidebar')
            </div>
    <div class="col-md-10">
            <div class="row">
                    <div class="col-md-6">
                            <form method="post" action="{{ route('settings.updatefinish') }}">
                                    @csrf
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">@lang("Update")</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                    
                                                     <div class="col-md-12">
                                                            <ol>
                                                                    <li><b>@lang("Backup your files & database")</b></li>
                                                                    <li>@lang("<b>Overwrite all files</b> from <code>Upload</code> folder.")</li>
                                                                    <li>@lang("Login user admin and click button update bottom")</li>
                                                            </ol>
                                                    </div>
                                                      
                                                
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                                <button class="btn btn-block btn-primary">@lang("Update App")</button>
                                        </div>
                                    </div>
                        
                                </form>
                    </div>
                    <div class="col-md-6">
                            <div class="card">
                                    <div class="card-header">
                                      <h2 class="card-title">@lang("Info App")</h2>
                                    </div>
                                    <table class="table card-table">
                                      <tbody><tr>
                                        <td>@lang("Software version")</td>
                                        <td class="text-right">
                                          <span class="badge badge-default">{{ config('rb.version') }}</span>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td>@lang("PHP version")</td>
                                        <td class="text-right">
                                          <span class="badge badge-default">{!! PHP_VERSION !!}</span>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td>@lang("Purchase code")</td>
                                        <td class="text-right purchase_code">
                                          <span class="badge badge-success">{{ config('rb.PURCHASE_CODE') }}</span>
                                        </td>
                                      </tr>
                                    </tbody>
                                    </table>
                            </div>
                    </div>
            </div>
           

    </div>
    
</div>
@stop