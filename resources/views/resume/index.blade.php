@extends('layouts.app')

@section('title', __('Resume'))

@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <div class="page-header">
        <h1 class="page-title">
            @lang('Resume')
        </h1>
        
    </div>
    <div class="card">
        @if($data->count() > 0)
        <div class="table-responsive">
        <table class="table">
               <thead class="thead-dark">
           
                    <tr>
                        <th>@lang('Name')</th>
                        <th>@lang('Users')</th>
                        <th>@lang('Date Created')</th>
                        <th>@lang('Date Modified')</th>
                        <th class="">@lang('Action')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $item)
                    <tr data-id="{{ $item->id }}">
                        <td>
                            <a href="{{ route('resume.edit', $item) }}">{{ $item->name }}</a>
                        </td>
                        <td>
                            {{$item->user->name}}
                        </td>
                        <td>
                                <div class="small text-muted">
                                        {{$item->created_at->format('M j, Y')}}
                                </div>
                        </td>
                        <td>
                                <div class="small text-muted">
                                        {{$item->updated_at->format('M j, Y')}}
                                </div>
                        </td>
                        <td class="">
                            <div class="d-flex">
                                <div class="p-1 ">
                                    <a class="btn btn-sm btn-primary btn-clean" href="{{ route('resume.exportpdf', $item) }}" target="_blank"><i class="fe fe-download"></i> @lang('Export PDF')</a>
                                </div>
                                <div class="p-1 ">
                                        <a class="btn btn-sm btn-warning btn-clean" href="{{ route('resume.edit', $item) }}"><i class="fe fe-edit-2"></i> @lang('Edit')</a>
                                </div>
                                <div class="p-1">
                                <form method="post" action="{{ route('resume.delete', $item) }}" onsubmit="return confirm('@lang('Confirm delete?')');">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger btn-clean">
                                        <i class="fe fe-trash"></i> @lang('Delete')
                                    </button>
                                </form>
                                </div>
                                
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>

    {{ $data->appends( Request::all() )->links() }}

    @if($data->count() == 0)
        <div class="alert alert-primary text-center">
            <i class="fe fe-alert-triangle mr-2"></i> @lang('No resume found')
        </div>
    @endif

@stop