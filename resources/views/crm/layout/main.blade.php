<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <title>@yield('title')</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('icon/cropped-favicon-32x32-1-32x32.png') }}" type="image/x-icon"/>
    <script src="{{ asset('crm/assets/js/plugin/webfont/webfont.min.js') }}"></script>
    <script>
        WebFont.load({
            google: {families: ["Public Sans:300,400,500,600,700"]},
            custom: {
                families: [
                    "Font Awesome 5 Solid",
                    "Font Awesome 5 Regular",
                    "Font Awesome 5 Brands",
                    "simple-line-icons"
                ],
                urls: ["/crm/assets/css/fonts.min.css"]
            },
            active: function () {
                sessionStorage.fonts = true;
            }
        });
    </script>

    <link rel="stylesheet" href="{{ asset('crm/assets/css/bootstrap.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('crm/assets/css/plugins.min.css') }}"/>

    <style>
        :root {
            --ink: #0f172a;
            --muted: #6b7280;
            --br: #e5e7eb;
            --bg: #f7f8fa;
            --pri: #1168e6;
            --pri-soft: #e0edff;
            --tb-bg: #ffffff;
            --tb-border: #e5e7eb;
            --tb-text: #111827;
            --tb-muted: #6b7280;
            --tb-accent: #ffffff;
        }

        body {
            background: var(--bg);
            font-family: -apple-system, BlinkMacSystemFont, "SF Pro Display", "Inter", "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            -webkit-font-smoothing: antialiased;
            text-rendering: optimizeLegibility;
            color: var(--tb-text);
            font-size: 14px;
            line-height: 1.4;
        }

        .topbar {
            position: sticky;
            top: 0;
            z-index: 1050;
            width: 100%;
            background: var(--tb-bg);
            border-bottom: 1px solid var(--tb-border);
            box-shadow: 0 6px 18px rgba(15, 23, 42, .05);
        }

        .topbar-inner {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: .55rem 1rem;
            transition: all .2s ease;
        }

        @media (min-width: 1200px) {
            .topbar-inner {

                margin-inline: auto;
            }
        }

        .brand img {
            height: 72px;
            display: block;
        }

        .nav-strip {
            flex: 1 1 auto;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .nav-scroll {
            display: flex;
            gap: .75rem;
            overflow-x: auto;
            padding-inline: .5rem;
            scrollbar-width: thin;
        }

        .nav-scroll::-webkit-scrollbar {
            height: 6px;
        }

        .nav-scroll::-webkit-scrollbar-thumb {
            background: #d1d5db;
            border-radius: 999px;
        }

        .tb-link {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-width: 180px;
            gap: .2rem;
            padding: .5rem .8rem;
            border-radius: 999px;
            border: 1px solid rgba(209, 213, 219, .9);
            background: #fff;
            color: var(--tb-muted);
            text-decoration: none;

            transition: all .18s ease;
        }

        .tb-link i {
            font-size: 20px;
            opacity: .9;
        }

        .tb-link span {
            font-size: .8rem;
            font-weight: 500;
            letter-spacing: .01em;
        }

        .tb-link:hover {
            color: var(--pri);
            border-color: rgba(191, 219, 254, .95);
            background: #f9fafb;
            transform: translateY(-1px);
            box-shadow: 0 10px 22px rgba(15, 23, 42, .1);
        }

        .tb-link.active {
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            color: #fff;
            border-color: transparent;

        }

        .tb-link.active i,
        .tb-link.active span {
            color: #fff;
        }

        .tb-actions {
            display: flex;
            align-items: center;
            gap: .4rem;
        }

        .tb-btn {
            width: 36px;
            height: 36px;
            border-radius: 999px;
            background: #fff;
            border: 1px solid var(--tb-border);
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 6px 16px rgba(15, 23, 42, .1);
            transition: all .18s ease;
        }

        .tb-btn:hover {
            background: #eef2ff;
            border-color: rgba(129, 140, 248, .8);
            transform: translateY(-1px);
        }

        @media (min-width: 992px) {
            .tb-actions {
                display: none;
            }
        }

        .quickmenu-shell {
            overflow: hidden;
            max-height: 0;
            opacity: 0;
            border-top: 1px solid var(--tb-border);
            background: #fff;
            box-shadow: inset 0 2px 6px rgba(15, 23, 42, .04);
            transition: all .3s cubic-bezier(.4, 0, .2, 1);
        }

        .quickmenu-shell.show {
            max-height: 300px;
            opacity: 1;
            padding: .6rem .9rem .9rem;
        }

        .quickmenu-shell .qm-pill {
            display: inline-flex;
            align-items: center;
            gap: .4rem;
            padding: .45rem .9rem;
            font-size: .8rem;
            font-weight: 500;
            color: var(--tb-text);
            border: 1px solid rgba(148, 163, 184, .6);
            border-radius: 999px;
            background: #fff;
            margin: .25rem;
            box-shadow: 0 4px 10px rgba(15, 23, 42, .05);
            transition: all .18s ease;
        }

        .quickmenu-shell .qm-pill:hover {
            color: var(--pri);
            border-color: rgba(129, 140, 248, .7);
            background: #eef2ff;
            transform: translateY(-1px);
            box-shadow: 0 10px 20px rgba(15, 23, 42, .08);
        }

        .quickmenu-shell .qm-pill.active {
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            color: #fff;
            border-color: transparent;
            box-shadow: 0 10px 22px rgba(37, 99, 235, .45);
        }

        @media (max-width: 768px) {
            .brand img {
                height: 32px;
            }

            .nav-strip {
                justify-content: flex-start;
            }

            .tb-link {
                min-width: 72px;
            }

            .tb-link i {
                font-size: 18px;
            }
        }
    </style>

    <style>
        .swal2-popup {
            border-radius: 14px !important;
            border: 1px solid #e5e7eb !important;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15) !important;
            background: #fff !important;
        }

        .swal2-confirm {
            border-radius: 9999px !important;
            background: linear-gradient(90deg, #2563eb, #1d4ed8) !important;
            border: none !important;
            color: #fff !important;
            font-weight: 500 !important;
            padding: 8px 20px !important;
            font-size: 14px !important;
            transition: all 0.2s ease-in-out !important;
        }

        .swal2-confirm:hover {
            filter: brightness(1.08) !important;
        }

        .swal2-cancel {
            border-radius: 9999px !important;
            background: #f3f4f6 !important;
            border: none !important;
            color: #374151 !important;
            font-weight: 500 !important;
            padding: 8px 20px !important;
            font-size: 14px !important;
            transition: all 0.2s ease-in-out !important;
        }

        .swal2-cancel:hover {
            background: #e5e7eb !important;
        }

        .swal2-deny {
            border-radius: 9999px !important;
            background: linear-gradient(90deg, #16a34a, #15803d) !important;
            border: none !important;
            color: #fff !important;
            font-weight: 500 !important;
            padding: 8px 20px !important;
            font-size: 14px !important;
            transition: all 0.2s ease-in-out !important;
        }

        .swal2-deny:hover {
            filter: brightness(1.1) !important;
        }

        .tox-statusbar__path {
            display: none !important;
        }

        .dropdown-menu {
            background: #fff;
            border: 1px solid rgba(0,0,0,0.05);
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            transition: all .2s ease-in-out;
        }

        .dropdown-item {
            border-radius: .5rem;
            transition: background .2s, color .2s;
        }

        .dropdown-item:hover {
            background: #f8fafc;
            color: #0f172a;
        }
    </style>
    @stack('css')
</head>

<body>
<div class="wrapper">
    @include('crm.layout.top-nav-bar')

    <div class="main-panel">
        @yield('main')
        @include('crm.layout.footer')
    </div>
</div>

@if(!Request::is('crm/leads'))<script src="{{ asset('crm/assets/js/core/popper.min.js') }}"></script>@endif

<script src="{{ asset('crm/assets/js/core/jquery-3.7.1.min.js') }}"></script>
<script src="{{ asset('crm/assets/js/core/bootstrap.min.js') }}"></script>
<script src="{{ asset('crm/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>
<script src="{{ asset('crm/assets/js/plugin/chart.js/chart.min.js') }}"></script>
<script src="{{ asset('crm/assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js') }}"></script>
<script src="{{ asset('crm/assets/js/plugin/chart-circle/circles.min.js') }}"></script>
<script src="{{ asset('crm/assets/js/plugin/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('crm/assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>
<script src="{{ asset('crm/assets/js/plugin/jsvectormap/jsvectormap.min.js') }}"></script>
<script src="{{ asset('crm/assets/js/plugin/jsvectormap/world.js') }}"></script>
<script src="{{ asset('crm/assets/js/plugin/sweetalert/sweetalert.min.js') }}"></script>
<script src="{{ asset('crm/assets/js/kaiadmin.min.js') }}"></script>

<script>
    function showEmailTab(selector) {
        if ($('#quickMenu').length) {
            $('#quickMenu').collapse('hide');
        }

        const $pill = $('#emailAdminTabs a[href="' + selector + '"]');

        if ($pill.length) {
            $pill.tab('show');

            const $card = $('.page-inner .card').first();
            if ($card.length) {
                $('html, body').animate(
                    {scrollTop: $card.offset().top - 20},
                    300
                );
            }
        }
    }

    $(document).on('click', '.email-tab-link', function (e) {
        e.preventDefault();

        const targetTab = $(this).data('tab');
        const emailPageUrl = "{{ route('crm.email.index') }}";

        const currentPath = window.location.pathname.replace(/\/+$/, '');
        const emailPath = (function (u) {
            const a = document.createElement('a');
            a.href = u;
            return a.pathname.replace(/\/+$/, '');
        })(emailPageUrl);

        const isEmailPage = currentPath === emailPath;

        if (!isEmailPage) {
            const cleanTab = String(targetTab).replace('#', '');
            window.location = emailPageUrl + '?tab=' + cleanTab;
            return;
        }

        showEmailTab(targetTab);
    });

    $(function () {
        const params = new URLSearchParams(window.location.search);
        const tabFromUrl = params.get('tab');

        if (tabFromUrl) {
            showEmailTab('#' + tabFromUrl);
        }
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const toggleBtn = document.querySelector(".tb-btn");
        const quickMenu = document.querySelector(".quickmenu-shell");
        if (toggleBtn && quickMenu) {
            toggleBtn.addEventListener("click", () => {
                quickMenu.classList.toggle("show");
            });
        }
    });
</script>

@stack('js')
</body>
</html>
