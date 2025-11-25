<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;
use App\Models\Cohort;
use App\Models\User;
use App\Models\FrontOrder;
use App\Models\FrontOrderDetails;
use App\Models\FrontPayment;
use App\Models\CheckoutDetail;
use App\Models\ProductInvoice;

trait HandlesCohortEnrollment
{
    use BuildsInvoiceLines;

    public function enrollUserToCohortWithOptions(
        int|string $userId,
        int|string $cohortId,
        bool $includeInvoice = false
    ): array {
        return DB::transaction(function () use ($userId, $cohortId, $includeInvoice) {
            $cohort = Cohort::with('course')->findOrFail($cohortId);

            $currentCount = DB::table('cohort_user')
                ->where('cohort_id', $cohortId)
                ->count();

            if ($cohort->max_learner && $currentCount >= $cohort->max_learner) {
                abort(400, 'Cohort learner limit has been reached.');
            }

            $exists = DB::table('cohort_user')
                ->where('user_id', $userId)
                ->where('cohort_id', $cohortId)
                ->exists();

            if ($exists) {
                abort(400, 'User is already assigned to this cohort.');
            }

            DB::table('cohort_user')->insert([
                'user_id'    => $userId,
                'cohort_id'  => $cohortId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $user   = User::findOrFail($userId);
            $course = $cohort->course ?? abort(404, 'Associated course not found for this cohort.');

            $vatRate        = 0.20;
            $quantity       = 1;

            $grossUnit      = (float) ($course->price ?? 0);
            $netUnit        = round($grossUnit / (1 + $vatRate), 2);
            $vatUnit        = round($grossUnit - $netUnit, 2);

            $netTotal       = round($netUnit * $quantity, 2);
            $vatTotal       = round($vatUnit * $quantity, 2);
            $grossTotal     = round($netTotal + $vatTotal, 2);

            $order = FrontOrder::create([
                'user_id'           => $userId,
                'total_amount'      => $grossTotal,
                'payment_method'    => null,
                'order_status'      => 'Processing',
                'shipping_cost'     => 0,
                'tax_amount'        => $vatTotal,
                'discount_amount'   => 0,
                'remaining_balance' => $grossTotal,
            ]);

            $detail = FrontOrderDetails::create([
                'order_id'          => $order->id,
                'user_id'           => $userId,
                'is_bundle'         => 0,
                'courses'           => null,
                'course_id'         => $course->id,
                'cohort_id'         => $cohortId,
                'bundle_id'         => null,
                'product_id'        => null,
                'course_name'       => $course->name,
                'course_price'      => $netTotal,
                'quantity'          => $quantity,
                'total_price'       => $netTotal,
                'deposit_paid'      => 0,
                'deposit_amount'    => 0,
                'cost_price'        => $netTotal,
                'vat'               => $vatTotal,
                'remaining_balance' => $grossTotal,
                'discount'          => 0,
            ]);

            FrontPayment::create([
                'order_id'       => $order->id,
                'amount'         => 0,
                'payment_method' => 'stripe',
                'status'         => 'pending',
            ]);

            CheckoutDetail::create([
                'order_id'         => $order->id,
                'first_name'       => $user->name ?? "N/A",
                'last_name'        => $user->last_name ?? "N/A",
                'company_name'     => $user->company ?? "N/A",
                'street_address'   => $user->address ?? "N/A",
                'unit'             => $user->unit ?? "N/A",
                'city'             => $user->city ?? "N/A",
                'postcode'         => $user->postcode ?? "00000",
                'phone'            => $user->phone_number ?? ($user->telephone ?? "000000000"),
                'email'            => $user->email ?? "N/A",
                'attendee_details' => null,
                'hear_about'       => '',
                'declaration'      => false,
                'terms'            => false,
            ]);

            $invoice = null;
            if ($includeInvoice) {
                $existing = ProductInvoice::where('order_detail_id', $detail->id)->first();
                $invoice  = $existing ?: $this->buildInvoiceAndLine($detail, $user);
            }

            return [
                'order'        => $order,
                'detail'       => $detail,
                'invoice'      => $invoice,
                'vat_rate'     => $vatRate,
                'net_amount'   => $netTotal,
                'vat_amount'   => $vatTotal,
                'gross_amount' => $grossTotal,
            ];
        });
    }
}
