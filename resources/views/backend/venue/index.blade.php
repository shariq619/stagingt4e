@extends('layouts.main')

@section('title', 'Venue')

@section('breadcump')
    <div class="col-sm-6">
        <h1 class="m-0">{{ __('Venue') }}</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('backend.venues.index') }}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item active">{{ __('Venue') }}</li>
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
                        {{ __('Data Venue') }}
                    </h3>
                </div>
                <div class="card-body">
                    <div class="card-tools userDashboard d-flex align-items-center justify-content-between">
                        <form action="{{ route('backend.venues.index') }}" method="GET"
                            class="d-flex  align-items-center formUser">
                            <div class="input-group input-group-sm mb-3" style="width: 300px;">
                                <input type="text" name="search" class="form-control" placeholder="Search Venues..."
                                    value="{{ request('search') }}" style="height: calc(2.25rem + 2px);">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                        @can('add venues')
                            <div class="text-right mb-3">
                                <a href="{{ route('backend.venues.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus-circle mr-2"></i>
                                    {{ __('Add venue') }}
                                </a>
                            </div>
                        @endcan
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th width="35%">{{ __('Venue Name') }}</th>
                                    <th width="15%">{{ __('City') }}</th>
                                    <th width="15%">{{ __('Post Code') }}</th>
                                    <th width="20%">{{ __('Telephone') }}</th>
                                    <th width="15%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($venues as $venue)
                                    <tr>
                                        <td>{{ $venue->venue_name }}</td>
                                        <td>{{ $venue->city }}</td>
                                        <td>{{ $venue->post_code }}</td>
                                        <td>{{ $venue->telephone_number }}</td>
                                        <td>
                                            @if ($venue->name == 'Super Admin')
                                                <i class="text-muted">{{ __('Default role') }}</i>
                                            @else
                                                @can('change roles')
                                                    <a href="{{ route('backend.venues.edit', $venue->slug) }}"
                                                        class="btn btn-sm btn-warning">
                                                        <i class="fas fa-edit mr-2"></i>
                                                        {{ __('Change') }}
                                                    </a>
                                                @endcan
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">
                                            <i>{{ __('Data venue not found!') }}</i>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center">
                            {{ $venues->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
