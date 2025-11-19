@extends('layouts.frontend')

@section('title', ucfirst($slug->name))

@push('css')
<style>
    div#accordionWrapper {
        margin-top: 30px;
    }

    div#accordionWrapper button.btn.btn-link.collapsed {
        color: #000;
    }

    div#accordionWrapper button.btn.btn-link {
        box-shadow: unset;
        text-decoration: none;
        color: #085e92;
        font-weight: 600;
    }
</style>
@endpush

@section('main')
    <div class="courseBundleDetailPage">
        <section class="detailTopSection pt-5">
            <div class="container">
                <div class="row pb-5">
                    <div class="col-12 col-md-6">
                        <nav class="dtpBreadcrumb mb-4 d-md-none d-lg-none d-xl-none" aria-label="Breadcrumb">
                            <a href="/">Home</a>
                            <i class="fa-solid fa-angles-right"></i>
                            <a href="{{ route('course.bundle') }}">Course Bundles</a>
                            <i class="fa-solid fa-angles-right"></i>
                            <span>{{ $slug->name }}</span>
                        </nav>
                        <img src="{{ asset($slug->bundle_image ? $slug->bundle_image : 'frontend/img/thumbnail.webp') }}"
                            class="img-fluid w-100" alt="{{ Str::title($slug->name) }}">
                    </div>
                    <div class="col-12 col-md-6" id="booknow">
                        <nav class="dtpBreadcrumb mb-4 d-none d-md-block d-lg-block d-xl-block" aria-label="Breadcrumb">
                            <a href="/">Home</a>
                            <i class="fa-solid fa-angles-right"></i>
                            <a href="{{ route('course.bundle') }}">Course Bundles</a>
                            <i class="fa-solid fa-angles-right"></i>
                            <span>{{ $slug->name }}</span>
                        </nav>
                        <div class="dtpInfo">
                            <h1 class="mb-3">{{ $slug->name }}</h1>
                            <p class="h4 mb-3">£{{ $slug->regular_price }}</p>
                            <div class="dtpShortDesc py-3">
                                {!! $slug->excerpt !!}
                            </div>
                            <p>Please select dates for each course.</p>


                            <form action="{{ route('cart.add') }}" method="POST">
                                @csrf

                                <input type="hidden" name="is_bundle" value="1"> <!-- Flag to identify bundle -->
                                <input type="hidden" name="bundle_name" value="{{ $slug->name }}">
                                <input type="hidden" name="bundle_price" value="{{ $slug->regular_price }}">

                                @foreach ($coursesWithCohorts as $course)
                                    <div class="coursesDates mb-4">
                                        <div class="h6">
                                            <span class="text-danger">{{ (trim($course->name) == "Level 1 Health and Safety Awareness within Construction Environment") ? '' : '*' }}</span>
                                            {{ $course->name }}
                                        </div>
                                        @if ($course->cohorts->isEmpty())
                                            <p>No dates are available for this course.</p>
                                        @else
                                            <select name="cohort_ids[{{ $course->id }}]" class="form-control">
                                                @foreach ($course->cohorts as $cohort)
                                                    @php
                                                        $venueName = $cohort->venue->venue_name ?? 'Venue not assigned';
                                                    @endphp
                                                    <option value="{{ $cohort->id }}">
                                                        {{ formatCourseDate($cohort) }} ({{ $venueName }})
                                                    </option>
                                                @endforeach
                                            </select>
                                        @endif


                                    </div>
                                @endforeach

                                <div class="dtpFinalTotal mt-5">
                                    <p class="h6">Final total</p>
                                    <p class="h6">£{{ $slug->regular_price }}</p>
                                    <div class="dtpAddToCart mt-4">
                                        <button type="submit" class="btn btnCart mt-1 d-inline-block"
                                            {{ $course->cohorts->isEmpty() ? 'disabled' : '' }}>
                                            Add to basket
                                        </button>
                                    </div>
                                </div>
                                <hr>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="row longDesc">
                    <div class="col-12">
                        <div class="py-4 datas">{!! $slug->long_description !!}</div>
                        <div class="text-center mb-4 mt-5">
                            <button id="scroll2ToBookNow" class="btn btnCart mt-1 d-inline-block">
                                Book Now
                            </button>
                        </div>
                    </div>
                </div>

                <h2 class="fs2 mt-4">Related Course Bundles</h2>
                <div class="relatedProducts singles my-5">
                    @forelse ($bundles as $bundle)
                        @if ($bundle->id != $slug->id)
                            <div class="sliderRelatedProducts">
                                <div class="bundlesAll d-flex flex-column justify-content-between h-100">
                                    <div class="relatedThumbnail">
                                        <img src="{{ asset($bundle->bundle_image ? $bundle->bundle_image : 'frontend/img/thumbnail.webp') ?? '' }}"
                                            class="img-fluid" alt="{{ Str::title($bundle->name) }}">
                                        <div class="mt-4 h5">{{ $bundle->name ?? '' }}</div>
                                    </div>
                                    <div class="relatedContent">
                                        <p class="price">£{{ $bundle->regular_price ?? '' }}</p>
                                        <div class="dtpAddToCart mt-4">
                                            <a href="{{ route('course.bundle.show', $bundle->slug) }}"
                                                class="btn btnCart mt-1 d-inline-block">Book Now</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @empty
                        <p>No Bundle Found!</p>
                    @endforelse
                </div>
            </div>
        </section>
    </div>
@endsection
@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css"
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css"
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js" crossorigin="anonymous"
        referrerpolicy="no-referrer"></script>

    <script>
        $(document).ready(function() {
            $('.relatedProducts').slick({
                infinite: true,
                slidesToShow: 3,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 2000,
                arrows: false,
                dots: true,
                responsive: [{
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 1,
                            dots: true
                        }
                    },
                    {
                        breakpoint: 800,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 600,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    }
                ]
            });
        });

        document.getElementById("scrollToBookNow").addEventListener("click", function() {
            const target = document.getElementById("booknow");
            if (target) {
                target.scrollIntoView({
                    behavior: "smooth"
                });
            }
        });

        document.getElementById("scroll2ToBookNow").addEventListener("click", function() {
            const target = document.getElementById("booknow");
            if (target) {
                target.scrollIntoView({
                    behavior: "smooth"
                });
            }
        });
    </script>
@endpush
