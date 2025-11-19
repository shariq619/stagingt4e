@php use Illuminate\Support\Str; @endphp
@extends('layouts.main')

@section('title', 'User')

@section('breadcump')
    <div class="col-sm-6">
        <h1 class="m-0">{{ __('Task') }}</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('backend.learner.dashboard') }}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item">{{ __('Task') }}</li>
            <li class="breadcrumb-item active">{{ __('Detail') }}</li>
        </ol>
    </div>
@endsection

@section('main')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    {{ $task->name }}
                </h3>
            </div>
            <div class="card-body">
                <div class="text-right mb-3">
                    <a href="{{ route('backend.learner.dashboard') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left mr-2"></i>
                        {{ __('Return') }}
                    </a>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        @php
                            $task_file = Str::snake(strtolower($task->name));
                        @endphp
                        @include('backend.tasks.'.$task_file,[
                            'learner_response'=>$learner_response,
                            'course_id'=>$course_id,
                            'cohort_id'=>$cohort_id,
                            'trainer_id'=>$trainer_id,
                            'cohort_info'=>$cohort_info,
                        ])
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
