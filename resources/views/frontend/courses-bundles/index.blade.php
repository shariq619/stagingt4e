@extends('layouts.frontend')

@section('title', 'Courses Bundles')

@section('main')
    <div class="courseBundlePage">
        <section id="banner" class="bannerWrapper">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-8 col-lg-8 py-5 screen_col2">
                        <div class="bannerCol px-3 px-lg-0 px-md-0 px-xl-0 pl-xl-5 pl-lg-5 pl-md-5 mr-xl-5 pr-xl-5">
                            <div class="bannerInfo">
                                <h1 class="mb-5">Course Bundles</h1>
                                <p class="h4 mb-4">
                                    Accredited Security and Construction Course Bundles SIA & CSCS Certification UK
                                </p>
                                <p class="mb-3">Are you looking to obtain more than one qualification this year or simply
                                    looking to brush up on your training and bring your skills up-to-date?</p>
                                <p class="mb-3">At Training for Employment, we provide a wide variety of accredited course
                                    bundles that are designed to help you succeed in today’s competitive job market. Whether
                                    you’re looking to enhance your first aid skills, gain health and safety certifications,
                                    or explore SIA security training opportunities, our flexible and affordable training
                                    programs are tailored to fit your schedule and career goals. With our nationwide
                                    accredited courses you'll gain the qualifications and confidence you need to excel in
                                    your chosen field.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="courseBundles courseBundlesProduct mainpage py-5">
            <div class="container pt-5">
                <div class="row">
                    @forelse ($bundles as $bundle)
                        <div class="col-12 col-md-12 col-lg-4 col-xl-4 mb-5 courseBundleCol">
                            <div class="productGrid">
                                <div class="productGridInner">
                                    <div class="productGridThumbnail position-relative">
                                        <div class="productGridImg">
{{--                                            <img src="{{ $bundle->bundle_image ? $bundle->bundle_image : asset('images/placeholderimage.jpg') }}"--}}
{{--                                                class="img-fluid w-100" alt="{{ Str::title($bundle->name) }}">--}}

                                            <img src="{{ asset($bundle->bundle_image ? $bundle->bundle_image : 'images/placeholderimage.jpg') }}" class="img-fluid w-100" alt="{{ Str::title($bundle->name) }}">

                                        </div>
                                        <div class="productGridOverlay">
                                            <a href="{{ route('course.bundle.show', $bundle->slug) }}" class="gridBtn">View
                                                Dates & Venues</a>
                                        </div>
                                    </div>
                                    <h2 class="h5">{{ $bundle->name }}</h2>
                                    <div class="productGridContent">
                                        <div class="d-flex align-items-center mb-4 bundlePrice justify-content-between">
                                            <span>Save £{{ $bundle->vat }}</span>
                                            <span>£{{ $bundle->regular_price }}</span>
                                        </div>
                                        <ul class="productsName p-0 m-0 list-unstyled mb-3">
                                            @forelse ($bundle->courses as $course)
                                                <li class="d-flex align-items-center justify-content-between">
                                                    <div class="d-flex align-items-center">
                                                        <i class="fa-solid fa-circle-chevron-right mr-2"></i>
                                                        <p class="mr-2 mb-0"><a title="{{ $course->name }}" class="mr-2" href="{{ route('course.show',$course->slug) }}">{{ $course->name }}</a></p>
                                                    </div>
{{--                                                    <a class="mr-2" href="{{ route('course.show',$course->slug) }}">view</a>--}}
                                                </li>
                                            @empty
                                                <li>No products available.</li>
                                            @endforelse
                                        </ul>
                                        <div class="shortDesc">
                                            {!! $bundle->short_description !!}
                                        </div>

                                    </div>
                                    <div class="courseBundlePackage mt-4 d-flex align-items-center justify-content-between">
                                        <a href="tel:0808 280 8098">Call Us: 0808 280 8098</a>
                                        <a href="{{ route('course.bundle.show', $bundle->slug) }}">Book Now</a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    @empty
                        <p>No courses bundles found!</p>
                    @endforelse
                </div>
                <div class="d-flex justify-content-center mt-5">
                    {{ $bundles->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </section>
    </div>
@endsection
