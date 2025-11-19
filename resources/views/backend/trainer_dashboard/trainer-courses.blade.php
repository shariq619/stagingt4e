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

    <link href="{{ asset('css/app.css') }}" rel="stylesheet"/>
    <link href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet"/>
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet"/>
    <style>
        .section-heading {
            border: 2px solid #ccc;
            padding: 10px;
            color: #333;
            background-color: #f8f9fa;
            margin-bottom: 15px;
        }

        .course-list {
            margin-bottom: 30px;
        }
    </style>
@endpush

@section('main')

    <div class="content">
        <!-- My Courses -->
        <div class="row align-items-start" id="trainer-my-courses">



            <div class="col-md-8 col-12">
                <div class="filter-section mb-4">
                    <form action="{{ route('backend.trainer.my.courses') }}" method="GET">
                        <div class="row">

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="course">Course</label>
                                    <select name="course" id="course" class="form-control">
                                        <option value="">Select Course</option>
                                        @foreach($courses as $course)
                                            <option value="{{ $course->id }}" {{ request('course') == $course->id ? 'selected' : '' }}>
                                                {{ $course->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                            <div class="col-md-2">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary mt-4">Filter</button>
                                    <!-- Reset Button -->
                                    <a href="{{ route('backend.trainer.my.courses') }}"
                                       class="btn btn-secondary mt-4">Reset</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-md-8 col-12">
                <div class="otsTask mt-4 p-4 h-100 tableShadow">
                    <div class="otsTaskInner">
                        <div class="taskHeading d-flex align-items-center mb-4">
                            <i class="fas fa-graduation-cap mr-3"></i>
                            <h4 class="m-0">My Courses</h4>
                        </div>
                        <div class="otstaskData trainer-my-courses tableSticky">
                            <table class="otsDataTable table table-bordered">
                                <thead>
                                <tr>
                                    <th class="sticky">Course Name</th>
                                    <th>Risk Assessment </th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Location</th>
                                    <th>Lesson Plan</th>
                                    <th>Learners</th>
                                    <th>Course Status</th>
                                    <th>Pass Rate</th>
                                    <th>Invoice</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($assignedCohort as $cohort)
                                    <tr>
                                        <td class="sticky">{{ $cohort->course->name }}</td>
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
                                        <td>{{ \Carbon\Carbon::parse($cohort->start_date_time)->format('d M, Y, g:i A') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($cohort->end_date_time)->format('d M, Y, g:i A') }}</td>
                                        <td>{{ optional($cohort->venue)->venue_name }}</td>


                                        <td>
                                            @if($cohort->lesson_plan)
                                                <a href="{{ asset('storage/' . $cohort->lesson_plan) }}" target="_blank"
                                                   class="btn btn-success">View</a>
                                            @else
                                                <a href="javascript:void(0)" class="btn btn-danger btn-sm uploadBtn"
                                                   data-cohortid="{{$cohort->id}}"
                                                   data-coursename="{{$cohort->course->name}}">Upload</a>
                                            @endif
                                        </td>

                                        <td>{{ $cohort->max_learner   }}</td>
                                        <td>
                                            @switch($cohort->status ?? "")
                                                @case('Complete')
                                                    <span class="badge">Complete</span>
                                                    @break
                                                @case('Cancelled')
                                                    <span class="badge" >Cancelled</span>
                                                    @break
                                                @case('Confirmed')
                                                    <span class="badge">Confirmed</span>
                                                    @break
                                                @default
                                                    <span class="badge">Confirmed</span>
                                            @endswitch
                                        </td>
                                        <td>
                                            <!-- Pass Rate Progress Bar (50%) -->
                                            <div class="progress" style="height: 20px;">
                                                <div class="progress-bar bg-success btn-sm" role="progressbar"
                                                     style="width: 70%;" aria-valuenow="70"
                                                     aria-valuemin="0"
                                                     aria-valuemax="100">70%
                                                </div>
                                            </div>
                                        </td>
                                        @if($cohort->invoice)
                                            <td><a href="{{ asset('storage/' . $cohort->invoice) }}"
                                                   class="btn btn-success btn-sm" target="_blank">View</a></td>
                                        @else
                                            <td><a href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                   data-bs-target="#uploadInvoiceModal"
                                                   data-cohort-id="{{ $cohort->id }}"
                                                   data-course-name="{{ $cohort->course->name }}">Upload</a></td>
                                        @endif
                                    </tr>

                                @empty
                                    <tr>
                                        <td colspan="6">No data available</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>


                            <div class="d-flex justify-content-center">
                                {{ $assignedCohort->links() }} <!-- Display pagination links -->
                            </div>


                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-12">
                <div class="otsTaskChart mt-4 p-4 h-100 tableShadow">
                    <div class="otsTaskInner">
                        <div class="taskHeading d-flex align-items-center mb-4">
                            <i class="fa fa-tasks mr-3"></i>
                            <h4 class="m-0">Qualification Specifications</h4>
                        </div>
                        <div class="otstaskData">
                            <div class="">
                                <!-- Security Section -->
                                <div class="course-list">
                                    <h3 class="section-heading bg-cyan">Security</h3>
                                    <ul class="list-group">
                                        <li class="list-group-item px-2">Highfield Level 2 Award for Door Supervisors in the
                                            Private Security Industry
                                        </li>
                                        <li class="list-group-item px-1">Highfield Level 2 Award for Personal Licence
                                            Holders
                                        </li>
                                        <li class="list-group-item px-1">Highfield Level 2 Award for CCTV Operators (Public
                                            Space Surveillance) in the Private Security Industry
                                        </li>
                                        <li class="list-group-item px-1">Highfield Level 2 Award for Door Supervisors in the
                                            Private Security Industry (Top Up)
                                        </li>
                                        <li class="list-group-item px-1">Highfield Level 2 Award for Security Officers in the
                                            Private Security Industry (Top Up)
                                        </li>
                                    </ul>
                                </div>

                                <!-- First Aid Section -->
                                <div class="course-list">
                                    <h3 class="section-heading bg-success">First Aid</h3>
                                    <ul class="list-group">
                                        <li class="list-group-item px-1">Highfield Level 3 Award in First Aid at Work</li>
                                        <li class="list-group-item px-1">Highfield Level 3 Award in Emergency First Aid at
                                            Work
                                        </li>
                                        <li class="list-group-item px-1">Highfield Level 3 Award in Paediatric First Aid</li>
                                        <li class="list-group-item px-1">Highfield Level 3 Award in Emergency Paediatric
                                            First Aid
                                        </li>
                                    </ul>
                                </div>

                                <!-- Construction Section -->
                                <div class="course-list">
                                    <h3 class="section-heading bg-yellow">Construction</h3>
                                    <ul class="list-group">
                                        <li class="list-group-item px-1">Highfield Level 1 Award in Health and Safety within
                                            a Construction Environment
                                        </li>

                                        <li class="list-group-item px-1">CITB Health and Safety Awareness (HSA)</li>

                                        <li class="list-group-item px-1">CITB Site Supervision Safety Training Scheme
                                            (SSSTS)
                                        </li>

                                        <li class="list-group-item px-1">CITB Site Supervision Safety Training Scheme
                                            Refresher (SSSTS-R)
                                        </li>

                                        <li class="list-group-item px-1">CITB Site Management Safety Training Scheme
                                            (SMSTS)
                                        </li>

                                        <li class="list-group-item px-1">CITB Site Management Safety Training Scheme
                                            Refresher (SMSTS-R)
                                        </li>
                                    </ul>
                                </div>

                                <!-- Fire Safety Section -->
                                <div class="course-list">
                                    <h3 class="section-heading bg-danger">Fire Safety</h3>
                                    <ul class="list-group">
                                        <li class="list-group-item px-1">Highfield Level 2 Award in the Principles of Fire
                                            Safety
                                        </li>
                                        <li class="list-group-item px-1">Highfield Level 1 Award in the Principles of Fire
                                            Safety Awareness
                                        </li>
                                    </ul>
                                </div>

                                <!-- Licensing Section -->
                                <div class="course-list">
                                    <h3 class="section-heading bg-orange">Licensing</h3>
                                    <ul class="list-group">
                                        <li class="list-group-item px-1">Highfield Level 2 Award for Personal Licence
                                            Holders
                                        </li>
                                    </ul>
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

@endpush
