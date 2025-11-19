@extends('layouts.main')

@section('title', 'Sub Category')
@section('breadcump')
    <div class="col-sm-6">
        <h1 class="m-0">{{ __('Sub Category') }}</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('backend.dashboard.index') }}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item active">{{ __('Sub Category') }}</li>
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
                        {{ __('Data Sub category') }}
                    </h3>
                </div>
                <div class="card-body">
                    @can('add category')
                        <div class="text-right mb-3">
                            <a href="{{ route('backend.sub-categories.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus-circle mr-2"></i>
                                {{ __('Add sub categories') }}
                            </a>
                        </div>
                    @endcan
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>{{ __('Parent Category') }}</th>
                                    <th>{{ __('Sub Category') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($subCategories as $subCategory)
                                    <tr>
                                        <td>#{{ $subCategory->id }}</td>
                                        <td>{{ optional($subCategory->category)->name }}</td>
                                        <td>{{ $subCategory->name }}</td>
                                        <td>
                                            @if ($subCategory->name == 'Super Admin')
                                                <i class="text-muted">{{ __('Default sub category') }}</i>
                                            @else
                                                @can('change subcategory')
                                                    <a href="{{ route('backend.sub-categories.edit', $subCategory->id) }}"
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
                                            <i>{{ __('Category Data is empty') }}</i>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
