@extends('layouts.frontend')
@section('title', 'SIA Security Training Courses in ' . ucfirst($slug->slug))

@section('main')
    <div class="product-page" id="locationPage">
        <section class="locationWrapper">
            <div class="pageTitle py-5"
                style="background:url({{ $slug->slug == 'birmingham' ? asset('frontend/img/Birmingham-bg.webp') : ($slug->slug == 'leicester' ? asset('frontend/img/Leicester-bgnew.webp') : ($slug->slug == 'nottingham' ? asset('frontend/img/Nottingham-gb.webp') : ($slug->slug == 'manchester' ? asset('frontend/img/Manchester-bg.webp') : asset('frontend/img/pageTitle.webp')))) }}) no-repeat top center/cover;">
                <div class="container pb-5">
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6" data-aos="fade-right">
                            <h1 class="mb-3">SIA Security Training Courses in {{ ucfirst($slug->slug) }}</h1>
                            @php
                                $bannerContent = [
                                    'birmingham' =>
                                        'Here at Training for Employment, you can start your path to a fulfilling career in the safety and security industries. We provide excellent, authorised training programs in Birmingham that will give you the abilities and credentials you need to succeed. Our knowledgeable instructors in Birmingham are prepared to help you at every stage, whether you are starting a new professional path or upgrading your current credentials.',
                                    'leicester' =>
                                        'Your pathway to a fulfilling career in the security and safety sectors starts here. At Training for Employment, we deliver high-quality, licenced training courses designed to equip you with the skills and qualifications you need to excel. Whether you’re embarking on a new career or renewing your existing certifications, our experienced instructors are on hand to support you every step of the way.',
                                    'nottingham' =>
                                        'Your journey toward a rewarding career in the safety and security fields begins here at Training for Employment. We offer top-quality, accredited training courses in Nottingham designed to equip you with the necessary skills and certifications for success. Whether you are embarking on a new career path or updating your existing qualifications, our expert instructors in Nottingham are ready to support you every step of the way.',
                                    'london' => '',
                                    'manchester' =>
                                        'This is the first step on your route to a rewarding career in the security and safety industries. Training for Employment offers top-notch, licensed training programs that will provide you the credentials and abilities you need to succeed. Our knowledgeable instructors are available to help you at any stage, whether you’re starting a new career or renewing your current certificates.',
                                ];
                            @endphp

                            <p>{{ $bannerContent[$slug->slug] ?? '' }}</p>
                        </div>
                    </div>
                    <div class="pageHeaderBtn mt-5" data-aos="fade-up">
                        <a href="#coursesAll">Explore Courses</a>
                    </div>
                </div>
            </div>
        </section>
        <section class="coursesLocation py-5">
            <div class="container mt-5">
                <div class="row" id="coursesAll">
                    <div class="col-12 text-center mb-3">
                        <h2 class="fs2 mb-4" data-aos="fade-right">Our Courses in {{ Str::ucfirst($slug->slug) }}</h2>
                        <p class="mb-5" data-aos="fade-left">
                            @php
                                $bannerContent = [
                                    'birmingham' =>
                                        'We are pleased to provide our excellent training programs in several places throughout the United Kingdom. Locate a location in your area and advance your career at one of our professional and easily accessible training facilities.',
                                    'leicester' =>
                                        'We offer a range of training programs tailored to meet your professional goals and ensure compliance with industry standards:',
                                    'nottingham' =>
                                        'We provide a variety of training programs designed to align with your career objectives and maintain compliance with industry regulations.',
                                    'london' =>
                                        'We are pleased to provide our excellent training programs in several places throughout the United Kingdom. Locate a location in your area and advance your career at one of our professional and easily accessible training facilities.',
                                    'manchester' =>
                                        'We provide a variety of training courses designed to help you achieve your career objectives and guarantee adherence to industry norms:',
                                ];
                            @endphp
                            {{ $bannerContent[$slug->slug] ?? '' }}
                        </p>
                    </div>
                    @forelse($courses as $course)
                        <div class="col-12 col-md-6 col-lg-6" data-aos="fade-up" data-aos-duration="3000">
                            <div class="productcertificate">
                                <div class="row">
                                    <div class="col-md-6 col-lg-6 col-sm-12">
                                        <div class="productGridThumbnails position-relative">
                                            <div class="productGridImgs">
                                                <img src="{{ $course->course_image ? asset($course->course_image) : asset('images/placeholderimage.jpg') }}"
                                                    class="img-fluid w-100" alt="{{ $course->name }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-sm-12">
                                        <div class="productGridContents">
                                            <h3>{{ $course->name }}</h3>
                                            <p>{!! Str::limit($course->description, 100, '...') !!}</p>
                                            <ul class="list-unstyled pb-4 m-0">
                                                <li class="d-flex align-content-center"><i class="mr-3 fas fa-home"></i>
                                                    <p class="m-0"><strong>Delivery Mode</strong>:
                                                        {{ $course->delivery_mode ?? '' }}</p>
                                                </li>
                                                <li class="d-flex align-content-center"><i
                                                        class="mr-3 fas fa-certificate"></i>
                                                    <p class="m-0"><strong>Award</strong>:
                                                        {{ $course->awardingBody->name ?? '' }}</p>
                                                </li>
                                                <li class="d-flex align-content-center"><i
                                                        class="mr-3 fas fa-money-bill-wave"></i>
                                                    <p class="m-0"><strong>Income Potential</strong>: £13 –
                                                        £23 per hour</p>
                                                </li>
                                                <li class="d-flex align-content-center"><i class="mr-3 far fa-clock"></i>
                                                    <p class="m-0"><strong>Duration</strong>:
                                                        {{ $course->duration }}</p>
                                                </li>
                                                <li class="d-flex align-content-center"><i class="mr-3 fas fa-coins"></i>
                                                    <p class="m-0"><strong>Price</strong>: from
                                                        £{{ $course->price ?? '' }}</p>
                                                </li>
                                            </ul>
                                            <a href="{{ route('course.show', $course->slug) }}" class="gridBtn">View Dates
                                                & Venues</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    @empty


                        <div class="text-center w-100 p-4 shadow-sm rounded bg-light">
                            <h4 class="fw-bold mb-2">No Courses Found</h4>
                            <p class="text-muted">It looks like there are no available courses at the moment.</p>
                        </div>

                    @endforelse
                </div>
            </div>
        </section>
        <section class="upcomingDates">
            <div class="row">
                <div class="col-12 col-md-4 col-lg-4 d-none d-lg-block d-xl-block" data-aos="fade-right"
                    style="background:url({{ asset('frontend/img/usefullimg.jpg') }}) no-repeat center/cover;">
                    {{-- <div class="upcomingDatesImg" >
                    </div> --}}
                </div>
                <div class="col-12 col-sm-12 col-md-5 col-lg-3" data-aos="fade-left">
                    <h2 class="text-white pt-5 pl-5">Usefull Links</h2>
                    <div class="upcomingDatesLink">
                        <ul class="list-unstyled m-0 p-0 two-column">
                            <li data-aos="zoom-in">
                                <i class="fa-solid fa-link"></i>
                                <a href="{{ route('elearning.index') }}">E-learning Courses</a>
                            </li>
                            <li data-aos="zoom-in">
                                <i class="fa-solid fa-link"></i>
                                <a href="{{ route('refer.friend') }}">Refer a Friend & Earn – Become a Partner</a>
                            </li>
                            <li data-aos="zoom-in">
                                <i class="fa-solid fa-link"></i>
                                <a href="{{ route('booking.conditions') }}">Booking Terms & Conditions</a>
                            </li>
                            <li data-aos="zoom-in">
                                <i class="fa-solid fa-link"></i>
                                <a href="{{ route('course.bundle') }}">Course Bundle Deals</a>
                            </li>
                        </ul>
                        <ul class="list-unstyled m-0 p-0 d-flex sMediaLocation">
                            <li data-aos="fade-up">
                                <a href="https://www.facebook.com/training4employmentUK"
                                    class="d-flex align-items-center justify-content-center">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                            </li>
                            <li data-aos="fade-up">
                                <a href="https://www.linkedin.com/company/10628798"
                                    class="d-flex align-items-center justify-content-center">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                            </li>
                            <li data-aos="fade-up">
                                <a href="https://www.instagram.com/trainingforemployment/"
                                    class="d-flex align-items-center justify-content-center">
                                    <i class="fab fa-instagram"></i>
                                </a>
                            </li>
                            <li data-aos="fade-up">
                                <a href="https://www.youtube.com/@training4employment38"
                                    class="d-flex align-items-center justify-content-center">
                                    <i class="fab fa-youtube"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-7 col-lg-5" data-aos="fade-left">
                    <div class="upcomingDatesContent py-4">
                        <h2 class="text-white mb-4 pt-3">Upcoming Dates</h2>
                        <div class="upcomingTabs">

                            @php
                                $months = $courses
                                    ->flatMap(function ($course) {
                                        return $course->cohorts->map(function ($cohort) {
                                            return \Carbon\Carbon::parse($cohort->start_date_time)->format('F');
                                        });
                                    })
                                    ->unique()
                                   ->filter(function ($monthName) {
                                        // Exclude January (1) to June (6)
                                        $monthNumber = \Carbon\Carbon::parse("1 $monthName")->month;
                                        return $monthNumber >= 7; // Only July (7) to December (12)
                                    })
                                    ->sortBy(function ($monthName) {
                                        return \Carbon\Carbon::parse("1 $monthName")->month;
                                    });
                            @endphp


                            @if (!empty($months))
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    @foreach ($months as $month)
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link text-capitalize {{ $loop->first ? 'active' : '' }}"
                                                id="{{ strtolower($month) }}-tab" data-toggle="tab"
                                                data-target="#{{ strtolower($month) }}" type="button" role="tab"
                                                aria-controls="{{ strtolower($month) }}"
                                                aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                                                {{ $month }}
                                            </button>
                                        </li>
                                    @endforeach
                                </ul>
                                <div class="tab-content" id="myTabContent">
                                    @foreach ($months as $month)
                                        @php
                                            $monthKey = strtolower($month);
                                            // Fetch cohorts for the current month and sort them in ascending order (earliest first)
                                            $sortedCohorts = $courses
                                                ->flatMap(
                                                    fn($course) => $course->cohorts
                                                        ->filter(
                                                            fn($cohort) => \Carbon\Carbon::parse(
                                                                $cohort->start_date_time,
                                                            )->format('F') === $month,
                                                        )
                                                        ->map(
                                                            fn($cohort) => ['cohort' => $cohort, 'course' => $course],
                                                        ),
                                                )
                                                ->sortBy(
                                                    fn($item) => \Carbon\Carbon::parse($item['cohort']->start_date_time)
                                                        ->timestamp,
                                                ); // Sort in ascending order
                                        @endphp

                                        <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                                            id="{{ $monthKey }}" role="tabpanel"
                                            aria-labelledby="{{ $monthKey }}-tab">
                                            <div class="upcomingDatesShow">
                                                @foreach ($sortedCohorts as $item)
                                                    @php
                                                        $cohort = $item['cohort'];
                                                        $course = $item['course'];
                                                    @endphp
                                                    <div class="d-flex align-items-center upcomingDatesShowList">
                                                        <i class="fa-solid fa-calendar-days mr-2"></i>
                                                        <div class="dateShow">
                                                            <p class="mb-0">
                                                                <strong><a
                                                                        href="{{ route('course.show', $course->slug) }}">{{ $course->name }}</a></strong>
                                                            </p>
                                                            <p
                                                                class="m-0 bg-success badge-btn px-2 pb-1 text-white rounded d-inline">
                                                                <strong><small>{{ \Carbon\Carbon::parse($cohort->start_date_time)->format('d M Y') }}</small></strong>
                                                            </p>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p>No Dates Found!</p>
                            @endif


                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="whyChooseUse">
            <div class="container">
                <h2 class="text-center fs2 mb-5" data-aos="fade-up">Why Choose Training for Employment in
                    {{ ucfirst($slug->slug) }}?</h2>
                <div class="row whyChooseUseRow1">
                    <div class="col-12 col-md-6 col-lg-4 mb-4" data-aos="flip-left">
                        <div class="whyChooseUseRowBox">
                            <div class="whyChooseUseNum mb-3">1</div>
                            <h3 class="h6 mb-4">Experienced Trainers</h3>
                            <p>Learn from seasoned professionals with years of hands-on experience in the industry. Our
                                expert trainers ensure you gain both practical skills and in-depth knowledge to excel in
                                your career</p>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4 mb-4" data-aos="flip-left">
                        <div class="whyChooseUseRowBox">
                            <div class="whyChooseUseNum mb-3">2</div>
                            <h3 class="h6 mb-4">Accredited Programmes</h3>
                            <p>All our courses are fully validated, meeting the latest industry regulations and standards.
                                This means your qualifications will be recognised and respected by employers throughout the
                                sector.</p>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4 mb-4" data-aos="flip-left">
                        <div class="whyChooseUseRowBox">
                            <div class="whyChooseUseNum mb-3">3</div>
                            <h3 class="h6 mb-4">Convenient Location</h3>
                            @php
                                $locations = [
                                    'birmingham' =>
                                        'based at the Head office – 89-91 Hatchett Street, Birmingham, West Midlands, B19 3NY',
                                    'leicester' =>
                                        'based at the Leicester Arts Centre, Garden Street, Leicester LE1 3UA',
                                    'nottingham' => 'based at the 296 Mansfield Road, Nottingham, NG5 2BT',
                                    'london' =>
                                        'based at the Head office – 89-91 Hatchett Street, Birmingham, West Midlands, B19 3NY',
                                    'manchester' => 'based at the 12 Tib St, Back Piccadilly, Manchester M4 1SH',
                                ];
                            @endphp
                            <p>Our training centre is {{ $locations[$slug->slug] ?? '' }}. It’s conveniently located
                                with excellent transport links and provides a comfortable and welcoming learning
                                environment.</p>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4 mb-4" data-aos="flip-left">
                        <div class="whyChooseUseRowBox">
                            <div class="whyChooseUseNum mb-3">4</div>
                            <h3 class="h6 mb-4">Same Day Results</h3>
                            <p>We know how important it is to get your results quickly, so we aim to provide same-day
                                results wherever possible. This allows you to plan your next steps without delay.</p>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4 mb-4" data-aos="flip-left">
                        <div class="whyChooseUseRowBox">
                            <div class="whyChooseUseNum mb-3">5</div>
                            <h3 class="h6 mb-4">Flexible Learning Options</h3>
                            <p>Whether you are starting from scratch or enhancing existing skills, we offer courses tailored
                                to suit all levels. With flexible schedules, you can fit your training around your
                                commitments.</p>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4 mb-4" data-aos="flip-left">
                        <div class="whyChooseUseRowBox">
                            <div class="whyChooseUseNum mb-3">6</div>
                            <h3 class="h6 mb-4">Free Resits – No Hidden Costs</h3>
                            <p>We’re committed to your success, which is why we operate a “NO PASS – NO RETAKE FEE” policy.
                                If you don’t pass the first time, you won’t have to pay for a resit up to 2 times. With a
                                pass rate exceeding 95%, you’re in safe hands with us.
                                Choose Training for Employment for highest quality training delivered with professionalism,
                                expertise, and a personal touch. Your journey to success starts here!</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <x-frontend.modal-video class="py-5 learnerSays" />
        <section class="py-5">
            <div class="container py-5">
                <script defer async src='https://cdn.trustindex.io/loader.js?34690d4371cd5966f966569d8e0'></script>
            </div>
        </section>
        <section class="courseCards py-5">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-12 col-lg-6 col-md-6" data-aos="fade-right">
                        <img src="{{ asset('frontend/img/cardall.webp') }}" class="img-fluid" alt="Venue Details" style="width: 70%;margin: 0;">
                    </div>
                    <div class="col-12 col-lg-6 col-md-6" data-aos="fade-left">
                        <div class="courseCardsInfo mt-sm-5">
                            @php
                                $getStarted = [
                                    'birmingham' =>
                                        'Are you ready to embark on your adventure? For additional information about course schedules, costs, and other specifics,  get in touch with us. Use Training for Employment in Birmingham to take advantage of the chance to improve your abilities and achieve your career goals.',
                                    'leicester' =>
                                        'Ready to begin your journey? Contact us for course schedules, pricing, and additional details. Don’t miss out on the opportunity to upskill and achieve your professional goals with Training for Employment in Leicester!',
                                    'nottingham' =>
                                        'Are you prepared to start your journey? Reach out to us for information on course schedules, pricing, and more details. Take advantage of the opportunity to enhance your skills and reach your professional aspirations with Training for Employment in Nottingham!',
                                    'london' => '',
                                    'manchester' =>
                                        'Ready to begin your journey? Contact us for course schedules, pricing, and additional details. Don’t miss out on the opportunity to upskill and achieve your professional goals with Training for Employment in Manchester!',
                                ];
                            @endphp
                            <h3 class="fs2 mb-4 text-white h2">Get Started Now</h3>
                            <p>{{ $getStarted[$slug->slug] }}</p>
                            <div class="cardBtn mt-5">
                                <a href="#startCours" class="text-uppercase">Start your course</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="locationMap py-5">
            <div class="container py-5">
                <div class="row align-items-center">
                    <div class="col-12 col-lg-6 col-md-6" data-aos="fade-right">
                        <div class="map">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d4842.20092158658!2d-1.131362!3d52.640098!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4877611c14d3ccd9%3A0xc042d5374f54b515!2sGarden%20St%2C%20Birmingham%2C%20UK!5e0!3m2!1sen!2sus!4v1732718307459!5m2!1sen!2sus"
                                width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 col-md-6" data-aos="fade-left">
                        <div class="locationDetail">
                            <h3 class="fs2 mb-4">Venue Details</h3>
                            @php
                                $address = [
                                    'birmingham' => '<div class="h4">Birmingham – Newtown (Head Office)</div>
                                                    <p class="mb-2 h6">B19 3NY</p>
                                                    <p class="mb-2 h6">89-91 Hatchett Street, Birmingham, West Midlands</p>
                                                    <p class="my-4">Take the next step in your career with confidence by joining us in Birmingham. Discover our courses and sign up today!</p>',
                                    'leicester' => '<div class="h4">Leicester Arts Centre</div>
                                                    <p class="mb-2 h6">Leicester</p>
                                                    <p class="mb-2 h6">LE1 3UA</p>
                                                    <p class="my-4">Join us in Leicester and take the next step in your career with confidence. Explore our courses and register today!</p>',
                                    'nottingham' => '<div class="h4">NG5 2BT</div>
                                                    <p class="mb-2 h6">296 Mansfield Road,</p>
                                                    <p class="my-4">Join us in Nottingham and take the next step in your career with confidence. Explore our courses and register today!</p>',
                                    'london' => '<div class="h4">London Arts Centre</div>
                                                <p class="mb-2 h6">London</p>
                                                <p class="mb-2 h6">LE1 3UA</p>
                                                <p class="my-4">Join us in London and take the next step in your career with confidence.
                                                Explore our courses and register today!</p>',
                                    'manchester' => '<div class="h4">Manchester</div>
                                                    <p class="mb-2 h6">Back Piccadilly</p>
                                                    <p class="mb-2 h6">12 Tib St, Manchester M4 1SH</p>
                                                    <p class="my-4">Come join with us in Manchester and confidently advance your career. Check out our courses and sign up right now!</p>',
                                ];
                            @endphp
                            {!! $address[$slug->slug] !!}
                            <div class="locationBtn mt-5">
                                <a href="{{ route('courses.index') }}" class="text-uppercase">Explore Courses</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="whyChooseUs py-5 overflow-hidden">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 whyChooseUsBgCol"></div>
                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 whyChooseUsInfoCol pl-5">
                    <h2 class="fs2" data-aos="fade-right">Why Choose Training for Employment?</h2>
                    <div class="whyChooseUsInner d-flex align-items-center" data-aos="fade-left">
                        <img src="{{ asset('frontend/img/3d-map.png') }}" class="img-fluid" alt="Convenient Locations">
                        <div class="innerContent mt-4 px-1 px-sm-2 px-md-3 px-lg-3 px-xl-3">
                            <div class="h6 text-white">Convenient Locations:</div>
                            <p>Multiple venues across major cities for your convenience.</p>
                        </div>
                    </div>
                    <div class="whyChooseUsInner d-flex align-items-center" data-aos="fade-left">
                        <img src="{{ asset('frontend/img/learning experience.png') }}" class="img-fluid"
                            alt="Professional Facilities">
                        <div class="innerContent mt-4 px-1 px-sm-2 px-md-3 px-lg-3 px-xl-3">
                            <div class="h6 text-white">Professional Facilities:</div>
                            <p>All venues are equipped to ensure a productive and comfortable learning experience.</p>
                        </div>
                    </div>
                    <div class="whyChooseUsInner d-flex align-items-center" data-aos="fade-left">
                        <img src="{{ asset('frontend/img/expert.png') }}" class="img-fluid" alt="Expert Trainers">
                        <div class="innerContent mt-4 px-1 px-sm-2 px-md-3 px-lg-3 px-xl-3">
                            <div class="h6 text-white">Expert Trainers:</div>
                            <p>Learn from experienced professionals committed to helping you succeed.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="venues py-5 mb-4">
            <div class="container pb-5">
                <h3 class="px-3 px-sm-3 px-md-3 px-lg-0 px-xl-0 text-center fs2 mb-5">Training for Employment Venues Across
                    the UK</h3>
                <p class="px-3 px-sm-3 px-md-3 maintest px-lg-0 px-xl-0 text-center mb-5">
                    @php
                        $venueContent = [
                            'birmingham' =>
                                'We are pleased to provide our excellent training programs in several places throughout the United Kingdom. Locate a location in your area and advance your career at one of our professional and easily accessible training facilities.',
                            'leicester' => '',
                            'nottingham' =>
                                'We’re proud to offer our high-quality training courses at multiple locations across the UK. Find a venue near you and take the next step in your career at one of our convenient and professional training centres.',
                            'london' => '',
                            'manchester' =>
                                'We’re proud to offer our high-quality training courses at multiple locations across the UK. Find a venue near you and take the next step in your career at one of our convenient and professional training centres.',
                        ];
                    @endphp
                    {{ $venueContent[$slug->slug] ?? '' }}
                </p>

                <div class="row">
                    @if ($slug->slug != 'nottingham')
                        <div class="col-12 col-sm-6 col-md-6 col-lg-3 col-xl-3 mb-4" data-aos="fade-up"
                            data-aos-anchor-placement="center-center">
                            <div class="venuesBox d-flex justify-content-between flex-column h-100 mt-4">
                                <div>
                                    <div class="h5 mb-4">Nottingham</div>
                                    <p><strong>Address:</strong></p>
                                    <p><em>296 Mansfield Road, Nottingham, NG5 2BT</em></p>
                                    <p>Located in the heart of Nottingham, this venue offers a comfortable and easily
                                        accessible
                                        space for your training needs. Perfect for those based in or around the East
                                        Midlands.
                                    </p>
                                </div>
                                <div>
                                    <a href="{{ url('location/nottingham') }}" class="venuesBtnArr">
                                        <span>Learn More</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if ($slug->slug != 'london')
                        <div class="col-12 col-sm-6 col-md-6 col-lg-3 col-xl-3 mb-4" data-aos="fade-up"
                            data-aos-anchor-placement="center-center">
                            <div class="venuesBox d-flex justify-content-between flex-column h-100 mt-4">
                                <div>
                                    <div class="h5 mb-4">London – Rays House</div>
                                    <p><strong>Address:</strong></p>
                                    <p><em>North Circular Road, NW10 7XP</em></p>
                                    <p>Situated in a prime location in London, Rays House provides excellent facilities for
                                        learners. Ideal for those in the capital or surrounding areas looking for a trusted
                                        training provider.</p>
                                </div>
                                <div>
                                    <a href="{{ url('location/london') }}" class="venuesBtnArr">
                                        <span>Learn More</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if ($slug->slug != 'birmingham')
                        <div class="col-12 col-sm-6 col-md-6 col-lg-3 col-xl-3 mb-4" data-aos="fade-up"
                            data-aos-anchor-placement="center-center">
                            <div class="venuesBox d-flex justify-content-between flex-column h-100 mt-4">
                                <div>
                                    <div class="h5 mb-4">Birmingham – Newtown (Head Office)</div>
                                    <p><strong>Address:</strong></p>
                                    <p><em>89-91 Hatchett Street, Birmingham, West Midlands, B19 3NY</em></p>
                                    <p>As our head office, the Birmingham venue is a central hub for Training 4Employment.
                                        Offering top-notch facilities and expert instructors, it’s the ideal location for
                                        anyone
                                        in the Midlands.</p>
                                </div>
                                <div>
                                    <a href="{{ url('location/birmingham') }}" class="venuesBtnArr">
                                        <span>Learn More</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if ($slug->slug != 'manchester')
                        <div class="col-12 col-sm-6 col-md-6 col-lg-3 col-xl-3 mb-4" data-aos="fade-up"
                            data-aos-anchor-placement="center-center">
                            <div class="venuesBox d-flex justify-content-between flex-column h-100 mt-4">
                                <div>
                                    <div class="h5 mb-4">Manchester</div>
                                    <p><strong>Address:</strong></p>
                                    <p><em>Britannia Manchester Hotel & Sachas Hote</em></p>
                                    <p>Manchester’s central location ensures easy access for learners from across the North
                                        West. Both venues provide excellent amenities and a professional atmosphere to
                                        support
                                        your learning journey.</p>
                                </div>
                                <div>
                                    <a href="{{ url('location/manchester') }}" class="venuesBtnArr">
                                        <span>Learn More</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if ($slug->slug != 'leicester')
                        <div class="col-12 col-sm-6 col-md-6 col-lg-3 col-xl-3 mb-4" data-aos="fade-up"
                            data-aos-anchor-placement="center-center">
                            <div class="venuesBox d-flex justify-content-between flex-column h-100 mt-4">
                                <div>
                                    <div class="h5 mb-4">Leicester Arts Center</div>
                                    <p><strong>Address:</strong></p>
                                    <p><em>Leicester Arts Centre, Garden Street, Leicester, LE1 3UA.</em></p>
                                    <p>Leicester Arts Centre, Garden Street, Leicester, LE1 3UA.</p>
                                </div>
                                <div>
                                    <a href="{{ url('location/Leicester') }}" class="venuesBtnArr">
                                        <span>Learn More</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </section>
        <section class="contactUs py-5">
            <div class="container py-5">
                <div class="row align-items-center">
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6" data-aos="fade-right">
                        <h2 class="fs2 mb-4">Contact Us</h2>
                        <p>Find the venue closest to you and start your journey with Training 4Employment today! Contact us
                            to learn more about our locations, course schedules, and how we can help you achieve your goals.
                        </p>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 mt-sm-5">
                        <div class="d-flex align-items-center justify-content-between conactMenuList">
                            <div class="text-center m-auto w-25" data-aos="fade-up">
                                <i class="fa-regular text-white fa-comment-dots"></i>
                                <p class="mb-0 font-weight-bold mt-3">Live Chat</p>
                            </div>
                            <div class="text-center m-auto w-25" data-aos="fade-up">
                                <i class="fa-regular text-white fa-paper-plane"></i>
                                <p class="mb-0 font-weight-bold mt-3">Email Us</p>
                            </div>
                            <div class="text-center m-auto w-25" data-aos="fade-up">
                                <i class="fa-solid text-white fa-mobile-screen-button"></i>
                                <p class="mb-0 font-weight-bold mt-3">0808 280 8098</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="referFriendFaqs faqWrapper py-5">
            <div class="container">
                <h2 class="mb-5 mt-4 px-3 px-lg-0 px-xl-0 fs2">Frequently Asked Questions</h2>
                @php
                    $faqAddress = [
                        'birmingham' => '89-91 Hatchett Street, Birmingham, West Midlands, B19 3NY',
                        'leicester' => 'Leicester Arts Centre, located on Garden Street, Leicester, LE1 3UA',
                        'nottingham' => '296 Mansfield Road, Nottingham, NG5 2BT',
                        'london' => '',
                        'manchester' => '12 Tib St, Back Piccadilly, Manchester M4 1SH',
                    ];
                @endphp
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-4" data-aos="fade-up">
                        <div class="faqsInner">
                            <div class="accordion toggaleAccordion" id="accordionFaqs">
                                <div class="card active">
                                    <div class="card-header" id="acc1">
                                        <div class="h3 mb-0">
                                            <button
                                                class="btn btn-link text-left d-flex align-items-center justify-content-between w-100"
                                                type="button" data-toggle="collapse" data-target="#collapse1"
                                                aria-expanded="true" aria-controls="collapse1">
                                                <span>What is the location of the training in
                                                    {{ $slug->venue_name }}?</span>
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <div id="collapse1" class="collapse show" aria-labelledby="acc1"
                                        data-parent="#accordionFaqs">
                                        <p>All our training courses are held at the {{ $faqAddress[$slug->slug] }}. The
                                            venue is easily accessible by public transport and offers
                                            a comfortable learning environment.</p>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="acc2">
                                        <div class="h3 mb-0">
                                            <button
                                                class="btn btn-link text-left d-flex align-items-center justify-content-between w-100"
                                                type="button" data-toggle="collapse" data-target="#collapse2"
                                                aria-expanded="true" aria-controls="collapse2">
                                                <span>Who are the courses for?</span>
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <div id="collapse2" class="collapse" aria-labelledby="acc2"
                                        data-parent="#accordionFaqs">
                                        <p>Our courses are designed for anyone looking to start or advance their career in
                                            the security or safety sectors. Whether you’re new to the field or need to
                                            refresh your qualifications, we have a course for you.</p>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="acc3">
                                        <div class="h3 mb-0">
                                            <button
                                                class="btn btn-link text-left d-flex align-items-center justify-content-between w-100"
                                                type="button" data-toggle="collapse" data-target="#collapse3"
                                                aria-expanded="true" aria-controls="collapse3">
                                                <span>What courses are available at the {{ $slug->venue_name }}
                                                    location?</span>
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <div id="collapse3" class="collapse" aria-labelledby="acc3"
                                        data-parent="#accordionFaqs">
                                        <p>We offer the following courses in {{ $slug->venue_name }}:</p>
                                        <ul>
                                            <li>Door Supervisor Training</li>
                                            <li>Door Supervisor Refresher</li>
                                            <li>Security Guard Refresher</li>
                                            <li>Emergency First Aid at Work</li>
                                            <li>Health and Safety (HSA)</li>
                                            <li>Traffic Marshal &amp; Vehicle Banksman Course</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="acc4">
                                        <div class="h3 mb-0">
                                            <button
                                                class="btn btn-link text-left d-flex align-items-center justify-content-between w-100"
                                                type="button" data-toggle="collapse" data-target="#collapse4"
                                                aria-expanded="true" aria-controls="collapse4">
                                                <span>How do I enrol in a course in {{ $slug->venue_name }}?</span>
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <div id="collapse4" class="collapse" aria-labelledby="acc4"
                                        data-parent="#accordionFaqs">
                                        <p>Enrolling is easy! Simply contact us via phone, email, or through our website to
                                            book your seat. Our team will guide you through the registration process and
                                            provide all necessary details.</p>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="acc5">
                                        <div class="h3 mb-0">
                                            <button
                                                class="btn btn-link text-left d-flex align-items-center justify-content-between w-100"
                                                type="button" data-toggle="collapse" data-target="#collapse5"
                                                aria-expanded="true" aria-controls="collapse5">
                                                <span>Do I need any prior experience or qualifications to take a
                                                    course?</span>
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <div id="collapse5" class="collapse" aria-labelledby="acc5"
                                        data-parent="#accordionFaqs">
                                        <ul>
                                            <li>For <strong>Door Supervisor Training</strong>, no prior experience is
                                                required.</li>
                                            <li><strong>For Refresher Course</strong>s (Door Supervisor and Security Guard),
                                                you need to hold a valid SIA license or equivalent qualification.</li>
                                            <li>For other courses like <strong>Emergency First Aid at Work</strong>,
                                                <strong>Health and Safety (HSA)</strong> and <strong>Traffic
                                                    Marshal</strong>, no prior qualifications are necessary.
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="acc6">
                                        <div class="h3 mb-0">
                                            <button
                                                class="btn btn-link text-left d-flex align-items-center justify-content-between w-100"
                                                type="button" data-toggle="collapse" data-target="#collapse6"
                                                aria-expanded="true" aria-controls="collapse6">
                                                <span>Who can I contact for more information?</span>
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <div id="collapse6" class="collapse" aria-labelledby="acc6"
                                        data-parent="#accordionFaqs">
                                        <p>For more information, you can reach out to us via:</p>
                                        <p><strong>Call: 0121 630 2115</strong></p>
                                        <p><strong>Call Free: 0808 280 8098</strong></p>
                                        <p><strong>WhatsApp: 07904 010 700</strong></p>
                                        <p><strong>Email: info@training4employment.co.uk</strong></p>
                                        <p>We’re happy to assist with any queries or additional details you need.</p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-4" data-aos="fade-up">
                        <div class="faqsInner">
                            <div class="accordion toggaleAccordion" id="accordionFaqs">
                                <div class="card">
                                    <div class="card-header" id="acc7">
                                        <div class="h3 mb-0">
                                            <button
                                                class="btn btn-link text-left d-flex align-items-center justify-content-between w-100"
                                                type="button" data-toggle="collapse" data-target="#collapse7"
                                                aria-expanded="true" aria-controls="collapse7">
                                                <span>Is the first aid qualification needed to do the SIA Door Supervisor
                                                    course?</span>
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <div id="collapse7" class="collapse" aria-labelledby="acc7"
                                        data-parent="#accordionFaqs">
                                        <p>Yes, from August 2021 it is an SIA requirement that training centres must confirm
                                            that each candidate is sufficiently qualified in First Aid or Emergency First
                                            Aid.</p>
                                        <p>Therefore, all candidates will need to show that they hold a current and valid
                                            First Aid or Emergency First Aid certificate that meets the requirements of the
                                            Health and Safety (First Aid) Regulations 1981.</p>
                                        <p>The First Aid or Emergency First Aid certificate must be valid for at least 12
                                            months from the course start date.</p>
                                        <p>You will need to present your First Aid or Emergency First Aid certificate to
                                            Training4Employment before you start SIA Door Supervisor training.</p>
                                        <p>If you don’t have a valid First Aid or Emergency First Aid certificate, we can
                                            offer you can <a
                                                href="https://training4employment.co.uk/courses/emergency-first-aid-at-work/">Emergency
                                                First Aid Training Course.</a></p>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="acc8">
                                        <div class="h3 mb-0">
                                            <button
                                                class="btn btn-link text-left d-flex align-items-center justify-content-between w-100"
                                                type="button" data-toggle="collapse" data-target="#collapse8"
                                                aria-expanded="true" aria-controls="collapse8">
                                                <span>Do I have to complete any distance learning (E-learning) before
                                                    attending the training?</span>
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <div id="collapse8" class="collapse" aria-labelledby="acc8"
                                        data-parent="#accordionFaqs">
                                        <p>Yes, the Door Supervisor course includes distance learning which you must
                                            complete before you attend the classroom training.</p>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="acc9">
                                        <div class="h3 mb-0">
                                            <button
                                                class="btn btn-link text-left d-flex align-items-center justify-content-between w-100"
                                                type="button" data-toggle="collapse" data-target="#collapse9"
                                                aria-expanded="true" aria-controls="collapse9">
                                                <span>Are the courses accredited?</span>
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <div id="collapse9" class="collapse" aria-labelledby="acc9"
                                        data-parent="#accordionFaqs">
                                        <p>Yes! All our courses, except Traffic Marshal, Vehicle Banksman, are fully
                                            accredited and meet the latest industry standards. Upon successful completion,
                                            you will receive a recognised certification.</p>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="acc10">
                                        <div class="h3 mb-0">
                                            <button
                                                class="btn btn-link text-left d-flex align-items-center justify-content-between w-100"
                                                type="button" data-toggle="collapse" data-target="#collapse10"
                                                aria-expanded="true" aria-controls="collapse10">
                                                <span>How long does each course take?</span>
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <div id="collapse10" class="collapse" aria-labelledby="acc10"
                                        data-parent="#accordionFaqs">
                                        <ul>
                                            <li><strong>Door Supervisor Training</strong>: Typically runs over six days.
                                            </li>
                                            <li><strong>Refresher Courses</strong>: Usually completed in a single day.</li>
                                            <li><strong>Emergency First Aid at Work</strong>: A four-hour course.</li>
                                            <li><strong>Health and Safety (HSA)</strong>: A one-day course.</li>
                                            <li><strong>Traffic Marshal, Vehicle Banksman</strong>: A two-hour course.</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="acc11">
                                        <div class="h3 mb-0">
                                            <button
                                                class="btn btn-link text-left d-flex align-items-center justify-content-between w-100"
                                                type="button" data-toggle="collapse" data-target="#collapse11"
                                                aria-expanded="true" aria-controls="collapse11">
                                                <span>What's the difference between door supervisor and security
                                                    guard?</span>
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <div id="collapse11" class="collapse" aria-labelledby="acc11"
                                        data-parent="#accordionFaqs">
                                        <ul>
                                            <li><strong>Door Supervisors</strong>: Those who carry out security duties in or
                                                at licensed premises, like pubs and nightclubs, preventing crime and
                                                disorder and keeping staff and customers safe</li>
                                            <li><strong>Security Officers (guarding)</strong>: Those who guard premises
                                                against unauthorised access or occupation, outbreaks of disorder, theft or
                                                damage</li>
                                        </ul>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-4" data-aos="fade-up">
                        <div class="faqsInner">
                            <div class="accordion toggaleAccordion" id="accordionFaqs">
                                <div class="card">
                                    <div class="card-header" id="acc12">
                                        <div class="h3 mb-0">
                                            <button
                                                class="btn btn-link text-left d-flex align-items-center justify-content-between w-100"
                                                type="button" data-toggle="collapse" data-target="#collapse12"
                                                aria-expanded="true" aria-controls="collapse12">
                                                <span>Is the cost of an SIA licence included in the price of the security
                                                    courses? And can you help me apply?</span>
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <div id="collapse12" class="collapse" aria-labelledby="acc12"
                                        data-parent="#accordionFaqs">
                                        <p>No, the licence fee is a separate price. Payment for the license is £184.00 which
                                            is payable to the SIA (Security Industry Authority) this can be paid online on
                                            their website or at the Post Office. </p>
                                        <p>Yes, we can help you apply for your SIA badge. Our team offers online support for
                                            a £20 fee. Support is available via a Teams video call, where our staff can
                                            guide you through the process. During the session, you’ll be able to share your
                                            screen with our team to ensure the application is completed correctly. Call us
                                            to book your appointment. </p>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="acc13">
                                        <div class="h3 mb-0">
                                            <button
                                                class="btn btn-link text-left d-flex align-items-center justify-content-between w-100"
                                                type="button" data-toggle="collapse" data-target="#collapse13"
                                                aria-expanded="true" aria-controls="collapse13">
                                                <span>What should I bring to the training?</span>
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <div id="collapse13" class="collapse" aria-labelledby="acc13"
                                        data-parent="#accordionFaqs">
                                        <p>We recommend bringing the following:</p>
                                        <ul>
                                            <li>A valid ID (passport, driver’s license, or other government-issued ID).</li>
                                            <li>Comfortable clothing.</li>
                                            <li>For refresher courses, your current SIA license or proof of qualification.
                                            </li>
                                        </ul>
                                        <p>For further information, please visit Examination Requirements page: <a
                                                href="https://training4employment.co.uk/examination-requirements/">https://training4employment.co.uk/examination-requirements/</a>
                                        </p>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="acc14">
                                        <div class="h3 mb-0">
                                            <button
                                                class="btn btn-link text-left d-flex align-items-center justify-content-between w-100"
                                                type="button" data-toggle="collapse" data-target="#collapse14"
                                                aria-expanded="true" aria-controls="collapse14">
                                                <span>Is there parking available at the venue?</span>
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <div id="collapse14" class="collapse" aria-labelledby="acc14"
                                        data-parent="#accordionFaqs">
                                        <p>Yes, there are parking options available near the Hatchett Street,
                                            {{ $slug->venue_name }},
                                            West Midlands. Please contact us for specific details or recommendations.</p>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="acc15">
                                        <div class="h3 mb-0">
                                            <button
                                                class="btn btn-link text-left d-flex align-items-center justify-content-between w-100"
                                                type="button" data-toggle="collapse" data-target="#collapse15"
                                                aria-expanded="true" aria-controls="collapse15">
                                                <span>What happens after I complete the course?</span>
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <div id="collapse15" class="collapse" aria-labelledby="acc15"
                                        data-parent="#accordionFaqs">
                                        <p>Upon successful completion, you will receive your certification. For SIA-related
                                            courses, you can then apply or renew your license through the official SIA
                                            website. Our team can guide you through this process if needed.</p>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="acc16">
                                        <div class="h3 mb-0">
                                            <button
                                                class="btn btn-link text-left d-flex align-items-center justify-content-between w-100"
                                                type="button" data-toggle="collapse" data-target="#collapse16"
                                                aria-expanded="true" aria-controls="collapse16">
                                                <span>Can I reschedule if I can’t attend my booked course?</span>
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <div id="collapse16" class="collapse" aria-labelledby="acc16"
                                        data-parent="#accordionFaqs">
                                        <p>We understand that plans can change. If you need to reschedule, please contact us
                                            as soon as possible. We’ll do our best to accommodate your request.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        {{-- Form --}}
        <div id="startCours" data-aos="fade-up">
            <x-frontend.request_form />
        </div>
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
            AOS.init({
                duration: 1200,
                once: true, // Run animations only once
            });

            // Reinitialize on window load to ensure proper layout
            $(window).on('load', function() {
                AOS.refresh();
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            // Toggle active class on card click
            $(document).on('click', '.toggaleAccordion .card-header button', function() {
                $('.toggaleAccordion .card').removeClass('active');
                $(this).closest('.card').addClass('active');
            });
        });
    </script>
@endpush

@push('footer_schema')
    <script type="application/ld+json">
        {
        "@context": "https://schema.org",
        "@type": "Course",
        "@id": "https://training4employment.co.uk/public/sia-security-training-courses-in-birmingham",
        "name": "SIA Security Training Courses – Birmingham",
        "description": "Various SIA-approved security training courses delivered in Birmingham, including Door Supervisor, CCTV Operator, Security Guard Refresher, Emergency First Aid, HSA and Traffic Marshal & Vehicle Banksman.",
        "provider": {
            "@type": "Organization",
            "name": "Training4Employment",
            "sameAs": "https://training4employment.co.uk",
            "contactPoint": {
            "@type": "ContactPoint",
            "telephone": "+44-808-280-8098",
            "contactType": "customer support",
            "availableLanguage": [
                "en"
            ],
            "areaServed": "GB",
            "email": "info@training4employment.co.uk",
            "hoursAvailable": {
                "@type": "OpeningHoursSpecification",
                "opens": "00:00",
                "closes": "23:59",
                "dayOfWeek": [
                "Monday",
                "Tuesday",
                "Wednesday",
                "Thursday",
                "Friday",
                "Saturday",
                "Sunday"
                ]
            }
            }
        },
        "hasCourseInstance": [
            {
            "@type": "CourseInstance",
            "name": "SIA Door Supervisor – Birmingham",
            "courseMode": "Blended Learning",
            "location": {
                "@type": "Place",
                "geo": {
                "@type": "GeoCoordinates",
                "latitude": 52.485,
                "longitude": -1.902
                },
                "address": {
                "@type": "PostalAddress",
                "streetAddress": "89–91 Hatchett Street",
                "addressLocality": "Birmingham",
                "postalCode": "B19 3NY",
                "addressCountry": "GB"
                }
            }
            },
            {
            "@type": "CourseInstance",
            "name": "SIA CCTV Operator – Birmingham",
            "courseMode": "Blended Learning",
            "location": {
                "@type": "Place",
                "geo": {
                "@type": "GeoCoordinates",
                "latitude": 52.485,
                "longitude": -1.902
                },
                "address": {
                "@type": "PostalAddress",
                "streetAddress": "89–91 Hatchett Street",
                "addressLocality": "Birmingham",
                "postalCode": "B19 3NY",
                "addressCountry": "GB"
                }
            }
            },
            {
            "@type": "CourseInstance",
            "name": "Door Supervisor Refresher – Birmingham",
            "courseMode": "Blended Learning",
            "location": {
                "@type": "Place",
                "geo": {
                "@type": "GeoCoordinates",
                "latitude": 52.485,
                "longitude": -1.902
                },
                "address": {
                "@type": "PostalAddress",
                "streetAddress": "89–91 Hatchett Street",
                "addressLocality": "Birmingham",
                "postalCode": "B19 3NY",
                "addressCountry": "GB"
                }
            }
            },
            {
            "@type": "CourseInstance",
            "name": "Security Guard Refresher – Birmingham",
            "courseMode": "Blended Learning",
            "location": {
                "@type": "Place",
                "geo": {
                "@type": "GeoCoordinates",
                "latitude": 52.485,
                "longitude": -1.902
                },
                "address": {
                "@type": "PostalAddress",
                "streetAddress": "89–91 Hatchett Street",
                "addressLocality": "Birmingham",
                "postalCode": "B19 3NY",
                "addressCountry": "GB"
                }
            }
            },
            {
            "@type": "CourseInstance",
            "name": "Emergency First Aid at Work – Birmingham",
            "courseMode": "Blended Learning",
            "location": {
                "@type": "Place",
                "geo": {
                "@type": "GeoCoordinates",
                "latitude": 52.485,
                "longitude": -1.902
                },
                "address": {
                "@type": "PostalAddress",
                "streetAddress": "89–91 Hatchett Street",
                "addressLocality": "Birmingham",
                "postalCode": "B19 3NY",
                "addressCountry": "GB"
                }
            }
            },
            {
            "@type": "CourseInstance",
            "name": "Traffic Marshall Training – Birmingham",
            "courseMode": "Classroom Based",
            "location": {
                "@type": "Place",
                "geo": {
                "@type": "GeoCoordinates",
                "latitude": 52.485,
                "longitude": -1.902
                },
                "address": {
                "@type": "PostalAddress",
                "streetAddress": "89–91 Hatchett Street",
                "addressLocality": "Birmingham",
                "postalCode": "B19 3NY",
                "addressCountry": "GB"
                }
            }
            },
            {
            "@type": "CourseInstance",
            "name": "Level 1 Health and Safety Awareness within Construction Environment – Birmingham",
            "courseMode": "Blended Learning",
            "location": {
                "@type": "Place",
                "geo": {
                "@type": "GeoCoordinates",
                "latitude": 52.485,
                "longitude": -1.902
                },
                "address": {
                "@type": "PostalAddress",
                "streetAddress": "89–91 Hatchett Street",
                "addressLocality": "Birmingham",
                "postalCode": "B19 3NY",
                "addressCountry": "GB"
                }
            }
            },
            {
            "@type": "CourseInstance",
            "name": "Health and Safety Awareness - HSA – Birmingham",
            "courseMode": "Classroom Based",
            "location": {
                "@type": "Place",
                "geo": {
                "@type": "GeoCoordinates",
                "latitude": 52.485,
                "longitude": -1.902
                },
                "address": {
                "@type": "PostalAddress",
                "streetAddress": "89–91 Hatchett Street",
                "addressLocality": "Birmingham",
                "postalCode": "B19 3NY",
                "addressCountry": "GB"
                }
            }
            }
        ],
        "offers": [
            {
            "@type": "Offer",
            "name": "SIA Door Supervisor",
            "price": "261.50",
            "priceCurrency": "GBP",
            "url": "http://127.0.0.1:8000/courses/sia-door-supervisor"
            },
            {
            "@type": "Offer",
            "name": "SIA CCTV Operator",
            "price": "201.50",
            "priceCurrency": "GBP",
            "url": "http://127.0.0.1:8000/courses/sia-cctv-operator"
            },
            {
            "@type": "Offer",
            "name": "Door Supervisor Refresher",
            "price": "156.50",
            "priceCurrency": "GBP",
            "url": "http://127.0.0.1:8000/courses/door-supervisor-refresher"
            },
            {
            "@type": "Offer",
            "name": "Security Guard Refresher",
            "price": "101.50",
            "priceCurrency": "GBP",
            "url": "http://127.0.0.1:8000/courses/security-guard-refresher"
            },
            {
            "@type": "Offer",
            "name": "Emergency First Aid at Work",
            "price": "67.50",
            "priceCurrency": "GBP",
            "url": "http://127.0.0.1:8000/courses/emergency-first-aid-at-work"
            },
            {
            "@type": "Offer",
            "name": "Traffic Marshall Training",
            "price": "67.50",
            "priceCurrency": "GBP",
            "url": "http://127.0.0.1:8000/courses/traffic-marshall-training"
            },
            {
            "@type": "Offer",
            "name": "Level 1 Health and Safety Awareness within Construction Environment",
            "price": "101.50",
            "priceCurrency": "GBP",
            "url": "http://127.0.0.1:8000/courses/level-1-health-and-safety-awareness-within-construction-environment"
            },
            {
            "@type": "Offer",
            "name": "Health and Safety Awareness - HSA",
            "price": "147.50",
            "priceCurrency": "GBP",
            "url": "http://127.0.0.1:8000/courses/health-and-safety-awareness-hsa"
            }
        ]
        }
    </script>
@endpush
