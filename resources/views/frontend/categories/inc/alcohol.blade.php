@extends('layouts.frontend')
@section('title', 'Alcohol Licence Training')
@section('main')
    <div class="personalLicence coursePage">
        <section id="banner" class="bannerWrapper">
            <div class="container">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-4 col-lg-4 bannerImg" data-aos="fade-right"></div>
                <div class="col-12 col-sm-12 col-md-8 col-lg-8 py-5" data-aos="fade-left">
                    <div class="bannerCol px-3 px-lg-0 px-md-0 px-xl-0 pl-xl-5 pl-lg-5 pl-md-5 mr-xl-5 pr-xl-5">
                        <div class="bannerInfo">
                            <h1 class="mb-4" style="font-size: 25px;line-height: 25px;">Gain essential training to obtain
                                a Personal Licence required for responsible alcohol sales and compliance with licensing
                                laws.</h1>
                            <ul class="list-unstyled p-0 m-0">
                                <li class="mb-2"><i class="far fa-check-square mr-2"></i> Expert Trainers</li>
                                <li class="mb-2"><i class="far fa-check-square mr-2"></i> Free Mock Exams Included</li>
                                <li class="mb-2"><i class="far fa-check-square mr-2"></i> Free Exam Retakes</li>
                                <li class="mb-2"><i class="far fa-check-square mr-2"></i> Online Learning with Flexible Face-to-face Assessment</li>
                                <li class="mb-2"><i class="far fa-check-square mr-2"></i> Nationwide Delivery</li>
                            </ul>
                        </div>
                        <div class="bookingBtnGroup d-flex flex-column flex-md-row flex-lg-row mt-4 mb-5">
                            <a href="#alchoholSec"
                                class="mr-lg-2 mr-md-2 mr-sm-0 mb-2 mb-md-0 mb-lg-0 btnMstr text-center"><i
                                    class="fas fa-shopping-cart"></i> Book Now</a>
                            <a href="javascript:;" class="btnWhiteBg text-center" data-toggle="modal" data-target="#bespokeForm"><i class="fas fa-users"></i> Request
                                Bespoke
                                Training</a>
                        </div>
                        <script defer async src='https://cdn.trustindex.io/loader.js?c6282b731b132346ef669eb8980'></script>
                    </div>
                </div>
            </div>
            </div>
        </section>
        <section class="kickStarWrapper py-5">
            <div class="container">
                <h2 class="text-center mb-4 fs2 mb-5">How to get Personal Licence?</h2>
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-6 mb-4 mb-xl-0 col-lg-3 col-xl-3" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-duration="4000">
                        <div class="kickStarSteps d-flex justify-content-between">
                            <div class="kickStarIcon">
                                <i class="fa-solid fa-lightbulb"></i>
                            </div>
                            <div class="kickStarContent">
                                <h3>Step 1</h3>
                                <p class="m-0">
                                    <strong>Complete the Personal Licence Course</strong>
                                    Pass the APLH Level 2 course to gain the necessary qualification for your
                                    Personal Licence application.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 mb-4 mb-xl-0 col-lg-3 col-xl-3" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-duration="4000">
                        <div class="kickStarSteps d-flex justify-content-between">
                            <div class="kickStarIcon">
                                <i class="fa-solid fa-user-check"></i>
                            </div>
                            <div class="kickStarContent">
                                <h3>Step 2</h3>
                                <p class="m-0">
                                    <strong>Obtain a DBS Check</strong>
                                    You will need an Enhanced Disclosure and Barring Service (DBS) certificate to show that
                                    you have no criminal record. This can usually be applied for online or through your
                                    local council. <strong>Standard DBS Check Cost from: £18</strong>.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 mb-4 mb-xl-0 col-lg-3 col-xl-3" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-duration="4000">
                        <div class="kickStarSteps d-flex justify-content-between">
                            <div class="kickStarIcon">
                                <i class="fa-solid fa-file"></i>
                            </div>
                            <div class="kickStarContent">
                                <h3>Step 3</h3>
                                <p class="m-0">
                                    <strong>Submit an Application to Your Local Licensing Authority</strong>
                                    Once you’ve completed your training and received your DBS check, you can apply for your
                                    Personal Licence at your local licensing authority. <strong>Standard Application Fee
                                        Acreoss the
                                        UK: £37.</strong>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 mb-4 mb-xl-0 col-lg-3 col-xl-3" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-duration="4000">
                        <div class="kickStarSteps d-flex justify-content-between">
                            <div class="kickStarIcon">
                                <i class="fa-solid fa-id-card"></i>
                            </div>
                            <div class="kickStarContent">
                                <h3>Step 4</h3>
                                <p class="m-0">
                                    <strong>Approval and Granting of Your Personal Licence</strong>
                                    Your local licensing authority will review your application. If successful, they will
                                    issue your Personal Licence, which is valid for 10 years and allows you to authorise
                                    alcohol sales at any licensed premises in England and Wales.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="coursesWrapper py-5" id="alchoholSec">
            <div class="container">
                <h2 class="text-center mt-4 px-3 px-lg-0 px-xl-0 fs2 mb-5">Explore Our Personal Licence (APLH) Courses</h2>
                <div class="row justify-content-center" id="courses-container">
                    @include('frontend.categories.courses.index', ['courses' => $category->courses])
                </div>
            </div>
        </section>
        <section class="licenceCourse py-5">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-12 col-md-6 col-lg-6" data-aos="fade-up-right">
                        <img src="{{ asset('frontend/img/Personal-Licence.webp') }}" class="img-fluid" alt="A Personal Licence">
                    </div>
                    <div class="col-12 col-md-6 col-lg-6" data-aos="fade-up-left">
                        <h2 class="fs2 mb-3 mb-md-5 mb-lg-5 mb-xl-5 mt-4 mt-md-0 mt-lg-0 mt-xl-0">What is the Personal Licence Course?</h2>
                        <p class="h5 mb-4" style="color:#ea7000;">A Personal Licence is a legal requirement for anyone
                            looking to authorise the sale of alcohol in a retail or hospitality setting.</p>
                        <p>Whether you’re managing a pub, restaurant, or an off-licence, holding a Personal Licence allows
                            you to ensure that your establishment complies with the Licensing Act 2003.</p>
                        <p>Our course, officially known as the Award for Personal Licence Holders (APLH), provides the
                            essential training to apply for your licence, including vital information on the legal
                            responsibilities associated with alcohol sales.</p>
                    </div>
                </div>
            </div>
        </section>
        <section class="needLicenceCourse py-5">
            <div class="container" data-aos="fade-down">
                <h2 class="mb-5 fs2 text-left text-md-center text-lg-center text-xl-center">Who needs Personal Licence?</h2>
                <p class="text-left text-md-center text-lg-center text-xl-center mb-5">This course is ideal for anyone working in or
                    managing an alcohol-licensed premises, including:</p>
                <div class="row justify-content-center mb-4">
                    <div class="col-12 col-md-6 col-lg-6">
                        <div class="d-flex justify-content-between flex-column flex-md-row flex-lg-row flex-xl-row">
                            <div class="w-100">
                                <ul class="list-unstyled p-0 m-0 needFawBox">
                                    <li class="d-flex align-items-center mb-3">
                                        <i
                                            class="d-flex align-items-center text-white justify-content-center fa-regular fa-square-check mr-2"></i>
                                        <span class="w-100">Bar Managers</span>
                                    </li>
                                    <li class="d-flex align-items-center mb-3">
                                        <i
                                            class="d-flex align-items-center text-white justify-content-center fa-regular fa-square-check mr-2"></i>
                                        <span class="w-100">Pub Licensees</span>
                                    </li>
                                    <li class="d-flex align-items-center mb-3">
                                        <i
                                            class="d-flex align-items-center text-white justify-content-center fa-regular fa-square-check mr-2"></i>
                                        <span class="w-100">Restaurant Owners</span>
                                    </li>
                                </ul>
                            </div>
                            <div class="w-100">
                                <ul class="list-unstyled p-0 m-0 needFawBox">
                                    <li class="d-flex align-items-center mb-3">
                                        <i
                                            class="d-flex align-items-center text-white justify-content-center fa-regular fa-square-check mr-2"></i>
                                        <span class="w-100">Retail Managers</span>
                                    </li>
                                    <li class="d-flex align-items-center mb-3">
                                        <i
                                            class="d-flex align-items-center text-white justify-content-center fa-regular fa-square-check mr-2"></i>
                                        <span class="w-100">Event Managers</span>
                                    </li>
                                    <li class="d-flex align-items-center mb-3">
                                        <i
                                            class="d-flex align-items-center text-white justify-content-center fa-regular fa-square-check mr-2"></i>
                                        <span class="w-100">Hotel Staff</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <p class="px-3 px-md-0 px-lg-0 px-xl-0 text-left text-md-center text-lg-center text-xl-center">Whether you’re advancing in your current role or looking
                    to start a new career in the hospitality industry, the APLH qualification is essential for applying for
                    a Personal Licence.</p>
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
            $('.hover').hover(function() {
                $(this).addClass('flip');
            }, function() {
                $(this).removeClass('flip');
            });
        });
    </script>
@endpush
