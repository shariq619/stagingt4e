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
        color: #0f172a;
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
        max-width: 100%;
        display: block;
    }

    .table-modern {
        border-collapse: collapse;
        width: 100%;
        min-width: 900px;
        font-size: .875rem;
    }

    #learnerDelegatesTable {
        width: 100% !important;
    }

    .table-modern thead {
        box-shadow: 0 1px 0 rgba(148, 163, 184, .45);
    }

    .table-modern th {
        background: linear-gradient(90deg, #eff6ff, #e0f2fe);
        color: #0f172a;
        font-size: .75rem;
        letter-spacing: .08em;
        border: 0;
        white-space: nowrap;
        text-transform: uppercase;
        text-align: left;
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

    .delegate-status {
        font-size: 12px;
        font-weight: 600;
        border-radius: 999px;
        padding: 3px 10px;
        text-transform: capitalize;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }

    .delegate-status::before {
        content: "";
        width: 6px;
        height: 6px;
        border-radius: 999px;
        background: currentColor;
        opacity: .85;
    }

    .delegate-status.active {
        background: #d1fae5;
        color: #065f46;
    }

    .delegate-status.pending {
        background: #fef3c7;
        color: #92400e;
    }

    .delegate-status.inactive {
        background: #fee2e2;
        color: #991b1b;
    }

    #learnerDelegatesTable_paginate, #learnerDelegatesTable_info, #learnerDelegatesTable_filter{
        margin: 10px;
    }

    .btn-add-delegate{
        display:inline-flex;
        align-items:center;
        gap:.35rem;
        padding:.35rem .9rem;
        border-radius:999px;
        border:1px solid #0e58c3;
        background:linear-gradient(135deg,#2d8bff,#1168e6);
        color:#fff;
        font-size:.82rem;
        font-weight:600;
        text-decoration:none;
        box-shadow:0 8px 20px rgba(37,99,235,.3);
    }
    .btn-add-delegate:hover{
        text-decoration:none;
        color:#fff;
        transform:translateY(-1px);
        box-shadow:0 10px 26px rgba(37,99,235,.35);
    }

</style>

<div class="card-modern">
    <div class="card-header d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center gap-2">
            <h6 class="card-title mb-0 d-none">Learner Delegates</h6>
            <span class="badge-soft">Linked Delegates</span>
        </div>

        <a href="{{ route('crm.learner.delegates.create', $delegate->id ?? request()->route('id')) }}"
           class="btn btn-sm btn-add-delegate">
            <i class="bi bi-plus-circle"></i>
            Add Delegate
        </a>
    </div>

    <div class="card-body">
        <div class="table-wrap delegate-table-wrap">
            <table id="learnerDelegatesTable" class="table-modern dataTable">
                <thead>
                <tr>
                    <th>Learner Delegate ID</th>
                    <th>Learner Delegate Name</th>
                    <th>Town</th>
                    <th>PostCode</th>
                    <th>Telephone</th>
                    <th>Email</th>
                </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>
