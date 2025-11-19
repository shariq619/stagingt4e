<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\FrontOrder;
use App\Models\User;
use App\Models\Venue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Stripe\Refund;
use Stripe\Stripe;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = FrontOrder::with('frontOrderDetail', 'checkoutDetail', 'frontOrderDetail.reseller');

        // Month filter
        if ($request->filled('month')) {
            $month = $request->input('month');
            $orders->whereMonth('created_at', date('m', strtotime($month)))
                ->whereYear('created_at', date('Y', strtotime($month)));
        }

        // Reseller filter
        if ($request->filled('reseller_id')) {
            $orders->whereHas('frontOrderDetail', function ($q) use ($request) {
                $q->where('reseller_id', $request->reseller_id);
            });
        }

        // Get total amount for filtered results
        $totalAmount = $orders->sum('total_amount');

        // Pagination
        $orders = $orders->orderBy('created_at', 'desc')->paginate(15);

        // Pass resellers list to view for dropdown
        $resellers = User::role('Reseller')->get();

        return view('backend.orders.index', compact('orders', 'totalAmount', 'resellers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(FrontOrder $order)
    {
        $order->load('frontOrderDetail', 'checkoutDetail', 'front_payment');
        return view('backend.orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function updateStatus(FrontOrder $order, Request $request)
    {
        $order->update([
            'order_status' => $request->order_status
        ]);
        return redirect()->back()->with('success', 'Order status updated successfully.');
    }

    public function refund(Request $request, FrontOrder $order)
    {
        $request->validate([
            'admin_password' => 'required|string',
        ]);

        // Check the admin password
        if (!Hash::check($request->admin_password, config('refund.master_password_hash'))) {
            return back()->with('error', 'Invalid password. Refund aborted.');
        }

        $newStatus = 'Refund';

        try {
            Stripe::setApiKey(config('services.stripe.secret'));


            $payment = $order->front_payment;

            if ($payment && $payment->payment_method === 'stripe') {
                $refund = Refund::create([
                    'payment_intent' => $payment->transaction_id, // This is the PaymentIntent ID
                    'amount' => intval($payment->amount * 100), // amount in pence
                ]);

                $payment->update([
                    'status' => 'Refund',
                ]);

                $order->update([
                    'order_status' => $newStatus,
                    'user_id' => auth()->user()->id,
                ]);


            }

            // If using other gateways (like PayPal), handle their refunds here

        } catch (\Exception $e) {
            return back()->with('error', 'Refund failed: ' . $e->getMessage());
        }

        return back()->with('success', 'Order refunded updated successfully.');
    }

}
