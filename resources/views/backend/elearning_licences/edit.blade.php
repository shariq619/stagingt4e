@extends('layouts.main')

@section('title', 'Elearning License')

@section('breadcump')
<div class="col-sm-6">
    <h1 class="m-0">{{ __('Change elearning licence') }}</h1>
</div>
<div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('backend.dashboard.index') }}">{{ __('Home') }}</a></li>
        <li class="breadcrumb-item">{{ __('Elearning License') }}</li>
        <li class="breadcrumb-item active">{{ __('Update') }}</li>
    </ol>
</div>
@endsection

@section('main')
<div class="row justify-content-center">
    <div class="col-12">
        <div class="card carFormWrapper">
            <div class="card-header">
                {{ __('Form change Elearning License') }}
            </div>
            <div class="card-body">
                <div class="text-right">
                    <a href="{{ route('backend.elearning_licences.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left mr-2"></i>
                        {{ __('Return') }}
                    </a>
                </div>
                <form action="{{ route('backend.elearning_licences.update', $elearningLicence) }}" method="POST">
                    @csrf
                    @method('PUT')
                    @include('backend.elearning_licences._form')
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save mr-2"></i>
                            {{ __('Update') }}
                        </button>
                        <a href="{{ route('backend.elearning_licences.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times mr-2"></i>
                            {{ __('Cancel') }}
                        </a>
                    </div>
                </form>
                <hr>
                @can('delete elearning_licences')
                <button class="btn btn-danger" data-toggle="modal" data-target="#deleteElearningLicence">
                    <i class="fas fa-trash-alt mr-2"></i>
                    {{ __('Delete elearning licences') }}
                </button>
                @endcan
            </div>
        </div>
    </div>
</div>
@can('delete elearning_licences')
<div class="modal fade" id="deleteElearningLicence" tabindex="-1" aria-labelledby="deleteCatLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteRoleLabel">{{ __('Delete Elearning licence') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('backend.elearning_licences.destroy', $elearningLicence) }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <div class="alert alert-danger">
                        {{ __('Delete elearning licence?') }}
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
