@extends('layouts.main')

@section('title', 'Category')

@section('breadcump')
    <div class="col-sm-6">
        <h1 class="m-0">{{ __('Edit Sub Category') }}</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('backend.dashboard.index') }}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item">{{ __('Sub Category') }}</li>
            <li class="breadcrumb-item active">{{ __('Update') }}</li>
        </ol>
    </div>
@endsection

@section('main')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    {{ __('Form edit sub categories') }}
                </div>
                <div class="card-body">
                    <div class="text-right">
                        <a href="{{ route('backend.sub-categories.create') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left mr-2"></i>
                            {{ __('Return') }}
                        </a>
                    </div>
                    <form action="{{ route('backend.sub-categories.update', $subCategory) }}" method="POST">
                        @csrf
                        @method('PUT')
                        @include('backend.sub-category._form')
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save mr-2"></i>
                                {{ __('Save') }}
                            </button>
                            <a href="{{ route('backend.sub-categories.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times mr-2"></i>
                                {{ __('Cancel') }}
                            </a>
                        </div>
                    </form>
                    <hr>
                    @can('delete subcategory')
                        <button class="btn btn-danger" data-toggle="modal" data-target="#deleteSubCat">
                            <i class="fas fa-trash-alt mr-2"></i>
                            {{ __('delete sub category') }}
                        </button>
                    @endcan
                </div>
            </div>
        </div>
    </div>
    @can('delete subcategory')
        <div class="modal fade" id="deleteSubCat" tabindex="-1" aria-labelledby="deleteSubCatLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteRoleLabel">{{ __('delete sub category') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('backend.sub-categories.destroy', $subCategory) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="modal-body">
                            <div class="alert alert-danger">
                                {{ __('delete sub-category ini? All users with this role will lose their access rights') }}
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                <i class="fas fa-times mr-2"></i>
                                {{ __('Cancel') }}
                            </button>
                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-trash-alt mr-2"></i>
                                {{ __('delete') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endcan
@endsection
