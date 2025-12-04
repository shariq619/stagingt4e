@extends('crm.layout.main')
@section('title', 'Email -Update')

@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-bootstrap-4/bootstrap-4.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@1.5.2/dist/select2-bootstrap4.min.css">
    <style>
        body {
            background: #f3f4f6;
            color: #1f2937;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            font-size: 14px;
            line-height: 1.4
        }

        .page-inner {
            padding: 24px 0 48px
        }

        .composer-shell {
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 16px;
            box-shadow: 0 24px 48px -8px rgba(0, 0, 0, .2);
            overflow: hidden
        }

        .composer-head {
            background: linear-gradient(to right, #ffffff 0%, #f9fafb 60%);
            border-bottom: 1px solid #e5e7eb;
            padding: 12px 16px;
            display: flex;
            flex-wrap: wrap;
            gap: 8px
        }

        .composer-head .btn-top {
            font-size: 12px;
            font-weight: 600;
            line-height: 1.2;
            border-radius: 9999px;
            border: 1px solid #d1d5db;
            background: #fff;
            padding: .45rem .8rem;
            box-shadow: 0 4px 10px rgba(0, 0, 0, .05);
            cursor: pointer
        }

        .btn-top.primary {
            background: #1168e6;
            border-color: #1168e6;
            color: #fff;
            box-shadow: 0 10px 20px rgba(17, 104, 230, .4)
        }

        .composer-body {
            padding: 16px;
            background: #fff
        }

        .row-field {
            display: flex;
            align-items: flex-start;
            padding: 6px 0;
            border-bottom: 1px solid #f1f2f5
        }

        .row-field .label-col {
            flex: 0 0 140px;
            font-size: 12px;
            font-weight: 600;
            color: #374151;
            line-height: 28px
        }

        .row-field .value-col {
            flex: 1 1 auto
        }

        .inline-input {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 6px
        }

        .inline-input .form-control {
            font-size: 13px;
            line-height: 1.4;
            border-radius: 8px;
            border: 1px solid #d1d5db;
            color: #1f2937;
            padding: 6px 10px;
            height: 32px;
            min-width: 240px
        }

        .inline-input .form-control:focus {
            outline: none;
            border-color: #1168e6;
            box-shadow: 0 0 0 3px rgba(17, 104, 230, .15)
        }

        .pill-input-area {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 6px;
            min-height: 32px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            padding: 4px 8px;
            cursor: text;
            background: #fff
        }

        .pill-input-area.invalid {
            border-color: #dc2626;
            box-shadow: 0 0 0 3px rgba(220, 38, 38, .15)
        }

        .field-error-help {
            font-size: 12px;
            color: #dc2626;
            line-height: 1.4;
            font-weight: 500;
            margin-top: 4px
        }

        .recipient-pill {
            background: #eef2ff;
            border: 1px solid #c7d2fe;
            border-radius: 9999px;
            font-size: 12px;
            font-weight: 600;
            line-height: 1.2;
            padding: .35rem .6rem;
            color: #4338ca;
            display: flex;
            align-items: center;
            gap: 4px
        }

        .pill-close {
            font-size: 11px;
            line-height: 1;
            color: #4b5563;
            cursor: pointer
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

        .attachments-bar {
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 8px 12px;
            font-size: 12px;
            line-height: 1.4;
            color: #374151;
            margin-top: 6px
        }

        .attach-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 4px 0;
            border-bottom: 1px solid #edf1f5
        }

        .attach-row:last-child {
            border-bottom: 0
        }

        .attach-name {
            font-weight: 600;
            color: #1f2937;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 70vw
        }

        .attach-meta {
            font-size: 12px;
            color: #6b7280
        }

        .attach-del {
            font-size: 12px;
            font-weight: 600;
            cursor: pointer
        }

        .sec-title {
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            color: #4b5563;
            letter-spacing: .03em;
            margin-top: 20px;
            margin-bottom: 8px
        }

        .editor-wrapper {
            border: 1px solid #d1d5db;
            border-radius: 10px;
            overflow: hidden;
            margin-top: 12px;
            display: flex;
            flex-direction: column
        }

        .editor-toolbar-strip {
            background: #f9fafb;
            border-bottom: 1px solid #e5e7eb;
            padding: 8px 12px;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 8px;
            font-size: 12px;
            font-weight: 600;
            color: #4b5563
        }

        .editor-toolbar-left {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 8px
        }

        .editor-toolbar-right {
            margin-left: auto;
            position: relative;
            display: flex;
            align-items: center;
            gap: 8px
        }

        .bulk-insert-wrap {
            position: relative
        }

        .bulk-btn {
            font-size: 11px;
            border-radius: 6px;
            border: 1px solid #d1d5db;
            background: #fff;
            line-height: 1.2;
            padding: .3rem .5rem;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 4px
        }

        .bulk-btn .caret {
            font-size: 10px;
            line-height: 1;
            color: #6b7280
        }

        .bulk-menu {
            position: absolute;
            right: 0;
            top: calc(100% + 4px);
            min-width: 220px;
            background: #fff;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, .15);
            padding: 6px 0;
            display: none;
            z-index: 9999
        }

        .bulk-menu.open {
            display: block
        }

        .bulk-menu-btn {
            width: 100%;
            background: transparent;
            border: 0;
            outline: 0;
            text-align: left;
            padding: .6rem .75rem;
            font-size: 12px;
            line-height: 1.3;
            color: #1f2937;
            font-weight: 500;
            cursor: pointer;
            display: flex;
            flex-direction: column
        }

        .bulk-menu-btn:hover {
            background: #f3f4f6
        }

        .bulk-menu-btn .small-hint {
            font-size: 11px;
            line-height: 1.3;
            color: #6b7280;
            font-weight: 400
        }

        #tpl_var_insert {
            width: 400px;
            font-size: 13px;
            height: 36px;
            border-radius: 10px;
            border: 1px solid #d1d5db;
            padding: 6px 10px;
            box-sizing: border-box;
            color: #1f2937;
            background: linear-gradient(to right, #ffffff, #f9fafb);
            transition: all .2s ease-in-out;
            box-shadow: 0 1px 2px rgba(0, 0, 0, .04);
        }

        #tpl_var_insert:focus,
        #tpl_var_insert.select2-container--focus .select2-selection {
            border-color: #2563eb !important;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, .2);
            background: #fff;
        }

        .select2-container--bootstrap4 .select2-selection--single {
            height: 36px !important;
            border: 1px solid #d1d5db !important;
            border-radius: 10px !important;
            display: flex !important;
            align-items: center;
            padding-left: 10px;
            transition: all .2s ease-in-out;
            background: linear-gradient(to right, #ffffff, #f9fafb);
        }


        .select2-container--bootstrap4.select2-container--focus .select2-selection--single {
            border-color: #2563eb !important;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, .2);
            background: #fff;
        }

        .select2-container--bootstrap4 .select2-results__option--highlighted {
            background-color: #2563eb !important;
            color: #fff !important;
        }

        .select2-container--bootstrap4 .select2-results__option {
            font-size: 13px;
            padding: 6px 10px;
            border-radius: 6px;
        }

        .select2-dropdown {
            border: 1px solid #d1d5db !important;
            border-radius: 10px !important;
            box-shadow: 0 6px 20px rgba(0, 0, 0, .08) !important;
        }

        .editor-area {
            min-height: 320px;
            background: #fff;
            padding: 0
        }

        .plain-text-area {
            margin-top: 12px
        }

        .plain-text-area textarea {
            width: 100%;
            min-height: 120px;
            resize: vertical;
            border-radius: 8px;
            border: 1px solid #d1d5db;
            font-size: 13px;
            line-height: 1.4;
            padding: 8px 10px;
            color: #1f2937
        }

        .plain-text-area textarea:focus {
            outline: none;
            border-color: #1168e6;
            box-shadow: 0 0 0 3px rgba(17, 104, 230, .15)
        }

        .layout-wrapper-grid {
            display: flex;
            flex-wrap: wrap;
            margin: 0 -8px
        }

        .layout-wrapper-grid .layout-col {
            flex: 0 0 100%;
            max-width: 100%;
            padding: 8px;
            box-sizing: border-box
        }

        @media (min-width: 768px) {
            .layout-wrapper-grid .layout-col {
                flex: 0 0 50%;
                max-width: 50%
            }
        }

        .layout-label {
            font-size: 12px;
            font-weight: 600;
            color: #374151;
            line-height: 1.3;
            margin-bottom: 4px;
            display: block
        }

        .layout-textarea {
            width: 100%;
            min-height: 160px;
            border-radius: 8px;
            border: 1px solid #d1d5db;
            font-family: ui-monospace, SFMono-Regular, Menlo, Consolas, monospace;
            font-size: 12px;
            line-height: 1.4;
            white-space: pre-wrap;
            padding: 8px 10px;
            color: #1f2937;
            resize: vertical
        }

        .layout-hint {
            font-size: 11px;
            color: #6b7280;
            line-height: 1.4;
            margin-top: 4px
        }

        .layout-hint code {
            font-size: 11px;
            background: #f3f4f6;
            border: 1px solid #d1d5db;
            border-radius: 4px;
            padding: 1px 4px;
            display: inline-block;
            color: #1f2937
        }

        .var-guide-group {
            margin-top: 16px;
            border-top: 1px solid #e5e7eb;
            padding-top: 12px;
        }

        .var-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            padding: 8px 12px;
            margin-bottom: 8px;
        }

        .var-row:hover {
            background: #f3f4f6;
            border-color: #cbd5e1;
        }

        .var-code {
            font-size: 12px;
            font-weight: 700;
            color: #2563eb;
        }

        .var-desc {
            flex: 1;
            margin-left: 10px;
            font-size: 12px;
            color: #4b5563;
        }

        .var-actions {
            display: flex;
            gap: 8px;
        }

        .vg-btn {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            font-size: 12px;
            padding: 6px 10px;
            border-radius: 8px;
            cursor: pointer;
            line-height: 1.2;
            transition: .15s ease-in-out;
            user-select: none;
        }

        .vg-copy {
            background: #fff;
            border: 1px solid #d1d5db;
            color: #111827;
            box-shadow: 0 1px 1px rgba(0, 0, 0, .04);
        }

        .vg-copy:hover {
            background: #f8fafc;
            border-color: #cbd5e1;
        }

        .vg-copy.copied {
            background: #16a34a;
            border-color: #16a34a;
            color: #fff;
        }

        .vg-insert {
            background: #2563eb;
            border: 1px solid #2563eb;
            color: #fff;
            box-shadow: 0 2px 8px rgba(37, 99, 235, .25);
        }

        .vg-insert:hover {
            filter: brightness(0.95);
            box-shadow: 0 3px 10px rgba(37, 99, 235, .3);
        }

        .vg-insert:active {
            transform: translateY(1px);
            box-shadow: 0 1px 6px rgba(37, 99, 235, .25);
        }

        .vg-insert-all {
            background: #2563eb;
            border: 1px solid #2563eb;
            color: #fff;
            box-shadow: 0 2px 8px rgba(37, 99, 235, .25);
        }

        .vg-insert-all:hover {
            filter: brightness(0.95);
            box-shadow: 0 3px 10px rgba(37, 99, 235, .3);
        }

    </style>
@endpush

@section('main')
    <div class="">
        <div class="page-inner">
            <div class="composer-shell">
                <div class="composer-head">
                    <button class="btn-top" id="updateNewLetter">Update Email</button>
                    <button class="btn-top" id="btnAttach">Attach Files</button>
                    <button class="btn-top d-none" id="btnPlainToggle">Plain Text</button>
                    <button class="btn-top primary d-none" id="btnSendNow">Send Email</button>
                    <button class="btn-top" style="color:#dc2626" id="btnClearAll">Clear</button>
                </div>
                <div class="composer-body">
                    <div class="row-field">
                        <div class="label-col">Email Name</div>
                        <div class="value-col">
                            <input class="form-control" id="nl_name" readonly placeholder="Joining Instructions - EFAW Portal">
                        </div>
                    </div>
                    <div class="row-field">
                        <div class="label-col">Subject</div>
                        <div class="value-col">
                            <input class="form-control" id="nl_subject" placeholder="Booking Confirmation T4E Hub">
                        </div>
                    </div>
                    <div class="row-field d-none">
                        <div class="label-col">Created by</div>
                        <div class="value-col inline-input">
                            <input class="form-control" id="nl_created_by_name" style="max-width:220px">
                            <input class="form-control" id="nl_created_by_email" style="max-width:260px">
                        </div>
                    </div>
                    <div class="row-field d-none">
                        <div class="label-col">Data Source</div>
                        <div class="value-col inline-input">
                            <input class="form-control" id="nl_data_source" value="TrainingCourse">
                        </div>
                    </div>
                    <div class="row-field d-none">
                        <div class="label-col">From</div>
                        <div class="value-col inline-input">
                            <input class="form-control" id="nl_from_name" style="max-width:220px">
                            <input class="form-control" id="nl_from_email" style="max-width:260px">
                        </div>
                    </div>
                    <div class="row-field d-none">
                        <div class="label-col">Send To:</div>
                        <div class="value-col">
                            <div class="pill-input-area" id="to_area"></div>
                            <div class="mt-1" style="display:flex;gap:6px;flex-wrap:wrap">
                                <button class="addr-add-btn" data-field="to">A-Z</button>
                            </div>
                        </div>
                    </div>
                    <div class="row-field">
                        <div class="label-col">CC To:</div>
                        <div class="value-col">
                            <div class="pill-input-area" id="cc_area"></div>
                            <div class="mt-1" style="display:flex;gap:6px;flex-wrap:wrap">
                                <button class="addr-add-btn" data-field="cc">Please Enter to mark Cc</button>
                            </div>
                        </div>
                    </div>
                    <div class="row-field">
                        <div class="label-col">BCC To:</div>
                        <div class="value-col">
                            <div class="pill-input-area" id="bcc_area"></div>
                            <div class="mt-1" style="display:flex;gap:6px;flex-wrap:wrap">
                                <button class="addr-add-btn" data-field="bcc">Please Enter to mark Bcc</button>
                            </div>
                        </div>
                    </div>
                    <div class="row-field d-none">
                        <div class="label-col">Mail Merge Field</div>
                        <div class="value-col inline-input">
                            <input class="form-control" id="nl_mail_merge_field" style="max-width:220px"
                                   placeholder="e.g. course.start_at">
                        </div>
                    </div>
                    <div class="row-field">
                        <div class="label-col">Attachments</div>
                        <div class="value-col">
                            <div class="attachments-bar" id="attach_list"></div>
                            <input type="file" id="composer_asset" style="display:none;" multiple>
                        </div>
                    </div>
                    <div class="sec-title">Email Content</div>
                    <div class="editor-wrapper">
                        <div class="editor-toolbar-strip">
                            <div class="editor-toolbar-left">
                                <div class="editor-toolbar-title">Insert Variable</div>
                                <select id="tpl_var_insert"></select>
                                <button type="button" id="tpl_var_help" class="editor-help-btn bulk-btn">Help</button>
                            </div>
                            <div class="editor-toolbar-right">
                                <div class="bulk-insert-wrap">
                                    <button type="button" class="bulk-btn" id="bulkInsertBtn">Bulk insert <span
                                            class="caret">▼</span></button>
                                    <div class="bulk-menu" id="bulkMenu"></div>
                                </div>
                                <button type="button" class="bulk-btn" id="addFooterImgBtn">Add Footer Image</button>
                            </div>
                        </div>
                        <div class="editor-area">
                            <textarea id="composer_html" data-rich="1"></textarea>
                        </div>
                    </div>
                    <div class="plain-text-area" id="plainWrap" style="display:none">
                        <div class="mb-1"
                             style="font-size:12px;font-weight:700;color:#4b5563;display:flex;align-items:center;justify-content:space-between">
                            <span>Plain Text Version</span>
                            <small style="color:#6b7280;font-weight:400">Shown if user's client can't render
                                HTML</small>
                        </div>
                        <textarea id="composer_text"></textarea>
                    </div>
                    @php
                        $logo = url('crm/assets/img/logo.png');
                    @endphp
                    <div class="sec-title" style="margin-top:24px;">Layout Wrapper</div>
                    <div class="layout-wrapper-grid">
                        <div class="layout-col">
                            <label class="layout-label">Layout HTML (wrapper)</label>
                            <textarea value="@{{content}}" class="layout-textarea" id="layout_html" placeholder="<div style='font-family:sans-serif;color:#1f2937;font-size:14px;line-height:1.5'>
@{{content}}
<hr style='border:0;border-top:1px solid #e5e7eb;margin:24px 0'>
<div style='font-size:12px;color:#6b7280;line-height:1.4;text-align:center'>
    <img src='{{ $logo }}' alt='Training4Employment' style='max-width:140px;display:block;margin:0 auto 8px auto'>
    Training4Employment · Automated Notification<br>
    Please do not reply directly to this email.
</div>
</div>"></textarea>
                            <div class="layout-hint">Must include <code>@{{content}}</code> exactly. The rendered email
                                body will be injected in that spot.
                            </div>
                        </div>
                        <div class="layout-col d-none">
                            <label class="layout-label">Layout Text (wrapper)</label>
                            <textarea class="layout-textarea" id="layout_text" placeholder="@{{content}}

--
Training4Employment
Automated Notification
Please do not reply directly to this message."></textarea>
                            <div class="layout-hint">Must include <code>@{{content}}</code>. Plaintext fallback uses
                                this wrapper.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>window.$ = window.jQuery = jQuery;</script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.full.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/tinymce@5.10.9/tinymce.min.js"></script>
    <script>
        const tplId = @json($templateId);
        const CSRF_TOKEN = @json(csrf_token());
        const ROUTE_UPLOAD = @json(route('crm.email.templates.upload-asset'));
        const ROUTE_VAR_LOOKUP = @json(route('crm.email.lookups.variables'));
    </script>
    @verbatim
        <script>
            (function ($) {
                'use strict';
                var editorHTML = null;
                var currentAttachments = [];

                function toastOk(m) {
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        title: m || 'Done',
                        timer: 1500,
                        showConfirmButton: false
                    });
                }

                function toastErr(m) {
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'error',
                        title: m || 'Failed',
                        timer: 2500,
                        showConfirmButton: false
                    });
                }

                function extractLaravelError(xhr) {
                    if (xhr && xhr.responseJSON) {
                        if (xhr.responseJSON.errors) {
                            var f = Object.keys(xhr.responseJSON.errors)[0];
                            if (f && xhr.responseJSON.errors[f] && xhr.responseJSON.errors[f][0]) return xhr.responseJSON.errors[f][0]
                        }
                        if (xhr.responseJSON.message) return xhr.responseJSON.message
                    }
                    if (xhr && xhr.statusText) return xhr.statusText;
                    return 'Failed'
                }

                function isValidEmail(e) {
                    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test((e || '').trim())
                }

                function addRecipientPill($area, emailVal) {
                    if (!emailVal) return;
                    var pill = $('<div class="recipient-pill"/>').text(emailVal);
                    var x = $('<span class="pill-close">&times;</span>');
                    x.on('click', function () {
                        pill.remove();
                    });
                    pill.append(x);
                    var input = $area.find('.rec-input');
                    if (input.length) input.before(pill); else $area.append(pill);
                }

                function inlineEmailError(a, msg) {
                    var $a = a.jquery ? a : $(a);
                    $a.next('.field-error-help').remove();
                    if (msg) {
                        $a.addClass('invalid');
                        $('<div class="field-error-help">' + msg + '</div>').insertAfter($a);
                    } else {
                        $a.removeClass('invalid');
                    }
                }

                function pendingText($area) {
                    var $inp = $area.find('.rec-input');
                    return ($inp.length ? $inp.val().trim() : '')
                }

                function normalizePendingToPill($area) {
                    var v = pendingText($area);
                    if (!v) return true;
                    if (!isValidEmail(v)) {
                        inlineEmailError($area, 'Enter a valid email');
                        return false
                    }
                    inlineEmailError($area, '');
                    addRecipientPill($area, v);
                    $area.find('.rec-input').val('');
                    return true
                }

                function renderRecipients(areaSel, list) {
                    var $area = $(areaSel).empty();
                    (list || []).forEach(function (addrRaw) {
                        var addr = (typeof addrRaw === 'string') ? addrRaw : (addrRaw && addrRaw.email ? addrRaw.email : '');
                        if (addr) addRecipientPill($area, addr);
                    });
                    var input = $('<input type="text" class="rec-input" style="border:none;outline:none;min-width:120px;font-size:13px;line-height:1.4;padding:4px 2px;color:#1f2937">');
                    input.on('keydown', function (e) {
                        if (e.key === 'Enter') {
                            e.preventDefault();
                            normalizePendingToPill($area);
                            if ($area.is('#cc_area') || $area.is('#bcc_area')) validateCcBcc();
                        }
                        if (e.key === 'Backspace' && !$(this).val()) {
                            var pills = $area.find('.recipient-pill');
                            if (pills.length) pills.last().remove();
                            if ($area.is('#cc_area') || $area.is('#bcc_area')) validateCcBcc();
                        }
                    }).on('blur', function () {
                        if ($area.is('#cc_area') || $area.is('#bcc_area')) {
                            normalizePendingToPill($area);
                            validateCcBcc();
                        }
                    });
                    $area.append(input);
                }

                function collectRecipientsFrom(areaSel) {
                    var emails = [];
                    $(areaSel).find('.recipient-pill').each(function () {
                        var txt = $(this).clone().children('.pill-close').remove().end().text().trim();
                        if (txt) emails.push(txt);
                    });
                    return emails
                }

                function renderAttachments(list) {
                    currentAttachments = Array.isArray(list) ? list.slice() : [];
                    var $box = $('#attach_list').empty();
                    if (!currentAttachments.length) {
                        $box.append('<div class="text-muted" style="color:#6b7280;font-size:12px;">No attachments</div>');
                        return;
                    }
                    currentAttachments.forEach(function (f, idx) {
                        var displayName = f.original_name || f.nameOriginal || f.name || '';
                        var row = $('<div class="attach-row"/>');
                        var left = $('<div/>');
                        left.append('<div class="attach-name">' + $('<div/>').text(displayName).html() + '</div>');
                        left.append('<div class="attach-meta">' + (f.size || '') + '</div>');
                        var p = $('<div class="attach-del" style="color:#1168e6;">Preview</div>');
                        p.on('click', function () {
                            var n = (f.name || displayName);
                            var ext = (n.split('.').pop() || '').toLowerCase();
                            var isImage = ['jpg', 'jpeg', 'png', 'gif', 'webp'].includes(ext);
                            var isPdf = ext === 'pdf';
                            var html = '';
                            if (isImage && f.url) html = '<img src="' + f.url + '" style="max-width:100%;border-radius:8px;">'; else if (isPdf && f.url) html = '<iframe src="' + f.url + '" style="width:100%;height:70vh;border:none;border-radius:8px;"></iframe>'; else html = (f.url ? '<div><a href="' + f.url + '" target="_blank">Open in new tab</a></div>' : '<div>No preview</div>');
                            Swal.fire({
                                width: '900px',
                                title: displayName || 'Attachment',
                                html: html,
                                confirmButtonText: 'Close'
                            });
                        });
                        var d = $('<div class="attach-del" style="color:#dc2626;">Remove</div>');
                        d.on('click', function () {
                            currentAttachments.splice(idx, 1);
                            renderAttachments(currentAttachments);
                        });
                        var right = $('<div style="display:flex;gap:12px;align-items:center;"></div>');
                        right.append(p).append(d);
                        row.append(left).append(right);
                        $box.append(row);
                    });
                }

                function insertIntoEditor(text) {
                    if (!editorHTML) return;
                    editorHTML.focus();
                    editorHTML.insertContent(text || '');
                }

                function insertFooterImage(url) {
                    if (!editorHTML || !url) return;
                    var footerHtml = '<p style="margin-top:24px;text-align:center;"><img src="' + url + '" style="max-width:100%;border-radius:8px" /></p>';
                    var cur = editorHTML.getContent() || '';
                    editorHTML.setContent(cur + footerHtml);
                }

                function initVarSelect() {
                    if (!$.fn.select2) return;
                    var full = [];
                    $('#tpl_var_insert').select2({
                        theme: 'bootstrap4',
                        placeholder: 'Insert variable…',
                        ajax: {
                            url: ROUTE_VAR_LOOKUP, dataType: 'json', delay: 200, processResults: function (d) {
                                full = d;
                                return {results: d};
                            }
                        }
                    }).on('select2:select', function (e) {
                        var token = e.params.data.id || '';
                        if (token) insertIntoEditor(token);
                        setTimeout(function () {
                            $('#tpl_var_insert').val(null).trigger('change');
                        }, 0);
                    });

                    $('#tpl_var_help').off('click').on('click', function () {
                        function renderGuide(groups) {
                            var body = '<div id="varDictWrap" style="text-align:left;font-size:13px;line-height:1.6;max-height:70vh;overflow-y:auto;padding:6px 2px;">' +
                                '<div style="position:sticky;top:0;background:#fff;padding:6px 0 10px;z-index:1">' +
                                '<input id="varSearch" type="text" placeholder="Search variables (e.g. user, course.title)" style="width:100%;max-width:420px;border:1px solid #d1d5db;border-radius:10px;height:36px;padding:6px 10px;box-sizing:border-box;font-size:13px">' +
                                '</div>';
                            (groups || []).forEach(function (g, gi) {
                                var label = g.text || ('Group ' + (gi + 1));
                                var kids = Array.isArray(g.children) ? g.children : [];
                                if (!kids.length) return;
                                body += '<div class="var-guide-group" data-group="' + $('<div/>').text(label).html() + '">' +
                                    '<h5 style="margin:14px 0 8px;font-size:14px;color:#111827;font-weight:700;display:flex;align-items:center;justify-content:space-between">' +
                                    '<span>' + $('<div/>').text(label).html() + '</span>' +
                                    '<button type="button" class="vg-btn vg-insert-all" data-gi="' + gi + '">Insert all</button>' +
                                    '</h5>';
                                kids.forEach(function (c, ci) {
                                    var code = c.id || '';
                                    var desc = c.text || '';
                                    body += '<div class="var-row" data-code="' + $('<div/>').text(code).html() + '" data-desc="' + $('<div/>').text(desc).html() + '">' +
                                        '<code class="var-code">' + $('<div/>').text(code).html() + '</code>' +
                                        '<span class="var-desc">' + $('<div/>').text(desc).html() + '</span>' +
                                        '<div class="var-actions">' +
                                        '<button type="button" class="vg-btn vg-copy" data-gi="' + gi + '" data-ci="' + ci + '">Copy</button>' +
                                        '<button type="button" class="vg-btn vg-insert" data-gi="' + gi + '" data-ci="' + ci + '">Insert</button>' +
                                        '</div></div>';
                                });
                                body += '</div>';
                            });
                            body += '</div>';
                            return body;
                        }

                        function getEditor() {
                            if (editorHTML) return editorHTML;
                            if (window.editorHTML) return window.editorHTML;
                            if (window.tplEditorInstance) return window.tplEditorInstance;
                            if (window.TPL_ED) return window.TPL_ED;
                            return null;
                        }

                        function insertToken(token) {
                            var t = token || '';
                            if (!t) return;
                            var ed = getEditor();
                            if (ed) {
                                ed.focus();
                                ed.insertContent(t);
                                return;
                            }
                            var el = document.activeElement;
                            if (el && (el.tagName === 'TEXTAREA' || (el.tagName === 'INPUT' && el.type === 'text'))) {
                                var start = el.selectionStart || 0, end = el.selectionEnd || 0, v = el.value || '';
                                el.value = v.slice(0, start) + t + v.slice(end);
                                try {
                                    el.setSelectionRange(start + t.length, start + t.length);
                                } catch (e) {
                                }
                            }
                        }

                        function wireModal(groups) {
                            $('.vg-copy').on('click', function () {
                                var gi = +$(this).data('gi'), ci = +$(this).data('ci');
                                var item = (groups[gi] && groups[gi].children && groups[gi].children[ci]) ? groups[gi].children[ci] : null;
                                var t = item && item.id ? item.id : '';
                                if (!t) return;
                                navigator.clipboard.writeText(t);
                                $(this).addClass('copied').text('Copied!');
                                setTimeout(() => $(this).removeClass('copied').text('Copy'), 1200);
                            });
                            $('.vg-insert').on('click', function () {
                                var gi = +$(this).data('gi'), ci = +$(this).data('ci');
                                var item = (groups[gi] && groups[gi].children && groups[gi].children[ci]) ? groups[gi].children[ci] : null;
                                var t = item && item.id ? item.id : '';
                                if (t) insertToken(t);
                            });
                            $('.vg-insert-all').on('click', function () {
                                var gi = +$(this).data('gi');
                                var kids = (groups[gi] && Array.isArray(groups[gi].children)) ? groups[gi].children : [];
                                var tokens = kids.map(function (c) {
                                    return c.id || '';
                                }).filter(Boolean).join('\n');
                                if (tokens) insertToken(tokens);
                            });
                            $('#varSearch').on('input', function () {
                                var q = ($(this).val() || '').toLowerCase().trim();
                                $('.var-guide-group').each(function () {
                                    var any = false;
                                    $(this).find('.var-row').each(function () {
                                        var c = ($(this).data('code') || '').toLowerCase();
                                        var d = ($(this).data('asc') || '').toLowerCase();
                                        var hit = !q || c.includes(q) || d.includes(q);
                                        $(this).css('display', hit ? 'flex' : 'none');
                                        if (hit) any = true;
                                    });
                                    $(this).css('display', any ? 'block' : 'none');
                                });
                            });
                        }

                        function openGuide(groups) {
                            Swal.fire({
                                width: '900px',
                                title: '📘 Variable Dictionary',
                                html: renderGuide(groups),
                                showConfirmButton: true,
                                confirmButtonText: 'Close',
                                didOpen: function () {
                                    wireModal(groups);
                                }
                            });
                        }

                        $.get(ROUTE_VAR_LOOKUP, {all: 1})
                            .done(function (d) {
                                openGuide(Array.isArray(d) ? d : []);
                            })
                            .fail(function () {
                                $.get(ROUTE_VAR_LOOKUP)
                                    .done(function (d2) {
                                        openGuide(Array.isArray(d2) ? d2 : []);
                                    })
                                    .fail(function () {
                                        openGuide([]);
                                    });
                            });
                    });


                    var $btn = $('#bulkInsertBtn'), $menu = $('#bulkMenu');
                    $btn.on('click', function () {
                        if (!$menu.hasClass('open')) {
                            build(full);
                            $menu.addClass('open');
                        } else {
                            $menu.removeClass('open');
                        }
                    });
                    $(document).on('click', function (evt) {
                        var $t = $(evt.target);
                        if (!$t.closest('.bulk-insert-wrap').length && !$t.closest('#bulkInsertBtn').length) {
                            $menu.removeClass('open')
                        }
                    });

                    function build(groups) {
                        $menu.empty();
                        if (!groups || !groups.length) {
                            $menu.append($('<div/>', {
                                text: 'No variables available',
                                css: {fontSize: '12px', color: '#6b7280', padding: '.6rem .75rem'}
                            }));
                            return
                        }
                        groups.forEach(function (g) {
                            var label = g.text || 'Group';
                            var kids = Array.isArray(g.children) ? g.children : [];
                            if (!kids.length) return;
                            var b = $('<button/>', {'class': 'bulk-menu-btn', 'data-group': label, type: 'button'});
                            b.append($('<div/>', {text: 'Insert all from ' + label}));
                            b.append($('<div/>', {'class': 'small-hint', text: kids.length + ' fields'}));
                            b.on('click', function () {
                                ins(kids);
                                $menu.removeClass('open');
                            });
                            $menu.append(b);
                        });
                    }

                    function ins(list) {
                        if (!list || !list.length) return;
                        var tokens = list.map(function (c) {
                            return c.id || ''
                        }).filter(function (t) {
                            return t && t.length
                        }).join('\n');
                        if (!tokens.length) return;
                        insertIntoEditor(tokens);
                    }
                }

                function initCk() {
                    tinymce.init({
                        selector: '#composer_html',
                        height: 420,
                        menubar: true,
                        plugins: 'lists link image table code paste autoresize',
                        toolbar: 'undo redo | styleselect | bold italic underline | alignleft aligncenter alignright | bullist numlist | link image table | code',
                        paste_data_images: true,
                        convert_urls: false,
                        branding: false,
                        images_upload_credentials: true,
                        automatic_uploads: true,
                        images_upload_handler: function (blobInfo, success, failure) {
                            var xhr = new XMLHttpRequest();
                            xhr.open('POST', ROUTE_UPLOAD);
                            xhr.setRequestHeader('X-CSRF-TOKEN', CSRF_TOKEN);
                            xhr.onreadystatechange = function () {
                                if (xhr.readyState !== 4) return;
                                if (xhr.status >= 200 && xhr.status < 300) {
                                    try {
                                        var res = JSON.parse(xhr.responseText || '{}');
                                        if (res && res.url) {
                                            success(res.url);
                                        } else {
                                            failure('Invalid response');
                                        }
                                    } catch (e) {
                                        failure('Upload parse error');
                                    }
                                } else {
                                    failure('HTTP ' + xhr.status);
                                }
                            };
                            var fd = new FormData();
                            fd.append('file', blobInfo.blob());
                            xhr.send(fd);
                        },
                        setup: function (ed) {
                            ed.on('init', function () {
                                editorHTML = ed;
                                window.editorHTML = ed;
                                window.tplEditorInstance = ed;
                                window.TPL_ED = ed;
                                loadTemplate();
                            });
                        },
                        content_style: 'body { font-family: system-ui,-apple-system,Segoe UI,Roboto,Helvetica,Arial,sans-serif; font-size:14px; }'
                    });
                }


                function loadTemplate() {
                    $.get('/crm/email/templates/' + tplId, function (res) {
                        $('#nl_name').val(res.newsletter_name || (res.code + ' - ' + (res.category || '')));
                        $('#nl_subject').val(res.subject || '');
                        $('#nl_created_by_name').val(res.created_by_name || '');
                        $('#nl_created_by_email').val(res.created_by_email || '');
                        $('#nl_data_source').val(res.data_source || 'TrainingCourse');
                        $('#nl_from_name').val(res.from_name || '');
                        $('#nl_from_email').val(res.from_email || '');
                        $('#nl_mail_merge_field').val(res.mail_merge_field || '');
                        renderRecipients('#to_area', res.to || []);
                        renderRecipients('#cc_area', res.cc || []);
                        renderRecipients('#bcc_area', res.bcc || []);
                        renderAttachments((res.attachments || []).map(function (a) {
                            const displayName = a.nameOriginal || a.nameStored || '';
                            return {
                                name: displayName,
                                nameOriginal: a.nameOriginal || displayName,
                                original_name: a.nameOriginal || displayName,
                                url: a.url,
                                size: a.size
                            };
                        }));

                        if (editorHTML) editorHTML.setContent(res.html_body || '');
                        $('#composer_text').val(res.text_body || '');
                        $('#layout_html').val(res.layout_html || '');
                        $('#layout_text').val(res.layout_text || '');
                    }).fail(function () {
                        toastErr('Failed to load template');
                    });
                }

                function buildUpdateFormData() {
                    var fd = new FormData();

                    var toList = collectRecipientsFrom('#to_area');
                    var ccList = collectRecipientsFrom('#cc_area');
                    var bccList = collectRecipientsFrom('#bcc_area');

                    var htmlBody = editorHTML ? editorHTML.getContent() : '';
                    var textBody = $('#composer_text').val() || '';
                    var layoutHtml = $('#layout_html').val() || '';
                    var layoutText = $('#layout_text').val() || '';

                    fd.append('category', $('#nl_data_source').val() || 'TrainingCourse');
                    fd.append('active', 'true');
                    fd.append('is_draft', 'false');
                    fd.append('locale', 'en');
                    fd.append('subject', $('#nl_subject').val() || '');
                    fd.append('html_body', htmlBody);
                    fd.append('text_body', textBody);
                    fd.append('layout_html', layoutHtml);
                    fd.append('layout_text', layoutText);

                    // 🔧 NEW: clean attachments before sending
                    var cleanedAttachments = (currentAttachments || [])
                        .map(function (att) {
                            var name = (att.name || att.nameOriginal || att.original_name || '').trim();
                            var url = (att.url || '').trim();

                            // if there is no name at all, skip this attachment
                            if (!name) return null;

                            return {
                                name: name,
                                original_name: (att.original_name || att.nameOriginal || name),
                                url: url,
                                size: att.size || ''
                            };
                        })
                        .filter(function (att) { return att !== null; });

                    // Only send attachments if we actually have valid ones
                    cleanedAttachments.forEach(function (att, idx) {
                        fd.append('attachments[' + idx + '][url]', att.url || '');
                        fd.append('attachments[' + idx + '][name]', att.name || '');
                        fd.append('attachments[' + idx + '][original_name]', att.original_name || att.name || '');
                        fd.append('attachments[' + idx + '][size]', att.size || '');
                    });

                    toList.forEach(function (e, i) {
                        fd.append('to_recipients[' + i + ']', e)
                    });
                    ccList.forEach(function (e, i) {
                        fd.append('cc_recipients[' + i + ']', e)
                    });
                    bccList.forEach(function (e, i) {
                        fd.append('bcc_recipients[' + i + ']', e)
                    });

                    fd.append('from_name', $('#nl_from_name').val() || '');
                    fd.append('from_email', $('#nl_from_email').val() || '');
                    fd.append('created_by_name', $('#nl_created_by_name').val() || '');
                    fd.append('created_by_email', $('#nl_created_by_email').val() || '');
                    fd.append('data_source', $('#nl_data_source').val() || '');
                    fd.append('merge_field', $('#nl_mail_merge_field').val() || '');
                    fd.append('newsletter_name', $('#nl_name').val() || '');
                    fd.append('_method', 'PUT');
                    fd.append('_token', CSRF_TOKEN);

                    return fd;
                }


                function validateCcBcc() {
                    var $cc = $('#cc_area'), $bcc = $('#bcc_area');
                    var ccOk = normalizePendingToPill($cc);
                    var bccOk = normalizePendingToPill($bcc);
                    var cc = collectRecipientsFrom('#cc_area');
                    var bcc = collectRecipientsFrom('#bcc_area');
                    var badCc = cc.filter(function (e) {
                        return !isValidEmail(e)
                    });
                    var badBcc = bcc.filter(function (e) {
                        return !isValidEmail(e)
                    });
                    inlineEmailError($cc, (!ccOk || badCc.length) ? 'Enter valid email(s) in CC' : '');
                    inlineEmailError($bcc, (!bccOk || badBcc.length) ? 'Enter valid email(s) in BCC' : '');
                    return ccOk && bccOk && !badCc.length && !badBcc.length
                }

                function validateBeforeSave(fd) {
                    var subject = fd.get('subject');
                    var fromEmail = fd.get('from_email');
                    var layoutHtml = fd.get('layout_html') || '';
                    var layoutText = fd.get('layout_text') || '';

                    var hasTokenHtml = /(\{\{\s*content\s*\}\}|@\{\{\s*content\s*\}\})/.test(layoutHtml);
                    var hasTokenText = !layoutText || /(\{\{\s*content\s*\}\}|@\{\{\s*content\s*\}\})/.test(layoutText);
                    if (!subject || !subject.trim()) {
                        toastErr('Subject is required');
                        return false
                    }
                    if (!fromEmail || !fromEmail.trim()) {
                        toastErr('From email is required');
                        return false
                    }
                    if ((!hasTokenHtml)) {
                        toastErr('Layout HTML must include {{content}}');
                        return false
                    }
                    if (layoutText && (!hasTokenText)) {
                        toastErr('Layout Text must include {{content}}');
                        return false
                    }
                    return true
                }

                $('#updateNewLetter').on('click', function () {
                    if (!validateCcBcc()) {
                        toastErr('Fix CC/BCC emails');
                        return
                    }
                    var fd = buildUpdateFormData();
                    if (!validateBeforeSave(fd)) return;
                    $.ajax({
                        url: '/crm/email/templates/' + tplId,
                        method: 'POST',
                        data: fd,
                        contentType: false,
                        processData: false,
                        success: function () {
                            toastOk('Template updated');
                        },
                        error: function (xhr) {
                            toastErr(extractLaravelError(xhr) || 'Update failed');
                        }
                    });
                });
                $('#btnPlainToggle').on('click', function () {
                    $('#plainWrap').toggle();
                });
                $('#btnSendNow').on('click', function () {
                    Swal.fire({
                        title: 'Send this email?',
                        text: 'This will send immediately to all mapped recipients.',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Send now'
                    }).then(function (r) {
                        if (r.isConfirmed) {
                            $.post('/crm/email/templates/' + tplId + '/send-test', {_token: CSRF_TOKEN}).done(function () {
                                toastOk('Send queued');
                            }).fail(function () {
                                toastErr('Send failed');
                            });
                        }
                    });
                });
                $('#btnAttach').on('click', function () {
                    $('#composer_asset').trigger('click');
                });
                $('#composer_asset').on('change', function () {
                    var files = Array.from(this.files || []);
                    if (!files.length) return;
                    $('#attach_list').prepend('<div class="attach-row" id="up_row"><div class="attach-meta">Uploading ' + files.length + ' file(s)...</div></div>');
                    var ups = files.map(function (f) {
                        return $.Deferred(function (def) {
                            var fd = new FormData();
                            fd.append('file', f);
                            fd.append('_token', CSRF_TOKEN);
                            $.ajax({
                                url: ROUTE_UPLOAD,
                                method: 'POST',
                                data: fd,
                                contentType: false,
                                processData: false,
                                headers: {'X-CSRF-TOKEN': CSRF_TOKEN}
                            }).done(function (res) {
                                currentAttachments.push({
                                    name: res.name || f.name,
                                    original_name: res.original_name || f.name,
                                    nameOriginal: res.original_name || f.name,
                                    url: res.url || '',
                                    size: res.size || (f.size ? (Math.round(f.size / 1024) + ' KB') : '')
                                });
                                def.resolve();
                            }).fail(function (xhr) {
                                def.reject(extractLaravelError(xhr));
                            });
                        }).promise();
                    });
                    $.when.apply($, ups).done(function () {
                        $('#up_row').remove();
                        renderAttachments(currentAttachments);
                        toastOk('Upload complete');
                        $('#composer_asset').val('');
                    }).fail(function (err) {
                        $('#up_row').remove();
                        renderAttachments(currentAttachments);
                        toastErr(err || 'Some files failed');
                        $('#composer_asset').val('');
                    });
                });
                $('#btnClearAll').on('click', function () {
                    $('#nl_name,#nl_subject,#nl_created_by_name,#nl_created_by_email,#nl_data_source,#nl_from_name,#nl_from_email,#nl_mail_merge_field').val('');
                    $('#attach_list').empty().append('<div class="text-muted" style="color:#6b7280;font-size:12px;">No attachments</div>');
                    currentAttachments = [];
                    renderRecipients('#to_area', []);
                    renderRecipients('#cc_area', []);
                    renderRecipients('#bcc_area', []);
                    if (editorHTML) editorHTML.setContent('');
                    $('#composer_text').val('');
                    $('#layout_html').val('');
                    $('#layout_text').val('');
                });
                $('#addFooterImgBtn').on('click', function () {
                    Swal.fire({
                        title: 'Footer image URL',
                        input: 'url',
                        inputLabel: 'Paste public image link',
                        inputPlaceholder: 'https://example.com/footer-banner.png',
                        showCancelButton: true,
                        confirmButtonText: 'Insert'
                    }).then(function (r) {
                        if (r.isConfirmed && r.value) insertFooterImage(r.value);
                    });
                });
                $(function () {
                    initVarSelect();
                    initCk();
                });
            })(jQuery);
        </script>
    @endverbatim
@endpush

