<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function createOrder(Request $request) {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'cohort_id' => 'nullable|exists:cohorts,id',
            'payment_type' => 'required|in:full,deposit',
        ]);

        $coursePrice = Course::find($request->course_id)->price;
        $amountToPay = $request->payment_type === 'deposit' ? 100 : $coursePrice;

        $order = Order::create([
            'user_id' => auth()->id(),
            'course_id' => $request->course_id,
            'cohort_id' => $request->cohort_id,
            'total_amount' => $coursePrice,
            'amount_paid' => 0,
            'payment_type' => $request->payment_type,
            'status' => 'pending',
        ]);

        // Redirect to payment gateway (Stripe/PayPal)
        return redirect()->route('payment.process', ['order' => $order->id, 'amount' => $amountToPay]);
    }
}
