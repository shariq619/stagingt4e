@extends('crm.layout.main')
@section('title','Leads')

@push('css')
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/datatables.net-bs5@1.13.10/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css">

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
            --pri: #1168e6;
        }

        body {
            background: radial-gradient(circle at top left, #eef2ff 0, #f3f4f6 42%, #f9fafb 100%);
        }

        .page-wrap {
            max-width: 1440px;
            margin-inline: auto;
            padding-inline: 1.25rem;
        }

        .page-inner {
            padding: 1.5rem 0 3rem;
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

        .card-modern .card-title {
            margin: 0;
            font-weight: 600;
            color: var(--ink);
            font-size: 1rem;
            letter-spacing: .01em;
        }

        .card-modern .card-body {
            padding: 1.1rem 1.25rem 1.25rem;
        }

        .badge-soft {
            background: rgba(37, 99, 235, .06);
            color: #1d4ed8;
            border: 1px solid #dbeafe;
            border-radius: 999px;
            padding: .25rem .7rem;
            font-weight: 600;
            font-size: .8rem;
            display: inline-flex;
            align-items: center;
            gap: .25rem;
        }

        .badge-soft::before {
            content: '';
            width: 8px;
            height: 8px;
            border-radius: 999px;
            background: var(--accent);
        }

        .kpis {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
            gap: 14px;
            padding: 12px;
            margin-bottom: .75rem;
            background: #f9fafb;
            border-radius: 14px;
            border: 1px solid rgba(148, 163, 184, 0.25);
        }

        .kpis .k {
            border-radius: 14px;
            text-align: center;
            padding: 14px 10px;
            transition: all .2s ease;
            box-shadow: 0 2px 6px rgba(15, 23, 42, 0.04);
            border: 1px solid rgba(148, 163, 184, 0.35);
            background: #ffffff;
            cursor: pointer;
        }

        .kpis .k:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 14px rgba(15, 23, 42, 0.09);
        }

        .k .v {
            font-size: 1.3rem;
            font-weight: 700;
            color: #111827;
        }

        .k .h {
            font-size: 0.85rem;
            font-weight: 500;
            color: #374151;
        }

        .k-total {
            background: #e7f1ff !important;
            border-color: rgba(145, 180, 255, 0.6) !important;
        }

        .k-status-pending {
            background: #fff9e5 !important;
            border-color: rgba(255, 220, 100, 0.6) !important;
        }

        .k-status-processing {
            background: #e0f2fe !important;
            border-color: rgba(56, 189, 248, 0.6) !important;
        }

        .k-status-need_to_followup {
            background: #fef3c7 !important;
            border-color: rgba(251, 191, 36, 0.7) !important;
        }

        .k-status-enrolled {
            background: #e8fdf0 !important;
            border-color: rgba(34, 197, 94, 0.65) !important;
        }

        .k-status-do_not_disturb {
            background: #fee2e2 !important;
            border-color: rgba(248, 113, 113, 0.7) !important;
        }

        .k-status-last_hope {
            background: #f3e8ff !important;
            border-color: rgba(192, 132, 252, 0.7) !important;
        }

        .k-status-not_interested {
            background: #f3f4f6 !important;
            border-color: rgba(156, 163, 175, 0.45) !important;
            color: #374151 !important;
        }

        .k-status-interested {
            background: #e0fdf9 !important;
            border-color: rgba(45, 212, 191, 0.7) !important;
            color: #065f46 !important;
        }

        .kpis .k.k-active {
            box-shadow: 0 0 0 2px rgba(17, 104, 230, 0.25), 0 6px 14px rgba(0, 0, 0, 0.12);
            border-color: #1168e6 !important;
        }

        @media (max-width: 768px) {
            .kpis {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        .toolbar {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 8px;
            padding: .6rem .25rem .3rem;
            margin-bottom: .75rem;
        }

        .btn-pill {
            border-radius: 9999px;
        }

        .btn-soft {
            background: #fff;
            border: 1px solid var(--soft);
            color: #111827;
            transition: background-color .15s ease, color .15s ease, border-color .15s ease, box-shadow .15s ease, transform .15s ease;
        }

        .btn-soft:hover {
            background: #f9fafb;
            border-color: #d1d5db;
        }

        .filter-chip {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: .35rem .7rem;
            border: 1px solid var(--soft);
            border-radius: 9999px;
            background: #fff;
        }

        .stat-badges {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .badge-pill {
            border-radius: 9999px;
            padding: .4rem .7rem;
            font-weight: 600;
        }

        .table-wrap {
            border: 1px solid rgba(148, 163, 184, .35);
            background: #ffffff;
            border-radius: 14px;
        }

        .table-modern {
            border-collapse: collapse;
            width: 100%;
            font-size: .875rem;
        }

        .table-modern thead {
            box-shadow: 0 1px 0 rgba(148, 163, 184, .45);
        }

        .table-modern th {
            background: linear-gradient(90deg, #eff6ff, #e0f2fe);
            color: #0f172a;
            position: sticky;
            top: 0;
            z-index: 2;
            font-size: .75rem;
            letter-spacing: .08em;
            border: 0;
            white-space: nowrap;
            text-transform: uppercase;
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

        #leadsTable_filter {
            display: none !important;
        }

        #leadsTable th,
        #leadsTable td {
            white-space: nowrap;
        }

        #leadsTable th:nth-child(2),
        #leadsTable th:nth-child(7),
        #leadsTable th:nth-child(8),
        #leadsTable th:nth-child(9),
        #leadsTable th:nth-child(10),
        #leadsTable th:nth-child(14),
        #leadsTable th:nth-child(15),
        #leadsTable th:nth-child(16) {
            min-width: 100px;
            width: 100px;
        }

        #leadsTable th:nth-child(3),
        #leadsTable th:nth-child(4),
        #leadsTable th:nth-child(6),
        #leadsTable th:nth-child(11),
        #leadsTable th:nth-child(12) {
            min-width: 160px;
            width: 160px;
        }

        #leadsTable th:nth-child(5),
        #leadsTable th:nth-child(13) {
            min-width: 250px;
            width: 250px;
        }

        #leadsTable th:last-child {
            width: 120px;
            text-align: center;
        }

        .modal-content {
            border-radius: 18px;
        }

        .form-control,
        .form-select {
            border-radius: 12px;
        }

        #leadModal .modal-content {
            border-radius: 18px;
        }

        #leadModal .form-control,
        #leadModal .form-select {
            border-radius: 10px;
        }

        #leadModal .modal-body {
            max-height: calc(100dvh - 180px);
            overflow-y: auto;
        }

        @media (max-width: 768px) {
            #leadModal .modal-dialog {
                margin: .5rem;
            }
        }

        @media (max-width: 992px) {
            .table-modern th,
            .table-modern td {
                padding-inline: .6rem;
            }
        }

        #leadsTable_length {
            margin: 15px;
        }

        .pagination {
            margin: 10px !important;
        }

        .quick-range {
            display: inline-flex;
            margin-left: .35rem;
            gap: .2rem;
        }

        .quick-range .q-btn {
            width: 26px;
            height: 26px;
            border-radius: 8px;
            border: 1px solid var(--soft);
            background: #ffffff;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
            color: var(--muted);
            padding: 0;
            cursor: pointer;
            line-height: 1;
        }

        .quick-range .q-btn.active {
            background: var(--pri);
            border-color: var(--pri);
            color: #fff;
            box-shadow: 0 0 0 1px rgba(17, 104, 230, .25);
        }
    </style>

    <style>
        #btnFilter {
            background: #1168e6;
            color: #fff;
            border: none;
            border-radius: 50px;
            padding: 6px 18px;
            font-weight: 500;
            transition: all .2s ease;
            width: 500px;
        }

        #btnFilter:hover {
            background: #0d5cd5;
            transform: translateY(-1px);
            box-shadow: 0 2px 8px rgba(17, 104, 230, .25);
        }

        #btnFilter i {
            font-size: 15px;
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

        #mail_to_wrap {
            cursor: text;
        }

        #mail_to_wrap input {
            box-shadow: none !important;
        }
    </style>
@endpush

@section('main')
    <div class="">
        <div class="page-inner">
            <div class="card-modern">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="card-title mb-0">Leads</h4>
                        <small class="text-muted">T4E CRM lead management</small>
                    </div>
                    <span class="badge-soft">
                        <i class="bi bi-people-fill"></i>
                        <span id="k_total_header">Total leads</span>
                    </span>
                </div>

                <div class="card-body">
                    <div class="kpis">
                        <div class="k k-total k-active" data-status="">
                            <div class="h">Total</div>
                            <div class="v" id="k_total">--</div>
                        </div>

                        @foreach($statuses as $key => $label)
                            <div class="k k-status-{{ $key }}" data-status="{{ $key }}">
                                <div class="h">{{ $label }}</div>
                                <div class="v" id="k_status_{{ $key }}">--</div>
                            </div>
                        @endforeach
                    </div>

                    <div class="toolbar">
                        <button id="btnAdd" class="btn btn-primary btn-pill">
                            <i class="bi bi-plus-lg me-1"></i>New Lead
                        </button>

                        <div class="filter-chip">
                            <i class="bi bi-funnel"></i>
                            <select id="filterStatus" class="form-select border-0" style="width:200px">
                                <option value="">All Status</option>
                                @foreach($statuses as $k=>$v)
                                    <option value="{{ $k }}">{{ $v }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="filter-chip">
                            <i class="bi bi-calendar3"></i>
                            <input id="filterDateFrom"
                                   class="form-control form-control-sm border-0"
                                   placeholder="Contact (From date)"
                                   autocomplete="off"
                                   style="width:160px">
                            <span class="mx-1">–</span>
                            <input id="filterDateTo"
                                   class="form-control form-control-sm border-0"
                                   placeholder="Contact (To date)"
                                   autocomplete="off"
                                   style="width:160px">
                            <div class="quick-range">
                                <button type="button" class="q-btn" data-range="today">T</button>
                                <button type="button" class="q-btn" data-range="week">W</button>
                                <button type="button" class="q-btn" data-range="month">M</button>
                                <button type="button" class="q-btn" data-range="clear">C</button>
                            </div>
                        </div>

                        <div class="d-flex align-items-center flex-grow-1" style="gap:.5rem; max-width:1080px">
                            <input id="filterSearch"
                                   class="form-control"
                                   placeholder="Search name, email, phone, city">

                            <button id="btnFilter" class="btn btn-soft btn-pill">
                                <i class="bi bi-search me-1"></i>Search
                            </button>
                        </div>

                        <button id="btnReload" class="btn btn-soft ms-1 rounded-circle">
                            <i class="bi bi-arrow-repeat"></i>
                        </button>

                        <div class="ms-auto stat-badges d-flex align-items-center" style="gap:.5rem">
                            <select id="bulkStatus" class="form-select" style="width:220px">
                                <option value="">Set Status...</option>
                                @foreach($statuses as $k=>$v)
                                    <option value="{{ $k }}">{{ $v }}</option>
                                @endforeach
                            </select>
                            <button id="btnBulkSet" class="btn btn-soft btn-pill">
                                <i class="bi bi-activity me-1"></i>Apply
                            </button>
                            <button id="btnBulkAuto" class="btn btn-soft btn-pill">
                                <i class="bi bi-magic me-1"></i>Auto Status
                            </button>
                            <button id="btnBulkSync" class="btn btn-soft btn-pill">
                                <i class="bi bi-person-check me-1"></i>Sync Enrolled
                            </button>
                            <button id="btnBulkEmailSelected" class="btn btn-soft btn-pill">
                                <i class="bi bi-envelope me-1"></i>Email Selected
                            </button>
                            <button id="btnBulkEmailAll" class="btn btn-soft btn-pill">
                                <i class="bi bi-envelope-open me-1"></i>Email All (Filtered)
                            </button>
                        </div>
                    </div>

                    <div class="table-wrap">
                        <table id="leadsTable" class="table-modern w-100">
                            <thead>
                            <tr>
                                <th><input type="checkbox" id="selectAll" class="form-check-input"></th>
                                <th>Contact Date</th>
                                <th>Candidate's Name</th>
                                <th>Contact Number</th>
                                <th>Email Address</th>
                                <th>Course Interested</th>
                                <th>City</th>
                                <th>Status</th>
                                <th>Enrolment Date</th>
                                <th>Contact Created by</th>
                                <th>Platform</th>
                                <th>Source</th>
                                <th>Notes</th>
                                <th>Follow up</th>
                                <th>2nd Follow Up</th>
                                <th>Final Follow Up</th>
                                <th></th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="leadModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content border-0 shadow-lg rounded-3">
                <form id="leadForm" autocomplete="off">
                    @csrf

                    <div class="modal-header bg-white border-0">
                        <h5 class="modal-title d-flex align-items-center">
                            <i class="bi bi-person-lines-fill me-2 text-primary"></i>
                            Lead
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body p-4">
                        <input type="hidden" id="lead_id" name="lead_id">
                        <input type="hidden" name="user_id" value="">
                        <input type="hidden" name="course_id" value="">
                        <input type="hidden" name="follow_up_at" value="">

                        <div class="row g-3">
                            <div class="col-md-3">
                                <label class="form-label">Contact Date</label>
                                <input type="date"
                                       class="form-control"
                                       name="contact_date"
                                       placeholder="YYYY-MM-DD"
                                       inputmode="numeric"
                                       autocomplete="off">
                            </div>

                            <div class="col-md-5">
                                <label class="form-label">Candidate's Name</label>
                                <input type="text"
                                       class="form-control"
                                       name="candidate_name"
                                       placeholder="e.g. Ali Raza"
                                       maxlength="120"
                                       autocomplete="name">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Contact Number</label>
                                <input type="tel"
                                       class="form-control"
                                       name="contact_number"
                                       placeholder="e.g. +92 300 1234567"
                                       inputmode="tel"
                                       autocomplete="tel">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Email Address</label>
                                <input type="email"
                                       class="form-control"
                                       name="email"
                                       placeholder="e.g. ali@example.com"
                                       autocomplete="email">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Course Interested</label>
                                <select class="form-select" name="course_interested">
                                    <option value="">Choose course…</option>
                                    @foreach($courses as $course)
                                        <option value="{{ $course->name }}">{{ $course->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">City</label>
                                <input type="text"
                                       class="form-control"
                                       name="city"
                                       placeholder="e.g. Karachi">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Status</label>
                                <select class="form-select" name="status">
                                    <option value="" selected disabled>Choose status…</option>
                                    @foreach($statuses as $k=>$v)
                                        <option value="{{ $k }}">{{ $v }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Enrolment Date</label>
                                <input type="date"
                                       class="form-control"
                                       name="enrolment_date"
                                       placeholder="YYYY-MM-DD"
                                       inputmode="numeric"
                                       autocomplete="off">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Platform</label>
                                <input type="text"
                                       class="form-control"
                                       name="platform"
                                       placeholder="e.g. WhatsApp, Phone Call, Website">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Source</label>
                                <input type="text"
                                       class="form-control"
                                       name="source"
                                       placeholder="e.g. Google Ads, Referral, Instagram">
                            </div>

                            <div class="col-12">
                                <label class="form-label">Notes</label>
                                <textarea class="form-control"
                                          name="notes"
                                          rows="3"
                                          placeholder="Key details, objections, availability, etc."></textarea>
                            </div>

                            <div class="col-md-4 followup-field d-none" id="followUp2Group">
                                <label class="form-label">2nd Follow Up</label>
                                <input type="datetime-local"
                                       class="form-control"
                                       name="follow_up2_at"
                                       placeholder="Select date & time">
                            </div>

                            <div class="col-md-4 followup-field d-none" id="followUpFinalGroup">
                                <label class="form-label">Final Follow Up</label>
                                <input type="datetime-local"
                                       class="form-control"
                                       name="follow_up_final_at"
                                       placeholder="Select date & time">
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer bg-white border-0 d-flex justify-content-between">
                        <button type="button" class="btn btn-light rounded-pill" data-bs-dismiss="modal">Close</button>
                        <button id="btnSave" type="submit" class="btn btn-primary rounded-pill">
                            <i class="bi bi-save me-1"></i>Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

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
                            <label class="fw-semibold mb-1">To</label>
                            <div id="mail_to_wrap" class="form-control d-flex align-items-center flex-wrap gap-1">
                                <div id="mail_to_chips" class="d-flex flex-wrap gap-1"></div>
                                <input type="text" id="mail_to_input" class="border-0 flex-grow-1"
                                       style="min-width:160px;outline:0;" autocomplete="off"
                                       placeholder="Type email and press Enter">
                            </div>
                            <input type="hidden" id="mail_to" name="to">
                        </div>

                        <div class="form-group mb-3">
                            <label class="fw-semibold mb-1">Subject</label>
                            <input type="text" id="mail_subject" name="subject" class="form-control"
                                   placeholder="Email subject" autocomplete="off" required>
                        </div>

                        <div class="form-group mb-3">
                            <label class="fw-semibold mb-1">Attachments</label>
                            <input type="file" id="mail_attachments" name="attachments[]" class="form-control" multiple>
                            <div class="form-text small" id="mail_attachments_list"></div>
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

    <div class="modal fade" id="footerUrlModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius:14px;">
                <div class="modal-header">
                    <h5 class="modal-title">Footer image URL</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <label for="footerUrlInput" class="form-label">Image URL</label>
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
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/datatables.net@1.13.10/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/datatables.net-bs5@1.13.10/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/moment@2.29.4/min/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/tinymce@5.10.9/tinymce.min.js"></script>

    <script>
        var DT,
            ROUTE = {
                dt: "{{ route('crm.leads.dt') }}",
                store: "{{ route('crm.leads.store') }}",
                show: id => "{{ route('crm.leads.show','_ID_') }}".replace('_ID_', id),
                update: id => "{{ route('crm.leads.update','_ID_') }}".replace('_ID_', id),
                destroy: id => "{{ route('crm.leads.destroy','_ID_') }}".replace('_ID_', id),
                check: id => "{{ route('crm.leads.check','_ID_') }}".replace('_ID_', id),
                sync: "{{ route('crm.leads.sync') }}",
                statusUpdate: id => "{{ route('crm.leads.status.update','_ID_') }}".replace('_ID_', id),
                statusBulk: "{{ route('crm.leads.status.bulk') }}",
                statusAuto: id => "{{ route('crm.leads.status.auto','_ID_') }}".replace('_ID_', id),
                statusAutoBulk: "{{ route('crm.leads.status.auto-bulk') }}",
                emailBulk: "{{ route('crm.leads.email.bulk') }}"
            },
            STATUSES = @json($statuses),
            composeEd = null,
            mailComposeModalInstance = null,
            footerUrlModalInstance = null,
            EMAIL_SCOPE = null,
            EMAIL_IDS = [],
            EMAIL_FILTERS = {},
            MAIL_TO_LIST = [];

        function isValidEmail(e) {
            return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test((e || '').trim());
        }

        function reloadKPIs(json) {
            var total = parseInt(json.kpi_total, 10);
            if (isNaN(total)) {
                total = 0;
            }
            $('#k_total').text(total);
            $('#k_total_header').text('Total leads: ' + total);
            var statusCounts = json.kpi_status_counts || {};
            if (statusCounts && typeof statusCounts === 'object') {
                Object.keys(STATUSES).forEach(function (key) {
                    var count = statusCounts[key] || 0;
                    $('#k_status_' + key).text(count);
                });
            }
        }

        function reloadTable() {
            if (DT) {
                DT.ajax.reload(null, false);
            }
        }

        function setStatusFilterFromKpi(statusKey) {
            statusKey = statusKey || '';
            $('#filterStatus').val(statusKey);
            $('.kpis .k').removeClass('k-active');
            $('.kpis .k').each(function () {
                var s = $(this).data('status');
                if ((s || '') === statusKey) {
                    $(this).addClass('k-active');
                }
                if (!statusKey && !s) {
                    $(this).addClass('k-active');
                }
            });
            reloadTable();
        }

        function setDateInputs(from, to) {
            $('#filterDateFrom').val(from || '');
            $('#filterDateTo').val(to || '');
            var drpFrom = $('#filterDateFrom').data('daterangepicker');
            var drpTo = $('#filterDateTo').data('daterangepicker');
            if (drpFrom && from) {
                drpFrom.setStartDate(from);
                drpFrom.setEndDate(from);
            }
            if (drpTo && to) {
                drpTo.setStartDate(to);
                drpTo.setEndDate(to);
            }
        }

        function applyQuickRange(rangeKey) {
            var today = moment().startOf('day');
            var from = '';
            var to = '';
            if (rangeKey === 'today') {
                from = today.format('YYYY-MM-DD');
                to = from;
            } else if (rangeKey === 'week') {
                from = today.clone().subtract(6, 'days').format('YYYY-MM-DD');
                to = today.format('YYYY-MM-DD');
            } else if (rangeKey === 'month') {
                from = today.clone().startOf('month').format('YYYY-MM-DD');
                to = today.clone().endOf('month').format('YYYY-MM-DD');
            } else if (rangeKey === 'clear') {
                setDateInputs('', '');
                $('.quick-range .q-btn').removeClass('active');
                reloadTable();
                return;
            }
            setDateInputs(from, to);
            $('.quick-range .q-btn').removeClass('active');
            $('.quick-range .q-btn[data-range="' + rangeKey + '"]').addClass('active');
            reloadTable();
        }

        function initComposeOnce() {
            if (composeEd) return;
            tinymce.init({
                selector: '#mail_editor_area',
                height: 420,
                menubar: true,
                plugins: 'lists link image table code paste autoresize',
                toolbar: 'undo redo | styleselect | bold italic underline | alignleft aligncenter alignright | bullist numlist | link image table | code',
                paste_data_images: true,
                convert_urls: false,
                branding: false,
                setup: function (ed) {
                    ed.on('init', function () {
                        composeEd = ed;
                    });
                },
                content_style: 'body{font-family:system-ui,-apple-system,Segoe UI,Roboto,Helvetica,Arial,sans-serif;font-size:14px;}'
            });
        }

        function renderRecipientChips() {
            var $chips = $('#mail_to_chips');
            $chips.empty();
            MAIL_TO_LIST.forEach(function (email, idx) {
                var $chip = $('<span class="badge rounded-pill bg-primary-subtle text-primary d-flex align-items-center gap-1"></span>');
                $chip.append($('<span></span>').text(email));
                var $btn = $('<button type="button" class="btn-close ms-1 mail-chip-remove" aria-label="Remove"></button>');
                $btn.attr('data-idx', idx);
                $chip.append($btn);
                $chips.append($chip);
            });
            $('#mail_to').val(MAIL_TO_LIST.join(','));
            if (EMAIL_SCOPE === 'single' || EMAIL_SCOPE === 'selected') {
                if (!MAIL_TO_LIST.length) {
                    $('#mail_to_wrap').addClass('is-invalid');
                } else {
                    $('#mail_to_wrap').removeClass('is-invalid');
                }
            } else {
                $('#mail_to_wrap').removeClass('is-invalid');
            }
        }

        function resetRecipients() {
            MAIL_TO_LIST = [];
            renderRecipientChips();
            $('#mail_to_input').val('');
        }

        function addEmailFromInput() {
            var val = ($('#mail_to_input').val() || '').trim();
            if (!val) return;
            if (!isValidEmail(val)) {
                Swal.fire({icon: 'error', title: 'Invalid email', text: val});
                $('#mail_to_input').val('');
                return;
            }
            if (MAIL_TO_LIST.indexOf(val) === -1) {
                MAIL_TO_LIST.push(val);
                renderRecipientChips();
            }
            $('#mail_to_input').val('');
        }

        function openCompose(recipientData, scope, ids, filters) {
            EMAIL_SCOPE = scope || 'single';
            EMAIL_IDS = Array.isArray(ids) ? ids : [];
            EMAIL_FILTERS = filters || {};
            $('#mail_subject').val('');
            $('#sendStatus').text('');
            $('#mail_attachments').val('');
            $('#mail_attachments_list').text('');
            $('#mail_to_wrap').removeClass('is-invalid');
            $('#mail_to_input').prop('disabled', false).attr('placeholder', 'Type email and press Enter');
            resetRecipients();
            if (EMAIL_SCOPE === 'selected') {
                var arr = Array.isArray(recipientData) ? recipientData : [];
                MAIL_TO_LIST = [];
                arr.forEach(function (e) {
                    e = (e || '').trim();
                    if (e && MAIL_TO_LIST.indexOf(e) === -1) {
                        MAIL_TO_LIST.push(e);
                    }
                });
                renderRecipientChips();
            } else if (EMAIL_SCOPE === 'single') {
                var single = (recipientData || '').trim();
                MAIL_TO_LIST = [];
                if (single) {
                    MAIL_TO_LIST.push(single);
                }
                renderRecipientChips();
            } else if (EMAIL_SCOPE === 'all_filtered') {
                MAIL_TO_LIST = [];
                renderRecipientChips();
                $('#mail_to_input').prop('disabled', true).attr('placeholder', String(recipientData || 'All filtered leads'));
            }
            initComposeOnce();
            if (!mailComposeModalInstance) {
                mailComposeModalInstance = new bootstrap.Modal(document.getElementById('mailComposeModal'));
            }
            mailComposeModalInstance.show();
            setTimeout(function () {
                if (composeEd) composeEd.focus();
            }, 150);
        }

        function insertFooterImage(url) {
            if (!composeEd || !url) return;
            var cur = composeEd.getContent() || '';
            var foot = '<p style="margin-top:24px;text-align:center;"><img src="' + url + '" style="max-width:100%;border-radius:8px" /></p>';
            composeEd.setContent(cur + foot);
        }

        function isHttpUrl(u) {
            return /^https?:\/\//i.test((u || '').trim());
        }

        function postSend() {
            var sub = ($('#mail_subject').val() || '').trim();
            var body = composeEd ? (composeEd.getContent() || '') : '';
            var bodyText = body.replace(/<[^>]*>/g, '').replace(/&nbsp;/g, '').trim();
            if ((EMAIL_SCOPE === 'single' || EMAIL_SCOPE === 'selected') && !MAIL_TO_LIST.length) {
                Swal.fire({icon: 'error', title: 'Add at least one recipient'});
                return;
            }
            if (EMAIL_SCOPE === 'single' || EMAIL_SCOPE === 'selected') {
                for (var i = 0; i < MAIL_TO_LIST.length; i++) {
                    if (!isValidEmail(MAIL_TO_LIST[i])) {
                        Swal.fire({icon: 'error', title: 'Invalid email', text: MAIL_TO_LIST[i]});
                        return;
                    }
                }
            }
            if (!bodyText) {
                Swal.fire({icon: 'error', title: 'Body is required'});
                return;
            }
            if (!sub) {
                Swal.fire({icon: 'error', title: 'Subject is required'});
                return;
            }
            var token = $('meta[name="csrf-token"]').attr('content');
            $('#sendStatus').text('Sending…');
            $('#btnSendMail').prop('disabled', true);
            var to = '';
            if (EMAIL_SCOPE === 'single' || EMAIL_SCOPE === 'selected') {
                to = MAIL_TO_LIST.join(',');
            } else {
                to = $('#mail_to').val() || '';
            }
            var fd = new FormData();
            fd.append('_token', token);
            fd.append('to', to);
            fd.append('subject', sub);
            fd.append('html_body', body);
            fd.append('scope', EMAIL_SCOPE || '');
            EMAIL_IDS.forEach(function (id, idx) {
                fd.append('ids[' + idx + ']', id);
            });
            Object.keys(EMAIL_FILTERS || {}).forEach(function (k) {
                fd.append('filters[' + k + ']', EMAIL_FILTERS[k]);
            });
            var filesInput = document.getElementById('mail_attachments');
            if (filesInput && filesInput.files && filesInput.files.length) {
                for (var j = 0; j < filesInput.files.length; j++) {
                    fd.append('attachments[]', filesInput.files[j]);
                }
            }
            $.ajax({
                url: ROUTE.emailBulk,
                method: 'POST',
                data: fd,
                processData: false,
                contentType: false
            })
                .done(function () {
                    $('#sendStatus').text('Sent');
                    Swal.fire({
                        icon: 'success',
                        title: 'Email sent successfully!',
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: true
                    });
                    setTimeout(function () {
                        if (mailComposeModalInstance) mailComposeModalInstance.hide();
                        $('#sendStatus').text('');
                        $('#mail_subject').val('');
                        $('#mail_to').val('');
                        $('#mail_to_input').val('');
                        $('#mail_attachments').val('');
                        $('#mail_attachments_list').text('');
                        if (composeEd) composeEd.setContent('');
                        EMAIL_SCOPE = null;
                        EMAIL_IDS = [];
                        EMAIL_FILTERS = {};
                        resetRecipients();
                    }, 2000);
                })
                .fail(function (xhr) {
                    var msg = (xhr.responseJSON && (xhr.responseJSON.message ||
                        (xhr.responseJSON.errors && Object.values(xhr.responseJSON.errors)[0][0]))) || 'Send failed';
                    Swal.fire({icon: 'error', title: msg});
                    $('#sendStatus').text('');
                })
                .always(function () {
                    $('#btnSendMail').prop('disabled', false);
                });
        }

        $(function () {
            DT = $('#leadsTable').DataTable({
                processing: true,
                serverSide: true,
                scrollX: true,
                autoWidth: false,
                searching: false,
                ajax: {
                    url: ROUTE.dt,
                    data: function (d) {
                        d.status = $('#filterStatus').val() || '';
                        d.q = $('#filterSearch').val() || '';
                        d.date_from = $('#filterDateFrom').val() || '';
                        d.date_to = $('#filterDateTo').val() || '';
                    },
                    dataSrc: function (json) {
                        reloadKPIs(json);
                        return json.data;
                    }
                },
                order: [[1, 'desc']],
                columns: [
                    {
                        data: null,
                        orderable: false,
                        searchable: false,
                        className: 'text-center',
                        render: function () {
                            return '<input type="checkbox" class="form-check-input rowpick">';
                        }
                    },
                    {data: 'contact_date'},
                    {data: 'candidate_name'},
                    {data: 'contact_number'},
                    {data: 'email'},
                    {data: 'course_interested'},
                    {data: 'city'},
                    {
                        data: 'status',
                        render: function (data) {
                            if (!data) return '-';
                            var label = String(data)
                                .replace(/_/g, ' ')
                                .replace(/\b\w/g, function (c) {
                                    return c.toUpperCase();
                                });
                            var knownStatuses = [
                                'pending',
                                'processing',
                                'need_to_followup',
                                'enrolled',
                                'do_not_disturb',
                                'last_hope',
                                'not_interested',
                                'interested'
                            ];
                            var cls = knownStatuses.indexOf(data) !== -1
                                ? 'k-status-' + data + ' text-dark'
                                : 'bg-light text-dark border';
                            return '<span class="badge rounded-pill ' + cls + '">' + label + '</span>';
                        }
                    },
                    {data: 'enrolment_date'},
                    {data: 'created_by'},
                    {data: 'platform'},
                    {data: 'source'},
                    {data: 'notes'},
                    {data: 'follow_up_at'},
                    {data: 'follow_up2_at'},
                    {data: 'follow_up_final_at'},
                    {
                        data: 'actions',
                        orderable: false,
                        searchable: false
                    }
                ],
                lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
                initComplete: function () {
                    var api = this.api();
                    setTimeout(function () {
                        api.columns.adjust().draw(false);
                    }, 50);
                },
                drawCallback: function () {
                    this.api().columns.adjust();
                }
            });

            $('#filterDateFrom, #filterDateTo').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                autoApply: true,
                autoUpdateInput: false,
                locale: {
                    format: 'YYYY-MM-DD',
                    cancelLabel: 'Clear'
                }
            });

            $('#filterDateFrom, #filterDateTo').on('apply.daterangepicker', function (ev, picker) {
                $(this).val(picker.startDate.format('YYYY-MM-DD'));
            });

            $('#filterDateFrom, #filterDateTo').on('cancel.daterangepicker', function () {
                $(this).val('');
            });

            $('.quick-range').on('click', '.q-btn', function () {
                var key = $(this).data('range');
                applyQuickRange(key);
            });

            $('#btnFilter').on('click', function () {
                reloadTable();
            });

            $('#filterSearch').on('keyup', function (e) {
                if (e.key === 'Enter' || e.keyCode === 13) {
                    $('#btnFilter').click();
                }
            });

            $('#btnReload').on('click', function () {
                $('#filterStatus').val('');
                $('#filterSearch').val('');
                $('#filterDateFrom').val('');
                $('#filterDateTo').val('');
                $('.quick-range .q-btn').removeClass('active');
                $('.kpis .k').removeClass('k-active');
                $('.kpis .k-total').addClass('k-active');
                reloadTable();
            });

            $('#filterStatus').on('change', function () {
                var v = $(this).val() || '';
                $('.kpis .k').removeClass('k-active');
                if (!v) {
                    $('.kpis .k-total').addClass('k-active');
                } else {
                    $('.kpis .k-status-' + v).addClass('k-active');
                }
            });

            $(document).on('change', '#selectAll', function () {
                var checked = this.checked;
                $('#leadsTable tbody input.rowpick').each(function () {
                    this.checked = checked;
                    $(this).closest('tr').toggleClass('table-active', checked);
                });
            });

            $('#leadsTable').on('change', 'input.rowpick', function () {
                var total = $('#leadsTable tbody input.rowpick').length;
                var checkedCount = $('#leadsTable tbody input.rowpick:checked').length;
                $('#selectAll').prop('checked', total > 0 && total === checkedCount);
                $(this).closest('tr').toggleClass('table-active', this.checked);
            });

            DT.on('draw', function () {
                $('#selectAll').prop('checked', false);
            });

            $('.kpis').on('click', '.k', function () {
                var statusKey = $(this).data('status') || '';
                setStatusFilterFromKpi(statusKey);
            });

            $('#btnAdd').on('click', function () {
                $('#leadForm')[0].reset();
                $('#lead_id').val('');
                $('.followup-field').addClass('d-none');
                $('[name=follow_up2_at],[name=follow_up_final_at]').val('');
                $('[name=contact_date]').val(new Date().toISOString().slice(0, 10));
                new bootstrap.Modal(document.getElementById('leadModal')).show();
            });

            $('#leadsTable').on('click', '.act-edit', function () {
                $.getJSON(ROUTE.show($(this).data('id')), function (res) {
                    $('#lead_id').val(res.id);
                    $('[name=contact_date]').val(res.contact_date ? res.contact_date.substring(0, 10) : '');
                    $('[name=candidate_name]').val(res.candidate_name || '');
                    $('[name=contact_number]').val(res.contact_number || '');
                    $('[name=email]').val(res.email || '');
                    $('[name=course_interested]').val(res.course_interested || '');
                    $('[name=city]').val(res.city || '');
                    $('[name=status]').val(res.status || '');
                    $('[name=enrolment_date]').val(res.enrolment_date ? res.enrolment_date.substring(0, 10) : '');
                    $('[name=platform]').val(res.platform || '');
                    $('[name=source]').val(res.source || '');
                    $('[name=notes]').val(res.notes || '');
                    $('[name=follow_up_at]').val(res.follow_up_at ? res.follow_up_at.replace(' ', 'T') : '');
                    $('.followup-field').removeClass('d-none');
                    $('[name=follow_up2_at]').val(res.follow_up2_at ? res.follow_up2_at.replace(' ', 'T') : '');
                    $('[name=follow_up_final_at]').val(res.follow_up_final_at ? res.follow_up_final_at.replace(' ', 'T') : '');
                    $('[name=course_id]').val(res.course_id || '');
                    $('[name=user_id]').val(res.user_id || '');
                    new bootstrap.Modal(document.getElementById('leadModal')).show();
                });
            });

            $('#leadsTable').on('click', '.act-del', function () {
                var id = $(this).data('id');
                Swal.fire({
                    icon: 'warning',
                    title: 'Delete Lead?',
                    text: 'This action cannot be undone.',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, Delete',
                    cancelButtonText: 'Cancel'
                }).then(function (r) {
                    if (!r.isConfirmed) return;
                    $.ajax({
                        url: ROUTE.destroy(id),
                        type: 'DELETE',
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        success: function () {
                            Swal.fire({icon: 'success', title: 'Deleted!', timer: 1500, showConfirmButton: false});
                            reloadTable();
                        }
                    });
                });
            });

            $('#leadsTable').on('click', '.act-check', function () {
                var id = $(this).data('id');
                $.post(ROUTE.check(id), {
                    _token: $('meta[name="csrf-token"]').attr('content')
                }, function (res) {
                    if (res.enrolled) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Enrolment Found',
                            text: 'Learner is enrolled. User ID: ' + (res.user_id || '-')
                        });
                    } else {
                        Swal.fire({
                            icon: 'info',
                            title: 'No Enrolment',
                            text: 'No matching learner found for this lead.'
                        });
                    }
                    reloadTable();
                });
            });

            $('#leadsTable').on('click', '.act-auto', function () {
                var id = $(this).data('id');
                $.post(ROUTE.statusAuto(id), {
                    _token: $('meta[name="csrf-token"]').attr('content')
                }, function (res) {
                    var key = res.status || '';
                    var label = (STATUSES && STATUSES[key]) ? STATUSES[key] : key;
                    Swal.fire({
                        icon: 'success',
                        title: 'Status Updated',
                        text: 'New status: ' + (label || '-')
                    });
                    reloadTable();
                });
            });

            $('#leadForm').on('submit', function (e) {
                e.preventDefault();
                var id = $('#lead_id').val();
                var url = id ? ROUTE.update(id) : ROUTE.store;
                var method = id ? 'PUT' : 'POST';
                $.ajax({
                    url: url,
                    type: method,
                    data: $(this).serialize(),
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    success: function () {
                        bootstrap.Modal.getInstance(document.getElementById('leadModal')).hide();
                        Swal.fire({
                            icon: 'success',
                            title: 'Saved successfully',
                            timer: 1500,
                            showConfirmButton: false
                        });
                        reloadTable();
                    },
                    error: function (x) {
                        Swal.fire({icon: 'error', title: (x.responseJSON && x.responseJSON.message) || 'Error'});
                    }
                });
            });

            $('#btnBulkSync').on('click', function () {
                Swal.fire({
                    icon: 'question',
                    title: 'Sync Enrolled Leads?',
                    showCancelButton: true,
                    confirmButtonText: 'Yes'
                }).then(function (r) {
                    if (!r.isConfirmed) return;
                    $.post(ROUTE.sync, {_token: $('meta[name="csrf-token"]').attr('content')}, function () {
                        Swal.fire({icon: 'success', title: 'Synced!', timer: 1500, showConfirmButton: false});
                        reloadTable();
                    });
                });
            });

            $('#btnBulkAuto').on('click', function () {
                Swal.fire({
                    icon: 'question',
                    title: 'Auto-update all statuses?',
                    showCancelButton: true,
                    confirmButtonText: 'Run Auto'
                }).then(function (r) {
                    if (!r.isConfirmed) return;
                    $.post(ROUTE.statusAutoBulk, {_token: $('meta[name="csrf-token"]').attr('content')}, function () {
                        Swal.fire({icon: 'success', title: 'Statuses Updated', timer: 1500, showConfirmButton: false});
                        reloadTable();
                    });
                });
            });

            $('#btnBulkSet').on('click', function () {
                var s = $('#bulkStatus').val();
                if (!s) return;
                var ids = [];
                $('#leadsTable tbody tr').each(function () {
                    var chk = $(this).find('.rowpick');
                    if (chk.is(':checked')) {
                        var row = DT.row(this).data();
                        if (row) ids.push(row.id);
                    }
                });
                if (!ids.length) {
                    Swal.fire({icon: 'info', title: 'Select rows first'});
                    return;
                }
                Swal.fire({
                    icon: 'question',
                    title: 'Apply status to selected?',
                    showCancelButton: true,
                    confirmButtonText: 'Yes'
                }).then(function (r) {
                    if (!r.isConfirmed) return;
                    $.post(ROUTE.statusBulk, {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        ids: ids,
                        status: s
                    }, function () {
                        Swal.fire({icon: 'success', title: 'Status Applied', timer: 1500, showConfirmButton: false});
                        reloadTable();
                    });
                });
            });

            $('#leadsTable tbody').on('change', '.rowpick', function () {
                var tr = $(this).closest('tr');
                if (this.checked) {
                    tr.addClass('table-active');
                } else {
                    tr.removeClass('table-active');
                }
            });

            $('#btnFooterImg').on('click', function () {
                $('#footerUrlInput').val('');
                $('#footerUrlPreview').hide().empty();
                $('#footerUrlInput').removeClass('is-invalid');
                if (!footerUrlModalInstance) {
                    footerUrlModalInstance = new bootstrap.Modal(document.getElementById('footerUrlModal'));
                }
                footerUrlModalInstance.show();
                setTimeout(function () {
                    $('#footerUrlInput').trigger('focus');
                }, 150);
            });

            $('#footerUrlInput').on('input', function () {
                var v = ($(this).val() || '').trim();
                if (isHttpUrl(v)) {
                    $(this).removeClass('is-invalid');
                    $('#footerUrlPreview').show().html('<img src="' + v + '" class="img-fluid rounded">');
                } else {
                    $(this).addClass('is-invalid');
                    $('#footerUrlPreview').hide().empty();
                }
            });

            $('#footerUrlInsertBtn').on('click', function () {
                var v = ($('#footerUrlInput').val() || '').trim();
                if (!isHttpUrl(v)) {
                    $('#footerUrlInput').addClass('is-invalid').focus();
                    return;
                }
                insertFooterImage(v);
                if (footerUrlModalInstance) footerUrlModalInstance.hide();
            });

            $('#btnSendMail').off('click').on('click', postSend);

            $('#mailComposeModal').on('hidden.bs.modal', function () {
                $('#mail_subject').val('');
                $('#sendStatus').text('');
                $('#mail_to').val('');
                $('#mail_to_input').val('');
                $('#mail_attachments').val('');
                $('#mail_attachments_list').text('');
                if (composeEd) composeEd.setContent('');
                EMAIL_SCOPE = null;
                EMAIL_IDS = [];
                EMAIL_FILTERS = {};
                resetRecipients();
            });

            $('#btnBulkEmailSelected').on('click', function () {
                var ids = [];
                var emails = [];
                $('#leadsTable tbody tr').each(function () {
                    var chk = $(this).find('.rowpick');
                    if (chk.is(':checked')) {
                        var row = DT.row(this).data();
                        if (row) {
                            ids.push(row.id);
                            if (row.email) {
                                emails.push(row.email);
                            }
                        }
                    }
                });
                if (!ids.length) {
                    Swal.fire({icon: 'info', title: 'Select leads first'});
                    return;
                }
                var uniqueEmails = [];
                emails.forEach(function (e) {
                    e = (e || '').trim();
                    if (e && uniqueEmails.indexOf(e) === -1) uniqueEmails.push(e);
                });
                openCompose(uniqueEmails, 'selected', ids, {});
            });

            $('#btnBulkEmailAll').on('click', function () {
                var filters = {
                    status: $('#filterStatus').val() || '',
                    q: $('#filterSearch').val() || '',
                    date_from: $('#filterDateFrom').val() || '',
                    date_to: $('#filterDateTo').val() || ''
                };
                openCompose('All filtered leads', 'all_filtered', [], filters);
            });

            $('#mail_to_wrap').on('click', function (e) {
                if (e.target.id !== 'mail_to_input') {
                    $('#mail_to_input').trigger('focus');
                }
            });

            $('#mail_to_input').on('keydown', function (e) {
                if (e.key === 'Enter' || e.key === ',' || e.key === ';') {
                    e.preventDefault();
                    if (EMAIL_SCOPE === 'all_filtered') return;
                    addEmailFromInput();
                } else if (e.key === 'Backspace' && !this.value && (EMAIL_SCOPE === 'single' || EMAIL_SCOPE === 'selected')) {
                    if (MAIL_TO_LIST.length) {
                        MAIL_TO_LIST.pop();
                        renderRecipientChips();
                    }
                }
            });

            $('#mail_to_input').on('blur', function () {
                if (EMAIL_SCOPE === 'all_filtered') return;
                addEmailFromInput();
            });

            $(document).on('click', '.mail-chip-remove', function () {
                var idx = parseInt($(this).attr('data-idx'), 10);
                if (!isNaN(idx)) {
                    MAIL_TO_LIST.splice(idx, 1);
                    renderRecipientChips();
                }
            });

            $('#mail_attachments').on('change', function () {
                var files = this.files || [];
                var names = [];
                for (var i = 0; i < files.length; i++) {
                    names.push(files[i].name);
                }
                $('#mail_attachments_list').text(names.join(', '));
            });
        });
    </script>
@endpush
