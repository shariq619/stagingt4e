<!-- resources/views/certificate.blade.php -->
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>{{ $name }} Certificate</title>
    <style>
        @page {
            margin: 0;
        }

        body {
            margin: 0;
            padding: 0;
        }

        .certificate {
            position: relative;
            width: 100%;
            height: 100vh;
            background: url('{{ asset('crm/certificates/certificate.png') }}') no-repeat center;
            background-size: cover;
        }

        .name {
            position: absolute;
            top: 300px;
            left: 0;
            width: 100%;
            text-align: center;
            font-size: 36px;
            font-weight: bold;
        }

        .issue-date {
            position: absolute;
            top: 450px;
            right: 200px;
            font-size: 18px;
        }

        .valid-date {
            position: absolute;
            top: 500px;
            right: 200px;
            font-size: 18px;
        }
    </style>
</head>

<body>
    <div class="certificate">
        <div class="name">{{ $name }}</div>
        <div class="issue-date">{{ $issueDate }}</div>
        <div class="valid-date">{{ $validDate }}</div>
    </div>
</body>

</html>
