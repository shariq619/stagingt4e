@extends('layouts.main')

@section('title', 'Risk Assessments')

@section('breadcump')
    <div class="col-sm-6">
        <h1 class="m-0">{{ __('Risk Assessments') }}</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('backend.dashboard.index') }}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item active">{{ __('Risk Assessments') }}</li>
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
                <div class="card-body">
                    <div class="card-tools userDashboard d-flex align-items-center justify-content-between">
                        @can('add category')
                            <div class="text-right mb-3">
                                <a href="{{ route('backend.categories.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus-circle mr-2"></i>
                                    {{ __('Add category') }}
                                </a>
                            </div>
                        @endcan
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Cohort</th>
                                <th>Trainer</th>
                                <th>Course Name</th>
                                <th>Sign Date</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($riskAssessments as $ra)
                                <tr>
                                    <td>{{ $ra->id }}</td>
                                    <td>{!! formatCourseDate($ra->cohort) !!}</td>
                                    <td>{{ $ra->trainer->name ?? '-' }}</td>
                                    <td>{{ $ra->course_name }}</td>
                                    <td>{{ $ra->sign_date }}</td>
                                    <td>
                                        <a href="{{ route('backend.risk-assessments.show', $ra) }}"
                                           class="btn btn-info btn-sm">View</a>
{{--                                        <a href="{{ route('backend.risk-assessments.edit', $ra) }}"--}}
{{--                                           class="btn btn-warning btn-sm">Edit</a>--}}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center">
                            {{ $riskAssessments->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
