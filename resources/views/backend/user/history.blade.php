@php use App\Models\Task;use Carbon\Carbon; @endphp
@extends('layouts.main')

@section('title', 'User History')

@section('breadcump')
    <div class="col-sm-6">
        <h1 class="m-0">{{ __('User History') }}</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('backend.dashboard.index') }}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item">{{ __('User History') }}</li>
            <li class="breadcrumb-item active">{{ __('User History') }}</li>
        </ol>
    </div>
@endsection

@section('main')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ __('Detail User History') }}</h3>
                </div>
                <div class="card-body">
                    <div class="text-right mb-3">
                        <a href="{{ route('backend.users.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left mr-2"></i>
                            {{ __('Return') }}
                        </a>
                    </div>

                    @forelse($histories as $history)
                        <div class="card mb-4">
                            <div class="card-header bg-gradient-blue">
                                <strong>Change made on:</strong> {{ $history->created_at->format('d M Y H:i') }}
                            </div>
                            <div class="card-body">

                                @if($history->cohort_ids)
                                    <p><strong>Old
                                            Cohorts:</strong> {{ implode(', ', json_decode($history->cohort_ids)) }}</p>
                                @endif

                                @if($history->task_submissions)
                                    <h5>Task Submissions</h5>
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-sm">
                                            <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Cohort</th>
                                                <th>Task</th>
                                                <th>Status</th>
                                                <th>Submitted At</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach(json_decode($history->task_submissions, true) as $task)
                                                @if(isset($task['task_id']))
                                                    @php
                                                        $taskName = $tasks[$task['task_id'] ?? 0]->name ?? '-';
                                                        $licenseName = $licenses[$task['license_id'] ?? 0]->name ?? '-';
                                                        $courseName = $courses[$task['course_id'] ?? 0]->name ?? '-';
                                                        $start_date_time = $cohorts[$task['cohort_id'] ?? 0]->start_date_time ?? '-';
                                                        $end_date_time = $cohorts[$task['cohort_id'] ?? 0]->end_date_time ?? '-';
                                                        $submittedAt = isset($task['created_at']) ? Carbon::parse($task['created_at'])->format('d M Y H:i') : '-';
                                                    @endphp
                                                    <tr>
                                                        <td>{{ $task['id'] ?? '-' }}</td>
                                                        <td>
                                                            <strong>{{ $courseName }} ({{ $task['cohort_id'] }})</strong><br>
                                                            <small>
                                                                {{ $start_date_time ? \Carbon\Carbon::parse($start_date_time)->format('d M Y H:i') : '-' }}
                                                                –
                                                                {{ $end_date_time ? \Carbon\Carbon::parse($end_date_time)->format('d M Y H:i') : '-' }}
                                                            </small>
                                                        </td>
                                                        <td>{{ $taskName }}</td>
                                                        <td>{{ ucfirst($task['status'] ?? '-') }}</td>
                                                        <td>{{ $submittedAt }}</td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @endif

                                @if($history->task_submissions)
                                    <h5>E Learning Submissions</h5>
                                    <div class="table-responsive">

                                        <table class="table table-bordered table-sm">
                                            <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Cohort</th>
                                                <th>License</th>
                                                <th>SCORM Details</th>
                                                <th>Status</th>
                                                <th>Submitted At</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach(json_decode($history->task_submissions, true) as $task)
                                                @if(isset($task['license_id']))
                                                    @php
                                                        $taskName = $tasks[$task['task_id'] ?? 0]->name ?? '-';
                                                        $licenseName = $licenses[$task['license_id'] ?? 0]->name ?? '-';
                                                        $courseName = $courses[$task['course_id'] ?? 0]->name ?? '-';

                                                        $cohort = $cohorts[$task['cohort_id'] ?? 0] ?? null;
                                                        $start_date_time = $cohort?->start_date_time;
                                                        $end_date_time = $cohort?->end_date_time;

                                                        $submittedAt = isset($task['created_at'])
                                                            ? \Carbon\Carbon::parse($task['created_at'])->format('d M Y H:i')
                                                            : '-';
                                                    @endphp
                                                    <tr>
                                                        <td>{{ $task['id'] ?? '-' }}</td>
                                                        <td>
                                                            <strong>{{ $courseName }} ({{ $task['cohort_id'] }})</strong><br>
                                                            <small>
                                                                {{ $start_date_time ? \Carbon\Carbon::parse($start_date_time)->format('d M Y H:i') : '-' }}
                                                                –
                                                                {{ $end_date_time ? \Carbon\Carbon::parse($end_date_time)->format('d M Y H:i') : '-' }}
                                                            </small>
                                                        </td>
                                                        <td>{{ $licenseName }}</td>
                                                        <td>
                                                            <strong>Document:</strong> {{ $task['act_document'] ?? '-' }}<br>
                                                            <strong>Registration ID:</strong> {{ $task['scorm_registration_id'] ?? '-' }}<br>
                                                            <strong>Course Link:</strong>
                                                            @if(!empty($task['scorm_course_link']))
                                                                {{ $task['scorm_course_link'] }}
                                                            @else
                                                                -
                                                            @endif
                                                        </td>
                                                        <td>{{ ucfirst($task['status'] ?? '-') }}</td>
                                                        <td>{{ $submittedAt }}</td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                            </tbody>
                                        </table>

                                    </div>
                                @endif

                                @if($history->learner_certificates)
                                    <h5>Learner Certificates</h5>
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-sm">
                                            <thead>
                                            <tr>
                                                <th>Certificate Title</th>
                                                <th>Issued At</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach(json_decode($history->learner_certificates, true) as $lc)
                                                <tr>
                                                    <td>{{ $lc['title'] ?? $lc['certificate_name'] ?? '-' }}</td>
                                                    <td>{{ $lc['issued_at'] ?? $lc['created_at'] ?? '-' }}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @endif

                            </div>
                        </div>
                    @empty
                        <p>No history records available.</p>
                    @endforelse


                    <div class="mt-4">
                        {{ $histories->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

