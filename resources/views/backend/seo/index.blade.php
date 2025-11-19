@extends('layouts.main')

@section('title', 'Seo')

@section('breadcump')
    <div class="col-sm-6">
        <h1 class="m-0">{{ __('Seo') }}</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('backend.dashboard.index') }}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item active">{{ __('Seo') }}</li>
        </ol>
    </div>
@endsection

@section('main')
    @if (session()->has('success'))
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    {{ session('success') }}
                </div>
            </div>
        </div>
    @endif
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        {{ __('Data Seo') }}
                    </h3>
                </div>
                <div class="card-body">
                    <div class="card-tools d-flex align-items-center justify-content-between">
                        <form action="{{ route('backend.seo.index') }}" method="GET" class="d-flex  align-items-center">
                            <div class="input-group input-group-sm mb-3" style="width: 300px;">
                                <input type="text" name="search" class="form-control" placeholder="Search Seo..."
                                    value="{{ request()->get('search') }}" style="height: calc(2.25rem + 2px);">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                        @can('add seo')
                            <div class="text-right mb-3">
                                <a href="{{ route('backend.seo.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus-circle mr-2"></i>
                                    {{ __('Add Seo') }}
                                </a>
                            </div>
                        @endcan
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>{{ __('Page URL') }}</th>
                                    <th>{{ __('Robots') }}</th>
                                    <th>{{ __('SEO Score') }}</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($seos as $seo)
                                    <tr>
                                        <td><a target="_blank" href="{{ $seo->slug ?? '' }}">{{ $seo->slug ?? '' }}</a></td>
                                        <td>{{ $seo->robots }}</td>
                                        <td>
                                            <span class="{{ getSeoScoreClass($seo->seo_score) }}">
                                                {{ $seo->seo_score }} / 100
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('backend.seo.edit', $seo->id) }}" class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit mr-2"></i>
                                                Update
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center">
                                            <i>{{ __('Seo Data is empty') }}</i>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center">
                            {{ $seos->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
