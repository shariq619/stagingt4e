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
                            <li class="d-flex align-content-center"><i class="mr-3 fas fa-certificate"></i>
                                <p class="m-0"><strong>Award</strong>:
                                    {{ $course->awardingBody->name ?? '' }}</p>
                            </li>
                            <li class="d-flex align-content-center"><i class="mr-3 fas fa-money-bill-wave"></i>
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
                        <a href="{{ route('course.show', $course->slug) }}" class="gridBtn">View Dates & Venues</a>
                    </div>
                </div>

            </div>

        </div>
    </div>
@empty
    <p class="w-100 text-center">No Course Found!</p>
@endforelse
