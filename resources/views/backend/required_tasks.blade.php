@php
    use App\Libraries\ScormApiService;
    use App\Models\ProfilePhoto;
@endphp

@extends('layouts.main')

@section('title', 'Learner Dashboard')

@section('breadcump')
    <div class="col-sm-6">
        <h1 class="m-0">{{ __('Dashboard') }}</h1>
    </div>
@endsection
@push('css')
    <link href="{{ asset('css/adminltev3.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lity/2.4.1/lity.css"
        integrity="sha512-NDcw4w5Uk5nra1mdgmYYbghnm2azNRbxeI63fd3Zw72aYzFYdBGgODILLl1tHZezbC8Kep/Ep/civILr5nd1Qw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="{{ asset('css/dflip.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/themify-icons.min.css') }}">
    <style>
        #myTabContent .col.deactive .boxBottom i {
            color: #fb9634;
        }

        #myTabContent .boxWrapper p,
        #myTabContent .boxWrapper h4 {
            color: #fff;
        }

        div#myTabContent .col.active .boxWrapper {
            background: #d4e3fc;
        }

        div#myTabContent .col.deactive .boxWrapper {
            background: #292a5c;
        }

        div#myTabContent .boxWrapper {
            border-radius: 20px;
        }

        .boxWrapper .boxTop {
            border: solid 2px #fff;
            padding: 20px;
            border-radius: 20px;
            margin-bottom: 10px;
        }

        .boxWrapper .boxTop i {
            font-size: 60px;
            display: flex;
            justify-content: end;
            color: #d4e3fc;
        }

        .boxWrapper .boxTop h4 {
            font-size: 30px;
            font-weight: 700;
            line-height: 35px;
            margin: 0;
        }

        .boxWrapper .boxBottom {
            font-size: 30px;
            color: #fb9634;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .boxWrapper .boxBottom i.fa-check-circle {
            color: #238b45;
        }

        div#myTabContent .col.active .boxWrapper .boxTop i,
        div#myTabContent .col.active .boxWrapper .boxTop h4 {
            color: #292a5c;
        }

        div#myTabContent .col.active .boxWrapper .boxTop,
        div#myTabContent .col.active .boxWrapper p,
        div#myTabContent .col.active .boxWrapper .boxBottom span {
            border-color: #292a5c;
            color: #292a5c;
        }
    </style>
@endpush

@section('main')
    <div class="row">

        @php $user = Auth::user(); @endphp
        <div class="tab-content w-100" id="myTabContent">
            <!------------------------------ LEARNER DASHBOARD ------------------------------>
            <div class="tab-pane fade show active w-100" id="learner-dashboard" role="tabpanel"
                aria-labelledby="learner_dashboard">

                <h1 class="text-center" style="color: #292a5c"><strong> Welcome to your T4E Hub </strong></h1>
                <p class="text-center">To unlock access to your Learner Dashboard, please complete the following steps:</p>

                <div class="row px-5">
                    @php
                        $learner = auth()->user();
                        $cohorts = $learner
                            ->cohorts()
                            ->whereHas('course', function ($query) {
                                $query->whereNotNull('qualification_type');
                            })
                            ->with(['course']) // Load the course with its associated tasks
                            ->get();




                        $cohorts_array = $learner->cohorts()->pluck('course_id')->toArray();
                        $allowedCourseIds = [1, 2, 4];

                    @endphp
                    <div
                        class="col col-12 text-light {{ $cohorts->count() > 0 ? 'col-md-3' : 'col-md-3' }} {{ $user->hasSubmittedApplicationForm() ? 'active' : 'deactive' }}">
                        <div class="boxWrapper h-100 p-3">
                            <div class="boxTop">
                                <i class="fas fa-file-alt"></i>
                                <h4>Application <br>Form</h4>
                            </div>
                            <p>Ensure all details are accurately provided.</p>
                            <div class="boxBottom">
                                <span>Step 1</span>
                                {!! $user->hasSubmittedApplicationForm()
                                    ? '<i class="fas fa-check-circle"></i>'
                                    : '<a href="' . route('backend.application-forms.index') . '"><i class="fas fa-long-arrow-alt-right"></i></a>' !!}
                            </div>
                        </div>
                    </div>
                    <div
                        class="col col-12 {{ $cohorts->count() > 0 ? 'col-md-3' : 'col-md-3' }} {{ $user->hasUploadedProfilePhoto() ? 'active' : 'deactive' }}">
                        <div class="boxWrapper h-100 p-3">
                            <div class="boxTop">
                                <i class="fas fa-user-circle"></i>
                                <h4>Profile <br>Photo</h4>
                            </div>
                            <p>Upload a recent, clear photo for your profile.</p>
                            <div class="boxBottom">
                                <span>Step 2</span>
                                {!! $user->hasUploadedProfilePhoto()
                                    ? '<i class="fas fa-check-circle"></i>'
                                    : '<a href="' . route('backend.profile-photo.index') . '"><i class="fas fa-long-arrow-alt-right"></i></a>' !!}
                            </div>
                        </div>
                    </div>
                    <div
                        class="col col-12 {{ $cohorts->count() > 0 ? 'col-md-3' : 'col-md-3' }} {{ $user->hasUploadedDocuments() ? 'active' : 'deactive' }}">
                        <div class="boxWrapper h-100 p-3">
                            <div class="boxTop">
                                <i class="fas fa-id-card"></i>
                                <h4>Proof<br>of ID</h4>
                            </div>
                            <p>Submit a valid ID document for verification.</p>
                            <div class="boxBottom">
                                <span>Step 3</span>
                                {!! $user->hasUploadedDocuments()
                                    ? '<i class="fas fa-check-circle"></i>'
                                    : '<a href="' . route('backend.document-uploads.index') . '"><i class="fas fa-long-arrow-alt-right"></i></a>' !!}
                            </div>
                        </div>
                    </div>
                    @if ( array_intersect($allowedCourseIds, $cohorts_array) )
                        <div class="col col-12 {{ $cohorts->count() > 0 ? 'col-md-3' : 'col-md-3' }} {{$user->hasUserCertification() ? 'active' : 'deactive'}}">
                            <div class="boxWrapper h-100 p-3">
                                <div class="boxTop">
                                    <i class="fas fa-tasks"></i>
                                    <h4>Course <br>Pre-Requisites</h4>
                                </div>
                                <p>Confirm completion of any required prerequisites.</p>
                                <div class="boxBottom">
                                    <span>Step 4</span>
                                    {!! $user->hasUserCertification()
                                        ? '<i class="fas fa-check-circle"></i>'
                                        : '<a href="' . route('backend.course-pre-requisites.index') . '"><i class="fas fa-long-arrow-alt-right"></i></a>' !!}
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

    @endsection
    @push('js')
        <script type="text/javascript" src="{{ asset('js/dflip.min.js') }}"></script>
    @endpush
