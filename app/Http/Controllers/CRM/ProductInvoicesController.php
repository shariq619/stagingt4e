<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Controller;
use App\Models\FrontOrder;
use App\Models\FrontOrderDetails;
use App\Models\FrontPayment;
use App\Models\ProductInvoice;
use App\Models\ProductInvoiceLine;
use App\Models\ProductInvoicePayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Traits\BuildsInvoiceLines;

class ProductInvoicesController extends Controller
{
    use BuildsInvoiceLines;

    public function show(ProductInvoice $invoice)
    {
        if ($invoice->lines()->count() === 0 && $invoice->order_detail_id) {
            $detail = FrontOrderDetails::with(['course'])->find($invoice->order_detail_id);

            if ($detail) {
                $updatedInvoice = $this->buildInvoiceAndLine($detail, $invoice->user, $invoice);

                $invoice->update([
                    'total_net' => $updatedInvoice->total_net,
                    'total_vat' => $updatedInvoice->total_vat,
                    'total_gross' => $updatedInvoice->total_gross,
                ]);
            }
        }

        return view('crm.invoices.index', compact('invoice'));
    }

    public function json(ProductInvoice $invoice)
    {
        $invoice->load([
            'user',
            'cohort',
            'nominalCode',
            'projectCode',
            'source',
            'department',
            'lines'
        ]);

//        $latestReassignedLine = $invoice->lines->where('is_reassigned', 1)->sortByDesc('id')->first();
//
//        $latestNormalLine = $invoice->lines->where('is_reassigned', 0)->sortByDesc('id')->first();
//
//        $lines = [];
//        if ($latestReassignedLine) {
//            $lines[] = $latestReassignedLine;
//        }
//        if ($latestNormalLine) {
//            $lines[] = $latestNormalLine;
//        }

        return response()->json([
            'header' => [
                'id' => $invoice->id,
                'cohort_id' => $invoice->cohort_id,
                'invoice_no' => $invoice->invoice_no,
                'invoice_date' => $invoice->invoice_date?->format('d-m-Y H:i'),
                'status' => $invoice->invoice_status,
                'additional_invoice_details' => $invoice->additional_invoice_details,
                'carriage' => (float)($invoice->carriage ?? 0),
                'misc_cost' => (float)($invoice->misc_cost ?? 0),
                'discount_amount' => (float)($invoice->discount_amount ?? 0),
                'discount_percent' => (float)($invoice->discount_percent ?? 0),
                'discount_vat_rate' => (float)($invoice->discount_vat_rate ?? 0),
                'order_no' => $invoice->order_no,
                'user' => [
                    'id' => $invoice->user_id,
                    'name' => trim("{$invoice->user?->name} {$invoice->user?->middle_name} {$invoice->user?->last_name}"),
                    'phone' => $invoice->user?->phone_number,
                    'telephone' => $invoice->user?->telephone,
                ],
                'nominal_code' => $invoice->nominalCode ? [
                    'id' => $invoice->nominalCode->id,
                    'code' => $invoice->nominalCode->code,
                    'description' => $invoice->nominalCode->description,
                ] : null,
                'project_code' => $invoice->projectCode ? [
                    'id' => $invoice->projectCode->id,
                    'code' => $invoice->projectCode->code,
                    'description' => $invoice->projectCode->description,
                ] : null,
                'source' => $invoice->source ? [
                    'id' => $invoice->source->id,
                    'code' => $invoice->source->code,
                    'name' => $invoice->source->name,
                ] : null,
                'department' => $invoice->department ? [
                    'id' => $invoice->department->id,
                    'code' => $invoice->department->code,
                    'description' => $invoice->department->description,
                ] : null,
                'totals' => [
                    'net' => (float)$invoice->total_net,
                    'vat' => (float)$invoice->total_vat,
                    'gross' => (float)$invoice->total_gross,
                ],
                'pdf_url' => $invoice->pdf_url ? asset('storage/' . $invoice->pdf_url) : null,
            ],
//            'lines' => collect($lines)->map(fn($l) => [
            'lines' => $invoice->lines->sortBy('is_reassigned')->map(fn($l) => [
                'id' => $l->id,
                'qty' => (int)$l->qty,
                'product_code' => $l->product_code,
                'product_description' => $l->product_description,
                'unit_cost' => (float)$l->unit_cost,
                'vat_rate' => (float)$l->vat_rate,
                'discount' => (float)$l->discount,
                'net_amount' => (float)$l->net_amount,
                'vat_amount' => (float)$l->vat_amount,
                'gross_amount' => (float)$l->gross_amount,
                'assembly' => (bool)$l->assembly,
                'weight' => $l->weight !== null ? (float)$l->weight : null,
                'is_reassigned' => (bool)$l->is_reassigned,
            ])->values(),
        ]);
    }


    public function updateHeader(Request $request, ProductInvoice $invoice)
    {
        try {
            return DB::transaction(function () use ($request, $invoice) {
                $data = $request->validate([
                    'status' => ['nullable', 'string', 'max:50'],
                    'additional_invoice_details' => ['nullable', 'string'],
                    'carriage' => ['nullable', 'numeric', 'min:0'],
                    'discount_amount' => ['nullable', 'numeric', 'min:0'],
                    'order_no' => ['nullable', 'string', 'max:80'],
                    'discount_percent' => ['nullable', 'numeric', 'min:0'],
                    'discount_vat_rate' => ['nullable', 'numeric', 'min:0'],
                    'misc_cost' => ['nullable', 'numeric', 'min:0'],
                    'nominal_code_id' => ['nullable', 'exists:nominal_codes,id'],
                    'project_code_id' => ['nullable', 'exists:project_codes,id'],
                    'source_id' => ['nullable', 'exists:sources,id'],
                    'department_id' => ['nullable', 'exists:departments,id'],
                ]);

                $update = [];

                if (array_key_exists('status', $data)) {
                    $update['invoice_status'] = $data['status'];
                }
                if (array_key_exists('order_no', $data)) {
                    $update['order_no'] = $data['order_no'];
                }
                if (array_key_exists('additional_invoice_details', $data)) {
                    $update['additional_invoice_details'] = $data['additional_invoice_details'];
                }
                if (array_key_exists('carriage', $data)) {
                    $update['carriage'] = (float)$data['carriage'];
                }
                if (array_key_exists('discount_percent', $data)) {
                    $update['discount_percent'] = (float)$data['discount_percent'];
                }
                if (array_key_exists('discount_vat_rate', $data)) {
                    $update['discount_vat_rate'] = (float)$data['discount_vat_rate'];
                }
                if (array_key_exists('misc_cost', $data)) {
                    $update['misc_cost'] = (float)$data['misc_cost'];
                }

                if (array_key_exists('nominal_code_id', $data)) {
                    $update['nominal_code_id'] = $data['nominal_code_id'] ?? null;
                }
                if (array_key_exists('project_code_id', $data)) {
                    $update['project_code_id'] = $data['project_code_id'] ?? null;
                }
                if (array_key_exists('source_id', $data)) {
                    $update['source_id'] = $data['source_id'] ?? null;
                }
                if (array_key_exists('department_id', $data)) {
                    $update['department_id'] = $data['department_id'] ?? null;
                }

                if (!empty($update)) {
                    $invoice->forceFill($update)->save();
                }

                $sumLines = $invoice->lines()->selectRaw('SUM(net_amount) as net, SUM(vat_amount) as vat')->first();
                $linesNet = (float)($sumLines->net ?? 0);
                $linesVat = (float)($sumLines->vat ?? 0);

                $discPercent = (float)($invoice->discount_percent ?? 0);
                $discAmtProvided = (float)($data['discount_amount'] ?? 0);
                $discAmtCalc = $discPercent > 0 ? ($linesNet * ($discPercent / 100)) : $discAmtProvided;
                $invoice->forceFill(['discount_amount' => round($discAmtCalc, 2)])->save();

                $carriage = (float)($invoice->carriage ?? 0);
                $misc = (float)($invoice->misc_cost ?? 0);
                $discAmt = (float)($invoice->discount_amount ?? 0);
                $discVatR = (float)($invoice->discount_vat_rate ?? 0);

                $newTotalNet = max(0.0, $linesNet + $carriage + $misc - $discAmt);
                $discountVatAdj = -($discAmt * ($discVatR / 100.0));
                $totalVat = $linesVat + $discountVatAdj;
                $totalGross = $newTotalNet + $totalVat;

                $invoice->forceFill([
                    'total_net' => round($newTotalNet, 2),
                    'total_vat' => round($totalVat, 2),
                    'total_gross' => round($totalGross, 2),
                ])->save();

                $allocated = (float)ProductInvoicePayment::where('invoice_id', $invoice->id)->sum('amount');
                $unallocated = max(0.0, (float)$invoice->total_gross - $allocated);
                if ($unallocated <= 0.00001) {
                    $invoice->forceFill(['invoice_status' => 'Paid'])->save();
                }

                return response()->json([
                    'status' => 'ok',
                    'invoice_status' => $invoice->invoice_status,
                    'totals' => [
                        'lines_net' => number_format($linesNet, 2, '.', ''),
                        'discount' => number_format((float)$invoice->discount_amount, 2, '.', ''),
                        'new_total_net' => number_format((float)$invoice->total_net, 2, '.', ''),
                        'vat' => number_format((float)$invoice->total_vat, 2, '.', ''),
                        'gross' => number_format((float)$invoice->total_gross, 2, '.', ''),
                        'carriage' => number_format((float)$invoice->carriage, 2, '.', ''),
                        'misc' => number_format((float)$invoice->misc_cost, 2, '.', ''),
                    ],
                    'allocated' => number_format($allocated, 2, '.', ''),
                    'unallocated' => number_format($unallocated, 2, '.', ''),
                ]);
            });
        } catch (\Throwable $e) {
            Log::error('Invoice Header Update Failed: ' . $e->getMessage());
            return response()->json(['message' => 'Something went wrong while updating invoice header.'], 500);
        }
    }


    public function updateLine(Request $request, ProductInvoiceLine $line)
    {
        try {
            return DB::transaction(function () use ($request, $line) {
                $data = $request->validate([
                    'qty'                 => ['required', 'integer', 'min:1'],
                    'product_code'        => ['nullable', 'string', 'max:80'],
                    'product_description' => ['nullable', 'string', 'max:255'],
                    'unit_cost'           => ['required', 'numeric', 'min:0'],
                    'vat_rate'            => ['required', 'numeric', 'min:0'],
                    'discount'            => ['nullable', 'numeric', 'min:0'],
                    'assembly'            => ['sometimes', 'boolean'],
                    'weight'              => ['nullable', 'numeric', 'min:0'],
                ]);

                $qty     = (int) $data['qty'];
                $unitNet = (float) $data['unit_cost'];
                $vatRate = (float) $data['vat_rate'];
                $discG   = (float) ($data['discount'] ?? 0.0);
                $factor  = 1 + ($vatRate / 100);

                $net0   = round($qty * $unitNet, 2);
                $vat0   = round($net0 * ($vatRate / 100), 2);
                $gross0 = round($net0 + $vat0, 2);

                $discApplied = max(0.0, min($discG, $gross0));
                $gross1 = round($gross0 - $discApplied, 2);

                $net1 = round($gross1 / $factor, 2);
                $vat1 = round($gross1 - $net1, 2);

                $line->fill([
                    'qty'                 => $data['qty'],
                    'product_code'        => $data['product_code'] ?? $line->product_code,
                    'product_description' => $data['product_description'] ?? $line->product_description,
                    'unit_cost'           => $data['unit_cost'],
                    'vat_rate'            => $data['vat_rate'],
                    'weight'              => $data['weight'] ?? $line->weight,
                ]);
                if (array_key_exists('assembly', $data)) {
                    $line->assembly = (bool) $data['assembly'];
                }

                $isReassigned = (bool) $line->is_reassigned;

                $line->discount     = round($discApplied, 2);
                $line->net_amount   = $net1;
                $line->vat_amount   = $vat1;
                $line->gross_amount = $gross1;
                $line->save();

                $invoice = $line->invoice()->lockForUpdate()->first();

                $sum = $invoice->lines()
                    ->selectRaw('COALESCE(SUM(net_amount),0) AS net, COALESCE(SUM(vat_amount),0) AS vat, COALESCE(SUM(gross_amount),0) AS gross, COALESCE(SUM(discount),0) AS disc')
                    ->first();

                $totalNet   = round((float) ($sum->net ?? 0), 2);
                $totalVat   = round((float) ($sum->vat ?? 0), 2);
                $totalGross = round((float) ($sum->gross ?? 0), 2);
                $discSum    = round((float) ($sum->disc ?? 0), 2);

                $allocated = (float) ProductInvoicePayment::where('invoice_id', $invoice->id)
                    ->where(function($q){ $q->whereNull('is_refunded')->orWhere('is_refunded', false); })
                    ->sum('amount');

                $unallocated = max(0.0, $totalGross - $allocated);
                $status = ($unallocated <= 0.00001) ? 'Paid' : 'Outstanding';

                $preDiscountGross = $totalGross + $discSum;
                $discPercent = $totalGross > 0 ? round(($discSum / $totalGross) * 100, 2) : 0.00;

                $invoice->update([
                    'total_net'        => $totalNet,
                    'total_vat'        => $totalVat,
                    'total_gross'      => $totalGross,
                    'discount_amount'  => $discSum,
                    'discount_percent' => $discPercent,
                    'invoice_status'   => $status,
                ]);

                if ($isReassigned) {
                    $reassign = DB::table('cohort_reassignments')
                        ->where('invoice_line_id', $line->id)
                        ->lockForUpdate()
                        ->first();

                    if (!$reassign) {
                        $reassign = DB::table('cohort_reassignments')
                            ->where('invoice_id', $invoice->id)
                            ->where('user_id', $invoice->user_id)
                            ->orderByDesc('id')
                            ->lockForUpdate()
                            ->first();
                    }

                    if ($reassign) {
                        DB::table('cohort_reassignments')
                            ->where('id', $reassign->id)
                            ->update([
                                'invoice_id'      => $invoice->id,
                                'invoice_line_id' => $line->id,
                                'fee_net'         => $net1,
                                'fee_vat'         => $vat1,
                                'fee_gross'       => $gross1,
                                'vat_rate'        => $vatRate,
                                'updated_at'      => now(),
                            ]);
                    }
                } else {
                    if (!empty($invoice->order_detail_id)) {
                        $fod = FrontOrderDetails::where('id', $invoice->order_detail_id)->lockForUpdate()->first();
                        if ($fod) {
                            $fod->course_price = round($unitNet, 2);
                            if (property_exists($fod, 'quantity') || \Schema::hasColumn($fod->getTable(), 'quantity')) {
                                $fod->quantity = $qty;
                            }
                            $fod->discount = round($discApplied, 2);
                            $fod->total_price = $totalNet;
                            $fod->vat = $totalVat;
                            $depositPaid = (float) ($fod->deposit_paid ?? 0.0);
                            $fod->remaining_balance = max(0.0, $totalGross - $depositPaid);
                            $fod->save();

                            $orderId = $fod->order_id;
                            if ($orderId) {
                                $sumOrder = FrontOrderDetails::where('order_id', $orderId)
                                    ->selectRaw('COALESCE(SUM(total_price),0) AS net, COALESCE(SUM(vat),0) AS vat')
                                    ->first();

                                $orderNet   = round((float) ($sumOrder->net ?? 0), 2);
                                $orderVat   = round((float) ($sumOrder->vat ?? 0), 2);
                                $orderGross = round($orderNet + $orderVat, 2);

                                $paidOrder = (float) FrontPayment::where('order_id', $orderId)
                                    ->whereIn('status', ['paid', 'success', 'succeeded'])
                                    ->sum('amount');

                                $order = FrontOrder::lockForUpdate()->find($orderId);
                                if ($order) {
                                    $order->total_amount      = $orderNet;
                                    $order->tax_amount        = $orderVat;
                                    $order->remaining_balance = max(0.0, $orderGross - $paidOrder);
                                    $order->save();
                                }
                            }
                        }
                    }
                }

                return response()->json([
                    'status' => 'ok',
                    'invoice' => [
                        'total_net'        => $totalNet,
                        'total_vat'        => $totalVat,
                        'total_gross'      => $totalGross,
                        'allocated'        => round($allocated, 2),
                        'unallocated'      => round($unallocated, 2),
                        'status'           => $status,
                        'discount_amount'  => $discSum,
                        'discount_percent' => $discPercent,
                    ],
                ]);
            });
        } catch (\Throwable $e) {
            Log::error('Invoice Line Update Failed: '.$e->getMessage(), ['trace' => $e->getTraceAsString()]);
            return response()->json(['message' => 'Something went wrong while updating invoice line.'], 500);
        }
    }


    public function destroyLine(ProductInvoiceLine $line)
    {
        try {
            return DB::transaction(function () use ($line) {
                $line->delete();
                return response()->json(['status' => 'deleted']);
            });
        } catch (\Exception $e) {
            Log::error('Invoice Line Delete Failed: ' . $e->getMessage());
            return response()->json(['message' => 'Something went wrong while deleting invoice line.'], 500);
        }
    }
}
