<?php

namespace App\Http\Controllers\CRM;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ProductInvoice;
use App\Models\ProductInvoicePayment;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class CustomersController extends BaseUserDirectoryController
{
    protected const ROLE            = 'Corporate Client';
    protected const INDEX_VIEW      = 'crm.customers.index';
    protected const SHOW_ROUTE_NAME = 'crm.customers.show';
    protected const CODE_PREFIX     = 'C';
    protected const ENTITY_LABEL    = 'Customer';

    public function index(Request $request)
    {
        $total = $this->totalCount();
        return view(static::INDEX_VIEW, compact('total'));
    }

    public function financialsJson($customerId, Request $request)
    {
        $customerId = (int) $customerId;
        $customer = User::findOrFail($customerId);
        $userIds = User::where('client_id', $customerId)->pluck('id');

        if ($userIds->isEmpty()) {
            return response()->json([
                'customer' => [
                    'id'           => $customer->id,
                    'name'         => $customer->name ?? ($customer->company ?? ''),
                    'credit_limit' => (float) ($customer->credit_limit ?? 0),
                ],
                'account_balance'           => 0.0,
                'account_balance_formatted' => number_format(0, 2, '.', ''),
                'rows' => [],
            ]);
        }

        $invoiceQuery = ProductInvoice::with(['cohort.course', 'nominalCode'])
            ->whereIn('user_id', $userIds);

        $paymentFilter = function ($q) {
            $q->whereNull('is_refunded')->orWhere('is_refunded', false);
        };

        $from = $request->get('from');
        $to   = $request->get('to');

        if (!empty($from)) {
            try {
                $fromDate = Carbon::createFromFormat('d-m-Y', $from)->startOfDay();
                $invoiceQuery->where('invoice_date', '>=', $fromDate);
            } catch (\Throwable $e) {}
        }
        if (!empty($to)) {
            try {
                $toDate = Carbon::createFromFormat('d-m-Y', $to)->endOfDay();
                $invoiceQuery->where('invoice_date', '<=', $toDate);
            } catch (\Throwable $e) {}
        }

        $invoices = $invoiceQuery->get();

        if ($invoices->isEmpty()) {
            return response()->json([
                'customer' => [
                    'id'           => $customer->id,
                    'name'         => $customer->name ?? ($customer->company ?? ''),
                    'credit_limit' => (float) ($customer->credit_limit ?? 0),
                ],
                'account_balance'           => 0.0,
                'account_balance_formatted' => number_format(0, 2, '.', ''),
                'rows' => [],
            ]);
        }

        $invoiceIds = $invoices->pluck('id');

        $paymentsQuery = ProductInvoicePayment::whereIn('invoice_id', $invoiceIds)
            ->where($paymentFilter);

        if (!empty($from ?? null)) {
            try {
                $fromDate = Carbon::createFromFormat('d-m-Y', $from)->startOfDay();
                $paymentsQuery->where('payment_date', '>=', $fromDate);
            } catch (\Throwable $e) {}
        }
        if (!empty($to ?? null)) {
            try {
                $toDate = Carbon::createFromFormat('d-m-Y', $to)->endOfDay();
                $paymentsQuery->where('payment_date', '<=', $toDate);
            } catch (\Throwable $e) {}
        }

        $payments = $paymentsQuery->get();
        $paymentsByInvoice = $payments->groupBy('invoice_id');
        $rows = collect();

        foreach ($invoices as $invoice) {
            $paid = (float) ($paymentsByInvoice->get($invoice->id, collect())->sum('amount') ?? 0);
            $gross = (float) ($invoice->total_gross ?? 0);
            $remaining = round($gross - $paid, 2);

            if (abs($gross) < 0.00001) {
                $flag = null;
            } elseif (abs($remaining) < 0.00001) {
                $flag = 'ok';
            } elseif ($paid > 0 && $remaining > 0) {
                $flag = 'warn';
            } else {
                $flag = 'bad';
            }

            $delegate = $invoice->user;

            $delegateLabelParts = [];
            if ($delegate) {
                if (!empty($delegate->name)) {
                    $delegateLabelParts[] = $delegate->name;
                }
            }
            $delegateLabel = implode(' | ', $delegateLabelParts);

            $rows->push([
                'invoice_id'    => $invoice->id,
                'type'          => 'invoice',
                'date'          => optional($invoice->invoice_date)->format('d-m-Y'),
                'date_sort'     => optional($invoice->invoice_date)->timestamp ?? 0,
                'code'          => $invoice->invoice_no,
                'transaction'   => 'Product-Invoice',
                'transaction_url' => route('crm.invoices.show', $invoice->id),
                'details'       => $invoice->cohort?->course?->name ?? 'Training Course',
                'nominal'       => $invoice->nominalCode?->description ?? '-',
                'debit'         => $gross > 0 ? number_format($gross, 2, '.', '') : 0.0,
                'credit'        => $paid > 0 ? number_format($paid, 2, '.', '') : 0.0,
                'flag'          => $flag,
                'balance'       => $remaining,
                'balance_text'  => $gross > 0
                    ? '(' . number_format(abs($remaining), 2, '.', '') . ')'
                    : null,
                'delegate_hint'   => $delegateLabel ?: null,
            ]);
        }

        $rows = $rows->sortByDesc('date_sort')->values();

        $sumInvoices = (float) $invoices->sum('total_gross');
        $sumPayments = (float) $payments->sum('amount');
        $balance = round($sumInvoices - $sumPayments, 2);

        return response()->json([
            'customer' => [
                'id'           => $customer->id,
                'name'         => $customer->name ?? ($customer->company ?? ''),
                'credit_limit' => (float) ($customer->credit_limit ?? 0),
            ],
            'account_balance'           => $balance,
            'account_balance_formatted' => number_format($balance, 2, '.', ''),
            'rows' => $rows,
        ]);
    }

    public function invoicePaymentsJson(Request $request)
    {
        $invoiceId = (int) $request->input('invoice_id');

        if (!$invoiceId) {
            return response()->json([
                'ok' => false,
                'message' => 'Missing invoice.',
            ], 422);
        }

        $rows = ProductInvoicePayment::where('invoice_id', $invoiceId)
            ->where(function ($q) {
                $q->whereNull('is_refunded')->orWhere('is_refunded', false);
            })
            ->orderBy('payment_date', 'asc')
            ->get()
            ->map(function (ProductInvoicePayment $p) {
                return [
                    'id'           => $p->id,
                    'payment_ref'  => $p->payment_ref,
                    'payment_date' => $p->payment_date ? $p->payment_date->format('d/m/Y H:i') : '',
                    'payment_type' => $p->payment_type,
                    'payment_from' => $p->payment_from,
                    'amount'       => (float) $p->amount,
                ];
            })
            ->values();

        return response()->json([
            'ok'   => true,
            'rows' => $rows,
        ]);
    }

}
