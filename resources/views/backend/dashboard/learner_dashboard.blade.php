@php
    use App\Libraries\ScormApiService;
    use App\Models\ProfilePhoto;
    use Carbon\Carbon;
@endphp

@extends('layouts.main')

@section('title', 'Learner Dashboard')

@section('breadcump')
    <div class="col-sm-6">
        <h1 class="m-0">{{ __('Dashboard') }}</h1>
    </div>
    <div class="col-sm-6">
        {{-- Centered content below heading --}}
        <div class="text-center mt-3">
            <div class="embed-responsive embed-responsive-16by9" style="max-width: 600px; margin: 0 auto;">
                <iframe class="embed-responsive-item"
                        src="https://www.youtube.com/embed/OdeS4h8hhhw"
                        allowfullscreen></iframe>
            </div>
        </div>
    </div>

@endsection
@push('css')
    <link href="{{ asset('css/adminltev3.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lity/2.4.1/lity.css"
          integrity="sha512-NDcw4w5Uk5nra1mdgmYYbghnm2azNRbxeI63fd3Zw72aYzFYdBGgODILLl1tHZezbC8Kep/Ep/civILr5nd1Qw=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>

    <link rel="stylesheet" href="{{ asset('css/dflip.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/themify-icons.min.css') }}">
    <style>
        @media (min-width: 768px) {
            .col1.text-light {
                width: 100%;
                margin: 10px;
            }

            .col2 {
                width: 100%;
                margin: 10px;
            }

            .col3 {
                width: 100%;
                margin: 10px;
            }


        }

        @media (min-width: 576px) {
            .col1.text-light {
                width: 100%;
                margin: 10px;
            }

            .col2 {
                width: 100%;
                margin: 10px;
            }

            .col3 {
                width: 100%;
                margin: 10px;
            }

        }

        span.numFs {
            font-size: 35px;
        }

        #flipbook {
            width: 800px;
            height: 600px;
            margin: auto;
        }

        .page {
            background: #fff;
            width: 100%;
            height: 100%;
        }

        #tasksTabs #custom-tabs-one-tab {
            border: none !important;
            /*justify-content: center;*/
        }

        #tasksTabs #custom-tabs-one-tab li.nav-item a.nav-link {
            border: none !important;
            background: #343a40;
            margin: 0px 5px;
            /* box-shadow: #0000007d 0px 0px 10px 0px; */
            color: #fff;
            font-weight: bold;
            padding: 6px 30px;
            border-radius: 12px 12px 0px 0px;
        }

        #tasksTabs .card-header {
            border: none;
            background: #343a40;
        }

        #tasksTabs #custom-tabs-one-tab li.nav-item a.nav-link.active {
            background: #fff;
            color: #000;
        }

        #tasksTabs .card-header {
            margin-bottom: 30px;
            width: 100%;
            border: none;
        }

        ul#myTab {
            margin-bottom: 30px !important;
        }

        ul#myTab li button {
            background: transparent;
            border: solid 1px #000;
            border-radius: 0;
            margin: 0px 2px;
        }

        ul#myTab li button.active {
            background: #343a40;
            color: #fff;
            position: relative;
        }

        .table-responsive.elearning tr td span {
            font-size: 20px;
            margin-bottom: 20px !important;
            display: block;
        }

        .table-responsive.myUlpoads {
            background: #fff;
            padding: 50px 100px;
            border-radius: 30px;
            border: solid 1px #cccc;
            margin-bottom: 50px;
        }

        .table-responsive.elearning {
            background: #fff;
            padding: 50px 100px;
            border-radius: 30px;
            border: solid 1px #cccc;
        }

        .table-responsive.elearning tr {
            border: none !important;
        }

        .table-responsive.elearning tr:hover {
            background: transparent;
        }

        .table-responsive.elearning tr img {
            height: 200px;
            width: 100%;
            object-fit: cover;
        }

        .table-responsive.elearning tr {
            border: solid 1px #ccc !important;
            margin-bottom: 30px !important;
            display: block;
            border-radius: 10px;
        }

        .table-responsive.elearning tr td {
            border: none;
            display: block;
        }

        .nav-tabs .nav-link {
            padding: 1rem 1.5rem;
            /* Increase padding */
            font-size: 1.25rem;
            /* Increase font size */
            border-radius: 0.5rem;
            /* Optionally adjust border radius */
        }

        .nav-tabs .nav-link.active {
            font-weight: bold;
            /* Optionally make the active tab bold */
        }

        ul#myTab li button.active:before {
            position: absolute;
            content: '';
            font-size: 31px;
            background: #343a40;
            clip-path: polygon(100% 0, 41% 100%, 0 0);
            width: 33px;
            height: 20px;
            bottom: -17px;
            left: 0;
            right: 0;
            margin: auto;
        }

        .coursesBox {
            border: solid 1px #cccc;
            padding: 15px;
            border-radius: 15px;
        }

        button#profile-tab {
            position: relative;
        }

        button#learner_dashboard {
            position: relative;
        }

        .col1.text-light {
            width: 20%;
            margin: 10px;
        }

        .col2 {
            width: 35%;
            margin: 10px;
        }

        .col3 {
            width: 25%;
            margin: 10px;
        }

        .progressChart {
            border: solid 1px #dddddd;
            margin-top: 37px;
        }

        .act-card-title {
            font-size: 1.25rem;
            font-weight: 600;
        }

        .act-step-number {
            font-size: 1.5rem;
            font-weight: bold;
            color: #007bff;
        }

        .act-card {
            margin-bottom: 10px;
            border: 1px solid #ddd;
        }

        .act-btn-awareness {
            background-color: #007bff;
            color: white;
        }

        .act-btn-security {
            background-color: #a05b17;
            color: white;
        }

        .act-col {
            border: solid 1px #666762;
            border-radius: 10px;
            padding: 20px;
        }

        .act-col .act-card {
            border: solid 1px #18a2b8;
            border-radius: 10px;
        }

        .act-col .act-card:hover {
            background: #18a2b8;
        }

        .act-col .act-card .act-step-number {
            color: #18a2b8;
        }

        .act-col .act-card p {
            color: #666762;
        }

        .act-col .act-card:hover .act-step-number,
        .act-col .act-card:hover p, .act-col .act-card:hover p a {
            color: #ffff;
        }
    </style>
    <script src="https://www.gstatic.com/charts/loader.js"></script>
@endpush
@section('main')

    <div class="row">
        <ul class="nav nav-tabs nav-fill flex-column flex-sm-row" id="myTab" role="tablist">
            <li class="nav-item mb-2">
                <button class="nav-link active" id="learner_dashboard" data-toggle="tab"
                        data-target="#learner-dashboard"
                        type="button" role="tab" aria-controls="learner-dashboard" aria-selected="true">
                    {{ __('Learner Dashboard') }}
                </button>
            </li>

            <li class="nav-item mb-2">
                <button class="nav-link" id="profile-tab" data-toggle="tab" data-target="#my_progress" type="button"
                        role="tab" aria-controls="profile" aria-selected="false">
                    {{ __('My Progress') }}
                </button>
            </li>

            <li class="nav-item mb-2">
                <button class="nav-link" id="my-results" data-toggle="tab" data-target="#my_results" type="button"
                        role="tab" aria-controls="results" aria-selected="false">
                    {{ __('My Results') }}
                </button>
            </li>

        </ul>
        <br>
        <div class="tab-content w-100" id="myTabContent">
            <!------------------------------ LEARNER DASHBOARD ------------------------------>
            <div class="tab-pane fade show active w-100" id="learner-dashboard" role="tabpanel"
                 aria-labelledby="learner_dashboard">

                <div class="row mt-3">
                    <div class="col text-light">
                        <div class="coursesBox bg-dark h-100 shadow-lg">
                            <div class="coursesBoxHeader d-flex align-items-center justify-content-between">
                                <h4>My Courses</h4>
                                <div class="icon-and-number">
                                    <i class="fas fa-graduation-cap"></i>
                                </div>
                            </div>
                            <div class="coursesBoxFooter d-flex align-items-end justify-content-between">
                                <div class="boxFooterInfo">
                                    <h4>{{ $totalCourses ?? '' }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="coursesBox bg-success text-white h-100 shadow-lg">
                            <div class="coursesBoxHeader d-flex align-items-center justify-content-between">
                                <h4>My Certificates</h4>
                                <div class="icon-and-number">
                                    <i class="fas fa-certificate"></i>
                                </div>
                            </div>
                            <div class="coursesBoxFooter d-flex align-items-end justify-content-between">
                                <div class="boxFooterInfo">
                                    <h4>{{ $uploadedCertificates ?? '' }} </h4>
                                    <p class="text-white">{{ $pendingCertificates ?? '' }} pending</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="coursesBox bg-danger text-white h-100 shadow-lg">
                            <div class="coursesBoxHeader d-flex align-items-center justify-content-between">
                                <h4>My Messages</h4>
                                <div class="icon-and-number">
                                    <i class="fas fa-envelope"></i>
                                </div>
                            </div>
                            <div class="coursesBoxFooter d-flex align-items-end justify-content-between">
                                <div class="boxFooterInfo">
                                    <h4>{{ $unreadCount ?? '' }} unread</h4>
                                    <p class="text-white">{{ $readCount ?? '' }} read messages</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="coursesBox bg-primary text-white h-100 shadow-lg">
                            <div class="coursesBoxHeader d-flex align-items-center justify-content-between">
                                <h4>Outstanding Balance</h4>
                                <div class="icon-and-number">
                                    <i class="fas fa-pound-sign"></i>
                                </div>
                            </div>
                            <div class="coursesBoxFooter d-flex align-items-end justify-content-between">
                                <div class="boxFooterInfo">
                                    <h4><b>£ 0.00</b></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-md-12 col-12">
                        <h2>Outstanding Self-Study</h2>
                        <div class="otsTaskInner">
                            <div class="otstaskData">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Deadline</th>
                                        <th>Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($dashboardData as $data)
                                        <!-- Row for Task Type -->
                                        @if ($data['course']['name'])
                                            <tr>
                                                <td colspan="9">
                                                    <div class="bgHeadings">
                                                        <h2 class="callout callout-success">
                                                            {{ $data['course']['name'] }}

                                                            <a href="javascript:;" class="badgeCst ml-4">
                                                                {{ isset($data['start_date_time']) ? \Carbon\Carbon::parse($data['start_date_time'])->format('d F, Y, h:i A') : 'N/A' }}
                                                            </a> -
                                                            <a href="javascript:;" class="badgeCst">
                                                                {{ isset($data['end_date_time']) ? \Carbon\Carbon::parse($data['end_date_time'])->format('d F, Y, h:i A') : 'N/A' }}
                                                            </a>
                                                        </h2>
                                                    </div>
                                                </td>
                                            </tr>

                                            @php
                                                $flipbook = [
                                                    'DS Distance Learning Booklet',
                                                    'CCTV Distance Learning Booklet',
                                                    'DS Top-Up Textbook',
                                                    'SG Top-Up Textbook',
                                                    'DS Refresher Coursebook',
                                                    'Security Guard Course book',
                                                ];

                                                // Filter tasks to exclude "Reminders" and the specific flipbook tasks
                                                $nonReminders = $data['course']['tasks']->filter(function (
                                                    $task,
                                                ) use ($flipbook) {
                                                    return $task['type'] != 'Reminders' &&
                                                        !in_array($task['name'], $flipbook);
                                                });
                                            @endphp

                                            @forelse($nonReminders as $task)
                                                <tr>
                                                    <td>{{ $task['name'] ?? '' }}</td>
                                                    <td>{{ isset($data['end_date_time']) ? \Carbon\Carbon::parse($data['end_date_time'])->format('d F, Y, h:i A') : 'N/A' }}
                                                    </td>
                                                    <td>
                                                        @if ($task['type'] == 'Reminders')
                                                        @else
                                                            @switch($task['status'] ?? "")
                                                                @case('Approved')
                                                                    <span class="badge bg-success">Approved</span>
                                                                    @break

                                                                @case('Rejected')
                                                                    @if ($task['name'] == 'English Assessment')
                                                                        <span class="badge bg-danger">Failed</span>
                                                                    @else
                                                                        <span class="badge bg-danger">Rejected</span>
                                                                    @endif
                                                                    @break

                                                                @case('In Progress')
                                                                    <span class="badge bg-warning">In Progress</span>
                                                                    @break

                                                                @default
                                                                    <span class="badge bg-danger">Not Submitted</span>
                                                            @endswitch
                                                        @endif
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="4">No self-study assigned to this
                                                        course.
                                                    </td>
                                                </tr>
                                            @endforelse
                                        @else
                                            <tr>
                                                <td colspan="6">No course assigned to this
                                                    cohort.
                                                </td>
                                            </tr>
                                        @endif
                                    @empty
                                        <p>No cohorts assigned.</p>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
            <!------------------------------ MY PROGRESS ------------------------------>
            <div class="tab-pane fade w-100" id="my_progress" role="tabpanel" aria-labelledby="profile-tab">

                <div class="row">
                    <div class="col-12 col-md-4 mb-3 mb-md-0">
                        <div class="coursesBox bg-dark h-100">
                            <div class="coursesBoxHeader d-flex align-items-center justify-content-between">
                                <h4>All Self-Study</h4>
                                <span class="numFs"><b>{{ $totalTasks ?? '' }}</b></span>
                            </div>
                            <div class="coursesBoxFooter d-flex align-items-end justify-content-between">
                                <div class="boxFooterInfo">
                                    <h4>My Self-Study</h4>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-4 mb-3 mb-md-0">
                        <div class="coursesBox bg-success text-white h-100">
                            <div class="coursesBoxHeader d-flex align-items-center justify-content-between">
                                <h4>Complete Activities</h4>
                                <span class="numFs"><b>{{ $totalCompletedTasks ?? '' }}</b></span>
                            </div>
                            <div class="coursesBoxFooter d-flex align-items-end justify-content-between">
                                <div class="boxFooterInfo">
                                    <h4>All activities that have been completed</h4>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-4 mb-3 mb-md-0">
                        <div class="coursesBox bg-danger text-white h-100">
                            <div class="coursesBoxHeader d-flex align-items-center justify-content-between">
                                <h4>Incomplete Activities</h4>
                                <span class="numFs"><b>{{ $totalIncompleteTasks ?? '' }}</b></span>
                            </div>
                            <div class="coursesBoxFooter d-flex align-items-end justify-content-between">
                                <div class="boxFooterInfo">
                                    <h4>Activities that need to be completed</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-12">
                        <div id="tasksTabs">
                            <div class="card-header p-0 pt-1">
                                <ul class="nav nav-tabs nav-fill flex-column flex-sm-row" id="custom-tabs-one-tab"
                                    role="tablist">

                                    <li class="nav-item">
                                        <a class="nav-link active" id="custom-tabs-one-profile-tab" data-toggle="pill"
                                           href="#custom-tabs-one-profile" role="tab"
                                           aria-controls="custom-tabs-one-profile" aria-selected="false">Self-Study</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" id="custom-tabs-one-home-tab" data-toggle="pill"
                                           href="#custom-tabs-one-home" role="tab"
                                           aria-controls="custom-tabs-one-home" aria-selected="true">Resources</a>
                                    </li>

                                    <br>
                                </ul>
                            </div>
                            @php
                                // Define the task-specific messages
                                $taskMessages = [
                                    'Proof of ID' => [
                                        'Not Submitted' =>
                                            'Proof of ID is required. Please upload your document to proceed.',
                                        'In Progress' =>
                                            'Your ID proof has been submitted. We are verifying your document.',
                                        'Approved' =>
                                            'Your ID proof has been successfully verified. Thank you!',
                                        'Rejected' =>
                                            'Your ID proof was rejected. Please ensure it meets the required guidelines and try again.',
                                    ],
                                    'English Assessment' => [
                                        'Not Submitted' =>
                                            'The Initial English Assessment is ready for you. Complete it to demonstrate your skills.',
                                        'In Progress' =>
                                            'Your Initial English Assessment is being reviewed and marked by your instructor.',
                                        'Approved' =>
                                            "Congratulations! You've finished and passed the English Assessment. Well done!",
                                        'Rejected' =>
                                            'Your Initial English Assessment results were not successful. Please review the feedback and retake the assessment.',
                                    ],
                                    'PI Health Questioner' => [
                                        'Not Submitted' =>
                                            'The PI Health Questionnaire is waiting for your input. Complete it to proceed.',
                                        'In Progress' =>
                                            "You've completed the PI Health Questionnaire. Almost there! Your answers are being reviewed by your instructor.",
                                        'Approved' => 'You\'ve finished PI Health Questionnaire. Well done!',
                                        'Rejected' =>
                                            'Your PI Health Questionnaire needs additional information. Please review the feedback and complete it again.',
                                    ],
                                    'DS Activity Sheet' => [
                                        'Not Submitted' =>
                                            'The DS Activity Sheet is ready. Before you start, remember to spend at least 8 hours reading the DS Distance Learning Booklet.',
                                        'In Progress' =>
                                            'Well Done! Your submission will be reviewed by your trainer/instructor.',
                                        'Approved' => 'DS Activity Sheet completed. Great job!',
                                        'Rejected' =>
                                            'Your DS Activity Sheet was not approved. Please ensure you have spent the required 8 hours on the DS Distance Learning Booklet, review the feedback, and make necessary corrections.',
                                    ],
                                    'CCTV Activity Sheet' => [
                                        'Not Submitted' =>
                                            'The CCTV Activity Sheet is ready. Before you start, remember to spend at least 8 hours reading the CCTV Distance Learning Booklet.',
                                        'In Progress' =>
                                            'Well Done! Your submission will be reviewed by your trainer/instructor.',
                                        'Approved' => 'CCTV Activity Sheet completed. Great job!',
                                        'Rejected' =>
                                            'Your CCTV Activity Sheet was not approved. Please ensure you have spent the required 8 hours on the CCTV Distance Learning Booklet, review the feedback, and make necessary corrections.',
                                    ],
                                    'DS Top-Up Workbook' => [
                                        'Not Submitted' =>
                                            'The DS Top-Up Workbook is available. Start now to complete this required task.',
                                        'In Progress' =>
                                            'Well Done! Your submission will be reviewed by your trainer/instructor.',
                                        'Approved' =>
                                            'DS Top-Up Workbook completed. You\'ve made great progress!',
                                        'Rejected' =>
                                            'Your DS Top-Up Workbook was not approved. Please review the feedback and make necessary revisions.',
                                    ],
                                    'SG Top-Up Workbook' => [
                                        'Not Submitted' =>
                                            'The SG Top-Up Workbook is available. Start now to complete this required task.',
                                        'In Progress' =>
                                            'Well Done! Your submission will be reviewed by your trainer/instructor.',
                                        'Approved' =>
                                            'SG Top-Up Workbook completed. You\'ve made great progress!',
                                        'Rejected' =>
                                            'Your SG Top-Up Workbook was not approved. Please review the feedback and make necessary revisions.',
                                    ],
                                    'PI Techniques Questionnaire' => [
                                        'Not Submitted' =>
                                            'The Techniques Questionnaire is waiting for you. Complete it to proceed.',
                                        'In Progress' =>
                                            'Well done! Your Techniques Questionnaire will be reviewed by your instructor.',
                                        'Approved' => 'Techniques Questionnaire completed. Thank you!',
                                        'Rejected' =>
                                            'Your Techniques Questionnaire needs attention. Please review the feedback and complete it again.',
                                    ],
                                    'DS Top-Up Textbook' => [
                                        'Not Submitted' =>
                                            'The DS Top-Up Textbook is available for reading. Review it to proceed.',
                                        'In Progress' =>
                                            'You\'re currently reading the DS Top-Up Textbook. Your understanding will be assessed via DS Top-Up Workbook and reviewed by your trainer/instructor.',
                                        'Approved' => 'You\'ve completed the DS Top-Up Textbook. Great job!',
                                        'Rejected' => 'Keep reading.',
                                    ],
                                    'SG Top-Up Textbook' => [
                                        'Not Submitted' =>
                                            'The SG Top-Up Textbook is available for reading. Review it to proceed.',
                                        'In Progress' =>
                                            'You\'re currently reading the SG Top-Up Textbook. Your understanding will be assessed via SG Top-Up Workbook and reviewed by your trainer/instructor.',
                                        'Approved' => 'You\'ve completed the SG Top-Up Textbook. Great job!',
                                        'Rejected' => 'Keep reading.',
                                    ],
                                    'DS Distance Learning Booklet' => [
                                        'Not Submitted' =>
                                            'The DS Distance Learning Booklet is available. Begin reading it when you\'re ready. Required reading time approximately 8 hours.',
                                        'In Progress' =>
                                            'You\'re making progress on the DS Distance Learning Booklet. Your comprehension will be reviewed by your trainer/instructor.',
                                        'Approved' =>
                                            'You\'ve finished reading the DS Distance Learning Booklet. Excellent! Now you can complete the DS Activity Sheet.',
                                        'Rejected' => 'Keep reading.',
                                    ],
                                    'CCTV Distance Learning Booklet' => [
                                        'Not Submitted' =>
                                            'The CCTV Distance Learning Booklet is ready for reading. Begin reading it when you\'re ready. Required reading time approximately 8 hours.',
                                        'In Progress' =>
                                            'You\'re currently reading the CCTV Distance Learning Booklet. Your comprehension will be reviewed by your trainer/instructor.',
                                        'Approved' =>
                                            'CCTV Distance Learning Booklet reading completed. Nice work! Now you can complete the CCTV Activity Sheet.',
                                        'Rejected' => 'Keep reading.',
                                    ],
                                ];
                            @endphp
                            <div class="card-body">
                                <div class="tab-content" id="custom-tabs-one-tabContent">
                                    <div class="tab-pane fade" id="custom-tabs-one-home" role="tabpanel"
                                         aria-labelledby="custom-tabs-one-home-tab">


                                        <h3 class="text-center font-weight-bold mb-3 bg-dark p-3 rounded border-bottom">
                                            Resources</h3>
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                <tr>
                                                    <th width="30%">Resources</th>
                                                    <th width="20%">Type</th>
                                                    <th width="10%">Action</th>
                                                    <th width="40%">Description</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @forelse($tasks as $task)
                                                    <tr>
                                                        <td>{{ $task->name }}</td>
                                                        <td>Flip Book</td>
                                                        <td>
                                                            <a target="_blank"
                                                               href="{{ route('backend.flipbook.view', ['task' => $task->id]) }}"
                                                               class="btn btn-primary btn-sm">
                                                                <i class="fas fa-eye"></i>
                                                                View
                                                            </a>
                                                        </td>
                                                        <td>
                                                            @switch($task->name)
                                                                @case('DS Top-Up Textbook')
                                                                    Self-study textbook designed for
                                                                    individuals pursuing the Highfield
                                                                    Level
                                                                    2 Award for Door Supervisors in the
                                                                    Private Security Industry. It
                                                                    focuses on
                                                                    the principles of using equipment
                                                                    relevant to door supervisors.
                                                                    @break

                                                                @case('SG Top-Up Textbook')
                                                                    This textbook supports learners
                                                                    preparing for the Highfield Level 2
                                                                    Award for Security Officers in the
                                                                    Private Security Industry (Top-Up),
                                                                    focusing on minimizing personal risk
                                                                    for
                                                                    security officers.
                                                                    @break

                                                                @case('DS Distance Learning Booklet')
                                                                    This Distance Learning Booklet
                                                                    supports
                                                                    learners preparing for the Highfield
                                                                    Level 2 Award for Door Supervisors
                                                                    in
                                                                    the Private Security Industry. It
                                                                    focuses on Module 1: Principles of
                                                                    Working in the Private Security
                                                                    Industry.
                                                                    @break

                                                                @case('CCTV Distance Learning Booklet')
                                                                    This Distance Learning Booklet
                                                                    supports
                                                                    learners preparing for the Highfield
                                                                    Level 2 Award for CCTV Operators in
                                                                    the
                                                                    Private Security Industry. It
                                                                    focuses on
                                                                    Module 1: Principles of Working in
                                                                    the
                                                                    Private Security Industry.
                                                                    @break

                                                                @default
                                                                    No description available.
                                                            @endswitch
                                                        </td>
                                                    </tr>
                                                @empty
                                                    {{--                                                                            <tr> --}}
                                                    {{--                                                                                <td colspan="4">No resources found.</td> --}}
                                                    {{--                                                                            </tr> --}}
                                                @endforelse

                                                @forelse($resources as $resource)
                                                    <tr>
                                                        <td>{{ $resource->name }}</td>
                                                        <td>Flip Book</td>
                                                        <td>
                                                            <a target="_blank"
                                                               href="{{ route('backend.flipbook.resource.view', $resource->id) }}"
                                                               class="btn btn-primary btn-sm">
                                                                <i class="fas fa-eye"></i>
                                                                View
                                                            </a>
                                                        </td>
                                                        <td>

                                                        </td>
                                                    </tr>
                                                @empty
                                                    {{--                                                                        <tr> --}}
                                                    {{--                                                                            <td colspan="4">No resources found.</td> --}}
                                                    {{--                                                                        </tr> --}}
                                                @endforelse


                                                </tbody>
                                            </table>
                                        </div>


                                    </div>

                                    <div class="tab-pane fade active show" id="custom-tabs-one-profile" role="tabpanel"
                                         aria-labelledby="custom-tabs-one-profile-tab">


                                        <h3 class="text-center font-weight-bold mb-3 bg-dark p-3 rounded border-bottom">
                                            My Tasks
                                        </h3>
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                <tr>
                                                    <th width="30%">Task</th>
                                                    <th width="10%">Action</th>
                                                    <th width="20%">Trainer Response</th>
                                                    <th width="10%">Status</th>
                                                    <th width="30%">Progress Information</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @forelse($dashboardData as $data)

                                                    {{-- @if ($data['course']['name'] && $canAccessTasks) --}}
                                                    @if ($data['course']['name'])
                                                        <tr>
                                                            <td colspan="9">
                                                                <h2 class="callout callout-success">
                                                                    #{{ $data['cohort_id'] }} -
                                                                    {{ $data['course']['name'] }}
                                                                    <a href="javascript:;" class="badgeCst ml-4">
                                                                        {{ isset($data['start_date_time']) ? \Carbon\Carbon::parse($data['start_date_time'])->format('d F, Y, h:i A') : 'N/A' }}
                                                                    </a>
                                                                    <span class="dashedMinus">-</span>
                                                                    <a href="javascript:;" class="badgeCst">
                                                                        {{ isset($data['end_date_time']) ? \Carbon\Carbon::parse($data['end_date_time'])->format('d F, Y, h:i A') : 'N/A' }}
                                                                    </a>
                                                                </h2>
                                                            </td>
                                                        </tr>
                                                        @php
                                                            $flipbook = [
                                                                'DS Distance Learning Booklet',
                                                                'CCTV Distance Learning Booklet',
                                                                'DS Top-Up Textbook',
                                                                'SG Top-Up Textbook',
                                                                'DS Refresher Coursebook',
                                                                'Security Guard Course book',
                                                            ];

                                                            $nonReminders = $data['course'][
                                                                'tasks'
                                                            ]->filter(function ($task) use ($flipbook) {
                                                                return $task['type'] != 'Reminders' &&
                                                                    !in_array($task['name'], $flipbook);
                                                            });

                                                            $reminders = $data['course']['tasks']->filter(
                                                                function ($task) {
                                                                    return $task['type'] == 'Reminders';
                                                                },
                                                            );
                                                        @endphp

                                                        @forelse($nonReminders as $task)
                                                            <tr>
                                                                <td>{{ $task['name'] ?? '' }}</td>
                                                                <td>



                                                                    @if ($task['type'] == 'CourseWork' || $task['name'] == 'Course Evaluation Form')
                                                                        @php

                                                                            $flipbook = [
                                                                                'DS Distance Learning Booklet',
                                                                                'CCTV Distance Learning Booklet',
                                                                                'DS Top-Up Textbook',
                                                                                'SG Top-Up Textbook',
                                                                                'DS Refresher Coursebook',
                                                                                'Security Guard Course book',
                                                                            ];

                                                                            $endDate = Carbon::parse($data['end_date_time'])->timezone('Europe/London');
                                                                            $now = Carbon::now('Europe/London');
                                                                        @endphp

                                                                        {{-- ✅ Flipbook --}}
                                                                        @if (in_array($task['name'], $flipbook))
                                                                            <a href="{{ route('backend.flipbook.view', ['task' => $task['id']]) }}" class="btn btn-primary btn-sm">
                                                                                <i class="fas fa-eye"></i>&nbsp;&nbsp;View
                                                                            </a>
                                                                        @else
                                                                            {{-- ✅ Normal / Conditional Tasks --}}
                                                                            @if ($task['status'] == 'Not Submitted' || $task['status'] == 'Rejected')
                                                                                @php
                                                                                    $showTask = true;

                                                                                    // ✅ Special rule for PI Techniques Questionnaire



                                                                                    if (
                                                                                        in_array($data['course']['id'], [1, 2]) && // Only these courses
                                                                                        $task['id'] == 7 &&                        // Task ID 7
                                                                                        $task['name'] == 'PI Techniques Questionnaire'
                                                                                    ) {
                                                                                        $startDate = Carbon::parse($data['start_date_time'])->timezone('Europe/London');
                                                                                        $endDate   = Carbon::parse($data['end_date_time'])->timezone('Europe/London');

                                                                                        // Check if this is a weekend course
                                                                                        $isWeekendCourse = isset($data['is_weekend']) && $data['is_weekend'] == 1;


                                                                                        if ($isWeekendCourse) {

                                                                                            // 🔸 Weekend course: show on 2nd-last weekend day
                                                                                            $weekendDates = [];
                                                                                            $date = $startDate->copy();
                                                                                            while ($date->lte($endDate)) {
                                                                                                if ($date->isSaturday() || $date->isSunday()) {
                                                                                                    $weekendDates[] = $date->copy();
                                                                                                }
                                                                                                $date->addDay();
                                                                                            }
                                                                                            $secondLastDate = count($weekendDates) > 1 ? $weekendDates[count($weekendDates) - 2] : null;
                                                                                            $showTask = $secondLastDate && $now->greaterThanOrEqualTo($secondLastDate);

                                                                                        } else {
                                                                                            // 🔸 Normal course: show on 2nd-last course day
                                                                                            $courseDays = [];
                                                                                            $date = $startDate->copy();
                                                                                            while ($date->lte($endDate)) {
                                                                                                $courseDays[] = $date->copy();
                                                                                                $date->addDay();
                                                                                            }
                                                                                            $secondLastDate = count($courseDays) > 1 ? $courseDays[count($courseDays) - 2] : null;
                                                                                            $showTask = $secondLastDate && $now->greaterThanOrEqualTo($secondLastDate);

                                                                                        }
                                                                                    }
                                                                                @endphp

                                                                                @if ($showTask)
                                                                                    {{-- ✅ Course Evaluation Form (after course ends) --}}
                                                                                    @if ($task['name'] === 'Course Evaluation Form')
                                                                                        @if ($now->toDateString() >= $endDate->toDateString())
                                                                                            <a href="{{ route('backend.tasks.show', [
                                                                                                    'id' => $task['id'],
                                                                                                    'course_id' => $data['course']['id'],
                                                                                                    'cohort_id' => $data['cohort_id'],
                                                                                                    'trainer_id' => $data['course']['trainer_id'],
                                                                                                ]) }}" class="btn btn-primary btn-sm">
                                                                                                <i class="fas fa-eye"></i> View
                                                                                            </a>
                                                                                        @endif
                                                                                    @else
                                                                                        {{-- ✅ All Other Tasks --}}
                                                                                        <a href="{{ route('backend.tasks.show', [
                                                                                                    'id' => $task['id'],
                                                                                                    'course_id' => $data['course']['id'],
                                                                                                    'cohort_id' => $data['cohort_id'],
                                                                                                    'trainer_id' => $data['course']['trainer_id'],
                                                                                                ]) }}" class="btn btn-primary btn-sm">
                                                                                            <i class="fas fa-eye"></i> View
                                                                                        </a>
                                                                                    @endif
                                                                                @endif
                                                                            @endif
                                                                        @endif
                                                                    @endif
                                                                </td>



                                                                <td>
                                                                    @if ($task['status'] == 'Rejected' || $task['status'] == 'Approved')
                                                                        <a href="{{ route('backend.view.task.submission', [
                                                                                        'submission' => $task['submission_id'],
                                                                                    ]) }}"
                                                                           class="btn btn-primary btn-sm">
                                                                            <i class="fas fa-eye"></i>&nbsp;&nbsp;
                                                                            View
                                                                        </a>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if (in_array($task['name'], $flipbook))
                                                                    @else
                                                                        @if ($task['type'] == 'Reminders')
                                                                        @else
                                                                            @switch($task['status'] ?? "")
                                                                                @case('Approved')
                                                                                    <span
                                                                                        class="badge bg-success">Approved</span>
                                                                                    @break

                                                                                @case('Rejected')
                                                                                    @if ($task['name'] == 'English Assessment')
                                                                                        <span
                                                                                            class="badge bg-danger">Failed</span>
                                                                                    @else
                                                                                        <span
                                                                                            class="badge bg-danger">Rejected</span>
                                                                                    @endif
                                                                                    @break

                                                                                @case('In Progress')
                                                                                    <span class="badge bg-warning">In
                                                                                                    Progress</span>
                                                                                    @break

                                                                                @default
                                                                                    <span class="badge bg-danger">Not
                                                                                                    Submitted</span>
                                                                            @endswitch
                                                                        @endif
                                                                    @endif


                                                                    {{--                                                                        <a href="{{ asset() }}"--}}
                                                                    {{--                                                                           class="btn btn-primary btn-sm">--}}
                                                                    {{--                                                                            <i class="fas fa-eye"></i>&nbsp;&nbsp;--}}
                                                                    {{--                                                                            View--}}
                                                                    {{--                                                                        </a>--}}


                                                                </td>
                                                                <td>
                                                                    @if ($task['type'] == 'Reminders')
                                                                    @else
                                                                        @php
                                                                            $taskName = $task['name']; // Assume $task->name contains the task name, e.g., "Application Form"
                                                                            $taskStatus = $task['status']; // Assume $task->pivot->status contains the status
                                                                            if (
                                                                                isset(
                                                                                    $taskMessages[
                                                                                        $taskName
                                                                                    ][$taskStatus],
                                                                                )
                                                                            ) {
                                                                                $message =
                                                                                    $taskMessages[
                                                                                        $taskName
                                                                                    ][$taskStatus];
                                                                            } else {
                                                                                $message =
                                                                                    'No message available.';
                                                                            }
                                                                        @endphp
                                                                        <small>{{ $message }}</small>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        @empty
                                                            <tr>
                                                                <td colspan="4">No tasks assigned to
                                                                    this
                                                                    course.
                                                                </td>
                                                            </tr>
                                                        @endforelse
                                                    @else
                                                        <tr>
                                                            <td colspan="6"></td>
                                                        </tr>
                                                    @endif
                                                @empty
                                                    <p>No cohorts assigned.</p>
                                                @endforelse
                                                </tbody>
                                            </table>
                                        </div>


                                        <h3 class="text-center font-weight-bold mb-3 bg-dark p-3 rounded border-bottom">
                                            E-Learning
                                        </h3>
                                        <div class="row">
                                            @forelse($dashboardData as $data)
                                                @php //echo '<pre>';  print_r($data); @endphp
                                                    <!-- Row for Task Type -->
                                                @if ($data['course']['name'])
                                                    <div class="col-12">
                                                        <h2 class="callout callout-success">
                                                            {{ $data['course']['name'] }}
                                                            <a href="javascript:;" class="badgeCst ml-4">
                                                                {{ isset($data['start_date_time']) ? \Carbon\Carbon::parse($data['start_date_time'])->format('d F, Y, h:i A') : 'N/A' }}
                                                            </a>
                                                            ,
                                                            <a href="javascript:;" class="badgeCst">
                                                                {{ isset($data['end_date_time']) ? \Carbon\Carbon::parse($data['end_date_time'])->format('d F, Y, h:i A') : 'N/A' }}
                                                            </a>
                                                        </h2>
                                                    </div>
                                                    @forelse($data['course']['licenses'] as $license)
                                                        @php

                                                            $name = $license['name'] ?? '';
                                                            $licenseId = $license['id'] ?? '';
                                                            $scorm_course_link =
                                                                $license['scorm_course_link'] ?? '';
                                                            $scorm_registration_id =
                                                                $license['scorm_registration_id'] ?? '';
                                                        @endphp
                                                        <div class="col-12 col-md-6 col-lg-4 mb-4">
                                                            <div class="card h-100">


                                                                <div class="card-body d-flex flex-column">
                                                                    <h5 class="card-title">{{ $name }}</h5>
                                                                    <a href="javascript:void(0);" target="_blank">
                                                                        <img src="{{ asset('images/course.jpg') }}"
                                                                             class="img-fluid mb-3" alt="">
                                                                    </a>

                                                                    @php
                                                                        // SCORM work only in production environment
                                                                        $scormApiService = new ScormApiService();
                                                                        //if (app()->isProduction()) {
                                                                        $course_info = $scormApiService->getRegistrationDetails(
                                                                            $scorm_registration_id,
                                                                        );
                                                                        //}
                                                                    @endphp
                                                                    @if (isset($course_info))

                                                                        {{--                                                                        <a href="{{ $scorm_course_link }}"--}}
                                                                        {{--                                                                           target="_blank"--}}
                                                                        {{--                                                                           class="btn btn-info">--}}
                                                                        {{--                                                                            Launch {{ $name }}--}}
                                                                        {{--                                                                        </a>--}}

                                                                        <a href="javascript:void(0);"
                                                                           class="btn btn-info launch-course"
                                                                           data-registration="{{ $scorm_registration_id }}"
                                                                           data-name="{{ $name }}">
                                                                            Launch {{ $name }}
                                                                        </a>


                                                                        @php

                                                                            $activityDetails =
                                                                                $course_info[
                                                                                    'activityDetails'
                                                                                ];
                                                                            $title =
                                                                                $activityDetails[
                                                                                    'title'
                                                                                ] ?? 'N/A';
                                                                            $attempts =
                                                                                $activityDetails[
                                                                                    'attempts'
                                                                                ] ?? 'N/A';
                                                                            $activity_completion =
                                                                                $activityDetails[
                                                                                    'activityCompletion'
                                                                                ] ?? 'N/A';

                                                                            $totalSecondsTracked =
                                                                                $course_info[
                                                                                    'totalSecondsTracked'
                                                                                ] ?? 0;
                                                                            $hours = floor(
                                                                                $totalSecondsTracked /
                                                                                    3600,
                                                                            );
                                                                            $minutes = floor(
                                                                                ($totalSecondsTracked /
                                                                                    60) %
                                                                                    60,
                                                                            );
                                                                            $seconds =
                                                                                $totalSecondsTracked %
                                                                                60;
                                                                        @endphp
                                                                        <p class="mt-3">
                                                                            <strong>Title:</strong> {{ $title }}
                                                                            <br>
                                                                            <strong>Attempts:</strong> {{ $attempts }}
                                                                            <br>
                                                                            <strong>Completion
                                                                                Status:</strong> {{ $activity_completion }}
                                                                            <br>

                                                                            <br>
                                                                            <strong>Total Time
                                                                                Tracked:</strong> {{ $hours }}
                                                                            hours, {{ $minutes }}
                                                                            minutes, {{ $seconds }}
                                                                            seconds<br>
                                                                        </p>

                                                                        @if ($name == 'ACT Awareness' || $name == 'ACT Security')
                                                                            @if ($license['act_document'] == null)
                                                                                <hr>

                                                                                <p class="text-muted">If you have
                                                                                    already completed the ACT from
                                                                                    another institution or location, you
                                                                                    can upload here.</p>

                                                                                <div class="form-group">
                                                                                    <label for="fileUpload"
                                                                                           class="btn btn-primary">Upload
                                                                                        File</label>
                                                                                    <input type="file" id="fileUpload"
                                                                                           class="d-none"
                                                                                           data-license-id="{{ $licenseId ?? '' }}"
                                                                                           data-learner-id="{{ $learner['id'] }}"
                                                                                           data-cohort-id="{{ $data['cohort_id'] ?? '' }}"
                                                                                           data-submission-id="{{ $license['task_submission_id']  }}">
                                                                                </div>
                                                                                <div id="uploadStatus" class="mt-2">
                                                                                </div>
                                                                                <!-- Status Messages -->
                                                                            @else
                                                                                <a href="{{ asset($license['act_document']) }}"
                                                                                   target="_blank"
                                                                                   class="btn btn-primary">View</a>
                                                                            @endif
                                                                        @endif

                                                                    @else

                                                                        <!-- Naveed make 2 boxes here -->
                                                                        @if($name == "ACT Awareness")
                                                                            <div class="act-col mx-2 mt-2">

                                                                                <div class="act-card p-3">
                                                                                    <div class="act-step-number">1.
                                                                                        Upload ACT Awareness Certificate
                                                                                    </div>
                                                                                    <p>To Complete the ACT Awareness
                                                                                        e-learning module please visit
                                                                                        <a href="https://ct.protectuk.police.uk/?mode=startindividual_act">https://ct.protectuk.police.uk/?mode=startindividual_act</a>
                                                                                        .</p>
                                                                                </div>

                                                                                <div class="act-card p-3">
                                                                                    <div class="act-step-number">2.
                                                                                        Register or Log In
                                                                                    </div>
                                                                                    <p>If you already have an account,
                                                                                        click on Log In and enter your
                                                                                        credentials. If you are new to
                                                                                        the platform, click on Register
                                                                                        or Create an Account to set up
                                                                                        your profile. You will need to
                                                                                        provide a valid email address
                                                                                        and create a password.</p>
                                                                                </div>

                                                                                <div class="act-card p-3">
                                                                                    <div class="act-step-number">3.
                                                                                        Enrol and Complete Module
                                                                                    </div>
                                                                                    <p>Select “ACT Awareness” from the
                                                                                        list and click on Enrol or Start
                                                                                        Course. Work through each
                                                                                        section of the course, ensuring
                                                                                        you complete all required
                                                                                        modules. Some modules may
                                                                                        include quizzes or assessments
                                                                                        that must be completed to
                                                                                        progress.</p>
                                                                                </div>

                                                                                <div class="act-card p-3">
                                                                                    <div class="act-step-number">4.
                                                                                        Download Certificate
                                                                                    </div>
                                                                                    <p>Once you've completed the
                                                                                        activity, look for the “Download
                                                                                        Certificate” button located at
                                                                                        the top right corner of the
                                                                                        screen.
                                                                                        Click on the button.
                                                                                        Enter your name and surname when
                                                                                        prompted.
                                                                                        Download the certificate to your
                                                                                        device.</p>
                                                                                </div>


                                                                                @if ($license['act_document'] == null)
                                                                                    <hr>
                                                                                    <div class="act-card p-3">
                                                                                        <div class="act-step-number">5.
                                                                                            Submit Your Certificate
                                                                                        </div>
                                                                                        <p>Use the button below to
                                                                                            upload and submit your
                                                                                            certificate to us:</p>

                                                                                        <div class="form-group mt-3">
                                                                                            <label for="fileUpload"
                                                                                                   class="btn w-100 act-btn-awareness">Upload
                                                                                                ACT Awareness
                                                                                                Certificate</label>
                                                                                            <input type="file"
                                                                                                   id="fileUpload"
                                                                                                   class="d-none"
                                                                                                   data-submission-id="{{ $license['task_submission_id']  }}">
                                                                                        </div>
                                                                                        <div id="uploadStatus"
                                                                                             class="mt-2"></div>
                                                                                    </div>
                                                                                @else
                                                                                    <a href="{{ asset($license['act_document']) }}"
                                                                                       target="_blank"
                                                                                       class="btn btn-primary">View
                                                                                        Uploaded Certificate</a>

                                                                                    <a href="javascript:;"
                                                                                       class="btn btn-danger remove_cert"
                                                                                       data-submission-id="{{ $license['task_submission_id']  }}"
                                                                                       onclick="return confirm('Are you sure you want to remove this certificate?');">
                                                                                        Remove Certificate</a>

                                                                                    <div
                                                                                        class="removeStatus mt-2"></div>

                                                                                @endif
                                                                            </div>

                                                                        @elseif($name == "ACT Security")
                                                                            <div class="act-col mx-2 mt-2">

                                                                                <div class="act-card p-3">
                                                                                    <div class="act-step-number">1.
                                                                                        Upload ACT Security Certificate
                                                                                    </div>
                                                                                    <p>To Complete the ACT Security
                                                                                        e-learning module please visit
                                                                                        <a href="https://www.protectuk.police.uk/group/90?type=catalog">https://www.protectuk.police.uk/group/90?type=catalog</a>
                                                                                        .</p>
                                                                                </div>

                                                                                <div class="act-card p-3">
                                                                                    <div class="act-step-number">2.
                                                                                        Register or Log In
                                                                                    </div>
                                                                                    <p>If you already have an account,
                                                                                        click on Log In and enter your
                                                                                        credentials. If you are new to
                                                                                        the platform, click on Register
                                                                                        or Create an Account to set up
                                                                                        your profile. You will need to
                                                                                        provide a valid email address
                                                                                        and create a password.</p>
                                                                                </div>

                                                                                <div class="act-card p-3">
                                                                                    <div class="act-step-number">3.
                                                                                        Enrol and Complete Module
                                                                                    </div>
                                                                                    <p>Select “ACT Security” from the
                                                                                        list and click on Enrol or Start
                                                                                        Course. Work through each
                                                                                        section of the course, ensuring
                                                                                        you complete all required
                                                                                        modules. Some modules may
                                                                                        include quizzes or assessments
                                                                                        that must be completed to
                                                                                        progress.</p>
                                                                                </div>

                                                                                <div class="act-card p-3">
                                                                                    <div class="act-step-number">4.
                                                                                        Download Certificate
                                                                                    </div>
                                                                                    <p>Once you've completed the
                                                                                        activity, look for the “Download
                                                                                        Certificate” button located at
                                                                                        the top right corner of the
                                                                                        screen.
                                                                                        Click on the button.
                                                                                        Enter your name and surname when
                                                                                        prompted.
                                                                                        Download the certificate to your
                                                                                        device.</p>
                                                                                </div>


                                                                                @if ($license['act_document'] == null)
                                                                                    <hr>
                                                                                    <div class="act-card p-3">
                                                                                        <div class="act-step-number">5.
                                                                                            Submit Your Certificate
                                                                                        </div>
                                                                                        <p>Use the button below to
                                                                                            upload and submit your
                                                                                            certificate to us:</p>

                                                                                        <div class="form-group mt-3">
                                                                                            <label for="fileUpload"
                                                                                                   class="btn w-100 {{ $name == 'ACT Awareness' ? 'act-btn-awareness' : 'act-btn-security' }}">
                                                                                                Upload {{ $name }}
                                                                                                Certificate
                                                                                            </label>
                                                                                            <input type="file"
                                                                                                   id="fileUpload"
                                                                                                   class="d-none"
                                                                                                   data-submission-id="{{ $license['task_submission_id']  }}">
                                                                                        </div>
                                                                                        <div id="uploadStatus"
                                                                                             class="mt-2"></div>
                                                                                    </div>
                                                                                @else
                                                                                    <a href="{{ asset($license['act_document']) }}"
                                                                                       target="_blank"
                                                                                       class="btn btn-primary">View
                                                                                        Uploaded Certificate</a>

                                                                                    <a href="javascript:;"
                                                                                       class="btn btn-danger remove_cert"
                                                                                       data-submission-id="{{ $license['task_submission_id']  }}"
                                                                                       onclick="return confirm('Are you sure you want to remove this certificate?');">
                                                                                        Remove Certificate</a>
                                                                                    <div
                                                                                        class="removeStatus mt-2"></div>

                                                                                @endif
                                                                            </div>
                                                                        @else
                                                                            <p>No course information available.</p>
                                                                        @endif

                                                                    @endif


                                                                </div>

                                                            </div>
                                                        </div>

                                                    @empty
                                                        <div class="col-12">
                                                            <div class="alert alert-info">
                                                                <h5>No licenses assigned to this course.</h5>
                                                            </div>
                                                        </div>
                                                    @endforelse
                                                @else
                                                    <div class="col-12">
                                                        <div class="alert alert-info">
                                                            No course assigned to this cohort.
                                                        </div>
                                                    </div>
                                                @endif
                                            @empty
                                                <div class="col-12">
                                                    <div class="alert alert-info">
                                                        No cohorts assigned.
                                                    </div>
                                                </div>
                                            @endforelse
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="tab-pane fade w-100" id="my_results" role="tabpanel" aria-labelledby="my-results">


                <div class="row my-5 flex-lg-row flex-md-row flex-xl-row flex-column-reverse">
                    <div class="col-md-12 col-lg-12 col-12">
                        <h4><strong>{{ __('My Exam Results') }}</strong></h4>
                        <div class="otsTaskInner">
                            <div class="otstaskData">
                                <table class="otsDataTable table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Course</th>
                                        <th>Exam</th>
                                        <th>Type</th>
                                        <th>Status</th>
                                        <th>Score</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($dashboardData as $data)

                                        @if ($data['course']['name'])

                                            @foreach($data['course']['exam_results'] as $exam)
                                                <tr>
                                                    <td>{{ $data['course']['name'] }}</td> {{-- Course Name --}}
                                                    <td>{{ $exam['exam_name'] }}</td> {{-- Exam --}}
                                                    <td>{{ $exam['type'] }}</td> {{-- Type: MCQ/Practical --}}
                                                    <td>
                                                    <span
                                                        class="badge {{ $exam['status'] === 'Passed' ? 'bg-success' : 'bg-danger' }}">
                                                        {{ $exam['status'] }}
                                                    </span>
                                                    </td>
                                                    <td>{{ $exam['score'] }}</td> {{-- Score --}}
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="5">No results found.</td>
                                            </tr>
                                        @endif
                                    @empty
                                        <p>No cohorts assigned.</p>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row my-5 flex-lg-row flex-md-row flex-xl-row flex-column-reverse">
                    <div class="col-md-8 col-lg-8 col-12">
                        <h4><strong>{{ __('My Courses') }}</strong></h4>
                        <div class="otsTaskInner">
                            <div class="otstaskData">
                                <table class="otsDataTable table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Course</th>
                                        <th>E-learning Certificate</th>
                                        <th>Final Award</th>
                                        {{-- <th width="20%">Order Date</th> --}}
                                        {{-- <th width="20%">Date Enrolled</th> --}}
                                        {{-- <th width="20%">Date Completed</th> --}}
                                        <th>Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($dashboardData as $data)

                                        @php
                                            //echo '<pre>';  print_r($data);
                                        @endphp

                                        @if ($data['course']['name'])
                                            <tr>
                                                <td>
                                                    <p>
                                                        {{ $data['course']['name'] }}
                                                    </p>
                                                    <p class="m-0">
                                                        <strong>Location:</strong><small>
                                                            {{ $data['course']['venue_name'] ?? '' }}</small>
                                                    </p>
                                                    <p class="m-0">
                                                        <strong>Order Date:</strong><small>
                                                            {{ isset($data['start_date_time']) ? \Carbon\Carbon::parse($data['start_date_time'])->format('d F, Y, h:i A') : '' }}</small>
                                                    </p>
                                                    <p class="m-0">
                                                        <strong>Date Enrolled:</strong><small>
                                                            {{ isset($data['course']['date_enrolled']) ? \Carbon\Carbon::parse($data['course']['date_enrolled'])->format('d F, Y, h:i A') : '' }}</small>
                                                    </p>
                                                    <p class="m-0">
                                                        <strong>Date Completed:</strong><small>
                                                            {{ $data['course']['date_completed'] ?? '' }}</small>
                                                    </p>
                                                </td>
                                                <td>


                                                    @if (isset($data['course']['taskSubmissions']))
                                                        @foreach ($data['course']['taskSubmissions'] as $taskSubmissions)
                                                            @if (isset($taskSubmissions['act_document']))
                                                                <p>{{ $taskSubmissions['act_name'] }}</p>
                                                                <p class="m-0 mb-2">
                                                                    <small>
                                                                        <a href="{{ asset($taskSubmissions['act_document']) }}"
                                                                           target="_blank"
                                                                           class="btn btn-primary">View</a>
                                                                    </small>
                                                                </p>
                                                            @endif
                                                        @endforeach
                                                    @endif

                                                    @if ($data['course']['certificate']->isNotEmpty())
                                                        @foreach ($data['course']['certificate'] as $certificate)
                                                            <p>{{ $certificate['license_name'] }}</p>
                                                            <p class="m-0 mb-2">
                                                                <small>
                                                                    <a href="{{ asset('storage/' . $certificate['certificate_path']) }}"
                                                                       target="_blank"
                                                                       class="btn btn-primary">View</a>
                                                                </small>
                                                            </p>
                                                        @endforeach
                                                    @else
                                                        <small>No certificate issued yet</small>
                                                    @endif

                                                </td>
                                                <td>
                                                    @foreach ($data['course']['highfield_certificate'] as $certificate)
                                                        <p class="m-0">
                                                            <small>
                                                                <a href="{{ asset('storage/' . $certificate['file_path']) }}"
                                                                   target="_blank" class="btn btn-primary">View</a>
                                                            </small>
                                                        </p>
                                                    @endforeach
                                                </td>
                                                <td>
                                                    <a href="javascript:;"
                                                       class="badge bg-success">{{ $data['course']['cohort_status'] ?? '' }}</a>
                                                </td>
                                            </tr>
                                        @else
                                            <tr>
                                                <td colspan="6">No course assigned to this
                                                    cohort.
                                                </td>
                                            </tr>
                                        @endif
                                    @empty
                                        <p>No cohorts assigned.</p>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-4 col-12">
                        <div class="progressChart">
                            <div id="myChart"></div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>

@endsection
@push('js')
    <script type="text/javascript" src="{{ asset('js/dflip.min.js') }}"></script>

    <script>
        $('#fileUpload').on('change', function (e) {
            const file = this.files[0];
            const allowedTypes = ['image/png', 'image/jpeg', 'application/pdf'];
            const maxSize = 10 * 1024 * 1024; // 10MB in bytes

            // Validation
            if (!allowedTypes.includes(file.type)) {
                $('#uploadStatus').text('Only PNG, JPEG, and PDF files are allowed.')
                    .addClass('text-danger');
                return;
            }

            if (file.size > maxSize) {
                $('#uploadStatus').text('File size must be 10MB or less.')
                    .addClass('text-danger');
                return;
            }

            // Prepare FormData
            const formData = new FormData();
            formData.append('file', file);
            formData.append('task_submission_id', $(this).data('submission-id'));

            // Send AJAX request
            $.ajax({
                url: '/backend/upload-act-document', // 👈 create this route
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // if using Laravel CSRF
                },
                beforeSend: function () {
                    $('#uploadStatus').removeClass('text-danger text-success').text('Uploading...');
                },
                success: function (response) {
                    $('#uploadStatus').addClass('text-success').text('File uploaded successfully.');
                    // Optionally reset input
                    $('#fileUpload').val('');
                    location.reload();
                },
                error: function (xhr) {
                    $('#uploadStatus').addClass('text-danger').text(
                        'Failed to upload. Please try again.');
                    console.error(xhr.responseText);
                }
            });
        });


        // remove certificate
        $('.remove_cert').on('click', function (e) {

            e.preventDefault();

            // Prepare FormData
            const formData = new FormData();
            formData.append('task_submission_id', $(this).data('submission-id'));

            // Send AJAX request
            $.ajax({
                url: '/backend/remove-act-document', // 👈 create this route
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // if using Laravel CSRF
                },
                beforeSend: function () {
                    $('#uploadStatus').removeClass('text-danger text-success').text('Remove...');
                },
                success: function (response) {
                    $('#removeStatus').addClass('text-success').text('File removed successfully.');
                    location.reload();
                },
                error: function (xhr) {
                    $('#removeStatus').addClass('text-danger').text(
                        'Failed to remove. Please try again.');
                    console.error(xhr.responseText);
                }
            });
        });
    </script>
    <script>
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

            // Set Data
            const data = google.visualization.arrayToDataTable([
                ['Status', 'Count'],
                ['Approved', {{ $totalCompletedTasks ?? 0 }}],
                ['Not Submitted', {{ $totalIncompleteTasks ?? 0 }}],
                ['In Progress', {{ $totalInProgress ?? 0 }}]
            ]);

            // Set Options
            const options = {
                title: 'My Progress',
                is3D: true,
                colors: ['#28a745', '#dc3545', '#ffc107'],
                sliceVisibilityThreshold: 0 // Show slices even if the value is 0
            };

            // Draw
            const chart = new google.visualization.PieChart(document.getElementById('myChart'));
            chart.draw(data, options);

        }


        $(document).ready(function () {
            // Auto-generate certificate if success status is "Completed"
            const autoGenerateDiv = $('.auto-generate-certificate');
            if (autoGenerateDiv.length > 0) {
                generateCertificate(
                    autoGenerateDiv.data('learner-id'),
                    autoGenerateDiv.data('cohort-id'),
                    autoGenerateDiv.data('license-id'),
                    autoGenerateDiv.siblings('.certMsg')
                );
            }

            // Manual generation button click handler
            // $(document).on('click', '.generateCertificate', function(e) {
            //     e.preventDefault();
            //     generateCertificate(
            //         $(this).data('learner-id'),
            //         $(this).data('cohort-id'),
            //         $(this).data('license-id'),
            //         $(this).siblings('.certMsg')
            //     );
            // });
        });

        function generateCertificate(learnerId, cohortId, licenseId, messageDiv) {
            const button = $('.generateCertificate');
            button.text('Generating...').prop('disabled', true);

            // Clear previous messages
            messageDiv.html('');

            $.ajax({
                url: "{{ route('backend.generate.certificate') }}",
                type: 'POST',
                data: {
                    learner_id: learnerId,
                    cohort_id: cohortId,
                    cohort_id: cohortId,
                    license_id: licenseId,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    messageDiv.html('<div class="alert alert-success">' + response.message + '</div>');
                    // location.reload();
                },
                error: function (xhr) {
                    let errorMsg = "Generation failed. Try again.";
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMsg = xhr.responseJSON.message;
                    }
                    messageDiv.html('<div class="alert alert-danger">' + errorMsg + '</div>');
                },
                complete: function () {
                    button.text('Generate Certificate').prop('disabled', false);
                }
            });

        }


        document.addEventListener("DOMContentLoaded", function () {
            document.querySelectorAll(".launch-course").forEach(function (btn) {
                btn.addEventListener("click", function () {
                    let registrationId = btn.getAttribute("data-registration");

                    fetch(`/backend/scorm/launch-link/${registrationId}`)
                        .then(response => response.json())
                        .then(data => {
                            if (data.launchLink) {
                                // Redirect learner to SCORM Cloud player
                                window.open(data.launchLink, "_blank");
                            } else {
                                alert("Failed to generate launch link. Please try again.");
                            }
                        })
                        .catch(err => {
                            console.error(err);
                            alert("Error contacting SCORM service.");
                        });
                });
            });
        });
    </script>
@endpush
