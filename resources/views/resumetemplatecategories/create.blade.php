@extends('layouts.app')

@section('title', __('Create category'))

@section('content')
<div class="page-header">
    <h1 class="page-title">@lang('Create category')</h1>
</div>

<div class="row">
        <div class="col-md-2">
                @include('partials.settings-sidebar')
            </div>
    <div class="col-md-10">

        <form role="form" method="post" action="{{ route('settings.resumetemplatecategories.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">

                            <div class="form-group">
                                <label class="form-label">@lang('Name')</label>
                                <input type="text" name="name" value="{{ old('name') }}" class="form-control" placeholder="@lang('Name')">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Thumb Category</label>
                                <input name="thumb" type="file"><br>
                            </div>

                        </div>
                        
                    </div>

                </div>
                <div class="card-footer">
                    <div class="d-flex">
                        <a href="{{ route('settings.users.index') }}" class="btn btn-secondary">@lang('Cancel')</a>
                        <button class="btn btn-success ml-auto">@lang('Add category')</button>
                    </div>
                </div>
            </div>
        </form>

    </div>
    
</div>


@stop