@php use Illuminate\Support\Facades\Storage; @endphp
@extends('layouts.main')

@section('title', 'Cohort')

@section('breadcump')
    <div class="col-sm-6">
        <h1 class="m-0">{{ __('Learners') }}</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('backend.dashboard.index') }}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item active">{{ __('Cohort') }}</li>
        </ol>
    </div>
@endsection

@push('css')
    <style>
        .send-reminder {
            background-color: #ffc107;
            border-color: #ffc107;
            color: #212529;
        }

        .send-reminder:hover {
            background-color: #e0a800;
            border-color: #d39e00;
        }
    </style>
@endpush

@section('main')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        Data course
                    </h3>
                </div>
                <div class="card-body">
                    <h1 class="callout callout-success">{{ $cohort->course->name }}
                        - {{  displayDates($cohort->start_date_time,$cohort->end_date_time)  }}
                    </h1>

                    @if($cohort->users->isEmpty())
                        <p>No users are assigned to this cohort.</p>
                    @else
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Learner</th>
                                <th>Application Form</th>
                                <th>Profile Photo</th>
                                <th>Proof of ID</th>
                                <th>Tasks</th>
                                <th>E-Learning</th>
                                <th>Reminder</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($cohort->users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>
                                        <p class="mb-0">
                                            <small><strong>Name: </strong></small>
                                            <small>{{ $user->name ?? "" }} {{ $user->last_name ?? "" }}</small>
                                        </p>

                                        <p class="mb-0">
                                            <small><strong>Email: </strong></small>
                                            <small>{{ $user->email ?? "" }}</small>
                                        </p>

                                        <p class="mb-0">
                                            <small><strong>Phone: </strong></small>
                                            <small>{{ $user->telephone ?? "" }}</small>
                                        </p>

                                        <p class="mb-0">
                                            <small><strong>Trainer: </strong></small>
                                            <small>{{ $user->cohorts->first()->trainer->name ?? "" }}</small>
                                        </p>
                                    </td>
                                    <td>
                                        @switch($user->applicationForm->status ?? "")
                                            @case('Approved')
                                                <span class="badge bg-success">Approved</span>
                                                @break

                                            @case('Rejected')
                                                <span class="badge bg-danger">Rejected</span>
                                                @break

                                            @case('In Progress')
                                                <span class="badge bg-warning">In Progress</span>
                                                @break

                                            @default
                                                <span class="badge bg-danger">Not Submitted</span>
                                        @endswitch



                                        @if(isset($user->applicationForm->learner_pdf))
                                            <p><a target="_blank"
                                                  href="{{ asset($user->applicationForm->learner_pdf) }}"
                                                  class="btn btn-primary btn-sm applicationBtnSize mt-2">View</a></p>
                                        @endif

                                    </td>
                                    <td>
                                        @switch($user->profilePhoto->status ?? "")
                                            @case('Approved')
                                                <span class="badge bg-success">Approved</span>
                                                @break

                                            @case('Rejected')
                                                <span class="badge bg-danger">Rejected</span>
                                                @break

                                            @case('In Progress')
                                                <span class="badge bg-warning">In Progress</span>
                                                @break

                                            @default
                                                <span class="badge bg-danger">Not Submitted</span>
                                        @endswitch

                                        @if(isset($user->profilePhoto->profile_photo))
                                            <p><a target="_blank" href="{{ asset($user->profilePhoto->profile_photo) }}"
                                                  class="btn btn-primary btn-sm applicationBtnSize mt-2">View</a></p>
                                        @endif

                                    </td>
                                    <td>
                                        @switch($user->documentUpload->status ?? "")
                                            @case('Approved')
                                                <span class="mb-2 badge bg-success">Approved</span>
                                                @break

                                            @case('Rejected')
                                                <span class="mb-2 badge bg-danger">Rejected</span>
                                                @break

                                            @case('In Progress')
                                                <span class="mb-2 badge bg-warning">In Progress</span>
                                                @break

                                            @default
                                                <span class="mb-2 badge bg-danger">Not Submitted</span>
                                        @endswitch


                                            @php
                                                $uploads = [
                                                    'first_front_upload',
                                                    'first_back_upload',
                                                    'second_front_upload',
                                                    'second_back_upload',
                                                    'third_front_upload',
                                                    'third_back_upload',
                                                ];
                                            @endphp

                                            @foreach ($uploads as $field)
                                                @php
                                                    $filePath = $user->documentUpload->$field ?? null;
                                                    $resolvedPath = resolveDocumentPath($filePath);
                                                @endphp

                                                @if ($resolvedPath)
                                                    <p>
                                                        <a href="{{ $resolvedPath }}"
                                                           target="_blank"
                                                           class="btn btn-primary btn-sm applicationBtnSize mb-2">View</a>
                                                    </p>
                                                @endif
                                            @endforeach



                                    </td>
                                    <td>

                                        @foreach($cohort->course->tasks as $task)
                                            @php
                                                $submission = $user->taskSubmissions->where('task_id', $task->id)
                                                ->where('cohort_id',$cohort->id)
                                                ->first();

                                                //dump($submission);

                                            @endphp

                                            <div class="mb-4 p-3 border rounded">
                                                <p><strong>Task:</strong> {{ $task->name }}</p>

                                                @if($submission)
                                                    <p>
                                                        @if($submission->comments == "")
                                                            <a href="{{ asset($submission->pdf) }}" target="_blank"
                                                               class="btn btn-primary btn-sm applicationBtnSize mb-2">View</a>


                                                            @if($task->id == "21")

{{--                                                                <a href="{{ route('backend.trainer.viewSubmission',[$user->id,$task->id,$cohort->id]) }}"--}}
{{--                                                                   class="btn btn-primary btn-sm mb-2">--}}
{{--                                                                    <i class="fas fa-pencil"></i> Edit--}}
{{--                                                                </a>--}}

                                                                <a href="#" onclick="openAndPrintPdf('{{ asset($submission->pdf) }}')"
                                                                   class="btn btn-primary btn-sm applicationBtnSize mb-2">
                                                                    <i class="fas fa-print"></i> Print
                                                                </a>
                                                            @endif


                                                        @endif

                                                        @if($submission->status != "Approved")
                                                            <a href="javascript:;" id="manually_submission"
                                                               data-task-id="{{ $submission->id }}"
                                                               class="btn btn-dark btn-sm applicationBtnSize mb-2">
                                                                Submitted Manually
                                                            </a>
                                                        @endif
                                                    </p>

                                                    @switch($submission->status ?? "")
                                                        @case('Approved')
                                                            <span class="badge bg-success">Approved
                                                                @if(!empty($submission->comments))
                                                                    <span
                                                                        class="text-gray-dark"> - {{ $submission->comments }}</span>
                                                                @endif
                                                            </span>
                                                            @break

                                                        @case('Rejected')
                                                            <span class="badge bg-danger">Rejected</span>
                                                            @break

                                                        @case('In Progress')
                                                            <span class="badge bg-warning">In Progress</span>
                                                            @break

                                                        @default
                                                            <span class="badge bg-danger">Not Submitted</span>
                                                    @endswitch

                                                @else
                                                    <span class="badge bg-danger">Not Submitted</span>


                                                    <a href="javascript:;" id="inserted_submission"
                                                       data-user-id="{{ $user->id }}"
                                                       data-task-id="{{ $task->id }}"
                                                       data-course-id="{{ $cohort->course_id }}"
                                                       data-cohort-id="{{ $cohort->id }}"
                                                       data-trainer-id="{{ $cohort->trainer_id }}"
                                                       class="btn btn-dark btn-sm applicationBtnSize mb-2">
                                                        Submitted Manually
                                                    </a>

                                                @endif
                                            </div>
                                        @endforeach


                                    </td>
                                    <td>
                                        @foreach($user->taskSubmissions as $submission)
                                            @if(is_null($submission->task_id))
                                            <div class="mb-4 p-3 border rounded">
                                                <strong>Name:</strong> {{ $submission->license->name ?? 'No License' }}
                                                <br>
                                                @switch($submission->status ?? "")
                                                    @case('Approved')
                                                        <span class="mb-2 badge bg-success">Approved</span>
                                                        @break

                                                    @case('Rejected')
                                                        <span class="mb-2 badge bg-danger">Rejected</span>
                                                        @break

                                                    @case('In Progress')
                                                        <span class="mb-2 badge bg-warning">In Progress</span>
                                                        @break

                                                    @default
                                                        <span class="mb-2 badge bg-danger">Not Submitted</span>
                                                @endswitch

                                                @php
                                                    $relatedCertificate = $user->certificates
                                                        ->where('cohort_id', $submission->cohort_id)
                                                        ->where('license_id', $submission->license_id)
                                                        ->first();
                                                @endphp


                                                @if(isset($submission->act_document))
                                                    <p>
                                                        <a href="{{ asset($submission->act_document) }}" target="_blank"
                                                           class="btn btn-primary btn-sm applicationBtnSize mb-2">View
                                                            Certificate</a>
                                                    </p>
                                                @else
                                                    @if($relatedCertificate)
                                                        @php
                                                            // Get the path from database (e.g., "learners/tahir_bashir/certificate_general_68375d4509ab6.pdf")
                                                            $dbPath = $relatedCertificate->certificate_path;

                                                            // Remove any 'storage/' prefix if present
                                                            $normalizedPath = ltrim(str_replace('storage/', '', $dbPath), '/');

                                                            // Split path into components
                                                            $pathParts = explode('/', $normalizedPath);
                                                            $directory = $pathParts[0]; // "learners"
                                                            $username = $pathParts[1];  // "tahir_bashir"
                                                            $filename = $pathParts[2];  // "certificate_general_68375d4509ab6.pdf"

                                                            // Create proper case username (e.g., "Tahir_Bashir")
                                                            $properUsername = implode('_', array_map('ucfirst', explode('_', strtolower($username))));

                                                            // Build possible storage paths
                                                            $possiblePaths = [
                                                                // Try proper case directory first
                                                                "public/{$directory}/{$properUsername}/{$filename}",
                                                                // Then try original case directory
                                                                "public/{$directory}/{$username}/{$filename}",
                                                            ];

                                                            // Find the first existing path
                                                            $foundPath = null;
                                                            foreach ($possiblePaths as $storagePath) {
                                                                if (Storage::exists($storagePath)) {
                                                                    $foundPath = str_replace('public/', 'storage/', $storagePath);
                                                                    break;
                                                                }
                                                            }
                                                        @endphp

                                                        @if($foundPath)
                                                            <p>
                                                                <a href="{{ asset($foundPath) }}" target="_blank"
                                                                   class="btn btn-primary btn-sm applicationBtnSize mb-2">
                                                                    View Certificate
                                                                </a>
                                                            </p>
                                                        @else
                                                            <p class="text-danger">Certificate file not found</p>
                                                        @endif
                                                    @endif
                                                @endif





                                            </div>

                                                @php
                                                    $externalCertificate = $user->certifications
                                                        ->filter(fn($cert) => $cert->pivot->qualification_type === 'external')
                                                        ->first();
                                                @endphp

                                                @if ($externalCertificate && $externalCertificate->pivot->course_certificate)
                                                    <div class="mb-4 p-3 border rounded">
                                                        <strong>Course-pre-requisites:</strong> External
                                                        <br>
                                                        @switch($externalCertificate->pivot->status ?? "")
                                                            @case('Approved')
                                                                <span class="mb-2 badge bg-success">Approved</span>
                                                                @break

                                                            @case('Rejected')
                                                                <span class="mb-2 badge bg-danger">Rejected</span>
                                                                @break

                                                            @case('In Progress')
                                                                <span class="mb-2 badge bg-warning">In Progress</span>
                                                                @break

                                                            @default
                                                                <span class="mb-2 badge bg-danger">Not Submitted</span>
                                                        @endswitch
                                                        <br>
                                                        <a href="{{ asset($externalCertificate->pivot->course_certificate) }}"
                                                           target="_blank"
                                                           class="btn btn-primary btn-sm applicationBtnSize mb-2">
                                                            <i class="fas fa-file-alt"></i> View Certificate
                                                        </a>
                                                    </div>
                                                @endif

                                            @endif
                                        @endforeach






                                    </td>
                                    <td>
                                        <button class="btn btn-warning btn-sm send-reminder"
                                                data-user-id="{{ $user->id }}"
                                                data-cohort-id="{{ $cohort->id }}">
                                            Send Reminder
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @endif


                </div>

            </div>
            <a href="{{ route('backend.cohorts.index') }}" class="btn btn-secondary mb-4">Back to Cohorts</a>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).on('click', '#manually_submission', function (e) {
            e.preventDefault();

            const taskId = $(this).data('task-id');

            if (confirm("Are you sure you want to approve this submission?")) {
                $.ajax({
                    url: '{{ route("backend.task-submissions.approve") }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        task_id: taskId
                    },
                    success: function (response) {
                        alert(response.message);
                        // Optionally reload or update UI
                        location.reload();
                    },
                    error: function (xhr) {
                        alert("Something went wrong. Please try again.");
                    }
                });
            }
        });


        $(document).on('click', '#inserted_submission', function (e) {
            e.preventDefault();

            const userId = $(this).data('user-id');
            const taskId = $(this).data('task-id');
            const courseId = $(this).data('course-id');
            const cohortId = $(this).data('cohort-id');
            const trainerId = $(this).data('trainer-id');


            if (confirm("Are you sure you want to approve this submission?")) {
                $.ajax({
                    url: '{{ route("backend.task-submissions.create") }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        user_id: userId,
                        task_id: taskId,
                        course_id: courseId,
                        cohort_id: cohortId,
                        trainer_: trainerId
                    },
                    success: function (response) {
                        alert(response.message);
                        // Optionally reload or update UI
                        location.reload();
                    },
                    error: function (xhr) {
                        alert("Something went wrong. Please try again.");
                    }
                });
            }
        });


        $(document).ready(function() {
            $('.send-reminder').click(function() {
                const userId = $(this).data('user-id');
                const cohortId = $(this).data('cohort-id');

                if (confirm('Are you sure you want to send a reminder to this learner?')) {
                    $.ajax({
                        url: '{{ route("backend.cohorts.sendReminder") }}',
                        method: 'POST',
                        data: {
                            user_id: userId,
                            cohort_id: cohortId,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            alert('Reminder sent successfully!');
                        },
                        error: function(xhr) {
                            alert('Error sending reminder: ' + xhr.responseText);
                        }
                    });
                }
            });
        });


        function openAndPrintPdf(pdfUrl) {
            const printWindow = window.open(pdfUrl, '_blank');
            printWindow.focus();

            // Wait for the PDF to load before printing
            printWindow.onload = function() {
                printWindow.print();
            };
        }

    </script>

@endpush
