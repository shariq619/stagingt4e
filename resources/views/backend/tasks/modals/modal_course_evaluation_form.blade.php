<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .fsXl {
            font-size: 50px !important;
        }

        .formWrapper {
            padding: 0px 10px;
        }

        .inputDiv {
            border: solid 1px #777;
            border-radius: 10px;
            height: 25px;
            line-height: 25px;
            padding-left: 10px;
            background: #f7f7f7;
        }

        .simpleInput {
            border: solid 1px #777;
            height: 25px;
            border-radius: 10px;
            line-height: 25px;
            font-size: 15px;
            padding-left: 10px;
        }

        .clear-fix {
            clear: both;
        }

        label {
            color: #3b1d8f;
            font-weight: 600;
        }

        .cstPanel {
            border: solid 1px #777;
            margin-top: 30px;
            border-radius: 10px;
        }

        .cstPanel .bgBlue {
            background: #3b1d8f;
            margin: 0;
            border-radius: 10px 10px 0px 0px;
            color: #fff;
            padding: 10px 10px;
        }

        .tableHead td {
            padding: 10px 20px;
        }

        .tableSet table.tableHead thead tr th {
            background: #3b1d8f;
            color: #fff;
            padding: 10px 0px;
            font-size: 14px;
        }

        .tableSet table.tableHead thead tr th:first-child {
            background: transparent;
        }

        .tableSet table.tableHead tbody tr td:first-child {
            background: #3b1d8f;
            color: #fff;
            text-align: left;
            border: none;
        }

        .tableSet table.tableHead tbody tr td {
            text-align: center;
            border-bottom: solid 1px #777;
            border-right: solid 1px #777;
        }

        .tableBorder {
            border: solid 1px #777;
        }
        .inputTextarea {
            padding: 20px 10px;
        }
    </style>
</head>

<body>
    @php
        $signatureImgPath = public_path('images/logo_with_details.PNG');
        $signatureImg = base64_encode(file_get_contents($signatureImgPath));
        $signatureImgSrc = 'data:' . mime_content_type($signatureImgPath) . ';base64,' . $signatureImg;

        $radioImgSimplePath = public_path('images/dry-clean.png');
        $radioImgSimple = base64_encode(file_get_contents($radioImgSimplePath));
        $radioImgSimpleSrc = 'data:' . mime_content_type($radioImgSimplePath) . ';base64,' . $radioImgSimple;

        $radioImgfillPath = public_path('images/round.png');
        $radioImgfill = base64_encode(file_get_contents($radioImgfillPath));
        $radioImgfillSrc = 'data:' . mime_content_type($radioImgfillPath) . ';base64,' . $radioImgfill;
    @endphp
    <div class="formWrapper">
        <div class="step1">
            <h1>Course Evaluation Form</h1>
            <p>Dear {{ auth()->user()->name }} ,</p>
            <p>Thank you for the time you are taking to complete this evaluation. Your answers will help improve the
                content of our courses. All answers will be held in the strictest confidentiality.
            </p>
            <p>Thank you in advance.
            </p>
            <p>Sincerely your,</p>
            <div><img src="{{ $signatureImgSrc }}" width="20%" alt=""></div>
        </div>
        <div class="step2">
            <h3>Rate Your Course</h3>
            <div class="formControl">
                <table style="width:100%;" style="margin-top:30px;">
                    <tbody style="width:100%;">
                        <tr style="width:100%;">
                            <td style="width:50%;">
                                <label>Training centre:</label>
                                <div class="inputDiv">{{ $formData['data']['Q1. Training centre'] }}</div>
                            </td>
                            <td style="width:50%;">
                                <label>Course Date:</label>
                                <div class="inputDiv">{{ $formData['data']['Q2. Course Date'] }}</div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="clear-fix"></div>
                <div style="margin-top:15px;">
                    <label>Course attended</label>
                    <div class="simpleInput">{{ $formData['data']['Q3. Course attended'] }}</div>
                </div>
                <div class="cstPanel">
                    <p class="bgBlue">Did the course meet your expectations?</p>
                    <table class="tableHead" style="width:100%;">
                        <tbody>
                            <tr>
                                @php $confirmations = ['Yes','No']; @endphp
                                @foreach ($confirmations as $confirmation)
                                    <td>
                                        <img src="{{ $formData['data']['Q4. Did the course meet your expectations?'][0] == $confirmation ? $radioImgfillSrc : $radioImgSimpleSrc }}"
                                            style="width:13px;height:13px;margin-right:10px;">
                                        {{ $confirmation }}
                                    </td>
                                @endforeach
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="tableSet" style="margin-top:30px;">
                    <label style="margin-bottom:15px;display:block;">Did the course meet your expectations?</label>

                    <table class="tableHead tableBorder" style="width:100%;">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Excellent</th>
                                <th>Very Good</th>
                                <th>Good</th>
                                <th>Fair</th>
                                <th>Poor</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Exercises and Practical Training</td>
                                @php $confirmations = ['Excellent','Very Good', 'Good','Fair', 'Poor']; @endphp
                                @foreach ($confirmations as $confirmation)
                                    <td>
                                        <img src="{{ $formData['data']['Q5. Did the course meet your expectations?']['Exercise and Practical Training'][0] == $confirmation ? $radioImgfillSrc : $radioImgSimpleSrc }}"
                                            style="width:13px;height:13px;margin-right:10px;">
                                    </td>
                                @endforeach
                            </tr>
                            <tr>
                                <td>Presentation and Course Materials</td>
                                @php $confirmations = ['Excellent','Very Good', 'Good','Fair', 'Poor']; @endphp
                                @foreach ($confirmations as $confirmation)
                                    <td>
                                        <img src="{{ $formData['data']['Q5. Did the course meet your expectations?']['Presentation and Course Materials'][0] == $confirmation ? $radioImgfillSrc : $radioImgSimpleSrc }}"
                                            style="width:13px;height:13px;margin-right:10px;">
                                    </td>
                                @endforeach
                            </tr>
                            <tr>
                                <td>Use of Class Time</td>
                                @php $confirmations = ['Excellent','Very Good', 'Good','Fair', 'Poor']; @endphp
                                @foreach ($confirmations as $confirmation)
                                    <td>
                                        <img src="{{ $formData['data']['Q5. Did the course meet your expectations?']['Use of Class Time'][0] == $confirmation ? $radioImgfillSrc : $radioImgSimpleSrc }}"
                                            style="width:13px;height:13px;margin-right:10px;">
                                    </td>
                                @endforeach
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="tableSet" style="margin-top:30px;">
                    <label style="margin-bottom:15px;display:block;">How would you rate your Overall impressions?</label>

                    <table class="tableHead tableBorder" style="width:100%;">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Excellent</th>
                                <th>Very Good</th>
                                <th>Good</th>
                                <th>Fair</th>
                                <th>Poor</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $confirmations = ['Excellent','Very Good', 'Good','Fair', 'Poor']; @endphp
                            <tr>
                                <td>Joining Instructions/ Pre-Course Materials</td>
                                @foreach ($confirmations as $confirmation)
                                    <td>
                                        <img src="{{ $formData['data']['Q6. How would you rate your Overall impressions?']['Joining Instructions/ Pre-Course Materials'][0] == $confirmation ? $radioImgfillSrc : $radioImgSimpleSrc }}"
                                            style="width:13px;height:13px;margin-right:10px;">
                                    </td>
                                @endforeach
                            </tr>
                            <tr>
                                <td>Members of Staff (other than Trainer)</td>
                                @foreach ($confirmations as $confirmation)
                                    <td>
                                        <img src="{{ $formData['data']['Q6. How would you rate your Overall impressions?']['Members of Staff (other than Trainer)'][0] == $confirmation ? $radioImgfillSrc : $radioImgSimpleSrc }}"
                                            style="width:13px;height:13px;margin-right:10px;">
                                    </td>
                                @endforeach
                            </tr>
                            <tr>
                                <td>Venue/Facilities</td>
                                @foreach ($confirmations as $confirmation)
                                    <td>
                                        <img src="{{ $formData['data']['Q6. How would you rate your Overall impressions?']['Venue/Facilities)'][0] == $confirmation ? $radioImgfillSrc : $radioImgSimpleSrc }}"
                                            style="width:13px;height:13px;margin-right:10px;">
                                    </td>
                                @endforeach
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="cstPanel">
                    <p class="bgBlue">Did the course meet your expectations?</p>
                    <table class="tableHead" style="width:100%;">
                        <tbody>
                            <tr>
                                @php $confirmations = ['Yes','No']; @endphp
                                @foreach ($confirmations as $confirmation)
                                    <td>
                                        <img src="{{ $formData['data']['Q4. Did the course meet your expectations?'][0] == $confirmation ? $radioImgfillSrc : $radioImgSimpleSrc }}"
                                            style="width:13px;height:13px;margin-right:10px;">
                                        {{ $confirmation }}
                                    </td>
                                @endforeach
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="cstPanel">
                    <p class="bgBlue">Do you feel there was any areas that we could improve?</p>
                    <table class="tableHead" style="width:100%;">
                        <tbody>
                            <tr>
                                @php $confirmations = ['Yes','No']; @endphp
                                @foreach ($confirmations as $confirmation)
                                    <td>
                                        <img src="{{ $formData['data']['Q7. Do you feel there was any areas that we could improve?)'][0] == $confirmation ? $radioImgfillSrc : $radioImgSimpleSrc }}"
                                            style="width:13px;height:13px;margin-right:10px;">
                                        {{ $confirmation }}
                                    </td>
                                @endforeach
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="cstPanel">
                    <p class="bgBlue">What did you enjoy most about the course?</p>
                    <div class="inputTextarea">
                        {{$formData['data']['Q8. What did you enjoy most about the course?']}}
                    </div>
                </div>
                <div class="cstPanel">
                    <p class="bgBlue">Any Further Notes/Comments?</p>
                    <div class="inputTextarea">
                        {{$formData['data']['Q9. Any Further Notes/Comments?']}}
                    </div>
                </div>
            </div>

        </div>
        <div class="step3">
            @php $confirmations = ['Excellent','Very Good', 'Good','Fair', 'Poor']; @endphp
            <h3>RATE YOUR TRAINER</h3>
            <div class="formControl">
                <label>Trainers Name</label>
                <div class="inputDiv">{{ $formData['data']['Q10. Trainers Name'] }}</div>
                <div class="tableSet" style="margin-top:30px;">
                    <label style="margin-bottom:15px;display:block;">How would you rate the trainer's performance?</label>
                    <table class="tableHead tableBorder" style="width:100%;">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Excellent</th>
                                <th>Very Good</th>
                                <th>Good</th>
                                <th>Fair</th>
                                <th>Poor</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Knowledge of Subject Matter</td>
                                @foreach ($confirmations as $confirmation)
                                    <td>
                                        <img src="{{ $formData['data']["Q11. How would you rate the trainer's performance?"]['Knowledge of Subject Matter'][0] == $confirmation ? $radioImgfillSrc : $radioImgSimpleSrc }}"
                                            style="width:13px;height:13px;margin-right:10px;">
                                    </td>
                                @endforeach
                            </tr>
                            <tr>
                                <td>Overall Trainer Rating</td>
                                @foreach ($confirmations as $confirmation)
                                    <td>
                                        <img src="{{ $formData['data']["Q11. How would you rate the trainer's performance?"]['Overall Trainer Rating'][0] == $confirmation ? $radioImgfillSrc : $radioImgSimpleSrc }}"
                                            style="width:13px;height:13px;margin-right:10px;">
                                    </td>
                                @endforeach
                            </tr>
                            <tr>
                                <td>Presentation and Delivery Skills</td>
                                @foreach ($confirmations as $confirmation)
                                    <td>
                                        <img src="{{ $formData['data']["Q11. How would you rate the trainer's performance?"]['Presentation and Delivery Skills)'][0] == $confirmation ? $radioImgfillSrc : $radioImgSimpleSrc }}"
                                            style="width:13px;height:13px;margin-right:10px;">
                                    </td>
                                @endforeach
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="step4">
            @php $confirmations = ['Excellent','Very Good', 'Good','Fair', 'Poor']; @endphp
            <h3>FURTHER QUAESTIONS</h3>
            <div class="formControl">
                <div class="cstPanel">
                    <p class="bgBlue">Would you recommend this course to others?</p>
                    <table class="tableHead" style="width:100%;">
                        <tbody>
                            <tr>
                                @php $confirmations = ['Yes','No']; @endphp
                                @foreach ($confirmations as $confirmation)
                                    <td>
                                        <img src="{{ $formData['data']['Q13. Would you recommend this course to others?'][0] == $confirmation ? $radioImgfillSrc : $radioImgSimpleSrc }}"
                                            style="width:13px;height:13px;margin-right:10px;">
                                        {{ $confirmation }}
                                    </td>
                                @endforeach
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="cstPanel">
                    <p class="bgBlue">Would you take another course by the Training4Employment?</p>
                    <table class="tableHead" style="width:100%;">
                        <tbody>
                            <tr>
                                @php $confirmations = ['Yes','No','Maybe']; @endphp
                                @foreach ($confirmations as $confirmation)
                                    <td>
                                        <img src="{{ $formData['data']['Q14. Would you take another course by the Training4Employment?'][0] == $confirmation ? $radioImgfillSrc : $radioImgSimpleSrc }}"
                                            style="width:13px;height:13px;margin-right:10px;">
                                        {{ $confirmation }}
                                    </td>
                                @endforeach
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="cstPanel">
                    <p class="bgBlue">Please state which course you would be interested in</p>
                    <div class="inputDiv" style="margin: 30px 10px;">
                        @php
                            $selectedCourses = $formData['data']['Q15. Please state which course you would be interested in'] ?? [];
                            //dd($selectedCourses);
                            if (!is_array($selectedCourses)) {
                                $selectedCourses = explode(',', $selectedCourses); // Convert comma-separated string to array
                            }
                        @endphp

                        {{ implode(', ', $selectedCourses) }}
                    </div>
                </div>


            </div>
        </div>
    </div>
    </div>
</body>

</html>
