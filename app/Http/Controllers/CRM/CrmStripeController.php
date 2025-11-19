<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Controller;
use App\Models\ProductInvoice;
use App\Models\ProductInvoicePayment;
use App\Services\CrmStripeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CrmStripeController extends Controller
{
    public function intent(Request $request, $invoiceId, CrmStripeService $svc)
    {
        $invoice = ProductInvoice::findOrFail($invoiceId);
        $allocated = (float) ProductInvoicePayment::where('invoice_id', $invoice->id)->sum('amount');
        $gross = (float) ($invoice->total_gross ?? 0);
        $outstanding = max(0.0, $gross - $allocated);
        $amount = (float) ($request->input('amount') ?: $outstanding);
        $currency = $request->input('currency', config('services.stripe.currency', 'GBP'));
        if ($amount <= 0.0) {
            return response()->json(['message' => 'Nothing outstanding to pay.'], 422);
        }
        $intent = $svc->createPaymentIntent($invoice, $amount, $currency, []);
        return response()->json($intent);
    }

    public function allocate(Request $request, $invoiceId, CrmStripeService $svc)
    {
        $invoice = ProductInvoice::findOrFail($invoiceId);
        $data = $request->validate([
            'payment_intent' => ['required', 'string'],
        ]);
        $pi = $svc->retrieveIntent($data['payment_intent']);
        if (!$pi || $pi->status !== 'succeeded') {
            return response()->json(['message' => 'Payment not completed.'], 422);
        }
        $amount = ((int) $pi->amount_received) / 100.0;
        $ref = $pi->id;

        DB::transaction(function () use ($invoice, $amount, $ref) {
            ProductInvoicePayment::create([
                'invoice_id'   => $invoice->id,
                'payment_ref'  => $ref,
                'payment_date' => now(),
                'payment_type' => 'Credit / Debit Card',
                'payment_from' => 'Customer',
                'amount'       => round($amount, 2),
            ]);

            $allocated = (float) ProductInvoicePayment::where('invoice_id', $invoice->id)->sum('amount');
            $gross     = (float) ($invoice->total_gross ?? 0);
            $unalloc   = max(0.0, $gross - $allocated);

            $invoice->update(['invoice_status' => $unalloc <= 0.00001 ? 'Paid' : 'Outstanding']);
        });

        return response()->json(['ok' => true, 'payment_ref' => $ref]);
    }

    public function balance(Request $request, CrmStripeService $svc)
    {
        $account = $request->query('account_id');
        $res = $svc->getBalance($account);
        return response()->json($res);
    }

    public function refund(Request $request, $invoiceId, CrmStripeService $svc)
    {
        try {
            $invoice = ProductInvoice::findOrFail($invoiceId);

            $data = $request->validate([
                'payment_intent' => ['required', 'string'],
                'amount'        => ['nullable', 'numeric', 'min:0.01'],
                'reason'        => ['nullable', 'string', 'max:40'],
                'account_id'    => ['nullable', 'string', 'max:64'],
            ]);

            $refund = $svc->refundPaymentIntent(
                $data['payment_intent'],
                $data['amount'] ?? null,
                $data['reason'] ?? null,
                $data['account_id'] ?? null
            );

            $payment = ProductInvoicePayment::where('invoice_id', $invoice->id)
                ->where('payment_ref', $data['payment_intent'])
                ->first();

            $fullyRefunded = false;

            try {
                $accountId = $data['account_id'] ?? null;

                $pi = $svc->retrieveIntent(
                    $data['payment_intent'],
                    $accountId,
                    ['charges']
                );

                $chargeId = $pi->latest_charge ?? null;

                $charge = $chargeId
                    ? $svc->retrieveCharge($chargeId, $accountId)
                    : ($pi->charges->data[0] ?? null);

                $capturedCents = (int)($charge->amount_captured ?? 0);
                $refundedCents = (int)($charge->amount_refunded ?? 0);

                $fullyRefunded = $charge && (
                        ($charge->refunded ?? false) ||
                        $refundedCents >= $capturedCents
                    );

            } catch (\Throwable $inner) {
                $fullyRefunded = false;
            }

            if ($payment && $fullyRefunded) {
                $payment->update(['is_refunded' => true]);
            }

            $allocated = (float) ProductInvoicePayment::where('invoice_id', $invoice->id)
                ->where('is_refunded', false)
                ->sum('amount');

            $gross = (float) ($invoice->total_gross ?? 0.0);
            $unallocated = max(0.0, $gross - $allocated);

            $invoice->update([
                'invoice_status' => $unallocated <= 0.00001 ? 'Paid' : 'Outstanding',
            ]);

            return response()->json([
                'ok' => true,
                'refund' => [
                    'id'         => $refund['refund_id'] ?? null,
                    'status'     => $refund['status'] ?? null,
                    'currency'   => strtoupper($refund['currency'] ?? ''),
                    'amount'     => (float)($refund['amount'] ?? 0),
                    'amount_dec' => number_format(
                        (float)($refund['amount'] ?? 0),
                        2,
                        '.',
                        ''
                    ),
                    'reason'     => $data['reason'] ?? null,
                ],
                'allocated'      => number_format($allocated, 2, '.', ''),
                'unallocated'    => number_format($unallocated, 2, '.', ''),
                'status'         => $invoice->invoice_status,
                'fully_refunded' => $fullyRefunded,
            ], 200);

        } catch (\Stripe\Exception\ApiErrorException $e) {

            $rawMsg = $e->getMessage();
            $piId   = $request->input('payment_intent');
            $niceMsg = $rawMsg;

            if (stripos($rawMsg, 'has already been refunded') !== false) {
                $niceMsg = "This payment ($piId) has already been refunded.";
            }

            return response()->json([
                'ok' => false,
                'message' => $niceMsg,
                'stripe_message' => $rawMsg,
            ], 400);

        } catch (\Illuminate\Validation\ValidationException $e) {

            $firstError = collect($e->errors())->flatten()->first() ?? 'Invalid data';

            return response()->json([
                'ok' => false,
                'message' => $firstError,
            ], 422);

        } catch (\Throwable $e) {

            return response()->json([
                'ok' => false,
                'message' => 'Refund failed: ' . $e->getMessage(),
            ], 500);
        }
    }

}
