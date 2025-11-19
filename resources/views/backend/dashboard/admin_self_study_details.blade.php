@php use App\Libraries\ScormApiService; @endphp
@extends('layouts.main')

@section('content')
    @push('css')
        <style>
            .card {
                margin-bottom: 20px;
                box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            }

            .card-title {
                font-weight: 600;
                margin-bottom: 1rem;
            }

            .table-responsive {
                overflow-x: auto;
            }

            .exam-section {
                margin-bottom: 1rem;
                padding-bottom: 1rem;
                border-bottom: 1px solid #eee;
            }

            .badge {
                font-size: 0.85em;
                font-weight: 500;
            }
        </style>
    @endpush
    @section('main')
        <div class="content">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Learner Self-Study Details</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Learner Info Column -->
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body text-center">
                                    @if ($submission->user->profilePhoto && $submission->user->profilePhoto->profile_photo && $submission->user->profilePhoto->status === 'Approved')
                                        <img src="{{ asset($submission->user->profilePhoto->profile_photo) }}"
                                             style="width:200px; height:160px;" class="img-fluid mb-3" alt="User Image">
                                    @else
                                        <img src="{{ asset('images/placeholderimage.jpg') }}"
                                             style="width:150px; height:auto;" class="img-fluid mb-3"
                                             alt="Placeholder Image">
                                    @endif

                                    <h4>{{ $submission->user->name }} {{ $submission->user->last_name ?? "" }}</h4>
                                    <p class="text-muted">{{ $submission->user->email }}</p>
                                    <p><i class="fas fa-phone"></i> {{ $submission->user->telephone }}</p>
                                </div>
                            </div>

                            <!-- Course Info -->
                            <div class="card mt-3">
                                <div class="card-body">
                                    <h5 class="font-weight-bold">Course Information</h5>
                                    <p><strong>Course:</strong> {{ $submission->cohort->course->name }}</p>
                                    <p><strong>Cohort:</strong>
                                        @php
                                            $start = Carbon\Carbon::parse($submission->cohort->start_date_time);
                                            $end = Carbon\Carbon::parse($submission->cohort->end_date_time);
                                            if ($start->isSameDay($end)) {
                                                $datePart = $start->format('d F Y');
                                            } else {
                                                $datePart = $start->format('d') . '-' . $end->format('d') . ' ' . $end->format('F Y');
                                            }
                                            $timePart = $start->format('Hi') . '-' . $end->format('Hi');
                                        @endphp
                                        {{ $datePart }}, {{ $timePart }}
                                    </p>
                                    <p><strong>Venue:</strong> {{ $submission->cohort->venue->venue_name ?? "N/A" }}</p>
                                    <p><strong>Trainer:</strong> {{ $submission->cohort->trainer->name ?? "N/A" }}</p>
                                </div>
                            </div>

                            <!-- Certifications -->
                            @if($submission->user->certifications->isNotEmpty())
                                <div class="card mt-3">
                                    <div class="card-body">
                                        <h5 class="font-weight-bold">Certifications</h5>
                                        @foreach($submission->user->certifications as $certification)
                                            <p><strong>{{ $certification->name }}</strong></p>
                                            <p>Type: {{ $certification->pivot->qualification_type }}</p>
                                            @if($certification->pivot->qualification_type == "external" && $certification->pivot->course_certificate)
                                                <a target="_blank"
                                                   href="{{ asset($certification->pivot->course_certificate) }}"
                                                   class="btn btn-sm btn-primary">
                                                    View Certificate
                                                </a>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!-- Main Content Column -->
                        <div class="col-md-8">
                            <!-- Application Form Status -->
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h5 class="font-weight-bold">Application Form</h5>
                                    <p>
                                        Status:
                                        @switch($submission->user->applicationForm->status ?? 'Not Submitted')
                                            @case('Approved') <span class="badge bg-success">Approved</span> @break
                                            @case('Rejected') <span class="badge bg-danger">Rejected</span> @break
                                            @case('Not Submitted') <span
                                                class="badge bg-secondary">Not Submitted</span> @break
                                            @default <span class="badge bg-warning text-dark">In Progress</span>
                                        @endswitch
                                    </p>
                                    @if(($submission->user->applicationForm->learner_pdf ?? false))
                                        <a href="{{ asset($submission->user->applicationForm->learner_pdf) }}"
                                           target="_blank"
                                           class="btn btn-sm btn-primary">
                                            View Application
                                        </a>
                                    @endif
                                </div>
                            </div>

                            <!-- Proof of ID Status -->
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h5 class="font-weight-bold">Proof of ID</h5>
                                    <p>
                                        Status:
                                        @switch($submission->user->documentUpload->status ?? 'Not Submitted')
                                            @case('Approved') <span class="badge bg-success">Approved</span> @break
                                            @case('Rejected') <span class="badge bg-danger">Rejected</span> @break
                                            @case('Not Submitted') <span
                                                class="badge bg-secondary">Not Submitted</span> @break
                                            @default <span class="badge bg-warning text-dark">In Progress</span>
                                        @endswitch
                                    </p>
                                    @if(isset($submission->user->documentUpload->first_front_upload))
                                        <a href="{{ asset($submission->user->documentUpload->first_front_upload) }}"
                                           target="_blank"
                                           class="btn btn-sm btn-primary">
                                            View
                                        </a>
                                    @endif
                                    @if(isset($submission->user->documentUpload->first_back_upload))
                                        <a href="{{ asset($submission->user->documentUpload->first_back_upload) }}"
                                           target="_blank"
                                           class="btn btn-sm btn-primary">
                                            View
                                        </a>
                                    @endif
                                    @if(isset($submission->user->documentUpload->second_front_upload))
                                        <a href="{{ asset($submission->user->documentUpload->second_front_upload) }}"
                                           target="_blank"
                                           class="btn btn-sm btn-primary">
                                            View
                                        </a>
                                    @endif
                                    @if(isset($submission->user->documentUpload->second_back_upload))
                                        <a href="{{ asset($submission->user->documentUpload->second_back_upload) }}"
                                           target="_blank"
                                           class="btn btn-sm btn-primary">
                                            View
                                        </a>
                                    @endif
                                    @if(isset($submission->user->documentUpload->third_front_upload))
                                        <a href="{{ asset($submission->user->documentUpload->third_front_upload) }}"
                                           target="_blank"
                                           class="btn btn-sm btn-primary">
                                            View
                                        </a>
                                    @endif
                                    @if(isset($submission->user->documentUpload->third_back_upload))
                                        <a href="{{ asset($submission->user->documentUpload->third_back_upload) }}"
                                           target="_blank"
                                           class="btn btn-sm btn-primary">
                                            View
                                        </a>
                                    @endif
                                </div>
                            </div>

                            <!-- Task Submissions -->
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h5 class="font-weight-bold">Task Submissions</h5>
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                            <tr>
                                                <th>Task Name</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($submissions as $taskSubmission)
                                                <tr>
                                                    <td>{{ $taskSubmission->task->name }}</td>
                                                    <td>
                                                        @switch($taskSubmission->status)
                                                            @case('Approved') <span
                                                                class="badge bg-success">Approved</span> @break
                                                            @case('Rejected') <span
                                                                class="badge bg-danger">Rejected</span> @break
                                                            @case('Not Submitted') <span class="badge bg-secondary">Not Submitted</span> @break
                                                            @default <span class="badge bg-warning text-dark">In Progress</span>
                                                        @endswitch
                                                    </td>
                                                    <td>
                                                        @if($taskSubmission->pdf)
                                                            <a href="{{ asset($taskSubmission->pdf) }}" target="_blank"
                                                               class="btn btn-sm btn-primary">
                                                                View Submission
                                                            </a>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <!-- Exams -->
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h5 class="font-weight-bold">Exams & Assessments</h5>
                                    @foreach($submission->cohort->course->exams as $exam)
                                        @php
                                            $result = $examResults->firstWhere('exam_id', $exam->id);
                                        @endphp
                                        <div class="mb-3 p-3 border rounded">
                                            <h6>{{ $exam->name }}</h6>
                                            @if($result)
                                                <p>
                                                    Status:
                                                    @switch($result->status)
                                                        @case('Passed') <span
                                                            class="badge bg-success">Passed</span> @break
                                                        @case('Failed') <span
                                                            class="badge bg-danger">Failed</span> @break
                                                        @default <span
                                                            class="badge bg-warning text-dark">In Progress</span>
                                                    @endswitch
                                                </p>
                                                <p>Score: {{ $result->score ?? 'N/A' }}</p>
                                            @else
                                                <form action="{{ route('backend.exam-results.store') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="exam_id" value="{{ $exam->id }}">
                                                    <input type="hidden" name="cohort_id"
                                                           value="{{ $submission->cohort_id }}">
                                                    <input type="hidden" name="learner_id"
                                                           value="{{ $submission->user_id }}">

                                                    <div
                                                        class="d-flex justify-content-between align-items-md-center align-items-lg-center align-items-xl-center mb-2 flex-column flex-xl-row flex-lg-row flex-md-row">
                                                        <div class="mb-md-0 mb-lg-0 mb-xl-0 mb-2">
                                                            <span class="badge bg-secondary">Not Taken</span>
                                                        </div>
                                                        <div class="d-flex">
                                                            <select name="status"
                                                                    class="form-select form-select-sm mr-2"
                                                                    style="width: auto;">
                                                                <option value="Passed">Passed</option>
                                                                <option value="Failed">Failed</option>
                                                            </select>
                                                            <button type="submit" class="btn btn-sm btn-primary">Submit
                                                                Result
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- E-Learning Progress -->
                            <div class="card">
                                <h5 class="card-title">E-Learning Progress</h5>
                                @foreach($sub as $s)
                                    @php

                                        $scormApiService = new ScormApiService();
                                        if(isset($s->scorm_registration_id)){
                                            $course_info = $scormApiService->getRegistrationDetails($s->scorm_registration_id);
                                        }

            //                            echo '<pre>';
            //                            print_r("here UserID:".$s->user_id);

                                        if(isset($course_info)){
                                            $activityDetails = $course_info['activityDetails'];
                                            $title = $activityDetails['title'] ?? 'N/A';
                                            $attempts = $activityDetails['attempts'] ?? 'N/A';
                                            $activity_completion = $activityDetails['activityCompletion'] ?? 'N/A';
                                            $completionAmount = $activityDetails['completionAmount']['scaled'] ?? 'N/A';
                                            $totalSecondsTracked = $course_info['totalSecondsTracked'] ?? 0;
                                            $hours = floor($totalSecondsTracked / 3600);
                                            $minutes = floor(($totalSecondsTracked / 60) % 60);
                                            $seconds = $totalSecondsTracked % 60;
                                        }

                                    @endphp
                                    @if(isset($course_info))

                                        <div class="card-body">

                                            <p><strong>Title:</strong> {{ $title }}</p>
                                            <p><strong>Attempts:</strong> {{ $attempts }}</p>
                                            <p><strong>Completion Status:</strong> {{ $activity_completion }}</p>
                                            <p><strong>Score:</strong> {{ $completionAmount }}</p>
                                            <p><strong>Total Time Tracked:</strong> {{ $hours }} hours, {{ $minutes }}
                                                minutes, {{ $seconds }} seconds</p>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('backend.admin.self.study') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back to List
                    </a>
                </div>
            </div>
    @endsection
