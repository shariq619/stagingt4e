@extends('layouts.main')

@section('title', 'Order Detail')
@section('main')
    <div class="row">
        {{-- @dd($order->courseMany ) --}}
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        Order #{{ $order->id }} details

                        <span class="badge
                            @if($order->order_status == 'Completed') badge-success
                            @elseif($order->order_status == 'Processing') badge-primary
                            @elseif($order->order_status == 'Partially Paid') badge-warning
                            @elseif($order->order_status == 'Refund') badge-danger
                            @elseif($order->order_status == 'Cancelled') badge-dark
                            @else badge-secondary
                            @endif">
                            {{ $order->order_status }}
                        </span>

                        <br>

                        <small class="text-muted">
                            Status updated by
                            <strong>{{ $order->user->name ?? 'User #' . $order->user_id }}</strong>
                            at {{ $order->updated_at->format('d M Y, Hi') }}
                        </small>

                    </h3>
                </div>
                <div class="card-body">
                    <div class="card-tools">
                        @php
                            $paymentDate = $order->front_payment;
                        @endphp
                        <p>Payment Method {{ ucfirst($order->payment_method) }} -
                            <u>{{ $order->front_payment->transaction_id ?? '' }}</u>, Paid on
                            {{ \Carbon\Carbon::parse($paymentDate->created_at)->format('d M Y, Hi') ?? '' }}
                        </p>
                        <div class="paymentStatus">
                            @if (session()->has('success'))
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="alert alert-success alert-dismissible">
                                            <button type="button" class="close" data-dismiss="alert"
                                                    aria-hidden="true">×
                                            </button>
                                            {{ session('success') }}
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if (session()->has('error'))
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="alert alert-danger alert-dismissible">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                                                ×
                                            </button>
                                            {{ session('error') }}
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if ($order->order_status != 'Refund')
                                <form action="{{ route('backend.order.update.status', $order->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="d-flex align-items-center">
                                        <select name="order_status" class="form-control mr-2">
                                            <option
                                                value="Processing" {{ $order->order_status == 'Processing' ? 'selected' : '' }}>
                                                Processing
                                            </option>
                                            <option
                                                value="Partially Paid" {{ $order->order_status == 'Partially Paid' ? 'selected' : '' }}>
                                                Partially Paid
                                            </option>
                                            <option
                                                value="Completed" {{ $order->order_status == 'Completed' ? 'selected' : '' }}>
                                                Completed
                                            </option>
                                            {{--                                        @if ($order->order_status === 'Completed')--}}
                                            {{--                                            <option value="Refund" {{ $order->order_status == 'Refund' ? 'selected' : '' }}>Refund</option>--}}
                                            {{--                                        @endif--}}

                                        </select>
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </form>
                            @endif


                            @if($order->order_status === 'Completed')
                                <button class="btn btn-danger mt-4" data-toggle="modal" data-target="#refundModal">
                                    Issue Refund
                                </button>
                            @endif


                        </div>
                        <div class="row mt-5">
                            <div class="col-md-4">
                                <div class="formBilling">
                                    <h3 class="mb-5">
                                        <strong>Billing</strong>
                                    </h3>
                                    <p>
                                        <strong>Name</strong> <br>
                                        <span>{{ $order->checkoutDetail->first_name . ' ' . $order->checkoutDetail->last_name }}</span>
                                    </p>
                                    <p>
                                        <strong>City</strong> <br>
                                        <span>{{ $order->checkoutDetail->city }}</span><br>
                                        <strong>Address</strong> <br>
                                        <span>{{ $order->checkoutDetail->street_address }}</span>
                                    </p>
                                    <p>
                                        <strong>Email address</strong> <br>
                                        <span>{{ $order->checkoutDetail->email }}</span>
                                    </p>
                                    <p>
                                        <strong>Phone</strong> <br>
                                        <span>{{ $order->checkoutDetail->phone }}</span>
                                    </p>
                                    <p>
                                        <strong>Attendee Details</strong> <br>
                                        <span>{{ $order->checkoutDetail->attendee_details }}</span>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="productByOrderId">
                                    <h3 class="mb-5">
                                        <strong>Product</strong>
                                    </h3>
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Cost</th>
                                            <th>Qty</th>
                                            <th>Remaining</th>
                                            <th>Total</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($order->frontOrderDetail as $detail)
                                            @if($detail->is_bundle == 1)

                                                @php
                                                    $coursesArray = json_decode($detail->courses, true);
                                                    $courses = json_decode(json_encode($coursesArray)); // Convert array to object
                                                @endphp

                                                <tr>
                                                    <td>
                                                        <h4 class="mb-4">{{ $detail->course_name ?? '' }}</h4>

                                                        @if (!empty($courses))

                                                            <ul class="list-unstyled mt-2">
                                                                @foreach ($courses as $course)
                                                                    <li>
                                                                        <strong>{{ $course->course_name }}</strong><br>

                                                                        📅 {{ formatCourseDate($course) }}<br>

                                                                        {{--📅 {{ $course['start_date'] }}
                                                                        - {{ $course['end_date'] }}<br>--}}

                                                                        📍 {{ $course->venue }}
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        @endif
                                                    </td>
                                                    <td>£{{ $detail->total_price ?? '' }}</td>
                                                    <td>{{ $detail->quantity }}</td>
                                                    <td>£{{ number_format($detail->remaining_balance, 2) }}</td>
                                                    <td>
                                                        £{{ number_format($detail->course_price * $detail->quantity, 2) }}</td>
                                                </tr>

                                            @elseif($detail->is_bundle == 2)

                                                <tr>
                                                    <td>
                                                        {{ $detail->product->name  }}
                                                    </td>
                                                    <td>£{{ $detail->course_price * $detail->quantity }}</td>
                                                    <td>{{ $detail->quantity }}</td>
                                                    <td>£{{ number_format($detail->remaining_balance, 2) }}</td>
                                                    <td>£{{ $detail->course_price * $detail->quantity }}</td>
                                                </tr>

                                            @else

                                                @if($detail->course->category->id == 7)

                                                    <tr>
                                                        <td>
                                                            {{ $detail->course->name ?? "" }}
                                                        </td>
                                                        <td>£{{ $detail->course_price * $detail->quantity }}</td>
                                                        <td>{{ $detail->quantity }}</td>
                                                        <td>£{{ number_format($detail->remaining_balance, 2) }}</td>
                                                        <td>£{{ $detail->course_price * $detail->quantity }}</td>
                                                    </tr>

                                                @else

                                                    <tr>
                                                        <td>
                                                            <h4 class="mb-4">{{ $detail->course->name ?? '' }}</h4>
                                                            <p class="border-bottom pb-2 mb-2"><strong>📍</strong>
{{--                                                                <span>{{ $detail->course->cohort->venue->venue_name }}</span>--}}
                                                                <span>{{ $detail->cohort->venue->venue_name }}</span>
                                                            </p>
                                                            <p class="m-0">
                                                                <strong>📅</strong>
                                                                {{--                                                                {{ \Carbon\Carbon::parse($detail->course->cohort->start_date_time)->format('jS M Y, g:i A') }}--}}
                                                                {{--                                                                ---}}
                                                                {{--                                                                {{ \Carbon\Carbon::parse($detail->course->cohort->end_date_time)->format('jS M Y, g:i A') }}--}}


                                                                {{ formatCourseDate($detail->cohort) }}

                                                            </p>
                                                        </td>
                                                        <td> £{{ $detail->course->price ?? '' }}</td>
                                                        <td> {{ $detail->quantity ?? '' }}</td>
                                                        <td>£{{ number_format($detail->remaining_balance, 2) }}</td>
                                                        <td> £{{ $detail->total_price ?? '' }}</td>
                                                    </tr>

                                                @endif
                                            @endif
                                        @empty
                                            <tr>
                                                <td colspan="9" class="text-right">No order found.</td>
                                            </tr>
                                        @endforelse
                                        <tr>
                                            <td colspan="9" class="text-right"><strong>Discount</strong>:
                                                £-{{ $order->discount_amount ?? 0  }}</td>

                                        </tr>
                                        <tr>
                                            <td colspan="9" class="text-right"><strong>Total Amount</strong>:
                                                £{{ number_format($order->total_amount,2)  }}</td>

                                        </tr>
                                        <tr>

                                            <td colspan="9" class="text-right"><strong>Remaining Amount</strong>:
                                                £{{ number_format($order->remaining_balance, 2) }}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- Refund Confirmation Modal -->
    <div class="modal fade" id="refundModal" tabindex="-1" aria-labelledby="refundModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('backend.order.refund', $order->id) }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title" id="refundModalLabel">Confirm Refund</h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Please enter your password to confirm the refund for Order #{{ $order->id }}.</p>
                        <input type="password" name="admin_password" class="form-control" placeholder="Password"
                               required>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">Confirm Refund</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
