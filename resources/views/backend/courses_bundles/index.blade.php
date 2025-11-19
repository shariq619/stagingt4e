@extends('layouts.main')

@section('title', 'Courses Bundles')

@section('breadcump')
    <div class="col-sm-6">
        <h1 class="m-0">{{ __('Courses Bundles') }}</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('backend.courses-bundle.index') }}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item active">{{ __('Courses Bundles') }}</li>
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
                        {{ __('Data Course Bundle') }}
                    </h3>
                </div>
                <div class="card-body">
                    <div class="card-tools d-flex align-items-center justify-content-between">
                        <form action="{{ route('backend.courses-bundle.index') }}" method="GET"
                              class="d-flex  align-items-center">
                            <div class="input-group input-group-sm mb-3" style="width: 300px;">
                                <input type="text" name="search" class="form-control"
                                       placeholder="Search Courses bundles..." value="{{ request('search') }}"
                                       style="height: calc(2.25rem + 2px);">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                        @can('add category')
                            <div class="text-right mb-3">
                                <a href="{{ route('backend.courses-bundle.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus-circle mr-2"></i>
                                    {{ __('Add Bundle') }}
                                </a>
                            </div>
                        @endcan
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th width="30%">{{ __('Name') }}</th>
                                {{--<th width="10%">{{ __('Image') }}</th>--}}
                                <th width="10%">{{ __('Price') }}</th>
                                <th width="10%">{{ __('Save') }}</th>
                                <th width="20%">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse ($slug as $bundle)
                                <tr>
                                    <td>{{$bundle->name ?? ''}}</td>
                                    {{--<td>
                                        @if(isset($bundle->bundle_image))
                                            <img src="{{asset($bundle->bundle_image) ?? ''}}" class="img-fluid"
                                                 width="100" height="100" alt="">
                                        @endif
                                    </td>--}}
                                    <td>£{{$bundle->regular_price ?? ''}}</td>
                                    <td>£{{$bundle->vat ?? ''}}</td>
                                    <td><a href="{{route('backend.courses-bundle.edit', $bundle->slug)}}"
                                           class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit mr-2"></i>
                                            Update
                                        </a></td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center">
                                        <i>{{ __('Coursed Bundles is empty') }}</i>
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center">
                            {{ $slug->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
