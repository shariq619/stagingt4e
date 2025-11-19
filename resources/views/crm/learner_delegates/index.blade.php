{{-- resources/views/crm/learner_delegates/index.blade.php --}}
@extends('crm.layout.main')
@section('title', 'CRM - Learner Delegates')

@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css">
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
    </style>

@endpush

@section('main')
    <div class="">
        <div class="page-inner py-3">
            <form id="filters" class="ribbon mb-3">
                <div class="group">
                    <input class="search" type="text" name="q" id="q"
                           placeholder="Search by name, email or phone">
                </div>

                <div class="mini">
                    @php $alpha = range('A','Z'); @endphp
                    @foreach($alpha as $ch)
                        <button type="button" data-letter="{{ $ch }}" class="pill az">{{ $ch }}</button>
                    @endforeach
                    <button type="button" id="reset" class="pill">Reset</button>
                </div>

                <button class="pill btn-blue" type="submit">Apply</button>
                <input type="hidden" name="starts" id="starts" value="">
            </form>

            <div class="card card-modern">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Learner Delegates</h4>
                    <span class="badge-soft" id="totalBadge">{{ number_format($total ?? 0) }} total</span>
                </div>

                <div class="card-body">
                    <div class="table-wrap">
                        <table class="table-modern" id="dtLearners">
                            <thead>
                            <tr>
                                <th style="width:70px;">#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th style="width:140px;">Phone</th>
                                <th>Address</th>
                                <th style="width:140px;">Date</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>

            <div id="finder" class="finder hidden">
                <div class="finder-head">
                    <div class="finder-title">Delegate Database</div>
                    <button type="button" id="finderClose" class="finder-close">×</button>
                </div>
                <div class="finder-grid" id="finderList"></div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>
    <script>
        var table, finderOpen = false, finderIndex = -1;

        function params() {
            return {q: $('#q').val(), starts: $('#starts').val()}
        }

        function openFinder() {
            if (finderOpen) return;
            $('#finder').removeClass('hidden');
            finderOpen = true;
            finderIndex = -1
        }

        function closeFinder() {
            $('#finder').addClass('hidden');
            finderOpen = false;
            finderIndex = -1
        }

        function renderFinder(items) {
            const $l = $('#finderList').empty();
            items.forEach((it, i) => {
                $l.append(`<div class="finder-row" data-idx="${i}" data-id="${it.id}" data-url="${it.show}">
                    <div class="finder-col-date"><span>${it.date || ''}</span></div>
                    <div class="dots"><span>${it.name || ''}</span></div>
                    <div class="dots"><span>${it.email || ''}</span></div>
                    <div class="finder-col-code"><span>${it.code || ''}</span></div>
                    </div>`
                );
            });
        }

        function fetchFinder() {
            $.get("{{ route('crm.learner.delegates.quick') }}", {
                q: $('#q').val(),
                starts: $('#starts').val()
            }).done(res => {
                renderFinder(res.items || [])
            }).fail(() => {
                renderFinder([])
            })
        }

        function highlightFinder(idx) {
            const $r = $('#finderList .finder-row');
            $r.removeClass('finder-active');
            if (idx >= 0 && idx < $r.length) {
                $($r[idx]).addClass('finder-active')[0].scrollIntoView({block: 'nearest'})
            }
        }

        $(function () {
            table = $('#dtLearners').DataTable({
                lengthChange: true,
                pageLength: 25,
                serverSide: true,
                processing: true,
                scrollX: true,
                autoWidth: false,
                searching: false,
                ajax: {
                    url: "{{ route('crm.learner.delegates.dt') }}",
                    data: function (d) {
                        $.extend(d, params())
                    }
                },
                columns: [
                    {data: 'id', name: 'id', width: '80px'},
                    {
                        data: 'full_name',
                        name: 'users.name',
                        render: function (data, type, row) {
                            return `<a href="/crm/learner-delegates/${row.id}/detail" class="text-decoration-underline">${data}</a>`;
                        }
                    },
                    {data: 'email', name: 'users.email'},
                    {data: 'phone_number', name: 'users.phone_number'},
                    {data: 'address', name: 'users.address', className: 'td-trunc'},
                    {data: 'date', name: 'date', width: '160px'}
                ],
                order: [[5, 'desc']],
                drawCallback: function (s) {
                    if (s.json && typeof s.json.total !== 'undefined') {
                        $('#totalBadge').text(new Intl.NumberFormat().format(s.json.total) + ' total')
                    }
                    this.api().columns.adjust();
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
                table.page(0).ajax.reload();
                openFinder();
                fetchFinder()
            });

            $('.az').on('click', function () {
                $('#starts').val($(this).data('letter'));
                $('.az').removeClass('active');
                $(this).addClass('active');
                table.page(0).ajax.reload();
                openFinder();
                fetchFinder();
            });

            $('#reset').on('click', function (e) {
                e.preventDefault();
                $('#q').val('');
                $('#starts').val('');
                $('.az').removeClass('active');
                table.search('').order([[5, 'desc']]).page(0).ajax.reload();
                closeFinder();
                if (history.replaceState) history.replaceState({}, document.title, location.pathname);
            });

            $('#q').on('keyup', function (e) {
                if ($(this).val().trim().length >= 2) {
                    openFinder();
                    fetchFinder()
                } else if ($(this).val().trim().length === 0) {
                    closeFinder()
                }
                if (e.key === 'Enter') {
                    table.page(0).ajax.reload()
                }
            });

            $(document).on('click', '#finderClose', closeFinder);

            $('#finderList').on('click', '.finder-row', function () {
                const url = $(this).data('url');
                window.location.href = url;
            });

            $(document).on('keydown', function (e) {
                if (!finderOpen) return;
                const $rows = $('#finderList .finder-row');
                if (e.key === 'Escape') {
                    closeFinder();
                    return
                }
                if (e.key === 'ArrowDown') {
                    finderIndex = Math.min(finderIndex + 1, $rows.length - 1);
                    highlightFinder(finderIndex);
                    e.preventDefault()
                }
                if (e.key === 'ArrowUp') {
                    finderIndex = Math.max(finderIndex - 1, 0);
                    highlightFinder(finderIndex);
                    e.preventDefault()
                }
                if (e.key === 'Enter') {
                    if (finderIndex >= 0) {
                        window.location.href = $($rows[finderIndex]).data('url')
                    }
                }
            });
        });
    </script>
@endpush
