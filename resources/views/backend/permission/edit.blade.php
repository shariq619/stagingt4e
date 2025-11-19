@extends('layouts.main')

@section('title', 'Permission')

@section('breadcump')
<div class="col-sm-6">
    <h1 class="m-0">{{ __('change permissions') }}</h1>
</div>
<div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('backend.dashboard.index') }}">{{ __('Home') }}</a></li>
        <li class="breadcrumb-item">{{ __('Permission') }}</li>
        <li class="breadcrumb-item active">{{ __('Change') }}</li>
    </ol>
</div>
@endsection


@section('main')
<div class="row">
    <div class="col-12">
        <div class="card carFormWrapper">
            <div class="card-header">
                {{ __('Form change permissions') }}
            </div>
            <div class="card-body">

                <div class="text-right">
                    <a href="{{ route('backend.permissions.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left mr-2"></i>
                        {{ __('Return') }}
                    </a>
                </div>
                <form action="{{ route('backend.permissions.update', $permission) }}" method="POST">
                    @csrf
                    @method('PUT')
                    @include('backend.permission._form')
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save mr-2"></i>
                            {{ __('Change') }}
                        </button>
                        <a href="{{ route('backend.permissions.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times mr-2"></i>
                            {{ __('Cancel') }}
                        </a>
                    </div>
                </form>
                <hr>
                @can('delete permissions')
{{--                <button class="btn btn-danger" data-toggle="modal" data-target="#deletePermission">--}}
{{--                    <i class="fas fa-trash-alt mr-2"></i>--}}
{{--                    {{ __('delete permissions') }}--}}
{{--                </button>--}}
                @endcan

            </div>
        </div>
    </div>
</div>

@can('delete permissions')
<div class="modal fade" id="deletePermission" tabindex="-1" aria-labelledby="deletePermissionLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deletePermissionLabel">{{ __('delete permissions') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('backend.permissions.destroy', $permission) }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <div class="alert alert-danger">
                        {{ __('delete this permissions? All roles with this permission will lose their access rights') }}
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
@endsection
