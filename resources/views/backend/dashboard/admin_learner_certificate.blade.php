@php use App\Libraries\ScormApiService;use Illuminate\Support\Str; @endphp
@extends('layouts.main')

@section('title', 'E-Learners')

@section('breadcump')
    <div class="col-sm-6">
        <h1 class="m-0">{{ __('E-Learners') }}</h1>
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

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet" />


@endpush

@section('main')
    <div class="content">


        <div class="row">
            <div class="col-md-12 col-12">
                <div class="filter-section">
                    <form action="{{ route('backend.admin.learner.certificate') }}" method="GET">
                        <div class="row">


                                <!-- Course Dropdown -->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="course_id">Course</label>
                                        <select name="course_id" id="course_id" class="form-control">
                                            <option value="">Select Course</option>
                                            @foreach ($submitted_courses as $course)
                                                <option
                                                    value="{{ $course->id }}" {{ request('course_id') == $course->id ? 'selected' : '' }}>
                                                    {{ $course->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <!-- Cohort Dropdown -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="cohort_id">Cohort</label>
                                        <select name="cohort_id" id="cohort_id" class="form-control select2">
                                            <option value="">Select Cohort</option>
                                            @foreach ($submitted_cohorts as $cohort)
                                                <option
                                                    value="{{ $cohort->id }}" {{ request('cohort_id') == $cohort->id ? 'selected' : '' }}>
                                                    {{ $cohort->course->name ?? '' }}
                                                    ({{ \Carbon\Carbon::parse($cohort->start_date_time)->format('d M Y') }}
                                                    - {{ \Carbon\Carbon::parse($cohort->end_date_time)->format('d M Y') }})
                                                    ({{$cohort->venue->venue_name}})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <!-- License Filter -->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="license_id">E-Learning</label>
                                        <select name="license_id" id="license_id" class="form-control">
                                            <option value="">Select E-Learning</option>
                                            @foreach($licenses as $license)
                                                <option value="{{ $license->id }}" {{ request('license_id') == $license->id ? 'selected' : '' }}>
                                                    {{ $license->name }}
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
                                        <a href="{{ route('backend.admin.learner.certificate') }}"
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

                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th width="10%">Learner</th>
                                <th width="10%">Course</th>
                                <th width="20%">Course Dates</th>
                                <th width="10%">E-Learning</th>
                                <th width="30%">Progress</th>
                                <th width="10%">Certificate</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($learners as $learner)

                                @php
                                    $filteredSubmissions = $learner->taskSubmissions->whereNotNull('license_id');

                                    // Apply frontend license filter too (because we loaded all taskSubmissions in the controller)
                                    if (request('license_id')) {
                                        $filteredSubmissions = $filteredSubmissions->where('license_id', request('license_id'));
                                    }

                                    if (request('course_id')) {
                                        $filteredSubmissions = $filteredSubmissions->where('course_id', request('course_id'));
                                    }

                                    if (request('cohort_id')) {
                                        $filteredSubmissions = $filteredSubmissions->where('cohort_id', request('cohort_id'));
                                    }
                                @endphp


                                @foreach($filteredSubmissions as $submission)




                                    <tr>
                                        <td>{{ $learner->name }} {{ $learner->last_name }}</td>
                                        <td>{{ $submission->course->name ?? 'N/A' }}</td>
                                        <td>
                                            {{ isset($submission->cohort->start_date_time)
                                                ? \Carbon\Carbon::parse($submission->cohort->start_date_time)->format('d F, Y, h:i A')
                                                : 'N/A' }}
                                        </td>
                                        <td>{{ $submission->license->name ?? 'N/A' }}</td>

                                        <td>
                                            @php

                                                  $certificate = $certificates->first(function($cert) use ($submission, $learner) {
                                                        if ($cert->user_id == $learner->id) {
                                                            return $cert->license_id == $submission->license_id;
                                                        }
                                                    });



                                                    $name = $submission->license->name;
                                                    $scorm_registration_id = $submission->scorm_registration_id ?? '';
                                                    // Fetch SCORM details
                                                    $scormApiService = new ScormApiService();
                                                    $course_info = $scormApiService->getRegistrationDetails($scorm_registration_id);

                                            @endphp

                                            <div class="card shadow-sm border-0">
                                                <div class="card-body">
                                                        @php
                                                            $activityDetails = $course_info['activityDetails'] ?? [];
                                                            $title = $activityDetails['title'] ?? 'N/A';
                                                            $attempts = $activityDetails['attempts'] ?? 'N/A';
                                                            $activity_completion = $activityDetails['activityCompletion'] ?? 'N/A';
                                                            $totalSecondsTracked = $course_info['totalSecondsTracked'] ?? 0;
                                                            $hours = floor($totalSecondsTracked / 3600);
                                                            $minutes = floor(($totalSecondsTracked / 60) % 60);
                                                            $seconds = $totalSecondsTracked % 60;
                                                        @endphp

                                                        <p><strong><i class="fas fa-book"></i>
                                                                Title:</strong> {{ $title }}</p>
                                                        <p><strong><i class="fas fa-sync-alt"></i>
                                                                Attempts:</strong> {{ $attempts }}</p>
                                                        <p>
                                                            <strong><i class="fas fa-tasks"></i> Completion
                                                                Status:</strong>
                                                            <span
                                                                class="badge badge-{{ $activity_completion == 'completed' ? 'success' : 'warning' }}">
    {{ ucfirst($activity_completion) }}
</span>
                                                        </p>
                                                        <p><strong><i class="fas fa-clock"></i> Total Time
                                                                Tracked:</strong> {{ $hours }}h {{ $minutes }}
                                                            m {{ $seconds }}s</p>
                                                </div>
                                            </div>

                                        </td>
                                        <td>


                                            @if($certificate)
                                                <a href="{{ asset('storage/' . $certificate->certificate_path) }}" target="_blank" class="btn btn-sm btn-success">
                                                    View Certificate
                                                </a>
                                            @else
                                                <span class="text-warning">No Certificate</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach
                            </tbody>
                        </table>


                    </div>
                </div>
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


        $(document).ready(function () {
            $.fn.editable.defaults.mode = 'inline'; // Set x-editable to inline mode
            $.fn.editable.defaults.ajaxOptions = {type: 'POST'}; // Use POST for updates

            // Enable editing for the score field
            $('.score').editable({
                url: '{{ route("backend.exam-results.update") }}', // Route to handle the update
                params: function (params) {
                    params._token = '{{ csrf_token() }}'; // Include CSRF token
                    return params;
                },
                title: 'Enter score',
                success: function (response) {
                    console.log(response.message); // Log success message
                },
                error: function (error) {
                    console.log('Error:', error); // Log error
                }
            });

            // Enable editing for the status field
            $('.badge').editable({
                url: '{{ route("backend.exam-results.update") }}', // Route to handle the update
                params: function (params) {
                    params._token = '{{ csrf_token() }}'; // Include CSRF token
                    return params;
                },
                source: [
                    {value: 'Passed', text: 'Passed'},
                    {value: 'Failed', text: 'Failed'},
                ], // Dropdown options for the status field
                title: 'Select status',
                success: function (response) {
                    console.log(response.message); // Log success message
                },
                error: function (error) {
                    console.log('Error:', error); // Log error
                }
            });

            $('.select2').select2({
                placeholder: "Select Course", // Changed to match your select
                allowClear: true,
                theme: "bootstrap-5",
                width: '100%'
            });


        });


    </script>

@endpush
