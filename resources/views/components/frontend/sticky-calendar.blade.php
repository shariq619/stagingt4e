<style>
    .mobile-break {
        display: block;
    }

    .stickyBanner {
        background: linear-gradient(90deg, #0a1128 0%, #08091b 50%, #000 100%);
        padding: 14px 0;
        position: relative;
        box-shadow: 0 18px 40px rgba(0, 0, 0, 0.35);
        border-radius: 0 0 22px 22px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        overflow: hidden;
        z-index: 1050;
    }

    /* Soft shimmering Christmas glow */
    .stickyBanner::before {
        content: '';
        position: absolute;
        inset: 0;
        background: rgba(255, 255, 255, 0.06);
        backdrop-filter: blur(4px);
        pointer-events: none;
        animation: shimmer 4s infinite linear;
    }

    @keyframes shimmer {
        0% {
            opacity: 0.1;
        }
        50% {
            opacity: 0.18;
        }
        100% {
            opacity: 0.1;
        }
    }

    @keyframes slideDown {
        from {
            transform: translateY(-100%);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    /* Falling snow */

    /* Falling snow */
    .stickyBanner::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: url('https://img.freepik.com/free-vector/hand-drawn-flat-christmas-pattern-design_23-2149147706.jpg?semt=ais_hybrid&w=740&q=80');
        background-repeat: repeat; /* repeat both ways */
        background-size: cover;    /* adjust as needed */
        opacity: 0.08 !important; /* lower value = less interference */
        pointer-events: none;
        animation: snowfall 100s linear infinite;
    }

    @keyframes snowfall {
        0% {
            background-position: 0 0;
        }
        100% {
            background-position: 0 100%;
        }
    }

    /* Text styles */
    .stickyBanner .headline {
        font-family: "Rubik", sans-serif;
        color: #ffffff;
        font-size: 18px;
        line-height: 1.5;
        text-shadow: 0 2px 6px rgba(0, 0, 0, 0.45);
        margin: 0;
    }

    .stickyBanner .headline strong {
        color: #ea7000;
        text-shadow: 0 2px 10px rgba(250, 204, 21, 0.55);
        font-weight: 700;
    }

    /* Tag pill */
    .tag-pill {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 3px 10px;
        border-radius: 999px;
        background: rgba(255, 255, 255, 0.12);
        border: 1px solid rgba(255, 255, 255, 0.25);
        font-size: 11px;
        color: #fff;
    }

    .stickyBanner .headline .tag-pill span {
        font-size: 10px;
        opacity: 0.9;
    }

    .stickyBanner .headline .highlight-inline {
        padding: 2px 8px;
        border-radius: 999px;
        background: rgba(15, 23, 42, 0.45);
        border: 1px solid rgba(248, 250, 252, 0.18);
    }

    .stickyBanner .subcopy {
        font-family: "Rubik", system-ui, -apple-system, BlinkMacSystemFont, sans-serif;
        font-size: 12px;
        color: #e5e7eb;
        margin: 6px 0 0;
        opacity: 0.92;
    }

    .stickyBanner .subcopy strong {
        color: #fef9c3;
        font-weight: 600;
    }

    .calenddarBanner {
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        gap: 4px;
    }

    .calenddarBanner p.m-0 {
        text-align: right;
        font-size: 12px;
        margin-top: 6px !important;
        color: #e5e7eb;
        font-family: "Rubik", sans-serif;
    }

    .calenddarBanner p.m-0 small {
        opacity: 0.9;
    }

    #countdown-container {
        display: flex;
        justify-content: center;
        gap: 12px;
        padding: 6px 0 2px;
    }

    #countdown-container .countdown-box {
        max-width: 72px;
        flex-basis: 72px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        gap: 6px;
    }

    #countdown-container .countdown-box small {
        font-family: "Rubik", sans-serif;
        font-size: 11px;
        margin-top: 0;
        color: #f9fafb;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-weight: 500;
        text-shadow: 0 1px 3px rgba(15, 23, 42, 0.45);
        opacity: 0.9;
    }

    .countdown-box div {
        background: radial-gradient(circle at top, rgba(248, 250, 252, 0.9), rgba(226, 232, 240, 0.7));
        backdrop-filter: blur(14px);
        color: #111827;
        border-radius: 14px;
        min-width: 52px;
        height: 52px;
        width: 52px;
        min-height: 52px;
        font-family: "Rubik", sans-serif;
        display: flex;
        font-size: 22px;
        font-weight: 700;
        align-items: center;
        justify-content: center;
        box-shadow: 0 8px 25px rgba(15, 23, 42, 0.35),
        inset 0 1px 0 rgba(255, 255, 255, 0.7);
        border: 1px solid rgba(148, 163, 184, 0.65);
        transition: transform 0.25s ease, box-shadow 0.25s ease, translate 0.25s ease;
    }

    .countdown-box div:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 30px rgba(15, 23, 42, 0.5),
        inset 0 1px 0 rgba(255, 255, 255, 0.8);
    }

    .closeBtn {
        position: absolute;
        right: 14px;
        top: 10px;
        z-index: 10;
    }

    .closeBtn i {
        cursor: pointer;
        background: rgba(15, 23, 42, 0.65);
        color: #f9fafb;
        width: 32px;
        height: 32px;
        border-radius: 999px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        transition: all 0.25s ease;
        backdrop-filter: blur(16px);
        border: 1px solid rgba(248, 250, 252, 0.32);
        box-shadow: 0 8px 24px rgba(15, 23, 42, 0.6);
    }

    .closeBtn i:hover {
        background: rgba(15, 23, 42, 0.85);
        transform: rotate(90deg) scale(1.06);
        box-shadow: 0 10px 30px rgba(15, 23, 42, 0.8);
    }

    @media (min-width: 768px) {
        .mobile-break {
            display: none;
        }
    }

    @media (max-width: 767px) {
        .headline {
            text-align: center;
        }

        .stickyBanner {
            top: 0;
            padding: 12px 0 14px;
            border-radius: 0 0 18px 18px;
        }

        .stickyBanner .headline {
            font-size: 16px;
        }

        .stickyBanner .subcopy {
            text-align: center;
        }

        #countdown-container {
            gap: 8px;
            margin-top: 10px;
        }

        #countdown-container .countdown-box {
            max-width: 64px;
            flex-basis: 64px;
        }

        .countdown-box div {
            min-width: 46px;
            height: 46px;
            width: 46px;
            min-height: 46px;
            font-size: 18px;
            border-radius: 12px;
        }

        #countdown-container .countdown-box small {
            font-size: 10px;
        }

        .calenddarBanner {
            align-items: center;
        }

        .calenddarBanner p.m-0 {
            text-align: center;
        }

        .closeBtn {
            right: 10px;
            top: 8px;
        }

        .closeBtn i {
            width: 28px;
            height: 28px;
            font-size: 12px;
        }
    }

    @media (max-width: 500px) {
        .stickyBanner {
            padding: 10px 0 12px;
        }

        .stickyBanner .headline {
            font-size: 14px;
            line-height: 1.55;
        }

        .stickyBanner .headline .tag-pill {
            margin-bottom: 4px;
        }

        #countdown-container {
            gap: 6px;
        }

        #countdown-container .countdown-box {
            max-width: 58px;
            flex-basis: 58px;
        }

        .countdown-box div {
            min-width: 40px;
            height: 40px;
            width: 40px;
            min-height: 40px;
            font-size: 16px;
            border-radius: 10px;
        }

        #countdown-container .countdown-box small {
            font-size: 9px;
        }
    }
</style>

<div class="stickyBanner" aria-hidden="false">
    <div class="closeBtn" aria-label="Close banner">
        <i class="fa-solid fa-xmark closeBanner"></i>
    </div>
    <div class="container">
        <div class="row align-items-center justify-content-center g-2">
            <div class="col-12 col-md-7 col-lg-7 col-xl-7">
                <p class="headline">
                    Book your <strong>December courses</strong> now and enjoy an exclusive
                    <strong>10% discount</strong>.
                </p>
                <p class="headline">
                    Subscribe to receive your code instantly.
                </p>
            </div>
            <div class="col-12 col-md-5 col-lg-4 col-xl-3 offset-xl-1 mt-2 mt-md-0">
                <div class="calenddarBanner">
                    <div id="countdown-container" aria-hidden="true">
                        <div id="days" class="countdown-box">
                            <div class="days"></div>
                            <small>Days</small>
                        </div>
                        <div id="hours" class="countdown-box">
                            <div class="hours"></div>
                            <small>Hours</small>
                        </div>
                        <div id="minutes" class="countdown-box">
                            <div class="minutes"></div>
                            <small>Minutes</small>
                        </div>
                        <div id="seconds" class="countdown-box">
                            <div class="seconds"></div>
                            <small>Seconds</small>
                        </div>
                    </div>
                    <p class="m-0">
                        <small>Countdown to the end of the <strong>December 10% OFF</strong> promotion.</small>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')
    <!-- Countdown plugin -->
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery.countdown/2.2.0/jquery.countdown.min.js"
        integrity="sha512-lteuRD+aUENrZPTXWFRPTBcDDxIGWe5uu0apPEn+3ZKYDwDaEErIK9rvR0QzUGmUQ55KFE2RqGTVoZsKctGMVw=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer"
        defer
    ></script>

    <script defer>
        document.addEventListener('DOMContentLoaded', function () {

            // 1. Simple Close (NO LOCAL STORAGE)
            const closeBanner = document.querySelector('.closeBanner');
            const stickyBanner = document.querySelector('.stickyBanner');

            if (closeBanner && stickyBanner) {
                closeBanner.addEventListener('click', function (e) {
                    e.preventDefault();
                    stickyBanner.style.display = 'none';
                });
            }

            // 2. Robust countdown init (waits for plugin to be ready)
            function initCountdown() {
                if (typeof window.jQuery === 'undefined' || typeof jQuery.fn.countdown === 'undefined') {
                    return false;
                }

                const eventTime = "2025/12/31 23:59:59";

                jQuery(".days, .hours, .minutes, .seconds").countdown(eventTime, function (event) {
                    const $this = jQuery(this);

                    if ($this.hasClass('days')) {
                        $this.html(event.strftime('%D'));
                    } else if ($this.hasClass('hours')) {
                        $this.html(event.strftime('%H'));
                    } else if ($this.hasClass('minutes')) {
                        $this.html(event.strftime('%M'));
                    } else {
                        $this.html(event.strftime('%S'));
                    }
                });

                return true;
            }

            // Retry until plugin is loaded (max ~5 seconds)
            let attempts = 0;
            const countdownInterval = setInterval(function () {
                if (initCountdown()) {
                    clearInterval(countdownInterval);
                } else {
                    attempts++;
                    if (attempts > 20) {
                        clearInterval(countdownInterval);
                        console.warn('Countdown plugin not available – check jQuery / CDN load.');
                    }
                }
            }, 250);
        });
    </script>
@endpush


