@extends('layouts.main')

@section('title', 'Course Bundles')

@section('breadcump')
    <div class="col-sm-6">
        <h1 class="m-0">{{ __('Add Bundle') }}</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('backend.dashboard.index') }}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item">{{ __('Course Bundles') }}</li>
            <li class="breadcrumb-item active">{{ __('Create') }}</li>
        </ol>
    </div>
@endsection
@section('main')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {{ __('Form add cohort') }}
                </div>
                <div class="card-body carFormWrapper">
                    <div class="text-right">
                        <a href="{{ route('backend.courses-bundle.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left mr-2"></i>
                            {{ __('Return') }}
                        </a>
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('backend.courses-bundle.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>{{ __('Bundle Name') }} <span class="text-red">*</span></label>
                                    <input type="text" name="name"
                                        class="form-control @error('name') is-invalid @enderror" placeholder="Bundle Name"
                                        value="{{ old('name') }}">
                                    @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>{{ __('Bundle Image') }} </label>
                                    <input type="file" name="bundle_image" id="bundle_image" class="form-control">
                                    @error('bundle_image')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label>{{ __('Select Course') }} <span class="text-red">*</span></label>
                                    <select name="products[]" id="courses" class="form-control" multiple
                                        class="form-control @error('products') is-invalid @enderror">
                                        @foreach ($courses as $course)
                                            <option value="{{ $course->id }}">{{ $course->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('products')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label>{{ __('Regular Price') }} <span class="text-red">*</span></label>
                                    <input type="text" class="form-control @error('regular_price') is-invalid @enderror"
                                        name="regular_price" id="regular_price" value="{{ old('regular_price') }}">
                                    @error('regular_price')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label>{{ __('Save') }}</label>
                                    <input type="text" class="form-control" name="vat" id="vat"
                                        value="{{ old('vat') }}">
                                </div>
                            </div>
                            <div class="col-7">
                                <div class="form-group">
                                    <label>{{ __('Short Description') }}</label>
                                    <textarea class="form-control w-100" name="short_description" id="short_description">{{ old('short_description') }}</textarea>
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="form-group">
                                    <label>{{ __('Detail Page Excerpt') }}</label>
                                    <textarea class="form-control w-100" name="excerpt" id="excerpt">{{ old('excerpt') }}</textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>{{ __('Detail Page Long Description') }}</label>
                                    <textarea class="form-control w-100" name="long_description" id="long_description">{{ old('long_description') }}</textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>{{ __('Courses Included') }}</label>
                                    <textarea class="form-control w-100" name="courses_included" id="courses_included">{{ old('courses_included') }}</textarea>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group mt-5">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save mr-2"></i>
                                        {{ __('Save') }}
                                    </button>
                                    <a href="{{ route('backend.courses-bundle.index') }}" class="btn btn-secondary">
                                        <i class="fas fa-times mr-2"></i>
                                        {{ __('Cancel') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('css')
    <link rel="stylesheet" href="{{ asset('admin/plugins/select2/css/select2.min.css') }}">
    <style>
        ul.select2-selection__rendered li.select2-selection__choice {
            background: #08091b !important;
        }

        ul.select2-selection__rendered li span {
            color: #fff !important;
        }
    </style>
@endpush
@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/7.6.0/tinymce.min.js"></script>
    <script src="{{ asset('admin') }}/plugins/select2/js/select2.min.js"></script>
    <script>
        $('#courses').select2();
    </script>
    <script>
        tinymce.init({
            selector: 'textarea#courses_included',
            plugins: 'code table lists',
            toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table'
        });
        tinymce.init({
            selector: 'textarea#short_description',
            plugins: 'code table lists',
            toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table'
        });
        tinymce.init({
            selector: 'textarea#excerpt',
            plugins: 'code table lists',
            toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table'
        });
        tinymce.init({
            selector: 'textarea#long_description',
            plugins: 'code table lists',
            toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table'
        });
    </script>
@endpush
