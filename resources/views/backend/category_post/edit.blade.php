{{-- @extends('layouts.main')

@section('title', 'Post Category')

@section('breadcump')
    <div class="col-sm-6">
        <h1 class="m-0">{{ __('Update Post Category') }}</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('backend.dashboard.index') }}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item">{{ __('Post Category') }}</li>
            <li class="breadcrumb-item active">{{ __('Update') }}</li>
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
                    <form action="{{ route('backend.post_category.update', $post_category) }}" method="POST">
                        @csrf
                        @method('PUT')

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
                    <hr>
                    @can('delete category_post')
                        <button class="btn btn-danger" data-toggle="modal" data-target="#deletePost">
                            <i class="fas fa-trash-alt mr-2"></i>
                            {{ __('Delete post') }}
                        </button>
                    @endcan
                </div>
            </div>
        </div>
    </div>
    @can('delete category_post')
        <div class="modal fade" id="deletePost" tabindex="-1" aria-labelledby="deleteCatLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteRoleLabel">{{ __('delete Post Category') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('backend.post_category.delete', $post_category) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="modal-body">
                            <div class="alert alert-danger">
                                {{ __('delete Post Category?') }}
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                <i class="fas fa-times mr-2"></i>
                                {{ __('Cancel') }}
                            </button>
                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-trash-alt mr-2"></i>
                                {{ __('Delete') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endcan
@endsection --}}
