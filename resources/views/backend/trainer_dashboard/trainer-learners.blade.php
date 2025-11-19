@php
    use App\Libraries\ScormApiService;
    use Illuminate\Support\Str;
@endphp
@extends('layouts.main')

@section('title', 'My Learners')

@section('breadcump')
    <div class="col-sm-6">
        <div class="taskHeading d-flex">
            <i class="fa fa-users mr-3"></i>
            <h4 class="m-0">My Learners</h4>
        </div>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('backend.dashboard.index') }}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item active">{{ __('Dashboard') }}</li>
        </ol>
    </div>
@endsection

@push('css')
    <link href="{{ asset('css/adminltev3.css') }}" rel="stylesheet" />
    <link href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet" />
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet" />

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet" />

    <style>
        .card-body.table-responsive::-webkit-scrollbar-track {
            background: #e5e5e5 !important;
            border-radius: 10px;
        }

        .card-body.table-responsive::-webkit-scrollbar-thumb {
            background: #343a40 !important;
            border-radius: 10px;
        }

        .card-body.table-responsive::-webkit-scrollbar {
            width: 10px;
        }

        .scroll-row {
            overflow-x: auto;
            display: block;
            white-space: nowrap;
        }

        .scroll-row td {
            display: inline-block;
            min-width: 120px;
            /* Adjust as needed */
            border: 1px solid #ccc;
            padding: 8px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        @media (min-width: 768px) {
            .scroll-row td {
                display: table-cell;
                min-width: auto;
            }

            .scroll-row {
                display: table-row;
                overflow-x: unset;
                white-space: normal;
            }
        }

        .otstaskData #accordion .card-header {
            background: #e5e5e5;
        }

        .otstaskData #accordion .card-header h5,
        .otstaskData #accordion .card-header button {
            color: #000 !important;
        }

        .examBox {
            height: 100%;
            box-shadow: #00000026 0px 0px 10px 0px;
            padding: 10px 10px;
            border-radius: 10px;
        }

        .examBox h5 {
            font-size: 16px;
            font-weight: 600;
        }

        .examBox form {
            display: flex;
            flex-wrap: wrap;
        }

        .examBox form button {
            width: 100%;
        }

        .examBox form input,
        .examBox form select {
            flex: 1;
            margin: 3px;
        }

        .examBox form input::placeholder {
            font-size: 13px;
        }

        .examBox p {
            font-size: 14px;
        }

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
            list-style-type: none;
            /* Remove default bullets */
            padding: 0;
            margin: 0;
        }

        .task-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            /* Add a border */
            border-radius: 5px;
            background-color: #f9f9f9;
            /* Optional: background color */
        }

        .task-box {
            flex: 1;
            padding: 10px;
            border-right: 1px solid #ddd;
            background-color: #f0f8ff;
            /* Light blue background */
            border-radius: 5px 0 0 5px;
            /* Rounded corners on the left */
        }

        .status-box {
            /* padding: 10px; */

            border-radius: 0 5px 5px 0;
            /* Rounded corners on the right */
            width: 150px;
            /* Set a fixed width for the status box */
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
            list-style-type: none;
            /* Remove default bullets */
            padding: 0;
            margin: 0;
        }

        .exam-item {
            margin-bottom: 10px;
            /* Space between items */
        }

        .exam-box {
            padding: 10px;
            background-color: #f0f8ff;
            /* Light blue background */
            border: 1px solid #ccc;
            /* Border */
            border-radius: 5px;
            /* Rounded corners */
            text-align: center;
            /* Center text */
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
            /* Optional: subtle shadow for depth */
        }

        .otstaskData .bgHeadings h2 {
            font-size: 21px;
        }

        .tabsWrapper {
            box-shadow: #00000040 0px 0px 10px 0px;
            padding: 20px;
            margin: 0px 10px;
            border-radius: 10px;
        }

        .tabsWrapper {
            box-shadow: #00000040 0px 0px 10px 0px;
            padding: 20px;
            margin: 0px 10px;
            border-radius: 10px;
        }

        .tabsWrapper ul li.nav-item button {
            background: transparent;
            border: solid 1px;
            margin: 0px 3px;
        }

        .tabsWrapper ul li.nav-item button.active {
            background: #343a40;
            color: #fff;
        }

        .tabsWrapper ul {
            border: none;
        }

        #accordion .card.active .card-header {
            background: #007bfe;
        }

        #accordion .card.active .card-header button {
            color: #fff !important;
        }

        #accordion .card.active .card-header h5:after {
            content: '';
            font-family: "Font Awesome 5 Free";
            font-weight: 600;
            color: #fff;
        }

        #accordion .card .card-header h5:after {
            content: '';
            font-family: "Font Awesome 5 Free";
            font-weight: 600;
        }

        #accordion .card .card-header h5 {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
    </style>
@endpush

@section('main')
    <div class="content">
        <!-- My Courses -->
        <div class="row">
            <div class="col-md-12 col-12 mb-4">
                <div class="filter-section mb-4">
                    <form action="{{ route('backend.trainer.my.learners') }}" method="GET">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="learner">Learner</label>
                                    <select name="learner" id="learner" class="form-control select2">
                                        <option value="">Select Learner</option>
                                        @foreach ($learners as $learner)
                                            <option value="{{ $learner->id }}"
                                                {{ request('learner') == $learner->id ? 'selected' : '' }}>
                                                {{ $learner->name }} {{ $learner->middle_name }} {{ $learner->last_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="course">Course</label>
                                    <select name="course" id="course" class="form-control">
                                        <option value="">Select Course</option>
                                        @foreach ($submitted_courses as $course)
                                            <option value="{{ $course->id }}"
                                                {{ request('course') == $course->id ? 'selected' : '' }}>
                                                {{ $course->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="cohort">Cohort</label>
                                    <select name="cohort" id="cohort" class="form-control">
                                        <option value="">Select Cohort</option>
                                        @foreach ($submitted_cohorts as $cohort)
                                            <option value="{{ $cohort->id }}"
                                                {{ request('cohort') == $cohort->id ? 'selected' : '' }}>
                                                {{ $cohort->course->name ?? '' }}
                                                ({{ \Carbon\Carbon::parse($cohort->start_date_time)->format('d M Y') }}
                                                - {{ \Carbon\Carbon::parse($cohort->end_date_time)->format('d M Y') }})
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
                                            <option value="{{ $venue->id }}"
                                                {{ request('venue') == $venue->id ? 'selected' : '' }}>
                                                {{ $venue->venue_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary mt-4">Filter</button>
                                    <!-- Reset Button -->
                                    <a href="{{ route('backend.trainer.my.learners') }}"
                                        class="btn btn-secondary mt-4">Reset</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-12 col-12 mb-4">
                <div class="">
                    <div class="otsTaskInner">
                        <div class="otstaskData card-body table-responsive p-0" id="trainerMyLearners">
                            <div class="card-body px-0">
                                <div id="accordion">
                                    @php
                                        $count = 0;
                                    @endphp
                                    @php
                                        $index = 0;
                                    @endphp
                                    @php
                                        // Check if any filters are applied
                                        $hasFilters = request()->filled('learner') || request()->filled('course') ||
                                                     request()->filled('cohort') || request()->filled('venue');
                                    @endphp
                                    @foreach ($groupedSubmissions as $cohortData)
                                        @if(!$hasFilters && $index >= 5)
                                            @continue
                                        @endif
                                        @php
                                            $count++;
                                        @endphp
                                        @php
                                            $index++;
                                        @endphp
                                        <div class="card @if ($count == 1) active @endif">
                                            <div class="card-header" id="heading{{ $count }}">
                                                <h5 class="mb-0">
                                                    <button class="btn btn-link" data-toggle="collapse"
                                                        data-target="#collapse{{ $count }}" aria-expanded="true"
                                                        aria-controls="collapse{{ $count }}">
                                                        <span class="text-grey"> Cohort Details: </span>
                                                        <strong>{{ $cohortData['cohort']['course_name'] }}
                                                            ,
                                                            {{ \Carbon\Carbon::parse($cohortData['cohort']['start_date'])->format('d M Y') }}
                                                            -
                                                            {{ \Carbon\Carbon::parse($cohortData['cohort']['end_date'])->format('d M Y') }}</strong>,
                                                        {{ $cohortData['cohort']['venue'] ?? '' }}
                                                    </button>
                                                </h5>
                                            </div>

                                            <div id="collapse{{ $count }}"
                                                class="collapse @if ($count == 1) show @endif"
                                                aria-labelledby="heading{{ $count }}" data-parent="#accordion">
                                                <div class="card-body">

                                                    @foreach ($cohortData['learners'] as $learner)
                                                        <div class="tabsWrapper mb-4">
                                                            <ul class="nav nav-tabs" id="myTab{{ $index }}"
                                                                role="tablist">
                                                                <li class="nav-item" role="presentation">
                                                                    <button class="nav-link active"
                                                                        id="learner-tab-{{ $index }}{{ $learner['id'] }}"
                                                                        data-toggle="tab"
                                                                        data-target="#learner-{{ $index }}{{ $learner['id'] }}"
                                                                        type="button" role="tab"
                                                                        aria-controls="learner-{{ $index }}{{ $learner['id'] }}"
                                                                        aria-selected="true">
                                                                        Learner Detail
                                                                    </button>
                                                                </li>
                                                                <li class="nav-item" role="presentation">
                                                                    <button class="nav-link"
                                                                        id="client-tab-{{ $index }}{{ $learner['id'] }}"
                                                                        data-toggle="tab"
                                                                        data-target="#client-{{ $index }}{{ $learner['id'] }}"
                                                                        type="button" role="tab"
                                                                        aria-controls="client-{{ $index }}{{ $learner['id'] }}"
                                                                        aria-selected="false">
                                                                        Corporate Client
                                                                    </button>
                                                                </li>
                                                                <li class="nav-item" role="presentation">
                                                                    <button class="nav-link"
                                                                        id="tasks-tab-{{ $index }}{{ $learner['id'] }}"
                                                                        data-toggle="tab"
                                                                        data-target="#tasks-{{ $index }}{{ $learner['id'] }}"
                                                                        type="button" role="tab"
                                                                        aria-controls="tasks-{{ $index }}{{ $learner['id'] }}"
                                                                        aria-selected="false">
                                                                        Self-Study
                                                                    </button>
                                                                </li>
                                                                <li class="nav-item" role="presentation">
                                                                    <button class="nav-link"
                                                                        id="exams-tab-{{ $index }}{{ $learner['id'] }}"
                                                                        data-toggle="tab"
                                                                        data-target="#exams-{{ $index }}{{ $learner['id'] }}"
                                                                        type="button" role="tab"
                                                                        aria-controls="exams-{{ $index }}{{ $learner['id'] }}"
                                                                        aria-selected="false">
                                                                        Exams
                                                                    </button>
                                                                </li>
                                                            </ul>
                                                            <div class="tab-content"
                                                                id="myTabContent{{ $index }}{{ $learner['id'] }}">
                                                                <div class="tab-pane fade show active"
                                                                    id="learner-{{ $index }}{{ $learner['id'] }}" role="tabpanel"
                                                                    aria-labelledby="learner-tab-{{ $index }}{{ $learner['id'] }}">
                                                                    <p
                                                                        class="userName h5 bg-dark px-4 py-2 border-rounded my-3">
                                                                        <small><strong>Learner Name:
                                                                                {{ $learner['learner_name'] }}</strong></small>
                                                                    </p>
                                                                    <div class="userImg">
                                                                        @if (!empty($learner['profile_photo']) && $learner['profile_photo_status'] === 'Approved')
                                                                            <img src="{{ asset($learner['profile_photo']) }}"
                                                                                style="width:200px; height:160px;object-fit:cover;"
                                                                                alt="User Image">
                                                                        @else
                                                                            <img src="{{ asset('images/placeholderimage.jpg') }}"
                                                                                style="width:150px; height:auto;"
                                                                                alt="Placeholder Image">
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="tab-pane fade"id="client-{{ $index }}{{ $learner['id'] }}" role="tabpanel"
                                                                    aria-labelledby="client-tab-{{ $index }}{{ $learner['id'] }}">
                                                                    <p class="my-3">
                                                                        {{ $learner['learner_client'] ? $learner['learner_client'] : 'No Corporate Client Found!' }}
                                                                    </p>
                                                                </div>
                                                                <div class="tab-pane fade" id="tasks-{{ $index }}{{ $learner['id'] }}"
                                                                    role="tabpanel"
                                                                    aria-labelledby="tasks-tab-{{ $index }}{{ $learner['id'] }}">
                                                                    <p
                                                                        class="userName h5 bg-dark px-4 py-2 border-rounded my-3">
                                                                        <small><strong>Learner Name:
                                                                                {{ $learner['learner_name'] }}</strong></small>
                                                                    </p>
                                                                    <div class="card-body table-responsive p-0"
                                                                        style="height: 300px;">
                                                                        <table class="table table-head-fixed text-nowrap">
                                                                            <thead class="thead-inverse">

                                                                                @foreach ($learner['submitted_tasks'] as $tasks)
                                                                                    <tr>
                                                                                        <td>
                                                                                            <a href="javascript:0"
                                                                                                class="text-dark">
                                                                                                {{ $tasks['name'] }}
                                                                                            </a>
                                                                                        </td>
                                                                                        <td>
                                                                                            @if ($tasks['status'] == 'In Progress')
                                                                                                <a target="_blank"
                                                                                                    href="{{ route('backend.trainer.viewSubmission', ['user_id' => $tasks['user_id'], 'task_id' => $tasks['task_id'], 'cohort_id' => $tasks['cohort_id']]) }}"
                                                                                                    class="btn-sm btn-primary">
                                                                                                    View
                                                                                                </a>
                                                                                            @endif
                                                                                        </td>
                                                                                        <td>
                                                                                            <strong>Trainer Previous Response:</strong><br>
                                                                                            @php
                                                                                                $trainerResponse = json_decode($tasks['trainer_response'], true);
                                                                                            @endphp

                                                                                            @if($trainerResponse)
                                                                                                <table class="table table-bordered table-sm">
                                                                                                    <thead>
                                                                                                    <tr>
                                                                                                        <th>Question</th>
                                                                                                        <th>Answer</th>
                                                                                                        <th>Feedback</th>
                                                                                                        <th>Grade</th>
                                                                                                    </tr>
                                                                                                    </thead>
                                                                                                    <tbody>
                                                                                                    @foreach($trainerResponse as $key => $response)
                                                                                                        @if($key !== 'total' && $response['answer'] !== 'correct')
                                                                                                            <tr>
                                                                                                                <td>{{ $key }}</td>
                                                                                                                <td>{{ $response['answer'] }}</td>
                                                                                                                <td>{{ $response['feedback'] ?? 'N/A' }}</td>
                                                                                                                <td>{{ $response['grade'] ?? 'N/A' }}</td>
                                                                                                            </tr>
                                                                                                        @endif
                                                                                                    @endforeach
                                                                                                    </tbody>
                                                                                                </table>
                                                                                            @else
                                                                                                <p>No trainer response found.</p>
                                                                                            @endif
                                                                                        </td>

                                                                                        <td>
                                                                                            {{--@if ($tasks['status'] == 'In Progress')--}}
                                                                                                <a target="_blank"
                                                                                                    href="{{ asset($tasks['pdf']) }}"
                                                                                                    class="badge badge-primary">
                                                                                                    <i
                                                                                                        class="fas fa-eye mr-1"></i>
                                                                                                    {{ $tasks['name'] }}
                                                                                                </a>
                                                                                           {{-- @endif--}}
                                                                                        </td>
                                                                                        <td>
                                                                                            <div class="status-box">
                                                                                                @switch($tasks['status'])
                                                                                                    @case('Approved')
                                                                                                        <span
                                                                                                            class="badge badge-success">Approved</span>
                                                                                                    @break

                                                                                                    @case('Rejected')
                                                                                                        <span
                                                                                                            class="badge badge-danger">Rejected</span>
                                                                                                    @break

                                                                                                    @case('Not Submitted')
                                                                                                        <span
                                                                                                            class="badge badge-secondary">Not
                                                                                                            Submitted</span>
                                                                                                    @break

                                                                                                    @default
                                                                                                        <span
                                                                                                            class="badge badge-warning">In
                                                                                                            Progress</span>
                                                                                                @endswitch
                                                                                            </div>
                                                                                        </td>
                                                                                    </tr>
                                                                                @endforeach
                                                                                </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                                <div class="tab-pane fade" id="exams-{{ $index }}{{ $learner['id'] }}"
                                                                    role="tabpanel"
                                                                    aria-labelledby="exams-tab-{{ $index }}{{ $learner['id'] }}">
                                                                    <p
                                                                        class="userName h5 bg-dark px-4 py-2 border-rounded my-3">
                                                                        <small><strong>Learner Name:
                                                                                {{ $learner['learner_name'] }}</strong></small>
                                                                    </p>
                                                                    <div class="d-flex justify-content-between flex-wrap">
                                                                        @foreach ($learner['exams'] as $exam)
                                                                            @if($exam['type'] == "Practical")
                                                                            <div class="col-12 col-md-3 mb-3">
                                                                                <div class="examBox">
                                                                                    {{-- Exam Name --}}
                                                                                    <h5>{{ $exam['name'] ?? 'Unnamed Exam' }}
                                                                                    </h5>

                                                                                    {{-- Exam Type and Score Info --}}
                                                                                    @if (isset($exam['type']))
                                                                                        <p>
                                                                                            <strong>Type:</strong>
                                                                                            {{ $exam['type'] }}<br>
                                                                                            <strong>Min:</strong>
                                                                                            {{ $exam['min_score'] ?? 'N/A' }}
                                                                                            /
                                                                                            <strong>Max:</strong>
                                                                                            {{ $exam['max_score'] ?? 'N/A' }}<br>
                                                                                            <strong>Pass Rate:</strong>
                                                                                            {{ $exam['pass_rate'] ?? 'N/A' }}
                                                                                        </p>
                                                                                    @endif

                                                                                    {{-- Result Display / Form --}}
                                                                                    @php
                                                                                        $examResult = \App\Models\ExamResult::where(
                                                                                            'learner_id',
                                                                                            $learner['id'],
                                                                                        )
                                                                                            ->where(
                                                                                                'exam_id',
                                                                                                $exam['id'],
                                                                                            )
                                                                                            ->where(
                                                                                                'cohort_id',
                                                                                                $cohortData['cohort'][
                                                                                                    'id'
                                                                                                ],
                                                                                            )
                                                                                            ->first();
                                                                                    @endphp

                                                                                    @if ($examResult)
                                                                                        <p>
                                                                                            <span
                                                                                                class="badge {{ $examResult->status === 'Passed' ? 'badge-success' : 'badge-danger' }}">
                                                                                                {{ $examResult->status }}
                                                                                                @if ($examResult->score)
                                                                                                    - Score:
                                                                                                    {{ $examResult->score }}
                                                                                                @endif
                                                                                            </span>
                                                                                        </p>
                                                                                    @else

                                                                                        @if (auth()->user()->hasRole('Trainer') && ($exam['type'] ?? null) === 'Practical')

                                                                                            <form class="examResultForm">
                                                                                                @csrf
                                                                                                <input type="hidden" name="exam_id" value="{{ $exam['id'] ?? '' }}">
                                                                                                <input type="hidden" name="learner_id" value="{{ $learner['id'] }}">
                                                                                                <input type="hidden" name="cohort_id" value="{{ $cohortData['cohort']['id'] }}">

                                                                                                <input type="text" class="form-control mb-1" name="score" placeholder="Enter marks">
                                                                                                <select class="form-control mb-1" name="status">
                                                                                                    <option value="">Select</option>
                                                                                                    <option value="Passed">Passed</option>
                                                                                                    <option value="Failed">Failed</option>
                                                                                                </select>
                                                                                                <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                                                                                            </form>

                                                                                            <div class="exam-result-message mt-2"></div>

{{--                                                                                            <form--}}
{{--                                                                                                action="{{ route('backend.exam-results.store') }}"--}}
{{--                                                                                                method="POST">--}}
{{--                                                                                                @csrf--}}
{{--                                                                                                <input type="hidden"--}}
{{--                                                                                                    name="exam_id"--}}
{{--                                                                                                    value="{{ $exam['id'] ?? '' }}">--}}
{{--                                                                                                <input type="hidden"--}}
{{--                                                                                                    name="learner_id"--}}
{{--                                                                                                    value="{{ $learner['id'] }}">--}}
{{--                                                                                                <input type="hidden"--}}
{{--                                                                                                    name="cohort_id"--}}
{{--                                                                                                    value="{{ $cohortData['cohort']['id'] }}">--}}

{{--                                                                                                <input type="text"--}}
{{--                                                                                                    class="form-control mb-1"--}}
{{--                                                                                                    name="score"--}}
{{--                                                                                                    placeholder="Enter marks">--}}
{{--                                                                                                <select--}}
{{--                                                                                                    class="form-control mb-1"--}}
{{--                                                                                                    name="status">--}}
{{--                                                                                                    <option value="">--}}
{{--                                                                                                        Select--}}
{{--                                                                                                    </option>--}}
{{--                                                                                                    <option value="Passed">--}}
{{--                                                                                                        Passed--}}
{{--                                                                                                    </option>--}}
{{--                                                                                                    <option value="Failed">--}}
{{--                                                                                                        Failed--}}
{{--                                                                                                    </option>--}}
{{--                                                                                                </select>--}}
{{--                                                                                                <button type="submit"--}}
{{--                                                                                                    class="btn btn-primary btn-sm">Submit</button>--}}
{{--                                                                                            </form>--}}
                                                                                        @else
                                                                                            <span class="text-muted">Result
                                                                                                not
                                                                                                available.</span>
                                                                                        @endif
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                            @endif
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#selectAll').on('click', function() {
                $('input[name="submissions[]"]').prop('checked', this.checked);
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#accordion .card').on('click', function() {
                $('#accordion .card').removeClass('active');
                $(this).addClass('active');
            });
        });

        $('.select2').select2({
            placeholder: "Please Select", // Changed to match your select
            allowClear: true,
            theme: "bootstrap-5",
        });




        $(document).ready(function () {
            $('.examResultForm').on('submit', function (e) {
                e.preventDefault(); // Stop default form submission

                let $form = $(this);
                let formData = $form.serialize();
                let messageBox = $form.next('.exam-result-message');

                $.ajax({
                    url: "{{ route('backend.exam-results.store') }}",
                    type: "POST",
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        messageBox.html(
                            `<div class="alert alert-success">Exam result updated successfully.</div>`
                        );
                    },
                    error: function (xhr) {
                        let errors = xhr.responseJSON.errors;
                        let errorHtml = '<div class="alert alert-danger"><ul>';
                        $.each(errors, function (key, value) {
                            errorHtml += `<li>${value}</li>`;
                        });
                        errorHtml += '</ul></div>';
                        messageBox.html(errorHtml);
                    }
                });
            });
        });




    </script>
@endpush
