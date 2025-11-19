@extends('layouts.main')

@section('title', 'Exam')

@section('breadcump')
<div class="col-sm-6">
    <h1 class="m-0">{{ __('change exams') }}</h1>
</div>
<div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('backend.dashboard.index') }}">{{ __('Home') }}</a></li>
        <li class="breadcrumb-item">{{ __('Category') }}</li>
        <li class="breadcrumb-item active">{{ __('Update') }}</li>
    </ol>
</div>
@endsection

@section('main')
<div class="row justify-content-center">
    <div class="col-8">
        <div class="card carFormWrapper">
            <div class="card-header">
                {{ __('Form change exams') }}
            </div>
            <div class="card-body">
                <div class="text-right">
                    <a href="{{ route('backend.exams.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left mr-2"></i>
                        {{ __('Return') }}
                    </a>
                </div>
                <form action="{{ route('backend.exams.update', $exam) }}" method="POST">
                    @csrf
                    @method('PUT')
                    @include('backend.exams._form')
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save mr-2"></i>
                            {{ __('Update') }}
                        </button>
                        <a href="{{ route('backend.exams.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times mr-2"></i>
                            {{ __('Cancel') }}
                        </a>
                    </div>
                </form>
                <hr>
                @can('delete exam')
                <button class="btn btn-danger" data-toggle="modal" data-target="#deleteModule">
                    <i class="fas fa-trash-alt mr-2"></i>
                    {{ __('delete exam') }}
                </button>
                @endcan
            </div>
        </div>
    </div>
</div>
@can('delete exam')
<div class="modal fade" id="deleteModule" tabindex="-1" aria-labelledby="deleteCatLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteRoleLabel">{{ __('Delete Exam') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('backend.exams.destroy', $exam) }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <div class="alert alert-danger">
                        {{ __('delete Exam?') }}
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
