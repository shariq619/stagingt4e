<?php

namespace App\Traits;

use App\Http\Controllers\CRM\InvoicePDFController;
use App\Models\ProductInvoice;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

trait BuildsInvoiceLines
{
    protected function buildInvoiceAndLine($detail, $user, $invoice = null, $isNormal = false)
    {
        $qty     = max(1, (int) ($detail->quantity ?? 1));
        $unitNet = (float) ($detail->course_price ?? 0.0);
        $vatRate = $detail->vat_rate ?? ($detail->course->vat_rate ?? 20.0);

        if ($vatRate <= 1) {
            $vatRate *= 100;
        }

        $vatRate = round(max(0, min(100, (float) $vatRate)), 2);
        $factor  = 1 + ($vatRate / 100);

        $discGrossL = (float) ($detail->discount ?? 0.0);

        $net0   = round($qty * $unitNet, 2);
        $vat0   = round($net0 * ($vatRate / 100), 2);
        $gross0 = round($net0 + $vat0, 2);

        $discApplied = max(0.0, min($discGrossL, $gross0));
        $gross1      = round($gross0 - $discApplied, 2);

        $net1 = round($gross1 / $factor, 2);
        $vat1 = round($gross1 - $net1, 2);

        $cohort = DB::table('cohorts')
            ->leftJoin('courses', 'courses.id', '=', 'cohorts.course_id')
            ->leftJoin('venues', 'venues.id', '=', 'cohorts.venue_id')
            ->where('cohorts.id', $detail->cohort_id)
            ->selectRaw('DATE_FORMAT(cohorts.start_date_time, "%d-%m-%Y %H:%i:%s") as course_date, courses.name as course_name, venues.venue_name')
            ->first();

        if ($cohort) {
            $desc = trim(
                ($cohort->course_date ?? '') . ' – ' .
                ($cohort->course_name ?? '') .
                (empty($cohort->venue_name) ? '' : ' (' . $cohort->venue_name . ')')
            );
        }

        $invoice = $invoice ?: ProductInvoice::create([
            'invoice_no'      => 'PI' . mt_rand(100000, 999999),
            'cohort_id'       => $detail->cohort_id,
            'user_id'         => $user->id,
            'front_order_id'  => $detail->frontOrder?->id,
            'order_detail_id' => $detail->id,
            'invoice_date'    => now(),
            'status'          => 'Outstanding',
            'total_net'       => $net1,
            'total_vat'       => $vat1,
            'total_gross'     => $gross1,
            'pdf_url'         => $detail->frontOrder?->invoice_pdf_url ?: null,
        ]);

        $invoice->lines()->delete();
        $invoice->lines()->create([
            'qty'                 => $qty,
            'product_code'        => $detail->course?->code ?? 'Product Fees',
            'product_description' => $desc
                ?? $detail->course_name
                    ?? $detail->course?->name
                    ?? 'Course',
            'unit_cost'    => round($unitNet, 2),
            'vat_rate'     => $vatRate,
            'discount'     => round($discApplied, 2),
            'net_amount'   => $net1,
            'vat_amount'   => $vat1,
            'gross_amount' => $gross1,
            'assembly'     => false,
            'weight'       => null,
        ]);

        $depositPaid               = (float) ($detail->deposit_paid ?? 0.0);
        $detail->discount          = round($discApplied, 2);
        $detail->total_price       = $net1;
        $detail->vat               = $vat1;
        $detail->remaining_balance = max(0.0, $gross1 - $depositPaid);

        if (!$isNormal && empty($detail->invoice_number)) {
            $detail->invoice_number = $invoice->invoice_no;
            $detail->status         = "Unpaid";
        }

        if (!$isNormal && empty($detail->invoice_pdf_url)) {
            $dir      = 'crm/training-courses/invoices';
            $fileName = "{$invoice->invoice_no}.pdf";
            $filePath = "{$dir}/{$fileName}";

            Storage::disk('public')->makeDirectory($dir);

            $result = InvoicePDFController::generateSingleInvoicePdf(
                $invoice,
                $user,
                'public',
                $filePath
            );

            $detail->invoice_pdf_url = $result['path'];
            $invoice->pdf_url        = $result['path'];
            $invoice->save();
        }

        $detail->save();

        $invoice->forceFill([
            'total_net'   => $net1,
            'total_vat'   => $vat1,
            'total_gross' => $gross1,
        ])->save();

        return $invoice;
    }
}
