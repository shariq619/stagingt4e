@extends('layouts.frontend')
@section('title', 'Courses')

@section('main')
    @php
        use Illuminate\Support\Facades\Request;
        use Illuminate\Support\Str;
    @endphp
    <div class="coursePage">
        <section class="coursesWrapper py-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-12">
                        <div class="bannerCol pb-5">
                            <div class="bannerInfo">
                                <h1 class="mb-4">COURSES</h1>
                                <p class="h5 font-weight-normal mb-4">At Training4Employment we deliver training that works.
                                    We
                                    help
                                    people to get the knowledge and skills they need to get on with their professional lives
                                </p>
                                <ul class="list-unstyled p-0 m-0">
                                    <li class="mb-3"><i class="far fa-check-square mr-2"></i><strong>100% money back
                                            guarantee</strong>:&nbsp; Get
                                        a <b>full refund</b> if you change your mind. Terms apply.</li>
                                    <li class="mb-3"><i class="far fa-check-square mr-2"></i><strong>Top-rated training
                                            provider</strong><b>:&nbsp; 95%</b> of our delegates pass the exam in the first
                                        attempt.</li>
                                    <li class="mb-3"><i class="far fa-check-square mr-2"></i><strong>No hidden
                                            fees:</strong>&nbsp; We
                                        <b>never</b> charge any hidden fees.
                                    </li>
                                    <li class="mb-3"><i class="far fa-check-square mr-2"></i><strong>Excellent customer
                                            support</strong>:&nbsp;
                                        Excellence in customer support is one of our main priorities.</li>
                                    <li class="mb-3"><i class="far fa-check-square mr-2"></i><strong>Group
                                            discounts</strong>:&nbsp;
                                        Contact
                                        our
                                        office to discuss group bookings.</li>
                                </ul>
                            </div>
                            <div class="bookingBtnGroup d-flex flex-column flex-md-row flex-lg-row mb-2">
                                <a href="{{ route('courses.calender') }}" target="_blank"
                                    class="mr-lg-2 mr-md-2 mr-sm-0 mb-2 mb-md-0 mb-lg-0 btnMstr text-center">
                                    <i class="fa-solid fa-cloud-arrow-down"></i> Download Our Course Calendar & Price
                                    List</a>
                            </div>
                        </div>
                        <h2 class="mb-4">Find the right location for you.</h2>

                        <div class="card shadow-sm border-0 mb-4 filter-card">
                            <div class="card-body">
                                <form id="courseFilters" method="GET" class="row gy-3 align-items-end">
                                    {{-- Course Type --}}
                                    <div class="col-12 col-lg">
                                        <label for="filterCategory" class="form-label text-uppercase small mb-1">
                                            Course Type
                                        </label>
                                        <select name="category_id"
                                                id="filterCategory"
                                                class="form-control">
                                            <option value="0" {{ request('category_id') == 0 || request('category_id') == '' ? 'selected' : '' }}>
                                                All Course Types
                                            </option>

                                            @foreach($categories as $category)
                                                @if ($category->slug !== 'e-learning-and-bite-size-courses')
                                                    <option value="{{ $category->id }}"
                                                        {{ (int) request('category_id') === (int) $category->id ? 'selected' : '' }}>
                                                        {{ $category->name }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>

                                    {{-- Location --}}
                                    <div class="col-12 col-lg">
                                        <label for="filterVenue" class="form-label text-uppercase small mb-1">
                                            Location
                                        </label>
                                        <select name="venue_id"
                                                id="filterVenue"
                                                class="form-control">
                                            <option value="" {{ request('venue_id') == '' ? 'selected' : '' }}>
                                                All Locations
                                            </option>

                                            @foreach($venues as $venue)
                                                <option value="{{ $venue->id }}"
                                                    {{ (int) request('venue_id') === (int) $venue->id ? 'selected' : '' }}>
                                                    {{ $venue->venue_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    {{-- Awarding Body --}}
                                    <div class="col-12 col-lg">
                                        <label for="filterAwardingBody" class="form-label text-uppercase small mb-1">
                                            Awarding Body
                                        </label>
                                        <select name="awarding_body_id"
                                                id="filterAwardingBody"
                                                class="form-control">
                                            <option value="" {{ request('awarding_body_id') == '' ? 'selected' : '' }}>
                                                All Awarding Bodies
                                            </option>

                                            @foreach($awardingBodies as $body)
                                                <option value="{{ $body->id }}"
                                                    {{ (int) request('awarding_body_id') === (int) $body->id ? 'selected' : '' }}>
                                                    {{ $body->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    {{-- Duration --}}
                                    <div class="col-12 col-lg">
                                        <label for="filterDuration" class="form-label text-uppercase small mb-1">
                                            Duration
                                        </label>
                                        <select name="duration"
                                                id="filterDuration"
                                                class="form-control">
                                            <option value="" {{ request('duration') == '' ? 'selected' : '' }}>
                                                All Durations
                                            </option>

                                            @foreach($durations as $duration)
                                                <option value="{{ $duration }}"
                                                    {{ request('duration') === $duration ? 'selected' : '' }}>
                                                    {{ $duration }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    {{-- Reset (same line on lg+, own line on mobile) --}}
                                    <div class="col-12 col-lg d-flex justify-content-lg-end mt-2 mt-lg-4">
                                        <a href="{{ route('courses.index') }}"
                                           class="btn btn-outline-secondary w-100 w-lg-auto text-center">
                                            Reset
                                        </a>
                                    </div>
                                </form>

                            </div>
                        </div>







                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-courses" role="tabpanel"
                                aria-labelledby="pills-courses-tab">
                                <div class="row" id="courses-container">
                                    @forelse ($courses as $course)
                                        <div class="col-12 col-md-6 col-lg-6" data-aos="fade-up" data-aos-duration="3000">
                                            <div class="productcertificate">
                                                <div class="row">
                                                    <div class="col-md-6 col-lg-6 col-sm-12">
                                                        <div class="productGridThumbnails position-relative">
                                                            <div class="productGridImgs">
                                                                <img src="{{ $course->course_image ? asset($course->course_image) : asset('images/placeholderimage.jpg') }}"
                                                                    class="img-fluid w-100"
                                                                    alt="{{ Str::title($course->name) }}">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 col-lg-6 col-sm-12">
                                                        <div class="productGridContents">
                                                            <h2 class="h4">{{ $course->name }}</h2>
                                                            <p>{!! Str::limit($course->description, 100, '...') !!}</p>
                                                            <ul class="list-unstyled pb-4 m-0">
                                                                <li class="d-flex align-content-center"><i
                                                                        class="mr-3 fas fa-home"></i>
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
                                                                    <p class="m-0"><strong>Income Potential</strong>: £13
                                                                        –
                                                                        £23 per hour</p>
                                                                </li>
                                                                <li class="d-flex align-content-center"><i
                                                                        class="mr-3 far fa-clock"></i>
                                                                    <p class="m-0"><strong>Duration</strong>:
                                                                        {{ $course->duration }}</p>
                                                                </li>
                                                                <li class="d-flex align-content-center"><i
                                                                        class="mr-3 fas fa-coins"></i>
                                                                    <p class="m-0"><strong>Price</strong>: from
                                                                        £{{ $course->price ?? '' }}</p>
                                                                </li>
                                                            </ul>

                                                            @php
                                                                $default = $course->cohorts->isNotEmpty()
                                                                    ? 'View Dates & Venues'
                                                                    : 'Learn More';
                                                            @endphp
                                                            <a href="{{ route('course.show', $course->slug) }}"
                                                                class="gridBtn">{{ $default }}</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="col-12 col-md-6 col-lg-6" data-aos="fade-up" data-aos-duration="3000">
                                            <div class="row justify-content-center my-5">
                                                <div class="col-md-6">
                                                    <div class="text-center p-4 shadow-sm rounded bg-light">
                                                        <h4 class="fw-bold mb-2">No Courses Found</h4>
                                                        <p class="text-muted">It looks like there are no available courses at the moment.</p>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                </div>
                                @endforelse
                            </div>
                        </div>

                        {{--                            @if (!request()->has('category_id')) --}}
                        {{--                                <div class="d-flex justify-content-center"> --}}
                        {{--                                    <button id="load-more" class="btn btn-primary mt-3 p-2">Load More</button> --}}
                        {{--                                </div> --}}
                        {{--                            @endif --}}

                    </div>
                </div>
            </div>
        </section>

        <section class="py-5 popularBundles position-relative overflow-hidden d-none">
            <div class="bundleBackgroundPattern"></div>
            <div class="container position-relative">
                <div class="bundleHeader text-center mb-5">
                    <span class="bundleBadge">Special Offers</span>
                    <h2 class="bundleTitle mb-3">Our Most Popular Course Bundles</h2>
                    <p class="bundleSubtitle">Save More, Learn Smarter — Get the best value with our expertly curated bundles</p>
                </div>

                <div class="row justify-content-center">
                    @foreach ($bundles as $bundle)
                        <div class="col-12 col-md-6 col-lg-4 mb-4" data-aos="fade-up" data-aos-duration="800">
                            <div class="bundleCard h-100">
                                <div class="bundleImageWrapper position-relative overflow-hidden">
                                    <div class="bundleImage">
                                        <img src="{{ asset($bundle->bundle_image ?? 'images/placeholderimage.jpg') }}"
                                             alt="{{ $bundle->name }}" class="img-fluid w-100">
                                    </div>
                                    <div class="bundleOverlay">
                                        <div class="bundleOverlayContent">
                                            <i class="fas fa-gift bundleIcon"></i>
                                        </div>
                                    </div>
                                    <div class="bundleRibbon">
                                        <i class="fas fa-star"></i> Popular
                                    </div>
                                </div>
                                <div class="bundleContent">
                                    <h4 class="bundleName mb-3">{{ $bundle->name }}</h4>
                                    <a href="{{ route('course.bundle.show', $bundle->slug) }}" class="bundleBtn">
                                        <span>View Bundle</span>
                                        <i class="fas fa-arrow-right ml-2"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>



        <section class="pb-5">
            <div class="container">
                <h2 class="fs2 text-center mb-4">What Do Our Customers Say?</h2>
                <script defer async src='https://cdn.trustindex.io/loader.js?34690d4371cd5966f966569d8e0'></script>
            </div>
        </section>
    </div>
@endsection

@push('css')
    <style>
        .productGridThumbnail:hover a.gridBtn {
            transform: translateY(0px);
            transition: all 0.3s ease;
        }


        .productGridInner .productGridContent ul li {
            margin-bottom: 6px;
        }

        .productGridInner .productGridContent ul li i {
            color: #085e92;
        }

        .productGridInner .productGridContent a.gridBtn {
            background: #085e92;
            color: #fff;
            display: block;
            text-align: center;
            padding: 10px 10px;
            margin-top: 30px;
            position: relative;
            width: 60%;
            margin-left: auto;
            margin-right: auto;
            margin-bottom: 20px;
        }

        .productGridInner .productGridContent a.gridBtn:before {
            content: '';
            border: solid 1px #085e92;
            position: absolute;
            left: -4px;
            top: -4px;
            height: 100%;
            width: 50%;
            border-bottom: none;
            border-right: none;
            transition: all 0.3s ease;
        }

        .productGridInner .productGridContent a.gridBtn:after {
            content: '';
            border: solid 1px #085e92;
            position: absolute;
            right: -4px;
            bottom: -4px;
            height: 100%;
            width: 50%;
            border-top: none;
            border-left: none;
            transition: all 0.3s ease;
        }

        .productGridInner:hover .productGridContent a.gridBtn:after,
        .productGridInner:hover .productGridContent a.gridBtn:before {
            width: 100%;
            transition: all 0.3s ease;
        }

        .productGridInner:hover .productGridContent a.gridBtn {
            background: #000;
        }



        .productGrid {
            box-shadow: #00000063 0px 0px 20px 0px;
            padding: 10px;
            overflow: hidden;
        }

        .productGridThumbnail:before {
            content: '';
            background: #085e92;
            width: 50%;
            height: 50%;
            position: absolute;
            top: -10px;
            left: -10px;
            z-index: -1;
            transition: all 0.3s ease;
        }

        .productGridThumbnail:after {
            content: '';
            background: #085e92;
            width: 50%;
            height: 50%;
            position: absolute;
            bottom: -10px;
            right: -10px;
            z-index: -1;
        }

        .productGridThumbnail:hover:before {
            width: 103%;
            height: 103%;
            transition: all 0.3s ease;
        }

        .productGridThumbnail:hover:after {
            transition: all 0.3s ease;
            width: 106%;
            height: 105.6%;
        }

        .productGridThumbnail .productGridOverlay {
            position: absolute;
            height: 100%;
            width: 100%;
            top: 0;
            bottom: 0;
            right: 0;
            left: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            /* transform: translateY(50%); */
            transition: all 0.4s ease;
            opacity: 0;
            visibility: hidden;
        }

        .productGridThumbnail:hover .productGridOverlay {
            /* transform: translateY(0%); */
            opacity: 1;
            visibility: visible;
            transition: all 0.4s ease;
        }

        .productGridThumbnail:hover .productGridImg {
            transition: all 0.2s ease;
        }

        .productGridThumbnail .productGridImg {
            transition: all 0.2s ease;
            opacity: 1;
            height: 100%;
        }

        .productGridThumbnail {
            height: 350px;
            margin-bottom: 25px;
        }

        .productGridImg h3 {
            position: absolute;
            top: 5%;
            left: 5%;
            color: #fff;
        }

        .productGridImg {
            position: relative;
        }

        .productGridImg:before {
            content: '';
            background: #0000007a;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            position: absolute;
        }

        .productGridThumbnail .productGridImg img {
            height: 100%;
            object-fit: cover;
        }

        .productGridOverlay a.gridBtn {
            background: #085e92;
            color: #fff;
            border-radius: 30px;
            padding: 10px 20px;
        }
    </style>
    <style>
        .filter-card {
            border-radius: 1rem;
            background: linear-gradient(135deg, #ffffff, #f3f4ff);
        }

        .filter-card .form-label {
            font-weight: 600;
            letter-spacing: .06em;
        }

        .filter-card .form-control {
            border-radius: .75rem;
            border-color: #e5e7eb;
            box-shadow: none;
        }

        .filter-card .form-control:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 .2rem rgba(13,110,253,.15);
        }

        @media (max-width: 767.98px) {
            .filter-card {
                padding: .75rem !important;
            }
        }


        /* 🔸 Reset button styled in brand orange */
        .filter-card .btn-outline-secondary {
            background: #ea7000;
            color: #fff;
            border: 1px solid #ea7000;
            border-radius: 18px;
            font-weight: 600;
            padding-inline: 1.5rem;
            transition: all 0.25s ease;
            box-shadow: 0 4px 12px rgba(234, 112, 0, 0.3);
        }

        .filter-card .btn-outline-secondary:hover {
            background: #ff7b00;
            border-color: #ff7b00;
            box-shadow: 0 6px 20px rgba(234, 112, 0, 0.45);
            transform: translateY(-1px);
            color: #fff;
        }

        /* Popular Bundles Section - Enhanced Design */
        .popularBundles {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 50%, #f8f9fa 100%);
            position: relative;
            padding: 80px 0 !important;
        }

        .bundleBackgroundPattern {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image:
                radial-gradient(circle at 20% 50%, rgba(8, 94, 146, 0.03) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(234, 112, 0, 0.03) 0%, transparent 50%);
            pointer-events: none;
        }

        .bundleHeader {
            position: relative;
            z-index: 1;
        }

        .bundleBadge {
            display: inline-block;
            background: linear-gradient(135deg, #ea7000 0%, #ff8c00 100%);
            color: #fff;
            padding: 8px 24px;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 700;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            box-shadow: 0 4px 15px rgba(234, 112, 0, 0.3);
            margin-bottom: 20px;
        }

        .bundleTitle {
            font-size: 2.5rem;
            font-weight: 800;
            color: #07102c;
            line-height: 1.2;
            margin-bottom: 15px !important;
        }

        .bundleSubtitle {
            font-size: 1.1rem;
            color: #6b7280;
            max-width: 700px;
            margin: 0 auto;
            line-height: 1.6;
        }

        .bundleCard {
            background: #fff;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            border: 1px solid rgba(229, 231, 235, 0.8);
            position: relative;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .bundleCard::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #085e92 0%, #ea7000 100%);
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.4s ease;
        }

        .bundleCard:hover {
            transform: translateY(-12px) scale(1.02);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
            border-color: rgba(8, 94, 146, 0.3);
        }

        .bundleCard:hover::before {
            transform: scaleX(1);
        }

        .bundleImageWrapper {
            position: relative;
            height: 260px;
            overflow: hidden;
        }

        .bundleImage {
            width: 100%;
            height: 100%;
            position: relative;
        }

        .bundleImage img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .bundleCard:hover .bundleImage img {
            transform: scale(1.15);
        }

        .bundleOverlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(8, 94, 146, 0.85) 0%, rgba(234, 112, 0, 0.85) 100%);
            opacity: 0;
            transition: opacity 0.4s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .bundleCard:hover .bundleOverlay {
            opacity: 1;
        }

        .bundleOverlayContent {
            text-align: center;
        }

        .bundleIcon {
            font-size: 3rem;
            color: #fff;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }

        .bundleRibbon {
            position: absolute;
            top: 15px;
            right: -35px;
            background: linear-gradient(135deg, #ea7000 0%, #ff8c00 100%);
            color: #fff;
            padding: 6px 40px;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transform: rotate(45deg);
            box-shadow: 0 4px 12px rgba(234, 112, 0, 0.4);
            z-index: 2;
        }

        .bundleRibbon i {
            margin-right: 4px;
        }

        .bundleContent {
            padding: 30px 25px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .bundleName {
            font-size: 1.35rem;
            color: #07102c;
            font-weight: 700;
            line-height: 1.4;
            margin-bottom: 20px !important;
            min-height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .bundleBtn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #085e92 0%, #0a6ba8 100%);
            color: #fff;
            padding: 14px 28px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(8, 94, 146, 0.3);
            position: relative;
            overflow: hidden;
        }

        .bundleBtn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s ease;
        }

        .bundleBtn:hover::before {
            left: 100%;
        }

        .bundleBtn:hover {
            background: linear-gradient(135deg, #0a6ba8 0%, #085e92 100%);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(8, 94, 146, 0.4);
            color: #fff;
        }

        .bundleBtn i {
            transition: transform 0.3s ease;
        }

        .bundleBtn:hover i {
            transform: translateX(5px);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .bundleTitle {
                font-size: 2rem;
            }

            .bundleSubtitle {
                font-size: 1rem;
                padding: 0 15px;
            }

            .bundleImageWrapper {
                height: 220px;
            }

            .bundleContent {
                padding: 25px 20px;
            }

            .bundleName {
                font-size: 1.2rem;
                min-height: auto;
            }

            .popularBundles {
                padding: 60px 0 !important;
            }
        }



    </style>

@endpush

@push('js')
    <script>
        // $(document).ready(function () {
        //     buttons.forEach(button => {
        //         button.addEventListener('click', function() {
        //             buttons.forEach(btn => btn.classList.remove('active'));
        //             this.classList.add('active');

        //             const categoryId = this.getAttribute('data-category-id');
        //             if (!categoryId) {
        //                 allCourses.forEach(course => course.style.display = 'block');
        //             } else {
        //                 allCourses.forEach(course => {
        //                     if (course.getAttribute('data-category-id') === categoryId || course.getAttribute('data-category-id') === 0) {
        //                         course.style.display = 'block';
        //                     } else {
        //                         course.style.display = 'none';
        //                     }
        //                 });
        //             }
        //         });
        //     });

        // });


        document.addEventListener('DOMContentLoaded', function() {
            if (window.location.hash) {
                document.querySelector(window.location.hash).scrollIntoView({
                    behavior: 'smooth'
                });
            }
        });

        $(document).ready(function() {
            $('.hover').hover(function() {
                $(this).addClass('flip');
            }, function() {
                $(this).removeClass('flip');
            });
        });
    </script>

    <script>
        let offset = 10; // keep your existing logic

        $('#load-more').on('click', function() {
            $.ajax({
                url: '{{ route('courses.index') }}',
                type: 'GET',
                data: {
                    offset: offset,
                    category_id: $('#filterCategory').val(),
                    venue_id: $('#filterVenue').val(),
                    awarding_body_id: $('#filterAwardingBody').val(),
                    duration: $('#filterDuration').val()
                },
                success: function(response) {
                    if (response.courses.length > 0) {
                        response.courses.forEach(function(course) {
                            $('#courses-container').append(`
                        <div class="col-12 col-md-6 col-lg-6" data-aos="fade-up" data-aos-duration="3000">
                            <div class="productcertificate">
                                <div class="row">
                                    <div class="col-md-6 col-lg-6 col-sm-12">
                                        <div class="productGridThumbnails position-relative">
                                            <div class="productGridImgs">
                                                <img src="${course.course_image ? '{{ asset('') }}' + course.course_image : '{{ asset('images/placeholderimage.jpg') }}'}"
                                                    class="img-fluid w-100" alt="${course.name}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-sm-12">
                                        <div class="productGridContents">
                                            <h3>${course.name}</h3>
                                            <p>${limitWordsWithHTML(course.description, 20)}</p>
                                            <ul class="list-unstyled pb-4 m-0">
                                                <li class="d-flex align-content-center"><i class="mr-3 fas fa-home"></i>
                                                    <p class="m-0"><strong>Delivery Mode</strong>: ${course.delivery_mode ?? ''}</p>
                                                </li>
                                                <li class="d-flex align-content-center"><i class="mr-3 fas fa-certificate"></i>
                                                    <p class="m-0"><strong>Award</strong>: ${course.awarding_body_name ?? ''}</p>
                                                </li>
                                                <li class="d-flex align-content-center"><i class="mr-3 fas fa-money-bill-wave"></i>
                                                    <p class="m-0"><strong>Income Potential</strong>: £13 – £23 per hour</p>
                                                </li>
                                                <li class="d-flex align-content-center"><i class="mr-3 far fa-clock"></i>
                                                    <p class="m-0"><strong>Duration</strong>: ${course.duration}</p>
                                                </li>
                                                <li class="d-flex align-content-center"><i class="mr-3 fas fa-coins"></i>
                                                    <p class="m-0"><strong>Price</strong>: from £${course.price ?? ''}</p>
                                                </li>
                                            </ul>
                                            <a href="/courses/${course.slug}" class="gridBtn">View Dates & Venues</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `);
                        });

                        offset += 10;
                    } else {
                        $('#load-more').text('No More Courses').prop('disabled', true);
                    }
                },
                error: function() {
                    alert('Failed to load more courses.');
                }
            });
        });



        function limitWordsWithHTML(text, limit) {
            // Strip HTML tags
            const strippedText = text.replace(/<[^>]*>/g, '');

            // Split into words
            const words = strippedText.split(/\s+/);

            // Check if word limit exceeded
            if (words.length > limit) {
                return words.slice(0, limit).join(' ') + '...';
            }

            return strippedText;
        }
    </script>
@endpush

@push('footer_schema')
    <script type="application/ld+json">
        {
        "@context": "https://schema.org",
        "@type": "Course",
        "name": "SIA Security Training – Training4Employment",
        "description": "Comprehensive SIA courses including Door Supervisor, CCTV Operator, Security Guard and Refresher courses, delivered via blended learning across multiple UK locations.",
        "provider": {
            "@type": "Organization",
            "name": "Training4Employment",
            "sameAs": "https://www.training4employment.co.uk"
        },
        "hasCourseInstance": [
            {
            "@type": "CourseInstance",
            "name": "SIA Door Supervisor",
            "startDate": "2025-06-30",
            "endDate": "2025-07-05",
            "courseMode": ["BlendedLearning"],
            "location": {
                "@type": "Place",
                "address": {
                "@type": "PostalAddress",
                "addressLocality": "Birmingham",
                "addressCountry": "UK"
                }
            }
            },
            {
            "@type": "CourseInstance",
            "name": "SIA CCTV Operator",
            "startDate": "2025-06-23",
            "endDate": "2025-06-25",
            "courseMode": ["BlendedLearning"],
            "location": {
                "@type": "Place",
                "address": {
                "@type": "PostalAddress",
                "addressLocality": "Birmingham",
                "addressCountry": "UK"
                }
            }
            },
            {
            "@type": "CourseInstance",
            "name": "Security Guard Refresher",
            "startDate": "2025-07-04",
            "endDate": "2025-07-04",
            "courseMode": ["BlendedLearning"],
            "location": {
                "@type": "Place",
                "address": {
                "@type": "PostalAddress",
                "addressLocality": "Birmingham",
                "addressCountry": "UK"
                }
            }
            },
            {
            "@type": "CourseInstance",
            "name": "Door Supervisor Refresher",
            "startDate": "2025-07-05",
            "endDate": "2025-07-06",
            "courseMode": ["BlendedLearning"],
            "location": {
                "@type": "Place",
                "address": {
                "@type": "PostalAddress",
                "addressLocality": "Birmingham",
                "addressCountry": "UK"
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
            "url": "https://training4employment.co.uk/sia-courses",
            "validFrom": "2025-06-01"
            },
            {
            "@type": "Offer",
            "name": "SIA CCTV Operator",
            "price": "201.50",
            "priceCurrency": "GBP",
            "url": "https://training4employment.co.uk/sia-courses",
            "validFrom": "2025-06-01"
            },
            {
            "@type": "Offer",
            "name": "Security Guard Refresher",
            "price": "101.50",
            "priceCurrency": "GBP",
            "url": "https://training4employment.co.uk/sia-courses",
            "validFrom": "2025-06-01"
            },
            {
            "@type": "Offer",
            "name": "Door Supervisor Refresher",
            "price": "156.50",
            "priceCurrency": "GBP",
            "url": "https://training4employment.co.uk/sia-courses",
            "validFrom": "2025-06-01"
            }
        ]
        }



    </script>
    <script>
        $(function () {
            $('#filterCategory, #filterVenue, #filterAwardingBody, #filterDuration').on('change', function () {
                $('#courseFilters').submit();
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            $('.videoSlider').slick({
                slidesToShow: 3,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 3000,
                dots: true,
                arrows: false,
                responsive: [
                    { breakpoint: 992, settings: { slidesToShow: 2 } },
                    { breakpoint: 768, settings: { slidesToShow: 1 } }
                ]
            });
        });
    </script>

@endpush
