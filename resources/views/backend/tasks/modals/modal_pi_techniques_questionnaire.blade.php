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

        h4.bgStrip {
            widows: 100%;
            background: #3b1d8f;
            border-radius: 5px;
            font-size: 35px;
            font-weight: 700;
            color: #fff;
            padding: 15px 0px 15px 10px;
        }

        .mb-5,
        .my-5 {
            margin-bottom: 3rem !important;
        }

        .text-right {
            text-align: right;
        }

        .img-fluid {
            max-width: 100%;
            height: auto;
        }

        img {
            vertical-align: middle;
            border-style: none;
        }

        .col-md-6,
        .col-lg-6,
        .col-6 {
            -webkit-flex: 0 0 50%;
            -ms-flex: 0 0 50%;
            flex: 0 0 50%;
            max-width: 50%;
            position: relative;
            width: 100%;
            padding-right: 7.5px;
            padding-left: 7.5px;
        }

        .row {
            display: -webkit-flex;
            display: -ms-flexbox;
            display: flex;
            -webkit-flex-wrap: wrap;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            margin-right: -7.5px;
            margin-left: -7.5px;
        }

        *,
        ::after,
        ::before {
            box-sizing: border-box;
        }

        .content {
            margin-top: 50px;
            margin-bottom: 30px;
        }

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
            border: solid 1px #777777 !important;
            border-radius: 5px;
            resize: none;
            background-color: #fff !important;
            font-size: 14px;
            padding: 5px 10px;
        }

        label {
            margin-bottom: 5px;
            font-size: 14px;
            font-weight: 500;
        }

        .text {
            float: left;
            display: inline;
            word-wrap: break-word;
           font-size:14px;
           padding-top: 11px;
        }

        .boxRow {
            border: solid 1px #000;
            border-radius: 10px;
            margin: 10px 0px;
            width: 100%;
            display: block !important;
            width: 100%;
            height: 51px;
            overflow: hidden;
        }

        .number {
            background: #3b1d8f;
            color: #fff;
            width: 50px;
            height: 50px;
            /* display: flex;
            align-items: center;
            justify-content: center; */
            border-radius: 9px 0px 0px 9px;
            margin-right: 10px;
            text-align: center;
            padding-top: 11px;
            float: left;
        }

        .align-items-center {
            -webkit-align-items: center !important;
            -ms-flex-align: center !important;
            align-items: center !important;
        }

        .d-flex {
            display: -webkit-flex !important;
            display: -ms-flexbox !important;
            display: flex !important;
        }
    </style>
</head>

<body>
    <div class="formWrapper">
        <div style="display:block;margin-bottom:50px;clear:both;">
            <div class="col-6" style="width:47%;float:left;margin-right:5px;">
                @php
                    $radioImgSimplePath = public_path('images/headerlogopdf.png');
                    $radioImgSimple = base64_encode(file_get_contents($radioImgSimplePath));
                    $radioImgSimpleSrc =
                        'data:' . mime_content_type($radioImgSimplePath) . ';base64,' . $radioImgSimple;
                @endphp
                <img src="{{ $radioImgSimpleSrc }}" class="img-fluid" alt="">
            </div>
            <div class="col-6" style="width:50%;float:left;margin-left:5px;">
                <div class="companyInfo text-right">
                    <p class="m-0"><strong>Training for Employment Ltd</strong></p>
                    <span>89-91 Hatchett Street, Birmingham, B19 3NY</span><br>
                    <span>E: info@training4employment.co.uk</span><br>
                    <span>www.training4employment.co.uk</span><br>
                    <span>Tel: 0121 630 2115</span><br>
                </div>
            </div>
        </div>
        <div class="row" style="margin-top:50px;clear:both;">
            <div class="studyAssessment" style="width:100%;">
                <h4 class="bgStrip mb-5 fsXl">Techniques <br>Questionnaire for <br>Physical Intervention
                    <br>Participants
                </h4>
                <p>Dear <strong>{{ auth()->user()->name }},</strong></p>

                <p>We ask you to confirm that during your Physical Intervention programme, you have <strong>NOT</strong>
                    been taught or shown any techniques that:</p>
                <div class="quetionList">
                    <div class="row">
                        <div class="col-12" style="width:100%;">
                            <div class="boxRow">
                                <div class="number">1.</div>
                                <div class="text">Involve direct contact with neck or spine</div>
                            </div>
                            <div class="boxRow">
                                <div class="number">2.</div>
                                <div class="text">Involve striking or pushing</div>
                            </div>
                            <div class="boxRow">
                                <div class="number">3.</div>
                                <div class="text">Are contra-indicative in terms of flexion or extension of joint, or
                                    apply pressure directly to it</div>
                            </div>
                            <div class="boxRow">
                                <div class="number">4.</div>
                                <div class="text">Carry inherent likelihood of resulting in pain</div>
                            </div>
                            <div class="boxRow">
                                <div class="number">5.</div>
                                <div class="text">Involve pressing on or compression of the stomach or chest</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="learnerDeclaration" style="margin-top:40px;">
                <label class="d-flex align-items-center mt-2">
                    <input type="checkbox" name="guideline1" class="form-check-input mr-4" checked>
                    <span style="color:#000;color:#000;font-weight:400;">I declare that I have never had any other
                        disorder not already mentioned that could effect my involvement on the training. I understand
                        that if any of the information is incorrect or if there are any omission, I will not hold the
                        Training team, Centre or Awarding Body responsible for any injuries that result.</span>
                </label>
                <div class="form-group" style="margin-top:40px;">
                    <label>First Name<span>*</span></label>
                    <div class="inputField" style="margin-bottom:5px;">
                        {{ $formData['data']['detail_first_name'] }}
                    </div>
                    <label>Last Name<span>*</span></label>
                    <div class="inputField" style="margin-bottom:5px;">
                        {{ $formData['data']['detail_last_name'] }}
                    </div>
                    <label>Date, Time Assessment Completed<span>*</span></label>
                    <div class="inputField" style="margin-bottom:5px;">
                        {{ $formData['data']['assessment_date'] }}
                    </div>
                    <label>Signature<span>*</span></label>
                    <div class="inputField" style="margin-bottom:5px;">
                        <img src="{{ $signatureData }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
