@extends('crm.layout.main')
@section('title', 'Newsletter - Campaigns')

@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <style>
        :root {
            --ink: #0f172a;
            --muted: #6b7280;
            --border: #e5e7eb;
            --soft: #f3f4f6;
            --bg: #f3f4f6;
            --accent: #2563eb;
            --accent-soft: #eff6ff;
            --danger: #ef4444
        }

        body {
            background: var(--bg);
            color: var(--ink);
            font-family: -apple-system, BlinkMacSystemFont, "SF Pro Text", system-ui, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            font-size: 14px;
            line-height: 1.4
        }

        .page-inner {
            padding: 24px 0 48px
        }

        .form-control {
            border-radius: 999px;
            border: 1px solid #d1d5db;
            font-size: 14px;
            line-height: 1.4;
            color: #111827;
            height: 36px;
            padding: 6px 12px;
            background: #f9fafb
        }

        .form-select {
            border-radius: 999px;
            border: 1px solid #d1d5db;
            height: 36px;
            padding: 6px 12px;
            background: #f9fafb
        }

        .badge-soft {
            background: #eff6ff;
            color: #2563eb;
            font-weight: 600;
            border-radius: 999px;
            padding: 3px 8px;
            font-size: 12px
        }

        .shell, .table-shell {
            border-radius: 20px;
            border: 1px solid var(--border);
            background: #ffffff;
            box-shadow: 0 18px 38px rgba(15, 23, 42, .10);
            position: relative;
            overflow: hidden
        }

        .shell {
            padding: 18px 22px 20px;
            margin-bottom: 16px
        }

        .shell-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 4px
        }

        .shell-title {
            display: flex;
            align-items: flex-start;
            gap: 10px
        }

        .shell-icon {
            width: 34px;
            height: 34px;
            border-radius: 999px;
            background: var(--accent-soft);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--accent);
            flex-shrink: 0;
            border: 1px solid #dbeafe
        }

        .shell-icon i {
            font-size: 18px
        }

        .shell-text-title {
            font-size: 15px;
            font-weight: 700;
            letter-spacing: .02em;
            color: var(--ink)
        }

        .shell-text-sub {
            font-size: 12px;
            color: var(--muted);
            margin-top: 2px
        }

        .shell-actions {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap
        }

        .shell-meta {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 11px;
            color: var(--muted);
            flex-wrap: wrap
        }

        .meta-pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: .25rem .65rem;
            border-radius: 999px;
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            font-weight: 500
        }

        .meta-pill i {
            font-size: 14px;
            color: var(--accent)
        }

        .table-shell .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            padding: 10px 16px;
            border-bottom: 1px solid #e5e7eb;
            background: #f9fafb
        }

        .table-shell .header-left .title {
            font-size: 13px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .08em;
            color: var(--ink)
        }

        .table-shell .header-left .sub {
            font-size: 11px;
            color: var(--muted);
            margin-top: 1px
        }

        .table-shell .header-right {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap
        }

        .table-modern {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0
        }

        .table-modern th, .table-modern td {
            padding: 10px 12px;
            border-bottom: 1px solid var(--border);
            background: #fff
        }

        .table-modern th {
            font-weight: 700;
            background: #f8fafc;
            text-transform: uppercase;
            font-size: 11px;
            letter-spacing: .08em;
            color: #4b5563
        }

        .table-modern tbody tr:hover {
            background: #f3f4f6;
            transform: translateY(-1px)
        }

        .empty {
            padding: 24px;
            text-align: center;
            color: var(--muted);
            font-weight: 500
        }

        .pager {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            padding: 10px 14px;
            background: #fff;
            border-top: 1px solid var(--border)
        }

        .pager-left {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap
        }

        .pager-right {
            display: flex;
            align-items: center;
            gap: 6px;
            flex-wrap: wrap
        }

        .pill {
            border: 1px solid #d1d5db;
            background: #fff;
            border-radius: 999px;
            height: 34px;
            padding: 0 12px;
            display: inline-flex;
            align-items: center;
            font-size: 12px;
            font-weight: 600
        }

        .select-pp {
            border: 1px solid #d1d5db;
            border-radius: 999px;
            height: 34px;
            padding: 0 12px;
            background: #fff;
            font-size: 12px
        }

        .pager-btn {
            border: 1px solid #d1d5db;
            background: #fff;
            border-radius: 999px;
            height: 34px;
            padding: 0 12px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer
        }

        .pager-btn[disabled] {
            opacity: .5;
            cursor: not-allowed
        }

        .page-link {
            border: 1px solid #d1d5db;
            background: #fff;
            border-radius: 10px;
            min-width: 34px;
            height: 34px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer
        }

        .page-link.active {
            background: #2563eb;
            color: #fff;
            border-color: #2563eb
        }

        .btn {
            border-radius: 8px
        }

        .btn-newsletter {
            border-radius: 9999px !important;
            padding-left: 1rem;
            padding-right: 1rem;
            font-weight: 600
        }

        .ds-modal {
            max-width: 980px;
            width: 95%
        }

        .ds-head {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 10px
        }

        .ds-search {
            flex: 1;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            height: 36px;
            padding: 6px 10px
        }

        .ds-letters {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            margin: 8px 0
        }

        .ds-letters button {
            border: 1px solid #d1d5db;
            background: #fff;
            border-radius: 6px;
            font-size: 12px;
            padding: .25rem .45rem;
            cursor: pointer
        }

        .ds-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0
        }

        .ds-table th, .ds-table td {
            padding: 10px 12px;
            border-bottom: 1px solid #e5e7eb;
            background: #fff
        }

        .ds-table th {
            background: #f8fafc;
            font-weight: 700;
            font-size: 12px;
            letter-spacing: .02em
        }

        .addr-add-btn {
            font-size: 11px;
            border-radius: 6px;
            border: 1px solid #d1d5db;
            background: #fff;
            line-height: 1.2;
            padding: .3rem .5rem;
            font-weight: 600;
            cursor: pointer
        }

        .avatar {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: var(--accent-soft);
            color: var(--accent);
            font-weight: 700;
            border: 1px solid #dbeafe
        }

        .btn-newsletter.disabled,
        .btn-newsletter:disabled {
            opacity: .6;
            cursor: not-allowed
        }

        .status-pill {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 2px 10px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 600;
            border: 1px solid transparent;
            line-height: 1;
        }

        .status-pill.sent {
            background: #dcfce7;
            color: #166534;
            border-color: #bbf7d0
        }

        .status-pill.pending,
        .status-pill.queued,
        .status-pill.remaining {
            background: #fef9c3;
            color: #92400e;
            border-color: #fef3c7
        }

        .status-pill.failed {
            background: #fee2e2;
            color: #b91c1c;
            border-color: #fecaca
        }
    </style>
@endpush

@section('main')
    <div class="container-fluid page-inner">
        <div class="shell">
            <div class="shell-header">
                <div class="shell-title">
                    <div class="shell-icon"><i class="bi bi-send-check-fill"></i></div>
                    <div>
                        <div class="shell-text-title">Newsletter Campaigns</div>
                        <div class="shell-text-sub">Build a campaign from your newsletter recipients</div>
                    </div>
                </div>
                <div class="shell-actions">
                    <select id="newsletterPick" class="form-select form-select-sm" style="width:260px"
                            aria-label="Select Newsletter"></select>
                    <select id="dataSource" class="form-select form-select-sm" style="width:220px"
                            aria-label="Data Source"></select>
                    <input id="groupName" type="text" class="form-control" placeholder="Group Name"
                           style="width:200px"/>
                    <button id="btnBuild" class="btn btn-primary btn-sm btn-newsletter">
                        <i class="bi bi-hammer me-1"></i>Build Campaign
                    </button>
                    <button id="btnRefresh" class="btn btn-outline-secondary btn-sm">
                        <i class="bi bi-arrow-clockwise"></i>
                    </button>
                    <button id="btnDsHelp" class="btn btn-outline-secondary btn-sm">Help</button>
                    <select id="perPage" class="select-pp">
                        <option value="10">10 / page</option>
                        <option value="20">20 / page</option>
                        <option value="50">50 / page</option>
                        <option value="100">100 / page</option>
                    </select>
                </div>
            </div>
            <div class="shell-meta">
                <span class="meta-pill"><i class="bi bi-diagram-3"></i><span id="metaTotal">0 total</span></span>
                <span class="meta-pill"><i class="bi bi-envelope"></i><span
                        id="metaNewsletter">Newsletter: Any</span></span>
            </div>
        </div>

        <div class="shell" style="padding-top:12px;">
            <div class="shell-text-title" style="margin-bottom:8px;">Dictionary</div>
            <div id="dict" class="d-flex flex-wrap gap-2"></div>
        </div>

        <div class="table-shell">
            <div class="header">
                <div class="header-left">
                    <div class="title">Campaign List</div>
                    <div class="sub">All built campaigns ready to send</div>
                </div>
                <div class="header-right">
                    <span class="meta-pill"><i class="bi bi-123"></i><span id="metaRange">0–0 of 0</span></span>
                </div>
            </div>
            <div>
                <table class="table-modern" id="tbl" aria-live="polite">
                    <thead>
                    <tr>
                        <th>Newsletter</th>
                        <th style="width:54px">Image</th>
                        <th>Data Source</th>
                        <th>Group Name</th>
                        <th>Email Sender</th>
                        <th>Subject</th>
                        <th>Last Date Sent</th>
                        <th>Total</th>
                        <th>Sent</th>
                        <th>Remaining</th>
                        <th style="width:220px"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr id="loadingRow">
                        <td colspan="11" class="empty">Loading…</td>
                    </tr>
                    </tbody>
                </table>
                <div id="empty" class="empty" style="display:none">No campaigns found</div>

                <div class="pager">
                    <div class="pager-left">
                        <span id="range" class="pill">0–0 of 0</span>
                    </div>
                    <div class="pager-right">
                        <button id="firstBtn" class="pager-btn"><i class="bi bi-chevron-double-left"></i> First</button>
                        <button id="prevBtn" class="pager-btn"><i class="bi bi-chevron-left"></i> Prev</button>
                        <div id="pages" style="display:flex;gap:6px"></div>
                        <button id="nextBtn" class="pager-btn">Next <i class="bi bi-chevron-right"></i></button>
                        <button id="lastBtn" class="pager-btn">Last <i class="bi bi-chevron-double-right"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        (function ($) {
            var tbody = $('#tbl tbody'),
                emptyBox = $('#empty'),
                pick = $('#newsletterPick'),
                dsSel = $('#dataSource'),
                groupTxt = $('#groupName'),
                dictBox = $('#dict'),
                btnBuild = $('#btnBuild'),
                btnHelp = $('#btnDsHelp'),
                btnRefresh = $('#btnRefresh');
            var metaTotal = $('#metaTotal'),
                metaNewsletter = $('#metaNewsletter'),
                metaRange = $('#metaRange');
            var pagesBox = $('#pages'),
                rangeBox = $('#range'),
                firstBtn = $('#firstBtn'),
                prevBtn = $('#prevBtn'),
                nextBtn = $('#nextBtn'),
                lastBtn = $('#lastBtn'),
                perPageSel = $('#perPage');

            var ROUTE_LIST = @json(route('crm.newsletters.campaigns.list'));
            var ROUTE_DICT = @json(route('crm.newsletters.campaigns.dict'));
            var ROUTE_NEWSLETTERS = @json(route('crm.newsletters.list'));
            var ROUTE_BUILD = @json(route('crm.newsletters.campaigns.build'));
            var ROUTE_DS_SELECT = @json(route('crm.newsletters.campaigns.select'));
            var ROUTE_DS_TABLE = @json(route('crm.newsletters.campaigns.table'));
            var ROUTE_DS_CONTACTS = @json(route('crm.newsletters.campaigns.datasource.contacts'));
            var CSRF_TOKEN = '{{ csrf_token() }}';

            function getQueryParam(key) {
                var p = new URLSearchParams(window.location.search);
                return p.get(key) || '';
            }

            var state = {
                page: Number(getQueryParam('page')) || 1,
                per_page: Number(getQueryParam('per_page')) || 10,
                total: 0,
                rows: [],
                server: false,
                allClient: [],
                filters: {
                    newsletter: getQueryParam('newsletter') || ''
                }
            };

            function escapeHtml(s) {
                return String(s ?? '').replace(/[&<>\"']/g, function (m) {
                    return {'&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;'}[m]
                })
            }

            function initials(s) {
                s = String(s || '').trim();
                if (!s) return 'N';
                var parts = s.split(/\s+/).slice(0, 2);
                return parts.map(function (x) {
                    return x.charAt(0).toUpperCase()
                }).join('')
            }

            function rowTpl(x) {
                var nl = x.newsletter || '';
                var ds = (x.data_source || x.group_name || '');
                var grp = x.group_name || '';
                var sender = x.sender || '';
                var subject = x.subject || '';
                var last = x.last_sent || '';
                var total = Number(x.total || x.count || 0);
                var sent = Number(x.sent || 0);
                var remaining = Number(x.remaining || 0);

                var canSend = remaining > 0;
                var sendDisabledAttr = canSend ? '' : ' disabled';
                var sendLabel = canSend ? 'Send' : 'Sent';
                var sendExtraClass = canSend ? '' : ' disabled';

                var totalBtn = '<button type="button" class="page-link count-pill" data-kind="total" data-id="' + x.id + '">' + total + '</button>';
                var sentBtn = '<button type="button" class="page-link count-pill" data-kind="sent" data-id="' + x.id + '">' + sent + '</button>';
                var remBtn = '<button type="button" class="page-link count-pill" data-kind="remaining" data-id="' + x.id + '">' + remaining + '</button>';

                return '<tr>'
                    + '<td>' + escapeHtml(nl) + '</td>'
                    + '<td><div class="avatar" title="' + escapeHtml(nl) + '">' + escapeHtml(initials(nl)) + '</div></td>'
                    + '<td>' + escapeHtml(ds) + '</td>'
                    + '<td>' + escapeHtml(grp) + '</td>'
                    + '<td>' + escapeHtml(sender) + '</td>'
                    + '<td>' + escapeHtml(subject) + '</td>'
                    + '<td>' + escapeHtml(last) + '</td>'
                    + '<td class="text-center">' + totalBtn + '</td>'
                    + '<td class="text-center">' + sentBtn + '</td>'
                    + '<td class="text-center">' + remBtn + '</td>'
                    + '<td class="text-end">'
                    + '<button class="btn btn-sm btn-success me-1 btn-newsletter' + sendExtraClass + '" data-id="' + x.id + '" data-act="send"' + sendDisabledAttr + '>'
                    + '<i class="bi bi-send-check me-1"></i>' + sendLabel + '</button>'
                    + '<button class="btn btn-sm btn-outline-danger" data-id="' + x.id + '" data-act="delete">Delete</button>'
                    + '</td>'
                    + '</tr>';
            }

            function toggleLoading(on) {
                var lr = $('#loadingRow');
                if (lr.length) lr.toggle(on)
            }

            function currentFilters() {
                var chosen = (pick.val() || '').trim();
                if (chosen) return {newsletter_id: chosen};
                if ((state.filters.newsletter || '').trim()) return {newsletter_id: state.filters.newsletter};
                return {newsletter_id: ''};
            }

            function loadCampaigns() {
                toggleLoading(true);
                state.filters = Object.assign({}, state.filters, currentFilters());
                var qs = {};
                if (state.filters.newsletter_id) qs.newsletter_id = state.filters.newsletter_id;
                qs.page = state.page;
                qs.per_page = state.per_page;

                $.ajax({url: ROUTE_LIST, data: qs, headers: {Accept: 'application/json'}, dataType: 'json'})
                    .done(function (data) {
                        if ($.isArray(data)) {
                            state.server = false;
                            state.allClient = data;
                            applyClientFilter()
                        } else {
                            state.server = true;
                            state.rows = $.isArray(data.data) ? data.data : [];
                            state.total = Number(data.total || 0);
                            state.page = Number(data.page || state.page);
                            state.per_page = Number(data.per_page || state.per_page)
                        }
                        render()
                    })
                    .fail(function () {
                        tbody.html('<tr><td colspan="11" class="empty">Failed to load campaigns. Please retry.</td></tr>');
                        emptyBox.hide();
                        metaTotal.text('0 total');
                        metaRange.text('0–0 of 0');
                        rangeBox.text('0–0 of 0');
                        Swal.fire({icon: 'error', title: 'Load failed', text: 'Could not load campaigns.'})
                    })
                    .always(function () {
                        toggleLoading(false);
                        syncQueryString()
                    })
            }

            function applyClientFilter() {
                var rows = state.allClient.slice();
                var nid = (state.filters.newsletter_id || '').toString();
                if (nid) rows = rows.filter(function (r) {
                    return String(r.newsletter_id || '') === nid;
                });
                state.total = rows.length;
                var start = (state.page - 1) * state.per_page;
                state.rows = rows.slice(start, start + state.per_page);
            }

            function render() {
                var nlLabel = (pick.val() ? (pick.find('option:selected').text() || 'Selected') : (state.filters.newsletter ? ('ID ' + state.filters.newsletter) : 'Any'));
                metaNewsletter.text('Newsletter: ' + nlLabel);

                if (!state.rows.length) {
                    tbody.html('');
                    emptyBox.show()
                } else {
                    emptyBox.hide();
                    tbody.html(state.rows.map(rowTpl).join(''))
                }

                var start = state.total ? ((state.page - 1) * state.per_page + 1) : 0;
                var end = Math.min(state.page * state.per_page, state.total);
                metaTotal.text(state.total + ' total');
                metaRange.text(start + '–' + end + ' of ' + state.total);
                rangeBox.text(start + '–' + end + ' of ' + state.total);

                renderPager();
                bindRowActions();
            }

            function renderPager() {
                var totalPages = Math.max(1, Math.ceil(state.total / state.per_page));
                if (state.page > totalPages) state.page = totalPages;
                pagesBox.empty();
                var windowSize = 5;
                var from = Math.max(1, state.page - 2);
                var to = Math.min(totalPages, from + windowSize - 1);
                from = Math.max(1, to - windowSize + 1);
                for (var i = from; i <= to; i++) {
                    var b = $('<button type="button" class="page-link' + (i === state.page ? ' active' : '') + '"/>').text(i);
                    (function (n) {
                        b.on('click', function () {
                            state.page = n;
                            state.server ? loadCampaigns() : (applyClientFilter(), render())
                        })
                    })(i);
                    pagesBox.append(b)
                }
                firstBtn.prop('disabled', state.page <= 1);
                prevBtn.prop('disabled', state.page <= 1);
                nextBtn.prop('disabled', state.page >= totalPages);
                lastBtn.prop('disabled', state.page >= totalPages);
            }

            function statusPillHtml(status) {
                var s = String(status || '').toLowerCase();
                var label = s ? s.toUpperCase() : '';
                var cls = 'status-pill';
                if (s === 'sent') cls += ' sent';
                else if (s === 'failed') cls += ' failed';
                else if (s === 'pending' || s === 'queued' || s === 'retry') cls += ' pending';
                else if (s === 'remaining') cls += ' remaining';
                return '<span class="' + cls + '">' + escapeHtml(label) + '</span>';
            }

            function openRecipientsModal(campaignId, kind) {
                var status = '';
                var title = 'Recipients';

                if (kind === 'sent') {
                    status = 'sent';
                    title = 'Sent recipients';
                } else if (kind === 'remaining') {
                    status = 'remaining';
                    title = 'Remaining recipients';
                } else if (kind === 'pending') {
                    status = 'pending';
                    title = 'Pending recipients';
                } else if (kind === 'failed') {
                    status = 'failed';
                    title = 'Failed recipients';
                } else {
                    status = '';
                    title = 'All recipients';
                }

                Swal.fire({
                    title: title,
                    html:
                        '<div id="rc_wrap" style="max-height:60vh;overflow:auto;">' +
                        '<table class="ds-table">' +
                        '<thead><tr>' +
                        '<th>Name</th><th>Email</th><th>Status</th><th>Updated</th>' +
                        '</tr></thead>' +
                        '<tbody id="rc_tbody">' +
                        '<tr><td colspan="4" style="text-align:center;padding:12px;">Loading…</td></tr>' +
                        '</tbody></table></div>' +
                        '<div id="rc_pager" style="display:flex;justify-content:space-between;align-items:center;margin-top:8px;">' +
                        '<small id="rc_range"></small>' +
                        '<div>' +
                        '<button id="rc_prev" class="addr-add-btn" style="margin-right:4px;">Prev</button>' +
                        '<button id="rc_next" class="addr-add-btn">Next</button>' +
                        '</div>' +
                        '</div>',
                    width: 900,
                    showConfirmButton: true,
                    confirmButtonText: 'Close',
                    didOpen: function () {
                        var page = 1;
                        var perPage = 50;

                        function renderRows(res) {
                            var rows  = $.isArray(res.data) ? res.data : [];
                            var total = Number(res.total || rows.length || 0);
                            var cur   = Number(res.page || page);
                            var pp    = Number(res.per_page || perPage);
                            var last  = pp > 0 ? Math.max(1, Math.ceil(total / pp)) : 1;

                            if (!rows.length) {
                                $('#rc_tbody').html('<tr><td colspan="4" style="text-align:center;padding:12px;">No recipients found</td></tr>');
                            } else {
                                var html = rows.map(function (r) {
                                    return '<tr>' +
                                        '<td>' + escapeHtml(r.name || '') + '</td>' +
                                        '<td>' + escapeHtml(r.email || '') + '</td>' +
                                        '<td>' + statusPillHtml(r.status || '') + '</td>' +
                                        '<td>' + escapeHtml(r.updated_at || '') + '</td>' +
                                        '</tr>';
                                }).join('');
                                $('#rc_tbody').html(html);
                            }

                            var start = total ? ((cur - 1) * pp + 1) : 0;
                            var end   = Math.min(cur * pp, total);
                            $('#rc_range').text(start + '–' + end + ' of ' + total);

                            $('#rc_prev').prop('disabled', cur <= 1);
                            $('#rc_next').prop('disabled', cur >= last);

                            page = cur;
                            perPage = pp;
                        }

                        function load(pageToLoad) {
                            $.getJSON(
                                '/crm/newsletter-campaigns/' + campaignId + '/recipients',
                                {status: status, page: pageToLoad, per_page: perPage},
                                function (res) {
                                    renderRows(res);
                                }
                            ).fail(function () {
                                $('#rc_tbody').html('<tr><td colspan="4" style="text-align:center;padding:12px;">Failed to load recipients</td></tr>');
                                $('#rc_range').text('');
                                $('#rc_prev, #rc_next').prop('disabled', true);
                            });
                        }

                        $('#rc_prev').on('click', function () {
                            if (page > 1) {
                                load(page - 1);
                            }
                        });

                        $('#rc_next').on('click', function () {
                            load(page + 1);
                        });

                        load(1);
                    }
                });
            }

            function bindRowActions() {
                tbody.find('button[data-act="send"]').each(function () {
                    var btn = $(this);
                    btn.off('click').on('click', function () {
                        if (btn.is(':disabled')) return;
                        var id = btn.data('id');
                        Swal.fire({
                            title: 'Send this campaign?',
                            icon: 'question',
                            showCancelButton: true,
                            confirmButtonText: 'Send',
                            cancelButtonText: 'Cancel'
                        }).then(function (res) {
                            if (!res.isConfirmed) return;
                            $.ajax({
                                url: '/crm/newsletter-campaigns/' + id + '/send',
                                method: 'POST',
                                headers: {'X-CSRF-TOKEN': CSRF_TOKEN, Accept: 'application/json'}
                            }).done(function (res) {
                                var ok = !!res.ok;
                                var status = res.status || '';
                                var msg = res.message || '';

                                var icon = 'success';
                                var title = 'Queued';

                                if (!ok) {
                                    if (status === 'already_sent' || status === 'already_completed') {
                                        icon = 'info';
                                        title = 'Already sent';
                                        if (!msg) msg = 'This campaign has already been sent or completed.';
                                    } else {
                                        icon = 'error';
                                        title = 'Send failed';
                                        if (!msg) msg = 'Could not queue campaign.';
                                    }
                                } else {
                                    if (!msg) msg = 'Campaign send has been queued. Delivery will happen via the queue.';
                                }

                                Swal.fire({icon: icon, title: title, text: msg});
                                loadCampaigns();
                            }).fail(function (xhr) {
                                var msg = 'Could not queue campaign.';
                                if (xhr && xhr.responseJSON && xhr.responseJSON.message) {
                                    msg = xhr.responseJSON.message;
                                }
                                Swal.fire({icon: 'error', title: 'Send failed', text: msg});
                            });
                        });
                    });
                });
                tbody.find('button[data-act="delete"]').each(function () {
                    var btn = $(this);
                    btn.off('click').on('click', function () {
                        var id = btn.data('id');
                        Swal.fire({
                            title: 'Delete this campaign?',
                            text: 'This action cannot be undone.',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Delete',
                            cancelButtonText: 'Cancel'
                        }).then(function (res) {
                            if (!res.isConfirmed) return;
                            $.ajax({
                                url: '/crm/newsletter-campaigns/' + id,
                                method: 'DELETE',
                                headers: {'X-CSRF-TOKEN': CSRF_TOKEN, Accept: 'application/json'}
                            }).done(function () {
                                Swal.fire({icon: 'success', title: 'Deleted', timer: 1200, showConfirmButton: false});
                                state.server ? loadCampaigns() : (state.allClient = state.allClient.filter(function (x) {
                                    return String(x.id) !== String(id)
                                }), applyClientFilter(), render());
                            }).fail(function () {
                                Swal.fire({icon: 'error', title: 'Delete failed', text: 'Could not delete campaign.'});
                            });
                        });
                    });
                });
                tbody.find('.count-pill').each(function () {
                    var btn = $(this);
                    btn.off('click').on('click', function () {
                        var id = btn.data('id');
                        var kind = btn.data('kind');
                        openRecipientsModal(id, kind);
                    });
                });
            }


            function syncQueryString() {
                var p = new URLSearchParams();
                if (state.filters.newsletter_id) p.set('newsletter', state.filters.newsletter_id);
                p.set('page', String(state.page));
                p.set('per_page', String(state.per_page));
                var qs = p.toString();
                var url = location.pathname + (qs ? ('?' + qs) : '');
                history.replaceState(null, '', url);
            }

            function restoreFromQuery() {
                var p = new URLSearchParams(location.search);
                var page = parseInt(p.get('page') || '1', 10);
                var per = parseInt(p.get('per_page') || '10', 10);
                state.page = page > 0 ? page : 1;
                state.per_page = per > 0 ? per : 10;
                perPageSel.val(String(state.per_page));
            }

            function loadDict() {
                $.ajax({
                    url: ROUTE_DICT,
                    headers: {Accept: 'application/json'},
                    dataType: 'json'
                }).done(function (rows) {
                    if ($.isArray(rows) && rows.length) {
                        dictBox.html(rows.map(function (x) {
                            return '<span class="badge-soft me-2 mb-2">' + escapeHtml(x.key) + ': ' + Number(x.count || 0) + '</span>'
                        }).join(''))
                    } else {
                        dictBox.html('<span class="text-muted">No dictionary data</span>')
                    }
                }).fail(function () {
                    dictBox.html('<span class="text-muted">Failed to load dictionary</span>');
                    Swal.fire({icon: 'error', title: 'Load failed', text: 'Could not load dictionary.'})
                });
            }

            function loadNewsletters() {
                $.ajax({
                    url: ROUTE_NEWSLETTERS,
                    headers: {Accept: 'application/json'},
                    dataType: 'json'
                }).done(function (rows) {
                    if ($.isArray(rows) && rows.length > 0) {
                        pick.html('<option value="">Select Newsletter</option>' + rows.map(function (r) {
                            return '<option value="' + r.id + '">' + escapeHtml(r.title) + '</option>'
                        }).join(''));
                        if ((state.filters.newsletter || '').trim()) {
                            pick.val(state.filters.newsletter);
                        }
                    } else {
                        pick.html('<option value="">No newsletters available</option>')
                    }
                }).fail(function () {
                    pick.html('<option value="">Failed to load</option>');
                    Swal.fire({icon: 'error', title: 'Load failed', text: 'Could not load newsletters.'})
                });
            }

            function loadDataSources() {
                dsSel.html('<option value="">Select Data Source</option>');
                $.ajax({
                    url: ROUTE_DS_SELECT,
                    headers: {Accept: 'application/json'},
                    dataType: 'json',
                    data: {q: ''}
                }).done(function (rows) {
                    var opts = $.isArray(rows) ? rows : [];
                    dsSel.append(opts.map(function (r) {
                        return '<option value="' + escapeHtml(r.text) + '">' + escapeHtml(r.text) + '</option>'
                    }).join(''));
                }).fail(function () {
                    Swal.fire({icon: 'error', title: 'Load failed', text: 'Could not load data sources.'})
                });
            }

            function isSelectableSource(ds) {
                var s = String(ds || '');
                return ['LearnerDelegates', 'Customers', 'Trainers', 'Resellers', 'Admins'].indexOf(s) !== -1;
            }

            function buildCampaignRequest(nid, grp, ds, emails) {
                $.ajax({
                    url: ROUTE_BUILD,
                    method: 'POST',
                    contentType: 'application/json; charset=utf-8',
                    data: JSON.stringify({
                        newsletter_id: nid,
                        group_name: grp,
                        data_source: ds,
                        recipient_emails: emails || []
                    }),
                    headers: {'X-CSRF-TOKEN': CSRF_TOKEN, Accept: 'application/json'}
                })
                    .done(function () {
                        Swal.fire({icon: 'success', title: 'Campaign built', timer: 1300, showConfirmButton: false});
                        groupTxt.val('');
                        state.page = 1;
                        loadCampaigns()
                    })
                    .fail(function (xhr) {
                        var msg = 'Could not build campaign.';
                        if (xhr && xhr.responseJSON && xhr.responseJSON.message) msg = xhr.responseJSON.message;
                        Swal.fire({icon: 'error', title: 'Build failed', text: msg})
                    });
            }

            function openSourceRecipientPicker(nid, grp, ds) {
                var selected = {};
                var page = 1;
                var per = 25;
                var q = '';

                Swal.fire({
                    title: 'Select recipients',
                    html:
                        '<div class="ds-head">' +
                        '<input id="rp_search" class="ds-search" placeholder="Search by name or email">' +
                        '</div>' +
                        '<div style="overflow:auto;max-height:60vh">' +
                        '<table class="ds-table">' +
                        '<thead><tr><th style="width:40px"><input type="checkbox" id="rp_check_all"></th><th>Name</th><th>Email</th></tr></thead>' +
                        '<tbody id="rp_tbody"><tr><td colspan="3" style="text-align:center;padding:12px;">Loading…</td></tr></tbody>' +
                        '</table>' +
                        '</div>' +
                        '<div id="rp_pager" style="display:flex;justify-content:space-between;align-items:center;margin-top:8px;">' +
                        '<small id="rp_range"></small>' +
                        '<div>' +
                        '<button id="rp_prev" class="addr-add-btn" style="margin-right:4px;">Prev</button>' +
                        '<button id="rp_next" class="addr-add-btn">Next</button>' +
                        '</div>' +
                        '</div>' +
                        '<div style="margin-top:10px;display:flex;justify-content:flex-end;gap:8px;">' +
                        '<button id="rp_build" class="btn btn-sm btn-primary btn-newsletter">Build with selected</button>' +
                        '</div>',
                    width: 800,
                    showConfirmButton: false,
                    didOpen: function () {
                        var tbodyEl = $('#rp_tbody');
                        var rangeEl = $('#rp_range');
                        var prevEl = $('#rp_prev');
                        var nextEl = $('#rp_next');
                        var searchEl = $('#rp_search');
                        var checkAllEl = $('#rp_check_all');

                        function renderRows(res) {
                            var rows = $.isArray(res.data) ? res.data : [];
                            var total = Number(res.total || rows.length || 0);
                            var cur = Number(res.page || page);
                            var pp = Number(res.per_page || per);
                            var last = pp > 0 ? Math.max(1, Math.ceil(total / pp)) : 1;

                            if (!rows.length) {
                                tbodyEl.html('<tr><td colspan="3" style="text-align:center;padding:12px;">No recipients found</td></tr>');
                            } else {
                                var html = rows.map(function (r) {
                                    var email = String(r.email || '');
                                    var checked = selected[email] ? ' checked' : '';
                                    return '<tr>' +
                                        '<td><input type="checkbox" class="rp-check" data-email="' + escapeHtml(email) + '"' + checked + '></td>' +
                                        '<td>' + escapeHtml(r.name || '') + '</td>' +
                                        '<td>' + escapeHtml(email) + '</td>' +
                                        '</tr>';
                                }).join('');
                                tbodyEl.html(html);
                            }

                            var start = total ? ((cur - 1) * pp + 1) : 0;
                            var end = Math.min(cur * pp, total);
                            rangeEl.text(start + '–' + end + ' of ' + total);

                            prevEl.prop('disabled', cur <= 1);
                            nextEl.prop('disabled', cur >= last);

                            page = cur;
                            per = pp;

                            updateCheckAll();
                        }

                        function updateCheckAll() {
                            var checks = tbodyEl.find('.rp-check');
                            if (!checks.length) {
                                checkAllEl.prop('checked', false).prop('indeterminate', false);
                                return;
                            }
                            var total = checks.length;
                            var checkedCount = 0;
                            checks.each(function () {
                                if ($(this).is(':checked')) checkedCount++;
                            });
                            if (checkedCount === 0) {
                                checkAllEl.prop('checked', false).prop('indeterminate', false);
                            } else if (checkedCount === total) {
                                checkAllEl.prop('checked', true).prop('indeterminate', false);
                            } else {
                                checkAllEl.prop('checked', false).prop('indeterminate', true);
                            }
                        }

                        function load(pageToLoad) {
                            $.getJSON(
                                ROUTE_DS_CONTACTS,
                                {source: ds, page: pageToLoad, per_page: per, q: q},
                                function (res) {
                                    renderRows(res);
                                }
                            ).fail(function () {
                                tbodyEl.html('<tr><td colspan="3" style="text-align:center;padding:12px;">Failed to load recipients</td></tr>');
                                rangeEl.text('');
                                prevEl.prop('disabled', true);
                                nextEl.prop('disabled', true);
                            });
                        }

                        prevEl.on('click', function () {
                            if (page > 1) load(page - 1);
                        });
                        nextEl.on('click', function () {
                            load(page + 1);
                        });
                        searchEl.on('input', function () {
                            q = this.value || '';
                            page = 1;
                            load(page);
                        });

                        checkAllEl.on('change', function () {
                            var checked = $(this).is(':checked');
                            tbodyEl.find('.rp-check').each(function () {
                                var em = $(this).data('email') || '';
                                $(this).prop('checked', checked);
                                if (em) {
                                    if (checked) selected[em] = true;
                                    else delete selected[em];
                                }
                            });
                        });

                        tbodyEl.on('change', '.rp-check', function () {
                            var em = $(this).data('email') || '';
                            if (!em) return;
                            if ($(this).is(':checked')) selected[em] = true;
                            else delete selected[em];
                            updateCheckAll();
                        });

                        tbodyEl.on('click', 'tr', function (e) {
                            if ($(e.target).is('input')) return;
                            var cb = $(this).find('.rp-check');
                            if (!cb.length) return;

                            var checked = cb.is(':checked');
                            cb.prop('checked', !checked).trigger('change');
                        });

                        $('#rp_build').on('click', function () {
                            var emails = Object.keys(selected);
                            if (!emails.length) {
                                Swal.fire({icon: 'warning', title: 'No recipients selected', text: 'Please select at least one recipient.'});
                                return;
                            }
                            Swal.close();
                            buildCampaignRequest(nid, grp, ds, emails);
                        });

                        load(1);
                    }
                });
            }

            btnBuild.on('click', function () {
                var nid = (pick.val() || state.filters.newsletter || '').trim();
                var grp = (groupTxt.val() || '').trim();
                var ds = (dsSel.val() || '').trim();

                if (!nid) {
                    Swal.fire({icon: 'warning', title: 'Select newsletter', text: 'Please choose a newsletter first.'});
                    return;
                }
                if (!ds) {
                    Swal.fire({icon: 'warning', title: 'Select data source', text: 'Please choose a data source.'});
                    return;
                }
                if (!grp) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Enter group name',
                        text: 'Please provide a group name for this campaign.'
                    });
                    return;
                }

                if (isSelectableSource(ds)) {
                    Swal.fire({
                        title: 'Which recipients?',
                        text: 'From ' + ds + ', include all or select specific recipients?',
                        icon: 'question',
                        showCancelButton: true,
                        showDenyButton: true,
                        confirmButtonText: 'All from ' + ds,
                        denyButtonText: 'Select specific',
                        cancelButtonText: 'Cancel'
                    }).then(function (res) {
                        if (res.isConfirmed) {
                            buildCampaignRequest(nid, grp, ds, []);
                        } else if (res.isDenied) {
                            openSourceRecipientPicker(nid, grp, ds);
                        }
                    });
                } else {
                    buildCampaignRequest(nid, grp, ds, []);
                }
            });

            btnRefresh.on('click', function () {
                loadDict();
                loadCampaigns();
            });

            btnHelp.on('click', function () {
                Swal.fire({
                    title: 'Data Source Database',
                    html: '<div class="ds-head"><input id="ds_search" class="ds-search" placeholder="Search"><div class="ds-letters" id="ds_letters"></div></div><div style="overflow:auto;max-height:60vh"><table class="ds-table"><thead><tr><th>Datasource Name</th><th>Number of Records</th><th>Valid Addresses</th></tr></thead><tbody id="ds_tbody"></tbody></table></div><div id="ds_pager" style="display:flex;justify-content:flex-end;gap:8px;margin-top:8px"><button id="ds_prev" class="addr-add-btn">Prev</button><span id="ds_page" style="align-self:center"></span><button id="ds_next" class="addr-add-btn">Next</button></div>',
                    width: 980,
                    customClass: {popup: 'ds-modal'},
                    showConfirmButton: true,
                    confirmButtonText: 'Close',
                    didOpen: function () {
                        var page = 1, per = 10, q = '', letter = '';

                        function load() {
                            $.getJSON(ROUTE_DS_TABLE, {
                                page: page,
                                per_page: per,
                                q: q,
                                starts_with: letter
                            }, function (r) {
                                var rows = r.data || [];
                                $('#ds_tbody').html(rows.map(function (x) {
                                    return '<tr><td><button type="button" class="addr-add-btn ds-pick" data-val="' + escapeHtml(x.name) + '">' + escapeHtml(x.name) + '</button></td><td>' + x.total + '</td><td>' + x.valid + '</td></tr>'
                                }).join(''));
                                $('#ds_page').text('Page ' + r.page + ' of ' + Math.max(1, Math.ceil((r.total || 0) / per)));
                                $('#ds_prev').prop('disabled', page <= 1);
                                $('#ds_next').prop('disabled', page >= Math.max(1, Math.ceil((r.total || 0) / per)));
                            }).fail(function () {
                                Swal.fire({icon: 'error', title: 'Load failed', text: 'Could not load data sources.'})
                            });
                        }

                        $('#ds_prev').on('click', function () {
                            page = Math.max(1, page - 1);
                            load()
                        });
                        $('#ds_next').on('click', function () {
                            page = page + 1;
                            load()
                        });
                        $('#ds_search').on('input', function () {
                            q = this.value || '';
                            page = 1;
                            load()
                        });
                        var letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'.split('');
                        var btns = ['ALL'].concat(letters).concat(['Other', '123']);
                        $('#ds_letters').html(btns.map(function (b) {
                            return '<button data-k="' + b + '">' + b + '</button>'
                        }).join(' '));
                        $('#ds_letters').on('click', 'button', function () {
                            var k = $(this).data('k');
                            if (k === 'ALL') {
                                letter = '';
                                page = 1;
                                load();
                                return;
                            }
                            if (k === 'Other') {
                                letter = 'other';
                                page = 1;
                                load();
                                return;
                            }
                            if (k === '123') {
                                letter = 'num';
                                page = 1;
                                load();
                                return;
                            }
                            letter = k;
                            page = 1;
                            load()
                        });
                        $(document).on('click', '.ds-pick', function () {
                            var v = $(this).data('val') || '';
                            if (v) {
                                dsSel.val(v)
                            }
                        });
                        load();
                    }
                });
            });

            pick.on('change', function () {
                state.page = 1;
                loadCampaigns()
            });
            perPageSel.on('change', function () {
                state.per_page = parseInt($(this).val(), 10) || 10;
                state.page = 1;
                state.server ? loadCampaigns() : (applyClientFilter(), render())
            });
            firstBtn.on('click', function () {
                state.page = 1;
                state.server ? loadCampaigns() : (applyClientFilter(), render())
            });
            prevBtn.on('click', function () {
                state.page = Math.max(1, state.page - 1);
                state.server ? loadCampaigns() : (applyClientFilter(), render())
            });
            nextBtn.on('click', function () {
                var totalPages = Math.max(1, Math.ceil(state.total / state.per_page));
                state.page = Math.min(totalPages, state.page + 1);
                state.server ? loadCampaigns() : (applyClientFilter(), render())
            });
            lastBtn.on('click', function () {
                state.page = Math.max(1, Math.ceil(state.total / state.per_page));
                state.server ? loadCampaigns() : (applyClientFilter(), render())
            });

            function loadData() {
                restoreFromQuery();
                loadNewsletters();
                loadDataSources();
                loadDict();
                loadCampaigns();
            }

            $(loadData);
        })(jQuery);
    </script>
@endpush
