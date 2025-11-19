<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $messageData['subject'] }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #f4f4f4;
            padding: 20px;
        }
        h1 {
            color: #333;
        }
        p {
            font-size: 16px;
            line-height: 1.6;
        }
        .footer {
            margin-top: 20px;
            font-size: 12px;
            color: #666;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>{{ $messageData['subject'] }}</h1>
    <div>{!! $messageData['body'] !!}</div> <!-- Render unescaped HTML content -->

    <div class="footer">
        <p>Thank you for using our application!</p>
        <p>&copy; {{ date('Y') }} Training 4 employment. All rights reserved.</p>
    </div>
</div>
</body>
</html>
