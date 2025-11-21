<?php

namespace App\Traits;

use App\Models\FrontOrderDetails;
use App\Models\ProductInvoice;
use App\Models\ProductInvoicePayment;
use Illuminate\Support\Facades\DB;

trait UserCohortReassignment
{
    protected function moveLearnerPivot(int $fromCohortId, int $toCohortId, int $userId): void
    {
        $pivot = DB::table('cohort_user')
            ->where('cohort_id', $fromCohortId)
            ->where('user_id', $userId)
            ->whereDate('created_at', '>=', '2025-11-24')
            ->lockForUpdate()
            ->first();

        if (!$pivot) {
            abort(422, "User {$userId} is not in the source cohort.");
        }

        $exists = DB::table('cohort_user')
            ->where('user_id', $userId)
            ->where('cohort_id', $toCohortId)
            ->whereDate('created_at', '>=', '2025-11-24')
            ->exists();

        if ($exists) {
            abort(400, 'User is already assigned to this cohort.');
        }

        DB::table('cohort_user')
            ->where('id', $pivot->id)
            ->whereDate('created_at', '>=', '2025-11-24')
            ->update([
                'is_reassigned' => 1,
                'updated_at'    => now(),
            ]);

        DB::table('cohort_user')->insert([
            'cohort_id'     => $toCohortId,
            'user_id'       => $userId,
            'status'        => $pivot->status ?? 'enrolled',
            'is_reassigned' => 0,
            'comments'      => $pivot->comments ?? '',
            'created_at'    => now(),
            'updated_at'    => now(),
        ]);
    }


    protected function attachRescheduleFeeToLatestInvoice(
        int $fromCohortId,
        int $toCohortId,
        int $userId,
        float $feeNet,
        float $vatRate,
        ?float $feeVat = null,
        ?float $feeGross = null
    ): ?array {
        $invoice = ProductInvoice::query()
            ->where('cohort_id', $fromCohortId)
            ->where('user_id',  $userId)
            ->latest('id')
            ->lockForUpdate()
            ->first();

        if (!$invoice) {
            return null;
        }

        $feeVat   = $feeVat   ?? round($feeNet * ($vatRate / 100), 2);
        $feeGross = $feeGross ?? round($feeNet + $feeVat, 2);

        $cohort = DB::table('cohorts')
            ->leftJoin('courses', 'courses.id', '=', 'cohorts.course_id')
            ->leftJoin('venues', 'venues.id', '=', 'cohorts.venue_id')
            ->where('cohorts.id', $toCohortId)
            ->selectRaw('
                DATE_FORMAT(cohorts.start_date_time, "%d-%m-%Y %H:%i:%s") as course_date,
                courses.name as course_name,
                venues.venue_name,
                cohorts.course_id as course_id
            ')
            ->first();

        $desc = 'Reschedule Fee';
        if ($cohort) {
            $desc = trim(($cohort->course_date ?? '').' – '.($cohort->course_name ?? '').(empty($cohort->venue_name) ? '' : ' ('.$cohort->venue_name.')'));
        }

        $line = $invoice->lines()->create([
            'qty'                 => 1,
            'product_code'        => 'RS-FEE',
            'product_description' => $desc ?: 'Reschedule Fee',
            'unit_cost'           => $feeNet,
            'vat_rate'            => $vatRate,
            'discount'            => 0,
            'net_amount'          => $feeNet,
            'vat_amount'          => $feeVat,
            'gross_amount'        => $feeGross,
            'assembly'            => false,
            'weight'              => null,
            'is_reassigned'       => true,
        ]);

        $sum = $invoice->lines()
            ->selectRaw('COALESCE(SUM(net_amount),0) AS net, COALESCE(SUM(vat_amount),0) AS vat, COALESCE(SUM(gross_amount),0) AS gross')
            ->first();

        $totalNet   = round((float)($sum->net ?? 0), 2);
        $totalVat   = round((float)($sum->vat ?? 0), 2);
        $totalGross = round((float)($sum->gross ?? 0), 2);

        $invoice->update([
            'cohort_id'   => $toCohortId,
            'total_net'   => $totalNet,
            'total_vat'   => $totalVat,
            'total_gross' => $totalGross,
        ]);

        if (!empty($invoice->order_detail_id)) {
            $detail = FrontOrderDetails::where('id', $invoice->order_detail_id)->lockForUpdate()->first();
            if ($detail) {
                $detail->cohort_id = $toCohortId;
                $detail->course_status = "Provisional";
                $detail->course_id = $cohort->course_id;
                $detail->save();
            }
        }

        $allocated   = (float) ProductInvoicePayment::where('invoice_id', $invoice->id)->sum('amount');
        $unallocated = round(max(0.0, $totalGross - $allocated), 2);
        if ($feeNet > 0) {
            $invoice->invoice_status = 'Outstanding';
            $invoice->save();
        } elseif ($unallocated <= 0.00001) {
            $invoice->invoice_status = 'Paid';
            $invoice->save();
        }

        return [
            'invoice_id'       => $invoice->id,
            'invoice_line_id'  => $line->id,
            'order_detail_id'  => $invoice->order_detail_id,
            'total_net'        => $totalNet,
            'total_vat'        => $totalVat,
            'total_gross'      => $totalGross,
            'allocated'        => round($allocated, 2),
            'unallocated'      => $unallocated,
            'status'           => $invoice->invoice_status,
        ];
    }


    protected function insertCohortReassignmentDraft(
        int $userId,
        int $from,
        int $to,
        float $feeNet,
        float $rate,
        ?float $feeVat,
        ?float $feeG,
        bool $addFee
    ): int {
        return (int) DB::table('cohort_reassignments')->insertGetId([
            'user_id'             => $userId,
            'from_cohort_id'      => $from,
            'to_cohort_id'        => $to,
            'order_detail_id'     => null,
            'invoice_id'          => null,
            'invoice_line_id'     => null,
            'fee_net'             => $feeNet,
            'vat_rate'            => $rate,
            'fee_vat'             => $feeVat ?? round($feeNet * ($rate / 100), 2),
            'fee_gross'           => $feeG ?? round($feeNet + ($feeVat ?? round($feeNet * ($rate / 100), 2)), 2),
            'included_in_invoice' => $addFee,
            'invoice_line_code'   => $addFee ? 'RS-FEE' : null,
            'invoice_line_desc'   => $addFee ? 'Reschedule Fee' : null,
            'created_by'          => auth()->id(),
            'meta'                => null,
            'notes'               => null,
            'created_at'          => now(),
            'updated_at'          => now(),
        ]);
    }

    protected function updateCohortReassignmentWithInvoice(int $reassignId, array $invResult): void
    {
        DB::table('cohort_reassignments')
            ->where('id', $reassignId)
            ->update([
                'invoice_id'      => $invResult['invoice_id']      ?? null,
                'invoice_line_id' => $invResult['invoice_line_id'] ?? null,
                'order_detail_id' => $invResult['order_detail_id'] ?? null,
                'meta'            => json_encode($invResult),
                'updated_at'      => now(),
            ]);
    }
}
