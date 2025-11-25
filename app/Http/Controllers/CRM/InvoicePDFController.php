<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Controller;
use App\Models\Cohort;
use App\Models\FrontOrderDetails;
use App\Models\ProductInvoice;
use App\Models\ProductInvoicePayment;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class InvoicePDFController extends Controller
{
    public function selected(Request $request)
    {
        $cohortId   = $request->input('cohort_id');
        $learnerIds = (array)$request->input('learner_ids', []);

        if (!$cohortId) {
            return response()->json(['message' => 'Missing cohort.'], 422);
        }
        if (!count($learnerIds)) {
            return response()->json(['message' => 'No learners selected.'], 422);
        }

        $cohort = Cohort::with('course:id,name')
            ->select('id','course_id','start_date_time','end_date_time')
            ->findOrFail($cohortId);

        $users = User::whereIn('id', $learnerIds)
            ->select('id','name','last_name','email')
            ->get()
            ->keyBy('id');

        $invoices = ProductInvoice::with(['cohort.course:id,name','lines','user:id,name,last_name,email'])
            ->where('cohort_id', $cohortId)
            ->whereIn('user_id', $learnerIds)
            ->get()
            ->keyBy('user_id');

        $pages = [];
        foreach ($learnerIds as $uid) {
            $user = $users->get($uid);
            if (!$user) continue;
            $invoice = $invoices->get($uid);
            $pages[] = $this->pageData($cohort, $user, $invoice);
        }

        $pages = array_values(array_filter($pages));
        if (!count($pages)) {
            return response()->json(['message' => 'No invoice data found.'], 422);
        }

        $html = '';
        $last = count($pages) - 1;
        foreach ($pages as $i => $pageData) {
            $pageData['page_break'] = ($i !== $last);
            $html .= view('crm.invoices.pdf.index', $pageData)->render();
        }

        $pdf  = Pdf::loadHTML($html)->setPaper('a4', 'portrait');
        $path = 'invoice-bulk/cohort_'.$cohortId.'_'.time().'.pdf';
        Storage::disk('public')->put($path, $pdf->output());

        return response()->json([
            'ok' => true,
            'pdf_url' => Storage::url($path),
        ]);
    }

    public function cohortPdf($cohortId)
    {
        $cohort = Cohort::with('course:id,name')
            ->select('id','course_id','start_date_time','end_date_time')
            ->findOrFail($cohortId);

        $users = DB::table('cohort_user as cu')
            ->join('users as u','u.id','=','cu.user_id')
            ->where('cu.cohort_id',$cohortId)
            ->select('u.id','u.name','u.last_name','u.email')
            ->orderBy('u.name')
            ->get()
            ->keyBy('id');

        $invoices = ProductInvoice::with(['cohort.course:id,name','lines','user:id,name,last_name,email'])
            ->where('cohort_id', $cohortId)
            ->get()
            ->keyBy('user_id');

        $pages = [];
        foreach ($users as $uid => $user) {
            $invoice = $invoices->get($uid);
            $pages[] = $this->pageData($cohort, $user, $invoice);
        }

        $pages = array_values(array_filter($pages));
        if (!count($pages)) {
            return response()->json(['message' => 'No invoice data found.'], 422);
        }

        $html = '';
        $last = count($pages) - 1;
        foreach ($pages as $i => $pageData) {
            $pageData['page_break'] = ($i !== $last);
            $html .= view('crm.invoices.pdf.index', $pageData)->render();
        }

        $pdf  = Pdf::loadHTML($html)->setPaper('a4', 'portrait');
        $path = 'invoice-bulk/cohort_'.$cohortId.'_'.time().'.pdf';
        Storage::disk('public')->put($path, $pdf->output());

        return response()->json([
            'ok' => true,
            'pdf_url' => Storage::url($path),
        ]);
    }

    protected function pageData(Cohort $cohort, $userObj, ?ProductInvoice $invoice)
    {
        if ($invoice) {
            return $this->fromInvoice($invoice, $userObj);
        }
        return $this->fromFallback($cohort, $userObj->id, $userObj);
    }

    protected function fromInvoice(ProductInvoice $invoice, $userObj)
    {
        $paymentsRaw = ProductInvoicePayment::where('invoice_id', $invoice->id)
            ->where(function ($q) {
                $q->whereNull('is_refunded')->orWhere('is_refunded', false);
            })
            ->orderBy('payment_date','asc')
            ->get();

        $lines = $invoice->lines;

        $normalNet   = (float)$lines->where('is_reassigned', false)->sum('net_amount');
        $normalVat   = (float)$lines->where('is_reassigned', false)->sum('vat_amount');
        $normalGross = (float)$lines->where('is_reassigned', false)->sum('gross_amount');

        $resFeeNet   = (float)$lines->where('is_reassigned', true)->sum('net_amount');
        $resFeeVat   = (float)$lines->where('is_reassigned', true)->sum('vat_amount');
        $resFeeGross = (float)$lines->where('is_reassigned', true)->sum('gross_amount');

        $netWithFee   = $normalNet + $resFeeNet;
        $vatWithFee   = $normalVat + $resFeeVat;
        $grossWithFee = $netWithFee + $vatWithFee;

        $paymentLines = [];
        $totalPaid    = 0.0;

        foreach ($paymentsRaw as $p) {
            $amt = (float)$p->amount;
            $totalPaid += $amt;
            $paymentLines[] = [
                'date'   => $p->payment_date ? $p->payment_date->format('d-m-Y H:i') : '-',
                'method' => $p->payment_type ?? '-',
                'ref'    => $p->payment_ref ?? '-',
                'amount' => '£'.number_format($amt, 2, '.', ''),
            ];
        }

        $paid        = round($totalPaid, 2);
        $outstanding = max(0.0, $grossWithFee - $paid);

        $cRef = $invoice->cohort;


        $courseName = $cRef?->course?->name
            ?? optional($lines->where('is_reassigned', false)->first())->product_description
            ?? 'N/A';


        $startRaw  = $cRef?->start_date_time;
        $endRaw    = $cRef?->end_date_time;

        $startDisp = $startRaw ? Carbon::parse($startRaw)->format('d-m-Y H:i') : '-';
        $endDisp   = $endRaw   ? Carbon::parse($endRaw)->format('d-m-Y H:i')   : '-';

        $rangeDisp = ($startRaw || $endRaw) ? trim($startDisp.' - '.$endDisp) : '-';

        $orderId    = $invoice->order_no ?? null;
        $order_show = $orderId ? '#'.$orderId : '-';

        return [
            'invoice_number' => $invoice->invoice_no ?? '-',
            'order_number'   => $order_show,
            'invoice_date'   => $invoice->invoice_date
                ? $invoice->invoice_date->format('d-m-Y')
                : now()->format('d-m-Y'),
            'invoice_status' => $invoice->invoice_status ?? 'Outstanding',

            'customer' => [
                'name'  => trim(($userObj->name ?? '').' '.($userObj->last_name ?? '')) ?: '-',
                'email' => $userObj->email ?? '-',
            ],

            'course' => [
                'name'        => $courseName,
                'start_date'  => $startDisp,
                'end_date'    => $endDisp,
                'range'       => $rangeDisp,
            ],

            'line' => [
                'net'              => $normalNet,
                'vat'              => $normalVat,
                'gross'            => $normalGross,
                'reschedule_fee'   => $resFeeNet,
                'reschedule_vat'   => $resFeeVat,
                'net_with_fee'     => $netWithFee,
                'vat_with_fee'     => $vatWithFee,
                'gross_with_fee'   => $grossWithFee,
                'paid'             => $paid,
                'outstanding'      => $outstanding,
            ],

            'payments' => [
                'hasPayments' => count($paymentLines) > 0,
                'lines'       => $paymentLines,
                'totalPaid'   => '£'.number_format($paid, 2, '.', ''),
                'outstanding' => '£'.number_format($outstanding, 2, '.', ''),
            ],

            'bank' => config('billing'),
        ];
    }

    protected function fromFallback(Cohort $cohort, $userId, $userObj)
    {
        $fod = FrontOrderDetails::where('cohort_id',$cohort->id)
            ->where('user_id',$userId)
            ->orderByDesc('id')
            ->first();

        if (!$fod) {
            return null;
        }

        $normalNet   = round((float)($fod->total_price ?? 0), 2);
        $normalVat   = round((float)($fod->vat ?? 0), 2);

        $resFeeNet   = round((float)($fod->reassignment_fee_net ?? 0), 2);
        $resFeeVat   = round((float)($fod->reassignment_fee_vat ?? 0), 2);

        $netWithFee   = $normalNet + $resFeeNet;
        $vatWithFee   = $normalVat + $resFeeVat;
        $grossWithFee = $netWithFee + $vatWithFee;

        $paid        = 0.0;
        $outstanding = $grossWithFee;

        $startRaw = $cohort->start_date_time;
        $endRaw   = $cohort->end_date_time;

        $startDisp = $startRaw ? Carbon::parse($startRaw)->format('d-m-Y H:i') : '-';
        $endDisp   = $endRaw   ? Carbon::parse($endRaw)->format('d-m-Y H:i')   : '-';

        $rangeDisp = ($startRaw || $endRaw) ? trim($startDisp.' - '.$endDisp) : '-';

        $orderId    = $fod->order_id ?? null;
        $order_show = $orderId ? '#'.$orderId : '-';

        return [
            'invoice_number' => $fod->invoice_number ?? '-',
            'order_number'   => $order_show,
            'invoice_date'   => now()->format('d-m-Y'),
            'invoice_status' => $fod->status ?? 'Outstanding',

            'customer' => [
                'name'  => trim(($userObj->name ?? '').' '.($userObj->last_name ?? '')) ?: '-',
                'email' => $userObj->email ?? '-',
            ],

            'course' => [
                'name'        => $fod->course_name ?? ($cohort->course?->name ?? 'N/A'),
                'start_date'  => $startDisp,
                'end_date'    => $endDisp,
                'range'       => $rangeDisp,
            ],

            'line' => [
                'net'              => $normalNet,
                'vat'              => $normalVat,
                'gross'            => $netWithFee + $vatWithFee - ($resFeeNet + $resFeeVat),
                'reschedule_fee'   => $resFeeNet,
                'reschedule_vat'   => $resFeeVat,
                'net_with_fee'     => $netWithFee,
                'vat_with_fee'     => $vatWithFee,
                'gross_with_fee'   => $grossWithFee,
                'paid'             => $paid,
                'outstanding'      => $outstanding,
            ],

            'payments' => [
                'hasPayments' => false,
                'lines'       => [],
                'totalPaid'   => '£'.number_format($paid, 2, '.', ''),
                'outstanding' => '£'.number_format($outstanding, 2, '.', ''),
            ],

            'bank' => config('billing'),
        ];
    }

    public function selectedByInvoices(Request $request)
    {
        $ids = array_filter(array_map('intval', (array) $request->input('invoice_ids', [])));

        if (!count($ids)) {
            return response()->json(['message' => 'No invoices selected.'], 422);
        }

        $from = $request->input('from');
        $to   = $request->input('to');
        $fromDate = null;
        $toDate   = null;

        if ($from) {
            try {
                $fromDate = Carbon::createFromFormat('d-m-Y', $from)->startOfDay();
            } catch (\Throwable $e) {}
        }
        if ($to) {
            try {
                $toDate = Carbon::createFromFormat('d-m-Y', $to)->endOfDay();
            } catch (\Throwable $e) {}
        }

        $invoiceQuery = ProductInvoice::with([
            'cohort.course:id,name',
            'lines',
            'user:id,name,last_name,email',
        ])->whereIn('id', $ids);

        if ($fromDate) {
            $invoiceQuery->where('invoice_date', '>=', $fromDate);
        }
        if ($toDate) {
            $invoiceQuery->where('invoice_date', '<=', $toDate);
        }

        $invoices = $invoiceQuery->get();

        if ($invoices->isEmpty()) {
            return response()->json(['message' => 'No invoice data found.'], 422);
        }

        $pages = [];
        foreach ($invoices as $invoice) {
            if (!$invoice->user) {
                continue;
            }
            $pages[] = $this->fromInvoice($invoice, $invoice->user);
        }

        $pages = array_values(array_filter($pages));
        if (!count($pages)) {
            return response()->json(['message' => 'No invoice data found.'], 422);
        }

        $html = '';
        $last = count($pages) - 1;
        foreach ($pages as $i => $pageData) {
            $pageData['page_break'] = ($i !== $last);
            $html .= view('crm.invoices.pdf.index', $pageData)->render();
        }

        $pdf  = Pdf::loadHTML($html)->setPaper('a4', 'portrait');
        $path = 'invoice-bulk/invoices_' . time() . '.pdf';
        Storage::disk('public')->put($path, $pdf->output());

        return response()->json([
            'ok' => true,
            'pdf_url' => Storage::url($path),
        ]);
    }

    public function customerStatement(Request $request, $customerId)
    {
        $customer = User::findOrFail($customerId);
        $userIds = User::where('client_id', $customerId)->pluck('id');

        if ($userIds->isEmpty()) {
            return response()->json([
                'ok' => false,
                'message' => 'No learner accounts found for this customer.',
            ], 422);
        }

        $from = $request->input('from');
        $to   = $request->input('to');
        $fromDate = null;
        $toDate   = null;

        if ($from) {
            try {
                $fromDate = Carbon::createFromFormat('d-m-Y', $from)->startOfDay();
            } catch (\Throwable $e) {}
        }
        if ($to) {
            try {
                $toDate = Carbon::createFromFormat('d-m-Y', $to)->endOfDay();
            } catch (\Throwable $e) {}
        }

        $idsFilter = array_filter(array_map('intval', (array) $request->input('invoice_ids', [])));

        $invoiceQuery = ProductInvoice::whereIn('user_id', $userIds);

        if (count($idsFilter)) {
            $invoiceQuery->whereIn('id', $idsFilter);
        }
        if ($fromDate) {
            $invoiceQuery->where('invoice_date', '>=', $fromDate);
        }
        if ($toDate) {
            $invoiceQuery->where('invoice_date', '<=', $toDate);
        }

        $invoices = $invoiceQuery->orderBy('invoice_date')->get();

        if ($invoices->isEmpty()) {
            return response()->json([
                'ok' => false,
                'message' => 'No invoices found for this customer in the selected range.',
            ], 422);
        }

        $paymentsQuery = ProductInvoicePayment::whereIn('invoice_id', $invoices->pluck('id'))
            ->where(function ($q) {
                $q->whereNull('is_refunded')->orWhere('is_refunded', false);
            });

        if ($fromDate) {
            $paymentsQuery->where('payment_date', '>=', $fromDate);
        }
        if ($toDate) {
            $paymentsQuery->where('payment_date', '<=', $toDate);
        }

        $payments = $paymentsQuery->orderBy('payment_date')->get()->groupBy('invoice_id');

        $rows = [];
        $totalDebit = 0;
        $totalCredit = 0;
        $running = 0;

        foreach ($invoices as $inv) {
            $gross = (float) ($inv->total_gross ?? 0);
            $debit = $gross > 0 ? $gross : 0;
            $credit = $gross < 0 ? abs($gross) : 0;

            $running += ($debit - $credit);
            $totalDebit += $debit;
            $totalCredit += $credit;

            $rows[] = [
                'kind' => 'invoice',
                'date' => $inv->invoice_date ? $inv->invoice_date->format('d/m/Y') : '',
                'invoice_no' => $inv->invoice_no ?? '',
                'ref' => '',
                'debit' => $debit,
                'credit' => $credit,
                'balance' => $running,
            ];

            $invPays = $payments->get($inv->id) ?: collect();

            foreach ($invPays as $pay) {
                $amt = (float) ($pay->amount ?? 0);
                if ($amt <= 0) {
                    continue;
                }

                $running -= $amt;
                $totalCredit += $amt;

                $rows[] = [
                    'kind' => 'payment',
                    'date' => $pay->payment_date ? $pay->payment_date->format('d/m/Y') : '',
                    'invoice_no' => '',
                    'ref' => $pay->payment_ref ?: 'Payment',
                    'debit' => 0,
                    'credit' => $amt,
                    'balance' => $running,
                ];
            }
        }

        $data = [
            'customer' => $customer,
            'rows' => $rows,
            'total_debit' => $totalDebit,
            'total_credit' => $totalCredit,
            'statement_date' => now()->format('d-F-Y'),
        ];

        $html = view('crm.invoices.pdf.statement', $data)->render();

        $pdf = Pdf::loadHTML($html)->setPaper('a4', 'portrait');
        $path = 'statements/customer_' . $customerId . '_' . time() . '.pdf';
        Storage::disk('public')->put($path, $pdf->output());

        return response()->json([
            'ok'       => true,
            'pdf_url'  => Storage::url($path),
            'pdf_path' => $path,
            'filename' => 'Statement_'.$customerId.'.pdf',
            'disk'     => 'public',
            'mime'     => 'application/pdf',
        ]);

    }

    public static function generateSingleInvoicePdf(
        ProductInvoice $invoice,
        User $userObj,
        string $disk = 'public',
        ?string $filePath = null
    ): array {
        $invoice->loadMissing(['cohort.course', 'lines', 'user']);

        $controller = app(self::class);
        $pageData = $controller->fromInvoice($invoice, $userObj);
        $pageData['page_break'] = false;

        $html = view('crm.invoices.pdf.index', $pageData)->render();

        if (!$filePath) {
            $filePath = 'invoice-single/invoice_' . $invoice->id . '_' . time() . '.pdf';
        }

        $diskInstance = Storage::disk($disk);
        $dir = dirname($filePath);

        if ($dir !== '.') {
            $diskInstance->makeDirectory($dir);
        }
        if ($diskInstance->exists($filePath)) {
            $diskInstance->delete($filePath);
        }

        $pdf = Pdf::loadHTML($html)->setPaper('a4', 'portrait');
        $diskInstance->put($filePath, $pdf->output());

        return [
            'path' => $filePath,
            'url'  => $diskInstance->url($filePath),
            'disk' => $disk,
        ];
    }


}
