<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>EFAW Check List PDF</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        .header-table {
            width: 100%;
            margin-bottom: 40px;
        }

        .header-table td {
            padding: 2px 8px;
            border: 1px solid #222;
        }

        .header-table-inner {
            border-collapse: collapse;
        }

        .header-table-inner td {
            border: 1px solid #222;
            padding: 3px 8px;
        }

        .logo {
            text-align: right;
            border: none !important;
        }

        .main-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .main-table th,
        .main-table td {
            border: 1px solid #000;
            padding: 6px 8px;
            text-align: left;
        }

        .main-table th {
            background: #f2f2f2;
            text-align: center;
        }

        .footer {
            text-align: center;
            margin-top: 40px;
            font-weight: bold;
            font-size: 16px;
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <table class="header-table">
        <tr>
            <td style="width: 60%; border: none;">
                <table class="header-table-inner">
                    <tr>
                        <td>Centre Number:</td>
                        <td>{{ $venue->code ?? '' }}</td>
                    </tr>
                    <tr>
                        <td>Venue:</td>
                        <td>{{ $venue->venue_name ?? '' }}</td>
                    </tr>
                    <tr>
                        <td>Tutor Name:</td>
                        <td>{{ $trainer->name .' '. $trainer->middle_name .' '. $trainer->last_name ?? '' }}</td>
                    </tr>
                    <tr>
                        <td>Tutor Number:</td>
                        <td>{{ $trainer->phone_number ?? ($trainer->telephone ?? '') }}</td>
                    </tr>
                    <tr>
                        <td>Course ID:</td>
                        <td>{{ $course->id ?? '' }}</td>
                    </tr>
                    <tr>
                        <td>Course Title:</td>
                        <td>{{ $course->name ?? '' }}</td>
                    </tr>
                    <tr>
                        <td>Date:</td>
                        <td>{{ $date ?? '' }}</td>
                    </tr>
                </table>
            </td>
            <td class="logo" style="border: none;">
                <img src="{{ asset('frontend/img/T4E-logo_Full-Colour-e1611494943115.png') }}" style="height: 70px;">
            </td>
        </tr>
    </table>

    <table class="main-table">
        <thead>
            <tr>
                <th>Delegate Name</th>
                <th>Contact No</th>
                <th>EFAW</th>
                <th>Photo ID</th>
                <th>Photo</th>
                <th>Inital Essement</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($delegates as $delegate)
                <tr>
                    <td>{{ $delegate['name'] }}</td>
                    <td>{{ $delegate['contact'] }}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">CHECK LIST</div>
</body>

</html>
