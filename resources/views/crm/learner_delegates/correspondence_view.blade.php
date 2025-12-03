@extends('crm.layout.main')
@section('title', 'User Correspondence')

@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-bootstrap-4/bootstrap-4.min.css">
    <style>
        :root {
            --crm-bg: #f3f4f6;
            --crm-surface: #f9fafb;
            --crm-card: #ffffff;
            --crm-border-subtle: #e5e7eb;
            --crm-border-strong: #d1d5db;
            --crm-primary: #2563eb;
            --crm-primary-soft: rgba(37, 99, 235, 0.06);
            --crm-primary-soft-strong: rgba(37, 99, 235, 0.12);
            --crm-primary-ring: rgba(37, 99, 235, 0.25);
            --crm-text-main: #111827;
            --crm-text-muted: #9ca3af;
            --crm-text-soft: #6b7280;
            --crm-success-soft: #dcfce7;
            --crm-success-border: #4ade80;
            --crm-danger-soft: #fee2e2;
            --crm-danger-border: #f87171;
            --crm-warning-soft: #fef9c3;
            --crm-warning-border: #facc15;
            --crm-radius-xl: 18px;
            --crm-radius-lg: 14px;
            --crm-radius-pill: 999px;
            --crm-transition-fast: 120ms ease-out;
            --crm-transition-med: 160ms ease;
        }

        body {
            background:
                radial-gradient(circle at top left, rgba(37, 99, 235, 0.12), transparent 55%),
                radial-gradient(circle at bottom right, rgba(59, 130, 246, 0.12), transparent 55%),
                var(--crm-bg);
            color: var(--crm-text-main);
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            font-size: 14px;
            line-height: 1.4;
        }

        .page-inner {
            padding: 32px 0 56px;
        }

        .container {
            max-width: 1820px;
        }

        .composer-shell {
            background: var(--crm-card);
            border-radius: 24px;
            border: 1px solid rgba(209, 213, 219, 0.9);
            box-shadow:
                0 18px 45px rgba(15, 23, 42, 0.12),
                0 0 0 1px rgba(148, 163, 184, 0.06);
            overflow: hidden;
            position: relative;
        }

        .composer-shell::before {
            content: "";
            position: absolute;
            inset: 0;
            background:
                radial-gradient(circle at 0 0, rgba(37, 99, 235, 0.08), transparent 55%),
                radial-gradient(circle at 100% 100%, rgba(56, 189, 248, 0.06), transparent 55%);
            opacity: 0.9;
            pointer-events: none;
            mix-blend-mode: screen;
        }

        .composer-shell > * {
            position: relative;
            z-index: 1;
        }

        .composer-head {
            background: linear-gradient(
                120deg,
                #ffffff 0%,
                #f9fafb 45%,
                #eff6ff 100%
            );
            border-bottom: 1px solid #e5e7eb;
            padding: 14px 18px 12px;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
        }

        .composer-head-left {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .composer-title {
            font-size: 15px;
            font-weight: 700;
            color: #111827;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 8px;
        }

        .composer-title span.subject-chip {
            padding: 3px 9px;
            border-radius: var(--crm-radius-pill);
            background: #f3f4ff;
            border: 1px solid #e5e7eb;
            font-size: 11px;
            font-weight: 600;
            color: #4b5563;
        }

        .composer-sub {
            font-size: 12px;
            color: var(--crm-text-soft);
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 8px;
        }

        .composer-sub .subject-label {
            color: var(--crm-text-muted);
        }

        .btn-top {
            font-size: 12px;
            font-weight: 600;
            line-height: 1.2;
            border-radius: var(--crm-radius-pill);
            border: 1px solid rgba(209, 213, 219, 0.9);
            background: #ffffff;
            padding: .47rem .9rem;
            box-shadow:
                0 10px 22px rgba(148, 163, 184, 0.25);
            cursor: pointer;
            text-decoration: none;
            color: #111827;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: transform var(--crm-transition-fast), box-shadow var(--crm-transition-fast), background var(--crm-transition-fast), border-color var(--crm-transition-fast);
            white-space: nowrap;
        }

        .btn-top::before {
            content: '';
            width: 6px;
            height: 6px;
            border-radius: 999px;
            background: radial-gradient(circle, rgba(56, 189, 248, 0.9), rgba(59, 130, 246, 0.6));
            box-shadow: 0 0 10px rgba(56, 189, 248, 0.7);
        }

        .btn-top:hover {
            text-decoration: none;
            border-color: rgba(129, 140, 248, 0.9);
            background: #f9fafb;
            transform: translateY(-1px);
            box-shadow:
                0 14px 30px rgba(148, 163, 184, 0.35);
        }

        .composer-body {
            padding: 18px 18px 20px;
            background: #f9fafb;
        }

        .composer-grid {
            display: grid;
            grid-template-columns: minmax(0, 1.2fr) minmax(0, 1.6fr);
            gap: 16px;
        }

        @media (max-width: 992px) {
            .composer-grid {
                grid-template-columns: minmax(0, 1fr);
            }
        }

        .meta-panel {
            border-radius: var(--crm-radius-xl);
            border: 1px solid var(--crm-border-subtle);
            background: #ffffff;
            padding: 12px 12px 10px;
            box-shadow:
                0 10px 24px rgba(148, 163, 184, 0.2);
        }

        .meta-panel-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 4px;
            gap: 8px;
        }

        .meta-panel-title {
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: .16em;
            color: var(--crm-text-soft);
            font-weight: 600;
        }

        .row-field {
            display: flex;
            align-items: flex-start;
            padding: 7px 0;
            border-bottom: 1px dashed #e5e7eb;
        }

        .row-field:last-of-type {
            border-bottom: 0;
        }

        .row-field .label-col {
            flex: 0 0 120px;
            font-size: 11px;
            font-weight: 600;
            color: var(--crm-text-soft);
            text-transform: uppercase;
            letter-spacing: .08em;
            padding-top: 2px;
        }

        .row-field .value-col {
            flex: 1 1 auto;
        }

        .field-text {
            font-size: 13px;
            color: var(--crm-text-main);
            word-break: break-word;
        }

        .field-text.muted {
            color: var(--crm-text-muted);
        }

        .pill-email {
            display: inline-flex;
            align-items: center;
            padding: 3px 9px;
            border-radius: var(--crm-radius-pill);
            background: #eef2ff;
            border: 1px solid #c7d2fe;
            font-size: 11px;
            font-weight: 600;
            color: #4338ca;
            margin: 2px 4px 4px 0;
        }

        .pill-email span.dot {
            width: 6px;
            height: 6px;
            border-radius: 999px;
            background: #4f46e5;
            box-shadow: 0 0 6px rgba(79, 70, 229, 0.4);
            margin-right: 6px;
        }

        .sec-title {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            color: var(--crm-text-soft);
            letter-spacing: .18em;
            margin-top: 18px;
            margin-bottom: 6px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 8px;
        }

        .sec-title span.left-label {
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .sec-title span.left-label::before {
            content: "";
            width: 22px;
            height: 1px;
            border-radius: 999px;
            background: linear-gradient(to right, rgba(148, 163, 184, 0.6), rgba(37, 99, 235, 0.85));
        }

        .sec-title span.right-meta {
            font-size: 11px;
            color: var(--crm-text-soft);
            font-weight: 500;
        }

        .body-panel {
            border-radius: var(--crm-radius-xl);
            border: 1px solid var(--crm-border-subtle);
            background: #ffffff;
            padding: 12px;
            max-height: 600px;
            overflow: auto;
            box-shadow:
                0 10px 26px rgba(148, 163, 184, 0.25);
        }

        .body-panel-html {
            background: #ffffff;
        }

        .body-panel-text {
            margin-top: 10px;
            background: #f9fafb;
            font-family: ui-monospace, SFMono-Regular, Menlo, Consolas, monospace;
            font-size: 12px;
            white-space: pre-wrap;
            color: var(--crm-text-muted);
        }

        .attachments-bar {
            border-radius: var(--crm-radius-lg);
            border: 1px dashed rgba(209, 213, 219, 0.9);
            padding: 8px 11px;
            font-size: 12px;
            color: var(--crm-text-main);
            background: #f9fafb;
            box-shadow:
                0 8px 20px rgba(148, 163, 184, 0.2);
        }

        .attachments-bar-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 4px;
        }

        .attachments-bar-header span {
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: .16em;
            color: var(--crm-text-soft);
            font-weight: 600;
        }

        .attach-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 6px 0;
            border-top: 1px solid #e5e7eb;
            gap: 10px;
        }

        .attach-row:first-of-type {
            border-top: 0;
        }

        .attach-main {
            display: flex;
            flex-direction: column;
            gap: 1px;
            min-width: 0;
        }

        .attach-name {
            font-weight: 600;
            color: #111827;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 52vw;
        }

        @media (max-width: 768px) {
            .attach-name {
                max-width: 70vw;
            }
        }

        .attach-meta {
            font-size: 11px;
            color: var(--crm-text-soft);
        }

        .attach-link a {
            font-size: 11px;
            font-weight: 600;
            color: var(--crm-primary);
            text-decoration: none;
            padding: 4px 9px;
            border-radius: var(--crm-radius-pill);
            border: 1px solid rgba(37, 99, 235, 0.7);
            background: #eff6ff;
            box-shadow: 0 8px 18px rgba(147, 197, 253, 0.4);
            display: inline-flex;
            align-items: center;
            gap: 4px;
            transition: background var(--crm-transition-fast), transform var(--crm-transition-fast), box-shadow var(--crm-transition-fast), border-color var(--crm-transition-fast);
        }

        .attach-link a::before {
            content: "👁";
            font-size: 11px;
        }

        .attach-link a:hover {
            text-decoration: none;
            border-color: rgba(37, 99, 235, 1);
            background: #dbeafe;
            transform: translateY(-1px);
            box-shadow: 0 12px 26px rgba(59, 130, 246, 0.45);
        }

        .badge-status {
            display: inline-flex;
            align-items: center;
            padding: 4px 10px;
            border-radius: var(--crm-radius-pill);
            font-size: 11px;
            font-weight: 600;
            letter-spacing: .05em;
            text-transform: uppercase;
            margin-left: 4px;
            border: 1px solid transparent;
            box-shadow: 0 4px 10px rgba(148, 163, 184, 0.4);
        }

        .badge-status::before {
            content: '';
            width: 6px;
            height: 6px;
            border-radius: 999px;
            margin-right: 6px;
        }

        .badge-status.sent {
            background: var(--crm-success-soft);
            color: #15803d;
            border-color: var(--crm-success-border);
        }

        .badge-status.sent::before {
            background: #22c55e;
            box-shadow: 0 0 10px rgba(34, 197, 94, 0.6);
        }

        .badge-status.queued {
            background: var(--crm-warning-soft);
            color: #854d0e;
            border-color: var(--crm-warning-border);
        }

        .badge-status.queued::before {
            background: #eab308;
            box-shadow: 0 0 10px rgba(234, 179, 8, 0.5);
        }

        .badge-status.failed {
            background: var(--crm-danger-soft);
            color: #b91c1c;
            border-color: var(--crm-danger-border);
        }

        .badge-status.failed::before {
            background: #ef4444;
            box-shadow: 0 0 10px rgba(239, 68, 68, 0.5);
        }

        .conversation-panel {
            background: #ffffff;
            position: relative;
        }

        .conversation-panel::before {
            content: "";
            position: absolute;
            top: 10px;
            bottom: 12px;
            left: 18px;
            width: 1px;
            border-radius: 999px;
            background: linear-gradient(
                to bottom,
                rgba(209, 213, 219, 1),
                rgba(37, 99, 235, 0.5),
                rgba(148, 163, 184, 0.1)
            );
            opacity: 0.9;
        }

        .message-item {
            border-radius: 14px;
            padding: 9px 11px 9px 32px;
            margin-bottom: 10px;
            position: relative;
            border: 1px solid #e5e7eb;
            background: #f9fafb;
            box-shadow:
                0 8px 16px rgba(148, 163, 184, 0.25);
        }

        .message-item::before {
            content: "";
            position: absolute;
            left: 13px;
            top: 13px;
            width: 10px;
            height: 10px;
            border-radius: 999px;
            background: #0ea5e9;
            box-shadow:
                0 0 0 3px rgba(56, 189, 248, 0.25),
                0 0 0 6px rgba(255, 255, 255, 0.9);
        }

        .message-item.inbound::before {
            background: #f97316;
            box-shadow:
                0 0 0 3px rgba(251, 146, 60, 0.25),
                0 0 0 6px rgba(255, 255, 255, 0.9);
        }

        .message-item.outbound {
            border-left: 2px solid rgba(59, 130, 246, 0.7);
        }

        .message-item.inbound {
            border-left: 2px solid rgba(251, 146, 60, 0.7);
        }

        .message-meta {
            font-size: 11px;
            color: var(--crm-text-soft);
            margin-bottom: 4px;
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            align-items: center;
        }

        .message-meta .badge-dir {
            border-radius: var(--crm-radius-pill);
            padding: 2px 7px;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .12em;
        }

        .message-meta .badge-dir.outbound {
            background: #e0f2fe;
            color: #0369a1;
            border: 1px solid #7dd3fc;
        }

        .message-meta .badge-dir.inbound {
            background: #ffedd5;
            color: #9a3412;
            border: 1px solid #fed7aa;
        }

        .message-body {
            font-size: 13px;
            color: #111827;
        }

        .message-empty {
            font-size: 13px;
            color: var(--crm-text-muted);
            margin-top: 4px;
        }

        #conversation-loading {
            font-size: 12px;
        }

        .status-time {
            font-size: 11px;
            color: var(--crm-text-soft);
        }

        /* Attachments carousel modal */
        #attachmentsCarouselInner .attachment-slide {
            min-height: 260px;
        }

        #attachmentsCarouselInner .attachment-slide-image {
            max-height: 60vh;
            object-fit: contain;
        }

        #attachmentsCarouselInner .attachment-slide-box {
            border-radius: 16px;
            border: 1px dashed #d1d5db;
            background: #f9fafb;
        }

        @media (max-width: 768px) {
            .composer-head {
                padding: 12px 14px;
            }
            .composer-body {
                padding: 14px 12px 16px;
            }
            .meta-panel {
                border-radius: 16px;
            }
            .body-panel {
                border-radius: 16px;
            }
            .message-item {
                padding-left: 30px;
            }
            .conversation-panel::before {
                left: 16px;
            }
        }

        #attachmentsCarousel .carousel-control-prev-icon,
        #attachmentsCarousel .carousel-control-next-icon {
            width: 38px;
            height: 38px;
            border-radius: 999px;
            background-color: rgba(15, 23, 42, 0.88);
            background-image: none;
            box-shadow: 0 4px 10px rgba(15, 23, 42, 0.45);
            position: relative;
        }

        #attachmentsCarousel .carousel-control-prev-icon::before,
        #attachmentsCarousel .carousel-control-next-icon::before {
            content: '';
            position: absolute;
            inset: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            font-weight: 700;
            color: #ffffff;
        }

        #attachmentsCarousel .carousel-control-prev-icon::before {
            content: '‹';
        }

        #attachmentsCarousel .carousel-control-next-icon::before {
            content: '›';
        }

        #attachmentsCarousel .carousel-control-prev:hover .carousel-control-prev-icon,
        #attachmentsCarousel .carousel-control-next:hover .carousel-control-next-icon {
            background-color: rgba(15, 23, 42, 0.96);
            box-shadow: 0 6px 14px rgba(15, 23, 42, 0.6);
        }

    </style>
@endpush

@section('main')
    <div class="container">
        <div class="page-inner">
            <div class="composer-shell">
                <div class="composer-head">
                    <div class="composer-head-left">
                        <div class="composer-title">
                            <span>Email to {{ $send->recipient_email ?: '-' }}</span>
                            <span class="subject-chip">
                                {{ $send->subject ?: 'No subject' }}
                            </span>
                        </div>
                        <div class="composer-sub">
                            <span class="subject-label">Status:</span>
                            @php
                                $status = strtolower($send->status ?? 'queued');
                                if (!in_array($status, ['sent','failed','queued'])) {
                                    $status = 'queued';
                                }
                            @endphp
                            <span class="badge-status {{ $status }}">
                                {{ ucfirst($status) }}
                            </span>

                            @if($send->sent_at)
                                <span class="status-time">
                                    • Sent at {{ $send->sent_at->format('d-m-Y H:i:s') }}
                                </span>
                            @elseif($send->created_at)
                                <span class="status-time">
                                    • Created at {{ $send->created_at->format('d-m-Y H:i:s') }}
                                </span>
                            @endif
                        </div>
                    </div>
                    <div>
                        <a href="{{ route('crm.learner.delegates.show', $delegate->id) }}" class="btn-top">
                            ← Back to Delegate
                        </a>
                    </div>
                </div>

                <div class="composer-body">
                    <div class="composer-grid">
                        <div class="meta-panel">
                            <div class="meta-panel-header">
                                <div class="meta-panel-title">Message Metadata</div>
                            </div>

                            <div class="row-field">
                                <div class="label-col">To</div>
                                <div class="value-col">
                                    @if($send->recipient_email)
                                        <span class="pill-email">
                                            <span class="dot"></span>{{ $send->recipient_email }}
                                        </span>
                                    @else
                                        <span class="field-text muted">-</span>
                                    @endif
                                </div>
                            </div>

                            <div class="row-field">
                                <div class="label-col">CC</div>
                                <div class="value-col">
                                    @forelse($cc as $addr)
                                        <span class="pill-email">
                                            <span class="dot"></span>{{ $addr }}
                                        </span>
                                    @empty
                                        <span class="field-text muted">-</span>
                                    @endforelse
                                </div>
                            </div>

                            <div class="row-field">
                                <div class="label-col">BCC</div>
                                <div class="value-col">
                                    @forelse($bcc as $addr)
                                        <span class="pill-email">
                                            <span class="dot"></span>{{ $addr }}
                                        </span>
                                    @empty
                                        <span class="field-text muted">-</span>
                                    @endforelse
                                </div>
                            </div>

                            <div class="row-field">
                                <div class="label-col">From</div>
                                <div class="value-col">
                                    <div class="field-text">
                                        {{ $fromName }} &lt;{{ $fromEmail }}&gt;
                                    </div>
                                </div>
                            </div>

                            <div class="row-field">
                                <div class="label-col">Template</div>
                                <div class="value-col">
                                    @php
                                        $newsletter = $meta['newsletter_name'] ?? null;
                                    @endphp
                                    <div class="field-text">
                                        @if($newsletter && $send->template_code)
                                            {{ $send->template_code }} – {{ $newsletter }}
                                        @elseif($newsletter)
                                            {{ $newsletter }}
                                        @elseif($send->template_code)
                                            {{ $send->template_code }}
                                        @else
                                            <span class="field-text muted">-</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row-field">
                                <div class="label-col">Created by</div>
                                <div class="value-col">
                                    <div class="field-text">
                                        @if($creatorName || $creatorEmail)
                                            {{ $creatorName ?? '' }}
                                            @if($creatorEmail)
                                                &lt;{{ $creatorEmail }}&gt;
                                            @endif
                                        @else
                                            <span class="field-text muted">-</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row-field">
                                <div class="label-col">Course</div>
                                <div class="value-col">
                                    <div class="field-text">
                                        @if($course)
                                            {{ $course->code ?? '' }} {{ $course->name ?? '' }}
                                        @else
                                            <span class="field-text muted">-</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="sec-title">
                                <span class="left-label">Attachments</span>
                            </div>
                            <div class="attachments-bar">
                                <div class="attachments-bar-header">
                                    <span>Files</span>
                                </div>

                                @if(!empty($attachments))
                                    @foreach($attachments as $att)
                                        @php
                                            $name = $att['original_name'] ?? $att['name'] ?? 'Attachment';
                                            $size = $att['size'] ?? '';
                                        @endphp
                                        <div class="attach-row">
                                            <div class="attach-main">
                                                <div class="attach-name">{{ $name }}</div>
                                                @if($size)
                                                    <div class="attach-meta">{{ $size }}</div>
                                                @endif
                                            </div>
                                            <div class="attach-link">
                                                <a href="#"
                                                   class="attach-preview-link"
                                                   data-attachments='@json($attachments)'
                                                   data-attachment-index="{{ $loop->index }}">
                                                    Preview
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="field-text muted">No attachments</div>
                                @endif
                            </div>
                        </div>

                        <div>
                            <div class="sec-title">
                                <span class="left-label">Body (HTML)</span>
                            </div>
                            <div class="body-panel body-panel-html">
                                {!! $send->html_body !!}
                            </div>

                            <div class="d-none sec-title">
                                <span class="left-label">Body (Plain text)</span>
                            </div>
                            <div class="d-none body-panel body-panel-text">
                                {{ $send->text_body }}
                            </div>

                            <div class="sec-title" style="margin-top: 18px;">
                                <span class="left-label">Conversation with mailer</span>
                                <span class="right-meta">
                                    <button type="button"
                                            class="btn-top"
                                            id="btn-refresh-thread"
                                            data-sync-url="{{ route('crm.emails.sync-replies') }}">
                                        ⟳ Refresh conversation
                                    </button>
                                </span>
                            </div>

                            <div class="body-panel body-panel-html conversation-panel"
                                 id="conversation-panel"
                                 data-thread-url="{{ route('crm.learner.delegates.correspondence.thread', [$delegate->id, $send->id]) }}"
                                 data-from-name="{{ $fromName }}"
                                 data-from-email="{{ $fromEmail }}"
                            >
                                <div class="field-text muted" id="conversation-loading">
                                    Loading conversation…
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="attachmentsPreviewModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content border-0 shadow-lg" style="border-radius:18px;">
                <div class="modal-header border-0 bg-white">
                    <div>
                        <h5 class="modal-title fw-bold mb-0">
                            <i class="bi bi-paperclip me-2 text-primary"></i> Attachments
                        </h5>
                        <div class="small text-muted" id="attachmentsPreviewMeta"></div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
                <div class="modal-body bg-light-subtle">
                    <div id="attachmentsCarousel" class="carousel slide" data-bs-ride="false">
                        <div class="carousel-indicators" id="attachmentsCarouselIndicators"></div>
                        <div class="carousel-inner" id="attachmentsCarouselInner" style="min-height:260px;"></div>

                        <button class="carousel-control-prev" type="button"
                                data-bs-target="#attachmentsCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button"
                                data-bs-target="#attachmentsCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
                <div class="modal-footer border-0 bg-white d-flex justify-content-between align-items-center">
                    <small class="text-muted">
                        Use keyboard <span class="fw-semibold">◀</span> <span class="fw-semibold">▶</span> keys
                        or click the side arrows to browse attachments.
                    </small>
                    <div class="d-flex gap-2">
                        <a href="#" target="_blank" class="btn btn-outline-secondary btn-sm d-none"
                           id="attachmentsOpenOriginal">
                            <i class="bi bi-box-arrow-up-right me-1"></i> Open current in new tab
                        </a>
                        <button type="button" class="btn btn-primary btn-sm" data-bs-dismiss="modal">
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        (function ($) {
            function escapeHtml(str) {
                var div = document.createElement('div');
                div.innerText = str;
                return div.innerHTML;
            }

            function nl2br(str) {
                return str.replace(/\n/g, '<br>');
            }

            function loadConversation() {
                var $panel = $('#conversation-panel');
                if (!$panel.length) {
                    return;
                }

                var url = $panel.data('thread-url');
                var fromName = $panel.data('from-name') || 'You';
                var fromEmail = $panel.data('from-email') || '';
                var $loadingEl = $('#conversation-loading');

                if ($loadingEl.length) {
                    $loadingEl.text('Loading conversation…').show();
                }

                $.ajax({
                    url: url,
                    method: 'GET',
                    dataType: 'json',
                    cache: false
                }).done(function (data) {
                    var messages = $.isArray(data.messages) ? data.messages : [];
                    $panel.empty();

                    if (!messages.length) {
                        var $empty = $('<div/>')
                            .addClass('field-text muted')
                            .css('margin', '15px')
                            .text('No conversation content available. Showing original email below.');
                        var $original = $('<div/>')
                            .css('margin-top', '10px')
                            .html(@json($send->html_body));
                        $panel.append($empty).append($original);
                        return;
                    }

                    $.each(messages, function (_, msg) {
                        var direction = (msg.direction || '').toLowerCase();
                        var isOutbound = direction === 'outbound';

                        var $wrapper = $('<div/>')
                            .addClass('message-item ' + (isOutbound ? 'outbound' : 'inbound'));

                        var $meta = $('<div/>').addClass('message-meta');

                        var $badge = $('<span/>')
                            .addClass('badge-dir ' + (isOutbound ? 'outbound' : 'inbound'))
                            .text(isOutbound ? 'You' : 'Recipient');
                        $meta.append($badge);

                        var $label = $('<span/>');
                        if (isOutbound) {
                            var email = msg.from_email || fromEmail;
                            $label.text(fromName + (email ? ' <' + email + '>' : ''));
                        } else {
                            var emailIn = msg.from_email || 'Recipient';
                            $label.text(emailIn);
                        }
                        $meta.append($label);

                        if (msg.timestamp) {
                            var $ts = $('<span/>').text('· ' + msg.timestamp);
                            $meta.append($ts);
                        }

                        var $body = $('<div/>').addClass('message-body');

                        if (msg.body_html) {
                            $body.html(msg.body_html);
                        } else if (msg.body_text) {
                            $body.html(nl2br(escapeHtml(msg.body_text)));
                        } else {
                            $body.html('<span class="message-empty">No content</span>');
                        }

                        $wrapper.append($meta).append($body);
                        $panel.append($wrapper);
                    });
                }).fail(function () {
                    $panel.html('<div class="field-text muted">Unable to load conversation. Please try again.</div>');
                });
            }

            // -------- Attachments carousel helpers --------
            function isImageAttachment(att) {
                var mime = (att.mime || '').toLowerCase();
                var url = (att.url || att.download_url || att.path || '').toLowerCase();

                if (mime.indexOf('image/') === 0) return true;

                return /\.(png|jpe?g|gif|webp|bmp|svg)$/.test(url);
            }

            function buildAttachmentSlide(att, index) {
                var url = att.url || att.download_url || att.path || '#';
                var name = att.name || att.original_name || ('Attachment ' + (index + 1));

                var safeName = $('<div/>').text(name).html();

                var $slide = $('<div/>')
                    .addClass('carousel-item')
                    .append(
                        $('<div/>')
                            .addClass('attachment-slide d-flex flex-column align-items-center justify-content-center p-3')
                            .append(
                                (function () {
                                    if (isImageAttachment(att)) {
                                        return $('<img/>', {
                                            src: url,
                                            alt: safeName,
                                            class: 'img-fluid rounded-3 shadow-sm attachment-slide-image mb-2'
                                        });
                                    }

                                    var $box = $('<div/>')
                                        .addClass('attachment-slide-box p-4 d-flex flex-column align-items-center justify-content-center text-center shadow-sm');

                                    $box.append(
                                        $('<div/>')
                                            .addClass('rounded-circle mb-3 d-flex align-items-center justify-content-center')
                                            .css({
                                                width: '60px',
                                                height: '60px',
                                                background: '#eef2ff',
                                                color: '#4f46e5'
                                            })
                                            .html('<i class="bi bi-file-earmark-text fs-2"></i>')
                                    );

                                    $box.append(
                                        $('<div/>').addClass('fw-semibold mb-1').text(name)
                                    );

                                    if (att.size) {
                                        $box.append(
                                            $('<div/>').addClass('small text-muted').text(att.size)
                                        );
                                    }

                                    if (url && url !== '#') {
                                        $box.append(
                                            $('<a/>', {
                                                href: url,
                                                target: '_blank',
                                                class: 'btn btn-outline-primary btn-sm mt-3'
                                            }).html('<i class="bi bi-box-arrow-up-right me-1"></i>Open file')
                                        );
                                    }

                                    return $box;
                                })()
                            )
                    );

                return $slide;
            }

            function openAttachmentsModal(attachments, startIndex) {
                if (!Array.isArray(attachments) || !attachments.length) return;

                startIndex = parseInt(startIndex || 0, 10) || 0;
                if (startIndex < 0 || startIndex >= attachments.length) {
                    startIndex = 0;
                }

                var $modal = $('#attachmentsPreviewModal');
                var $inner = $('#attachmentsCarouselInner');
                var $indicators = $('#attachmentsCarouselIndicators');
                var $meta = $('#attachmentsPreviewMeta');
                var $openOriginal = $('#attachmentsOpenOriginal');

                $inner.empty();
                $indicators.empty();
                $meta.text(attachments.length + ' attachment' + (attachments.length > 1 ? 's' : ''));
                $openOriginal.addClass('d-none').attr('href', '#');

                attachments.forEach(function (att, idx) {
                    var $slide = buildAttachmentSlide(att, idx);
                    if (idx === startIndex) {
                        $slide.addClass('active');
                        var url0 = att.url || att.download_url || att.path || '#';
                        if (url0 && url0 !== '#') {
                            $openOriginal.removeClass('d-none').attr('href', url0);
                        }
                    }
                    $inner.append($slide);

                    var $ind = $('<button/>', {
                        type: 'button',
                        'data-bs-target': '#attachmentsCarousel',
                        'data-bs-slide-to': idx,
                        'aria-label': 'Slide ' + (idx + 1)
                    });
                    if (idx === startIndex) {
                        $ind.addClass('active').attr('aria-current', 'true');
                    }
                    $indicators.append($ind);
                });

                var carouselEl = document.getElementById('attachmentsCarousel');
                var existing = bootstrap.Carousel.getInstance(carouselEl);
                if (existing) {
                    existing.to(startIndex);
                } else {
                    existing = new bootstrap.Carousel(carouselEl, {
                        interval: false,
                        ride: false,
                        wrap: true
                    });
                }

                carouselEl.addEventListener('slid.bs.carousel', function (ev) {
                    var idx = ev.to;
                    var att = attachments[idx];
                    if (!att) return;
                    var url = att.url || att.download_url || att.path || '#';
                    if (url && url !== '#') {
                        $openOriginal.removeClass('d-none').attr('href', url);
                    } else {
                        $openOriginal.addClass('d-none').attr('href', '#');
                    }
                }, { once: true });

                // keyboard ◀ ▶ navigation while modal open
                function keyHandler(ev) {
                    if (ev.key === 'ArrowRight') {
                        ev.preventDefault();
                        existing.next();
                    } else if (ev.key === 'ArrowLeft') {
                        ev.preventDefault();
                        existing.prev();
                    }
                }

                document.addEventListener('keydown', keyHandler);

                $modal.one('hidden.bs.modal', function () {
                    document.removeEventListener('keydown', keyHandler);
                });

                var modal = new bootstrap.Modal($modal[0]);
                modal.show();
            }

            $(document).ready(function () {
                loadConversation();

                $('#btn-refresh-thread').on('click', function () {
                    var syncUrl = $(this).data('sync-url');
                    var $btn = $(this);
                    $btn.prop('disabled', true).text('Refreshing…');

                    $.ajax({
                        url: syncUrl,
                        method: 'GET',
                        dataType: 'json',
                        cache: false
                    }).always(function () {
                        loadConversation();
                        $btn.prop('disabled', false).text('⟳ Refresh conversation');
                    });
                });

                // Global handler for attachment previews
                $(document).on('click', '.attach-preview-link', function (e) {
                    e.preventDefault();
                    var raw = $(this).attr('data-attachments');
                    if (!raw) return;

                    var attachments = [];
                    try {
                        attachments = JSON.parse(raw);
                    } catch (err) {
                        console.error('Invalid data-attachments JSON', err);
                        return;
                    }

                    if (!Array.isArray(attachments) || !attachments.length) return;

                    var startIndex = $(this).attr('data-attachment-index') || 0;
                    openAttachmentsModal(attachments, startIndex);
                });
            });
        })(jQuery);
    </script>
@endpush
