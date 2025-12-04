@extends('crm.layout.main')
@section('title','Customer Details')
@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/datatables.net-bs5@1.13.10/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css">


    <style>
        :root {
            --ink: #0f172a;
            --muted: #6b7280;
            --br: #e5e7eb;
            --bg: #f3f4f6;
            --soft: #f8fafc;
            --pri: #1168e6;
            --card-bg: #ffffff;
            --ui-chip: #4b5563;
        }

        body {
            background: radial-gradient(circle at top left, #eef2ff 0, #f3f4f6 42%, #f9fafb 100%);
        }

        .wrap {
            max-width: 1440px;
            margin: 1rem auto 2.5rem;
            padding-inline: 1.25rem;
        }

        .legacy-toolbar {
            background: linear-gradient(135deg, #ffffff, #f3f4ff);
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: .75rem 1.25rem;
            border-bottom: 1px solid var(--br);
            box-shadow: 0 10px 30px rgba(15, 23, 42, .08);
        }

        .legacy-title {
            display: flex;
            align-items: center;
            gap: .75rem;
        }

        .legacy-chip {
            font-weight: 600;
            color: var(--ink);
            font-size: 1.02rem;
        }

        .legacy-badge {
            display: inline-block;
            background: rgba(37, 99, 235, .06);
            border: 1px solid #dbeafe;
            border-radius: 999px;
            padding: .18rem .7rem;
            font-weight: 700;
            font-size: .8rem;
            color: #1d4ed8;
        }

        .btn-pill {
            padding: .45rem .9rem;
            border-radius: 999px;
            cursor: pointer;
            border: 1px solid transparent;
            font-weight: 600;
            font-size: .85rem;
            display: inline-flex;
            align-items: center;
            gap: .35rem;
        }

        .btn-gray-soft {
            background: #f3f4f6;
            border-color: #e5e7eb;
            color: #111827;
        }

        .btn-blue {
            background: linear-gradient(135deg, #2d8bff, #1168e6);
            border-color: #0e58c3;
            color: #fff;
            box-shadow: 0 8px 20px rgba(37, 99, 235, .32);
        }

        .btn-gray {
            background: linear-gradient(135deg, #e5e7eb, #cbd5e1);
            border-color: #cbd5e1;
            color: #111827;
        }

        .btn-pill:hover {
            transform: translateY(-1px);
            box-shadow: 0 10px 26px rgba(15, 23, 42, .16);
        }

        .panel {
            border: 1px dashed #d1d5db;
            border-radius: 16px;
            background: linear-gradient(180deg, #f9fafb, #ffffff);
            padding: 18px 18px 16px;
            box-shadow: 0 10px 24px rgba(15, 23, 42, .06);
            margin: 1.2rem;
        }

        .panel-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: .75rem;
        }

        .panel-title {
            display: inline-flex;
            align-items: center;
            gap: .4rem;
            padding: .3rem .85rem;
            border-radius: 999px;
            background: #e5f0ff;
            color: #1d4ed8;
            font-weight: 700;
            font-size: .86rem;
        }

        .b2b-toggle {
            display: inline-flex;
            align-items: center;
            gap: .35rem;
            font-size: .88rem;
            font-weight: 600;
            color: var(--muted);
        }

        .grid-main {
            display: grid;
            grid-template-columns: 1.35fr 1.25fr;
            gap: 16px;
        }

        .col-card {
            border-radius: 16px;
            padding: .9rem .85rem;
            background: #fff;
            border: 1px solid rgba(148, 163, 184, .35);
            box-shadow: 0 3px 10px rgba(15, 23, 42, .04);
        }

        .rowline {
            display: grid;
            grid-template-columns: 150px 1fr;
            gap: .6rem;
            align-items: center;
            margin: .48rem 0;
            position: relative;
        }

        .label {
            color: #374151;
            font-size: .9rem;
            font-weight: 600;
        }

        .input {
            position: relative;
            display: flex;
            align-items: center;
            gap: .5rem;
            min-height: 40px;
            background: #ffffff;
            border: 1px solid rgba(17, 24, 39, 0.08);
            border-radius: 16px;
            padding: .4rem .9rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.04),
            inset 0 1px 0 rgba(255, 255, 255, 0.6);
            transition: border-color .25s ease,
            box-shadow .25s ease,
            transform .2s ease,
            background-color .25s ease;
        }

        .input:hover {
            transform: translateY(-1px);
            border-color: rgba(17, 104, 230, 0.25);
            box-shadow: 0 4px 8px rgba(17, 104, 230, 0.08),
            inset 0 1px 0 rgba(255, 255, 255, 0.8);
        }

        .input:focus-within {
            border-color: var(--pri);
            background: #f9fbff;
            box-shadow: 0 0 0 4px rgba(17, 104, 230, 0.1),
            0 4px 10px rgba(17, 104, 230, 0.08);
        }

        .fx {
            flex: 1 1 auto;
            border: none;
            outline: none;
            background: transparent;
            font-size: .95rem;
            color: #0f172a;
            font-weight: 500;
        }

        .fx::placeholder {
            color: #9ca3af;
        }

        select.fx,
        input.fx[type="date"],
        input.fx[type="datetime-local"] {
            appearance: none;
            background: transparent;
            color-scheme: light;
            cursor: pointer;
        }

        .mini-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 3px 8px;
            font-size: 12px;
            font-weight: 600;
            border-radius: 6px;
            border: 1px solid #ccc;
            background: #f9fafb;
            color: #333;
            text-decoration: none;
            transition: all 0.15s ease-in-out;
        }

        .mini-btn:hover {
            background: #e5e7eb;
        }

        .divider {
            border-top: 1px dashed var(--br);
            margin: .8rem 0;
        }

        .contacts-wrap {
            margin-top: .9rem;
            border-radius: 14px;
            border: 1px solid #d1d5db;
            overflow: hidden;
            background: #f9fafb;
        }

        .contacts-head {
            background: #e5e7eb;
            padding: .35rem .6rem;
            font-size: .84rem;
            font-weight: 600;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .contacts-table {
            width: 100%;
            border-collapse: collapse;
            background: #ffffff;
        }

        .contacts-table th,
        .contacts-table td {
            border-bottom: 1px solid #e5e7eb;
            padding: .25rem .4rem;
            font-size: .83rem;
            white-space: nowrap;
        }

        .contacts-table th {
            background: #f3f4f6;
            font-weight: 600;
            color: #374151;
        }

        .contacts-table input {
            width: 100%;
            border-radius: 10px;
            border: 1px solid #e5e7eb;
            padding: .1rem .3rem;
            font-size: .82rem;
        }

        .contacts-table .mini-btn {
            font-size: .75rem;
            padding: .12rem .5rem;
        }

        .mc-shell {
            display: grid;
            grid-template-columns: minmax(0, 1.5fr) 260px;
            gap: 12px;
            margin-top: 1rem;
        }

        .mc-card {
            border-radius: 14px;
            border: 1px solid #9ca3af;
            overflow: hidden;
            background: #f3f4f6;
            font-size: .83rem;
        }

        .mc-header {
            background: #6b7280;
            color: #f9fafb;
            padding: .3rem .6rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
        }

        .mc-header span {
            font-weight: 600;
        }

        .mc-body {
            background: #ffffff;
            border-top: 1px solid #9ca3af;
            display: grid;
            grid-template-columns: 1.3fr 1fr;
        }

        .mc-table {
            border-right: 1px solid #d1d5db;
        }

        .mc-table:last-child {
            border-right: none;
        }

        .mc-row {
            width: 275px;
            display: grid;
            grid-template-columns: 1fr 32px;
            align-items: center;
            border-bottom: 1px solid #e5e7eb;
            padding: .25rem .4rem;
        }

        .mc-row:last-child {
            border-bottom: none;
        }

        .mc-row label {
            margin: 0;
            cursor: pointer;
        }

        .mc-row input[type="checkbox"] {
            width: 14px;
            height: 14px;
        }

        .mc-footer-btn {
            width: 100%;
            border: none;
            background: #2563eb;
            color: #fff;
            padding: .35rem;
            font-size: .78rem;
            font-weight: 600;
            border-radius: 0;
            cursor: pointer;
        }

        .mc-footer-btn:hover {
            background: #1d4ed8;
        }

        .notes-box {
            min-height: 130px;
            resize: vertical;
        }

        .err {
            border-color: #ef4444 !important;
            box-shadow: 0 0 0 3px rgba(239, 68, 68, .08);
        }

        .rowline.has-err {
            padding-bottom: 18px;
        }

        .err-text {
            position: absolute;
            left: 160px;
            bottom: -18px;
            font-size: .78rem;
            color: #ef4444;
            max-width: calc(100% - 180px);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        @media (max-width: 1024px) {
            .grid-main {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .rowline {
                grid-template-columns: 1fr;
            }

            .err-text {
                left: 12px;
                max-width: calc(100% - 24px);
            }

            .mc-shell {
                grid-template-columns: 1fr;
            }
        }

        .mega-tabs {
            top: 112px;
            border-bottom: 1px solid var(--br);
            background: #ffffff;
            box-shadow: 0 6px 16px rgba(15, 23, 42, .06);
            width: 100%;
        }

        .mega-inner {
            width: 100%;
            max-width: 1440px;
            padding: .45rem 1.25rem .6rem;
        }

        .tab-row {
            display: flex;
            gap: 8px;
            flex-wrap: nowrap;
            overflow: auto hidden;
            scrollbar-width: none;
            padding: 0 .25rem;
        }

        .tab-row::-webkit-scrollbar {
            display: none;
        }

        .tab {
            --pad-x: .9rem;
            display: inline-flex;
            align-items: center;
            gap: .5rem;
            padding: .52rem var(--pad-x);
            border-radius: 999px;
            border: 1px solid #e3e7ef;
            background: #fff;
            color: var(--ui-chip);
            font-weight: 600;
            font-size: .82rem;
            white-space: nowrap;
            position: relative;
            text-decoration: none;
            transition: background-color .15s ease, color .15s ease, box-shadow .15s ease, transform .12s ease;
        }

        .tab:hover {
            background: #f3f5fa;
            transform: translateY(-1px);
            box-shadow: 0 4px 10px rgba(15, 23, 42, .08);
        }

        .tab.primary {
            background: #f9fafb;
            color: #374151;
        }

        .tab.secondary {
            background: #fff;
        }

        .tab.active {
            background: #e0edff;
            border-color: #c7d2fe;
            color: #1d4ed8;
            box-shadow: 0 6px 14px rgba(37, 99, 235, .25);
        }

        .tab.active::after {
            content: "";
            position: absolute;
            left: 16px;
            right: 16px;
            bottom: -8px;
            height: 3px;
            background: #2563eb;
            border-radius: 999px;
        }

        .tab-spacer {
            height: 10px;
        }

        .tabs-label {
            font-size: .75rem;
            color: var(--muted);
            padding: .2rem .25rem .35rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .06em;
        }

        .section {
            display: none;
        }

        .section.active {
            display: block;
        }

        .ip-wrap {
            margin: 18px auto 32px;
            padding-inline: 1.25rem;
        }

        .ip-card {
            border: 1px dashed #d1d5db;
            border-radius: 16px;
            background: linear-gradient(180deg, #f9fafb, #ffffff);
            padding: 18px 18px 16px;
            box-shadow: 0 10px 24px rgba(15, 23, 42, .06);
        }

        .ip-top {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .ip-icon {
            width: 36px;
            height: 36px;
            border-radius: 999px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #eef2ff;
            color: #4338ca;
            font-weight: 800;
            font-size: .9rem;
        }

        .ip-title {
            font-weight: 600;
            color: #111827;
        }

        .ip-text {
            color: #6b7280;
            margin-top: 4px;
            font-size: .85rem;
        }

        .ip-bar {
            margin-top: 12px;
            height: 7px;
            background: #eef2f7;
            border-radius: 999px;
            overflow: hidden;
        }

        .ip-bar > span {
            display: block;
            height: 100%;
            width: 40%;
            background: linear-gradient(90deg, #60a5fa, #2563eb);
        }

        .badge-soft {
            display: inline-block;
            background: #f1f5f9;
            border: 1px solid #e5e7eb;
            border-radius: 999px;
            padding: .15rem .6rem;
            color: #374151;
            font-weight: 700;
            font-size: .78rem;
        }

        .mini-btn.danger {
            border-color: #ef4444;
            background: #fee2e2;
            color: #b91c1c;
        }

        .mini-btn.danger:hover {
            background: #ef4444;
            color: #fff;
            box-shadow: 0 2px 6px rgba(239, 68, 68, 0.35);
        }
    </style>

@endpush
@section('main')
    <div class="legacy-toolbar">
        <div class="legacy-title">
            <div class="legacy-chip">
                <span>Customer Code:</span>
                <span class="legacy-badge" id="cust_code">C000000</span>
            </div>
            <a href="{{ route('crm.users.audit.dt', ['user' => $delegate->id]) }}" class="btn-pill btn-gray-soft"
               target="_blank">
                <i class="bi bi-clock-history"></i> View Audit Trail
            </a>

        </div>

        <div class="toolbar-actions d-flex gap-2">
            <button class="btn-pill btn-blue d-none" type="submit" form="customerForm" data-quit="0" id="btnSaveTop">
                <i class="bi bi-save"></i> Save Changes
            </button>
            <button class="d-none btn-pill btn-blue" type="submit" form="customerForm" data-quit="1"
                    id="btnSaveQuitTop">
                <i class="bi bi-box-arrow-right"></i> Save &amp; Exit
            </button>
            <button class="d-none btn-pill btn-gray" type="button" id="btnCancelTop">
                <i class="bi bi-arrow-counterclockwise"></i> Cancel
            </button>
            <button class="d-none btn-pill btn-gray-soft" type="button" id="btnPrintTop">
                <i class="bi bi-printer"></i> Print
            </button>
        </div>
    </div>

    <nav class="mega-tabs">
        <div class="mega-inner">
            <div class="tab-spacer"></div>
            <div class="tabs-label">Sections</div>
            <div class="tab-row" id="secondaryTabs">
                <a href="#" class="tab secondary" data-tab="customer-details">Customer Details</a>
                <a href="#" class="tab secondary" data-tab="delegates">Delegates</a>
                <a href="#" class="tab secondary" data-tab="financials">Financials</a>
            </div>
        </div>
    </nav>


    <div id="customer-page" data-id="{{ $delegate->id ?? request()->route('id') }}"
         data-json-url="{{ route('crm.customers.show.json', $delegate->id ?? request()->route('id')) }}">
    </div>

    <section class="section active" id="section-customer-details">
        @include('crm.customers.partials.details')
    </section>

    <section class="section" id="section-delegates">
        <div class="ip-wrap">
            <div class="ip-card">
                <div class="ip-top">
                    <div class="ip-icon">D</div>
                    <div>
                        <div class="ip-title">Delegates</div>
                        <div class="ip-text">Manage learners, profiles, enrollments, and course assignments.</div>
                    </div>
                </div>



                <div class="ip-body mt-3">
                    @include('crm.customers.partials.delegate')
                </div>
            </div>
        </div>
    </section>

    <section class="section" id="section-financials">
        <div class="ip-wrap">
            <div class="ip-card">
                <div class="ip-top">
                    <div class="ip-icon">F</div>
                    <div>
                        <div class="ip-title">Financials | {{ $delegate->name }}</div>
                        <div class="ip-text">Manage invoices, payments, and transaction history for this delegate.</div>
                    </div>
                </div>

                <div class="ip-body mt-3">
                    @include('crm.customers.partials.financials')
                </div>
            </div>
        </div>
    </section>

@endsection
@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/datatables.net@1.13.10/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/datatables.net-bs5@1.13.10/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/moment@2.29.4/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/tinymce@5.10.9/tinymce.min.js"></script>

    <script>
        // CUSTOMER DETAILS + CONTACTS + TABS + LEARNER DATATABLE
        $(function () {
            const customerId = {{ $delegate->id ?? request()->route('id') }};
            let delegatesTable = null;

            function pad(n, len = 6) {
                n = String(n ?? '');
                while (n.length < len) n = '0' + n;
                return n;
            }

            function fmtNice(dt) {
                if (!dt) return '';
                const d = new Date(dt);
                if (isNaN(d)) return '';
                const p = n => String(n).padStart(2, '0');
                return `${p(d.getDate())}-${p(d.getMonth() + 1)}-${d.getFullYear()} ${p(d.getHours())}:${p(d.getMinutes())}`;
            }

            function fill(field, val) {
                const $el = $('[data-f="' + field + '"]');
                if (!$el.length) return;

                if ($el.is(':checkbox')) {
                    const v = (val === true || val === 1 || val === '1');
                    $el.prop('checked', v);
                    return;
                }

                if ($el.is('input[type="date"]')) {
                    if (!val) {
                        $el.val('');
                        return;
                    }
                    const d = new Date(val);
                    if (isNaN(d)) {
                        $el.val('');
                        return;
                    }
                    const p = n => String(n).padStart(2, '0');
                    $el.val(`${d.getFullYear()}-${p(d.getMonth() + 1)}-${p(d.getDate())}`);
                    return;
                }

                if ($el.is('select')) {
                    $el.val(val ?? '');
                    return;
                }

                $el.val(val ? String(val) : '');
            }

            function linkify() {
                $('[data-mail]').each(function () {
                    const key = $(this).data('mail');
                    const v = $('.fx[data-f="' + key + '"]').val();
                    $(this)
                        .toggleClass('disabled', !v)
                        .attr('href', v ? 'mailto:' + v : '#');
                });
                $('[data-call]').each(function () {
                    const key = $(this).data('call');
                    const v = $('.fx[data-f="' + key + '"]').val();
                    $(this)
                        .toggleClass('disabled', !v)
                        .attr('href', v ? 'tel:' + v : '#');
                });
                $('[data-sms]').each(function () {
                    const key = $(this).data('sms');
                    const v = $('.fx[data-f="' + key + '"]').val();
                    $(this)
                        .toggleClass('disabled', !v)
                        .attr('href', v ? 'sms:' + v : '#');
                });
            }

            function clearErrors() {
                $('.rowline.has-err').removeClass('has-err');
                $('.input.err').removeClass('err').each(function () {
                    $(this).find('.err-text').remove();
                });
            }

            function showErrors(errs) {
                const swalMessages = [];

                Object.keys(errs || {}).forEach(function (field) {
                    const msg = (errs[field] && errs[field][0]) || 'Invalid';
                    const $fx = $('[name="' + field + '"]').first();

                    if (!$fx.length) {
                        swalMessages.push(msg);
                        return;
                    }

                    const isCheckbox = $fx.is(':checkbox');
                    const $wrap = $fx.closest('.input');
                    const $row = $fx.closest('.rowline');

                    if (isCheckbox || !$wrap.length || !$row.length) {
                        swalMessages.push(msg);
                        return;
                    }

                    $wrap.addClass('err');
                    $row.addClass('has-err');
                    $wrap.append('<div class="err-text">' + msg + '</div>');
                });

                const $first = $('.input.err').first();
                if ($first.length) {
                    $('html,body').animate({scrollTop: $first.offset().top - 140}, 300);
                    $first.find('.fx').focus();
                }

                if (swalMessages.length) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Please fix the following',
                        html:
                            '<ul style="text-align:left;margin:0;padding-left:1.25rem;">' +
                            swalMessages.map(function (m) {
                                return '<li>' + m + '</li>';
                            }).join('') +
                            '</ul>'
                    });
                }
            }
            const jsonUrl = $('#customer-page').data('json-url');

            $.ajax({
                url: jsonUrl,
                dataType: 'json',
            }).done(function (res) {
                const d = res.delegate || {};
                const contacts = Array.isArray(d.contacts) ? d.contacts : [];

                const fields = [
                    'name', 'address', 'address2', 'town', 'county', 'country',
                    'customer_group', 'old_reference', 'status', 'currency',
                    'telephone', 'fax', 'mobile', 'email', 'website',
                    'staff_code', 'supervisor_confirmer', 'source', 'source_affiliate',
                    'source_campaign', 'notes'
                ];
                fields.forEach(f => typeof d[f] !== 'undefined' && fill(f, d[f]));

                fill('postal_code_normalized', d.postal_code_normalized || d.postal_code || d.postcode);
                fill('created_at', fmtNice(d.created_at));
                fill('b2b_customer', d.b2b_customer);
                fill('external_login', d.external_login);
                $('#external_login_checkbox').prop('checked', !!d.external_login);

                const checkboxFields = [
                    'ct_cctv', 'ct_close_protection', 'ct_cscs', 'ct_door_supervisor',
                    'ct_fire_marshall', 'ct_first_aid', 'ct_vehicle_banksman',
                    'pm_letter', 'pm_email', 'pm_sms'
                ];
                checkboxFields.forEach(f => $('input[name="' + f + '"]').prop('checked', !!d[f]));

                const code = 'C' + pad(d.id || customerId);
                $('#cust_code').text(code);

                linkify();

                let hasContactsData = false;

                if (contacts.length) {
                    console.log(contacts)
                    contacts.forEach(function (c) {
                        const rowHasData =
                            (c.id && c.id !== '') ||
                            (c.name && c.name.trim() !== '') ||
                            (c.position && c.position.trim() !== '') ||
                            (c.direct_number && c.direct_number.trim() !== '') ||
                            (c.direct_email && c.direct_email.trim() !== '') ||
                            (c.mobile && c.mobile.trim() !== '') ||
                            !!c.opt_out;

                        if (rowHasData) {
                            hasContactsData = true;
                        }

                        addContactRow({
                            id: c.id || '',
                            name: c.name || '',
                            position: c.position || '',
                            direct_number: c.direct_number || '',
                            direct_email: c.direct_email || '',
                            mobile: c.mobile || '',
                            opt_out: !!c.opt_out
                        });
                    });
                }

                $('#toggleContactsTable').prop('checked', hasContactsData);
                updateContactsVisibility();
            });

            $('#external_login_checkbox').on('change', function () {
                const v = $(this).is(':checked') ? '1' : '0';
                $('input[data-f="external_login"]').val(v);
            });

            $('#btnPrintTop').on('click', function () {
                window.print();
            });

            $('#btnCancelTop').on('click', function () {
                window.location.reload();
            });

            $('#btnSaveTop,#btnSaveQuitTop').on('click', function () {
                $('#__save_quit').val($(this).data('quit') ? '1' : '0');
            });

            $(document).on('input change', '.fx', linkify);

            function addContactRow(contact = {}) {
                const idx = $('#contactsTable tbody tr').length;
                const row = `
            <tr>
                <td><input type="hidden" name="contacts[${idx}][id]" value="${contact.id || ''}"></td>
                <td><input type="text" name="contacts[${idx}][name]" value="${contact.name || ''}"></td>
                <td><input type="text" name="contacts[${idx}][position]" value="${contact.position || ''}"></td>
                <td><input type="text" name="contacts[${idx}][direct_number]" value="${contact.direct_number || ''}"></td>
                <td><input type="email" name="contacts[${idx}][direct_email]" value="${contact.direct_email || ''}"></td>
                <td><input type="text" name="contacts[${idx}][mobile]" value="${contact.mobile || ''}"></td>
                <td style="text-align:center;">
                    <input type="hidden" name="contacts[${idx}][opt_out]" value="0">
                    <input type="checkbox"
                           name="contacts[${idx}][opt_out]"
                           value="1"
                           ${contact.opt_out ? 'checked' : ''}>
                </td>
                <td>
                    <div style="display:flex;gap:6px;justify-content:flex-end;align-items:center;">
                        <a href="#" class="mini-btn contact-email" data-index="${idx}">E</a>
                        <a href="#" class="mini-btn contact-call" data-index="${idx}">CALL</a>
                        <a href="#" class="mini-btn contact-sms" data-index="${idx}">SMS</a>
                        <button type="button"
                                class="mini-btn danger contact-remove"
                                title="Remove contact">
                            <i class="bi bi-x-lg"></i>
                        </button>
                    </div>
                </td>
            </tr>`;
                $('#contactsTable tbody').append(row);
            }

            $(document).on('click', '.contact-remove', function (e) {
                e.preventDefault();
                $(this).closest('tr').remove();
            });

            $('#btnAddContact').on('click', function () {
                addContactRow({});
            });

            $(document).on('click', '.contact-email', function (e) {
                e.preventDefault();
                const idx = $(this).data('index');
                const v = $(`input[name="contacts[${idx}][direct_email]"]`).val();
                if (v) window.location.href = 'mailto:' + v;
            });

            $(document).on('click', '.contact-call', function (e) {
                e.preventDefault();
                const idx = $(this).data('index');
                const v = $(`input[name="contacts[${idx}][mobile]"]`).val() ||
                    $(`input[name="contacts[${idx}][direct_number]"]`).val();
                if (v) window.location.href = 'tel:' + v;
            });

            $(document).on('click', '.contact-sms', function (e) {
                e.preventDefault();
                const idx = $(this).data('index');
                const v = $(`input[name="contacts[${idx}][mobile]"]`).val();
                if (v) window.location.href = 'sms:' + v;
            });

            function toggleMc(open) {
                const $body = $('#mcBody');
                const $chev = $('#mcChevron');
                if (open === undefined) open = $body.is(':hidden');
                if (open) {
                    $body.slideDown(160);
                    $chev.removeClass('bi-chevron-right').addClass('bi-chevron-down');
                } else {
                    $body.slideUp(160);
                    $chev.removeClass('bi-chevron-down').addClass('bi-chevron-right');
                }
            }

            $('#mcHeader, #mcSelectedOnly').on('click', function () {
                toggleMc();
            });

            $('#mcBody').show();

            $('#customerForm').on('submit', function (e) {
                e.preventDefault();
                clearErrors();

                const $btns = $('#btnSaveTop,#btnSaveQuitTop').prop('disabled', true);
                const fd = $(this).serialize();

                $.ajax({
                    url: this.action,
                    method: 'POST',
                    data: fd,
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') || ''}
                })
                    .done(function (res) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Saved',
                            text: (res && res.message) || 'Customer details updated',
                            timer: 1500,
                            showConfirmButton: false,
                            toast: true,
                            position: 'top-end'
                        });

                        if ($('#__save_quit').val() === '1') {
                            setTimeout(function () {
                                window.location = "{{ route('crm.customers.index') }}";
                            }, 1500);
                        }
                    })
                    .fail(function (xhr) {
                        if (xhr.status === 422 && xhr.responseJSON && xhr.responseJSON.errors) {
                            showErrors(xhr.responseJSON.errors);
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Update failed',
                                text: (xhr.responseJSON && xhr.responseJSON.message) || 'Something went wrong while saving.'
                            });
                        }
                    })
                    .always(function () {
                        $btns.prop('disabled', false);
                        $('#__save_quit').val('0');
                    });
            });

            function getParam(k) {
                return new URLSearchParams(window.location.search).get(k);
            }

            function setQueryParam(k, v) {
                const u = new URL(window.location);
                u.searchParams.set(k, v);
                window.history.replaceState(null, '', u.toString());
            }

            function initDelegatesTable() {
                if (delegatesTable) {
                    delegatesTable.columns.adjust().draw(false);
                    return;
                }

                delegatesTable = $('#learnerDelegatesTable').DataTable({
                    processing: true,
                    serverSide: true,
                    scrollX: true,
                    autoWidth: false,
                    ajax: '{{ route("crm.customers.delegates.dt", $delegate->id ?? request()->route("id")) }}',
                    columns: [
                        {data: 'learner_code', name: 'id', searchable: true, orderable: false},
                        {data: 'full_name', name: 'name'},
                        {data: 'town', name: 'town'},
                        {data: 'postal', name: 'postal_code'},
                        {data: 'telephone', name: 'telephone'},
                        {data: 'email', name: 'email'},
                    ],
                    pageLength: 10,
                    lengthChange: false,
                    order: [[1, 'asc']],
                    language: {emptyTable: 'No delegates found.'},
                    initComplete: function () {
                        const api = this.api();
                        setTimeout(function () {
                            api.columns.adjust().draw(false);
                        }, 50);
                    },
                    drawCallback: function () {
                        this.api().columns.adjust();
                    }
                });

                $(window).on('resize', function () {
                    if (delegatesTable) {
                        delegatesTable.columns.adjust().draw(false);
                    }
                });
            }

            const defaultTab = 'customer-details';
            const activeTab = (getParam('tab') || defaultTab).toLowerCase();
            $('[data-tab="' + activeTab + '"]').addClass('active');
            $('.section').removeClass('active');
            $('#section-' + activeTab).addClass('active');

            if (activeTab === 'delegates') {
                initDelegatesTable();
            }

            if (activeTab === 'customer-details') {
                $('#btnSaveTop').removeClass('d-none')
            }

            $('.mega-tabs .tab').on('click', function (e) {
                e.preventDefault();
                const tab = $(this).data('tab');
                $('.mega-tabs .tab').removeClass('active');
                $(this).addClass('active');
                $('.section').removeClass('active');
                $('#section-' + tab).addClass('active');
                setQueryParam('tab', tab);

                if (tab === 'delegates') {
                    initDelegatesTable();
                }

                if (tab === 'customer-details') {
                    $('#btnSaveTop').removeClass('d-none')
                } else {
                    $('#btnSaveTop').addClass('d-none')
                }
            });

            function updateContactsVisibility() {
                const show = $('#toggleContactsTable').is(':checked');
                $('#contactsTable').toggle(show);
                $('#btnAddContact').prop('disabled', !show);

                if (!show) {
                    $('#contactsTable tbody input').each(function () {
                        if (this.type === 'checkbox') {
                            this.checked = false;
                        } else {
                            $(this).val('');
                        }
                    });
                } else {
                    if ($('#contactsTable tbody tr').length === 0) {
                        addContactRow({});
                    }
                }
            }

            updateContactsVisibility();
            $(document).on('change', '#toggleContactsTable', updateContactsVisibility);
        });

        // CUSTOMER FINANCIALS + BULK INVOICE PDF
        var composeEd = null;
        var mailRecipients = [];

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

        function emailIsValid(v) {
            return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test((v || '').trim());
        }

        function syncRecipientsHidden() {
            $('#mail_to').val(mailRecipients.join(','));
        }

        function renderRecipients() {
            var wrap = $('#mail_to_wrap .mail-to-chips');
            if (!wrap.length) return;
            wrap.empty();
            mailRecipients.forEach(function (addr, idx) {
                wrap.append(
                    '<span class="mail-chip" data-idx="' + idx + '">' +
                    addr +
                    '<span class="chip-remove ms-1" data-idx="' + idx + '">&times;</span>' +
                    '</span>'
                );
            });
            syncRecipientsHidden();
        }

        function addRecipientFromValue(val) {
            if (!val) return;
            var parts = val.split(/[,;]/).map(function (s) {
                return s.trim();
            }).filter(Boolean);
            parts.forEach(function (p) {
                if (!emailIsValid(p)) return;
                if (mailRecipients.indexOf(p) === -1) {
                    mailRecipients.push(p);
                }
            });
            $('#mail_to_input').val('');
            renderRecipients();
        }

        function openCompose(toEmail) {
            mailRecipients = [];
            if (toEmail) {
                addRecipientFromValue(toEmail);
            } else {
                renderRecipients();
            }
            $('#mail_subject').val('');
            initComposeOnce();
            $('#mailComposeModal').modal('show');
            setTimeout(function () {
                $('#mail_to_input').trigger('focus');
                if (composeEd) composeEd.focus();
            }, 150);
        }

        function insertFooterImage(url) {
            if (!composeEd || !url) return;
            var cur = composeEd.getContent() || '';
            var foot = '<p style="margin-top:24px;text-align:center;"><img src="' + url + '" style="max-width:100%;border-radius:8px" /></p>';
            composeEd.setContent(cur + foot);
        }

        $(document).on('click', '[data-mail]', function (e) {
            e.preventDefault();
            if ($(this).hasClass('disabled')) return;
            var key = $(this).data('mail');
            var v = $('.fx[data-f="' + key + '"]').val();
            openCompose(v || '');
        });

        $('#btnFooterImg').on('click', function () {
            $('#footerUrlInput').val('');
            $('#footerUrlPreview').hide().empty();
            $('#footerUrlInput').removeClass('is-invalid');
            $('#footerUrlModal').modal('show');
            setTimeout(function () {
                $('#footerUrlInput').trigger('focus');
            }, 150);
        });

        function isHttpUrl(u) {
            return /^https?:\/\//i.test((u || '').trim());
        }

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
            if (typeof insertFooterImage === 'function') insertFooterImage(v);
            $('#footerUrlModal').modal('hide');
        });

        function renderAttachmentList() {
            var wrap = $('#mail_attachments_wrap');
            var list = $('#mail_attachments_list');
            if (!wrap.length || !list.length) return;
            var json = $('#mail_attachments').val() || '[]';
            var items;
            try {
                items = JSON.parse(json);
            } catch (e) {
                items = [];
            }
            list.empty();
            if (!items.length) {
                wrap.addClass('d-none');
                return;
            }
            wrap.removeClass('d-none');
            items.forEach(function (att, idx) {
                var name = att.name || ('Attachment ' + (idx + 1));
                var url = att.url || att.pdf_url || '';
                var icon = '<i class="bi bi-paperclip me-2 text-secondary"></i>';
                if (url) {
                    list.append(
                        '<li class="d-flex align-items-center mb-1">' +
                        icon +
                        '<a href="' + url + '" target="_blank" rel="noopener noreferrer">' +
                        name +
                        '</a></li>'
                    );
                } else {
                    list.append(
                        '<li class="d-flex align-items-center mb-1">' +
                        icon +
                        '<span>' + name + '</span></li>'
                    );
                }
            });
        }

        function postSend() {
            var toRaw = ($('#mail_to').val() || '').trim();
            var sub = ($('#mail_subject').val() || '').trim();
            var body = composeEd ? (composeEd.getContent() || '') : '';
            var attachmentsJson = $('#mail_attachments').val() || '[]';
            var attachments;

            try {
                attachments = JSON.parse(attachmentsJson);
            } catch (e) {
                attachments = [];
            }

            if (!toRaw) {
                Swal.fire({icon: 'error', title: 'Enter recipient email'});
                return;
            }

            var toList = toRaw.split(',').map(function (s) {
                return s.trim();
            }).filter(Boolean);
            if (!toList.length) {
                Swal.fire({icon: 'error', title: 'Enter recipient email'});
                return;
            }

            var bad = null;
            toList.forEach(function (addr) {
                if (!bad && !emailIsValid(addr)) bad = addr;
            });
            if (bad) {
                Swal.fire({icon: 'error', title: 'Invalid email: ' + bad});
                return;
            }

            if (!body.replace(/<[^>]*>/g, '').replace(/&nbsp;/g, '').trim()) {
                Swal.fire({icon: 'error', title: 'Body is required'});
                return;
            }

            var delegateId = $('#delegate-page').data('id');
            var route = "{{ route('crm.learner.delegates.email.send', ':id') }}".replace(':id', delegateId);

            const token = $('meta[name="csrf-token"]').attr('content');
            $('#sendStatus').text('Sending…');
            $('#btnSendMail').prop('disabled', true);

            $.ajax({
                url: route,
                method: 'POST',
                data: {
                    _token: token,
                    to: toRaw,
                    subject: sub,
                    html_body: body,
                    attachments: attachmentsJson
                }
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
                        $('#mailComposeModal').modal('hide');
                        $('#sendStatus').text('');
                        $('#mail_subject').val('');
                        $('#mail_attachments').val('');
                        renderAttachmentList();
                        mailRecipients = [];
                        renderRecipients();
                        if (composeEd) composeEd.setContent('');
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

        $('#btnSendMail').off('click').on('click', postSend);

        $('#mailComposeModal').on('hidden.bs.modal', function () {
            $('#mail_subject').val('');
            $('#sendStatus').text('');
            $('#mail_attachments').val('');
            renderAttachmentList();
            mailRecipients = [];
            renderRecipients();
        });

        $(document).on('keydown', '#mail_to_input', function (e) {
            if (e.key === 'Enter' || e.key === ',' || e.key === ';') {
                e.preventDefault();
                var v = $(this).val().trim();
                addRecipientFromValue(v);
            } else if (e.key === 'Backspace' && !$(this).val()) {
                if (mailRecipients.length) {
                    mailRecipients.pop();
                    renderRecipients();
                }
            }
        });

        $(document).on('blur', '#mail_to_input', function () {
            var v = $(this).val().trim();
            addRecipientFromValue(v);
        });

        $(document).on('click', '.chip-remove', function () {
            var idx = parseInt($(this).data('idx'), 10);
            if (!isNaN(idx)) {
                mailRecipients.splice(idx, 1);
                renderRecipients();
            }
        });

        $(function () {
            var finUrl = "{{ route('crm.customers.financials.json', $delegate->id) }}";
            var allTransactions = [];
            var currentSortField = 'date_sort';
            var currentSortDir = 'asc';
            var currentPage = 1;
            var perPage = 25;

            $('#fin-table thead th[data-sort="date_sort"]').addClass('sort-desc');

            function money(v) {
                v = parseFloat(v || 0);
                return isNaN(v) ? '0.00' : v.toFixed(2);
            }

            function buildStatusCell(row) {
                if (!row.balance_text) return '';
                var flag = row.flag || '';
                var icoClass = flag === 'ok' ? 'ok' : flag === 'bad' ? 'bad' : 'warn';
                var icoChar = flag === 'ok' ? '✓' : flag === 'bad' ? '×' : '!';
                return '<span class="status"><span class="ico ' + icoClass + '">' + icoChar + '</span><span class="neg">' + row.balance_text + '</span></span>';
            }

            function updateSelectedTotals() {
                var selDebit = 0, selCredit = 0, selBalance = 0;
                $('.fin-row-chk:checked').each(function () {
                    selDebit += parseFloat($(this).data('debit') || 0);
                    selCredit += parseFloat($(this).data('credit') || 0);
                    selBalance += parseFloat($(this).data('balance') || 0);
                });
                $('#fin-sel-debit').text(money(selDebit));
                $('#fin-sel-credit').text(money(selCredit));
                $('#fin-sel-balance').text(money(selBalance));
            }

            function renderRows(rows) {
                var $tbody = $('#fin-rows').empty();
                if (!rows.length) {
                    $tbody.append('<tr><td colspan="9" class="muted">No transactions found.</td></tr>');
                    updateSelectedTotals();
                    return;
                }
                $.each(rows, function (_, row) {
                    var debit = row.debit ? money(row.debit) : '';
                    var credit = row.credit ? money(row.credit) : '';
                    var statusHtml = buildStatusCell(row);
                    var txnLabel = row.transaction_url
                        ? '<a class="link" href="' + row.transaction_url + '">' + row.transaction + '</a>'
                        : (row.transaction || '');
                    var typeAttr = row.type || '';
                    var invoiceIdAttr = (row.type === 'invoice' && row.invoice_id) ? row.invoice_id : '';
                    var invoiceAttr = invoiceIdAttr ? 'data-invoice-id="' + invoiceIdAttr + '"' : '';
                    var detailBtn = '';
                    if (typeAttr === 'invoice' && invoiceIdAttr) {
                        detailBtn = '<button type="button" class="fin-payments-btn fin-payments-open" ' +
                            'data-invoice-id="' + invoiceIdAttr + '" ' +
                            'data-code="' + (row.code || '') + '">D</button>';
                    }
                    var codeHtml = row.code || '';
                    if (row.delegate_hint) {
                        codeHtml = '<span title="' + escHtml(row.delegate_hint) + '">' + escHtml(row.code || '') + '</span>';
                    }
                    var tr = '<tr>' +
                        '<td>' + (row.date || '') + '</td>' +
                        '<td class="code">' + codeHtml + '</td>' +
                        '<td>' + txnLabel + detailBtn + '</td>' +
                        '<td class="muted">' + (row.details || '') + '</td>' +
                        '<td>' + (row.nominal || '') + '</td>' +
                        '<td class="center">' +
                        '<input type="checkbox" class="fin-row-chk"' +
                        ' data-type="' + typeAttr + '"' +
                        ' ' + invoiceAttr +
                        ' data-debit="' + (row.debit || 0) + '"' +
                        ' data-credit="' + (row.credit || 0) + '"' +
                        ' data-balance="' + (row.balance || 0) + '">' +
                        '</td>' +
                        '<td class="right">' + debit + '</td>' +
                        '<td class="right">' + credit + '</td>' +
                        '<td>' + statusHtml + '</td>' +
                        '</tr>';
                    $tbody.append(tr);
                });
                var allChecked = $('#fin-all-trans').prop('checked');
                $('.fin-row-chk').prop('checked', allChecked);
                updateSelectedTotals();
            }

            var paymentsUrl = "{{ route('crm.customers.invoices.payments.json') }}";

            $(document).on('click', '.fin-payments-open', function () {
                var invoiceId = $(this).data('invoice-id');
                var code = $(this).data('code') || '';
                if (!invoiceId) return;

                $('#ipm-title-code').text(code ? '(' + code + ')' : '');
                $('#ipm-rows').html('<tr><td colspan="5" class="text-muted text-center py-3">Loading…</td></tr>');
                $('#ipm-total').text('£ 0.00');
                $('#invoicePaymentsModal').modal('show');

                $.getJSON(paymentsUrl, {invoice_id: invoiceId}, function (res) {
                    var $tbody = $('#ipm-rows').empty();
                    if (!res.ok || !res.rows || !res.rows.length) {
                        $tbody.html('<tr><td colspan="5" class="text-muted text-center py-3">No payments found for this invoice.</td></tr>');
                        $('#ipm-total').text('£ 0.00');
                        return;
                    }
                    var total = 0;
                    $.each(res.rows, function (_, p) {
                        var amt = parseFloat(p.amount || 0);
                        if (isNaN(amt)) amt = 0;
                        total += amt;
                        $tbody.append(
                            '<tr>' +
                            '<td>' + (p.payment_date || '') + '</td>' +
                            '<td>' + (p.payment_ref || '') + '</td>' +
                            '<td>' + (p.payment_from || '') + '</td>' +
                            '<td>' + (p.payment_type || '') + '</td>' +
                            '<td class="text-end">£ ' + money(amt) + '</td>' +
                            '</tr>'
                        );
                    });
                    $('#ipm-total').text('£ ' + money(total));
                }).fail(function () {
                    $('#ipm-rows').html('<tr><td colspan="5" class="text-danger text-center py-3">Unable to load payments.</td></tr>');
                    $('#ipm-total').text('£ 0.00');
                });
            });


            function sortRows(rows) {
                if (!currentSortField) return rows;
                var field = currentSortField;
                var dir = currentSortDir === 'asc' ? 1 : -1;
                return rows.slice().sort(function (a, b) {
                    var av = a[field];
                    var bv = b[field];
                    var na = parseFloat(av);
                    var nb = parseFloat(bv);
                    if (!isNaN(na) && !isNaN(nb)) {
                        if (na < nb) return -1 * dir;
                        if (na > nb) return 1 * dir;
                        return 0;
                    }
                    av = (av === null || typeof av === 'undefined') ? '' : String(av);
                    bv = (bv === null || typeof bv === 'undefined') ? '' : String(bv);
                    return av.localeCompare(bv, undefined, {numeric: true, sensitivity: 'base'}) * dir;
                });
            }

            function renderPagination(totalPages) {
                var $pager = $('#fin-pagination');
                if (!$pager.length) return;
                $pager.empty();
                var html = '<ul class="fin-pager-list">';
                var disabledPrev = currentPage === 1 ? ' disabled' : '';
                html += '<li class="fin-page-item' + disabledPrev + '" data-page="' + (currentPage - 1) + '">&laquo;</li>';
                for (var p = 1; p <= totalPages; p++) {
                    var active = p === currentPage ? ' active' : '';
                    html += '<li class="fin-page-item' + active + '" data-page="' + p + '">' + p + '</li>';
                }
                var disabledNext = currentPage === totalPages ? ' disabled' : '';
                html += '<li class="fin-page-item' + disabledNext + '" data-page="' + (currentPage + 1) + '">&raquo;</li>';
                html += '</ul>';
                $pager.html(html);
            }

            function applySortAndPagination() {
                var sorted = sortRows(allTransactions);
                var total = sorted.length;
                var totalPages = Math.max(1, Math.ceil(total / perPage));
                if (currentPage > totalPages) currentPage = totalPages;
                if (currentPage < 1) currentPage = 1;
                var start = (currentPage - 1) * perPage;
                var pageRows = sorted.slice(start, start + perPage);
                renderRows(pageRows);
                renderPagination(totalPages);
            }

            function getRangeParams() {
                var params = {};
                var f = $('#fin-from').val();
                var t = $('#fin-to').val();
                if (f) params.from = f;
                if (t) params.to = t;
                return params;
            }

            function loadFinancials(params) {
                $.getJSON(finUrl, params || {}, function (res) {
                    allTransactions = res.rows || [];
                    $('#fin-account-balance').text(res.account_balance_formatted || '0.00');
                    var creditLimit = (res.customer && typeof res.customer.credit_limit !== 'undefined')
                        ? parseFloat(res.customer.credit_limit || 0).toFixed(2)
                        : '0.00';
                    $('#fin-credit-limit').text(creditLimit);
                    currentPage = 1;
                    applySortAndPagination();
                });
            }

            $('#fin-all-trans').on('change', function () {
                var checked = $(this).prop('checked');
                $('.fin-row-chk').prop('checked', checked);
                updateSelectedTotals();
            });

            $(document).on('change', '.fin-row-chk', updateSelectedTotals);

            $(document).on('click', '#fin-pagination .fin-page-item', function () {
                var $li = $(this);
                if ($li.hasClass('disabled') || $li.hasClass('active')) return;
                var page = parseInt($li.data('page'), 10);
                if (!page || page < 1) return;
                currentPage = page;
                applySortAndPagination();
            });

            $(document).on('click', '#fin-table thead th[data-sort]', function () {
                var field = $(this).data('sort');
                if (!field) return;
                if (currentSortField === field) {
                    currentSortDir = currentSortDir === 'asc' ? 'desc' : 'asc';
                } else {
                    currentSortField = field;
                    currentSortDir = 'asc';
                }
                $('#fin-table thead th').removeClass('sort-asc sort-desc');
                $(this).addClass(currentSortDir === 'asc' ? 'sort-asc' : 'sort-desc');
                applySortAndPagination();
            });

            loadFinancials({});

            $('#fin-pdf-btn').on('click', function () {
                var invoiceIds = [];
                $('.fin-row-chk:checked').each(function () {
                    if ($(this).data('type') === 'invoice') {
                        var id = $(this).data('invoice-id');
                        if (id) invoiceIds.push(id);
                    }
                });

                var from = $('#fin-from').val();
                var to = $('#fin-to').val();

                if (!invoiceIds.length) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'No Invoices Selected',
                        text: 'Please select at least one invoice to print.',
                        confirmButtonColor: '#2563eb'
                    });
                    return;
                }

                Swal.fire({
                    title: 'Generate PDF?',
                    text: 'Selected invoices will be merged into a single PDF file.',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#2563eb',
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: 'Yes, generate'
                }).then(function (result) {
                    if (!result.isConfirmed) return;

                    Swal.fire({
                        title: 'Generating...',
                        text: 'Please wait while the PDF is being created.',
                        allowOutsideClick: false,
                        didOpen: function () {
                            Swal.showLoading();
                        }
                    });

                    $.ajax({
                        url: "{{ route('crm.invoices.bulk.by-invoices') }}",
                        method: 'POST',
                        data: {
                            invoice_ids: invoiceIds,
                            from: from,
                            to: to,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function (res) {
                            Swal.close();
                            if (res.ok && res.pdf_url) {
                                window.open(res.pdf_url, '_blank');
                                Swal.fire({
                                    toast: true,
                                    icon: 'success',
                                    title: 'Invoice PDF opened in a new tab',
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 2200,
                                    timerProgressBar: true
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: res.message || 'Could not generate invoice PDF.'
                                });
                            }
                        },
                        error: function () {
                            Swal.close();
                            Swal.fire('Error', 'Something went wrong while generating the PDF.', 'error');
                        }
                    });
                });
            });

            $('#fin-statement-btn').on('click', function () {
                var from = $('#fin-from').val();
                var to = $('#fin-to').val();

                var invoiceIds = [];
                $('.fin-row-chk:checked').each(function () {
                    if ($(this).data('type') === 'invoice') {
                        var id = $(this).data('invoice-id');
                        if (id) invoiceIds.push(id);
                    }
                });

                Swal.fire({
                    title: 'Generate Statement?',
                    text: 'Customer account statement will be generated as a PDF.',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#2563eb',
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: 'Yes, generate'
                }).then(function (result) {
                    if (!result.isConfirmed) return;

                    Swal.fire({
                        title: 'Generating...',
                        text: 'Please wait while the PDF is being created.',
                        allowOutsideClick: false,
                        didOpen: function () {
                            Swal.showLoading();
                        }
                    });

                    $.ajax({
                        url: "{{ route('crm.customers.statement.pdf', $delegate->id) }}",
                        method: 'POST',
                        data: {
                            from: from,
                            to: to,
                            invoice_ids: invoiceIds,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function (res) {
                            Swal.close();
                            if (res.ok && res.pdf_url) {
                                window.open(res.pdf_url, '_blank');
                                Swal.fire({
                                    toast: true,
                                    icon: 'success',
                                    title: 'Statement PDF opened in a new tab',
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 2200,
                                    timerProgressBar: true
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: res.message || 'Could not generate statement PDF.'
                                });
                            }
                        },
                        error: function () {
                            Swal.close();
                            Swal.fire('Error', 'Something went wrong while generating the statement PDF.', 'error');
                        }
                    });
                });
            });

            $('#fin-statement-email').on('click', function () {
                var from = $('#fin-from').val();
                var to = $('#fin-to').val();

                var invoiceIds = [];
                $('.fin-row-chk:checked').each(function () {
                    if ($(this).data('type') === 'invoice') {
                        var id = $(this).data('invoice-id');
                        if (id) invoiceIds.push(id);
                    }
                });

                Swal.fire({
                    title: 'Email Statement?',
                    text: 'A statement PDF will be generated and attached to an email.',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#2563eb',
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: 'Yes, continue'
                }).then(function (result) {
                    if (!result.isConfirmed) return;

                    Swal.fire({
                        title: 'Generating...',
                        text: 'Please wait while the statement PDF is being created.',
                        allowOutsideClick: false,
                        didOpen: function () {
                            Swal.showLoading();
                        }
                    });

                    $.ajax({
                        url: "{{ route('crm.customers.statement.pdf', $delegate->id) }}",
                        method: 'POST',
                        data: {
                            from: from,
                            to: to,
                            invoice_ids: invoiceIds,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function (res) {
                            Swal.close();
                            if (res.ok && res.pdf_url) {
                                var attachments = [{
                                    path: res.pdf_path || '',
                                    name: res.filename || 'statement.pdf',
                                    disk: res.disk || 'public',
                                    mime: res.mime || 'application/pdf'
                                }];

                                $('#mail_attachments').val(JSON.stringify(attachments));
                                renderAttachmentList();

                                var toEmail = "{{ $delegate->email ?? '' }}";
                                openCompose(toEmail || '');
                                $('#mail_subject').val('Statement of Account');
                                setTimeout(function () {
                                    if (composeEd) composeEd.focus();
                                }, 150);
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: res.message || 'Could not generate statement PDF.'
                                });
                            }
                        },error: function () {
                            Swal.close();
                            Swal.fire('Error', 'Something went wrong while generating the statement PDF.', 'error');
                        }
                    });
                });
            });

            $('#fin-from').daterangepicker({
                singleDatePicker: true,
                autoUpdateInput: false,
                showDropdowns: true,
                locale: {
                    format: 'DD-MM-YYYY',
                    cancelLabel: 'Clear'
                }
            }, function (start) {
                $('#fin-from').val(start.format('DD-MM-YYYY'));
            });

            $('#fin-to').daterangepicker({
                singleDatePicker: true,
                autoUpdateInput: false,
                showDropdowns: true,
                locale: {
                    format: 'DD-MM-YYYY',
                    cancelLabel: 'Clear'
                }
            }, function (start) {
                $('#fin-to').val(start.format('DD-MM-YYYY'));
            });

            function formatDate(d) {
                var dd = ('0' + d.getDate()).slice(-2);
                var mm = ('0' + (d.getMonth() + 1)).slice(-2);
                var yyyy = d.getFullYear();
                return dd + '-' + mm + '-' + yyyy;
            }

            $('.quick .q').on('click', function () {
                var range = $(this).data('range');
                var today = new Date();
                var from = null, to = today;

                if (range === 'clear') {
                    $('#fin-from, #fin-to').val('');
                    loadFinancials({});
                    return;
                }

                if (range === 'today') {
                    from = new Date(today);
                } else if (range === 'week') {
                    from = new Date();
                    from.setDate(today.getDate() - 7);
                } else if (range === 'month') {
                    from = new Date();
                    from.setMonth(today.getMonth() - 1);
                }

                if (from) {
                    $('#fin-from').val(formatDate(from));
                    $('#fin-to').val(formatDate(to));
                }

                var params = {
                    from: $('#fin-from').val(),
                    to: $('#fin-to').val()
                };

                loadFinancials(params);
            });

            $('#fin-from, #fin-to').on('change', function () {
                var params = {};
                var f = $('#fin-from').val();
                var t = $('#fin-to').val();
                if (f) params.from = f;
                if (t) params.to = t;
                loadFinancials(params);
            });

            $('#fin-filter-type').on('change', function () {
                applyFilters();
            });

            $('#fin-search').on('click', function () {
                loadFinancials(getRangeParams());
            });

            $('#fin-refresh').on('click', function () {
                $(this).addClass('disabled').text('Refreshing…');
                loadFinancials({});
                setTimeout(() => {
                    $('#fin-refresh').removeClass('disabled').html('<i class="bi bi-arrow-repeat me-1"></i>Refresh');
                }, 1000);
            });

            function escHtml(s) {
                return String(s || '').replace(/[&<>"']/g, function (c) {
                    return {'&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;'}[c];
                });
            }

        });
    </script>
@endpush
