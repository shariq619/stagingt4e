<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>New Lead Submission</title>
</head>
<body>
<h1>New Lead Submission</h1>

<p><strong>Name:</strong> {{ $leadData['name'] }}</p>
<p><strong>Email:</strong> {{ $leadData['email'] }}</p>
<p><strong>Phone:</strong> {{ $leadData['phone'] }}</p>
<p><strong>Course Interested:</strong> {{ $leadData['course_interested'] }}</p>
<p><strong>Notes:</strong><br>{{ $leadData['notes'] }}</p>

<p>Thanks,<br>
    {{ config('app.name') }}</p>
</body>
</html>
