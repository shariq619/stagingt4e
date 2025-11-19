@extends('layouts.main')

@section('title', 'Course')

@section('breadcump')
    <div class="col-sm-6">
        <h1 class="m-0">{{ __('Course') }}</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('backend.dashboard.index') }}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item active">{{ __('Course') }}</li>
        </ol>
    </div>
@endsection

@section('main')
    @if (session()->has('success'))
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    {{ session('success') }}
                </div>
            </div>
        </div>
    @endif
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        {{ __('Data course') }}
                    </h3>
                </div>
                <div class="card-body">
                    <div class="card-tools d-flex align-items-center justify-content-between">
                        <form action="{{ route('backend.courses.index') }}" method="GET"
                            class="d-flex  align-items-center">
                            <div class="input-group input-group-sm mb-3" style="width: 300px;">
                                <input type="text" name="search" class="form-control"
                                    placeholder="Search by name..." value="{{ request()->get('search') }}"
                                    style="height: calc(2.25rem + 2px);">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                        @can('add course')
                            <div class="text-right mb-3">
                                <a href="{{ route('backend.courses.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus-circle mr-2"></i>
                                    {{ __('Add Course') }}
                                </a>
                            </div>
                        @endcan
                    </div>
                    <div class="table-responsive">
                        <div id="courses-table">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th width="5%">ID</th>
                                        <th width="10%">{{ __('Color Code') }}</th>
                                        <th width="10%">{{ __('Category') }}</th>
                                        {{-- <th width="10%">{{ __('Delivery Mode') }}</th> --}}
                                        <th width="10%">{{ __('Price') }}</th>
                                        <th width="20%">{{ __('Course Name') }}</th>
                                        {{-- <th width="25%">{{ __('Tasks') }}</th> --}}
                                        {{-- <th width="20%">{{ __('Elearning License') }}</th> --}}
                                        {{--                                        <th width="20%">{{ __('Exams') }}</th> --}}
                                        <th width="15%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <tbody>
                                    {{-- <div id="loadingSpinner" style="display: none; text-align: center;">
                                        <i class="fas fa-spinner fa-spin fa-3x"></i>
                                    </div> --}}
                                    @include('backend.course.partials.courses_table', [
                                        'courses' => $courses,
                                    ])
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        {{ $courses->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        // $(document).ready(function() {
        //     $(document).on('click', '.pagination a', function(e) {
        //         e.preventDefault();
        //         var url = $(this).attr('href');
        //         getCourses(url);
        //     });
        //
        //     function getCourses(url) {
        //         $.ajax({
        //             url: url,
        //             type: 'GET',
        //             beforeSend: function() {
        //                 $('#courses-table').html('Loading...');
        //             },
        //             success: function(data) {
        //                 $('#courses-table').html(data);
        //             },
        //             error: function(xhr) {
        //                 console.log('AJAX request failed:', xhr);
        //             }
        //         });
        //     }
        // });
    </script>
    {{-- <script>
        $(document).ready(function() {
            const url = '/backend/courses/search';
            setupSearchInput(url);
        });
    </script> --}}
@endpush
