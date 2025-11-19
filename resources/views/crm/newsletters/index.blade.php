@extends('crm.layout.main')

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

        .badge-soft {
            background: #eff6ff;
            color: #2563eb;
            font-weight: 600;
            border-radius: 999px;
            padding: 3px 8px;
            font-size: 12px
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

        .btn-pill {
            border-radius: 999px;
            padding: .45rem .85rem;
            font-weight: 600
        }

        .btn-top {
            border-radius: 999px;
            border: 1px solid #d1d5db;
            background: #ffffff;
            color: #111827;
            font-size: 12px;
            line-height: 1.2;
            padding: .35rem .75rem;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-weight: 500;
            cursor: pointer;
            transition: background .12s ease, border-color .12s ease, box-shadow .12s ease, transform .08s ease, color .12s ease
        }

        .btn-top:hover {
            background: #f3f4f6;
            border-color: #cbd5e1;
            box-shadow: 0 6px 14px rgba(15, 23, 42, .10);
            transform: translateY(-1px)
        }

        .form-control {
            border-radius: 999px;
            border: 1px solid #d1d5db;
            font-size: 14px;
            line-height: 1.4;
            color: #111827;
            height: 38px;
            padding: 6px 14px;
            background: #f9fafb;
            transition: border-color .15s ease, box-shadow .15s ease, background .15s ease, transform .08s ease
        }

        .form-control:focus {
            border-color: #2563eb;
            background: #ffffff;
            box-shadow: 0 0 0 1px #2563eb, 0 0 0 4px rgba(37, 99, 235, .15);
            outline: none;
            transform: translateY(-1px)
        }

        .select-pp {
            border: 1px solid #d1d5db;
            border-radius: 999px;
            height: 34px;
            padding: 0 12px;
            background: #fff;
            font-size: 12px
        }

        .search-box {
            position: relative
        }

        .search-box i {
            position: absolute;
            left: 10px;
            top: 9px;
            color: #9ca3af
        }

        .search-input {
            padding-left: 34px;
            height: 38px;
            width: 260px
        }

        .newsletter-shell, .newsletter-table-shell {
            border-radius: 20px;
            border: 1px solid var(--border);
            background: #ffffff;
            box-shadow: 0 18px 38px rgba(15, 23, 42, .10);
            position: relative;
            overflow: hidden
        }

        .newsletter-shell {
            padding: 18px 22px 20px;
            margin-bottom: 16px
        }

        .newsletter-shell-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 4px
        }

        .newsletter-shell-title {
            display: flex;
            align-items: flex-start;
            gap: 10px
        }

        .newsletter-shell-icon {
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

        .newsletter-shell-icon i {
            font-size: 18px
        }

        .newsletter-shell-text-title {
            font-size: 15px;
            font-weight: 700;
            letter-spacing: .02em;
            color: var(--ink);
            display: flex;
            align-items: center;
            gap: 6px
        }

        .newsletter-shell-text-sub {
            font-size: 12px;
            color: var(--muted);
            margin-top: 2px
        }

        .newsletter-shell-meta {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 11px;
            color: var(--muted);
            flex-wrap: wrap
        }

        .newsletter-shell-meta-pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: .25rem .65rem;
            border-radius: 999px;
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            font-weight: 500
        }

        .newsletter-shell-meta-pill i {
            font-size: 14px;
            color: var(--accent)
        }

        .newsletter-shell-actions {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap
        }

        .newsletter-table-shell .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            padding: 10px 16px;
            border-bottom: 1px solid #e5e7eb;
            background: #f9fafb
        }

        .newsletter-table-shell .header-left .title {
            font-size: 13px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .08em;
            color: var(--ink)
        }

        .newsletter-table-shell .header-left .sub {
            font-size: 11px;
            color: var(--muted);
            margin-top: 1px
        }

        .newsletter-table-shell .header-right {
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
            padding: 12px;
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

        .row-icon {
            width: 40px;
            text-align: center;
            color: #64748b
        }

        .table-actions {
            display: flex;
            gap: 6px;
            justify-content: flex-end
        }

        .table-actions .btn {
            border-radius: 9999px !important;
            padding: .45rem 1rem;
            font-weight: 600;
            transition: all .15s ease
        }

        .table-actions .btn-sm {
            font-size: 13px;
            line-height: 1.2
        }

        .table-actions .btn-light {
            background: #f8fafc;
            border-color: #e2e8f0
        }

        .table-actions .btn-light:hover {
            background: #2563eb;
            color: #fff;
            border-color: #2563eb
        }

        .table-actions .btn-outline-secondary:hover {
            background: #2563eb;
            color: #fff;
            border-color: #2563eb
        }

        .table-actions .btn-outline-danger {
            border-color: #ef4444;
            color: #ef4444;
            background: #fff
        }

        .table-actions .btn-outline-danger:hover {
            background: #ef4444;
            color: #fff
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
            font-weight: 600
        }

        .page-link.active {
            background: #2563eb;
            color: #fff;
            border-color: #2563eb
        }
    </style>
@endpush

@section('main')
    <div class="container-fluid page-inner">
        <div class="newsletter-shell">
            <div class="newsletter-shell-header">
                <div class="newsletter-shell-title">
                    <div class="newsletter-shell-icon"><i class="bi bi-envelope-fill"></i></div>
                    <div>
                        <div class="newsletter-shell-text-title">Newsletters</div>
                        <div class="newsletter-shell-text-sub">Create, manage and launch newsletter campaigns</div>
                    </div>
                </div>
                <div class="newsletter-shell-actions">
                    <div class="search-box">
                        <i class="bi bi-search"></i>
                        <input id="q" class="form-control search-input" placeholder="Search title or subject"
                               aria-label="Search newsletters">
                    </div>
                    <select id="perPage" class="select-pp">
                        <option value="10">10 / page</option>
                        <option value="20">20 / page</option>
                        <option value="50">50 / page</option>
                        <option value="100">100 / page</option>
                    </select>
                    <button id="btnRefresh" type="button" class="btn-top">
                        <i class="bi bi-arrow-clockwise"></i><span>Refresh</span>
                    </button>
                    <a href="{{ route('crm.newsletters.create') }}" class="btn btn-primary btn-sm btn-pill"><i
                            class="bi bi-plus-lg me-1"></i>Add New</a>
                    <a href="{{ route('crm.newsletters.campaigns.index') }}"
                       class="btn btn-outline-primary btn-sm btn-pill"><i
                            class="bi bi-send-check me-1"></i>Campaigns</a>
                </div>
            </div>
            <div class="newsletter-shell-meta">
                <div class="newsletter-shell-meta-pill"><i class="bi bi-diagram-3"></i><span
                        id="metaTotal">0 total</span></div>
                <div class="newsletter-shell-meta-pill"><i class="bi bi-funnel"></i><span
                        id="metaQuery">No filter</span></div>
            </div>
        </div>

        <div class="newsletter-table-shell">
            <div class="header">
                <div class="header-left">
                    <div class="title">Newsletter List</div>
                    <div class="sub">Overview of all drafts and ready-to-send newsletters</div>
                </div>
                <div class="header-right">
                    <span id="range" class="pill">0–0 of 0</span>
                </div>
            </div>
            <div>
                <table class="table-modern" id="tbl" aria-live="polite">
                    <thead>
                    <tr>
                        <th style="width:52px"></th>
                        <th>Newsletter</th>
                        <th>Subject</th>
                        <th style="width:260px">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr id="loadingRow">
                        <td colspan="5" class="empty">Loading…</td>
                    </tr>
                    </tbody>
                </table>
                <div id="empty" class="empty" style="display:none">No newsletters found</div>
                <div class="pager">
                    <div class="pager-left"></div>
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
            $(function () {
                const tbody = document.querySelector('#tbl tbody');
                const empty = document.getElementById('empty');
                const pagesBox = document.getElementById('pages');
                const rangeBox = document.getElementById('range');
                const metaTotal = document.getElementById('metaTotal');
                const metaQuery = document.getElementById('metaQuery');
                const q = document.getElementById('q');
                const perPageSel = document.getElementById('perPage');
                const firstBtn = document.getElementById('firstBtn');
                const prevBtn = document.getElementById('prevBtn');
                const nextBtn = document.getElementById('nextBtn');
                const lastBtn = document.getElementById('lastBtn');
                const btnRefresh = document.getElementById('btnRefresh');

                const ROUTE_LIST = @json(route('crm.newsletters.list'));
                const CSRF_TOKEN = '{{ csrf_token() }}';

                let state = {page: 1, per_page: 10, total: 0, rows: [], server: false, allClient: [], q: ''};

                function rowTpl(x) {
                    return `<tr>
                        <td class="row-icon"><i class="bi bi-envelope"></i></td>
                        <td>${escapeHtml(x.title ?? '')}</td>
                        <td>${escapeHtml(x.subject ?? '')}</td>
                        <td class="table-actions">
                          <a class="btn btn-light btn-sm" href="/crm/newsletters/${x.id}/composer"><i class="bi bi-pencil-square me-1"></i>Compose</a>
                          <a class="btn btn-outline-secondary btn-sm" href="{{ route('crm.newsletters.campaigns.index') }}?newsletter=${x.id}&page=1&per_page=10"><i class="bi bi-rocket-takeoff me-1"></i>Campaigns</a>
                          <button class="btn btn-outline-danger btn-sm" data-id="${x.id}" data-act="delete">Delete</button>
                        </td>
                        </tr>`;
                }

                function escapeHtml(s) {
                    return String(s ?? '').replace(/[&<>"']/g, m => ({
                        '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;'
                    }[m]));
                }

                async function load(showToast) {
                    toggleLoading(true);
                    try {
                        const url = `${ROUTE_LIST}?page=${state.page}&per_page=${state.per_page}&q=${encodeURIComponent(state.q)}`;
                        const resp = await fetch(url, {headers: {'Accept': 'application/json'}});
                        const res = await resp.json();
                        if (Array.isArray(res)) {
                            state.server = false;
                            state.allClient = res;
                            applyClientFilter();
                        } else {
                            state.server = true;
                            state.rows = res.data || [];
                            state.total = Number(res.total || 0);
                            state.page = Number(res.page || 1);
                            state.per_page = Number(res.per_page || state.per_page);
                        }
                        render();
                        if (showToast) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Refreshed',
                                timer: 900,
                                showConfirmButton: false
                            });
                        }
                    } catch {
                        tbody.innerHTML = `<tr><td colspan="5" class="empty">Failed to load. Please retry.</td></tr>`;
                        empty.style.display = 'none';
                        rangeBox.textContent = `0–0 of 0`;
                        metaTotal.textContent = `0 total`;
                        Swal.fire({
                            icon: 'error',
                            title: 'Load failed',
                            text: 'Could not load newsletters.'
                        });
                    } finally {
                        toggleLoading(false);
                    }
                }

                function toggleLoading(on) {
                    const lr = document.getElementById('loadingRow');
                    if (lr) lr.style.display = on ? '' : 'none';
                }

                function applyClientFilter() {
                    const qq = state.q.trim().toLowerCase();
                    let filtered = state.allClient;
                    if (qq.length) {
                        filtered = filtered.filter(x =>
                            String(x.title ?? '').toLowerCase().includes(qq) ||
                            String(x.subject ?? '').toLowerCase().includes(qq)
                        );
                    }
                    state.total = filtered.length;
                    const start = (state.page - 1) * state.per_page;
                    state.rows = filtered.slice(start, start + state.per_page);
                }

                function render() {
                    if (!state.rows.length) {
                        tbody.innerHTML = '';
                        empty.style.display = 'block';
                    } else {
                        empty.style.display = 'none';
                        tbody.innerHTML = state.rows.map(rowTpl).join('');
                    }
                    const start = state.total ? ((state.page - 1) * state.per_page + 1) : 0;
                    const end = Math.min(state.page * state.per_page, state.total);
                    rangeBox.textContent = `${start}–${end} of ${state.total}`;
                    metaTotal.textContent = `${state.total} total`;
                    metaQuery.textContent = state.q.trim().length ? `Filter: "${state.q.trim()}"` : 'No filter';
                    renderPager();
                    bindRowActions();
                    syncQueryString();
                }

                function renderPager() {
                    const totalPages = Math.max(1, Math.ceil(state.total / state.per_page));
                    state.page = Math.min(state.page, totalPages);
                    pagesBox.innerHTML = '';
                    const windowSize = 5;
                    let from = Math.max(1, state.page - 2);
                    let to = Math.min(totalPages, from + windowSize - 1);
                    from = Math.max(1, to - windowSize + 1);
                    for (let i = from; i <= to; i++) {
                        const a = document.createElement('button');
                        a.className = 'page-link' + (i === state.page ? ' active' : '');
                        a.textContent = i;
                        a.type = 'button';
                        a.onclick = () => {
                            state.page = i;
                            state.server ? load() : (applyClientFilter(), render());
                        };
                        pagesBox.appendChild(a);
                    }
                    firstBtn.disabled = state.page <= 1;
                    prevBtn.disabled = state.page <= 1;
                    nextBtn.disabled = state.page >= totalPages;
                    lastBtn.disabled = state.page >= totalPages;
                }

                function bindRowActions() {
                    tbody.querySelectorAll('button[data-act="delete"]').forEach(btn => {
                        btn.onclick = () => {
                            const id = btn.getAttribute('data-id');
                            Swal.fire({
                                title: 'Delete this newsletter?',
                                text: 'This action cannot be undone.',
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonText: 'Delete',
                                cancelButtonText: 'Cancel'
                            }).then(async result => {
                                if (!result.isConfirmed) return;
                                try {
                                    const ok = await fetch(`/crm/newsletters/${id}`, {
                                        method: 'DELETE',
                                        headers: {
                                            'X-CSRF-TOKEN': CSRF_TOKEN,
                                            'Accept': 'application/json'
                                        }
                                    });
                                    if (!ok.ok) throw new Error('Delete failed');
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Deleted',
                                        timer: 1100,
                                        showConfirmButton: false
                                    });
                                    if (state.server) load();
                                    else {
                                        state.allClient = state.allClient.filter(x => x.id !== Number(id));
                                        applyClientFilter();
                                        render();
                                    }
                                } catch {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Delete failed',
                                        text: 'Could not delete newsletter.'
                                    });
                                }
                            });
                        };
                    });
                }

                q.addEventListener('input', debounce(() => {
                    state.q = q.value;
                    state.page = 1;
                    state.server ? load() : (applyClientFilter(), render());
                }, 300));

                perPageSel.addEventListener('change', () => {
                    state.per_page = parseInt(perPageSel.value, 10) || 10;
                    state.page = 1;
                    state.server ? load() : (applyClientFilter(), render());
                });

                firstBtn.onclick = () => {
                    state.page = 1;
                    state.server ? load() : (applyClientFilter(), render());
                };

                prevBtn.onclick = () => {
                    state.page = Math.max(1, state.page - 1);
                    state.server ? load() : (applyClientFilter(), render());
                };

                nextBtn.onclick = () => {
                    const totalPages = Math.max(1, Math.ceil(state.total / state.per_page));
                    state.page = Math.min(totalPages, state.page + 1);
                    state.server ? load() : (applyClientFilter(), render());
                };

                lastBtn.onclick = () => {
                    state.page = Math.max(1, Math.ceil(state.total / state.per_page));
                    state.server ? load() : (applyClientFilter(), render());
                };

                btnRefresh.onclick = () => {
                    state.page = 1;
                    load(true);
                };

                function debounce(fn, ms) {
                    let t;
                    return function () {
                        clearTimeout(t);
                        const args = arguments;
                        t = setTimeout(() => fn.apply(null, args), ms);
                    };
                }

                function syncQueryString() {
                    const params = new URLSearchParams();
                    params.set('page', String(state.page));
                    params.set('per_page', String(state.per_page));
                    if ((state.q || '').trim().length) params.set('q', state.q);
                    const qs = params.toString();
                    const url = location.pathname + (qs ? '?' + qs : '');
                    history.replaceState(null, '', url);
                }

                (function init() {
                    const p = new URLSearchParams(location.search);
                    const page = parseInt(p.get('page') || '1', 10);
                    const per = parseInt(p.get('per_page') || '10', 10);
                    const query = p.get('q') || '';
                    state.page = page > 0 ? page : 1;
                    state.per_page = per > 0 ? per : 10;
                    state.q = query;
                    perPageSel.value = String(state.per_page);
                    q.value = state.q;
                    load();
                })();
            });
        })(jQuery);
    </script>
@endpush
