
@section('title', 'Page Not Found')

<style>
    :root {
        --ink: #020617;
        --muted: #6b7280;
        --soft: #e5e7eb;
        --bg: radial-gradient(circle at top left, #0f172a 0, #020617 45%, #020617 100%);
        --accent: #38bdf8;
        --accent-soft: rgba(56, 189, 248, .12);
        --accent-deep: #0ea5e9;
        --card-bg: rgba(15, 23, 42, 0.8);
        --danger: #fb7185;
        --pri: #2563eb;
    }

    html,
    body {
        height: 100%;
        margin: 0;
        padding: 0;
    }

    body.crm-error-fallback {
        min-height: 100vh;
        height: 100%;
        background: var(--bg) fixed;
        background-size: cover;
        background-repeat: no-repeat;
        color: #e5e7eb;
        font-family: -apple-system, BlinkMacSystemFont, "SF Pro Display", "Inter", "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
        overflow-x: hidden;
    }

    .error-shell {
        min-height: 100vh;
        height: 100%;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 3rem 1.5rem;
        overflow: hidden;
    }

    .blob {
        position: absolute;
        width: 420px;
        height: 420px;
        border-radius: 999px;
        filter: blur(40px);
        opacity: .65;
        mix-blend-mode: screen;
        animation: blob-move 26s infinite alternate ease-in-out;
    }

    .blob-1 {
        top: -80px;
        left: -120px;
        background: radial-gradient(circle, #1d4ed8, #22c55e);
    }

    .blob-2 {
        bottom: -140px;
        right: -120px;
        background: radial-gradient(circle, #f97316, #ec4899);
        animation-delay: 3s;
    }

    .blob-3 {
        top: 40%;
        left: 60%;
        background: radial-gradient(circle, #06b6d4, #22d3ee);
        animation-delay: 6s;
    }

    @keyframes blob-move {
        0% {
            transform: translate3d(0, 0, 0) scale(1);
        }
        50% {
            transform: translate3d(40px, -30px, 0) scale(1.08);
        }
        100% {
            transform: translate3d(-30px, 30px, 0) scale(1.04);
        }
    }

    .error-card {
        position: relative;
        max-width: 720px;
        width: 100%;
        background: linear-gradient(135deg, rgba(15, 23, 42, .96), rgba(15, 23, 42, .82));
        border-radius: 1.75rem;
        border: 1px solid rgba(148, 163, 184, .28);
        box-shadow:
            0 24px 80px rgba(15, 23, 42, .75),
            0 0 0 1px rgba(15, 23, 42, .7),
            0 0 0 1px rgba(148, 163, 184, .18) inset;
        padding: 2.5rem 2.25rem 2.1rem;
        backdrop-filter: blur(18px);
        overflow: hidden;
        transform-origin: center;
        animation: card-in 0.65s cubic-bezier(.21, 1.02, .35, 1) forwards;
    }

    @keyframes card-in {
        0% {
            opacity: 0;
            transform: translate3d(0, 18px, 0) scale(.96);
        }
        100% {
            opacity: 1;
            transform: translate3d(0, 0, 0) scale(1);
        }
    }

    .error-pill {
        display: inline-flex;
        align-items: center;
        gap: .45rem;
        padding: .35rem .9rem;
        border-radius: 999px;
        border: 1px solid rgba(248, 250, 252, .22);
        background: radial-gradient(circle at top left, rgba(148, 163, 184, .28), rgba(15, 23, 42, .9));
        box-shadow: 0 10px 30px rgba(15, 23, 42, .9);
        margin-bottom: 1.4rem;
        font-size: .75rem;
        text-transform: uppercase;
        letter-spacing: .14em;
        color: #e5e7eb;
    }

    .error-pill-dot {
        width: 9px;
        height: 9px;
        border-radius: 999px;
        background: radial-gradient(circle, #22c55e, #16a34a);
        box-shadow: 0 0 0 0 rgba(34, 197, 94, .6);
        animation: ping-dot 1.5s infinite;
    }

    @keyframes ping-dot {
        0% {
            box-shadow: 0 0 0 0 rgba(34, 197, 94, .6);
        }
        70% {
            box-shadow: 0 0 0 12px rgba(34, 197, 94, 0);
        }
        100% {
            box-shadow: 0 0 0 0 rgba(34, 197, 94, 0);
        }
    }

    .error-heading {
        display: flex;
        align-items: baseline;
        justify-content: space-between;
        gap: 1.25rem;
        margin-bottom: 1.1rem;
    }

    .error-title {
        font-size: 2.25rem;
        line-height: 1.1;
        letter-spacing: -.03em;
        color: #f9fafb;
        display: flex;
        align-items: center;
        gap: .75rem;
    }

    .error-code-pill {
        padding: .1rem .7rem;
        border-radius: 999px;
        border: 1px solid rgba(148, 163, 184, .6);
        font-size: .75rem;
        color: #e5e7eb;
        background: radial-gradient(circle at top right, rgba(148, 163, 184, .35), rgba(15, 23, 42, .9));
    }

    .error-subtitle {
        font-size: .9rem;
        color: rgba(209, 213, 219, .88);
        max-width: 360px;
        text-align: right;
    }

    .error-body {
        display: grid;
        grid-template-columns: minmax(0, 1.5fr) minmax(0, 1.15fr);
        gap: 1.75rem;
        margin-top: 1.1rem;
        margin-bottom: 1.75rem;
    }

    @media (max-width: 768px) {
        .error-card {
            padding: 2rem 1.5rem 1.75rem;
            border-radius: 1.5rem;
        }

        .error-body {
            grid-template-columns: minmax(0, 1fr);
        }

        .error-heading {
            flex-direction: column;
            align-items: flex-start;
        }

        .error-subtitle {
            text-align: left;
        }

        .error-title {
            font-size: 1.7rem;
        }
    }

    .error-bullets {
        list-style: none;
        padding: 0;
        margin: 0;
        display: grid;
        gap: .55rem;
    }

    .error-bullets li {
        display: flex;
        align-items: flex-start;
        gap: .5rem;
        font-size: .86rem;
        color: rgba(209, 213, 219, .92);
    }

    .error-bullets i {
        margin-top: .1rem;
        font-size: .78rem;
        color: var(--accent);
    }

    .error-search-box {
        position: relative;
        margin-bottom: 1rem;
    }

    .error-search-input {
        width: 100%;
        background: rgba(15, 23, 42, .85);
        border-radius: 999px;
        border: 1px solid rgba(148, 163, 184, .5);
        padding: .6rem 3rem .6rem 1rem;
        font-size: .82rem;
        color: #e5e7eb;
        outline: none;
        box-shadow: 0 12px 25px rgba(15, 23, 42, .6);
        transition: all .2s ease;
    }

    .error-search-input::placeholder {
        color: rgba(148, 163, 184, .95);
    }

    .error-search-input:focus {
        border-color: rgba(96, 165, 250, .9);
        box-shadow:
            0 0 0 1px rgba(59, 130, 246, .6),
            0 18px 40px rgba(30, 64, 175, .75);
    }

    .error-search-icon {
        position: absolute;
        right: .85rem;
        top: 50%;
        transform: translateY(-50%);
        font-size: .95rem;
        color: rgba(148, 163, 184, .95);
    }

    .error-actions {
        display: flex;
        flex-wrap: wrap;
        gap: .75rem;
        align-items: center;
        margin-top: .5rem;
    }

    .btn-gradient {
        position: relative;
        overflow: hidden;
        border-radius: 999px;
        padding: .65rem 1.5rem;
        border: none;
        font-size: .86rem;
        font-weight: 500;
        letter-spacing: .03em;
        text-transform: uppercase;
        color: #0b1120;
        background: linear-gradient(135deg, #38bdf8, #4f46e5);
        box-shadow:
            0 18px 45px rgba(37, 99, 235, .7),
            0 0 0 1px rgba(191, 219, 254, .6);
        display: inline-flex;
        align-items: center;
        gap: .4rem;
        text-decoration: none;
        transition: transform .13s ease-out, box-shadow .13s ease-out;
    }

    .btn-gradient span.icon {
        font-size: 1rem;
        transform: translateX(0);
        transition: transform .18s ease;
    }

    .btn-gradient:hover {
        transform: translateY(-1px) translateZ(0);
        box-shadow:
            0 20px 55px rgba(37, 99, 235, .85),
            0 0 0 1px rgba(191, 219, 254, .9);
        color: #020617;
    }

    .btn-gradient:hover span.icon {
        transform: translateX(2px);
    }

    .btn-soft {
        border-radius: 999px;
        padding: .65rem 1.2rem;
        font-size: .83rem;
        font-weight: 500;
        color: rgba(226, 232, 240, .95);
        background: rgba(15, 23, 42, .9);
        border: 1px solid rgba(148, 163, 184, .6);
        display: inline-flex;
        align-items: center;
        gap: .45rem;
        text-decoration: none;
        box-shadow: 0 12px 30px rgba(15, 23, 42, .85);
        transition: all .18s ease;
    }

    .btn-soft:hover {
        background: rgba(15, 23, 42, 1);
        border-color: rgba(148, 163, 184, .9);
        transform: translateY(-1px);
    }

    .error-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: .72rem;
        color: rgba(148, 163, 184, .95);
        border-top: 1px solid rgba(30, 64, 175, .65);
        padding-top: .7rem;
        margin-top: .8rem;
        gap: .75rem;
    }

    .error-meta span.badge {
        border-radius: 999px;
        padding: .25rem .7rem;
        background: rgba(15, 23, 42, .92);
        border: 1px solid rgba(148, 163, 184, .65);
        font-size: .7rem;
        text-transform: uppercase;
        letter-spacing: .16em;
        color: rgba(209, 213, 219, .95);
    }
</style>


    <div class="error-shell">
        <div class="blob blob-1"></div>
        <div class="blob blob-2"></div>
        <div class="blob blob-3"></div>

        <div class="error-card">
            <div class="error-pill">
                <span class="error-pill-dot"></span>
                <span>CRM route not found</span>
            </div>

            <div class="error-heading">
                <div>
                    <div class="error-title">
                        <span>We couldn’t find that screen</span>
                        <span class="error-code-pill">Error 404</span>
                    </div>
                </div>

            </div>

            <div class="error-body">
                <div>
                    <ul class="error-bullets">
                        <li>
                            <i class="fas fa-bullseye"></i>
                            <span>Use the main Dashboard to navigate to training courses, customers, delegates and invoices.</span>
                        </li>
                        <li>
                            <i class="fas fa-keyboard"></i>
                            <span>Double-check the CRM URL – even a small mismatch can break deep links.</span>
                        </li>
                        <li>
                            <i class="fas fa-code-branch"></i>
                            <span>If you came from an old bookmark or email, the route may have changed in the latest release.</span>
                        </li>
                    </ul>

                    <div class="error-actions mt-3">
                        <a href="{{ route('crm.dashboard.index') }}" class="btn-gradient">
                            <span class="icon"><i class="fas fa-arrow-left-long"></i></span>
                            <span>Back to CRM Dashboard</span>
                        </a>

                        <a href="{{ route('crm.training-courses.index') }}" class="btn-soft">
                            <i class="fas fa-book-open"></i>
                            Training Courses
                        </a>

                        <a href="{{ route('crm.customers.index') }}" class="btn-soft">
                            <i class="fas fa-users"></i>
                            Customers
                        </a>
                    </div>
                </div>

                <div>
                    <div class="error-search-box">
                        <input
                            type="text"
                            class="error-search-input"
                            placeholder="Quick tip: use the top navigation ribbon inside the CRM to reach key modules…" disabled
                        >
                        <span class="error-search-icon">
                            <i class="fas fa-magnifying-glass"></i>
                        </span>
                    </div>

                    <p style="font-size:.8rem;color:rgba(156,163,175,.96);margin-bottom:.25rem;">
                        You’re still authenticated, and your CRM session is active.
                    </p>
                    <p style="font-size:.8rem;color:rgba(156,163,175,.9);">
                        If this keeps happening from a specific button or deep link, share the URL with the dev team so we can map it to the correct module.
                    </p>
                </div>
            </div>

            <div class="error-meta">
                <span>Routing context: <strong>/crm</strong> namespace</span>
                <span class="badge">Safe redirect · Dashboard first</span>
            </div>
        </div>
    </div>

