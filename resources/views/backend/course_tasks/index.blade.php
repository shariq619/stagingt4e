@extends('layouts.main')

@section('title', 'Course Tasks')

@section('breadcump')
    <div class="col-sm-6">
        <h1 class="m-0">{{ __('Course Tasks') }}</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('backend.dashboard.index') }}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item active">{{ __('Course Tasks') }}</li>
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
                        {{ __('Data Course Tasks') }}
                    </h3>
                </div>
                <div class="card-body">
                    <div class="card-tools d-flex align-items-center justify-content-between">
                        <form action="{{ route('backend.course_tasks.index') }}" method="GET" class="d-flex  align-items-center">
                            <div class="input-group input-group-sm mb-3" style="width: 300px;">
                                <input type="text" name="search" class="form-control" placeholder="Search course tasks..."
                                    value="{{ request()->get('search') }}" style="height: calc(2.25rem + 2px);">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                        @can('add course_tasks')
                            <div class="text-right mb-3">
                                <a href="{{ route('backend.course_tasks.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus-circle mr-2"></i>
                                    {{ __('Add course tasks') }}
                                </a>
                            </div>
                        @endcan
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Resource') }}</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($tasks as $task)
                                    <tr>
                                        <td>#{{ $task->id }}</td>
                                        <td>{{ $task->name }}</td>

                                        <td>
                                            @if ($task->task_code)
                                                <a class="btn btn-info" role="button" href="{{ asset($task->task_code) }}" target="_blank">View</a>
                                            @endif
                                        </td>

                                        <td>
                                            @can('change course_tasks')
                                                    <a href="{{ route('backend.course_tasks.edit', $task->id) }}"
                                                        class="btn btn-sm btn-warning">
                                                        <i class="fas fa-edit mr-2"></i>
                                                        {{ __('Update') }}
                                                    </a>
                                            @endcan
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">
                                            <i>{{ __('Course tasks are empty') }}</i>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center">
                            {{ $tasks->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
