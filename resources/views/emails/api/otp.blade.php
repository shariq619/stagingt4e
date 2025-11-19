<!DOCTYPE html>
<html>

<head>
    <title>Password Reset OTP</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            background: #007bff;
            color: white;
            padding: 20px;
            text-align: center;
        }

        .content {
            background: #f9f9f9;
            padding: 20px;
        }

        .otp-box {
            background: #007bff;
            color: white;
            padding: 15px;
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            margin: 20px 0;
            border-radius: 5px;
        }

        .footer {
            background: #f1f1f1;
            padding: 15px;
            text-align: center;
            font-size: 12px;
            color: #666;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Password Reset OTP</h1>
        </div>

        <div class="content">
            <p>Hello!</p>
            <p>You requested to reset your password. Please use the following OTP (One-Time Password) to proceed:</p>

            <div class="otp-box">
                {{ $otp }}
            </div>

            <p>This OTP will expire at <strong>{{ $expiryTime }}</strong> (10 minutes from now).</p>

            <p>If you did not request this password reset, please ignore this email. Your account remains secure.</p>
        </div>

        <div class="footer">
            <p>Thank you,<br>{{ config('app.name') }}</p>
        </div>
    </div>
</body>

</html>
