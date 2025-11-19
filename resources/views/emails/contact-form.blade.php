<!DOCTYPE html>
<html>
<head>
    <title>New Contact Form Submission</title>
</head>
<body>
<h2>New Contact Form Submission</h2>
<p><strong>Name:</strong> {{ $contactData['name'] }}</p>
<p><strong>Phone:</strong> {{ $contactData['phone'] }}</p>
<p><strong>Email:</strong> {{ $contactData['email'] }}</p>
<p><strong>Subject:</strong> {{ $contactData['subject'] }}</p>
<p><strong>Company:</strong> {{ $contactData['company'] }}</p>
<p><strong>Message:</strong></p>
<p>{{ $contactData['message'] }}</p>
</body>
</html>
