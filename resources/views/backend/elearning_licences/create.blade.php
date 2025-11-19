@extends('layouts.main')

@section('title', 'Elearning License')

@section('breadcump')
<div class="col-sm-6">
    <h1 class="m-0">{{ __('Add Elearning License') }}</h1>
</div>
<div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('backend.dashboard.index') }}">{{ __('Home') }}</a></li>
        <li class="breadcrumb-item">{{ __('Elearning License') }}</li>
        <li class="breadcrumb-item active">{{ __('Add') }}</li>
    </ol>
</div>
@endsection

@section('main')
<div class="row justify-content-center">
    <div class="col-12">
        <div class="card carFormWrapper">
{{--            <div class="card-header">--}}
{{--                {{ __('Form add qualifications') }}--}}
{{--            </div>--}}
            <div class="card-body">
                <div class="text-right">
                    <a href="{{ route('backend.elearning_licences.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left mr-2"></i>
                        {{ __('Return') }}
                    </a>
                </div>
                <form action="{{ route('backend.elearning_licences.store') }}" method="POST">
                    @csrf
                    @include('backend.elearning_licences._form')
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save mr-2"></i>
                            {{ __('Save') }}
                        </button>
                        <a href="{{ route('backend.elearning_licences.index') }}" class="btn btn-secondary">
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
