@extends('layouts.frontend')
@section('title', 'SIA Security')
@section('main')
    <div class="coursePage siSecurityWrapper">
        <section id="banner" class="bannerWrapper">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-4 col-lg-4 bannerImg"
                        style='background: url({{ asset('CategoryImages/sia-security-training.png') }}) no-repeat center/cover; '
                        data-aos="fade-right"></div>
                    <div class="col-12 col-sm-12 col-md-8 col-lg-8 py-5" data-aos="fade-left">
                        <div class="bannerCol px-3 px-lg-0 px-md-0 px-xl-0 pl-xl-5 pl-lg-5 pl-md-5 mr-xl-5 pr-xl-5">
                            <div class="bannerInfo">
                                <h1 class="mb-4">Get Licenced with Our Training Courses</h1>
                                <p class="mb-4">We offer a range of SIA security training courses including our popular
                                    SIA Door Supervision Course along with other complementary qualifications such as
                                    Emergency First Aid at Work.</p>
                                <ul class="list-unstyled p-0 m-0">
                                    <li class="mb-2"><i class="far fa-check-square mr-2"></i> <em>Instant Access to
                                            E-learning</em></li>
                                    <li class="mb-2"><i class="far fa-check-square mr-2"></i> <em>Same Day Results</em>
                                    </li>
                                    {{-- <li class="mb-2"><i class="far fa-check-square mr-2"></i> <em>Instant Results</em></li> --}}
                                    <li class="mb-2"><i class="far fa-check-square mr-2"></i> <em>Nationwide Delivey</em>
                                    </li>
                                </ul>
                            </div>
                            <div class="bookingBtnGroup mt-4 d-flex flex-column flex-md-row flex-lg-row mb-2">
                                <a href="#sia_section"
                                    class="mr-lg-2 mr-md-2 mr-sm-0 mb-2 mb-md-0 mb-lg-0 btnMstr text-center"><i
                                        class="fas fa-shopping-cart"></i> Book Now</a>
                                <a href="javascript:;" class="btnWhiteBg text-center" data-toggle="modal"
                                    data-target="#bespokeForm"><i class="fas fa-users"></i> Request Bespoke Training</a>
                            </div>
                            <script defer async src='https://cdn.trustindex.io/loader.js?c6282b731b132346ef669eb8980'></script>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <section class="kickStarWrapper py-5">
            <div class="container">
                <h2 class="text-center mb-5 fs2">Kickstart Your Career in the Private Security Industry</h2>
                <div class="row">
                    <div class="col-12 col-sm-6 col-md-3 col-lg-3 col-xl-3" data-aos="flip-left"
                        data-aos-easing="ease-out-cubic" data-aos-duration="2000">
                        <div class="kickStarSteps d-flex justify-content-between">
                            <div class="kickStarIcon">
                                <i class="far fa-arrow-alt-circle-right"></i>
                            </div>
                            <div class="kickStarContent">
                                <h3>Step 1</h3>
                                <p class="m-0">Book your training course with us. Gain instant access to e-learning</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3 col-lg-3 col-xl-3" data-aos="flip-left"
                        data-aos-easing="ease-out-cubic" data-aos-duration="2000">
                        <div class="kickStarSteps d-flex justify-content-between">
                            <div class="kickStarIcon">
                                <i class="far fa-arrow-alt-circle-right"></i>
                            </div>
                            <div class="kickStarContent">
                                <h3>Step 2</h3>
                                <p class="m-0">Attend the face-to-face training, pass assessments, and gain
                                    qualification</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3 col-lg-3 col-xl-3" data-aos="flip-left"
                        data-aos-easing="ease-out-cubic" data-aos-duration="2000">
                        <div class="kickStarSteps d-flex justify-content-between">
                            <div class="kickStarIcon">
                                <i class="far fa-arrow-alt-circle-right"></i>
                            </div>
                            <div class="kickStarContent">
                                <h3>Step 3</h3>
                                <p class="m-0">Apply and get your new security licence from the SIA</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3 col-lg-3 col-xl-3" data-aos="flip-left"
                        data-aos-easing="ease-out-cubic" data-aos-duration="2000">
                        <div class="kickStarSteps d-flex justify-content-between">
                            <div class="kickStarIcon">
                                <i class="far fa-arrow-alt-circle-right"></i>
                            </div>
                            <div class="kickStarContent">
                                <h3>Step 4</h3>
                                <p class="m-0">Start working in your chosen role with the private security workforce</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="coursesWrapper" id="sia_section">
            <div class="container">
                <h2 class="text-center mb-5 mt-4 px-3 px-lg-0 px-xl-0 fs2">Explore SIA Security Courses</h2>
                <div class="row" id="courses-container">
                    @include('frontend.categories.courses.index', ['courses' => $category->courses])
                </div>
            </div>
        </section>

        @if (request()->is('category/sia-security-training'))
            <section class="courseChoiceWrapper">
                <div class="container">
                    <div class="row align-items-end">
                        <div class="col-md-6">
                            <div class="courseChoiceInnerImg">
                                <img src="{{ asset('images/sia-security-training.png') }}" alt="Course Selection Guidance"
                                     class="img-fluid">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="courseChoiceInfo pr-lg-4 pr-xl-4 pr-md-3 pr-sm-2 pr-1 pl-md-3 pl-sm-2 pl-1 py-5">
                                <h2 class="mb-4">Not sure whether to choose Door Supervisor or CCTV Operator?</h2>
                                <p class="mb-4">Not sure whether to choose Door Supervisor or CCTV Operator? <br>Take our
                                    quick 1-minute questionnaire to discover which SIA course fits your strengths and
                                    preferences best.</p>

                                <div class="choicePoints">
                                    <ul class="list-unstyled">
                                        <li><i class="far fa-check-square mr-2"></i><span>Face-to-face or
                                            behind-the-scenes?</span></li>
                                        <li><i class="far fa-check-square mr-2"></i><span>Conflict resolution or surveillance focus?</span></li>
                                        <li><i class="far fa-check-square mr-2"></i><span>We’ll guide you to the right
                                            path.</span></li>
                                    </ul>
                                </div>

                                <a href="javascript:;" data-toggle="modal" data-target="#questionnaire"
                                   class="btn btn-primary btn-lg px-4">Take the Quiz</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif

        <section class="expertTrainers pt-5">
            <div class="container">
                <h2 class="fs2 text-center mb-5">Meet Our Expert Trainers</h2>
                <div class="row">
                    <div class="col-12 col-md-6 mb-4 mb-xl-0 mb-lg-0 col-lg-3 px-2" data-aos="zoom-in-up"
                        data-aos-easing="ease-out-cubic" data-aos-duration="2000">
                        <div class="expertSingle text-center">
                            <img src="{{ asset('frontend/img/Arshad-Hussain.webp') }}" class="img-fluid"
                                alt="Arshad Hussain">
                            <div class="expertSingleInfo py-4">
                                <h3 class="h5">Arshad Hussain</h3>
                                <p class="m-0"><small>SIA Security, SIA CCTV and First Aid Trainer</small></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 mb-4 mb-xl-0 mb-lg-0 col-lg-3 px-2" data-aos="zoom-in-up"
                        data-aos-easing="ease-out-cubic" data-aos-duration="2000">
                        <div class="expertSingle text-center">
                            <img src="{{ asset('frontend/img/Tony-Bates.webp') }}" class="img-fluid" alt="Tony Bates">
                            <div class="expertSingleInfo py-4">
                                <h3 class="h5">Tony Bates</h3>
                                <p class="m-0"><small>SIA Security, SIA CCTV, Fire Safety and First Aid Trainer</small>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 mb-4 mb-xl-0 mb-lg-0 col-lg-3 px-2" data-aos="zoom-in-up"
                        data-aos-easing="ease-out-cubic" data-aos-duration="2000">
                        <div class="expertSingle text-center">
                            <img src="{{ asset('frontend/img/Riz-Dean.webp') }}" class="img-fluid" alt="Riz Dean">
                            <div class="expertSingleInfo py-4">
                                <h3 class="h5">Riz Dean</h3>
                                <p class="m-0"><small>SIA Security, SIA CCTV, First Aid, and Traffic Marshal
                                        Trainer</small></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 mb-4 mb-xl-0 mb-lg-0 col-lg-3 px-2" data-aos="zoom-in-up"
                        data-aos-easing="ease-out-cubic" data-aos-duration="2000">
                        <div class="expertSingle text-center">
                            <img src="{{ asset('frontend/img/Untitled-design-66.webp') }}" class="img-fluid"
                                alt="Lorraine Upritchard">
                            <div class="expertSingleInfo py-4">
                                <h3 class="h5">Lorraine Upritchard</h3>
                                <p class="m-0"><small>First Aid Trainer</small></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="skillProgress">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-5 col-lg-5" data-aos="fade-left">
                        <div class="skillProgressTitle">
                            <h2 class="fs2 text-white">The demand for skilled security professionals is on the rise</h2>
                            <p class="skillProgressPortrait">SECURITY</p>
                        </div>
                    </div>
                    <div class="col-12 col-md-7 col-lg-7">
                        <div class="progressbar">
                            <p data-aos="fade-right">The private security industry in the UK is a dynamic and rapidly
                                growing sector, offering a range of opportunities for individuals seeking a rewarding and
                                challenging career. From safeguarding events to protecting valuable assets, the roles within
                                this industry are diverse and essential to maintaining safety and security. Here are some of
                                the key benefits of working in the private security industry in the UK.</p>
                            <div class="progressInner mb-3" data-aos="fade-left" data-aos-duration="2000">
                                <div class="d-flex justify-content-between">
                                    <p class="m-0">Growing Demand in Trained Operatives</p>
                                    <p class="m-0">100%</p>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" style="width: 100%" aria-valuenow="100"
                                        aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="progressInner mb-3" data-aos="fade-left" data-aos-duration="1700">
                                <div class="d-flex justify-content-between">
                                    <p class="m-0">Diverse Opportunities</p>
                                    <p class="m-0">92%</p>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" style="width: 92%" aria-valuenow="92"
                                        aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="progressInner mb-3" data-aos="fade-left" data-aos-duration="1400">
                                <div class="d-flex justify-content-between">
                                    <p class="m-0">Flexible Schedules</p>
                                    <p class="m-0">89%</p>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" style="width: 89%" aria-valuenow="89"
                                        aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="progressInner mb-3" data-aos="fade-left" data-aos-duration="1100">
                                <div class="d-flex justify-content-between">
                                    <p class="m-0">Continuous Learning</p>
                                    <p class="m-0">59%</p>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" style="width: 59%" aria-valuenow="59"
                                        aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        {{-- Form --}}
        <div id="formContact">
            <x-frontend.request_form />
        </div>
    </div>
    @include('frontend.bespoke_form.index')
@endsection

@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" crossorigin="anonymous"
        referrerpolicy="no-referrer" />
    <style>
        section.courseChoiceWrapper {
            background: linear-gradient(90deg, rgba(182, 201, 228, 1) 15%, rgba(255, 255, 255, 1) 131%);
            position: relative;
        }

        .choicePoints ul li i {
            color: #ea7000;
        }

        .courseChoiceInfo a.btn.btn-primary {
            background: linear-gradient(269deg, rgba(26, 109, 162, 1) 0%, rgba(10, 3, 60, 1) 50%);
            border: none;
        }
        /* .courseChoiceWrapper::before{
            content: '';
            position: absolute;
            top: 0;
            left:0;
            right:0;
            bottom: 0;
            background: url('{{ asset('images//sia-security-training.png') }}');
        } */
    </style>
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
