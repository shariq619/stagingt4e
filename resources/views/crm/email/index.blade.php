@extends('crm.layout.main')
@section('title', 'Email Management')

@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@1.5.2/dist/select2-bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-bootstrap-4/bootstrap-4.min.css">
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
            --danger: #ef4444;
        }

        body {
            background: var(--bg);
            color: var(--ink);
            font-family: -apple-system, BlinkMacSystemFont, "SF Pro Text", system-ui, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            font-size: 14px;
            line-height: 1.4;
        }

        .page-inner {
            padding-top: 24px;
            padding-bottom: 48px;
        }

        .card {
            border-radius: 16px;
            border: 1px solid var(--border);
            box-shadow: 0 20px 40px -8px rgba(0, 0, 0, .15);
            background: #fff;
            overflow: hidden;
        }

        .card-body {
            background: radial-gradient(circle at 0% 0%, #ffffff 0%, #f9fafb 60%);
            border-radius: 16px;
            padding: 20px 24px 24px;
        }

        .nav-pills {
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 9999px;
            padding: 4px;
            display: inline-flex;
            flex-wrap: wrap;
            box-shadow: 0 6px 16px rgba(0, 0, 0, .07);
        }

        .nav-pills .nav-item {
            margin: 2px 4px;
        }

        .nav-pills .nav-link {
            border-radius: 9999px !important;
            font-weight: 600;
            font-size: 13px;
            line-height: 1.2;
            padding: .55rem 1rem;
            border: 1px solid transparent;
            color: #4b5563;
            background: transparent;
            transition: all .12s;
            cursor: pointer;
        }

        .nav-pills .nav-link.active {
            background: #1168e6;
            color: #fff;
            border-color: #1168e6;
            box-shadow: 0 8px 16px rgba(17, 104, 230, .4);
        }

        .nav-pills .nav-link:not(.active):hover {
            background: #f3f4f6;
            color: #111827;
            border-color: #d1d5db;
        }

        .tab-box-shell {
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 12px;
            box-shadow: 0 10px 24px rgba(0, 0, 0, .08);
            padding: 0;
            margin-top: 16px !important;
        }

        .tab-pane-inner {
            padding: 16px;
        }

        .field-error-help {
            font-size: 12px;
            color: #dc2626;
            line-height: 1.4;
            font-weight: 500;
            margin-top: 4px;
        }

        .field-hint {
            font-size: 11px;
            color: var(--muted);
            line-height: 1.4;
            margin-top: 4px;
            display: block;
        }

        .form-label-compact {
            font-size: 11px;
            font-weight: 600;
            color: #374151;
            line-height: 1.3;
            margin-bottom: 4px;
            display: block;
            text-transform: uppercase;
            letter-spacing: .08em;
        }

        .form-control-compact {
            border-radius: 999px;
            border: 1px solid #d1d5db;
            font-size: 13px;
            line-height: 1.4;
            color: #111827;
            height: 40px;
            padding: 8px 14px;
            background: #f9fafb;
            transition: border-color .15s ease, box-shadow .15s ease, background .15s ease, transform .08s ease;
        }

        .form-control-compact:focus {
            border-color: var(--accent);
            background: #ffffff;
            box-shadow: 0 0 0 1px var(--accent), 0 0 0 4px rgba(37, 99, 235, .14);
            outline: none;
            transform: translateY(-1px);
        }

        select.form-control-compact {
            padding-right: 32px;
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background-image: linear-gradient(45deg, transparent 50%, #9ca3af 50%), linear-gradient(135deg, #9ca3af 50%, transparent 50%);
            background-position: calc(100% - 14px) 15px, calc(100% - 9px) 15px;
            background-size: 5px 5px, 5px 5px;
            background-repeat: no-repeat;
        }

        .select-compact {
            border-radius: 999px;
            border: 1px solid #d1d5db;
            font-size: 13px;
            height: 40px;
            padding: 8px 14px;
            background: #f9fafb;
            width: 100%;
            transition: border-color .15s ease, box-shadow .15s ease, background .15s ease, transform .08s ease;
        }

        .select-compact:focus {
            border-color: var(--accent);
            background: #ffffff;
            box-shadow: 0 0 0 1px var(--accent), 0 0 0 4px rgba(37, 99, 235, .14);
            outline: none;
            transform: translateY(-1px);
        }

        .pill-input-area {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 6px;
            min-height: 40px;
            border-radius: 999px;
            border: 1px solid #d1d5db;
            padding: 6px 10px;
            background: #f9fafb;
            cursor: text;
        }

        .pill-input-area.invalid {
            border-color: #dc2626 !important;
            box-shadow: 0 0 0 3px rgba(220, 38, 38, .15) !important;
        }

        .addr-actions {
            margin-top: 4px;
            display: flex;
            gap: 6px;
            flex-wrap: wrap;
            font-size: 11px;
            color: var(--muted);
        }

        .addr-add-btn {
            font-size: 11px;
            border-radius: 999px;
            border: 1px solid #e5e7eb;
            background: #ffffff;
            line-height: 1.2;
            padding: .3rem .6rem;
            font-weight: 600;
            cursor: pointer;
        }

        .inline-duo {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            align-items: center;
        }

        .w-fixed-180 {
            width: 180px;
            flex: 0 0 auto;
        }

        .w-flex-grow {
            flex: 1 1 auto;
        }

        .footer-variant-row {
            display: flex;
            gap: 8px;
            align-items: center;
        }

        .footer-variant-note {
            font-size: 11px;
            color: var(--muted);
            white-space: nowrap;
        }

        .attachments-bar {
            min-height: 38px;
            border-radius: 999px;
            border: 1px dashed #d1d5db;
            background: #f9fafb;
            padding: 6px 10px;
            display: flex;
            align-items: center;
            gap: 6px;
            cursor: pointer;
            font-size: 12px;
            color: #4b5563;
        }

        .attachments-empty {
            display: inline-flex;
            align-items: center;
            font-size: 12px;
            color: #6b7280;
        }

        .btn-gray {
            background: #6b7280 !important;
            border-color: #6b7280 !important;
            color: #fff !important;
            box-shadow: 0 10px 20px rgba(0, 0, 0, .25) !important;
        }

        .btn-pill-primary,
        .btn-mapping-primary {
            border-radius: 9999px;
            font-size: 12px;
            line-height: 1.2;
            padding: .5rem 1.1rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: var(--accent);
            border: 1px solid var(--accent);
            color: #fff;
            box-shadow: 0 10px 22px rgba(37, 99, 235, .40);
            transition: transform .08s ease, box-shadow .12s ease, filter .12s ease;
        }

        .btn-pill-primary i,
        .btn-mapping-primary i {
            font-size: 15px;
        }

        .btn-pill-primary:hover,
        .btn-mapping-primary:hover {
            filter: brightness(.97);
            transform: translateY(-1px);
            box-shadow: 0 16px 30px rgba(37, 99, 235, .50);
        }

        .btn-pill-primary:active,
        .btn-mapping-primary:active {
            transform: translateY(0);
            box-shadow: 0 8px 18px rgba(37, 99, 235, .35);
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
            transition: background .12s ease, border-color .12s ease, box-shadow .12s ease, transform .08s ease, color .12s ease;
        }

        .btn-top i {
            font-size: 14px;
        }

        .btn-top:hover {
            background: #f3f4f6;
            border-color: #cbd5e1;
            box-shadow: 0 6px 14px rgba(15, 23, 42, .10);
            transform: translateY(-1px);
        }

        .btn-top:active {
            transform: translateY(0);
            box-shadow: 0 3px 8px rgba(15, 23, 42, .08);
        }

        .btn-top-primary {
            background: var(--accent);
            border-color: var(--accent);
            color: #ffffff;
            box-shadow: 0 10px 22px rgba(37, 99, 235, .40);
        }

        .btn-top-primary:hover {
            background: #1d4ed8;
            border-color: #1d4ed8;
            box-shadow: 0 14px 26px rgba(37, 99, 235, .50);
        }

        .btn-top-gray {
            background: #f3f4f6;
            border-color: #e5e7eb;
            color: #374151;
        }

        .bulk-insert-wrap {
            position: relative;
        }

        .bulk-btn {
            font-size: 11px;
            border-radius: 999px;
            border: 1px solid #e5e7eb;
            background: #ffffff;
            line-height: 1.2;
            padding: .3rem .6rem;
            font-weight: 600;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            color: #111827;
        }

        .bulk-btn .caret {
            font-size: 10px;
            line-height: 1;
            color: #6b7280;
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
            z-index: 9999;
            font-size: 12px;
        }

        .bulk-menu.open {
            display: block;
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
            flex-direction: column;
        }

        .bulk-menu-btn:hover {
            background: #f3f4f6;
        }

        .bulk-menu-btn .small-hint {
            font-size: 11px;
            line-height: 1.3;
            color: #6b7280;
            font-weight: 400;
        }

        #tplFooterImgBtn {
            border-radius: 999px;
            border: 1px solid #e5e7eb;
            background: #ffffff;
            font-size: 11px;
            padding: 4px 10px;
            cursor: pointer;
            color: #111827;
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
            border: 1px solid transparent;
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

        .vg-insert,
        .vg-insert-all {
            background: #2563eb;
            border: 1px solid #2563eb;
            color: #fff;
            box-shadow: 0 2px 8px rgba(37, 99, 235, .25);
        }

        .vg-insert:hover,
        .vg-insert-all:hover {
            filter: brightness(0.95);
            box-shadow: 0 3px 10px rgba(37, 99, 235, .3);
        }

        .vg-insert:active,
        .vg-insert-all:active {
            transform: translateY(1px);
            box-shadow: 0 1px 6px rgba(37, 99, 235, .25);
        }

        .trigger-shell,
        .mapping-shell,
        .email-template-shell,
        .drafts-shell,
        .templates-shell,
        .trigger-table-shell,
        .mapping-table-shell {
            border-radius: 20px;
            border: 1px solid var(--border);
            background: #ffffff;
            box-shadow: 0 18px 38px rgba(15, 23, 42, .10);
            padding: 18px 22px 20px;
            margin-bottom: 22px;
            position: relative;
            overflow: hidden;
        }

        .trigger-shell-inner,
        .mapping-shell-inner,
        .email-template-inner,
        .drafts-inner,
        .templates-inner,
        .trigger-table-inner,
        .mapping-table-inner {
            position: relative;
            z-index: 1;
        }

        .trigger-shell-header,
        .mapping-shell-header,
        .email-template-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 14px;
        }

        .trigger-shell-title-main,
        .mapping-shell-title-main,
        .email-template-title-main {
            display: flex;
            align-items: flex-start;
            gap: 10px;
        }

        .trigger-shell-icon,
        .mapping-shell-icon,
        .email-template-icon {
            width: 34px;
            height: 34px;
            border-radius: 999px;
            background: var(--accent-soft);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--accent);
            flex-shrink: 0;
            border: 1px solid #dbeafe;
        }

        .trigger-shell-icon i,
        .mapping-shell-icon i,
        .email-template-icon i {
            font-size: 18px;
        }

        .trigger-shell-text-title,
        .mapping-shell-text-title,
        .email-template-text-title {
            font-size: 15px;
            font-weight: 700;
            letter-spacing: .02em;
            color: var(--ink);
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .trigger-shell-text-title span,
        .mapping-shell-text-title span,
        .email-template-text-title span {
            font-size: 11px;
            font-weight: 500;
            color: #9ca3af;
        }

        .trigger-shell-text-sub,
        .mapping-shell-text-sub,
        .email-template-text-sub {
            font-size: 12px;
            color: var(--muted);
            margin-top: 2px;
        }

        .trigger-shell-meta,
        .mapping-shell-meta,
        .email-template-meta {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 11px;
            color: var(--muted);
        }

        .trigger-shell-meta-pill,
        .mapping-shell-meta-pill,
        .email-template-meta-pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: .25rem .65rem;
            border-radius: 999px;
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            font-weight: 500;
        }

        .trigger-shell-meta-pill i,
        .mapping-shell-meta-pill i,
        .email-template-meta-pill i {
            font-size: 14px;
            color: var(--accent);
        }

        .trigger-form-grid {
            display: grid;
            grid-template-columns: minmax(0, 2.2fr) minmax(0, 1.4fr) minmax(0, 1.4fr) minmax(0, 1.2fr);
            gap: 12px 16px;
        }

        @media (max-width: 992px) {
            .trigger-form-grid {
                grid-template-columns: minmax(0, 1fr);
            }
        }

        .trigger-form-footer,
        .mapping-form-footer {
            margin-top: 10px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            flex-wrap: wrap;
        }

        .trigger-form-helper,
        .mapping-form-helper {
            font-size: 11px;
            color: #9ca3af;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .trigger-form-helper i,
        .mapping-form-helper i {
            font-size: 13px;
        }

        .mapping-form-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 12px 16px;
        }

        @media (max-width: 992px) {
            .mapping-form-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 640px) {
            .mapping-form-grid {
                grid-template-columns: minmax(0, 1fr);
            }
        }

        .top-bar-wrap {
            border-radius: 999px;
            border: 1px solid #e5e7eb;
            background: #f9fafb;
            padding: 6px 10px;
            margin-bottom: 14px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 8px;
            flex-wrap: wrap;
        }

        .email-template-body {
            margin-top: 4px;
        }

        .flex-row {
            display: flex;
            gap: 18px;
            align-items: flex-start;
        }

        .col-left {
            flex: 2 1 0;
            min-width: 0;
        }

        .templates-table-wrap {
            flex: 1.4 1 0;
            min-width: 0;
        }

        @media (max-width: 992px) {
            .flex-row {
                flex-direction: column;
            }

            .templates-table-wrap {
                width: 100%;
            }
        }

        .section-heading {
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .08em;
            color: var(--ink);
            margin: 10px 0 6px;
        }

        .row-tight {
            margin-left: -6px;
            margin-right: -6px;
        }

        .row-tight > [class^="col-"],
        .row-tight > [class*=" col-"] {
            padding-left: 6px;
            padding-right: 6px;
        }

        .editor-wrapper {
            margin-top: 8px;
            border-radius: 14px;
            border: 1px solid #e5e7eb;
            background: #ffffff;
            box-shadow: 0 10px 28px rgba(15, 23, 42, .10);
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        .editor-toolbar-strip {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            padding: 8px 10px;
            border-bottom: 1px solid #e5e7eb;
            background: #f9fafb;
            font-size: 12px;
            font-weight: 600;
            color: #4b5563;
        }

        .editor-toolbar-left,
        .editor-toolbar-right {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
        }

        .editor-toolbar-title {
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .08em;
            color: var(--muted);
        }

        #tpl_var_insert {
            width: 400px;
            max-width: 100%;
            font-size: 13px;
            height: 36px;
            border-radius: 999px;
            border: 1px solid #d1d5db;
            padding: 6px 10px;
            box-sizing: border-box;
            color: #1f2937;
            background: linear-gradient(to right, #ffffff, #f9fafb);
            transition: all .2s ease-in-out;
            box-shadow: 0 1px 2px rgba(0, 0, 0, .04);
        }

        #tpl_var_insert:focus {
            border-color: #2563eb !important;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, .2);
            background: #fff;
            outline: none;
        }

        .editor-help-btn {
            border-radius: 999px;
            border: 1px solid #e5e7eb;
            background: #ffffff;
            font-size: 11px;
            padding: 4px 10px;
            color: #374151;
            cursor: pointer;
        }

        .editor-area {
            min-height: 320px;
            background: #fff;
            padding: 0;
        }

        #tpl_editor_html {
            width: 100%;
            min-height: 320px;
            border: 0;
            outline: 0;
            padding: 12px;
            font-size: 13px;
            line-height: 1.5;
            color: #1f2937;
            box-sizing: border-box;
            resize: vertical;
            font-family: -apple-system, BlinkMacSystemFont, "SF Pro Text", system-ui, "Segoe UI", sans-serif;
        }

        .editor-mode-bar {
            padding: 6px 8px;
            border-top: 1px solid #e5e7eb;
            display: flex;
            justify-content: flex-end;
            gap: 6px;
            background: #f9fafb;
            font-size: 12px;
            font-weight: 600;
            color: #4b5563;
        }

        .editor-mode-btn {
            border-radius: 999px;
            border: 1px solid #e5e7eb;
            background: #ffffff;
            font-size: 11px;
            padding: 3px 10px;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            color: #111827;
            font-weight: 600;
        }

        #tpl_plain_wrap {
            margin-top: 16px;
            display: none;
        }

        .plain-head-row {
            display: flex;
            align-items: baseline;
            gap: 6px;
            margin-top: 10px;
        }

        .plain-head-row span {
            font-size: 12px;
            font-weight: 600;
            color: var(--ink);
        }

        .plain-head-hint {
            font-size: 11px;
            color: var(--muted);
        }

        #tpl_plaintext {
            width: 100%;
            min-height: 180px;
            margin-top: 6px;
            border-radius: 10px;
            border: 1px solid #e5e7eb;
            padding: 8px 10px;
            font-size: 13px;
            line-height: 1.5;
            font-family: -apple-system, BlinkMacSystemFont, "SF Pro Text", system-ui, "Segoe UI", sans-serif;
            color: #1f2937;
            box-sizing: border-box;
            resize: vertical;
        }

        .drafts-table-wrap {
            margin-top: 16px;
        }

        .drafts-header,
        .templates-header,
        .trigger-table-header,
        .mapping-table-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            padding: 10px 16px;
            border-bottom: 1px solid #e5e7eb;
            background: #f9fafb;
        }

        .drafts-header-left,
        .templates-header-left,
        .trigger-table-header-left {
            min-width: 0;
        }

        .drafts-title,
        .templates-title,
        .trigger-table-title,
        .mapping-table-title {
            font-size: 13px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .08em;
            color: var(--ink);
        }

        .drafts-sub,
        .templates-sub,
        .trigger-table-sub,
        .mapping-table-sub {
            font-size: 11px;
            color: var(--muted);
            margin-top: 1px;
        }

        .drafts-header-right,
        .templates-header-right,
        .trigger-table-header-right,
        .mapping-table-header-right {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
        }

        .drafts-count-pill,
        .templates-count-pill,
        .trigger-count-pill,
        .mapping-count-pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: .25rem .65rem;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 600;
            color: #111827;
            background: #f3f4f6;
            border: 1px solid #e5e7eb;
        }

        .drafts-count-pill i,
        .templates-count-pill i,
        .trigger-count-pill i,
        .mapping-count-pill i {
            font-size: 13px;
            color: var(--accent);
        }

        .trigger-table-filter-chip {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: .25rem .7rem;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 500;
            color: #111827;
            background: #ffffff;
            border: 1px solid #e5e7eb;
            cursor: default;
        }

        .trigger-table-filter-chip i {
            font-size: 13px;
            color: #16a34a;
        }

        .templates-badge-status {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: .22rem .55rem;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 500;
            color: #15803d;
            background: #ecfdf3;
            border: 1px solid #bbf7d0;
        }

        .templates-badge-status i {
            font-size: 13px;
        }

        .drafts-shell .table-responsive,
        .templates-shell .table-responsive,
        .trigger-table-shell .table-responsive,
        .mapping-table-shell .table-responsive {
            margin-bottom: 0;
        }

        #triggersTable,
        #mappingsTable,
        #templatesTable,
        #draftsTable {
            margin-bottom: 0;
            font-size: 13px;
            border-collapse: separate;
            border-spacing: 0;
            width: 100%;
        }

        #triggersTable thead tr,
        #mappingsTable thead tr,
        #templatesTable thead tr,
        #draftsTable thead tr {
            background: #f9fafb;
            border-bottom: 1px solid #e5e7eb;
            color: #4b5563;
            font-weight: 600;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: .10em;
        }

        #triggersTable thead th,
        #mappingsTable thead th,
        #templatesTable thead th,
        #draftsTable thead th {
            border-bottom: none;
            padding: .5rem .85rem;
            white-space: nowrap;
        }

        #triggersTable thead th:first-child,
        #mappingsTable thead th:first-child,
        #templatesTable thead th:first-child,
        #draftsTable thead th:first-child {
            padding-left: 1rem;
        }

        #triggersTable thead th:last-child,
        #mappingsTable thead th:last-child,
        #templatesTable thead th:last-child,
        #draftsTable thead th:last-child {
            padding-right: 1rem;
            text-align: right;
        }

        #triggersTable tbody tr,
        #mappingsTable tbody tr,
        #templatesTable tbody tr,
        #draftsTable tbody tr {
            border-bottom: 1px solid #f1f5f9;
            transition: background-color .12s ease, transform .08s ease, box-shadow .12s ease;
        }

        #triggersTable tbody tr:nth-child(2n) {
            background-color: #fcfdff;
        }

        #triggersTable tbody tr:last-child,
        #mappingsTable tbody tr:last-child,
        #templatesTable tbody tr:last-child,
        #draftsTable tbody tr:last-child {
            border-bottom: none;
        }

        #triggersTable tbody td,
        #mappingsTable tbody td,
        #templatesTable tbody td,
        #draftsTable tbody td {
            vertical-align: middle;
            padding: .5rem .85rem;
        }

        #triggersTable tbody td:first-child,
        #mappingsTable tbody td:first-child,
        #templatesTable tbody td:first-child,
        #draftsTable tbody td:first-child {
            padding-left: 1rem;
        }

        #triggersTable tbody td:last-child,
        #mappingsTable tbody td:last-child,
        #templatesTable tbody td:last-child,
        #draftsTable tbody td:last-child {
            padding-right: 1rem;
            text-align: right;
        }

        #triggersTable tbody tr:hover,
        #templatesTable tbody tr:hover {
            background: #f3f4f6;
            transform: translateY(-1px);
            box-shadow: 0 8px 18px rgba(15, 23, 42, .08);
        }

        #mappingsTable tbody tr:hover,
        #draftsTable tbody tr:hover {
            background: #f3f4f6;
        }

        .key-cell,
        .tpl-code-cell {
            font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
            font-size: 12px;
            color: #111827;
            max-width: 320px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .tpl-code-cell {
            max-width: 260px;
        }

        .tpl-actions-cell,
        .mapping-actions-cell {
            white-space: nowrap;
        }

        .tpl-actions-cell .btn,
        .mapping-actions-cell .btn {
            border-radius: 999px;
            font-size: 12px;
            line-height: 1.2;
            padding: .3rem .6rem;
            margin-right: 4px;
        }

        .tpl-actions-cell .btn:last-child,
        .mapping-actions-cell .btn:last-child {
            margin-right: 0;
        }

        .drafts-footer-note {
            display: flex;
            align-items: center;
            gap: 6px;
            padding: 8px 16px 10px;
            font-size: 12px;
            color: var(--muted);
            background: #ffffff;
        }

        .drafts-footer-note i {
            font-size: 14px;
            color: var(--accent);
        }

        .badge-entity,
        .badge-type {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            font-size: 11px;
            font-weight: 600;
            border-radius: 999px;
            padding: .22rem .6rem;
            border: 1px solid transparent;
            white-space: nowrap;
        }

        .badge-entity {
            background: #eff6ff;
            color: #1d4ed8;
            border-color: #dbeafe;
        }

        .badge-type {
            background: #ecfeff;
            color: #0e7490;
            border-color: #a5f3fc;
        }

        .badge-entity i,
        .badge-type i {
            font-size: 13px;
        }

        .status-pill {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            font-size: 11px;
            font-weight: 600;
            border-radius: 999px;
            padding: .25rem .6rem;
        }

        .status-pill i {
            font-size: 13px;
        }

        .status-active {
            background: #ecfdf3;
            color: #15803d;
            border: 1px solid #bbf7d0;
        }

        .status-inactive {
            background: #fef2f2;
            color: #b91c1c;
            border: 1px solid #fecaca;
        }

        .table-action-group,
        .tpl-actions {
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .btn-icon-soft,
        .tpl-btn-icon {
            border-radius: 999px;
            border: 1px solid #e5e7eb;
            background: #ffffff;
            width: 28px;
            height: 28px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            color: #4b5563;
            cursor: pointer;
            transition: background .12s ease, border-color .12s ease, box-shadow .12s ease, transform .08s ease, color .12s ease;
        }

        .btn-icon-soft {
            width: 30px;
            height: 30px;
        }

        .btn-icon-soft:hover,
        .tpl-btn-icon:hover {
            background: #f3f4f6;
            border-color: #cbd5e1;
            color: #111827;
            box-shadow: 0 8px 16px rgba(15, 23, 42, .14);
            transform: translateY(-1px);
        }

        .btn-icon-soft-danger,
        .tpl-btn-icon-danger {
            color: #b91c1c;
            border-color: #fecaca;
            background: #fef2f2;
        }

        .btn-icon-soft-danger:hover,
        .tpl-btn-icon-danger:hover {
            background: #fee2e2;
            border-color: #fca5a5;
            color: #7f1d1d;
        }

        .tpl-version-pill {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: .18rem .5rem;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 500;
            background: #eef2ff;
            color: #3730a3;
            border: 1px solid #e0e7ff;
        }

        .tpl-active-pill {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: .18rem .5rem;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 500;
            background: #ecfdf3;
            color: #15803d;
            border: 1px solid #bbf7d0;
        }

        .tpl-inactive-pill {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: .18rem .5rem;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 500;
            background: #fef2f2;
            color: #b91c1c;
            border: 1px solid #fecaca;
        }

        .select2-container--bootstrap4 .select2-selection--single {
            height: 42px !important;
            border: 1px solid #d1d5db !important;
            line-height: 1.2;
            border-radius: 999px !important;
            display: flex !important;
            align-items: center;
            padding-left: 10px;
            transition: all .2s ease-in-out;
            background: linear-gradient(to right, #ffffff, #f9fafb);
            font-size: 13px;
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

        .form-control {
            border-radius: 999px;
            border: 1px solid #d1d5db;
            font-size: 14px;
            line-height: 1.4;
            margin-bottom: 10px;
            color: #111827;
            height: 42px;
            padding: 9px 15px;
            background: #f9fafb;
            transition: border-color .15s ease, box-shadow .15s ease, background .15s ease, transform .08s ease;
            font-family: -apple-system, BlinkMacSystemFont, "SF Pro Text", system-ui, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
        }

        .form-control:focus {
            border-color: #2563eb;
            background: #ffffff;
            box-shadow: 0 0 0 1px #2563eb, 0 0 0 4px rgba(37, 99, 235, .15);
            outline: none;
            transform: translateY(-1px);
        }

        .form-control::placeholder {
            color: #9ca3af;
            opacity: 1;
            font-size: 13px;
        }

        .form-control:disabled,
        .form-control[readonly] {
            background: #f3f4f6;
            opacity: .8;
            cursor: not-allowed;
        }

        select.form-control {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background-image: linear-gradient(45deg, transparent 50%, #9ca3af 50%), linear-gradient(135deg, #9ca3af 50%, transparent 50%);
            background-position: calc(100% - 16px) 17px, calc(100% - 11px) 17px;
            background-size: 5px 5px, 5px 5px;
            background-repeat: no-repeat;
            padding-right: 32px;
            cursor: pointer;
        }

        textarea.form-control {
            min-height: 120px;
            border-radius: 16px;
            resize: vertical;
            padding: 12px 16px;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        #tpl_attach_list.attachments-bar {
            border: none;
            border-radius: 0;
            background: transparent;
            padding: 0;
        }

        .attach-list {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .attach-add-row {
            display: flex;
            justify-content: flex-start;
        }

        .att-add-btn {
            border-radius: 999px;
            border: 1px dashed #9ca3af;
            background: #ffffff;
            font-size: 12px;
            font-weight: 600;
            padding: .4rem .9rem;
            line-height: 1.2;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: #111827;
            cursor: pointer;
            transition: background .12s ease, border-color .12s ease, box-shadow .12s ease, transform .08s ease, color .12s ease;
        }

        .att-add-btn:hover {
            background: #f9fafb;
            border-color: #2563eb;
            color: #2563eb;
            box-shadow: 0 4px 10px rgba(15,23,42,.08);
            transform: translateY(-1px);
        }

        .attach-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            padding: 8px 12px;
            border-radius: 12px;
            border: 1px solid #edf1f5;
            background: #ffffff;
            transition: background .12s ease, box-shadow .12s ease, transform .08s ease;
        }

        .attach-item:hover {
            background: #f9fafb;
            box-shadow: 0 4px 10px rgba(15, 23, 42, .05);
            transform: translateY(-1px);
        }

        .attach-left {
            display: flex;
            align-items: center;
            gap: 8px;
            min-width: 0;
            flex: 1 1 auto;
        }

        .attach-icon {
            flex-shrink: 0;
            width: 26px;
            height: 26px;
            border-radius: 999px;
            background: #eff6ff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
        }

        .attach-meta {
            display: flex;
            flex-direction: column;
            gap: 2px;
            min-width: 0;
        }

        .attach-name {
            font-weight: 600;
            font-size: 13px;
            color: #111827;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .attach-size {
            font-size: 11px;
            color: #6b7280;
        }

        .att-actions {
            display: flex;
            align-items: center;
            gap: 6px;
            flex-shrink: 0;
        }

        .att-btn {
            font-size: 11px;
            border-radius: 999px;
            border: 1px solid #d1d5db;
            background: #ffffff;
            line-height: 1.2;
            padding: .32rem .7rem;
            font-weight: 600;
            cursor: pointer;
            transition: background .12s ease, border-color .12s ease, box-shadow .12s ease, transform .08s ease, color .12s ease;
        }

        .att-btn:hover {
            background: #f3f4f6;
            border-color: #cbd5e1;
            box-shadow: 0 4px 10px rgba(15, 23, 42, .08);
            transform: translateY(-1px);
        }

        .att-btn-outline {
            color: #111827;
        }

        .att-btn-danger {
            border-color: #fecaca;
            background: #fef2f2;
            color: #b91c1c;
        }

        .att-btn-danger:hover {
            background: #fee2e2;
            border-color: #fca5a5;
            color: #7f1d1d;
        }

    </style>
@endpush

@section('main')
    <div class="">
        <div class="page-inner">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-pills" id="emailAdminTabs" role="tablist">
                        <li class="nav-item"><a class="nav-link" data-toggle="pill"
                                                data-target="#tab-triggers">Triggers</a></li>
                        <li class="nav-item"><a class="nav-link" data-toggle="pill" data-target="#tab-templates">Templates</a>
                        </li>
                        <li class="nav-item"><a class="nav-link" data-toggle="pill" data-target="#tab-drafts">Drafts</a>
                        </li>
                        <li class="nav-item"><a class="nav-link" data-toggle="pill"
                                                data-target="#tab-mappings">Mappings</a></li>
                    </ul>
                    <div class="tab-box-shell">
                        <div class="tab-content">
                            <div class="tab-pane fade" id="tab-triggers">
                                <div class="tab-pane-inner">@include('crm.email.partials.triggers')</div>
                            </div>
                            <div class="tab-pane fade" id="tab-templates">
                                <div class="tab-pane-inner">@include('crm.email.partials.templates')</div>
                            </div>
                            <div class="tab-pane fade" id="tab-drafts">
                                <div class="tab-pane-inner">@include('crm.email.partials.drafts')</div>
                            </div>
                            <div class="tab-pane fade" id="tab-mappings">
                                <div class="tab-pane-inner">@include('crm.email.partials.mappings')</div>
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
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>

    <script>
        var ROUTE_UPLOAD = '{{ route("crm.email.templates.upload-asset") }}';
        var ROUTE_STORE_TPL = '{{ route("crm.email.templates.store") }}';
        var ROUTE_STORE_DRAFT = '{{ route("crm.email.templates.store-draft") }}';
        var ROUTE_PUBLISH_BASE = '{{ url("crm/email/templates") }}';
        var ROUTE_VAR_LOOKUP = '{{ route("crm.email.lookups.variables") }}';
        var ROUTE_TRIGGERS = '{{ route("crm.email.triggers.index") }}';
        var ROUTE_TRG_STORE = '{{ route("crm.email.triggers.store") }}';
        var ROUTE_TEMPLATES = '{{ route("crm.email.templates.index") }}';
        var ROUTE_TPL_BASE = '{{ url("crm/email/templates") }}';
        var ROUTE_MAPPINGS = '{{ route("crm.email.mappings.index") }}';
        var ROUTE_MAP_STORE = '{{ route("crm.email.mappings.store") }}';
        var ROUTE_STATUSES = '{{ route("crm.email.lookups.learner-statuses") }}';
        var ROUTE_TRIG_KEYS = '{{ route("crm.email.lookups.trigger-keys") }}';
        var ROUTE_TRG_DELETE_BASE = '{{ url("crm/email/triggers") }}';
        var ROUTE_MAP_DELETE_BASE = '{{ url("crm/email/mappings") }}';
        var CSRF_TOKEN = '{{ csrf_token() }}';
    </script>

    @verbatim
        <script>
            (function ($) {
                'use strict';
                $.ajaxSetup({headers: {'X-CSRF-TOKEN': CSRF_TOKEN}});

                function toastOk(m) {
                    Swal.fire({toast: true, position: 'top-end', icon: 'success', title: m || 'Done', timer: 1500, showConfirmButton: false});
                }
                function toastErr(m) {
                    Swal.fire({toast: true, position: 'top-end', icon: 'error', title: m || 'Failed', timer: 2500, showConfirmButton: false});
                }
                function extractLaravelError(xhr) {
                    if (xhr && xhr.responseJSON) {
                        if (xhr.responseJSON.errors) {
                            var f = Object.keys(xhr.responseJSON.errors)[0];
                            if (f && xhr.responseJSON.errors[f] && xhr.responseJSON.errors[f][0]) return xhr.responseJSON.errors[f][0];
                        }
                        if (xhr.responseJSON.message) return xhr.responseJSON.message;
                    }
                    if (xhr && xhr.statusText) return xhr.statusText;
                    return 'Request failed';
                }
                function isValidEmail(e) { return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test((e || '').trim()); }
                function inlineEmailErrorArea(sel, msg) {
                    var $a = $(sel);
                    $a.next('.field-error-help').remove();
                    if (msg && msg.length) {
                        $a.addClass('invalid');
                        $('<div class="field-error-help">' + msg + '</div>').insertAfter($a);
                    } else { $a.removeClass('invalid'); }
                }
                function pendingText(areaSel) {
                    var $inp = $(areaSel).find('input.rec-input');
                    return ($inp.length ? ($inp.val() || '').trim() : '');
                }
                function normalizePendingToPill(areaSel) {
                    var $area = $(areaSel.jquery ? areaSel : $(areaSel));
                    var v = pendingText($area);
                    if (!v) return true;
                    if (!isValidEmail(v)) return false;
                    var p = $('<div style="background:#eef2ff;border:1px solid #c7d2fe;border-radius:9999px;font-size:12px;font-weight:600;line-height:1.2;padding:.35rem .6rem;color:#4338ca;display:flex;align-items:center;gap:4px;"></div>');
                    var t = $('<span/>').text(v);
                    var c = $('<span style="font-size:11px;line-height:1;color:#4b5563;cursor:pointer;">×</span>');
                    c.on('click', function () { p.remove(); });
                    p.append(t).append(c);
                    var $inp = $area.find('input.rec-input');
                    if ($inp.length) $inp.before(p); else $area.append(p);
                    if ($inp.length) $inp.val('');
                    return true;
                }
                function pillBox(sel, opts) {
                    var onChange = (opts && typeof opts.onChange === 'function') ? opts.onChange : null;
                    var $a = $(sel);
                    $a.empty();
                    var i = $('<input type="text" class="rec-input" style="border:none;outline:none;min-width:120px;font-size:13px;line-height:1.4;padding:4px 2px;color:#1f2937;background:transparent;">');
                    i.on('keydown', function (e) {
                        if (e.key === 'Enter') {
                            e.preventDefault();
                            var v = ($(this).val() || '').trim();
                            if (!v) return;
                            if (!isValidEmail(v)) { toastErr('Enter a valid email'); return; }
                            normalizePendingToPill($a);
                            if (onChange) onChange();
                        }
                        if (e.key === 'Backspace' && !$(this).val()) {
                            var ps = $a.children('div');
                            if (ps.length) { ps.last().remove(); if (onChange) onChange(); }
                        }
                    }).on('blur', function () {
                        var val = ($(this).val() || '').trim();
                        if (val.length) {
                            if (!isValidEmail(val)) { inlineEmailErrorArea($a, 'Enter a valid email'); return; }
                            normalizePendingToPill($a);
                        }
                        inlineEmailErrorArea($a, '');
                        if (onChange) onChange();
                    });
                    $a.append(i);
                }
                function collectEmailsFromPillBox(s) {
                    var out = [], $a = $(s);
                    $a.children('div').each(function () {
                        var t = $(this).find('span').first().text().trim();
                        if (t) out.push(t);
                    });
                    return out;
                }
                function initTriggerKeySelect() {
                    if (!$.fn || !$.fn.select2) return;
                    var $el = $('#trigger_key_select');
                    if (!$el.length || $el.data('select2')) return;
                    $el.select2({
                        theme: 'bootstrap4',
                        tags: true,
                        placeholder: 'Select or type a trigger key',
                        ajax: {
                            url: ROUTE_TRIG_KEYS,
                            dataType: 'json',
                            delay: 200,
                            data: function (p) { return {q: p.term || ''}; },
                            processResults: function (d) { return {results: d}; }
                        }
                    });
                }
                function bindTriggerForm() {
                    $('#triggerForm').off('submit.crmemails').on('submit.crmemails', function (e) {
                        e.preventDefault();
                        var payload = $(this).serializeArray().reduce(function (o, x) { o[x.name] = x.value; return o; }, {});
                        payload.key = $('#trigger_key_select').val();
                        $.post(ROUTE_TRG_STORE, payload).done(function () {
                            toastOk('Trigger created'); loadTriggers(); $('#triggerForm')[0].reset(); $('#trigger_key_select').val(null).trigger('change');
                        }).fail(function (xhr) { toastErr(extractLaravelError(xhr)); });
                    });
                }
                function bindDeleteButtons() {
                    $(document).off('click.del-trigger').on('click.del-trigger', '.del-trigger', function (e) {
                        e.preventDefault();
                        var id = $(this).data('id');
                        $.ajax({url: ROUTE_TRG_DELETE_BASE + '/' + id, type: 'DELETE'}).done(function () { toastOk('Trigger deleted'); loadTriggers(); }).fail(function (xhr) { toastErr(extractLaravelError(xhr)); });
                    });
                    $(document).off('click.del-mapping').on('click.del-mapping', '.del-mapping', function (e) {
                        e.preventDefault();
                        var id = $(this).data('id');
                        $.ajax({url: ROUTE_MAP_DELETE_BASE + '/' + id, type: 'DELETE'}).done(function () { toastOk('Mapping deleted'); loadMappings(); }).fail(function (xhr) { toastErr(extractLaravelError(xhr)); });
                    });
                    $(document).off('click.del-template').on('click.del-template', '.del-template', function (e) {
                        e.preventDefault();
                        var id = $(this).data('id');
                        Swal.fire({title: 'Delete this template?', text: 'This will permanently remove the template and all versions.', icon: 'warning', showCancelButton: true, confirmButtonText: 'Delete'}).then(function (r) {
                            if (!r.isConfirmed) return;
                            $.ajax({url: ROUTE_TPL_BASE + '/' + id, type: 'DELETE', headers: {'X-CSRF-TOKEN': CSRF_TOKEN}})
                                .done(function () { toastOk('Template deleted'); loadTemplates(); loadDrafts(); })
                                .fail(function (xhr) { toastErr(extractLaravelError(xhr)); });
                        });
                    });
                    $(document).off('click.pub-template').on('click.pub-template', '.pub-template', function (e) {
                        e.preventDefault();
                        var id = $(this).data('id');
                        $.post(ROUTE_PUBLISH_BASE + '/' + id + '/publish', {_token: CSRF_TOKEN}).done(function () { toastOk('Draft published'); loadTemplates(); loadDrafts(); }).fail(function (xhr) { toastErr(extractLaravelError(xhr)); });
                    });
                }

                var tplEditorInstance = null;
                var attachmentsDraft = [];

                function initTemplateEditor() {
                    if (!document.querySelector('#tpl_editor_html')) return;
                    tinymce.init({
                        selector: '#tpl_editor_html',
                        height: 420,
                        menubar: true,
                        plugins: 'lists link image table code paste autoresize',
                        toolbar: 'undo redo | styleselect | bold italic underline | alignleft aligncenter alignright | bullist numlist | link image table | code',
                        paste_data_images: true,
                        convert_urls: false,
                        branding: false,
                        images_upload_handler: function (blobInfo, success, failure) {
                            var xhr = new XMLHttpRequest(); xhr.open('POST', ROUTE_UPLOAD);
                            xhr.setRequestHeader('X-CSRF-TOKEN', CSRF_TOKEN);
                            xhr.onreadystatechange = function () {
                                if (xhr.readyState !== 4) return;
                                if (xhr.status >= 200 && xhr.status < 300) {
                                    try { var res = JSON.parse(xhr.responseText || '{}'); if (res && res.url) success(res.url); else failure('Invalid response'); }
                                    catch (e) { failure('Upload parse error'); }
                                } else { failure('HTTP ' + xhr.status); }
                            };
                            var fd = new FormData(); fd.append('file', blobInfo.blob()); xhr.send(fd);
                        },
                        setup: function (ed) {
                            ed.on('init', function () { tplEditorInstance = ed; window.tplEditorInstance = ed; window.TPL_ED = ed; });
                        },
                        content_style: 'body{font-family:system-ui,-apple-system,Segoe UI,Roboto,Helvetica,Arial,sans-serif;font-size:14px;}'
                    });
                }

                function initVarSelectForTemplate() {
                    if (!$.fn.select2) return;
                    var full = [];
                    $('#tpl_var_insert').select2({
                        theme: 'bootstrap4',
                        placeholder: 'Insert variable…',
                        ajax: { url: ROUTE_VAR_LOOKUP, dataType: 'json', delay: 200, processResults: function (d) { full = d; return {results: d}; } }
                    }).on('select2:select', function (e) {
                        var token = e.params.data.id || '';
                        if (token) {
                            if (tplEditorInstance && tplEditorInstance.insertContent) { tplEditorInstance.focus(); tplEditorInstance.insertContent(token); }
                            else {
                                var el = document.activeElement;
                                if (el && (el.tagName === 'TEXTAREA' || (el.tagName === 'INPUT' && el.type === 'text'))) {
                                    var start = el.selectionStart || 0, end = el.selectionEnd || 0, v = el.value || '';
                                    el.value = v.slice(0, start) + token + v.slice(end);
                                    try { el.setSelectionRange(start + token.length, start + token.length); } catch (e) {}
                                }
                            }
                        }
                        setTimeout(function () { $('#tpl_var_insert').val(null).trigger('change'); }, 0);
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
                            if (tplEditorInstance) return tplEditorInstance;
                            if (window.tplEditorInstance) return window.tplEditorInstance;
                            if (window.TPL_ED) return window.TPL_ED;
                            return null;
                        }
                        function insertToken(token) {
                            var t = token || '';
                            if (!t) return;
                            var ed = getEditor();
                            if (ed && ed.insertContent) { ed.focus(); ed.insertContent(t); return; }
                            var el = document.activeElement;
                            if (el && (el.tagName === 'TEXTAREA' || (el.tagName === 'INPUT' && el.type === 'text'))) {
                                var start = el.selectionStart || 0, end = el.selectionEnd || 0, v = el.value || '';
                                el.value = v.slice(0, start) + t + v.slice(end);
                                try { el.setSelectionRange(start + t.length, start + t.length); } catch (e) {}
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
                                var tokens = kids.map(function (c) { return c.id || ''; }).filter(Boolean).join('\n');
                                if (tokens) insertToken(tokens);
                            });
                            $('#varSearch').on('input', function () {
                                var q = ($(this).val() || '').toLowerCase().trim();
                                $('.var-guide-group').each(function () {
                                    var any = false;
                                    $(this).find('.var-row').each(function () {
                                        var c = ($(this).data('code') || '').toLowerCase();
                                        var d = ($(this).data('desc') || '').toLowerCase();
                                        var hit = !q || c.includes(q) || d.includes(q);
                                        $(this).css('display', hit ? 'flex' : 'none');
                                        if (hit) any = true;
                                    });
                                    $(this).css('display', any ? 'block' : 'none');
                                });
                            });
                        }
                        function openGuide(groups) {
                            Swal.fire({width: '900px', title: '📘 Variable Dictionary', html: renderGuide(groups), showConfirmButton: true, confirmButtonText: 'Close', didOpen: function () { wireModal(groups); }});
                        }
                        $.get(ROUTE_VAR_LOOKUP, {all: 1})
                            .done(function (d) { openGuide(Array.isArray(d) ? d : []); })
                            .fail(function () {
                                $.get(ROUTE_VAR_LOOKUP)
                                    .done(function (d2) { openGuide(Array.isArray(d2) ? d2 : []); })
                                    .fail(function () { openGuide([]); });
                            });
                    });

                    var $btn = $('#bulkInsertBtn'), $menu = $('#bulkMenu');
                    $btn.on('click', function () {
                        if (!$menu.hasClass('open')) { build(full); $menu.addClass('open'); } else { $menu.removeClass('open'); }
                    });
                    $(document).on('click', function (evt) {
                        var $t = $(evt.target);
                        if (!$t.closest('.bulk-insert-wrap').length && !$t.closest('#bulkInsertBtn').length) { $menu.removeClass('open'); }
                    });
                    function build(groups) {
                        $menu.empty();
                        if (!groups || !groups.length) {
                            $menu.append($('<div/>', {text: 'No variables available', css: {fontSize: '12px', color: '#6b7280', padding: '.6rem .75rem'}}));
                            return;
                        }
                        groups.forEach(function (g) {
                            var label = g.text || 'Group';
                            var kids = Array.isArray(g.children) ? g.children : [];
                            if (!kids.length) return;
                            var b = $('<button/>', {'class': 'bulk-menu-btn', 'data-group': label, type: 'button'});
                            b.append($('<div/>', {text: 'Insert all from ' + label}));
                            b.append($('<div/>', {'class': 'small-hint', text: kids.length + ' fields'}));
                            b.on('click', function () { ins(kids); $menu.removeClass('open'); });
                            $menu.append(b);
                        });
                    }
                    function ins(list) {
                        if (!list || !list.length) return;
                        var tokens = list.map(function (c) { return c.id || ''; }).filter(function (t) { return t && t.length; }).join('\n');
                        if (!tokens.length) return;
                        if (tplEditorInstance && tplEditorInstance.insertContent) { tplEditorInstance.focus(); tplEditorInstance.insertContent(tokens); }
                    }
                }

                function insertFooterImage(url) {
                    if (!tplEditorInstance || !url) return;
                    var cur = tplEditorInstance.getContent() || '';
                    var foot = '<p style="margin-top:24px;text-align:center;"><img src="' + url + '" style="max-width:100%;border-radius:8px" /></p>';
                    tplEditorInstance.setContent(cur + foot);
                }

                function showPreviewModal() {
                    var subj = $('#tpl_subject').val() || '(no subject)';
                    var htmlBody = tplEditorInstance ? tplEditorInstance.getContent() : '';
                    var attHtml = '';
                    if (!attachmentsDraft.length) {
                        attHtml = '<div style="color:#6b7280;font-size:12px;">No attachments</div>';
                    } else {
                        attHtml = '<ul style="font-size:12px;line-height:1.4;margin:0;padding-left:16px;">';
                        attachmentsDraft.forEach(function (a) {
                            attHtml += '<li><strong>' + ($('<div/>').text(a.nameOriginal || a.nameStored || '').html()) + '</strong> <span style="color:#6b7280;">' + (a.size || '') + '</span></li>';
                        });
                        attHtml += '</ul>';
                    }
                    Swal.fire({
                        width: '800px',
                        title: 'Preview',
                        html:
                            '<div style="text-align:left;font-size:13px;line-height:1.5;max-height:70vh;overflow:auto;">' +
                            '<div style="margin-bottom:12px;"><div style="font-size:12px;font-weight:700;color:#4b5563;text-transform:uppercase;letter-spacing:.03em;">Subject</div><div style="font-size:14px;font-weight:600;color:#111827;">' + ($('<div/>').text(subj).html()) + '</div></div>' +
                            '<div style="margin-bottom:12px;"><div style="font-size:12px;font-weight:700;color:#4b5563;text-transform:uppercase;letter-spacing:.03em;">HTML Body</div><div style="border:1px solid #e5e7eb;border-radius:8px;padding:12px;background:#fff;color:#1f2937;font-size:13px;line-height:1.5;">' + htmlBody + '</div></div>' +
                            '<div><div style="font-size:12px;font-weight:700;color:#4b5563;text-transform:uppercase;letter-spacing:.03em;">Attachments</div>' + attHtml + '</div>' +
                            '</div>',
                        showConfirmButton: true,
                        confirmButtonText: 'Close'
                    });
                }

                function bindTemplateForm() {
                    var $form = $('#templateForm');
                    $.validator.addMethod("ckrequired", function () {
                        if (tplEditorInstance) {
                            var data = (tplEditorInstance.getContent() || '').replace(/<[^>]*>/g, '').replace(/&nbsp;/g, '').trim();
                            return data.length > 0;
                        }
                        return false;
                    }, "Email body is required");
                    $form.validate({
                        ignore: [],
                        rules: { newsletter_name: {required: true, minlength: 6, maxlength: 100}, code: {required: true, minlength: 3, maxlength: 100}, subject: {required: true, minlength: 2}, html_body: {ckrequired: true} },
                        messages: {
                            newsletter_name: { required: 'Name is required', minlength: 'Name must be at least 6 characters', maxlength: 'Name must be at most 100 characters' },
                            code: { required: "Template code is required", minlength: "Code must be at least 3 characters" },
                            category: {required: "Category is required"},
                            locale: { required: "Locale is required", maxlength: "Locale must be short (e.g. en, en-GB)" },
                            subject: {required: "Subject is required"},
                            created_by_email: { required: "Creator email is required", email: "Enter a valid email address" },
                            from_email: { required: "From email is required", email: "Enter a valid email address" },
                            html_body: {ckrequired: "Email body can't be empty"}
                        },
                        errorElement: 'div',
                        errorClass: 'field-error-help',
                        highlight: function (el) { $(el).closest('.form-control').css({ borderColor: '#dc2626', boxShadow: '0 0 0 3px rgba(220,38,38,.15)' }); },
                        unhighlight: function (el) { $(el).closest('.form-control').css({ borderColor: '#d1d5db', boxShadow: '0 0 0 0 rgba(0,0,0,0)' }); },
                        errorPlacement: function (error, element) {
                            var $wrap = element.closest('.form-group');
                            if ($wrap.length) { var $old = $wrap.find('.field-error-help'); if ($old.length) { $old.remove(); } $wrap.append(error); }
                            else { error.insertAfter(element); }
                        }
                    });
                    function buildPayload() {
                        var p = {};
                        p._token = CSRF_TOKEN;
                        p.code = $('#tpl_code').val() || '';
                        p.category = $('#tpl_category').val() || 'transactional';
                        p.locale = $('#tpl_locale').val() || 'en';
                        p.active = 1;
                        p.subject = $('#tpl_subject').val() || '';
                        p.layout_html = $('#tpl_layout_html').val() || '';
                        p.layout_text = $('#tpl_layout_text').val() || '';
                        p.html_body = tplEditorInstance ? tplEditorInstance.getContent() : '';
                        p.text_body = $('#tpl_plaintext').val() || '';
                        p.attachments = attachmentsDraft;
                        p.to_recipients = collectEmailsFromPillBox('#tpl_to_area');
                        p.cc_recipients = collectEmailsFromPillBox('#tpl_cc_area');
                        p.bcc_recipients = collectEmailsFromPillBox('#tpl_bcc_area');
                        p.from_name = $('#tpl_from_name').val() || '';
                        p.from_email = $('#tpl_from_email').val() || '';
                        p.created_by_name = $('#tpl_created_by_name').val() || '';
                        p.created_by_email = $('#tpl_created_by_email').val() || '';
                        p.data_source = $('#tpl_data_source').val() || '';
                        p.merge_field = $('#tpl_merge_field').val() || '';
                        p.newsletter_name = $('#tpl_newsletter_name').val() || '';
                        return p;
                    }
                    function validateCcBcc() {
                        normalizePendingToPill('#tpl_cc_area');
                        normalizePendingToPill('#tpl_bcc_area');
                        var cc = collectEmailsFromPillBox('#tpl_cc_area');
                        var bcc = collectEmailsFromPillBox('#tpl_bcc_area');
                        var badCc = cc.filter(function (e) { return !isValidEmail(e); });
                        var badBcc = bcc.filter(function (e) { return !isValidEmail(e); });
                        inlineEmailErrorArea('#tpl_cc_area', badCc.length ? 'Enter valid email(s) in CC' : '');
                        inlineEmailErrorArea('#tpl_bcc_area', badBcc.length ? 'Enter valid email(s) in BCC' : '');
                        return !badCc.length && !badBcc.length;
                    }
                    $('#tplSaveBtn').off('click.tplsave').on('click.tplsave', function () {
                        if (!$form.valid()) { toastErr('Please fix the highlighted fields'); return; }
                        if (!validateCcBcc()) { toastErr('Fix CC/BCC emails'); return; }
                        var payload = buildPayload();
                        if (payload.layout_html && payload.layout_html.indexOf('{{content}}') === -1) { toastErr('Layout HTML must include {{content}}'); return; }
                        if (payload.layout_text && payload.layout_text.indexOf('{{content}}') === -1) { toastErr('Layout Text must include {{content}}'); return; }
                        $.post(ROUTE_STORE_TPL, payload).done(function () { toastOk('Template created'); loadTemplates(); loadDrafts(); }).fail(function (xhr) { toastErr(extractLaravelError(xhr)); });
                    });
                    $('#tplSaveDraftBtn').off('click.tpldraft').on('click.tpldraft', function () {
                        if (!$form.valid()) { toastErr('Please fix the highlighted fields'); return; }
                        if (!validateCcBcc()) { toastErr('Fix CC/BCC emails'); return; }
                        var payload = buildPayload();
                        $.post(ROUTE_STORE_DRAFT, payload).done(function () { toastOk('Draft saved'); loadTemplates(); loadDrafts(); }).fail(function (xhr) { toastErr(extractLaravelError(xhr)); });
                    });
                    $('#tplPreviewBtn, #tplPreviewBtn2').off('click.tplpreview').on('click.tplpreview', function () { showPreviewModal(); });
                    $('#tplFooterImgBtn').off('click.tplfooterimg').on('click.tplfooterimg', function () {
                        Swal.fire({title: 'Footer image URL', input: 'url', inputLabel: 'Paste public image link', inputPlaceholder: 'https://example.com/footer-banner.png', showCancelButton: true, confirmButtonText: 'Insert'})
                            .then(function (r) { if (r.isConfirmed && r.value) insertFooterImage(r.value); });
                    });
                    $('#tplClearBtn').off('click.tplclear').on('click.tplclear', function () {
                        $('#tpl_newsletter_name,#tpl_subject,#tpl_created_by_name,#tpl_created_by_email,#tpl_data_source,#tpl_from_name,#tpl_from_email,#tpl_merge_field,#tpl_locale,#tpl_category,#tpl_code').val('');
                        $('#tpl_footer_variant').val('');
                        $('#tpl_plaintext').val('');
                        $('#tpl_layout_html').val('');
                        $('#tpl_layout_text').val('');
                        attachmentsDraft = [];
                        renderAttachmentList();
                        if (tplEditorInstance) tplEditorInstance.setContent('');
                        pillBox('#tpl_to_area');
                        pillBox('#tpl_cc_area', { onChange: function () { $('#tplSaveBtn,#tplSaveDraftBtn'); } });
                        pillBox('#tpl_bcc_area', { onChange: function () { $('#tplSaveBtn,#tplSaveDraftBtn'); } });
                    });
                    $('#tplSendBtn').off('click.tplsend').on('click.tplsend', function () {
                        Swal.fire({title: 'Send this newsletter?', text: 'This will send immediately to all mapped recipients.', icon: 'warning', showCancelButton: true, confirmButtonText: 'Send now'})
                            .then(function (res) { if (res.isConfirmed) toastOk('Send queued'); });
                    });
                    pillBox('#tpl_to_area');
                    pillBox('#tpl_cc_area', {onChange: validateCcBcc});
                    pillBox('#tpl_bcc_area', {onChange: validateCcBcc});
                }

                function bindMappingForm() {
                    $('#mappingForm').off('submit.mapform').on('submit.mapform', function (e) {
                        e.preventDefault();
                        var d = $(this).serialize();
                        $.post(ROUTE_MAP_STORE, d).done(function () { toastOk('Mapping created'); loadMappings(); }).fail(function (xhr) { toastErr(extractLaravelError(xhr)); });
                    });
                }

                function loadTriggers() {
                    $.get(ROUTE_TRIGGERS, function (rows) {
                        var tb = $('#triggersTable tbody').empty();
                        var sel = $('#mf_trigger').empty();
                        rows.forEach(function (r) {
                            var tr = $('<tr/>');
                            tr.append('<td>' + r.key + '</td>');
                            tr.append('<td>' + r.entity + '</td>');
                            tr.append('<td>' + r.type + '</td>');
                            tr.append('<td>' + (r.active ? 'Yes' : 'No') + '</td>');
                            tr.append('<td><button type="button" class="btn btn-sm btn-danger del-trigger" data-id="' + r.id + '">Delete</button></td>');
                            tb.append(tr);
                            sel.append('<option value="' + r.id + '">' + r.key + '</option>');
                        });
                    }).fail(function (xhr) { toastErr(extractLaravelError(xhr)); });
                }

                function renderTemplateRow(r, context) {
                    var openHref = ROUTE_TPL_BASE + '/' + r.id + '/composer';

                    var actions = '';
                    actions += '<a class="btn btn-sm btn-outline-primary" href="' + openHref + '" target="_blank">Open</a> ';
                    if (r.is_draft) {
                        actions += '<button type="button" class="btn btn-sm btn-success pub-template" data-id="' + r.id + '">Publish</button> ';
                    }
                    actions += '<button type="button" class="btn btn-sm btn-danger del-template" data-id="' + r.id + '">Delete</button>';

                    var tr = $('<tr/>');
                    tr.append('<td class="tpl-code-cell">' + r.code + '</td>');
                    tr.append('<td>' + (r.current_version ? r.current_version.version : '-') + '</td>');

                    if (context === 'drafts') {
                        var localesText = r.locales ? r.locales : '-';
                        tr.append('<td>' + localesText + '</td>');
                    } else {
                        tr.append('<td>' + (r.active ? 'Yes' : 'No') + '</td>');
                    }

                    tr.append('<td class="tpl-actions-cell">' + actions + '</td>');
                    return tr;
                }
                function loadTemplates() {
                    $.get(ROUTE_TEMPLATES, function (rows) {
                        var tb = $('#templatesTable tbody').empty();
                        var sel = $('#mf_template').empty();
                        var count = 0;
                        var activeCount = 0;

                        rows.forEach(function (r) {
                            if (r.is_draft) return;
                            tb.append(renderTemplateRow(r));
                            sel.append('<option value="' + r.id + '">' + r.code + '</option>');
                            count++;
                            if (r.active) activeCount++;
                        });

                        $('#tplCountLabel').text(count + ' version' + (count === 1 ? '' : 's'));
                        $('#tplActiveLabel').text(activeCount + ' active' + (activeCount === 1 ? '' : ''));

                    }).fail(function (xhr) {
                        toastErr(extractLaravelError(xhr));
                    });
                }

                function loadDrafts() {
                    $.get(ROUTE_TEMPLATES + '?draft=1', function (rows) {
                        var tb = $('#draftsTable tbody').empty();
                        var count = 0;

                        rows.forEach(function (r) {
                            tb.append(renderTemplateRow(r, 'drafts'));
                            count++;
                        });

                        $('#draftsCountLabel').text(count + ' draft' + (count === 1 ? '' : 's'));
                    }).fail(function (xhr) {
                        toastErr(extractLaravelError(xhr));
                    });
                }


                function loadMappings() {
                    $.get(ROUTE_MAPPINGS, function (rows) {
                        var tb = $('#mappingsTable tbody').empty();
                        rows.forEach(function (r) {
                            var tr = $('<tr/>');
                            tr.append('<td>' + (r.trigger ? r.trigger.key : r.trigger_id) + '</td>');
                            tr.append('<td>' + (r.template ? r.template.code : r.template_id) + '</td>');
                            tr.append('<td>' + r.priority + '</td>');
                            tr.append('<td>' + (r.enabled ? 'Yes' : 'No') + '</td>');
                            tr.append('<td><button type="button" class="btn btn-sm btn-danger del-mapping" data-id="' + r.id + '">Delete</button></td>');
                            tb.append(tr);
                        });
                    }).fail(function (xhr) { toastErr(extractLaravelError(xhr)); });
                }
                function loadLearnerStatuses() {
                    $.get(ROUTE_STATUSES, function (rows) {
                        var sel = $('#mf_learner_status').empty().append('<option value="">-- Any --</option>');
                        rows.forEach(function (s) { sel.append('<option value="' + s + '">' + s + '</option>'); });
                    }).fail(function (xhr) { toastErr(extractLaravelError(xhr)); });
                }
                function activateTabByName(n) {
                    var c = (n || '').toString().replace(/^#/, '').replace(/^tab-/, '');
                    var map = {
                        'triggers':  '#tab-triggers',
                        'templates': '#tab-templates',
                        'drafts':    '#tab-drafts',
                        'mappings':  '#tab-mappings'
                    };

                    var t = map[c] || '#tab-triggers';

                    var activeName = null;
                    $.each(map, function (k, v) {
                        if (v === t) activeName = k;
                    });

                    $('#emailAdminTabs .nav-link')
                        .removeClass('active')
                        .filter('[data-target="' + t + '"]')
                        .addClass('active');

                    $('.tab-pane').removeClass('show active');
                    $(t).addClass('show active');

                    try {
                        var url = new URL(window.location.href);
                        if (activeName) {
                            url.searchParams.set('tab', activeName);
                        } else {
                            url.searchParams.delete('tab');
                        }
                        window.history.replaceState({}, '', url.toString());
                    } catch (e) {}
                }

                function updateScopeVisibility() {
                    var v = $('#mf_scope').val();
                    if (v === 'global') {
                        $('#group_course_category,#group_course_id').addClass('d-none');
                        $('#mf_course_category,#mf_course_id').val('');
                    } else if (v === 'category') {
                        $('#group_course_category').removeClass('d-none');
                        $('#group_course_id').addClass('d-none');
                        $('#mf_course_id').val('');
                    } else if (v === 'course') {
                        $('#group_course_id').removeClass('d-none');
                        $('#group_course_category').addClass('d-none');
                        $('#mf_course_category').val('');
                    } else {
                        $('#group_course_category,#group_course_id').addClass('d-none');
                        $('#mf_course_category,#mf_course_id').val('');
                    }
                }

                $('#tpl_asset').attr('multiple', true).css('display', 'none');
                function canOpenPicker(t) {
                    var $t = $(t);
                    if ($t.closest('.attach-item').length) return false;
                    if ($t.closest('.att-actions').length) return false;
                    if ($t.is('button,a,input,textarea,label,svg,i')) return false;
                    return true;
                }
                $(document).off('mousedown.stopAttach click.stopAttach keydown.stopAttach').on('mousedown.stopAttach click.stopAttach keydown.stopAttach', '.attach-item, .attach-item *', function (e) {
                    if (e.type === 'keydown' && (e.key === 'Enter' || e.key === ' ')) e.preventDefault();
                    e.stopPropagation();
                });
                $('#tpl_attach_list').off('click.tplattach').on('click.tplattach', function (e) {
                    if (!canOpenPicker(e.target)) return;

                    var $form = $('#templateForm');
                    if ($form.length && !$form.valid()) {
                        toastErr('Please complete the required fields before adding attachments.');
                        return;
                    }

                    $('#tpl_asset').trigger('click');
                });

                $(document).on('click', '#tpl_attach_add_btn', function (e) {
                    e.preventDefault();

                    var $form = $('#templateForm');
                    if ($form.length && !$form.valid()) {
                        toastErr('Please complete the required fields before adding attachments.');
                        return;
                    }

                    $('#tpl_asset').trigger('click');
                });


                $('#tpl_asset').off('change.tplup').on('change.tplup', function () {
                    var files = Array.from(this.files || []);
                    if (!files.length) return;
                    $('#tpl_attach_list').html('<div class="att-loading"><span class="spin">⟳</span>Uploading ' + files.length + '...</div>');
                    var tasks = files.map(function (f) {
                        var fd = new FormData();
                        fd.append('file', f);
                        fd.append('_token', CSRF_TOKEN);
                        return $.ajax({ url: ROUTE_UPLOAD, method: 'POST', data: fd, contentType: false, processData: false, headers: {'X-CSRF-TOKEN': CSRF_TOKEN} })
                            .then(function (res) {
                                attachmentsDraft.push({ nameOriginal: f.name, nameStored: (res && res.name) ? res.name : f.name, url: (res && res.url) ? res.url : '', size: (res && res.size) ? res.size : (f.size ? Math.round(f.size / 1024) + ' KB' : '') });
                                return true;
                            }, function () { return false; });
                    });
                    $.when.apply($, tasks).always(function () { renderAttachmentList(); $('#tpl_asset').val(''); });
                });
                function renderAttachmentList() {
                    var $box = $('#tpl_attach_list');

                    var $list = $('<div class="attach-list"></div>');

                    var $addRow = $('<div class="attach-add-row"></div>');
                    var $addBtn = $('<button type="button" class="att-add-btn" id="tpl_attach_add_btn">+ Add attachment</button>');
                    $addRow.append($addBtn);
                    $list.append($addRow);

                    if (!attachmentsDraft.length) {
                        $box.empty().append($list);
                        return;
                    }

                    attachmentsDraft.forEach(function (f, idx) {
                        var safeName = $('<div/>').text(f.nameOriginal || '').html();
                        var sizeText = f.size || '';

                        var $row = $('<div class="attach-item" tabindex="-1"></div>');

                        var $left = $('<div class="attach-left"></div>');
                        var $icon = $('<div class="attach-icon">📎</div>');
                        var $meta = $('<div class="attach-meta"></div>');

                        $meta.append('<div class="attach-name" title="' + (f.nameOriginal || '') + '">' + safeName + '</div>');
                        $meta.append('<div class="attach-size">' + sizeText + '</div>');

                        $left.append($icon, $meta);

                        var $act = $('<div class="att-actions"></div>');
                        var $prev = $('<button type="button" class="att-btn att-btn-outline" data-idx="' + idx + '">Preview</button>');
                        var $del = $('<button type="button" class="att-btn att-btn-danger" data-idx="' + idx + '">Delete</button>');

                        $act.append($prev, $del);
                        $row.append($left, $act);
                        $list.append($row);
                    });

                    $box.empty().append($list);
                }


                $(document).off('click.attPreview').on('click.attPreview', '.att-btn.att-btn-outline', function (e) {
                    e.preventDefault();
                    e.stopPropagation();
                    var idx = Number($(this).data('idx'));
                    var f = attachmentsDraft[idx];
                    if (!f) return;
                    var ext = ((f.nameOriginal || '').split('.').pop() || '').toLowerCase();
                    var isImg = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'bmp', 'svg'].indexOf(ext) > -1;
                    var isPdf = ext === 'pdf';
                    var html = '';
                    if (isImg && f.url) html = '<img src="' + f.url + '" style="max-width:100%;border-radius:8px">';
                    else if (isPdf && f.url) html = '<iframe src="' + f.url + '" style="width:100%;height:70vh;border:none;border-radius:8px"></iframe>';
                    else html = '<div style="text-align:left;font-size:13px;line-height:1.45"><p><strong>File Name:</strong> ' + $('<div/>').text(f.nameOriginal || '').html() + '</p>' + (f.url ? '<p><a target="_blank" rel="noopener" href="' + f.url + '">Open in new tab</a></p>' : '') + '</div>';
                    Swal.fire({ width: '900px', title: f.nameOriginal || 'Attachment', html: html, confirmButtonText: 'Close' });
                });
                $(document).off('click.attDelete').on('click.attDelete', '.att-btn.att-btn-danger', function (e) {
                    e.preventDefault();
                    e.stopPropagation();
                    var idx = Number($(this).data('idx'));
                    attachmentsDraft.splice(idx, 1);
                    renderAttachmentList();
                    toastOk('Attachment removed');
                });

                $(function () {
                    var urlParams = new URLSearchParams(window.location.search);
                    var desiredTab = urlParams.get('tab');
                    activateTabByName(desiredTab);
                    $('#emailAdminTabs .nav-link').on('click', function (e) {
                        e.preventDefault();
                        var target = $(this).data('target');
                        activateTabByName(target);
                    });

                    initTriggerKeySelect();
                    bindTriggerForm();
                    bindDeleteButtons();
                    initTemplateEditor();
                    initVarSelectForTemplate();
                    bindTemplateForm();
                    bindMappingForm();
                    pillBox('#tpl_to_area');
                    pillBox('#tpl_cc_area', { onChange: function () { $('.dummy').length; } });
                    pillBox('#tpl_bcc_area', { onChange: function () { $('.dummy').length; } });
                    loadTriggers();
                    loadTemplates();
                    loadDrafts();
                    loadMappings();
                    loadLearnerStatuses();
                    renderAttachmentList();
                    $('#mf_scope').on('change', function () { updateScopeVisibility(); });
                    updateScopeVisibility();
                });
            })(jQuery);
        </script>

    @endverbatim
@endpush
