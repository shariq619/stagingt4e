@php use App\Models\Cohort; @endphp
@extends('layouts.frontend')
@section('title', 'Basket')

@section('main')
    <div class="pageTitleTop pyxl-5">
        <div class="container">
            <h1 class="text-center">Cart</h1>
        </div>
    </div>
    <section class="pyxl-5 cartBanner">
        <div class="container">
            <div class="row flex-column-reverse flex-md-row flex-lg-row flex-xl-row">
                @if ($cart->isEmpty())
                    <div class="cartTtotalBalance text-center w-100" style="box-shadow: unset;">
                        <p class="text-center mb-4"><strong>Your cart is empty.</strong></p>
                        <a class="d-inline-block m-auto" style="display: inline !important;"
                            href="{{ route('courses.index') }}">Return to Courses</a>
                    </div>
                @else
                    <div class="col-12 col-md-8 col-lg-9">
                        @if (session('success'))
                            <p
                                style="background-color: #28a745;border-color: #23923d;color: #fff;padding: 10px 10px;border-radius: 5px;">
                                {{ session('success') }}
                            </p>
                        @endif


                        @foreach (Cart::getContent() as $item)
                            @if (isset($item->attributes['is_bundle']) && $item->attributes['is_bundle'] == 1)
                                <!-- Bundle Display -->
                                <div class="bundle-item p-3 border rounded mb-3">
                                    <h4 class="font-weight-bold">{{ $item->name }}</h4>
                                    <p><strong>Bundle Price:</strong> £{{ number_format($item->price, 2) }}</p>

                                    <ul class="list-unstyled">
                                        @foreach ($item->attributes['courses'] as $course)
                                            <li class="mb-2">
                                                <strong>{{ $course->course_name }}</strong><br>
                                                {{-- 📅 {{ $course['start_date'] }} - {{ $course['end_date'] }}<br> --}}

                                                📅 {{ formatCourseDate($course) }} <br>

                                                📍 Venue: {{ $course->venue }}
                                            </li>
                                        @endforeach
                                    </ul>
                                    <p>{{ $item->attributes['custom_fields'] }}</p>
                                </div>
                            @elseif (isset($item->attributes['is_bundle']) && $item->attributes['is_bundle'] == 2)
                                <!-- Product -->
                                <div class="bundle-item p-3 border rounded mb-3">
                                    <h4 class="font-weight-bold">{{ $item->name }} @if($item->attributes['color_option'])<span class="text-muted">({{ $item->attributes['color_option'] }})</span>@endif</h4>
                                    <p class="text-muted">Price: <strong>£{{ number_format($item->price, 2) }}</strong></p>
                                </div>
                            @else
                                @if (isset($item->attributes['is_elearning']) && $item->attributes['is_elearning'])
                                    <!-- ELEARNING -->
                                    <div class="single-item p-3 border rounded mb-3">
                                        <h4>{{ $item->name }} </h4>
                                        <p>Price: £{{ number_format($item->price, 2) }}</p>
                                    </div>
                                @else
                                    <!-- Single Course Display -->
                                    <div class="single-item p-3 border rounded mb-3">
                                        <h4>{{ $item->name }}</h4>
                                        <p><strong>Price:</strong> £{{ number_format($item->price, 2) }}</p>
                                        <p><strong>Quantity:</strong> {{ $item->quantity }}</p>
                                        <ul class="list-unstyled">

                                            <li class="mb-2">

                                                📅 {{ formatCourseDate($item->attributes->formatted_dates) }} <br>
                                                @php
                                                    $cohort = Cohort::find($item->attributes->cohort_id);
                                                    $venueName = $cohort
                                                        ? $cohort->venue->venue_name
                                                        : 'Venue not available';
                                                @endphp
                                                📍 {{ $venueName }}

                                            </li>

                                            @if(isset($item->attributes['custom_fields']))
                                                <p class="text-danger">Please indicate what type of First Aid qualification you currently hold or going to obtain as per SIA requirements:</p>
                                                <li>
                                                    {{ $item->attributes['custom_fields'] }} ✔️
                                                </li>
                                            @endif




                                        </ul>
                                    </div>
                                @endif
                            @endif
                        @endforeach

                        <div class="btnClear mt-5 text-right">


                            <form action="{{ route('cart.clear') }}" method="POST">
                                @csrf
                                <span class="text-muted" style="cursor: pointer;" onclick="this.closest('form').submit();">Empty cart</span>
                            </form>



                        </div>
                    </div>
                    <div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-0 mb-lg-0 mb-xl-0">
                        <div class="cartTtotalBalance">
                            <p><strong>Subtotal:</strong> £{{ number_format(Cart::getSubTotal(), 2) }}</p>
                            <p><strong>Due Today:</strong> £{{ number_format(Cart::getTotal(), 2) }}</p>

                            <!-- Display Future Payments -->
                            <p><strong>Future Payments:</strong> £{{ number_format($futurePayments, 2) }}</p>

                            <a  type="button" role="tab" class="d-inline-block" href="{{ route('checkout.index') }}">Proceed to Checkout</a>



                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection
