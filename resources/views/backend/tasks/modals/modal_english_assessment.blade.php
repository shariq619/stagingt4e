<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .inputDiv {
            border: solid 1px #000;
            padding: 8px 10px;
            border-radius: 10px;
            margin-bottom: 7px;
            margin-top: 5px;
        }

        label {
            margin-top: 15px;
            display: block;
        }
        .clear-fix{
            clear: both;
        }
        .col-6{
            width: 49%;
        }
        .float-left{
            float: left;
        }
        .float-right{
            float: right;
        }
        ul{
            list-style:none;
            margin: 0;
            padding: 0;
            column-count: 4;
        }
        /* .radioGroup ul li{
            display: inline;
        } */
    </style>
</head>

<body>
    @php

        //dd($formData);

        $logoImgPath = public_path('images/blacklogo.png');
        $logoImg = base64_encode(file_get_contents($logoImgPath));
        $logoImgSrc = 'data:' . mime_content_type($logoImgPath) . ';base64,' . $logoImg;

        $radioImgSimplePath = public_path('images/dry-clean.png');
        $radioImgSimple = base64_encode(file_get_contents($radioImgSimplePath));
        $radioImgSimpleSrc = 'data:' . mime_content_type($radioImgSimplePath) . ';base64,' . $radioImgSimple;

        $radioImgfillPath = public_path('images/round.png');
        $radioImgfill = base64_encode(file_get_contents($radioImgfillPath));
        $radioImgfillSrc = 'data:' . mime_content_type($radioImgfillPath) . ';base64,' . $radioImgfill;

        $txtAimgPath = public_path('images/text-a.png');
        $txtAimg = base64_encode(file_get_contents($txtAimgPath));
        $txtAimgSrc = 'data:' . mime_content_type($txtAimgPath) . ';base64,' . $txtAimg;

        $txtBimgPath = public_path('images/text-b.png');
        $txtBimg = base64_encode(file_get_contents($txtBimgPath));
        $txtBimgSrc = 'data:' . mime_content_type($txtBimgPath) . ';base64,' . $txtBimg;
    @endphp
    <div style="display: flex;margin-bottom:30px;border-bottom:solid 1px #000;">
        <div class="col-6" style="width:50%;float:left;margin-right:5px;">
            <img src="{{ $logoImgSrc }}" class="img-fluid" alt="">
        </div>
        <div class="col-6" style="width:50%;float:left;margin-left:5px;padding-bottom:10px;">
            <div class="companyInfo" style="text-align: right;">
                <p style="margin:0;"><strong>Training for Employment Ltd</strong></p>
                <small><span>89-91 Hatchett Street, Birmingham, B19 3NY</span><br>
                    <span>E: info@training4employment.co.uk</span><br>
                    <span>www.training4employment.co.uk</span><br>
                    <span>Tel: 0121 630 2115</span><br></small>
            </div>
        </div>
    </div>

    <h1 style="margin-bottom:30px;">Initial English Assessment</h1>

    <div style="">
        <h4>Learner Declaration</h4>
        <div>
            <p style="margin:0;"><strong>I confirm that:</strong></p>
            <div style="padding-left:25px;">
                @php
                    $confirmations = [
                        'I received no help in answering the questions in this examination paper.',
                        'I am the person stated above on this form.',
                        'I will not discuss the content of the examination with anyone else.',
                    ];
                @endphp

                @foreach ($confirmations as $confirmation)
                    <div class="inputField" style="margin-bottom:5px; display:flex; align-items:center;">
                        <input type="checkbox"
                               name="data[I confirm that][]"
                               value="{{ $confirmation }}"
                               checked
                               style="margin-right:10px;">
                        {{ $confirmation }}
                    </div>
                @endforeach
            </div>
        </div>

        <div class="firstForm">
            <div class="col-12">
                <label>First Name</label>
                <div class="inputDiv">
                    {{ $formData['data']['first_name'] }}
                </div>
            </div>
            <div class="col-12">
                <label>Last Name</label>
                <div class="inputDiv">
                    {{ $formData['data']['last_name'] }}
                </div>
            </div>
        </div>
        <div class="clear-fix"></div>
        <div class="firstForm">
            <div class="col-6 float-left">
                <label>Learner Signature</label>
                <div class="inputDiv">
                    <img src="{{ $signatureData }}" alt="">
                </div>
            </div>
            <div class="col-6 float-right">
                <label>Date, Time Completed</label>
                <div class="inputDiv">
                    {{ $formData['data']['assessment_date'] }}
                </div>
            </div>
        </div>
        <div class="clear-fix"></div>
        <div class="secondForm">
            <h2>Text A</h2>
            <p>You receive the following document from Training for Employment:</p>
            <img src="{{$txtAimgSrc}}" style="width:80%" alt="">

            <div class="radioGroup" style="margin-bottom:20px;">
                @php
                $confirmations = [
                    'To describe',
                    'To explain',
                    'To persuade',
                    'To instruct',
                ];
                @endphp

                <label style="margin-bottom:10px;">Q1. What is the main purpose of Text A?  Please select one answer. (1 Point)</label>
                <ul>
                    @foreach ($confirmations as $confirmation)
                    <li>
                        <img src="{{ $formData['data']['Q1. What is the main purpose of Text A?'][0] == $confirmation ? $radioImgfillSrc : $radioImgSimpleSrc }}"
                            style="width:13px;height:13px;margin-right:10px;">
                            {{ $confirmation }}
                    </li>
                    @endforeach
                </ul>
            </div>
            <div class="radioGroup" style="margin-bottom:20px;">
                @php
                $confirmations = [
                    'As long as it takes',
                    '2 weeks',
                    '9 days',
                    'Long periods',
                ];
                @endphp

                <label style="margin-bottom:10px;">Q2. According to Text A, how long will the roadworks take? Please select one answer. (1 Point)</label>
                <ul>
                    @foreach ($confirmations as $confirmation)
                    <li>
                        <img src="{{ $formData['data']['Q2. According to Text A, how long will the roadworks take?'][0] == $confirmation ? $radioImgfillSrc : $radioImgSimpleSrc }}"
                            style="width:13px;height:13px;margin-right:10px;">
                            {{ $confirmation }}
                    </li>
                    @endforeach
                </ul>
            </div>
            <div class="radioGroup" style="margin-bottom:20px;">
                @php
                $confirmations = [
                    'By keeping local businesses open',
                    'By resurfacing the road',
                    'By using temporary traffic lights',
                    'By using heavy machinery',
                ];
                @endphp

                <label style="margin-bottom:10px;">Q3. According to Text A, how does the council plan to reduce congestion? Please select one answer. (1 Point)</label>
                <ul style="column-count:2;">
                    @foreach ($confirmations as $confirmation)
                        <li>
                            <img src="{{ $formData['data']['Q3. According to Text A, how does the council plan to reduce congestion?'][0] == $confirmation ? $radioImgfillSrc : $radioImgSimpleSrc }}"
                                style="width:13px;height:13px;margin-right:10px;">
                                {{ $confirmation }}
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="radioGroup" style="margin-bottom:20px;">
                @php
                $confirmations = [
                    'People living on Main Street',
                    'Dee Rose',
                    'Council employees',
                    'Businesses on Main Street',
                ];
                @endphp

                <label style="margin-bottom:10px;">Q4. According to Text A, who can use the park-and-ride service at a reduced cost? Please select one answer. (1 Point)</label>
                <ul style="column-count:2;">
                    @foreach ($confirmations as $confirmation)
                        <li>
                            <img src="{{ $formData['data']['Q4. According to Text A, who can use the park-and-ride service at a reduced cost?'][0] == $confirmation ? $radioImgfillSrc : $radioImgSimpleSrc }}"
                                style="width:13px;height:13px;margin-right:10px;">
                                {{ $confirmation }}
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="clear-fix"></div>
        <div class="thirdForm">
            {{--<div class="radioGroup" style="margin-bottom:20px;">
                @php
                $confirmations = [
                    'To describe',
                    'To explain',
                    'To persuade',
                ];
                @endphp

                <label style="margin-bottom:10px;">Q5. What is the main purpose of Text A?  Please select one answer. (1 Point)</label>
                <ul>
                    @foreach ($confirmations as $confirmation)
                    <li>
                        <img src="{{ $formData['data']['Q1. What is the main purpose of Text A?'][0] == $confirmation ? $radioImgfillSrc : $radioImgSimpleSrc }}"
                            style="width:13px;height:13px;margin-right:10px;">
                            {{ $confirmation }}
                    </li>
                    @endforeach
                </ul>
            </div>
            <div class="radioGroup" style="margin-bottom:20px;">
                @php
                $confirmations = [
                    'As long as it takes',
                    '2 weeks',
                    '9 days',
                    'Long periods',
                ];
                @endphp

                <label style="margin-bottom:10px;">Q6. According to Text A, how long will the roadworks take? Please select one answer. (1 Point)</label>
                <ul>
                    @foreach ($confirmations as $confirmation)
                    <li>
                        <img src="{{ $formData['data']['Q2. According to Text A, how long will the roadworks take?'][0] == $confirmation ? $radioImgfillSrc : $radioImgSimpleSrc }}"
                            style="width:13px;height:13px;margin-right:10px;">
                            {{ $confirmation }}
                    </li>
                    @endforeach
                </ul>
            </div>
            <div class="radioGroup" style="margin-bottom:20px;">
                @php
                $confirmations = [
                    'By keeping local businesses open',
                    'By resurfacing the road',
                    'By using temporary traffic lights',
                    'By using heavy machinery',
                ];
                @endphp

                <label style="margin-bottom:10px;">Q7. According to Text A, how does the council plan to reduce congestion? Please select one answer. (1 Point)</label>
                <ul style="column-count:2;">
                    @foreach ($confirmations as $confirmation)
                    <li>
                        <img src="{{ $formData['data']['Q3. According to Text A, how does the council plan to reduce congestion?'][0] == $confirmation ? $radioImgfillSrc : $radioImgSimpleSrc }}"
                            style="width:13px;height:13px;margin-right:10px;">
                            {{ $confirmation }}
                    </li>
                    @endforeach
                </ul>
            </div>
            <div class="radioGroup" style="margin-bottom:20px;">
                @php
                $confirmations = [
                    'People living on Main Street',
                    'Dee Rose',
                    'Council employees',
                    'Businesses on Main Street',
                ];
                @endphp

                <label style="margin-bottom:10px;">Q8. According to Text A, who can use the park-and-ride service at a reduced cost?</label>
                <ul style="column-count:2;">
                    @foreach ($confirmations as $confirmation)
                    <li>
                        <img src="{{ $formData['data']['Q4. According to Text A, who can use the park-and-ride service at a reduced cost?'][0] == $confirmation ? $radioImgfillSrc : $radioImgSimpleSrc }}"
                            style="width:13px;height:13px;margin-right:10px;">
                            {{ $confirmation }}
                    </li>
                    @endforeach
                </ul>
            </div>--}}
            <div class="radioGroup" style="margin-bottom:20px;">
                @php
                $confirmations = [
                    'Fact',
                    'Opinion',
                ];
               // dd($formData['data']['Q5. The writer of Text A states’ we will be heavy machinery to carry out the work’. Is this a fact or an opinion?'][0]);

                @endphp

                <label style="margin-bottom:10px;">Q5. The writer of Text A states’ we will be heavy machinery to carry out the work’. Is this a fact or an opinion? </label>
                <ul>
                    @foreach ($confirmations as $confirmation)
                    <li>
                        <img src="{{ $formData['data']['Q5. The writer of Text A states’ we will be heavy machinery to carry out the work’. Is this a fact or an opinion?'][0] == $confirmation ? $radioImgfillSrc : $radioImgSimpleSrc }}"
                            style="width:13px;height:13px;margin-right:10px;">
                            {{ $confirmation }}
                    </li>
                    @endforeach
                </ul>
            </div>
            <div class="col-12">
                <label>Give a reason for your answer <br>Please write a paragraph which consists of approximately 3-4 sentences</label>
                <div class="inputDiv">
                    {{ $formData['data']['Q5_reason'] ?? 'No reason given' }}
                </div>
            </div>
            <div class="col-12">
                <label>Q6. Using Text A, identify two instruction given by Dee Rose to residents of Main Street. (2 Marks)</label>
                <div class="inputDiv">
                    {{$formData['data']['Q6. Using Text A, identify two instruction given by Dee Rose to residents of Main Street'][0]}}
                </div>
                <div class="inputDiv">
                    {{$formData['data']['Q6. Using Text A, identify two instruction given by Dee Rose to residents of Main Street'][1]}}
                </div>
            </div>
            <div class="radioGroup" style="margin-bottom:20px;">
                @php
                $confirmations = [
                    'Formal',
                    'Informal',
                ];
                @endphp

                <label style="margin-bottom:10px;">Q7. Is Text A formal or informal? Give a reason for your answer. Please select one answer. (2 Marks)</label>
                <ul>
                    @foreach ($confirmations as $confirmation)
                    <li>
                        <img src="{{ $formData['data']['Q7. Is Text A formal or informal? Give a reason for your answer'][0] == $confirmation ? $radioImgfillSrc : $radioImgSimpleSrc }}"
                            style="width:13px;height:13px;margin-right:10px;">
                            {{ $confirmation }}
                    </li>
                    @endforeach
                </ul>
            </div>
            <div class="col-12">
                <label>Give a reason for your answer <br>Please write a paragraph which consists of approximately 3-4 sentences</label>
                <div class="inputDiv">
                    {{$formData['data']['Q7. Is Text A formal or informal? Give a reason for your answer'][1]}}
                </div>
            </div>
        </div>
        <div class="fourthForm">
            <h2>Text B</h2>
            <p>You see the following advertisement in the local newspaper:</p>
            <img src="{{$txtBimgSrc}}" style="width:80%" alt="">

            <div class="radioGroup" style="margin-bottom:20px;">
                @php
                $confirmations = [
                    'A student loan',
                    'A disadvantage',
                    'A benefit',
                    'An extra payment',
                ];
                @endphp

                <label style="margin-bottom:10px;">Q8. What is the meaning of the term "added bonus", as used in Text B? Please select one answer. (1 Mark)</label>
                <ul style="column-count:2;">
                    @foreach ($confirmations as $confirmation)
                    <li>
                        <img src="{{ $formData['data']['Q8. What is the meaning of the term added bonus as used in Text B?'][0] == $confirmation ? $radioImgfillSrc : $radioImgSimpleSrc }}"
                            style="width:13px;height:13px;margin-right:10px;">
                            {{ $confirmation }}
                    </li>
                    @endforeach
                </ul>
            </div>
            <div class="radioGroup" style="margin-bottom:20px;">
                @php
                $confirmations = [
                    'Paragraphs',
                    'Heading',
                    'Subheadings',
                    'Bullet points',
                ];
                @endphp

                <label style="margin-bottom:10px;">Q9. In Text B, which organisational feature is used to demonstrate the benefits of an apprenticeship? Please select one answer. (1 Mark)</label>
                <ul style="column-count:2;">
                    @foreach ($confirmations as $confirmation)
                    <li>
                        <img src="{{ $formData['data']['Q9. In Text B, which organisational feature is used to demonstrate the benefits of an apprenticeship?'][0] == $confirmation ? $radioImgfillSrc : $radioImgSimpleSrc }}"
                            style="width:13px;height:13px;margin-right:10px;">
                            {{ $confirmation }}
                    </li>
                    @endforeach
                </ul>
            </div>
            <div class="radioGroup" style="margin-bottom:20px;">
                @php
                $confirmations = [
                    'Apprentices earn a salary',
                    'National Apprenticeship Week is in the summer',
                    'Job centres have more details',
                    'Apprenticeship are only available to teenagers',
                ];
                @endphp

                <label style="margin-bottom:10px;">Q10. Using Text B, which of these statements is incorrect? Please select one answer. (1 Mark)</label>
                <ul style="column-count:2;">
                    @foreach ($confirmations as $confirmation)
                    <li>
                        <img src="{{ $formData['data']['Q10. Using Text B, which of these statements is incorrect?'][0] == $confirmation ? $radioImgfillSrc : $radioImgSimpleSrc }}"
                            style="width:13px;height:13px;margin-right:10px;">
                            {{ $confirmation }}
                    </li>
                    @endforeach
                </ul>
            </div>
            <div class="radioGroup" style="margin-bottom:20px;">
                @php
                $confirmations = [
                    'At the job centre',
                    'In the workplace',
                    'At university',
                    'At college',
                ];
                @endphp

                <label style="margin-bottom:10px;">Q11. According to Text B, most of the training takes place. Please select one answer. (1 Mark)</label>
                <ul style="column-count:2;">
                    @foreach ($confirmations as $confirmation)
                    <li>
                        <img src="{{ $formData['data']['Q11. According to Text B, most of the training takes place'][0] == $confirmation ? $radioImgfillSrc : $radioImgSimpleSrc }}"
                            style="width:13px;height:13px;margin-right:10px;">
                            {{ $confirmation }}
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="clear-fix"></div>
        <div class="fifthForm">
            <div class="col-12">
                <label>Q12.  What does the image in Text B suggest about how the apprentices are feeling about their course?<br>Please write a paragraph which consists of approximately 3-4 sentences.  (1 mark)</label>
                <div class="inputDiv">
                    {{$formData['data']['12. What does the image in Text B suggest about how the apprentices are feeling about their course?'][0]}}
                </div>
            </div>
            <div class="col-12">
                <label>Q13. Explain why the author has used exclamation marks in Text B.<br>
                    Please write a paragraph which consists of approximately 3-4 sentences.  (1 mark)</label>
                <div class="inputDiv">
                    {{$formData['data']['Q13. Explain why the author has used exclamation marks in Text B'][0]}}
                </div>
            </div>
            <div>
                <label style="margin-bottom:10px;">Please review Text A and Text B, then proceed to answer question 14</label>
                <div class="col-6 float-left">
                    <div class="inputDiv">
                        <img src="{{$txtAimgSrc}}" width="100%" alt="">
                        <p style="text-align: center;"><strong>Text A</strong></p>
                    </div>
                </div>
                <div class="col-6 float-right">
                    <div class="inputDiv">
                        <img src="{{$txtBimgSrc}}" width="100%" alt="">
                        <p style="text-align: center;"><strong>Text B</strong></p>
                    </div>
                </div>
            </div>
            <div class="clear-fix"></div>
            <div class="radioGroup" style="margin-bottom:20px;">
                <label style="margin-bottom:10px;">Q14.  How does the information about roadworks in Text B compare with that given in Text A?<br>Give two examples. (2 marks)</label>
                <p><small>Example 1</small></p>
                <div class="inputDiv">
                    {{$formData['data']['Q14. How does the information about roadworks in Text B compare with that given in Text A?'][0]}}
                </div>
                <p><small>Example 2</small></p>
                <div class="inputDiv">
                    {{$formData['data']['Q14. How does the information about roadworks in Text B compare with that given in Text A?'][1]}}
                </div>
            </div>
        </div>
    </div>
</body>

</html>
