@extends('layouts.frontend')

@section('title', ucfirst($slug->name) ?? '')

@section('main')
    <div class="product-page singleProduct singleElearning elearning coursePage">
        <section id="banner" class="bannerWrapper">
            <div class="container">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-4 col-lg-4 bannerImg"
                     style="background: url('{{ $slug->banner_image ? asset($slug->banner_image) : asset('images/placeholderimage.jpg') }}') no-repeat center / cover;">
                </div>
                <div class="col-12 col-sm-12 col-md-8 col-lg-8 py-5">
                    <div class="bannerCol px-3 px-lg-0 px-md-0 px-xl-0 pl-xl-5 pl-lg-5 pl-md-5 mr-xl-5 pr-xl-5">
                        {!! $slug->banner_description !!}
                        <div class="bookingBtnGroup d-flex flex-column flex-md-row flex-lg-row mb-2">
                            <a href="#book_elearning"
                               class="mr-lg-2 mr-md-2 mr-sm-0 mb-2 mb-md-0 mb-lg-0 btnMstr text-center"><i
                                    class="fas fa-shopping-cart"></i> Book Now</a>
                            <script defer async src='https://cdn.trustindex.io/loader.js?c6282b731b132346ef669eb8980'></script>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </section>
        <section class="mainContentWrapper py-5">
            @php
                $faqs = json_decode($slug->faqs, true);
                $value = 1;
            @endphp
            <div class="container">
                <div class="row flex-column-reverse  flex-md-row flex-lg-row flex-xl-row">
                    <div class="col-12 col-sm-12 col-md-7 col-lg-8 col-xl-8">
                        <div class="leftContentArea" id="content">
                            {!! $slug->long_desc !!}
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-5 col-lg-4 col-xl-4 mb-5 mb-xl-0 mb-lg-0">
                        <div class="rightSidebar mb-5 mb-sm-0 mb-md-0 mb-lg-0 mb-xl-0">
                            <div class="courseSidebar">
                                <img src="{{ $slug->course_image ? asset($slug->course_image) : asset('images/placeholderimage.jpg') }}"
                                     class="img-fluid" alt="{{ Str::title($slug->name) }}">
                                <h2>{{ $slug->name ?? '' }}</h2>
                                <ul class="list-unstyled mr-0 ml-0 my-4 p-0">
                                    <li class="d-flex align-items-center mb-1"><i class="fas fa-check-circle"></i>
                                        <p class="m-0"><strong>Duration:</strong> {{ $slug->duration ?? '' }} </p>
                                    </li>
                                    <li class="d-flex align-items-center mb-1"><i class="fas fa-check-circle"></i>
                                        <p class="m-0"><strong>SIA Licence Fee:</strong> £{{ $slug->price ?? '' }} </p>
                                    </li>
                                </ul>
                                @if ($slug->requirements)
                                    <h2 class="entryTitle">Entry Requirements</h2>
                                    {!! $slug->requirements !!}
                                @endif

                                <form action="{{ route('cart.add') }}" method="POST" id="book_elearning">
                                    @csrf

                                    <input type="hidden" name="is_elearning" value="1">
                                    <input type="hidden" name="course_id" value="{{ $slug->id }}">
                                    <input type="hidden" name="course_name" value="{{ $slug->name }}">
                                    <input type="hidden" name="course_price" value="{{ $slug->price }}">

                                    <a href="javascript:;" onclick="document.getElementById('book_elearning').submit(); return false;" class="btnBlue"><i class="fas fa-shopping-cart"></i> Book Now</a>

                                </form>

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
    </style>
@endpush
@push('js')
    <script>
        $(document).ready(function() {
            // add class on table od content
            $('.tableOfContent li').click(function() {
                $('.tableOfContent li').removeClass('active');
                $(this).addClass('active');
            });

            // add class table of content on scroll

            $(window).on('scroll', function() {
                const scrollTop = $(window).scrollTop();
                const offset = $('.tableOfContent').offset().top;
                if (scrollTop >= offset - 100) {
                    $('.tableOfContent').addClass('scrolled');
                } else {
                    $('.tableOfContent').removeClass('scrolled');
                }
            });

        });
    </script>
    <script>
        $(document).ready(function() {
            $(document).on('click', '.toggaleAccordion .card', function() {
                $('.toggaleAccordion .card').removeClass('active');
                $(this).addClass('active');
            });
        });
    </script>
@endpush
