<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Bespoke Request</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&display=swap');
        .mailHeader {
            text-align: center;
            margin-bottom:40px;
            background-color: #000;
        }
    </style>
</head>

<body>
    <header class="mailHeader">
        <img src="{{ asset('images/email-training-4-employment.png') }}" alt="logo" class="img-fluid">
    </header>
    <ul>
        <p><strong>Name:</strong> {{ $data->first_name }} {{ $data->last_name }}</p>
        <p><strong>Email:</strong> {{ $data->email }}</p>
        <p><strong>Phone:</strong> {{ $data->phone }}</p>
        <p><strong>Company:</strong> {{ $data->company_name }}</p>
        <p><strong>Participants:</strong> {{ $data->participant }}</p>
        <p><strong>Company Address:</strong> {{ $data->company_address }}</p>
        <p><strong>Courses:</strong>  
            @foreach(json_decode($data->courses, true) as $course)
                <span style="display: inline-block; background:#e5e5e5; padding: 5px 10px; margin: 3px; border-radius: 5px;">
                    {{ $course }}
                </span> , 
            @endforeach
        </p>
        <p><strong>Message:</strong> {{ $data->message ?? 'N/A' }}</p>
    </ul>
    <footer style="margin-top:40px; text-align: center;">
        <small>© 2025 Training 4 Employment. All rights reserved.</small>
        <small><a href="https://training4employment.co.uk/" target="_blank">www.training4employment.co.uk</a></small>
    </footer>
</body>

</html>
