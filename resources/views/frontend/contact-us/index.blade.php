@extends('layouts.frontend')
@section('title', 'Contact Us')
@section('main')
    <div class="contactUsPage">
        <section class="pageHeaderMain">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-8 col-lg-8" data-aos="fade-right">
                        <div class="pageHeaderTitle">
                            <h1>Contact Us</h1>
                            <ul class="m-0 p-0 list-unstyled d-flex align-items-center">
                                <li class="mr-2"><a href="{{ route('home.index') }}">Home</a></li>
                                <li class="mr-2"><i class="fa-solid fa-angles-right"></i></li>
                                <li class="mr-2"><a href="javascript:;">Contact Us</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="formContactUs py-5">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 text-center mb-5" data-aos="fade-down">
                        <h2 class="mb-5">Keep in touch with Training for Employment</h2>
                        <p>Got questions, feedback, or need assistance? We’re here to help! Feel free to reach out to us
                            using the information provided below or simply fill out the contact form. Our dedicated customer
                            service team is ready to assist you.</p>
                        <p>We value your inquiries and strive to provide timely assistance. Whether it’s about our courses,
                            support services, or any other concerns, we’re committed to ensuring your satisfaction.</p>
                        <p>Thank you for choosing Training for Employment as your trusted training provider.</p>
                    </div>
                    <div class="col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8" data-aos="fade-right">

                        @if ($errors->any())
                            <div class="alert alert-danger mb-3">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif


                        <form action="{{ route('contact.submit') }}" method="POST" class="mb-5">
                            @csrf
                            <div class="form-row">
                                <div class="col-md-4">
                                    <input type="text" name="name"
                                        class="form-control mb-3 @error('name') is-invalid @enderror" required
                                        placeholder="Name" required value="{{ old('name') }}" />
                                    @error('name')
                                        <small class="invalid-feedback" role="alert">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <input type="tel" name="phone"
                                        class="form-control mb-3 @error('phone') is-invalid @enderror" required
                                        placeholder="Phone" required value="{{ old('phone') }}" />
                                    @error('phone')
                                        <small class="invalid-feedback" role="alert">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <input type="email" name="email"
                                        class="form-control mb-3 @error('email') is-invalid @enderror" required
                                        placeholder="Email" required value="{{ old('email') }}" />
                                    @error('email')
                                        <small class="invalid-feedback" role="alert">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="subject"
                                        class="form-control mb-3 @error('subject') is-invalid @enderror" required
                                        placeholder="Subject" required value="{{ old('subject') }}" />
                                    @error('subject')
                                        <small class="invalid-feedback" role="alert">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="company"
                                        class="form-control mb-3 @error('company') is-invalid @enderror" required
                                        placeholder="Company" required value="{{ old('company') }}" />
                                    @error('company')
                                        <small class="invalid-feedback" role="alert">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <textarea name="message" class="form-control mb-3" placeholder="Message">{{ old('message') }}</textarea>
                                </div>

                                <div class="col-md-12 mb-3">
                                    {!! NoCaptcha::display() !!}
                                </div>


                                <div class="col-md-12">
                                    <button type="submit" class="btnGray">Send My Message</button>
                                </div>

{{--                                {!! NoCaptcha::renderJs() !!}--}}

                            </div>
                        </form>
                    </div>
                    <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                        <div class="companyInfo">
                            <div class="companyInfoBox d-flex align-items-center mb-2" data-aos="fade-left"
                                data-aos-easing="ease-out-cubic" data-aos-duration="2400">
                                <div class="box">
                                    <div class="icon"><i class="fa-solid fa-location-dot"></i></div>
                                    <div class="details d-flex align-items-center justify-content-center"><i
                                            class="fa-solid fa-location-dot"></i></div>
                                </div>
                                <div class="companyInfoBoxDesc">
                                    <p class="m-0"><small>Ground Floor, 89-91 Hatchett St, Birmingham B19 3NY</small></p>
                                </div>
                            </div>
                            <div class="companyInfoBox d-flex align-items-center mb-2" data-aos="fade-left"
                                data-aos-easing="ease-out-cubic" data-aos-duration="2200">
                                <div class="box">
                                    <div class="icon"><i class="fas text-white fa-phone-volume"></i></div>
                                    <div class="details d-flex align-items-center justify-content-center"><i
                                            class="fas text-white fa-phone-volume"></i></div>
                                </div>
                                <div class="companyInfoBoxDesc">
                                    <p class="m-0"><small>0121 630 2115</small></p>
                                </div>
                            </div>
                            <div class="companyInfoBox d-flex align-items-center mb-2" data-aos="fade-left"
                                data-aos-easing="ease-out-cubic" data-aos-duration="1800">
                                <div class="box">
                                    <div class="icon"><i class="fa-solid fa-mobile-screen-button"></i></div>
                                    <div class="details d-flex align-items-center justify-content-center"><i
                                            class="fa-solid fa-mobile-screen-button"></i></div>
                                </div>
                                <div class="companyInfoBoxDesc">
                                    <p class="m-0"><small>0808 280 8098</small></p>
                                </div>
                            </div>
                            <div class="companyInfoBox d-flex align-items-center mb-2" data-aos="fade-left"
                                data-aos-easing="ease-out-cubic" data-aos-duration="1400">
                                <div class="box">
                                    <div class="icon"><i class="fa-solid fa-comment"></i></div>
                                    <div class="details d-flex align-items-center justify-content-center"><i
                                            class="fa-solid fa-comment"></i></div>
                                </div>
                                <div class="companyInfoBoxDesc">
                                    <p class="m-0"><small>07904 010 700</small></p>
                                </div>
                            </div>
                            <div class="companyInfoBox d-flex align-items-center mb-2" data-aos="fade-left"
                                data-aos-easing="ease-out-cubic" data-aos-duration="1000">
                                <div class="box">
                                    <div class="icon"><i class="fa-solid fa-envelope"></i></div>
                                    <div class="details d-flex align-items-center justify-content-center"><i
                                            class="fa-solid fa-envelope"></i></div>
                                </div>
                                <div class="companyInfoBoxDesc">
                                    <p class="m-0"><small>info@training4employment.co.uk</small></p>
                                </div>
                            </div>
                        </div>
                    </div>
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
@endpush
