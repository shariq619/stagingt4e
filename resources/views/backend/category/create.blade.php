@extends('layouts.main')

@section('title', 'Category')

@section('breadcump')
<div class="col-sm-6">
    <h1 class="m-0">{{ __('Add Category') }}</h1>
</div>
<div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('backend.dashboard.index') }}">{{ __('Home') }}</a></li>
        <li class="breadcrumb-item">{{ __('Category') }}</li>
        <li class="breadcrumb-item active">{{ __('Tambah') }}</li>
    </ol>
</div>
@endsection

@section('main')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card carFormWrapper">
{{--            <div class="card-header">--}}
{{--                {{ __('Form add categories') }}--}}
{{--            </div>--}}
            <div class="card-body">
                <div class="text-right">
                    <a href="{{ route('backend.categories.create') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left mr-2"></i>
                        {{ __('Return') }}
                    </a>
                </div>
                <form action="{{ route('backend.categories.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @include('backend.category._form')
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save mr-2"></i>
                            {{ __('Save') }}
                        </button>
                        <a href="{{ route('backend.categories.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times mr-2"></i>
                            {{ __('Cancel') }}
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
