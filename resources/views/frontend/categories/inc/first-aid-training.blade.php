@extends('layouts.frontend')
@section('title', 'First Aid Training')
@section('main')
    <div class="firstAidTraining coursePage">
        <section id="banner" class="bannerWrapper bannerHeight">
            <div class="container">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-4 col-lg-4 bannerImg" style='background: url({{asset('CategoryImages/first-aid-training.png')}}) no-repeat center/cover; ' data-aos="fade-right"></div>
                <div class="col-12 col-sm-12 col-md-8 col-lg-8 py-5" data-aos="fade-left">
                    <div class="bannerCol px-3 px-lg-0 px-md-0 px-xl-0 pl-xl-5 pl-lg-5 pl-md-5 mr-xl-5 pr-xl-5">
                        <div class="bannerInfo">
                            <h1 class="mb-4"><strong>First Aid Training</strong></h1>
                            <p class="h3 mb-4 greenColor">Workplace First Aid Certification</p>
                            <ul class="list-unstyled p-0 m-0">
                                <li class="mb-2"><i class="far fa-check-square mr-2"></i>Expert Trainers</li>
                                <li class="mb-2"><i class="far fa-check-square mr-2"></i>Tailored Training</li>
                                <li class="mb-2"><i class="far fa-check-square mr-2"></i>Supportive Environment:</li>
                                <li class="mb-2"><i class="far fa-check-square mr-2"></i>On-Site & Off-Site Delivery Options</li>
                                <li class="mb-2"><i class="far fa-check-square mr-2"></i>Nationwide Delivey</li>
                            </ul>
                        </div>
                        <div class="bookingBtnGroup d-flex flex-column flex-md-row flex-lg-row mt-4 mb-2">
                            <a href="#explore_our_first_aid_course"
                                class="mr-lg-2 mr-md-2 mr-sm-0 mb-2 mb-md-0 mb-lg-0 btnMstr text-center"><i
                                    class="fas fa-shopping-cart"></i> Book Now</a>
                            <a href="javascript:;" class="btnWhiteBg text-center" data-toggle="modal" data-target="#bespokeForm"><i class="fas fa-users"></i> Request Bespoke Training</a>
                        </div>
                        <script defer async src='https://cdn.trustindex.io/loader.js?c6282b731b132346ef669eb8980'></script>
                    </div>
                </div>
            </div>
            </div>
        </section>
        <section class="coursesWrapper">
            <div class="container">
                <h2 id="explore_our_first_aid_course" class="text-center mb-5 mt-5 px-3 px-lg-0 px-xl-0 fs2">Explore Our First Aid Courses</h2>
                <div class="row justify-content-center" id="courses-container">
                    @php
                        $filteredCourses = $category->courses->reject(function ($course) {
                            return $course->id == 13;
                        });
                    @endphp

                    @include('frontend.categories.courses.index', ['courses' => $filteredCourses])

                    {{-- <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-4 mb-4">-
                        <div class="singleCourse mb-4">
                            <div class="wrap">
                                <div class="box">
                                    <div class="hover panel">
                                        <div class="front w-100" style="background:url({{asset('frontend/img/EFAW.webp')}}) no-repeat center/cover;">
                                            <div class="base1">
                                            </div>
                                        </div>
                                        <div class="back w-100 d-flex align-items-center justify-content-center">
                                            <div class="base2">
                                                <a href="javascript:;" class="panelBtn text-uppercase font-weight-bold">View
                                                    Dates &amp; Venues</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panelContent">
                                        <h3>First Aid at Work</h3>
                                        <p class="text-center"></p><p>The First Aid at Work (FAW) Training is aimed at those individuals who wish to become First Aider...</p>
                                        <ul class="list-unstyled p-0 m-0">
                                            <li class="d-flex align-content-center"><i class="mr-2 fas fa-home"></i>
                                                <p class="m-0"><strong>Delivery Mode</strong>: ClassroomBased  </p>
                                            </li>
                                            <li class="d-flex align-content-center"><i class="mr-2 fas fa-certificate"></i>
                                                <p class="m-0"><strong>Award</strong>: Highfield Qualifications</p>
                                            </li>
                                            <li class="d-flex align-content-center"><i class="mr-2 fas fa-money-bill-wave"></i>
                                                <p class="m-0"><strong>Duration</strong>: 3 day</p>
                                            </li>
                                            <li class="d-flex align-content-center"><i class="mr-2 far fa-clock"></i>
                                                <p class="m-0"><strong>Price</strong>: from £179.00</p>
                                            </li>
                                        </ul>
                                        <div class="panelViewDateBtn">
                                            <a href="javascript:;">View Dates &amp; Venues</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
        </section>
        <section class="whatIsFaw">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-6 d-sm-none d-md-block d-lg-block d-xl-block whatIsFawBgImg" data-aos="fade-right"
                        style="background:url({{ asset('frontend/img/What-is-First-Aid.webp') }}) no-repeat center/cover">
                    </div>
                    <div class="col-12 col-md-6 col-lg-6 d-sm-block d-md-none d-lg-none d-xl-none">
                        <img src="{{ asset('frontend/img/What-is-First-Aid.webp') }}" class="img-fluid" alt="What is First Aid">
                    </div>
                    <div class="col-12 col-md-6 col-lg-6 pl-3 pl-xl-5 pl-lg-5 pl-md-5" data-aos="fade-left">
                        <h2 class="mb-5 fs2">What is First Aid?</h2>
                        <p class="h5 mb-4"><strong>First Aid at Work saves lives and prevents minor injuries becoming major
                                ones</strong></p>
                        <p>People at work can suffer injuries or fall ill at all times. It doesn’t matter whether the injury
                            or
                            illness is caused by work, however, it is important to give them immediate attention and call an
                            ambulance in serious cases.</p>
                        <p class="mb-5">Below is a list of legislative requirements governing first aid within the workplace. You should
                            make
                            arrangements to ensure sufficient help and support is available.</p>

                        <details>
                            <summary>The Health and Safety (First Aid) Regulations 1981</summary>
                            <p>Requires employers to provide adequate and appropriate equipment, facilities and personnel to
                                ensure their employees receive immediate attention if they are injured or taken ill at work.
                                The
                                Health and Safety (First Aid) Regulations 1981 apply to all workplaces including those with
                                less
                                than five employees and to the self-employed.</p>
                        </details>
                        <details>
                            <summary>The Health and Safety (First-Aid) Regulations (Northern Ireland) 1982</summary>
                            <p>The Health and Safety (First-Aid) Regulations (Northern Ireland) 1982 apply to all workplaces
                                in
                                Northern Ireland including those with less than five employees and to the self-employed.
                                Requires employers in Northern Ireland to provide adequate and appropriate equipment,
                                facilities
                                and personnel to ensure their employees receive immediate attention if they are injured or
                                taken
                                ill at work.</p>
                        </details>
                        <details>
                            <summary>The Health and Safety at Work etc. Act 1974</summary>
                            <p>Employers have a responsibility for the health and safety of their employees. They are also
                                responsible for any visitors to the premises such as customers, suppliers and the general
                                public.</p>
                        </details>
                        <details>
                            <summary>RIDDOR Reporting of Injuries, Diseases and Dangerous Occurrences Regulations (current
                                Regulations)</summary>
                            <p>RIDDOR places duties on employers, the self-employed and people in control of work premises
                                (the
                                Responsible Person) to report serious workplace accidents, occupational diseases and
                                specified
                                dangerous occurrences (near misses) in line with current regulations.</p>
                        </details>
                        <details>
                            <summary>The Management of Health and Safety at Work Regulations 1999</summary>
                            <p>The main requirement on employers is to carry out a concise risk assessment of the workplace.
                                Employers with five or more employees need to record the significant findings of the risk
                                assessment. The risk assessment will assist employers in determining the first-aid provision
                                and
                                requirements within the workplace.</p>
                        </details>
                        <details>
                            <summary>Further information...</summary>
                            <p>Further information can be found on the Health and Safety Executive (HSE) website
                                www.hse.gov.uk
                            </p>
                        </details>
                    </div>
                </div>
            </div>
        </section>
        <section class="needFAW px-5">
            <div class="container">
                <h2 class="mb-5 mt-4 px-3 px-lg-0 px-xl-0 fs2" data-aos="fade-right">Who needs First Aid?</h2>
                <p class="mb-5 mt-4 px-3 px-lg-0 px-xl-0" data-aos="fade-right">People at work can suffer injuries or fall ill at all times. It
                    doesn’t matter whether the injury or illness is caused by work, however, it is important to give them
                    immediate attention and call an ambulance in serious cases. The minimum first-aid provision on any work
                    site is:</p>
                <div class="row">
                    <div class="col-12 col-md-10 col-lg-10 offset-0 offset-md-2 offset-lg-2">
                        <ul class="list-unstyled p-0 m-0 needFawBox">
                            <li class="d-flex align-items-center mb-3" data-aos="fade-left" data-aos-duration="2000">
                                <i class="d-flex align-items-center text-white justify-content-center fa-regular fa-square-check mr-2"></i>
                                <span>a suitably stocked first-aid kit.</span>
                            </li>
                            <li class="d-flex align-items-center" data-aos="fade-left" data-aos-duration="1500">
                                <i class="d-flex align-items-center text-white justify-content-center fa-regular fa-square-check mr-2"></i>
                                <span>an appointed person to take charge of first-aid arrangements information for employees
                                    about first-aid arrangements.</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <section class="assessingFaw">
            <div class="container">
                <h2 class="mb-5 mt-4 px-3 px-lg-0 px-xl-0 fs2">What to consider when assessing your First Aid needs?</h2>
                <p class="mb-5 mt-4 px-3 px-lg-0 px-xl-0">What is considered ‘adequate and appropriate’ first aid
                    arrangements will depend on the work you do and where you do it. You should always assess what your
                    first aid needs are.</p>
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-6" data-aos="fade-right">
                        <h3 class="mb-5">You must consider:</h3>
                        <ul class="list-unstyled p-0 m-0 needFawBox">
                            <li class="d-flex align-items-center mb-3">
                                <i
                                    class="d-flex align-items-center text-white justify-content-center fa-regular fa-square-check mr-2"></i>
                                <span class="w-100">the type of work you do</span>
                            </li>
                            <li class="d-flex align-items-center mb-3">
                                <i
                                    class="d-flex align-items-center text-white justify-content-center fa-regular fa-square-check mr-2"></i>
                                <span class="w-100">hazards and the likely risk of them causing harm</span>
                            </li>
                            <li class="d-flex align-items-center mb-3">
                                <i
                                    class="d-flex align-items-center text-white justify-content-center fa-regular fa-square-check mr-2"></i>
                                <span class="w-100">the size of your workforce</span>
                            </li>
                            <li class="d-flex align-items-center mb-3">
                                <i
                                    class="d-flex align-items-center text-white justify-content-center fa-regular fa-square-check mr-2"></i>
                                <span class="w-100">work patterns of your staff</span>
                            </li>
                            <li class="d-flex align-items-center mb-3">
                                <i
                                    class="d-flex align-items-center text-white justify-content-center fa-regular fa-square-check mr-2"></i>
                                <span class="w-100">holiday and other absences of those who will be first aiders and
                                    appointed persons</span>
                            </li>
                            <li class="d-flex align-items-center mb-3">
                                <i
                                    class="d-flex align-items-center text-white justify-content-center fa-regular fa-square-check mr-2"></i>
                                <span class="w-100">the history of accidents in your business</span>
                            </li>
                        </ul>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6" data-aos="fade-left">
                        <h3 class="mb-5">You might also consider:</h3>
                        <ul class="list-unstyled p-0 m-0 needFawBox">
                            <li class="d-flex align-items-center mb-3">
                                <i  class="d-flex align-items-center text-white justify-content-center fa-regular fa-square-check mr-2"></i>
                                <span class="w-100">the needs of travelling, remote and lone workers</span>
                            </li>
                            <li class="d-flex align-items-center mb-3">
                                <i
                                    class="d-flex align-items-center text-white justify-content-center fa-regular fa-square-check mr-2"></i>
                                <span class="w-100">how close your sites are to emergency medical services</span>
                            </li>
                            <li class="d-flex align-items-center mb-3">
                                <i
                                    class="d-flex align-items-center text-white justify-content-center fa-regular fa-square-check mr-2"></i>
                                <span class="w-100">whether your employees work on shared or multi-occupancy sites</span>
                            </li>
                            <li class="d-flex align-items-center mb-3">
                                <i
                                    class="d-flex align-items-center text-white justify-content-center fa-regular fa-square-check mr-2"></i>
                                <span class="w-100">first aid for non-employees including members of the public</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <section class="personnelFaw position-relative">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-6 py-5 personnelBg1" data-aos="fade-right">
                        <div class="personnelInfo">
                            <h2 class="fs2 mb-5">Suggested Numbers of First Aid Personnel</h2>
                            <p>Conducting a first aid needs assessment will identify what type of first aid training your
                                first
                                aiders will need, how many first aiders you need and where they should be located. The
                                first-aid
                                provision needed will depend on the circumstances of each workplace.</p>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-6 py-5 personnelBg2">
                        <div class="personnelSliderMain position-relative" data-aos="fade-left">
                            <div class="personnelSlider"
                                style="background:url({{ asset('frontend/img/28.webp') }}) no-repeat center/cover;">
                                <div class="personnelSliderInner">
                                    <h2 class="fs2 mb-4">Higher Hazard Workplaces</h2>
                                    <em>E.g. light engineering and assembly work, food processing, warehousing, extensive
                                        work with dangerous machinery or sharp instruments, construction and chemical
                                        manufacture</em>
                                    <ul class="mt-4">
                                        <li>
                                            <b>Fewer than 5 employees</b> – require 1 small workplace compliant first-aid
                                            kit and at least <b>1 Appointed Person</b>
                                        </li>
                                        <li>
                                            <b>5-50 employees</b> – require 1 medium workplace compliant first-aid kit and
                                            at least <b>1 EFAW trained first-aider</b>.
                                        </li>
                                        <li>
                                            <b>More than 50 employees</b> – require 1 large workplace compliant first-aid
                                            kit (per 100 people) and at least <b>1 FAW trained first-aider for every 50
                                                employees.</b>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="personnelSlider"
                                style="background:url({{ asset('frontend/img/290.webp') }}) no-repeat center/cover;">
                                <div class="personnelSliderInner">
                                    <h2 class="fs2 mb-4">Low Hazard Workplaces</h2>
                                    <em>E.g. offices, shops, libraries</em>
                                    <ul class="mt-4">
                                        <li>
                                            <b>Fewer than 25 employees</b> – require 1 small workplace compliant first-aid
                                            kit and at least <b>1 Appointed Person</b>.
                                        </li>
                                        <li>
                                            <b>25-30 employees</b> – require 1 medium workplace compliant first-aid kit and
                                            at least <b>1 EFAW trained first-aider</b>.
                                        </li>
                                        <li>
                                            <b>More than 50 employees</b> – require 1 large workplace compliant first-aid
                                            kit (per 100 people) and at least <b>1 FAW trained first-aider for every 100
                                                employees</b>.
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        {{-- Form --}}
        <div id="contactForm"><x-frontend.request_form /></div>
        <section class="everyOneFaw">
            <div class="everyOneFawDesc">
                <div class="container">
                    <h2 class="mb-5 fs2">First Aid is for Everyone!</h2>
                    <p>Looking to promote safety in your workplace? Explore our collection of free downloadable posters,
                        guides, and templates. These professionally designed resources are perfect for displaying in
                        offices, break rooms, and common areas. Download, print, and display to make a lasting impact in
                        your work environment!</p>
                </div>
            </div>
            <div class="everyOneFawPdf mt-5">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-md-6 col-lg-6">
                            <img src="{{ asset('frontend/img/pdf1.webp') }}" class="img-fluid" alt="Click to download 1" data-aos="flip-left">
                            <div class="text-center my-5">
                                <a href="#" class="btnPdf">Click to download</a>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-6">
                            <img src="{{ asset('frontend/img/pdf2.webp') }}" class="img-fluid" alt="Click to download 2" data-aos="flip-left">
                            <div class="text-center my-5">
                                <a href="#" class="btnPdf">Click to download</a>
                            </div>
                            <img src="{{ asset('frontend/img/pdf3.webp') }}" class="img-fluid" alt="Click to download 3" data-aos="flip-left">
                            <div class="text-center my-5">
                                <a href="#" class="btnPdf">Click to download</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    @include('frontend.bespoke_form.index')
@endsection
@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" crossorigin="anonymous"
        referrerpolicy="no-referrer" />
@endpush
@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js" crossorigin="anonymous"
        referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function() {
            AOS.init();
            $(window).on('load', function() {
                AOS.refresh();
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.hover').hover(function() {
                $(this).addClass('flip');
            }, function() {
                $(this).removeClass('flip');
            });
        });
    </script>
@endpush
