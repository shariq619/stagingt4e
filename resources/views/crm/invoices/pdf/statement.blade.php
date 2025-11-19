<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Statement of Account</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .to-block {
            margin-bottom: 20px;
        }

        .to-block strong {
            font-weight: bold;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th, td {
            border: 1px solid #000;
            padding: 6px 8px;
        }

        th {
            background: #e5e5e5;
            text-align: left;
        }

        .right {
            text-align: right;
            white-space: nowrap;
        }

        .totals {
            margin-top: 15px;
            text-align: right;
        }

        .muted {
            color: #555;
        }

        .payment-row td {
            background: #fafafa;
        }

        .payment-label {
            padding-left: 16px;
        }

        .money {
            display: inline-flex;
            align-items: baseline;
            gap: 2px;
            white-space: nowrap;
        }

        .money-symbol {
            font-weight: bold;
        }

        .money-amount {
            min-width: 55px;
            text-align: right;
        }


        .bold{
            font-size: medium;
        }
    </style>
</head>
<body>
<h1>Statement of Account</h1>

<div class="to-block">
    <p>
        To:<br>
        <strong>{{ $customer->name ?? $customer->company ?? '' }}</strong><br>
        @if(!empty($customer->address))
            {{ $customer->address }}<br>
        @endif
        @if(!empty($customer->address2))
            {{ $customer->address2 }}<br>
        @endif
        @if(!empty($customer->town))
            {{ $customer->town }}<br>
        @endif
        @if(!empty($customer->county))
            {{ $customer->county }}<br>
        @endif
        @if(!empty($customer->postcode))
            {{ $customer->postcode }}<br>
        @endif
    </p>
    <p>Date: {{ $statement_date }}</p>
</div>

<table>
    <thead>
    <tr>
        <th style="width:15%;">Date</th>
        <th style="width:25%;">Invoice Number</th>
        <th style="width:30%;">Details</th>
        <th style="width:10%;" class="right">Debit</th>
        <th style="width:10%;" class="right">Credit</th>
        <th style="width:10%;" class="right">Balance</th>
    </tr>
    </thead>
    <tbody>
    @foreach($rows as $row)
        <tr class="{{ $row['kind'] === 'payment' ? 'payment-row' : '' }}">
            <td>{{ $row['date'] }}</td>
            <td>{{ $row['invoice_no'] }}</td>
            <td class="{{ $row['kind'] === 'payment' ? 'payment-label' : '' }}">
                @if($row['kind'] === 'invoice')
                    <span class="bold">Invoice</span>
                @else
                    <span class="strong">Payment</span>
                    @if(!empty($row['ref']))
                        <span class="muted">({{ $row['ref'] }})</span>
                    @endif
                @endif
            </td>

            <td class="right">
                @if($row['debit'] > 0)
                    <span class="money">
                        <span class="money-symbol">£</span>
                        <span class="money-amount">{{ number_format($row['debit'], 2, '.', ',') }}</span>
                    </span>
                @endif
            </td>
            <td class="right">
                @if($row['credit'] > 0)
                    <span class="money">
                        <span class="money-symbol">£</span>
                        <span class="money-amount">{{ number_format($row['credit'], 2, '.', ',') }}</span>
                    </span>
                @endif
            </td>
            <td class="right">
                <span class="money">
                    <span class="money-symbol">£</span>
                    <span class="money-amount">{{ number_format($row['balance'], 2, '.', ',') }}</span>
                </span>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

<div class="totals">
    <p>
        Total Debit:
        <span class="money">
            <span class="money-symbol">£</span>
            <span class="money-amount">{{ number_format($total_debit, 2, '.', ',') }}</span>
        </span>
        <br>
        Total Credit:
        <span class="money">
            <span class="money-symbol">£</span>
            <span class="money-amount">{{ number_format($total_credit, 2, '.', ',') }}</span>
        </span>
    </p>
</div>
</body>
</html>
