@extends('crm.layout.main')
@section('title', 'Add Learner–Delegate')

@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <style>
        :root {
            --ink: #0f172a;
            --muted: #6b7280;
            --br: #e5e7eb;
            --bg: #f3f4f6;
            --soft: #f8fafc;
            --pri: #1168e6;
            --card-bg: #ffffff;
            --chip: #2563eb;
            --chip-soft: #e0edff;
            --header-bg: #f9fafb;
            --accent: #22c55e;
            --ui-bg: var(--bg);
            --ui-soft: #eef2f7;
            --ui-border: var(--br);
            --ui-ink: var(--ink);
            --ui-blue: var(--pri);
            --ui-chip: #4b5563;
            --ui-muted: var(--muted);
            --ui-chrome-top: #e5e7eb;
            --ui-chrome-bot: #d1d5db;
            --ui-input: #eef2f7;
            --ui-input-br: #cbd5f1;
            --ui-yellow: #fef9c3;
        }

        body {
            background: radial-gradient(circle at top left, #eef2ff 0, #f3f4f6 42%, #f9fafb 100%);
        }

        .wrap {
            max-width: 1800px;
            margin: 1rem auto 2.5rem;
            padding-inline: 1.25rem;
        }

        .chip {
            display: inline-block;
            padding: .32rem .75rem;
            border-radius: 999px;
            border: 1px solid var(--br);
            background: #fff;
            font-weight: 700;
            color: var(--ink);
            box-shadow: 0 6px 16px rgba(15, 23, 42, .06);
        }

        .panel {
            background: var(--card-bg);
            border: 1px solid var(--br);
            border-radius: 18px;
            padding: 1.25rem;
            box-shadow: 0 18px 40px rgba(15, 23, 42, .08);
        }

        .grid-main {
            display: grid;
            grid-template-columns: 1fr 1fr 320px;
            gap: 16px;
        }

        .col {
            border-radius: 16px;
            padding: .9rem .85rem;
            background: #fff;
            border: 1px solid rgba(148, 163, 184, .35);
            box-shadow: 0 3px 10px rgba(15, 23, 42, .04);
        }

        .rowline {
            display: grid;
            grid-template-columns: 180px 1fr;
            gap: .6rem;
            align-items: center;
            margin: .5rem 0;
            position: relative;
        }

        .label {
            color: #374151;
            font-size: .9rem;
            font-weight: 600;
        }

        .input {
            min-height: 38px;
            border: 1px solid var(--ui-input-br);
            border-radius: 14px;
            background: var(--ui-input);
            padding: .3rem .6rem;
            display: flex;
            align-items: center;
            gap: .5rem;
            position: relative;
            box-shadow: inset 0 1px 0 #fff, inset 0 -1px 0 #e4e7ec;
        }

        .input .fx {
            flex: 1 1 auto;
            border: none;
            background: transparent;
            outline: none;
            height: 28px;
            font-size: .95rem;
            color: var(--ink);
        }

        .input .fx::placeholder {
            color: #9ca3af;
        }

        .input .fx[type="date"] {
            height: 32px;
        }

        .input select.fx {
            height: 32px;
            background: transparent;
        }

        .divider {
            border-top: 1px dashed var(--br);
            margin: .9rem 0;
        }

        .avatar {
            border: 1px solid rgba(148, 163, 184, .6);
            border-radius: 14px;
            background: #f3f4f6;
            width: 100%;
            height: 280px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            box-shadow: 0 8px 22px rgba(15, 23, 42, .08);
        }

        .mini-btn {
            border: 1px solid #d1d5db;
            background: #fff;
            border-radius: 999px;
            padding: .22rem .7rem;
            font-weight: 600;
            line-height: 1;
            font-size: .8rem;
            color: #374151;
            transition: background-color .15s ease, box-shadow .15s ease, transform .12s ease;
        }

        .mini-btn:hover {
            background: #f3f4f6;
            box-shadow: 0 1px 4px rgba(15, 23, 42, .12);
            transform: translateY(-1px);
        }

        .mini-btn.disabled {
            opacity: .45;
            pointer-events: none;
        }

        .legacy-toolbar {
            top: 56px;
            background: linear-gradient(135deg, #ffffff, #f3f4ff);
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: .75rem 1.25rem;
            border-bottom: 1px solid var(--br);
            box-shadow: 0 10px 30px rgba(15, 23, 42, .08);
        }

        .legacy-title {
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

        .toolbar-actions {
            display: flex;
            gap: .45rem;
            flex-wrap: wrap;
        }

        .btn {
            padding: .45rem .9rem;
            border-radius: 999px;
            cursor: pointer;
            border: 1px solid transparent;
            font-weight: 600;
            font-size: .85rem;
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

        .btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 10px 26px rgba(15, 23, 42, .16);
        }

        .section {
            display: block;
        }

        .err {
            border-color: #ef4444 !important;
            box-shadow: 0 0 0 3px rgba(239, 68, 68, .08);
        }

        .err .fx {
            border: 1px solid #ef4444 !important;
            border-radius: 10px;
        }

        .rowline.has-err {
            padding-bottom: 18px;
        }

        .err-text {
            position: absolute;
            left: 12px;
            bottom: -18px;
            font-size: .78rem;
            color: #ef4444;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: calc(100% - 24px);
        }

        @media (max-width: 1280px) {
            .grid-main {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .legacy-toolbar {
                top: 0;
                border-radius: 0 0 16px 16px;
            }

            .wrap {
                padding-inline: .75rem;
            }

            .rowline {
                grid-template-columns: 1fr;
                align-items: flex-start;
            }
        }
    </style>

    <style>
        .input {
            position: relative;
            display: flex;
            align-items: center;
            gap: .5rem;
            min-height: 46px;
            background: #ffffff;
            border: 1px solid rgba(17, 24, 39, 0.08);
            border-radius: 16px;
            padding: .5rem .9rem;
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
            border-color: var(--ui-blue);
            background: #f9fbff;
            box-shadow: 0 0 0 4px rgba(17, 104, 230, 0.1),
                0 4px 10px rgba(17, 104, 230, 0.08);
            transform: translateY(-1px);
        }

        .fx {
            flex: 1 1 auto;
            border: none;
            outline: none;
            background: transparent;
            font-size: 1rem;
            color: #0f172a;
            font-weight: 500;
            transition: color .2s ease;
        }

        .fx::placeholder {
            color: #9ca3af;
            opacity: .8;
        }

        select.fx,
        input.fx[type="date"],
        input.fx[type="datetime-local"] {
            appearance: none;
            background: transparent;
            cursor: pointer;
            color-scheme: light;
        }

        .input:focus-within .fx {
            color: #0a58ca;
        }

        .input .mini-btn {
            border: 1px solid rgba(17, 104, 230, 0.15);
            background: #f8fafc;
            border-radius: 9999px;
            padding: .25rem .7rem;
            font-weight: 600;
            color: var(--ui-blue);
            font-size: .85rem;
            transition: all .25s ease;
        }

        .input .mini-btn:hover {
            background: var(--ui-blue);
            color: #fff;
            box-shadow: 0 4px 10px rgba(17, 104, 230, 0.25);
            transform: translateY(-1px);
        }
    </style>
@endpush

@section('main')
    <div class="legacy-toolbar">
        <div class="legacy-title">
            Add Learner–Delegate:
            <span class="legacy-badge">New</span>
        </div>
        <div class="toolbar-actions">
            <button class="btn btn-blue" type="submit" form="delegateForm" data-quit="0" id="btnSaveTop">
                <i class="bi bi-save"></i> Save
            </button>
            <button class="btn btn-gray d-none" type="button" id="btnCancelTop">Cancel</button>
        </div>
    </div>

    <section class="section" id="section-delegate-details">
        <div class="wrap">
            <form id="delegateForm" action="{{ route('crm.learner.delegates.update', ['id' => 0]) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="__save_quit" id="__save_quit" value="0">
                <input type="hidden" name="client_id" value="{{ $customerId }}">

                <div class="panel">
                    <div class="grid-main">
                        <div class="col">
                            <div class="rowline">
                                <div class="label">Name:</div>
                                <div class="input">
                                    <input class="fx" name="name" placeholder="First name">
                                    <input class="fx" name="middle_name" placeholder="Middle name (optional)">
                                    <input class="fx" name="last_name" placeholder="Last name">
                                </div>
                            </div>


                            <div class="rowline">
                                <div class="label">Unknown Delegate Name:</div>
                                <div class="input">
                                    <input class="fx" name="unknown_delegate_name"
                                        placeholder="If delegate not identified yet">
                                </div>
                            </div>

                            <div class="rowline">
                                <div class="label">House Number:</div>
                                <div class="input">
                                    <input class="fx" name="house_number" placeholder="e.g. 221B">
                                </div>
                            </div>

                            <div class="rowline">
                                <div class="label">House Name:</div>
                                <div class="input">
                                    <input class="fx" name="house_name" placeholder="e.g. Baker Street Residence">
                                </div>
                            </div>

                            <div class="rowline">
                                <div class="label">Address:</div>
                                <div class="input">
                                    <input class="fx" name="address" placeholder="Street address, area">
                                </div>
                            </div>

                            <div class="rowline">
                                <div class="label">Town:</div>
                                <div class="input">
                                    <input class="fx" name="town" placeholder="e.g. Birmingham">
                                </div>
                            </div>

                            <div class="rowline">
                                <div class="label">County:</div>
                                <div class="input">
                                    <input class="fx" name="county" placeholder="e.g. West Midlands">
                                </div>
                            </div>

                            <div class="rowline">
                                <div class="label">Post Code:</div>
                                <div class="input">
                                    <input class="fx" name="postal_code" placeholder="e.g. B1 1AA">
                                </div>
                            </div>

                            <div class="rowline">
                                <div class="label">Years at Address:</div>
                                <div class="input">
                                    <input class="fx" name="years_at_address" placeholder="e.g. 3 years">
                                </div>
                            </div>

                            <div class="divider"></div>

                            <div class="rowline">
                                <div class="label">Start Date:</div>
                                <div class="input">
                                    <input type="date" class="fx" name="start_date">
                                </div>
                            </div>

                            <div class="rowline">
                                <div class="label">VLE:</div>
                                <div class="input">
                                    <input class="fx" name="vle" placeholder="Virtual Learning Environment ID">
                                </div>
                            </div>

                            <div class="rowline">
                                <div class="label">External Login:</div>
                                <div class="input">
                                    <select class="fx" name="external_login">
                                        <option value="">Select…</option>
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                            </div>

                            <div class="rowline">
                                <div class="label">Exclude From Course Level Check:</div>
                                <div class="input">
                                    <select class="fx" name="exclude_from_level_check">
                                        <option value="">Select…</option>
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                            </div>

                            <div class="rowline">
                                <div class="label">Third Party Reference:</div>
                                <div class="input">
                                    <input class="fx" name="third_party_reference"
                                        placeholder="External system reference ID">
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="rowline">
                                <div class="label">Telephone:</div>
                                <div class="input">
                                    <input class="fx" name="telephone" placeholder="e.g. +44 20 7946 1234">
                                </div>
                            </div>

                            <div class="rowline">
                                <div class="label">Work Tel:</div>
                                <div class="input">
                                    <input class="fx" name="work_tel" placeholder="e.g. +44 20 7000 4321">
                                </div>
                            </div>

                            <div class="rowline">
                                <div class="label">Mobile:</div>
                                <div class="input">
                                    <input class="fx" name="mobile" placeholder="e.g. +44 77 1234 5678">
                                </div>
                            </div>

                            <div class="rowline">
                                <div class="label">Email:</div>
                                <div class="input">
                                    <input class="fx" name="email" type="email"
                                        placeholder="e.g. user@example.com">
                                </div>
                            </div>

                            <div class="rowline">
                                <div class="label">Work Email:</div>
                                <div class="input">
                                    <input class="fx" name="work_email" type="email"
                                        placeholder="e.g. firstname.lastname@company.com">
                                </div>
                            </div>

                            <div class="rowline">
                                <div class="label">Date of Birth:</div>
                                <div class="input">
                                    <input type="date" class="fx" name="dob">
                                </div>
                            </div>

                            <div class="rowline">
                                <div class="label">NI Number:</div>
                                <div class="input">
                                    <input class="fx" name="ni_number" placeholder="e.g. QQ 12 34 56 C">
                                </div>
                            </div>

                            <div class="rowline">
                                <div class="label">Payroll Reference:</div>
                                <div class="input">
                                    <input class="fx" name="payroll_reference"
                                        placeholder="Company payroll code or ID">
                                </div>
                            </div>

                            <div class="divider"></div>

                            <div class="rowline">
                                <div class="label">Job Type:</div>
                                <div class="input">
                                    <input class="fx" name="job_type" placeholder="e.g. Security Officer">
                                </div>
                            </div>

                            <div class="rowline">
                                <div class="label">Hours Worked:</div>
                                <div class="input">
                                    <input class="fx" name="hours_worked" placeholder="e.g. 40 hours/week">
                                </div>
                            </div>

                            <div class="rowline">
                                <div class="label">Nationality:</div>
                                <div class="input">
                                    <input class="fx" name="nationality" placeholder="e.g. British">
                                </div>
                            </div>

                            <div class="rowline">
                                <div class="label">Salutation:</div>
                                <div class="input">
                                    <input class="fx" name="salutation" placeholder="e.g. Mr / Ms / Dr">
                                </div>
                            </div>

                            <div class="rowline">
                                <div class="label">Job Title:</div>
                                <div class="input">
                                    <input class="fx" name="job_title" placeholder="e.g. Senior Trainer">
                                </div>
                            </div>
                        </div>

                        <div class="col" style="display:flex;flex-direction:column;align-items:center;gap:10px">
                            <div class="avatar" id="avatar_wrap">
                                <img id="avatar_img"
                                    src="https://mytraining4employment.co.uk/images/Staff_Photo_Default.png"
                                    alt="avatar" style="width:100%;height:100%;object-fit:cover">
                            </div>
                            <small class="text-muted">Delegate Code:
                                <strong id="side_code">Auto</strong>
                            </small>
                            <div class="input" style="width:100%;flex-wrap:wrap;gap:6px">
                                <label for="image" class="mini-btn" style="cursor:pointer">Upload</label>
                                <input type="file" id="image" name="image" accept="image/*" hidden>
                            </div>
                            <small class="text-muted" id="file_name" style="display:none;font-size:.8rem"></small>
                        </div>
                    </div>

                    <div class="divider"></div>

                    <div id="customerRow" class="rowline d-none">
                        <div class="label">Customer:</div>
                        <div class="input">
                            <select class="fx" name="client_id">
                                <option value="">Select Customer</option>
                                @foreach ($clients as $client)
                                    <option value="{{ $client->id }}"
                                        {{ isset($customerId) && $customerId == $client->id ? 'selected' : '' }}>
                                        {{ $client->name }} {{ $client->last_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="rowline">
                        <div class="label">Owner:</div>
                        <div class="input">
                            <input class="fx" name="owner_id" placeholder="Responsible staff member">
                        </div>
                    </div>

                    <div class="rowline">
                        <div class="label">Funder:</div>
                        <div class="input">
                            <input class="fx" name="funder" placeholder="e.g. Training Fund / Employer">
                        </div>
                    </div>

                    <div class="rowline">
                        <div class="label">Source:</div>
                        <div class="input">
                            <input class="fx" name="source" placeholder="e.g. Google Ads / Facebook / Referral">
                        </div>
                    </div>

                    <div class="rowline">
                        <div class="label">Staff Link:</div>
                        <div class="input">
                            <input class="fx" name="staff_link" placeholder="Internal staff code or referral link">
                        </div>
                    </div>

                    <div class="rowline" style="grid-template-columns:180px 1fr;">
                        <div class="label">Learner-Delegate Type:</div>
                        <div class="input">
                            <input class="fx" name="learner_delegate_type"
                                placeholder="e.g. Door Supervisor / First Aid">
                        </div>
                    </div>

                    <div class="rowline" style="grid-template-columns:180px 1fr;">
                        <div class="label">Notes:</div>
                        <div class="input" style="padding:0">
                            <textarea class="fx" name="notes" style="min-height:110px;resize:vertical"
                                placeholder="Add any additional details or comments about this delegate"></textarea>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </section>
@endsection

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(function() {
            $('#image').on('change', function() {
                const f = this.files[0];
                if (!f) return;
                $('#file_name').text(f.name).show();
                const r = new FileReader();
                r.onload = ev => $('#avatar_img').attr('src', ev.target.result);
                r.readAsDataURL(f);
            });

            function clearErrors() {
                $('.rowline.has-err').removeClass('has-err');
                $('.input.err').removeClass('err').each(function() {
                    $(this).find('.err-text').remove();
                });
            }

            function setFieldError(field, message) {
                var $fx = $('.fx[name="' + field + '"]');
                if (!$fx.length) return;
                var $wrap = $fx.closest('.input');
                var $row = $fx.closest('.rowline');
                $wrap.removeClass('err').find('.err-text').remove();
                $row.removeClass('has-err');
                if (message) {
                    $wrap.addClass('err').append('<div class="err-text">' + message + '</div>');
                    $row.addClass('has-err');
                }
            }

            function showErrors(errs) {
                Object.keys(errs || {}).forEach(function(field) {
                    var msg = (errs[field] && errs[field][0]) || 'Invalid';
                    var $fx = $('.fx[name="' + field + '"]');
                    if ($fx.length) {
                        var $wrap = $fx.closest('.input');
                        var $row = $fx.closest('.rowline');
                        $wrap.removeClass('err').find('.err-text').remove();
                        $wrap.addClass('err').append('<div class="err-text">' + msg + '</div>');
                        $row.addClass('has-err');
                    }
                });
                var $first = $('.input.err').first();
                if ($first.length) {
                    $('html,body').animate({
                        scrollTop: $first.offset().top - 140
                    }, 300);
                    $first.find('.fx').focus();
                }
            }

            function isEmail(v) {
                return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(String(v || '').trim());
            }

            function clientValidate() {
                var errs = {};
                var workEmail = $('.fx[name="work_email"]').val();
                var email = $('.fx[name="email"]').val();
                if (workEmail && !isEmail(workEmail)) errs.work_email = [
                    'The work email must be a valid email address.'
                ];
                if (email && !isEmail(email)) errs.email = ['The email must be a valid email address.'];
                var startDate = $('.fx[name="start_date"]').val();
                if (startDate && isNaN(Date.parse(startDate))) errs.start_date = ['The start date is invalid.'];
                var dob = $('.fx[name="dob"]').val();
                if (dob && isNaN(Date.parse(dob))) errs.dob = ['The date of birth is invalid.'];
                return errs;
            }

            $('#btnCancelTop').on('click', function() {
                window.history.back();
            });

            var uniqueFields = [
                'email',
                'work_email',
                'mobile',
                'ni_number',
                'payroll_reference',
                'third_party_reference'
            ];

            uniqueFields.forEach(function(field) {
                $(document).on('blur', '.fx[name="' + field + '"]', function() {
                    var value = $(this).val();
                    setFieldError(field, null);
                    if (!value) return;
                    $.ajax({
                        url: "{{ route('crm.learner.delegates.check-unique') }}",
                        method: 'POST',
                        data: {
                            field: field,
                            value: value,
                            id: 0,
                            _token: $('meta[name="csrf-token"]').attr('content') || ''
                        }
                    }).done(function(res) {
                        if (res && res.valid === false && res.message) {
                            setFieldError(field, res.message);
                        }
                    });
                });
            });

            $('#delegateForm').on('submit', function(e) {
                e.preventDefault();

                const $form = $(this);
                const fd = new FormData(this);

                Swal.fire({
                    title: 'Saving delegate…',
                    allowOutsideClick: false,
                    didOpen: () => Swal.showLoading()
                });

                $.ajax({
                    url: $form.attr('action'),
                    type: 'POST',
                    data: fd,
                    processData: false,
                    contentType: false
                })
                    .done(function(res) {
                        Swal.close();

                        if (!res || !res.success) {
                            const msg = (res && res.message) || 'Save failed';
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: msg
                            });
                            return;
                        }

                        Swal.fire({
                            icon: 'success',
                            title: res.message || 'Delegate saved',
                            timer: 1000,
                            showConfirmButton: false
                        });

                        const redirectUrl = res.redirect || window.location.href;
                        let secondsLeft = 5;

                        Swal.fire({
                            title: 'All done ✨',
                            html: `
                <div style="font-size:14px;color:#4b5563;line-height:1.4;">
                    Redirecting you to the delegate view…
                    <span id="delegateRedirectCountdown" style="font-weight:600;color:#111827;">
                        ${secondsLeft}s remaining…
                    </span>
                </div>
                <div style="
                    margin-top:16px;
                    background:#f1f5f9;
                    border-radius:8px;
                    padding:12px 14px;
                    font-size:12px;
                    color:#6b7280;
                    border:1px solid #e5e7eb;
                    text-align:left;
                ">
                    <div style="display:flex;align-items:center;gap:8px;">
                        <div style="
                            width:8px;
                            height:8px;
                            border-radius:999px;
                            background:#22c55e;
                            box-shadow:0 0 10px rgba(34,197,94,.8);
                            animation:pulseDot 1.2s infinite;
                        "></div>
                        <div>Opening the delegate detail screen for you…</div>
                    </div>
                </div>
                <style>
                    @keyframes pulseDot {
                        0%   { opacity:1; transform:scale(1);   }
                        50%  { opacity:.4; transform:scale(.6); }
                        100% { opacity:1; transform:scale(1);   }
                    }
                </style>
            `,
                            showConfirmButton: false,
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            customClass: {
                                popup: 'swal-modern-popup',
                                title: 'swal-modern-title'
                            },
                            didOpen: () => {
                                const $count = $('#delegateRedirectCountdown');
                                const intervalId = setInterval(() => {
                                    secondsLeft -= 1;
                                    if (secondsLeft <= 0) {
                                        clearInterval(intervalId);
                                    }
                                    if ($count.length) {
                                        $count.text(secondsLeft + 's remaining…');
                                    }
                                }, 1000);

                                setTimeout(() => {
                                    window.location.href = redirectUrl;
                                    Swal.close();
                                }, 5000);
                            }
                        });

                        if (!document.getElementById('swal-modern-style')) {
                            const style = document.createElement('style');
                            style.id = 'swal-modern-style';
                            style.textContent = `
                .swal-modern-popup {
                    border-radius: 16px !important;
                    padding: 24px 24px 20px !important;
                    box-shadow: 0 25px 50px -12px rgba(0,0,0,.45) !important;
                    border: 1px solid #e5e7eb !important;
                }
                .swal-modern-title {
                    font-size: 16px !important;
                    font-weight:600 !important;
                    color:#111827 !important;
                    margin-bottom:8px !important;
                }
            `;
                            document.head.appendChild(style);
                        }
                    })
                    .fail(function(xhr) {
                        Swal.close();

                        let title = 'Validation Error';
                        let html = 'Failed to save.';

                        if (xhr.status === 422 && xhr.responseJSON && xhr.responseJSON.errors) {
                            const errors = xhr.responseJSON.errors;
                            const items = [];

                            Object.keys(errors).forEach(function (field) {
                                errors[field].forEach(function (msg) {
                                    items.push('<li>' + msg + '</li>');
                                });
                            });

                            html = `
                <div style="text-align:left;font-size:14px;color:#4b5563;">
                    <p style="margin-bottom:6px;">Please fix the following:</p>
                    <ul style="padding-left:18px;margin:0;">
                        ${items.join('')}
                    </ul>
                </div>
            `;
                        } else if (xhr.responseJSON && xhr.responseJSON.message) {
                            html = xhr.responseJSON.message;
                        }

                        Swal.fire({
                            icon: 'error',
                            title: title,
                            html: html
                        });
                    });
            });

        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const row = document.getElementById('customerRow');
            const url = window.location.href;

            if (url.includes('/new')) {
                row.classList.remove('d-none');
            } else {
                row.classList.add('d-none');
            }
        });
    </script>
@endpush
