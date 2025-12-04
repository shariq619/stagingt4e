@extends('crm.layout.main')
@section('title', 'Delegates Details')

@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/datatables.net-bs5@1.13.10/css/dataTables.bootstrap5.min.css">
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
            max-width: 1440px;
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
            border: 1px dashed #d1d5db;
            border-radius: 16px;
            background: linear-gradient(180deg, #f9fafb, #ffffff);
            padding: 18px 18px 16px;
            box-shadow: 0 10px 24px rgba(15, 23, 42, .06);
            margin: 1.2rem;
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

        .hL {
            background: #fef9c3;
            border: 1px solid #eab308;
            border-radius: 12px;
            padding: .2rem .6rem;
            display: inline-block;
            font-size: .8rem;
            font-weight: 600;
            color: #92400e;
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

        .btn-green {
            background: linear-gradient(135deg, #32d27a, #16b45f);
            border-color: #10a357;
            color: #fff;
            box-shadow: 0 8px 20px rgba(16, 185, 129, .32);
        }

        .btn-red {
            background: linear-gradient(135deg, #ff6a76, #e14e59);
            border-color: #cc3e49;
            color: #fff;
            box-shadow: 0 8px 20px rgba(248, 113, 113, .32);
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

        .ip-bar>span {
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

        .section {
            display: none;
        }

        .section.active {
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

        .modal-body .form-control {
            border-radius: 12px;
        }

        .btn-chip {
            border-radius: 9999px;
            border: 1px solid #d1d5db;
            background: #fff;
            padding: .4rem .8rem;
            font-weight: 700;
            line-height: 1;
            font-size: .8rem;
        }


        .modal-header .btn#btnFooterImg {
            margin-right: 400px !important;
        }

        #mailComposeModal .modal-footer {
            position: sticky;
            bottom: 0;
            z-index: 1055;
            background: #f8f9fa;
            border-top: 1px solid #dee2e6;
        }

        #mailComposeModal .modal-body {
            max-height: calc(100vh - 220px);
            overflow-y: auto;
        }

        #footerUrlPreview img {
            border-radius: 10px;
            box-shadow: 0 6px 18px rgba(15, 23, 42, .18);
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

            .mega-tabs {
                top: 64px;
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
            Learner–Delegate:
            <span class="legacy-badge" id="badge_code">-</span>
        </div>
        <div class="toolbar-actions">
            <button class="d-none btn btn-blue d-none" type="submit" form="delegateForm" data-quit="1"
                id="btnSaveQuitTop">
                Save &amp; Quit
            </button>
            <button class="btn btn-blue" type="submit" form="delegateForm" data-quit="0" id="btnSaveTop">
                <i class="bi bi-save"></i> Save Changes
            </button>
            <button class="d-none btn btn-gray d-none" type="button" id="btnCancelTop">Cancel</button>
            <button class="d-none btn btn-red d-none" type="button" id="btnDeleteTop">Delete</button>
        </div>
    </div>

    <nav class="mega-tabs">
        <div class="mega-inner">
            <div class="tab-spacer"></div>
            <div class="tabs-label">Sections</div>
            <div class="tab-row" id="secondaryTabs">
                <a href="#" class="tab secondary" data-tab="delegate-details">Delegate Details</a>
                <a href="#" class="tab secondary" data-tab="delegate-courses">Training Courses</a>
                <a href="#" class="tab secondary" data-tab="delegate-correspondences">Correspondence</a>
            </div>
        </div>
    </nav>


    <div id="delegate-page" data-id="{{ $delegate->id ?? request()->route('id') }}"
        data-json-url="{{ route('crm.learner.delegates.show.json', $delegate->id ?? request()->route('id')) }}">
    </div>

    <section class=" py-3 section active" id="section-delegate-details">
        @include('crm.learner_delegates.partials.details')
    </section>

    <section class="section" id="section-delegate-courses">
        <div class="ip-wrap">
            <div class="ip-card">
                <div class="ip-top">
                    <div class="ip-icon">T</div>
                    <div>
                        <div class="ip-title">Training Courses</div>
                        <div class="ip-text">View and manage the learner’s enrolled courses, attendance, and progress
                            details.
                        </div>
                    </div>
                </div>

                <div class="ip-body mt-3">
                    @include('crm.learner_delegates.partials.delegate_courses')
                </div>
            </div>
        </div>
    </section>

    <section class="section" id="section-delegate-correspondences">
        <div class="ip-wrap">
            <div class="ip-card">
                <div class="ip-top">
                    <div class="ip-icon">C</div>
                    <div>
                        <div class="ip-title">Correspondence | {{ $delegate->name }}</div>
                        <div class="ip-text">Review and manage all communications related to this delegate.</div>
                    </div>
                </div>

                <div class="ip-body mt-3">
                    @include('crm.learner_delegates.partials.delegate_correspondence')
                </div>
            </div>
        </div>
    </section>


    {{-- Compose Email Modal --}}
    <div class="modal fade" id="mailComposeModal" tabindex="-1" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content border-0 shadow-lg" style="border-radius:18px;">

                <form id="mailComposeForm" method="POST">
                    @csrf
                    <div class="modal-header bg-white border-0 d-flex align-items-center">
                        <div class="d-flex align-items-center gap-2">
                            <h5 class="modal-title fw-bold d-flex align-items-center mb-0">
                                <i class="bi bi-envelope-paper text-primary me-2"></i> Compose Email
                            </h5>
                            <button type="button"
                                class="btn btn-sm d-flex align-items-center px-3 py-2 border rounded-pill" id="btnFooterImg"
                                style="background:#f8f9fa;">
                                <i class="bi bi-image me-2 text-secondary"></i>
                                <span class="fw-semibold">Footer Image</span>
                            </button>
                        </div>

                        <div class="flex-grow-1"></div>
                        <button type="button" class="btn-close ms-2" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body px-4 pt-2 pb-3">
                        <div class="form-group mb-3">
                            <label class="fw-semibold mb-1">To</label>
                            <input type="email" id="mail_to" name="to" class="form-control"
                                placeholder="Recipient email" autocomplete="off" required>
                        </div>

                        <div class="form-group mb-3">
                            <label class="fw-semibold mb-1">Subject</label>
                            <input type="text" id="mail_subject" name="subject" class="form-control"
                                placeholder="Email subject" autocomplete="off" required>
                        </div>

                        <textarea id="mail_editor_area" name="html_body"></textarea>
                    </div>

                    <div
                        class="modal-footer border-0 bg-light d-flex justify-content-between align-items-center px-4 py-3">
                        <span class="text-muted small" id="sendStatus"></span>
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-outline-secondary d-flex align-items-center px-3"
                                data-bs-dismiss="modal">
                                <i class="bi bi-x-circle me-2"></i> Close
                            </button>
                            <button type="button" class="btn btn-success d-flex align-items-center px-3"
                                id="btnSendMail">
                                <i class="bi bi-send-fill me-2"></i> Send
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

    {{-- Footer URL modal --}}
    <div class="modal fade" id="footerUrlModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" style="border-radius:14px;">
                <div class="modal-header">
                    <h5 class="modal-title">Footer image URL</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label for="footerUrlInput" class="sr-only">Image URL</label>
                    <input type="url" class="form-control" id="footerUrlInput"
                        placeholder="https://example.com/footer.png" autocomplete="off">
                    <div class="invalid-feedback">Enter a valid http(s) URL.</div>

                    <div id="footerUrlPreview" class="mt-2" style="display:none;"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="footerUrlInsertBtn">
                        <i class="bi bi-image"></i>&nbsp;Insert
                    </button>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/tinymce@5.10.9/tinymce.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/datatables.net@1.13.10/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/datatables.net-bs5@1.13.10/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(function() {

            function toggleSaveButtonsForTab(tab) {
                if (tab === 'delegate-details') {
                    $('#btnSaveTop').removeClass('d-none');
                } else {
                    $('#btnSaveTop').addClass('d-none');
                }
            }

            function toYMD(v) {
                if (!v) return '';
                if (/^\d{4}-\d{2}-\d{2}/.test(v)) return v.slice(0, 10);
                const m = String(v).match(/^(\d{2})-(\d{2})-(\d{4})$/);
                if (m) return `${m[3]}-${m[2]}-${m[1]}`;
                const d = new Date(v);
                if (isNaN(d)) return '';
                const p = n => String(n).padStart(2, '0');
                return `${d.getFullYear()}-${p(d.getMonth() + 1)}-${p(d.getDate())}`;
            }

            function fmtNice(dt) {
                if (!dt) return '';
                try {
                    const d = new Date(dt);
                    const p = n => String(n).padStart(2, '0');
                    return `${p(d.getDate())}-${p(d.getMonth() + 1)}-${d.getFullYear()} ${p(d.getHours())}:${p(d.getMinutes())}`;
                } catch {
                    return '';
                }
            }

            function fill(field, val) {
                const $el = $('.fx[data-f="' + field + '"]');
                if (!$el.length) return;
                if ($el.is('input[type="date"]') || $el.hasClass('datepick')) {
                    $el.val(toYMD(val)).trigger('change');
                } else if ($el.is('select')) {
                    if (val === true || val === '1' || val === 1) $el.val('1');
                    else if (val === false || val === '0' || val === 0) $el.val('0');
                    else $el.val('');
                } else {
                    $el.val(val ? String(val) : '');
                }
            }

            $('#image').on('change', function() {
                const f = this.files[0];
                if (!f) return;
                $('#file_name').text(f.name).show();
                const r = new FileReader();
                r.onload = ev => $('#avatar_img').attr('src', ev.target.result);
                r.readAsDataURL(f);
            });

            function setQueryParam(k, v) {
                const u = new URL(window.location);
                u.searchParams.set(k, v);
                window.history.replaceState(null, '', u.toString());
            }

            function getParam(k) {
                return new URLSearchParams(window.location.search).get(k);
            }

            const defaultTab = 'delegate-details';
            const activeTab = (getParam('tab') || defaultTab).toLowerCase();
            $('[data-tab="' + activeTab + '"]').addClass('active');
            $('.section').removeClass('active');
            $('#section-' + activeTab).addClass('active');
            toggleSaveButtonsForTab(activeTab);


            let courseTable = null;
            let corrTable = null;

            $('.mega-tabs .tab').on('click', function(e) {
                e.preventDefault();
                const tab = $(this).data('tab');

                $('.mega-tabs .tab').removeClass('active');
                $(this).addClass('active');
                $('.section').removeClass('active');
                $('#section-' + tab).addClass('active');

                toggleSaveButtonsForTab(tab);

                if (tab === 'delegate-courses') {
                    initCourseTable();
                }

                if (tab === 'delegate-correspondences') {
                    initCorrespondenceTable();
                }

                setQueryParam('tab', tab);
            });



            $('input.fx[data-f="email"]').attr({
                type: 'email',
                readonly: true
            });
            $('input.fx[data-f="work_email"]').attr('type', 'email');

            function initPicker($i) {
                if (!$i.length) return;
                $i.attr('type', 'text').addClass('datepick');
                const v = $i.val();
                $i.daterangepicker({
                    singleDatePicker: true,
                    showDropdowns: true,
                    autoApply: false,
                    autoUpdateInput: true,
                    locale: {
                        format: 'YYYY-MM-DD'
                    }
                });
                if (v) {
                    const iso = toYMD(v);
                    $i.data('daterangepicker').setStartDate(iso);
                    $i.data('daterangepicker').setEndDate(iso);
                    $i.val(iso);
                }
            }

            initPicker($('input.fx[name="start_date"]'));
            initPicker($('input.fx[name="dob"]'));
            $(document).on('apply.daterangepicker', 'input.fx[name="start_date"], input.fx[name="dob"]', function(e,
                picker) {
                const v = picker.startDate.format('YYYY-MM-DD');
                $(this).val(v).trigger('change');
            });

            const jsonUrl = $('#delegate-page').data('json-url');

            $.ajax({
                url: jsonUrl,
                dataType: 'json',
            }).done(function(res) {
                var d = res.delegate || {};
                d.created_at = fmtNice(d.created_at);
                fill('name', d.name);
                fill('middle_name', d.middle_name);
                fill('last_name', d.last_name);
                fill('unknown_delegate_name', d.unknown_delegate_name);
                fill('house_number', d.house_number);
                fill('house_name', d.house_name);
                fill('address', d.address);
                fill('town', d.town);
                fill('county', d.county);
                fill('postal_code_normalized', d.postal_code_normalized);
                fill('years_at_address', d.years_at_address);
                fill('start_date', d.start_date);
                fill('vle', d.vle);
                $('select[name="client_id"]').val(d.client_id);
                fill('external_login', d.external_login);
                fill('exclude_from_level_check', d.exclude_from_level_check);
                fill('third_party_reference', d.third_party_reference);
                fill('created_at', d.created_at);
                $('[data-bind="status"]').text(d.status ? d.status : '-');
                fill('old_reference', d.old_reference);
                fill('telephone', d.telephone);
                fill('work_tel', d.work_tel);
                fill('mobile', d.mobile);
                fill('email', d.email);
                fill('work_email', d.work_email);
                fill('dob', d.dob || d.birth_date);
                fill('ni_number', d.ni_number);
                fill('payroll_reference', d.payroll_reference);
                fill('job_type', d.job_type);
                fill('hours_worked', d.hours_worked);
                fill('nationality', d.nationality);
                fill('salutation', d.salutation);
                fill('job_title', d.job_title);
                fill('customer_id', d.customer_id);
                fill('owner_id', d.owner_id);
                fill('funder', d.funder);
                fill('source', d.source);
                fill('staff_link', d.staff_link);
                fill('learner_delegate_type', d.learner_delegate_type);
                fill('notes', d.notes);
                const code = 'D' + String(d.id || 0).padStart(6, '0');
                $('#chip_code,#badge_code,#side_code').text(code);
                var avatar = d.image && String(d.image).trim() !== '' ? d.image :
                    'https://mytraining4employment.co.uk/images/Staff_Photo_Default.png';
                if (avatar && !/^https?:\/\//i.test(avatar)) {
                    avatar = (window.APP_URL || '') + '/' + avatar.replace(/^\/+/, '');
                }
                $('#avatar_img').attr('src', avatar);
                const s = toYMD(d.start_date);
                if (s) {
                    $('input.fx[name="start_date"]').data('daterangepicker').setStartDate(s);
                    $('input.fx[name="start_date"]').data('daterangepicker').setEndDate(s);
                    $('input.fx[name="start_date"]').val(s);
                }
                const b = toYMD(d.dob || d.birth_date);
                if (b) {
                    $('input.fx[name="dob"]').data('daterangepicker').setStartDate(b);
                    $('input.fx[name="dob"]').data('daterangepicker').setEndDate(b);
                    $('input.fx[name="dob"]').val(b);
                }
                linkify();
            });

            function linkify() {
                $('[data-mail]').each(function() {
                    const k = $(this).data('mail'),
                        v = $('.fx[data-f="' + k + '"]').val();
                    $(this).toggleClass('disabled', !v).attr('href', v ? 'mailto:' + v : '#');
                });
                $('[data-call]').each(function() {
                    const k = $(this).data('call'),
                        v = $('.fx[data-f="' + k + '"]').val();
                    $(this).toggleClass('disabled', !v).attr('href', v ? 'tel:' + v : '#');
                });
                $('[data-sms]').each(function() {
                    const k = $(this).data('sms'),
                        v = $('.fx[data-f="' + k + '"]').val();
                    $(this).toggleClass('disabled', !v).attr('href', v ? 'sms:' + v : '#');
                });
            }

            function clearErrors() {
                $('.rowline.has-err').removeClass('has-err');
                $('.input.err').removeClass('err').each(function() {
                    $(this).find('.err-text').remove();
                });
                $('.err-text').remove();
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

            $(document).on('blur change',
                '.fx[name="work_email"],.fx[name="email"],.fx[name="start_date"],.fx[name="dob"]',
                function() {
                    clearErrors();
                    var errs = clientValidate();
                    if (Object.keys(errs).length) showErrors(errs);
                });

            $('#btnSaveTop,#btnSaveQuitTop').on('click', function() {
                $('#__save_quit').val($(this).data('quit') ? '1' : '0');
            });

            $('#btnCancelTop').on('click', function(e) {
                e.preventDefault();
                window.location.reload();
            });

            $('#delegateForm').on('submit', function(e) {
                e.preventDefault();
                clearErrors();
                var errs = clientValidate();
                if (Object.keys(errs).length) {
                    showErrors(errs);
                    return;
                }
                var $saveBtns = $('#btnSaveTop,#btnSaveQuitTop').prop('disabled', true);
                var fd = new FormData(this);
                $.ajax({
                        url: this.action,
                        method: 'POST',
                        data: fd,
                        processData: false,
                        contentType: false,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') || ''
                        }
                    })
                    .done(() => {
                        Swal.fire({
                            icon: 'success',
                            title: 'Saved Successfully',
                            text: 'Learner–Delegate details have been updated.',
                            showConfirmButton: false,
                            timer: 1500,
                            toast: true,
                            position: 'top-end'
                        });
                        if ($('#__save_quit').val() === '1') setTimeout(() => window.history.back(),
                            1500);
                    })
                    .fail(function(xhr) {
                        if (xhr.status === 422 && xhr.responseJSON && xhr.responseJSON.errors) {
                            showErrors(xhr.responseJSON.errors);
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Update Failed',
                                text: (xhr.responseJSON && xhr.responseJSON.message) ||
                                    'Something went wrong while saving.',
                                confirmButtonColor: '#2563eb'
                            });
                        }
                    })
                    .always(() => {
                        $saveBtns.prop('disabled', false);
                        $('#__save_quit').val('0');
                    });
            });

            $(document).on('input change', '.fx', linkify);

            var composeEd = null;

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
                    setup: function(ed) {
                        ed.on('init', function() {
                            composeEd = ed;
                        });
                    },
                    content_style: 'body{font-family:system-ui,-apple-system,Segoe UI,Roboto,Helvetica,Arial,sans-serif;font-size:14px;}'
                });
            }

            function openCompose(toEmail) {
                $('#mail_to').val(toEmail || '');
                $('#mail_subject').val('');
                initComposeOnce();
                $('#mailComposeModal').modal('show');
                setTimeout(function() {
                    if (composeEd) composeEd.focus();
                }, 150);
            }

            function insertFooterImage(url) {
                if (!composeEd || !url) return;
                var cur = composeEd.getContent() || '';
                var foot = '<p style="margin-top:24px;text-align:center;"><img src="' + url +
                    '" style="max-width:100%;border-radius:8px" /></p>';
                composeEd.setContent(cur + foot);
            }

            $(document).on('click', '[data-mail]', function(e) {
                e.preventDefault();
                if ($(this).hasClass('disabled')) return;
                var key = $(this).data('mail');
                var v = $('.fx[data-f="' + key + '"]').val();
                openCompose(v || '');
            });

            $('#btnFooterImg').on('click', function() {
                $('#footerUrlInput').val('');
                $('#footerUrlPreview').hide().empty();
                $('#footerUrlInput').removeClass('is-invalid');
                $('#footerUrlModal').modal('show');
                setTimeout(function() {
                    $('#footerUrlInput').trigger('focus');
                }, 150);
            });

            function isHttpUrl(u) {
                return /^https?:\/\//i.test((u || '').trim());
            }

            $('#footerUrlInput').on('input', function() {
                var v = ($(this).val() || '').trim();
                if (isHttpUrl(v)) {
                    $(this).removeClass('is-invalid');
                    $('#footerUrlPreview').show().html('<img src="' + v + '" class="img-fluid rounded">');
                } else {
                    $(this).addClass('is-invalid');
                    $('#footerUrlPreview').hide().empty();
                }
            });

            $('#footerUrlInsertBtn').on('click', function() {
                var v = ($('#footerUrlInput').val() || '').trim();
                if (!isHttpUrl(v)) {
                    $('#footerUrlInput').addClass('is-invalid').focus();
                    return;
                }
                if (typeof insertFooterImage === 'function') insertFooterImage(v);
                $('#footerUrlModal').modal('hide');
            });

            function postSend() {
                var to = ($('#mail_to').val() || '').trim();
                var sub = ($('#mail_subject').val() || '').trim();
                var body = composeEd ? (composeEd.getContent() || '') : '';

                if (!to) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Enter recipient email'
                    });
                    return;
                }
                if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(to)) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Invalid email'
                    });
                    return;
                }
                if (!body.replace(/<[^>]*>/g, '').replace(/&nbsp;/g, '').trim()) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Body is required'
                    });
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
                            to: to,
                            subject: sub,
                            html_body: body
                        }
                    })
                    .done(function() {
                        $('#sendStatus').text('Sent');

                        Swal.fire({
                            icon: 'success',
                            title: 'Email sent successfully!',
                            showConfirmButton: false,
                            timer: 2000,
                            timerProgressBar: true
                        });

                        setTimeout(function() {
                            $('#mailComposeModal').modal('hide');
                            $('#sendStatus').text('');
                            $('#mail_subject').val('');
                            if (composeEd) composeEd.setContent('');
                        }, 2000);
                    })
                    .fail(function(xhr) {
                        var msg = (xhr.responseJSON && (xhr.responseJSON.message ||
                                (xhr.responseJSON.errors && Object.values(xhr.responseJSON.errors)[0][0]))) ||
                            'Send failed';
                        Swal.fire({
                            icon: 'error',
                            title: msg
                        });
                        $('#sendStatus').text('');
                    })
                    .always(function() {
                        $('#btnSendMail').prop('disabled', false);
                    });
            }

            $('#btnSendMail').off('click').on('click', postSend);
            $('#mailComposeModal').on('hidden.bs.modal', function() {
                $('#mail_subject').val('');
                $('#sendStatus').text('');
            });

            function initCourseTable() {
                if (courseTable) {
                    courseTable.columns.adjust().draw(false);
                    return;
                }

                const COURSE_DT_URL =
                    "{{ route('crm.learner.delegates.courses.dt', $delegate->id ?? request()->route('id')) }}";

                courseTable = $('#delegateCoursesTable').DataTable({
                    processing: true,
                    serverSide: true,
                    scrollX: true,
                    autoWidth: false,
                    lengthChange: false,
                    ajax: {
                        url: COURSE_DT_URL,
                        data: function(d) {}
                    },
                    order: [
                        [2, 'asc']
                    ],
                    columns: [{
                            data: 'course_code',
                            name: 'course_code'
                        },
                        {
                            data: 'course_description',
                            name: 'course_description'
                        },
                        {
                            data: 'course_date',
                            name: 'course_date'
                        },
                        {
                            data: 'course_status',
                            name: 'course_status'
                        },
                        {
                            data: 'default_customer',
                            name: 'default_customer'
                        }
                    ],
                    initComplete: function() {
                        const api = this.api();
                        setTimeout(function() {
                            api.columns.adjust().draw(false);
                        }, 50);
                    },
                    drawCallback: function() {
                        this.api().columns.adjust();
                    }
                });

                $(window).on('resize', function() {
                    if (courseTable) {
                        courseTable.columns.adjust().draw(false);
                    }
                });
            }

            function initCorrespondenceTable() {

                if (corrTable) {
                    corrTable.columns.adjust().draw(false);
                    return;
                }
                const CORR_DT_URL =
                    "{{ route('crm.learner.delegates.correspondence.dt', $delegate->id ?? request()->route('id')) }}";

                corrTable = $('#delegateCorrespondenceTable').DataTable({
                    processing: true,
                    serverSide: true,
                    scrollX: true,
                    autoWidth: false,
                    lengthChange: false,
                    ajax: {
                        url: CORR_DT_URL,
                        data: function(d) {}
                    },
                    order: [
                        [0, 'asc']
                    ],
                    columns: [{
                            data: 'date',
                            name: 'date'
                        },
                        {
                            data: 'letter_code',
                            name: 'letter_code'
                        },
                        {
                            data: 'letter_name',
                            name: 'letter_name'
                        },
                        {
                            data: 'course',
                            name: 'course'
                        },
                        {
                            data: 'description',
                            name: 'description'
                        },
                        {
                            data: 'type',
                            name: 'type'
                        },
                        {
                            data: 'user_name',
                            name: 'user_name'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        },
                    ],
                    initComplete: function() {
                        const api = this.api();
                        setTimeout(function() {
                            api.columns.adjust().draw(false);
                        }, 50);
                    },
                    drawCallback: function() {
                        this.api().columns.adjust();
                    }
                });
                $(window).on('resize', function() {
                    if (corrTable) {
                        corrTable.columns.adjust().draw(false);
                    }
                });
            }

            if (activeTab === 'delegate-courses') {
                initCourseTable();
            } else if (activeTab === 'delegate-correspondences') {
                initCorrespondenceTable();
            }

        });
    </script>
@endpush
