<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .bgStrip {
            background: #919191;
            border-radius: 5px;
            font-size: 18px;
            font-weight: 500;
            color: #fff;
            padding: 6px 0px 6px 10px;
        }

        .form-group {
            background: #f7f6f6;
            border: solid 1px #777;
            border-radius: 5px;
            padding: 15px;
            margin-top: 7px;
            margin-bottom: 7px;
        }

        .inputField {
            font-size: 14px;
        }

        .inputFieldBg {
            padding: 5px 10px;
            border: solid 1px #777777 !important;
            border-radius: 5px;
            resize: none;
            background-color: #fff !important;
        }

        label {
            margin-bottom: 5px;
            font-size: 14px;
            font-weight: 500;
        }
    </style>
</head>

<body>
    @php
        $logoImgPath = public_path('images/headerlogopdf.png');
        $logoImg = base64_encode(file_get_contents($logoImgPath));
        $logoImgSrc = 'data:' . mime_content_type($logoImgPath) . ';base64,' . $logoImg;

        $radioImgSimplePath = public_path('images/dry-clean.png');
        $radioImgSimple = base64_encode(file_get_contents($radioImgSimplePath));
        $radioImgSimpleSrc = 'data:' . mime_content_type($radioImgSimplePath) . ';base64,' . $radioImgSimple;

        $radioImgfillPath = public_path('images/round.png');
        $radioImgfill = base64_encode(file_get_contents($radioImgfillPath));
        $radioImgfillSrc = 'data:' . mime_content_type($radioImgfillPath) . ';base64,' . $radioImgfill;
    @endphp
    <div class="formWrapper">
        <div style="display: flex;margin-bottom:50px;">
            <div class="col-6" style="width:50%;float:left;margin-right:5px;">
                <img src="{{ $logoImgSrc }}" class="img-fluid" alt="">
            </div>
            <div class="col-6" style="width:50%;float:left;margin-left:5px;">
                <div class="companyInfo" style="text-align: right;">
                    <p class="m-0"><strong>Training for Employment Ltd</strong></p>
                    <span>89-91 Hatchett Street, Birmingham, B19 3NY</span><br>
                    <span>E: info@training4employment.co.uk</span><br>
                    <span>www.training4employment.co.uk</span><br>
                    <span>Tel: 0121 630 2115</span><br>
                </div>
            </div>
        </div>
        <div class="row">
            <h3>PI Health Questionnaire Form</h3>
            <div class="devider"></div>
            <p>Dear {{ auth()->user()->name }},</p>
            <p>You have been selected to attend the Level 2 Physical Intervention Skills for the Private
                Security Industry Programme. As such it is a requirement that a Health Questionnaire is
                completed pre course to identify suitability to attend the course. Although the training does
                not require a great deal of physical fitness it is essential that the training team are made
                aware of any potential injuries or problems prior to commencement of the physical activities.
            </p>
            <p>Information supplied and recorded will be kept in compliance with the Access to Medical Reports
                Act 1988.</p>
            <div class="bgStrip">Health Questionnaire</div>

            <div class="form-group">
                <div style="margin-bottom:10px !important;">
                    <label>Have you been exercise inactive for the past 12 months?</label>
                </div>
                @if (
                    $formData['data']['Have you been exercise inactive for the past 12 months?'][0] ==
                        'Yes, I have been exercise inactive due to ongoing health issues')
                    <div class="inputField" style="margin-bottom:5px;display: flex;align-items: center;">
                        <img src="{{ $radioImgfillSrc }}" style="width:13px;height:13px;margin-right:10px;">
                        {{ $formData['data']['Have you been exercise inactive for the past 12 months?'][0] }}
                    </div>
                @endif
                @if (
                    $formData['data']['Have you been exercise inactive for the past 12 months?'][0] ==
                        'No, for past 12 months keep physically active')
                    <div class="inputField" style="margin-bottom:5px;display: flex;align-items: center;">
                        <img src="{{ $radioImgSimpleSrc }}" style="width:13px;height:13px;margin-right:10px;">
                        {{ $formData['data']['Have you been exercise inactive for the past 12 months?'][0] }}
                    </div>
                @endif
                @if ($formData['data']['Have you been exercise inactive for the past 12 months?'][1])
                    <div class="inputFieldBg" style="margin-bottom:5px;display: flex;align-items: center;">
                        {{ $formData['data']['Have you been exercise inactive for the past 12 months?'][1] }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <div style="margin-bottom:10px !important;">
                    <label>Do you have a heart condition?</label>
                </div>
                @if ($formData['data']['Do you have a heart condition?'][0] == 'Yes')
                    <div class="inputField" style="margin-bottom:5px;display: flex;align-items: center;">
                        <img src="{{ $radioImgfillSrc }}" style="width:13px;height:13px;margin-right:10px;">
                        {{ $formData['data']['Do you have a heart condition?'][0] }}
                    </div>
                @elseif ($formData['data']['Do you have a heart condition?'][0] == 'No')
                    <div class="inputField" style="margin-bottom:5px;display: flex;align-items: center;">
                        <img src="{{ $radioImgSimpleSrc }}" style="width:13px;height:13px;margin-right:10px;">
                        {{ $formData['data']['Do you have a heart condition?'][0] }}
                    </div>
                @endif

            </div>
            <div class="form-group">
                <div style="margin-bottom:10px !important;">
                    <label>Have you ever experienced chest pains when exercising?</label>
                </div>
                @if ($formData['data']['Have you ever experienced chest pains when exercising?'][0] == 'Yes')
                    <div class="inputField" style="margin-bottom:5px;display: flex;align-items: center;">
                        <img src="{{ $radioImgfillSrc }}" style="width:13px;height:13px;margin-right:10px;">
                        {{ $formData['data']['Have you ever experienced chest pains when exercising?'][0] }}
                    </div>
                @else
                    <div class="inputField" style="margin-bottom:5px;display: flex;align-items: center;">
                        <img src="{{ $radioImgSimpleSrc }}" style="width:13px;height:13px;margin-right:10px;">
                        {{ $formData['data']['Have you ever experienced chest pains when exercising?'][0] }}
                    </div>
                @endif

            </div>
            <div class="form-group">
                <div style="margin-bottom:10px !important;">
                    <label>Do you suffer from any joint problems?</label>
                </div>
                @if ($formData['data']['Do you suffer from any joint problems?'][0] == 'Yes')
                    <div class="inputField" style="margin-bottom:5px;display: flex;align-items: center;">
                        <img src="{{ $radioImgfillSrc }}" style="width:13px;height:13px;margin-right:10px;">
                        {{ $formData['data']['Do you suffer from any joint problems?'][0] }}
                    </div>
                    <div class="inputFieldBg" style="margin-bottom:5px;display: flex;align-items: center;">
                        {{ $formData['data']['Do you suffer from any joint problems?'][1] }}
                    </div>
                @else
                    <div class="inputField" style="margin-bottom:5px;display: flex;align-items: center;">
                        <img src="{{ $radioImgSimpleSrc }}" style="width:13px;height:13px;margin-right:10px;">
                        {{ $formData['data']['Do you suffer from any joint problems?'][0] }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <div style="margin-bottom:10px !important;">
                    <label>Do you have any ongoing injuries or are you currently taking medication or receiving
                        treatment?</label>
                </div>
                @if (
                    $formData['data'][
                        'Do you have any ongoing injuries or are you currently taking medication or receiving treatment?'
                    ][0] == 'Yes')
                    <div class="inputField" style="margin-bottom:5px;display: flex;align-items: center;">
                        <img src="{{ $radioImgfillSrc }}" style="width:13px;height:13px;margin-right:10px;">
                        {{ $formData['data']['Do you have any ongoing injuries or are you currently taking medication or receiving treatment?'][0] }}
                    </div>
                    <div class="inputFieldBg" style="margin-bottom:5px;display: flex;align-items: center;">
                        {{ $formData['data']['Do you have any ongoing injuries or are you currently taking medication or receiving treatment?'][1] }}
                    </div>
                @else
                    <div class="inputField" style="margin-bottom:5px;display: flex;align-items: center;">
                        <img src="{{ $radioImgSimpleSrc }}" style="width:13px;height:13px;margin-right:10px;">
                        {{ $formData['data']['Do you have any ongoing injuries or are you currently taking medication or receiving treatment?'][0] }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <div style="margin-bottom:10px !important;">
                    <label>Is there anything else not previously mentioned which, could effect your inclusion on the
                        training during the day?</label>
                </div>
                @if (
                    $formData['data'][
                        'Is there anything else not previously mentioned which, could effect your inclusion on the training during the day?'
                    ][0] == 'Yes')
                    <div class="inputField" style="margin-bottom:5px;display: flex;align-items: center;">
                        <img src="{{ $radioImgfillSrc }}" style="width:13px;height:13px;margin-right:10px;">
                        {{ $formData['data']['Is there anything else not previously mentioned which, could effect your inclusion on the training during the day?'][0] }}
                    </div>
                    <div class="inputFieldBg" style="margin-bottom:5px;display: flex;align-items: center;">
                        {{ $formData['data']['Is there anything else not previously mentioned which, could effect your inclusion on the training during the day?'][1] }}
                    </div>
                @else
                    <div class="inputField" style="margin-bottom:5px;display: flex;align-items: center;">
                        <img src="{{ $radioImgSimpleSrc }}" style="width:13px;height:13px;margin-right:10px;">
                        {{ $formData['data']['Is there anything else not previously mentioned which, could effect your inclusion on the training during the day?'][0] }}
                    </div>
                @endif
            </div>

            <div class="bgStrip" style="clear: both;margin:10px 0px;">Learner Declaration</div>
            <div class="form-group">
                <label>First Name<span>*</span></label>
                <div class="inputFieldBg" style="margin-bottom:5px;">
                    {{ $formData['data']['detail_first_name'] }}
                </div>
                <label>Last Name<span>*</span></label>
                <div class="inputFieldBg" style="margin-bottom:5px;">
                    {{ $formData['data']['detail_last_name'] }}
                </div>
                <label>Date, Time Assessment Completed<span>*</span></label>
                <div class="inputFieldBg" style="margin-bottom:5px;">
                    {{ $formData['data']['assessment_date'] }}
                </div>
                <label>Signature<span>*</span></label>
                <div class="inputFieldBg" style="margin-bottom:5px;">
                    <img src="{{ $signatureData }}" alt="">
                </div>
            </div>
        </div>
    </div>

</body>

</html>
