<section id="financials" class="legacy-financial">
    <style>
        :root {
            --ink: #0f172a;
            --muted: #6b7280;
            --soft: #e5e7eb;
            --bg: #f3f4f6;
            --card-bg: #ffffff;
            --chip: #2563eb;
            --chip-soft: #e0edff;
            --header-bg: #f9fafb;
            --accent: #22c55e;
        }

        body {
            background: radial-gradient(circle at top left, #eef2ff 0, #f3f4f6 42%, #f9fafb 100%);
        }

        .card-modern {
            border: 0;
            border-radius: 18px;
            box-shadow: 0 18px 40px rgba(15, 23, 42, .08);
            overflow: hidden;
            background: var(--card-bg);
        }

        .card-modern .card-header {
            background: linear-gradient(135deg, #ffffff, #f3f4ff);
            border-bottom: 1px solid var(--soft);
            border-top-left-radius: 18px;
            border-top-right-radius: 18px;
            padding-inline: 1.25rem;
            padding-block: .9rem;
        }

        .card-modern .card-body {
            padding: 1.1rem 1.25rem 1.25rem;
        }

        .table-wrap {
            border: 1px solid rgba(148, 163, 184, .35);
            background: #ffffff;
            border-radius: 14px;
            max-width: 100%;
            display: block;
        }

        .table-modern {
            border-collapse: collapse;
            width: 100%;
            min-width: 900px;
            font-size: .875rem;
        }

        .table-modern thead {
            box-shadow: 0 1px 0 rgba(148, 163, 184, .45);
        }

        .table-modern th {
            background: linear-gradient(90deg, #eff6ff, #e0f2fe);
            color: #0f172a;
            font-size: .75rem;
            letter-spacing: .08em;
            border: 0;
            white-space: nowrap;
            text-transform: uppercase;
            text-align: left;
        }

        .table-modern th,
        .table-modern td {
            padding: .75rem .9rem;
            vertical-align: middle;
            white-space: nowrap;
            border-bottom: 1px solid #f1f5f9;
            border-right: 1px solid #edf2f7;
        }

        .table-modern th:last-child,
        .table-modern td:last-child {
            border-right: 0;
        }

        .table-modern tbody tr {
            transition: background-color .16s ease, box-shadow .16s ease;
        }

        .table-modern tbody tr:hover {
            background: #f9fafb;
            box-shadow: 0 2px 6px rgba(15, 23, 42, .05);
        }

        .legacy-financial {
            font-family: system-ui, -apple-system, Segoe UI, Roboto, Helvetica, Arial, sans-serif;
            color: var(--ink);
            margin-top: 1.25rem;
        }

        .legacy-financial .toolbar {
            display: flex;
            align-items: center;
            gap: .75rem;
            justify-content: space-between;
        }

        .legacy-financial .tb-left,
        .legacy-financial .tb-right {
            display: flex;
            align-items: center;
            gap: .5rem;
            flex-wrap: wrap;
        }

        .legacy-financial .brand {
            display: flex;
            align-items: center;
            gap: .4rem;
            font-weight: 600;
            color: var(--ink);
            font-size: .9rem;
        }

        .legacy-financial .brand .crumb {
            color: var(--chip);
            font-weight: 600;
        }

        .legacy-financial .brand small {
            color: var(--muted);
            font-weight: 500;
        }

        .legacy-financial .select,
        .legacy-financial .input {
            height: 30px;
            border: 1px solid var(--soft);
            border-radius: 999px;
            background: #fff;
            padding: 0 .7rem;
            font-size: 12px;
            color: var(--ink);
            outline: none;
        }

        .legacy-financial .select.yellow {
            background: #fef9c3;
            color: #43351a;
            border-color: #e5e7eb;
            font-weight: 700;
            letter-spacing: .2px;
        }

        .legacy-financial .toggle {
            display: inline-flex;
            align-items: center;
            gap: .35rem;
            background: #ffffff;
            border: 1px solid var(--soft);
            border-radius: 999px;
            padding: 0 .35rem;
            height: 30px;
        }

        .legacy-financial .toggle .dot {
            width: 14px;
            height: 14px;
            border-radius: 999px;
            background: #facc15;
            border: 1px solid #e5e7eb;
        }

        .legacy-financial .kbtn {
            border: 1px solid #0e58c3;
            background: linear-gradient(135deg, #2d8bff, #1168e6);
            color: #fff;
            height: 30px;
            padding: 0 .8rem;
            border-radius: 999px;
            font-size: 12px;
            line-height: 28px;
            font-weight: 600;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: .4rem;
            box-shadow: 0 8px 18px rgba(37, 99, 235, .35);
            border-width: 1px;
        }

        .legacy-financial .kbtn.gray {
            background: #e5e7eb;
            border-color: #cbd5f5;
            color: #111827;
            box-shadow: none;
        }

        .legacy-financial .kbtn.search-btn {
            height: 30px;
            border-radius: 999px;
            padding: 0 1.1rem 0 .95rem;
            border: 1px solid #d1d5db;
            background: #ffffff;
            display: inline-flex;
            align-items: center;
            gap: .4rem;
            font-size: 12px;
            font-weight: 600;
            color: #111827;
            box-shadow: 0 6px 16px rgba(15, 23, 42, .08);
            transition: background-color .15s ease, box-shadow .15s ease, transform .08s ease, border-color .15s ease;
            margin-left: .4rem;
        }

        .legacy-financial .kbtn.search-btn .icon {
            width: 14px;
            height: 14px;
            border-radius: 999px;
            border: 2px solid #4b5563;
            position: relative;
            box-sizing: border-box;
        }

        .legacy-financial .kbtn.search-btn .icon::after {
            content: '';
            position: absolute;
            width: 6px;
            height: 2px;
            border-radius: 999px;
            background: #4b5563;
            right: -4px;
            bottom: -2px;
            transform: rotate(45deg);
        }

        .legacy-financial .kbtn.search-btn:hover {
            background: #f9fafb;
            border-color: #9ca3af;
            box-shadow: 0 10px 22px rgba(15, 23, 42, .12);
            transform: translateY(-1px);
        }

        .legacy-financial .kbtn.search-btn:active {
            transform: translateY(0);
            box-shadow: 0 4px 10px rgba(15, 23, 42, .08);
        }

        .legacy-financial .opt-wrap {
            display: flex;
            align-items: center;
            gap: .6rem;
            color: var(--muted);
            font-size: 12px;
        }

        .legacy-financial .opt-btn {
            background: var(--chip);
            color: #fff;
            border: 1px solid #1d4ed8;
            border-radius: 999px;
            height: 28px;
            padding: 0 .7rem;
            font-size: 12px;
            font-weight: 600;
        }

        .legacy-financial .account-bar {
            margin: .9rem 0 .6rem;
            display: flex;
            align-items: center;
            gap: .75rem;
        }

        .legacy-financial .account-pill {
            background: rgba(37, 99, 235, .06);
            border: 1px solid #dbeafe;
            border-radius: 999px;
            padding: .35rem .9rem;
            font-size: 13px;
            font-weight: 600;
            color: var(--ink);
            display: inline-flex;
            align-items: center;
            gap: .4rem;
        }

        .legacy-financial .account-pill .label {
            color: var(--muted);
        }

        .legacy-financial .account-actions {
            margin-left: auto;
            display: flex;
            gap: .5rem;
        }

        .legacy-financial .filters {
            display: flex;
            align-items: center;
            gap: .4rem;
            margin-left: .5rem;
        }

        .legacy-financial .filters .label {
            font-size: 12px;
            color: var(--muted);
        }

        .legacy-financial .chip {
            height: 28px;
            padding: 0 .55rem;
            border-radius: 999px;
            border: 1px solid var(--soft);
            background: #fff;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
        }

        .legacy-financial .chip.blue {
            background: var(--chip);
            border-color: #1d4ed8;
            color: #fff;
        }

        .legacy-financial .quick {
            display: flex;
            gap: .25rem;
            margin-left: .15rem;
        }

        .legacy-financial .quick .q {
            width: 26px;
            height: 26px;
            border-radius: 8px;
            border: 1px solid var(--soft);
            background: #ffffff;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
            color: var(--muted);
        }

        .legacy-financial .th-gray {
            background: #0f172a !important;
            color: #fff !important;
        }

        .legacy-financial .center {
            text-align: center;
        }

        .legacy-financial .right {
            text-align: right;
        }

        .legacy-financial .code {
            color: var(--ink);
            font-weight: 700;
            letter-spacing: .02em;
        }

        .legacy-financial .link {
            color: var(--chip);
            text-decoration: none;
            font-weight: 500;
        }

        .legacy-financial .link:hover {
            text-decoration: underline;
        }

        .legacy-financial .muted {
            color: var(--muted);
        }

        .legacy-financial .chk {
            width: 16px;
            height: 16px;
            border: 1px solid var(--soft);
            border-radius: 4px;
            background: #fff;
            display: inline-block;
        }

        .legacy-financial .ico {
            width: 20px;
            height: 20px;
            border-radius: 999px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 12px;
            font-weight: 900;
        }

        .legacy-financial .ico.warn {
            background: #f59e0b;
        }

        .legacy-financial .ico.ok {
            background: #22c55e;
        }

        .legacy-financial .ico.bad {
            background: #ef4444;
        }

        .legacy-financial .neg {
            color: #ef4444;
        }

        .legacy-financial .small {
            font-size: 12px;
        }

        .legacy-financial .status {
            display: flex;
            align-items: center;
            gap: .35rem;
            width: 100%;
        }

        .legacy-financial .status .ico.bad {
            margin-left: auto;
        }

        .legacy-financial .fin-totals {
            margin-top: .75rem;
            display: flex;
            gap: 1.5rem;
            font-size: .85rem;
            color: var(--muted);
        }

        .legacy-financial .fin-totals strong {
            color: var(--ink);
        }

        .legacy-financial th[data-sort] {
            position: relative;
            cursor: pointer;
        }

        .legacy-financial .sort-icon {
            font-size: 10px;
            margin-left: .25rem;
            opacity: .4;
            transition: opacity .2s ease;
        }

        .legacy-financial th.sort-asc .sort-icon::before {
            content: '▲';
            opacity: 1;
        }

        .legacy-financial th.sort-desc .sort-icon::before {
            content: '▼';
            opacity: 1;
        }

        .legacy-financial .fin-pagination {
            margin: .75rem;
            display: flex;
            justify-content: flex-end;
        }

        .legacy-financial .fin-pager-list {
            list-style: none;
            display: flex;
            gap: .25rem;
            padding: 0;
            margin: 0;
        }

        .legacy-financial .fin-page-item {
            min-width: 28px;
            height: 28px;
            border-radius: 999px;
            border: 1px solid var(--soft);
            font-size: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: var(--muted);
            background: #fff;
        }

        .legacy-financial .fin-page-item.active {
            background: var(--chip);
            color: #fff;
            border-color: #1d4ed8;
        }

        .legacy-financial .fin-page-item.disabled {
            opacity: .5;
            cursor: default;
        }

        .daterangepicker select.monthselect,
        .daterangepicker select.yearselect {
            border-radius: 8px;
            border: 1px solid #d1d5db;
            padding: 4px 8px;
            font-size: 13px;
            color: #111827;
            background: #fff;
            transition: all .2s ease;
        }

        .daterangepicker select.monthselect:focus,
        .daterangepicker select.yearselect:focus {
            border-color: #1168e6;
            box-shadow: 0 0 0 2px rgba(17, 104, 230, .2);
            outline: none;
        }

        .drp-calendar {
            width: 800px;
        }

        #mailComposeModal .modal-footer {
            position: sticky;
            bottom: 0;
            z-index: 1055;
            background: #f8f9fa;
            border-top: 1px solid #dee2e6;
        }

        #mailComposeModal .modal-body {
            max-height: calc(100vh - 220px);
            overflow-y: auto;
        }

        #footerUrlPreview img {
            border-radius: 10px;
            box-shadow: 0 6px 18px rgba(15, 23, 42, .18);
        }

        .mail-chip {
            display: inline-flex;
            align-items: center;
            border-radius: 999px;
            background: #e5e7eb;
            padding: 2px 8px;
            font-size: 12px;
            color: #111827;
        }

        .mail-chip .chip-remove {
            cursor: pointer;
            margin-left: 6px;
            font-size: 12px;
            opacity: .7;
        }

        .mail-chip .chip-remove:hover {
            opacity: 1;
        }

        .fin-payments-btn{
            border-radius:999px;
            border:1px solid #1d4ed8;
            background:#eff6ff;
            color:#1d4ed8;
            font-size:11px;
            height:20px;
            padding:0 7px;
            line-height:18px;
            font-weight:700;
            margin-left:6px;
        }
        .fin-payments-btn:hover{
            background:#dbeafe;
        }
        #invoicePaymentsModal .modal-content{
            border-radius:16px;
        }
        #invoicePaymentsModal .table-sm th,
        #invoicePaymentsModal .table-sm td{
            padding:.4rem .6rem;
            font-size:13px;
            white-space:nowrap;
        }
    </style>

    <div class="card-modern">
        <div class="card-header">
            <div class="toolbar">
                <div class="tb-left">
                    <div class="brand d-none">
                        <span>Financial</span>
                        <span class="crumb">| Menu</span>
                        <small>{{ $delegate->name ?? 'Customer' }}</small>
                    </div>

                    <select class="select d-none" id="fin-filter-type">
                        <option value="all">ALL</option>
                        <option value="invoice">Invoices</option>
                        <option value="payment">Payments</option>
                    </select>

                    <div class="toggle">
                        <span class="dot"></span>
                        <input class="input" style="width:120px" id="fin-from" placeholder="From:"/>
                        <input class="input" style="width:120px" id="fin-to" placeholder="To:"/>
                        <div class="quick">
                            <button class="q" data-range="today">T</button>
                            <button class="q" data-range="week">W</button>
                            <button class="q" data-range="month">M</button>
                            <button class="q" data-range="clear">C</button>
                        </div>
                        <button class="kbtn search-btn" type="button" id="fin-search">
                            <span class="icon"></span><span>Search</span>
                        </button>
                        <button class="kbtn gray" type="button" id="fin-refresh">
                            <i class="bi bi-arrow-repeat me-1"></i>Refresh
                        </button>
                    </div>

                    <div class="filters">
                        <span class="label">ALL Transactions:</span>
                        <input type="checkbox" id="fin-all-trans" checked/>
                    </div>

                    <button class="kbtn" type="button" id="fin-pdf-btn">
                        Invoices Print
                    </button>
                    <button class="kbtn" type="button" id="fin-statement-btn">
                        Customer Statement
                    </button>
                    <button class="kbtn" type="button" id="fin-statement-email">
                        E
                    </button>
                </div>


                <div class="tb-right d-none">
                    <div class="opt-wrap">
                        <span>Credit Limit: <strong id="fin-credit-limit">0.00</strong></span>
                        <button class="opt-btn" type="button">Options ▾</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="account-bar">
                <div class="account-pill">
                    <span class="label">Account Receivable:</span>
                    <span id="fin-account-balance">0.00</span>
                </div>
                <div class="account-actions">
                    <button class="kbtn gray d-none" type="button">Triggers</button>
                    <button class="kbtn d-none" type="button">Take Payment</button>
                </div>
            </div>

            <div class="table-wrap">
                <table id="fin-table" class="table-modern">
                    <thead>
                    <tr>
                        <th style="width:130px" data-sort="date_sort">Date<span class="sort-icon"></span></th>
                        <th style="width:120px" data-sort="code">Code<span class="sort-icon"></span></th>
                        <th style="width:180px" data-sort="transaction">Transaction<span class="sort-icon"></span></th>
                        <th class="th-gray" data-sort="details">Transaction Details<span class="sort-icon"></span></th>
                        <th style="width:120px" data-sort="nominal">Nominal<span class="sort-icon"></span></th>
                        <th style="width:60px" class="center"></th>
                        <th style="width:140px" class="right" data-sort="debit">Debit Amount<span
                                class="sort-icon"></span></th>
                        <th style="width:160px" class="right" data-sort="credit">Credit Amount<span
                                class="sort-icon"></span></th>
                        <th style="width:200px" data-sort="balance">Status<span class="sort-icon"></span>
                        </th>
                    </tr>
                    </thead>
                    <tbody id="fin-rows"></tbody>
                </table>
                <div id="fin-pagination" class="fin-pagination"></div>
            </div>

            <div class="fin-totals justify-content-end">
                <span>Selected Debit: <strong id="fin-sel-debit">0.00</strong></span>
                <span>Selected Credit: <strong id="fin-sel-credit">0.00</strong></span>
                <span>Selected Outstanding: <strong id="fin-sel-balance">0.00</strong></span>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="mailComposeModal" tabindex="-1" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content border-0 shadow-lg" style="border-radius:18px;">

            <form id="mailComposeForm" method="POST">
                @csrf
                <div class="modal-header bg-white border-0 d-flex align-items-center">
                    <div class="d-flex align-items-center gap-2">
                        <h5 class="modal-title fw-bold d-flex align-items-center mb-0">
                            <i class="bi bi-envelope-paper text-primary me-2"></i> Compose Email
                        </h5>
                        <input type="hidden" id="mail_attachments" name="attachments" value="">

                        <button type="button"
                                class="btn btn-sm d-flex align-items-center px-3 py-2 border rounded-pill"
                                id="btnFooterImg" style="background:#f8f9fa;">
                            <i class="bi bi-image me-2 text-secondary"></i>
                            <span class="fw-semibold">Footer Image</span>
                        </button>
                    </div>

                    <div class="flex-grow-1"></div>
                    <button type="button" class="btn-close ms-2" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>

                <div class="modal-body px-4 pt-2 pb-3">
                    <div class="form-group mb-3">
                        <label class="fw-semibold mb-1">From</label>
                        <input type="email"
                               id="mail_from"
                               name="from"
                               class="form-control"
                               value="{{ config('mail.from.address') }}"
                               readonly>
                    </div>

                    <div class="form-group mb-3">
                        <label class="fw-semibold mb-1">To</label>
                        <div class="form-control d-flex align-items-center flex-wrap gap-1"
                             id="mail_to_wrap"
                             style="min-height:38px; padding-top:4px; padding-bottom:4px;">
                            <div class="mail-to-chips d-flex flex-wrap gap-1 me-1"></div>
                            <input type="text"
                                   id="mail_to_input"
                                   autocomplete="off"
                                   style="border:0;outline:0;min-width:120px;flex:1 0 80px;"
                                   placeholder="Type email and press Enter">
                        </div>
                        <input type="hidden" id="mail_to" name="to" value="">
                    </div>

                    <div class="form-group mb-3">
                        <label class="fw-semibold mb-1">Subject</label>
                        <input type="text" id="mail_subject" name="subject" class="form-control"
                               placeholder="Email subject" autocomplete="off" required>
                    </div>

                    <div class="form-group mb-3 d-none" id="mail_attachments_wrap">
                        <label class="fw-semibold mb-1">Attachments</label>
                        <ul id="mail_attachments_list" class="list-unstyled small mb-0"></ul>
                    </div>

                    <textarea id="mail_editor_area" name="html_body"></textarea>
                </div>

                <div
                    class="modal-footer border-0 bg-light d-flex justify-content-between align-items-center px-4 py-3">
                    <span class="text-muted small" id="sendStatus"></span>
                    <div class="d-flex gap-2">
                        <button type="button" class="btn btn-outline-secondary d-flex align-items-center px-3"
                                data-bs-dismiss="modal">
                            <i class="bi bi-x-circle me-2"></i> Close
                        </button>
                        <button type="button" class="btn btn-success d-flex align-items-center px-3"
                                id="btnSendMail">
                            <i class="bi bi-send-fill me-2"></i> Send
                        </button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>

<div class="modal fade" id="footerUrlModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="border-radius:14px;">
            <div class="modal-header">
                <h5 class="modal-title">Footer image URL</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <label for="footerUrlInput" class="sr-only">Image URL</label>
                <input type="url" class="form-control" id="footerUrlInput"
                       placeholder="https://example.com/footer.png" autocomplete="off">
                <div class="invalid-feedback">Enter a valid http(s) URL.</div>

                <div id="footerUrlPreview" class="mt-2" style="display:none;"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="footerUrlInsertBtn">
                    <i class="bi bi-image"></i>&nbsp;Insert
                </button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="invoicePaymentsModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-light border-0">
                <h5 class="modal-title fw-bold mb-0">
                    Invoice Payments
                    <span class="text-muted fw-normal ms-2" id="ipm-title-code"></span>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pt-2 pb-3">
                <div class="table-responsive border rounded">
                    <table class="table table-sm mb-0">
                        <thead class="table-light">
                        <tr>
                            <th style="width:18%">Date</th>
                            <th style="width:22%">Reference</th>
                            <th style="width:22%">From</th>
                            <th style="width:18%">Method</th>
                            <th style="width:20%" class="text-end">Amount</th>
                        </tr>
                        </thead>
                        <tbody id="ipm-rows"></tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-end mt-3 small">
                    <span class="me-2 text-muted">Total Received:</span>
                    <strong id="ipm-total">£ 0.00</strong>
                </div>
            </div>
        </div>
    </div>
</div>
