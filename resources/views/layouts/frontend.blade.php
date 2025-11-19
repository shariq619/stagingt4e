@php
    use App\Models\SEO;
    use App\Models\Venue;
    use Carbon\Carbon;use Illuminate\Support\Facades\Cookie;
    $formSubmitted = cookie::get('form_submitted');
    $questionnaireFormSubmitted = cookie::get('questionnaire_form');
 @endphp
 <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="google-site-verification" content="qy8kTRHAtDYMCNL6wNR4-IrjKJpqkQe2Jk2vOyoNVF0"/>

    <meta name="performance-budget"
          content="{
      'css': 50,
      'js': 100,
      'image': 500,
      'total': 1000
    }">

    @php
        $seos = SEO::all();
    @endphp

    <title>@yield('title') | Training 4 Employment</title>

    <link rel="icon" href="{{ asset('icon/cropped-favicon-32x32-1-32x32.png') }}" sizes="32x32"/>
    <link rel="icon" href="{{ asset('icon/cropped-favicon-32x32-1-192x192.png') }}" sizes="192x192"/>
    <link rel="apple-touch-icon" href="{{ asset('icon/cropped-favicon-32x32-1-180x180.png') }}"/>
    <link rel="preload" as="image" href="{{ asset('frontend/img/logo.webp') }}">


    <!-- Google Tag Manager -->
    <script>(function (w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start':
                    new Date().getTime(), event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-M9FQB5MH');</script>
    <!-- End Google Tag Manager -->

    @foreach ($seos as $seo)
        @php
            $data_meta_keywords = json_decode($seo->meta_keywords, true);
            $meta_keywords_array = is_array($data_meta_keywords) ? array_column($data_meta_keywords, 'value') : [];
            $meta_keywords = implode(',', $meta_keywords_array);
        @endphp @if (url()->current() == $seo->slug)
            <!-- SEO -->
            <meta name="title" content="{{ $seo->meta_title ?? '' }}">
            <meta name="description" content="{{ $seo->meta_description ?? '' }}">
            <meta name="keywords" content="{{ $meta_keywords }}">
            <meta name="robots" content="{{ $seo->robots ?? '' }}">
        @endif
    @endforeach


    @php

        if (request()->has('page') && request()->get('page') > 1) {
           // Include query string for paginated pages
           $canonical = url()->full();
        } else {
           // Default canonical URL without query string
           $canonical = url()->current();
        }

       //$canonical = url()->current(); // Default canonical URL

       foreach ($seos as $seo) {
           if (url()->current() == $seo->slug && !empty($seo->canonical_url)) {
               $canonical = $seo->slug;
               break;
           }
       }
    @endphp

    <link rel="canonical" href="{{ $canonical }}"/>

    <!-- SEO -->

    <link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>
    <!--<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>-->
    <link rel="dns-prefetch" href="https://fonts.googleapis.com">
    <!--<link rel="dns-prefetch" href="https://fonts.gstatic.com">-->
    <link rel="preload"
          href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100..900;1,100..900&family=Rubik:wght@300..900&display=swap"
          as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet"
              href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100..900;1,100..900&family=Rubik:wght@300..900&display=swap">
    </noscript>
    <link rel="preload" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" as="style"
          onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    </noscript>
    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" as="style"
          onload="this.onload=null;this.rel='stylesheet'">
    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css"
          as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css">
    </noscript>
    @php
        $data = now();
    @endphp
    @if (app()->isProduction())
        {!! NoCaptcha::renderJs() !!}
    @endif
    <script>
        function gtag_report_conversion(url) {
            var callback = function () {
                if (typeof (url) != 'undefined') {
                    window.location = url;
                }
            };
            gtag('event', 'conversion', {
                'send_to': 'AW-966846683/caLCCOKH6r8aENvRg80D',
                'event_callback': callback
            });
            return false;
        }
    </script>
    <link rel="stylesheet" href="{{ asset('frontend/css/responsive.css')}} " as="style">
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') . '?' . $data }} " as="style">
    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" as="style"
          onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    </noscript>
    <style>
        .ti-review-item[data-id="cb81f0ce6b86d321a26b6e661b9b034c"] {
            display: none;
        }

        #scrollTopBtn {
            display: none;
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 99;
            border: none;
            outline: none;
            background-color: #007bff;
            color: white;
            cursor: pointer;
            padding: 10px 15px;
            border-radius: 50%;
            font-size: 18px;
            box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);
        }

        #scrollTopBtn:hover {
            background-color: #0056b3;
        }

        header#headerWrapper .marque {
            position: fixed;
            /* Fixes it at the top */
            top: 0;
            left: 0;
            width: 100%;
            background: #000;
            text-align: center;
            margin: 0;
            z-index: 1000;
            /* Ensures it stays above other elements */
        }

        header#headerWrapper .marque p {
            margin: 0;
            color: #fff;
            padding: 10px;
            font-weight: 700;
            /* Corrected from 'font-width' */
            font-size: 24px;
        }

        header#headerWrapper .marque a {
            margin: 0;
            color: #fff;
            padding: 10px;
            font-weight: 700;
            /* Corrected from 'font-width' */
            font-size: 24px;
        }

        #loader-wrapper {
            position: fixed;
            z-index: 9999;
            background: #000;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .loader-spinner {
            margin-top: 20px;
            border: 6px solid #f3f3f3;
            border-top: 6px solid #333;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>

    @stack('css')

    {{-- <script type="text/javascript" defer>
        window.addEventListener('load', function() {
            (function(c, l, a, r, i, t, y) {
                c[a] = c[a] || function() {
                    (c[a].q = c[a].q || []).push(arguments)
                };
                t = l.createElement(r);
                t.async = 1;
                t.defer = 1;
                t.src = "https://www.clarity.ms/tag/" + i;
                y = l.getElementsByTagName(r)[0];
                y.parentNode.insertBefore(t, y);
            })(window, document, "clarity", "script", "p8a4hf3uzf");
        });
    </script> --}}
    @stack('head_schema')
</head>

<body class="hold-transition sidebar-mini layout-fixed position-relative mb-0">
{{-- Header --}}

<!-- Google Tag Manager (noscript) -->
<noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-M9FQB5MH"
            height="0" width="0" style="display:none;visibility:hidden"></iframe>
</noscript>
<!-- End Google Tag Manager (noscript) -->

@php
    $categories = App\Models\Category::where('id', '!=', 7)->get();
    //$locations = App\Models\Venue::all();


    $todayCarbon = Carbon::today();

        $locations = Venue::where('id', 1)->get();


    $today = now();

@endphp

@if (($today->month == 11 || $today->month == 12) && !$formSubmitted)
    <div class="formModalAutoOpen position-relative">
        <style>

            div#exampleModalCenter {
                margin-top: 70px;
            }

            div#loadingSpinner {
                position: fixed;
                left: 0;
                right: 0;
                margin: auto;
                top: 0;
                bottom: 0;
                z-index: 9999;
                background: rgba(0, 0, 0, 0.7);
                backdrop-filter: blur(4px);
                display: flex;
                align-items: center;
                justify-content: center;
            }

            div#loadingSpinner i {
                color: #007bff;
                animation: pulse 1.5s ease-in-out infinite;
            }

            @keyframes pulse {
                0%, 100% { opacity: 1; transform: scale(1); }
                50% { opacity: 0.7; transform: scale(1.1); }
            }

            /* Modern Modal Styles */
            #exampleModalCenter .modal-dialog {
                max-width: 520px;
            }

            #exampleModalCenter .modal-content {
                border: none;
                border-radius: 20px;
                box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
                overflow: hidden;
                background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
            }

            #exampleModalCenter .saleAnimate {
                padding: 20px;
                margin: -30px -20px 20px -20px;
                background: linear-gradient(
                    135deg,
                    #0c1d55 0%,
                    #10266f 25%,
                    #142f89 50%,
                    #0c1d55 75%,
                    #10266f 100%
                );
                background-size: 200% 200%;
                animation: gradientShift 3s ease infinite;
                overflow: hidden;
                box-shadow: 0 4px 20px rgba(255, 107, 107, 0.4), inset 0 1px 0 rgba(255, 255, 255, 0.2);
                position: relative;
            }

            @keyframes gradientShift {
                0%, 100% { background-position: 0% 50%; }
                50% { background-position: 100% 50%; }
            }

            #exampleModalCenter .saleAnimate::before {
                content: '';
                position: absolute;
                top: -50%;
                left: -50%;
                width: 200%;
                height: 200%;
                background: linear-gradient(45deg, transparent 30%, rgba(255, 255, 255, 0.3) 50%, transparent 70%);
                animation: shine 3s infinite;
                z-index: 1;
            }

            #exampleModalCenter .saleAnimate::after {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: radial-gradient(circle at 20% 50%, rgba(255, 255, 255, 0.2) 0%, transparent 50%),
                radial-gradient(circle at 80% 50%, rgba(255, 255, 255, 0.2) 0%, transparent 50%);
                animation: pulseGlow 2s ease-in-out infinite;
                z-index: 0;
            }

            @keyframes shine {
                0% { transform: translateX(-100%) translateY(-100%) rotate(45deg); }
                100% { transform: translateX(100%) translateY(100%) rotate(45deg); }
            }

            @keyframes pulseGlow {
                0%, 100% { opacity: 0.5; }
                50% { opacity: 1; }
            }

            #exampleModalCenter .saleAnimate .cell {
                position: relative;
                z-index: 2;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            /* Removed the square element styles as requested */
            /* #exampleModalCenter .saleAnimate .square {
                ... removed ...
            } */

            #exampleModalCenter .modal-header {
                border: none;
                padding: 30px 30px 20px;
                background: transparent;
            }

            #exampleModalCenter .modal-header .close {
                position: absolute;
                right: 20px;
                top: 20px;
                width: 35px;
                height: 35px;
                border-radius: 50%;
                background: rgba(0, 0, 0, 0.05);
                display: flex;
                align-items: center;
                justify-content: center;
                transition: all 0.3s ease;
                z-index: 10;
            }

            #exampleModalCenter .modal-header .close:hover {
                background: rgba(0, 0, 0, 0.1);
                transform: rotate(90deg);
            }

            #exampleModalCenter .modal-header .close span {
                font-size: 24px;
                line-height: 1;
            }

            #exampleModalCenter .modal-title {
                font-size: 26px;
                font-weight: 700;
                color: #2d3748;
                line-height: 1.4;
                margin: 0;
                text-align: center;
            }

            #exampleModalCenter .modal-body {
                padding: 0 30px 30px;
            }

            /* Modern Form Styles */
            #contactForm .form-group {
                margin-bottom: 25px;
                position: relative;
            }

            #contactForm label {
                position: relative;
                display: block;
            }

            #contactForm input[type="text"],
            #contactForm input[type="email"],
            #contactForm input[type="tel"] {
                width: 100%;
                padding: 16px 20px;
                font-size: 16px;
                border: 2px solid #e2e8f0;
                border-radius: 12px;
                background: #ffffff;
                transition: all 0.3s ease;
                outline: none;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.02);
            }

            #contactForm input[type="text"]:focus,
            #contactForm input[type="email"]:focus,
            #contactForm input[type="tel"]:focus {
                border-color: #667eea;
                box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
                transform: translateY(-2px);
            }

            #contactForm input[type="text"]:not(:placeholder-shown) + span,
            #contactForm input[type="email"]:not(:placeholder-shown) + span,
            #contactForm input[type="tel"]:not(:placeholder-shown) + span,
            #contactForm input[type="text"]:focus + span,
            #contactForm input[type="email"]:focus + span,
            #contactForm input[type="tel"]:focus + span {
                top: -10px;
                left: 12px;
                font-size: 13px;
                color: #667eea;
                background: #ffffff;
                padding: 0 8px;
                font-weight: 600;
            }

            #contactForm label span {
                position: absolute;
                top: 16px;
                left: 20px;
                font-size: 16px;
                color: #718096;
                pointer-events: none;
                transition: all 0.3s ease;
                background: transparent;
            }

            /* Fixed validation message styling */
            #contactForm .input-error {
                display: block !important;
                color: #e53e3e !important;
                font-size: 13px;
                margin-top: 8px;
                padding-left: 4px;
                font-weight: 500;
                background-color: transparent !important;
            }

            #contactForm .recaptcha-form {
                margin: 25px 0;
                display: flex;
                justify-content: center;
            }

            #contactForm button[type="submit"] {
                width: 100%;
                padding: 16px 30px;
                font-size: 17px;
                font-weight: 700;
                color: #ffffff;
                background: #ea7000;
                border: none;
                border-radius: 12px;
                cursor: pointer;
                transition: all 0.3s ease;
                box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
                text-transform: uppercase;
                letter-spacing: 0.5px;
                margin-top: 10px;
                position: relative;
                overflow: hidden;
            }

            #contactForm button[type="submit"]::before {
                content: '';
                position: absolute;
                top: 0;
                left: -100%;
                width: 100%;
                height: 100%;
                background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
                transition: left 0.5s;
            }

            #contactForm button[type="submit"]:hover::before {
                left: 100%;
            }

            #contactForm button[type="submit"]:hover {
                transform: translateY(-2px);
                box-shadow: 0 6px 20px rgba(102, 126, 234, 0.5);
            }

            #contactForm button[type="submit"]:active {
                transform: translateY(0);
            }

            #contactForm button[type="submit"]:disabled {
                opacity: 0.7;
                cursor: not-allowed;
                transform: none;
            }

            #contactForm p small {
                color: #718096;
                font-size: 13px;
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 5px;
            }

            #contactForm p small i {
                font-size: 10px;
            }

            #contactFormrecaptchaError {
                color: #e53e3e !important;
                font-size: 13px;
                margin-top: 10px;
                display: block;
                text-align: center;
                font-weight: 500;
            }

            /* Responsive adjustments */
            @media (max-width: 576px) {
                #exampleModalCenter .modal-dialog {
                    margin: 15px;
                }

                #exampleModalCenter .modal-header,
                #exampleModalCenter .modal-body {
                    padding-left: 20px;
                    padding-right: 20px;
                }

                #exampleModalCenter .modal-title {
                    font-size: 22px;
                }
            }
        </style>
        <div id="loadingSpinner" style="display: none; text-align: center;">
            <i class="fas fa-spinner fa-spin fa-3x"></i>
        </div>
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="saleAnimate">
                        <div class="cell">
                            <!-- Removed the square element as requested -->
                            <div class="hithere text-capitalize" style="color: white; font-weight: 700; font-size: 24px; text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);">🎉 Sign Up Discount</div>
                        </div>
                    </div>
                    <div class="modal-header">
{{--                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">--}}
{{--                            <span aria-hidden="true">&times;</span>--}}
{{--                        </button>--}}
                        <h5 class="modal-title" id="exampleModalLongTitle">Receive an exclusive <br> <span style="color: #ea7000;">10% discount</span> towards our professional courses</h5>
                    </div>

                    <div class="modal-body">
                        <form id="contactForm" action="{{ route('subscriber.store') }}" method="POST">
                            @csrf
                            @honeypot
                            <div class="form-group">
                                <label class="col-form-label w-100">
                                    <input type="text" class="form-control" name="full_name" placeholder=" "
                                           autocomplete="off" required>
                                    <span>Full name</span>
                                </label>
                                <span class="input-error" style="display: none;"></span>
                            </div>

                            <div class="form-group">
                                <label class="col-form-label w-100">
                                    <input type="email" class="form-control" name="email" placeholder=" "
                                           autocomplete="off" required>
                                    <span>Email</span>
                                </label>
                                <span class="input-error" style="display: none;"></span>
                            </div>

                            <div class="form-group">
                                <label class="col-form-label w-100">
                                    <input type="tel" class="form-control" name="phone" placeholder=" "
                                           autocomplete="off" required>
                                    <span>Phone</span>
                                </label>
                                <span class="input-error" style="display: none;"></span>
                            </div>

                            <div class="recaptcha-form" id="recaptcha-form-3">
                                @if (app()->isProduction())
                                    {!! NoCaptcha::display() !!}
                                @endif
                            </div>
                            <span class="input-error" id="contactFormrecaptchaError"
                                  style="color:white; display:none; margin-top:5px;"></span>

                            <button type="submit" class="btn btn-primary">
                                <span>Subscribe Now</span>
                            </button>
                            <p class="m-0 mt-3"><small><i class="fa-solid fa-asterisk text-danger"></i> Terms and conditions applied.</small></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif



@if (request()->is('category/sia-security-training'))
    <div class="questionnaireModalForm position-relative">
        <div class="modal fade" id="questionnaire" tabindex="-1" role="dialog"
             aria-labelledby="questionnaireTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered m-auto modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="m-0 text-capitalize text-center font-semibold h5">
                            {{ __('career path questionnaire') }}
                        </div>
                        <p class="m-0 text-center">{{ __('Door Supervisor or CCTV Operator') }}</p>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body d-flex flex-column justify-content-center">
                        <div id="loadingSpinner" style="display: none; text-align: center;z-index: 9999;">
                            <i class="fas fa-spinner fa-spin fa-3x"></i>
                        </div>
                        <x-frontend.questionnaire-form/>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal for Results  --}}

    <div class="modalResultForm position-relative">
        <div class="modal fade" id="modalA" tabindex="-1" role="dialog" aria-labelledby="modalATitle"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered m-auto modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="m-0 text-capitalize text-center font-semibold h5">
                            {{ __('Your Results Revealed') }}
                        </div>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="d-flex flex-column justify-content-center">
                            <p class="m-0 text-center">{{ __('Your Responses Show...') }}</p>
                            <div class="h3">{{ __('100% CCTV Operator Match!') }}</div>
                            <div class="resultPera">
                                <p>{{ __("You're a perfect fit for surveillance and tech-driven roles.") }}</p>
                                <p>{{ __('Quiet, focused, and reliable – you’ll excel in control rooms and system-based environments.') }}
                                </p>
                            </div>
                            <div class="recommendation">
                                <p><strong>Recommended Course:</strong><a
                                        href="{{ url('/courses/sia-cctv-operator') }}">CCTV Operator Training</a>
                                </p>
                                <p>{{ __('Perfect for roles involving monitoring, analysis, and digital systems.') }}
                                </p>
                                <a href="{{ url('/courses/sia-cctv-operator') }}"
                                   class="resultBtn">{{ __('Take me to the CCTV Course') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modalB" tabindex="-1" role="dialog" aria-labelledby="modalBTitle"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered m-auto modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="m-0 text-capitalize text-center font-semibold h5">
                            {{ __('Your Results Revealed') }}
                        </div>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="d-flex flex-column justify-content-center">
                            <p class="m-0 text-center">{{ __('Your Responses Show...') }}</p>
                            <div
                                class="h3 text-white">{{ __('The Hybrid Hero – You’re the Superman of Security!') }}</div>
                            <div class="resultPera">
                                <p>{{ __('You’ve got a super balanced skill set: strength, strategy, awareness, and adaptability.') }}
                                </p>
                                <p>{{ __('Whether it’s handling a crowd or scanning the scene, you’re ready to fly in either role (or both!).') }}
                                </p>
                            </div>
                            <div class="recommendation">
                                <p><strong>Recommended Course:</strong><a
                                        href="{{ url('/sia-courses-bundles/door-supervisor-cctv-bundle-emergency-first-aid-at-work') }}">
                                        {{ __('Combo Course Bundle') }}</a></p>
                                <p>{{ __('Your Kryptonite-Proof Career Move!') }}</p>
                                <p>{{ __('Perfect for roles such as Retail Security, Control Room Support in Event Venues') }}
                                </p>
                                <a href="{{ url('/sia-courses-bundles/door-supervisor-cctv-bundle-emergency-first-aid-at-work') }}"
                                   class="resultBtn">{{ __('Take me to the Combo Bundle') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modalC" tabindex="-1" role="dialog" aria-labelledby="modalCTitle"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered m-auto modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="m-0 text-capitalize text-center font-semibold h5">
                            {{ __('Your Results Revealed') }}
                        </div>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="d-flex flex-column justify-content-center">
                            <p class="m-0 text-center">{{ __('Your Responses Show...') }}</p>
                            <div class="h3">{{ __('100% Door Supervisor Match!') }}</div>
                            <div class="resultPera">
                                <p>{{ __("You’re built for the front line! All your answers show confidence, stamina, and people skills: you're ready for the spotlight.") }}
                                </p>
                            </div>
                            <div class="recommendation">
                                <p><strong>Next Step:</strong><a href="{{ url('/courses/sia-door-supervisor') }}">
                                        {{ __('Enrol in the Door Supervisor course and start your career strong!') }}</a>
                                </p>
                                <a href="{{ url('/courses/sia-door-supervisor') }}"
                                   class="resultBtn">{{ __('Take me to the Door Supervisor Course') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif



{{--@if ($today->month == 12)--}}
    <x-frontend.sticky-calendar/>
{{--@endif--}}

<x-frontend.header :categories="$categories" :locations="$locations"/>
<div class="mainWrapper">
    @yield('main')
</div>
<x-frontend.footer/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/js/bootstrap.bundle.min.js"
        integrity="sha512-igl8WEUuas9k5dtnhKqyyld6TzzRjvMqLC79jkgT3z02FvJyHAuUtyemm/P/jYSne1xwFI06ezQxEwweaiV7VA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js" crossorigin="anonymous"
        referrerpolicy="no-referrer" defer
        data-src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"
        onload="this.removeAttribute('data-src')"></script>
<script src="{{ asset('frontend/js/app.js') }}" defer></script>
<button onclick="scrollToTop()" id="scrollTopBtn" title="Go to top">
    <i class="fas fa-arrow-up"></i>
</button>
@stack('js')
<script src="{{ asset('frontend/js/custom.js') }}" defer></script>
<script defer>
    window.addEventListener('load', function () {
        const script = document.createElement('script');
        script.src = "//code.tidio.co/boyf7qowgp5os4ji8yofv7auofdca9nn.js";
        script.defer = true;
        document.body.appendChild(script);
    });
</script>
<script async src="https://www.googletagmanager.com/gtag/js?id=G-TGBXV5ZMKJ" defer></script>
<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }

    gtag('js', new Date());
    gtag('config', 'G-TGBXV5ZMKJ');
    gtag('config', 'AW-966846683/iQ29CMDS578aENvRg80D', {
        'phone_conversion_number': '0808 280 8098'
    });
</script>

@if (!$formSubmitted)
    <script>
        $(document).ready(function () {
            $('#exampleModalCenter').modal('show');
        });
    </script>
@endif
<script>
    function getCookie(name) {
        let match = document.cookie.match(new RegExp('(^| )' + name + '=([^;]+)'));
        return match ? decodeURIComponent(match[2]) : null;
    }

    $(document).ready(function () {
        // Initialize modal
        var myModal = new bootstrap.Modal(document.getElementById('exampleModalCenter'));

        // Show modal on page load for demo purposes
        //myModal.show();

        // Only show modal if the user has never submitted form before
        if (!getCookie("form_submitted")) {
            myModal.show();
        } else {
            console.log("User already submitted form — hiding modal.");
            return; // stop further form logic
        }

        // $('#contactForm input[name="full_name"], #contactForm input[name="email"], #contactForm input[name="phone"]')
        //     .on('copy paste cut', function (e) {
        //         e.preventDefault();
        //     });

        const formStartTime = Date.now();

        $("#contactForm").submit(function (e) {
            e.preventDefault();

            console.log('contactForm clicked');

            const timeSpent = (Date.now() - formStartTime) / 1000;
            if (timeSpent < 3) {
                e.preventDefault();
                return;
            }

            const form = $(this);
            const submitButton = form.find('button[type="submit"]');
            const fullNameInput = form.find('input[name="full_name"]');
            const emailInput = form.find('input[name="email"]');
            const phoneInput = form.find('input[name="phone"]');

            const full_name = fullNameInput.val().trim();
            const email = emailInput.val().trim();
            const phone = phoneInput.val().trim();
            // For demo purposes, we'll simulate recaptcha validation
            const contactFormrecaptchaError = grecaptcha.getResponse();

            form.find('span.input-error').remove();

            submitButton.prop('disabled', true).text('Submitting...');
            form.find('span.input-error').remove();

            let error = false;

            if (full_name === '') {
                fullNameInput.after(
                    '<span class="input-error" style="display:block;margin-top:5px;">Please enter your full name.</span>'
                );
                error = true;
            }

            if (email === '') {
                emailInput.after(
                    '<span class="input-error" style="display:block;margin-top:5px;">Please enter your email address.</span>'
                );
                error = true;
            }
            // else if (!/^[a-zA-Z0-9._%+-]+@(gmail|yahoo|hotmail|outlook)\.com$/.test(email)) {
            //     emailInput.after(
            //         '<span class="input-error" style="display:block;margin-top:5px;">Only Gmail, Yahoo, Hotmail, or Outlook emails are allowed.</span>'
            //     );
            //     error = true;
            // }

            if (phone === '') {
                phoneInput.after(
                    '<span class="input-error" style="display:block;margin-top:5px;">Please enter your phone number.</span>'
                );
                error = true;
            }


            if (contactFormrecaptchaError.length === 0) {
                $('#contactFormrecaptchaError').text('Please verify that you are not a robot.').show();
                console.log('Please verify that you are not a robot.');
                error = true;
            } else {
                $('#contactFormrecaptchaError').hide();
                console.log('hide');
            }


            if (error) {
                submitButton.prop('disabled', false).text('Subscribe Now');
                $('#loadingSpinner').hide();
                return;
            }

            $('#loadingSpinner').show();

            console.log(error);

            $.ajax({
                url: $(this).attr('action'),
                method: "POST",
                data: $(this).serialize(),
                success: function (response) {
                    $('#loadingSpinner').hide();
                    submitButton.prop('disabled', false).text('Submit');
                    document.cookie = "form_submitted=true; path=/; max-age=" + (30 * 24 *
                        60 * 60);
                    $('#exampleModalCenter').modal('hide');

                    window.location = "{{ route('thank.you') }}";

                },
                error: function (xhr) {
                    $('#loadingSpinner').hide();
                    submitButton.prop('disabled', false).text('Submit');
                    if (xhr.status === 422) {
                        const errors = xhr.responseJSON.errors;

                        if (errors.full_name) {
                            fullNameInput.after(
                                `<span class="input-error" style="color:white;display:block;margin-top:5px;">${errors.full_name[0]}</span>`
                            );
                        }

                        if (errors.email) {
                            emailInput.after(
                                `<span class="input-error" style="color:white;display:block;margin-top:5px;">${errors.email[0]}</span>`
                            );
                        }

                        if (errors.phone) {
                            phoneInput.after(
                                `<span class="input-error" style="color:white;display:block;margin-top:5px;">${errors.phone[0]}</span>`
                            );
                        }

                        if (errors['g-recaptcha-response']) {
                            $('#contactFormrecaptchaError')
                                .text(errors['g-recaptcha-response'][0])
                                .show();
                        }


                    } else {
                        // Handle other server errors (non-validation)
                        alert("Something went wrong. Please try again later.");
                    }
                }
            });
        });
    });
</script>

{{-- @if (
    !$questionnaireFormSubmitted &&
        (request()->is('courses/sia-door-supervisor') ||
            request()->is('courses/door-supervisor-refresher') ||
            request()->is('courses/sia-cctv-operator') ||
            request()->is('courses/security-guard-refresher')))
    <script>
        $(document).ready(function() {
            $('#questionnaire').modal('show');
        });
    </script>
@endif --}}

@stack('footer_schema')
</body>

</html>
