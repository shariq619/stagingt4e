<!DOCTYPE html>
<html>
<head>
    <title>Order Confirmation</title>
</head>
<body>
<h2>Thank you for your order, {{ $order->checkoutDetail->first_name }} {{ $order->checkoutDetail->last_name }}!</h2>
<p>Your order has been successfully placed.</p>

<p><strong>Payment Method:</strong> {{ ucfirst($order->payment_method) }}</p>

@if($order->discount_amount > 0)
    <p><strong>Discount:</strong> £-{{ $order->discount_amount ?? 0 }}</p>
@endif

<p><strong>Total Amount:</strong> £{{ number_format($order->total_amount, 2) }}</p>
<p><strong>Remaining Amount:</strong> £{{ number_format($order->remaining_balance, 2) }}</p>

<h3>Order Date: {{ \Carbon\Carbon::parse($order->created_at)->format('jS M Y') }}</h3>
<table border="1" cellpadding="5" cellspacing="0">
    <thead>
    <tr>
        <th>Course</th>
        <th>Price</th>
        <th>Remaining Balance</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($order->frontOrderDetail as $item)
        <!-- Course Bundle -->
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
            <!-- Product -->
        @elseif($item->is_bundle == 2)
            <tr>
                <td>{{ $item->course_name ?? "Product" }} - {{ $item->color_option ?? "" }}</td>
                <td>£{{ number_format($item->course_price * $item->quantity, 2) }}</td>
                <td>£{{ number_format($item->remaining_balance, 2) }}</td>
            </tr>
            <!-- Courses -->
        @else
            <!-- E lEARNING Courses -->
            @if($item->course->category->id == 7)
                <tr>
                    <td>{{ $item->course_name ?? "Product" }}</td>
                    <td>£{{ number_format($item->course_price * $item->quantity, 2) }}</td>
                    <td>£{{ number_format($item->remaining_balance, 2) }}</td>
                </tr>
                <!-- Normal Courses -->
            @else
                <tr>
                    <td>
                        {{ $item->course->name ?? "" }}
                        <br>
                        <small>
                            <strong>
                                📅 {{ formatCourseDate($item->cohort) }}
                                <br>
                                📍 {{ $item->cohort->venue->venue_name ?? "" }}
                            </strong>
                        </small>
                    </td>
                    <td>£{{ number_format($item->course_price * $item->quantity, 2) }}</td>
                    <td>£{{ number_format($item->remaining_balance, 2) }}</td>
                </tr>
            @endif
        @endif
    @endforeach
    </tbody>
</table>

<p><strong>Declaration:</strong> I understand and confirm that I will complete the required self-study and e-learning activities prior to the start of the course

<p><strong>How did you hear about us?:</strong> {{ $order->checkoutDetail->hear_about }}

<p><strong>Attendee name(s) and contact details (email address and mobile phone):</strong> {{ $order->checkoutDetail->attendee_details }}

<h3>Billing Information:</h3>
<p><strong>Email:</strong> {{ $order->checkoutDetail->email }}</p>
<p><strong>Phone:</strong> {{ $order->checkoutDetail->phone }}</p>
<p><strong>Address:</strong> {{ $order->checkoutDetail->street_address }}, {{ $order->checkoutDetail->city }}
    , {{ $order->checkoutDetail->postcode }}</p>
<p><strong>Attendee Details:</strong> {{ $order->checkoutDetail->attendee_details }}</p>

<p>Thank you for shopping with us!</p>
</body>
</html>
