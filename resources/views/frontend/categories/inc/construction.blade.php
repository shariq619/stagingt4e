@extends('layouts.frontend')
@section('title', 'Construction Training')
@section('main')
    <div class="constructionRraining coursePage">
        <section id="banner" class="bannerWrapper">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-4 col-lg-4 bannerImg"
                        style='background: url({{ asset('CategoryImages/construction.png') }}) no-repeat center/cover; '
                        data-aos="fade-right"></div>
                    <div class="col-12 col-sm-12 col-md-8 col-lg-8 py-5" data-aos="fade-left">
                        <div class="bannerCol px-3 px-lg-0 px-md-0 px-xl-0 pl-xl-5 pl-lg-5 pl-md-5 mr-xl-5 pr-xl-5">
                            <div class="bannerInfo">
                                <h1 class="mb-4">CSCS Green Labourers Card training
                                    and other Site Safety Plus courses</h1>
                                <ul class="list-unstyled p-0 m-0">
                                    <li class="mb-2"><i class="far fa-check-square mr-2"></i> <em>Expert Trainers</em>
                                    </li>
                                    <li class="mb-2"><i class="far fa-check-square mr-2"></i> <em>Supportive
                                            Environment:</em></li>
                                    <li class="mb-2"><i class="far fa-check-square mr-2"></i> <em>On-Site & Off-Site
                                            Delivery Options</em>
                                    </li>
                                    <li class="mb-2"><i class="far fa-check-square mr-2"></i> <em>Nationwide Delivey</em>
                                    </li>
                                </ul>
                            </div>
                            <div class="bookingBtnGroup d-flex flex-column flex-md-row flex-lg-row mb-2 mt-4">
                                <a href="#construction_section"
                                    class="mr-lg-2 mr-md-2 mr-sm-0 mb-2 mb-md-0 mb-lg-0 btnMstr text-center"><i
                                        class="fas fa-shopping-cart"></i> Book Now</a>
                                {{--<a href="javascript:;" class="btnWhiteBg text-center"><i class="fas fa-users"></i> Request Bespoke Training</a>--}}

                                <a href="javascript:;" class="btnWhiteBg text-center" data-toggle="modal" data-target="#bespokeForm"><i class="fas fa-users"></i>
                                    <span>Request Bespoke Training</span></a>

                            </div>
                            <script defer async src='https://cdn.trustindex.io/loader.js?c6282b731b132346ef669eb8980'></script>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="kickStarWrapper">
            <div class="container">
                <h2 class="text-center mb-5 fs2">How to get CSCS Green Labourer Card?</h2>
                <div class="row">
                    <div class="col-12 col-sm-6 mb-4 mb-xl-0 mb-lg-0 col-md-6 col-lg-3 col-xl-3" data-aos="flip-left"
                        data-aos-easing="ease-out-cubic" data-aos-duration="2000">
                        <div class="kickStarSteps d-flex justify-content-between h-100">
                            <div class="kickStarIcon">
                                <i class="fa-solid fa-lightbulb"></i>
                            </div>
                            <div class="kickStarContent">
                                <h3>Step 1</h3>
                                <p class="m-0">
                                    Book HSA training course with us now and enjoy instant access to a 12-month subscription
                                    to Construction Site Safety – The Comprehensive Guide e-book. Get ready to ace your CITB
                                    touchscreen test with confidence!<br>
                                    Course price: from £147.50
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 mb-4 mb-xl-0 mb-lg-0 col-md-6 col-lg-3 col-xl-3" data-aos="flip-left"
                        data-aos-easing="ease-out-cubic" data-aos-duration="2000">
                        <div class="kickStarSteps d-flex justify-content-between h-100">
                            <div class="kickStarIcon">
                                <i class="fa-solid fa-user-check"></i>
                            </div>
                            <div class="kickStarContent">
                                <h3>Step 2</h3>
                                <p class="m-0">
                                    Complete 1-day face-to-face or online training, based on your individual preferences,
                                    and pass course assessment. The question paper consists of 25 multiple-choice questions.
                                    The delegates must obtain 25 marks out of 30 (83%) or more in order to pass the
                                    examination.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 mb-4 mb-xl-0 mb-lg-0 col-md-6 col-lg-3 col-xl-3" data-aos="flip-left"
                        data-aos-easing="ease-out-cubic" data-aos-duration="2000">
                        <div class="kickStarSteps d-flex justify-content-between h-100">
                            <div class="kickStarIcon">
                                <i class="fa-solid fa-file"></i>
                            </div>
                            <div class="kickStarContent">
                                <h3>Step 3</h3>
                                <p class="m-0">
                                    Schedule CITB Exam. Book and complete CITB Health, Safety & Environment Test,
                                    administered by CITB. The Heath, Safety and Environment tests last for 45 minutes and
                                    contain 50 questions.<br>
                                    Cost of CITB test: £22.50
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 mb-4 mb-xl-0 mb-lg-0 col-md-6 col-lg-3 col-xl-3" data-aos="flip-left"
                        data-aos-easing="ease-out-cubic" data-aos-duration="2000">
                        <div class="kickStarSteps d-flex justify-content-between h-100">
                            <div class="kickStarIcon">
                                <i class="fa-solid fa-id-card"></i>
                            </div>
                            <div class="kickStarContent">
                                <h3>Step 4</h3>
                                <p class="m-0">
                                    Apply and obtain your CSCS card by applying directly to CSCS. With valid CSCS green card
                                    you can gain access to construction sites, increase your health and safety awareness,
                                    and facilitate professional development.<br>
                                    Cost of CSCS Green Labourer Card test: £36
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="discoverBenefits position-relative">
            <div class="container">
                <h2 class="fs2 px-3 px-md-0 px-lg-0 text-center mb-5">Discover Benefits of Construction Training</h2>
                <p class="px-3 px-md-0 px-lg-0 text-center mb-5">At Training for Employment, we offer a wide range of Site
                    Safety Plus and other courses designed to equip individuals and companies with the essential skills
                    needed to thrive in the construction industry. All our courses are tailored to meet the construction
                    industry standards, ensuring both personal safety and professional growth.</p>
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                        <div class="discoverBenefitsInfo pl-0">
                            <h3 class="mb-5">Individuals:</h3>
                            <div class="discoverBenefitsBox d-flex mb-5" data-aos="fade-right">
                                <div class="discoverBenefitsIcon d-flex align-items-center justify-content-center">
                                    <i class="fa-regular fa-square-check"></i>
                                </div>
                                <div class="discoverBenefitsDesc">
                                    <p class="h5 mb-4">Career Advancement</p>
                                    <p>Gain industry-recognised qualifications that can open doors to new job opportunities
                                        and higher salaries.</p>
                                </div>
                            </div>
                            <div class="discoverBenefitsBox d-flex mb-5" data-aos="fade-right">
                                <div class="discoverBenefitsIcon d-flex align-items-center justify-content-center">
                                    <i class="fa-regular fa-square-check"></i>
                                </div>
                                <div class="discoverBenefitsDesc">
                                    <p class="h5 mb-4">Safety Training</p>
                                    <p>Learn vital safety protocols to ensure a safer working environment and reduce the
                                        risk of workplace accidents.</p>
                                </div>
                            </div>
                            <div class="discoverBenefitsBox d-flex mb-5" data-aos="fade-right">
                                <div class="discoverBenefitsIcon d-flex align-items-center justify-content-center">
                                    <i class="fa-regular fa-square-check"></i>
                                </div>
                                <div class="discoverBenefitsDesc">
                                    <p class="h5 mb-4">Certification</p>
                                    <p>Earn certificates that validate your expertise and boost your resume, making you a
                                        more attractive candidate to employers.</p>
                                </div>
                            </div>
                            <div class="discoverBenefitsBox d-flex mb-5" data-aos="fade-right">
                                <div class="discoverBenefitsIcon d-flex align-items-center justify-content-center">
                                    <i class="fa-regular fa-square-check"></i>
                                </div>
                                <div class="discoverBenefitsDesc">
                                    <p class="h5 mb-4">Job Readiness</p>
                                    <p>Get job-ready with health and safety training designed for real-world construction
                                        projects</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 d-none d-xl-block d-lg-block" data-aos="fade-up"
                        style="background:url({{ asset('frontend/img/Construction-training-bg.webp') }}) no-repeat center/cover;background-position: 80% 00%;">
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                        <div class="discoverBenefitsInfo pr-0">
                            <h3 class="mb-5">Companies:</h3>
                            <div class="discoverBenefitsBox d-flex mb-5" data-aos="fade-left">
                                <div class="discoverBenefitsIcon d-flex align-items-center justify-content-center">
                                    <i class="fa-regular fa-square-check"></i>
                                </div>
                                <div class="discoverBenefitsDesc">
                                    <p class="h5 mb-4">Increased Productivity</p>
                                    <p>Well-trained employees can work more efficiently, leading to increased productivity
                                        and project completion rates.</p>
                                </div>
                            </div>
                            <div class="discoverBenefitsBox d-flex mb-5" data-aos="fade-left">
                                <div class="discoverBenefitsIcon d-flex align-items-center justify-content-center">
                                    <i class="fa-regular fa-square-check"></i>
                                </div>
                                <div class="discoverBenefitsDesc">
                                    <p class="h5 mb-4">Reduced Liability</p>
                                    <p>Safety training courses help minimise the risk of accidents and associated
                                        liabilities, protecting your company's reputation and finances.</p>
                                </div>
                            </div>
                            <div class="discoverBenefitsBox d-flex mb-5" data-aos="fade-left">
                                <div class="discoverBenefitsIcon d-flex align-items-center justify-content-center">
                                    <i class="fa-regular fa-square-check"></i>
                                </div>
                                <div class="discoverBenefitsDesc">
                                    <p class="h5 mb-4">Cost Efficiency</p>
                                    <p>Investing in employee training can reduce the need for external contractors, saving
                                        your company money in the long run.</p>
                                </div>
                            </div>
                            <div class="discoverBenefitsBox d-flex mb-5" data-aos="fade-left">
                                <div class="discoverBenefitsIcon d-flex align-items-center justify-content-center">
                                    <i class="fa-regular fa-square-check"></i>
                                </div>
                                <div class="discoverBenefitsDesc">
                                    <p class="h5">Regulatory Compliance</p>
                                    <p>Stay compliant with industry regulations and standards by ensuring your team is
                                        up-to-date with the latest heath and safety practices withing the construction
                                        industry.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="constructionWrapper" id="construction_section">
            <div class="container">
                <h2 class="fs2 px-3 px-md-0 px-lg-0 text-center mb-5">
                    Explore Our Construction Courses
                </h2>
                <div class="row" id="courses-container">
                    @include('frontend.categories.courses.index', ['courses' => $category->courses])
                </div>
            </div>
        </section>
        <section class="discoverBenefits aboutCITB position-relative" id="citbLevy">
            <div class="container">
                <h2 class="fs2 px-3 px-md-0 px-lg-0 text-center mb-5">Have you got questions about CITB Levy?</h2>
                <div class="row">
                    <div class="col-12 col-sm-12 mb-4 mb-xl-0 mb-lg-0 col-md-6 col-lg-4 col-xl-4 citbCol">
                        <div class="discoverBenefitsInfo pl-0">
                            <div class="discoverBenefitsBox d-flex mb-5" data-aos="fade-right">
                                <div class="discoverBenefitsIcon d-flex align-items-center justify-content-center">
                                    <i class="fa-solid fa-circle-question"></i>
                                </div>
                                <div class="discoverBenefitsDesc">
                                    <p class="h5 mb-3">What is the CITB Levy?</p>
                                    <p>The CITB levy is a financial contribution that construction companies make to support
                                        the development and training of their workforce.</p>
                                    <a href="javascript:;" class="btnSimple">Read More <i
                                            class="fa-solid fa-chevron-right"></i></a>
                                </div>
                            </div>
                            <div class="discoverBenefitsBox d-flex mb-5" data-aos="fade-right">
                                <div class="discoverBenefitsIcon d-flex align-items-center justify-content-center">
                                    <i class="fa-solid fa-circle-question"></i>
                                </div>
                                <div class="discoverBenefitsDesc">
                                    <p class="h5 mb-3">Who Pays the CITB Levy?</p>
                                    <p>The CITB levy applies to most construction employers who engage in building or civil
                                        engineering work.</p>
                                    <a href="javascript:;" class="btnSimple">Read More <i
                                            class="fa-solid fa-chevron-right"></i></a>
                                </div>
                            </div>
                            <div class="discoverBenefitsBox d-flex mb-5" data-aos="fade-right">
                                <div class="discoverBenefitsIcon d-flex align-items-center justify-content-center">
                                    <i class="fa-solid fa-circle-question"></i>
                                </div>
                                <div class="discoverBenefitsDesc">
                                    <p class="h5 mb-3">How is the Levy Calculated?</p>
                                    <p>The levy is calculated based on the company’s payroll and subcontractor payments.</p>
                                    <a href="javascript:;" class="btnSimple">Read More <i
                                            class="fa-solid fa-chevron-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 mb-4 mb-xl-0 mb-lg-0 col-md-4 col-lg-4 col-xl-4 d-none d-xl-block d-lg-block" data-aos="fade-up"
                        style="background:url({{ asset('frontend/img/CITB-Levy-Funding.webp') }}) no-repeat center/cover">
                        <div class="h-100 d-flex align-items-end justify-content-center">
                            <div class="cibtBtnFnd d-inline-block  mb-4">
                                <a href="javascript:;" class="cibtBtnCenter d-inline-block">Visit CITB Funding Page</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 mb-4 mb-xl-0 mb-lg-0 col-md-6 col-lg-4 col-xl-4 citbCol">
                        <div class="discoverBenefitsInfo pr-0">
                            <div class="discoverBenefitsBox d-flex mb-5" data-aos="fade-left">
                                <div class="discoverBenefitsIcon d-flex align-items-center justify-content-center">
                                    <i class="fa-solid fa-circle-question"></i>
                                </div>
                                <div class="discoverBenefitsDesc">
                                    <p class="h5 mb-3">Benefits of Paying the CITB Levy</p>
                                    <p>The CITB levy is a financial contribution that construction companies make to support
                                        the development and training of their workforce ...Paying the CITB levy provides
                                        numerous benefits to construction companies.</p>
                                    <a href="javascript:;" class="btnSimple">Read More <i
                                            class="fa-solid fa-chevron-right"></i></a>
                                </div>
                            </div>
                            <div class="discoverBenefitsBox d-flex mb-5" data-aos="fade-left">
                                <div class="discoverBenefitsIcon d-flex align-items-center justify-content-center">
                                    <i class="fa-solid fa-circle-question"></i>
                                </div>
                                <div class="discoverBenefitsDesc">
                                    <p class="h5 mb-3">How to Pay the CITB Levy</p>
                                    <p>Paying the CITB levy is a straightforward process:
                                        Annual Levy Return - Levy Assessment - Payment</p>
                                    <a href="javascript:;" class="btnSimple">Read More <i
                                            class="fa-solid fa-chevron-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="requestForm">
            <div class="container">
                @include('frontend.bespoke_form.index')
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
@endpush
