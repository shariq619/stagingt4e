@extends('layouts.main')

@section('title', 'Elearning License')

@section('breadcump')
    <div class="col-sm-6">
        <h1 class="m-0">{{ __('Elearning License') }}</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('backend.dashboard.index') }}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item active">{{ __('Elearning License') }}</li>
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
                        {{ __('Data Elearning License') }}
                    </h3>
                </div>
                <div class="card-body">
                    <div class="card-tools userDashboard d-flex align-items-center justify-content-between">
                        <form action="{{ route('backend.elearning_licences.index') }}" method="GET"
                            class="d-flex  align-items-center formUser">
                            <div class="input-group input-group-sm mb-3" style="width: 300px;">
                                <input type="text" name="search" class="form-control"
                                    placeholder="Search Elearning License..." value="{{ request('search') }}"
                                    style="height: calc(2.25rem + 2px);">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                        @can('add elearning licences')
                            <div class="text-right mb-3">
                                <a href="{{ route('backend.elearning_licences.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus-circle mr-2"></i>
                                    {{ __('Add Elearning License') }}
                                </a>
                            </div>
                        @endcan
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th width="5%">ID</th>
                                    <th width="25%">{{ __('Name') }}</th>
                                    <th width="40%">{{ __('Description') }}</th>
                                    <th width="15%">{{ __('Modified By') }}</th>
                                    <th width="15%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($licences as $licence)
                                    <tr>
                                        <td>{{ $licence->id }}</td>
                                        <td>{{ $licence->name }}</td>
                                        <td>{{ $licence->description }}</td>
                                        <td>{{ $licence->user->name ?? '' }}</td>

                                        <td>
                                            @if ($licence->name == 'Super Admin')
                                                <i class="text-muted">{{ __('Default elearning licences') }}</i>
                                            @else
                                                @can('change qualification')
                                                    <a href="{{ route('backend.elearning_licences.edit', $licence->id) }}"
                                                        class="btn btn-sm btn-warning">
                                                        <i class="fas fa-edit mr-2"></i>
                                                        {{ __('Update') }}
                                                    </a>
                                                @endcan
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">
                                            <i>{{ __('Elearning Licences Data is empty') }}</i>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center">
                            {{ $licences->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
