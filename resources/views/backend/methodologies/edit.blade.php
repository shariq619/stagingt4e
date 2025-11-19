@extends('layouts.main')

@section('title', 'Methodology')

@section('breadcump')
<div class="col-sm-6">
    <h1 class="m-0">{{ __('Change Methodology') }}</h1>
</div>
<div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('backend.dashboard.index') }}">{{ __('Home') }}</a></li>
        <li class="breadcrumb-item">{{ __('Methodology') }}</li>
        <li class="breadcrumb-item active">{{ __('Update') }}</li>
    </ol>
</div>
@endsection

@section('main')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card carFormWrapper">
{{--            <div class="card-header">--}}
{{--                {{ __('Form change categories') }}--}}
{{--            </div>--}}
            <div class="card-body">
                <div class="text-right">
                    <a href="{{ route('backend.methodologies.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left mr-2"></i>
                        {{ __('Return') }}
                    </a>
                </div>
                <form action="{{ route('backend.methodologies.update', $methodology) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    @include('backend.methodologies._form')
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save mr-2"></i>
                            {{ __('Update') }}
                        </button>
                        <a href="{{ route('backend.methodologies.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times mr-2"></i>
                            {{ __('Cancel') }}
                        </a>
                    </div>
                </form>
                <hr>
                @can('delete methodology')
                <button class="btn btn-danger" data-toggle="modal" data-target="#deleteCat">
                    <i class="fas fa-trash-alt mr-2"></i>
                    {{ __('Delete methodology') }}
                </button>
                @endcan
            </div>
        </div>
    </div>
</div>
@can('delete methodology')
<div class="modal fade" id="deleteCat" tabindex="-1" aria-labelledby="deleteCatLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteRoleLabel">{{ __('delete methodology') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('backend.methodologies.destroy', $methodology) }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <div class="alert alert-danger">
                        {{ __('delete methodology?') }}
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
