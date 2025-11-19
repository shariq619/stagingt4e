@extends('layouts.main')

@section('title', 'Reseller')

@section('breadcump')
    <div class="col-sm-6">
        <h1 class="m-0">{{ __('Reseller') }}</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('backend.dashboard.index') }}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item">{{ __('Reseller') }}</li>
            <li class="breadcrumb-item active">{{ __('Add') }}</li>
        </ol>
    </div>
@endsection

@section('main')

    <div class="card-header">
        <h3 class="card-title">
            {{ __('Form Reseller') }}
        </h3>
    </div>
    <div class="row">
        <div class="col-md-12 carFormWrapper">
            <form action="{{ route('backend.resellers.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @include('backend.resellers._form')
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save mr-2"></i>
                                {{ __('Save') }}
                            </button>
                            <a href="{{ route('backend.resellers.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times mr-2"></i>
                                {{ __('Cancel') }}
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection


@push('js')
    <script>

    </script>
@endpush
