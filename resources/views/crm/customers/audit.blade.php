@extends('crm.layout.main')
@section('title','User Audit Logs')

@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
    <style>
        :root {
            --ink: #0f172a;
            --muted: #6b7280;
            --bg: #f3f4f6;
            --soft: #f8fafc;
            --card-bg: #ffffff;
            --pri: #1168e6;
            --pri-soft: #e0edff;
            --border: #d0d5dd;
        }

        body {
            background: radial-gradient(circle at top left, #eef2ff 0, #f3f4f6 45%, #f9fafb 100%);
            color: var(--ink);
            font: 13px "Segoe UI", system-ui, -apple-system, BlinkMacSystemFont, Arial, sans-serif;
        }

        #wrap {
            padding: 12px;
        }

        .card {
            background: var(--card-bg);
            border: 1px solid #e5e7eb;
            border-radius: 18px;
            box-shadow: 0 12px 32px rgba(15, 23, 42, .08);
            overflow: hidden;
        }

        .toolbar {
            background: linear-gradient(135deg, #ffffff, #edf2ff);
            padding: 14px 18px;
            display: flex;
            flex-direction: column;
            gap: 12px;
            border-bottom: 1px solid #e5e7eb;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(12, minmax(0, 1fr));
            gap: 10px;
            align-items: flex-end;
        }

        .grid + .grid {
            margin-top: 6px;
        }

        .cell {
            grid-column: span 3;
        }

        .x1 {
            grid-column: span 1;
        }

        .x2 {
            grid-column: span 2;
        }

        .x3 {
            grid-column: span 3;
        }

        .x4 {
            grid-column: span 4;
        }

        .x5 {
            grid-column: span 5;
        }

        .x6 {
            grid-column: span 6;
        }

        .x10 {
            grid-column: span 10;
        }

        .x12 {
            grid-column: span 12;
        }

        .label {
            color: var(--muted);
            font-size: 11px;
            margin-bottom: 4px;
            letter-spacing: .05em;
            text-transform: uppercase;
        }

        .input,
        .select {
            height: 36px;
            border-radius: 999px;
            border: 1px solid var(--border);
            background: #f3f4f6;
            padding: 0 12px;
            width: 100%;
            font-size: 12px;
            color: var(--ink);
            transition: all .15s ease-in-out;
        }

        .input:focus,
        .select:focus {
            outline: none;
            background: #ffffff;
            border-color: var(--pri);
            box-shadow: 0 0 0 3px rgba(17, 104, 230, .18);
        }

        .row2 {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            flex-wrap: wrap;
        }

        .row2 .left {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .row2 .right {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .pills {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .pill {
            padding: 0 12px;
            height: 30px;
            line-height: 30px;
            border-radius: 999px;
            border: 1px solid rgba(148, 163, 184, .5);
            color: #374151;
            cursor: pointer;
            font-weight: 600;
            font-size: 12px;
            background: #f9fafb;
            transition: transform .12s ease,
            background .2s ease,
            color .2s ease,
            box-shadow .2s ease,
            border-color .2s ease;
        }

        .pill:hover {
            transform: translateY(-1px) scale(1.02);
            background: #e5edff;
            box-shadow: 0 6px 16px rgba(15, 23, 42, .18);
            border-color: #c4d5ff;
        }

        .pill.active {
            background: #ffffff;
            color: #111827;
            border-color: #93c5fd;
            box-shadow: 0 4px 10px rgba(15, 23, 42, .16);
        }

        .row-actions {
            display: flex;
            gap: 8px;
            justify-content: flex-end;
            flex-wrap: wrap;
        }

        .btn {
            height: 32px;
            border-radius: 999px;
            border: 1px solid #d0d5dd;
            background: #ffffff;
            padding: 0 14px;
            cursor: pointer;
            font-size: 12px;
            font-weight: 600;
            color: #1f2937;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all .15s ease-in-out;
        }

        .btn:hover {
            background: var(--pri);
            color: #ffffff;
            border-color: var(--pri);
            box-shadow: 0 6px 14px rgba(17, 104, 230, .35);
            transform: translateY(-1px);
        }

        .table-wrap {
            padding: 14px 18px 8px;
        }

        .erp-scroll {
            max-height: calc(100vh - 240px);
            overflow: auto;
            border-radius: 14px;
            border: 1px solid #e5e7eb;
            background: #ffffff;
        }

        .erp-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }

        .erp-table thead th {
            position: sticky;
            top: 0;
            z-index: 2;
            background: linear-gradient(90deg, #eff6ff, #e0f2fe);
            color: #111827;
            font-weight: 600;
            border-bottom: 1px solid var(--border);
        }

        .erp-table thead th,
        .erp-table tbody td {
            padding: 10px 12px;
            font-size: 12px;
            vertical-align: middle;
            white-space: nowrap;
        }

        .erp-table tbody tr {
            transition: background .12s.ease;
        }

        .erp-table tbody tr:nth-child(even) {
            background: #f9fafb;
        }

        .erp-table tbody tr:hover {
            background: #eff6ff;
        }

        .erp-table tbody tr td:first-child {
            color: var(--muted);
        }

        .clip {
            max-width: 320px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .badge {
            display: inline-block;
            padding: 2px 8px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 600;
        }

        .b-upd {
            background: #dbeafe;
            color: #1d4ed8;
        }

        .b-del {
            background: #fee2e2;
            color: #b91c1c;
        }

        .b-re {
            background: #fef9c3;
            color: #854d0e;
            border: 1px solid #facc15;
        }

        .dataTables_wrapper .dataTables_paginate {
            padding: 8px 0 10px;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 4px 9px;
            margin: 0 2px;
            background: #ffffff;
            color: #111827 !important;
            font-size: 11px;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current,
        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: var(--pri) !important;
            color: #ffffff !important;
            border-color: var(--pri);
            box-shadow: 0 3px 8px rgba(17, 104, 230, .35);
        }

        .dataTables_wrapper .dataTables_info {
            color: var(--muted);
            padding-top: 6px;
            font-size: 11px;
        }

        .dataTables_wrapper .dataTables_processing {
            background: #ffffffd9;
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 8px 12px;
            box-shadow: 0 6px 18px rgba(15, 23, 42, .18);
            font-size: 12px;
            color: var(--ink);
        }

        .buttons-csv {
            display: none !important;
        }

        .m-ov {
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, .25);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            backdrop-filter: blur(3px);
        }

        .m-ov.open {
            display: flex;
        }

        .m-box {
            width: min(900px, 96vw);
            background: #ffffff;
            border-radius: 18px;
            border: 1px solid var(--border);
            box-shadow: 0 24px 60px rgba(15, 23, 42, .3);
            overflow: hidden;
        }

        .m-hd {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px 16px;
            border-bottom: 1px solid var(--border);
            background: #f8fafc;
        }

        .m-tt {
            font-weight: 700;
            font-size: 14px;
            color: var(--ink);
        }

        .m-bd {
            padding: 14px 16px;
            max-height: 70vh;
            overflow: auto;
            background: #ffffff;
        }

        .m-ft {
            text-align: right;
            padding: 10px 16px;
            border-top: 1px solid var(--border);
            background: #f9fafb;
        }

        .m-x {
            border: none;
            background: transparent;
            font-size: 20px;
            cursor: pointer;
            color: var(--muted);
            transition: color .15s ease;
        }

        .m-x:hover {
            color: #ef4444;
        }

        .chg-tab {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .chg-tab th,
        .chg-tab td {
            border: 1px solid var(--border);
            padding: 6px 8px;
            vertical-align: top;
            font-size: 12px;
        }

        .chg-tab thead th {
            background: #f1f5f9;
            font-weight: 600;
            color: var(--ink);
        }

        .chg-key {
            white-space: nowrap;
            background: #eef3fa;
            font-weight: 600;
        }

        .chg-old {
            background: #fff7f7;
        }

        .chg-new {
            background: #f4fff6;
        }

        .muted {
            color: var(--muted);
            font-size: 12px;
        }

        .date-shortcuts {
            display: inline-flex;
            gap: 4px;
        }

        .ds-btn {
            width: 26px;
            height: 26px;
            border-radius: 8px;
            border: 1px solid var(--pri);
            background: #ffffff;
            color: var(--pri);
            font-size: 11px;
            font-weight: 700;
            padding: 0;
            line-height: 24px;
            text-align: center;
            cursor: pointer;
        }

        .ds-btn:hover,
        .ds-btn.active {
            background: var(--pri);
            color: #ffffff;
        }

        @media (max-width: 1024px) {
            .grid {
                grid-template-columns: repeat(6, minmax(0, 1fr));
            }

            .cell,
            .x6,
            .x5,
            .x4,
            .x3,
            .x2 {
                grid-column: span 3;
            }
        }

        @media (max-width: 640px) {
            .grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .cell,
            .x6,
            .x5,
            .x4,
            .x3,
            .x2,
            .x1 {
                grid-column: span 2;
            }

            .toolbar {
                gap: 10px;
            }
        }
    </style>
@endpush

@section('main')
    <div id="wrap">
        <div class="card">
            <div class="toolbar">
                <div class="grid">
                    <div class="cell x2">
                        <div class="label">Event</div>
                        <select class="select" id="f-event">
                            <option value="">Any</option>
                            <option value="created">created</option>
                            <option value="updated" selected>updated</option>
                            <option value="deleted">deleted</option>
                            <option value="restored">restored</option>
                            <option value="forceDeleted">forceDeleted</option>
                        </select>
                    </div>
                    <div class="cell x2">
                        <div class="label">From</div>
                        <input type="date" class="input" id="f-from">
                    </div>
                    <div class="cell x2">
                        <div class="label">To</div>
                        <input type="date" class="input" id="f-to">
                    </div>
                    <div class="cell x5">
                        <div class="label">Search</div>
                        <input class="input" id="f-q"
                               placeholder="ID, name, email, user, IP, any text — even ‘From: … → To: …’">
                    </div>
                    <div class="cell x1">
                        <div class="label">Per page</div>
                        <select class="select" id="f-pp">
                            <option>25</option>
                            <option selected>50</option>
                            <option>100</option>
                        </select>
                    </div>
                </div>

                <div class="row2">
                    <div class="left">
                        <div class="label">Quick filter</div>
                        <div class="pills">
                            <span class="pill" data-ev="created">Created</span>
                            <span class="pill active" data-ev="updated">Updated</span>
                            <span class="pill" data-ev="deleted">Deleted</span>
                            <span class="pill" data-ev="restored">Restored</span>
                        </div>
                    </div>
                    <div class="right">
                        <div class="date-shortcuts">
                            <button type="button" class="ds-btn" data-range="today">T</button>
                            <button type="button" class="ds-btn" data-range="week">W</button>
                            <button type="button" class="ds-btn" data-range="month">M</button>
                            <button type="button" class="ds-btn" data-range="clear">C</button>
                        </div>
                    </div>
                </div>

                <div class="grid">
                    <div class="cell x12">
                        <div class="row-actions">
                            <button class="btn" id="btn-refresh">Refresh</button>
                            <button class="btn" id="btn-reset">Reset</button>
                            <button class="btn" id="btn-export">Export CSV</button>
                        </div>
                    </div>
                </div>
            </div>

            <div style="padding:14px" class="table-wrap">
                <div class="erp-scroll">
                    <table id="auditTable" class="display compact stripe erp-table">
                        <thead>
                        <tr>
                            <th class="nowrap">#</th>
                            <th class="nowrap">When</th>
                            <th class="nowrap">Event</th>
                            <th class="nowrap">Type</th>
                            <th class="nowrap">Target</th>
                            <th class="nowrap">User</th>
                            <th class="nowrap">IP</th>
                            <th class="nowrap">Changes</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div id="changeModal" class="m-ov" aria-hidden="true">
        <div class="m-box" role="dialog" aria-modal="true" aria-labelledby="chgTitle">
            <div class="m-hd">
                <div class="m-tt" id="chgTitle">Changes</div>
                <button type="button" class="m-x" id="chgClose" aria-label="Close">&times;</button>
            </div>
            <div class="m-bd">
                <div class="muted" id="chgMeta"></div>
                <div style="margin-top:10px">
                    <table class="chg-tab">
                        <thead>
                        <tr>
                            <th style="width:240px">Field</th>
                            <th>Old</th>
                            <th>New</th>
                        </tr>
                        </thead>
                        <tbody id="chgBody"></tbody>
                    </table>
                </div>
            </div>
            <div class="m-ft">
                <button class="btn" id="chgClose2">Close</button>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script>
        $(function () {
            const pad = n => String(n).padStart(2, '0');
            const fmt = d => d.getFullYear() + '-' + pad(d.getMonth() + 1) + '-' + pad(d.getDate());

            const now = new Date();
            const today = fmt(now);
            if (!$('#f-from').val()) $('#f-from').val(today);
            if (!$('#f-to').val()) $('#f-to').val(today);

            const userId = @json($user->id);
            var url = "{{ route('crm.users.audit.dt', ':user') }}".replace(':user', userId);

            const table = $('#auditTable').DataTable({
                serverSide: true,
                processing: true,
                scrollX: true,
                autoWidth: false,
                searching: false,
                pageLength: parseInt($('#f-pp').val(), 10),
                ajax: {
                    url: url,
                    type: 'get',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data: function (d) {
                        d.event = $('#f-event').val();
                        d.from = $('#f-from').val();
                        d.to = $('#f-to').val();
                        d.search = {value: $('#f-q').val()};
                    },
                    dataSrc: function (json) {
                        const filtered = Array.isArray(json.data)
                            ? json.data.filter(r => Array.isArray(r.changes_list) && r.changes_list.length > 0)
                            : [];
                        json.recordsFiltered = filtered.length;
                        return filtered;
                    },
                    initComplete: function () {
                        const api = this.api();
                        setTimeout(function () {
                            api.columns.adjust().draw(false);
                        }, 50);
                    },
                    drawCallback: function () {
                        this.api().columns.adjust();
                    }
                },
                order: [[1, 'asc']],
                columns: [
                    {data: 'id', name: 'user_audit_logs.id', width: '60px'},
                    {data: 'at', name: 'user_audit_logs.created_at', width: '170px'},
                    {
                        data: 'event_badge',
                        name: 'user_audit_logs.event',
                        orderable: false,
                        searchable: false,
                        width: '260px'
                    },
                    {data: 'type', name: 'user_audit_logs.auditable_type', width: '150px'},
                    {
                        data: 'auditable_id',
                        name: 'user_audit_logs.auditable_id',
                        width: '140px',
                        orderable: false,
                        searchable: false
                    },
                    {data: 'user_name', name: 'users.name', width: '180px'},
                    {data: 'ip', name: 'user_audit_logs.ip', width: '140px'},
                    {data: 'changes_btn', orderable: false, searchable: false, width: '140px'}
                ],
                dom: 'Bfrtip',
                buttons: [{extend: 'csvHtml5', text: 'Export CSV', className: 'btn-primary'}]
            });

            $(window).on('resize', function () {
                if (table) {
                    table.columns.adjust().draw(false);
                }
            });

            function setActivePill(ev) {
                const valid = ['created', 'updated', 'deleted', 'restored'];
                $('.pill').removeClass('active');
                if (valid.indexOf(ev) !== -1) {
                    $('.pill[data-ev="' + ev + '"]').addClass('active');
                }
            }

            function reload() {
                table.ajax.reload(null, true);
            }

            function debounce(fn, wait) {
                let t;
                return function () {
                    clearTimeout(t);
                    t = setTimeout(fn, wait);
                };
            }

            function show(v) {
                return (v === null || v === undefined || v === '') ? '∅' : String(v);
            }

            function esc(s) {
                return $('<div/>').text(s).html();
            }

            $('#f-event').on('change', function () {
                setActivePill($(this).val());
                reload();
            });
            $('#f-from,#f-to').on('change', reload);
            $('#f-q').on('input', debounce(reload, 250));
            $('#f-pp').on('change', function () {
                table.page.len(parseInt($(this).val(), 10)).draw(false);
            });
            $('.pill').on('click', function () {
                $('#f-event').val($(this).data('ev')).trigger('change');
            });
            $('#btn-refresh').on('click', reload);
            $('#btn-reset').on('click', function () {
                $('#f-event').val('updated').trigger('change');
                $('#f-from').val(today);
                $('#f-to').val(today);
                $('#f-q').val('');
                $('#f-pp').val('50').trigger('change');
                $('.ds-btn').removeClass('active');
                reload();
            });
            $('#btn-export').on('click', function () {
                $('.buttons-csv').click();
            });

            $('.ds-btn').on('click', function () {
                const range = $(this).data('range');
                const base = new Date();

                let from = '';
                let to = '';

                if (range === 'today') {
                    from = fmt(base);
                    to = fmt(base);
                } else if (range === 'week') {
                    const past = new Date(base);
                    past.setDate(past.getDate() - 7);
                    from = fmt(past);
                    to = fmt(base);
                } else if (range === 'month') {
                    const first = new Date(base.getFullYear(), base.getMonth(), 1);
                    from = fmt(first);
                    to = fmt(base);
                } else if (range === 'clear') {
                    $('#f-from,#f-to').val('');
                }

                if (range !== 'clear') {
                    $('#f-from').val(from);
                    $('#f-to').val(to);
                }

                $('.ds-btn').removeClass('active');
                if (range !== 'clear') {
                    $(this).addClass('active');
                }

                reload();
            });

            const $ov = $('#changeModal'), $bd = $('#chgBody'), $meta = $('#chgMeta'), $ttl = $('#chgTitle');
            $(document).on('click', '.btn-changes', function () {
                const tr = $(this).closest('tr');
                const row = table.row(tr).data() || {};
                const list = Array.isArray(row.changes_list) ? row.changes_list : [];
                let html = '';
                for (let i = 0; i < list.length; i++) {
                    html += '<tr><th class="chg-key">' + esc(list[i].field || '') + '</th><td class="chg-old">' + esc(show(list[i].old)) + '</td><td class="chg-new">' + esc(show(list[i].new)) + '</td></tr>';
                }
                if (!html) html = '<tr><td colspan="3" class="muted">No visible changes</td></tr>';
                $ttl.text('Changes (' + list.length + ')');
                $meta.text((row.at ? ' • ' + row.at : ''));
                $bd.html(html);
                $ov.addClass('open').attr('aria-hidden', 'false');
            });
            $('#chgClose,#chgClose2,#changeModal').on('click', function (e) {
                if (e.target.id === 'chgClose' || e.target.id === 'chgClose2' || e.target.id === 'changeModal') {
                    $ov.removeClass('open').attr('aria-hidden', 'true');
                    $bd.empty();
                }
            });
            $(document).on('keydown', function (e) {
                if (e.key === 'Escape' && $ov.hasClass('open')) {
                    $ov.removeClass('open').attr('aria-hidden', 'true');
                    $bd.empty();
                }
            });
        });
    </script>
@endpush
