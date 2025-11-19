@extends('layouts.frontend')
@section('title', 'About Us')

@section('main')
    <section class="pageHeaderMain">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-8 col-lg-8">
                    <div class="pageHeaderTitle" data-aos="fade-right">
                        <h1>About Us</h1>
{{--                        <p class="my-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum vestibulum--}}
{{--                            aliquam pretium. Ut in dignissim dolor. Praesent convallis euismod turpis, condimentum--}}
{{--                            condimentum erat faucibus vitae.</p>--}}
                        <ul class="m-0 p-0 list-unstyled d-flex align-items-center">
                            <li class="mr-2"><a href="{{ route('home.index') }}">Home</a></li>
                            <li class="mr-2"><i class="fa-solid fa-angles-right"></i></li>
                            <li class="mr-2"><a href="javascript:;">About Us</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="bannerBox">
        <div class="row align-items-center">
            <div class="col-12 col-md-4 col-lg-4 bannerBoxRight" data-aos="fade-up-right">
                <div class="px-3">
                    <h2 class="fs2 mb-5">Welcome to Training for Employment</h2>
                    <p>At Training for Employment, we specialise in delivering key training programmes across the UK, with a
                        particular focus on SIA security training, first aid certification, fire safety courses, and
                        construction training.</p>
                    <P>All our accredited courses are led by industry professionals, ensuring learners gain the
                        qualifications needed for career progression and compliance with industry standards. Contact us
                        today to start your training journey!</P>
                </div>
            </div>
            <div class="col-12 col-md-8 col-lg-8 bannerBoxLeft">
                <div class="row bannerBoxRow">
                    <div class="col-12 col-md-6 col-lg-6" data-aos="zoom-in-up">
                        <div class="bannerBoxInner d-flex align-items-center">
                            <div class="bannerBoxInnerIcon">
                                <i class="fa-solid fa-crosshairs"></i>
                            </div>
                            <div class="bannerBoxInnerInfo">
                                <h3 class="h5">Our Commitment to Excellence</h3>
                                <p class="m-0">We pride ourselves on our high pass rates, achieved through the expertise
                                    of our industry-leading trainers. Our support extends beyond the classroom, offering CV
                                    building and job search assistance to ensure our learners' success.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6" data-aos="zoom-in-up">
                        <div class="bannerBoxInner d-flex align-items-center">
                            <div class="bannerBoxInnerIcon">
                                <i class="fa-solid fa-rocket"></i>
                            </div>
                            <div class="bannerBoxInnerInfo">
                                <h3 class="h5">Accreditations and Partnerships</h3>
                                <p class="m-0">Our training programs are accredited by respected organisations such as <a
                                        href="https://www.citb.co.uk/courses-and-qualifications/find-a-training-course/site-safety-plus-courses//"
                                        target="_blank">Highfield CITB</a> and <a
                                        href="https://www.highfieldqualifications.com/" target="_blank"
                                        rel="noopener">Highfield Qualifications</a>, ensuring the highest standards of
                                    education and industry relevance.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6" data-aos="zoom-in-up">
                        <div class="bannerBoxInner d-flex align-items-center">
                            <div class="bannerBoxInnerIcon">
                                <i class="fa-solid fa-lightbulb"></i>
                            </div>
                            <div class="bannerBoxInnerInfo">
                                <h3 class="h5">Tailored Training Solutions for Businesses</h3>
                                <p class="m-0">Our corporate training programs are designed to meet the specific needs of
                                    businesses, offering off-site and on-site training solutions that ensure your team is
                                    fully prepared to handle daily workplace challenges. These courses cover essential
                                    skills and knowledge, providing your staff with the tools they need to maintain a safe
                                    and compliant working environment.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6" data-aos="zoom-in-up">
                        <div class="bannerBoxInner d-flex align-items-center">
                            <div class="bannerBoxInnerIcon">
                                <i class="fa-solid fa-hands-holding"></i>
                            </div>
                            <div class="bannerBoxInnerInfo">
                                <h3 class="h5">High Pass Rates</h3>
                                <p class="m-0">We have an extremely high first-time pass rate. All our trainers have a
                                    vast amount of experience in the field, we work with our learners to create a bespoke,
                                    relevant and interactive courses, supported by highly qualified trainers and assessors.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="col-12">
                <div class="px-lg-5 px-md-5 px-sm-3 px-2 text-center mb-5">
                    <h2 class="mb-5 fs2"><strong>Welcome to Training for Employment</strong></h2>
                    <p>At Training for Employment, we specialise in delivering key training programmes across the UK, with a
                        particular focus on SIA security training, first aid certification, fire safety courses, and
                        construction training.</p>
                    <p>All our accredited courses are led by industry professionals, ensuring learners gain the
                        qualifications needed for career progression and compliance with industry standards. Contact us
                        today to start your training journey!</p>
                </div>
            </div>
            <div class="col-12 col-md-8 col-lg-8">
                <div class="Box3d mb-4 d-flex">
                    <img src="{{asset('frontend/img/Our Commitment to Excellence.png')}}" class="img-fluid mr-3">
                    <div>
                        <h3 class="h5">Our Commitment to Excellence</h3>
                        <p class="m-0">We pride ourselves on our high pass rates, achieved through the expertise of our
                            industry-leading
                            trainers. Our support extends beyond the classroom, offering CV building and job search assistance
                            to ensure our learners' success.</p>
                    </div>
                </div>
            </div>
            <div class="col-12 offset-0 offset-md-4 offset-lg-4 col-md-8 col-lg-8">
                <div class="Box3d mb-4 d-flex">
                    <img src="{{asset('frontend/img/Accreditations and Partnerships.png')}}" class="img-fluid mr-3">
                    <div>
                        <h3 class="h5">Accreditations and Partnerships</h3>
                        <p class="m-0">Our training programs are accredited by respected organisations such as <a
                                href="https://www.citb.co.uk/courses-and-qualifications/find-a-training-course/site-safety-plus-courses//"
                                target="_blank">Highfield CITB</a> and <a href="https://www.highfieldqualifications.com/"
                                target="_blank" rel="noopener">Highfield
                                Qualifications</a>, ensuring the highest standards of education and industry relevance.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-8 col-lg-8">
                <div class="Box3d mb-4 d-flex">
                    <img src="{{asset('frontend/img/Tailored Training Solutions for Businesses.png')}}" class="img-fluid mr-3">
                    <div>
                        <h3 class="h5">Tailored Training Solutions for Businesses</h3>
                        <p class="m-0">Our corporate training programs are designed to meet the specific needs of businesses,
                            offering off-site and on-site training solutions that ensure your team is fully prepared to handle
                            daily workplace challenges. These courses cover essential skills and knowledge, providing your staff
                            with the tools they need to maintain a safe and compliant working environment.</p>
                    </div>
                </div>
            </div>
            <div class="col-12 offset-0 offset-md-4 offset-lg-4 col-md-8 col-lg-8">
                <div class="Box3d mb-4 d-flex">
                    <img src="{{asset('frontend/img/High Pass Rates.png')}}" class="img-fluid mr-3">
                    <div>
                        <h3 class="h5">High Pass Rates</h3>
                        <p class="m-0">We have an extremely high first-time pass rate. All our trainers have a vast amount of
                            experience in the field, we work with our learners to create a bespoke, relevant and interactive
                            courses, supported by highly qualified trainers and assessors.</p>
                    </div>
                </div>
            </div> --}}
        </div>
    </section>
    {{-- <section class="bannerAboutUs">
        <div class="row align-items-center">
            <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                <div class="row aboutBannerBoxRow">
                    <div class="aboutBannerBox col-12 col-sm-12 col-md-6 col-lg-6">
                        <div class="px-2 px-sm-3 px-md-4 px-lg-4 py-2 py-sm-3 py-md-4 py-lg-4">
                            <h3>Our Commitment to Excellence</h3>
                            <p>We pride ourselves on our high pass rates, achieved through the expertise of our
                                industry-leading trainers. Our support extends beyond the classroom, offering CV building
                                and job search assistance to ensure our learners' success.</p>
                        </div>
                    </div>
                    <div class="aboutBannerBox col-12 col-sm-12 col-md-6 col-lg-6">
                        <div class="px-2 px-sm-3 px-md-4 px-lg-4 py-2 py-sm-3 py-md-4 py-lg-4">
                            <h3>Tailored Training Solutions for Businesses</h3>
                            <p>Our corporate training programs are designed to meet the specific needs of businesses,
                                offering off-site and on-site training solutions that ensure your team is fully prepared to
                                handle daily workplace challenges. These courses cover essential skills and knowledge,
                                providing your staff with the tools they need to maintain a safe and compliant working
                                environment.</p>
                        </div>
                    </div>
                    <div class="aboutBannerBox col-12 col-sm-12 col-md-6 col-lg-6">
                        <div class="px-2 px-sm-3 px-md-4 px-lg-4 py-2 py-sm-3 py-md-4 py-lg-4">
                            <h3>Accreditations and Partnerships</h3>
                            <p>Our training programs are accredited by respected organisations such as <a
                                    href="https://www.citb.co.uk/courses-and-qualifications/find-a-training-course/site-safety-plus-courses//"
                                    target="_blank">Highfield CITB</a> and <a
                                    href="https://www.highfieldqualifications.com/" target="_blank" rel="noopener">Highfield
                                    Qualifications</a>, ensuring the highest standards of education and industry relevance.
                            </p>
                        </div>
                    </div>
                    <div class="aboutBannerBox col-12 col-sm-12 col-md-6 col-lg-6">
                        <div class="px-2 px-sm-3 px-md-4 px-lg-4 py-2 py-sm-3 py-md-4 py-lg-4">
                            <h3>High Pass Rates</h3>
                            <p>We have an extremely high first-time pass rate. All our trainers have a vast amount of
                                experience in the field, we work with our learners to create a bespoke, relevant and
                                interactive courses, supported by highly qualified trainers and assessors.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    <section class="animateCounter py-5">
        <div class="container pt-5">
            <div class="row pb-5">
                {{-- <div class="col-md-2 col-lg-2 d-none d-lg-block d-md-block"></div> --}}
                <div class="col-12 col-sm-12 col-md-8 col-lg-8 offset-lg-2 offset-md-2 mb-5">
                    <h2 class="text-center mb-5 fs2">We'll Help You Achieve Your Goals</h2>
                </div>
                <div class="col-12 col-sm-4 col-md-4 col-lg-4" data-aos="fade-down">
                    <div class="counter text-center">
                        <div class="borderCounter mb-3 ml-auto mr-auto w-50"></div>
                        <span class="count archivo">17</span><span>K+</span>
                        <p class="font-weight-bold text-uppercase h5 my-4 archivo">Individuals Trained</p>
                        <p>17,907 Individuals Trained since 2010.</p>
                    </div>
                </div>
                <div class="col-12 col-sm-4 col-md-4 col-lg-4" data-aos="fade-down">
                    <div class="counter text-center">
                        <div class="borderCounter mb-3 ml-auto mr-auto w-50"></div>
                        <span class="count archivo">405</span>
                        <p class="font-weight-bold text-uppercase h5 my-4 archivo">Courses Conducted</p>
                        <p>405 Courses Conducted in 2023.</p>
                    </div>
                </div>
                <div class="col-12 col-sm-4 col-md-4 col-lg-4" data-aos="fade-down">
                    <div class="counter text-center">
                        <div class="borderCounter mb-3 ml-auto mr-auto w-50"></div>
                        <span class="count archivo">97</span><span>%</span>
                        <p class="font-weight-bold text-uppercase h5 my-4 archivo">Pass Rate</p>
                        <p>We have an extremely high first-time pass rate.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="ourServices py-5">
        <div class="container">
            <h2 class="text-center mb-5 mt-5 px-3 px-lg-0 px-xl-0 fs2">Our Services</h2>
            <div class="row">
                <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4" data-aos="fade-down">
                    <div class="services mb-5">
                        <img src="{{ asset('frontend/img/on-site.webp') }}" class="img-fluid"
                            alt="On-site delivery">
                        <div class="servicesContent">
                            <h4 class="my-4"><a href="javascript:;">On-site delivery:</a></h4>
                            <p>We bring our expert training directly to your location, ensuring minimal disruption to your
                                business.</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4" data-aos="fade-down">
                    <div class="services mb-5">
                        <img src="{{ asset('frontend/img/off-site.webp') }}" class="img-fluid"
                            alt="Off-site training">
                        <div class="servicesContent">
                            <h4 class="my-4"><a href="javascript:;">Off-site training:</a></h4>
                            <p>Attend one of our dedicated training centres for in-depth, hands-on learning.</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4" data-aos="fade-down">
                    <div class="services mb-5">
                        <img src="{{ asset('frontend/img/e-learning.webp') }}" class="img-fluid"
                            alt="E-learning options">
                        <div class="servicesContent">
                            <h4 class="my-4"><a href="javascript:;">E-learning options:</a></h4>
                            <p>Access flexible online training programmes that fit around your schedule.</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4" data-aos="fade-down">
                    <div class="services mb-5">
                        <img src="{{ asset('frontend/img/Learner portal.webp') }}" class="img-fluid"
                            alt="24/7 learner portal">
                        <div class="servicesContent">
                            <h4 class="my-4"><a href="javascript:;">24/7 learner portal::</a></h4>
                            <p>Enjoy round-the-clock access to training materials and progress tracking through our online
                                learner portal.</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4" data-aos="fade-down">
                    <div class="services mb-5">
                        <img src="{{ asset('frontend/img/learning portal.webp') }}" class="img-fluid"
                            alt="Customer portal">
                        <div class="servicesContent">
                            <h4 class="my-4"><a href="javascript:;">Customer portal:</a></h4>
                            <p>Businesses can manage bookings, track employee progress, and access important documentation
                                via our customer portal.</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4" data-aos="fade-down">
                    <div class="services mb-5">
                        <img src="{{ asset('frontend/img/application support.webp') }}" class="img-fluid"
                            alt="Support with SIA and CSCS Green Card
                                    applications">
                        <div class="servicesContent">
                            <h4 class="my-4"><a href="javascript:;">Support with SIA and CSCS Green Card
                                    applications:</a></h4>
                            <p>We assist you through the application process for both SIA licences and the CSCS Green
                                Labourer Card, helping you navigate the requirements with ease.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="abtWhyChoose py-5">
        <div class="container">
            <h2 class="text-center mb-5 mt-4 px-3 px-lg-0 px-xl-0 fs2">Why Choose Us</h2>
            <div class="abtWhyChooseRow d-flex">
                <div class="abtWhyChooseCol px-2 px-sm-2 px-md-3 px-lg-3" data-aos="zoom-in-up">
                    <div class="whyChooseColInner text-center">
                        <h4 class="mb-4">Industry leading Courses</h4>
                        <p>From security industry qualifications to first aid and workplace safety training, our courses are
                            designed to meet legal and professional standards.</p>
                    </div>
                </div>
                <div class="abtWhyChooseCol px-2 px-sm-2 px-md-3 px-lg-3" data-aos="zoom-in-up">
                    <div class="whyChooseColInner text-center">
                        <h4 class="mb-4">Expert Trainers</h4>
                        <p>Our trainers are highly qualified professionals with years of industry experience, ensuring you
                            receive the best guidance.</p>
                    </div>
                </div>
                <div class="abtWhyChooseCol px-2 px-sm-2 px-md-3 px-lg-3" data-aos="zoom-in-up">
                    <div class="whyChooseColInner text-center">
                        <h4 class="mb-4">Tailored Solutions</h4>
                        <p>We provide flexible training solutions for businesses, customising courses to fit the specific
                            needs of your organisation.</p>
                    </div>
                </div>
                <div class="abtWhyChooseCol px-2 px-sm-2 px-md-3 px-lg-3" data-aos="zoom-in-up">
                    <div class="whyChooseColInner text-center">
                        <h4 class="mb-4">Recognised Certifications</h4>
                        <p>We are accredited by top bodies such as the Highfield Qualifications and CITB ensuring our
                            certifications are accepted nationwide.</p>
                    </div>
                </div>
                <div class="abtWhyChooseCol px-2 px-sm-2 px-md-3 px-lg-3" data-aos="zoom-in-up">
                    <div class="whyChooseColInner text-center">
                        <h4 class="mb-4">Comprehensive Support</h4>
                        <p>We support learners from enrolment to certification, offering expert advice and assistance at
                            every step of the way.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('css')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Archivo:ital,wght@0,100..900;1,100..900&family=Raleway:ital,wght@0,100..900;1,100..900&family=Rubik:ital,wght@0,300..900;1,300..900&display=swap');

        .archivo {
            font-family: "Archivo", sans-serif;
            font-optical-sizing: auto;
            font-style: normal;
            font-variation-settings:
                "wdth" 100;
        }
    </style>
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
            $('.count').each(function() {
                $(this).prop('Counter', 0).animate({
                    Counter: $(this).text()
                }, {
                    duration: 4000,
                    easing: 'swing',
                    step: function(now) {
                        $(this).text(Math.ceil(now));
                    }
                });
            });
        });
    </script>
@endpush
