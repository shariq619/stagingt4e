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
    <link href="{{ asset('css/adminltev3.css') }}" rel="stylesheet" />
    <link href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet" />
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet" />

    <style>
        .coursesBoxRow .col:hover {
            background: #444444;
        }

        .coursesBoxRow .col {
            margin: 0px 5px;
            border: solid 1px #cccc;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px !important;
            box-shadow: #0000001f 0px 0px 10px 0px;
        }

        #tainerDashboard .coursesBox {
            border: none;
            padding: unset;
            border-radius: unset;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        @media (max-width: 1500px) {
            .coursesBox .coursesBoxFooter .boxFooterInfo h4 {
                font-size: 14px;
                margin: 0;
            }

            .coursesBox .coursesBoxFooter .boxFooterInfo p,
            .coursesBox .coursesBoxFooter p,
            .coursesBox .coursesBoxFooter a {
                font-size: 13px;
            }

            .table-responsive::-webkit-scrollbar {
                height: 7px;
            }

            .table-responsive::-webkit-scrollbar-track {
                background: #f1f1f1;
                border-radius: 10px;
            }

            .table-responsive::-webkit-scrollbar-thumb {
                background: #888;
                border-radius: 10px;
            }

            .table-responsive::-webkit-scrollbar-thumb:hover {
                background: #555;
            }

            .responsive>thead th {
                display: none;
            }

            .responsive>tbody td,
            .responsive>tbody th {
                display: block;
            }

            .responsive>tbody>tr:nth-child(even) td,
            .responsive>tbody>tr:nth-child(even) th {
                background-color: #eee;
            }

            [row-header] {
                position: relative;
                /* width: 50%;*/
                vertical-align: middle;
            }

            [row-header]:before {
                content: attr(row-header);
                display: inline-block;
                vertical-align: middle;
                text-align: left;
                width: 50%;
                padding-right: 30px;
                white-space: nowrap;
                overflow: hidden;
            }
        }
    </style>
@endpush

@section('main')
    <div class="content mb-4" id="tainerDashboard">
        <div class="row coursesBoxRow">
            <div class="col">
                <div class="coursesBox">
                    <div class="coursesBoxHeader d-flex align-items-center justify-content-between">
                        <h4>My Courses</h4>
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <div class="coursesBoxFooter d-flex align-items-end justify-content-between">
                        <div class="boxFooterInfo">
                            <h4>{{ $assignedCohortCount ?? '' }}</h4>
                            {{--                            <p class="m-0">2 complete</p> --}}
                        </div>
                        <a href="{{ route('backend.trainer.my.courses') }}" class="m-0">View All</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="coursesBox">
                    <div class="coursesBoxHeader d-flex align-items-center justify-content-between">
                        <h4>My Learners</h4>
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="boxFooterInfo">
                        <h4> {{ $totalLearners ?? '' }} </h4>
                    </div>
                    <div class="coursesBoxFooter d-flex justify-content-end">
                        <a href="{{ route('backend.trainer.my.learners') }}" class="m-0">View All Learners</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="coursesBox">
                    <div class="coursesBoxHeader d-flex align-items-center justify-content-between">
                        <h4>My Tasks</h4>
                        <i class="fa fa-edit"></i>
                    </div>
                    <div class="coursesBoxFooter d-flex align-items-end justify-content-between">
                        <div class="boxFooterInfo">
                            <h4 class="text-danger">{{ $pendingTasksCount ?? '' }} Pending</h4>
                            <p class="m-0">{{ $completedTasksCount ?? '' }} complete</p>
                        </div>
                        <a href="{{ route('backend.trainer.my.learners') }}" class="m-0">View All Tasks</a>
                        {{--<a href="{{ route('backend.trainer.my.tasks') }}" class="m-0">View All Tasks</a>--}}
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="coursesBox">
                    <div class="coursesBoxHeader d-flex align-items-center justify-content-between">
                        <h4>My Messages</h4>
                        <i class="fa fa-envelope"></i>
                    </div>
                    <div class="coursesBoxFooter d-flex align-items-end justify-content-between">
                        <div class="boxFooterInfo">
                            <h4 class="text-danger">{{ $unreadCount ?? '' }} unread</h4>
                            <p class="m-0">{{ $readCount ?? '' }} read messages</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="coursesBox">
                    <div class="coursesBoxHeader d-flex align-items-center justify-content-between">
                        <h4>My Invoices</h4>
                        <i class="fas fa-pound-sign"></i>
                    </div>
                    <div class="coursesBoxFooter d-flex align-items-end justify-content-between">
                        <div class="boxFooterInfo">
                            <h4 class="text-danger">0 Pending</h4>
                            <p class="m-0">0 paid</p>
                        </div>
                        <p class="m-0">{{ $invoices ?? 0 }} total</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- My Courses -->
        <div class="row mb-4">
            <div class="col-md-8 col-12">
                <div class="otsTask mt-4 p-4 h-100 bg-white tableShadow">
                    <div class="otsTaskInner">
                        <div class="taskHeading d-flex justify-content-between align-items-center mb-3">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-graduation-cap mr-2"></i>
                                <h4 class="m-0">My Courses</h4>
                            </div>
                            <div class="coursesBoxFooter d-flex justify-content-end">
                                <a href="{{ route('backend.trainer.my.courses') }}" class="m-0 btn btn-primary btn-sm"
                                    style="line-height:25px;">View All</a>
                            </div>
                        </div>
                        <div class="otstaskData table-responsive tableSticky">
                            <table class="otsDataTable table table-bordered">
                                <thead>
                                    <tr>
                                        <th width="20%" class="sticky">Course Name</th>
                                        <th width="20%">Risk Assessment</th>
                                        <th width="20%">Start Date</th>
                                        <th width="20%">End Date</th>
                                        <th width="20%">Location</th>
{{--                                        <th width="20%">Lesson Plan</th>--}}
{{--                                        <th width="20%">Enrolled / Max Learners</th>--}}
{{--                                        <th width="20%">Course Status</th>--}}
{{--                                        <th width="20%">Pass Rate</th>--}}
{{--                                        <th width="20%">Invoice</th>--}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($assignedCohort as $cohort)
                                        <tr>
                                            <td class="sticky">{{ $cohort->course->name ?? "" }}</td>
                                            <td>
                                                @if(!$cohort->riskAssessment)
                                                    <a href="{{ route('backend.risk-assessments.create', ['cohort_id' => $cohort->id]) }}"
                                                       class="btn-sm btn-primary">
                                                        View
                                                    </a>
                                                @else
                                                    <span class="badge badge-success">Submitted</span>
                                                @endif
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($cohort->start_date_time)->format('d M, Y, g:i A') }}
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($cohort->end_date_time)->format('d M, Y, g:i A') }}
                                            </td>
                                            <td>{{ optional($cohort->venue)->venue_name }}</td>

{{--                                            <td>--}}
{{--                                                @if ($cohort->lesson_plan)--}}
{{--                                                    <a href="{{ asset('storage/' . $cohort->lesson_plan) }}"--}}
{{--                                                        target="_blank" class="btn btn-success btn-sm">View</a>--}}
{{--                                                @else--}}
{{--                                                    <a href="javascript:void(0)" class="btn btn-danger btn-sm uploadBtn"--}}
{{--                                                        data-cohortid="{{ $cohort->id }}"--}}
{{--                                                        data-coursename="{{ $cohort->course->name }}">Upload</a>--}}
{{--                                                @endif--}}
{{--                                            </td>--}}
{{--                                            <td>{{ $cohort->users_count }} / {{ $cohort->max_learner }}</td>--}}
{{--                                            <td>--}}
{{--                                                @switch($submission->cohort->status ?? "")--}}
{{--                                                    @case('Complete')--}}
{{--                                                        <span class="badge">Complete</span>--}}
{{--                                                    @break--}}

{{--                                                    @case('Cancelled')--}}
{{--                                                        <span class="badge">Cancelled</span>--}}
{{--                                                    @break--}}

{{--                                                    @case('Confirmed')--}}
{{--                                                        <span class="badge">Confirmed</span>--}}
{{--                                                    @break--}}

{{--                                                    @default--}}
{{--                                                        <span class="badge">Confirmed</span>--}}
{{--                                                @endswitch--}}
{{--                                            </td>--}}
{{--                                            <td>--}}
{{--                                                <div class="progress" style="height: 20px;">--}}
{{--                                                    <div class="progress-bar bg-success" role="progressbar"--}}
{{--                                                        style="width: 70%;" aria-valuenow="70" aria-valuemin="0"--}}
{{--                                                        aria-valuemax="100">70%--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </td>--}}
{{--                                            @if ($cohort->invoice)--}}
{{--                                                <td><a href="{{ asset('storage/' . $cohort->invoice) }}"--}}
{{--                                                        class="btn btn-success btn-sm" target="_blank">View</a></td>--}}
{{--                                            @else--}}
{{--                                                <td><a href="#" class="btn btn-danger btn-sm"--}}
{{--                                                        data-bs-toggle="modal" data-bs-target="#uploadInvoiceModal"--}}
{{--                                                        data-cohort-id="{{ $cohort->id }}"--}}
{{--                                                        data-course-name="{{ $cohort->course->name }}">Upload</a></td>--}}
{{--                                            @endif--}}
                                        </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6">No data available</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                <!-- Pagination links -->
                                <div class="d-flex justify-content-center">
                                    {{ $assignedCohort->links() }} <!-- Display pagination links -->
                                </div>
                            </div>


                        <div class="otsTask mt-4 p-4 h-100 bg-white tableShadow">
                            <div class="otsTaskInner">
                                <div class="taskHeading d-flex align-items-center justify-content-between mb-3">
                                    <div class="d-flex align-items-center">
                                        <i class="fa fa-users mr-2"></i>
                                        <h4 class="m-0">My Learners</h4>
                                    </div>
                                    <div class="coursesBoxFooter d-flex justify-content-end">
                                        <a href="{{ route('backend.trainer.my.learners') }}" class="btn btn-primary btn-sm">View All Learners</a>
                                    </div>
                                </div>
                                <div class="otstaskData table-responsive tableSticky">
                                    @foreach ($groupedSubmissions as $cohortData)
                                        <table class="table table-bordered">
                                            <thead>
                                            <tr>
                                                <th>Full Name</th>
                                                <th>Course Name</th>
                                                <th>Start Date</th>
                                                <th>End Date</th>
                                                <th>Location</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($cohortData['learners'] as $learner)
                                                <!-- First Row: Main Details -->
                                                <tr>
                                                    <td>{{ $learner['learner_name'] }}</td>
                                                    <td>{{ $cohortData['cohort']['course_name'] }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($cohortData['cohort']['start_date'])->format('d M Y') }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($cohortData['cohort']['end_date'])->format('d M Y') }}</td>
                                                    <td>{{ $cohortData['cohort']['venue'] ?? "" }}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    @endforeach
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
                <div class="modal fade" id="uploadInvoiceModal" tabindex="-1" aria-labelledby="uploadInvoiceModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="uploadInvoiceModalLabel">Upload Invoice for <span
                                        id="courseName"></span></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form action="{{ route('backend.invoice.upload') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="cohort_id" id="cohortId">
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="invoiceFile" class="form-label">Upload Invoice</label>
                                        <input type="file" class="form-control" id="invoiceFile" name="invoice_file"
                                            required>
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
                <div class="col-md-4 col-12">
                    <div class="otsTaskChart mt-4 p-4 h-100 bg-white tableShadow">
                        <div class="otsTaskInner">
                            <div class="taskHeading d-flex align-items-center">
                                <i class="fa fa-tasks mr-3"></i>
                                <h4  class="m-0">New Coursework Submissions</h4>
                            </div>
                            <div class="otstaskData">
                                <div class="mt-4">
                                    @forelse($submissions as $submission)
                                        @if ($submission->task_id != null)
                                            <!-- Task Title -->
                                            <h3 class="mb-3">
                                                @if ($submission->task->name ?? '')
                                                    {{ $submission->task->name ?? '' }}
                                                @endif
                                            </h3>
                                            <div class="lessonBox">
                                                <div class="lessonBoxList mb-3">
                                                    <p class="mb-0"><strong>Learner:</strong> {{ $submission->user->name }}
                                                    </p>
                                                    <p class="mb-0"><strong>Date, Time:</strong>
                                                        {{ \Carbon\Carbon::now()->format('d/m/Y H:i:s') }}</p>

                                                    <!-- Access task status from pivot table (task_user) -->
                                                    <p class="mb-0"><strong>Task Status:</strong>
                                                        {{ $submission->status ?? 'Not Available' }}</p>
                                                </div>
                                                <div class="lessonBoxBtn">
                                                    <a href="{{ route('backend.trainer.my.learners') }}"
                                                        class="btn btn-danger text-white">Review & Mark</a>
                                                </div>
                                            </div>
                                            <hr class="my-4">
                                        @endif
                                    @empty
                                        <p>No Coursework found.</p>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-md-8 col-12">

                </div>
                <div class="col-md-4 col-12">
                    <div class="otsTaskChart mt-4 p-4 h-100 bg-white tableShadow">
                        <div class="otsTaskInner">
                            <div class="taskHeading d-flex mb-3">
                                <i class="fa fa-tasks mr-3"></i>
                                <h4 class="m-0">Pending Lesson Plans</h4>
                            </div>
                            <div class="otstaskData">
                                <div class="">
                                    @forelse($lessonPlans as $plan)
                                        <div class="lessonBox d-flex justify-content-between flex-wrap align-items-center">
                                            <div class="lessonBoxList">
                                                <!-- Row 1 -->
                                                <p class="mb-0"><strong>Course Title:</strong> {{ $plan->course->name }}</p>
                                                <p class="mb-0"><strong>Start Date:</strong>
                                                    {{ \Carbon\Carbon::parse($plan->start_date_time)->format('d M, Y, g:i A') }}
                                                </p>
                                            </div>
                                            <div class="lessonBoxBtn">
                                                <a href="javascript:void(0)" class="btn btn-danger btn-sm uploadBtn"
                                                    data-cohortid="{{ $plan->id }}"
                                                    data-coursename="{{ $plan->course->name }}">Upload</a>
                                            </div>
                                        </div>
                                        <hr class="my-3">
                                    @empty
                                        <div class="lessonBox d-flex justify-content-between flex-wrap">
                                            No Pending Lesson Plans Found.
                                        </div>
                                    @endforelse


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endsection
        @push('js')
            <script src="{{ asset('js/main.js') }}"></script>
            <script>
                $(function() {
                    // Show the modal when the upload button is clicked
                    $('.uploadBtn').click(function() {
                        $('#uploadModal').modal('show');
                    });


                });
                $(document).on('click', '.uploadBtn', function() {
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


                $(document).on('click', '[data-bs-toggle="modal"]', function() {
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
