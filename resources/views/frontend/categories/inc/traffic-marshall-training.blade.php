@extends('layouts.frontend')
@section('title', 'Traffic Marshall Training Category')
@section('main')
    <div class="trafficMarshalVb coursePage">
        <section id="banner" class="bannerWrapper">
            <div class="container">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-4 col-lg-4 bannerImg" style='background: url({{asset('CategoryImages/traffic-marshall-training.png')}}) no-repeat center/cover; ' data-aos="fade-right"></div>
                <div class="col-12 col-sm-12 col-md-8 col-lg-8 py-5" data-aos="fade-left">
                    <div class="bannerCol px-3 px-lg-0 px-md-0 px-xl-0 pl-xl-5 pl-lg-5 pl-md-5 mr-xl-5 pr-xl-5">
                        <div class="bannerInfo">
                            <h1 class="mb-4">Traffic Marshall
                                and Banksman Training </h1>
                            {{-- {{ $category->courses }} --}}
                            <ul class="list-unstyled p-0 m-0">
                                <li class="mb-2"><i class="far fa-check-square mr-2"></i> <em>Free Photo ID Card</em></li>
                                <li class="mb-2"><i class="far fa-check-square mr-2"></i> <em>Instant Results</em></li>
                                <li class="mb-2"><i class="far fa-check-square mr-2"></i> <em>Supportive Environment:</em></li>
                                <li class="mb-2"><i class="far fa-check-square mr-2"></i> <em>On-Site & Off-Site Delivery Options</em>
                                </li>
                                <li class="mb-2"><i class="far fa-check-square mr-2"></i> <em>Nationwide Delivey</em></li>
                            </ul>
                        </div>
                        <div class="bookingBtnGroup mt-4 d-flex flex-column flex-md-row flex-lg-row mb-2">
                            <a href="#trafficMars"
                                class="mr-lg-2 mr-md-2 mr-sm-0 mb-2 mb-md-0 mb-lg-0 btnMstr text-center"><i
                                    class="fas fa-shopping-cart"></i> Book Now</a>
                            <a href="javascript:;" class="btnWhiteBg text-center" data-toggle="modal" data-target="#bespokeForm"><i class="fas fa-users"></i> Request
                                Bespoke Training</a>
                        </div>
                        <script defer async src='https://cdn.trustindex.io/loader.js?c6282b731b132346ef669eb8980'></script>
                    </div>
                </div>
            </div>
            </div>
        </section>
        <section class="aboutTmVb pt-5 px-0 px-md-5 px-lg-5">
            <div class="container">
                <div class="row align-items-center flex-column-reverse flex-md-row flex-lg-row flex-xl-row">
                    <div class="pt-5 col-12 col-sm-12 col-md-7 col-lg-7 col-xl-8" data-aos="fade-right">
                        <h2 class="fs2 mb-5">About the Traffic Marshall and Banksman Training</h2>
                        <p>Traffic Marshall Vehicle Banksman Training is designed to provide individuals with comprehensive
                            skills and knowledge to effectively manage and supervise the movement of vehicles and pedestrians on
                            various sites, ensuring safety and efficiency.</p>
                        <p>The training includes critical topics such as:</p>
                        <ul>
                            <li>the legal obligations outlined in the Health and Safety at Work Act 1974,</li>
                            <li>the importance of wearing appropriate personal protective equipment (PPE), and the ability to
                                process thorough risk assessments to identify and mitigate potential hazards.</li>
                        </ul>
                        <p>Participants learn to distinguish between Traffic Banksmen and Slinger Banksmen, understanding their
                            specific roles and responsibilities.</p>
                        <p>The course emphasises the development of critical qualities such as honesty, reliability, and
                            effective communication, which are essential for ensuring a professional and safe workplace. </p>
                        <p>Additionally, the training provides practical guidance on dealing with customers, highlighting the
                            significance of good customer service and the impact of poor communication skills. Hands-on practice
                            with standard signalling techniques ensures that participants can clearly and safely direct vehicle
                            movements, minimising the risk of accidents.</p>
                        {{--<div class="row my-5">
                            @include('frontend.categories.courses.index', ['courses' => $category->courses])
                        </div>--}}
                    </div>
                    <div class="pt-5 col-12 col-sm-12 col-md-5 col-lg-5 col-xl-4 vbColRight" data-aos="fade-left" id="trafficMars">
                        <section class="coursesWrapper">
                            <div class="row justify-content-center" id="courses-container">
                                <div class="col-12">
                                    <div class="singleCourse mb-4 px-4">
                                        <div class="wrap">
                                            <div class="box">
                                                <div class="hover panel">
                                                    <div class="front w-100"
                                                        style="background:url({{asset('CategoryImages/traffic-marshall-training.png')}}) no-repeat center/cover;">
                                                        <div class="base1">
                                                        </div>
                                                    </div>
                                                    <div class="back w-100 d-flex align-items-center justify-content-center">
                                                        <div class="base2">
                                                            <a href="{{route('course.bundle.show', 'traffic-marshall-training')}}"
                                                                class="panelBtn text-uppercase font-weight-bold">View
                                                                Dates &amp; Venues</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="panelContent">
                                                    <h3 class="py-4 px-3">Traffic Marshal, Vehicle Bansksman Course</h3>
                                                    <ul class="list-unstyled p-0 m-0 px-3">
                                                        <li class="d-flex align-content-center"><i class="mr-2 fas fa-home"></i>
                                                            <p class="m-0"><strong>Delivery Mode</strong>: Classroom-based
                                                            </p>
                                                        </li>
                                                        <li class="d-flex align-content-center"><i
                                                                class="mr-2 fas fa-certificate"></i>
                                                            <p class="m-0"><strong>Award</strong>: Award: Successful
                                                                candidates will receive a Certificate of Completion and ID Card.
                                                            </p>
                                                        </li>
                                                        <li class="d-flex align-content-center"><i
                                                                class="mr-2 fas fa-money-bill-wave"></i>
                                                            <p class="m-0"><strong>Duration</strong>: 2 hours</p>
                                                        </li>
                                                        <li class="d-flex align-content-center"><i
                                                                class="mr-2 far fa-clock"></i>
                                                            <p class="m-0"><strong>Price</strong>: from £67.50</p>
                                                        </li>
                                                    </ul>
                                                    <div class="panelViewDateBtn">
                                                        <a href="{{route('course.show', 'traffic-marshall-trainining')}}">View Dates &amp; Venues</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </section>
        <section class="whoTmVb position-relative">
            <div class="container">
                <h2 class="fs2 text-center mb-5 px-3 px-md-0 px-lg-0">Who is the Traffic Marshall and Banksman Training for?
                </h2>
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                        <ul class="m-0 p-0 list-unstyled whoTmVbList">
                            <li class="mb-5" data-aos="fade-right">
                                <div class="d-flex align-items-center">
                                    <div class="whoTmVbIcon d-flex align-items-center justify-content-center mr-3">
                                        <i class="fa-regular fa-square-check text-white"></i>
                                    </div>
                                    <div class="whoTmVbInfo">
                                        <p class="mb-2"><strong>Site Managers & Supervisors:</strong></p>
                                        <p class="m-0">Ensure vehicle operations run smoothly and safely.</p>
                                    </div>
                                </div>
                            </li>
                            <li class="mb-5" data-aos="fade-right">
                                <div class="d-flex align-items-center">
                                    <div class="whoTmVbIcon d-flex align-items-center justify-content-center mr-3">
                                        <i class="fa-regular fa-square-check text-white"></i>
                                    </div>
                                    <div class="whoTmVbInfo">
                                        <p class="mb-2"><strong>Vehicle Operators:</strong></p>
                                        <p class="m-0">Essential training for those directing and managing vehicle
                                            movements.</p>
                                    </div>
                                </div>
                            </li>
                            <li class="mb-5" data-aos="fade-right">
                                <div class="d-flex align-items-center">
                                    <div class="whoTmVbIcon d-flex align-items-center justify-content-center mr-3">
                                        <i class="fa-regular fa-square-check text-white"></i>
                                    </div>
                                    <div class="whoTmVbInfo">
                                        <p class="mb-2"><strong>Construction Workers:</strong></p>
                                        <p class="m-0">Enhance safety skills and credentials on busy job sites.</p>
                                    </div>
                                </div>
                            </li>
                            <li class="mb-5" data-aos="fade-right">
                                <div class="d-flex align-items-center">
                                    <div class="whoTmVbIcon d-flex align-items-center justify-content-center mr-3">
                                        <i class="fa-regular fa-square-check text-white"></i>
                                    </div>
                                    <div class="whoTmVbInfo">
                                        <p class="mb-2"><strong>Logistics Professionals:</strong></p>
                                        <p class="m-0">Improve safety protocols in vehicle-heavy environments.</p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                        <ul class="m-0 p-0 list-unstyled whoTmVbList">
                            <li class="mb-5" data-aos="fade-left">
                                <div class="d-flex align-items-center">
                                    <div class="whoTmVbIcon d-flex align-items-center justify-content-center mr-3">
                                        <i class="fa-regular fa-square-check text-white"></i>
                                    </div>
                                    <div class="whoTmVbInfo">
                                        <p class="mb-2"><strong>Career Advancers:</strong></p>
                                        <p class="m-0">Boost your qualifications in the construction and logistics
                                            industries.</p>
                                    </div>
                                </div>
                            </li>
                            <li class="mb-5" data-aos="fade-left">
                                <div class="d-flex align-items-center">
                                    <div class="whoTmVbIcon d-flex align-items-center justify-content-center mr-3">
                                        <i class="fa-regular fa-square-check text-white"></i>
                                    </div>
                                    <div class="whoTmVbInfo">
                                        <p class="mb-2"><strong>Newcomers:</strong></p>
                                        <p class="m-0">Get foundational training to start your role with confidence.</p>
                                    </div>
                                </div>
                            </li>
                            <li class="mb-5" data-aos="fade-left">
                                <div class="d-flex align-items-center">
                                    <div class="whoTmVbIcon d-flex align-items-center justify-content-center mr-3">
                                        <i class="fa-regular fa-square-check text-white"></i>
                                    </div>
                                    <div class="whoTmVbInfo">
                                        <p class="mb-2"><strong>Experienced Workers:</strong></p>
                                        <p class="m-0">Refresh and update your safety practices.</p>
                                    </div>
                                </div>
                            </li>
                            <li class="mb-5" data-aos="fade-left">
                                <div class="d-flex align-items-center">
                                    <div class="whoTmVbIcon d-flex align-items-center justify-content-center mr-3">
                                        <i class="fa-regular fa-square-check text-white"></i>
                                    </div>
                                    <div class="whoTmVbInfo">
                                        <p class="mb-2"><strong>Safety Officers:</strong></p>
                                        <p class="m-0">Maintain and enforce a safe work environment involving vehicles.
                                        </p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <section class="topicsCovered">
            <div class="container">
                <h2 class="fs2 text-center mb-5 px-3 px-md-0 px-lg-0">Topics Covered</h2>
                <p class="mb-5">The Traffic Marshal, Vehicle banksman course is designed to equip participants with the essential
                    knowledge and skills required for effective traffic management not only on construction sites but also
                    in busy docks, factories, and warehouses. The curriculum covers a wide range of topics critical to
                    maintaining a safe and legally compliant work environment in these dynamic and potentially hazardous
                    settings. Below is an overview of the key areas of focus:</p>
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                        <div class="topicsCoveredList">
                            <div class="topicsCoveredBox d-flex align-items-center mb-5" data-aos="fade-right">
                                <i class="fa-regular fa-square-check mr-3"></i>
                                <p class="m-0 h5">Health and safety</p>
                            </div>
                            <div class="topicsCoveredBox d-flex align-items-center mb-5" data-aos="fade-right">
                                <i class="fa-regular fa-square-check mr-3"></i>
                                <p class="m-0 h5">Construction law, regarding traffic management</p>
                            </div>
                            <div class="topicsCoveredBox d-flex align-items-center mb-5" data-aos="fade-right">
                                <i class="fa-regular fa-square-check mr-3"></i>
                                <p class="m-0 h5">Hazard analysis</p>
                            </div>
                            <div class="topicsCoveredBox d-flex align-items-center mb-5" data-aos="fade-right">
                                <i class="fa-regular fa-square-check mr-3"></i>
                                <p class="m-0 h5">Safeguarding pedestrians and other staff where vehicles may be reversing
                                </p>
                            </div>
                            <div class="topicsCoveredBox d-flex align-items-center mb-5" data-aos="fade-right">
                                <i class="fa-regular fa-square-check mr-3"></i>
                                <p class="m-0 h5">Safety signs</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                        <div class="topicsCoveredList">
                            <div class="topicsCoveredBox d-flex align-items-center mb-5" data-aos="fade-up">
                                <i class="fa-regular fa-square-check mr-3"></i>
                                <p class="m-0 h5">Who should be allowed on site</p>
                            </div>
                            <div class="topicsCoveredBox d-flex align-items-center mb-5" data-aos="fade-up">
                                <i class="fa-regular fa-square-check mr-3"></i>
                                <p class="m-0 h5">Administering first aid to a choking casualty</p>
                            </div>
                            <div class="topicsCoveredBox d-flex align-items-center mb-5" data-aos="fade-up">
                                <i class="fa-regular fa-square-check mr-3"></i>
                                <p class="m-0 h5">Risk management for directing vehicles</p>
                            </div>
                            <div class="topicsCoveredBox d-flex align-items-center mb-5" data-aos="fade-up">
                                <i class="fa-regular fa-square-check mr-3"></i>
                                <p class="m-0 h5">Demonstrating the code of hand signals recommended by the HSE</p>
                            </div>
                            <div class="topicsCoveredBox d-flex align-items-center mb-5" data-aos="fade-up">
                                <i class="fa-regular fa-square-check mr-3"></i>
                                <p class="m-0 h5">Accident prevention</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                        <div class="topicsCoveredList">
                            <div class="topicsCoveredBox d-flex align-items-center mb-5" data-aos="fade-left">
                                <i class="fa-regular fa-square-check mr-3"></i>
                                <p class="m-0 h5">Safety of vehicle access</p>
                            </div>
                            <div class="topicsCoveredBox d-flex align-items-center mb-5" data-aos="fade-left">
                                <i class="fa-regular fa-square-check mr-3"></i>
                                <p class="m-0 h5">Hazard analysis</p>
                            </div>
                            <div class="topicsCoveredBox d-flex align-items-center mb-5" data-aos="fade-left">
                                <i class="fa-regular fa-square-check mr-3"></i>
                                <p class="m-0 h5">Identifying dangerous manoeuvres (reversing)</p>
                            </div>
                            <div class="topicsCoveredBox d-flex align-items-center mb-5" data-aos="fade-left">
                                <i class="fa-regular fa-square-check mr-3"></i>
                                <p class="m-0 h5">Legal obligations and responsibilities of employers and their employees
                                </p>
                            </div>
                            <div class="topicsCoveredBox d-flex align-items-center mb-5" data-aos="fade-left">
                                <i class="fa-regular fa-square-check mr-3"></i>
                                <p class="m-0 h5">How to plan the use of vehicles</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="discoverBenefits aboutCITB position-relative px-3 px-md-5 px-lg-5">
            <div class="container">
                <h2 class="fs2 px-3 px-md-0 px-lg-0 text-center mb-5">Boosting Site Safety, Compliance, and Efficiency with
                    relevant training</h2>
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-4">
                        <div class="discoverBenefitsInfo pl-0">
                            <div class="discoverBenefitsBox d-flex mb-5" data-aos="fade-right">
                                <div class="discoverBenefitsIcon d-flex align-items-center justify-content-center">
                                    <i class="fa-solid fa-circle-question"></i>
                                </div>
                                <div class="discoverBenefitsDesc">
                                    <p class="h5 mb-3">Enhancing Site Safety</p>
                                    <p>Imagine a bustling construction site with vehicles constantly moving in and out. With
                                        proper guidance, the risk of accidents remains high. It is where the Traffic Marshal and
                                        Banksman step in. Their training ensures they can manage vehicle movements safely,
                                        preventing accidents and protecting lives. They're taught to identify potential hazards,
                                        control risks, and use effective communication signals to direct traffic. It's not just
                                        about waving vehicles through; it's about ensuring every movement is safe and efficient.
                                    </p>
                                    <a href="javascript:;" class="btnSimple">Read More <i
                                            class="fa-solid fa-chevron-right"></i></a>
                                </div>
                            </div>
                            <div class="discoverBenefitsBox d-flex mb-5" data-aos="fade-right">
                                <div class="discoverBenefitsIcon d-flex align-items-center justify-content-center">
                                    <i class="fa-solid fa-circle-question"></i>
                                </div>
                                <div class="discoverBenefitsDesc">
                                    <p class="h5 mb-3">Regulatory Compliance</p>
                                    <p>The UK has some of the world's strictest health and safety regulations. Companies that
                                        fail to comply with these regulations can face hefty fines, legal trouble, and damage to
                                        their reputation. Traffic Marshall and Banksman Training helps businesses meet these
                                        stringent requirements. By equipping workers with legal responsibilities and best
                                        practices, companies can confidently comply with the law, avoiding penalties and
                                        fostering a safer workplace.</p>
                                    <a href="javascript:;" class="btnSimple">Read More <i
                                            class="fa-solid fa-chevron-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 d-none d-xl-block" data-aos="fade-up">
                        <div class="discoverBenefitsImg">
                            <img src="{{ asset('frontend/img/CITB-Levy-Funding.webp') }}" alt="Traffic Marshall Training"
                                class="img-fluid">
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-4">
                        <div class="discoverBenefitsInfo pr-0">
                            <div class="discoverBenefitsBox d-flex mb-5" data-aos="fade-left">
                                <div class="discoverBenefitsIcon d-flex align-items-center justify-content-center">
                                    <i class="fa-solid fa-circle-question"></i>
                                </div>
                                <div class="discoverBenefitsDesc">
                                    <p class="h5 mb-3">Skill Development</p>
                                    <p>This training is more than a course; it's a skill-building journey. Participants learn
                                        crucial abilities such as hazard identification, risk assessment, and effective
                                        communication. These skills are essential for anyone involved in site operations.
                                        Knowing how to spot potential dangers and communicate clearly can distinguish between a
                                        smooth operation and a disaster.</p>
                                    <a href="javascript:;" class="btnSimple">Read More <i
                                            class="fa-solid fa-chevron-right"></i></a>
                                </div>
                            </div>
                            <div class="discoverBenefitsBox d-flex mb-5" data-aos="fade-left">
                                <div class="discoverBenefitsIcon d-flex align-items-center justify-content-center">
                                    <i class="fa-solid fa-circle-question"></i>
                                </div>
                                <div class="discoverBenefitsDesc">
                                    <p class="h5 mb-3">Operational Efficiency</p>
                                    <p>A well-trained Traffic Marshal and Banksman enhance safety and boost efficiency.
                                        Effectively managing vehicle movements helps reduce delays and keeps projects on track.
                                        Think of them as traffic controllers at a busy airport, ensuring everything flows
                                        smoothly without a hitch. This efficiency translates to better productivity, timely
                                        project completion, and, ultimately, cost savings for the company.</p>
                                    <a href="javascript:;" class="btnSimple">Read More <i
                                            class="fa-solid fa-chevron-right"></i></a>
                                </div>
                            </div>
                            <div class="discoverBenefitsBox d-flex mb-5" data-aos="fade-left">
                                <div class="discoverBenefitsIcon d-flex align-items-center justify-content-center">
                                    <i class="fa-solid fa-circle-question"></i>
                                </div>
                                <div class="discoverBenefitsDesc">
                                    <p class="h5 mb-3">Fostering a Culture of Safety</p>
                                    <p>Investing in Traffic Marshall and Banksman Training is about more than just meeting legal
                                        requirements and creating a safety culture. When workers are trained to prioritise
                                        safety, it becomes a core value of the organization. This culture reduces accidents,
                                        enhances worker morale, and improves site operations.</p>
                                    <a href="javascript:;" class="btnSimple">Read More <i
                                            class="fa-solid fa-chevron-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        {{-- Form --}}
        <div id="contactForm">
            <x-frontend.request_form />
        </div>
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
            $('.hover').hover(
                function() {
                    $(this).addClass('flip');
                },
                function() {
                    $(this).removeClass('flip');
                });
        });
    </script>
@endpush
