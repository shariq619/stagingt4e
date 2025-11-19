@extends('layouts.frontend')
@section('title', 'E-learning & Bite Courses')
@section('main')
    <div class="eLearningWrapper coursePage">
        <section id="banner" class="bannerWrapper">
            <div class="container">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-4 col-lg-4 bannerImg" data-aos="fade-right"></div>
                <div class="col-12 col-sm-12 col-md-8 col-lg-8 py-5" data-aos="fade-left">
                    <div class="bannerCol px-3 px-lg-0 px-md-0 px-xl-0 pl-xl-5 pl-lg-5 pl-md-5 mr-xl-5 pr-xl-5">
                        <div class="bannerInfo">
                            <h1 class="mb-5">E-learning and Bite Size Courses</strong></h1>
                            <p class="mb-4">Whether you're looking to enhance your career prospects, upskill your workforce, or explore a
                                new field, our e-learning solutions offer flexibility, expert knowledge, and
                                industry-relevant content.</p>
                            <ul class="list-unstyled p-0 m-0 mb-5">
                                <li class="d-flex mb-3">
                                    <i class="far mt-2 fa-check-square mr-2"></i>
                                    <p class="m-0 font-weight-normal">Flexible Learning - Study at your convenience, whether part-time or full-time.</p>
                                </li>
                                <li class="d-flex mb-3">
                                    <i class="far mt-2 fa-check-square mr-2"></i>
                                    <p class="m-0 font-weight-normal">Expert-Led Courses - Gain insights from industry professionals and subject matter experts.</p>
                                </li>
                                <li class="d-flex mb-3">
                                    <i class="far mt-2 fa-check-square mr-2"></i>
                                    <p class="m-0 font-weight-normal">Learn online from any device, with 24/7 access to course materials.</p>
                                </li>
                                <li class="d-flex mb-3">
                                    <i class="far mt-2 fa-check-square mr-2"></i>
                                    <p class="m-0 font-weight-normal">Recognised qualifications and certifications upon completion</p>
                                </li>
                            </ul>
                        </div>
                        <div class="bookingBtnGroup d-flex flex-column flex-md-row flex-lg-row mt-4">
                            <a href="javascript:;" class="mb-2 mb-md-0 mb-lg-0 btnMstr text-center text-white">
                                <i class="fa-solid fa-circle-arrow-down mr-2"></i> Start Learning Today!
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </section>
        <section class="eLearningWhorAre">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-center">
                        <h2 class="fs2 mb-5">E-Learning and Bite-Size Training | Professional Development at Your Pace</h2>
                        <p>Unlock flexible learning with our expertly designed e-learning and bite-size courses. Ideal for
                            job seekers, employees, and employers, our courses offer recognised qualifications and
                            certifications, helping you enhance your career prospects or upskill your team. Learn anytime,
                            anywhere, from industry professionals and access content on any device. Whether you’re looking
                            to stay compliant or expand your expertise, our courses cover a wide range of subjects to suit
                            your needs.</p>

                        <p class="h4 mb-5 pb-5 mt-5">Who Are Our Courses For?</p>
                    </div>
                    <div class="col-12 col-sm-12 col-md-4 col-lg-4 col1" data-aos="zoom-in-up">
                        <div class="eLearningWhorAreBox h-100 text-center">
                            <img src="{{ asset('frontend/img/Job Seekers.png') }}" class="img-fluid w-25" alt="Job Seekers">
                            <h4 class="mb-4">Job Seekers:</h4>
                            <p>Enhance your employability by acquiring new skills and qualifications.</p>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-4 col-lg-4 col2" data-aos="zoom-in-up">
                        <div class="eLearningWhorAreBox h-100 text-center">
                            <img src="{{ asset('frontend/img/Employees.png') }}" class="img-fluid w-25" alt="Employees">
                            <h4 class="mb-4">Employees:</h4>
                            <p>Gain additional expertise to progress in your current role or pivot to a new industry.</p>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-4 col-lg-4 col3" data-aos="zoom-in-up">
                        <div class="eLearningWhorAreBox h-100 text-center">
                            <img src="{{ asset('frontend/img/Employers.png') }}" class="img-fluid w-25" alt="Employers">
                            <h4 class="mb-4">Employers:</h4>
                            <p>Provide your team with professional development opportunities and ensure they stay compliant
                                with regulations.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="commitmentWraapper position-relative">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-6" data-aos="fade-up-right">
                        <img src="{{ asset('frontend/img/elearning.png') }}" class="img-fluid" alt="Our Commitment to Your Success">
                    </div>
                    <div class="col-12 col-md-6 col-lg-6" data-aos="fade-up-left">
                        <h2 class="fs2 mb-5">Our Commitment to Your Success</h2>
                        <p class="mb-4">We are dedicated to offering training solutions that cater to the needs of modern learners. With
                            user-friendly platforms, support from experienced trainers, and content that’s accessible from
                            any device, you can be confident in achieving your learning goals. Discover how our e-learning
                            and bite-size training can support your career and business growth today.</p>
                        <ul class="m-0 pl-3 list-unstyled">
                            <li><i class="fa-solid fa-circle-check"></i> <strong>24/7 Access</strong></li>
                            <li><i class="fa-solid fa-circle-check"></i> <strong>Expert-Led Content</strong></li>
                            <li><i class="fa-solid fa-circle-check"></i> <strong>Flexible Learning</strong></li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <section class="weOffer">
            <div class="container">
                <h2 class="fs2 text-center mb-5">Explore E-learning Courses We Offer</h2>
                <div class="row">
                    @include('frontend.categories.courses.index', ['courses' => $category->courses])
                </div>
            </div>
        </section>
    </div>
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
