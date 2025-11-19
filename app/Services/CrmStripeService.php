<?php

namespace App\Services;

use App\Models\CrmStripePaymentLog;
use App\Models\ProductInvoice;
use Stripe\StripeClient;
class CrmStripeService
{
    protected StripeClient $stripe;

    public function __construct()
    {
        $this->stripe = new StripeClient(config('services.stripe.secret'));
    }

    public function createPaymentIntent(ProductInvoice $invoice, float $amount, string $currency = null, array $meta = []): array
    {
        $currency = $currency ?: (config('services.stripe.currency') ?? env('STRIPE_DEFAULT_CURRENCY', 'GBP'));
        $amt = (int) round($amount * 100);
        $intent = $this->stripe->paymentIntents->create([
            'amount' => $amt,
            'currency' => strtolower($currency),
            'automatic_payment_methods' => ['enabled' => true],
            'metadata' => array_merge([
                'invoice_id' => (string) $invoice->id,
                'invoice_no' => (string) ($invoice->invoice_number ?? ''),
                'app' => 'CRM',
            ], $meta),
        ]);
        CrmStripePaymentLog::create([
            'context' => 'create_intent',
            'invoice_id' => $invoice->id,
            'payment_intent' => $intent->id,
            'amount' => $amount,
            'currency' => strtoupper($currency),
            'status' => $intent->status,
            'payload' => $intent->toArray()
        ]);
        return [
            'id' => $intent->id,
            'client_secret' => $intent->client_secret,
            'amount' => $amount,
            'currency' => strtoupper($currency),
            'status' => $intent->status,
        ];
    }

    public function retrieveIntent(string $piId, ?string $accountId = null, array $expand = [])
    {
        $opts   = $accountId ? ['stripe_account' => $accountId] : [];
        $params = $expand ? ['expand' => $expand] : [];

        $res = $this->stripe->paymentIntents->retrieve($piId, $params, $opts);

        CrmStripePaymentLog::create([
            'context'         => 'retrieve_intent',
            'payment_intent'  => $piId,
            'refund_id'       => null,
            'amount'          => isset($res->amount_received) ? ($res->amount_received / 100) : 0,
            'currency'        => strtoupper($res->currency ?? 'GBP'),
            'status'          => $res->status ?? null,
            'payload'         => $res->toArray(),
        ]);

        return $res;
    }

    public function retrieveCharge(string $chargeId, ?string $accountId = null)
    {
        $opts = $accountId ? ['stripe_account' => $accountId] : [];

        $res = $this->stripe->charges->retrieve($chargeId, [], $opts);

        CrmStripePaymentLog::create([
            'context'         => 'retrieve_charge',
            'payment_intent'  => $res->payment_intent ?? null,
            'refund_id'       => null,
            'amount'          => isset($res->amount_captured) ? ($res->amount_captured / 100) : 0,
            'currency'        => strtoupper($res->currency ?? 'GBP'),
            'status'          => $res->status ?? null,
            'payload'         => $res->toArray(),
        ]);

        return $res;
    }


    public function getBalance(string $accountId = null): array
    {
        $balance = $this->stripe->balance->retrieve([], $accountId ? ['stripe_account' => $accountId] : []);
        CrmStripePaymentLog::create([
            'context' => 'balance',
            'status' => 'ok',
            'payload' => $balance->toArray()
        ]);
        $available = collect($balance->available ?? [])->map(function ($b) {
            return ['amount' => ($b->amount ?? 0) / 100, 'currency' => strtoupper($b->currency ?? 'GBP')];
        })->values()->all();
        $pending = collect($balance->pending ?? [])->map(function ($b) {
            return ['amount' => ($b->amount ?? 0) / 100, 'currency' => strtoupper($b->currency ?? 'GBP')];
        })->values()->all();
        return ['available' => $available, 'pending' => $pending];
    }

    public function refundPaymentIntent(string $paymentIntentId, ?float $amount = null, string $reason = null, string $accountId = null): array
    {
        $params = ['payment_intent' => $paymentIntentId];
        if ($amount !== null) {
            $params['amount'] = (int) round($amount * 100);
        }
        if ($reason) {
            $params['reason'] = $reason;
        }
        $refund = $this->stripe->refunds->create($params, $accountId ? ['stripe_account' => $accountId] : []);
        CrmStripePaymentLog::create([
            'context' => 'refund',
            'payment_intent' => $paymentIntentId,
            'refund_id' => $refund->id,
            'amount' => isset($refund->amount) ? ($refund->amount / 100) : 0,
            'currency' => strtoupper($refund->currency ?? 'GBP'),
            'status' => $refund->status ?? null,
            'payload' => $refund->toArray()
        ]);
        return [
            'refund_id' => $refund->id,
            'status' => $refund->status,
            'amount' => isset($refund->amount) ? ($refund->amount / 100) : 0,
            'currency' => strtoupper($refund->currency ?? 'GBP')
        ];
    }
}
