<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>Reminder: Incomplete Course Requirements</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #222222; /* Darker text color */
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff; /* Ensure white background */
        }
        .header {
            color: #1a365d; /* Darker blue for header */
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .panel {
            background-color: #f8f9fa;
            border-left: 4px solid #2b6cb0; /* Darker blue border */
            padding: 15px;
            margin: 20px 0;
            border-radius: 4px;
        }
        ul {
            padding-left: 20px;
            margin: 10px 0;
        }
        li {
            margin-bottom: 8px;
            color: #222222; /* Dark text for list items */
        }
        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e2e8f0;
            font-size: 14px;
            color: #4a5568; /* Slightly darker gray for footer */
        }
        p {
            color: #222222; /* Dark text for paragraphs */
            margin-bottom: 16px;
        }
        strong {
            color: #1a365d; /* Dark blue for strong elements */
        }
    </style>
</head>
<body>
<div class="header">Reminder: Incomplete Course Requirements</div>

<p>Dear {{ $user->name }},</p>

<p>Our records show that you have the following incomplete items for your course <strong>{{ $cohort->course->name }}</strong>:</p>

<div class="panel">
    <ul>
        @foreach($incompleteItems as $item)
            <li>{{ $item }}</li>
        @endforeach
    </ul>
</div>

<p>Please complete these requirements as soon as possible. If you need any assistance.</p>

<div class="footer">
    <p>Thanks,<br>
        <strong>Training 4 Employment</strong></p>
</div>
</body>
</html>
