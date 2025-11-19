<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subscription Confirmation</title>
    <style>
        .couponCode{
            text-align: center;
            margin-bottom:15px;
        }
        .couponCode p{
            background:#134082;
            color: #fff;
            padding: 10px 20px;
            text-align: center;
        }
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        p,h4,h3, a, ul li{
            color:#000;
        }

        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
        }

        .email-banner img {
            width: 100%;
            height: auto;
            border-radius: 10px;
        }

        .email-content {
            padding: 20px;
            text-align: center;
        }

        .email-footer {
            margin-top: 20px;
            color:#000;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <!-- Email Banner -->
        <div class="email-banner mb-4">
            {{-- php --}}
            <img src="{{ asset('frontend/img/emailbanner.png') }}" alt="Email Banner">
        </div>
        <h4 class="text-black">Dear {{ ucfirst($subscriber->full_name) }}, </h4>
        <p>Thank you for subscribing to the Training4Employment monthly newsletters. We are delighted to welcome you as
            part of our community dedicated to career development and professional training. </p>
        <p>As a token of our appreciation, we are pleased to offer you a <strong>&pound;10 discount</strong> on any
            order above <strong>&pound;115</strong>. This discount applies to both <strong>individual courses</strong>
            and <strong>e-learning programs</strong> offered nowadays.</p>
            <div class="couponCode">
                <p>Your coupon code: <strong>{{ $subscriber->coupon_code }}</strong></p>
            </div>
        <p>To redeem your discount, simply enter the code at checkout when booking your courses. Don’t miss out on this
            opportunity as this discount is only available throughout the month of April, so what are you waiting for?
            Add our courses to your cart NOW! </p>

        <h3>Visit Our Courses & Book Now: </h3>
        <p><span><a href="{{ route('courses.index') }}">Courses | Training 4 Employment </a></span>
            <span>|</span> <span><a href="{{ route('elearning.index') }}">E-learning and Bite-Size Courses
                    | Training 4 Employment </a></span></p>

        <h3>Why Choose Us? </h3>
        <ul>
            <li><strong>Best Prices in UK</strong> &ndash; We offer the most competitive course fees in the UK, ensuring
                affordability without compromising on quality.</li>
            <li><strong>Two Free Resits</strong> &ndash; Understanding that exams can be challenging, we&rsquo;re
                providing two free resets to give you the best chance at passing.</li>
            <li><strong>Free Parking</strong> &ndash; Making in-person training convenient by offering free parking at
                our training centres.</li>
            <li><strong>Same-Day Results</strong> &ndash; Allowing you to proceed with your certification without
                unnecessary delays.</li>
            <li><strong>Assistance in Job Search</strong> &ndash; Our support does not end with training; we help
                connect you with potential employers and job opportunities.</li>
            <li><strong>24/7 Chat and Call Support</strong> &ndash; We&rsquo;re available round the clock to assist you
                with any queries, ensuring a smooth learning experience.</li>
            <li><strong>Multiple Locations</strong> &ndash; We offer training across various cities, making it easier
                for you to find a centre near you.</li>
            <li><strong>E-Learning Convenience</strong> &ndash; Prefer learning from home? Our online courses allow you
                to study at your own pace, and upon completion, you will receive a <strong>recognised online
                    certificate</strong>.</li>
        </ul>


        <div class="email-footer">
            If you have any questions or require assistance, please do not hesitate to contact us at <a href="mailto:info@training4employment.co.uk">info@training4employment.co.uk</a> or <b>0808 280 8098</b>. We look forward to supporting you on your journey to success.
        </div>
        <h4 style="margin-bottom: 0;">Best regards,</h4>
        <h4 style="margin-top:0;">Training4Employment Team</h4>
    </div>

</body>

</html>
