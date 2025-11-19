@extends('layouts.frontend')
@section('title', 'E-learning and Bite Size Courses')
@section('main')
    <div class="eLearningWrapper elearningNewPage">
        <section id="banner" class="bannerWrapper">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-4 col-lg-4 bannerImg" style='background: url({{ asset('banner_images/E-learning.webp') }}) no-repeat center/cover; ' data-aos="fade-right"></div>
                    <div class="col-12 col-sm-12 col-md-8 col-lg-8 py-5" data-aos="fade-left">
                        <div class="bannerCol px-3 px-lg-0 px-md-0 px-xl-0 pl-xl-5 pl-lg-5 pl-md-5 mr-xl-5 pr-xl-5">
                            <div class="bannerInfo">
                                <h1 class="mb-5">E-learning and Bite Size Courses</h1>
                                <p class="mb-4">Whether you're looking to enhance your career prospects, upskill your
                                    workforce, or explore a
                                    new field, our e-learning solutions offer flexibility, expert knowledge, and
                                    industry-relevant content.</p>
                                <ul class="list-unstyled p-0 m-0 mb-5">
                                    <li class="d-flex mb-3">
                                        <i class="far mt-2 fa-check-square mr-2"></i>
                                        <p class="m-0 font-weight-normal">Flexible Learning - Study at your convenience,
                                            whether part-time or full-time.</p>
                                    </li>
                                    <li class="d-flex mb-3">
                                        <i class="far mt-2 fa-check-square mr-2"></i>
                                        <p class="m-0 font-weight-normal">Expert-Led Courses - Gain insights from industry
                                            professionals and subject matter experts.</p>
                                    </li>
                                    <li class="d-flex mb-3">
                                        <i class="far mt-2 fa-check-square mr-2"></i>
                                        <p class="m-0 font-weight-normal">Learn online from any device, with 24/7 access to
                                            course materials.</p>
                                    </li>
                                    <li class="d-flex mb-3">
                                        <i class="far mt-2 fa-check-square mr-2"></i>
                                        <p class="m-0 font-weight-normal">Recognised qualifications and certifications upon
                                            completion</p>
                                    </li>
                                </ul>
                            </div>
                            <div class="bookingBtnGroup d-flex flex-column flex-md-row flex-lg-row mt-4">
                                <a href="#bookNow" class="mb-2 mb-md-0 mb-lg-0 btnMstr text-center text-white">
                                    <i class="fa-solid fa-circle-arrow-down mr-2"></i> Start Learning Today!
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="eLearningWhorAre whyChooseUse">
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

                        <p class="h4 mb-5 mt-5">Who Are Our Courses For?</p>
                    </div>
                </div>
                <div class="row whyChooseUseRow1">
                    <div class="col-12 col-md-6 col-lg-4 mb-4" data-aos="flip-left">
                        <div class="whyChooseUseRowBox">
                            <div class="whyChooseUseNum mb-3">1</div>
                            <div class="h6 mb-4">Job Seekers</div>
                            <p>Enhance your employability by acquiring new skills and qualifications.</p>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4 mb-4" data-aos="flip-left">
                        <div class="whyChooseUseRowBox">
                            <div class="whyChooseUseNum mb-3">2</div>
                            <div class="h6 mb-4">Employees</div>
                            <p>Gain additional expertise to progress in your current role or pivot to a new industry.</p>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4 mb-4" data-aos="flip-left">
                        <div class="whyChooseUseRowBox">
                            <div class="whyChooseUseNum mb-3">3</div>
                            <div class="h6 mb-4">Employers</div>
                                <p>Provide your team with professional development opportunities and ensure they stay compliant with regulations.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="commitmentWraapper position-relative">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-6 ourCommitment" data-aos="fade-up-left">
                        <h2 class="fs2 mb-4">Our Commitment to Your Success</h2>
                        <p class="mb-4">We are dedicated to offering training solutions that cater to the needs of modern
                            learners. With
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
        <section class="weOffer elearning">
            <div class="container">
                <h2 class="fs2 text-center mb-5">Explore E-learning Courses We Offer</h2>
                <div class="row" id="bookNow">
                    @forelse($courses as $course)
                        <div class="col-12 col-md-6 col-lg-4" data-aos="fade-up" data-aos-duration="3000">
                            <div class="productcertificate">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="productGridThumbnails position-relative">
                                            <div class="productGridImgs">
                                                <img src="{{ $course->course_image ? asset($course->course_image) : asset('images/placeholderimage.jpg') }}"
                                                    class="img-fluid w-100" alt="{{ Str::title($course->name) }}">
                                            </div>
                                        </div>
                                        <div class="productGridContents">
                                            <h3 class="pt-3 pb-2">{{ $course->name }}</h3>
                                            <p>{!! Str::limit($course->description, 100, '...') !!}</p>
                                            <ul class="list-unstyled pb-4 m-0">
                                                <li class="d-flex align-content-center"><i class="mr-3 far fa-clock"></i>
                                                    <p class="m-0"><strong>Duration</strong>:
                                                        {{ $course->duration }}</p>
                                                </li>
                                                <li class="d-flex align-content-center"><i class="mr-3 fas fa-coins"></i>
                                                    <p class="m-0"><strong>Price</strong>: from
                                                        £{{ $course->price ?? '' }}</p>
                                                </li>
                                            </ul>
                                            <a href="{{ route('elearning.course', $course->slug) }}" class="gridBtn">Book
                                                Now</a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    @empty
                        <p class="w-100 text-center">No Course Found!</p>
                    @endforelse
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
