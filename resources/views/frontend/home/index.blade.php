@extends('layouts.frontend')

@section('title', 'SIA Training Course')

@section('main')
    <div class="home-page">
        <section class="homeBanner">
            <div class="container">
                <div class="row flex-xl-row flex-lg-row flex-md-row flex-column-reverse">
                    <div class="col-12 col-md-8 col-lg-8">
                        <div id="bannerSlider" class="mt-lg-0 mt-md-0 mt-xl-0 mt-3">
                            <div class="sliderMain">
                                <div class="bannerSliderInfo bannerSliderInfo_1">
                                    <div class="bannerSliderBg" loading="lazy">
                                        <div class="bannerSliderInner">
                                            <div class="subTitle"><small>In High Demand</small></div>
                                            <h2>SIA <br>Door<br>Supervisor</h2>
                                            <div class="BannerDescription">
                                                Qualify for SIA Licence with 6-days course for <span>£261.50</span><br>Same
                                                day Results
                                            </div>
                                            <a href="{{ route('course.show', 'sia-door-supervisor') }}" class="bookNow">Book
                                                Now</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="bannerSliderInfo bannerSliderInfo_2">
                                    <div class="bannerSliderBg">
                                        <div class="bannerSliderInner">
                                            <div class="subTitle"><small>Best Selling</small></div>
                                            <h2>(EFAW)<br>Emergency First Aid <br>at Work</h2>
                                            <div class="BannerDescription">
                                                Gain essential life saving skills with 1/2 day course for
                                                <span>£67.50</span><br>Same
                                                day Results
                                            </div>
                                            <a href="{{ route('course.show', 'emergency-first-aid-at-work') }}"
                                                class="bookNow">Book Now</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4 col-lg-4">
                        <div class="bannerContactForm position-relative mt-lg-0 mt-md-0 mt-xl-0 mt-4">
                            <div id="loadingSpinnerHome" style="display: none; text-align: center;">
                                <i class="fas fa-spinner fa-spin fa-3x"></i>
                            </div>
                            <p class="h3 text-center">Request A Call Back</p>
                            <form action="{{ route('lead.form') }}" method="POST" id="bannerContactForm">
                                @csrf
                                <div class="inner-message">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="name" placeholder="Name">
                                    </div>
                                </div>
                                <div class="inner-message">
                                    <div class="form-group">
                                        <input type="email" class="form-control" name="email" placeholder="Email">
                                    </div>
                                </div>
                                <div class="inner-message">
                                    <div class="form-group">
                                        <input type="tel" class="form-control" name="phone"
                                            placeholder="Phone Number">
                                    </div>
                                </div>
                                <div class="inner-message">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="course_interested"
                                            placeholder="Course Interested">
                                    </div>
                                </div>
                                <div class="inner-message">
                                    <div class="form-group">
                                        <textarea class="form-control" name="notes" placeholder="Notes"></textarea>
                                    </div>
                                </div>

                                <div class="inner-message mb-3">
                                    <div class="recaptcha-form" id="recaptcha-form-1">
                                        @if (app()->isProduction())
                                            {!! NoCaptcha::display() !!}
                                        @endif
                                    </div>
                                    <div id="homeBannerRecaptchaError" class="text-danger"></div>
                                </div>

                                <button type="submit" class="btn btn-primary m-auto d-block w-100">Request a Call Back
                                    Within 15 Minutes</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="coursesCategory py-5">
            <div class="container">
                <h1 class="text-white mb-4 fs2">Courses by Category</h1>
                <div class="row">
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 px-2 mb-3">
                        <div class="courseBg1 courseBgImg">
                            <!--<div class="ribbon ribbon-top-right"><span>£10 off</span></div>-->
                            <div class="courseCat"
                                style="background:url({{ asset('frontend/img/course1.webp') }}) no-repeat center/cover;">
                            </div>
                            <div class="courseCatInfo">
                                <h3>SIA <br>Security<br>Training</h3>
                                <a href="{{ route('courses.byCategory', 'sia-security-training') }}">View Courses</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 px-2 mb-3">
                        <div class="courseBg2 courseBgImg">
                            <!--<div class="ribbon ribbon-top-right"><span>£10 off</span></div>-->
                            <div class="courseCat"
                                style="background:url({{ asset('frontend/img/course8.webp') }}) no-repeat center/cover;">
                            </div>
                            <div class="courseCatInfo">
                                <h3>Construction <br>
                                    Training</h3>
                                <a href="{{ route('courses.byCategory', 'construction') }}">View Courses</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 px-2 mb-3">
                        <div class="courseBg3 courseBgImg">
                            <!--<div class="ribbon ribbon-top-right"><span>£10 off</span></div>-->
                            <div class="courseCat"
                                style="background:url({{ asset('frontend/img/Traffic-Marshal-Vehicle-Banksma.webp') }}) no-repeat center/cover;">
                            </div>
                            <div class="courseCatInfo">
                                <h3>Traffic Marshal<br>
                                    Vehicle Banksman<br>Training</h3>
                                <a href="{{ route('courses.byCategory', 'traffic-marshall-training') }}">View
                                    Courses</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 px-2 mb-3">
                        <div class="courseBg4 courseBgImg">
                            <!--<div class="ribbon ribbon-top-right"><span>£10 off</span></div>-->
                            <div class="courseCat"
                                style="background:url({{ asset('frontend/img/course6.webp') }}) no-repeat center/cover;">
                            </div>
                            <div class="courseCatInfo">
                                <h3>First Aid<br>Training</h3>
                                <a href="{{ route('courses.byCategory', 'first-aid-training') }}">View Courses</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 px-2 mb-3">
                        <div class="courseBg5 courseBgImg">
                            <!--<div class="ribbon ribbon-top-right"><span>£10 off</span></div>-->
                            <div class="courseCat"
                                style="background:url({{ asset('frontend/img/course5.webp') }}) no-repeat center/cover;">
                            </div>
                            <div class="courseCatInfo">
                                <h3>Fire Safety <br>
                                    Training</h3>
                                <a href="{{ route('courses.byCategory', 'fire-safety-for-fire-wardens') }}">View
                                    Courses</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 px-2 mb-3">
                        <div class="courseBg6 courseBgImg">
                            <div class="courseCat"
                                style="background:url({{ asset('frontend/img/course4.webp') }}) no-repeat center/cover;">
                            </div>
                            <div class="courseCatInfo">
                                <h3>Alcohol <br>
                                    Licence
                                    <br>Training
                                </h3>
                                <a href="{{ route('courses.byCategory', 'alcohol') }}">View Courses</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 px-2 mb-3">
                        <div class="courseBg7 courseBgImg">
                            <div class="courseCat"
                                style="background:url({{ asset('frontend/img/course3.webp') }}) no-repeat center/cover;">
                            </div>
                            <div class="courseCatInfo">
                                <h3>Food Safety<br>&amp; Hygiene<br>Training</h3>
                                <a href="javascript:;">View Courses</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 px-2 mb-3">
                        <div class="courseBg8 courseBgImg">
                            <!--<div class="ribbon ribbon-top-right"><span>£10 off</span></div>-->
                            <div class="courseCat"
                                style="background:url({{ asset('frontend/img/course2.webp') }}) no-repeat center/cover;">
                            </div>
                            <div class="courseCatInfo">
                                <h3>E-learning<br>Courses</h3>
                                <a href="{{ route('elearning.index') }}">View
                                    Courses</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="py-5 trustindex">
            <div class="container"></div>
        </section>
        <x-frontend.modal-video />
        <section class="upcoming">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-md-12">
                        <div class="upcomingmainhead">
                            <h2>Our Upcoming Courses</h2>
                        </div>
                    </div>
                    @foreach ($upcomingCourses as $course)
                        @php
                            $formId = 'cartForm_' . $course->cohort_id; // Unique form ID
                            $startDate = \Carbon\Carbon::parse($course->start_date_time);
                        @endphp
                        <div class="col-sm-12 col-md-4 mb-4 mb-md-0 mb-lg-0 mb-xl-0 px-2 column-5">
                            <div class="upcomingmaincontent">
                                <div class="upcomingmaindata">
                                    <div class="upcomingheading">
                                        <h3 class="h4">{{ $course->name }}</h3>
                                        <p>📅 {!! formatCourseDateBold($course) !!} </p>
                                        <p class="h4">📍 {{ $course->venue_name ?? 'Unknown Venue' }}</p>
                                    </div>
                                    <div class="upcomingpara">
                                        <p>{!! Str::limit($course->description, 50, '...') !!}</p>
                                    </div>
                                </div>
                                <div class="upcomingbutton">
                                    <form action="{{ route('cart.add') }}" method="POST"
                                        check="{{ $course->cohort_id }}" id="{{ $formId }}">
                                        @csrf
                                        <input type="hidden" name="cohort_id" value="{{ $course->cohort_id }}">
                                        <input type="hidden" name="course_name" value="{{ $course->name }}">
                                        <input type="hidden" name="course_price" value="{{ $course->price }}">
                                    </form>

                                    @if ($course->is_soldout)
                                        <a href="javascript:" class="btnBlue">Sold Out</a>
                                    @else
                                        <a href="#" class="btnBlue"
                                            onclick="document.getElementById('{{ $formId }}').submit(); return false;">Book
                                            Now</a>
                                    @endif

                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="col-lg-12 text-center">
                        <a href="{{ route('courses.calender') }}" class="btn outline-none mt-4 text-white px-5 font-weight-bold py-2" style="background:#ea7000">View All Courses</a>
                    </div>
                </div>
            </div>
        </section>
    </div>

    @include('frontend.bespoke_form.index')
@endsection
@push('css')
    <style>
        .headerMenuBtn .mblLoginBtn {
            background: #0056b3;
            text-align: center;
        }

        .headerMenuBtn .mblLoginBtn a {
            display: block;
            padding: 8px 10px;
            color: #ffff;
            font-weight: 700;
        }

        .headerMenuBtn .mblLogoutBtn {
            background: #dc3545;
            text-align: center;
        }

        .headerMenuBtn .mblLogoutBtn a {
            display: block;
            padding: 8px 10px;
            color: #ffff;
            font-weight: 700;
        }

        .upcoming .column-5 {
            max-width: 20%;
            flex-basis: 20%;
        }

        .upcoming .upcomingmaincontent .upcomingmaindata {
            height: auto !important;
        }

        .upcoming .upcomingmaincontent .upcomingmaindata .upcomingheading h3 {
            font-size: unset;
            line-height: unset;
        }

        section.upcoming .upcomingmaincontent {
            padding: 15px;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .bannerSliderInfo_1 {
            background: url('/frontend/img/SIA-DOOR-SUPERVISOR-Banner.webp') no-repeat top center/cover;
        }

        .bannerSliderInfo_2 {
            background: url('/frontend/img/T4E-Emergency-First-Aid-at-Work-Promo-Banners.webp') no-repeat top center/cover;
        }
    </style>
    <style>
        div#loadingSpinnerHome {
            position: absolute;
            left: 0;
            right: 0;
            margin: auto;
            top: 0;
            bottom: 0;
            z-index: 9999;
            background: #00000036;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        div#loadingSpinnerHome i {
            color: #007bff;
        }
    </style>
@endpush
@push('js')
    <script src="{{ asset('frontend/js/requests.app.js') }}"></script>
    @if (Route::currentRouteName() === 'home.index')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const container = document.querySelector('.trustindex .container');
                if (!container) return;

                const script = document.createElement('script');
                script.src = 'https://cdn.trustindex.io/loader.js?34690d4371cd5966f966569d8e0';
                script.defer = true;

                container.appendChild(script);
            });
        </script>
    @endif
@endpush

@push('head_schema')
    <script type="application/ld+json">
    {
    "@context": "https://schema.org",
    "@type": "BreadcrumbList",
    "itemListElement": [
        {
        "@type": "ListItem",
        "position": 1,
        "name": "Home",
        "item": "https://training4employment.co.uk/"
        },
        {
        "@type": "ListItem",
        "position": 2,
        "name": "Courses",
        "item": "https://training4employment.co.uk/courses/"
        },
        {
        "@type": "ListItem",
        "position": 3,
        "name": "SIA Security",
        "item": "https://training4employment.co.uk/sia-courses/"
        },
        {
        "@type": "ListItem",
        "position": 4,
        "name": "SIA Door Supervisor",
        "item": "https://training4employment.co.uk/courses/sia-door-supervisor/"
        }
    ]
    }
    </script>
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Organization",
        "url": "{{ url('/') }}",
        "name": "Training 4 Employment",
        "description": "Specialist UK provider of accredited SIA security, first aid, construction, fire safety, traffic marshall & vehicle banksman, alcohol licensing, food safety and e‑learning courses.",
        "logo": "{{ asset('frontend/img/logo.webp') }}",
        "sameAs": [
            "https://www.facebook.com/training4employmentUK/",
            "https://uk.linkedin.com/company/training-for-employment",
            "https://www.youtube.com/channel/UCGrY7cOVvZuZM17lKc_ga8A"
        ],
        "contactPoint": [
            {
                "@type": "ContactPoint",
                "telephone": "+44-808-280-8098",
                "contactType": "customer support",
                "areaServed": "GB",
                "availableLanguage": ["en-GB"]
            },
            {
                "@type": "ContactPoint",
                "telephone": "+44-121-630-2115",
                "contactType": "office",
                "areaServed": "GB",
                "availableLanguage": ["en-GB"]
            },
            {
                "@type": "ContactPoint",
                "telephone": "+44-7904-010-700",
                "contactType": "sms",
                "areaServed": "GB",
                "availableLanguage": ["en-GB"]
            },
            {
                "@type": "ContactPoint",
                "email": "info@training4employment.co.uk",
                "contactType": "customer support",
                "areaServed": "GB",
                "availableLanguage": ["en-GB"]
            }
        ],
        "address": {
            "@type": "PostalAddress",
            "streetAddress": "Ground Floor, 89‑91 Hatchett Street",
            "addressLocality": "Birmingham",
            "postalCode": "B19 3NY",
            "addressCountry": "GB"
        },
        "telephone": "+44-808-280-8098",
        "email": "info@training4employment.co.uk",
        "foundingDate": "2010",
        "numberOfEmployees": "2-10",
        "vatID": "GB07457750"
    }
    </script>
@endpush
