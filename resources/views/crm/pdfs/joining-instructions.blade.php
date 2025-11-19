<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Joining Instructions</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 13px;
        }

        .logo {
            float: right;
            width: 180px;
            margin-top: -30px;
        }

        .heading {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .section-title {
            font-weight: bold;
            margin-top: 20px;
            margin-bottom: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #888;
            padding: 6px 10px;
            text-align: left;
        }

        th {
            background: #f5f5f5;
        }

        .info-table td {
            font-weight: bold;
            width: 180px;
            background: #f5f5f5;
        }

        .info-table td+td {
            font-weight: normal;
            background: #fff;
        }

        .note {
            font-size: 12px;
            color: #333;
            margin-bottom: 10px;
        }

        .footer {
            text-align: right;
            font-size: 12px;
            color: #555;
            margin-top: 30px;
        }

        hr {
            border: none;
            border-top: 1px solid #bbb;
            margin: 18px 0;
        }
    </style>
</head>

<body>
    <!-- Logo and Header -->
    <div>
        <div style="display: flex; justify-content: flex-end; align-items: center; margin-bottom: 20px;">
            <div class="logo" style="border: none;">
                <img src="{{ asset('frontend/img/T4E-logo_Full-Colour-e1611494943115.png') }}" style="height: 70px;">
            </div>
        </div>
        <hr style="margin-top: 40px;margin-bottom: 20px;">
        <h3 style="font-weight: bold;">Joining Instructions</h3>
        <p style="font-size: 13px;">Please ensure you issue a copy of this form to each of your delegates prior to
            attending the course below.</p>

        <!-- Course Details Table -->
        <table style="width: 100%; border-collapse: collapse; font-size: 14px; margin-bottom: 20px;">
            <tr style="background: #f5f5f5;">
                <td style="border: 1px solid #000; font-weight: bold; width: 25%; padding: 6px;">Course</td>
                <td style="border: 1px solid #000; padding: 6px;">{{ $course->name }}</td>
            </tr>
            <tr>
                <td style="border: 1px solid #000; font-weight: bold; padding: 6px;">Date</td>
                <td style="border: 1px solid #000; padding: 6px;">{{ \Carbon\Carbon::parse($training_course->start_date_time)->format('d-m-y') }}</td>
            </tr>
            <tr style="background: #f5f5f5;">
                <td style="border: 1px solid #000; font-weight: bold; padding: 6px;">Course Length</td>
                <td style="border: 1px solid #000; padding: 6px;">{{ $course->duration }}</td>
            </tr>
            <tr>
                <td style="border: 1px solid #000; font-weight: bold; padding: 6px;">Start Time</td>
                <td style="border: 1px solid #000; padding: 6px;">{{ \Carbon\Carbon::parse($training_course->start_date_time)->format('H:i') ?? 'N/A' }}</td>
            </tr>
            <tr style="background: #f5f5f5;">
                <td style="border: 1px solid #000; font-weight: bold; padding: 6px;">Finish Time</td>
                <td style="border: 1px solid #000; padding: 6px;">{{ \Carbon\Carbon::parse($training_course->end_date_time)->format('H:i') ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td style="border: 1px solid #000; font-weight: bold; padding: 6px;">Location</td>
                <td style="border: 1px solid #000; padding: 6px;">
                    {{$venue->venue_name}}<br>
                    {{$venue->address}}<br>
                    {{$venue->city}}<br>
                    {{$venue->post_code}}
                </td>
            </tr>
            <tr style="background: #f5f5f5;">
                <td style="border: 1px solid #000; font-weight: bold; padding: 6px;">Contact Details</td>
                <td style="border: 1px solid #000; padding: 6px;">Tel: {{ $venue->primary_contact_number ?? $venue->telephone_number ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td style="border: 1px solid #000; font-weight: bold; padding: 6px;">Lunch Provided</td>
                <td style="border: 1px solid #000; padding: 6px;">Lunch will not be provided.</td>
            </tr>
        </table>

        <!-- Important Information Section -->
        <h4 style="font-weight: bold; margin-top: 30px;">Important Information</h4>
        <div style="font-size: 13px;">
            <b>Equipment & Other Requirements</b><br>
            To register for the course, all candidates must be aged 18 and over.<br><br>
            It is an SIA requirement that training centres must confirm that each learner is sufficiently qualified in
            First Aid or Emergency First Aid. Therefore, all candidates will need to show that they hold a current and
            valid First Aid or Emergency First Aid certificate that meets the requirements of the Health and Safety
            (First Aid) Regulations 1981.<br><br>
            The First Aid or Emergency First Aid certificate must be valid for at least 12 months from the course start
            date.<br><br>
            You will need to present your First Aid or Emergency First Aid certificate to Training4Employment before you
            start SIA Door Supervisor training.<br><br>
            If you don’t have a valid First Aid or Emergency First Aid certificate, we can offer you an Emergency First
            Aid Training Course.<br><br>
            <b>ID / Documents Required</b><br>
            All delegates MUST bring two forms of Picture ID – Passport/Driving Licence or Provisional Licence<br>
            If you only have one of the above – you will need to bring two forms of proof address eg. Utility Bill/Bank
            Statement<br>
            2 passport size photos<br>
            Any issues with ID, please call our Admin Team on 0121 630 2115.<br><br>
            <b>Additional Requirements</b><br>
            All delegates must be able to read and write English to a good standard to take this course.<br>
            You will be given basic English assessment on the first day of the course. If you do not get at least 80% on
            this assessment, you will unfortunately not be able to continue the course and will receive no
            refund<br><br>
            <b>Other Information</b><br>
            There is parking available on site, spaces are on a first come, first serve basis.<br><br>
            <b>Certificate Information</b><br>
            You will be notified with your exam results via text message 7-14 working days after the course.
            <br>
             If you have successfully passed the course, you will receive your e-certificate on email 3-5 working days
            after you receive your results.<br>
            If you do unfortunately fail, we will offer you two further chances to retake all modules.<br>
            You will be contacted via text message to arrange a retake date.<br><br>
            <b>Payment Conditions</b><br>
            Registration for the course is not guaranteed until a completed payment (deposit) has been received.<br>
            If you have made a deposit, you will need to pay the remaining balance on the first day of the course.<br>
            Deposit and payments are non-refundable.<br><br>
            <b>Transfer Fees</b><br>
            Should circumstances mean that you need to transfer to another T4E course, you need to inform us minimum 24
            hours prior the course start day, otherwise the transfer will not be possible and the course fee remains
            payable.<br><br>
            <b>Cancellation Fees</b><br>
            If you fail to attend without notice or arrive sufficiently late for the tutor to refuse your place on the
            course due to the amount of content missed, you will not be entitled to a refund.<br>
            If a course is cancelled by the T4E, you will be advised at the earliest possible opportunity and
            arrangements will be made for your course to be rearranged or the course fee to be refunded. This may occur
            at very short notice, in particular if the minimum number of participants has not been reached.<br>
            If you are absent from any session, we reserve the right to refuse to accept you for training and the full
            course fee remains payable.<br>
            Please read full Booking terms and conditions attached to this email.<br><br>
            If a course is cancelled by the T4E, you will be advised at the earliest possible opportunity and
            arrangements will be made for your course to be rearranged or the course fee to be refunded. This may occur
            at very short notice, in particular if the minimum number of participants has not been reached.<br><br>
            If you are absent from any session, we reserve the right to refuse to accept you for training and the full
            course fee remains payable.
        </div>
    </div>
</body>

</html>
