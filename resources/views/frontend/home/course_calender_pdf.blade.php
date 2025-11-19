<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Course Calendar PDF</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #333;
            padding: 4px;
        }

        th {
            background: #002855;
            color: #fff;
        }
    </style>
</head>
<body>
    <h2>Course Calendar</h2>
    <table>
        <thead>
            <tr>
                <th>Month</th>
                <th>Course Title</th>
                <th>Venue</th>
                <th>Date, Time</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cohorts as $cohort)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($cohort->start_date_time)->format('F') }}</td>
                    <td>{{ $cohort->course->name }}</td>
                    <td>{{ $cohort->venue->venue_name ?? '-' }}</td>
                    <td>
                        {!! formatCourseCalDate($cohort) !!}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
