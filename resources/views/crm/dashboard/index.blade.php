@extends('crm.layout.main')
@section('title', 'Dashboard')

@push('css')
    <style>
        :root {
            --ink: #0f172a;
            --muted: #6b7280;
            --soft: #e5e7eb;
            --bg: #f3f4f6;
            --card-bg: #ffffffcc;
            --chip: #2563eb;
            --chip-soft: #e0edff;
            --header-bg: #f9fafb;
            --accent: #22c55e;
        }

        body {
            background: radial-gradient(circle at top left, #eef2ff 0, #f3f4f6 45%, #f9fafb 100%);
        }

        .page-wrap {
            max-width: 1840px;
            margin-inline: auto;
            padding-inline: 1.25rem;
        }

        .page-inner {
            padding: 1.5rem 0 3rem;
        }

        .section-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.5rem;
            gap: .75rem;
        }

        .section-header h3 {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--ink);
        }

        .refresh-btn {
            background: linear-gradient(135deg, #2563eb, #1e40af);
            color: #fff;
            border: none;
            padding: .55rem 1rem;
            border-radius: .75rem;
            font-size: .78rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: .4rem;
            cursor: pointer;
            transition: .2s ease;
            box-shadow: 0 4px 14px rgba(37, 99, 235, .25);
            white-space: nowrap;
        }

        .refresh-btn:hover {
            background: linear-gradient(135deg, #1d4ed8, #1e3a8a);
            transform: translateY(-1px);
        }

        .refresh-btn:active {
            transform: scale(.96);
        }

        .refresh-btn i {
            font-size: .85rem;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .stat-card {
            position: relative;
            backdrop-filter: blur(18px);
            background: linear-gradient(135deg, #f9fafbcc, #edf4ffcc);
            border: 1px solid #dce3f8;
            border-radius: 1.1rem;
            box-shadow: 0 10px 28px rgba(15, 23, 42, .08);
            padding: 1rem 1rem;
            display: flex;
            align-items: center;
            gap: .85rem;
            transition: transform .25s ease, box-shadow .25s ease, background .25s ease, opacity .3s ease;
            opacity: 0;
            transform: translateY(6px);
        }

        .stat-card.show {
            opacity: 1;
            transform: translateY(0);
        }

        .stat-card::after {
            content: "";
            position: absolute;
            inset: 0;
            border-radius: inherit;
            background: radial-gradient(circle at top left, rgba(255, 255, 255, .6), transparent 55%);
            pointer-events: none;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 18px 40px rgba(37, 99, 235, .14);
            background: linear-gradient(135deg, #ffffff, #e3eeff);
        }

        .stat-icon {
            width: 46px;
            height: 46px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ffffff;
            font-size: 1.05rem;
            z-index: 1;
        }

        .icon-clients {
            background: linear-gradient(135deg, #60a5fa, #93c5fd);
        }

        .icon-learners {
            background: linear-gradient(135deg, #38bdf8, #a5f3fc);
        }

        .icon-sales {
            background: linear-gradient(135deg, #4ade80, #bbf7d0);
        }

        .icon-orders {
            background: linear-gradient(135deg, #a78bfa, #ddd6fe);
        }

        .stat-meta {
            flex: 1 1 auto;
            z-index: 1;
        }

        .stat-label {
            font-size: .7rem;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: .05em;
            margin-bottom: .1rem;
        }

        .stat-value {
            font-size: 1.45rem;
            font-weight: 700;
            color: var(--ink);
        }

        .stat-hint {
            font-size: .72rem;
            color: var(--muted);
        }

        .panel-grid {
            display: flex;
            gap: 1rem;
            align-items: stretch;
        }

        @media (max-width: 992px) {
            .panel-grid {
                flex-direction: column;
            }
        }

        .panel-card {
            flex: 1 1 0;
            backdrop-filter: blur(18px);
            background: var(--card-bg);
            border: 1px solid #dbe3f8;
            border-radius: 1.1rem;
            box-shadow: 0 14px 32px rgba(15, 23, 42, .08);
            display: flex;
            flex-direction: column;
            overflow: hidden;
            min-width: 0;
            height: 560px;
        }

        .panel-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: .85rem 1rem .7rem;
            background: linear-gradient(135deg, #f9faff, #edf2ff);
            border-bottom: 1px solid #e5e7eb;
            flex-shrink: 0;
        }

        .panel-title {
            font-size: .8rem;
            font-weight: 700;
            color: var(--ink);
        }

        .panel-body {
            padding: .85rem 1rem 1rem;
            flex: 1 1 auto;
            display: flex;
        }

        .list-users {
            display: flex;
            flex-direction: column;
            gap: .55rem;
            flex: 1 1 auto;
            overflow-y: auto;
            padding-right: .35rem;
        }

        .user-row {
            display: flex;
            align-items: center;
            gap: .7rem;
            border-radius: 1rem;
            padding: .35rem .35rem;
            transition: background .2s ease, transform .2s ease, box-shadow .2s ease;
            text-decoration: none;
            color: inherit;
        }

        .user-row:hover {
            background: #e5efff;
            transform: translateY(-1px);
            box-shadow: 0 8px 18px rgba(15, 23, 42, .06);
            text-decoration: none;
        }

        .user-row:hover .user-name {
            color: #2563eb;
        }

        .user-avatar {
            width: 46px;
            height: 46px;
            border-radius: 1rem;
            background: linear-gradient(135deg, #eff6ff, #dbeafe);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #1d4ed8;
            font-weight: 700;
            font-size: .95rem;
            border: 1px solid #e0e7ff;
            overflow: hidden;
            flex-shrink: 0;
        }

        .user-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: inherit;
            display: block;
        }

        .user-main {
            flex: 1 1 auto;
            min-width: 0;
            display: flex;
            flex-direction: column;
            gap: 1px;
        }

        .user-name {
            font-size: .82rem;
            font-weight: 600;
            color: var(--ink);
            white-space: nowrap;
            text-overflow: ellipsis;
            overflow: hidden;
        }

        .user-role {
            font-size: .72rem;
            color: var(--muted);
        }

        .user-meta {
            font-size: .7rem;
            color: var(--muted);
        }

        .tx-table-wrap {
            flex: 1 1 auto;
            overflow-y: auto;
            overflow-x: hidden;
            padding-right: .35rem;
        }

        .tx-table {
            width: 100%;
            border-collapse: collapse;
            font-size: .8rem;
            table-layout: auto;
        }

        .tx-table td,
        .tx-table th {
            white-space: nowrap;
        }

        .tx-table th:nth-child(1),
        .tx-table td:nth-child(1) {
            width: 38%;
        }

        .tx-table th:nth-child(2),
        .tx-table td:nth-child(2) {
            width: 26%;
        }

        .tx-table th:nth-child(3),
        .tx-table td:nth-child(3) {
            width: 20%;
        }

        .tx-table th:nth-child(4),
        .tx-table td:nth-child(4) {
            width: 16%;
        }

        .tx-table thead th {
            font-size: .7rem;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: .05em;
            padding: .6rem .75rem;
            border-bottom: 1px solid var(--soft);
            background: #f9fafb;
        }

        .tx-table tbody tr {
            border-bottom: 1px solid #f1f5f9;
            transition: background .18s ease, transform .18s ease;
        }

        .tx-table tbody tr:last-child {
            border-bottom: 0;
        }

        .tx-table tbody tr:hover {
            background: #eef4ff;
            transform: translateY(-1px);
        }

        .tx-table td {
            padding: .65rem .75rem;
            vertical-align: middle;
            color: var(--ink);
        }

        .tx-id {
            display: flex;
            align-items: center;
            gap: .55rem;
            font-weight: 600;
            min-width: 0;
        }

        .tx-icon {
            width: 28px;
            height: 28px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #bfdbfe, #93c5fd);
            color: #1e3a8a;
            font-size: .75rem;
            flex-shrink: 0;
        }

        .tx-id div:last-child {
            min-width: 0;
        }

        .tx-id div:last-child .tx-sub {
            white-space: nowrap;
            text-overflow: ellipsis;
            overflow: hidden;
            display: block;
            max-width: 100%;
        }

        .tx-sub {
            font-size: .7rem;
            color: var(--muted);
        }

        .tx-amount {
            font-variant-numeric: tabular-nums;
            font-feature-settings: "tnum";
        }

        .status-chip {
            display: inline-flex;
            align-items: center;
            border-radius: 999px;
            padding: .3rem .6rem;
            font-size: .7rem;
            font-weight: 600;
        }

        .status-success {
            background: rgba(16, 185, 129, .15);
            color: #166534;
        }

        .status-danger {
            background: rgba(239, 68, 68, .16);
            color: #7f1d1d;
        }

        .status-muted {
            background: rgba(148, 163, 184, .18);
            color: #1f2937;
        }

        .text-end {
            text-align: right;
        }

        .list-users::-webkit-scrollbar,
        .tx-table-wrap::-webkit-scrollbar {
            width: 8px;
        }

        .list-users::-webkit-scrollbar-track,
        .tx-table-wrap::-webkit-scrollbar-track {
            background: #eef2ff;
            border-radius: 999px;
        }

        .list-users::-webkit-scrollbar-thumb,
        .tx-table-wrap::-webkit-scrollbar-thumb {
            background: linear-gradient(180deg, #c7d2fe, #a5b4fc);
            border-radius: 999px;
        }

        .list-users::-webkit-scrollbar-thumb:hover,
        .tx-table-wrap::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(180deg, #a5b4fc, #818cf8);
        }
        .list-users,
        .tx-table-wrap {
            height: 560px;
        }
        .list-users,
        .tx-table-wrap {
            overflow-y: auto;
            overflow-x: hidden;
        }

        .list-users::-webkit-scrollbar,
        .tx-table-wrap::-webkit-scrollbar {
            width: 8px;
        }

        .list-users::-webkit-scrollbar-track,
        .tx-table-wrap::-webkit-scrollbar-track {
            background: #eef2ff;
            border-radius: 10px;
        }

        .list-users::-webkit-scrollbar-thumb,
        .tx-table-wrap::-webkit-scrollbar-thumb {
            background: #c7d2fe;
            border-radius: 10px;
        }

        .list-users::-webkit-scrollbar-thumb:hover,
        .tx-table-wrap::-webkit-scrollbar-thumb:hover {
            background: #a5b4fc;
        }


        .list-users,
        .tx-table-wrap {
            scrollbar-width: thin;
            scrollbar-color: #a5b4fc #eef2ff;
        }
    </style>
@endpush

@section('main')
    <div class="page-wrap">
        <div class="page-inner">

            <div class="section-header">
                <h3>Dashboard</h3>
                <button id="refreshDashboard" class="refresh-btn">
                    <i class="fas fa-sync-alt"></i>
                    Refresh
                </button>
            </div>

            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon icon-clients">
                        <i class="fas fa-user-tie"></i>
                    </div>
                    <div class="stat-meta">
                        <div class="stat-label">Clients</div>
                        <div class="stat-value">{{ $clients }}</div>
                        <div class="stat-hint">Corporate</div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon icon-learners">
                        <i class="fas fa-user-check"></i>
                    </div>
                    <div class="stat-meta">
                        <div class="stat-label">Learners</div>
                        <div class="stat-value">{{ $learners }}</div>
                        <div class="stat-hint">Active</div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon icon-sales">
                        <i class="fas fa-pound-sign"></i>
                    </div>
                    <div class="stat-meta">
                        <div class="stat-label">Sales</div>
                        <div class="stat-value">£{{ number_format($sales, 2) }}</div>
                        <div class="stat-hint">Revenue</div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon icon-orders">
                        <i class="fas fa-receipt"></i>
                    </div>
                    <div class="stat-meta">
                        <div class="stat-label">Payments</div>
                        <div class="stat-value">{{ $orders }}</div>
                        <div class="stat-hint">Transactions</div>
                    </div>
                </div>
            </div>

            <div class="panel-grid">
                <div class="panel-card">
                    <div class="panel-head">
                        <div class="panel-title">New Learners</div>
                    </div>
                    <div class="panel-body">
                        <div class="list-users">
                            @foreach($recent_learners as $learner)
                                @php
                                    $initial   = strtoupper(mb_substr($learner->name ?? 'U', 0, 1));
                                    $photoPath = optional($learner->profilePhoto)->profile_photo;
                                    $hasPhoto  = $photoPath && file_exists(public_path($photoPath));
                                    $learnerUrl = route('crm.learner.delegates.show', $learner->id);
                                @endphp
                                <a href="{{ $learnerUrl }}" target="_blank" rel="noopener" class="user-row">
                                    <div class="user-avatar">
                                        @if($hasPhoto)
                                            <img src="{{ asset($photoPath) }}" alt="{{ $learner->name }}">
                                        @else
                                            {{ $initial }}
                                        @endif
                                    </div>
                                    <div class="user-main">
                                        <div class="user-name">
                                            {{ $learner->name }}
                                        </div>
                                        <div class="user-role">{{ $learner->designation ?? 'Learner' }}</div>
                                        <div class="user-meta">ID: {{ $learner->id }}</div>
                                    </div>
                                </a>
                            @endforeach
                            @if($recent_learners->isEmpty())
                                <div style="padding:.4rem 0;font-size:.8rem;color:var(--muted);">
                                    No recent learners to display.
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="panel-card">
                    <div class="panel-head">
                        <div class="panel-title">New Cohorts</div>
                    </div>
                    <div class="panel-body">
                        <div class="list-users">
                            @foreach($recent_cohorts as $cohort)
                                @php
                                    $courseName = $cohort->course->name ?? 'Untitled course';
                                    $dateLabel  = $cohort->start_date_time
                                        ? \Carbon\Carbon::parse($cohort->start_date_time)->format('d M Y')
                                        : 'TBC';
                                    $status     = $cohort->status ?? 'N/A';
                                    $learnersCount = $cohort->learners_count ?? 0;
                                    $initial   = strtoupper(mb_substr($courseName, 0, 1));
                                    $url       = route('crm.training-courses.show', $cohort->id);
                                @endphp

                                <a href="{{ $url }}" target="_blank" rel="noopener" class="user-row">
                                    <div class="user-avatar">
                                        {{ $initial }}
                                    </div>
                                    <div class="user-main">
                                        <div class="user-name">
                                            {{ $courseName }}
                                        </div>
                                        <div class="user-role">
                                            {{ $dateLabel }} • {{ ucfirst($status) }}
                                        </div>
                                        <div class="user-meta">
                                            Learners: {{ $learnersCount }}
                                        </div>
                                    </div>
                                </a>
                            @endforeach

                            @if($recent_cohorts->isEmpty())
                                <div style="padding:.4rem 0;font-size:.8rem;color:var(--muted);">
                                    No recent cohorts to display.
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="panel-card">
                    <div class="panel-head">
                        <div class="panel-title">Payments</div>
                    </div>
                    <div class="panel-body">
                        <div class="tx-table-wrap">
                            <table class="tx-table">
                                <thead>
                                <tr>
                                    <th>Payment</th>
                                    <th class="text-end">When</th>
                                    <th class="text-end">Amount</th>
                                    <th class="text-end">Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($payments as $payment)
                                    @php
                                        $invoice = $payment->invoice;
                                        $customer = $invoice?->user;
                                        $statusLabel = $payment->is_refunded ? 'Refunded' : 'Paid';
                                        $badgeClass = $payment->is_refunded ? 'status-danger' : 'status-success';
                                    @endphp
                                    <tr>
                                        <td>
                                            <div class="tx-id">
                                                <div class="tx-icon">
                                                    <i class="fa fa-credit-card"></i>
                                                </div>
                                                <div>
                                                    <div>Payment #{{ $payment->id }}</div>
                                                    <span class="tx-sub">
                                                        @if($invoice)
                                                            Inv: {{ $invoice->invoice_no }}
                                                            @if($customer)
                                                                • {{ $customer->name }}
                                                            @endif
                                                        @else
                                                            No invoice linked
                                                        @endif
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-end">
                                            {{ optional($payment->payment_date)->format('M d, Y g:i A') }}
                                        </td>
                                        <td class="text-end tx-amount">
                                            £{{ number_format($payment->amount, 2) }}
                                        </td>
                                        <td class="text-end">
                                            <span class="status-chip {{ $badgeClass }}">{{ $statusLabel }}</span>
                                        </td>
                                    </tr>
                                @endforeach
                                @if($payments->isEmpty())
                                    <tr>
                                        <td colspan="4" class="text-center"
                                            style="padding:.9rem .75rem;color:var(--muted);font-size:.8rem;">
                                            No recent payments to display.
                                        </td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@push('js')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        $(function () {
            $('.stat-card').each(function (i) {
                var card = $(this);
                setTimeout(function () {
                    card.addClass('show');
                }, 90 * i);
            });

            $(document).on('click', '#refreshDashboard', function () {
                var $btn = $('#refreshDashboard');
                var original = $btn.html();
                $btn.html('<i class="fas fa-spinner fa-spin"></i> Loading');

                $.ajax({
                    url: "{{ route('crm.dashboard.index') }}",
                    type: "GET",
                    dataType: "html",
                    success: function (response) {
                        var $res = $(response);
                        var newPanels = $res.find('.panel-grid').html();
                        var newStats = $res.find('.stats-grid').html();

                        if (newStats) {
                            $('.stats-grid').html(newStats);
                            $('.stat-card').each(function (i) {
                                var card = $(this);
                                setTimeout(function () {
                                    card.addClass('show');
                                }, 90 * i);
                            });
                        }

                        if (newPanels) {
                            $('.panel-grid').html(newPanels);
                        }

                        $btn.html(original);
                    },
                    error: function () {
                        $btn.html(original);
                    }
                });
            });
        });
    </script>
@endpush
