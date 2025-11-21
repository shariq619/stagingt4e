@extends('crm.layout.main')
@section('title','CRM - Product Invoice (Legacy)')
@push('css')

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/css/select2.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <meta name="stripe-pk" content="{{ config('services.stripe.key') }}">

    <style>
        :root {
            --ink: #0f172a;
            --muted: #6b7280;
            --soft: #e5e7eb;
            --bg: #f3f4f6;
            --card-bg: #ffffff;
            --accent: #1168e6;
            --accent-soft: #e0edff;
            --danger: #ef4444;
            --green: #16a34a;
            --amber: #facc15;


            --ui-bg: var(--bg);
            --ui-soft: #eef1f5;
            --ui-border: #c7cbd3;
            --ui-dark: #2f3b52;
            --ui-blue: var(--accent);
            --ui-green: #20c997;
            --ui-red: #dc3545;
            --ui-chrome-top: #f3f4f6;
            --ui-chrome-bot: #e5e7eb;
            --ui-input: #f9fafb;
            --ui-input-br: #d1d5db;

            --erp-input: var(--ui-input);
            --erp-input-br: var(--ui-input-br);
        }

        body {
            background: radial-gradient(circle at top left, #eef2ff 0, #f3f4f6 45%, #f9fafb 100%);
            color: var(--ui-dark);
            font-size: 13px;
        }

        .container-fluid .btn {
            border-radius: 999px;
        }



        .form-control,
        .form-select,
        textarea {
            background: var(--erp-input);
            border: 1px solid var(--erp-input-br);
            border-radius: 16px;
            box-shadow:
                inset 0 1px 0 #fff,
                inset 0 -1px 0 #e4e7ec;
            height: 32px;
            padding: .35rem .7rem;
            font-size: 12px;
            color: var(--ink);
            transition: all .18s ease-in-out;
        }

        textarea {
            height: auto;
            min-height: 90px;
            resize: vertical;
        }

        .form-control:focus,
        .form-select:focus,
        textarea:focus {
            outline: none;
            background: #fff;
            border-color: var(--accent);
            box-shadow:
                0 0 0 3px rgba(17, 104, 230, .18),
                0 4px 10px rgba(15, 23, 42, .08);
        }

        .form-control[readonly],
        .form-select[readonly],
        textarea[readonly] {
            background: linear-gradient(180deg, #e2e6ea 0%, #eef2f6 100%);
            border-color: #b7bec7;
            color: #374151;
            box-shadow: inset 0 0 0 1px rgba(255,255,255,.4);
        }



        .select2-container--default .select2-selection--single .select2-selection__clear {
            margin-top: -10px !important;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__clear {
            margin-top: -12px !important;
        }

        .select2-selection__clear {
            line-height: 1 !important;
            position: relative;
            top: -2px;
        }

        .select2-container--default .select2-selection--single {
            border: none;
            background: transparent;
            height: auto;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: normal;
            padding-left: 0;
            color: var(--ink);
            font-size: 12px;
        }

        .select2-container .select2-selection--single .select2-selection__arrow {
            height: 32px;
            right: 6px;
        }



        .legacy-wrap {
            background: var(--card-bg);
            border: 1px solid rgba(148, 163, 184, .45);
            margin-top: .9rem;
            border-radius: 20px;
            overflow: hidden;
            box-shadow:
                0 18px 40px rgba(15, 23, 42, .12),
                0 0 0 1px rgba(255,255,255,.7);
        }

        .legacy-toolbar {
            position: sticky;
            top: 0;
            z-index: 20;
            background: linear-gradient(120deg, #eff6ff 0%, #e0f2fe 40%, #f9fafb 100%);
            display: flex;
            gap: 12px;
            justify-content: space-between;
            align-items: center;
            padding: .75rem 1rem;
            border-bottom: 1px solid rgba(148, 163, 184, .4);
            box-shadow: 0 6px 18px rgba(15, 23, 42, .06);
        }

        .legacy-title {
            font-weight: 600;
            color: var(--ink);
            font-size: 1.05rem;
            letter-spacing: .04em;
            text-transform: uppercase;
            display: flex;
            align-items: center;
            gap: .5rem;
        }

        .legacy-badge {
            display: inline-block;
            background: #eef2ff;
            border: 1px solid #c7d2fe;
            border-radius: 999px;
            padding: .18rem .65rem;
            font-weight: 700;
            font-size: .78rem;
            color: #3730a3;
        }

        .toolbar-actions {
            display: flex;
            gap: .5rem;
            flex-wrap: wrap;
            justify-content: flex-end;
        }

        .btn {
            padding: .45rem .9rem;
            border-radius: 999px;
            cursor: pointer;
            border: 1px solid transparent;
            font-size: .82rem;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: .35rem;
            transition: all .16s ease-in-out;
        }

        .btn-sm {
            padding: .35rem .7rem;
            border-radius: 999px;
            font-size: .8rem;
        }

        .btn-blue {
            background: linear-gradient(135deg, #2d8bff, #1168e6);
            border-color: #0e58c3;
            color: #fff;
            box-shadow: 0 6px 16px rgba(37, 99, 235, .35);
        }

        .btn-blue:hover {
            filter: brightness(1.03);
            transform: translateY(-1px);
            box-shadow: 0 8px 20px rgba(37, 99, 235, .4);
        }

        .btn-green {
            background: linear-gradient(135deg, #34d399, #16a34a);
            border-color: #15803d;
            color: #fff;
            box-shadow: 0 6px 16px rgba(22, 163, 74, .32);
        }

        .btn-red {
            background: linear-gradient(135deg, #f97373, #dc2626);
            border-color: #b91c1c;
            color: #fff;
            box-shadow: 0 6px 16px rgba(220, 38, 38, .3);
        }

        .btn-gray {
            background: linear-gradient(135deg, #e5e7eb, #cbd5e1);
            border-color: #cbd5e1;
            color: #111827;
        }

        .btn-outline {
            background: #fff;
            border: 1px solid var(--ui-blue);
            color: var(--ui-blue);
            box-shadow: 0 2px 6px rgba(15, 23, 42, .04);
        }

        .btn-outline:hover {
            background: #eff6ff;
        }

        .btn-minimal {
            background: transparent;
            border: 1px solid #e5e7eb;
            border-radius: 14px;
            padding: 6px 12px;
            font-size: 13px;
            font-weight: 500;
            color: #374151;
            transition: all 0.2s ease-in-out;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .btn-minimal:hover,
        .btn-minimal:focus {
            background: #f9fafb;
            border-color: #d1d5db;
            color: #111827;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08);
        }

        .btn-minimal:active {
            background: #f3f4f6;
            transform: scale(0.98);
        }

        .btn-minimal i {
            font-size: 14px;
            color: inherit;
        }

        .btn.disabled,
        .btn:disabled {
            opacity: .55;
            cursor: not-allowed;
            box-shadow: none;
            transform: none;
        }



        .pi-body {
            padding: 1rem 1rem 1.1rem;
            background: radial-gradient(circle at top right, #eff6ff 0, #ffffff 45%, #f9fafb 100%);
        }

        .pi-grid {
            display: grid;
            grid-template-columns: 370px 1fr;
            gap: 1rem;
        }

        .pi-box {
            border: 1px solid rgba(148, 163, 184, .4);
            border-radius: 18px;
            overflow: hidden;
            background: #ffffff;
            box-shadow: 0 10px 24px rgba(15, 23, 42, .08);
        }

        .pi-h {
            background: linear-gradient(135deg, #0f172a, #1f2937);
            color: #fff;
            padding: .5rem .9rem;
            font-weight: 600;
            border-bottom: 1px solid #020617;
            letter-spacing: .05em;
            text-transform: uppercase;
            font-size: .78rem;
        }

        .pi-b {
            padding: .75rem .85rem .85rem;
        }

        .mini {
            font-size: .8rem;
        }



        .field-row {
            display: grid;
            grid-template-columns: 170px 260px 60px 1fr;
            gap: .45rem;
            align-items: center;
            margin-bottom: .55rem;
        }

        .field-row label {
            color: #495057;
            font-weight: 600;
            font-size: .8rem;
        }

        .hl {
            background: var(--ui-input);
            border: 1px solid var(--ui-input-br);
            border-radius: 14px;
            padding: .3rem .6rem;
            width: 100%;
            box-shadow:
                inset 0 1px 0 #fff,
                inset 0 -1px 0 #e4e7ec;
            font-size: 12px;
            color: var(--ink);
        }

        .field-row .hl[readonly] {
            background: linear-gradient(180deg, #e2e6ea 0%, #eef2f6 100%);
            border-color: #b7bec7;
            color: #374151;
        }

        .pill {
            display: inline-flex;
            align-items: center;
            gap: .35rem;
            border: 1px solid #cbd5e1;
            border-radius: 999px;
            background: #f9fafb;
            padding: .2rem .6rem;
        }

        .pill select {
            border: none;
            background: transparent;
            outline: 0;
            font-size: 12px;
        }

        .mini-btn {
            border: 1px solid #cbd5e1;
            background: #fff;
            border-radius: .5rem;
            padding: .18rem .5rem;
            font-weight: 700;
            font-size: .75rem;
        }

        .az {
            background: var(--accent);
            color: #fff;
            border: 1px solid #0e58c3;
            border-radius: 999px;
            padding: 6px 14px;
            font-weight: 600;
            font-size: .78rem;
            cursor: pointer;
            box-shadow: 0 4px 10px rgba(37, 99, 235, .32);
        }

        .az:hover {
            background: #1454c7;
        }



        .cust-card {
            display: grid;
            grid-template-rows: auto 1fr auto auto;
            gap: .45rem;
        }

        .cust-pill {
            display: flex;
            gap: .4rem;
            flex-wrap: wrap;
        }

        .cust-pill .cp {
            background: #e5e7eb;
            border: 1px solid #cbd5e1;
            border-radius: 999px;
            padding: .25rem .6rem;
            font-weight: 600;
            font-size: .75rem;
            color: #111827;
        }

        .cust-text {
            height: 145px;
            border: 1px solid #cbd5e1;
            border-radius: 14px;
            background: var(--ui-input);
            padding: .5rem .7rem;
            font-size: 12px;
        }

        .kv {
            display: grid;
            grid-template-columns: 90px 1fr;
            gap: .4rem;
            align-items: center;
            font-size: 12px;
            color: var(--muted);
        }



        .classic-hd {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            font-size: 12px;
            color: var(--muted);
            gap: 16px;
            margin: .4rem 0;
            flex-wrap: wrap;
        }

        .switch {
            appearance: none;
            width: 18px;
            height: 18px;
            border: 1px solid #cbd5e1;
            border-radius: 4px;
            background: #fff;
        }

        .classic-toolbar {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: .6rem;
            margin: .35rem 0;
        }

        .yellow-sel {
            background: #fffbeb;
            border: 1px solid #facc15;
            border-radius: 18px;
            padding: .35rem .6rem;
            width: 100%;
            font-size: 12px;
        }



        .lines-card {
            border: 1px solid #cbd5e1;
            border-radius: 12px;
            overflow: hidden;
            background: #fff;
            box-shadow: 0 8px 20px rgba(15, 23, 42, .06);
            margin-top: .8rem;
        }

        .lines-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            table-layout: fixed;
        }

        .lines-table th,
        .lines-table td {
            border-bottom: 1px solid #e2e8f0;
            padding: .38rem .5rem;
            font-size: 12px;
            vertical-align: middle;
        }

        .lines-head th {
            background: linear-gradient(120deg, #0f172a, #111827);
            color: #e5e7eb;
            border-bottom: 1px solid #020617;
            text-transform: uppercase;
            letter-spacing: .06em;
            font-weight: 600;
            font-size: 11px;
        }

        .lines-table tbody tr:nth-child(even) td {
            background: #f9fafb;
        }

        .lines-table tbody tr:hover td {
            background: #eff6ff;
        }

        .lines-table td input {
            width: 100%;
            border: none;
            background: #f3f4f6;
            border-radius: 6px;
            padding: .3rem .4rem;
            font-size: 12px;
        }

        .chk {
            width: 16px;
            height: 16px;
        }

        .line-row.mode-edit .cell-view {
            display: none;
        }

        .line-row.mode-edit .cell-edit {
            display: inline;
        }

        .cell-view {
            display: inline;
        }

        .cell-edit {
            display: none;
        }

        .line-actions a {
            margin-right: 10px;
            font-size: 11px;
        }

        .line-actions a.disabled {
            pointer-events: none;
            opacity: .5;
        }

        .text-end {
            text-align: right;
        }



        .row-under {
            /*display: grid;*/
            grid-template-columns: 220px auto 1fr;
            gap: .6rem;
            align-items: center;
            margin: .45rem .65rem .6rem;
        }

        .row-under input {
            border: 1px solid #cbd5e1;
            border-radius: 999px;
            padding: .35rem .6rem;
            background: #fff;
            font-size: 12px;
        }



        .split-2 {
            display: grid;
            grid-template-columns: 1fr 460px;
            gap: 1.2rem;
            margin-top: .9rem;
        }

        .note-box {
            height: 160px;
            border: 1px solid #cbd5e1;
            border-radius: 14px;
            width: 100%;
            padding: .6rem .75rem;
            background: var(--ui-input);
            font-size: 12px;
        }



        .totals-card {
            background: #ffffff;
            border: 1px solid #d0d5dd;
            border-radius: 16px;
            padding: 1rem .95rem;
            margin-top: .2rem;
            box-shadow: 0 8px 20px rgba(15, 23, 42, .06);
        }

        .totals-title {
            font-weight: 600;
            color: #111827;
            margin-bottom: .75rem;
            font-size: .9rem;
            letter-spacing: .04em;
            text-transform: uppercase;
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: .55rem;
            gap: .5rem;
        }

        .total-row.highlight {
            background: #eff6ff;
            border-radius: 10px;
            padding: .5rem .65rem;
            font-weight: 700;
        }

        .label-flex {
            display: flex;
            align-items: center;
            gap: 6px;
            white-space: nowrap;
            font-size: 12px;
            color: var(--muted);
        }

        .info-icon {
            font-size: 14px;
            color: #9ca3af;
            cursor: pointer;
        }

        .info-icon:hover {
            color: #2563eb;
        }

        .input-group {
            display: flex;
            align-items: center;
            gap: 6px;
            flex: 1;
            justify-content: flex-end;
            flex-wrap: wrap;
        }

        .divider {
            height: 1px;
            background: #e5e7eb;
            margin: .8rem 0 .7rem;
        }

        .totals-card input {
            text-align: right;
            width: 140px;
            padding: 6px 8px;
            border: 1px solid #cfd5dc;
            border-radius: 10px;
            transition: .2s;
            font-variant-numeric: tabular-nums;
            font-size: 12px;
        }

        .totals-card input:focus {
            background: #fff;
            border-color: #0e58c3;
            outline: 0;
            box-shadow: 0 0 0 3px rgba(17, 104, 230, .15);
        }

        .totals-card input[readonly] {
            background: linear-gradient(180deg, #e2e6ea 0%, #eef2f6 100%);
            border-color: #b7bec7;
            color: #374151;
        }



        .payments-card {
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 8px 20px rgba(15, 23, 42, .06);
            padding: 18px 16px;
            margin-top: 1rem;
            border: 1px solid #e2e8f0;
        }

        .payments-title {
            font-size: .9rem;
            font-weight: 600;
            color: #111827;
            margin-bottom: .65rem;
            letter-spacing: .04em;
            text-transform: uppercase;
        }

        .payments-card table {
            width: 100%;
            border-collapse: collapse;
        }

        .payments-card th,
        .payments-card td {
            padding: 8px 10px;
            text-align: left;
            font-size: 12px;
        }

        .payments-card th {
            background: #f3f4f6;
            color: #4b5563;
            font-weight: 600;
            border-bottom: 1px solid #e5e7eb;
        }

        .payments-card tr:nth-child(even) {
            background: #f9fafb;
        }

        .payments-card td {
            color: #111827;
            font-variant-numeric: tabular-nums;
        }



        .savebar {
            position: sticky;
            bottom: 0;
            background: #f1f5f9;
            border-top: 1px solid #cbd5e1;
            padding: .55rem .8rem;
            display: flex;
            gap: .6rem;
            flex-wrap: wrap;
            justify-content: flex-end;
        }

        .savebar .btn {
            background: var(--ui-blue);
            color: #fff;
            border: 1px solid var(--ui-blue);
            padding: .45rem .9rem;
            box-shadow: 0 4px 12px rgba(37, 99, 235, .32);
        }

        .savebar .btn.secondary {
            background: #6c757d;
            border-color: #6c757d;
            box-shadow: none;
        }

        .savebar .btn.danger {
            background: var(--ui-red);
            border-color: var(--ui-red);
            box-shadow: 0 4px 12px rgba(220, 38, 38, .32);
        }



        #generateInvoiceModal,
        #reassignModal,
        #courseBrowser {
            z-index: 99999999999999 !important;
        }

        .swal2-container,
        #stripeModal {
            z-index: 99999999999999 !important;
        }



        @media (max-width: 1200px) {
            .pi-grid {
                grid-template-columns: 1fr;
            }

            .split-2 {
                grid-template-columns: 1fr;
            }

            .totals-card input {
                width: 120px;
            }
        }

        @media (max-width: 768px) {
            .field-row {
                grid-template-columns: 1fr;
                gap: .4rem;
            }

            .row-under {
                grid-template-columns: 1fr;
            }

            .classic-toolbar {
                grid-template-columns: 1fr;
            }

            .total-row {
                flex-wrap: wrap;
            }

            .label-flex {
                white-space: normal;
            }

            .input-group {
                justify-content: flex-start;
            }

            .totals-card input {
                width: 100%;
            }
        }

        .page-readonly {
            pointer-events: none !important;
            opacity: 0.7;
        }

        .toolbar-readonly {
            pointer-events: none !important;
        }

    </style>
@endpush


@section('main')
    @php
        $statusOptions = function_exists('getInvoiceStatuses')
            ? (array) getInvoiceStatuses()
            : ['Outstanding', 'Paid', 'Unpaid'];

        $currentInvoiceStatus = isset($invoice) && !empty($invoice->invoice_status)
            ? (string) $invoice->invoice_status
            : (function_exists('invoiceStatusDefault') ? (string) invoiceStatusDefault() : 'Outstanding');
    @endphp

    @include('crm.alerts.messages')

    <div class="container-fluid px-3 py-3 ">
        <div class="legacy-wrap">
            <div class="legacy-toolbar">
                <div class="legacy-title">Product Invoice: <span class="legacy-badge" id="pi_no">-</span></div>
                <div class="toolbar-actions">
                    <button class="btn btn-blue" id="btnTakePayment">Take Payment</button>
                    <button class="btn btn-outline btn-stripe-br" id="btnStripeBR">Refund</button>
                    <button class="btn btn-outline" id="btnAddPayment"
                            onclick="location.href='{{ route('crm.payments.create', ['invoice' => $invoice->id ?? '__ID__']) }}'">
                        Add Payment
                    </button>
                    <button class="btn btn-green d-none" id="btnSaveTop">Save</button>
                    <button class="btn btn-green d-none" id="btnSaveExitTop">Save and Exit</button>
                    <button class="btn btn-gray d-none" id="btnCancelTop">Cancel</button>
                    <button class="btn btn-red d-none" id="btnDeleteTop">Delete</button>
                </div>
            </div>

            <div class="pi-body">
                <div class="pi-grid">
                    <div class="pi-box">
                        <div class="pi-h">Customer Details</div>
                        <div class="pi-b cust-card">
                            <div class="cust-pill d-none">
                                <span class="cp" id="cust_code">-</span>
                                <button class="cp" type="button">A-Z</button>
                                <span class="cp">👥 0</span>
                                <span class="cp" id="cust_tc">-</span>
                            </div>
                            <textarea class="cust-text form-control" id="cust_name" readonly></textarea>
                            <div class="kv"><span>Telephone:</span><input class="hl" id="cust_tel_in" readonly></div>
                            <div class="kv"><span>Mobile:</span><input class="hl" id="cust_mobile_in" readonly></div>
                        </div>
                    </div>

                    <div class="pi-box">
                        <div class="pi-h">Header</div>
                        <div class="pi-b">
                            <div class="field-row">
                                <label>Print Invoice:</label>
                                <div class="pill" style="grid-column: span 3">
                                    <select id="print_invoice" disabled>
                                        <option>Invoice</option>
                                        <option>Proforma</option>
                                        <option>Receipt</option>
                                    </select>
                                    <button class="btn btn-minimal" id="open_generate_invoice">
                                        <i class="bi bi-receipt"></i> Print Invoice
                                    </button>
                                </div>
                            </div>

                            <div class="field-row">
                                <label>Invoice Date:</label>
                                <input id="invoice_date_in" type="text" class="hl"><span
                                    class="mini-btn d-none">🗓</span><span></span>
                            </div>

                            <div class="field-row">
                                <label>Invoice Status:</label>
                                <div class="pill" style="width:260px">
                                    <select id="invoice_status_in" name="invoice_status" disabled>
                                        @foreach($statusOptions as $s)
                                            <option
                                                value="{{ $s }}" {{ $s === $currentInvoiceStatus ? 'selected' : '' }}>
                                                {{ $s }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <span></span><span></span>
                            </div>

                            <div class="field-row d-none">
                                <label>Order Number:</label>
                                <input class="hl" id="order_number_in">
                                <label>Delivery Date:</label>
                                <div class="date-field">
                                    <input class="hl" id="delivery_date_in">
                                    <span class="mini-btn d-none">🗓</span>
                                </div>
                            </div>

                            <div class="field-row">
                                <label class="label-flex">Nominal Code
                                    <i class="bi bi-info-circle info-icon" title="Ledger nominal for this invoice."></i>
                                </label>
                                <select class="hl" id="nominal_code_id" style="width:260px"></select>
                                <button class="az" type="button" id="btnNominalAZ">A-Z</button>
                                <input class="hl" id="nominal_code_2" readonly>
                            </div>

                            <div class="field-row">
                                <label class="label-flex">Project Code
                                    <i class="bi bi-info-circle info-icon"
                                       title="Optional project/job to associate."></i>
                                </label>
                                <select class="hl" id="project_code_id" style="width:260px"></select>
                                <button class="az" type="button" id="btnProjectAZ">A-Z</button>
                                <input class="hl" id="project_code_2" readonly>
                            </div>

                            <div class="field-row">
                                <label class="label-flex">Source
                                    <i class="bi bi-info-circle info-icon"
                                       title="Marketing/source channel attribution."></i>
                                </label>
                                <select class="hl" id="source_id" style="width:260px"></select>
                                <button class="az" type="button" id="btnSourceAZ">A-Z</button>
                                <input class="hl" id="source_2" readonly>
                            </div>

                            <div class="field-row">
                                <label class="label-flex">Department
                                    <i class="bi bi-info-circle info-icon"
                                       title="Business unit/department for reporting."></i>
                                </label>
                                <select class="hl" id="department_id" style="width:260px"></select>
                                <button class="az" type="button" id="btnDeptAZ">A-Z</button>
                                <input class="hl" id="department_2" readonly>
                            </div>

                            <div class="field-row d-none">
                                <label>Booking Reference:</label>
                                <input class="hl" id="booking_ref_in" style="grid-column: span 3">
                            </div>

                            <div class="field-row d-none">
                                <label>Payment Terms (Days):</label>
                                <div class="pill">
                                    <input class="hl" id="payment_terms_in"
                                           style="width:70px;background:#fff;border:none;padding:0">
                                    <span class="mini">days</span>
                                </div>
                                <span></span><span></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="classic-hd d-none">
                    <div>Only Include Amounts from Ticked Records on Print: <input type="checkbox" class="switch"></div>
                    <div>Show Header, Sub-Header & Category Icon: <input type="checkbox" class="switch"></div>
                    <div style="margin-left:auto;display:flex;gap:8px;align-items:center">
                        <button class="az">✉</button>
                        <button class="az">⤴</button>
                    </div>
                </div>

                <div class="classic-toolbar d-none">
                    <select class="yellow-sel" id="sel_category"></select>
                    <select class="yellow-sel" id="sel_product"></select>
                </div>

                <div class="lines-card">
                    <div style="overflow-x: auto;">
                        <table class="table table-sm table-bordered mb-0 align-middle text-nowrap lines-table"
                               style="min-width: 1400px;">
                            <thead class="table-light text-center lines-head">
                            <tr>
                                <th style="width: 60px;">Item</th>
                                <th style="width: 60px;">Qty</th>
                                <th style="width: 150px;">Product Code</th>
                                <th style="width: 400px;">Product Description</th>
                                <th style="width: 110px;">Unit Cost</th>
                                <th style="width: 110px;">Discount</th>
                                <th style="width: 80px;">VAT %</th>
                                <th style="width: 120px;">Net Amount</th>
                                <th style="width: 120px;">VAT Amount</th>
                                <th style="width: 120px;">Total Amount</th>
                                <th style="width: 95px;">Assembly</th>
                                <th style="width: 100px;">Weight</th>
                                <th style="width: 90px;">Action</th>
                            </tr>
                            </thead>
                            <tbody id="lines-tbody">

                            </tbody>
                        </table>
                    </div>

                    <div class="row-under">
                        <input id="under_code" class="d-none">
                        <button type="button" class="btn btn-primary m-1 open-reassign">Reassign to other courses</button>
                        <select id="under_product" class="yellow-sel d-none"></select>
                    </div>

                </div>

                <div class="row g-3 mt-2">
                    <div class="col-12 col-lg-4">
                        <div style="margin:.4rem 0;font-weight:600">Additional Invoice Details:</div>
                        <textarea id="additional_invoice_details" class="note-box"></textarea>
                    </div>
                    <div class="col-12 col-lg-8">
                        <div class="totals-card">
                            <h5 class="totals-title">Invoice Summary</h5>

                            <div class="total-row">
                                <span class="label-flex">Total Net Amount <i class="bi bi-info-circle info-icon"
                                                                             title="Sum of all line items' net amounts after per-line gross discounts, before header discount."></i></span>
                                <input id="total_net" readonly value="0.00">
                            </div>
                            <div class="d-none">
                                <div class="total-row">
                                <span class="label-flex">Carriage <i class="bi bi-info-circle info-icon"
                                                                     title="Additional cost for delivery or transportation."></i></span>
                                    <input id="carriage" value="0.00">
                                </div>

                                <div class="total-row d-none">
                                <span class="label-flex">Discount <i class="bi bi-info-circle info-icon"
                                                                     title="Invoice-level discount (net), before VAT adjust by 'Gross Discount VAT Rate'."></i></span>
                                    <div class="input-group">
                                        <input id="discount_amount" value="0.00" style="width:110px">
                                        <span>%</span>
                                        <input id="discount_percent" value="0.00" style="width:110px">
                                    </div>
                                </div>

                                <div class="total-row">
                                <span class="label-flex">Gross Discount VAT Rate <i class="bi bi-info-circle info-icon"
                                                                                    title="VAT rate applicable to invoice-level discount (carried as gross effect)."></i></span>
                                    <div class="input-group">
                                        <input id="discount_vat_rate" value="0.00" style="width:110px">
                                        <button class="az">A–Z</button>
                                    </div>
                                </div>

                                <div class="total-row">
                                <span class="label-flex">Total Miscellaneous Cost <i class="bi bi-info-circle info-icon"
                                                                                     title="Other additional costs or service fees."></i></span>
                                    <input id="misc_cost" value="0.00" readonly>
                                </div>
                            </div>

                            <div class="divider"></div>

                            <div class="total-row highlight">
                                <span class="label-flex"><b>New Total Net Amount</b> <i
                                        class="bi bi-info-circle info-icon"
                                        title="Final net after invoice-level discount, carriage and misc (VAT not included)."></i></span>
                                <input id="new_total_net" readonly value="0.00">
                            </div>

                            <div class="total-row">
                                <span class="label-flex">VAT Amount <i class="bi bi-info-circle info-icon"
                                                                       title="Total VAT after invoice-level discount VAT adjustment."></i></span>
                                <input id="total_vat" readonly value="0.00">
                            </div>

                            <div class="total-row">
                                <span class="label-flex">Invoice Balance <i class="bi bi-info-circle info-icon"
                                                                            title="Remaining unpaid balance."></i></span>
                                <input id="invoice_balance" readonly value="0.00">
                            </div>

                            <div class="total-row">
                                <span class="label-flex">Invoice Amount <i class="bi bi-info-circle info-icon"
                                                                           title="Grand total payable."></i></span>
                                <input id="total_gross" readonly value="0.00">
                            </div>
                        </div>

                        <div class="payments-card">
                            <h5 class="payments-title">Payments</h5>
                            <table class="w-100">
                                <thead>
                                <tr>
                                    <th>Payment Ref.</th>
                                    <th>Payment Date</th>
                                    <th>Payment Amount</th>
                                </tr>
                                </thead>
                                <tbody id="payments-tbody"></tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>

            <div class="savebar d-none">
                <button class="btn" id="btnSave">Save</button>
                <button class="btn" id="btnSaveExit">Save and Exit</button>
                <button class="btn secondary" id="btnCancel">Cancel</button>
                <button class="btn danger" id="btnDelete">Delete</button>
            </div>
        </div>
    </div>

    @include('crm.invoices.partials.stripe_modal')
    @include('crm.training-courses.partials.reassign')

@endsection


@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/js/select2.full.min.js"></script>
    <script src="https://js.stripe.com/v3/"></script>
    <script>window.INV_ID = "{{ $invoice->id }}";</script>
    <script src="{{ asset('js/crm/stripe.js') }}"></script>
    <script src="{{ asset('js/crm/stripe_balance.js') }}"></script>
    <script src="{{ asset('js/crm/reassign.js') }}"></script>

    <script>
        $(function () {
            let hydrating = true, saveTimer = null, lastDiscountChange = null, activeRow = null;

            function csrf() {
                return $('meta[name="csrf-token"]').attr('content')
            }

            function invoiceId() {
                return "{{ $invoice->id }}"
            }

            function money(n) {
                return Number(n || 0).toFixed(2)
            }

            function n(v) {
                return parseFloat(v) || 0
            }

            function toast(t, i) {
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    timer: 1800,
                    showConfirmButton: false,
                    title: t,
                    icon: i || 'success'
                })
            }

            function setAddPaymentState(balance, fullyFlag) {
                const ids = ['btnAddPayment', 'btnTakePayment'];
                ids.forEach(id => {
                    const btn = document.getElementById(id);
                    if (!btn) return;
                    const shouldEnable = !fullyFlag && (parseFloat(balance) > 0.0001);
                    btn.disabled = !shouldEnable;
                    btn.classList.toggle('disabled', !shouldEnable);
                });
            }


            function ensureBreakdownCard() {
                if ($('.line-breakdown-card').length) return;
                const html = `
        <div class="line-breakdown-card" style="margin:10px 0; padding:12px; border:1px solid #e5e7eb; border-radius:8px; background:#fafafa">
            <div style="display:flex; align-items:center; gap:8px; margin-bottom:8px;">
                <i class="bi bi-calculator"></i>
                <strong>Line Breakdown</strong>
            </div>
            <div style="overflow:auto;">
                 <table class="table table-sm table-bordered mb-0 align-middle text-nowrap" id="bd-table" style="min-width: 1600px;">
                        <thead class="table-light text-center">
                            <tr>
                                <th style="width: 50px;">#</th>
                                <th style="width: 70px;">Qty</th>
                                <th style="width: 140px;">Product Code</th>
                                <th style="width: 400px;">Product Description</th>
                                <th style="width: 110px;">Unit Net</th>
                                <th style="width: 110px;">Discount</th>
                                <th style="width: 80px;">VAT %</th>
                                <th style="width: 120px;">Net Before</th>
                                <th style="width: 120px;">VAT Before</th>
                                <th style="width: 120px;">Gross Before</th>
                                <th style="width: 120px;">Net After</th>
                                <th style="width: 120px;">VAT After</th>
                                <th style="width: 120px;">Gross After</th>
                                <th style="width: 95px;">Assembly</th>
                                <th style="width: 100px;">Weight</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
            </div>
        </div>`;
                $('.classic-toolbar').after(html);
            }

            function computeFromInputs(qty, unitNet, vatRate, discountGross) {
                const rateFactor = 1 + (vatRate / 100);
                const net0 = Math.max(0, qty * unitNet);
                const vat0 = net0 * (vatRate / 100);
                const gross0 = net0 + vat0;
                const discApplied = Math.max(0, Math.min(discountGross, gross0));
                const gross1 = gross0 - discApplied;
                const net1 = gross1 / rateFactor;
                const vat1 = gross1 - net1;
                return {net0, vat0, gross0, discApplied, net1, vat1, gross1};
            }

            function renderAllBreakdownsFromJson(lines) {
                ensureBreakdownCard();
                const $tb = $('#bd-table tbody');
                let rows = '';
                (lines || []).forEach((x, idx) => {
                    const qty = Number(x.qty || 1);
                    const unitN = Number(x.unit_cost || 0);
                    const rateN = Number(x.vat_rate || 0);
                    const discN = Number(x.discount || 0);
                    const r = computeFromInputs(qty, unitN, rateN, discN);
                    rows += `
              <tr>
                <td class="text-end">${idx + 1}</td>
                <td class="text-end">${qty}</td>
                <td>${x.product_code || ''}</td>
                <td>${x.product_description || ''}</td>
                <td class="text-end">${money(unitN)}</td>
                <td class="text-end">${money(discN)}</td>
                <td class="text-end">${money(rateN)}</td>
                <td class="text-end">${money(r.net0)}</td>
                <td class="text-end">${money(r.vat0)}</td>
                <td class="text-end">${money(r.gross0)}</td>
                <td class="text-end">${money(r.net1)}</td>
                <td class="text-end">${money(r.vat1)}</td>
                <td class="text-end">${money(r.gross1)}</td>
                <td class="text-end">${x.assembly ? 'Yes' : 'No'}</td>
                <td class="text-end">${x.weight != null ? Number(x.weight) : ''}</td>
              </tr>`;
                });
                $tb.html(rows);
            }

            function renderAllBreakdownsFromDom() {
                const lines = [];
                $('#lines-tbody .line-row').each(function () {
                    const tr = $(this);
                    lines.push({
                        qty: Number(tr.find('.line-qty').val() || 1),
                        product_code: tr.find('.line-code').val() || '',
                        product_description: tr.find('.line-desc').val() || '',
                        unit_cost: Number(tr.find('.line-unit').val() || 0),
                        discount: Number(tr.find('.line-discount').val() || 0),
                        vat_rate: Number(tr.find('.line-vat').val() || 0),
                        assembly: tr.find('.line-assembly').is(':checked'),
                        weight: tr.find('.line-weight').val() || null
                    });
                });
                renderAllBreakdownsFromJson(lines);
            }

            function lineRow(x, i) {
                const qty = x.qty || 1;
                const unitN = parseFloat(x.unit_cost) || 0;
                const rateN = parseFloat(x.vat_rate) || 0;
                const discN = parseFloat(x.discount || 0) || 0;
                const isRe = !!x.is_reassigned;
                const r = computeFromInputs(qty, unitN, rateN, discN);
                const unit = money(unitN);
                const disc = money(discN);
                const net = money(r.net1);
                const vatAmt = money(r.vat1);
                const gross = money(r.gross1);
                const asm = x.assembly ? 'Yes' : 'No';
                const weight = (x.weight ?? '') === '' ? '' : Number(x.weight);
                const dis = isRe ? 'disabled' : '';
                return `<tr class="line-row ${isRe ? 'mode-edit' : 'mode-view'}" data-id="${x.id}" data-is-reassigned="${isRe ? 1 : 0}">
            <td class="text-end">${i}</td>
            <td class="text-end"><span class="cell-view">${qty}</span><input class="cell-edit line-qty" type="number" min="1" value="${qty}" ${dis}></td>
            <td><span class="cell-view">${x.product_code || ''}</span><input class="cell-edit line-code" value="${x.product_code || ''}" ${dis}></td>
            <td><span class="cell-view">${x.product_description || ''}</span><input class="cell-edit line-desc" value="${x.product_description || ''}" ${dis}></td>
            <td class="text-end"><span class="cell-view v-unit">${unit}</span><input class="cell-edit line-unit" type="number" step="0.01" value="${unit}"></td>
            <td class="text-end"><span class="cell-view v-discount">${disc}</span><input class="cell-edit line-discount" type="number" step="0.01" value="${disc}" ${dis}></td>
            <td class="text-end"><span class="cell-view v-rate">${money(rateN)}</span><input class="cell-edit line-vat" type="number" step="0.01" value="${money(rateN)}"></td>
            <td class="text-end"><span class="v-net">${net}</span><span class="cell-edit calc-net" style="display:none">${net}</span></td>
            <td class="text-end"><span class="v-vat">${vatAmt}</span><span class="cell-edit calc-vat" style="display:none">${vatAmt}</span></td>
            <td class="text-end"><span class="v-gross">${gross}</span><span class="cell-edit calc-gross" style="display:none">${gross}</span></td>
            <td class="text-end"><span class="cell-view">${asm}</span><input class="cell-edit chk line-assembly" type="checkbox" ${x.assembly ? 'checked' : ''} ${dis}></td>
            <td class="text-end"><span class="cell-view">${weight === '' ? '' : weight}</span><input class="cell-edit line-weight" type="number" step="0.001" value="${weight === '' ? '' : weight}" ${dis}></td>
            <td class="line-actions">
                <div class="cell-view" ${isRe ? 'style="display:none"' : ''}><a href="javascript:void(0)" class="edit-line">Edit</a><a href="javascript:void(0)" class="delete-line">Delete</a></div>
                <div class="cell-edit">
                    <a href="javascript:void(0)" class="save-line">Save</a>
                    ${isRe ? '' : '<a href="javascript:void(0)" class="cancel-line">Cancel</a>'}
                    ${isRe ? '' : '<a href="javascript:void(0)" class="delete-line">Delete</a>'}
                </div>
            </td>
        </tr>`;
            }

            function fetchPayments() {
                return $.get({
                    url: '/crm/invoices/' + invoiceId() + '/payments',
                    cache: false
                }).then(function (r) {
                    var pays = (r && Array.isArray(r.payments)) ? r.payments : [];
                    var rows = '';
                    var total = 0;

                    if (pays.length) {
                        pays.forEach(function (p) {
                            const amt = parseFloat(p.amount) || 0;
                            if (!p.is_refunded) total += amt;

                            rows += `<tr data-id="${p.id}">
                    <td>
                        <a href="${p.edit_url}">${p.payment_ref}</a>
                    </td>
                    <td>${p.payment_date || ''}</td>
                    <td class="text-end">
                        ${amt.toFixed(2)}
                        ${p.is_refunded ? '<span class="badge rounded-pill text-bg-danger ms-2">Refunded</span>' : ''}
                    </td>
                </tr>`;
                        });

                        rows += `<tr class="fw-bold" style="font-size:1.1rem;border-top:3px solid #000;">
                <td colspan="2" class="text-end">TOTAL</td>
                <td class="text-end">${total.toFixed(2)}</td>
            </tr>`;
                    } else {
                        rows = `<tr><td colspan="3" class="text-center text-muted">No payments added</td></tr>`;
                    }

                    $('#payments-tbody').html(rows);
                    setAddPaymentState($('#invoice_balance').val() || 0, !!(r && r.fully_paid));

                    return r || {payments: [], allocated: total, fully_paid: false};
                });
            }



            function recalcAllClient(allocatedNow) {
                let totalNet = 0, totalVat = 0;
                $('#lines-tbody .line-row').each(function () {
                    const tr = $(this);
                    const qty = n(tr.find('.line-qty').val());
                    const unit = n(tr.find('.line-unit').val());
                    const rate = n(tr.find('.line-vat').val());
                    const disc = n(tr.find('.line-discount').val());
                    const r = computeFromInputs(qty, unit, rate, disc);
                    totalNet += r.net1;
                    totalVat += r.vat1;
                });
                $('#total_net').val(money(totalNet));
                let dPct = n($('#discount_amount').val());
                let dAmt = n($('#discount_percent').val());
                if (lastDiscountChange === 'percent') {
                    dAmt = totalNet * (dPct / 100);
                    $('#discount_percent').val(money(dAmt));
                } else if (lastDiscountChange === 'amount') {
                    dPct = totalNet ? (dAmt / totalNet) * 100 : 0;
                    $('#discount_amount').val(money(dPct));
                } else {
                    if (dPct && !dAmt) dAmt = totalNet * (dPct / 100);
                    if (dAmt && !dPct) dPct = totalNet ? (dAmt / totalNet) * 100 : 0;
                    $('#discount_amount').val(money(dPct));
                    $('#discount_percent').val(money(dAmt));
                }
                const carriage = n($('#carriage').val());
                const misc = n($('#misc_cost').val());
                const newTotalNet = Math.max(0, totalNet + carriage + misc - dAmt);
                $('#new_total_net').val(money(newTotalNet));
                const dR = n($('#discount_vat_rate').val());
                const dV = -(dAmt * (dR / 100));
                const grandVat = totalVat + dV;
                $('#total_vat').val(money(grandVat));
                const gross = newTotalNet + grandVat;
                $('#total_gross').val(money(gross));
                const al = n(allocatedNow);
                const balance = gross - al;
                $('#invoice_balance').val(money(balance));
                setAddPaymentState(balance, false);
            }

            function s2($el, url, placeholder) {
                $el.select2({
                    placeholder: placeholder || 'Search…',
                    allowClear: true,
                    width: 'resolve',
                    ajax: {
                        url: url,
                        dataType: 'json',
                        delay: 200,
                        data: params => ({q: params.term || '', page: params.page || 1}),
                        processResults: (data) => data
                    },
                    dropdownParent: $el.closest('.pi-box')
                });
            }

            function prefillSelect2($el, id, text) {
                if (!id) return;
                const opt = new Option(text, id, true, true);
                $el.append(opt).trigger('change');
            }

            function selectedText($el) {
                return $el.find('option:selected').text() || ''
            }

            let currentCohortId = null;
            let currentLearnerId = null;

            function loadAll() {
                $.get('/crm/invoices/' + invoiceId() + '/json').done(function (r) {
                    const h = r.header || {}, u = h.user || {};
                    $('#pi_no').text(h.invoice_no || '-');
                    $('#invoice_date_in').val(h.invoice_date || '');
                    $('#invoice_status_in').val(h.status || 'Outstanding');
                    $('#payment_terms_in').val(30);
                    $('#additional_invoice_details').val(h.additional_invoice_details || '');
                    $('#cust_name').val(u.name || '');
                    $('#cust_tel_in').val(u.telephone || '');
                    $('#cust_mobile_in').val(u.phone || '');
                    currentCohortId  = h.cohort_id || null;
                    currentLearnerId = u ? u.id : null;
                    const nmc = h.nominal_code ? (h.nominal_code.code + (h.nominal_code.description ? ' — ' + h.nominal_code.description : '')) : null;
                    const prj = h.project_code ? (h.project_code.code + (h.project_code.description ? ' — ' + h.project_code.description : '')) : null;
                    const src = h.source ? (h.source.code + (h.source.name ? ' — ' + h.source.name : '')) : null;
                    const dpt = h.department ? (h.department.code + (h.department.description ? ' — ' + h.department.description : '')) : null;
                    prefillSelect2($('#nominal_code_id'), h.nominal_code?.id, nmc);
                    prefillSelect2($('#project_code_id'), h.project_code?.id, prj);
                    prefillSelect2($('#source_id'), h.source?.id, src);
                    prefillSelect2($('#department_id'), h.department?.id, dpt);
                    $('#nominal_code_2').val(nmc || '');
                    $('#project_code_2').val(prj || '');
                    $('#source_2').val(src || '');
                    $('#department_2').val(dpt || '');
                    let rows = '';
                    const lines = r.lines || [];
                    lines.forEach((x, i) => rows += lineRow(x, i + 1));
                    $('#lines-tbody').html(rows);
                    $('#lines-tbody .line-row').each(function () {
                        if ($(this).data('is-reassigned') === 1) $(this).addClass('mode-edit');
                    });
                    renderAllBreakdownsFromJson(lines);
                    const linesNet = lines.reduce((s, l) => s + (parseFloat(l.net_amount) || 0), 0);
                    const headerPct = n(h.discount_percent);
                    const headerAmt = n(h.discount_amount);
                    if (headerPct > 0) {
                        $('#discount_amount').val(money(headerPct));
                        $('#discount_percent').val(money(linesNet * (headerPct / 100)));
                        lastDiscountChange = 'percent';
                    } else {
                        $('#discount_percent').val(money(headerAmt));
                        const pct = linesNet ? (headerAmt / linesNet * 100) : 0;
                        $('#discount_amount').val(money(pct));
                        lastDiscountChange = 'amount';
                    }
                    $('#carriage').val(money(h.carriage || 0));
                    $('#misc_cost').val(money(h.misc_cost || 0));
                    $('#discount_vat_rate').val(money(h.discount_vat_rate || 0));
                    fetchPayments().then(function (p) {
                        const g = parseFloat(h?.totals?.gross || 0);
                        const v = parseFloat(h?.totals?.vat || 0);
                        const n1 = parseFloat(h?.totals?.net || 0);
                        if ((n1 + v > 0) || g > 0) {
                            $('#total_net').val(money(n1));
                            $('#total_vat').val(money(v));
                            $('#total_gross').val(money(g));
                            const al = parseFloat(p.allocated || 0);
                            const balance = g - al;
                            $('#invoice_balance').val(money(balance));
                            setAddPaymentState(balance, !!p.fully_paid);
                        } else {
                            recalcAllClient(p.allocated);
                        }
                        hydrating = false;
                        ensureBreakdownCard();
                    });
                });
            }

            function saveHeader(extra = {}) {
                const payload = Object.assign({
                    _token: csrf(),
                    status: $('#invoice_status_in').val(),
                    additional_invoice_details: $('#additional_invoice_details').val(),
                    carriage: $('#carriage').val(),
                    discount_amount: $('#discount_percent').val(),
                    discount_percent: $('#discount_amount').val(),
                    discount_vat_rate: $('#discount_vat_rate').val(),
                    misc_cost: $('#misc_cost').val(),
                    nominal_code_id: $('#nominal_code_id').val(),
                    project_code_id: $('#project_code_id').val(),
                    source_id: $('#source_id').val(),
                    department_id: $('#department_id').val(),
                }, extra);
                return $.ajax({url: '/crm/invoices/' + invoiceId(), method: 'PUT', data: payload});
            }

            function debouncedSave(extra = {}, onDone) {
                if (hydrating) return;
                if (saveTimer) clearTimeout(saveTimer);
                saveTimer = setTimeout(function () {
                    saveHeader(extra).done(function (resp) {
                        if (onDone) onDone(resp);
                        toast('Saved');
                        fetchPayments().then(p => recalcAllClient(p.allocated));
                    }).fail(function (x) {
                        Swal.fire('Error', (x.responseJSON && x.responseJSON.message) || 'Save failed', 'error');
                    });
                }, 400);
            }

            $('#additional_invoice_details').on('blur', function () {
                debouncedSave()
            });
            $('#invoice_status_in').on('change', function () {
                debouncedSave()
            });
            s2($('#nominal_code_id'), '/crm/lookups/nominal-codes', 'Find nominal code');
            s2($('#project_code_id'), '/crm/lookups/project-codes', 'Find project code');
            s2($('#source_id'), '/crm/lookups/sources', 'Find source');
            s2($('#department_id'), '/crm/lookups/departments', 'Find department');
            $('#nominal_code_id').on('select2:select select2:clear', function () {
                $('#nominal_code_2').val(selectedText($(this)));
                debouncedSave();
            });
            $('#project_code_id').on('select2:select select2:clear', function () {
                $('#project_code_2').val(selectedText($(this)));
                debouncedSave();
            });
            $('#source_id').on('select2:select select2:clear', function () {
                $('#source_2').val(selectedText($(this)));
                debouncedSave();
            });
            $('#department_id').on('select2:select select2:clear', function () {
                $('#department_2').val(selectedText($(this)));
                debouncedSave();
            });

            $(document).on('click', '.edit-line', function () {
                const tr = $(this).closest('.line-row');
                tr.data('snapshot', {
                    qty: tr.find('.line-qty').val(),
                    code: tr.find('.line-code').val(),
                    desc: tr.find('.line-desc').val(),
                    unit: tr.find('.line-unit').val(),
                    disc: tr.find('.line-discount').val(),
                    vat: tr.find('.line-vat').val(),
                    asm: tr.find('.line-assembly').is(':checked'),
                    weight: tr.find('.line-weight').val()
                });
                tr.addClass('mode-edit');
                activeRow = tr;
            });

            $(document).on('click', '.cancel-line', function () {
                const tr = $(this).closest('.line-row');
                const s = tr.data('snapshot') || {};
                tr.find('.line-qty').val(s.qty);
                tr.find('.line-code').val(s.code);
                tr.find('.line-desc').val(s.desc);
                tr.find('.line-unit').val(s.unit);
                tr.find('.line-discount').val(s.disc);
                tr.find('.line-vat').val(s.vat);
                tr.find('.line-assembly').prop('checked', !!s.asm);
                tr.find('.line-weight').val(s.weight);
                fetchPayments().then(function (p) {
                    recalcAllClient(p.allocated)
                });
                if (tr.data('is-reassigned') === 1) {
                    tr.addClass('mode-edit');
                } else {
                    tr.removeClass('mode-edit');
                }
                activeRow = tr;
                renderAllBreakdownsFromDom();
            });

            function recalcRow(tr) {
                const qty = n(tr.find('.line-qty').val());
                const unit = n(tr.find('.line-unit').val());
                const disc = n(tr.find('.line-discount').val());
                const rate = n(tr.find('.line-vat').val());
                const r = computeFromInputs(qty, unit, rate, disc);
                tr.find('.v-unit').text(money(unit));
                tr.find('.v-discount').text(money(disc));
                tr.find('.v-rate').text(money(rate));
                tr.find('.v-net,.calc-net').text(money(r.net1));
                tr.find('.v-vat,.calc-vat').text(money(r.vat1));
                tr.find('.v-gross,.calc-gross').text(money(r.gross1));
            }

            $(document).on('input change', '.line-qty,.line-unit,.line-discount,.line-vat', function () {
                const tr = $(this).closest('.line-row');
                recalcRow(tr);
                fetchPayments().then(function (p) {
                    recalcAllClient(p.allocated)
                });
                renderAllBreakdownsFromDom();
            });

            $(document).on('click', '.save-line', function () {
                const tr = $(this).closest('tr'), id = tr.data('id');
                const data = {
                    _token: csrf(),
                    qty: tr.find('.line-qty').val(),
                    product_code: tr.find('.line-code').val(),
                    product_description: tr.find('.line-desc').val(),
                    unit_cost: tr.find('.line-unit').val(),
                    discount: tr.find('.line-discount').val(),
                    vat_rate: tr.find('.line-vat').val(),
                    assembly: tr.find('.line-assembly').is(':checked') ? 1 : 0,
                    weight: tr.find('.line-weight').val()
                };
                tr.find('.line-actions a').addClass('disabled');
                $.ajax({url: '/crm/invoice-lines/' + id, method: 'PUT', data: data})
                    .done(function () {
                        toast('Line saved');
                        if (tr.data('is-reassigned') === 1) tr.addClass('mode-edit'); else tr.removeClass('mode-edit');
                    })
                    .fail(function (x) {
                        Swal.fire('Error', (x.responseJSON && x.responseJSON.message) || 'Failed to save line', 'error');
                    })
                    .always(function () {
                        tr.find('.line-actions a').removeClass('disabled');
                        fetchPayments().then(function (p) {
                            recalcAllClient(p.allocated)
                        });
                        renderAllBreakdownsFromDom();
                    });
            });

            $(document).on('click', '.delete-line', function () {
                const tr = $(this).closest('tr'), id = tr.data('id');
                Swal.fire({title: 'Delete line?', icon: 'warning', showCancelButton: true}).then(function (r) {
                    if (!r.isConfirmed) return;
                    $.ajax({url: '/crm/invoice-lines/' + id, method: 'DELETE', data: {_token: csrf()}})
                        .done(function () {
                            toast('Line deleted');
                            loadAll();
                        })
                        .fail(function (x) {
                            Swal.fire('Error', (x.responseJSON && x.responseJSON.message) || 'Failed to delete line', 'error');
                        });
                });
            });

            $('#discount_amount').on('input', function () {
                lastDiscountChange = 'percent';
                fetchPayments().then(p => recalcAllClient(p.allocated));
            });
            $('#discount_percent').on('input', function () {
                lastDiscountChange = 'amount';
                fetchPayments().then(p => recalcAllClient(p.allocated));
            });
            $('#carriage,#misc_cost,#discount_vat_rate').on('input', function () {
                fetchPayments().then(p => recalcAllClient(p.allocated));
            });

            $('#btnSave,#btnSaveTop').on('click', function () {
                saveHeader().done(() => {
                    toast('Invoice saved');
                })
                    .fail(() => Swal.fire('Error', 'Save failed', 'error'));
            });
            $('#btnSaveExit,#btnSaveExitTop').on('click', function () {
                saveHeader().done(() => {
                    toast('Saved');
                })
                    .fail(() => Swal.fire('Error', 'Save failed', 'error'));
            });

            const inv = invoiceId();
            const btn = document.getElementById('btnAddPayment');
            if (btn && inv) {
                btn.onclick = function () {
                    location.href = '/crm/invoices/' + inv + '/payments/create'
                }
            }

            $(document).on('click', '#open_generate_invoice', function (e) {
                e.preventDefault();

                const cohort  = currentCohortId;
                const learner = currentLearnerId;

                Swal.fire({
                    title: 'Generate Invoice PDF?',
                    html: 'This will generate a PDF for this invoice only.',
                    showCancelButton: true,
                    confirmButtonText: 'Generate PDF',
                    cancelButtonText: 'Cancel',
                    confirmButtonColor: '#0d6efd'
                }).then((res) => {
                    if (!res.isConfirmed) return;

                    Swal.fire({
                        title: 'Generating PDF…',
                        allowOutsideClick: false,
                        didOpen: () => Swal.showLoading()
                    });

                    $.ajax({
                        url: '{{ route('crm.training-courses.invoice-pdf', ['cohort' => 'COHORT_ID_PLACEHOLDER']) }}'.replace('COHORT_ID_PLACEHOLDER', cohort),
                        type: 'GET',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            cohort_id: cohort,
                            learner_id: learner
                        },
                        success: function (r) {
                            Swal.close();

                            if (r?.pdf_url) {
                                window.open(r.pdf_url, '_blank');
                            }

                            Swal.fire({
                                icon: 'success',
                                title: 'Invoice PDF generated',
                                timer: 1200,
                                showConfirmButton: false
                            });
                        },
                        error: function (xhr) {
                            Swal.close();
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: xhr?.responseJSON?.message || 'Failed to generate PDF'
                            });
                        }
                    });
                });
            });

            loadAll();

            window.fetchPayments = fetchPayments;
            window.recalcAllClient = recalcAllClient;
            window.loadAll = loadAll;
        });
    </script>
@endpush
