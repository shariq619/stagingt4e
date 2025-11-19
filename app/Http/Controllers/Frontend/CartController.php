<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cohort;

use App\Models\Course;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Illuminate\Http\Request;
use stdClass;

class CartController extends Controller
{
    public function index()
    {
        $cart = Cart::getContent();

        $futurePayments = 0;
        foreach ($cart as $item) {
            $futurePayments += $item->attributes->remaining_balance * $item->quantity;
        }

        return view('frontend.cart.index',
            [
                'cart' => $cart,
                'futurePayments' => $futurePayments
            ]);
    }

    public function add(Request $request)
    {

        if ($request->is_bundle == 1) {

            return $this->addBundleToCart($request);

        } elseif ($request->is_bundle == 2) {

            return $this->addProductToCart($request);

        } else {

            if($request->is_elearning){

                // E-Learning COURSES

                Cart::add([
                    'id' => $request->course_id,
                    'name' => $request->course_name,
                    'price' => $request->course_price,
                    'quantity' => 1,
                    'attributes' => [
                        'is_elearning' => 1,
                        'custom_fields' => $request->custom_fields
                    ]
                ]);

            } else {


                // COURSES
                $cohort = Cohort::with('course')->findOrFail($request->cohort_id);

                $coursePrice = (float) $cohort->course->price;
                $isReseller  = !empty($cohort->reseller_id);

                // For reseller, always treat as deposit (no full payment allowed)
                $isDeposit = $isReseller ? true : ($request->deposit_option === 'deposit');

                if ($isReseller) {
                    // 30% deposit for reseller cohorts
                    $depositAmount = round($coursePrice * 0.30, 2);
                    if ($depositAmount <= 0) {
                        // safety fallback
                        $depositAmount = $coursePrice;
                    }
                } else {
                    // Original logic for non-reseller: deposit = min(£100, full price)
                    $depositAmount = $isDeposit ? min(100, $coursePrice) : $coursePrice;
                }

                $remainingAmount = $isDeposit
                    ? max($coursePrice - $depositAmount, 0)
                    : 0;

                // Create a unique ID by combining cohort_id
                $cartItemId = 'cartForm_' . $cohort->id;

                $additionalTimes = json_decode($cohort->additional_times, true);
                $secondStartTime = isset($additionalTimes['second_start_time'])
                    ? \Carbon\Carbon::createFromFormat('H:i', $additionalTimes['second_start_time'])->format('g:i A')
                    : null;
                $secondEndTime = isset($additionalTimes['second_end_time'])
                    ? \Carbon\Carbon::createFromFormat('H:i', $additionalTimes['second_end_time'])->format('g:i A')
                    : null;

                Cart::add([
                    'id'       => $cartItemId,  // Unique identifier
                    'name'     => $request->course_name,
                    'price'    => $depositAmount,
                    'quantity' => 1,
                    'attributes' => [
                        'course_id'         => $cohort->course->id,
                        'cohort_id'         => $request->cohort_id,
                        'start_date'        => $request->start_date,
                        'end_date'          => $request->end_date,
                        'additional_times'  => $secondStartTime . ' - ' . $secondEndTime,
                        'formatted_dates'   => $cohort,
                        'original_price'    => $coursePrice,
                        'deposit_paid'      => $isDeposit ? true : false,
                        'deposit_amount'    => $depositAmount,
                        'remaining_balance' => $remainingAmount,
                        'is_reseller'       => $isReseller,
                        'reseller_id'       => $cohort->reseller_id,
                        'custom_fields'     => $request->custom_fields,
                    ],
                ]);

                // COURSES

//                $cohort = Cohort::findOrFail($request->cohort_id);
//                $isDeposit = $request->deposit_option === 'deposit';
//                $coursePrice = $cohort->course->price;
//                $depositAmount = $isDeposit ? min(100, $coursePrice) : $coursePrice; // Use £100 or course price
//                $remainingAmount = $isDeposit ? ($coursePrice - $depositAmount) : 0; // Calculate remaining balance
//                // Create a unique ID by combining cohort_id
//                $cartItemId = 'cartForm_' . $cohort->id;
//                $additionalTimes = json_decode($cohort->additional_times, true);
//                $secondStartTime = isset($additionalTimes['second_start_time'])
//                    ? \Carbon\Carbon::createFromFormat('H:i', $additionalTimes['second_start_time'])->format('g:i A')
//                    : null;
//                $secondEndTime = isset($additionalTimes['second_end_time'])
//                    ? \Carbon\Carbon::createFromFormat('H:i', $additionalTimes['second_end_time'])->format('g:i A')
//                    : null;
//
//                Cart::add([
//                    'id' => $cartItemId,  // Unique identifier
//                    'name' => $request->course_name,
//                    'price' => $depositAmount,
//                    'quantity' => 1,
//                    'attributes' => [
//                        'course_id' => $cohort->course->id,
//                        'cohort_id' => $request->cohort_id,
//                        'start_date' => $request->start_date,
//                        'end_date' => $request->end_date,
//                        'additional_times' => $secondStartTime.' - '.$secondEndTime,
//                        'formatted_dates' => $cohort,
//                        'original_price' => $cohort->course->price,
//                        'deposit_paid' => $isDeposit ? true : false,
//                        'deposit_amount' => $depositAmount,
//                        'remaining_balance' => $remainingAmount,
//                        'custom_fields' => $request->custom_fields
//                    ]
//                ]);

            }




            return redirect()->route('checkout.index')->with('success', 'Course has been added to your basket.');
        }
    }

    private function addBundleToCart(Request $request)
    {

       // dd($request->toArray());

        $bundleName = $request->bundle_name;
        $bundlePrice = $request->bundle_price;
        $selectedCohorts = $request->cohort_ids; // Array [course_id => cohort_id]

        if (!$selectedCohorts || empty($selectedCohorts)) {
            return redirect()->back()->with('error', 'Please select cohorts for all courses in the bundle.');
        }

        // Generate a unique ID for the bundle
        $cartItemId = 'bundle-' . md5(implode('-', array_values($selectedCohorts)));

        // Fetch cohort details along with their related course and venue
        $cohorts = Cohort::whereIn('id', array_values($selectedCohorts))
            ->with(['course', 'venue'])
            ->get();

        $courseDetails = [];

        foreach ($cohorts as $cohort) {
            $courseDetail = new stdClass();
            $courseDetail->course_name = $cohort->course->name;
            $courseDetail->start_date_time = $cohort->start_date_time;
            $courseDetail->end_date_time = $cohort->end_date_time;
            $courseDetail->additional_times = $cohort->additional_times;
            $courseDetail->venue = $cohort->venue->venue_name ?? 'Venue not assigned';

            $courseDetails[] = $courseDetail; // Add the object to the array
        }

        // Add the bundle as a single cart item
        Cart::add([
            'id' => $cartItemId,
            'name' => $bundleName,
            'price' => $bundlePrice,
            'quantity' => 1,
            'attributes' => [
                'is_bundle' => true,
                'original_price' => $bundlePrice,
                'courses' => $courseDetails,
                'custom_fields' => $request->custom_fields
            ]
        ]);

        return redirect()->route('checkout.index')->with('success', 'Course bundle has been added to your basket.');
    }

    private function addProductToCart(Request $request)
    {
        $product_id = $request->product_id;
        $product_name = $request->product_name;
        $product_price = $request->product_price;
        $color_option = $request->color_option;

        // Add the bundle as a single cart item
        Cart::add([
            'id' => $product_id,
            'name' => $product_name,
            'price' => $product_price,
            'quantity' => 1,
            'attributes' => [
                'is_bundle' => 2,
                'custom_fields' => $request->custom_fields,
                'color_option' => $color_option
            ]
        ]);

        return redirect()->route('checkout.index')->with('success', 'Course bundle has been added to your basket.');
    }

    public function remove(Request $request)
    {
        Cart::remove($request->id);

        // Recalculate coupon if one is applied
        $couponCode = null;

        // Check if a coupon condition exists
        $conditions = \Cart::getConditionsByType('coupon');
        if ($conditions->count() > 0) {
            $couponCode = $conditions->first()->getAttributes()['code'] ?? null;
            // Remove existing coupon condition
            \Cart::removeCartCondition('COUPON_DISCOUNT');
        }

        if ($couponCode) {
            // Reapply coupon (will automatically remove if no eligible December courses)
            $request->merge(['coupon_code' => $couponCode]);
            app()->call('App\Http\Controllers\Frontend\CheckoutController@couponCode', ['request' => $request]);
        }

        return redirect()->route('checkout.index')->with('success', 'Course removed from cart.');
    }

    public function clear()
    {
        Cart::clear();
        return redirect()->route('cart.index')->with('success', 'Cart cleared.');
    }
}
