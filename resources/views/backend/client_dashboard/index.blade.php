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

@section('main')
    <div class="row">
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="dash-card h-100 card-sky">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="mb-0 font-weight-bold"><i class="fa fa-search mr-2"></i>Recently Booked Courses</h6>
                    <a href="#" class="btn btn-chip btn-chip-success">View Progress</a>
                </div>
                <div class="inner">
                    <p class="mb-3 text-black font-weight-600">Self Study Reports</p>
                    <div class="row no-gutters">
                        <div class="col-6 pr-2">
                            <div class="mini-box">
                                <div class="mini-label">Enrolled</div>
                                <div class="mini-num">28</div>
                            </div>
                        </div>
                        <div class="col-6 pl-2">
                            <div class="mini-box">
                                <div class="mini-label">Completed</div>
                                <div class="mini-num">16</div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-3">
                        <div class="d-flex justify-content-between small text-muted mb-1">
                            <span>Progress</span><span>57%</span>
                        </div>
                        <div class="progress progress-slim">
                            <div class="progress-bar bg-dark" style="width:57%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 mb-4">
            <div class="dash-card h-100 card-lilac">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="mb-0 font-weight-bold"><i class="far fa-check-circle mr-2"></i>Courses/Cohorts</h6>
                </div>

                <div class="inner p-0">
                    <ul class="list-unstyled mb-0">
                        @forelse($recentCohorts as $cohort)
                            <li class="list-item-row">
                                <span>{{ $cohort->course->name ?? "No course" }} <br>{{ formatCourseDate($cohort) }}</span>
                                <span class="badge badge-soft-success">{{ $cohort->status }}</span>
                            </li>
                        @empty
                            No cohorts assigned
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-12 mb-4">
            <div class="dash-card h-100 card-blue">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="mb-0 font-weight-bold"><i class="fa fa-graduation-cap mr-2"></i>E-Learning</h6>
                    {{--<a href="#" class="btn btn-chip btn-chip-primary">View</a>--}}
                </div>

                <div class="inner">
                    <p class="mb-3 text-black font-weight-600">Certificate</p>
                    @forelse($client_learners as $learner)
                        @php
                            $actCertificates = collect();
                            foreach ($learner->cohorts as $cohort) {
                                $act_document = $cohort
                                ->taskSubmissions->where('user_id', $learner->id)
                                ->filter(function ($submission) {
                                    return !is_null($submission->act_document);
                                });
                                $actCertificates = $actCertificates->merge($act_document);
                            }

                        @endphp
                        @foreach ($actCertificates as $acts)
                            @if (isset($acts['act_document']))
                                <div class="doc-row">
                                    <span class="doc-icon"><i class="far fa-file-alt"></i></span>
                                    <div>
                                        <a href="{{ asset($acts['act_document']) }}"
                                           class="doc-title">{{ $acts->license->name ?? "" }}</a>

                                        <div class="doc-sub">{{ $learner->name }}</div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @empty
                    @endforelse
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4 col-md-6 col-12 mb-4">
            <div class="card p-3 notifi_card h-100">
                <div class="d-flex align-items-center justify-content-between py-3">
                    <div class="notifi_head"><i class="far fa-bell me-2"></i> <strong>Notifications</strong></div>
                    <div class="notifi_view_all">
                        <a href="{{ route('backend.notifications.index') }}" class="text-capitalize">View all
                            notifications</a>
                    </div>
                </div>
                <ul class="list-unstyled p-0 m-0 notifi_list">
                </ul>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-12 mb-4">
            <div class="card p-3 progress_card h-100">
                <div class="d-flex align-items-center justify-content-between py-3">
                    <div class="progress_head"><strong>Recently Booked Delegates</strong></div>
                </div>
                <ul class="list-unstyled p-0 m-0 progress_list">
                    @forelse($client_learners as $learner)
                        <li class="mb-3 list-item d-flex align-items-end justify-content-between">

                            @if($learner->profilePhoto && $learner->profilePhoto->profile_photo && $learner->profilePhoto->status === 'Approved')

                                <div class="image">
                                    <img src="{{ asset($learner->profilePhoto->profile_photo) }}" width="42" height="42"
                                         class="img-circle elevation-2" alt="{{ $learner->name }}">
                                </div>
                            @else
                                <div class="image">
                                    <img src="{{ asset('frontend/demoImg/plceImg.png') }}"
                                         class="img-circle elevation-2" alt="{{ $learner->name }}">
                                </div>
                            @endif

                            <div class="progress_bar w-100">
                                <h6 class="mb-0"><strong>{{ $learner->name }} {{ $learner->last_name }}</strong></h6>
                                <div class="progress_bar_inner">
                                    <div class="progress progress-slim">
                                        <div class="progress-bar progressGrd1" style="width:100%"></div>
                                    </div>
                                    {{--                                <a href="javascript:;" class="d-block progress_bar_btn">View All</a>--}}
                                </div>
                            </div>
                        </li>
                    @empty
                        <li class="mb-3 list-item d-flex align-items-end justify-content-between">
                            <img src="{{ asset('frontend/demoImg/plceImg.png') }}" class="img-fluid mr-3" alt="">
                            <div class="progress_bar w-100">
                                No Delegates available.
                            </div>
                        </li>
                    @endforelse
                </ul>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-12 mb-4"></div>
    </div>
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card shadow-sm bg_delegate1 h-100">
                <div class="card-body delegates_box">
                    <div class="d-flex justify-content-between">
                        <h6>Total Delegates</h6>
                        <img src="{{ asset('frontend/demoImg/ic1.png') }}" class="img-fluid card__img" alt="">
                    </div>
                    <h4 class="font-weight-bold">{{$client_learners_count ?? ""}}</h4>
                    {{--<small class="text-success"><span class="delegates_count">+2</span> this week</small>--}}
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm bg_delegate2 h-100">
                <div class="card-body delegates_box">
                    <div class="d-flex justify-content-between">
                        <h6>Active Courses</h6>
                        <img src="{{ asset('frontend/demoImg/ic2.png') }}" class="img-fluid card__img" alt="">
                    </div>
                    <h4 class="font-weight-bold">{{ $activeCourses }}</h4>
                    {{--<small class="text-info"><span class="delegates_count">+3</span> Starting this month</small>--}}
                </div>
            </div>
        </div>

        @php


            $actCertificates = collect();
              foreach ($learner->cohorts as $cohort) {
                  $act_document = $cohort->taskSubmissions->filter(function ($submission) {
                      return !is_null($submission->act_document);
                  });
                  $actCertificates = $actCertificates->merge($act_document);
              }



              $normalCertificates = collect();
              foreach ($learner->cohorts as $cohort) {
                  $normalCertificates = $normalCertificates->merge($cohort->certificates);
              }

                $highfieldCertificates = collect();
                foreach ($learner->cohorts as $cohort) {
                    $certs = $cohort->highFieldCertificates()
                        ->where('user_id', $learner->id) // now filtering in DB
                        ->get();
                    $highfieldCertificates = $highfieldCertificates->merge($certs);
                }

              $totalCertificates =
                  $actCertificates->count() +
                  $normalCertificates->count() +
                  $highfieldCertificates->count();



        @endphp

        <div class="col-md-4">
            <div class="card shadow-sm bg_delegate3 h-100">
                <div class="card-body delegates_box">
                    <div class="d-flex justify-content-between">
                        <h6>Certificates Issued</h6>
                        <img src="{{ asset('frontend/demoImg/ic3.png') }}" class="img-fluid card__img" alt="">
                    </div>
                    <h4 class="font-weight-bold">{{ $totalCertificates ?? "" }}</h4>
                    {{--<small class="text-success"><span class="delegates_count">+7</span> this month</small>--}}
                </div>
            </div>
        </div>
    </div>
    <div class="card shadow-sm mb-4" style="background:#edf1f5;">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <div class="tabtTop">
                    <h4 class="card-title">Delegates Progress</h4>
                    <p>Manage delegates and their course progress</p>
                </div>
                <div class="card-tools searchBox">
                    <div class="input-group input-group-sm" style="width: 150px;">
                        <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                        <div class="input-group-append">
                            <button type="submit" class="btn btn-default">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>

            </div>
            <div class="tabsWrapper">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="home-tab" data-toggle="tab" data-target="#home"
                                type="button" role="tab" aria-controls="home" aria-selected="true">All Delegates
                        </button>
                    </li>
                    {{--                    <li class="nav-item" role="presentation">--}}
                    {{--                        <button class="nav-link" id="profile-tab" data-toggle="tab" data-target="#profile"--}}
                    {{--                                type="button" role="tab" aria-controls="profile" aria-selected="false">Active--}}
                    {{--                        </button>--}}
                    {{--                    </li>--}}
                    {{--                    <li class="nav-item" role="presentation">--}}
                    {{--                        <button class="nav-link" id="contact-tab" data-toggle="tab" data-target="#contact"--}}
                    {{--                                type="button" role="tab" aria-controls="contact" aria-selected="false">Completed--}}
                    {{--                        </button>--}}
                    {{--                    </li>--}}
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                <tr>
                                    <th>Course</th>
                                    <th>Delegate's Name</th>
                                    <th>Course Start Date, Time</th>
                                    <th>Certificates</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($client_learners as $learner)
                                    <tr>
                                        <td>
                                            <p class="m-0 text-black">
                                                @if($learner->cohorts->isNotEmpty())
                                                    @foreach($learner->cohorts as $cohort)
                                                        {{ $cohort->course->name ?? "No course" }}<br>
                                                    @endforeach
                                                @else
                                                    No cohort assigned
                                                @endif
                                            </p>
                                            {{--                                            <p class="m-0">--}}
                                            {{--                                                <span class="badge badge-soft-success">Done</span>--}}
                                            {{--                                                <span class="pl-2">70% complete</span>--}}
                                            {{--                                            </p>--}}
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <p class="textImg">
                                                    J
                                                </p>
                                                <div class="userInfo">
                                                    <p class="m-0">
                                                        <strong>{{ $learner->name .' '.$learner->last_name  }}</strong>
                                                    </p>
                                                    <p class="m-0">{{ $learner->email }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge badge-soft-primary">
                                            @if($learner->cohorts->isNotEmpty())
                                                    @foreach($learner->cohorts as $cohort)
                                                        @if($cohort->course)
                                                            {{ \Carbon\Carbon::parse($cohort->start_date_time)->format('d F, Y, h:i A') }}
                                                            <br>
                                                        @else
                                                            No start date
                                                        @endif
                                                    @endforeach
                                                @else
                                                    N/A
                                                @endif
                                            </span>
                                        </td>


                                        <td>

                                            @php
                                                $actCertificates = collect();
                                                foreach ($learner->cohorts as $cohort) {
                                                    $act_document = $cohort
                                                    ->taskSubmissions->where('user_id', $learner->id)
                                                    ->filter(function ($submission) {
                                                        return !is_null($submission->act_document);
                                                    });
                                                    $actCertificates = $actCertificates->merge($act_document);
                                                }

                                            @endphp

                                            @foreach ($actCertificates as $acts)
                                                @if (isset($acts['act_document']))
                                                    <p>{{ $acts->license->name ?? "" }}</p>

                                                    <p class="m-0 mb-2">
                                                        <a href="{{ asset($acts['act_document']) }}"
                                                           target="_blank"
                                                           class="btn btn-chip btn-chip-primary btn-table">View</a>
                                                    </p>
                                                @endif
                                            @endforeach

                                            @php
                                                $normalCertificates = collect();
                                                foreach ($learner->cohorts as $cohort) {
                                                    $certs = $cohort->certificates->where('user_id', $learner->id);
                                                    $normalCertificates = $normalCertificates->merge($certs);
                                                }
                                            @endphp

                                            @if ($normalCertificates->isNotEmpty())
                                                @foreach ($normalCertificates as $certificate)

                                                    <p>{{ $certificate->license->name ?? "" }}</p>
                                                    <p class="m-0 mb-2">
                                                        <a href="{{ asset( 'storage/'.$certificate->certificate_path)}}"
                                                           class="btn btn-chip btn-chip-primary btn-table">View</a>
                                                    </p>

                                                @endforeach
                                            @else
                                                <small>No certificate issued yet</small>
                                            @endif


                                            @php
                                                $highfieldCertificates = collect();
                                                foreach ($learner->cohorts as $cohort) {
                                                    $certs = $cohort->highFieldCertificates->where('user_id', $learner->id);
                                                    $highfieldCertificates = $highfieldCertificates->merge($certs);
                                                }
                                            @endphp

                                            @if($highfieldCertificates->isNotEmpty())
                                                @foreach($highfieldCertificates as $certificate)
                                                    <p class="m-0">
                                                        <a href="{{ asset('storage/' . $certificate->file_path) }}"
                                                           target="_blank"
                                                           class="btn btn-chip btn-chip-primary btn-table mb-1">
                                                            View Highfield
                                                        </a>
                                                    </p>
                                                @endforeach
                                            @else
                                                <small>No Highfield certificate</small>
                                            @endif

                                        </td>


                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">No delegates found.</td>
                                    </tr>
                                @endforelse

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                <tr>
                                    <th>Course</th>
                                    <th>Delegate's Name</th>
                                    <th>Course Start Date, Time</th>
                                    <th>Certificate</th>
                                    <th>Progress</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>
                                        <p class="m-0 text-black">SIA CCTV Operator</p>
                                        <p class="m-0">
                                            <span class="badge badge-soft-success">Done</span>
                                            <span class="pl-2">70% complete</span>
                                        </p>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <p class="textImg">
                                                J
                                            </p>
                                            <div class="userInfo">
                                                <p class="m-0"><strong>James</strong></p>
                                                <p class="m-0">james@example.com</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td><span class="badge badge-soft-primary">28 July, 2025, 09:00 AM</span></td>
                                    <td>
                                        <div class="d-flex align-items-center justify-content-between">
                                            <span>ACT Security</span>
                                            <span class="badge badge-soft-warning">
                                                    <i class="far fa-clock mr-1"></i> Pending
                                                </span>
                                        </div>
                                    </td>
                                    <td><a href="javascript:;"
                                           class="btn btn-chip btn-chip-primary btn-table">View</a></td>
                                </tr>
                                <tr>
                                    <td>
                                        <p class="m-0 text-black">SIA CCTV Operator</p>
                                        <p class="m-0">
                                            <span class="badge badge-soft-success">Done</span>
                                            <span class="pl-2">70% complete</span>
                                        </p>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <p class="textImg">
                                                J
                                            </p>
                                            <div class="userInfo">
                                                <p class="m-0"><strong>James</strong></p>
                                                <p class="m-0">james@example.com</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td><span class="badge badge-soft-primary">28 July, 2025, 09:00 AM</span></td>
                                    <td>
                                        <div class="d-flex align-items-center justify-content-between">
                                            <span>ACT Security</span>
                                            <span class="badge badge-soft-warning">
                                                    <i class="far fa-clock mr-1"></i> Pending
                                                </span>
                                        </div>
                                    </td>
                                    <td><a href="javascript:;"
                                           class="btn btn-chip btn-chip-primary btn-table">View</a></td>
                                </tr>
                                <tr>
                                    <td>
                                        <p class="m-0 text-black">SIA CCTV Operator</p>
                                        <p class="m-0">
                                            <span class="badge badge-soft-success">Done</span>
                                            <span class="pl-2">70% complete</span>
                                        </p>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <p class="textImg">
                                                J
                                            </p>
                                            <div class="userInfo">
                                                <p class="m-0"><strong>James</strong></p>
                                                <p class="m-0">james@example.com</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td><span class="badge badge-soft-primary">28 July, 2025, 09:00 AM</span></td>
                                    <td>
                                        <div class="d-flex align-items-center justify-content-between">
                                            <span>ACT Security</span>
                                            <span class="badge badge-soft-warning">
                                                    <i class="far fa-clock mr-1"></i> Pending
                                                </span>
                                        </div>
                                    </td>
                                    <td><a href="javascript:;"
                                           class="btn btn-chip btn-chip-primary btn-table">View</a></td>
                                </tr>
                                <tr>
                                    <td>
                                        <p class="m-0 text-black">SIA CCTV Operator</p>
                                        <p class="m-0">
                                            <span class="badge badge-soft-success">Done</span>
                                            <span class="pl-2">70% complete</span>
                                        </p>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <p class="textImg">
                                                J
                                            </p>
                                            <div class="userInfo">
                                                <p class="m-0"><strong>James</strong></p>
                                                <p class="m-0">james@example.com</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td><span class="badge badge-soft-primary">28 July, 2025, 09:00 AM</span></td>
                                    <td>
                                        <div class="d-flex align-items-center justify-content-between">
                                            <span>ACT Security</span>
                                            <span class="badge badge-soft-warning">
                                                    <i class="far fa-clock mr-1"></i> Pending
                                                </span>
                                        </div>
                                    </td>
                                    <td><a href="javascript:;"
                                           class="btn btn-chip btn-chip-primary btn-table">View</a></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                <tr>
                                    <th>Course</th>
                                    <th>Delegate's Name</th>
                                    <th>Course Start Date, Time</th>
                                    <th>Certificate</th>
                                    <th>Progress</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>
                                        <p class="m-0 text-black">SIA CCTV Operator</p>
                                        <p class="m-0">
                                            <span class="badge badge-soft-success">Done</span>
                                            <span class="pl-2">70% complete</span>
                                        </p>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <p class="textImg">
                                                J
                                            </p>
                                            <div class="userInfo">
                                                <p class="m-0"><strong>James</strong></p>
                                                <p class="m-0">james@example.com</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td><span class="badge badge-soft-primary">28 July, 2025, 09:00 AM</span></td>
                                    <td>
                                        <div class="d-flex align-items-center justify-content-between">
                                            <span>ACT Security</span>
                                            <span class="badge badge-soft-warning">
                                                    <i class="far fa-clock mr-1"></i> Pending
                                                </span>
                                        </div>
                                    </td>
                                    <td><a href="javascript:;"
                                           class="btn btn-chip btn-chip-primary btn-table">View</a></td>
                                </tr>
                                <tr>
                                    <td>
                                        <p class="m-0 text-black">SIA CCTV Operator</p>
                                        <p class="m-0">
                                            <span class="badge badge-soft-success">Done</span>
                                            <span class="pl-2">70% complete</span>
                                        </p>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <p class="textImg">
                                                J
                                            </p>
                                            <div class="userInfo">
                                                <p class="m-0"><strong>James</strong></p>
                                                <p class="m-0">james@example.com</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td><span class="badge badge-soft-primary">28 July, 2025, 09:00 AM</span></td>
                                    <td>
                                        <div class="d-flex align-items-center justify-content-between">
                                            <span>ACT Security</span>
                                            <span class="badge badge-soft-warning">
                                                    <i class="far fa-clock mr-1"></i> Pending
                                                </span>
                                        </div>
                                    </td>
                                    <td><a href="javascript:;"
                                           class="btn btn-chip btn-chip-primary btn-table">View</a></td>
                                </tr>
                                <tr>
                                    <td>
                                        <p class="m-0 text-black">SIA CCTV Operator</p>
                                        <p class="m-0">
                                            <span class="badge badge-soft-success">Done</span>
                                            <span class="pl-2">70% complete</span>
                                        </p>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <p class="textImg">
                                                J
                                            </p>
                                            <div class="userInfo">
                                                <p class="m-0"><strong>James</strong></p>
                                                <p class="m-0">james@example.com</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td><span class="badge badge-soft-primary">28 July, 2025, 09:00 AM</span></td>
                                    <td>
                                        <div class="d-flex align-items-center justify-content-between">
                                            <span>ACT Security</span>
                                            <span class="badge badge-soft-warning">
                                                    <i class="far fa-clock mr-1"></i> Pending
                                                </span>
                                        </div>
                                    </td>
                                    <td><a href="javascript:;"
                                           class="btn btn-chip btn-chip-primary btn-table">View</a></td>
                                </tr>
                                <tr>
                                    <td>
                                        <p class="m-0 text-black">SIA CCTV Operator</p>
                                        <p class="m-0">
                                            <span class="badge badge-soft-success">Done</span>
                                            <span class="pl-2">70% complete</span>
                                        </p>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <p class="textImg">
                                                J
                                            </p>
                                            <div class="userInfo">
                                                <p class="m-0"><strong>James</strong></p>
                                                <p class="m-0">james@example.com</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td><span class="badge badge-soft-primary">28 July, 2025, 09:00 AM</span></td>
                                    <td>
                                        <div class="d-flex align-items-center justify-content-between">
                                            <span>ACT Security</span>
                                            <span class="badge badge-soft-warning">
                                                    <i class="far fa-clock mr-1"></i> Pending
                                                </span>
                                        </div>
                                    </td>
                                    <td><a href="javascript:;"
                                           class="btn btn-chip btn-chip-primary btn-table">View</a></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('css')
        <style>
            .searchBox .input-group {
                width: 242px !important;
                position: relative;
            }

            .searchBox .input-group input.form-control {
                height: 40px;
            }

            .searchBox .input-group-append button {
                background: transparent !important;
                border: none !important;
                position: absolute;
                right: 0px;
                top: 0;
                bottom: 0;
            }

            .tabsWrapper .btn-chip-primary.btn-table {
                background: #e1e9f5;
                color: #2563eb;
                border: solid 1px #2563eb42;
                border-radius: 5px;
            }

            .tabsWrapper .badge-soft-primary {
                background: #e1e9f5;
                color: #2563eb;
                border: solid 1px #2563eb42;
            }

            .tabsWrapper p.textImg {
                margin: 0;
                width: 40px;
                height: 40px;
                display: flex;
                align-items: center;
                justify-content: center;
                border: solid 1px #ccc;
                border-radius: 50%;
                margin-right: 10px;
                background: #2563eb0f;
            }

            .tabtTop h4.card-title {
                display: block;
                font-weight: 800;
                float: unset;
            }

            .tabtTop p {
                display: block;
            }

            .tabsWrapper > ul {
                background: #F1F5F9;
                display: inline-flex;
                padding: 5px 5px;
                border: none;
            }

            .tabsWrapper > ul li button.active {
                background: #fff;
                color: #000;
                font-weight: 600;
            }

            .tabsWrapper > ul li button.nav-link {
                background: transparent;
                border: none;
                padding: 5px 25px;
                border-radius: 4px;
                color: #777;
            }

            .tabsWrapper table thead tr,
            .tabsWrapper table thead,
            .tabsWrapper table thead tr th {
                border: none !important;
            }

            .tabsWrapper table thead tr {
                border-top: solid 1px #ddd !important;
            }

            .tabsWrapper .card-body {
                margin-top: 25px;
            }

            .card.bg_delegate2 {
                background: rgb(183 185 224 / 50%);
            }

            .card.bg_delegate3 {
                background: rgb(147 51 234 / 30%);
            }

            .card.bg_delegate1 {
                background: rgb(232 242 255 / 70%);
            }

            .delegates_box span.delegates_count {
                background: #fff;
                padding: 1px 10px;
                border-radius: 5px;
                margin-right: 5px !important;
            }

            .card__img {
                width: 30px;
                height: 30px;
                object-fit: none;
            }

            .progress_bar_btn {
                color: #222;
            }

            .progress_bar_inner {
                display: flex;
                align-items: center;
                justify-content: space-between;
            }

            .progress_bar_inner .progress.progress-slim {
                width: 80%;
            }

            .progressGrd1 {
                background: linear-gradient(164deg, rgba(255, 191, 26, 1) 27%, rgba(255, 64, 128, 1) 71%);
            }

            .progressGrd2 {
                background: linear-gradient(164deg, #9333EA 27%, #FF4080 71%);
            }

            .progressGrd3 {
                background: linear-gradient(164deg, #2563EB 27%, #9333EA 71%);
            }

            .notifi_card,
            .progress_card {
                border-radius: 10px !important;
            }

            .notifi_list li.list-item-row p {
                margin: 0;
            }

            .notifi_list li.list-item-row.active {
                background: #eff6ff;
            }

            .notifi_list li.list-item-row {
                padding: 22px 10px;
                border-bottom: solid 1px #ddd;
            }

            .notifi_btn a {
                padding: 10px;
                border: solid 1px #ddd;
                border-radius: 5px;
                color: #222;
            }

            .dash-card .mini-box {
                background: #f9fafb;
            }

            .dash-card .btn-chip-pink {
                background: #fff;
                font-weight: 500;
                border-radius: 5px;
                padding: 11px 15px;
                letter-spacing: 0.5px;
            }

            .dash-card .btn-chip-primary {
                font-weight: 500;
                border-radius: 5px;
                padding: 11px 15px;
                letter-spacing: 0.5px;
                background: #fff;
            }

            .dash-card {
                background: #fff;
                border: 0;
                border-radius: 14px;
                padding: 18px;
                box-shadow: 0 8px 10px rgb(17 24 39 / 5%);
                position: relative;
            }

            .dash-card .inner {
                background: #fff;
                border: 1px solid #eef2f7;
                border-radius: 10px;
                padding: 14px;
            }

            .card-sky {
                background: linear-gradient(135deg, #eaf3ff 0%, #e6f1ff 100%);
            }

            .card-lilac {
                background: linear-gradient(135deg, #f5eaff 0%, #efe6ff 100%);
            }

            .card-blue {
                background: linear-gradient(135deg, #eaf5ff 0%, #e6f2ff 100%);
            }

            .font-weight-600 {
                font-weight: 600;
            }

            .btn-chip {
                border-radius: 999px;
                padding: 0.35rem 0.8rem;
                line-height: 1;
                font-size: 0.82rem;
                font-weight: 600;
                border: 0;
            }

            .btn-chip-success {
                background: #fff;
                color: #067647;
                font-weight: 500;
                border-radius: 5px;
                padding: 11px 15px;
            }

            .btn-chip-pink {
                background: #ffeaf3;
                color: #b4235a;
            }

            .btn-chip-primary {
                background: #e9f0ff;
                color: #1d4ed8;
            }

            .btn-chip:hover {
                opacity: 0.95;
            }

            .mini-box {
                background: #fff;
                border: 1px solid #eef2f7;
                border-radius: 10px;
                padding: 12px;
                height: 100%;
            }

            .mini-label {
                color: #6b7280;
                font-size: 0.8rem;
                margin-bottom: 2px;
            }

            .mini-num {
                font-weight: 700;
                font-size: 1.15rem;
            }

            .progress-slim {
                height: 6px;
                background: #edf2f7;
                border-radius: 8px;
                overflow: hidden;
            }

            .progress-slim .progress-bar {
                border-radius: 8px;
            }

            .list-item-row {
                display: flex;
                align-items: center;
                justify-content: space-between;
                padding: 12px 14px;
                border-bottom: 1px solid #f1f5f9;
            }

            .list-item-row:last-child {
                border-bottom: 0;
            }

            .badge-soft-success {
                background: #ecfdf3;
                color: #067647;
                border-radius: 999px;
                padding: 0.35rem 0.6rem;
                font-weight: 600;
            }

            .badge-soft-warning {
                background: #fff7ed;
                color: #b45309;
                border-radius: 999px;
                padding: 0.35rem 0.6rem;
                font-weight: 600;
            }

            .doc-row {
                display: flex;
                align-items: center;
                padding: 12px 0px;
                border-bottom: 1px solid #f1f5f9;
            }

            .doc-row:last-child {
                border-bottom: 0;
            }

            .doc-icon {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                width: 34px;
                height: 34px;
                margin-right: 12px;
                border-radius: 10px;
                background: #eef2ff;
                color: #4f46e5;
            }

            .doc-title {
                font-weight: 600;
            }

            .doc-title:hover {
                text-decoration: underline;
            }

            .doc-sub {
                font-size: 0.78rem;
                color: #6b7280;
                margin-top: 2px;
            }

            h6 {
                letter-spacing: 0.1px;
            }
        </style>
    @endpush
@endsection
