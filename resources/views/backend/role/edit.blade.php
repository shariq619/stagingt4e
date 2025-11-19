@extends('layouts.main')

@section('title', 'Role')

@section('breadcump')
<div class="col-sm-6">
    <h1 class="m-0">{{ __('change roles') }}</h1>
</div>
<div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('backend.dashboard.index') }}">{{ __('Home') }}</a></li>
        <li class="breadcrumb-item">{{ __('Role') }}</li>
        <li class="breadcrumb-item active">{{ __('Change') }}</li>
    </ol>
</div>
@endsection

@section('main')
<div class="row">
    <div class="col-12">
        <div class="card carFormWrapper">
            <div class="card-header">
                {{ __('Form change roles') }}
            </div>
            <div class="card-body">
                <div class="text-right">
                    <a href="{{ route('backend.roles.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left mr-2"></i>
                        {{ __('Return') }}
                    </a>
                </div>
                <form action="{{ route('backend.roles.update', $role) }}" method="POST">
                    @csrf
                    @method('PUT')
                    @include('backend.role._form')
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save mr-2"></i>
                            {{ __('Change') }}
                        </button>
                        <a href="{{ route('backend.roles.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times mr-2"></i>
                            {{ __('Cancel') }}
                        </a>
                    </div>
                </form>
                <hr>
                @can('delete role')
{{--                <button class="btn btn-danger" data-toggle="modal" data-target="#deleteRole">--}}
{{--                    <i class="fas fa-trash-alt mr-2"></i>--}}
{{--                    {{ __('delete role') }}--}}
{{--                </button>--}}
                @endcan
            </div>
        </div>
    </div>
</div>
@can('delete role')
<div class="modal fade" id="deleteRole" tabindex="-1" aria-labelledby="deleteRoleLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteRoleLabel">{{ __('delete role') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('backend.roles.destroy', $role) }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <div class="alert alert-danger">
                        {{ __('delete this role? All users with this role will lose their access rights') }}
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
