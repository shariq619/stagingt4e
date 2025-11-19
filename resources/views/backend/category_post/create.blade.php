{{-- @extends('layouts.main')

@section('title', 'Post Category')

@section('breadcump')
    <div class="col-sm-6">
        <h1 class="m-0">{{ __('Add Post Category') }}</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('backend.dashboard.index') }}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item">{{ __('Post Category') }}</li>
            <li class="breadcrumb-item active">{{ __('Create') }}</li>
        </ol>
    </div>
@endsection

@section('main')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card carFormWrapper">
                <div class="card-body">
                    <div class="text-right">
                        <a href="{{ route('backend.post_category.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left mr-2"></i>
                            {{ __('Return') }}
                        </a>
                    </div>
                    <form action="{{ route('backend.post_category.store') }}" method="POST">
                        @csrf
                        <div class="row">@include('backend.category_post._form')</div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save mr-2"></i>
                                {{ __('Save') }}
                            </button>
                            <a href="{{ route('backend.post_category.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times mr-2"></i>
                                {{ __('Cancel') }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection --}}