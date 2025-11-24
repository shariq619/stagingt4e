@section('title','Miscellaneous Cost')


@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">

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



            .toolbar {
                display: flex;
                align-items: center;
                gap: 10px;
                padding: 10px 12px;
                border-bottom: 1px solid #edf1f5;
                background: linear-gradient(#ffffff, #f9fafb);
            }

            .toolbar .title {
                font-size: 16px;
                font-weight: 700;
                color: #2f3b52;
                margin-right: auto;
            }

            .y-select {
                height: 32px;
                min-width: 220px;
                border-radius: 9999px;
                border: 1px solid #d1d5db;
                background: var(--pri-soft);
                padding: 0 12px;
                font-weight: 600;
                color: #111827;
            }

            .btn-pill {
                background: var(--pri);
                color: #fff;
                border: 0;
                border-radius: 9999px;
                padding: 8px 12px;
                font-weight: 700;
                cursor: pointer;
                box-shadow: 0 6px 12px rgba(17, 104, 230, .35);
            }

            .btn-pill:disabled {
                opacity: .6;
                cursor: not-allowed;
                box-shadow: none;
            }

            .chk {
                display: flex;
                align-items: center;
                gap: 8px;
                margin-left: auto;
                font-size: 12px;
                color: #374151;
            }

            .table-wrap {
                padding: 12px;
            }



            .table-wrap table.pm-table {
                width: 100%;
                border-collapse: collapse;
                table-layout: fixed;
                background: #ffffff;
            }

            .table-wrap table.pm-table thead th,
            .table-wrap table.pm-table tbody td {
                padding: 8px 10px;
                vertical-align: middle;
                box-sizing: border-box;
            }

            .table-wrap table.pm-table thead th {
                font-size: 11px;
                font-weight: 600;
                text-transform: uppercase;
                letter-spacing: .08em;
                color: #4b5563;
                border-bottom: 1px solid #e5e7eb;
                background: linear-gradient(90deg, #eff6ff, #e0f2fe);
            }

            .table-wrap table.pm-table tbody td {
                color: #111827;
                border-bottom: 1px solid #f1f5f9;
                font-variant-numeric: tabular-nums;
                font-size: 12px;
            }

            .table-wrap table.pm-table tbody tr:nth-child(even) td {
                background-color: #f9fafb;
            }

            .table-wrap table.pm-table tbody tr:last-child td {
                border-bottom: none;
            }

            .table-wrap table.pm-table tbody tr:hover td {
                background-color: #eff6ff;
            }

            .link {
                color: var(--pri);
                text-decoration: none;
                font-weight: 600;
            }

            .link:hover {
                text-decoration: underline;
            }

            .dataTables_wrapper .dataTables_filter,
            .dataTables_wrapper .dataTables_length,
            .dataTables_wrapper .dataTables_info,
            .dataTables_wrapper .dataTables_paginate {
                display: none;
            }

            .add-row {
                display: grid;
                grid-template-columns: 1fr 2fr repeat(4, 1fr) 1fr 1fr;
                gap: 12px;
                padding: 12px;
                align-items: center;
            }

            .add-row input {
                height: 34px;
                padding: 0 10px;
                border-radius: 8px;
                border: 1px solid #d1d5db;
                background: #fff;
                font-size: 13px;
            }

            .add-row input[readonly] {
                background: #f6f7f9;
                cursor: not-allowed;
            }

            .add-row button {
                height: 34px;
                border-radius: 9999px;
                background: var(--pri);
                color: #fff;
                border: none;
                font-weight: 700;
                cursor: pointer;
                box-shadow: 0 6px 12px rgba(17, 104, 230, .35);
            }

            .edit-input {
                width: 100%;
                height: 30px;
                border: 1px solid #d1d5db;
                border-radius: 8px;
                padding: 0 8px;
                background: #fff;
                font-size: 13px;
            }

            .edit-input[readonly] {
                background: #f6f7f9;
                cursor: not-allowed;
            }

            .td-actions {
                white-space: nowrap;
            }

            .vat-rate {
                display: flex;
                align-items: center;
                /*gap: 8px;*/
                /*margin-left: 12px;*/
            }

            .vat-rate input {
                width: 90px;
                height: 30px;
                border: 1px solid #d1d5db;
                border-radius: 8px;
                padding: 0 8px;
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

                .table-wrap table.pm-table thead th {
                    font-size: 11px;
                }

                .table-wrap table.pm-table tbody td {
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

                .table-wrap table.pm-table thead th {
                    font-size: 10px;
                    padding: 6px 6px;
                }

                .table-wrap table.pm-table tbody td {
                    font-size: 10px;
                    padding: 6px 6px;
                }
            }
        </style>
    @endpush

@endpush

<div class="pm-wrap">
    <div class="card">
        <div class="toolbar">
            <div class="title">Miscellaneous Costs</div>
{{--            <select class="y-select" id="filterA">--}}
{{--                <option value="">Select</option>--}}
{{--            </select>--}}
{{--            <select class="y-select" id="filterB">--}}
{{--                <option value="">Select</option>--}}
{{--            </select>--}}
{{--            <button class="btn-pill" id="btnGeneratePO">+ Generate PO</button>--}}
            <div class="vat-rate">
                <label for="vatRate">VAT %</label>
                <input type="number" id="vatRate" min="0" step="0.01" value="20">
            </div>
            <div class="chk">
                <label for="excludeChk">Exclude Miscellaneous Costs:</label>
                <input type="checkbox" id="excludeChk">
            </div>
{{--            <select class="y-select" id="filterC">--}}
{{--                <option value="">Select</option>--}}
{{--            </select>--}}
        </div>

        <div class="table-wrap">
            <table id="miscTable" class="pm-table display">
                <thead>
                <tr>
                    <th class="pm-left">Nominal Code</th>
                    <th class="pm-left">Description</th>
                    <th class="pm-right">Cost</th>
                    <th class="pm-right">Quantity</th>
                    <th class="pm-right">Net Cost</th>
                    <th class="pm-right">VAT</th>
                    <th class="pm-center">Created At</th>
                    <th class="pm-center">Actions</th>
                </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>

        <div class="add-row">
            <input id="inNominal" placeholder="Nominal code">
            <input id="inDesc" placeholder="Description">
            <input id="inCost" type="number" step="0.01" min="0" placeholder="Cost">
            <input id="inQty" type="number" step="1" min="1" value="1" placeholder="Qty">
            <input id="inNet" type="number" step="0.01" min="0" placeholder="Net Cost" readonly>
            <input id="inVat" type="number" step="0.01" min="0" value="0.00" placeholder="VAT" readonly>
            <input id="inCreated" placeholder="Created From" class="d-none">
            <button id="btnAdd">Add</button>
        </div>
    </div>
</div>

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(function () {
            const cohortId = @json(request()->route('training_course') ?? request()->route('cohort') ?? request()->route('id'));
            const csrf = $('meta[name="csrf-token"]').attr('content');

            const routes = {
                dt: "{{ route('crm.training-courses.cohorts.misc.dt', ['cohort' => ':id']) }}",
                toggle: "{{ route('crm.training-courses.cohorts.misc.toggle-exclude', ['cohort' => ':id']) }}",
                store: "{{ route('crm.training-courses.cohorts.misc.store', ['cohort' => ':id']) }}",
                update: "{{ route('crm.training-courses.cohorts.misc.update', ['cohort' => ':c', 'misc' => ':m']) }}",
                destroy: "{{ route('crm.training-courses.cohorts.misc.destroy', ['cohort' => ':c', 'misc' => ':m']) }}",
            };
            const r = (name, a, b) => routes[name].replace(':id', a ?? '').replace(':c', a ?? '').replace(':m', b ?? '');

            function toast(title, icon = 'success') {
                Swal.fire({toast: true, position: 'top-end', timer: 1700, showConfirmButton: false, icon, title});
            }

            function alertErr(msg) {
                Swal.fire({icon: 'error', title: msg || 'Something went wrong'});
            }

            const table = $('#miscTable').DataTable({
                dom: 't',
                autoWidth: false,
                ordering: false,
                columns: [
                    {data: 'nominal_code', className: 'pm-left', width: '16%'},
                    {data: 'description', className: 'pm-left', width: '20%'},
                    {data: 'cost', className: 'pm-left', width: '10%', render: v => Number(v || 0).toFixed(2)},
                    {data: 'quantity', className: 'pm-left', width: '10%'},
                    {data: 'net_cost', className: 'pm-left', width: '12%', render: v => Number(v || 0).toFixed(2)},
                    {data: 'vat', className: 'pm-left', width: '10%', render: v => Number(v || 0).toFixed(2)},
                    {data: 'created_from', className: 'pm-left', width: '16%', render: v => v ?? ''},
                    {
                        data: null, className: 'pm-center td-actions', orderable: false, width: '8%',
                        render: (d, t, row) => actionButtons(row)
                    }
                ],
                data: []
            });

            function actionButtons(row, editing = false) {
                const btnStyle = `
                    display:inline-block;
                    padding:6px 12px;
                    border-radius:8px;
                    font-size:12px;
                    font-weight:600;
                    text-decoration:none;
                    transition:all .15s ease;
                `;

                const btnEdit = `<a href="#" class="act-btn edit" data-id="${row.id}" style="${btnStyle}background:#e7f1ff;color:#0d6efd;margin-right:6px;">Edit</a>`;
                const btnDel = `<a href="#" class="act-btn del" data-id="${row.id}" style="${btnStyle}background:#ffecec;color:#dc3545;">Delete</a>`;
                const btnSave = `<a href="#" class="act-btn save" data-id="${row.id}" style="${btnStyle}background:#d1f7d6;color:#137a37;margin-right:6px;">Save</a>`;
                const btnCancel = `<a href="#" class="act-btn cancel" data-id="${row.id}" style="${btnStyle}background:#f0f2f5;color:#374151;">Cancel</a>`;

                return editing ? btnSave + btnCancel : btnEdit + btnDel;
            }


            function load() {
                $.getJSON(r('dt', cohortId), function (resp) {
                    $('#excludeChk').prop('checked', !!resp.exclude);
                    table.clear().rows.add(resp.data || []).draw();
                }).fail(() => alertErr('Load failed'));
            }

            load();

            function vatRate() {
                return parseFloat($('#vatRate').val() || 0);
            }

            function recalcAdd() {
                const cost = parseFloat($('#inCost').val() || 0);
                const qty = parseFloat($('#inQty').val() || 0);
                const net = (cost * qty);
                const vat = (net * (vatRate() / 100));
                $('#inNet').val(net.toFixed(2));
                $('#inVat').val(vat.toFixed(2));
            }

            $('#inCost,#inQty,#vatRate').on('input', recalcAdd);
            recalcAdd();

            $('#excludeChk').on('change', function () {
                fetch(r('toggle', cohortId), {
                    method: 'PUT',
                    headers: {'X-CSRF-TOKEN': csrf, 'Content-Type': 'application/json', 'Accept': 'application/json'},
                    body: JSON.stringify({exclude: this.checked ? 1 : 0})
                }).then(res => {
                    if (!res.ok) throw 0;
                    toast('Setting saved');
                }).catch(() => alertErr('Could not save setting'));
            });

            $('#btnAdd').on('click', function () {
                recalcAdd();
                const payload = {
                    nominal_code: $('#inNominal').val(),
                    description: $('#inDesc').val(),
                    cost: $('#inCost').val(),
                    quantity: $('#inQty').val(),
                    net_cost: $('#inNet').val(),
                    vat_rate: vatRate(),
                    created_from: $('#inCreated').val()
                };
                fetch(r('store', cohortId), {
                    method: 'POST',
                    headers: {'X-CSRF-TOKEN': csrf, 'Content-Type': 'application/json', 'Accept': 'application/json'},
                    body: JSON.stringify(payload)
                }).then(async resp => {
                    if (!resp.ok) {
                        const j = await resp.json().catch(() => ({message: 'Error'}));
                        throw new Error(j.message || 'Save failed');
                    }
                    $('#inNominal,#inDesc,#inCost,#inQty,#inNet,#inVat,#inCreated').val('');
                    $('#inQty').val('1');
                    recalcAdd();
                    load();
                    toast('Added');
                }).catch(e => alertErr(e.message));
            });

            $('#miscTable').on('click', '.edit', function (e) {
                e.preventDefault();
                const tr = $(this).closest('tr');
                if (tr.hasClass('editing')) return;
                tr.addClass('editing');

                const row = table.row(tr);
                const data = row.data();

                $('td', tr).eq(0).html(`<input class="edit-input" data-k="nominal_code" value="${data.nominal_code || ''}">`);
                $('td', tr).eq(1).html(`<input class="edit-input" data-k="description" value="${data.description || ''}">`);
                $('td', tr).eq(2).html(`<input class="edit-input pm-right" data-k="cost" type="number" step="0.01" min="0" value="${Number(data.cost || 0).toFixed(2)}">`);
                $('td', tr).eq(3).html(`<input class="edit-input pm-right" data-k="quantity" type="number" step="1" min="1" value="${data.quantity || 1}">`);
                $('td', tr).eq(4).html(`<span class="live-net">${Number(data.net_cost || 0).toFixed(2)}</span>`);
                $('td', tr).eq(5).html(`<span class="live-vat">${Number(data.vat || 0).toFixed(2)}</span>`);
                $('td', tr).eq(6).html(`<input class="edit-input" data-k="created_from" value="${data.created_from || ''}">`);
                $('td', tr).eq(7).html(actionButtons(data, true));

                function recalcRow() {
                    const cost = parseFloat(tr.find('.edit-input[data-k="cost"]').val() || 0);
                    const qty = parseFloat(tr.find('.edit-input[data-k="quantity"]').val() || 0);
                    const net = (cost * qty);
                    const vat = (net * (vatRate() / 100));
                    tr.find('.live-net').text(net.toFixed(2));
                    tr.find('.live-vat').text(vat.toFixed(2));
                }

                tr.on('input', '.edit-input[data-k="cost"], .edit-input[data-k="quantity"]', recalcRow);
                $('#vatRate').on('input.recalc' + data.id, recalcRow);
                recalcRow();
            });

            $('#miscTable').on('click', '.cancel', function (e) {
                e.preventDefault();
                const tr = $(this).closest('tr');
                const row = table.row(tr);
                tr.removeClass('editing');
                row.data(row.data());
                row.invalidate().draw(false);
            });

            $('#miscTable').on('click', '.save', function (e) {
                e.preventDefault();
                const tr = $(this).closest('tr');
                const row = table.row(tr);
                const old = row.data();
                const get = k => tr.find(`.edit-input[data-k="${k}"]`).val();

                const cost = parseFloat(get('cost') || 0);
                const qty = parseFloat(get('quantity') || 0);
                const net = (cost * qty);
                const payload = {
                    nominal_code: get('nominal_code'),
                    description: get('description'),
                    cost: cost,
                    quantity: qty,
                    vat_rate: vatRate(),
                    created_from: get('created_from')
                };

                fetch(r('update', cohortId, old.id), {
                    method: 'PUT',
                    headers: {'X-CSRF-TOKEN': csrf, 'Content-Type': 'application/json', 'Accept': 'application/json'},
                    body: JSON.stringify(payload)
                }).then(async resp => {
                    if (!resp.ok) {
                        const j = await resp.json().catch(() => ({message: 'Update failed'}));
                        throw new Error(j.message || 'Update failed');
                    }
                    tr.removeClass('editing');
                    load();
                    toast('Updated');
                }).catch(e => alertErr(e.message));
            });

            $('#miscTable').on('click', '.del', function (e) {
                e.preventDefault();
                const id = $(this).data('id');
                Swal.fire({
                    title: 'Delete this item?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete'
                })
                    .then(res => {
                        if (!res.isConfirmed) return;
                        fetch(r('destroy', cohortId, id), {
                            method: 'DELETE',
                            headers: {'X-CSRF-TOKEN': csrf, 'Accept': 'application/json'}
                        }).then(resp => {
                            if (!resp.ok) throw 0;
                            load();
                            toast('Deleted');
                        }).catch(() => alertErr('Delete failed'));
                    });
            });

            $('#btnGeneratePO').on('click', () => Swal.fire({icon: 'info', title: 'PO generation coming soon'}));
        });
    </script>
@endpush
