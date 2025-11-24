@section('title','Training Course Detail')

@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <style>
        :root {
            --ink: #0f172a;
            --muted: #6b7280;
            --soft: #e5e7eb;
            --bg: #f3f4f6;
            --card-bg: #ffffff;
            --pri: #1168e6;
            --pri-soft: #e0edff;
            --danger: #ef4444;
            --amber: #facc15;

            --erp-chrome: #6e737b;
            --erp-chrome-top: #7a8088;
            --erp-chrome-bot: #5f636a;
            --erp-input: #eef1f4;
            --erp-input-br: #bfc7d1;
            --erp-blue: #0d6efd;
            --erp-blue-pill: #22a3ff;
            --erp-green: #00d237;
            --erp-green-b: #08b62f;
            --erp-yellow: #fff7b8;
        }

        html, body {
            height: 100%;
        }

        body {
            background: radial-gradient(circle at top left, #eef2ff 0, #f3f4f6 45%, #f9fafb 100%);
            color: #2f3b52;
            font-size: 13px;
        }

        .btn {
            padding: .45rem .9rem;
            border-radius: 9999px;
            border: 1px solid transparent;
            box-shadow: none;
            font-size: .85rem;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: .25rem;
        }

        .btn-sm {
            padding: .35rem .7rem;
            border-radius: 9999px;
            font-size: .8rem;
        }

        .btn-blue {
            background: var(--pri);
            border-color: var(--pri);
            color: #fff;
        }

        .btn-blue:hover {
            background: #0b4fb8;
            border-color: #0b4fb8;
        }

        .btn-green {
            background: #22c55e;
            border-color: #1fa451;
            color: #fff;
        }

        .btn-red {
            background: var(--danger);
            border-color: #dc3a3a;
            color: #fff;
        }

        .btn-gray {
            background: #f3f4f6;
            border-color: #e5e7eb;
            color: #111827;
        }

        .btn-gray:hover {
            background: #e5e7eb;
        }

        .btn-outline {
            background: #fff;
            border: 1px solid #a5adba;
            color: var(--pri);
        }

        .btn-outline:hover {
            border-color: var(--pri);
            background: #eef2ff;
        }

        .btn-circle {
            width: 24px;
            height: 24px;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0;
            font-weight: 600;
            font-size: 11px;
        }

        .legacy-wrap,
        .pi-box,
        .table-wrap,
        .card {
            background: var(--card-bg);
            border: 1px solid rgba(148, 163, 184, 0.25);
            border-radius: 18px;
            box-shadow: 0 18px 38px rgba(15, 23, 42, 0.08);
        }

        .card {
            border-radius: 22px;
            overflow: hidden;
        }

        .legacy-toolbar {
            position: sticky;
            top: 58px;
            z-index: 20;
            background: rgba(255, 255, 255, 0.9);
            border: 1px solid rgba(148, 163, 184, 0.26);
            border-radius: 999px;
            padding: .65rem 1.1rem;
            display: flex;
            gap: 12px;
            justify-content: space-between;
            align-items: center;
            backdrop-filter: blur(14px);
            box-shadow: 0 16px 34px rgba(15, 23, 42, 0.12);
            margin-bottom: .9rem;
        }

        .legacy-title {
            font-weight: 600;
            color: #1f2937;
            font-size: 1rem;
            letter-spacing: .03em;
            text-transform: uppercase;
        }

        .toolbar-actions .btn {
            box-shadow: 0 6px 16px rgba(15, 23, 42, .08);
        }

        .pi-body {
            padding: 1.15rem 1.25rem 1.4rem;
        }

        .pi-h {
            background: linear-gradient(135deg, #ffffff, #f3f4ff);
            color: #374151;
            font-weight: 600;
            padding: .55rem .9rem;
            border-bottom: 1px solid #e5e7eb;
            border-top-left-radius: 18px;
            border-top-right-radius: 18px;
            font-size: .85rem;
            letter-spacing: .03em;
            text-transform: uppercase;
        }

        .pi-b {
            padding: .7rem .9rem .9rem;
        }


        .table-wrap {
            border-radius: 18px;
            overflow: hidden;
        }

        .table {
            width: 100%;
            margin: 0;
            border-collapse: separate;
            border-spacing: 0;
            background: #fff;
        }

        .table thead th {
            position: sticky;
            top: 0;
            z-index: 2;
            background: linear-gradient(90deg, #eff6ff, #e0f2fe);
            color: #4b5563;
            font-weight: 600;
            font-size: 11px;
            letter-spacing: .08em;
            text-transform: uppercase;
            padding: .5rem .65rem;
            border-bottom: 1px solid #e5e7eb;
            white-space: nowrap;
        }

        .table td,
        .table th {
            padding: .5rem .65rem;
            vertical-align: middle;
            border-bottom: 1px solid #f3f4f6;
        }

        .table tbody tr:hover {
            background: #f9fafb;
        }

        .tbl-compact td,
        .tbl-compact th {
            padding: .4rem .55rem;
            font-size: 12px;
        }

        .w-36 {
            text-align: center;
            width: 30px;
        }

        .text-end {
            text-align: right;
        }

        .view-badge {
            display: inline-block;
            padding: .25rem .45rem;
            border: 1px solid #d0d5dd;
            border-radius: 999px;
            font-weight: 600;
            min-width: 72px;
            text-align: center;
            font-size: 11px;
            background: #fff;
            color: #111827;
        }


        .bg-green,
        .bg-red,
        .bg-amber {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 11px;
            padding: 5px 14px;
            border-radius: 9999px;
            white-space: normal;
            text-align: center;
            line-height: 1.3;
            transition: all 0.25s ease-in-out;
            border: 1px solid transparent;
        }

        .bg-green {
            background: radial-gradient(circle at top left, #a7f3d0 0%, #059669 100%);
            color: #064e3b;
            border-color: rgba(16, 185, 129, .4);
            box-shadow: 0 2px 7px rgba(16, 185, 129, 0.3);
        }

        .bg-green:hover {
            transform: translateY(-1px);
            box-shadow: 0 5px 12px rgba(16, 185, 129, 0.4);
        }

        .bg-red {
            background: radial-gradient(circle at top left, #fecaca 0%, #dc2626 100%);
            color: #7f1d1d;
            border-color: rgba(248, 113, 113, .6);
            box-shadow: 0 2px 7px rgba(248, 113, 113, 0.35);
        }

        .bg-red:hover {
            transform: translateY(-1px);
            box-shadow: 0 5px 12px rgba(248, 113, 113, 0.45);
        }

        .bg-amber {
            background: radial-gradient(circle at top left, #fef9c3 0%, #facc15 100%);
            color: #78350f;
            border-color: rgba(234, 179, 8, .5);
            box-shadow: 0 2px 7px rgba(234, 179, 8, 0.35);
        }

        .bg-amber:hover {
            transform: translateY(-1px);
            box-shadow: 0 5px 12px rgba(234, 179, 8, 0.45);
        }

        .mini-note {
            min-height: 110px;
        }

        .context {
            position: relative;
            cursor: context-menu;
        }

        .ctx-menu {
            display: none;
            position: absolute;
            z-index: 9999;
            background: #fff;
            border: 1px solid #e8eaf0;
            box-shadow: 0 12px 28px rgba(15, 23, 42, .2);
            border-radius: 10px;
            overflow: hidden;
        }

        .ctx-menu a {
            display: block;
            padding: 8px 14px;
            text-decoration: none;
            color: #111827;
            white-space: nowrap;
            font-size: 12px;
        }

        .ctx-menu a:hover {
            background: #eff6ff;
        }

        .totals {
            background: #fff;
            border: 1px solid rgba(148, 163, 184, 0.28);
            border-radius: 18px;
            padding: .8rem 1rem;
            box-shadow: 0 12px 28px rgba(15, 23, 42, .08);
        }

        .totals .row > * {
            margin: .1rem 0;
        }

        .small-lab {
            font-size: 12px;
            color: #6b7280;
        }

        .fw-800 {
            font-weight: 800;
        }

        .ro-field {
            display: grid;
            grid-template-columns: 190px auto;
            align-items: center;
            gap: 10px;
            padding: 8px 10px;
            margin: 7px 0;
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 18px;
        }

        .ro-label {
            font-weight: 600;
            color: #1f2937;
            font-size: 12px;
        }

        .ro-value {
            color: #111827;
            font-size: 13px;
        }

        .event_none {
            pointer-events: none;
            opacity: .65;
        }

        #user_search_results .dropdown-menu {
            width: 100%;
            border-radius: 12px;
            box-shadow: 0 14px 32px rgba(15, 23, 42, .16);
            border: 1px solid #e5e7eb;
            overflow: hidden;
        }

        #user_search_results .dropdown-item {
            font-size: 13px;
        }

        #generateInvoiceModal,
        #reassignModal,
        #courseBrowser {
            z-index: 99999999999999 !important;
        }

        .swal2-container {
            z-index: 99999999999999 !important;
        }

        #re_az_filter {
            display: none !important;
        }

        .btn-pill-P {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 22px;
            height: 18px;
            border-radius: 6px;
            background: var(--erp-blue);
            color: #fff;
            font-weight: 600;
            border: 1px solid #0d6efd;
            font-size: 11px;
        }


        .form-control,
        .form-select,
        textarea {
            appearance: none;
            background: #f9fafb;
            border: 1px solid #d1d5db;
            border-radius: 14px;
            box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.02);
            height: 36px;
            padding: .45rem .8rem;
            font-size: 13px;
            line-height: 1.4;
            color: #111827;
            transition: all .2s ease-in-out;
        }

        textarea {
            min-height: 120px;
            height: auto;
            resize: vertical;
            border-radius: 16px;
        }

        .form-control:focus,
        .form-select:focus,
        textarea:focus {
            outline: none;
            background: #fff;
            border-color: var(--pri);
            box-shadow: 0 0 0 3px rgba(17, 104, 230, 0.18),
            0 2px 8px rgba(15, 23, 42, 0.08),
            inset 0 1px 1px rgba(255, 255, 255, 0.6);
        }

        .form-control[disabled],
        .form-select[disabled],
        textarea[disabled],
        .form-control[readonly],
        .form-select[readonly],
        textarea[readonly] {
            background: #f3f4f6;
            color: #6b7280;
            cursor: not-allowed;
            opacity: .85;
            box-shadow: none;
        }

        .form-select {
            background-image: linear-gradient(45deg, transparent 50%, #6b7280 50%),
            linear-gradient(135deg, #6b7280 50%, transparent 50%);
            background-position: calc(100% - 18px) center, calc(100% - 13px) center;
            background-size: 5px 5px, 5px 5px;
            background-repeat: no-repeat;
            padding-right: 28px;
        }

        .form-check-input {
            border-radius: 6px;
        }

        #posted_info {
            background: #111827;
            color: #dfe3ea;
            border-radius: 10px;
            padding: .6rem .8rem;
            font-size: 12px;
        }

        #posted_info .k {
            opacity: .7;
        }


        .erp-toolbar .btn {
            border-radius: 999px;
        }


        .modal-content {
            border-radius: 18px;
            border: 1px solid #e5e7eb;
        }

        .modal-header {
            border-bottom-color: #e5e7eb;
        }

        .modal-footer {
            border-top-color: #e5e7eb;
        }

        @media (max-width: 991.98px) {
            .legacy-toolbar {
                border-radius: 18px;
                top: 56px;
            }

            .ro-field {
                grid-template-columns: 1fr;
                align-items: flex-start;
            }
        }

        @media (max-width: 767.98px) {
            .pi-body {
                padding: .9rem .9rem 1.1rem;
            }

            .totals {
                margin-top: .75rem;
            }
        }

        .btn-qual {
            position: relative;
            width: 32px;
            height: 32px;
            padding: 0;
            border-radius: 8px;
            border: 1.7px solid #0b6fae;
            background-color: #ffffff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        .btn-qual:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }
        .q-glyph {
            position: relative;
            font-size: 12px;
            font-weight: 600;
            color: #0b6fae;
            line-height: 1;
            z-index: 2;
        }

        .q-glyph-check {
            position: absolute;
            font-size: 31px;
            color: #1a8f7a;
            right: 1px;
            bottom: -9px;
            transform: rotate(-30deg);
            z-index: 1;
        }

        .pagination-modern .page-link {
            border-radius: 999px;
            border: 1px solid var(--border);
            padding: 0.25rem 0.9rem;
            font-size: 12px;
            color: var(--muted);
            background: #f9fafb;
            line-height: 1.2;
            transition: background-color 0.15s ease, color 0.15s ease, box-shadow 0.15s ease, border-color 0.15s ease;
        }

        .pagination-modern .page-link:hover {
            text-decoration: none;
            background: #e5edff;
            border-color: #cbd5f5;
            color: var(--ink);
            box-shadow: 0 0 0 1px rgba(37, 99, 235, 0.12);
        }

        .pagination-modern .page-item.active .page-link {
            background: var(--accent);
            border-color: var(--accent);
            color: black;
            box-shadow: 0 8px 18px rgba(37, 99, 235, 0.35);
        }

        .pagination-modern .page-item.disabled .page-link {
            color: #d1d5db;
            background: #f9fafb;
            border-color: #e5e7eb;
            cursor: default;
            box-shadow: none;
        }

        .pagination-modern {
            gap: 6px;
        }

    </style>

@endpush

<div class="legacy-toolbar">
    <div class="legacy-title">Cohort Course Details</div>
    <div class="toolbar-actions d-none">
        <button class="btn btn-blue" id="btnSaveTop">Save</button>
        <button class="btn btn-blue" id="btnSaveExitTop">Save and Exit</button>
        <button class="btn btn-gray" id="btnCancelTop">Cancel</button>
        <button class="btn btn-red" id="btnDeleteTop">Delete</button>
    </div>
</div>

<div class="card">
    <div class="legacy-wrap">
        <div class="pi-body">
            <div class="row g-3">
                <div class="col-md-6">
                    <div class="pi-box mb-3">
                        <div class="pi-h">Course Details</div>
                        <div class="pi-b">
                            <div class="ro-field">
                                <div class="ro-label">Training Course:</div>
                                <div class="ro-value" id="tc_initials">A-Z</div>
                            </div>
                            <div class="ro-field">
                                <div class="ro-label">Course Name:</div>
                                <div class="ro-value" id="tc_name">-</div>
                            </div>
                            <div class="ro-field">
                                <div class="ro-label">Start Date:</div>
                                <div class="ro-value" id="tc_start">-</div>
                            </div>
                            <div class="ro-field">
                                <div class="ro-label">End Date:</div>
                                <div class="ro-value" id="tc_end">-</div>
                            </div>
                            <div class="ro-field">
                                <div class="ro-label">Course Status:</div>
                                <div class="ro-value" id="tc_status">Training Completed</div>
                            </div>
                            <div class="ro-field">
                                <div class="ro-label">Course Venue:</div>
                                <div class="ro-value" id="tc_venue">
                                    <span id="tc_postcode">B19 3NY</span>
                                    <span id="tc_venue_name">(Birmingham)</span>
                                </div>
                            </div>
                            <div class="ro-field">
                                <div class="ro-label">Owner:</div>
                                <div class="ro-value" id="tc_owner">-</div>
                            </div>
                            <div class="ro-field">
                                <div class="ro-label">Minimum Delegates:</div>
                                <div class="ro-value">4</div>
                            </div>
                            <div class="ro-field">
                                <div class="ro-label">Maximum:</div>
                                <div class="ro-value" id="tc_max">20</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="pi-box mb-3">
                        <div class="pi-h">Course Trainers</div>
                        <div class="pi-b">
                            <div class="table-wrap">
                                <table class="table tbl-compact">
                                    <thead>
                                    <tr>
                                        <th>Trainer Name</th>
                                        <th>Telephone</th>
                                        <th class="text-end">Cost</th>
                                        <th class="w-36">Days</th>
                                        <th>Notes</th>
                                        <th class="w-36">Edit</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td id="trainer_name">Riz Dean</td>
                                        <td id="trainer_tel">0121 630 2115</td>
                                        <td class="text-end">
                                            <span id="trainer_cost_view">0.00</span>
                                            <input class="form-control form-control-sm d-none" id="trainer_cost_input"
                                                   value="0.00">
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td class="w-36">
                                            <button class="btn btn-gray btn-circle edit-trainer">E</button>
                                            <form action="/crm/update-trainers" method="POST" class="d-inline"
                                                  id="trainer_update_form">
                                                @csrf @method('PUT')
                                                <button class="btn btn-blue btn-circle d-none save-trainer">S</button>
                                            </form>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-end gap-2 mt-2">
                                <a class="text-decoration-underline d-none" target="_blank" id="edit_course_link">Edit
                                    Course</a>
                                <a class="text-decoration-underline" target="_blank" id="edit_cohort_link">Edit
                                    Cohort</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-3">
                <div class="col-md-6">
                    <div class="pi-box" style="height: 269px;">
                        <div class="pi-h">Additional Course Details</div>
                        <div class="pi-b">
                            <textarea class="form-control mini-note" id="additional_note"
                                      style="height: 120px;"></textarea>
                            <div class="text-end mt-2">
                                <button class="btn btn-green btn-sm" id="save_note_btn">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="totals">
                        <div class="row">
                            <div class="col-7 small-lab d-flex align-items-center">
                                <span class="fw-semibold">Sub-Total Net Amount</span>

                                <small class="text-muted"
                                       style="font-size:10px; position:relative; top:2px; margin-left:6px;">
                                    (Before Discount)
                                </small>
                            </div>
                            <div class="col-5 text-end fw-800" id="sum-subtotal">0.00</div>

                            <div class="col-7 small-lab">Discount Amount:</div>
                            <div class="col-5 text-end fw-800" id="sum-discount">0.00</div>

                            <div class="col-7 small-lab d-flex align-items-center">
                                <span class="fw-semibold">VAT Amount:</span>

                                <small class="text-muted"
                                       style="font-size:10px; position:relative; top:2px; margin-left:6px;">
                                    (After Discount)
                                </small>
                            </div>

                            <div class="col-5 text-end fw-800" id="sum-vat">0.00</div>

                            <div class="col-7 small-lab d-flex align-items-center">
                                <span class="fw-semibold">Total Net Amount:</span>

                                <small class="text-muted"
                                       style="font-size:10px; position:relative; top:2px; margin-left:6px;">
                                    (After Discount)
                                </small>
                            </div>
                            <div class="col-5 text-end fw-800" id="sum-total">0.00</div>

                            <div class="col-12">
                                <hr class="my-2" style="border-color:#e5e7eb;">
                            </div>

                            <div class="col-12 fw-600" style="font-size:13px;color:#374151;">
                                Miscellaneous Cost (Cohort)
                            </div>

                            <div class="col-7 small-lab">Misc Net:</div>
                            <div class="col-5 text-end fw-800" id="sum-misc-net">0.00</div>

                            <div class="col-7 small-lab">Misc VAT:</div>
                            <div class="col-5 text-end fw-800" id="sum-misc-vat">0.00</div>

                            <div class="col-7 small-lab">Misc Total:</div>
                            <div class="col-5 text-end fw-800" id="sum-misc-total">0.00</div>

                            <div class="col-12">
                                <hr class="my-2" style="border-color:#e5e7eb;">
                            </div>

                            <div class="col-12 fw-600" style="font-size:13px;color:#374151;">
                                Reschedule Cost (Cohort)
                            </div>

                            <div class="col-7 small-lab">Reschedule Net:</div>
                            <div class="col-5 text-end fw-800" id="sum-res-net">0.00</div>

                            <div class="col-7 small-lab">Reschedule VAT:</div>
                            <div class="col-5 text-end fw-800" id="sum-res-vat">0.00</div>

                            <div class="col-7 small-lab">Reschedule Total:</div>
                            <div class="col-5 text-end fw-800" id="sum-res-total">0.00</div>
                        </div>

                        <div class="d-flex align-items-center justify-content-end gap-2 mt-2">
                            <button class="btn btn-outline d-none btn-circle generateChecklist" title="Print Checklist">
                                P
                            </button>
                            <button class="btn btn-blue btn-sm" id="open_generate_invoice">Generate Updated Invoice
                                (s)
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-3 mt-2 erp-toolbar align-items-end">
                <div class="col-lg-3">
                    <input type="search" class="form-control" id="search_input" placeholder="Search Name">
                </div>
                <div class="col-lg-3">
                    <select class="form-select" id="status_select">
                        <option value="">Select Status</option>
                        @foreach(getLearnerStatuses() as $s)
                            <option value="{{ $s }}">{{ $s }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-2 d-flex gap-2">
                    <button class="btn btn-blue d-none" id="filter_btn">Filter</button>
                    <button class="btn btn-gray" id="reset_btn">Refresh</button>
                </div>
                <div class="col-lg-4 d-flex justify-content-end gap-2">
                    <select class="form-select w-auto" id="print_list">
                        <option value="">Select Checklist</option>
                        <option value="efaw">Check List First Aid</option>
                        <option value="security">Check List Security</option>
                        <option value="joining-instructions">Joining Instructions</option>
                        <option value="register">Register</option>
                        <option value="vb-certificate">VB Certificate</option>
                    </select>
                    <button class="btn btn-outline btn-circle generateChecklist">P</button>
                </div>
            </div>

            <div class="row g-2 mt-2">
                <div class="col-lg-6">
                    <div class="input-group position-relative">
                        <input type="text" class="form-control" id="user_search_input" autocomplete="off"
                               placeholder="Search user by name or email" style="height: 40px;">
                        <a href="{{ route('backend.users.create') }}" target="_blank" class="btn btn-blue event_none"
                           id="create_new_user_btn">Create New</a>
                    </div>
                    <div id="user_search_results"></div>
                </div>
            </div>

            <div class="table-wrap mt-2" style="overflow-x: auto;overflow-y: visible;">
                <table class="table tbl-compact">
                    <thead>
                    <tr>
                        <th class="w-36"><input type="checkbox" name="select_all"></th>
                        <th>Date Added</th>
                        <th>Delegate Name</th>
                        <th>Customer</th>
                        <th>Status</th>
                        <th class="text-end">Cost</th>
                        <th class="text-end">Discount</th>
                        <th class="text-end">Net Cost</th>
                        <th class="text-end">Reschedule Fee</th>
                        <th class="text-end">Reschedule VAT</th>
                        <th class="text-end">VAT</th>
                        <th>Invoice Status</th>
                        <th>Invoice</th>
                        <th class="w-36">E/S</th>
                        <th class="w-36">PDF</th>
                        <th class="w-36">Q</th>
                        <th class="w-36">Del</th>
                    </tr>
                    </thead>
                    <tbody id="delegates-tbody"></tbody>
                </table>
                <div id="delegates-pagination" class="mt-2"></div>

                <div class="p-2 text-end small-lab" id="total-items">Total = 0</div>
            </div>
        </div>
    </div>

</div>

<div class="modal fade" id="generateInvoiceModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <form id="generateInvoiceForm" class="modal-content">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title">Generate Invoice</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row g-3 mb-2">
                    <div class="col-sm-6">
                        <label class="small-lab">Enter Password</label>
                        <input type="password" class="form-control" name="approval_password"
                               placeholder="Enter Password">
                    </div>
                    <div class="col-sm-6 d-flex align-items-end gap-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="print_pdf" name="print_pdf" checked>
                            <label for="print_pdf" class="form-check-label">Generate PDF Document for Invoice
                                Printing</label>
                        </div>
                    </div>
                </div>
                <div class="table-wrap">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Customer #</th>
                            <th>Customer Name</th>
                            <th>Address 1</th>
                            <th>Postcode</th>
                            <th>Funder</th>
                            <th>Net Amount</th>
                            <th>VAT Amount</th>
                            <th>Gross Amount</th>
                        </tr>
                        </thead>
                        <tbody id="gi-customer-row">
                        <tr>
                            <td colspan="8" class="text-center">Preview will appear here</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <input type="hidden" id="gi_cohort_id" name="cohort_id">
                <input type="hidden" id="gi_user_id" name="user_id">
                <input type="hidden" id="gi_order_detail_id" name="order_detail_id">
            </div>
            <div class="modal-footer">
                <button class="btn btn-gray" data-bs-dismiss="modal" type="button">Cancel</button>
                <button class="btn btn-blue" id="gi_submit_btn" type="submit">Generate</button>
            </div>
        </form>
    </div>
</div>

<div class="d-none">
    <select id="tmpl_status_options">
        <option selected></option>
        @foreach (getLearnerStatuses() as $statusOption)
            <option value="{{ $statusOption }}">{{ $statusOption }}</option>
        @endforeach
    </select>
    <select id="tmpl_payment_status_options">
        @foreach (getPaymentStatus() as $ps)
            <option value="{{ $ps }}">{{ $ps }}</option>
        @endforeach
    </select>
</div>

<div class="modal fade" id="qualificationModal" tabindex="-1" role="dialog" aria-labelledby="qualificationModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="qualificationForm">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Post to Qualification</h5>
                    <button type="button" class="close close_model" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    <div>Are you sure you want to post this Qualification?</div>
                    <div class="form-group mt-3">
                        <label>Qualification Status:</label>
                        <select class="form-control" name="qualification_status" id="qualification_status">
                            <option value="">Select Status</option>
                            <option value="Passed">Passed</option>
                            <option value="Failed">Failed</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Registration Date:</label>
                        <input type="date" class="form-control" name="registration_date" placeholder="Registration Date">
                    </div>
                    <div class="form-group">
                        <label>Date of Last Expiry:</label>
                        <input type="date" class="form-control" name="date_of_last_expiry" placeholder="Date of Last Expiry">
                    </div>
                    <input type="hidden" name="user_id" id="qualification_user_id">
                    <input type="hidden" name="cohort_id" id="qualification_cohort_id">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-secondary close_model" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>


<div id="rowCtxMenu" class="ctx-menu">
    <a href="#" class="d-none" data-action="tick-customer">Assign Tickbox For All Delegates Related To Customer</a>
    <a href="#" data-action="reassign">Reassign to Other Course</a>
</div>

@include('crm.training-courses.partials.reassign')

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{asset('js/crm/reassign.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>


    <script>
        $(function () {
            function csrf() {
                return $('meta[name="csrf-token"]').attr('content');
            }

            function csrf2() {
                return $('meta[name="csrf-token"]').attr('content');
            }

            function cohortId() {
                const m = location.pathname.match(/training-courses\/(\d+)/);
                return m ? m[1] : $('#gi_cohort_id').val() || null;
            }

            function cohortId2() {
                const m = location.pathname.match(/training-courses\/(\d+)/);
                return m ? m[1] : $('#gi_cohort_id').val() || null;
            }

            function money(n) {
                return (parseFloat(n || 0)).toFixed(2);
            }

            function money2(n) {
                return (parseFloat(n || 0)).toFixed(2);
            }

            function r2(n) {
                return Math.round((parseFloat(n || 0)) * 100) / 100;
            }

            function calcFromGrossDiscount(costNet, discountGross, vatRate) {
                const net = parseFloat(costNet || 0);
                const d = parseFloat(discountGross || 0);
                const vr = isNaN(vatRate) ? 20 : parseFloat(vatRate);
                const factor = 1 + (vr / 100);
                const gross0 = net * factor;
                const grossNew = Math.max(0, gross0 - d);
                const netNew = r2(grossNew / factor);
                const vatNew = r2(netNew * (vr / 100));
                return {net: netNew, vat: vatNew, gross: r2(grossNew)};
            }

            function payCls(s) {
                s = (s || '').toLowerCase();
                if (s === 'paid') return 'bg-green';
                if (s.includes('partially')) return 'bg-amber';
                if (s.includes('overdue') || s.includes('unpaid') || s.includes('zero')) return 'bg-red';
                return 'bg-amber';
            }

            function statusCls(s) {
                s = (s || '').toLowerCase();
                if (['passed', 'confirmed', 'completed', 'approved', 'attending'].includes(s)) return 'bg-green';
                if (['cancelled', 'failed', 'no show', 'declined', 'rejected'].includes(s)) return 'bg-red';
                return 'bg-amber';
            }

            let learnersAllItems = [];
            const learnersPageSize = 10;
            let learnersCurrentPage = 1;

            function renderLearners(items, page = 1) {
                learnersAllItems = items || learnersAllItems;
                learnersCurrentPage = page;

                const sortOrder = ['Unpaid', 'Outstanding', 'Paid'];
                const statusOpts = $('#tmpl_status_options').html();
                const payOpts = $('#tmpl_payment_status_options').html();

                const sortedItems = (learnersAllItems || []).slice().sort(function (a, b) {
                    return sortOrder.indexOf(a.invoice_status) - sortOrder.indexOf(b.invoice_status);
                });

                const totalItems = sortedItems.length;
                const totalPages = Math.max(1, Math.ceil(totalItems / learnersPageSize));

                if (learnersCurrentPage > totalPages) {
                    learnersCurrentPage = totalPages;
                }

                const start = (learnersCurrentPage - 1) * learnersPageSize;
                const pageItems = sortedItems.slice(start, start + learnersPageSize);

                let html = '';

                pageItems.forEach(function (x) {
                    const invCls = payCls(x.invoice_status);
                    const stCls = statusCls(x.status);
                    const vatRate = (typeof x.vat_rate !== 'undefined' && x.vat_rate !== null)
                        ? parseFloat(x.vat_rate)
                        : 20.0;
                    const a = calcFromGrossDiscount(x.cost, x.discount, vatRate);
                    const disabledRow = Number(x.order_detail_id) === 0;

                    const invoiceQuery = (x.order_detail_id == 0)
                        ? ('?invoice_id=' + (x.invoice_id || ''))
                        : '';

                    const invoiceHref = '/crm/training-courses/' +
                        cohortId() +
                        '/invoice/' +
                        x.id +
                        '/' +
                        x.order_detail_id +
                        invoiceQuery;

                    const badge = x.invoice_number
                        ? '<a class="view-badge ' + invCls + '" href="' + invoiceHref + '" target="_blank" rel="noopener noreferrer">' + x.invoice_number + '</a>'
                        : '<span class="text-muted">Not Generate Yet</span>';

                    const pdfBtn = x.invoice_pdf_url
                        ? '<a class="btn btn-blue btn-circle" target="_blank" href="' + x.invoice_pdf_url + '">P</a>'
                        : '<button class="btn btn-outline btn-circle generate-pdf">I</button>';

                    const selectCellHtml = disabledRow
                        ? (
                            '<input type="hidden" name="order_detail_id" value="' + (x.order_detail_id || '') + '">' +
                            '<input type="hidden" class="invoice_number" value="' + (x.invoice_number || '') + '">'
                        )
                        : (
                            '<input type="checkbox" name="learners" value="' + x.id + '" class="bulk-learner-checkbox learners">' +
                            '<input type="hidden" name="order_detail_id" value="' + (x.order_detail_id || '') + '">' +
                            '<input type="hidden" class="invoice_number" value="' + (x.invoice_number || '') + '">'
                        );

                    const ctxMenuHtml = disabledRow ? '' :
                        '<div class="ctx-menu">' +
                        '<a href="#" class="d-none" data-action="tick-customer">Assign Tickbox For All Delegates Related To Customer</a>' +
                        '<a href="#" data-action="reassign">Reassign to Other Course</a>' +
                        '</div>';

                    const editBtn = '<button class="btn btn-gray btn-circle edit-row" ' + (disabledRow ? 'disabled' : '') + '>E</button>';
                    const pdfBtnFinal = disabledRow
                        ? '<button class="btn btn-outline btn-circle" disabled>I</button>'
                        : pdfBtn;

                    const isQualified = (x.qualification_passed == 1);
                    const qBtn =
                        '<button class="btn btn-qual show-popup" ' + (disabledRow ? 'disabled' : '') + '>' +
                        '<span class="q-glyph">Q</span>' +
                        (isQualified ? '<i class="bi bi-check2 q-glyph-check"></i>' : '') +
                        '</button>';

                    const delBtn = '<button class="btn btn-red btn-circle delete-row" ' + (disabledRow ? 'disabled' : '') + '>D</button>';

                    html += ''
                        + '<tr data-id="' + x.id + '"'
                        + ' data-customer-id="' + (x.customer_id || '') + '"'
                        + ' data-customer-name="' + (x.customer || '') + '"'
                        + ' data-vat-rate="' + vatRate + '">'
                        + '<td class="w-36">' + selectCellHtml + '</td>'
                        + '<td>' + (x.date_added || '-') + '</td>'
                        + '<td class="context"><span class="delegate-name">' + (x.delegate_name || '-') + '</span>' + ctxMenuHtml + '</td>'
                        + '<td>' + (x.customer || '-') + '</td>'
                        + '<td><span class="view-badge ' + stCls + ' view-status">' + (x.status || '-') + '</span>'
                        + '<select class="form-select form-select-sm d-none ed-status" name="status">' + statusOpts + '</select></td>'
                        + '<td class="text-end"><span class="view v-cost">' + money(x.cost) + '</span>'
                        + '<input class="form-control form-control-sm d-none ed-cost" name="cost" value="' + money(x.cost) + '"></td>'
                        + '<td class="text-end"><span class="view v-discount">' + money(x.discount) + '</span>'
                        + '<input class="form-control form-control-sm d-none ed-discount" name="discount" value="' + money(x.discount) + '"></td>'
                        + '<td class="text-end"><span class="view v-net">' + money(a.net) + '</span></td>'
                        + '<td class="text-end"><span class="view v-fee">' + money(x.reassignment_fee_net || 0) + '</span></td>'
                        + '<td class="text-end"><span class="view v-fee-vat">' + money(x.reassignment_fee_vat || 0) + '</span></td>'
                        + '<td class="text-end v-vat">' + money(a.vat) + '</td>'
                        + '<td><span class="view-badge view-inv ' + invCls + '">' + (x.invoice_status || '-') + '</span>'
                        + '<select class="form-select form-select-sm d-none ed-inv-status" name="invoice_status">' + payOpts + '</select></td>'
                        + '<td>' + badge + '</td>'
                        + '<td class="w-36">' + editBtn + '</td>'
                        + '<td class="w-36">' + pdfBtnFinal + '</td>'
                        + '<td class="w-36">' + qBtn + '</td>'
                        + '<td class="w-36">' + delBtn + '</td>'
                        + '</tr>';
                });

                $('#delegates-tbody').html(html);

                $('#delegates-tbody tr').each(function () {
                    const x = pageItems[$(this).index()];
                    $(this).find('.ed-status').val(x.status || '');
                    $(this).find('.ed-inv-status').val(x.invoice_status || '');
                });

                let pagHtml = '';
                if (totalPages > 1) {
                    const isFirstPage = (learnersCurrentPage === 1);
                    const isLastPage = (learnersCurrentPage === totalPages);

                    pagHtml += '<nav aria-label="Learners pagination" class="mt-3 d-flex justify-content-end">';
                    pagHtml += '<ul class="pagination pagination-sm pagination-modern mb-0">';

                    pagHtml += '<li class="page-item' + (isFirstPage ? ' disabled' : '') + '">';
                    pagHtml += '<a class="page-link" href="#" data-page="1">&laquo; First</a>';
                    pagHtml += '</li>';

                    pagHtml += '<li class="page-item' + (isFirstPage ? ' disabled' : '') + '">';
                    pagHtml += '<a class="page-link" href="#" data-page="' + (learnersCurrentPage - 1) + '">&lsaquo; Prev</a>';
                    pagHtml += '</li>';

                    for (let p = 1; p <= totalPages; p++) {
                        pagHtml += '<li class="page-item' + (p === learnersCurrentPage ? ' active' : '') + '">';
                        pagHtml += '<a class="page-link" href="#" data-page="' + p + '">' + p + '</a>';
                        pagHtml += '</li>';
                    }

                    pagHtml += '<li class="page-item' + (isLastPage ? ' disabled' : '') + '">';
                    pagHtml += '<a class="page-link" href="#" data-page="' + (learnersCurrentPage + 1) + '">Next &rsaquo;</a>';
                    pagHtml += '</li>';


                    pagHtml += '<li class="page-item' + (isLastPage ? ' disabled' : '') + '">';
                    pagHtml += '<a class="page-link" href="#" data-page="' + totalPages + '">Last &raquo;</a>';
                    pagHtml += '</li>';

                    pagHtml += '</ul>';
                    pagHtml += '</nav>';
                }

                $('#delegates-pagination').html(pagHtml);

            }

            $(document).on('click', '#delegates-pagination .page-link', function (e) {
                e.preventDefault();
                const page = Number($(this).data('page'));
                if (!page || page < 1) {
                    return;
                }
                renderLearners(learnersAllItems, page);
            });

            function loadLearners() {
                const id = cohortId();
                if (!id) return;
                $.get('/crm/training-courses/' + id + '/learners', {
                    search: $('#search_input').val().trim(),
                    learner_status: $('#status_select').val()
                }).done(function (r) {
                    renderLearners(r.items || []);

                    $('#sum-subtotal').text(money(r.totals?.sub_total || 0));
                    $('#sum-discount').text(money(r.totals?.discount || 0));
                    $('#sum-vat').text(money(r.totals?.vat || 0));
                    $('#sum-total').text(money(r.totals?.total_cost || 0));

                    $('#sum-misc-net').text(money(r.totals?.misc_net || 0));
                    $('#sum-misc-vat').text(money(r.totals?.misc_vat || 0));
                    $('#sum-misc-total').text(money(r.totals?.misc_total || 0));

                    $('#sum-res-net').text(money(r.totals?.res_net || 0));
                    $('#sum-res-vat').text(money(r.totals?.res_vat || 0));
                    $('#sum-res-total').text(money(r.totals?.res_total || 0));

                    $('#total-items').text('Total = ' + (r.totals?.count || 0));
                });
            }

            window.loadLearners = loadLearners;

            $(document).on('click', '.edit-row', function () {
                const $b = $(this), row = $b.closest('tr'), editing = $b.hasClass('saving');

                if (!editing) {
                    row.find('.view').addClass('d-none');
                    row.find('.view-status,.view-inv').addClass('d-none');
                    row.find('.ed-status,.ed-discount,.ed-cost,.ed-inv-status').removeClass('d-none');
                    $b.removeClass('btn-gray').addClass('btn-blue saving').text('S');
                } else {
                    const invoiceNumber = row.find('.invoice_number').val();

                    const payload = {
                        _token: csrf(),
                        _method: 'PUT',
                        cohort_id: cohortId(),
                        status: row.find('.ed-status').val(),
                        discount: row.find('.ed-discount').val(),
                        cost: row.find('.ed-cost').val(),
                        invoice_status: row.find('.ed-inv-status').val(),
                        learners: row.find('.learners').val(),
                        invoice_number: invoiceNumber
                    };

                    const od = row.find('input[name="order_detail_id"]').val() || 0;

                    $.ajax({
                        url: '/crm/training-courses/' + od,
                        method: 'POST',
                        data: payload
                    })
                        .done(function (response) {
                            loadLearners();
                            Swal.fire({
                                icon: 'success',
                                title: 'Saved',
                                text: response.invoice_number
                                    ? 'Invoice ' + response.invoice_number + ' has been updated'
                                    : 'Row Updated',
                                timer: 900,
                                showConfirmButton: false
                            });
                        })
                        .fail(function (xhr) {
                            const res = xhr.responseJSON;
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                html: res?.message || 'An error occurred, please try again.',
                            });
                        })
                        .always(function () {
                            $b.addClass('btn-gray').removeClass('btn-blue saving').text('E');
                            row.find('.ed-status,.ed-discount,.ed-cost,.ed-inv-status').addClass('d-none');
                            row.find('.view,.view-status,.view-inv').removeClass('d-none');
                        });
                }
            });

            $(document).on('input', '.ed-cost,.ed-discount', function () {
                const row = $(this).closest('tr');
                const cost = row.find('.ed-cost').val();
                const disc = row.find('.ed-discount').val();
                const vatR = parseFloat(row.data('vat-rate')) || 20.0;
                const a = calcFromGrossDiscount(cost, disc, vatR);
                row.find('.v-net').text(money(a.net));
                row.find('.v-vat').text(money(a.vat));
            });

            loadLearners();

            function loadCohort() {
                const id = cohortId2();
                if (!id) return;
                $.get('/crm/training-courses/' + id + '/json').done(function (r) {
                    $('#tc_initials').text(r.training_course_initials || 'A-Z');
                    $('#tc_name').text(r.course_name || '-');
                    $('#tc_start').text(r.start_date || '-');
                    $('#tc_end').text(r.end_date || '-');
                    $('#tc_status').text(r.status || 'Open');
                    $('#tc_postcode').text(r.venue?.post_code || '-');
                    $('#tc_venue').text(`${r.venue?.post_code || '-'} (${r.venue?.venue_name || '-'})`);
                    $('#tc_owner').text(r.owner || '-');
                    $('#tc_max').text(r.max_learner || '20');
                    $('#trainer_name').text(r.trainer?.name || 'Riz Dean');
                    $('#trainer_tel').text(r.trainer?.telephone || '0121 630 2115');
                    $('#trainer_cost_view').text(money2(r.trainer_cost || 0));
                    $('#trainer_cost_input').val(money2(r.trainer_cost || 0));
                    $('#additional_note').val(r.additional_details || '');
                    if (r.course_id) $('#edit_course_link').attr('href', '/backend/courses/' + r.course_id + '/edit');
                    $('#edit_cohort_link').attr('href', '/backend/cohorts/' + id + '/edit');
                    $('#gi_cohort_id').val(id);
                });
            }

            $(document).on('click', '#filter_btn', function () {
                const id = cohortId2();
                if (!id) return;

                $.get('/crm/training-courses/' + id + '/learners', {
                    search: $('#search_input').val().trim(),
                    learner_status: $('#status_select').val()
                }).done(function (r) {

                    loadLearners();

                    $('#sum-subtotal').text(money2(r.totals?.sub_total || 0));
                    $('#sum-discount').text(money2(r.totals?.discount || 0));
                    $('#sum-total').text(money2(r.totals?.total_cost || 0));
                    $('#sum-vat').text(money2(r.totals?.vat || 0));
                    $('#total-items').text('Total = ' + (r.totals?.count || 0));

                    $('#sum-misc-net').text(money2(r.totals?.misc_net || 0));
                    $('#sum-misc-vat').text(money2(r.totals?.misc_vat || 0));
                    $('#sum-misc-total').text(money2(r.totals?.misc_total || 0));

                    $('#sum-res-net').text(money2(r.totals?.res_net || 0));
                    $('#sum-res-vat').text(money2(r.totals?.res_vat || 0));
                    $('#sum-res-total').text(money2(r.totals?.res_total || 0));
                });
            });


            $('#status_select').on('change', function () {
                $('#filter_btn').trigger('click');
            });
            $('#search_input').on('keydown', function (e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    $('#filter_btn').trigger('click');
                }
            });

            $('#reset_btn').on('click', function () {
                $('#search_input').val('');
                $('#status_select').val('');
                $('#filter_btn').trigger('click');
            });

            let typingTimer = null, selectedUserId = null;
            $(document).on('keyup', '#user_search_input', function () {

                clearTimeout(typingTimer);
                const query = $(this).val().trim();

                if (query.length < 2) {
                    $('#user_search_results').html('');
                    $('#create_new_user_btn').addClass('event_none');
                    selectedUserId = null;
                    return;
                }

                typingTimer = setTimeout(function () {

                    $.get(
                        '{{ route('crm.training-courses.find-user') }}',
                        { q: query, cohortId: cohortId2() }
                    )
                        .done(function (res) {

                            if (res.length > 0) {

                                let html = `<div class="dropdown-menu show" style="width:100%; max-height:250px; overflow-y:auto;">`;

                                res.forEach(function (u) {
                                    const fullName = [u.name, u.middle_name, u.last_name]
                                        .filter(Boolean)
                                        .join(' ');

                                    html += `
                        <button
                            class="dropdown-item user-result-item"
                            data-id="${u.id}"
                            data-name="${fullName}"
                            data-email="${u.email}">
                            ${fullName} (${u.email})
                        </button>`;
                                });

                                html += `</div>`;
                                $('#user_search_results').html(html);
                                $('#create_new_user_btn').addClass('event_none');

                            } else {
                                $('#user_search_results')
                                    .html('<div class="dropdown-menu show text-danger text-center">No user found.</div>');
                                $('#create_new_user_btn').removeClass('event_none');
                            }
                        })

                        .fail(function () {
                            $('#user_search_results')
                                .html('<div class="dropdown-menu show text-danger text-center">Search failed.</div>');
                            $('#create_new_user_btn').removeClass('event_none');
                        });

                }, 400);

            });

            $(document).on('click', '.user-result-item', function () {
                const userId = $(this).data('id');
                const userName = $(this).data('name');
                const userEmail = $(this).data('email');
                selectedUserId = userId;
                $('#user_search_input').val(`${userName} (${userEmail})`);
                $('#user_search_results').html('');
                $.post('{{ route('crm.training-courses.add-user-to-cohort') }}', {
                    user_id: userId,
                    cohort_id: cohortId2(),
                    _token: csrf2()
                })
                    .done(function () {
                        Swal.fire({
                            icon: 'success',
                            title: 'User added to cohort',
                            timer: 900,
                            showConfirmButton: false
                        });
                        $('#user_search_input').val('');
                        loadLearners();
                    })
                    .fail(function (xhr) {
                        const msg = xhr?.responseJSON?.message || 'Error adding user to cohort';
                        Swal.fire({icon: 'error', title: 'Failed', text: msg});
                    });
            });

            $(document).on('click', '.generate-pdf', function (e) {
                e.preventDefault();

                const $row = $(this).closest('tr');
                const invoiceNumber = $row.find('.invoice_number').val();
                const uid = $row.data('id');
                const od = $row.find('input[name="order_detail_id"]').val();
                const cid = cohortId2();

                $.get('{{ route('crm.training-courses.invoice-preview') }}', {
                    cohort_id: cid,
                    user_id: uid,
                    order_detail_id: od,
                    invoice_number: invoiceNumber
                })
                    .done(function (r) {
                        if (r.status === 'error') {
                            Swal.fire({icon: 'error', title: 'Error', html: r.message});
                            return;
                        }

                        $('#gi_user_id').val(uid);
                        $('#gi_order_detail_id').val(od);
                        $('#gi_cohort_id').val(cid);
                        $('#gi-customer-row').html(`
                            <tr>
                                <td>${r.customer_no ?? '-'}</td>
                                <td>${r.customer_name ?? '-'}</td>
                                <td>${r.address1 ?? '-'}</td>
                                <td>${r.postcode ?? '-'}</td>
                                <td>${r.funder ?? '-'}</td>
                                <td>${Number(r.net_amount || 0).toFixed(2)}</td>
                                <td>${Number(r.vat_amount || 0).toFixed(2)}</td>
                                <td>${Number(r.gross_amount || 0).toFixed(2)}</td>
                            </tr>
                        `);
                        $('#generateInvoiceModal').modal ? $('#generateInvoiceModal').modal('show') : $('#generateInvoiceModal').show();
                    })
                    .fail(function (xhr) {
                        let msg = 'Something went wrong.';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            msg = xhr.responseJSON.message;
                        }
                        Swal.fire({icon: 'error', title: 'Error', html: msg});
                    });
            });


            $('#generateInvoiceForm').on('submit', function (e) {
                e.preventDefault();
                const pw = $(this).find('[name="approval_password"]').val().trim();
                if (pw.length < 4) {
                    Swal.fire({icon: 'error', title: 'Password required'});
                    return;
                }
                Swal.fire({title: 'Generating…', allowOutsideClick: false, didOpen: () => Swal.showLoading()});
                $.post('{{ route('crm.training-courses.generate-invoice') }}', $(this).serialize())
                    .done(function (res) {
                        Swal.close();
                        if (res?.pdf_url) window.open(res.pdf_url, '_blank');
                        Swal.fire({
                            icon: 'success',
                            title: res?.message || 'Invoice generated successfully',
                            timer: 1200,
                            showConfirmButton: false
                        });
                        $('#generateInvoiceModal').modal('hide');
                        $('#generateInvoiceForm')[0].reset();
                        loadLearners();
                    })
                    .fail(function (xhr) {
                        Swal.close();
                        let message = 'Failed to generate';
                        if (xhr.responseJSON?.message) message = xhr.responseJSON.message;
                        Swal.fire({icon: 'error', title: 'Error', text: message});
                    });
            });

            $(document).on('click', '.edit-trainer', function () {
                $('#trainer_cost_view').addClass('d-none');
                $('#trainer_cost_input').removeClass('d-none');
                $(this).addClass('d-none');
                $('.save-trainer').removeClass('d-none');
            });

            $('#trainer_update_form').on('submit', function (e) {
                e.preventDefault();

                $.ajax({
                    url: '/crm/training-courses/update-trainers',
                    type: 'PUT',
                    data: {
                        _token: csrf2(),
                        cohort_id: cohortId2(),
                        trainer_cost: $('#trainer_cost_input').val()
                    },
                    success: function () {
                        $('#trainer_cost_view').text($('#trainer_cost_input').val()).removeClass('d-none');
                        $('#trainer_cost_input').addClass('d-none');
                        $('.save-trainer').addClass('d-none');
                        $('.edit-trainer').removeClass('d-none');
                        Swal.fire({icon: 'success', title: 'Saved', timer: 900, showConfirmButton: false});
                    }
                });
            });


            $(document).on('click', '.delete-row', function () {
                const row = $(this).closest('tr');
                const id = row.data('id');
                Swal.fire({
                    title: 'Delete?',
                    text: 'This learner will be removed.',
                    icon: 'warning',
                    showCancelButton: true
                })
                    .then(function (r) {
                        if (!r.isConfirmed) return;
                        $.ajax({
                            url: '/crm/training-courses/' + id,
                            method: 'DELETE',
                            data: {_token: csrf2(), cohort_id: cohortId2()}
                        })
                            .done(function () {
                                row.remove();
                                Swal.fire({icon: 'success', title: 'Deleted', timer: 900, showConfirmButton: false});
                            })
                            .fail(function () {
                                Swal.fire({icon: 'error', title: 'Failed to delete'});
                            });
                    });
            });

            $(document).on('change', 'input[name="select_all"]', function () {
                const v = $(this).is(':checked');
                $('input[name="learners"]').prop('checked', v);
            });

            function postToNewTab(action, data) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = action;
                form.target = '_blank';

                const csrf = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
                if (csrf) {
                    const t = document.createElement('input');
                    t.type = 'hidden';
                    t.name = '_token';
                    t.value = csrf;
                    form.appendChild(t);
                }

                Object.entries(data || {}).forEach(([k, v]) => {
                    if (Array.isArray(v)) {
                        v.forEach(val => {
                            const i = document.createElement('input');
                            i.type = 'hidden';
                            i.name = k + '[]';
                            i.value = val;
                            form.appendChild(i);
                        });
                    } else {
                        const i = document.createElement('input');
                        i.type = 'hidden';
                        i.name = k;
                        i.value = v;
                        form.appendChild(i);
                    }
                });

                document.body.appendChild(form);
                form.submit();
                form.remove();
            }

            $(document).on('click', '.generateChecklist', function () {
                const cohort = cohortId2();
                const type = $('#print_list').val();
                if (!cohort || !type) return;

                const base = `/crm/training-courses/generate-checklist/${encodeURIComponent(cohort)}`;
                const selected = $('input[name="learners"]:checked').map((i, el) => el.value).get();

                if (selected.length === 0) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'No Learners Selected',
                        text: 'Please select at least one learner first.',
                        confirmButtonText: 'OK',
                        confirmButtonColor: '#1168e6'
                    });
                    return;
                }

                if (type === 'vb-certificate') {
                    selected.forEach((uid, i) => {
                        setTimeout(() => {
                            window.open(`${base}/vb-certificate/${encodeURIComponent(uid)}`, '_blank');
                        }, i * 150);
                    });
                    return;
                }

                const url = `${base}/${encodeURIComponent(type)}`;
                postToNewTab(url, {user_ids: selected});
            });


            $('#save_note_btn').on('click', function () {
                $.post('/crm/training-courses/save-note', {
                    _token: csrf2(),
                    cohort_id: cohortId2(),
                    note: $('#additional_note').val()
                })
                    .done(function () {
                        Swal.fire({icon: 'success', title: 'Saved', timer: 900, showConfirmButton: false});
                    });
            });

            $(document).on('click', '#open_generate_invoice', function (e) {
                e.preventDefault();

                const cohortId = cohortId2();
                const selected = $('input[name="learners"]:checked').map((i, el) => $(el).val()).get();

                Swal.fire({
                    title: 'Generate Invoices',
                    html: 'Generate invoices for selected learners only, or for the full cohort?',
                    showDenyButton: true,
                    showCancelButton: true,
                    confirmButtonText: 'Selected Learners',
                    denyButtonText: 'Entire Cohort',
                    cancelButtonText: 'Cancel',
                    confirmButtonColor: '#0d6efd',
                    denyButtonColor: '#22c55e'
                }).then((res) => {
                    if (res.isConfirmed) {
                        if (selected.length === 0) {
                            Swal.fire({
                                icon: 'warning',
                                title: 'No Learners Selected',
                                text: 'Please select at least one learner.',
                                confirmButtonColor: '#0d6efd'
                            });
                            return;
                        }

                        Swal.fire({
                            title: 'Generating PDF…',
                            allowOutsideClick: false,
                            didOpen: () => Swal.showLoading()
                        });

                        $.ajax({
                            url: '{{ route('crm.invoices.bulk') }}',
                            type: 'POST',
                            data: {
                                _token: $('meta[name="csrf-token"]').attr('content'),
                                cohort_id: cohortId,
                                learner_ids: selected
                            },
                            success: function (r) {
                                Swal.close();
                                if (r?.pdf_url) window.open(r.pdf_url, '_blank');
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
                    } else if (res.isDenied) {
                        Swal.fire({
                            title: 'Generating full cohort pdf…',
                            allowOutsideClick: false,
                            didOpen: () => Swal.showLoading()
                        });

                        $.ajax({
                            url: '{{ route('crm.training-courses.invoice-pdf', ['cohort' => 'COHORT_ID_PLACEHOLDER']) }}'.replace('COHORT_ID_PLACEHOLDER', cohortId),
                            type: 'GET',
                            success: function (r) {
                                Swal.close();
                                if (r?.pdf_url) window.open(r.pdf_url, '_blank');
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Cohort invoice pdf generated',
                                    timer: 1200,
                                    showConfirmButton: false
                                });
                            },
                            error: function (xhr) {
                                Swal.close();
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: xhr?.responseJSON?.message || 'Failed to generate cohort pdf'
                                });
                            }
                        });
                    }
                });
            });

            $(document).on('click', '.view-popup', function () {
                var status = $(this).data('status');
                var registration = $(this).data('registration');
                var expiry = $(this).data('expiry');
                var userId = $(this).closest('tr').data('id');
                $('#qualification_user_id').val(userId);
                $('#qualification_cohort_id').val(cohortId2());
                $('select[name="qualification_status"]').val(status);
                $('input[name="registration_date"]').val(registration);
                $('input[name="date_of_last_expiry"]').val(expiry);

                $('#qualificationForm select, #qualificationForm input').prop('disabled', true);
                $('.modal-footer .btn-primary').hide();

                $('#qualificationModal').modal('show');
            });

            $(document).on('click', '.show-popup', function () {
                var userId = $(this).closest('tr').data('id');

                $('#qualification_user_id').val(userId);
                $('#qualification_cohort_id').val(cohortId2());

                $('#qualificationForm select, #qualificationForm input').prop('disabled', false);
                $('.modal-footer .btn-primary').show();

                $('#qualificationModal').modal('show');
            });

            $(document).on('click', '.close_model', function () {
                $('#qualificationModal').modal('hide');
            });


            $(document).on('submit', '#qualificationForm', function (e) {
                e.preventDefault();
                var form = $(this);

                form.find('.invalid-feedback').remove();
                form.find('.is-invalid').removeClass('is-invalid');

                var status = form.find('[name="qualification_status"]').val();
                if (!status) {
                    var input = form.find('[name="qualification_status"]');
                    input.addClass('is-invalid')
                        .after('<div class="invalid-feedback">Qualification status is required.</div>');
                    return;
                }

                $.post('{{ route('crm.qualifications.post') }}', form.serialize() + '&_token=' + csrf())
                    .done(function () {
                        resetQualificationModal();
                        $('#qualificationModal').modal('hide');
                        loadLearners();
                        Swal.fire({
                            icon: 'success',
                            title: 'Posted',
                            timer: 900,
                            showConfirmButton: false
                        });
                    })
                    .fail(function (xhr) {
                        if (xhr.status === 422) {
                            var errors = xhr.responseJSON.errors || {};
                            Object.keys(errors).forEach(function (k) {
                                var input = form.find('[name="' + k + '"]');
                                input.addClass('is-invalid')
                                    .after('<div class="invalid-feedback">' + errors[k][0] + '</div>');
                            });
                        } else {
                            Swal.fire({ icon: 'error', title: 'Error posting qualification.' });
                        }
                    });
            });

            function resetQualificationModal() {
                var form = $('#qualificationForm');
                form[0].reset();
                form.find('.is-invalid').removeClass('is-invalid');
                form.find('.invalid-feedback').remove();
            }

            $(document).on('click', '.close_model', function () {
                resetQualificationModal();
                $('#qualificationModal').modal('hide');
            });

            function initPicker($i) {
                if (!$i.length) return;
                $i.attr('type', 'text').addClass('datepick');

                if ($i.attr('name') === 'date_of_last_expiry') {
                    const hint = moment().add(3, 'years').format('YYYY-MM-DD');
                    $i.attr('placeholder', `e.g. ${hint}`);
                }

                const v = $i.val();

                $i.daterangepicker({
                    singleDatePicker: true,
                    showDropdowns: true,
                    autoApply: false,
                    autoUpdateInput: true,
                    locale: { format: 'YYYY-MM-DD' }
                });

                if (v) {
                    const iso = toYMD(v);
                    $i.data('daterangepicker').setStartDate(iso);
                    $i.data('daterangepicker').setEndDate(iso);
                    $i.val(iso);
                } else {
                    $i.val('');
                }
            }

            initPicker($('input[name="registration_date"]'));
            initPicker($('input[name="date_of_last_expiry"]'));

            loadCohort();

        });
    </script>

@endpush
