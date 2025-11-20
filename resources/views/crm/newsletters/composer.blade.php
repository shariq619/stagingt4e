@extends('crm.layout.main')
@section('title', 'Newsletter - Update')

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

        #tpl_var_insert {
            width: 360px;
            font-size: 13px;
            height: 36px;
            border-radius: 10px;
            border: 1px solid #d1d5db;
            padding: 6px 10px;
            box-sizing: border-box;
            color: #1f2937;
            background: linear-gradient(to right, #ffffff, #f9fafb);
            transition: all .2s ease-in-out;
            box-shadow: 0 1px 2px rgba(0, 0, 0, .04)
        }

        #tpl_var_insert:focus {
            border-color: #2563eb !important;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, .2);
            background: #fff
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

        .is-invalid {
            border-color: #dc2626 !important;
            box-shadow: 0 0 0 3px rgba(220, 38, 38, .15) !important
        }

        .field-error {
            font-size: 12px;
            color: #dc2626;
            margin-top: 4px
        }
    </style>
@endpush

@section('main')
    <div class="">
        <div class="page-inner">
            <div class="composer-shell">
                <div class="composer-head">
                    <button class="btn-top" id="updateNewLetter">Update Newsletter</button>
                    <button class="btn-top" id="btnAttach">Attach Files</button>
                    <button class="btn-top d-none" id="btnPlainToggle">Plain Text</button>
                    <button class="btn-top primary d-none" id="btnSendNow">Send Newsletter</button>
                    <button class="btn-top" style="color:#dc2626" id="btnClearAll">Clear</button>
                </div>

                <div class="composer-body">
                    <div class="row-field">
                        <div class="label-col">Newsletter Name</div>
                        <div class="value-col"><input class="form-control" id="nl_name"
                                                      placeholder="Joining Instructions - EFAW Portal"></div>
                    </div>

                    <div class="row-field">
                        <div class="label-col">Subject</div>
                        <div class="value-col"><input class="form-control" id="nl_subject"
                                                      placeholder="Booking Confirmation T4E Hub"></div>
                    </div>

                    <div class="row-field">
                        <div class="label-col">From</div>
                        <div class="value-col inline-input">
                            <input class="form-control" id="nl_from_name" style="max-width:220px"
                                   placeholder="From Name">
                            <input class="form-control" id="nl_from_email" style="max-width:260px"
                                   placeholder="noreply@example.com">
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
                            <span>Plain Text Version</span><small style="color:#6b7280;font-weight:400">Shown if user's
                                client can't render HTML</small>
                        </div>
                        <textarea id="composer_text"></textarea>
                    </div>

                    <div class="sec-title" style="margin-top:24px;">Layout Wrapper</div>
                    <div class="layout-wrapper-grid">
                        <div class="layout-col">
                            <label class="layout-label">Layout HTML (wrapper)</label>
                            <textarea value="@{{content}}" class="layout-textarea" id="layout_html" placeholder="<div style='font-family:sans-serif;color:#1f2937;font-size:14px;line-height:1.5'>
                                @{{content}}
                                <hr style='border:0;border-top:1px solid #e5e7eb;margin:24px 0'>
                                <div style='font-size:12px;color:#6b7280;line-height:1.4;text-align:center'>
                                    <img src='https://jetbrains.com/crm/assets/img/logo.png' alt='Training4Employment' style='max-width:140px;display:block;margin:0 auto 8px auto'>
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
        const tplId =@json($nlId);
        const CSRF_TOKEN =@json(csrf_token());
        const ROUTE_UPLOAD =@json(route('crm.email.templates.upload-asset'));
        const ROUTE_VAR_LOOKUP =@json(route('crm.email.lookups.variables'));
        const ROUTE_SHOW = `/crm/newsletters/${tplId}/json`;
        const ROUTE_SAVE = `/crm/newsletters/${tplId}`;
        const ROUTE_SEND_TEST =@json(route('crm.newsletters.campaigns.send_test',['newsletter'=>$nlId]));
    </script>

    @verbatim
        <script>
            (function ($) {
                'use strict';
                var editorHTML = null, currentAttachments = [];

                function ok(x) {
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        title: x || 'Done',
                        timer: 1500,
                        showConfirmButton: false
                    })
                }

                function err(x) {
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'error',
                        title: x || 'Failed',
                        timer: 2500,
                        showConfirmButton: false
                    })
                }

                function xhrErr(xhr) {
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

                function isEmail(e) {
                    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test((e || '').trim())
                }

                function pill($a, val) {
                    if (!val) return;
                    var p = $('<div class="recipient-pill"/>').text(val);
                    var x = $('<span class="pill-close">&times;</span>').on('click', function () {
                        p.remove()
                    });
                    p.append(x);
                    var i = $a.find('.rec-input');
                    if (i.length) i.before(p); else $a.append(p)
                }

                function inlineErr(a, m) {
                    var $a = a.jquery ? a : $(a);
                    $a.next('.field-error-help').remove();
                    if (m) {
                        $a.addClass('invalid');
                        $('<div class="field-error-help">' + m + '</div>').insertAfter($a)
                    } else {
                        $a.removeClass('invalid')
                    }
                }

                function pending($a) {
                    var i = $a.find('.rec-input');
                    return (i.length ? i.val().trim() : '')
                }

                function toPill($a) {
                    var v = pending($a);
                    if (!v) return true;
                    if (!isEmail(v)) {
                        inlineErr($a, 'Enter a valid email');
                        return false
                    }
                    inlineErr($a, '');
                    pill($a, v);
                    $a.find('.rec-input').val('');
                    return true
                }

                function renderArea(sel, list) {
                    var $a = $(sel).empty();
                    (list || []).forEach(function (z) {
                        var e = (typeof z === 'string') ? z : (z && z.email ? z.email : '');
                        if (e) pill($a, e)
                    });
                    var i = $('<input type="text" class="rec-input" style="border:none;outline:none;min-width:120px;font-size:13px;line-height:1.4;padding:4px 2px;color:#1f2937">');
                    i.on('keydown', function (e) {
                        if (e.key === 'Enter') {
                            e.preventDefault();
                            toPill($a);
                            if ($a.is('#cc_area') || $a.is('#bcc_area')) validCcBcc()
                        }
                        if (e.key === 'Backspace' && !$(this).val()) {
                            var p = $a.find('.recipient-pill');
                            if (p.length) p.last().remove();
                            if ($a.is('#cc_area') || $a.is('#bcc_area')) validCcBcc()
                        }
                    }).on('blur', function () {
                        if ($a.is('#cc_area') || $a.is('#bcc_area')) {
                            toPill($a);
                            validCcBcc()
                        }
                    });
                    $a.append(i)
                }

                function collect(sel) {
                    var arr = [];
                    $(sel).find('.recipient-pill').each(function () {
                        var t = $(this).clone().children('.pill-close').remove().end().text().trim();
                        if (t) arr.push(t)
                    });
                    return arr
                }

                function renderAtt(list) {
                    currentAttachments = Array.isArray(list) ? list.slice() : [];
                    var $b = $('#attach_list').empty();
                    if (!currentAttachments.length) {
                        $b.append('<div class="text-muted" style="color:#6b7280;font-size:12px;">No attachments</div>');
                        return
                    }
                    currentAttachments.forEach(function (f, idx) {
                        var n = f.original_name || f.nameOriginal || f.name || '';
                        var r = $('<div class="attach-row"/>'), l = $('<div/>');
                        l.append('<div class="attach-name">' + $('<div/>').text(n).html() + '</div>');
                        l.append('<div class="attach-meta">' + (f.size || '') + '</div>');
                        var p = $('<div class="attach-del" style="color:#1168e6;">Preview</div>').on('click', function () {
                            var nm = (f.name || n), ext = (nm.split('.').pop() || '').toLowerCase(),
                                img = ['jpg', 'jpeg', 'png', 'gif', 'webp'].includes(ext), pdf = ext === 'pdf',
                                html = '';
                            if (img && f.url) html = '<img src="' + f.url + '" style="max-width:100%;border-radius:8px;">';
                            else if (pdf && f.url) html = '<iframe src="' + f.url + '" style="width:100%;height:70vh;border:none;border-radius:8px;"></iframe>';
                            else html = (f.url ? '<div><a href="' + f.url + '" target="_blank">Open in new tab</a></div>' : '<div>No preview</div>');
                            Swal.fire({
                                width: '900px',
                                title: n || 'Attachment',
                                html: html,
                                confirmButtonText: 'Close'
                            })
                        });
                        var d = $('<div class="attach-del" style="color:#dc2626;">Remove</div>').on('click', function () {
                            currentAttachments.splice(idx, 1);
                            renderAtt(currentAttachments)
                        });
                        var rt = $('<div style="display:flex;gap:12px;align-items:center;"></div>').append(p).append(d);
                        r.append(l).append(rt);
                        $('#attach_list').append(r)
                    })
                }

                function insertEd(t) {
                    if (!editorHTML) return;
                    editorHTML.focus();
                    editorHTML.insertContent(t || '')
                }

                function footerImg(u) {
                    if (!editorHTML || !u) return;
                    var h = '<p style="margin-top:24px;text-align:center;"><img src="' + u + '" style="max-width:100%;border-radius:8px" /></p>';
                    var c = editorHTML.getContent() || '';
                    editorHTML.setContent(c + h)
                }

                function initVarSelect() {
                    $('#tpl_var_insert').select2({
                        theme: 'bootstrap4',
                        placeholder: 'Insert variable…',
                        ajax: {
                            url: ROUTE_VAR_LOOKUP, dataType: 'json', delay: 200, processResults: function (d) {
                                var g = Array.isArray(d) ? d : [];
                                g = g.filter(function (x) {
                                    return String(x.text || '').toLowerCase() === 'user'
                                });
                                return {results: g}
                            }
                        }
                    })
                        .on('select2:select', function (e) {
                            var t = e.params.data.id || '';
                            if (t) insertEd(t);
                            setTimeout(function () {
                                $('#tpl_var_insert').val(null).trigger('change')
                            }, 0)
                        });
                    $('#tpl_var_help').off('click').on('click', function () {
                        $.get(ROUTE_VAR_LOOKUP, {all: 1}).done(function (d) {
                            var g = Array.isArray(d) ? d : [];
                            g = g.filter(function (x) {
                                return String(x.text || '').toLowerCase() === 'user'
                            });
                            var html = '<div style="max-height:70vh;overflow:auto;">' +
                                (g[0] && Array.isArray(g[0].children) ? g[0].children.map(function (c) {
                                    var code = $('<div/>').text(c.id || '').html();
                                    var desc = $('<div/>').text(c.text || '').html();
                                    return '<div style="display:flex;gap:10px;align-items:center;justify-content:space-between;border:1px solid #e5e7eb;background:#f9fafb;padding:8px 12px;border-radius:10px;margin-bottom:8px">' +
                                        '<code style="font-weight:700;color:#2563eb">' + code + '</code>' +
                                        '<span style="flex:1;color:#4b5563">' + desc + '</span>' +
                                        '<div><button type="button" class="addr-add-btn" data-t="' + code + '">Insert</button></div>' +
                                        '</div>';
                                }).join('') : '<div class="text-muted">No variables</div>') + '</div>';
                            Swal.fire({
                                width: 900,
                                title: 'Variable Dictionary',
                                html: html,
                                showConfirmButton: true,
                                confirmButtonText: 'Close',
                                didOpen: function () {
                                    $('.addr-add-btn[data-t]').on('click', function () {
                                        insertEd($(this).data('t'));
                                    })
                                }
                            })
                        })
                    });
                    var $btn = $('#bulkInsertBtn'), $menu = $('#bulkMenu');
                    $btn.on('click', function () {
                        if (!$menu.hasClass('open')) {
                            $menu.addClass('open').html('<button class="bulk-menu-btn" id="bulkUserAll">Insert all User variables</button>');
                            $('#bulkUserAll').on('click', function () {
                                $menu.removeClass('open');
                                $.get(ROUTE_VAR_LOOKUP).done(function (d) {
                                    var g = Array.isArray(d) ? d : [];
                                    g = g.filter(function (x) {
                                        return String(x.text || '').toLowerCase() === 'user'
                                    });
                                    var kids = (g[0] && Array.isArray(g[0].children)) ? g[0].children : [];
                                    var t = kids.map(function (c) {
                                        return c.id || ''
                                    }).filter(Boolean).join('\n');
                                    if (t) insertEd(t);
                                });
                            });
                        } else {
                            $menu.removeClass('open')
                        }
                    });
                    $(document).on('click', function (e) {
                        var $t = $(e.target);
                        if (!$t.closest('.bulk-insert-wrap').length && !$t.closest('#bulkInsertBtn').length) {
                            $menu.removeClass('open')
                        }
                    })
                }

                function initTiny() {
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
                        images_upload_handler: function (b, s, f) {
                            var x = new XMLHttpRequest();
                            x.open('POST', ROUTE_UPLOAD);
                            x.setRequestHeader('X-CSRF-TOKEN', CSRF_TOKEN);
                            x.onreadystatechange = function () {
                                if (x.readyState !== 4) return;
                                if (x.status >= 200 && x.status < 300) {
                                    try {
                                        var r = JSON.parse(x.responseText || '{}');
                                        if (r && r.url) {
                                            s(r.url)
                                        } else {
                                            f('Invalid response')
                                        }
                                    } catch (e) {
                                        f('Upload parse error')
                                    }
                                } else {
                                    f('HTTP ' + x.status)
                                }
                            };
                            var fd = new FormData();
                            fd.append('file', b.blob());
                            x.send(fd)
                        },
                        setup: function (ed) {
                            ed.on('init', function () {
                                editorHTML = ed;
                                window.editorHTML = ed;
                                loadTpl()
                            })
                        },
                        content_style: 'body{font-family:system-ui,-apple-system,Segoe UI,Roboto,Helvetica,Arial,sans-serif;font-size:14px;}'
                    })
                }

                function loadTpl() {
                    $.getJSON(ROUTE_SHOW, function (res) {
                        $('#nl_name').val(res.newsletter_name || '');
                        $('#nl_subject').val(res.subject || '');
                        $('#nl_created_by_name').val(res.created_by_name || '');
                        $('#nl_created_by_email').val(res.created_by_email || '');
                        $('#nl_from_name').val(res.from_name || '');
                        $('#nl_from_email').val(res.from_email || '');
                        $('#nl_mail_merge_field').val(res.mail_merge_field || '');
                        renderArea('#to_area', res.to || []);
                        renderArea('#cc_area', res.cc || []);
                        renderArea('#bcc_area', res.bcc || []);
                        renderAtt((res.attachments || []).map(function (a) {
                            return {
                                name: a.name,
                                nameOriginal: a.original_name || a.name,
                                original_name: a.original_name || a.name,
                                url: a.url,
                                size: a.size
                            }
                        }));
                        if (editorHTML) editorHTML.setContent(res.html_body || '');
                        $('#composer_text').val(res.text_body || '');
                        $('#layout_html').val(res.layout_html || '');
                        $('#layout_text').val(res.layout_text || '')
                    }).fail(function () {
                        err('Failed to load')
                    })
                }

                function buildFD() {
                    var fd = new FormData();
                    var to = collect('#to_area'), cc = collect('#cc_area'), bcc = collect('#bcc_area');
                    var html = editorHTML ? editorHTML.getContent() : '', text = $('#composer_text').val() || '';
                    var lhtml = $('#layout_html').val() || '', ltext = $('#layout_text').val() || '';
                    fd.append('active', 'true');
                    fd.append('is_draft', 'false');
                    fd.append('locale', 'en');
                    fd.append('subject', $('#nl_subject').val() || '');
                    fd.append('html_body', html);
                    fd.append('text_body', text);
                    fd.append('layout_html', lhtml);
                    fd.append('layout_text', ltext);
                    currentAttachments.forEach(function (att, idx) {
                        fd.append('attachments[' + idx + '][url]', att.url || '');
                        fd.append('attachments[' + idx + '][name]', att.name || att.nameOriginal || '');
                        fd.append('attachments[' + idx + '][original_name]', att.original_name || att.nameOriginal || att.name || '');
                        fd.append('attachments[' + idx + '][size]', att.size || '')
                    });
                    to.forEach(function (e, i) {
                        fd.append('to_recipients[' + i + ']', e)
                    });
                    cc.forEach(function (e, i) {
                        fd.append('cc_recipients[' + i + ']', e)
                    });
                    bcc.forEach(function (e, i) {
                        fd.append('bcc_recipients[' + i + ']', e)
                    });
                    fd.append('from_name', $('#nl_from_name').val() || '');
                    fd.append('from_email', $('#nl_from_email').val() || '');
                    fd.append('created_by_name', $('#nl_created_by_name').val() || '');
                    fd.append('created_by_email', $('#nl_created_by_email').val() || '');
                    fd.append('merge_field', $('#nl_mail_merge_field').val() || '');
                    fd.append('newsletter_name', $('#nl_name').val() || '');
                    fd.append('_method', 'PUT');
                    fd.append('_token', CSRF_TOKEN);
                    return fd
                }

                function validCcBcc() {
                    var $cc = $('#cc_area'), $bcc = $('#bcc_area');
                    var okc = toPill($cc), okb = toPill($bcc);
                    var cc = collect('#cc_area'), bcc = collect('#bcc_area');
                    var badc = cc.filter(function (e) {
                        return !isEmail(e)
                    }), badb = bcc.filter(function (e) {
                        return !isEmail(e)
                    });
                    inlineErr($cc, (!okc || badc.length) ? 'Enter valid email(s) in CC' : '');
                    inlineErr($bcc, (!okb || badb.length) ? 'Enter valid email(s) in BCC' : '');
                    return okc && okb && !badc.length && !badb.length
                }

                function showFieldError($el, msg) {
                    $el.addClass('is-invalid');
                    var $next = $el.next('.field-error');
                    if (!$next.length) {
                        $next = $('<div class="field-error"></div>').insertAfter($el);
                    }
                    $next.text(msg || '')
                }

                function clearFieldError($el) {
                    $el.removeClass('is-invalid');
                    $el.next('.field-error').remove()
                }

                function stripHtmlToText(html) {
                    if (!html) return '';
                    var t = $('<div/>').html(html).text();
                    return t.replace(/\u00a0/g, ' ').replace(/\s+/g, ' ').trim()
                }

                function layoutHasContentToken(s) {
                    if (!s) return false;
                    return /@?\{\{\s*content\s*\}\}/i.test(s)
                }

                function validateForm() {
                    var ok = true;
                    var $name = $('#nl_name'), $subj = $('#nl_subject'), $fromEm = $('#nl_from_email'),
                        $layout = $('#layout_html');
                    var nameVal = ($name.val() || '').trim(), subjVal = ($subj.val() || '').trim(),
                        fromVal = ($fromEm.val() || '').trim(), layoutV = ($layout.val() || '');
                    [$name, $subj, $fromEm, $layout].forEach(clearFieldError);
                    if (!nameVal) {
                        showFieldError($name, 'Newsletter name is required');
                        ok = false;
                    }
                    if (!subjVal) {
                        showFieldError($subj, 'Subject is required');
                        ok = false;
                    }
                    if (!fromVal) {
                        showFieldError($fromEm, 'From email is required');
                        ok = false;
                    } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(fromVal)) {
                        showFieldError($fromEm, 'Enter a valid email');
                        ok = false;
                    }
                    var htmlBody = (window.editorHTML ? window.editorHTML.getContent() : '');
                    var plainLen = stripHtmlToText(htmlBody).length;
                    if (plainLen < 5) {
                        if (window.editorHTML) {
                            window.editorHTML.focus();
                        }
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'error',
                            title: 'HTML body must be at least 5 characters',
                            timer: 2200,
                            showConfirmButton: false
                        });
                        ok = false;
                    }
                    if (!layoutHasContentToken(layoutV)) {
                        showFieldError($layout, 'Layout HTML must include {{content}}');
                        ok = false;
                    }
                    return ok;
                }

                $('#updateNewLetter').on('click', function () {
                    if (!validCcBcc()) {
                        err('Fix CC/BCC emails');
                        return
                    }
                    if (!validateForm()) return;
                    var fd = buildFD();
                    var $b = $(this).prop('disabled', true).text('Saving…');
                    $.ajax({
                        url: ROUTE_SAVE, method: 'POST', data: fd, contentType: false, processData: false,
                        success: function () {
                            ok('Newsletter updated')
                        },
                        error: function (x) {
                            err(xhrErr(x) || 'Update failed')
                        },
                        complete: function () {
                            $b.prop('disabled', false).text('Update Newsletter')
                        }
                    });
                });
                $('#btnPlainToggle').on('click', function () {
                    $('#plainWrap').toggle()
                });
                $('#btnSendNow').on('click', function () {
                    Swal.fire({
                        title: 'Send this newsletter?',
                        text: 'A test copy will be sent.',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Send test'
                    }).then(function (r) {
                        if (!r.isConfirmed) return;
                        $.post(ROUTE_SEND_TEST, {_token: CSRF_TOKEN}).done(function () {
                            ok('Test sent')
                        }).fail(function (x) {
                            err((x.responseJSON && x.responseJSON.message) || 'Send failed')
                        })
                    })
                });
                $('#btnAttach').on('click', function () {
                    $('#composer_asset').trigger('click')
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
                            })
                                .done(function (res) {
                                    currentAttachments.push({
                                        name: res.name || f.name,
                                        original_name: res.original_name || f.name,
                                        nameOriginal: res.original_name || f.name,
                                        url: res.url || '',
                                        size: res.size || (f.size ? (Math.round(f.size / 1024) + ' KB') : '')
                                    });
                                    def.resolve()
                                })
                                .fail(function (x) {
                                    def.reject(xhrErr(x))
                                })
                        }).promise()
                    });
                    $.when.apply($, ups).done(function () {
                        $('#up_row').remove();
                        renderAtt(currentAttachments);
                        ok('Upload complete');
                        $('#composer_asset').val('')
                    })
                        .fail(function (e) {
                            $('#up_row').remove();
                            renderAtt(currentAttachments);
                            err(e || 'Some files failed');
                            $('#composer_asset').val('')
                        })
                });
                $('#btnClearAll').on('click', function () {
                    $('#nl_name,#nl_subject,#nl_created_by_name,#nl_created_by_email,#nl_from_name,#nl_from_email,#nl_mail_merge_field').val('');
                    $('#attach_list').empty().append('<div class="text-muted" style="color:#6b7280;font-size:12px;">No attachments</div>');
                    currentAttachments = [];
                    renderArea('#to_area', []);
                    renderArea('#cc_area', []);
                    renderArea('#bcc_area', []);
                    if (editorHTML) editorHTML.setContent('');
                    $('#composer_text').val('');
                    $('#layout_html').val('');
                    $('#layout_text').val('')
                });

                $('#nl_name,#nl_subject,#nl_from_email,#layout_html').on('input blur', function () {
                    clearFieldError($(this))
                });

                function footerImg(u) {
                    if (!editorHTML || !u) return;
                    var h = '<p style="margin-top:24px;text-align:center;"><img src="' + u + '" style="max-width:100%;border-radius:8px" /></p>';
                    var c = editorHTML.getContent() || '';
                    editorHTML.setContent(c + h)
                }

                $('#addFooterImgBtn').on('click', function () {
                    Swal.fire({
                        title: 'Footer image URL',
                        input: 'url',
                        inputLabel: 'Paste public image link',
                        inputPlaceholder: 'https://example.com/footer-banner.png',
                        showCancelButton: true,
                        confirmButtonText: 'Insert'
                    }).then(function (r) {
                        if (r.isConfirmed && r.value) footerImg(r.value)
                    })
                })


                $(function () {
                    initVarSelect();
                    initTiny()
                });
            })(jQuery);
        </script>
    @endverbatim
@endpush
