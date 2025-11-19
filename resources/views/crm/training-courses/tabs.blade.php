@php
    $routeName = request()->route()->getName();
    $tab       = request()->get('tab');
    $isShow    = $routeName === 'crm.training-courses.show';
    $isAudit   = $isShow && ($tab === 'audit');
    $isProfit  = $isShow && ($tab === 'profit');
    $isMisc    = $isShow && ($tab === 'misc');
    $isDetails = $isShow && !$isAudit && !$isProfit && !$isMisc;
    $cohortId  = request()->route('training_course');
@endphp

<style>
    .erp-nav {
        display: flex;
        gap: 12px;
        background: linear-gradient(90deg, #f7f8fa 0%, #eef0f3 100%);
        border-radius: 12px;
        padding: 6px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.08);
        flex-wrap: wrap;
    }

    .erp-nav .nav-link {
        display: flex;
        align-items: center;
        gap: 6px;
        padding: 8px 16px;
        font-weight: 600;
        font-size: 14px;
        color: #6c757d;
        border-radius: 8px;
        transition: all 0.25s ease;
        border: 1px solid transparent;
        background: transparent;
    }

    .erp-nav .nav-link:hover {
        color: #0d6efd;
        background: rgba(13, 110, 253, 0.06);
    }

    .erp-nav .nav-link.active {
        color: #fff;
        background: linear-gradient(135deg, #0d6efd, #0b5ed7);
        border-color: #0a58ca;
        box-shadow: 0 2px 6px rgba(13,110,253,0.25);
    }

    .erp-nav .nav-link svg {
        width: 16px;
        height: 16px;
        opacity: 0.7;
        transition: opacity .2s;
    }

    .erp-nav .nav-link.active svg {
        opacity: 1;
        fill: #fff;
    }
</style>

<ul class="nav nav-pills erp-nav" id="pills-tab" role="tablist">
    {{-- Cohort Details --}}
    <li class="nav-item" role="presentation">
        <a class="nav-link {{ $isDetails ? 'active' : '' }}"
           id="pills-cohort-details-tab"
           href="{{ route('crm.training-courses.show', [$cohortId]) }}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-journal-text" viewBox="0 0 16 16">
                <path d="M5 8V1h6v7H5zm0 1h6v7H5V9z"/>
                <path d="M1 2.828c.885-.37 2.154-.828 3.5-.828h8a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H4.5c-1.346 0-2.615-.458-3.5-.828V2.828z"/>
            </svg>
            Cohort Details
        </a>
    </li>

    {{-- Profit Margins --}}
    <li class="nav-item" role="presentation">
        <a class="nav-link {{ $isProfit ? 'active' : '' }}"
           id="pills-profit-margin-tab"
           href="{{ route('crm.training-courses.show', [$cohortId, 'tab' => 'profit']) }}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-graph-up-arrow" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M0 0h1v15h15v1H0V0zm10.293 4.293a1 1 0 0 1 1.414 0l3.5 3.5a1 1 0 0 1-1.414 1.414L11 6.414l-4.646 4.647a.5.5 0 0 1-.708 0L3.5 8.914l.708-.708L6 9.998l4.293-4.292z"/>
            </svg>
            Profit Margins
        </a>
    </li>

    {{-- Miscellaneous Cost --}}
    <li class="nav-item" role="presentation">
        <a class="nav-link {{ $isMisc ? 'active' : '' }}"
           id="pills-miscellaneous-tab"
           href="{{ route('crm.training-courses.show', [$cohortId, 'tab' => 'misc']) }}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-cash-stack" viewBox="0 0 16 16">
                <path d="M3 3a1 1 0 0 1 1-1h9a1 1 0 0 1 1 1v1H3V3zm10 2v6H3V5h10zM2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h11a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H2z"/>
                <path d="M8 9.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z"/>
            </svg>
            Miscellaneous Cost
        </a>
    </li>

    {{-- Audit History --}}
    <li class="nav-item" role="presentation">
        <a class="nav-link {{ $isAudit ? 'active' : '' }}"
           id="pills-audit-history-tab"
           href="{{ route('crm.training-courses.show', [$cohortId, 'tab' => 'audit']) }}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-clock-history" viewBox="0 0 16 16">
                <path d="M8.515 3.757a.5.5 0 0 0-.765.424v4.768l3.182 1.852a.5.5 0 1 0 .496-.868L8.5 8.293V4.181a.5.5 0 0 0-.485-.424z"/>
                <path d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 1 1 .908-.418A6 6 0 1 1 8 2v1z"/>
            </svg>
            Audit History
        </a>
    </li>
</ul>
