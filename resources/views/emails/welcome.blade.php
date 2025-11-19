<!DOCTYPE html>
<html>
<head>
    <title>Welcome to Our Platform</title>
</head>
<body>
<h1>Welcome, {{ $name ?? "" }}!</h1>
<p>We are excited to have you on board. Here are your login details:</p>
<p><strong>Email:</strong> {{ $email ?? "" }}</p>
<p><strong>Password:</strong> {{ $password ?? "" }}</p>
<p>Please change your password after logging in for the first time.</p>

<!-- Add the URL link here -->
<p>You can log in using the following link:</p>
<p><a href="{{ url('/login') }}">Click here to log in</a></p>

<p>Thank you!</p>
</body>
</html>
