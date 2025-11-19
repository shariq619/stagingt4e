@php use App\Models\Cohort; @endphp
@extends('layouts.frontend')
@section('title', 'Checkout')

@section('main')
    <div class="pageTitleTop pyxl-5">
        <div class="container">
            <h1 class="text-center">Checkout</h1>
        </div>
    </div>
    <section class="pyxl-5 checkoutPage position-relative">
        <div class="container">
            <div id="loadingSpinner" style="display: none; text-align: center;">
                <i class="fas fa-spinner fa-spin fa-3x"></i>
            </div>
            <div class="row flex-column-reverse flex-lg-row flex-md-row flex-xl-row">
                <div class="col-12 col-md-7">
                    <div class="checkoutForm">
                        <p class="h5 d-flex align-items-center mb-4">
                            <span>Secure Checkout</span>
                            <img src="{{ asset('frontend/img/lock.svg') }}" class="img-fluid ml-2"
                                 style="width:30px; height:30px;" alt="Lock">
                        </p>
                        <p class="mb-5" style="font-family:'Rubik', sans-serif;">Your seat is reserved. Complete your
                            booking in <span id="timer"></span></p>
                        <p class="h3 mb-5">Billing details</p>
                        <form action="{{ route('checkout.process') }}" method="POST" id="payment-form">
                            @csrf
                            <!-- Include this input to capture the Stripe payment method ID -->
                            <input type="hidden" name="payment_method_id" id="payment-method-id">
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">First Name <span style="color:#a00;">*</span></label>
                                        <input type="text" name="first_name" class="form-control"
                                               value="{{ session('checkout_form_data.first_name') }}" required/>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Last Name <span style="color:#a00;">*</span></label>
                                        <input type="text" name="last_name"
                                               value="{{ session('checkout_form_data.last_name') }}"
                                               class="form-control" required/>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Company name (optional)</label>
                                        <input type="text" name="company_name"
                                               value="{{ session('checkout_form_data.company_name') }}"
                                               class="form-control"/>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Street address <span
                                                style="color:#a00;">*</span></label>
                                        <input type="text" name="street_address"
                                               value="{{ session('checkout_form_data.street_address') }}"
                                               class="form-control" required/>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Flat, suite, unit, etc. (optional)</label>
                                        <input type="text" name="unit" class="form-control"
                                               value="{{ session('checkout_form_data.unit') }}"/>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Town / City <span style="color:#a00;">*</span></label>
                                        <input type="text" name="city" class="form-control"
                                               value="{{ session('checkout_form_data.city') }}" required/>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Postcode <span style="color:#a00;">*</span></label>
                                        <input type="text" name="postcode" class="form-control"
                                               value="{{ session('checkout_form_data.postcode') }}" required/>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Phone <span style="color:#a00;">*</span></label>
                                        <input type="tel" name="phone" id="phone" class="form-control"
                                               value="{{ session('checkout_form_data.phone') }}" required/>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Email address <span
                                                style="color:#a00;">*</span></label>
                                        <input type="email" name="email" class="form-control"
                                               value="{{ session('checkout_form_data.email') }}" required/>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Attendee name(s) and contact details (email address
                                            and
                                            mobile phone)<span style="color:#a00;">*</span></label>
                                        <input type="text" name="attendee_details" class="form-control"
                                               value="{{ session('checkout_form_data.attendee_details') }}" required/>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12 mt-4">
                                    <label class="form-label h4 mb-4"><strong>Declaration: </strong> <span
                                            style="color:#a00;">*</span></label>
                                    <div class="form-group declarationRadio">
                                        <label class="form-label">
                                            <input type="radio" class="mr-2" name="declaration" value="yes"
                                                   {{ session('checkout_form_data.declaration') == 'yes' ? 'checked' : '' }}
                                                   required>
                                            I understand and confirm that I will complete the required self-study and
                                            e-learning activities prior to the start of the course.
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12 mt-4">
                                    <label class="form-label h4 mb-4"><strong>How did you hear about us?</strong> <span
                                            style="color:#a00;">*</span></label>
                                    <div class="form-group">
                                        <label class="form-label">
                                            <input type="radio" class="mr-2" name="hear_about" value="Facebook"
                                                   {{ session('checkout_form_data.hear_about') == 'Facebook' ? 'checked' : '' }}
                                                   required> Facebook post/story
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">
                                            <input type="radio" class="mr-2" name="hear_about"
                                                   value="LinkedIn" {{ session('checkout_form_data.hear_about') == 'LinkedIn' ? 'checked' : '' }}>
                                            LinkedIn
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">
                                            <input type="radio" class="mr-2" name="hear_about"
                                                   value="Instagram" {{ session('checkout_form_data.hear_about') == 'Instagram' ? 'checked' : '' }}>
                                            Instagram post/story
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">
                                            <input type="radio" class="mr-2" name="hear_about"
                                                   value="Search Engine" {{ session('checkout_form_data.hear_about') == 'Search Engine' ? 'checked' : '' }}>
                                            Search Engine
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">
                                            <input type="radio" class="mr-2" name="hear_about"
                                                   value="Google Ads" {{ session('checkout_form_data.hear_about') == 'Google Ads' ? 'checked' : '' }}>
                                            Google Ads
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">
                                            <input type="radio" class="mr-2" name="hear_about"
                                                   value="Email" {{ session('checkout_form_data.hear_about') == 'Email' ? 'checked' : '' }}>
                                            Email
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">
                                            <input type="radio" class="mr-2" name="hear_about"
                                                   value="Word of mouth" {{ session('checkout_form_data.hear_about') == 'Word of mouth' ? 'checked' : '' }}>
                                            Word of mouth
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">
                                            <input type="radio" class="mr-2" name="hear_about"
                                                   value="Referred by trainer" {{ session('checkout_form_data.hear_about') == 'Referred by trainer' ? 'checked' : '' }}>
                                            Referred by one of the T4E trainers
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="remaining_balance" value="{{ $futurePayments }}">
                            <div class="paymentMethod">
                                <label>
                                    <input type="radio" name="payment_method" value="stripe" checked> Pay with Card
                                    (Stripe)
                                </label>
                                <label>
                                    <input type="radio" name="payment_method" value="paypal"> Pay with PayPal
                                </label>
                                <div class="payByCardWrapper my-4" id="stripe-container">
                                    <div id="card-element"></div>
                                </div>

                                <div id="paypal-button-container" style="display: none;"></div>
                            </div>
                            <div class="policies">
                                <p>Your personal data will be used to process your order, support your experience
                                    throughout
                                    this website, and for other purposes described in our <a
                                        href="{{ route('privacy.policy') }}" target="_blank"
                                        rel="noopener noreferrer">Privacy policy</a>.</p>
                                <p class="termsConditions"><input type="checkbox" name="terms" required> I have read
                                    and agree to the website <a href="{{ route('booking.conditions') }}" target="_blank"
                                                                rel="noopener noreferrer">Terms and conditions</a> <span
                                        style="color:#a00;">*</span></p>
                            </div>
                            <div class="checkoutBtn">
                                <button type="submit" class="btn btn-primary" id="place_order">Place order</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-12 col-md-5 mb-5 mb-md-0 mb-lg-0 mb-xl-0">
                    <div class="orderDetail mb-5">

                        <div class="orderTitles d-flex align-items-center justify-content-between px-3 py-2"
                             style="background: linear-gradient(275deg,#090039 0%,#085e92 83%); color: #fff; border-radius: 6px;">
                            <span>Order Summary</span>
                        </div>
                        <div class="orderLists">
                            @foreach (Cart::getContent() as $item)
                                @if (isset($item->attributes['is_bundle']) && $item->attributes['is_bundle'] == 1)
                                    <div class="orderitems d-flex align-items-center justify-content-between">

                                        <p class="productTitle pr-2">
                                            <strong>{{ $item->name }} <span
                                                    class="float-right">(x{{ $item->quantity }})</span></strong><br><br>

                                            @foreach ($item->attributes['courses'] as $course)
                                                <br><br><strong>{{ $course->course_name ?? '' }} </strong><br>
                                                {{-- <small>
                                                    📅 {{ $course['start_date'] }} - {{ $course['end_date'] }}
                                                </small><br> --}}
                                                <small>
                                                    📅 {{ formatCourseDate($course) }}
                                                </small><br>

                                                <small>
                                                    📍 {{ $course->venue }}
                                                </small>


                                                @if (isset($course->attributes['custom_fields']))
                                                    <br>
                                                    <small class="text-danger">Please indicate what type of First Aid
                                                        qualification you currently hold or going to obtain as per SIA
                                                        requirements:</small>
                                                    <br>
                                                    <small>
                                                        {{ $course->attributes['custom_fields'] }} ✔️
                                                    </small>
                                                @endif
                                            @endforeach

                                        </p>
                                        <p class="priceTotal">
                                            £{{ number_format($item->price * $item->quantity, 2) }}</p>

                                        {{-- Remove button --}}
                                        <form action="{{ route('cart.remove') }}" method="POST" class="ml-2">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $item->id }}">
                                            <button type="submit" class="btn btn-sm btn-outline-danger">✖</button>
                                        </form>

                                    </div>
                                @elseif (isset($item->attributes['is_bundle']) && $item->attributes['is_bundle'] == 2)
                                    <div class="orderitems d-flex align-items-center justify-content-between">
                                        <p class="productTitle pr-2">
                                            <strong>{{ $item->name }} @if ($item->attributes['color_option'])
                                                    <span
                                                        class="text-muted">({{ $item->attributes['color_option'] }})</span>
                                                @endif <span
                                                    class="float-right">(x{{ $item->quantity }})</span> </strong> <br>
                                        </p>

                                        <p class="priceTotal">
                                            £{{ number_format($item->price * $item->quantity, 2) }}</p>

                                        {{-- Remove button --}}
                                        <form action="{{ route('cart.remove') }}" method="POST" class="ml-2">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $item->id }}">
                                            <button type="submit" class="btn btn-sm btn-outline-danger">✖</button>
                                        </form>

                                    </div>
                                @else
                                    @if (isset($item->attributes['is_elearning']) && $item->attributes['is_elearning'])
                                        <div class="orderitems d-flex align-items-center justify-content-between">
                                            <p class="productTitle pr-2">
                                                <strong>{{ $item->name }} <span
                                                        class="float-right">(x{{ $item->quantity }})</span> </strong>
                                                <br>
                                            </p>
                                            <p class="priceTotal">
                                                £{{ number_format($item->price * $item->quantity, 2) }}</p>

                                            {{-- Remove button --}}
                                            <form action="{{ route('cart.remove') }}" method="POST" class="ml-2">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $item->id }}">
                                                <button type="submit" class="btn btn-sm btn-outline-danger">✖</button>
                                            </form>
                                        </div>
                                    @else
                                        <div class="couponCodeMain">
                                            <div class="orderitems d-flex align-items-center justify-content-between">
                                                <p class="productTitle pr-2">
                                                    <strong>{{ $item->name }}
                                                        <span class="float-right">(x{{ $item->quantity }})</span>
                                                    </strong> <br>

                                                    📅 {{ formatCourseDate($item->attributes->formatted_dates) }}

                                                    </small> <br>
                                                    <small>
                                                        @php
                                                            $cohort = Cohort::find($item->attributes->cohort_id);
                                                            $venueName = $cohort
                                                                ? $cohort->venue->venue_name
                                                                : 'Venue not available';
                                                        @endphp
                                                        📍 {{ $venueName }}
                                                    </small>

                                                    @if (isset($item->attributes['custom_fields']))
                                                        <br>
                                                        <small class="text-danger">Please indicate what type of First
                                                            Aid
                                                            qualification you currently hold or going to obtain as per
                                                            SIA
                                                            requirements:</small>
                                                        <br>
                                                        <small>
                                                            {{ $item->attributes['custom_fields'] }} ✔️
                                                        </small>
                                                    @endif


                                                </p>
                                                <p class="priceTotal">
                                                    £{{ number_format($item->price * $item->quantity, 2) }}</p>

                                                {{-- Remove button --}}
                                                <form action="{{ route('cart.remove') }}" method="POST" class="ml-2">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $item->id }}">
                                                    <button type="submit" class="btn btn-sm btn-outline-danger">✖
                                                    </button>
                                                </form>

                                            </div>


                                        </div>
                                    @endif
                                @endif
                            @endforeach








                            @php
                                $today = now();
                            @endphp

                            @if ($today->month == 11 || $today->month == 12)
                                <div class="couponCode">

                                    @if(\Cart::getCondition('COUPON_DISCOUNT'))
                                        <form action="{{ route('coupon.remove') }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-danger">Remove Coupon</button>
                                        </form>
                                    @else

                                        @php
                                            $showCouponForm = false;

                                            foreach(Cart::getContent() as $item) {
                                                // Make sure the start_date exists in attributes
                                                if(isset($item->attributes['start_date'])) {
                                                    // Convert start_date to a Carbon instance for easy month checking
                                                    $startDate = \Carbon\Carbon::parse($item->attributes['start_date']);
                                                    if($startDate->month === 12) { // December
                                                        $showCouponForm = true;
                                                        break;
                                                    }
                                                }
                                            }
                                        @endphp

                                        @if ($showCouponForm)
                                            <form id="couponForm">
                                                @csrf
                                                <input type="text" class="inputCoupon" name="coupon_code"
                                                       placeholder="Coupon code">
                                                <input type="hidden" name="price" value="{{ Cart::getTotal() }}">
                                                <button type="submit" class="btnCouponCod">
                                                    <span class="btnText">Apply</span>
                                                </button>
                                            </form>
                                            <div id="couponMessage"></div>
                                        @endif

                                    @endif


                                </div>
                                <br>
                            @endif


                        </div>
                        <div class="orderListSubTotal">

                            @php
                                $cartConditions = \Cart::getConditions();
                                $discountCondition = \Cart::getCondition('COUPON_DISCOUNT');
                                $discountValue = $discountCondition ? $discountCondition->getValue() : 0;

                                $subTotal = \Cart::getSubTotal();
                                $total = \Cart::getTotal();
                            @endphp


                            <p class="d-flex justify-content-between">
                                <strong>Subtotal</strong> <strong>£{{ number_format($subTotal, 2) }}</strong>
                            </p>

                            @if($discountCondition)
                                <p class="d-flex justify-content-between"><strong>Coupon Discount <span
                                            class="text-success">({{ $discountCondition->getAttributes()['code'] }})</span>:
                                    </strong>
                                    <strong>£{{ $discountCondition->getValue() }}</strong>
                                </p>
                            @endif


                            <p class="d-flex justify-content-between">
                                <strong>Due Today:</strong>
                                <strong>£{{ number_format($total, 2) }}</strong>
                            </p>

                            <p class="d-flex justify-content-between">
                                <strong>Future Payments</strong>
                                <strong>£{{ number_format($futurePayments, 2) }} </strong>
                            </p>
                            <p class="text-muted">Remaining balance will be due before the course starts.</p>

                        </div>
                    </div>

                    <div class="orderDetail mb-5">
                        <div class="orderTitles d-flex align-items-center justify-content-between px-3 py-2"
                             style="background: linear-gradient(275deg,#090039 0%,#085e92 83%); color: #fff; border-radius: 6px;">
                            <span>Recommended Bundles</span>
                        </div>

                        <div class="orderLists">
                            <div class="relatedProducts singles my-5">
                                @forelse ($bundles as $bundle)
                                    <div class="sliderRelatedProducts">
                                        <div class="bundlesAll d-flex flex-column justify-content-between h-100">
                                            <div class="relatedThumbnail">
                                                <img
                                                    src="{{ asset($bundle->bundle_image ?? 'frontend/img/thumbnail.webp') }}"
                                                    class="img-fluid" alt="{{ $bundle->name }}">
                                                <div class="mt-4 h5">{{ $bundle->name }}</div>
                                            </div>
                                            <div class="relatedContent">
                                                <p class="price">
                                                    <strong>£{{ $bundle->regular_price }}</strong>
                                                    <span class="badge badge-success ml-2 px-2 py-1"
                                                          style="background:#28a745; color:#fff; font-size:0.95rem; border-radius:6px;">
                                                        Save £{{ $bundle->vat }}
                                                    </span>
                                                </p>

                                                <div class="dtpAddToCart mt-4">
                                                    <a href="{{ route('course.bundle.show', $bundle->slug) }}"
                                                       class="btn btnCart mt-1 d-inline-block">Book Now</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <p>No Bundle Found!</p>
                                @endforelse
                            </div>
                        </div>
                    </div>


                    <script defer async src='https://cdn.trustindex.io/loader.js?34690d4371cd5966f966569d8e0'></script>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css"
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css"
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <style>
        form#couponForm {
            position: relative;
            width: 60%;
        }

        form#couponForm button.btnCouponCod {
            position: absolute;
            right: 0;
            background: #085e92;
            border: none;
            top: 0;
            bottom: 0;
            margin: 3px 3px;
            padding: 0px 15px;
            color: #fff;
        }

        form#couponForm input.inputCoupon {
            width: 100%;
            height: 35px;
        }

        .couponCode input.inputCoupon.active {
            background: #e5e5e5;
            border: none;
            opacity: 0.5;
        }

        .spinner {
            font-size: 14px;
            top: 0 !important;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        div#loadingSpinner {
            position: fixed;
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

        div#loadingSpinner i {
            color: #007bff;
        }

        .payByCardWrapper {
            border: 1px solid #ccc;
            padding: 15px;
            border-radius: 8px;
            background-color: #f9f9f9;
        }

        #card-element {
            padding: 12px;
            border-radius: 5px;
            background: white;
        }
    </style>
@endpush

@push('js')
    <script>
        $('#couponForm').on('submit', function (e) {
            e.preventDefault();

            const form = $(this);

            const paymentForm = $('#payment-form'); // ✅ jQuery selector
            const paymentData = paymentForm.serialize(); // ✅ Now works

            const submitBtn = form.find('.btnCouponCod');
            const btnText = submitBtn.find('.btnText');
            const spinner = submitBtn.find('.spinner');
            const messageBox = $('#couponMessage');
            const inputField = $('.inputCoupon');
            const couponCode = inputField.val().trim();

            if (couponCode === '') {
                messageBox.html('<span style="color:red;">Please enter a coupon code.</span>');
                return; // stop further execution
            }

            const couponData = form.serialize(); // Serialize coupon form data

            const combinedData = couponData + '&' + paymentData; // Merge both forms

            // UI lock
            submitBtn.prop('disabled', true);
            spinner.show();
            btnText.text('Checking...');
            messageBox.html('');

            $.ajax({
                url: "{{ route('checkout.coupon') }}",
                method: "POST",
                data: combinedData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
                .done(function (data) {
                    if (data.success) {
                        inputField.prop('readonly', true).addClass('active');
                        messageBox.html('<span style="color:green;">' + data.message + '</span>');
                        submitBtn.remove();

                        // 🔄 Delay reload to let user see the message
                        setTimeout(() => {
                            location.reload();
                        }, 1000); // reload after 1 second
                    } else {
                        messageBox.html('<span style="color:red;">' + data.message + '</span>');
                    }
                })
                .fail(function (xhr, status, error) {
                    // Extract the error message from the response if available
                    var errorMessage = xhr.responseJSON && xhr.responseJSON.message
                        ? xhr.responseJSON.message
                        : 'Coupon code does not exist.';  // Default message if no message is returned

                    messageBox.html('<span style="color:red;">' + errorMessage + '</span>');
                    console.error(errorMessage);
                })
                .always(function () {
                    submitBtn.prop('disabled', false);
                    spinner.hide();
                    btnText.text('Apply');
                });
        });
    </script>


    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const stripeRadio = document.querySelector('input[value="stripe"]');
            const paypalRadio = document.querySelector('input[value="paypal"]');
            const stripeContainer = document.getElementById('stripe-container');
            const paypalContainer = document.getElementById('paypal-button-container');

            const placeOrder = document.getElementById('place_order');


            function togglePaymentMethod() {
                if (stripeRadio.checked) {
                    stripeContainer.style.display = 'block';
                    paypalContainer.style.display = 'none';
                    placeOrder.style.display = 'block';
                } else {
                    stripeContainer.style.display = 'none';
                    paypalContainer.style.display = 'block';
                    placeOrder.style.display = 'none';
                }
            }


            stripeRadio.addEventListener('change', togglePaymentMethod);
            paypalRadio.addEventListener('change', togglePaymentMethod);

            togglePaymentMethod();
        });
    </script>

    {{-- Stripe SDK --}}
    <script src="https://js.stripe.com/v3/"></script>

    <script>
        let stripe;
        let elements;
        let cardElement;

        document.addEventListener("DOMContentLoaded", function () {
            const stripeKey = "{{ config('services.stripe.key') }}";

            if (!stripeKey || stripeKey.trim() === '') {
                console.error("Stripe key is missing! Check your environment settings.");
                return;
            }

            // Initialize Stripe
            stripe = Stripe(stripeKey);
            elements = stripe.elements();

            const style = {
                base: {
                    color: '#333',
                    fontSize: '16px',
                    fontFamily: 'Arial, sans-serif',
                    '::placeholder': {
                        color: '#888'
                    }
                },
                invalid: {
                    color: '#e5424d',
                    borderColor: '#e5424d'
                }
            };

            cardElement = elements.create('card', {style});
            cardElement.mount('#card-element');
        });

        document.addEventListener("DOMContentLoaded", function () {
            const form = document.querySelector('#payment-form');
            const button = document.querySelector('.checkoutBtn button');
            const loadingSpinner = document.getElementById('loadingSpinner');

            form.addEventListener('submit', async function (e) {
                e.preventDefault();

                const selectedPaymentMethod = document.querySelector('input[name="payment_method"]:checked');
                if (!selectedPaymentMethod) {
                    alert("Please select a payment method.");
                    return;
                }

                if (selectedPaymentMethod.value === 'paypal') {
                    // Submit the form normally for PayPal
                    form.submit();
                    return;
                }

                // Stripe flow starts here
                button.disabled = true;
                if (loadingSpinner) loadingSpinner.style.display = 'block';

                if (!stripe || !elements || !cardElement) {
                    alert("Payment system error. Please refresh the page.");
                    button.disabled = false;
                    if (loadingSpinner) loadingSpinner.style.display = 'none';
                    return;
                }

                try {
                    const {paymentMethod, error} = await stripe.createPaymentMethod({
                        type: 'card',
                        card: cardElement,
                    });

                    if (error) {
                        alert("Stripe error: " + error.message);
                        button.disabled = false;
                        if (loadingSpinner) loadingSpinner.style.display = 'none';
                        return;
                    }

                    // Prepare form data
                    const formData = new FormData(form);
                    formData.append('payment_method_id', paymentMethod.id);
                    formData.append('payment_method', 'stripe');

                    const payload = {};
                    formData.forEach((value, key) => {
                        payload[key] = value;
                    });

                    const response = await fetch('{{ route('checkout.process') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                        },
                        body: JSON.stringify(payload)
                    });

                    const data = await response.json();

                    if (data.error) {
                        alert("Payment failed: " + data.error);
                    } else if (data.requires_action) {
                        const {
                            error: confirmError,
                            paymentIntent
                        } = await stripe.confirmCardPayment(data.payment_intent_client_secret);

                        if (confirmError) {
                            alert("3D Secure failed: " + confirmError.message);
                        } else if (paymentIntent && paymentIntent.status === 'succeeded') {
                            window.location.href = '{{ route('checkout.thankyou') }}';
                        } else {
                            alert("Payment confirmation failed.");
                        }
                    } else {
                        window.location.href = '{{ route('checkout.thankyou') }}';
                    }

                } catch (err) {
                    console.error("Stripe JS Error:", err);
                    alert("Unexpected error occurred: " + err.message);
                } finally {
                    button.disabled = false;
                    if (loadingSpinner) loadingSpinner.style.display = 'none';
                }
            });
        });
    </script>



    {{-- PayPal SDK --}}
    {{--    <script --}}
    {{--        src="https://www.paypal.com/sdk/js?client-id=ASLJxakQ3tDRjMUTE90TYOWGAu0kcBpFxzVWvxGkTrUFJ1LQnuIVN3ruZgMOHuYLqRQoz0dDbjZ27oId&currency=USD"> --}}
    {{--    </script> --}}

    <script
        src="https://www.paypal.com/sdk/js?client-id=ASLJxakQ3tDRjMUTE90TYOWGAu0kcBpFxzVWvxGkTrUFJ1LQnuIVN3ruZgMOHuYLqRQoz0dDbjZ27oId&currency=GBP&disable-funding=paylater,card">
    </script>

    <script>
        const btnPayPal = document.querySelector('.checkoutBtn button');
        paypal.Buttons({
            createOrder: function (data, actions) {

                btnPayPal.disabled = true;
                $('#loadingSpinner').show();

                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: '{{ number_format(Cart::getTotal(), 2, '.', '') }}'
                        }
                    }]
                });
            },
            onApprove: function (data, actions) {
                return actions.order.capture().then(function (details) {

                    const form = document.querySelector('#payment-form');
                    const formData = new FormData(form);
                    const formObject = {};
                    formData.forEach((value, key) => {
                        formObject[key] = value;
                    });

                    formObject['transaction_id'] = details.id;
                    formObject['payment_method'] = 'paypal';
                    formObject['amount'] = details.purchase_units[0].amount.value;

                    fetch('{{ route('checkout.process') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                .getAttribute('content')
                        },
                        body: JSON.stringify(formObject)
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                // alert('Payment successful!');
                                window.location.href = '{{ route('checkout.thankyou') }}';
                            } else {
                                alert('Error: ' + (data.error || 'Payment failed.'));
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                        })
                        .finally(() => {
                            btnPayPal.disabled = false;
                            $('#loadingSpinner').hide();
                        });
                });
            },
            onCancel: function (data) {
                btnPayPal.disabled = false;
                $('#loadingSpinner').hide();
            },
            onError: function (err) {
                alert('Error: ' + err);
                btnPayPal.disabled = false;
                $('#loadingSpinner').hide();
            }
        }).render('#paypal-button-container');
    </script>
    <script>
        function startTimer(duration) {
            let timer = duration,
                minutes, seconds;
            let interval = setInterval(function () {
                minutes = Math.floor(timer / 60);
                seconds = timer % 60;

                minutes = minutes < 10 ? "0" + minutes : minutes;
                seconds = seconds < 10 ? "0" + seconds : seconds;

                $("#timer").text(minutes + ":" + seconds);

                if (--timer < 0) {
                    clearInterval(interval);
                    startTimer(duration);
                }
            }, 1000);
        }

        $(document).ready(function () {
            startTimer(15 * 60);
            $("#phone").on("input", function () {
                $(this).val($(this).val().replace(/[^0-9+]/g, ''));
            });
        });
    </script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js" crossorigin="anonymous"
            referrerpolicy="no-referrer"></script>

    <script>
        $(document).ready(function () {
            $('.relatedProducts').slick({
                centerMode: true,
                centerPadding: '60px',
                slidesToShow: 1,
                infinite: true,
                autoplay: true,
                autoplaySpeed: 2500,
                dots: true,
                arrows: false,
                cssEase: 'ease-in-out',
                speed: 600,
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            centerPadding: '40px',
                            slidesToShow: 1
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            centerPadding: '20px',
                            slidesToShow: 1
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            centerPadding: '0px',
                            slidesToShow: 1
                        }
                    }
                ]
            });
        });
    </script>
@endpush
