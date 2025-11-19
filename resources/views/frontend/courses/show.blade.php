@extends('layouts.frontend')
@section('title', 'SIA Security Training Courses in ' . $slug->name)

@section('main')

    @push('css')
        <style>
            .btn-header-link .fa-chevron-down {
                transition: transform 0.3s ease;
            }

            .btn-header-link.collapsed .fa-chevron-down {
                transform: rotate(-90deg);
            }
        </style>
    @endpush



    <div class="product-page singleProduct">
        <section id="banner" class="bannerWrapper coursesSinglePage {{ Str::slug($slug->category->name) ?? '' }}">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-4 col-lg-4 bannerImg d-none d-lg-block d-xl-block"
                         style="background: url('{{ $slug->banner_image ? asset($slug->banner_image) : asset('imag es/placeholderimage.jpg') }}') no-repeat center / cover;">
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-8 py-5">
                        <div class="bannerCol px-3 px-lg-0 px-md-0 px-xl-0 pl-xl-5 pl-lg-5 pl-md-0 mr-xl-5 pr-xl-5">
                            {!! $slug->banner_description !!}
                            <div
                                class="bookingBtnGroup d-flex flex-column flex-sm-column flex-md-row flex-lg-row flex-xl-row mb-2">
                                <a href="#cdates"
                                   class="mr-lg-2 mr-md-2 mr-sm-0 mb-2 mb-md-0 mb-lg-0 btnMstr text-center"><i
                                        class="fas fa-shopping-cart"></i> Book Now</a>
                                <a href="javascript:;" class="btnWhiteBg text-center" data-toggle="modal"
                                   data-target="#bespokeForm"><i class="fas fa-users"></i> Request
                                    Bespoke
                                    Training</a>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
        <section class="mainContentWrapper courseRow py-5">
            @php
                $faqs = json_decode($slug->faqs, true);
                $value = 1;
            @endphp
            <div class="container">
                <div class="row flex-column-reverse flex-sm-column-reverse flex-md-row flex-lg-row flex-xl-row">
                    <div
                        class="col-12 col-sm-12 col-md-7 screen_800_col1 col-lg-8 col-xl-8 mt-5 mt-md-0 mt-lg-0 mt-xl-0">
                        <div class="tableOfContent mb-4">
                            <div class="tableOfContentWrapper">
                                <p class="h4 d-inline-block">Table of Content</p>
                                <div class="tableOfContentTable"></div>
                            </div>
                            <ul class="list-unstyled d-flex align-items-center p-0 m-0">
                                <li class="mb-2 mb-lg-0 mb-xl-0"><a href="#content">Contents</a></li>
                                @if (!empty($faqs) && is_array($faqs))
                                    <li class="mb-2 mb-lg-0 mb-xl-0"><a href="#faqs">Faqs</a></li>
                                @endif
                                @if ($locations->isNotEmpty())
                                    <li class="mb-2 mb-lg-0 mb-xl-0"><a href="#cdates">Course Dates</a></li>
                                @endif
                                @if ($Courselocations->isNotEmpty())
                                    <li class="mb-2 mb-lg-0 mb-xl-0"><a href="#locations">Locations</a></li>
                                @endif
                            </ul>
                        </div>
                        <div class="leftContentArea" id="content">
                            {!! $slug->long_desc !!}
                        </div>
                        <div class="faqsInner " id="faqs">
                            {{-- <div class="faqsWrapper" id="faq"> --}}
                            @if (!empty($faqs) && is_array($faqs))
                                <h3 class="mt-5 h2">FAQs</h3>
                                <div class="accordion toggaleAccordion mt-4" id="accordionFaqs">
                                    @foreach ($faqs as $faq)
                                        <div class="card {{ $value === 1 ? 'active' : '' }}">
                                            <div class="card-header" id="faqhead{{ $value }}">
                                                <button
                                                    class="btn btn-link text-left d-flex align-items-center justify-content-between w-100"
                                                    type="button" data-toggle="collapse"
                                                    data-target="#faq{{ $value }}" aria-expanded="true"
                                                    aria-controls="collapse1">
                                                    <span>{{ $faq['question'] ?? '' }}</span>
                                                    <i class="fas fa-plus"></i>
                                                </button>
                                            </div>
                                            <div id="faq{{ $value }}"
                                                 class="collapse {{ $value === 1 ? 'show' : '' }} mt-4"
                                                 aria-labelledby="faqhead{{ $value }}" data-parent="#accordionFaqs">
                                                <div>
                                                    {!! $faq['answer'] ?? '' !!}
                                                </div>
                                            </div>
                                        </div>
                                        @php $value++; @endphp
                                    @endforeach
                                </div>
                                {{-- </div> --}}
                            @endif
                        </div>
                        <div class="faqsWrapper singlecourse" id="cdates">
                            @if ($locations->isNotEmpty())
                                <h3 class="mt-5 h2">Course Dates</h3>
                            @endif
                            <div class="accordion mt-4" id="venueAccordion">
                                @php
                                    $value = 1;
                                @endphp
                                @forelse ($locations as $venueId => $cohorts)
                                    @php
                                        $venue = $cohorts->first()->venue;

                                        $sortedCohorts = $cohorts->sortBy(function ($cohort) {
                                            return \Carbon\Carbon::parse($cohort->start_date_time);
                                        });

                                    @endphp
                                    <div class="card">
                                        <div class="card-header {{ $venue->id === 1 ? 'active' : '' }}"
                                             id="heading{{ $venue->id }}">
                                            <a href="#"
                                               class="btn btn-header-link {{ $venue->id === 1 ? '' : 'collapsed' }} d-flex justify-content-between align-items-center"
                                               data-toggle="collapse" data-target="#collapse{{ $venue->id }}"
                                               aria-expanded="{{ $venue->id === 1 ? 'true' : 'false' }}"
                                               aria-controls="collapse{{ $venue->id }}">
                                                <span>{{ $venue->venue_name }}</span>
                                                <i class="fas fa-chevron-down ml-2 transition-transform"
                                                   aria-hidden="true"></i>
                                            </a>
                                        </div>

                                        <div id="collapse{{ $venue->id }}"
                                             class="collapse {{ $venue->id === 1 ? 'show' : '' }}"
                                             aria-labelledby="heading{{ $venue->id }}" data-parent="#venueAccordion">
                                            <div class="card-body locationDates" id="bookNowCourse">


                                                <div class="row">
                                                    @foreach ($sortedCohorts as $cohort)
                                                        @php
                                                            $course     = $cohort->course;
                                                            $price      = $course->price ?? '';
                                                            $startDate  = \Carbon\Carbon::parse($cohort->start_date_time);
                                                            $endDate    = \Carbon\Carbon::parse($cohort->end_date_time);
                                                            $radioId    = 'cohort-' . $cohort->id;
                                                            $resellerId = $cohort->reseller_id;

                                                            // If reseller exists, show 20% deposit price
                                                            $displayPrice = $resellerId ? round($price * 0.2, 2) : $price;
                                                        @endphp

                                                        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                                            <div class="courseDate mb-3" id="booknow">
                                                                <div class="d-flex align-items-center">
                                                                    <h3 class="h4 text-dark">{{ $course->name ?? '' }}</h3>
                                                                    @if (!empty($course->duration))
                                                                        <strong class="h6">
                                                                            <small
                                                                                class="text-muted ml-2">({{ $course->duration }}
                                                                                )</small>
                                                                        </strong>
                                                                    @endif
                                                                </div>

                                                                <div class="d-flex align-items-center justify-content-between">
                                                                    <div class="h4 m-0">
                                                                        <strong>
                                                                            £{{ number_format($displayPrice, 2) }}
                                                                        </strong>
                                                                        @if ($resellerId)
                                                                            <small class="text-muted">(20% Deposit)</small>
                                                                        @endif
                                                                    </div>
                                                                    <div class="imgCourse">
                                                                        <i class="fas fa-map-marker-alt"></i>
                                                                    </div>
                                                                </div>

                                                                <ul class="list-unstyled p-0 m-0">
                                                                    <li>
                                                                        <strong><i
                                                                                class="far fa-calendar"></i>{{ formatCourseDate($cohort) }}
                                                                        </strong>
                                                                    </li>
                                                                </ul>

                                                                <div class="btnFooter">
                                                                    <form action="{{ route('cart.add') }}"
                                                                          method="POST">
                                                                        @csrf
                                                                        <input type="hidden" name="cohort_id"
                                                                               value="{{ $cohort->id }}">
                                                                        <input type="hidden" name="course_name"
                                                                               value="{{ $course->name ?? '' }}">
                                                                        <input type="hidden" name="course_price"
                                                                               value="{{ $displayPrice }}">
                                                                        <input type="hidden" name="start_date"
                                                                               value="{{ $startDate->format('dS M Y g:iA') }}">
                                                                        <input type="hidden" name="end_date"
                                                                               value="{{ $endDate->format('dS M Y g:iA') }}">

                                                                        @if (is_numeric($price) && $price > 102)
                                                                            <ul class="wc-deposits-option list-unstyled pl-0 d-flex justify-content-between flex-column flex-lg-row flex-xl-row">



                                                                                @if ($resellerId)
                                                                                    {{-- Only deposit option available for reseller --}}
                                                                                    <li>
                                                                                        <input type="radio"
                                                                                               name="deposit_option"
                                                                                               value="deposit"
                                                                                               id="wc-option-pay-deposit-{{ $radioId }}"
                                                                                               checked>
                                                                                        <label for="wc-option-pay-deposit-{{ $radioId }}">Pay Deposit</label>
                                                                                    </li>
                                                                                @else
                                                                                    {{-- Both options available --}}
                                                                                    <li>
                                                                                        <input type="radio"
                                                                                               name="deposit_option"
                                                                                               value="deposit"
                                                                                               id="wc-option-pay-deposit-{{ $radioId }}">
                                                                                        <label for="wc-option-pay-deposit-{{ $radioId }}">Pay Deposit</label>
                                                                                    </li>
                                                                                    <li>
                                                                                        <input type="radio"
                                                                                               name="deposit_option"
                                                                                               value="full"
                                                                                               id="wc-option-pay-full-{{ $radioId }}"
                                                                                               checked>
                                                                                        <label for="wc-option-pay-full-{{ $radioId }}">Pay in Full</label>
                                                                                    </li>
                                                                                @endif


{{--                                                                                <li>--}}
{{--                                                                                    <input type="radio"--}}
{{--                                                                                           name="deposit_option"--}}
{{--                                                                                           value="deposit"--}}
{{--                                                                                           id="wc-option-pay-deposit-{{ $radioId }}">--}}
{{--                                                                                    <label--}}
{{--                                                                                        for="wc-option-pay-deposit-{{ $radioId }}">Pay--}}
{{--                                                                                        Deposit</label>--}}
{{--                                                                                </li>--}}
{{--                                                                                <li>--}}
{{--                                                                                    <input type="radio"--}}
{{--                                                                                           name="deposit_option"--}}
{{--                                                                                           value="full"--}}
{{--                                                                                           id="wc-option-pay-full-{{ $radioId }}"--}}
{{--                                                                                           checked>--}}
{{--                                                                                    <label--}}
{{--                                                                                        for="wc-option-pay-full-{{ $radioId }}">Pay--}}
{{--                                                                                        in Full</label>--}}
{{--                                                                                </li>--}}
                                                                            </ul>
                                                                        @endif

                                                                        @if (in_array($slug->slug, ['door-supervisor-refresher','security-guard-refresher','sia-door-supervisor']))
                                                                            <div class="courseCustomField">
                                                                                <p class="text-danger">Please indicate
                                                                                    what type of First Aid qualification
                                                                                    you currently hold or are going to
                                                                                    obtain as per SIA requirements:</p>
                                                                                <ul class="list-unstyled p-0 m-0">
                                                                                    <li>
                                                                                        <input type="radio"
                                                                                               name="custom_fields"
                                                                                               value="I confirm that I have a valid First Aid certificate"
                                                                                               required>
                                                                                        I confirm that I have a valid
                                                                                        First Aid certificate
                                                                                    </li>
                                                                                    <li>
                                                                                        <input type="radio"
                                                                                               name="custom_fields"
                                                                                               value="I confirm that I have a valid Emergency First Aid certificate">
                                                                                        I confirm that I have a valid
                                                                                        Emergency First Aid certificate
                                                                                    </li>
                                                                                    <li>
                                                                                        <input type="radio"
                                                                                               name="custom_fields"
                                                                                               value="I confirm that I have booked a first aid course at Training4employment and will complete it prior to my chosen security course">
                                                                                        I confirm that I have booked a
                                                                                        first aid course at
                                                                                        Training4employment and will
                                                                                        complete it prior to my chosen
                                                                                        security course
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                        @endif

                                                                        <button type="submit"
                                                                                class="btnBlue" {{ $cohort->is_soldout ? 'disabled' : '' }}>
                                                                            {{ $cohort->is_soldout ? 'Sold Out' : 'Book Now' }}
                                                                        </button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>


                                                {{--                                                <div class="row">--}}

                                                {{--                                                    @foreach ($sortedCohorts as $cohort)--}}
                                                {{--                                                        @php--}}
                                                {{--                                                            $startDate = \Carbon\Carbon::parse(--}}
                                                {{--                                                                $cohort->start_date_time,--}}
                                                {{--                                                            );--}}
                                                {{--                                                            $endDate = \Carbon\Carbon::parse($cohort->end_date_time);--}}
                                                {{--                                                        @endphp--}}

                                                {{--                                                        @if ($cohort->additional_times)--}}
                                                {{--                                                            <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">--}}
                                                {{--                                                                <div class="courseDate mb-3" id="booknow">--}}
                                                {{--                                                                    --}}{{-- <p class="courseSubTitle"> {{ $venue->address ?? '' }}</p> --}}
                                                {{--                                                                    <div class="d-flex align-items-center">--}}
                                                {{--                                                                        <h3 class="h4 text-dark">--}}
                                                {{--                                                                            {{ $cohort->course->name ?? '' }}--}}
                                                {{--                                                                        </h3>--}}
                                                {{--                                                                        @if (!empty($cohort->course->duration))--}}
                                                {{--                                                                            <strong class="h6">--}}
                                                {{--                                                                                <small--}}
                                                {{--                                                                                    class="text-muted ml-2">({{ $cohort->course->duration }})</small>--}}
                                                {{--                                                                            </strong>--}}
                                                {{--                                                                        @endif--}}
                                                {{--                                                                    </div>--}}
                                                {{--                                                                    <div--}}
                                                {{--                                                                        class="d-flex align-items-center justify-content-between">--}}
                                                {{--                                                                        <h4 class="m-0">--}}
                                                {{--                                                                            <strong>£{{ $cohort->course->price ?? '' }}</strong>--}}
                                                {{--                                                                        </h4>--}}
                                                {{--                                                                        <div class="imgCourse"><i--}}
                                                {{--                                                                                class="fas fa-map-marker-alt"></i></div>--}}
                                                {{--                                                                    </div>--}}
                                                {{--                                                                    <ul class="list-unstyled p-0 m-0">--}}
                                                {{--                                                                        <li>--}}
                                                {{--                                                                            <strong><i--}}
                                                {{--                                                                                    class="far fa-calendar"></i>{{ formatCourseDate($cohort) }}</strong>--}}
                                                {{--                                                                        </li>--}}
                                                {{--                                                                    </ul>--}}

                                                {{--                                                                    <div class="btnFooter">--}}
                                                {{--                                                                        <form action="{{ route('cart.add') }}"--}}
                                                {{--                                                                            method="POST">--}}
                                                {{--                                                                            @csrf--}}
                                                {{--                                                                            <input type="hidden" name="cohort_id"--}}
                                                {{--                                                                                value="{{ $cohort->id }}">--}}
                                                {{--                                                                            <input type="hidden" name="course_name"--}}
                                                {{--                                                                                value="{{ $cohort->course->name }}">--}}
                                                {{--                                                                            <input type="hidden" name="course_price"--}}
                                                {{--                                                                                value="{{ $cohort->course->price }}">--}}
                                                {{--                                                                            <input type="hidden" name="start_date"--}}
                                                {{--                                                                                value="{{ $startDate->format('dS M Y g:iA') }}">--}}
                                                {{--                                                                            <input type="hidden" name="end_date"--}}
                                                {{--                                                                                value="{{ $endDate->format('dS M Y g:iA') }}">--}}


                                                {{--                                                                            @if ($cohort->course->price > 102)--}}
                                                {{--                                                                                <ul--}}
                                                {{--                                                                                    class="wc-deposits-option list-unstyled pl-0 d-flex justify-content-between flex-column flex-lg-row flex-xl-row">--}}
                                                {{--                                                                                    <li>--}}
                                                {{--                                                                                        <input type="radio"--}}
                                                {{--                                                                                            name="deposit_option"--}}
                                                {{--                                                                                            value="deposit"--}}
                                                {{--                                                                                            id="wc-option-pay-deposit">--}}
                                                {{--                                                                                        <label--}}
                                                {{--                                                                                            for="wc-option-pay-deposit">Pay--}}
                                                {{--                                                                                            Deposit</label>--}}
                                                {{--                                                                                    </li>--}}
                                                {{--                                                                                    <li>--}}
                                                {{--                                                                                        <input type="radio"--}}
                                                {{--                                                                                            name="deposit_option"--}}
                                                {{--                                                                                            value="full"--}}
                                                {{--                                                                                            id="wc-option-pay-full"--}}
                                                {{--                                                                                            checked="checked">--}}
                                                {{--                                                                                        <label for="wc-option-pay-full">Pay--}}
                                                {{--                                                                                            in Full</label>--}}
                                                {{--                                                                                    </li>--}}
                                                {{--                                                                                </ul>--}}
                                                {{--                                                                            @endif--}}


                                                {{--                                                                            @if (--}}
                                                {{--                                                                                $slug->slug == 'door-supervisor-refresher' ||--}}
                                                {{--                                                                                    $slug->slug == 'security-guard-refresher' ||--}}
                                                {{--                                                                                    $slug->slug == 'sia-door-supervisor')--}}
                                                {{--                                                                                <div class="courseCustomField">--}}
                                                {{--                                                                                    <p class="text-danger">Please indicate--}}
                                                {{--                                                                                        what type of First Aid qualification--}}
                                                {{--                                                                                        you currently hold or going to--}}
                                                {{--                                                                                        obtain as per SIA requirements:</p>--}}
                                                {{--                                                                                    <ul class="list-unstyled p-0 m-0">--}}
                                                {{--                                                                                        <li>--}}
                                                {{--                                                                                            <input type="radio"--}}
                                                {{--                                                                                                name="custom_fields"--}}
                                                {{--                                                                                                value="I confirm that I have a valid First Aid certificate"--}}
                                                {{--                                                                                                required>--}}
                                                {{--                                                                                            I confirm that I have a valid--}}
                                                {{--                                                                                            First Aid certificate--}}
                                                {{--                                                                                        <li>--}}
                                                {{--                                                                                            <input type="radio"--}}
                                                {{--                                                                                                name="custom_fields"--}}
                                                {{--                                                                                                value="I confirm that I have a valid Emergency First Aid certificate">--}}
                                                {{--                                                                                            I confirm that I have a valid--}}
                                                {{--                                                                                            Emergency First Aid certificate--}}
                                                {{--                                                                                        </li>--}}
                                                {{--                                                                                        <li>--}}
                                                {{--                                                                                            <input type="radio"--}}
                                                {{--                                                                                                name="custom_fields"--}}
                                                {{--                                                                                                value="I confirm that I have booked a first aid course at Training4employment and will complete it prior to my chosen security course">--}}
                                                {{--                                                                                            I confirm that I have booked a--}}
                                                {{--                                                                                            first aid course at--}}
                                                {{--                                                                                            Training4employment and will--}}
                                                {{--                                                                                            complete it prior to my chosen--}}
                                                {{--                                                                                            security course--}}
                                                {{--                                                                                        </li>--}}
                                                {{--                                                                                    </ul>--}}
                                                {{--                                                                                </div>--}}
                                                {{--                                                                            @endif--}}

                                                {{--                                                                            <button type="submit" class="btnBlue"--}}
                                                {{--                                                                                {{ $cohort->is_soldout ? 'disabled' : '' }}>--}}
                                                {{--                                                                                {{ $cohort->is_soldout ? 'Sold Out' : 'Book Now' }}--}}
                                                {{--                                                                            </button>--}}
                                                {{--                                                                        </form>--}}
                                                {{--                                                                    </div>--}}
                                                {{--                                                                </div>--}}
                                                {{--                                                            </div>--}}
                                                {{--                                                        @else--}}
                                                {{--                                                            <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">--}}
                                                {{--                                                                <div class="courseDate mb-3" id="booknow">--}}
                                                {{--                                                                    --}}{{-- <p class="courseSubTitle"> {{ $venue->address ?? '' }}</p> --}}
                                                {{--                                                                    <div class="d-flex align-items-center">--}}
                                                {{--                                                                        <h3 class="h4 text-dark">--}}
                                                {{--                                                                            {{ $cohort->course->name ?? '' }}--}}
                                                {{--                                                                        </h3>--}}
                                                {{--                                                                        @if (!empty($cohort->course->duration))--}}
                                                {{--                                                                            <strong class="h6">--}}
                                                {{--                                                                                <small--}}
                                                {{--                                                                                    class="text-muted ml-2">({{ $cohort->course->duration }})</small>--}}
                                                {{--                                                                            </strong>--}}
                                                {{--                                                                        @endif--}}
                                                {{--                                                                    </div>--}}
                                                {{--                                                                    <div--}}
                                                {{--                                                                        class="d-flex align-items-center justify-content-between">--}}
                                                {{--                                                                        <div class="h4 m-0">--}}
                                                {{--                                                                            <strong>£{{ $cohort->course->price ?? '' }}--}}
                                                {{--                                                                            </strong>--}}
                                                {{--                                                                        </div>--}}
                                                {{--                                                                        <div class="imgCourse"><i--}}
                                                {{--                                                                                class="fas fa-map-marker-alt"></i>--}}
                                                {{--                                                                        </div>--}}
                                                {{--                                                                    </div>--}}
                                                {{--                                                                    <ul class="list-unstyled p-0 m-0">--}}
                                                {{--                                                                        <li>--}}
                                                {{--                                                                            <strong><i--}}
                                                {{--                                                                                    class="far fa-calendar"></i>{{ formatCourseDate($cohort) }}</strong>--}}
                                                {{--                                                                        </li>--}}
                                                {{--                                                                    </ul>--}}
                                                {{--                                                                    <div class="btnFooter">--}}
                                                {{--                                                                        <form action="{{ route('cart.add') }}"--}}
                                                {{--                                                                            method="POST">--}}
                                                {{--                                                                            @csrf--}}
                                                {{--                                                                            <input type="hidden" name="cohort_id"--}}
                                                {{--                                                                                value="{{ $cohort->id }}">--}}
                                                {{--                                                                            <input type="hidden" name="course_name"--}}
                                                {{--                                                                                value="{{ $cohort->course->name }}">--}}
                                                {{--                                                                            <input type="hidden" name="course_price"--}}
                                                {{--                                                                                value="{{ $cohort->course->price }}">--}}
                                                {{--                                                                            <input type="hidden" name="start_date"--}}
                                                {{--                                                                                value="{{ $startDate->format('dS M Y g:iA') }}">--}}
                                                {{--                                                                            <input type="hidden" name="end_date"--}}
                                                {{--                                                                                value="{{ $endDate->format('dS M Y g:iA') }}">--}}


                                                {{--                                                                            @if ($cohort->course->price > 102)--}}
                                                {{--                                                                                <ul--}}
                                                {{--                                                                                    class="wc-deposits-option list-unstyled pl-0 d-flex justify-content-between flex-column flex-lg-row flex-xl-row">--}}
                                                {{--                                                                                    <li>--}}
                                                {{--                                                                                        <input type="radio"--}}
                                                {{--                                                                                            name="deposit_option"--}}
                                                {{--                                                                                            value="deposit"--}}
                                                {{--                                                                                            id="wc-option-pay-deposit">--}}
                                                {{--                                                                                        <label--}}
                                                {{--                                                                                            for="wc-option-pay-deposit">Pay--}}
                                                {{--                                                                                            Deposit</label>--}}
                                                {{--                                                                                    </li>--}}
                                                {{--                                                                                    <li>--}}
                                                {{--                                                                                        <input type="radio"--}}
                                                {{--                                                                                            name="deposit_option"--}}
                                                {{--                                                                                            value="full"--}}
                                                {{--                                                                                            id="wc-option-pay-full"--}}
                                                {{--                                                                                            checked="checked">--}}
                                                {{--                                                                                        <label for="wc-option-pay-full">Pay--}}
                                                {{--                                                                                            in Full</label>--}}
                                                {{--                                                                                    </li>--}}
                                                {{--                                                                                </ul>--}}
                                                {{--                                                                            @endif--}}

                                                {{--                                                                            @if (--}}
                                                {{--                                                                                $slug->slug == 'door-supervisor-refresher' ||--}}
                                                {{--                                                                                    $slug->slug == 'security-guard-refresher' ||--}}
                                                {{--                                                                                    $slug->slug == 'sia-door-supervisor')--}}
                                                {{--                                                                                <div class="courseCustomField">--}}
                                                {{--                                                                                    <p class="text-danger">Please indicate--}}
                                                {{--                                                                                        what type of First Aid qualification--}}
                                                {{--                                                                                        you currently hold or going to--}}
                                                {{--                                                                                        obtain as per SIA requirements:</p>--}}
                                                {{--                                                                                    <ul class="list-unstyled p-0 m-0">--}}
                                                {{--                                                                                        <li>--}}
                                                {{--                                                                                            <input type="radio"--}}
                                                {{--                                                                                                name="custom_fields"--}}
                                                {{--                                                                                                value="I confirm that I have a valid First Aid certificate"--}}
                                                {{--                                                                                                required>--}}
                                                {{--                                                                                            I confirm that I have a valid--}}
                                                {{--                                                                                            First Aid certificate--}}
                                                {{--                                                                                        <li>--}}
                                                {{--                                                                                            <input type="radio"--}}
                                                {{--                                                                                                name="custom_fields"--}}
                                                {{--                                                                                                value="I confirm that I have a valid Emergency First Aid certificate">--}}
                                                {{--                                                                                            I confirm that I have a valid--}}
                                                {{--                                                                                            Emergency First Aid certificate--}}
                                                {{--                                                                                        </li>--}}
                                                {{--                                                                                        <li>--}}
                                                {{--                                                                                            <input type="radio"--}}
                                                {{--                                                                                                name="custom_fields"--}}
                                                {{--                                                                                                value="I confirm that I have booked a first aid course at Training4employment and will complete it prior to my chosen security course">--}}
                                                {{--                                                                                            I confirm that I have booked a--}}
                                                {{--                                                                                            first aid course at--}}
                                                {{--                                                                                            Training4employment and will--}}
                                                {{--                                                                                            complete it prior to my chosen--}}
                                                {{--                                                                                            security course--}}
                                                {{--                                                                                        </li>--}}
                                                {{--                                                                                    </ul>--}}
                                                {{--                                                                                </div>--}}
                                                {{--                                                                            @endif--}}

                                                {{--                                                                            <button type="submit" class="btnBlue"--}}
                                                {{--                                                                                {{ $cohort->is_soldout ? 'disabled' : '' }}>--}}
                                                {{--                                                                                {{ $cohort->is_soldout ? 'Sold Out' : 'Book Now' }}--}}
                                                {{--                                                                            </button>--}}
                                                {{--                                                                        </form>--}}
                                                {{--                                                                    </div>--}}
                                                {{--                                                                </div>--}}
                                                {{--                                                            </div>--}}
                                                {{--                                                        @endif--}}
                                                {{--                                                    @endforeach--}}
                                                {{--                                                </div>--}}
                                            </div>
                                        </div>
                                    </div>
                                    @php $value++; @endphp
                                @empty
                                    <div class="bookNowFormLink">
                                        <div id="booknow">
                                            <x-frontend.request_form/>
                                        </div>
                                    </div>
                                @endforelse
                            </div>
                        </div>

                        @if ($Courselocations->isNotEmpty())
                            <div class="locationWrapper" id="locations">
                                <h2 class="mt-5">Locations</h2>
                                @foreach ($Courselocations as $venue)
                                    <a href="{{ route('locations.show', $venue->slug) }}" class="btn btn-header-link"
                                       style="margin: 5px !important;">
                                        {{ $venue->venue_name }}
                                    </a>
                                @endforeach
                            </div>
                        @endif
                    </div>
                    <div class="col-12 col-sm-12 col-md-5 screen_800_col2 col-lg-4 col-xl-4">
                        <div class="rightSidebar mb-5 mb-sm-0 mb-md-0 mb-lg-0 mb-xl-0">
                            <div class="courseSidebar">
                                <img
                                    src="{{ $slug->course_image ? asset($slug->course_image) : asset('images/placeholderimage.jpg') }}"
                                    class="img-fluid" alt="{{ $slug->name ?? '' }}">
                                <h2>{{ $slug->name ?? '' }}</h2>
                                <div class="keyInformation">
                                    {!! $slug->key_information !!}
                                </div>
                                @if ($slug->requirements)
                                    <h2 class="entryTitle">Entry Requirements</h2>
                                    {!! $slug->requirements !!}
                                @endif
                                <a href="#cdates" class="btnBlue"><i class="fas fa-shopping-cart"></i> Book
                                    Now</a>
                                <div class="courseStructure mt-4">
                                    @if ($slug->course_structure)
                                        <h2 class="entryTitle">Course Structure</h2>
                                        {!! $slug->course_structure !!}
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    @include('frontend.bespoke_form.index')
@endsection
@push('css')
    <style>
        /* first-aid */
        .first-aid ul li:before {
            color: #bbedac !important;
        }

        .first-aid .btnMstr {
            background: #bbedac !important;
        }

        .first-aid .btnMstr:hover {
            background: #e43409 !important;
            color: #fff !important;
        }

        .first-aid a.btnWhiteBg {
            background: 0 0 !important;
            color: #fff !important;
            border-color: #bbedac !important;
        }

        .first-aid a.btnWhiteBg:hover {
            background: #e43409 !important;
        }

        .coursesSinglePage.first-aid {
            background-color: #000;
            background-image: linear-gradient(109deg, #2f5f40 0, #bbedac00 100%) !important;
            opacity: 1;
            transition: background 0.3s, border-radius 0.3s, opacity 0.3s;
        }

        /* construction-training */

        .bannerWrapper.construction-training .bannerSubTitle,
        .bannerWrapper.construction-training h1,
        .bannerWrapper.construction-training p,
        .bannerWrapper.construction-training ul li,
        .product-page.singleProduct .construction-training .bannerInfo.banerBulletIcon ul li:before {
            color: #000 !important;
        }

        .coursesSinglePage.construction-training {
            background-image: linear-gradient(270deg, #684800 0, #ffde59 100%) !important;
        }

        /* traffic-marshall-vehicle-banksman */

        .product-page.singleProduct .traffic-marshall-vehicle-banksman .bannerInfo.banerBulletIcon ul li:before {
            color: #fff !important;
        }

        .traffic-marshall-vehicle-banksman .btnMstr {
            background: #fff !important;
        }

        .traffic-marshall-vehicle-banksman .btnMstr:hover {
            background: #000 !important;
            color: #fff !important;
        }

        .traffic-marshall-vehicle-banksman .btnMstr i {
            color: #ef9441 !important;
        }

        .coursesSinglePage.traffic-marshall-vehicle-banksman {
            background-image: radial-gradient(at bottom left, #170b00 0, #ef9494 100%) !important;
        }

        /* fire-safety-for-fire-wardens */
        .fire-safety-for-fire-wardens .btnMstr {
            background: #fff !important;
            color: #000 !important;
        }

        .fire-safety-for-fire-wardens .btnMstr:hover {
            background: #000 !important;
            color: #fff !important;
        }

        .fire-safety-for-fire-wardens .btnMstr i {
            color: #000 !important;
        }

        .fire-safety-for-fire-wardens .btnMstr:hover i {
            color: #fff !important;
        }

        .fire-safety-for-fire-wardens a.btnWhiteBg {
            background: #000 !important;
            color: #fff !important;
            transition: 0.3s !important;
            border-color: #fff0 !important;
        }

        .fire-safety-for-fire-wardens a.btnWhiteBg i {
            color: #a50500 !important;
            transition: 0.3s !important;
        }

        .fire-safety-for-fire-wardens a.btnWhiteBg:hover {
            background: 0 0 !important;
            border-color: #fff !important;
            transition: 0.3s !important;
        }

        .fire-safety-for-fire-wardens a.btnWhiteBg:hover i {
            color: #fff !important;
            transition: 0.3s !important;
        }

        .coursesSinglePage.fire-safety-for-fire-wardens {
            background-image: radial-gradient(at bottom right, #170b00d6 0, #a50500 59%) !important;
        }

        /* alcohol */
        .coursesSinglePage.alcohol .bannerInfo.banerBulletIcon ul li:before {
            color: #fff !important;
        }

        .coursesSinglePage.alcohol {
            background-image: linear-gradient(304deg, #693200 0, #ff7a00 56%) !important;
        }

        .coursesSinglePage.alcohol .btnMstr {
            background: #000;
            color: #fff;
            box-shadow: 0 8px 20px 1px rgb(0 0 0 / .27);
        }

        .tableOfContent::-webkit-scrollbar {
            border-radius: 10px;
        }


        .tableOfContent::-webkit-scrollbar-thumb {
            background: #777;
            border-radius: 10px;
        }

        .tableOfContent::-webkit-scrollbar-track {
            background: #ccc;
            border-radius: 10px;
        }

        section.mainContentWrapper.courseRow .tableOfContent {
            padding-bottom: 10px !important;
        }

        section.mainContentWrapper.courseRow .tableOfContent ul li {
            min-width: 120px;
            background: #ea7000;
        }

        section.mainContentWrapper.courseRow .tableOfContent ul li a {
            padding-left: 5px;
            padding-right: 5px;
            font-size: 15px;
            font-weight: 600;
            color: #fff !important;
        }

        html,
        body {
            overflow-x: visible !important;
        }

        .faqsInner .toggaleAccordion .card button i {
            background: #ecf0f4;
            color: #f26a21;
            font-size: 11px;
        }

        .toggaleAccordion button i {
            background: #f26a21;
            color: #fff;
            width: 25px;
            border-radius: 100%;
            height: 25px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .faqsInner .toggaleAccordion .card.active button i {
            background: #f26a21;
            color: #fff;
            line-height: 17px;
        }


        .faqsWrapper.singlecourse div#venueAccordion .card .card-header.active {
            background-color: #ea7000;
            /* Light red background */
            color: #fff !important;
        }

        .faqsWrapper.singlecourse div#venueAccordion .card .card-header.active a.btn.btn-header-link {
            color: #fff !important;
        }
    </style>
@endpush
@push('js')
    <script>
        $(document).ready(function () {
            // add class on table od content
            $('.tableOfContent li').click(function () {
                $('.tableOfContent li').removeClass('active');
                $(this).addClass('active');
            });

            // add class table of content on scroll

            $(window).on('scroll', function () {
                const scrollTop = $(window).scrollTop();
                const offset = $('.tableOfContent').offset().top;
                if (scrollTop >= offset - 100) {
                    $('.tableOfContent').addClass('scrolled');
                } else {
                    $('.tableOfContent').removeClass('scrolled');
                }
            });

        });

        $(document).ready(function () {
            $(document).on('click', '.toggaleAccordion .card', function () {
                $('.toggaleAccordion .card').removeClass('active');
                $(this).addClass('active');
            });
        });


        document.addEventListener("DOMContentLoaded", function () {
            const headers = document.querySelectorAll(".card-header .btn-header-link");

            headers.forEach(header => {
                header.addEventListener("click", function () {
                    // Remove 'active' class from all headers
                    document.querySelectorAll(".card-header").forEach(h => h.classList.remove(
                        "active"));

                    // Add 'active' class to the clicked header's parent
                    this.closest(".card-header").classList.add("active");
                });
            });
        });
    </script>
@endpush

@push('footer_schema')
    @if ($slug->slug == 'door-supervisor-refresher')
        <script type="application/ld+json">
            {
                "@context": "https://schema.org",
                "@type": "Course",
                "@id": "https://training4employment.co.uk/courses/door-supervisor-refresher",
                "name": "Door Supervisor Refresher",
                "description": "1.5‑day blended learning refresher course to renew SIA Door Supervisor licence, covering legal updates, physical intervention, conflict and safeguarding procedures.",
                "provider": {
                    "@type": "Organization",
                    "name": "Training4Employment",
                    "sameAs": "https://www.training4employment.co.uk",
                    "url": "https://www.training4employment.co.uk"
                },
                "image": "https://training4employment.co.uk/courses/door-supervisor-refresher",
                "educationalLevel": "Level 2",
                "inLanguage": "en-GB",
                "coursePrerequisites": [
                    "Valid SIA Door Supervisor licence",
                    "Valid First Aid or Emergency First Aid certificate",
                    "Must be 18+"
                ],
                "offers": {
                    "@type": "Offer",
                    "price": "156.50",
                    "priceCurrency": "GBP",
                    "url": "https://training4employment.co.uk/courses/door-supervisor-refresher",
                    "validFrom": "2025-04-01"
                },
                "hasCourseInstance": [
                    {
                    "@type": "CourseInstance",
                    "name": "Door Supervisor Refresher July 2025 – Birmingham",
                    "startDate": "2025-07-05T12:30:00",
                    "endDate": "2025-07-06T13:30:00",
                    "location": {
                        "@type": "Place",
                        "name": "Training4Employment, Birmingham",
                        "address": {
                        "@type": "PostalAddress",
                        "addressLocality": "Birmingham",
                        "addressCountry": "GB"
                        }
                    }
                    },
                    {
                    "@type": "CourseInstance",
                    "name": "Door Supervisor Refresher July 2025 – Birmingham",
                    "startDate": "2025-07-17T13:30:00",
                    "endDate": "2025-07-18T17:30:00",
                    "location": {
                        "@type": "Place",
                        "name": "Training4Employment, Birmingham",
                        "address": {
                        "@type": "PostalAddress",
                        "addressLocality": "Birmingham",
                        "addressCountry": "GB"
                        }
                    }
                    },
                    {
                    "@type": "CourseInstance",
                    "name": "Door Supervisor Refresher July 2025 – Birmingham",
                    "startDate": "2025-07-23T13:30:00",
                    "endDate": "2025-07-24T17:30:00",
                    "location": {
                        "@type": "Place",
                        "name": "Training4Employment, Birmingham",
                        "address": {
                        "@type": "PostalAddress",
                        "addressLocality": "Birmingham",
                        "addressCountry": "GB"
                        }
                    }
                    },
                    {
                    "@type": "CourseInstance",
                    "name": "Door Supervisor Refresher August 2025 – Birmingham",
                    "startDate": "2025-08-07T13:30:00",
                    "endDate": "2025-08-08T17:30:00",
                    "location": {
                        "@type": "Place",
                        "name": "Training4Employment, Birmingham",
                        "address": {
                        "@type": "PostalAddress",
                        "addressLocality": "Birmingham",
                        "addressCountry": "GB"
                        }
                    }
                    },
                    {
                    "@type": "CourseInstance",
                    "name": "Door Supervisor Refresher August 2025 – Birmingham",
                    "startDate": "2025-08-14T13:30:00",
                    "endDate": "2025-08-15T17:30:00",
                    "location": {
                        "@type": "Place",
                        "name": "Training4Employment, Birmingham",
                        "address": {
                        "@type": "PostalAddress",
                        "addressLocality": "Birmingham",
                        "addressCountry": "GB"
                        }
                    }
                    }
                ],
                "timeRequired": "P1.5D",
                "educationalCredentialAwarded": {
                    "@type": "EducationalOccupationalCredential",
                    "name": "Highfield Level 2 Award (Refresher)",
                    "credentialCategory": "Award"
                }
            }
        </script>
    @elseif ($slug->slug == 'sia-cctv-operator')
        <script type="application/ld+json">
            {
                "@context": "https://schema.org",
                "@type": "Course",
                "@id": "https://training4employment.co.uk/courses/sia-cctv-operator",
                "name": "SIA CCTV Operator",
                "description": "3‑day blended learning course to obtain SIA Level 2 CCTV Operator licence, including e-learning, classroom training and practical assessments.",
                "provider": {
                    "@type": "Organization",
                    "name": "Training4Employment",
                    "sameAs": "https://www.training4employment.co.uk",
                    "url": "https://www.training4employment.co.uk"
                },
                "image": "https://training4employment.co.uk/courses/sia-cctv-operator",
                "educationalLevel": "Level 2",
                "inLanguage": "en-GB",
                "coursePrerequisites": [
                    "Must be 18+"
                ],
                "offers": {
                    "@type": "Offer",
                    "price": "201.50",
                    "priceCurrency": "GBP",
                    "url": "https://training4employment.co.uk/courses/sia-cctv-operator",
                    "validFrom": "2025-07-28",
                    "availability": "https://schema.org/InStock"
                },
                "hasCourseInstance": [
                    {
                    "@type": "CourseInstance",
                    "name": "SIA CCTV Operator – 28 Jul 2025 – Birmingham",
                    "courseMode": "Onsite",
                    "courseSchedule": {
                        "@type": "Schedule",
                        "startDate": "2025-07-28",
                        "endDate": "2025-07-30",
                        "duration": "P3D"
                    },
                    "startDate": "2025-07-28T09:00:00",
                    "endDate": "2025-07-30T17:00:00",
                    "location": {
                        "@type": "Place",
                        "name": "Training4Employment, Birmingham",
                        "address": {
                        "@type": "PostalAddress",
                        "addressLocality": "Birmingham",
                        "addressCountry": "GB"
                        }
                    }
                    },
                    {
                    "@type": "CourseInstance",
                    "name": "SIA CCTV Operator – 26 Aug 2025 – Birmingham",
                    "courseMode": "Onsite",
                    "courseSchedule": {
                        "@type": "Schedule",
                        "startDate": "2025-08-26",
                        "endDate": "2025-08-28",
                        "duration": "P3D"
                    },
                    "startDate": "2025-08-26T09:00:00",
                    "endDate": "2025-08-28T17:00:00",
                    "location": {
                        "@type": "Place",
                        "name": "Training4Employment, Birmingham",
                        "address": {
                        "@type": "PostalAddress",
                        "addressLocality": "Birmingham",
                        "addressCountry": "GB"
                        }
                    }
                    },
                    {
                    "@type": "CourseInstance",
                    "name": "SIA CCTV Operator – 29 Sep 2025 – Birmingham",
                    "courseMode": "Onsite",
                    "courseSchedule": {
                        "@type": "Schedule",
                        "startDate": "2025-09-29",
                        "endDate": "2025-10-01",
                        "duration": "P3D"
                    },
                    "startDate": "2025-09-29T09:00:00",
                    "endDate": "2025-10-01T17:00:00",
                    "location": {
                        "@type": "Place",
                        "name": "Training4Employment, Birmingham",
                        "address": {
                        "@type": "PostalAddress",
                        "addressLocality": "Birmingham",
                        "addressCountry": "GB"
                        }
                    }
                    }
                ],
                "timeRequired": "P3D",
                "educationalCredentialAwarded": {
                    "@type": "EducationalOccupationalCredential",
                    "name": "Highfield Level 2 Award in CCTV Operation",
                    "credentialCategory": "Award"
                }
            }
        </script>
    @elseif ($slug->slug == 'security-guard-refresher')
        <script type="application/ld+json">
            {
            "@context": "https://schema.org",
            "@type": "Course",
            "@id": "https://training4employment.co.uk/courses/security-guard-refresher",
            "name": "Security Guard Refresher",
            "description": "3.5‑hour blended learning refresher course required to renew or downgrade an SIA Security Guard licence, including e‑learning, legal updates, search and safeguarding procedures, and practical assessment.",
            "provider": {
                "@type": "Organization",
                "name": "Training4Employment",
                "sameAs": "https://www.training4employment.co.uk",
                "url": "https://www.training4employment.co.uk"
            },
            "image": "https://training4employment.co.uk/public/sia-security-training-courses-in-manchester",
            "educationalLevel": "Level 2",
            "inLanguage": "en-GB",
            "coursePrerequisites": [
                "Must be 18+",
                "Valid First Aid or Emergency First Aid certificate",
                "Current SIA Security Guard licence (or downgrading from Door Supervisor)"
            ],
            "offers": {
                "@type": "Offer",
                "price": "101.50",
                "priceCurrency": "GBP",
                "url": "https://training4employment.co.uk/courses/security-guard-refresher",
                "validFrom": "2025-04-01"
            },
            "hasCourseInstance": [
                {
                "@type": "CourseInstance",
                "name": "Security Guard Refresher – 4 Jul 2025, Birmingham",
                "startDate": "2025-07-04T13:30:00",
                "endDate": "2025-07-04T17:00:00",
                "location": {
                    "@type": "Place",
                    "name": "Training4Employment, Birmingham",
                    "address": {
                    "@type": "PostalAddress",
                    "addressLocality": "Birmingham",
                    "addressCountry": "GB"
                    }
                }
                },
                {
                "@type": "CourseInstance",
                "name": "Security Guard Refresher – 21 Jul 2025, Birmingham",
                "startDate": "2025-07-21T13:30:00",
                "endDate": "2025-07-21T17:00:00",
                "location": {
                    "@type": "Place",
                    "name": "Training4Employment, Birmingham",
                    "address": {
                    "@type": "PostalAddress",
                    "addressLocality": "Birmingham",
                    "addressCountry": "GB"
                    }
                }
                },
                {
                "@type": "CourseInstance",
                "name": "Security Guard Refresher – 6 Aug 2025, Birmingham",
                "startDate": "2025-08-06T13:30:00",
                "endDate": "2025-08-06T17:00:00",
                "location": {
                    "@type": "Place",
                    "name": "Training4Employment, Birmingham",
                    "address": {
                    "@type": "PostalAddress",
                    "addressLocality": "Birmingham",
                    "addressCountry": "GB"
                    }
                }
                },
                {
                "@type": "CourseInstance",
                "name": "Security Guard Refresher – 14 Jul 2025, Leicester",
                "startDate": "2025-07-14T13:30:00",
                "endDate": "2025-07-14T17:00:00",
                "location": {
                    "@type": "Place",
                    "name": "Training4Employment, Leicester",
                    "address": {
                    "@type": "PostalAddress",
                    "addressLocality": "Leicester",
                    "addressCountry": "GB"
                    }
                }
                }
            ],
            "timeRequired": "PT3.5H",
            "educationalCredentialAwarded": {
                "@type": "EducationalOccupationalCredential",
                "name": "Highfield Level 2 Award in Security Guard (Refresher)",
                "credentialCategory": "Award"
            }
            }
        </script>
    @elseif ($slug->slug == 'level-1-health-and-safety-awareness-within-construction-environment')
        <script type="application/ld+json">
            {
                "@context": "https://schema.org",
                "@type": "Course",
                "@id": "https://training4employment.co.uk/courses/level-1-health-and-safety-awareness-within-construction-environment",
                "name": "Level 1 Health and Safety within a Construction Environment",
                "description": "Online Level 1 Health and Safety course (4–6 hrs self‑paced e‑learning + 1‑hr face‑to‑face exam) accredited by Highfield; essential for CSCS Green Labourer Card.",
                "provider": {
                    "@type": "Organization",
                    "name": "Training4Employment",
                    "sameAs": "https://www.training4employment.co.uk",
                    "url": "https://www.training4employment.co.uk"
                },
                "image": "https://training4employment.co.uk/courses/level-1-health-and-safety-awareness-within-construction-environment",
                "educationalLevel": "Level 1",
                "inLanguage": "en-GB",
                "coursePrerequisites": [
                    "Must be 16+",
                    "Internet access for online learning"
                ],
                "offers": {
                    "@type": "Offer",
                    "price": "101.50",
                    "priceCurrency": "GBP",
                    "url": "https://training4employment.co.uk/courses/level-1-health-and-safety-awareness-within-construction-environment",
                    "validFrom": "2025-???"
                },
                "hasCourseInstance": [
                    {
                    "@type": "CourseInstance",
                    "name": "E‑learning + Face‑to‑face Exam (Bookable Monday–Friday)",
                    "startDate": null,
                    "endDate": null,
                    "location": {
                        "@type": "Place",
                        "name": "Training4Employment (online + centre)",
                        "address": {
                        "@type": "PostalAddress",
                        "addressLocality": "Birmingham",
                        "addressCountry": "GB"
                        }
                    }
                    }
                ],
                "timeRequired": "PT5H",
                "educationalCredentialAwarded": {
                    "@type": "EducationalOccupationalCredential",
                    "name": "Highfield Level 1 Award in Health and Safety within a Construction Environment",
                    "credentialCategory": "Award"
                }
            }
        </script>
    @elseif ($slug->slug == 'health-and-safety-awareness-hsa')
        <script type="application/ld+json">
            {
                "@context": "https://schema.org",
                "@type": "Course",
                "@id": "https://training4employment.co.uk/courses/health-and-safety-awareness-hsa",
                "name": "Health and Safety Awareness (HSA)",
                "description": "One‑day CITB Health and Safety Awareness course (HSA), ideal for qualifying for a CSCS Green Labourer Card—covering site hazards, PPE, risk assessments, responsibilities, and same‑day certification.",
                "provider": {
                    "@type": "Organization",
                    "name": "Training4Employment",
                    "sameAs": "https://www.training4employment.co.uk",
                    "url": "https://www.training4employment.co.uk"
                },
                "image": "https://training4employment.co.uk/courses/health-and-safety-awareness-hsa",
                "educationalLevel": "Level 1",
                "inLanguage": "en-GB",
                "coursePrerequisites": [
                    "Must be 16+",
                    "Basic English literacy"
                ],
                "offers": {
                    "@type": "Offer",
                    "price": "147.50",
                    "priceCurrency": "GBP",
                    "url": "https://training4employment.co.uk/courses/health-and-safety-awareness-hsa",
                    "validFrom": "2025-08-16"
                },
                "hasCourseInstance": [
                    {
                    "@type": "CourseInstance",
                    "name": "Health and Safety Awareness (HSA) – 16 Aug 2025 – Birmingham",
                    "startDate": "2025-08-16T09:00:00",
                    "endDate": "2025-08-16T17:00:00",
                    "location": {
                        "@type": "Place",
                        "name": "Training4Employment, Birmingham",
                        "address": {
                        "@type": "PostalAddress",
                        "streetAddress": "89‑91 Hatchett Street",
                        "addressLocality": "Birmingham",
                        "postalCode": "B19 3NY",
                        "addressCountry": "GB"
                        }
                    }
                    },
                    {
                    "@type": "CourseInstance",
                    "name": "Health and Safety Awareness (HSA) – 20 Sep 2025 – Birmingham",
                    "startDate": "2025-09-20T09:00:00",
                    "endDate": "2025-09-20T17:00:00",
                    "location": {
                        "@type": "Place",
                        "name": "Training4Employment, Birmingham",
                        "address": {
                        "@type": "PostalAddress",
                        "streetAddress": "89‑91 Hatchett Street",
                        "addressLocality": "Birmingham",
                        "postalCode": "B19 3NY",
                        "addressCountry": "GB"
                        }
                    }
                    },
                    {
                    "@type": "CourseInstance",
                    "name": "Health and Safety Awareness (HSA) – 18 Oct 2025 – Birmingham",
                    "startDate": "2025-10-18T09:00:00",
                    "endDate": "2025-10-18T17:00:00",
                    "location": {
                        "@type": "Place",
                        "name": "Training4Employment, Birmingham",
                        "address": {
                        "@type": "PostalAddress",
                        "streetAddress": "89‑91 Hatchett Street",
                        "addressLocality": "Birmingham",
                        "postalCode": "B19 3NY",
                        "addressCountry": "GB"
                        }
                    }
                    },
                    {
                    "@type": "CourseInstance",
                    "name": "Health and Safety Awareness (HSA) – 15 Nov 2025 – Birmingham",
                    "startDate": "2025-11-15T09:00:00",
                    "endDate": "2025-11-15T17:00:00",
                    "location": {
                        "@type": "Place",
                        "name": "Training4Employment, Birmingham",
                        "address": {
                        "@type": "PostalAddress",
                        "streetAddress": "89‑91 Hatchett Street",
                        "addressLocality": "Birmingham",
                        "postalCode": "B19 3NY",
                        "addressCountry": "GB"
                        }
                    }
                    }
                ],
                "timeRequired": "P1D",
                "educationalCredentialAwarded": {
                    "@type": "EducationalOccupationalCredential",
                    "name": "CITB Health and Safety Awareness Certificate",
                    "credentialCategory": "Certificate"
                }
            }
        </script>
    @elseif ($slug->slug == 'sssts-site-supervision-safety')
        <script type="application/ld+json">
            {
                "@context": "https://schema.org",
                "@type": "Course",
                "@id": "https://training4employment.co.uk/courses/sssts-site-supervision-safety",
                "name": "SSSTS – Site Supervision Safety Training Scheme",
                "description": "Two‑day Site Supervision Safety Training Scheme (SSSTS) course covering legislation, risk assessment, CDM, environmental awareness and supervisory safety skills, with CITB-endorsed certification valid for 5 years.",
                "provider": {
                    "@type": "Organization",
                    "name": "Training4Employment",
                    "sameAs": "https://www.training4employment.co.uk",
                    "url": "https://www.training4employment.co.uk"
                },
                "image": "https://training4employment.co.uk/courses/sssts-site-supervision-safety",
                "educationalLevel": "Level 3",
                "inLanguage": "en-GB",
                "coursePrerequisites": [
                    "Must be 18+",
                    "Valid English literacy"
                ],
                "offers": {
                    "@type": "Offer",
                    "price": "0.00",
                    "priceCurrency": "GBP",
                    "url": "https://training4employment.co.uk/courses/sssts-site-supervision-safety",
                    "validFrom": "2025-01-01"
                },
                "hasCourseInstance": [
                    {
                    "@type": "CourseInstance",
                    "name": "SSSTS – Site Supervision Safety (2 days, nationwide)",
                    "startDate": null,
                    "endDate": null,
                    "location": {
                        "@type": "Place",
                        "name": "Training4Employment Locations",
                        "address": {
                        "@type": "PostalAddress",
                        "addressCountry": "GB"
                        }
                    }
                    }
                ],
                "timeRequired": "P2D",
                "educationalCredentialAwarded": {
                    "@type": "EducationalOccupationalCredential",
                    "name": "CITB SSSTS Certificate",
                    "credentialCategory": "Certificate"
                }
            }
        </script>
    @elseif ($slug->slug == 'sssts-refresher')
        <script type="application/ld+json">
            {
                "@context": "https://schema.org",
                "@type": "Course",
                "@id": "https://training4employment.co.uk/courses/sssts-refresher",
                "name": "SSSTS Refresher – Site Supervision Safety Training Scheme (SSSTS‑R)",
                "description": "One‑day CITB SSSTS Refresher course for site supervisors who have a current SSSTS certificate. Refreshes health, safety, welfare, environmental and legal knowledge, including toolbox talks and legislation updates.",
                "provider": {
                    "@type": "Organization",
                    "name": "Training4Employment",
                    "sameAs": "https://www.training4employment.co.uk",
                    "url": "https://www.training4employment.co.uk"
                },
                "image": "https://training4employment.co.uk/courses/sssts-refresher",
                "educationalLevel": "Level 3",
                "inLanguage": "en-GB",
                "coursePrerequisites": [
                    "Valid SSSTS certificate obtained within the last five years",
                    "Proof of attendance on full SSSTS course",
                    "Must be 18+"
                ],
                "offers": {
                    "@type": "Offer",
                    "price": "0.00",
                    "priceCurrency": "GBP",
                    "url": "https://training4employment.co.uk/courses/sssts-refresher",
                    "validFrom": "2025-01-01"
                },
                "hasCourseInstance": [
                    {
                    "@type": "CourseInstance",
                    "name": "SSSTS Refresher – 1‑Day Nationwide Sessions",
                    "startDate": null,
                    "endDate": null,
                    "location": {
                        "@type": "Place",
                        "name": "Training4Employment Locations",
                        "address": {
                        "@type": "PostalAddress",
                        "addressCountry": "GB"
                        }
                    }
                    }
                ],
                "timeRequired": "P1D",
                "educationalCredentialAwarded": {
                    "@type": "EducationalOccupationalCredential",
                    "name": "CITB SSSTS Refresher Certificate",
                    "credentialCategory": "Certificate"
                }
            }
        </script>
    @elseif ($slug->slug == 'smsts-site-management-safety')
        <script type="application/ld+json">
            {
                "@context": "https://schema.org",
                "@type": "Course",
                "@id": "https://training4employment.co.uk/courses/smsts-site-management-safety",
                "name": "SMSTS – Site Management Safety Training Scheme",
                "description": "Five‑day CITB‑endorsed SMSTS course covering legislation, risk management, CDM, environmental awareness, site setup and supervisory safety skills, with certification valid for 5 years.",
                "provider": {
                    "@type": "Organization",
                    "name": "Training4Employment",
                    "sameAs": "https://www.training4employment.co.uk",
                    "url": "https://www.training4employment.co.uk"
                },
                "image": "https://training4employment.co.uk/courses/smsts-site-management-safety",
                "educationalLevel": "Level 3",
                "inLanguage": "en-GB",
                "coursePrerequisites": [
                    "Must be 18+",
                    "Proficient English literacy",
                    "Valid photographic ID"
                ],
                "offers": {
                    "@type": "Offer",
                    "price": "0.00",
                    "priceCurrency": "GBP",
                    "url": "https://training4employment.co.uk/courses/smsts-site-management-safety",
                    "validFrom": "2025-01-01"
                },
                "hasCourseInstance": [
                    {
                    "@type": "CourseInstance",
                    "name": "SMSTS – Site Management Safety (5‑day nationwide)",
                    "startDate": null,
                    "endDate": null,
                    "location": {
                        "@type": "Place",
                        "name": "Training4Employment Locations",
                        "address": {
                        "@type": "PostalAddress",
                        "addressCountry": "GB"
                        }
                    }
                    }
                ],
                "timeRequired": "P5D",
                "educationalCredentialAwarded": {
                    "@type": "EducationalOccupationalCredential",
                    "name": "CITB SMSTS Certificate",
                    "credentialCategory": "Certificate"
                }
            }
        </script>
    @elseif ($slug->slug == 'smsts-refresher')
        <script type="application/ld+json">
            {
                "@context": "https://schema.org",
                "@type": "Course",
                "@id": "https://training4employment.co.uk/courses/smsts-refresher",
                "name": "SMSTS Refresher – Site Management Safety Training Scheme Refresher",
                "description": "Two‑day refresher of the CITB SMSTS course, reinforcing site safety, health & welfare, legislation, risk assessment, CDM, and supervisory responsibilities, plus a multiple‑choice exam.",
                "provider": {
                "@type": "Organization",
                "name": "Training4Employment",
                "sameAs": "https://www.training4employment.co.uk",
                "url": "https://www.training4employment.co.uk"
                },
                "image": "https://training4employment.co.uk/courses/smsts-refresher",
                "educationalLevel": "Level 3",
                "inLanguage": "en-GB",
                "coursePrerequisites": [
                "Current or previously held SMSTS certificate",
                "Must be 18+"
                ],
                "offers": {
                "@type": "Offer",
                "price": "0.00",
                "priceCurrency": "GBP",
                "url": "https://training4employment.co.uk/courses/smsts-refresher",
                "validFrom": "2025-01-01"
                },
                "hasCourseInstance": [
                {
                    "@type": "CourseInstance",
                    "name": "SMSTS Refresher – 2‑Day Nationwide Sessions",
                    "startDate": null,
                    "endDate": null,
                    "location": {
                    "@type": "Place",
                    "name": "Training4Employment Locations",
                    "address": {
                        "@type": "PostalAddress",
                        "addressCountry": "GB"
                    }
                    }
                }
                ],
                "timeRequired": "P2D",
                "educationalCredentialAwarded": {
                "@type": "EducationalOccupationalCredential",
                "name": "CITB SMSTS Refresher Certificate",
                "credentialCategory": "Certificate"
                }
            }
        </script>
    @elseif ($slug->slug == 'first-aid-at-work')
        <script type="application/ld+json">
            {
                "@context": "https://schema.org",
                "@type": "Course",
                "@id": "https://training4employment.co.uk/courses/first-aid-at-work",
                "name": "First Aid at Work",
                "description": "Three‑day classroom First Aid at Work course leading to a Highfield Level 3 Award, covering CPR, AED, bleeding, shock, fractures, major illness and practical assessments.",
                "provider": {
                    "@type": "Organization",
                    "name": "Training4Employment",
                    "sameAs": "https://www.training4employment.co.uk",
                    "url": "https://www.training4employment.co.uk"
                },
                "image": "https://training4employment.co.uk/courses/first-aid-at-work",
                "educationalLevel": "Level 3",
                "inLanguage": "en-GB",
                "coursePrerequisites": [
                    "Must be 14+",
                    "No formal prerequisites"
                ],
                "offers": {
                    "@type": "Offer",
                    "price": "181.50",
                    "priceCurrency": "GBP",
                    "url": "https://training4employment.co.uk/courses/first-aid-at-work",
                    "validFrom": "2025-01-01"
                },
                "hasCourseInstance": [
                    {
                    "@type": "CourseInstance",
                    "name": "First Aid at Work – example date (e.g., July 2025, Birmingham)",
                    "startDate": "2025-07-01",
                    "endDate": "2025-07-03",
                    "location": {
                        "@type": "Place",
                        "name": "Training4Employment, Birmingham",
                        "address": {
                        "@type": "PostalAddress",
                        "streetAddress": "89‑91 Hatchett Street",
                        "addressLocality": "Birmingham",
                        "addressCountry": "GB"
                        }
                    }
                    }
                ],
                "timeRequired": "P3D",
                "educationalCredentialAwarded": {
                    "@type": "EducationalOccupationalCredential",
                    "name": "Highfield Level 3 Award in First Aid at Work",
                    "credentialCategory": "Award"
                }
            }
        </script>
    @elseif ($slug->slug == 'emergency-first-aid-at-work')
        <script type="application/ld+json">
            {
                "@context": "https://schema.org",
                "@type": "Course",
                "@id": "https://training4employment.co.uk/courses/emergency-first-aid-at-work",
                "name": "Emergency First Aid at Work",
                "description": "One‑day blended learning Emergency First Aid at Work course including online self-study and a 4‑hour classroom session to gain a Highfield Level 3 Award in workplace first aid.",
                "provider": {
                    "@type": "Organization",
                    "name": "Training4Employment",
                    "sameAs": "https://www.training4employment.co.uk",
                    "url": "https://www.training4employment.co.uk"
                },
                "image": "https://training4employment.co.uk/courses/emergency-first-aid-at-work",
                "educationalLevel": "Level 3",
                "inLanguage": "en-GB",
                "coursePrerequisites": [
                    "Must be 14+",
                    "Internet access and e‑learning device"
                ],
                "offers": {
                    "@type": "Offer",
                    "price": "67.50",
                    "priceCurrency": "GBP",
                    "url": "https://training4employment.co.uk/courses/emergency-first-aid-at-work",
                    "validFrom": "2025-01-01"
                },
                "hasCourseInstance": [
                    {
                    "@type": "CourseInstance",
                    "name": "Emergency First Aid at Work – Birmingham 04 Jul 2025",
                    "startDate": "2025-07-04T09:00:00",
                    "endDate": "2025-07-04T13:00:00",
                    "location": {
                        "@type": "Place",
                        "name": "Training4Employment, Birmingham",
                        "address": {
                        "@type": "PostalAddress",
                        "addressLocality": "Birmingham",
                        "addressCountry": "GB"
                        }
                    }
                    },
                    {
                    "@type": "CourseInstance",
                    "name": "Emergency First Aid at Work – Birmingham 05 Jul 2025",
                    "startDate": "2025-07-05T08:00:00",
                    "endDate": "2025-07-05T12:00:00",
                    "location": {
                        "@type": "Place",
                        "name": "Training4Employment, Birmingham",
                        "address": {
                        "@type": "PostalAddress",
                        "addressLocality": "Birmingham",
                        "addressCountry": "GB"
                        }
                    }
                    },
                    {
                    "@type": "CourseInstance",
                    "name": "Emergency First Aid at Work – Leicester 14 Jul 2025",
                    "startDate": "2025-07-14T09:00:00",
                    "endDate": "2025-07-14T13:00:00",
                    "location": {
                        "@type": "Place",
                        "name": "Training4Employment, Leicester",
                        "address": {
                        "@type": "PostalAddress",
                        "addressLocality": "Leicester",
                        "addressCountry": "GB"
                        }
                    }
                    }
                ],
                "timeRequired": "PT4H",
                "educationalCredentialAwarded": {
                    "@type": "EducationalOccupationalCredential",
                    "name": "Highfield Level 3 Award in Emergency First Aid at Work",
                    "credentialCategory": "Award"
                }
            }
        </script>
    @elseif ($slug->slug == 'traffic-marshall-training')
        <script type="application/ld+json">
            {
                "@context": "https://schema.org",
                "@type": "Course",
                "@id": "https://training4employment.co.uk/courses/traffic-marshall-training",
                "name": "Traffic Marshal (Vehicle Banksman) Training",
                "description": "Two‑hour classroom Traffic Marshal / Vehicle Banksman course covering legal requirements, HSE-standard hand signals, risk assessments, PPE, and practical assessment; includes photo ID card and same‑day certification.",
                "provider": {
                    "@type": "Organization",
                    "name": "Training4Employment",
                    "sameAs": "https://www.training4employment.co.uk",
                    "url": "https://www.training4employment.co.uk"
                },
                "image": "https://training4employment.co.uk/courses/traffic-marshall-training",
                "educationalLevel": "Level 2",
                "inLanguage": "en-GB",
                "coursePrerequisites": [
                    "Must be 14+",
                    "Valid photographic ID"
                ],
                "offers": {
                    "@type": "Offer",
                    "price": "67.50",
                    "priceCurrency": "GBP",
                    "url": "https://training4employment.co.uk/courses/traffic-marshall-training",
                    "validFrom": "2025-01-01"
                },
                "hasCourseInstance": [
                    {
                    "@type": "CourseInstance",
                    "name": "Traffic Marshal Training – Birmingham 02 Jul 2025",
                    "startDate": "2025-07-02T14:00:00",
                    "endDate": "2025-07-02T16:00:00",
                    "location": {
                        "@type": "Place",
                        "name": "Training4Employment, Birmingham",
                        "address": {
                        "@type": "PostalAddress",
                        "addressLocality": "Birmingham",
                        "addressCountry": "GB"
                        }
                    }
                    },
                    {
                    "@type": "CourseInstance",
                    "name": "Traffic Marshal Training – Birmingham 16 Jul 2025",
                    "startDate": "2025-07-16T14:00:00",
                    "endDate": "2025-07-16T16:00:00",
                    "location": {
                        "@type": "Place",
                        "name": "Training4Employment, Birmingham",
                        "address": {
                        "@type": "PostalAddress",
                        "addressLocality": "Birmingham",
                        "addressCountry": "GB"
                        }
                    }
                    },
                    {
                    "@type": "CourseInstance",
                    "name": "Traffic Marshal Training – Leicester 16 Jul 2025",
                    "startDate": "2025-07-16T16:00:00",
                    "endDate": "2025-07-16T18:00:00",
                    "location": {
                        "@type": "Place",
                        "name": "Training4Employment, Leicester",
                        "address": {
                        "@type": "PostalAddress",
                        "addressLocality": "Leicester",
                        "addressCountry": "GB"
                        }
                    }
                    }
                ],
                "timeRequired": "PT2H",
                "educationalCredentialAwarded": {
                    "@type": "EducationalOccupationalCredential",
                    "name": "Traffic Marshal / Vehicle Banksman Certificate",
                    "credentialCategory": "Certificate"
                }
            }
        </script>
    @elseif ($slug->slug == 'fire-safety-for-fire-wardens')
        <script type="application/ld+json">
            {
                "@context": "https://schema.org",
                "@type": "Course",
                "@id": "https://training4employment.co.uk/courses/fire-safety-for-fire-wardens",
                "name": "Fire Safety for Fire Wardens",
                "description": "One-day Level 2 course for fire wardens/marshals, covering fire risk assessment, evacuation procedures, firefighting equipment use, fire safety regulations, practical exercises and MCQ exam—includes Highfield Level 2 Award valid for 3 years.",
                "provider": {
                    "@type": "Organization",
                    "name": "Training4Employment",
                    "sameAs": "https://www.training4employment.co.uk",
                    "url": "https://training4employment.co.uk"
                },
                "image": "https://training4employment.co.uk/courses/fire-safety-for-fire-wardens",
                "educationalLevel": "Level 2",
                "inLanguage": "en-GB",
                "coursePrerequisites": [
                    "Must be 14+",
                    "Valid photographic ID"
                ],
                "offers": {
                    "@type": "Offer",
                    "price": "150.80",
                    "priceCurrency": "GBP",
                    "url": "https://training4employment.co.uk/courses/fire-safety-for-fire-wardens",
                    "validFrom": "2025-01-01"
                },
                "hasCourseInstance": [
                    {
                    "@type": "CourseInstance",
                    "name": "Fire Safety for Fire Wardens – Birmingham",
                    "startDate": null,
                    "endDate": null,
                    "location": {
                        "@type": "Place",
                        "name": "Training4Employment, Birmingham",
                        "address": {
                        "@type": "PostalAddress",
                        "streetAddress": "89‑91 Hatchett Street",
                        "addressLocality": "Birmingham",
                        "postalCode": "B19 3NY",
                        "addressCountry": "GB"
                        }
                    }
                    }
                ],
                "timeRequired": "PT7H",
                "educationalCredentialAwarded": {
                    "@type": "EducationalOccupationalCredential",
                    "name": "Highfield Level 2 Award in Fire Safety (Fire Warden)",
                    "credentialCategory": "Award"
                }
            }
        </script>
    @elseif ($slug->slug == 'aphl-personal-licence')
        <script type="application/ld+json">
            {
                "@context": "https://schema.org",
                "@type": "Course",
                "@id": "https://training4employment.co.uk/courses/aphl-personal-licence",
                "name": "APLH Personal Licence (Award for Personal Licence Holders)",
                "description": "Ofqual-regulated Level 2 APLH course covering the Licensing Act 2003, legal responsibilities, protecting children, licensing authorities and responsible alcohol sale; includes multiple-choice exam with ≥70% pass mark and same-day certification.",
                "provider": {
                "@type": "Organization",
                "name": "Training4Employment",
                "sameAs": "https://www.training4employment.co.uk",
                "url": "https://www.training4employment.co.uk"
                },
                "image": "https://training4employment.co.uk/courses/aphl-personal-licence",
                "educationalLevel": "Level 2",
                "inLanguage": "en-GB",
                "coursePrerequisites": [
                "Must be 18+",
                "Enhanced DBS recommended"
                ],
                "offers": {
                "@type": "Offer",
                "price": "1.00",
                "priceCurrency": "GBP",
                "url": "https://training4employment.co.uk/courses/aphl-personal-licence",
                "validFrom": "2025-01-01"
                },
                "hasCourseInstance": [
                {
                    "@type": "CourseInstance",
                    "name": "APLH Personal Licence – 1‑day classroom session",
                    "startDate": null,
                    "endDate": null,
                    "location": {
                    "@type": "Place",
                    "name": "Training4Employment Locations (nationwide)",
                    "address": {
                        "@type": "PostalAddress",
                        "addressCountry": "GB"
                    }
                    }
                }
                ],
                "timeRequired": "P1D",
                "educationalCredentialAwarded": {
                "@type": "EducationalOccupationalCredential",
                "name": "Level 2 Award for Personal Licence Holders",
                "credentialCategory": "Award"
                }
            }
        </script>
    @endif
@endpush
