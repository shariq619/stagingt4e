@php use App\Libraries\ScormApiService;use Carbon\Carbon;use Illuminate\Support\Str; @endphp
@extends('layouts.main')

@section('title', 'Self Study Reports')

@section('breadcump')
    <div class="col-sm-6">
        <h1 class="m-0">{{ __('Self Study Reports') }}</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('backend.dashboard.index') }}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item active">{{ __('Dashboard') }}</li>
        </ol>
    </div>
@endsection

@push('css')
    <link href="{{ asset('css/adminltev3.css') }}" rel="stylesheet"/>
    <link href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet"/>
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet"/>
    <style>
        .placeholder-image {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            background-color: #ddd;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 auto;
        }

        .placeholder-image i {
            font-size: 50px;
            color: #888;
        }

        .task-list {
            list-style-type: none; /* Remove default bullets */
            padding: 0;
            margin: 0;
        }

        .task-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc; /* Add a border */
            border-radius: 5px;
            background-color: #f9f9f9; /* Optional: background color */
        }

        .task-box {
            flex: 1;
            padding: 10px;
            border-right: 1px solid #ddd;
            background-color: #f0f8ff; /* Light blue background */
            border-radius: 5px 0 0 5px; /* Rounded corners on the left */
        }

        .status-box {
            /* padding: 10px; */

            border-radius: 0 5px 5px 0; /* Rounded corners on the right */
            width: 150px; /* Set a fixed width for the status box */
            /* text-align: center; */
        }

        .task-box a {
            text-decoration: none;
            color: #333;
        }

        .task-box a:hover {
            text-decoration: underline;
        }

        .exam-list {
            list-style-type: none; /* Remove default bullets */
            padding: 0;
            margin: 0;
        }

        .exam-item {
            margin-bottom: 10px; /* Space between items */
        }

        .exam-box {
            padding: 10px;
            background-color: #f0f8ff; /* Light blue background */
            border: 1px solid #ccc; /* Border */
            border-radius: 5px; /* Rounded corners */
            text-align: center; /* Center text */
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2); /* Optional: subtle shadow for depth */
        }


    </style>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet" />


@endpush

@section('main')
    <div class="content">
        <!-- My Courses -->
        <div class="row">
            <div class="col-md-12 col-12 mb-4">
                <div class="filter-section mb-4">
                    <form action="{{ route('backend.admin.self.study') }}" method="GET">
                        <div class="row">

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="learner">Learner</label>
                                    <select name="learner" id="learner" class="form-control select2">
                                        <option value="">Select Learner</option>
                                        @foreach ($learners as $learner)
                                            <option value="{{ $learner->id }}" {{ request('learner') == $learner->id ? 'selected' : '' }}>
                                                {{ $learner->name }} {{ $learner->last_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                            <!-- Course Filter -->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="course">Course</label>
                                    <select name="course" id="course" class="form-control">
                                        <option value="">Select Course</option>
                                        @foreach ($courses as $course)
                                            <option
                                                value="{{ $course->id }}" {{ request('course') == $course->id ? 'selected' : '' }}>
                                                {{ $course->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="venue">Venue</label>
                                    <select name="venue" id="venue" class="form-control">
                                        <option value="">Select Venue</option>
                                        @foreach ($venues as $venue)
                                            <option
                                                value="{{ $venue->id }}" {{ request('venue') == $venue->id ? 'selected' : '' }}>
                                                {{ $venue->venue_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Start Date Filter -->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="cohorts">Select Cohorts</label>
                                    <select name="cohorts" id="cohorts" class="form-control select2">
                                        <option value="">Select Cohorts</option>
                                        @foreach ($submitted_cohorts as $cohort)
                                            <option
                                                value="{{ $cohort->id }}" {{ request('cohorts') == $cohort->id ? 'selected' : '' }}>
                                                {{   isset($cohort->start_date_time) ? \Carbon\Carbon::parse($cohort->start_date_time)->format('d F, Y, h:i A') : 'N/A' }}
                                                -
                                                {{   isset($cohort->end_date_time) ? \Carbon\Carbon::parse($cohort->end_date_time)->format('d F, Y, h:i A') : 'N/A' }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="trainer">Trainers</label>
                                    <select name="trainer" id="trainer" class="form-control">
                                        <option value="">Select Trainer</option>
                                        @foreach ($trainers as $trainer)
                                            <option
                                                value="{{ $trainer->id }}" {{ request('trainer') == $trainer->id ? 'selected' : '' }}>
                                                {{ $trainer->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Submit and Reset Buttons -->
                            <div class="col-md-2">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary mt-4">Filter</button>
                                    <!-- Reset Button -->
                                    <a href="{{ route('backend.admin.self.study') }}"
                                       class="btn btn-secondary mt-4">Reset</a>
                                </div>
                            </div>
                        </div>
                    </form>


                </div>
            </div>


            <div class="col-md-12 col-12 mb-4">
                <div class="otsTask mt-4 p-4 h-100 ">
                    <div class="otsTaskInner">


                        <div class="otstaskData card-body table-responsive p-0" id="trainerMyLearners">
                            {{-- <form id="bulkUpdateForm" action="{{ route('backend.trainer.bulkUpdate') }}" method="POST">
                                 @csrf--}}


                            <div class="card-body">
                                @if($groupedSubmissions->isNotEmpty())
                                    <div class="table-responsive">

                                        @if (session()->has('success'))
                                            <div class="row mt-2">
                                                <div class="col-md-12">
                                                    <div class="alert alert-success alert-dismissible">
                                                        <button type="button" class="close" data-dismiss="alert"
                                                                aria-hidden="true">×
                                                        </button>
                                                        {{ session('success') }}
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        <table class="table table-bordered align-middle">
                                            <thead>
                                            <tr>
                                                <th>Photo</th>
                                                <th>Learner</th>
                                                <th>Venue</th>
                                                <th>Course</th>
                                                <th>Cohort</th>
                                                <th>Trainer</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            @foreach($groupedSubmissions as $group)
                                                @php
                                                    $cohort = $group['cohort'];
                                                @endphp
                                                @foreach($group['learners'] as $learner)
                                                    <tr>
                                                        <td>
                                                            @if (!empty($learner['profile_photo']) && $learner['profile_photo_status'] === 'Approved')
                                                                <img src="{{ asset($learner['profile_photo']) }}" style="width:200px; height:160px;" alt="User Image">
                                                            @else
                                                                <img src="{{ asset('images/placeholderimage.jpg') }}" style="width:150px; height:auto;" alt="Placeholder Image">
                                                            @endif
                                                        </td>
                                                        <td>{{ $learner['learner_name'] }}</td>
                                                        <td>{{ $cohort['venue'] }}</td>
                                                        <td>{{ $cohort['course_name'] }}</td>
                                                        @php
                                                            $start = \Carbon\Carbon::parse($cohort['start_date']);
                                                            $end = \Carbon\Carbon::parse($cohort['end_date']);

                                                            if ($start->isSameDay($end)) {
                                                                $datePart = $start->format('d F Y');
                                                            } else {
                                                                $datePart = $start->format('d') . '-' . $end->format('d') . ' ' . $end->format('F Y');
                                                            }

                                                            $timePart = $start->format('Hi') . '-' . $end->format('Hi');
                                                        @endphp
                                                        <td>{{ $datePart }}, {{ $timePart }}</td>
                                                        <td>{{ $cohort['trainer_name'] ?? 'N/A' }}</td>
                                                        @php
                                                            $firstSubmission = collect($learner['submitted_tasks'])->firstWhere('submission_id', '!=', null);
                                                        @endphp
                                                        <td>
                                                            @if($firstSubmission)
                                                                <a href="{{ route('backend.admin.self.study.details', $firstSubmission['submission_id']) }}" class="btn btn-sm btn-primary">
                                                                    <i class="fas fa-eye mr-2"></i>View
                                                                </a>
                                                            @else
                                                                <span class="text-muted">No Submission</span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endforeach



                                            {{--                                            @foreach($groupedSubmissions as $learnerId => $cohorts)--}}
{{--                                                @foreach($cohorts as $cohortId => $submissions)--}}
{{--                                                    <tr>--}}
{{--                                                        <td>--}}
{{--                                                            <p>--}}
{{--                                                                @if ($submissions->first()->user->profilePhoto && $submissions->first()->user->profilePhoto->profile_photo && $submissions->first()->user->profilePhoto->status === 'Approved')--}}
{{--                                                                    <img--}}
{{--                                                                        src="{{ asset($submissions->first()->user->profilePhoto->profile_photo) }}"--}}
{{--                                                                        style="width:200px; height:160px;"--}}
{{--                                                                        alt="User Image">--}}
{{--                                                                @else--}}
{{--                                                                    <img--}}
{{--                                                                        src="{{ asset('images/placeholderimage.jpg') }}"--}}
{{--                                                                        style="width:150px; height:auto;"--}}
{{--                                                                        alt="Placeholder Image">--}}
{{--                                                                @endif--}}
{{--                                                            </p>--}}
{{--                                                            <p>--}}
{{--                                                                <strong>Learner--}}
{{--                                                                    Name: </strong> {{ $submissions->first()->user->name }}  {{ $submissions->first()->user->last_name ?? "" }}--}}
{{--                                                            </p>--}}

{{--                                                            <p>--}}
{{--                                                                <strong>Trainers: </strong>--}}
{{--                                                                <small> {{ $submissions->first()->cohort->trainer->name }}</small>--}}
{{--                                                            </p>--}}

{{--                                                            <p class="m-0">--}}
{{--                                                                <strong>Course: </strong>--}}
{{--                                                                <small>{{ $submissions->first()->cohort->course->name }}</small>--}}
{{--                                                            </p>--}}
{{--                                                            <hr class="my-2">--}}
{{--                                                            @php--}}

{{--                                                                $start = Carbon::parse($submissions->first()->cohort->start_date_time);--}}
{{--                                                                $end = Carbon::parse($submissions->first()->cohort->end_date_time);--}}

{{--                                                                // If same day--}}
{{--                                                                if ($start->isSameDay($end)) {--}}
{{--                                                                    $datePart = $start->format('d F Y'); // e.g., "07 April 2025"--}}
{{--                                                                } else {--}}
{{--                                                                    $datePart = $start->format('d') . '-' . $end->format('d') . ' ' . $end->format('F Y'); // e.g., "07-08 April 2025"--}}
{{--                                                                }--}}

{{--                                                                // Time part, always--}}
{{--                                                                $timePart = $start->format('Hi') . '-' . $end->format('Hi');--}}
{{--                                                            @endphp--}}

{{--                                                            <p class="m-0">--}}
{{--                                                                <strong>Cohort Date: </strong>--}}
{{--                                                                <small>{{ $datePart }}, {{ $timePart }}</small>--}}
{{--                                                            </p>--}}
{{--                                                            <hr class="my-2">--}}
{{--                                                            <p class="m-0">--}}
{{--                                                                <strong>Telephone: </strong>--}}
{{--                                                                <small>--}}
{{--                                                                    {{ $submissions->first()->user->telephone }}--}}
{{--                                                                </small>--}}
{{--                                                            </p>--}}
{{--                                                            <hr class="my-2">--}}
{{--                                                            <p class="m-0">--}}
{{--                                                                <strong>Venue: </strong>--}}
{{--                                                                <small>--}}
{{--                                                                    {{ $submissions->first()->cohort->venue->venue_name ?? ""  }}--}}
{{--                                                                </small>--}}
{{--                                                            </p>--}}
{{--                                                            <hr class="my-2">--}}
{{--                                                            <p class="m-0">--}}
{{--                                                                <strong>E-Learning: </strong>--}}
{{--                                                                <small>--}}
{{--                                                                    @php--}}
{{--                                                                        // Query to fetch license details for this cohort--}}
{{--                                                                        $sub = \App\Models\TaskSubmission::with('license')->where('cohort_id', $cohortId)->where('license_id', '!=' , null)->get();--}}
{{--                                                                        //dd($sub);--}}
{{--                                                                        foreach($sub as $s){--}}
{{--                                                                            $scormApiService = new ScormApiService();--}}
{{--                                                                       // if(app()->isProduction()){--}}
{{--                                                                                $course_info = $scormApiService->getRegistrationDetails($s->scorm_registration_id);--}}
{{--                                                                        //    }--}}
{{--                                                                    @endphp--}}

{{--                                                                        <!-- Check if a license was found -->--}}
{{--                                                                    @if (isset($course_info))--}}
{{--                                                                        @php--}}
{{--                                                                            $activityDetails = $course_info['activityDetails'];--}}
{{--                                                                            $title = $activityDetails['title'] ?? 'N/A';--}}
{{--                                                                            $attempts = $activityDetails['attempts'] ?? 'N/A';--}}
{{--                                                                            $activity_completion = $activityDetails['activityCompletion'] ?? 'N/A';--}}
{{--                                                                            $completionAmount = $activityDetails['completionAmount']['scaled'] ?? 'N/A';--}}

{{--                                                                            $totalSecondsTracked = $course_info['totalSecondsTracked'] ?? 0;--}}
{{--                                                                            $hours = floor($totalSecondsTracked / 3600);--}}
{{--                                                                            $minutes = floor(($totalSecondsTracked / 60) % 60);--}}
{{--                                                                            $seconds = $totalSecondsTracked % 60;--}}
{{--                                                                        @endphp--}}

{{--                                                                        <p class="mt-3">--}}
{{--                                                                            <strong>Title:</strong> {{ $title }}<br>--}}
{{--                                                                            <strong>Attempts:</strong> {{ $attempts }}--}}
{{--                                                                            <br>--}}
{{--                                                                            <strong>Completion--}}
{{--                                                                                Status:</strong> {{ $activity_completion }}--}}
{{--                                                                            <br>--}}
{{--                                                                            <strong>Score:</strong> {{ $completionAmount }}--}}
{{--                                                                            <br>--}}
{{--                                                                            <strong>Total Time--}}
{{--                                                                                Tracked:</strong> {{ $hours }}--}}
{{--                                                                            hours, {{ $minutes }}--}}
{{--                                                                            minutes, {{ $seconds }}--}}
{{--                                                                            seconds<br>--}}
{{--                                                                        </p>--}}
{{--                                                                    @else--}}
{{--                                                                        <p>No course information available.</p>--}}
{{--                                                                    @endif--}}

{{--                                                                    @php--}}
{{--                                                                        }--}}
{{--                                                                    @endphp--}}
{{--                                                                </small>--}}
{{--                                                            </p>--}}

{{--                                                        </td>--}}
{{--                                                        <td>--}}
{{--                                                            @forelse($submissions->first()->user->certifications as $certification)--}}
{{--                                                                <p>--}}
{{--                                                                    <strong>Certification:</strong> {{ $certification->name }}--}}
{{--                                                                </p>--}}
{{--                                                                <p><strong>Qualification--}}
{{--                                                                        Type:</strong> {{ $certification->pivot->qualification_type }}--}}
{{--                                                                </p>--}}

{{--                                                                @if($certification->pivot->qualification_type == "external")--}}
{{--                                                                    <a target="_blank"--}}
{{--                                                                       href="{{ asset($certification->pivot->course_certificate) }}"--}}
{{--                                                                       class="btn btn-sm btn-outline-primary">View</a>--}}
{{--                                                                @endif--}}
{{--                                                            @empty--}}
{{--                                                                <p></p>--}}
{{--                                                            @endforelse--}}
{{--                                                        </td>--}}

{{--                                                        <td class="p-2">--}}
{{--                                                            <table class="table table-sm table-bordered mb-0">--}}
{{--                                                                <thead class="table-light">--}}
{{--                                                                <tr>--}}
{{--                                                                    <th>Name</th>--}}
{{--                                                                    <th>Status</th>--}}
{{--                                                                    <th>Action</th>--}}
{{--                                                                </tr>--}}
{{--                                                                </thead>--}}
{{--                                                                <tbody>--}}
{{--                                                                --}}{{-- Application Form --}}
{{--                                                                <tr>--}}
{{--                                                                    <td><strong>Application Form</strong></td>--}}
{{--                                                                    <td>--}}
{{--                                                                        @switch($submissions->first()->user->applicationForm->status)--}}
{{--                                                                            @case('Approved')--}}
{{--                                                                                <span--}}
{{--                                                                                    class="badge bg-success">Approved</span>--}}
{{--                                                                                @break--}}
{{--                                                                            @case('Rejected')--}}
{{--                                                                                <span--}}
{{--                                                                                    class="badge bg-danger">Rejected</span>--}}
{{--                                                                                @break--}}
{{--                                                                            @case('Not Submitted')--}}
{{--                                                                                <span class="badge bg-secondary">Not Submitted</span>--}}
{{--                                                                                @break--}}
{{--                                                                            @default--}}
{{--                                                                                <span--}}
{{--                                                                                    class="badge bg-warning text-dark">In Progress</span>--}}
{{--                                                                        @endswitch--}}
{{--                                                                    </td>--}}
{{--                                                                    <td>--}}
{{--                                                                        @if($submissions->first()->user->applicationForm->learner_pdf)--}}
{{--                                                                            <a href="{{ asset($submissions->first()->user->applicationForm->learner_pdf) }}"--}}
{{--                                                                               target="_blank"--}}
{{--                                                                               class="btn btn-sm btn-outline-primary">View</a>--}}
{{--                                                                        @else--}}
{{--                                                                            <a href="{{ route('backend.application-forms.index') }}"--}}
{{--                                                                               class="btn btn-sm btn-outline-primary">View</a>--}}
{{--                                                                        @endif--}}
{{--                                                                    </td>--}}
{{--                                                                </tr>--}}

{{--                                                                --}}{{-- Proof of ID --}}
{{--                                                                <tr>--}}
{{--                                                                    <td><strong>Proof of ID</strong></td>--}}
{{--                                                                    <td>--}}
{{--                                                                        @switch($submissions->first()->user->documentUpload->status)--}}
{{--                                                                            @case('Approved')--}}
{{--                                                                                <span--}}
{{--                                                                                    class="badge bg-success">Approved</span>--}}
{{--                                                                                @break--}}
{{--                                                                            @case('Rejected')--}}
{{--                                                                                <span--}}
{{--                                                                                    class="badge bg-danger">Rejected</span>--}}
{{--                                                                                @break--}}
{{--                                                                            @case('Not Submitted')--}}
{{--                                                                                <span class="badge bg-secondary">Not Submitted</span>--}}
{{--                                                                                @break--}}
{{--                                                                            @default--}}
{{--                                                                                <span--}}
{{--                                                                                    class="badge bg-warning text-dark">In Progress</span>--}}
{{--                                                                        @endswitch--}}
{{--                                                                    </td>--}}
{{--                                                                    <td>--}}
{{--                                                                        <a href="{{ route('backend.document-uploads.index') }}"--}}
{{--                                                                           class="btn btn-sm btn-outline-primary">View</a>--}}
{{--                                                                    </td>--}}
{{--                                                                </tr>--}}

{{--                                                                --}}{{-- Task Submissions --}}
{{--                                                                @foreach($submissions as $submission)--}}
{{--                                                                    @php--}}
{{--                                                                        $u_id = $submission->user_id ?? "";--}}
{{--                                                                        $t_id = $submission->task_id ?? "";--}}
{{--                                                                        $c_id = $submission->cohort_id ?? "";--}}
{{--                                                                    @endphp--}}
{{--                                                                    <tr>--}}
{{--                                                                        <td>{{ $submission->task->name }}</td>--}}
{{--                                                                        <td>--}}
{{--                                                                            @switch($submission->status)--}}
{{--                                                                                @case('Approved')--}}
{{--                                                                                    <span class="badge bg-success">Approved</span>--}}
{{--                                                                                    @break--}}
{{--                                                                                @case('Rejected')--}}
{{--                                                                                    <span class="badge bg-danger">Rejected</span>--}}
{{--                                                                                    @break--}}
{{--                                                                                @case('Not Submitted')--}}
{{--                                                                                    <span class="badge bg-secondary">Not Submitted</span>--}}
{{--                                                                                    @break--}}
{{--                                                                                @default--}}
{{--                                                                                    <span--}}
{{--                                                                                        class="badge bg-warning text-dark">In Progress</span>--}}
{{--                                                                            @endswitch--}}
{{--                                                                        </td>--}}
{{--                                                                        <td>--}}


{{--                                                                            <a target="_blank" href="{{ asset($submission->pdf) }}" class="btn btn-sm btn-outline-primary">--}}
{{--                                                                                View--}}
{{--                                                                            </a>--}}


{{--                                                                            @if($submission->status == "In Progress")--}}
{{--                                                                                <a target="_blank"--}}
{{--                                                                                   href="{{ route('backend.trainer.viewSubmission', ['user_id' => $u_id, 'task_id' => $t_id, 'cohort_id' => $c_id]) }}"--}}
{{--                                                                                   class="btn btn-sm btn-outline-primary">View</a>--}}
{{--                                                                            @else--}}
{{--                                                                                <span--}}
{{--                                                                                    class="text-muted small">N/A</span>--}}
{{--                                                                            @endif--}}
{{--                                                                        </td>--}}
{{--                                                                    </tr>--}}
{{--                                                                @endforeach--}}
{{--                                                                </tbody>--}}
{{--                                                            </table>--}}
{{--                                                        </td>--}}


{{--                                                        <td>--}}
{{--                                                            @foreach($submissions->first()->cohort->course->exams as $exam)--}}

{{--                                                                @if(isset($exam->examResults->first()->status))--}}
{{--                                                                    <div class="exam-section">--}}
{{--                                                                        <p>--}}
{{--                                                                            <small>{{ trim($exam->name) }}</small>--}}
{{--                                                                            @switch($exam->examResults->first()->status)--}}
{{--                                                                                @case('Passed')--}}
{{--                                                                                    <span class="badge badge-success">Passed</span>--}}
{{--                                                                                    @break--}}

{{--                                                                                @case('Failed')--}}
{{--                                                                                    <span class="badge badge-danger">Failed</span>--}}
{{--                                                                                    @break--}}

{{--                                                                                @default--}}
{{--                                                                                    <span class="badge badge-warning">In Progress</span>--}}
{{--                                                                            @endswitch--}}
{{--                                                                        </p>--}}
{{--                                                                    </div>--}}
{{--                                                                @else--}}
{{--                                                                    <div class="exam-section">--}}
{{--                                                                        <form--}}
{{--                                                                            action="{{ route('backend.exam-results.store') }}"--}}
{{--                                                                            method="POST">--}}
{{--                                                                            @csrf--}}

{{--                                                                            <p>--}}
{{--                                                                                <small>{{ trim($exam->name) }}</small>--}}
{{--                                                                                <br>--}}
{{--                                                                            </p>--}}

{{--                                                                            <input type="hidden" name="exam_id"--}}
{{--                                                                                   value="{{ $exam->id }}">--}}
{{--                                                                            <input type="hidden" name="cohort_id"--}}
{{--                                                                                   value="{{ $submissions->first()->cohort->id }}">--}}
{{--                                                                            <input type="hidden" name="learner_id"--}}
{{--                                                                                   value="{{ $learnerId }}">--}}

{{--                                                                            <div class="d-flex">--}}
{{--                                                                                <h6 class="mx-2">Pass Rate <span--}}
{{--                                                                                        class="badge badge-success">{{$exam->pass_rate}}</span>--}}
{{--                                                                                </h6>--}}
{{--                                                                                <h6 class="mx-2">Min Score <span--}}
{{--                                                                                        class="badge badge-success">{{$exam->min_score}}</span>--}}
{{--                                                                                </h6>--}}
{{--                                                                                <h6 class="mx-2">Max Score <span--}}
{{--                                                                                        class="badge badge-success">{{$exam->max_score}}</span>--}}
{{--                                                                                </h6>--}}
{{--                                                                            </div>--}}

{{--                                                                            <div class="examBtn mt-2">--}}
{{--                                                                                <select name="status"--}}
{{--                                                                                        class="form-control d-inline"--}}
{{--                                                                                        style="width: auto;">--}}
{{--                                                                                    <option value="Passed"> Passed--}}
{{--                                                                                    </option>--}}
{{--                                                                                    <option value="Failed">Failed--}}
{{--                                                                                    </option>--}}
{{--                                                                                </select>--}}
{{--                                                                                <button type="submit"--}}
{{--                                                                                        class="btn btn-primary btn-sm">--}}
{{--                                                                                    Submit--}}
{{--                                                                                </button>--}}
{{--                                                                            </div>--}}
{{--                                                                        </form>--}}
{{--                                                                        <hr class="my-2">--}}
{{--                                                                    </div>--}}
{{--                                                                @endif--}}
{{--                                                            @endforeach--}}

{{--                                                        </td>--}}


{{--                                                        <td>--}}
{{--                                                            <a href="{{ route('backend.admin.self.study.details',$submissions->first()->id) }}" class="btn btn-sm btn-primary">--}}
{{--                                                                <i class="fas fa-eye mr-2"></i>View</a>--}}
{{--                                                        </td>--}}
{{--                                                    </tr>--}}
{{--                                                @endforeach--}}
{{--                                            @endforeach--}}
                                            </tbody>
                                        </table>

                                            {{ $cohorts->links() }}


                                    </div>
                                @else
                                    <p class="text-center">No records found.</p>
                                @endif
                            </div>




                            {{-- </form>--}}
                            <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')

    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


    <script src="{{ asset('js/main.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#selectAll').on('click', function () {
                $('input[name="submissions[]"]').prop('checked', this.checked);
            });


            $('.select2').select2({
                placeholder: "Select Course", // Changed to match your select
                allowClear: true,
                theme: "bootstrap-5",
                width: '100%'
            });

            $('#learner').select2({
                placeholder: "Select Learner",
                allowClear: true,
                theme: "bootstrap-5",
                width: '100%'
            });

        });
    </script>

@endpush
