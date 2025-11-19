@extends('crm.layout.main')

@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-bootstrap-4/bootstrap-4.min.css">
    <style>
        body {
            background: #f3f4f6;
            color: #1f2937;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            font-size: 14px;
            line-height: 1.4;
        }

        .page-inner {
            padding: 24px 0 48px;
        }

        .composer-shell {
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 16px;
            box-shadow: 0 24px 48px -8px rgba(0, 0, 0, .2);
            overflow: hidden;
        }

        .composer-head {
            background: linear-gradient(to right, #ffffff 0%, #f9fafb 60%);
            border-bottom: 1px solid #e5e7eb;
            padding: 12px 16px;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            gap: 8px;
        }

        .composer-head-left {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .composer-title {
            font-size: 14px;
            font-weight: 700;
            color: #111827;
        }

        .composer-sub {
            font-size: 12px;
            color: #6b7280;
        }

        .btn-top {
            font-size: 12px;
            font-weight: 600;
            line-height: 1.2;
            border-radius: 9999px;
            border: 1px solid #d1d5db;
            background: #fff;
            padding: .45rem .8rem;
            box-shadow: 0 4px 10px rgba(0, 0, 0, .05);
            cursor: pointer;
            text-decoration: none;
            color: #111827;
        }

        .btn-top:hover {
            text-decoration: none;
            background: #f9fafb;
        }

        .composer-body {
            padding: 16px;
            background: #fff;
        }

        .row-field {
            display: flex;
            align-items: flex-start;
            padding: 6px 0;
            border-bottom: 1px solid #f1f2f5;
        }

        .row-field .label-col {
            flex: 0 0 140px;
            font-size: 12px;
            font-weight: 600;
            color: #374151;
            line-height: 1.6;
        }

        .row-field .value-col {
            flex: 1 1 auto;
        }

        .field-text {
            font-size: 13px;
            color: #111827;
            word-break: break-word;
        }

        .field-text.muted {
            color: #9ca3af;
        }

        .pill-email {
            display: inline-flex;
            align-items: center;
            padding: .25rem .6rem;
            border-radius: 9999px;
            background: #eef2ff;
            border: 1px solid #c7d2fe;
            font-size: 12px;
            font-weight: 600;
            color: #4338ca;
            margin: 0 4px 4px 0;
        }

        .sec-title {
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            color: #4b5563;
            letter-spacing: .03em;
            margin-top: 18px;
            margin-bottom: 6px;
        }

        .body-panel {
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            background: #ffffff;
            padding: 12px;
            max-height: 600px;
            overflow: auto;
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
        }

        .attachments-bar {
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 8px 12px;
            font-size: 12px;
            color: #374151;
        }

        .attach-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 4px 0;
            border-bottom: 1px solid #edf1f5;
        }

        .attach-row:last-child {
            border-bottom: 0;
        }

        .attach-name {
            font-weight: 600;
            color: #1f2937;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 60vw;
        }

        .attach-meta {
            font-size: 11px;
            color: #6b7280;
        }

        .attach-link a {
            font-size: 12px;
            font-weight: 600;
            color: #2563eb;
            text-decoration: none;
        }

        .attach-link a:hover {
            text-decoration: underline;
        }

        .badge-status {
            display: inline-flex;
            align-items: center;
            padding: .15rem .5rem;
            border-radius: 9999px;
            font-size: 11px;
            font-weight: 600;
            margin-left: 8px;
        }

        .badge-status.sent {
            background: #dcfce7;
            color: #166534;
        }

        .badge-status.queued {
            background: #fef9c3;
            color: #854d0e;
        }

        .badge-status.failed {
            background: #fee2e2;
            color: #991b1b;
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
                            Email to {{ $send->recipient_email ?: '-' }}
                        </div>
                        <div class="composer-sub">
                            Subject: {{ $send->subject ?: '-' }}
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
                                <span
                                    style="margin-left:8px;">Sent at {{ $send->sent_at->format('d-m-Y H:i:s') }}</span>
                            @elseif($send->created_at)
                                <span
                                    style="margin-left:8px;">Created at {{ $send->created_at->format('d-m-Y H:i:s') }}</span>
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
                    <div class="row-field">
                        <div class="label-col">To</div>
                        <div class="value-col">
                            @if($send->recipient_email)
                                <span class="pill-email">{{ $send->recipient_email }}</span>
                            @else
                                <span class="field-text muted">-</span>
                            @endif
                        </div>
                    </div>
                    <div class="row-field">
                        <div class="label-col">CC</div>
                        <div class="value-col">
                            @forelse($cc as $addr)
                                <span class="pill-email">{{ $addr }}</span>
                            @empty
                                <span class="field-text muted">-</span>
                            @endforelse
                        </div>
                    </div>
                    <div class="row-field">
                        <div class="label-col">BCC</div>
                        <div class="value-col">
                            @forelse($bcc as $addr)
                                <span class="pill-email">{{ $addr }}</span>
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

                    <div class="sec-title">Attachments</div>
                    <div class="attachments-bar">
                        @if(!empty($attachments))
                            @foreach($attachments as $att)
                                @php
                                    $name = $att['original_name'] ?? $att['name'] ?? 'Attachment';
                                    $size = $att['size'] ?? '';
                                    $url  = $att['url']  ?? '#';
                                @endphp
                                <div class="attach-row">
                                    <div>
                                        <div class="attach-name">{{ $name }}</div>
                                        @if($size)
                                            <div class="attach-meta">{{ $size }}</div>
                                        @endif
                                    </div>
                                    <div class="attach-link">
                                        @if($url && $url !== '#')
                                            <a href="{{ $url }}" target="_blank">Open</a>
                                        @else
                                            <span class="field-text muted">No file</span>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="field-text muted">No attachments</div>
                        @endif
                    </div>

                    <div class="sec-title">Body (HTML)</div>
                    <div class="body-panel body-panel-html">
                        {!! $send->html_body !!}
                    </div>

                    <div class="d-none sec-title">Body (Plain text)</div>
                    <div class="d-none body-panel body-panel-text">
                        {{ $send->text_body }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

