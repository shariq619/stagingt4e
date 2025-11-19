@php use App\Libraries\ScormApiService;use Illuminate\Support\Str; @endphp
@extends('layouts.main')

@section('title', 'My Learners')

@section('breadcump')
    <div class="col-sm-6">
        <h1 class="m-0">{{ __('Grade Learners') }}</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('backend.dashboard.index') }}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item active">{{ __('Dashboard') }}</li>
        </ol>
    </div>
@endsection

@push('css')
    {{--<link href="{{ asset('css/adminltev3.css') }}" rel="stylesheet"/>--}}
    <link href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet"/>
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet"/>
    <style>

        .editable-buttons .btn.btn-primary.btn-sm.editable-submit:before {
            position: relative;
            content: "OK";
            font-size: 14px;
        }

        .editable-buttons .btn.btn-default.btn-sm.editable-cancel:after {
            position: relative;
            content: "Cancel";
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

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css"
          rel="stylesheet"/>

@endpush

@section('main')
    <div class="content">


        <div class="row">
            <div class="col-md-12 col-12">
                <div class="filter-section">
                    <form action="{{ route('backend.admin.grade.learner') }}" method="GET">
                        <div class="row">

                            <!-- Learner Filter -->
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


                            <!-- Course Dropdown -->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="course">Course</label>
                                    <select name="course" id="course" class="form-control">
                                        <option value="">Select Course</option>
                                        @foreach ($submitted_courses as $course)
                                            <option
                                                value="{{ $course->id }}" {{ request('course') == $course->id ? 'selected' : '' }}>
                                                {{ $course->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Cohort Dropdown -->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="cohort">Cohort</label>
                                    <select name="cohort" id="cohort" class="form-control select2">
                                        <option value="">Select Cohort</option>
                                        @foreach ($submitted_cohorts as $cohort)
                                            <option
                                                value="{{ $cohort->id }}" {{ request('cohort') == $cohort->id ? 'selected' : '' }}>
                                                {{ $cohort->course->name ?? '' }}
                                                ({{ \Carbon\Carbon::parse($cohort->start_date_time)->format('d M Y') }}
                                                - {{ \Carbon\Carbon::parse($cohort->end_date_time)->format('d M Y') }})
                                                ({{$cohort->venue->venue_name}})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Venue Filter -->
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

                            <!-- Trainer Filter -->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="trainer">Trainer</label>
                                    <select name="trainer" id="trainer" class="form-control">
                                        <option value="">Select Trainer</option>
                                        @foreach ($trainers as $trainer)
                                            <option
                                                value="{{ $trainer->id }}" {{ request('trainer') == $trainer->id ? 'selected' : '' }}>
                                                {{ $trainer->name }} {{ $trainer->last_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Submit and Reset Buttons -->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary mt-4">Filter</button>
                                    <!-- Reset Button -->
                                    <a href="{{ route('backend.admin.grade.learner') }}"
                                       class="btn btn-secondary mt-4">Reset</a>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-md-12 col-12 mb-4">
                <div class="otsTask mt-4 p-4 h-100 ">
                    <div class="otsTaskInner">
                        <div class="taskHeading d-flex">
                            <h4 class="m-0"></h4>
                        </div>

                        <div class="otstaskData card-body table-responsive p-0" id="trainerMyLearners">
                            <div class="card-body">
                                @if($groupedSubmissions->count())
                                    @foreach ($groupedSubmissions as $cohortData)
                                        <div>
                                            <div class="bgHeadings">
                                                <h2 class="callout callout-success">
                                                    <span class="text-grey"> Cohort Details: </span>
                                                    <strong>{{ $cohortData['cohort']['course_name'] }}
                                                        , {{ \Carbon\Carbon::parse($cohortData['cohort']['start_date'])->format('d M Y') }}
                                                        -
                                                        {{ \Carbon\Carbon::parse($cohortData['cohort']['end_date'])->format('d M Y') }}</strong>, {{ $cohortData['cohort']['venue'] ?? "" }}
                                                </h2>
                                            </div>
                                        </div>
                                        <table class="table table-bordered">
                                            <thead>
                                            <tr>
                                                <th>Learner Detail</th>
                                                <th>Corporate Client</th>
                                                <th>Highfield Award</th>
                                                <th>Exams</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($cohortData['learners'] as $learner)
                                                <tr>
                                                    <td>{{ $learner['learner_name'] }}</td>
{{--                                                    <td class="userImage">--}}
{{--                                                        @if ($learner['learner_image'] == null)--}}
{{--                                                            <img src="{{ asset('/images/default-placeholder.png') }}"--}}
{{--                                                                 class="img-fluid text-center"--}}
{{--                                                                 alt="{{ $learner['learner_name'] }}">--}}
{{--                                                        @else--}}
{{--                                                            <img src="{{ asset($learner['learner_image']) }}"--}}
{{--                                                                 class="img-fluid text-center"--}}
{{--                                                                 alt="{{ $learner['learner_name'] }}">--}}
{{--                                                        @endif--}}
{{--                                                        --}}
{{--                                                    </td>--}}
                                                    <td>{{ $learner['learner_client'] ?? ""  }}</td>
                                                    <td>
                                                        @if(isset($learner['highfield_certificate']['file_path']))
                                                            <a
                                                                href="{{ asset('storage/'.$learner['highfield_certificate']['file_path']) }}"
                                                                target="_blank"
                                                                class="btn btn-sm btn-primary"
                                                            >
                                                                View Certificate
                                                            </a>

                                                            @php
                                                                // Update the pivot table (cohort_user)
                                                                   $cohort_user = \DB::table('cohort_user')
                                                                            ->where('user_id',  $learner['id'])
                                                                            ->where('cohort_id', $cohortData['cohort']['id'])
                                                                            ->first();
                                                            @endphp

                                                            @if($cohort_user->status == "Approved")
                                                                <a href="javascript:0" class="badge badge-success">Notified</a>
                                                            @else
                                                                <a href="#" class="btn btn-sm btn-success notify-seller-btn"
                                                                   data-user_id="{{ $learner['id'] }}"
                                                                   data-cohort_id="{{ $cohortData['cohort']['id'] }}">
                                                                    Notify Learner
                                                                </a>
                                                            @endif

                                                            {{-- Re-upload form --}}
                                                            <form
                                                                action="{{ route('backend.admin.reuploadhighfield.certificate') }}"
                                                                method="POST"
                                                                enctype="multipart/form-data"
                                                                class="mt-2"
                                                            >
                                                                @csrf
                                                                <input type="hidden" name="user_id" value="{{ $learner['id'] }}">
                                                                <input type="hidden" name="course_id" value="{{ $cohortData['cohort']['course_id'] }}">
                                                                <input type="hidden" name="cohort_id" value="{{ $cohortData['cohort']['id'] }}">
                                                                <input type="file" name="certificate" class="form-control mb-2" required>
                                                                <button type="submit" class="btn btn-sm btn-warning">Re-upload Certificate</button>
                                                            </form>

                                                            {{-- Remove Certificate Form --}}
                                                            <form
                                                                action="{{ route('backend.admin.removehighfield.certificate') }}"
                                                                method="POST"
                                                                class="mt-2"
                                                                onsubmit="return confirm('Are you sure you want to remove this certificate?');"
                                                            >
                                                                @csrf
                                                                <input type="hidden" name="user_id" value="{{ $learner['id'] }}">
                                                                <input type="hidden" name="course_id" value="{{ $cohortData['cohort']['course_id'] }}">
                                                                <input type="hidden" name="cohort_id" value="{{ $cohortData['cohort']['id'] }}">
                                                                <button type="submit" class="btn btn-sm btn-danger">Remove Certificate</button>
                                                            </form>




                                                        @else
                                                            <form
                                                                action="{{ route('backend.admin.highfield.certificate') }}"
                                                                method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                <input type="hidden" name="user_id"
                                                                       value="{{ $learner['id'] }}">
                                                                <input type="hidden" name="course_id"
                                                                       value="{{ $cohortData['cohort']['course_id'] }}">
                                                                <input type="hidden" name="cohort_id"
                                                                       value="{{ $cohortData['cohort']['id'] }}">
                                                                <input type="file" name="certificate"
                                                                       class="form-control mb-2" required>
                                                                <button type="submit" class="btn btn-sm btn-primary">
                                                                    Upload Certificate
                                                                </button>
                                                            </form>
                                                        @endif
                                                    </td>
                                                    <td>

                                                        <button class="btn btn-sm btn-primary open-exam-modal"
                                                                data-learner="{{ $learner['id'] }}"
                                                                data-cohort="{{ $cohortData['cohort']['id'] }}">
                                                            Submit & Update Exam Results
                                                        </button>


{{--                                                        <table class="exam-table">--}}
{{--                                                            <tr>--}}
{{--                                                                @foreach ($learner['exams'] as $exam)--}}
{{--                                                                    <th colspan="2">{{ $exam['name'] ?? "" }}</th>--}}
{{--                                                                @endforeach--}}
{{--                                                            </tr>--}}
{{--                                                            <tr>--}}
{{--                                                                @foreach ($learner['exams'] as $exam)--}}
{{--                                                                    @if(isset($exam['type']))--}}
{{--                                                                        @if ($exam['type'] == 'MCQ')--}}
{{--                                                                            <td colspan="2">--}}
{{--                                                                                MCQ ---}}
{{--                                                                                <span--}}
{{--                                                                                    class="badge badge-secondary">Min {{ $exam['min_score'] ?? 'N/A' }}</span>--}}
{{--                                                                                <span--}}
{{--                                                                                    class="badge badge-info">Max {{ $exam['max_score'] ?? 'N/A' }}</span>--}}
{{--                                                                                <span class="badge badge-success">Pass Rate {{ $exam['pass_rate'] ?? 'N/A' }}%</span>--}}
{{--                                                                            </td>--}}
{{--                                                                        @elseif ($exam['type'] == 'Practical')--}}
{{--                                                                            <td colspan="2">--}}
{{--                                                                                Practical---}}
{{--                                                                                <span--}}
{{--                                                                                    class="badge badge-secondary">Min {{ $exam['min_score'] ?? 'N/A' }}</span>--}}
{{--                                                                                <span--}}
{{--                                                                                    class="badge badge-info">Max {{ $exam['max_score'] ?? 'N/A' }}</span>--}}
{{--                                                                                <span class="badge badge-success">Pass Rate {{ $exam['pass_rate'] ?? 'N/A' }}%</span>--}}
{{--                                                                            </td>--}}
{{--                                                                        @endif--}}
{{--                                                                    @endif--}}
{{--                                                                @endforeach--}}
{{--                                                            </tr>--}}
{{--                                                            <tr>--}}




{{--                                                                @foreach ($learner['exams'] as $exam)--}}
{{--                                                                    <td colspan="2">--}}
{{--                                                                        @php--}}
{{--                                                                            // Get the exam result for the learner, exam, and cohort--}}
{{--                                                                            $examResult = \App\Models\ExamResult::where('learner_id', $learner['id'])--}}
{{--                                                                                ->where('exam_id', $exam->id)--}}
{{--                                                                                ->where('cohort_id', $cohortData['cohort']['id'])--}}
{{--                                                                                ->first();--}}
{{--                                                                        @endphp--}}

{{--                                                                        @if ($examResult)--}}

{{--                                                                            <span id="status"--}}
{{--                                                                                  data-type="select"--}}
{{--                                                                                  data-name="status"--}}
{{--                                                                                  data-pk="{{ $examResult->id }}"--}}
{{--                                                                                  class="badge {{ $examResult->status === 'Passed' ? 'badge-success' : 'badge-danger' }}">--}}
{{--                                                                            {{ $examResult->status }}--}}
{{--                                                                        </span>--}}

{{--                                                                            Score:--}}
{{--                                                                            <span class="score"--}}
{{--                                                                                  data-type="text"--}}
{{--                                                                                  data-name="score"--}}
{{--                                                                                  data-pk="{{ $examResult->id }}">--}}
{{--                                                                                {{ $examResult->score }}--}}
{{--                                                                        </span>--}}

{{--                                                                        @else--}}
{{--                                                                            <form--}}
{{--                                                                                action="{{ route('backend.exam-results.store') }}"--}}
{{--                                                                                method="POST">--}}
{{--                                                                                @csrf--}}
{{--                                                                                <!-- Hidden Fields -->--}}
{{--                                                                                <input type="hidden" name="exam_id"--}}
{{--                                                                                       value="{{ $exam->id }}">--}}
{{--                                                                                <input type="hidden" name="learner_id"--}}
{{--                                                                                       value="{{ $learner['id'] }}">--}}
{{--                                                                                <input type="hidden" name="cohort_id"--}}
{{--                                                                                       value="{{ $cohortData['cohort']['id'] }}">--}}

{{--                                                                                <input type="number"--}}
{{--                                                                                       class="form-control mb-1"--}}
{{--                                                                                       name="score"--}}
{{--                                                                                       placeholder="Marks"/>--}}
{{--                                                                                <select class="form-control  mb-1"--}}
{{--                                                                                        name="status">--}}
{{--                                                                                    <option value="">Select</option>--}}
{{--                                                                                    <option value="Passed">Passed--}}
{{--                                                                                    </option>--}}
{{--                                                                                    <option value="Failed">Failed--}}
{{--                                                                                    </option>--}}
{{--                                                                                </select>--}}
{{--                                                                                <button type="submit"--}}
{{--                                                                                        class="btn btn-primary btn-sm">--}}
{{--                                                                                    Submit--}}
{{--                                                                                </button>--}}

{{--                                                                            </form>--}}
{{--                                                                        @endif--}}
{{--                                                                    </td>--}}
{{--                                                                @endforeach--}}
{{--                                                            </tr>--}}

{{--                                                        </table>--}}
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                        <br>
                                    @endforeach
                                @else
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th>Learner Detail</th>
                                            <th>Photo</th>
                                            <th>Corporate Client</th>
                                            <th>Certificate</th>
                                            <th>Exams</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td colspan="5"><p class="text-center">No records found.</p></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                @endif
                            </div>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="examModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form id="examResultsForm">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Enter Exam Results</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="examModalBody">
                        <!-- Populated by AJAX -->
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit Results</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection



@push('js')

    <link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css"
          rel="stylesheet"/>
    <script
        src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>

    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>


        $(document).ready(function () {
            $('.notify-seller-btn').on('click', function (e) {
                e.preventDefault();

                let userId = $(this).data('user_id');
                let cohortId = $(this).data('cohort_id');
                let button = $(this);

                $.ajax({
                    url: "{{ route('backend.notify.learner') }}",
                    method: 'POST',
                    data: {
                        user_id: userId,
                        cohort_id: cohortId,
                        _token: '{{ csrf_token() }}'
                    },
                    beforeSend: function () {
                        button.prop('disabled', true).text('Processing...');
                    },
                    success: function (response) {
                        alert(response.message);
                        location.reload();
                    },
                    error: function () {
                        alert('Something went wrong. Please try again.');
                        button.prop('disabled', false).text('Pass & Notify Seller');
                    }
                });
            });
        });


        $(document).on('click', '#highfieldCertificate', function (e) {
            e.preventDefault();

            let button = $(this);
            let messageDiv = button.siblings('.certMsg');
            let learnerId = button.data('learner-id');
            let cohortId = button.data('cohort-id');

            button.text('Generating...').prop('disabled', true);

            $.ajax({
                url: "{{ route('backend.admin.highfield.certificate') }}",
                type: 'POST',
                data: {
                    learner_id: learnerId,
                    cohort_id: cohortId,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    messageDiv.html('<div class="alert alert-success">' + response.message + '</div>');
                    location.reload();
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
        });


        $(document).on('click', '.uploadButton', function (e) {
            e.preventDefault(); // Prevent default button behavior

            let button = $(this); // Reference to the clicked button
            let fileInput = button.siblings('input[type="file"]'); // Get the specific file input near this button
            let messageDiv = button.siblings('#message'); // Get the specific message div near this button
            let file = fileInput[0].files[0];
            let cohortId = fileInput.data('cohort-id');
            let learnerId = fileInput.data('learner-id');

            if (!file) {
                messageDiv.html('<div class="alert alert-warning">Please select a file to upload.</div>');
                return;
            }

            let formData = new FormData();
            formData.append('certificate', file);
            formData.append('cohort_id', cohortId);
            formData.append('learner_id', learnerId);

            // Change button text to "Loading..." and disable it
            button.text('Loading...').prop('disabled', true);

            $.ajax({
                url: "{{ route('backend.upload.certificate') }}",
                type: 'POST',
                data: formData,
                processData: false, // Prevent jQuery from processing the data
                contentType: false, // Prevent jQuery from setting content type
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'), // Add CSRF token
                },
                success: function (response) {
                    messageDiv.html('<div class="alert alert-success">File uploaded successfully!</div>');
                    location.reload();
                },
                error: function (xhr, status, error) {
                    messageDiv.html('<div class="alert alert-danger">File upload failed. Please try again.</div>');
                },
                complete: function () {
                    // Revert button text and enable it
                    button.text('Upload').prop('disabled', false);
                },
            });
        });


        {{--$(document).ready(function () {--}}
        {{--    $.fn.editable.defaults.mode = 'inline'; // Set x-editable to inline mode--}}
        {{--    $.fn.editable.defaults.ajaxOptions = {type: 'POST'}; // Use POST for updates--}}

        {{--    // Enable editing for the score field--}}
        {{--    $('.score').editable({--}}
        {{--        url: '{{ route("backend.exam-results.update") }}', // Route to handle the update--}}
        {{--        params: function (params) {--}}
        {{--            params._token = '{{ csrf_token() }}'; // Include CSRF token--}}
        {{--            return params;--}}
        {{--        },--}}
        {{--        title: 'Enter score',--}}
        {{--        success: function (response) {--}}
        {{--            console.log(response.message); // Log success message--}}
        {{--        },--}}
        {{--        error: function (error) {--}}
        {{--            console.log('Error:', error); // Log error--}}
        {{--        }--}}
        {{--    });--}}

        {{--    // Enable editing for the status field--}}
        {{--    $('.badge').editable({--}}
        {{--        url: '{{ route("backend.exam-results.update") }}', // Route to handle the update--}}
        {{--        params: function (params) {--}}
        {{--            params._token = '{{ csrf_token() }}'; // Include CSRF token--}}
        {{--            return params;--}}
        {{--        },--}}
        {{--        source: [--}}
        {{--            {value: 'Passed', text: 'Passed'},--}}
        {{--            {value: 'Failed', text: 'Failed'},--}}
        {{--        ], // Dropdown options for the status field--}}
        {{--        title: 'Select status',--}}
        {{--        success: function (response) {--}}
        {{--            console.log(response.message); // Log success message--}}
        {{--        },--}}
        {{--        error: function (error) {--}}
        {{--            console.log('Error:', error); // Log error--}}
        {{--        }--}}
        {{--    });--}}


        {{--    $('.select2').select2({--}}
        {{--        allowClear: true,--}}
        {{--        theme: "bootstrap-5",--}}
        {{--        width: '100%'--}}
        {{--    });--}}


        {{--});--}}
        $('.select2').select2({
            allowClear: true,
            theme: "bootstrap-5",
            width: '100%'
        });



        $(document).ready(function () {

            // Open modal and fetch exams
            $('.open-exam-modal').on('click', function () {
                const learnerId = $(this).data('learner');
                const cohortId = $(this).data('cohort');

                $.ajax({
                    url: '{{ route("backend.exam-results.fetch-exams") }}',
                    type: 'POST',
                    data: {
                        learner_id: learnerId,
                        cohort_id: cohortId,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (html) {
                        $('#examModalBody').html(html);
                        $('#examModal').modal('show');
                    }
                });
            });

            // Submit all exam results at once
            $('#examResultsForm').on('submit', function (e) {
                e.preventDefault();

                $.ajax({
                    url: '{{ route("backend.exam-results.bulk-store") }}',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function (res) {
                        alert(res.message);
                        $('#examModal').modal('hide');
                        location.reload(); // optional: reload to see updated UI
                    },
                    error: function (xhr) {
                        alert("Error saving results");
                        console.log(xhr.responseText);
                    }
                });
            });





        });



    </script>

@endpush
