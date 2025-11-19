<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\FrontPayment;
use App\Models\Order;
use Illuminate\Http\Request;
use Stripe\Charge;
use Stripe\Stripe;

class FrontPaymentController extends Controller
{
    public function processPayment(Request $request)
    {
        $request->validate([
            'order_id'       => 'required|exists:orders,id',
            'payment_method' => 'required|in:stripe,paypal',
            'amount'         => 'required|numeric',
        ]);

        $order = Order::findOrFail($request->order_id);
        $amount = $request->amount;

        if ($request->payment_method === 'stripe') {
            return $this->processStripePayment($request, $order, $amount);
        } elseif ($request->payment_method === 'paypal') {
            return $this->processPayPalPayment($request, $order, $amount);
        }

        return response()->json(['error' => 'Invalid payment method']);
    }

    private function processStripePayment(Request $request, $order, $amount)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            $charge = Charge::create([
                'amount'      => $amount * 100,  // Convert to cents
                'currency'    => 'usd',
                'description' => "Payment for Course ID: {$order->course_id}",
                'source'      => $request->stripeToken,
            ]);

            FrontPayment::create([
                'order_id'       => $order->id,
                'amount'         => $amount,
                'payment_method' => 'stripe',
                'transaction_id' => $charge->id,
                'status'         => 'completed',
            ]);

            return $this->updateOrderStatus($order, $amount);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Payment failed: ' . $e->getMessage()]);
        }
    }

    private function processPayPalPayment(Request $request, $order, $amount)
    {
        $request->validate([
            'transaction_id' => 'required|string',
            'payer_email'    => 'required|email',
        ]);

        FrontPayment::create([
            'order_id'       => $order->id,
            'amount'         => $amount,
            'payment_method' => 'paypal',
            'transaction_id' => $request->transaction_id,
            'status'         => 'completed',
        ]);

        return $this->updateOrderStatus($order, $amount);
    }

    private function updateOrderStatus($order, $amount)
    {
        $order->amount_paid += $amount;

        if ($order->amount_paid >= $order->total_amount) {
            $order->status = 'completed';
        } else {
            $order->status = 'partially_paid';
        }

        $order->save();

        return response()->json(['success' => true, 'order_status' => $order->status]);
    }
}
