<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>New Questionnaire Submission</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f7f7f7; padding: 20px; }
        .container { background: #fff; padding: 20px; border-radius: 8px; }
        h2 { color: #333; }
        .section-title { margin-top: 20px; font-weight: bold; }
        ul { list-style: none; padding-left: 0; }
        li { margin-bottom: 8px; }
    </style>
</head>
<body>
<div class="container">
    <h2>📋 New Career Path Questionnaire Submission</h2>

    <p>A new questionnaire has been submitted. Details are as follows:</p>

    <p><strong>User:</strong> {{ $questionnaire->name }}</p>
    <p><strong>Email:</strong> {{ $questionnaire->email }}</p>
    <p><strong>Phone:</strong> {{ $questionnaire->phone }}</p>

    <div class="section-title">📝 Responses:</div>
    <ul>
        <li><strong>Q1:</strong> {{ $questionnaire->question_1 }}</li>
        <li><strong>Q2:</strong> {{ $questionnaire->question_2 }}</li>
        <li><strong>Q3:</strong> {{ $questionnaire->question_3 }}</li>
        <li><strong>Q4:</strong> {{ $questionnaire->question_4 }}</li>
        <li><strong>Q5:</strong> {{ $questionnaire->question_5 }}</li>
        <li><strong>Q6:</strong> {{ $questionnaire->question_6 }}</li>
    </ul>

    <p><small>Submitted at: {{ $questionnaire->created_at->format('d M Y, h:i A') }}</small></p>
</div>
</body>
</html>
