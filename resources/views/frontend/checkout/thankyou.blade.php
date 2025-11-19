@extends('layouts.frontend')
@section('title', 'Order - Thank you')

@section('main')

    <div class="pageTitleTop pyxl-5">
        <div class="container">
            <h1 class="text-center">{{ __('Thank you') }}</h1>
        </div>
    </div>
    <div class="container">
        <p class="my-5">{{ __('Thank you. Your order has been received.') }}</p>
        <div class="row">
            <div class="col-12 col-md-4">
                <div class="thankYouMsg">
                    <ul>
                        <li>
                            <strong>{{ __('Order Number') }}</strong>: <span
                                style="border-bottom:solid 1px #000;font-weight:500;">#{{ $order->id }}</span>
                        </li>
                        <li>
                            <strong>{{ __('Order Date') }}</strong>: <span
                                style="border-bottom:solid 1px #000;font-weight:500;">{{ \Carbon\Carbon::parse($order->created_at)->format('jS M Y') }}</span>
                        </li>
                        <li>
                            <strong>{{ __('Order Total') }}</strong>: <span
                                style="border-bottom:solid 1px #000;font-weight:500;">£{{ $order->total_amount }}</span>
                        </li>
                        <li>
                            <strong>{{ __('Payment Method') }}</strong>: <span
                                style="border-bottom:solid 1px #000;font-weight:500;">{{ Str::ucfirst($order->payment_method) }}</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <dl class="customer_details">
                    <dt>{{ __('Email') }}:</dt>
                    <dd>{{ $order->checkoutDetail->email }}</dd>
                    <dt>{{ __('Phone') }}:</dt>
                    <dd>{{ $order->checkoutDetail->phone }}</dd>
                </dl>
            </div>
            <div class="col-12 col-md-4">
                <dt>{{ __('Address') }}:</dt>
                <address>
                    <p>{{ $order->checkoutDetail->street_address }}<br>{{ $order->checkoutDetail->postcode }}
                        <br>{{ $order->checkoutDetail->city }}
                    </p>
                </address>
            </div>

            <div class="col-12 col-md-12">
                <div class="orderDetails">
                    <h2 class="mb-4">{{ __('Attendee Details') }}</h2>
                    <div class="col-12 col-md-4">
                        <address>
                            {{ $order->checkoutDetail->attendee_details }}
                            </p>
                        </address>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-12 my-5">
                <div class="orderDetails">
                    <h2 class="mb-4">{{ __('Order Details') }}</h2>
                    <table class="table">
                        <thead>
                        <tr>
                            <th>{{ __('Product') }}</th>
                            {{--<th>{{ __('Quantity') }}</th>--}}
                            <th>{{ __('Price') }}</th>
                            <th>{{ __('Remaining') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($order->frontOrderDetail as $item)
                            @if($item->is_bundle == 1)

                                @php
                                    $coursesArray = json_decode($item->courses, true);
                                    $courses = json_decode(json_encode($coursesArray)); // Convert array to object
                                @endphp

                                <tr>
                                    <td>
                                        <strong>{{ $item->course_name ?? "" }}</strong> <!-- Display bundle name -->
                                        @if (!empty($courses))

                                            <ul class="list-unstyled mt-2">
                                                @foreach ($courses as $course)
                                                    <li>
                                                        <strong>{{ $course->course_name }}</strong><br>

                                                        {{--📅 {{ $course['start_date'] }} - {{ $course['end_date'] }}<br>--}}

                                                        📅 {{ formatCourseDate($course) }}<br>

                                                        📍 {{ $course->venue }}
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </td>
                                    {{--<td>{{ $item->quantity }}</td>--}}
                                    <td>£{{ number_format($item->course_price * $item->quantity, 2) }}</td>
                                    <td>£{{ number_format($item->remaining_balance, 2) }}</td>
                                </tr>
                            @elseif($item->is_bundle == 2)

                                <tr>
                                    <td>
                                        {{ $item->product->name  }} @if($item->color_option)<span class="text-muted">({{ $item->color_option ?? "" }})</span>@endif
                                    </td>
                                    {{--<td>{{ $item->quantity }}</td>--}}
                                    <td>£{{ $item->course_price * $item->quantity }}</td>
                                    <td>£{{ number_format($item->remaining_balance, 2) }}</td>
                                </tr>

                            @else

                                @if($item->course->category->id == 7)


                                    <tr>
                                        <td>
                                            {{ $item->course->name ?? "" }}
                                        </td>
                                        {{--<td>{{ $item->quantity }}</td>--}}
                                        <td>£{{ $item->course_price * $item->quantity }}</td>
                                        <td>£{{ number_format($item->remaining_balance, 2) }}</td>
                                    </tr>

                                @else


                                    <tr>
                                        <td>
                                            {{ $item->course->name ?? "" }}
                                            <br>
                                            <small>
                                                <strong>
{{--                                                    📅 {{ \Carbon\Carbon::parse($item->cohort->start_date_time)->format('jS M Y, g:i A') }}--}}
{{--                                                    ---}}
{{--                                                    {{ \Carbon\Carbon::parse($item->cohort->end_date_time)->format('jS M Y, g:i A') }}--}}

                                                    📅 {{ formatCourseDate($item->cohort) }}

                                                    <br>
                                                    📍 {{ $item->cohort->venue->venue_name ?? "" }}
                                                </strong>
                                            </small>
                                        </td>
                                        {{--<td>{{ $item->quantity }}</td>--}}
                                        <td>£{{ $item->course_price * $item->quantity }}</td>
                                        <td>£{{ number_format($item->remaining_balance, 2) }}</td>
                                    </tr>

                                @endif



                            @endif
                        @empty
                        @endforelse
                        </tbody>
                        <tfoot>
                        @if($order->discount_amount > 0)
                            <tr>
                                <th>{{ __('Discount') }}</th>
                                <td><strong>£-{{ $order->discount_amount ?? 0 }}</strong></td>
                            </tr>
                        @endif
                        <tr>
                            <th> {{ __('Total') }} </th>
                            <td><strong>£{{ $order->total_amount }}</strong></td>
                        </tr>
                        <tr>
                            <th> {{ __('Remaining Balance') }} </th>
                            <td><strong>£{{ $order->remaining_balance }}</strong></td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
                <a href="{{route('home.index')}}" class="d-inline-block btn btn-primary mt-4">Back</a>
            </div>
        </div>
    </div>
    </div>
@endsection
@push('css')
    <style>
        .orderDetails table {
            border: solid 1px #ddd;
        }

        .orderDetails table tr {
            border-bottom: solid 1px #ddd;
        }
    </style>
@endpush
@push('js')
    <script>
        window.dataLayer = window.dataLayer || [];

        const purchaseEvent = {
            event: "purchase",
            ecommerce: {
                transaction_id: "{{ $order->id }}",
                affiliation: "Online Store",
                value: {{ $order->total_amount }},
                tax: {{ $order->tax_amount }},
                shipping: {{ $order->shipping_cost }},
                currency: "GBP",
                coupon: "{{ $order->discount_amount ?? '' }}",
                items: [
                        @foreach($order->frontOrderDetail as $item)
                    {
                        item_id: "{{ $item->cohort_id }}",
                        item_name: "{{ $item->course_name }}",
                        price: {{ $item->total_price }},
                        quantity: {{ $item->quantity }},
                        item_category: "{{ $item->course->category->name ?? '' }}"
                    }@if(!$loop->last),@endif
                    @endforeach
                ]
            }
        };

        // ✅ Debug in console
        console.log("Purchase Event Payload:", purchaseEvent);

        // Push to dataLayer
        window.dataLayer.push(purchaseEvent);
    </script>
@endpush
