@section('title','Profit Margins')

@push('css')
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
            --green: #22c55e;
            --border: #e5e7eb;
            --accent: #2563eb;
        }

        html, body {
            height: 100%;
        }

        body {
            background: radial-gradient(circle at top left, #eef2ff 0, #f3f4f6 45%, #f9fafb 100%);
            color: #2f3b52;
            font-size: 13px;
        }

        .card {
            background: var(--card-bg);
            border: 1px solid rgba(148, 163, 184, 0.28);
            border-radius: 20px;
            box-shadow: 0 18px 38px rgba(15, 23, 42, .08);
            padding: 0;
            overflow: hidden;
        }

        .pm-wrap {
            margin: 16px auto;
            padding: 14px 18px 18px;
        }

        .pm-grid {
            display: grid;
            grid-template-columns: 1.2fr .8fr;
            gap: 14px;
        }

        .pm-card {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 18px;
            padding: 14px 16px;
            box-shadow: 0 6px 18px rgba(15, 23, 42, .06);
            transition: transform .18s ease, box-shadow .18s ease, border-color .18s ease;
        }

        .pm-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 28px rgba(15, 23, 42, .09);
            border-color: rgba(129, 140, 248, .6);
        }

        .pm-title {
            font-size: .95rem;
            font-weight: 600;
            margin-bottom: 4px;
            color: var(--ink);
            letter-spacing: .04em;
            text-transform: uppercase;
        }

        .pm-sub {
            font-size: 12px;
            color: var(--muted);
            margin-bottom: 6px;
        }

        .pm-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 6px 0;
            border-bottom: 1px dashed #edf1f5;
        }

        .pm-row:last-child {
            border-bottom: 0;
        }

        .pm-k {
            font-size: 12px;
            color: var(--muted);
        }

        .pm-v {
            font-size: 13px;
            font-weight: 600;
            color: #111827;
        }

        .pm-kpi {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            margin-top: 14px;
        }

        .pm-kpi .pm-card {
            flex: 1;
            min-width: 160px;
            text-align: left;
            border-radius: 18px;
        }

        .pm-kpi .num {
            font-size: 1.35rem;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 4px;
            font-variant-numeric: tabular-nums;
        }

        .pm-kpi .lbl {
            font-size: .8rem;
            color: var(--muted);
            text-transform: none;
            letter-spacing: 0;
        }

        .pm-card.total {
            background: #e0f2fe;
            border-color: #38bdf8;
        }

        .pm-card.vat {
            background: #fef3c7;
            border-color: #facc15;
        }

        .pm-card.gross {
            background: #e9d5ff;
            border-color: #a855f7;
        }

        .pm-card.paid {
            background: #dcfce7;
            border-color: #22c55e;
        }

        .pm-card.misc {
            background: #fef9c3;
            border-color: #eab308;
        }

        .pm-card.profit {
            background: #dbeafe;
            border-color: #3b82f6;
        }

        .pm-card.resched-fee {
            background: #fee2e2;
            border-color: #fca5a5;
        }

        .pm-card.resched-vat {
            background: #fffbeb;
            border-color: #facc15;
        }

        .pm-card.table-card {
            margin-top: 14px;
        }

        .pm-table-wrap {
            width: 100%;
            overflow-x: auto;
            margin-top: 6px;
            border-radius: 14px;
            border: 1px solid #e5e7eb;
        }

        .pm-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            min-width: 820px;
            background: #ffffff;
        }

        .pm-thead th,
        .pm-tbody td {
            padding: 8px 10px;
            vertical-align: middle;
            box-sizing: border-box;
        }

        .pm-thead th {
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .08em;
            color: #4b5563;
            border-bottom: 1px solid #e5e7eb;
            background: linear-gradient(90deg, #eff6ff, #e0f2fe);
        }

        .pm-left {
            text-align: left;
        }

        .pm-right {
            text-align: right;
        }

        .pm-center {
            text-align: center;
        }

        .pm-tbody td {
            font-variant-numeric: tabular-nums;
            color: #111827;
            border-bottom: 1px solid #f1f5f9;
            background-color: #ffffff;
            font-size: 12px;
        }

        .pm-tbody tr:nth-child(even) td {
            background-color: #f9fafb;
        }

        .pm-tbody tr:last-child td {
            border-bottom: none;
        }

        .pm-tbody tr:hover td {
            background-color: #eff6ff;
        }

        .pm-ellip {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .pm-chip {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 3px 10px;
            border-radius: 9999px;
            font-size: 11px;
            font-weight: 600;
            border: 1px solid transparent;
        }

        .chip-paid {
            background: #e7f8ef;
            color: #137a37;
            border-color: #c7ebd6;
        }

        .chip-partial {
            background: #fff6ea;
            color: #a36100;
            border-color: #ffe3c2;
        }

        .chip-unpaid {
            background: #ffecec;
            color: #9b1c1c;
            border-color: #ffd3d3;
        }

        .pm-foot {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 12px;
            flex-wrap: wrap;
        }

        .pm-foot .pill {
            background: var(--pri);
            color: #fff;
            border-radius: 9999px;
            padding: 8px 14px;
            font-weight: 600;
            font-size: 12px;
            white-space: nowrap;
            box-shadow: 0 6px 16px rgba(17, 104, 230, .25);
        }

        .pm-foot .pill.secondary {
            background: rgba(15, 23, 42, 0.04);
            color: #0f172a;
            box-shadow: none;
            border: 1px solid #e5e7eb;
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
            background: #fff;
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

        @media (max-width: 1024px) {
            .pm-grid {
                grid-template-columns: 1fr;
            }

            .pm-kpi {
                justify-content: space-between;
            }

            .pm-thead th {
                font-size: 11px;
            }

            .pm-tbody td {
                font-size: 11px;
            }
        }

        @media (max-width: 768px) {
            .pm-wrap {
                padding: 12px;
            }

            .pm-thead th {
                font-size: 10px;
                padding: 6px 6px;
            }

            .pm-tbody td {
                font-size: 10px;
                padding: 6px 6px;
            }
        }
    </style>
@endpush

<div class="card">
    <div class="pm-wrap" id="profitMarginsApp"
         data-cohort-id="{{ $cohortId ?? (request()->route('training_course')) }}">
        <div class="pm-grid">
            <div class="pm-card">
                <div class="pm-title">Cohort Overview</div>
                <div class="pm-sub" id="pm-course-venue"></div>
                <div class="pm-row d-none">
                    <div class="pm-k">Booking Ref</div>
                    <div class="pm-v" id="pm-booking"></div>
                </div>
                <div class="pm-row">
                    <div class="pm-k">Schedule</div>
                    <div class="pm-v" id="pm-schedule"></div>
                </div>
                <div class="pm-row">
                    <div class="pm-k">Status</div>
                    <div class="pm-v" id="pm-status"></div>
                </div>
                <div class="pm-row">
                    <div class="pm-k">Max Learners</div>
                    <div class="pm-v" id="pm-max"></div>
                </div>
            </div>
            <div class="pm-card">
                <div class="pm-title">Trainer</div>
                <div class="pm-row">
                    <div class="pm-k">Trainer Name</div>
                    <div class="pm-v" id="pm-trainer-name"></div>
                </div>
                <div class="pm-row">
                    <div class="pm-k">Trainer Cost</div>
                    <div class="pm-v" id="pm-trainer-cost"></div>
                </div>
            </div>
        </div>

        <div class="pm-kpi" style="margin-top:12px">
            <div class="pm-card total">
                <div class="num" id="kpi-net">0.00</div>
                <div class="lbl">Total Revenue (All Invoices)</div>
            </div>
            <div class="pm-card vat">
                <div class="num" id="kpi-vat">0.00</div>
                <div class="lbl">VAT</div>
            </div>
            <div class="pm-card gross">
                <div class="num" id="kpi-gross">0.00</div>
                <div class="lbl">Gross Revenue</div>
            </div>
            <div class="pm-card paid">
                <div class="num" id="kpi-paid">0.00</div>
                <div class="lbl">Paid Revenue (Received)</div>
            </div>
            <div class="pm-card resched-fee">
                <div class="num" id="kpi-resched-fee">0.00</div>
                <div class="lbl">Reschedule Fee</div>
            </div>
            <div class="pm-card resched-vat">
                <div class="num" id="kpi-resched-vat">0.00</div>
                <div class="lbl">Reschedule VAT</div>
            </div>
            <div class="pm-card misc">
                <div class="num" id="kpi-misc-gross">0.00</div>
                <div class="lbl">Misc Gross</div>
            </div>
            <div class="pm-card profit">
                <div class="num" id="kpi-profit-after">0.00</div>
                <div class="lbl">Profit (After Misc & Trainer)</div>
            </div>
        </div>

        <div class="pm-card table-card" style="margin-top:12px">
            <div class="pm-title">Learners — Finance (Paid / Outstanding / Unpaid)</div>
            <div class="pm-table-wrap">
                <table class="pm-table" id="pm-learners">
                    <colgroup>
                        <col style="width:18%">
                        <col style="width:22%">
                        <col style="width:8%">
                        <col style="width:8%">
                        <col style="width:8%">
                        <col style="width:8%">
                        <col style="width:8%">
                        <col style="width:8%">
                        <col style="width:8%">
                        <col style="width:8%">
                    </colgroup>
                    <thead class="pm-thead">
                    <tr>
                        <th class="pm-left">Learner</th>
                        <th class="pm-left">Email</th>
                        <th class="pm-right">Net</th>
                        <th class="pm-right">Reschedule Fee</th>
                        <th class="pm-right">Reschedule VAT</th>
                        <th class="pm-right">VAT</th>
                        <th class="pm-right">Gross</th>
                        <th class="pm-right">Paid</th>
                        <th class="pm-right">Outstanding</th>
                        <th class="pm-left">Status</th>
                    </tr>
                    </thead>
                    <tbody class="pm-tbody"></tbody>
                </table>
            </div>
            <div id="pm-learners-pagination" class="mt-2 d-flex justify-content-end"></div>
            <div class="pm-foot">
                <div class="pill secondary">Profit Margin %: <span id="pm-profit-pct">0%</span></div>
                <div class="pill">Profit Amount: <span id="pm-profit-amt">0.00</span></div>
            </div>
        </div>
    </div>
</div>

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        (function () {
            const $app = $('#profitMarginsApp');
            const cohortId = $app.data('cohort-id');

            let learnersAll = [];
            let learnersCurrentPage = 1;
            const learnersPerPage = 10;

            function fmt(n) {
                return (Number(n || 0)).toFixed(2);
            }

            function chip(status) {
                if (status === 'Paid') return '<span class="pm-chip chip-paid">Paid</span>';
                if (status === 'Outstanding') return '<span class="pm-chip chip-partial" style="width:89px;">Outstanding</span>';
                return '<span class="pm-chip chip-unpaid">Unpaid</span>';
            }

            function renderOverview(c) {
                $('#pm-course-venue').text((c.course_name || '-') + ' • ' + (c.venue_name || '-'));
                $('#pm-booking').text(c.booking_reference || '—');
                const s1 = c.start_date_time ? c.start_date_time : '—';
                const s2 = c.end_date_time ? c.end_date_time : '—';
                $('#pm-schedule').text(s1 + ' → ' + s2);
                $('#pm-status').text(c.status || '—');
                $('#pm-max').text(c.max_learner || 0);
                $('#pm-trainer-name').text(c.trainer_name || '—');
                $('#pm-trainer-cost').text(fmt(c.trainer_cost));
            }

            function renderKpis(t) {
                $('#kpi-net').text(fmt(t.sum_net));
                $('#kpi-vat').text(fmt(t.sum_vat));
                $('#kpi-gross').text(fmt(t.sum_gross));
                $('#kpi-paid').text(fmt(t.sum_paid));
                const miscGross = t.misc_gross != null ? t.misc_gross : (Number(t.misc_net || 0) + Number(t.misc_vat || 0));
                $('#kpi-misc-gross').text(fmt(miscGross));
                $('#kpi-profit-after').text(fmt(t.profit_amount));
                $('#pm-profit-amt').text(fmt(t.profit_amount));
                $('#pm-profit-pct').text((Number(t.profit_margin_pct || 0)).toFixed(2) + '%');
                $('#kpi-resched-fee').text(fmt(t.resched_fee_net));
                $('#kpi-resched-vat').text(fmt(t.resched_fee_vat));
            }

            function sortLearners(list) {
                const order = { 'Unpaid': 1, 'Outstanding': 2, 'Paid': 3 };
                return (list || []).slice().sort(function (a, b) {
                    const sa = order[a.status] || 99;
                    const sb = order[b.status] || 99;
                    if (sa !== sb) return sa - sb;
                    const na = (a.learner_name || '').toLowerCase();
                    const nb = (b.learner_name || '').toLowerCase();
                    if (na < nb) return -1;
                    if (na > nb) return 1;
                    return 0;
                });
            }

            function renderLearnersTablePage() {
                const $tbody = $('#pm-learners .pm-tbody').empty();
                if (!learnersAll.length) {
                    $tbody.append('<tr><td colspan="10" style="padding:16px;text-align:center;color:#6b7280;">No learners found.</td></tr>');
                    return;
                }
                const total = learnersAll.length;
                const totalPages = Math.ceil(total / learnersPerPage);
                if (learnersCurrentPage > totalPages) learnersCurrentPage = totalPages || 1;
                const start = (learnersCurrentPage - 1) * learnersPerPage;
                const end = start + learnersPerPage;
                const slice = learnersAll.slice(start, end);

                slice.forEach(function (row) {
                    $tbody.append(
                        '<tr>' +
                        '<td class="pm-left pm-ellip">' + (row.learner_name || '—') + '</td>' +
                        '<td class="pm-left pm-ellip">' + (row.email || '—') + '</td>' +
                        '<td class="pm-right">' + fmt(row.total_net) + '</td>' +
                        '<td class="pm-right">' + fmt(row.fee_net) + '</td>' +
                        '<td class="pm-right">' + fmt(row.fee_vat) + '</td>' +
                        '<td class="pm-right">' + fmt(row.total_vat) + '</td>' +
                        '<td class="pm-right">' + fmt(row.total_gross) + '</td>' +
                        '<td class="pm-right">' + fmt(row.paid) + '</td>' +
                        '<td class="pm-right">' + fmt(row.outstanding) + '</td>' +
                        '<td class="pm-left">' + chip(row.status) + '</td>' +
                        '</tr>'
                    );
                });

                renderPagination(total, totalPages);
            }

            function renderPagination(totalRecords, totalPages) {
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
                $('#pm-learners-pagination').html(pagHtml);
            }

            function renderLearners(list) {
                learnersAll = sortLearners(list || []);
                learnersCurrentPage = 1;
                renderLearnersTablePage();
            }

            let isLoading = false;

            function load() {
                if (isLoading) return;
                isLoading = true;

                const url = `{{ route('crm.training-courses.profit-data',['cohort'=>'COHORT_ID_PLACEHOLDER']) }}`
                    .replace('COHORT_ID_PLACEHOLDER', cohortId);

                $.getJSON(url, function (resp) {
                    renderOverview(resp.cohort);
                    renderKpis(resp.totals);
                    renderLearners(resp.learners);
                }).fail(function () {
                    alert('Failed to load profit data.');
                }).always(function () {
                    isLoading = false;
                });
            }

            $(function () {
                load();
                let timer = setInterval(load, 10000);

                $(document).on('click', '#pm-learners-pagination .page-link', function (e) {
                    e.preventDefault();
                    const page = parseInt($(this).data('page'), 10);
                    if (!page || page === learnersCurrentPage) return;
                    const totalPages = Math.ceil(learnersAll.length / learnersPerPage);
                    if (page < 1 || page > totalPages) return;
                    learnersCurrentPage = page;
                    renderLearnersTablePage();
                });

                document.addEventListener('visibilitychange', function () {
                    if (document.hidden) {
                        clearInterval(timer);
                    } else {
                        load();
                        timer = setInterval(load, 10000);
                    }
                });

                $(window).on('beforeunload', function () {
                    clearInterval(timer);
                });
            });
        })();
    </script>
@endpush
