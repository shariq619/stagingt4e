<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Certificate of Completion</title>
    <style>
        @page {
            size: A4 landscape;
            margin: 28px 36px;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: DejaVu Sans, Arial, sans-serif;
            color: #111;
        }

        .wrap {
            width: 100%;
            height: 100%;
            position: relative;
        }

        .bg {
            position: absolute;
            inset: 0;
            background: radial-gradient(closest-side, rgba(0, 0, 0, 0.06), transparent 70%) center/1400px 1400px,
            radial-gradient(closest-side, rgba(0, 0, 0, 0.04), transparent 70%) 20% 40%/1100px 1100px,
            radial-gradient(closest-side, rgba(0, 0, 0, 0.03), transparent 70%) 80% 70%/900px 900px;
            opacity: .25;
        }

        .content {
            position: relative;
            z-index: 2;
            text-align: center;
            padding: 8px 10px;
        }

        .title {
            font-size: 72px;
            letter-spacing: 6px;
            font-weight: 600;
            margin: 18px 0 8px;
        }

        .ribbon {
            display: inline-block;
            background: #c50000;
            color: #fff;
            font-weight: 600;
            font-size: 22px;
            padding: 8px 22px;
            border-radius: 4px;
            margin: 4px 0 10px;
        }

        .subtitle {
            margin: 8px 0 18px;
            font-size: 14px;
            color: #333;
        }

        .brand {
            margin: 6px 0 18px;
        }

        .brand img {
            height: 56px;
        }

        .line {
            margin: 10px auto;
            width: 86%;
            border-top: 1px solid #ddd;
        }

        .certify {
            font-weight: 600;
            font-size: 14px;
            letter-spacing: 1px;
            margin-top: 6px;
        }

        .learner {
            font-size: 34px;
            font-weight: 600;
            margin: 8px 0 6px;
        }

        .has-completed {
            font-size: 14px;
            margin: 4px 0;
            color: #333;
        }

        .course {
            font-size: 28px;
            font-weight: 900;
            margin: 6px 0 2px;
        }

        .recommend {
            font-size: 14px;
            color: #333;
            margin: 4px 0 10px;
        }

        .footer {
            display: table;
            width: 86%;
            margin: 26px auto 6px;
            table-layout: fixed;
            font-size: 12px;
            color: #222;
        }

        .fcol {
            display: table-cell;
            vertical-align: bottom;
        }

        .left {
            text-align: left;
        }

        .right {
            text-align: right;
        }

        .sig {
            height: 46px;
        }

        .md {
            margin-top: 4px;
            font-weight: 700;
        }

        .company {
            margin-top: 2px;
        }

        .dates {
            line-height: 1.6;
        }

        .label {
            color: #444;
        }

        .value {
            font-weight: 700;
        }
    </style>
</head>
<body>
@php
    use Carbon\Carbon;
    $now = Carbon::now();
    $issued_on = $issued_on ?? $now->format('d-m-Y');
    $valid_until = $valid_until ?? $now->copy()->addYears(3)->subDay()->format('d-m-Y');
    $learner_id = $learner_id ?? null;
    $certificate_number = $certificate_number ?? ($now->format('jS F Y') . '-D' . str_pad((int)($learner_id ?? 0), 7, '0', STR_PAD_LEFT));
                $logo = url('crm/assets/img/logo.png');

@endphp
<div class="wrap">
    <div class="bg"></div>
    <div class="content">
        <div class="title">CERTIFICATE</div>
        <div class="ribbon">OF COMPLETION</div>
        <div class="subtitle">
            Certificate Number:
            <span class="value">{{ $certificate_number }}</span>
        </div>

        <div class="brand">
            <img src="{{ $logo }}" alt="Logo">
        </div>
        <div class="certify">THIS IS TO CERTIFY THAT</div>
        <div class="learner">{{ $learner_name ?? '' }}</div>
        <div class="has-completed">has successfully completed</div>
        <div class="course">{{ $course_title ?? '' }}</div>
        <div class="recommend">as recommended by the Health and Safety Executive (HSA)</div>
        <div class="line"></div>
        <div class="footer">
            <div class="fcol left">
                @if(!empty($signature_url))
                    <img class="sig" src="{{ $signature_url }}" alt="Signature">
                @else
                    <div style="height:46px"></div>
                @endif
                <div class="md">{{ $managing_director ?? 'Managing Director' }}</div>
                <div class="company">{{ $company_name ?? 'Training for Employment Ltd' }}</div>
            </div>
            <div class="fcol right dates">
                <div><span class="label">Issued on:</span> <span class="value">{{ $issued_on }}</span></div>
                <div><span class="label">Valid until:</span> <span class="value">{{ $valid_until }}</span></div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
