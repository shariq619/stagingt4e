@extends('layouts.main')

@section('title', 'Exam')

@section('breadcump')
<div class="col-sm-6">
    <h1 class="m-0">{{ __('Add Exam') }}</h1>
</div>
<div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('backend.dashboard.index') }}">{{ __('Home') }}</a></li>
        <li class="breadcrumb-item">{{ __('Exam') }}</li>
        <li class="breadcrumb-item active">{{ __('Tambah') }}</li>
    </ol>
</div>
@endsection

@section('main')
<div class="row justify-content-center">
    <div class="col-8">
        <div class="card carFormWrapper">
            <div class="card-header">
                {{ __('Form add exams') }}
            </div>
            <div class="card-body">
                <div class="text-right">
                    <a href="{{ route('backend.exams.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left mr-2"></i>
                        {{ __('Return') }}
                    </a>
                </div>
                <form action="{{ route('backend.exams.store') }}" method="POST">
                    @csrf
                    @include('backend.exams._form')
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save mr-2"></i>
                            {{ __('Save') }}
                        </button>
                        <a href="{{ route('backend.exams.index') }}" class="btn btn-secondary">
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
