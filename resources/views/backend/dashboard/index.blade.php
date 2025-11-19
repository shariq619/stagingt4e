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
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet"/>
    <style>
        .courseListInner {
            overflow: hidden;
            word-wrap: break-word;
        }

        .courseInfo {
            min-width: 0;
        }

    </style>
@endpush

@section('main')

    <div class="content">
        <div class="adminDashboard">
            <div class="row">
                <div class="col-lg-4 col-xl-2 col-md-4 mb-2 col-12">
                    <div class="infoBoxDashboard mb-3 mb-lg-0 mb-md-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="mb-0">Courses</h4>
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <div class="number">{{ $courses_count ?? '' }}</div>
                        <div class="d-flex align-items-center justify-content-between">
                            {{--                            <span>{{$courses_count ?? ""}}</span> --}}
                            <a href="{{ route('backend.courses.index') }}">View All</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-xl-2 col-md-4 mb-2 col-12">
                    <div class="infoBoxDashboard mb-3 mb-lg-0 mb-md-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="mb-0">Learners</h4>
                            <i class="fas fa-id-card-alt"></i>
                        </div>
                        <div class="number">{{ $learner_count ?? '' }}</div>
                        <div class="d-flex align-items-center text-right">
                            <span></span>
                            <a href="{{ route('backend.users.index') }}?search=&role=Learner&sort=desc">View All
                                Learners</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-xl-2 col-md-4 mb-2 col-12">
                    <div class="infoBoxDashboard mb-3 mb-lg-0 mb-md-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="mb-0">Trainers</h4>
                            <i class="fas fa-edit"></i>
                        </div>
                        <div class="number">{{ $trainer_count ?? '' }}</div>
                        <div class="d-flex align-items-center justify-content-between">
                            <span></span>
                            <a href="{{ route('backend.users.index') }}?search=&role=Trainer&sort=desc">Manage
                                Trainers</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-xl-2 col-md-4 mb-2 col-12">
                    <div class="infoBoxDashboard mb-3 mb-lg-0 mb-md-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="mb-0">Admins</h4>
                            <i class="fas fa-user-shield"></i>
                        </div>
                        <div class="number">{{ $admin_count ?? '' }}</div>
                        <div class="d-flex align-items-center justify-content-between">
                            <span></span>
                            <a href="{{ route('backend.users.index') }}?search=&role=Super Admin&sort=desc">Manage
                                Admins</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-xl-2 col-md-4 mb-2 col-12">
                    <div class="infoBoxDashboard mb-3 mb-lg-0 mb-md-3 position-relative">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="mb-0">Tasks</h4>
                            <i class="fas fa-file-signature"></i>
                        </div>
                        <div class="number">{{ $total_task_pending ?? '' }} Pending</div>

                        <div class="d-flex align-items-center justify-content-between">
                            <span>{{ $total_task_completed ?? '' }} completed</span>
                            <a href="javascript:;" class="pendingTask">
                                View All
                            </a>
                        </div>
                        <div class="pendingTaskHover">
                            <ul class="list-unstyled p-0 m-0">
                                <li><a href="{{ route('backend.application-forms.index') }}">Application Forms</a>
                                </li>
                                <li><a href="{{ route('backend.profile-photo.index') }}">Profile Photos</a></li>
                                <li><a href="{{ route('backend.document-uploads.index') }}">Proof Of ID</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-xl-2 col-md-4 mb-2 col-12">
                    <div class="infoBoxDashboard mb-3 mb-lg-0 mb-md-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="mb-0">My Messages </h4>
                            <i class="fas fa-comment-alt"></i>
                        </div>
                        <div class="number {{ $unreadCount > 0 ? 'text-red' : '' }}">{{ $unreadCount ?? 0 }} Unread
                        </div>
                        <div class="d-flex align-items-center justify-content-between">
                            <span>{{ $readCount ?? 0 }}</span>
                            <a href="{{ route('backend.messages.index') }}">View All</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-xl-3 col-md-6 mb-2 col-12">
                    <div class="cohortBoxes mb-3 mb-lg-0 mb-md-3 bg-light-green">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="leftInfo">
                                <h6 class="infoBox-subtitle">Upcoming Courses/Cohorts</h6>
                                <div class="infoBox-title">Self Study Reports</div>
                            </div>
                            <div class="rightInfo">
                                <i class="fas fa-search d-block text-right"></i>
                                <a href="{{ route('backend.admin.self.study') }}">View Progress</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-3 col-md-6 mb-2 col-12">
                    <div class="cohortBoxes mb-3 mb-lg-0 mb-md-3 bg-light-pink">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="leftInfo">
                                <h6 class="infoBox-subtitle">Completed Courses/Cohorts</h6>
                                <div class="infoBox-title">Grade Learners</div>
                            </div>
                            <div class="rightInfo">
                                <i class="fas fa-user-check d-block text-right"></i>
                                <a href="{{ route('backend.admin.grade.learner') }}">Process Results</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-3 col-md-6 mb-2 col-12">
                    <div class="cohortBoxes mb-3 mb-lg-0 mb-md-3 bg-gradient-dark">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="leftInfo">
                                <h6 class="infoBox-subtitle">E-Learning</h6>
                                <div class="infoBox-title">Certificates</div>
                            </div>
                            <div class="rightInfo">
                                <i class="fas fa-certificate d-block text-right"></i>
                                <a href="{{ route('backend.admin.learner.certificate') }}" class="text-white">View</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-3 col-md-6 mb-2 col-12">
                    <div class="cohortBoxes mb-3 mb-lg-0 mb-md-3 bg-light-blue">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="leftInfo">
                                <h6 class="infoBox-subtitle">Data Visualisation</h6>
                                <div class="infoBox-title">Reports</div>
                            </div>
                            <div class="rightInfo">
                                <i class="fas fa-chart-bar d-block text-right"></i>
                                <a href="javascript:">Generate
                                    Reports</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-xl-4 col-md-12 col-12">
                    <div class="eLarningCourse boxShadowBorder">

                        {{-- SCORM CLOUD SECTION --}}
                        <div class="courseListInfo courseBorder">
                            <h4>Scorm Cloud</h4>
                        </div>
                        <div
                            class="eLaerningBoxes d-flex align-items-center flex-column flex-lg-column-reverse flex-md-column-reverse">
                            <div class="eLaerningBoxeInner w-100">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="boxBorder">
                                        <span>Total Limit</span>
                                        <span>{{ $scorm['total_registration_limit'] ?? '' }}</span>
                                    </div>
                                    <div class="boxBorder">
                                        <span>Used</span>
                                        <span>{{ $scorm['used_registrations'] ?? '' }}</span>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="boxBorder" style="background: #dfedd6;">
                                        <span>Available</span>
                                        <span>{{ $scorm['remaining'] ?? '' }}</span>
                                    </div>
                                    <div class="boxBorder" style="background: #ffdad8;">
                                        <span>Cycle</span>
                                        <span>
                                            {{ \Carbon\Carbon::parse($scorm['cycle_start'])->format('d M') }}
                                            →
                                            {{ \Carbon\Carbon::parse($scorm['cycle_end'])->format('d M') }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>


                        {{-- QUALIFICATIONS SECTION --}}
                        <div class="courseListInfo courseBorder mt-4">
                            <h4>Qualifications</h4>
                        </div>

                        <table class="table table-bordered table-striped">
                            <thead style="background: #f2f9ff;">
                            <tr>
                                <th>Qualification Name</th>
                                <th>Remaining Registrations</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($qualifications as $q)
                                <tr>
                                    <td>
                                        {{ $q->qualification_name }}
                                    </td>
                                    <td>
                                        <a href="#" class="x-editable"
                                           data-type="number"
                                           data-pk="{{ $q->id }}"
                                           data-name="remaining_registrations"
                                           data-url="{{ route('backend.highfield.update') }}">
                                            {{ $q->remaining_registrations }}
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>


                        {{--                        <div class="courseListInfo courseBorder">--}}
                        {{--                            <h4>E-learning Licenses</h4>--}}
                        {{--                        </div>--}}
                        {{--                        <div--}}
                        {{--                            class="eLaerningBoxes d-flex align-items-center flex-column flex-lg-column-reverse flex-md-column-reverse">--}}
                        {{--                            <div class="eLaerningBoxeInner w-100">--}}
                        {{--                                <div class="d-flex align-items-center justify-content-between">--}}
                        {{--                                    <div class="boxBorder">--}}
                        {{--                                        <span>All Licences</span>--}}
                        {{--                                        <span>{{ $total_license ?? '' }}</span>--}}
                        {{--                                    </div>--}}
                        {{--                                    <div class="boxBorder">--}}
                        {{--                                        <span>Active</span>--}}
                        {{--                                        <span>{{ $total_license ?? '' }}</span>--}}
                        {{--                                    </div>--}}
                        {{--                                </div>--}}
                        {{--                                <div class="d-flex align-items-center justify-content-between">--}}
                        {{--                                    <div class="boxBorder" style="background: #dfedd6;">--}}
                        {{--                                        <span>Available</span>--}}
                        {{--                                        <span>{{ $total_license ?? '' }}</span>--}}
                        {{--                                    </div>--}}
                        {{--                                    <div class="boxBorder" style="background: #ffdad8;">--}}
                        {{--                                        <span>Expired</span>--}}
                        {{--                                        <span>{{ $total_license ?? '' }}</span>--}}
                        {{--                                    </div>--}}
                        {{--                                </div>--}}
                        {{--                            </div>--}}
                        {{--                            <div class="w-100">--}}
                        {{--                                <a href="{{ route('backend.elearning_licences.index') }}">View available licences</a>--}}
                        {{--                                <a href="{{ route('backend.elearning_licences.index') }}">Purchase additional--}}
                        {{--                                    licences</a>--}}
                        {{--                                <a href="{{ route('backend.elearning_licences.index') }}">Assign a licence to a new or--}}
                        {{--                                    existing user</a>--}}
                        {{--                                <a href="{{ route('backend.elearning_licences.index') }}">View details of your--}}
                        {{--                                    licences</a>--}}
                        {{--                                <a href="{{ route('backend.elearning_licences.index') }}">View available e-learning--}}
                        {{--                                    courses</a>--}}
                        {{--                                <a href="{{ route('backend.elearning_licences.index') }}">View expired licences</a>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}
                    </div>
                    <div class="upcomingCourse boxShadowBorder">
                        <div class="courseList">
                            <div class="courseListInfo d-flex align-items-center justify-content-between courseBorder">
                                <h4>Upcoming Courses</h4>
                                <a href="{{ route('backend.cohorts.index') }}">View All Courses</a>
                            </div>
                            @forelse($cohorts as $cohort)
                                @if ($cohort->course)
                                    <div class="courseListInner">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="courseName"
                                                 style="background: {{ $cohort->course->color_code ?? 777 }}">
                                                {{ getAcronym($cohort->course->name) }}</div>
                                            <!-- Display acronym -->
                                            <div class="courseInfo">
                                                <h4 class="m-0">{{ $cohort->course->name ?? '' }}</h4>
                                                <p class="m-0">
                                                    {{ isset($cohort->start_date_time) ? \Carbon\Carbon::parse($cohort->start_date_time)->format('d F, Y, h:i A') : 'N/A' }}
                                                    -
                                                    {{ isset($cohort->end_date_time) ? \Carbon\Carbon::parse($cohort->end_date_time)->format('d F, Y, h:i A') : 'N/A' }}
                                                </p>
                                            </div>
                                            <div class="courseDate">
                                                <p class="m-0">{{ $cohort->users_count }}
                                                    / {{ $cohort->max_learner }}</p>
                                                <p class="m-0">learners</p>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @empty
                                <div class="courseListInner">
                                    No trainers found.
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-4 col-md-12 col-12">
                    <div class="activeTrainer">
                        <div class="courseList boxShadowBorder">
                            <div class="courseListInfo d-flex align-items-center justify-content-between courseBorder">
                                <h4>Active Trainers</h4>
                                <a href="{{ route('backend.users.index') }}?search=&role=Trainer&sort=desc">View All
                                    Trainers</a>
                            </div>
                            @forelse($trainers as $trainer)
                                <div class="courseListInner py-2 px-2 border-bottom">
                                    <div class="d-flex align-items-center">
                                        @if ($trainer->image == null)
                                            <div class="courseName me-3">
                                                <i class="fas fa-user fa-2x"></i>
                                            </div>
                                        @else
                                            <div class="courseName me-3">
                                                <img src="{{ asset($trainer->image) }}" alt="Trainer Image"
                                                     class="img-thumbnail rounded-circle"
                                                     style="width: 40px; height: 40px; object-fit: cover;">
                                            </div>
                                        @endif

                                        <div class="courseInfo w-100">
                                            <h4 class="m-0" style="font-size: 16px;">{{ $trainer->name }}</h4>

                                            @php
                                                $uniqueCourses = $trainer->trainerCohorts
                                                    ->pluck('course.name')
                                                    ->filter()
                                                    ->unique()
                                                    ->take(100);
                                            @endphp

                                            <div class="mt-1">
                                                @forelse($uniqueCourses as $courseName)
                                                    <span class="badge bg-primary me-1 mb-1">{{ $courseName }}</span>
                                                @empty
                                                    <span class="text-muted">No courses assigned</span>
                                                @endforelse
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @empty
                                <div class="courseListInner">
                                    No trainers found.
                                </div>
                            @endforelse
                        </div>
                        <div class="courseList boxShadowBorder">
                            <div class="courseListInfo d-flex align-items-center justify-content-between courseBorder">
                                <h4>Recent Corporate Clients</h4>
                                <a href="{{ route('backend.users.index') }}?search=&role=Corporate Client&sort=desc">View
                                    All Clients</a>
                            </div>

                            @forelse($clients as $client)
                                <div class="courseListInner">
                                    <div class="d-flex align-items-center"> <!--justify-content-between-->
                                        <div class="courseName"><i class="fas fa-user"></i></div>
                                        <div class="courseInfo">
                                            <h4 class="m-0">{{ $client->name ?? '' }}</h4>
                                            {{--                                            <p class="m-0">Finance</p> --}}
                                        </div>
                                    </div>
                                </div>
                            @empty
                            @endforelse
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-4 col-md-12 col-12">
                    <div class="notification boxShadowBorder">
                        <div class="courseListInfo d-flex align-items-center justify-content-between courseBorder">
                            <h4>Notifications</h4>
                            <a href="{{ route('backend.notifications.index') }}">View All Notifications</a>
                        </div>
                        <ul class="list-group list-group-flush">
                            @forelse($notifications as $notification)
                                <li class="list-group-item">
                                    <div class="notifyInner d-flex align-items-center justify-content-between">
                                        <div class="infoDetail">
                                            <p class="m-0"><strong>Title:</strong> {{ $notification->data['message'] }}
                                            </p>
                                            <p class="m-0"><strong>Date,
                                                    Time:</strong> {{ $notification->created_at->diffForHumans() }}</p>
                                        </div>
                                        <a href="{{ $notification->data['task_url'] ?? '' }}"
                                           class="btn btn-sm btn-danger">View</a>
                                    </div>
                                </li>
                            @empty
                                <li class="list-group-item">
                                    <div class="notifyInner d-flex align-items-center justify-content-between">
                                        No notifications found.
                                    </div>
                                </li>
                            @endforelse

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('css')
    <style>
        .pendingTaskHover {
            position: absolute;
            background: #343a40;
            right: 0;
            z-index: 9;
            width: 100%;
            padding: 5px 10px;
        }

        .pendingTaskHover ul li a {
            color: #fff;
        }

        .pendingTaskHover ul li:hover {
            background: #fff;
        }

        .pendingTaskHover ul li:hover a {
            color: #000;
        }

        .pendingTaskHover {
            display: none;
        }

        .cohortBoxes {
            box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
            padding: 30px 20px;
            border-radius: 10px;
            height: 100%;
        }

        .cohortBoxes .infoBox-title {
            font-size: 19px;
            font-weight: 900;
        }

        .cohortBoxes .rightInfo {
            flex-basis: 35%;
            text-align: right;
        }

        .cohortBoxes .leftInfo {
            flex-basis: 65%;
        }

        .cohortBoxes .rightInfo a {
            font-size: 13px;
            color: #000;
        }

        .cohortBoxes .rightInfo i {
            font-size: 29px;
            margin-bottom: 17px;
        }

        .bg-light-green {
            background: #cbe8ba;
        }

        .bg-light-pink {
            background: #fad2e0;
        }

        .cohortBoxes.bg-light-blue {
            background: #bce8f1;
        }

        .eLarningCourse {
            padding: 20px 10px;
            border-radius: 10px;
            box-shadow: #77777757 0px 4px 10px 0px;
            margin-top: 20px;
        }

        .eLaerningBoxes .eLaerningBoxeInner {
            flex-basis: 60%;
        }

        .eLarningCourse .eLaerningBoxes a {
            font-size: 16px;
            display: block;
        }

        .eLarningCourse .eLaerningBoxes .boxBorder span {
            font-size: 14px;
        }

        .eLaerningBoxes .eLaerningBoxeInner ~ div {
            flex-basis: 40%;
        }

        .eLaerningBoxeInner .boxBorder {
            border: solid 1px;
            padding: 5px 10px;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .boxBorder {
            flex: 1;
            margin-right: 10px;
            display: flex;
            justify-content: space-between;
        }

        .notifyInner button {
            border: solid 1px #000;
        }

        .notification .courseListInfo {
            border-bottom: solid 1px #cccc;
            padding-bottom: 10px;
        }

        .notification ul li p {
            font-size: 16px;
        }

        .notification {
            padding: 20px 10px;
            border-radius: 10px;
            box-shadow: #77777757 0px 4px 10px 0px;
            margin-top: 20px;
        }

        .notification .courseListInfo h4 {
            font-size: 20px;
            color: #343a40;
            font-weight: 600;
        }

        .notification .courseListInfo a {
            font-size: 16px;
        }

        .activeTrainer .courseListInner .courseDate > .text-right ~ div {
            font-size: 16px;
        }

        .activeTrainer .success {
            background: #dfedd6;
            padding: 2px 10px;
            border: solid 1px #000;
            font-weight: 600;
        }

        .activeTrainer .warning {
            background: #f0dfb5;
            padding: 2px 10px;
            border: solid 1px #000;
            font-weight: 600;
        }

        .activeTrainer .courseName {
            background: transparent !important;
            border: solid 2px #343a40;
        }

        .activeTrainer .courseName i {
            color: #343a40;
        }

        .activeTrainer .courseList {
            padding: 20px 10px;
            border-radius: 10px;
            box-shadow: #77777757 0px 4px 10px 0px;
            margin-top: 20px;
        }

        .activeTrainer .courseList h4 {
            font-size: 18px;
            color: #343a40;
            font-weight: 600;
        }

        .activeTrainer .courseList a {
            font-size: 16px;
        }


        .adminDashboard {
            padding-bottom: 50px;
        }


        .courseListInner .courseInfo h4 {
            font-size: 17px;
            font-weight: 700;
        }

        .courseListInner .courseName {
            background: #777;
            height: 40px;
            min-width: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            border-radius: 100%;
            margin-right: 10px;
        }

        .courseListInner .courseInfo p {
            color: #777;
            font-size: 16px;
        }

        .courseListInner .courseDate > p {
            font-size: 16px;
            color: #343a40;
        }

        .courseListInner .courseDate > p ~ p {
            color: #777;
        }

        .courseListInner {
            background: #f7f7f7;
            border: solid 1.5px #e6e6e6;
            border-radius: 10px;
            padding: 4px 4px;
            margin-bottom: 10px;
        }

        .activeCourse {
            margin-top: 20px;
            background: #cbe8ba;
            padding: 20px;
            height: 100px;
            border-radius: 10px;
            box-shadow: #77777761 0px 10px 10px 0px;
        }

        .deactiveCourse {
            background: #ffc3ae;
            padding: 20px;
            height: 100px;
            border-radius: 10px;
            box-shadow: #77777761 0px 10px 10px 0px;
            margin-top: 20px;
        }

        .adminDashboard .infoBoxDashboard h4 {
            font-size: 17px;
            font-weight: 700;
            color: #343a40;
        }

        .adminDashboard .infoBoxDashboard i {
            color: #343a40;
            font-size: 22px;
        }

        .infoBoxDashboard .number {
            font-size: 18px;
            font-weight: 700;
            color: #343a40;
            margin: 8px 0px;
        }

        .infoBoxDashboard span {
            font-size: 16px;
            color: #777;
        }

        .infoBoxDashboard a {
            font-size: 16px;
            color: #777;
        }

        @media (max-width: 767px) {
            .eLaerningBoxes .eLaerningBoxeInner {
                flex-basis: 100%;
                width: 100%;
            }

            .eLaerningBoxes .eLaerningBoxeInner ~ div {
                flex-basis: 100%;
                width: 100%;
            }
        }

        @media (max-width: 1499px) {
            .eLarningCourse .eLaerningBoxes a {
                font-size: 13px;
            }

            .eLarningCourse .eLaerningBoxes .boxBorder span {
                font-size: 13px;
            }

            .notification ul li p {
                font-size: 13px;
            }

            .notification .courseListInfo a {
                font-size: 13px;
            }

            .activeTrainer .courseListInner .courseDate > .text-right ~ div {
                font-size: 13px;
            }

            .activeTrainer .courseList a {
                font-size: 13px;
            }

            .upcomingCourse .courseListInfo a {
                font-size: 13px;
            }

            .courseListInner .courseInfo p {
                color: #777;
                font-size: 13px;
            }

            .courseListInner .courseDate > p {
                font-size: 13px;
                color: #343a40;
            }

            .infoBoxDashboard .number {
                font-size: 18px;
                font-weight: 700;
                color: #343a40;
                margin: 8px 0px;
            }

            .infoBoxDashboard span {
                font-size: 12px;
                color: #777;
            }

            .infoBoxDashboard a {
                font-size: 13px;
                color: #777;
            }
        }

        @media (max-width: 1169px) {
        }

        @media (max-width: 991px) {
        }

        @media (max-width: 767px) {
        }

        @media (max-width: 479px) {
        }
    </style>
@endpush

@push('js')

    <link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css"
          rel="stylesheet"/>
    <script
        src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>


    <script>
        $(document).ready(function () {
            $(".pendingTask").click(function (event) {
                event.stopPropagation();
                $(".pendingTaskHover").toggle();
            });

            $(document).click(function (event) {
                if (!$(event.target).closest(".pendingTask, .pendingTaskHover").length) {
                    $(".pendingTaskHover").fadeOut();
                }
            });
        });


        $(document).ready(function () {
            $.fn.editable.defaults.mode = 'inline';
            $('.x-editable').editable({
                ajaxOptions: {
                    type: 'post',
                    dataType: 'json'
                },
                params: function (params) {
                    params._token = '{{ csrf_token() }}';
                    return params;
                }
            });
        });


    </script>

    <script src="{{ asset('js/main.js') }}"></script>
    <script>
        $(document).ready(function () {
            $(document).on('click', '.pagination a', function (e) {
                e.preventDefault();
                var url = $(this).attr('href');
                getCourses(url);
            });

            function getCourses(url) {
                $.ajax({
                    url: url,
                    type: 'GET',
                    beforeSend: function () {
                        $('#courses-table').html('Loading...');
                    },
                    success: function (data) {
                        $('#courses-table').html(data);
                    },
                    error: function (xhr) {
                        console.log('AJAX request failed:', xhr);
                    }
                });
            }
        });
    </script>
@endpush
