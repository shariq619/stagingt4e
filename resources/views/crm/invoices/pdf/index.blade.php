<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice - PDF</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 13px;
            margin: 0;
            padding: 24px;
        }

        .header {
            width: 100%;
            border-collapse: collapse;
        }

        .header td {
            vertical-align: top;
            font-size: 12px;
            line-height: 1.4;
        }

        .logo {
            width: 220px;
            height: auto;
        }

        .company-details {
            text-align: right;
        }

        .meta-table {
            font-size: 12px;
            margin-top: 8px;
            margin-left: auto;
        }

        .meta-table td {
            padding: 2px 0 4px 8px;
            vertical-align: top;
            white-space: nowrap;
        }

        .meta-k {
            font-weight: bold;
            text-align: left;
        }

        .meta-v {
            text-align: right;
        }

        .invoice-title {
            font-size: 24px;
            font-weight: bold;
            margin: 20px 0 10px 0;
        }

        .billto-block {
            font-size: 13px;
            line-height: 1.5;
            margin-bottom: 16px;
        }

        .main-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 12px;
        }

        .main-table th {
            background: #f2f2f2;
            font-size: 12px;
            text-align: left;
            border: 1px solid #000;
            padding: 6px 8px;
        }

        .main-table td {
            font-size: 12px;
            border: 1px solid #000;
            padding: 6px 8px;
            vertical-align: top;
        }

        .text-right {
            text-align: right;
        }

        .totals-wrapper {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 16px;
        }

        .totals-wrapper td {
            font-size: 12px;
            padding: 4px 8px;
            vertical-align: top;
        }

        .totals-label {
            font-weight: bold;
            text-align: right;
            white-space: nowrap;
        }

        .totals-amt {
            text-align: right;
            min-width: 90px;
            white-space: nowrap;
        }


        .bottom-two-col {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 16px;
        }

        .bottom-two-col td {
            vertical-align: top;
            font-size: 12px;
            line-height: 1.4;
            padding: 0 8px 0 0;
        }

        .delegate-box-title {
            font-weight: bold;
            margin-bottom: 4px;
        }

        .kv-block {
            margin-bottom: 10px;
        }

        .kv-label {
            font-weight: bold;
            display: inline-block;
            min-width: 80px;
        }


        .pay-panel {
            border: 1px solid #000;
            padding: 8px;
            line-height: 1.4;
        }

        .pay-heading {
            font-weight: bold;
            font-size: 12px;
            margin-bottom: 6px;
        }

        .pay-rows {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 6px;
        }

        .pay-row {
            font-size: 11px;
            border-bottom: 1px solid #ccc;
        }

        .pay-row:last-child {
            border-bottom: none;
        }

        .pay-row td {
            padding: 3px 0;
            vertical-align: top;
        }

        .pay-left {
            width: 70%;
        }

        .pay-right {
            width: 30%;
            text-align: right;
            white-space: nowrap;
        }

        .pay-smallline {
            white-space: nowrap;
        }

        .pay-summary {
            font-size: 12px;
            border-top: 1px solid #000;
            padding-top: 6px;
        }

        .pay-summary-row {
            display: flex;
            justify-content: space-between;
            font-weight: bold;
            margin-bottom: 2px;
        }

        .bank-details {
            font-size: 12px;
            line-height: 1.5;
        }

        .bank-heading {
            font-weight: bold;
            margin-bottom: 4px;
        }

        .footer {
            border-top: 1px solid #000;
            padding-top: 8px;
            font-size: 11px;
            line-height: 1.4;
        }

        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>

@php
    $pageBreakStyle = (!empty($page_break) && $page_break)
        ? 'page-break-after: always;'
        : '';
@endphp

<div style="{{ $pageBreakStyle }}">
<table class="header" width="100%">
    <tr>
        <td width="60%">
            <img src="{{ asset('frontend/img/T4E-logo_Full-Colour-e1611494943115.png') }}" class="logo" alt="Logo">
        </td>
        <td width="40%" class="company-details">
            89-91 Hatchett Street<br>
            Birmingham<br>
            B19 3NY<br>
            Tel: 0121 630 2115<br>

            <table class="meta-table">
                <tr>
                    <td class="meta-k">Invoice Date:</td>
                    <td class="meta-v">{{ $invoice_date ?? now()->format('d-m-Y') }}</td>
                </tr>
                <tr>
                    <td class="meta-k">Invoice Number:</td>
                    <td class="meta-v">{{ $invoice_number ?? '-' }}</td>
                </tr>
                <tr style="">
                    <td class="meta-k">Order Number:</td>
                    <td class="meta-v"></td>
                </tr>
                <tr>
                    <td class="meta-k">Invoice Status:</td>
                    <td class="meta-v">{{ $invoice_status ?? '-' }}</td>
                </tr>
            </table>
        </td>
    </tr>
</table>

<div class="invoice-title">INVOICE</div>

<div class="billto-block">
    <strong>{{ $customer['name'] ?? '' }}</strong><br>
    {{ $customer['email'] ?? '' }}
</div>

<table class="main-table">
    <thead>
    <tr>
        <th>Description</th>
        <th>Course Date</th>
        <th class="text-right">Net</th>
        <th class="text-right">Reschedule Fee</th>
        <th class="text-right">Reschedule VAT</th>
        <th class="text-right">VAT</th>
        <th class="text-right">Gross</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>{{ $course['name'] ?? 'N/A' }}</td>
        <td>
            {{ $course['start_date'] ?? '-' }}
{{--            ---}}
{{--            {{ $course['end_date'] ?? '-' }}--}}
        </td>
        <td class="text-right">£{{ number_format($line['net'] ?? 0, 2) }}</td>
        <td class="text-right">£{{ number_format($line['reschedule_fee'] ?? 0, 2) }}</td>
        <td class="text-right">£{{ number_format($line['reschedule_vat'] ?? 0, 2) }}</td>
        <td class="text-right">£{{ number_format($line['vat'] ?? 0, 2) }}</td>
        <td class="text-right">£{{ number_format($line['gross'] ?? 0, 2) }}</td>
    </tr>
    </tbody>
</table>

<table class="totals-wrapper">
    <tr>
        <td width="70%"></td>
        <td class="totals-label">Subtotal (Net + Reschedule):</td>
        <td class="totals-amt">£{{ number_format($line['net_with_fee'] ?? 0, 2) }}</td>
    </tr>
    <tr>
        <td></td>
        <td class="totals-label">VAT (Incl. Reschedule VAT):</td>
        <td class="totals-amt">£{{ number_format($line['vat_with_fee'] ?? 0, 2) }}</td>
    </tr>
    <tr>
        <td></td>
        <td class="totals-label">Gross Total:</td>
        <td class="totals-amt" style="font-weight:bold;">£{{ number_format($line['gross_with_fee'] ?? 0, 2) }}</td>
    </tr>
    <tr>
        <td></td>
        <td class="totals-label">Paid To Date:</td>
        <td class="totals-amt">£{{ number_format($line['paid'] ?? 0, 2) }}</td>
    </tr>
    <tr>
        <td></td>
        <td class="totals-label">Outstanding Balance:</td>
        <td class="totals-amt" style="font-weight:bold;">£{{ number_format($line['outstanding'] ?? 0, 2) }}</td>
    </tr>
</table>

<table class="bottom-two-col" width="100%">
    <tr>
        <td width="55%">
            <div class="kv-block">
                <div class="delegate-box-title">Delegate(s):</div>
                {{ $customer['name'] ?? '' }}
            </div>

            <div class="kv-block">
                <div class="delegate-box-title">Training Course:</div>
                {{ $course['name'] ?? 'N/A' }}
            </div>

            <div class="kv-block">
                <span class="kv-label">Start Date:</span>
                <span>{{ $course['start_date'] ?? '-' }}</span>
            </div>

            <div class="kv-block">
                <span class="kv-label">End Date:</span>
                <span>{{ $course['end_date'] ?? '-' }}</span>
            </div>
        </td>

        <td width="45%">
{{--            @if(!empty($payments['hasPayments']) && $payments['hasPayments'])--}}
{{--                <div class="pay-panel">--}}
{{--                    <div class="pay-heading">Payments Received:</div>--}}

{{--                    <table class="pay-rows" width="100%">--}}
{{--                        @foreach($payments['lines'] as $p)--}}
{{--                            <tr class="pay-row">--}}
{{--                                <td class="pay-left">--}}
{{--                                    <div class="pay-smallline"><strong>Date:</strong> {{ $p['date'] }}</div>--}}
{{--                                    <div class="pay-smallline"><strong>Method:</strong> {{ $p['method'] }}</div>--}}
{{--                                    <div class="pay-smallline"><strong>Ref:</strong> {{ $p['ref'] }}</div>--}}
{{--                                </td>--}}
{{--                                <td class="pay-right">--}}
{{--                                    {{ $p['amount'] }}--}}
{{--                                </td>--}}
{{--                            </tr>--}}
{{--                        @endforeach--}}
{{--                    </table>--}}

{{--                    <div class="pay-summary">--}}
{{--                        <div class="pay-summary-row">--}}
{{--                            <div>Total Paid:</div>--}}
{{--                            <div>{{ $payments['totalPaid'] }}</div>--}}
{{--                        </div>--}}
{{--                        <div class="pay-summary-row">--}}
{{--                            <div>Outstanding:</div>--}}
{{--                            <div>{{ $payments['outstanding'] }}</div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            @else--}}
                <div class="pay-panel">
                    <div class="bank-heading">Bank Details:</div>
                    {{ data_get($bank, 'company_name', 'Training For Employment Ltd') }}<br>
                    {{ data_get($bank, 'bank_line', 'BACS payment – Barclays Bank') }}<br>
                    Sort code – {{ data_get($bank, 'sort_code', '20-08-98') }}<br>
                    Account Number – {{ data_get($bank, 'account_number', '93390780') }}<br>
                    {{ data_get($bank, 'cheque_line', 'Please make all cheques payable to Training For Employment Ltd') }}
                </div>
{{--            @endif--}}
        </td>
    </tr>
</table>

<div class="footer">
    Email: {{ data_get($bank, 'email', 'info@trainingemployment.co.uk') }}<br>
    Telephone: {{ data_get($bank, 'telephone', '0121 630 2115') }}<br>
    Address: {{ data_get($bank, 'address', '89-91 Hatchett Street, Birmingham, B19 3NY') }}<br>
    Company Number: {{ data_get($bank, 'company_number', '07457750') }}
</div>



</body>
</html>
