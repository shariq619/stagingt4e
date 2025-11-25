<!DOCTYPE html>
<html>
<head>
    <title>Invoice - {{ $costing->invoice_number }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            margin: 0;
            padding: 0;
        }

        .d-flex {
            display: flex;
        }

        .align-items-center {
            align-items: center;
        }

        .justify-content-between {
            justify-content: space-between;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }

        .logo {
            width: 250px;
        }

        .company-details {
            text-align: right;
            font-size: 13px;
        }

        .invoice-title {
            font-size: 28px;
            font-weight: bold;
            margin: 30px 0 10px 0;
        }

        .meta-table {
            float: right;
            margin-top: 10px;
        }

        .meta-table td.bold {
            text-align: left;
        }

        .meta-table td {
            padding: 2px 0 8px 8px;
            text-align: right;
        }

        .main-table,
        .main-table th,
        .main-table td {
            border: 1px solid #000;
            border-collapse: collapse;
        }

        .main-table {
            width: 100%;
            margin-top: 30px;
        }

        .main-table th,
        .main-table td {
            padding: 8px;
            text-align: left;
        }

        .main-table th {
            background: #f2f2f2;
        }

        .totals {
            text-align: right;
        }

        .totals td {
            padding: 4px 8px;
        }

        .section {
            margin-top: 30px;
        }

        .bank-details {
            margin-top: 30px;
        }

        .footer {
            margin-top: 40px;
            font-size: 12px;
        }

        .bold {
            font-weight: bold;
        }
    </style>
</head>
<body>
@php
    $net        = (float)($costing->cost_price ?? 0);
    $vat        = (float)($costing->vat ?? 0);
    $discount   = (float)($costing->discount ?? 0);
    $hasDiscount = $discount > 0;
    $gross      = $net + $vat - $discount;
@endphp

<div class="header">
    <div>
        <img src="{{ asset('frontend/img/T4E-logo_Full-Colour-e1611494943115.png') }}" class="logo" alt="Logo">
    </div>
    <div class="company-details">
        Training4Employment<br>
        89-91 Hatchett Street<br>
        Birmingham<br>
        B19 3NY<br>
        Tel: 0121 630 2115<br>
        <table class="meta-table">
            <tr>
                <td class="bold">Invoice Date:</td>
                <td>{{ now()->format('d-m-Y') }}</td>
            </tr>
            <tr>
                <td class="bold">Invoice Number:</td>
                <td>{{ $costing->invoice_number ?? '-' }}</td>
            </tr>
            <tr>
                <td class="bold">Order Number:</td>
                <td>#{{ $costing->latestInvoice->order_no ?? '-' }}</td>
            </tr>
        </table>
    </div>
</div>

<div class="invoice-title">INVOICE</div>

<div>
    <strong>{{ $delegate->name }} {{ $delegate->last_name }}</strong>
</div>

<table class="main-table">
    <thead>
    <tr>
        <th>Description</th>
        <th>Course Date</th>
        <th>Net amount (excl. VAT)</th>
        @if($hasDiscount)
            <th>Discount</th>
        @endif
        <th>VAT amount</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>{{ $costing->course_name ?? 'N/A' }}</td>
        <td>{{ \Carbon\Carbon::parse($costing->cohort->start_date_time)->format('d-m-Y') ?? '-' }}</td>
        <td>£{{ number_format($net, 2) }}</td>
        @if($hasDiscount)
            <td>£{{ number_format($discount, 2) }}</td>
        @endif
        <td>£{{ number_format($vat, 2) }}</td>
    </tr>
    <tr>
        <td colspan="{{ $hasDiscount ? 3 : 2 }}"></td>
        <td class="totals bold">Net amount (excluding VAT)</td>
        <td>£{{ number_format($net, 2) }}</td>
    </tr>
    <tr>
        <td colspan="{{ $hasDiscount ? 3 : 2 }}"></td>
        <td class="totals bold">VAT amount</td>
        <td>£{{ number_format($vat, 2) }}</td>
    </tr>
    @if($hasDiscount)
        <tr>
            <td colspan="3"></td>
            <td class="totals bold">Discount</td>
            <td>£{{ number_format($discount, 2) }}</td>
        </tr>
    @endif
    <tr>
        <td colspan="{{ $hasDiscount ? 3 : 2 }}"></td>
        <td class="totals bold">Gross amount (including VAT)</td>
        <td class="bold">£{{ number_format($gross, 2) }}</td>
    </tr>
    </tbody>
</table>

<div class="d-flex align-items-center justify-content-between">
    <div class="section">
        <strong>Delegate(s) : </strong>
        {{ $delegate->name ?? '' }} {{ $delegate->middle_name ?? '' }} {{ $delegate->last_name ?? '' }}<br>
        <strong>Training Course : </strong>
        {{ $costing->course_name ?? 'N/A' }} <br>
        <strong>Start Date : </strong>
        {{ \Carbon\Carbon::parse($costing->cohort->start_date_time)->format('d-m-Y H:i') ?? '-' }}<br>
        <strong>End Date : </strong>
        {{ \Carbon\Carbon::parse($costing->cohort->end_date_time)->format('d-m-Y H:i') ?? '-' }}
    </div>
    <div class="bank-details">
        <strong>Bank Details:</strong><br>
        Training For Employment Ltd<br>
        BACS payment – Barclays Bank<br>
        Sort code – 20-08-98<br>
        Account Number – 93390780<br>
        Please make all cheques payable to Training For Employment Ltd
    </div>
</div>

<div class="footer">
    Email: <a href="mailto:info@trainingemployment.co.uk">info@trainingemployment.co.uk</a>
    Telephone: 0121 630 2115 Mobile: 07904 010 700<br>
    Address: 89-91 Hatchett Street, Birmingham, B19 3NY Company Number: 07457750
</div>
</body>
</html>
