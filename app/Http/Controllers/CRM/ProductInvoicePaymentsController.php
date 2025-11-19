<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Controller;
use App\Models\ProductInvoice;
use App\Models\ProductInvoicePayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class ProductInvoicePaymentsController extends Controller
{
    private const EPSILON = 0.01;

    public function create($invoiceId)
    {
        $invoice = ProductInvoice::with('activePayments')->findOrFail($invoiceId);

        $allocated = $invoice->activePayments->sum('amount');
        $gross = (float) ($invoice->total_gross ?? 0);
        $unalloc = max(0, $gross - $allocated);

        if ($unalloc <= self::EPSILON) {
            return redirect()->route('crm.invoices.show', $invoice->id)
                ->with('info', 'Invoice already fully paid.');
        }

        return view('crm.invoices.payment', [
            'invoice' => $invoice,
            'types' => paymentTypes(),
            'allocated' => number_format($allocated, 2, '.', ''),
            'unallocated' => number_format($unalloc, 2, '.', ''),
            'prefill' => [
                'payment_date' => now()->format('Y-m-d\TH:i'),
                'payment_type' => 'Credit / Debit Card',
                'payment_from' => 'Customer',
                'payment_ref' => null,
                'amount' => number_format($unalloc, 2, '.', ''),
            ],
        ]);
    }

    public function receipt($ref)
    {
        $payment = ProductInvoicePayment::with(['invoice.user'])
            ->where('payment_ref', $ref)
            ->firstOrFail();

        $invoice = $payment->invoice;

        $active = function ($q) {
            $q->whereNull('is_refunded')->orWhere('is_refunded', false);
        };

        $allocated = (float) ProductInvoicePayment::where('invoice_id', $invoice->id)
            ->where($active)
            ->sum('amount');

        $gross = (float) ($invoice->total_gross ?? 0);
        $unalloc = max(0, $gross - $allocated);

        return view('crm.invoices.payment_receipt', [
            'invoice' => $invoice,
            'payment' => $payment,
            'types' => paymentTypes(),
            'allocated' => number_format($allocated, 2, '.', ''),
            'unallocated' => number_format($unalloc, 2, '.', ''),
            'prefill' => [
                'payment_date' => optional($payment->payment_date)->format('Y-m-d\TH:i'),
                'payment_type' => $payment->payment_type,
                'payment_from' => $payment->payment_from,
                'payment_ref' => $payment->payment_ref,
                'amount' => number_format($payment->amount, 2, '.', ''),
            ],
        ]);
    }

    public function json($id)
    {
        $invoice = ProductInvoice::findOrFail($id);

        $payments = ProductInvoicePayment::where('invoice_id', $invoice->id)
            ->orderByDesc('payment_date')
            ->get();

        $active = function ($q) {
            $q->whereNull('is_refunded')->orWhere('is_refunded', false);
        };

        $allocated = round((float) ProductInvoicePayment::where('invoice_id', $invoice->id)
            ->where($active)
            ->sum('amount'), 2);

        $gross = round((float) ($invoice->total_gross ?? 0), 2);
        $unallocated = max(0, $gross - $allocated);

        return response()->json([
            'payments' => $payments->map(fn($p) => [
                'id'            => $p->id,
                'payment_ref'   => $p->payment_ref,
                'payment_date'  => $p->payment_date?->format('d-m-Y H:i'),
                'payment_type'  => $p->payment_type,
                'payment_from'  => $p->payment_from,
                'amount'        => number_format($p->amount, 2, '.', ''),
                'is_refunded'   => (bool) $p->is_refunded,
                'edit_url'      => route('crm.payments.receipt', $p->payment_ref),
            ]),
            'allocated'   => number_format($allocated, 2, '.', ''),
            'unallocated' => number_format($unallocated, 2, '.', ''),
            'fully_paid'  => $unallocated <= self::EPSILON,
        ]);
    }

    public function store(Request $request, $id)
    {
        $invoice = ProductInvoice::findOrFail($id);

        $data = $request->validate([
            'payment_date' => ['required', 'date'],
            'payment_type' => ['required', 'string', Rule::in(paymentTypes())],
            'payment_ref'  => ['nullable', 'string', 'max:40'],
            'payment_from' => ['nullable', 'string', 'max:60'],
            'amount'       => ['required', 'numeric', 'min:0.01'],
        ]);

        $incomingRef = isset($data['payment_ref']) ? trim($data['payment_ref']) : null;

        if ($incomingRef) {
            $exists = ProductInvoicePayment::where('payment_ref', $incomingRef)->exists();
            if ($exists) {
                return response()->json(['message' => 'Payment reference already exists.'], 422);
            }
        }

        $data['payment_ref'] = $data['payment_ref']
            ?: ('PR' . str_pad((string) random_int(1, 9_999_999), 7, '0', STR_PAD_LEFT));

        $active = function ($q) {
            $q->whereNull('is_refunded')->orWhere('is_refunded', false);
        };

        $allocatedBefore = (float) ProductInvoicePayment::where('invoice_id', $invoice->id)
            ->where($active)
            ->sum('amount');

        $gross       = (float) ($invoice->total_gross ?? 0);
        $outstanding = max(0.0, $gross - $allocatedBefore);

        if ($data['amount'] > $outstanding + self::EPSILON) {
            return response()->json(['message' => 'Payment exceeds outstanding balance.'], 422);
        }

        DB::transaction(function () use ($invoice, $data, $active) {
            ProductInvoicePayment::where('invoice_id', $invoice->id)->lockForUpdate()->get();

            $allocatedBefore = (float) ProductInvoicePayment::where('invoice_id', $invoice->id)
                ->where($active)
                ->sum('amount');

            $gross       = (float) ($invoice->total_gross ?? 0);
            $outstanding = max(0.0, $gross - $allocatedBefore);

            if ($data['amount'] > $outstanding + self::EPSILON) {
                throw \Illuminate\Validation\ValidationException::withMessages([
                    'amount' => 'Payment exceeds outstanding balance.',
                ]);
            }

            ProductInvoicePayment::create([
                'invoice_id'   => $invoice->id,
                'payment_ref'  => $data['payment_ref'],
                'payment_date' => $data['payment_date'],
                'payment_type' => $data['payment_type'],
                'payment_from' => $data['payment_from'] ?? 'Customer',
                'amount'       => round($data['amount'], 2),
            ]);

            $allocated = (float) ProductInvoicePayment::where('invoice_id', $invoice->id)
                ->where($active)
                ->sum('amount');

            $unalloc = max(0.0, $gross - $allocated);

            $invoice->update([
                'invoice_status' => ($unalloc <= self::EPSILON) ? 'Paid' : 'Outstanding',
            ]);
        });

        $allocated   = (float) ProductInvoicePayment::where('invoice_id', $invoice->id)
            ->where($active)
            ->sum('amount');
        $unallocated = max(0.0, ($invoice->total_gross ?? 0) - $allocated);

        return response()->json([
            'ok'          => true,
            'allocated'   => number_format($allocated, 2, '.', ''),
            'unallocated' => number_format($unallocated, 2, '.', ''),
            'status'      => $invoice->invoice_status,
        ], 201);
    }

    public function update(Request $request, $paymentId)
    {
        $payment = ProductInvoicePayment::with('invoice')->findOrFail($paymentId);
        $invoice = $payment->invoice;

        $data = $request->validate([
            'payment_date' => ['required', 'date'],
            'payment_type' => ['required', 'string', Rule::in(paymentTypes())],
            'payment_ref'  => ['required', 'string', 'max:40'],
            'payment_from' => ['nullable', 'string', 'max:60'],
            'amount'       => ['required', 'numeric', 'min:0.01'],
        ]);

        if ($payment->is_refunded) {
            return response()->json(['message' => 'Cannot modify a refunded payment.'], 422);
        }

        $refClash = ProductInvoicePayment::where('payment_ref', $data['payment_ref'])
            ->where('id', '<>', $payment->id)
            ->exists();
        if ($refClash) {
            return response()->json(['message' => 'Payment reference already exists.'], 422);
        }

        $active = function ($q) {
            $q->whereNull('is_refunded')->orWhere('is_refunded', false);
        };

        $allocatedOther = (float) ProductInvoicePayment::where('invoice_id', $invoice->id)
            ->where('id', '<>', $payment->id)
            ->where($active)
            ->sum('amount');

        $gross      = (float) ($invoice->total_gross ?? 0);
        $maxAllowed = max(0.0, $gross - $allocatedOther);

        if ($data['amount'] > $maxAllowed + self::EPSILON) {
            return response()->json(['message' => 'Payment exceeds outstanding balance.'], 422);
        }

        DB::transaction(function () use ($payment, $invoice, $data, $active) {
            ProductInvoicePayment::where('invoice_id', $invoice->id)->lockForUpdate()->get();

            $allocatedOther = (float) ProductInvoicePayment::where('invoice_id', $invoice->id)
                ->where('id', '<>', $payment->id)
                ->where($active)
                ->sum('amount');

            $gross      = (float) ($invoice->total_gross ?? 0);
            $maxAllowed = max(0.0, $gross - $allocatedOther);

            if ($data['amount'] > $maxAllowed + self::EPSILON) {
                throw \Illuminate\Validation\ValidationException::withMessages([
                    'amount' => 'Payment exceeds outstanding balance.',
                ]);
            }

            $payment->update([
                'payment_ref'  => $data['payment_ref'],
                'payment_date' => $data['payment_date'],
                'payment_type' => $data['payment_type'],
                'payment_from' => $data['payment_from'] ?? 'Customer',
                'amount'       => round($data['amount'], 2),
            ]);

            $allocated = (float) ProductInvoicePayment::where('invoice_id', $invoice->id)
                ->where($active)
                ->sum('amount');

            $unalloc = max(0.0, $gross - $allocated);

            $invoice->update([
                'invoice_status' => ($unalloc <= self::EPSILON) ? 'Paid' : 'Outstanding',
            ]);
        });

        return response()->json(['ok' => true]);
    }

    public function destroy($pid)
    {
        DB::transaction(function () use ($pid) {
            $p = ProductInvoicePayment::findOrFail($pid);
            $invoice = $p->invoice_id ? ProductInvoice::find($p->invoice_id) : null;

            $p->delete();

            if ($invoice) {
                $active = function ($q) {
                    $q->whereNull('is_refunded')->orWhere('is_refunded', false);
                };

                $allocated = (float) ProductInvoicePayment::where('invoice_id', $invoice->id)
                    ->where($active)
                    ->sum('amount');

                $gross = (float) ($invoice->total_gross ?? 0);

                $invoice->update([
                    'invoice_status' => (max(0.0, $gross - $allocated) <= self::EPSILON) ? 'Paid' : 'Outstanding',
                ]);
            }
        });

        return response()->json(['ok' => true]);
    }

    public function validateRef(Request $request)
    {
        $ref = trim((string) $request->query('payment_ref', ''));
        if ($ref === '') {
            return response()->json('Payment Ref is required.');
        }
        $exists = ProductInvoicePayment::where('payment_ref', $ref)->exists();
        return response()->json($exists ? 'This payment reference already exists.' : true);
    }
}
