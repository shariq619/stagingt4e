<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\OrderConfirmationMail;
use App\Mail\ResellerOrderMail;
use App\Models\Cohort;
use App\Models\CourseBundle;
use App\Models\FrontOrderDetails;
use Carbon\Carbon;
use Darryldecode\Cart\CartCondition;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use App\Models\CheckoutDetail;
use App\Models\Course;
use App\Models\FrontOrder;
use App\Models\FrontPayment;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = Cart::getContent();

        // Check if cart is empty
        if ($cart->isEmpty()) {
            return redirect()->route('courses.index'); // Adjust route name as needed
        }

        $futurePayments = 0;
        foreach ($cart as $item) {
            $futurePayments += $item->attributes->remaining_balance * $item->quantity;
        }

        $cartCourses = [];
        foreach ($cart as $item) {
            if (isset($item->attributes['course_id'])) {
                $cartCourses[] = (string) $item->attributes['course_id']; // cast to string because products column stores strings
            }
        }

        $bundles = \App\Models\CourseBundle::where(function ($query) use ($cartCourses) {
            foreach ($cartCourses as $courseId) {
                $query->orWhereJsonContains('products', $courseId);
            }
        })->get();

        return view('frontend.checkout.index', ['cart' => $cart, 'futurePayments' => $futurePayments,  'bundles' => $bundles]);
    }

    public function processPayment(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email',
            'street_address' => 'required|string',
            'city' => 'required|string',
            'postcode' => 'required|string',
            'phone' => 'required|string',
            'attendee_details' => 'required|string',
            'hear_about' => 'required|string',
            'declaration' => 'required|in:yes,no',
            'terms' => 'required|accepted',
            'payment_method' => 'required|string',
        ]);

        $cartItems = \Cart::getContent();
        $totalAmount = \Cart::getTotal();

        try {
            if ($request->payment_method === 'stripe') {
                Stripe::setApiKey(config('services.stripe.secret'));

                // Create PaymentIntent without confirming it here
                $paymentIntent = PaymentIntent::create([
                    'amount' => intval($totalAmount * 100), // Amount in cents
                    'currency' => 'gbp',
                    'payment_method' => $request->payment_method_id,
                    'confirmation_method' => 'manual',
                    'confirm' => true,
                    'return_url' => route('payment.return'),
                ]);

                if ($paymentIntent->status === 'requires_action' &&
                    $paymentIntent->next_action->type === 'use_stripe_sdk') {
                    return response()->json([
                        'requires_action' => true,
                        'payment_intent_client_secret' => $paymentIntent->client_secret,
                    ]);
                } elseif ($paymentIntent->status === 'succeeded') {
                    return $this->handleOrderSuccess($request, $paymentIntent->id, 'stripe');
                } else {
                    return response()->json(['error' => 'Unexpected payment status.']);
                }
            } elseif ($request->payment_method === 'paypal') {
                return $this->handleOrderSuccess($request, $request->transaction_id, 'paypal');
            }

            return response()->json(['error' => 'Invalid payment method']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function handleOrderSuccess($request, $transactionId, $paymentMethod)
    {
        DB::beginTransaction(); // Start the transaction

        try {
            $cartItems = \Cart::getContent();


            foreach ($cartItems as $item) {
                if (
                    isset($item->attributes['formatted_dates']) &&
                    $item->attributes['formatted_dates'] instanceof \App\Models\Cohort
                ) {
                    $resellerId = $item->attributes['formatted_dates']->reseller_id;
                    break; // Use the first cohort’s reseller_id
                }
            }


            $order_status = 'Completed';

            if ($request->remaining_balance > 0) {
                $order_status = 'Partially Paid';
            }

            // Create Order (outside the loop)
            $order = FrontOrder::create([
                'total_amount' => \Cart::getTotal(),
                'payment_method' => $request->payment_method,
                'remaining_balance' => $request->remaining_balance,
                'order_status' => $order_status,
            ]);

            $totalEligibleItems = 0;
            $cctvDiscountAmount = 0;

            foreach ($cartItems as $item) {

                // Create Order Details for each course
                $course = Course::find($item->attributes->get('course_id'));

                if (isset($item->attributes['is_bundle']) && $item->attributes['is_bundle'] == 1) {

                    $course_name = $item->name;
                    $bundle = CourseBundle::where('name', $course_name)->first();
                    $bundle_id = $bundle->id;
                    $courses = json_encode($item->attributes['courses']);

                    FrontOrderDetails::create([
                        'order_id' => $order->id,
                        'is_bundle' => 1,
                        'courses' => $courses,
                        'course_id' => $item->attributes->get('course_id'),
                        'cohort_id' => $item->attributes->get('cohort_id'),
                        'bundle_id' => $bundle_id ?? "",
                        'course_name' => $course_name ?? "",
                        'course_price' => $item->price,
                        'quantity' => $item->quantity,
                        'total_price' => $item->price * $item->quantity,

                        'deposit_paid' => $item->attributes->deposit_paid,
                        'deposit_amount' => $item->attributes->deposit_amount,
                        'remaining_balance' => $item->attributes->remaining_balance
                    ]);

                } elseif (isset($item->attributes['is_bundle']) && $item->attributes['is_bundle'] == 2) {

                    // Product
                    FrontOrderDetails::create([
                        'order_id' => $order->id,
                        'is_bundle' => 2,
                        'product_id' => $item->id,
                        'color_option' => $item->attributes['color_option'] ?? "",
                        'course_name' => $item->name ?? "",
                        'course_price' => $item->price,
                        'quantity' => $item->quantity,
                        'total_price' => $item->price * $item->quantity,
                    ]);

                } else {

                    if (isset($item->attributes['is_elearning']) && $item->attributes['is_elearning'] == 1) {

                        // LEARNING Course

                        FrontOrderDetails::create([
                            'order_id' => $order->id,
                            'course_id' => $item->id,
                            'course_name' => $item->name,
                            'course_price' => $item->price,
                            'quantity' => $item->quantity,
                            'total_price' => $item->price * $item->quantity,
                        ]);

                        // If the course price is above a certain value, apply a discount (example: £10 discount)
                        if (\Cart::getCondition('COUPON_DISCOUNT') && $item->price >= 105) {
                            $totalEligibleItems++;
                        }

                    } else {

                        // Course


                        $course_name = $course->name;


                        // $resellerId = Cohort::find($item->attributes->get('cohort_id'))->reseller_id ?? null;




                        $decemberDiscount = 0;


                        if (\Cart::getCondition('COUPON_DISCOUNT')) {
                            foreach ($cartItems as $item) {
                                // Skip bundles/eLearning if needed
                                if (isset($item->attributes['is_bundle']) && in_array($item->attributes['is_bundle'], [1,2])) {
                                    continue;
                                }

                                // Only eligible items: price >= 105
                                if ($item->price < 105) {
                                    continue;
                                }

                                // Only December courses
                                if (isset($item->attributes['start_date'])) {
                                    $startDate = Carbon::parse($item->attributes['start_date']);
                                    if ($startDate->month === 12) {
                                        $decemberDiscount += $item->price * $item->quantity * 0.10; // 10% discount
                                    }
                                }
                            }
                        }


                        FrontOrderDetails::create([
                            'reseller_id' => $resellerId,
                            'order_id' => $order->id,
                            'is_bundle' => 0,
                            'course_id' => $item->attributes->get('course_id'),
                            'cohort_id' => $item->attributes->get('cohort_id'),
                            'bundle_id' => $bundle_id ?? NULL,
                            'course_name' => $course_name ?? "",
                            'course_price' => $item->price,
                            'quantity' => $item->quantity,
                            'total_price' => $item->price * $item->quantity,
                            'deposit_paid' => $item->attributes->deposit_paid,
                            'remaining_balance' => $item->attributes->remaining_balance,
                        ]);


                    }
                }


            }

            $order->update([
                'discount_amount' => round($decemberDiscount, 2)
            ]);


            // Create Checkout Details (outside the loop)
            CheckoutDetail::create([
                'order_id' => $order->id,
                'first_name' => $request->input('first_name'),
                'last_name' => $request->input('last_name'),
                'email' => $request->input('email'),
                'street_address' => $request->input('street_address'),
                'city' => $request->input('city'),
                'postcode' => $request->input('postcode'),
                'phone' => $request->input('phone'),
                'attendee_details' => $request->input('attendee_details'),
                'hear_about' => $request->input('hear_about'),
                'declaration' => $request->input('declaration') === 'yes' ? 1 : 0,
                'terms' => $request->input('terms') === 'on' ? 1 : 0,
            ]);

            // Create Payment Record (outside the loop)
            FrontPayment::create([
                'order_id' => $order->id,
                'amount' => \Cart::getTotal(), // Total of all courses
                'payment_method' => $paymentMethod,
                'transaction_id' => $transactionId,
                'status' => 'completed'
            ]);
            session()->put('order_id', encrypt($order->id));

            DB::commit(); // Commit the transaction if everything is successful
            \Cart::clear(); // Clear the cart after successful transaction

            \Cart::removeCartCondition('COUPON_DISCOUNT');

            session()->forget('checkout_form_data');


            // Send email to customer
            Mail::to($request->email)->send(new OrderConfirmationMail($order, 'customer'));

            // Send email to admin
            Mail::to(['web@deans-group.co.uk', 'info@training4employment.co.uk'])->send(new OrderConfirmationMail($order, 'admin'));


            if (isset($resellerId)) {
                // Send email to reseller
                $reseller = \App\Models\User::find($resellerId);
                Mail::to([$reseller->email])->send(new ResellerOrderMail($order, 'admin'));

                //  Mail::to($reseller->email)->send(new ResellerOrderMail($order,'reseller'));

            }

            return response()->json(['success' => true]);
        } catch (Exception $e) {
            DB::rollBack(); // Rollback the transaction if any error occurs

            // Log the error message along with the file and line number
            Log::error('Transaction failed: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function handleReturn(Request $request)
    {
        return redirect()->route('checkout.thankyou')->with('success', 'Thank you. Your order has been received.');
    }

    public function thankyou()
    {
        $orderId = session('order_id');
        if (!$orderId) {
            return redirect()->route('home.index')->with('error', 'Invalid Order.');
        }

        try {
            $decryptedOrderId = decrypt($orderId);
        } catch (\Exception $e) {
            return redirect()->route('home.index')->with('error', 'Invalid Order ID.');
        }

        $order = FrontOrder::with('frontOrderDetail', 'checkoutDetail')->find($decryptedOrderId);

        if (!$order) {
            return redirect()->route('home.index')->with('error', 'Order not found.');
        }

        session()->forget('order_id');


        // log

        // Prepare payload for debugging
        $payload = [
            'transaction_id' => $order->id,
            'value' => $order->total_amount,
            'tax' => $order->tax_amount,
            'shipping' => $order->shipping_cost,
            'currency' => 'USD',
            'coupon' => $order->discount_amount,
            'items' => $order->frontOrderDetail->map(function ($item) {
                return [
                    'item_id' => $item->cohort_id,
                    'item_name' => $item->course_name,
                    'price' => (float)$item->total_price,
                    'quantity' => (int)$item->quantity,
                    'item_category' => optional($item->course->category)->name,
                ];
            })->toArray()
        ];

        // ✅ Log to storage/logs/laravel.log
        \Log::info('GA4 Purchase Event Payload:', $payload);


        return view('frontend.checkout.thankyou', compact('order'));
    }

    public function couponCode(Request $request)
    {

        session()->put('checkout_form_data', $request->except('_token', 'coupon_code'));

        $code = $request->coupon_code;

        // First, check if the coupon exists
        $exists = DB::table('subscribers')->where('coupon_code', $code)->exists();

        if (!$exists) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid coupon code.'
            ], 404);
        }

        // Initialize total price of eligible items
        $totalEligiblePrice = 0;

        // Iterate over the cart
        $cart = Cart::getContent();
        foreach ($cart as $item) {

            if (isset($item->attributes['is_bundle']) && in_array($item->attributes['is_bundle'], [1,2])) {
                continue;
            }
            if (isset($item->attributes['is_elearning']) && $item->attributes['is_elearning'] == 1) {
                continue;
            }

            // Only eligible items: price >= 105
            if ($item->price < 105) {
                continue;
            }


            if (isset($item->attributes['start_date'])) {
                $startDate = Carbon::parse($item->attributes['start_date']);

                // Only include December courses
                if ($startDate->month === 12) {
                    $totalEligiblePrice += $item->price * $item->quantity;
                }
            }
        }

        if ($totalEligiblePrice <= 0) {
            return response()->json([
                'success' => false,
                'message' => 'Coupon can only be applied to December courses priced at £105 or above.'
            ], 400);
        }

        // Apply 10% discount on eligible items
        $discount = round($totalEligiblePrice * 0.10, 2); // 10% of eligible price

        // Apply cart condition
        $condition = new CartCondition([
            'name' => 'COUPON_DISCOUNT',
            'type' => 'coupon',
            'target' => 'total',
            'value' => -$discount, // negative to subtract from total
            'attributes' => [
                'code' => $code,
                'discount_type' => 'percentage',
                'eligible_amount' => $totalEligiblePrice
            ]
        ]);

        \Cart::condition($condition);

        return response()->json([
            'success' => true,
            'message' => 'Coupon applied successfully! 10% discount applied to December courses.'
        ], 200);

    }

    public function removeCoupon()
    {
        \Cart::removeCartCondition('COUPON_DISCOUNT');
        return back()->with('success', 'Coupon removed.');
    }

}
