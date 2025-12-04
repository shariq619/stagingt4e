@extends('crm.layout.main')
@section('title', 'Training Courses')

@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css">
    <style>
        .ribbon {
            display: flex;
            gap: .75rem;
            flex-wrap: wrap;
            align-items: center;
            padding: .75rem 1rem;
            background: linear-gradient(135deg, #ffffff, #f9fafb);
            border: 1px solid rgba(148, 163, 184, .35);
            border-radius: 999px;
            box-shadow: 0 10px 30px rgba(15, 23, 42, .06);
            margin-bottom: 1.25rem;
        }
        .ribbon .group {
            display: inline-flex;
            gap: .4rem;
            align-items: center;
            background: var(--chip-soft);
            border-radius: 999px;
            padding: .25rem .55rem .25rem .5rem;
        }
        .ribbon .mini {
            display: flex;
            flex-wrap: wrap;
            gap: .35rem;
            align-items: center;
        }
        .ribbon select,
        .ribbon input {
            height: 36px;
            border: 1px solid var(--soft);
            background: #fff;
            border-radius: 999px;
            padding: .25rem .9rem;
            font-size: .875rem;
            color: var(--ink);
            min-width: 120px;
            outline: none;
            transition: border-color .16s ease, box-shadow .16s ease, background-color .16s ease;
        }
        .ribbon select:focus,
        .ribbon input:focus {
            border-color: rgba(37, 99, 235, .75);
            box-shadow: 0 0 0 1px rgba(37, 99, 235, .35);
            background-color: #f9fbff;
        }
        .ribbon .search {
            width: 260px;
        }
        .ribbon .pill {
            border-radius: 999px;
            border: 1px solid var(--soft);
            background: #fff;
            padding: .35rem .85rem;
            cursor: pointer;
            line-height: 1;
            user-select: none;
            font-size: .8rem;
            font-weight: 500;
            color: var(--muted);
            letter-spacing: .02em;
            text-transform: uppercase;
            transition: background-color .16s ease, color .16s ease, border-color .16s ease, box-shadow .16s ease, transform .12s ease;
        }
        .ribbon .pill:hover {
            background: #f9fafb;
            border-color: #d1d5db;
            color: var(--ink);
            transform: translateY(-1px);
            box-shadow: 0 1px 4px rgba(15, 23, 42, .08);
        }
        .ribbon .pill.active {
            color: blue;
            box-shadow: 0 2px 6px rgba(37, 99, 235, .35);
        }
        .ribbon .btn-blue {
            background: var(--chip);
            color: #fff;
            border: none;
            font-weight: 600;
        }
        .ribbon .btn-blue:hover {
            background: #1d4ed8;
        }
        .ribbon .btn-outline {
            background: #fff;
            color: var(--ink);
            border: 1px solid var(--soft);
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
        .card-modern .card-body {
            padding: 1.1rem 1.25rem 1.25rem;
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
        .td-trunc {
            max-width: 260px;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .empty {
            padding: 3rem 1rem;
            text-align: center;
            color: var(--muted);
            font-size: .9rem;
        }
        @media (max-width: 992px) {
            .ribbon {
                border-radius: 16px;
            }
        }
        @media (max-width: 576px) {
            .ribbon {
                flex-direction: column;
                align-items: stretch;
                border-radius: 18px;
            }
            .ribbon .group {
                width: 100%;
                justify-content: space-between;
            }
            .ribbon .search {
                width: 100%;
            }
            .td-trunc {
                max-width: 160px;
            }
        }
        #dtCourses_length {
            margin: 15px;
        }
        .form-control,
        .form-select {
            border-radius: 12px;
        }
    </style>

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
        .page-wrap {
            max-width: 1440px;
            margin-inline: auto;
            padding-inline: 1.25rem;
        }
        .page-inner {
            padding: 1.5rem 0 3rem;
        }
        .ribbon {
            display: flex;
            gap: .75rem;
            flex-wrap: wrap;
            align-items: center;
            padding: .75rem 1rem;
            background: linear-gradient(135deg, #ffffff, #f9fafb);
            border: 1px solid rgba(148, 163, 184, .35);
            border-radius: 999px;
            box-shadow: 0 10px 30px rgba(15, 23, 42, .06);
            margin-bottom: 1.25rem;
        }
        .ribbon .group {
            display: inline-flex;
            gap: .4rem;
            align-items: center;
            background: var(--chip-soft);
            border-radius: 999px;
            padding: .25rem .55rem .25rem .5rem;
        }
        .ribbon .mini {
            display: flex;
            flex-wrap: wrap;
            gap: .35rem;
            align-items: center;
        }
        .ribbon .pill {
            border-radius: 999px;
            border: 1px solid var(--soft);
            background: #fff;
            padding: .35rem .85rem;
            cursor: pointer;
            line-height: 1;
            user-select: none;
            font-size: .8rem;
            font-weight: 500;
            color: var(--muted);
            letter-spacing: .02em;
            text-transform: uppercase;
            transition: background-color .16s ease, color .16s ease, border-color .16s ease, box-shadow .16s ease, transform .12s ease;
        }
        .ribbon .pill:hover {
            background: #f9fafb;
            border-color: #d1d5db;
            color: var(--ink);
            transform: translateY(-1px);
            box-shadow: 0 1px 4px rgba(15, 23, 42, .08);
        }
        .ribbon .pill.active {
            color: blue;
            box-shadow: 0 2px 6px rgba(37, 99, 235, .35);
        }
        .ribbon .btn-blue {
            background: var(--chip);
            color: #fff;
            border: none;
            font-weight: 600;
        }
        .ribbon .btn-blue:hover {
            background: #1d4ed8;
        }
        .ribbon .search {
            width: 260px;
            height: 36px;
            border: 1px solid var(--soft);
            background: #fff;
            border-radius: 999px;
            padding: .25rem .9rem;
            font-size: .875rem;
            color: var(--ink);
            outline: none;
            transition: border-color .16s ease, box-shadow .16s ease, background-color .16s ease;
        }
        .ribbon .search:focus {
            border-color: rgba(37, 99, 235, .75);
            box-shadow: 0 0 0 1px rgba(37, 99, 235, .35);
            background-color: #f9fbff;
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
        .card-modern .card-body {
            padding: 1.1rem 1.25rem 1.25rem;
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
        .td-trunc {
            max-width: 260px;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        #dtLearners_length {
            margin: 15px;
        }
        .finder {
            position: fixed;
            inset: 80px 16px 16px 16px;
            background: #f9fafb;
            border: 1px solid rgba(148, 163, 184, .45);
            border-radius: 12px;
            box-shadow: 0 18px 40px rgba(15, 23, 42, .12);
            display: flex;
            flex-direction: column;
            z-index: 1050;
        }
        .finder.hidden {
            display: none;
        }
        .finder-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: linear-gradient(90deg, #eff6ff, #e0f2fe);
            color: var(--ink);
            padding: 8px 12px;
            border-top-left-radius: 12px;
            border-top-right-radius: 12px;
            font-weight: 600;
            font-size: .875rem;
        }
        .finder-close {
            background: #ffffff;
            border: 1px solid #d1d5db;
            border-radius: 999px;
            width: 28px;
            height: 28px;
            line-height: 26px;
            font-size: 18px;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: background-color .16s ease, border-color .16s ease, box-shadow .16s ease;
        }
        .finder-close:hover {
            background: #f9fafb;
            border-color: #9ca3af;
            box-shadow: 0 1px 4px rgba(15, 23, 42, .1);
        }
        .finder-title {
            font-size: .9rem;
        }
        .finder-grid {
            flex: 1;
            overflow: auto;
            background: #ffffff;
            padding: 6px 8px 8px;
        }
        .finder-row {
            display: grid;
            grid-template-columns: 120px 1.6fr 1.4fr 110px;
            gap: 10px;
            align-items: center;
            padding: 4px 6px;
            border-bottom: 1px solid #e5e7eb;
            font-family: ui-monospace, SFMono-Regular, Menlo, monospace;
            font-size: 12px;
        }
        .finder-row:hover {
            background: #f3f4ff;
        }
        .finder-row .dots {
            position: relative;
            overflow: hidden;
        }
        .finder-row .dots:after {
            content: "................................................................................................................................";
            position: absolute;
            left: 0;
            right: 0;
            white-space: nowrap;
            color: #d1d5db;
            pointer-events: none;
        }
        .finder-row span {
            background: #ffffff;
            position: relative;
            z-index: 1;
            padding-right: 6px;
        }
        .finder-col-date {
            color: #4b5563;
        }
        .finder-col-code {
            text-align: right;
            font-weight: 700;
            color: #6b7280;
        }
        .finder-active {
            outline: 2px solid rgba(37, 99, 235, .8);
        }
        @media (max-width: 992px) {
            .ribbon {
                border-radius: 16px;
            }
        }
        @media (max-width: 576px) {
            .ribbon {
                flex-direction: column;
                align-items: stretch;
                border-radius: 18px;
            }
            .ribbon .group {
                width: 100%;
                justify-content: space-between;
            }
            .ribbon .search {
                width: 100%;
            }
            .td-trunc {
                max-width: 160px;
            }
        }
        .form-control,
        .form-select {
            border-radius: 12px;
        }
        #dtCourses_filter {
            display: none;
        }
        .ctx-menu {
            display: none;
            position: absolute;
            z-index: 9999;
            background: #ffffff;
            border: 1px solid #e8eaf0;
            box-shadow: 0 12px 28px rgba(15, 23, 42, .2);
            border-radius: 10px;
            overflow: hidden;
            min-width: 230px;
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
    </style>

    <style>
        .status-modal {
            border-radius: 14px;
            box-shadow: 0 18px 40px rgba(15, 23, 42, .2);
            border: 1px solid #d1d5db;
        }
        .status-modal-header {
            background: linear-gradient(90deg, #e5edf7, #d9e2f2);
            border-bottom: 1px solid #cbd5e1;
            padding: .5rem .9rem;
        }
        .status-modal-header .modal-title {
            font-size: .95rem;
            font-weight: 600;
        }
        .status-modal-body {
            padding: .75rem .9rem 1rem;
            background: #f9fafb;
        }
        .status-grid {
            border: 1px solid #d1d5db;
            background: #ffffff;
        }
        .status-row {
            display: grid;
            grid-template-columns: 1.2fr 2fr;
            padding: .35rem .6rem;
            font-size: .8rem;
            align-items: center;
        }
        .status-header {
            background: #4b5563;
            color: #f9fafb;
            font-weight: 600;
        }
        .status-option {
            border: 0;
            width: 100%;
            text-align: left;
            background: #ffffff;
            cursor: pointer;
        }
        .status-option:nth-child(even) {
            background: #f9fafb;
        }
        .status-option:hover {
            background: #e5f0ff;
        }
        .status-modal-footer {
            padding: .5rem .9rem .6rem;
            border-top: 1px solid #e5e7eb;
        }
        .pagination {
            margin: 10px !important;
        }
    </style>
@endpush

@section('main')
    <div class="">
        <div class="page-inner py-3">
            <form id="filters" class="ribbon mb-3">
                <div class="group">
                    <select name="year" id="year">
                        @for ($y = now()->year + 1; $y >= 2016; $y--)
                            <option value="{{ $y }}" {{ request('year', now()->year) == $y ? 'selected' : '' }}>{{ $y }}</option>
                        @endfor
                    </select>
                    <select name="month" id="month">
                        @for ($m = 1; $m <= 12; $m++)
                            <option value="{{ $m }}" {{ request('month', now()->month) == $m ? 'selected' : '' }}>
                                {{ \Carbon\Carbon::create()->month($m)->format('F') }}
                            </option>
                        @endfor
                    </select>
                    <select name="day" id="day">
                        <option value="">All</option>
                        @for ($d = 1; $d <= 31; $d++)
                            <option value="{{ $d }}" {{ request('day') == $d ? 'selected' : '' }}>{{ $d }}</option>
                        @endfor
                    </select>
                </div>

                <div class="group">
                    <select name="status" id="status">
                        <option value="">--Status--</option>
                        @foreach(['Complete', 'Confirmed', 'Cancelled'] as $s)
                            <option value="{{ $s }}" {{ request('status') === $s ? 'selected' : '' }}>
                                {{ $s }}
                            </option>
                        @endforeach
                    </select>

                    <select class="d-none" name="trigger" id="trigger">
                        <option value="">--Trigger Events--</option>
                        @foreach(($triggerEvents ?? []) as $ev)
                            <option value="{{ $ev }}" {{ request('trigger') === $ev ? 'selected' : '' }}>{{ $ev }}</option>
                        @endforeach
                    </select>

                    <select class="d-none" name="module" id="module">
                        <option value="">--Modules--</option>
                        @foreach(($modules ?? []) as $mod)
                            <option value="{{ $mod }}" {{ request('module') === $mod ? 'selected' : '' }}>{{ $mod }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="group d-none">
                    <select name="invoice_status" id="invoice_status">
                        <option value="">--Course Invoice Status--</option>
                        @foreach(getPaymentStatus() as $ps)
                            <option value="{{ $ps }}" {{ request('invoice_status') === $ps ? 'selected' : '' }}>{{ $ps }}</option>
                        @endforeach
                    </select>
                </div>

                <input class="search" type="text" name="q" id="q" value="{{ request('q') }}" placeholder="Search By Names…">

                <div class="mini">
                    @php $alpha = range('A','Z'); @endphp
                    @foreach($alpha as $ch)
                        <button type="button" data-letter="{{ $ch }}" class="pill az">{{ $ch }}</button>
                    @endforeach
                    <button type="button" id="reset" class="pill">Reset</button>
                </div>

                <button class="pill btn-blue d-none" type="submit">Apply</button>
                <input type="hidden" name="starts" id="starts" value="{{ request('starts') }}">
            </form>

            <div class="card card-modern">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Training Courses</h4>
                    <span class="badge-soft" id="totalBadge">{{ number_format($cohort_count) }} total</span>
                </div>

                <div class="card-body">
                    <div class="table-wrap">
                        <table class="table-modern" id="dtCourses">
                            <thead>
                            <tr>
                                <th>Course Name</th>
                                <th>Course Date</th>
                                <th>Days</th>
                                <th>Availability</th>
                                <th>
                                    <span style="display:inline-block;">Net</span>
                                    <small class="text-muted" style="font-size:10px; position:relative; top:2px; margin-left:4px; display:inline-block;">
                                        (After Discount)
                                    </small>
                                </th>
                                <th>
                                    <span style="display:inline-block;">VAT</span>
                                    <small class="text-muted" style="font-size:10px; position:relative; top:2px; margin-left:4px; display:inline-block;">
                                        (After Discount)
                                    </small>
                                </th>
                                <th>Discount</th>
                                <th>
                                    <span style="display:inline-block;">Invoice Total</span>
                                    <small class="text-muted" style="font-size:10px; position:relative; top:2px; margin-left:4px; display:inline-block;">
                                        (After Discount)
                                    </small>
                                </th>
                                <th>Status</th>
                                <th>Customer</th>
                                <th>Trainer</th>
                                <th>Venue</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>

            <div id="courseCtxMenu" class="ctx-menu">
                <a href="#" data-action="copy">Copy Training Course</a>
                <a href="#" data-action="update">Update Training Course</a>
            </div>
        </div>
    </div>

    <div class="modal fade" id="statusModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content status-modal">
                <div class="modal-header status-modal-header">
                    <h5 class="modal-title">Course Status Database</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body status-modal-body">
                    <div class="status-meta mb-2 d-flex justify-content-between align-items-center">
                        <div class="small text-muted">Select a status to apply to this training course.</div>
                        <div class="small fw-semibold">
                            Current Status:
                            <span id="statusModalCurrent" class="badge bg-light text-dark border"></span>
                        </div>
                    </div>

                    <div class="status-grid">
                        <div class="status-row status-header">
                            <div class="status-col-code">Code</div>
                            <div class="status-col-name">Name</div>
                        </div>

                        <button type="button" class="status-row status-option" data-status="Cancelled">
                            <div class="status-col-code">Cancelled</div>
                            <div class="status-col-name">Cancelled</div>
                        </button>

                        <button type="button" class="status-row status-option" data-status="Complete">
                            <div class="status-col-code">Completed</div>
                            <div class="status-col-name">Training Completed</div>
                        </button>

                        <button type="button" class="status-row status-option" data-status="Confirmed">
                            <div class="status-col-code">Confirmed Course</div>
                            <div class="status-col-name">Confirmed Course</div>
                        </button>

                    </div>
                </div>

                <div class="modal-footer status-modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="copyCourseModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content status-modal">
                <div class="modal-header status-modal-header">
                    <h5 class="modal-title">
                        <i class="bi bi-people-fill me-2"></i> Copy Training Course
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>

                <div class="modal-body status-modal-body">
                    <input type="hidden" id="copyCohortId">

                    <div class="mb-2 d-flex flex-wrap gap-4">
                        <div class="form-check d-none">
                            <input class="form-check-input" type="checkbox" id="copyIncludeInfo" checked>
                            <label class="form-check-label" for="copyIncludeInfo">
                                Include Additional Info Data
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="copyExcludeDelegates" checked>
                            <label class="form-check-label" for="copyExcludeDelegates">
                                Exclude Learner-Delegates
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="copyExcludeTrainers" checked>
                            <label class="form-check-label" for="copyExcludeTrainers">
                                Exclude Trainers
                            </label>
                        </div>
                    </div>

                    <div class="row g-3 align-items-end">
                        <div class="col-md-4">
                            <label class="form-label mb-1">Start Date & Time</label>
                            <input type="text" class="form-control" id="copyStartDate" autocomplete="off"
                                   placeholder="Select start date & time">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label mb-1">End Date & Time</label>
                            <input type="text" class="form-control" id="copyEndDate" autocomplete="off"
                                   placeholder="Select end date & time">
                        </div>
                        <div class="col-md-4 d-flex gap-2">
                            <button type="button" class="btn btn-sm btn-outline-secondary flex-fill" id="btnCopyD1">D+1</button>
                            <button type="button" class="btn btn-sm btn-outline-secondary flex-fill" id="btnCopyM1">M+1</button>
                            <button type="button" class="btn btn-sm btn-outline-secondary flex-fill" id="btnCopyY1">Y+1</button>
                        </div>
                    </div>
                </div>

                <div class="modal-footer status-modal-footer d-flex justify-content-between">
                    <div></div>
                    <div class="d-flex gap-2">
                        <button type="button" class="btn btn-primary" id="copyProceed">Proceed</button>
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('js')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/moment@2.29.4/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script>
        var table;

        function params() {
            return {
                year: $('#year').val(),
                month: $('#month').val(),
                day: $('#day').val(),
                status: $('#status').val(),
                trigger: $('#trigger').val(),
                module: $('#module').val(),
                invoice_status: $('#invoice_status').val(),
                q: $('#q').val(),
                starts: $('#starts').val()
            };
        }

        $(function () {
            const trainers = @json($trainers ?? []);

            table = $('#dtCourses').DataTable({
                lengthChange: true,
                pageLength: 25,
                serverSide: true,
                processing: true,
                scrollX: true,
                autoWidth: false,
                searching: false,
                ajax: {
                    url: "{{ route('crm.training-courses.dt') }}",
                    data: function (d) {
                        $.extend(d, params());
                    }
                },
                order: [[1, 'asc']],
                columns: [
                    {data: 'course_name', name: 'course_name', orderable: false, searchable: false},
                    {data: 'course_date', name: 'start_date_time'},
                    {data: 'days', name: 'days', orderable: false},
                    {data: 'availability', name: 'availability', orderable: false, searchable: false},
                    {data: 'net', name: 'net', orderable: false, searchable: false},
                    {data: 'vat', name: 'vat', orderable: false, searchable: false},
                    {data: 'discount', name: 'discount', orderable: false, searchable: false},
                    {data: 'invoice_total', name: 'invoice_total', orderable: false, searchable: false},
                    {data: 'status_text', name: 'status'},
                    {data: 'customer', name: 'customer', orderable: false, searchable: false},
                    {data: 'trainer_name', name: 'trainer.name', orderable: false, searchable: false},
                    {data: 'venue_name', name: 'venue.venue_name', orderable: false, searchable: false}
                ],
                drawCallback: function (settings) {
                    const api = this.api();

                    if (settings.json && typeof settings.json.total !== 'undefined') {
                        $('#totalBadge').text(new Intl.NumberFormat().format(settings.json.total) + ' total');
                    }

                    api.columns.adjust();
                },
                initComplete: function () {
                    const api = this.api();
                    setTimeout(function () {
                        api.columns.adjust().draw(false);
                    }, 50);
                }
            });

            $(window).on('resize', function () {
                if (table) {
                    table.columns.adjust().draw(false);
                }
            });

            $('#filters').on('submit', function (e) {
                e.preventDefault();
                table.ajax.reload();
            });

            $('.az').on('click', function () {
                $('#starts').val($(this).data('letter'));
                table.ajax.reload();
                $('.az').removeClass('active');
                $(this).addClass('active');
            });

            $('#reset').on('click', function (e) {
                e.preventDefault();
                $('#filters').find('select').val('');
                $('#filters').find('input[type=text], input[type=hidden]').val('');
                $('.az').removeClass('active');
                const now = new Date();
                $('#year').val(now.getFullYear());
                $('#month').val(now.getMonth() + 1);
                table.search('').order([[1, 'asc']]).page(0).ajax.reload();
                $('#totalBadge').text('...');
            });

            $('#year,#month,#day,#status,#trigger,#module,#invoice_status').on('change', function () {
                table.ajax.reload();
            });

            $('#q').on('keyup', function (e) {
                if (e.key === 'Enter') {
                    table.ajax.reload();
                }
            });

            $('#q').on('blur', function () {
                table.ajax.reload();
            });

            const copyCourseUrlTemplate = "{{ route('crm.training-courses.copy', ['cohort' => '__ID__']) }}";
            const updateStatusUrl = "{{ route('crm.training-courses.update-status') }}";

            let ctxCourseId = null;
            let currentRowData = null;
            const $ctxMenu = $('#courseCtxMenu');

            $('#dtCourses tbody').on('contextmenu', 'tr', function (e) {
                e.preventDefault();
                const data = table.row(this).data();
                if (!data || !data.id) {
                    return;
                }
                ctxCourseId = data.id;
                currentRowData = data;
                $ctxMenu.css({
                    top: e.pageY + 'px',
                    left: e.pageX + 'px',
                    display: 'block'
                });
            });

            $(document).on('click', function () {
                $ctxMenu.hide();
            });

            function openStatusModal() {
                const current = currentRowData && currentRowData.status_text ? currentRowData.status_text : '-';
                $('#statusModalCurrent').text(current);
                const modalEl = document.getElementById('statusModal');
                const modal = new bootstrap.Modal(modalEl);
                modal.show();
            }

            function normalizeDateTimeString(str) {
                str = (str || '').trim();
                if (!str) return '';
                if (str.indexOf(' ') === -1) {
                    return str + ' 15:00';
                }
                return str;
            }

            function openCopyModal() {
                $('#copyCohortId').val(ctxCourseId);
                var startVal = '';
                var endVal = '';
                if (currentRowData) {
                    if (currentRowData.start_raw) startVal = currentRowData.start_raw;
                    else if (currentRowData.course_date_raw) startVal = currentRowData.course_date_raw;
                    else if (currentRowData.course_date) startVal = currentRowData.course_date;
                    if (currentRowData.end_raw) endVal = currentRowData.end_raw;
                    else if (currentRowData.end_date_raw) endVal = currentRowData.end_date_raw;
                    else if (currentRowData.end_date) endVal = currentRowData.end_date;
                }
                startVal = normalizeDateTimeString(startVal);
                endVal = normalizeDateTimeString(endVal);
                $('#copyStartDate').val(startVal);
                $('#copyEndDate').val(endVal);
                const modalEl = document.getElementById('copyCourseModal');
                const modal = new bootstrap.Modal(modalEl);
                modal.show();
            }

            $ctxMenu.on('click', 'a', function (e) {
                e.preventDefault();
                if (!ctxCourseId) return;
                const action = $(this).data('action');
                if (action === 'copy') {
                    openCopyModal();
                    $ctxMenu.hide();
                    return;
                } else if (action === 'update') {
                    openStatusModal();
                }
                $ctxMenu.hide();
            });

            $('.status-option').on('click', function () {
                if (!ctxCourseId) return;
                const newStatus = $(this).data('status');
                $.post(updateStatusUrl, {
                    _token: "{{ csrf_token() }}",
                    cohort_id: ctxCourseId,
                    status: newStatus
                }).done(function () {
                    const modalEl = document.getElementById('statusModal');
                    const modalInstance = bootstrap.Modal.getInstance(modalEl);
                    if (modalInstance) {
                        modalInstance.hide();
                    }
                    table.ajax.reload(null, false);
                });
            });

            $('#copyStartDate').daterangepicker({
                singleDatePicker: true,
                timePicker: true,
                timePicker24Hour: true,
                autoUpdateInput: false,
                locale: {
                    format: 'DD-MM-YYYY HH:mm'
                }
            });

            $('#copyEndDate').daterangepicker({
                singleDatePicker: true,
                timePicker: true,
                timePicker24Hour: true,
                autoUpdateInput: false,
                locale: {
                    format: 'DD-MM-YYYY HH:mm'
                }
            });

            $('#copyStartDate').on('apply.daterangepicker', function (ev, picker) {
                $(this).val(picker.startDate.format('DD-MM-YYYY HH:mm'));
            });

            $('#copyEndDate').on('apply.daterangepicker', function (ev, picker) {
                $(this).val(picker.startDate.format('DD-MM-YYYY HH:mm'));
            });

            function shiftMoment(value, type) {
                if (!value) return value;
                var m = moment(value, 'DD-MM-YYYY HH:mm', true);
                if (!m.isValid()) return value;
                if (type === 'D') m.add(1, 'day');
                if (type === 'M') m.add(1, 'month');
                if (type === 'Y') m.add(1, 'year');
                return m.format('DD-MM-YYYY HH:mm');
            }

            $('#btnCopyD1').on('click', function () {
                $('#copyStartDate').val(shiftMoment($('#copyStartDate').val(), 'D'));
                $('#copyEndDate').val(shiftMoment($('#copyEndDate').val(), 'D'));
            });

            $('#btnCopyM1').on('click', function () {
                $('#copyStartDate').val(shiftMoment($('#copyStartDate').val(), 'M'));
                $('#copyEndDate').val(shiftMoment($('#copyEndDate').val(), 'M'));
            });

            $('#btnCopyY1').on('click', function () {
                $('#copyStartDate').val(shiftMoment($('#copyStartDate').val(), 'Y'));
                $('#copyEndDate').val(shiftMoment($('#copyEndDate').val(), 'Y'));
            });

            function sendCopy(payload) {
                const url = copyCourseUrlTemplate.replace('__ID__', ctxCourseId);

                $.post(url, payload).done(function () {
                    const modalEl = document.getElementById('copyCourseModal');
                    const modalInstance = bootstrap.Modal.getInstance(modalEl);
                    if (modalInstance) {
                        modalInstance.hide();
                    }

                    Swal.fire({
                        icon: 'success',
                        title: 'Course copied',
                        text: 'A new training course has been created from this row.',
                        toast: true,
                        position: 'top-end',
                        timer: 2200,
                        showConfirmButton: false
                    });

                    table.ajax.reload();
                });
            }

            function pickTrainerAndCopy(payload) {
                if ($('#copyExcludeTrainers').is(':checked')) {
                    payload.trainer_id = null;
                    sendCopy(payload);
                    return;
                }

                const keys = Object.keys(trainers || {});
                if (!keys.length) {
                    Swal.fire({ icon: 'error', title: 'No trainers found', text: 'There are no trainers available to assign.' });
                    return;
                }

                let html = '<div style="text-align:left;">';
                keys.forEach(function (id) {
                    const name = trainers[id];
                    html += '<label style="display:flex;align-items:center;gap:.5rem;margin-bottom:.35rem;cursor:pointer;">' +
                        '<input type="radio" name="trainer_pick" value="' + id + '" style="accent-color:#2563eb;">' +
                        '<span style="font-size:.9rem;">' + name + '</span>' +
                        '</label>';
                });
                html += '</div>';

                Swal.fire({
                    title: 'Select Trainer',
                    html: html,
                    focusConfirm: false,
                    showCancelButton: true,
                    confirmButtonText: 'Use Trainer',
                    cancelButtonText: 'Cancel',
                    customClass: {
                        confirmButton: 'btn btn-primary',
                        cancelButton: 'btn btn-light'
                    },
                    buttonsStyling: false,
                    preConfirm: () => {
                        const el = document.querySelector('input[name="trainer_pick"]:checked');
                        if (!el) {
                            Swal.showValidationMessage('Please select a trainer');
                            return false;
                        }
                        return el.value;
                    }
                }).then(function (result) {
                    if (!result.isConfirmed) {
                        return;
                    }
                    payload.trainer_id = result.value;
                    sendCopy(payload);
                });
            }

            $('#copyProceed').on('click', function () {
                if (document.activeElement === this) {
                    this.blur();
                }

                if (!ctxCourseId) return;

                const startVal = $('#copyStartDate').val().trim();
                const endVal   = $('#copyEndDate').val().trim();

                if (!startVal || !endVal) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Dates required',
                        text: 'Please select both Start Date & Time and End Date & Time before copying this course.'
                    });
                    return;
                }

                const mStart = moment(startVal, 'DD-MM-YYYY HH:mm', true);
                const mEnd   = moment(endVal, 'DD-MM-YYYY HH:mm', true);

                if (!mStart.isValid() || !mEnd.isValid()) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Invalid date format',
                        text: 'Please use the date picker to select valid dates and times.'
                    });
                    return;
                }

                if (!mEnd.isAfter(mStart)) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Invalid range',
                        text: 'End Date & Time must be later than Start Date & Time.'
                    });
                    return;
                }

                const payload = {
                    _token: "{{ csrf_token() }}",
                    include_additional_info: $('#copyIncludeInfo').is(':checked') ? 1 : 0,
                    exclude_delegates: $('#copyExcludeDelegates').is(':checked') ? 1 : 0,
                    exclude_trainers: $('#copyExcludeTrainers').is(':checked') ? 1 : 0,
                    start_date_time: startVal,
                    end_date_time: endVal
                };

                pickTrainerAndCopy(payload);
            });
        });
    </script>
@endpush
