@php use App\Libraries\ScormApiService; @endphp
@extends('layouts.main')

@section('title', 'Dashboard')

@section('breadcump')
    <div class="col-sm-6">
        <h1 class="m-0">{{ __('Dashboard') }}</h1>
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
        #trainerTaskTabs ul#pills-tab {
            background: #444444;
            border-radius: 30px 30px 0px 0px !important;
            padding: 7px 7px 0px 7px;
        }

        #trainerTaskTabs ul#pills-tab li.nav-item button.nav-link.active {
            background: #fff;
            color: #444444;
        }

        #trainerTaskTabs ul#pills-tab li.nav-item button.nav-link {
            border-radius: 30px 30px 0px 0px;
            border: none;
            padding: 10px 50px;
            margin-right: 10px;
            background: transparent;
            color: #fff;
            border: solid 2px;
            border-bottom: none;
        }

        #trainerTaskTabs table.otsDataTable thead tr {
            background: #c0c0c0;
        }

        #trainerTaskTabs table.otsDataTable tbody tr:nth-child(2n) {
            background: #f6f6f6;
        }

        @media (max-width: 1599px) {
            #trainerTaskTabs table.otsDataTable tr th {
                font-size: 14px;
            }
        }
    </style>
@endpush

@section('main')

    <div class="content" id="trainerTaskTabs">
        <!-- My Courses -->
        <div class="row">
            <div class="col-md-12 col-12">
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="E-Learning-tab" data-toggle="pill" data-target="#E-Learning"
                                type="button" role="tab" aria-controls="E-Learning" aria-selected="true">E-Learning
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="Self-Study-tab" data-toggle="pill" data-target="#Self-Study"
                                type="button" role="tab" aria-controls="Self-Study"
                                aria-selected="false">Self-Study
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="Englishassessment-tab" data-toggle="pill"
                                data-target="#Englishassessment"
                                type="button" role="tab" aria-controls="Englishassessment"
                                aria-selected="false">English assessment
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="LessonPlans-tab" data-toggle="pill" data-target="#LessonPlans"
                                type="button" role="tab" aria-controls="LessonPlans"
                                aria-selected="false">Lesson Plans
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="Invoices-tab" data-toggle="pill" data-target="#Invoices"
                                type="button" role="tab" aria-controls="Invoices"
                                aria-selected="false">Invoices
                        </button>
                    </li>
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    <!------------------------------------ E-Learning ------------------------------------>
                    <div class="tab-pane fade show active" id="E-Learning" role="tabpanel"
                         aria-labelledby="E-Learning-tab">
                        <div class="otsTask mt-4 p-4 h-100">
                            <div class="otsTaskInner">
                                <div class="otstaskData">
                                    <div class="card-body">
                                        @if($groupedLicSubmissions->isNotEmpty())
                                            <td class="table-responsive">
                                                <table class="otsDataTable">
                                                    <thead>
                                                    <tr>
                                                        <th>Learner</th>
                                                        <th>Course</th>
                                                        <th>Cohort</th>
                                                        <th>Location</th>
                                                        <th>Status</th>
                                                        <th>E-Learning</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($groupedLicSubmissions as $learnerId => $cohorts)
                                                        @foreach($cohorts as $cohortId => $submissions)

                                                            <tr>
                                                                <td>{{ $submissions->first()->user->name }}</td>
                                                                <!-- Learner's name -->
                                                                <td>{{ $submissions->first()->cohort->course->name }}</td>
                                                                <!-- Course name -->
                                                                <td>{{ $submissions->first()->cohort->start_date_time }}
                                                                    - {{ $submissions->first()->cohort->end_date_time }}</td>

                                                                <td>{{ $submissions->first()->cohort->venue->venue_name ?? ""  }}</td>
                                                                <td>
                                                                    {{ $submissions->first()->status ?? "" }}
                                                                </td>
                                                                <td style="background: #ffdad8"> <!--# dfedd6-->

                                                                    @php
                                                                        // SCORM work only in production environment
                                                                        $scormApiService = new ScormApiService();
                                                                        if(app()->isProduction()){
                                                                            $course_info = $scormApiService->getRegistrationDetails($submissions->first()->scorm_registration_id);
                                                                        }
                                                                    @endphp

                                                                    @if (isset($course_info))
                                                                        @php
                                                                            $activityDetails = $course_info['activityDetails'];
                                                                            $title = $activityDetails['title'] ?? 'N/A';
                                                                            $attempts = $activityDetails['attempts'] ?? 'N/A';
                                                                            $activity_completion = $activityDetails['activityCompletion'] ?? 'N/A';
                                                                            $activity_success = $activityDetails['activitySuccess'] ?? 'N/A';
                                                                            $completionAmount = $activityDetails['completionAmount']['scaled'] ?? 'N/A';

                                                                            $totalSecondsTracked = $course_info['totalSecondsTracked'] ?? 0;
                                                                            $hours = floor($totalSecondsTracked / 3600);
                                                                            $minutes = floor(($totalSecondsTracked / 60) % 60);
                                                                            $seconds = $totalSecondsTracked % 60;
                                                                        @endphp

                                                                        <p class="mt-3">
                                                                            <strong>Title:</strong> {{ $title }}
                                                                            <br>
                                                                            <strong>Attempts:</strong> {{ $attempts }}
                                                                            <br>
                                                                            <strong>Completion
                                                                                Status:</strong> {{ $activity_completion }}
                                                                            <br>
                                                                            <strong>Success
                                                                                Status:</strong> {{ $activity_success }}
                                                                            <br>
                                                                            <strong>Score:</strong> {{ $completionAmount }}
                                                                            <br>
                                                                            <strong>Total Time
                                                                                Tracked:</strong> {{ $hours }}
                                                                            hours, {{ $minutes }}
                                                                            minutes, {{ $seconds }}
                                                                            seconds<br>
                                                                        </p>
                                                                    @else
                                                                        <p>No course information available.</p>
                                                                    @endif
                                                                </td>


                                                            </tr>
                                                        @endforeach
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                    </div>
                                    @else
                                        <p>No E-Learning found.</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <!------------------------------------ Self-Study ------------------------------------>
                    <div class="tab-pane fade" id="Self-Study" role="tabpanel" aria-labelledby="Self-Study-tab">
                        <div class="otsTask mt-4 p-4 h-100">
                            <div class="otsTaskInner">
                                <div class="otstaskData">
                                    <div class="card-body">
                                        @if($groupedSelfSubmissions->isNotEmpty())
                                            <td class="table-responsive">
                                                <table class="otsDataTable">
                                                    <thead>
                                                    <tr>
                                                        <th>Learner</th>
                                                        <th>Course</th>
                                                        <th>Cohort</th>
                                                        <th>Location</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($groupedSelfSubmissions as $learnerId => $cohorts)
                                                        @foreach($cohorts as $cohortId => $submissions)
                                                            <tr>
                                                                <td>{{ $submissions->first()->user->name }}</td>
                                                                <!-- Learner's name -->
                                                                <td>{{ $submissions->first()->cohort->course->name }}</td>
                                                                <!-- Course name -->
                                                                <td>{{ $submissions->first()->cohort->start_date_time }}
                                                                    - {{ $submissions->first()->cohort->end_date_time }}</td>

                                                                <td>{{ $submissions->first()->cohort->venue->venue_name ?? ""  }}</td>


                                                                @foreach($submissions as $submission)

                                                                    @php
                                                                        $u_id = $submission->user_id ?? "";
                                                                        $t_id = $submission->task_id ?? "";
                                                                        $c_id = $submission->cohort_id ?? "";
                                                                    @endphp
                                                                    @if($submission->task_id == 3 || $submission->task_id == 4 || $submission->task_id == 5 || $submission->task_id == 6)
                                                                        <td>
                                                                            {{ ucfirst($submission->status) }}
                                                                        </td>
                                                                        <td>
                                                                            @if($submission->status == "In Progress")
                                                                                <a target="_blank"
                                                                                   href="{{ route('backend.trainer.viewSubmission', ['user_id' => $u_id, 'task_id' => $t_id, 'cohort_id' => $c_id]) }}"
                                                                                   class="btn btn-danger" role="button">
                                                                                    Review & Mark
                                                                                </a>
                                                                            @else
                                                                                <a target="_blank"
                                                                                   href="{{ route('backend.view.task.submission', ['submission' => $submission->id]) }}"
                                                                                   class="btn btn-success"
                                                                                   role="button">
                                                                                    View
                                                                                </a>
                                                                            @endif
                                                                        </td>

                                                                    @endif

                                                                @endforeach


                                                            </tr>
                                                        @endforeach
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                        @else
                                                    <p>No Self-Study found.</p>
                                        @endif
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!------------------------------------ English Assessment ------------------------------------>
                    <div class="tab-pane fade" id="Englishassessment" role="tabpanel"
                         aria-labelledby="Englishassessment-tab">


                        <div class="otsTask mt-4 p-4 h-100">
                            <div class="otsTaskInner">
                                <td class="otstaskData">


                                    @if($groupedEnglishSubmissions->isNotEmpty())
                                        <div class="table-responsive">
                                            <table class="table table-bordered align-middle text-center">
                                                <thead>
                                                <tr>
                                                    <th>Learner</th>
                                                    <th>Course</th>
                                                    <th>Cohort</th>
                                                    <th>Location</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                    <th>Grade</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($groupedEnglishSubmissions as $learnerId => $cohorts)
                                                    @foreach($cohorts as $cohortId => $submissions)
                                                        <tr>
                                                            <td>{{ $submissions->first()->user->name }}</td>
                                                            <!-- Learner's name -->
                                                            <td>{{ $submissions->first()->cohort->course->name }}</td>
                                                            <!-- Course name -->
                                                            <td>{{ $submissions->first()->cohort->start_date_time }}
                                                                - {{ $submissions->first()->cohort->end_date_time }}</td>

                                                            <td>{{ $submissions->first()->cohort->venue->venue_name ?? ""  }}</td>
                                                            @foreach($submissions as $submission)

                                                                @php
                                                                    $u_id = $submission->user_id ?? "";
                                                                    $t_id = $submission->task_id ?? "";
                                                                    $c_id = $submission->cohort_id ?? "";
                                                                @endphp
                                                                @if($submission->task_id == 1)
                                                                    <td>
                                                                        @if($submission->status == "Approved")
                                                                            Passed
                                                                        @elseif($submission->status == "Rejected")
                                                                            Failed
                                                                        @else
                                                                            {{$submission->status}}
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        @if($submission->status == "In Progress")
                                                                            <a target="_blank"
                                                                               href="{{ route('backend.trainer.viewSubmission', ['user_id' => $u_id, 'task_id' => $t_id, 'cohort_id' => $c_id]) }}"
                                                                               class="btn btn-danger" role="button">
                                                                                Review & Mark
                                                                            </a>
                                                                        @else
                                                                            <a target="_blank"
                                                                               href="{{ route('backend.view.task.submission', ['submission' => $submission->id]) }}"
                                                                               class="btn btn-success" role="button">
                                                                                View
                                                                            </a>
                                                                        @endif
                                                                    </td>

                                                                    @php

                                                                        $trainerResponse = json_decode($submission->trainer_response, true);
                                                                        $total = $trainerResponse['total'] ?? 0; // If 'total' exists, store it; otherwise, set it to 0
                                                                        $percentage = round(($total / 17) * 100, 2);

                                                                    @endphp

                                                                    <td class="@if($percentage>=70) bg-success @else bg-red @endif "> {{ $total ?? "" }}
                                                                        / 17
                                                                    </td>

                                                                @endif

                                                            @endforeach
                                                            <td></td>
                                                        </tr>
                                                    @endforeach
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    @else
                                        <p>No English Assessments found.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!------------------------------------ LessonPlans ------------------------------------>
                    <div class="tab-pane fade" id="LessonPlans" role="tabpanel" aria-labelledby="LessonPlans-tab">


                        <div class="otsTask mt-4 p-4 h-100">
                            <div class="otsTaskInner">
                                <div class="otstaskData">
                                    <table class="otsDataTable">
                                        <thead>
                                        <tr>
                                            <th>Course</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Location</th>
                                            <th>Lesson Plan</th>
                                            <th>Learners</th>
                                            <th>Course Status</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($lessonPlans as $plan)
                                            <tr>
                                                <td>{{ $plan->course->name }}</td>
                                                <td>{{ \Carbon\Carbon::parse($plan->start_date_time)->format('d F, Y, h:i A')   ?? "" }}</td>
                                                <td>{{ \Carbon\Carbon::parse($plan->end_date_time)->format('d F, Y, h:i A') ?? "" }}</td>
                                                <td>{{ $plan->venue->venue_name ?? "" }}</td>
                                                <td>
                                                    @if($plan->lesson_plan)
                                                        <a href="{{ asset('storage/' . $plan->lesson_plan) }}"
                                                           target="_blank"
                                                           class="btn btn-success">View</a>
                                                    @else
                                                        <a href="javascript:void(0)"
                                                           class="btn btn-danger uploadBtn"
                                                           data-cohortid="{{$plan->id}}"
                                                           data-coursename="{{$plan->course->name}}">Upload</a>
                                                    @endif
                                                </td>
                                                <td>{{ $plan->max_learner   }}</td>
                                                <td>
                                                    @switch($plan->cohort->status ?? "")
                                                        @case('Complete')
                                                            <span class="badge">Complete</span>
                                                            @break
                                                        @case('Cancelled')
                                                            <span class="badge">Cancelled</span>
                                                            @break
                                                        @case('Confirmed')
                                                            <span class="badge">Confirmed</span>
                                                            @break
                                                        @default
                                                            <span class="badge">Confirmed</span>
                                                    @endswitch
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7">No Lesson Plans Found.</td>
                                            </tr>
                                        @endforelse
                                        </tbody>
                                    </table>

                                    <div class="container mt-4">
                                        <div class="card p-3 shadow-sm">
                                            <!-- Download Section -->
                                            <div class="d-flex align-items-center mb-3">
                                                <!-- FontAwesome Download Icon -->
                                                <i class="fas fa-download fa-2x me-3"></i>
                                                <div>
                                                    <h5 class="mb-0">Download Lesson Plan Template</h5>
                                                </div>
                                            </div>

                                            <!-- Link to Download -->
                                            <div class="mb-3">
                                                <a href="#" class="text-primary" style="font-size: 18px;">T4E Lesson
                                                    Plan Template</a>
                                            </div>

                                            <!-- Alert Message -->
                                            <div class="alert alert-danger d-flex align-items-center" role="alert">
                                                <i class="fas fa-exclamation-circle fa-2x me-3"></i>
                                                <div>
                                                    <strong>&nbsp; Note:</strong> Follow the link to download and
                                                    edit
                                                    the Lesson Plan Template. Once edited, save as PDF to upload.
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>


                    </div>
                    <!------------------------------------ Invoices ------------------------------------>
                    <div class="tab-pane fade" id="Invoices" role="tabpanel"
                         aria-labelledby="Invoices-tab">


                        <div class="otsTask mt-4 p-4 h-100">
                            <div class="otsTaskInner">
                                <div class="otstaskData">
                                    <table class="otsDataTable">
                                        <thead>
                                        <tr>
                                            <th>Course</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Location</th>
                                            <th>Invoice</th>
                                            <th>Learners</th>
                                            <th>Course Status</th>
                                            <th>Contact Finance Department</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($lessonPlans as $plan)
                                            <tr>
                                                <td>{{ $plan->course->name }}</td>
                                                <td>{{ \Carbon\Carbon::parse($plan->start_date_time)->format('d F, Y, h:i A')   ?? "" }}</td>
                                                <td>{{ \Carbon\Carbon::parse($plan->end_date_time)->format('d F, Y, h:i A') ?? "" }}</td>
                                                <td>{{ $plan->venue->venue_name ?? "" }}</td>



                                                    @if($plan->invoice)
                                                        <td><a href="{{ asset('storage/' . $plan->invoice) }}" class="btn btn-success" target="_blank">View</a></td>
                                                    @else
                                                    <td><a href="#" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#uploadInvoiceModal" data-cohort-id="{{ $plan->id }}" data-course-name="{{ $plan->course->name }}">Upload</a></td>
                                                    @endif



                                                <td>{{ $plan->max_learner   }}</td>
                                                <td>
                                                    @switch($plan->cohort->status ?? "")
                                                        @case('Complete')
                                                            <span class="badge">Complete</span>
                                                            @break
                                                        @case('Cancelled')
                                                            <span class="badge">Cancelled</span>
                                                            @break
                                                        @case('Confirmed')
                                                            <span class="badge">Confirmed</span>
                                                            @break
                                                        @default
                                                            <span class="badge">Confirmed</span>
                                                    @endswitch
                                                </td>
                                                <td class="text-center">
                                                    <a href="{{route('backend.messages.create')}}">
                                                        <i class="fas fa-envelope me-2"></i> Send Email
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7">No Invoices.</td>
                                            </tr>
                                        @endforelse
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>

        </div>


        <!-- Modal -->
        <div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <form id="uploadForm" method="POST" action="{{ route('backend.upload.lesson.plan') }}"
                      enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="cohort_id" id="cohort_id">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="uploadModalLabel">Upload Lesson Plan</h5>
                        </div>
                        <div class="modal-body">
                            <!-- Your upload input field here -->
                            <div class="mb-3">
                                <label for="lesson_plan" class="form-label">Select Lesson Plan</label>
                                <input type="file" class="form-control" name="lesson_plan" id="lesson_plan"
                                       required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>


        <!-- Invoice Upload Modal -->
        <div class="modal fade" id="uploadInvoiceModal" tabindex="-1" aria-labelledby="uploadInvoiceModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="uploadInvoiceModalLabel">Upload Invoice for <span id="courseName"></span></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('backend.invoice.upload') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="cohort_id" id="cohortId">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="invoiceFile" class="form-label">Upload Invoice</label>
                                <input type="file" class="form-control" id="invoiceFile" name="invoice_file" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save Invoice</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


    </div>

@endsection

@push('js')
    <script src="{{ asset('js/main.js') }}"></script>
    <script>
        $(function () {


            // Show the modal when the upload button is clicked
            $('.uploadBtn').click(function () {
                $('#uploadModal').modal('show');
            });


        });




        $(document).on('click', '.uploadBtn', function () {
            var cohortId = $(this).data('cohortid');
            var courseName = $(this).data('coursename');

            //alert(cohortId);

            // Set the cohort ID in the hidden form input
            $('#cohort_id').val(cohortId);

            // Set the modal title to the course name
            $('#uploadModalLabel').text('Upload Lesson Plan for ' + courseName);

            // Show the modal
            $('#uploadModal').modal('show');
        });


        $(document).on('click', '[data-bs-toggle="modal"]', function () {
            var cohortId = $(this).data('cohort-id');
            var courseName = $(this).data('course-name');

            // Set the cohort ID in the hidden form input
            $('#cohortId').val(cohortId);

            // Set the modal title to the course name
            $('#courseName').text('Upload Lesson Plan for ' + courseName);

            // Show the modal
            $('#uploadInvoiceModal').modal('show');
        });







    </script>
@endpush
