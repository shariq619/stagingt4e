<?php

namespace App\Services\Email\Context;

use App\Models\FrontOrderDetails;
use App\Models\FrontPayment;
use App\Models\ProductInvoicePayment;
use Illuminate\Support\Carbon;

class ContextBuilder
{
    public function build(FrontOrderDetails $detail, string $newStatus, array $extras = []): array
    {
        $detail->loadMissing([
            'learner',
            'course',
            'cohort',
            'frontOrder',
            'latestInvoice.lines',
        ]);

        $learner = $detail->learner;
        $course = $detail->course;
        $cohort = $detail->cohort;
        $order = $detail->frontOrder;
        $invoice = $detail->latestInvoice;
        $payments = $this->getPaymentsForOrder($order?->id);

        $latestPaid = $payments['latest_paid'];
        $now = Carbon::now();

        $userData = $this->exportModel($learner);
        $enrollmentData = $this->exportModel($detail);
        $orderData = $this->exportModel($order);
        $invoiceData = $this->exportModel($invoice);
        $courseData = array_merge(
            $this->exportModel($course),
            $this->prefixKeys('cohort_', $this->exportModel($cohort))
        );
        $paymentData = $this->exportArray($latestPaid);

        if ($newStatus) {
            $enrollmentData['status'] = $detail->course_status ?? $newStatus;
            $courseData['status'] = $newStatus;
        }

        if ($order) {
            $gross = (($order->total_amount ?? 0) + ($order->tax_amount ?? 0));
            $orderData['gross_total'] = $this->decimalOrNull($gross);
            $orderData['paid_amount'] = $this->decimalOrNull($payments['total_paid'] ?? 0);
            if (isset($orderData['created_at']) && $orderData['created_at'] instanceof \Carbon\CarbonInterface) {
                $orderData['created_at'] = $orderData['created_at']->toDateTimeString();
            }
        }

        if ($invoice && $invoice->invoice_date) {
            $invoiceData['due_date'] = $invoice->invoice_date->toDateString();
        }

        if (!isset($paymentData['paid_at'])) {
            $paymentData['paid_at'] = $now->toDateTimeString();
        }

        $enrollmentData = $this->normalizeMoneyish($enrollmentData, [
            'course_price',
            'cost_price',
            'discount',
            'total_price',
            'vat',
            'remaining_balance',
            'deposit_paid',
        ]);

        $orderData = $this->normalizeMoneyish($orderData, [
            'total_amount',
            'tax_amount',
            'remaining_balance',
            'gross_total',
            'paid_amount',
        ]);

        $invoiceData = $this->normalizeMoneyish($invoiceData, [
            'total_net',
            'total_vat',
            'total_gross',
        ]);

        $paymentData = $this->normalizeMoneyish($paymentData, ['amount']);

        $paymentDetailsHtml = $this->buildPaymentDetailsTable($invoice?->id, $invoiceData);

        return [
            'locale' => 'en',
            'user' => $userData,
            'course' => $courseData,
            'enrollment' => $enrollmentData,
            'order' => $orderData,
            'invoice' => $invoiceData,
            'payment' => $paymentData,
            'payment_details' => $paymentDetailsHtml,
            'extras' => $extras,
        ];
    }

    protected function buildPaymentDetailsTable($invoiceId, array $invoiceData): string
    {
        if (!$invoiceId) return '';

        $rows = ProductInvoicePayment::where('invoice_id', $invoiceId)
            ->orderBy('payment_date')
            ->get();

        $allocated = (float) ProductInvoicePayment::where('invoice_id', $invoiceId)
            ->where(function ($q) {
                $q->whereNull('is_refunded')->orWhere('is_refunded', false);
            })
            ->sum('amount');

        $refunded = (float) ProductInvoicePayment::where('invoice_id', $invoiceId)
            ->where(function ($q) {
                $q->where('is_refunded', true);
            })
            ->sum('amount');

        $gross = (float) ($invoiceData['total_gross'] ?? 0);
        $gross = is_string($gross) ? (float) $gross : $gross;
        $balance = max(0.0, $gross - $allocated);

        $html = '<table border="1" cellpadding="6" cellspacing="0" width="100%">';
        $html .= '<thead><tr>';
        $html .= '<th>#</th><th>Reference</th><th>Date</th><th>Type</th><th>From</th><th>Amount</th><th>Refunded</th>';
        $html .= '</tr></thead><tbody>';

        $i = 1;
        foreach ($rows as $r) {
            $html .= '<tr>';
            $html .= '<td>'.($i++).'</td>';
            $html .= '<td>'.htmlspecialchars((string)$r->payment_ref).'</td>';
            $html .= '<td>'.($r->payment_date ? $r->payment_date->format('Y-m-d H:i') : '').'</td>';
            $html .= '<td>'.htmlspecialchars((string)$r->payment_type).'</td>';
            $html .= '<td>'.htmlspecialchars((string)$r->payment_from).'</td>';
            $html .= '<td>'.number_format((float)$r->amount, 2, '.', '').'</td>';
            $html .= '<td>'.((bool)$r->is_refunded ? 'Yes' : 'No').'</td>';
            $html .= '</tr>';
        }

        if ($rows->isEmpty()) {
            $html .= '<tr><td colspan="7">No payments recorded.</td></tr>';
        }

        $html .= '</tbody><tfoot>';
        $html .= '<tr><th colspan="5" align="right">Total Paid</th><th>'.number_format($allocated, 2, '.', '').'</th><th></th></tr>';
        $html .= '<tr><th colspan="5" align="right">Total Refunded</th><th>'.number_format($refunded, 2, '.', '').'</th><th></th></tr>';
        $html .= '<tr><th colspan="5" align="right">Invoice Gross</th><th>'.number_format($gross, 2, '.', '').'</th><th></th></tr>';
        $html .= '<tr><th colspan="5" align="right">Balance</th><th>'.number_format($balance, 2, '.', '').'</th><th></th></tr>';
        $html .= '</tfoot></table>';

        return $html;
    }

    protected function getPaymentsForOrder($orderId): array
    {
        if (!$orderId) {
            return ['total_paid' => 0, 'latest_paid' => []];
        }

        $successfulStatuses = ['paid', 'success', 'succeeded'];
        $query = FrontPayment::where('order_id', $orderId)->whereIn('status', $successfulStatuses);
        $totalPaid = (float)$query->sum('amount');
        $lastPayment = $query->orderByDesc('id')->first();

        $latestPaid = [];
        if ($lastPayment) {
            $latestPaid = $lastPayment->toArray();
            if (isset($latestPaid['created_at']) && $lastPayment->created_at) {
                $latestPaid['paid_at'] = $lastPayment->created_at->toDateTimeString();
            }
        }

        return ['total_paid' => $totalPaid, 'latest_paid' => $latestPaid];
    }

    protected function exportModel($model): array
    {
        if (!$model) return [];
        $raw = $model->getAttributes();
        foreach ($raw as $key => $val) {
            if ($val instanceof \Carbon\CarbonInterface) {
                $raw[$key] = $val->toDateTimeString();
            }
        }
        return $raw;
    }

    protected function exportArray(array $data): array
    {
        foreach ($data as $k => $v) {
            if ($v instanceof \Carbon\CarbonInterface) {
                $data[$k] = $v->toDateTimeString();
            }
        }
        return $data;
    }

    protected function prefixKeys(string $prefix, array $arr): array
    {
        $out = [];
        foreach ($arr as $k => $v) {
            $out[$prefix . $k] = $v;
        }
        return $out;
    }

    protected function normalizeMoneyish(array $data, array $keys): array
    {
        foreach ($keys as $k) {
            if (array_key_exists($k, $data)) {
                $data[$k] = $this->decimalOrNull($data[$k]);
            }
        }
        return $data;
    }

    protected function decimalOrNull($value): ?string
    {
        if ($value === null) return null;
        return number_format((float)$value, 2, '.', '');
    }
}
