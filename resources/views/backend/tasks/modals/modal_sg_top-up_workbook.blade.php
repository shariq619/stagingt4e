<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .alertNotificationLight img {
            float: left;
            width: 50px;
            margin-right: 20px;
        }

        .alertNotificationLight {
            margin: auto;
            background: #d9edf7;
            display: block;
            border: solid 1px #3e8acc;
            border-radius: 5px;
            padding: 23px 20px;
        }

        .inputDiv {
            border: solid 1px #000;
            padding: 5px 5px;
            border-radius: 10px;
        }

        .panelCard {
            border: solid 1px #ccc;
            border-radius: 8px;
        }

        .col-12 {
            width: 100%;
            margin-bottom: 15px;
        }

        .col-6 {
            width: 48%;
        }

        .float-left {
            float: left;
        }

        .float-right {
            float: right;
        }

        .content {
            margin-top: 50px;
            margin-bottom: 30px;
        }

        .bgStrip {
            background: #3e8acc;
            padding: 10px;
            font-size: 18px;
            font-weight: 500;
            color: #fff;
            border-radius: 8px 8px 0px 0px;
            margin-top: 0 !important;
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

        p {
            font-weight: normal;
        }

        label {
            margin-bottom: 5px;
            font-size: 14px;
            font-weight: 500;
        }

        .clear-fix {
            clear: both;
        }

        .inputDiv {
            border: solid 1px #000;
            padding: 5px 5px;
            border-radius: 10px;
        }

        .alertNotification {
            margin: auto;
            background: #fad2e0;
            display: block;
            border: solid 1px #ff3823;
            border-radius: 5px;
            padding: 23px 20px;
        }

        .panelCard {
            border: solid 1px #ccc;
            border-radius: 8px;
        }

        .alertNotification img {
            float: left;
            width: 50px;
            margin-right: 15px;
        }

        .alertNotification span {
            /* margin-top: 26px; */
            display: block;
        }

        .bgGray {
            background: #c0c0c0;
            padding: 15px 15px;
            border-radius: 8px;
            border: solid 1px #777;
        }
    </style>
</head>

<body>
    <div class="formWrapper">
        @php
            $radioImgSimplePath = public_path('images/blacklogo.png');
            $radioImgSimple = base64_encode(file_get_contents($radioImgSimplePath));
            $radioImgSimpleSrc = 'data:' . mime_content_type($radioImgSimplePath) . ';base64,' . $radioImgSimple;
        @endphp
        @php
            $notificationPath = public_path('images/notificationimg.png');
            $notification = base64_encode(file_get_contents($notificationPath));
            $notificationSrc = 'data:' . mime_content_type($notificationPath) . ';base64,' . $notification;
        @endphp
        @php
            $keyPointPath = public_path('images/notificationlight.png');
            $keyPoint = base64_encode(file_get_contents($keyPointPath));
            $keyPointSrc = 'data:' . mime_content_type($keyPointPath) . ';base64,' . $keyPoint;
        @endphp

        <div style="display: block;clear: both;overflow: overlay;padding-bottom: 15px;">
            <div class="col-6" style="width:47%;float:left;margin-right:5px;">
                @php
                    $radioImgSimplePath = public_path('images/blacklogo.png');
                    $radioImgSimple = base64_encode(file_get_contents($radioImgSimplePath));
                    $radioImgSimpleSrc =
                        'data:' . mime_content_type($radioImgSimplePath) . ';base64,' . $radioImgSimple;
                @endphp
                <img src="{{ $radioImgSimpleSrc }}" class="img-fluid" alt="">
            </div>
            <div class="col-6" style="width:50%;float:left;margin-left:5px;">
                <div class="companyInfo" style="text-align:right;">
                    <p style="margin:0;"><strong>Training for Employment Ltd</strong></p>
                    <span>89-91 Hatchett Street, Birmingham, B19 3NY</span><br>
                    <span>E: info@training4employment.co.uk</span><br>
                    <span>www.training4employment.co.uk</span><br>
                    <span>Tel: 0121 630 2115</span><br>
                </div>
            </div>
        </div>
        <div class="clear-fix"></div>
        <div class="page1">
            <h1 style="color: #3e8acc;font-size: 25px;">Principles of Minimising Personal Risk <br> for Security
                Officers in the Private
                <br>Security Industry F/618/6846
            </h1>
            <h2 style="font-weight: 600;font-size:30px;">Self Study (Top-Up) Workbook</h2>

            <div class="panelCard" style="display: block;clear: both;overflow: auto;padding-bottom: 17px;">
                <h4 class="bgStrip">Learner Information</h4>
                <div style="padding:0px 10px;">
                    <div>
                        <label>First Name</label>
                        <div class="inputDiv">Haley</div>
                    </div>
                    <div>
                        <label>Last Name</label>
                        <div class="inputDiv">Roberson</div>
                    </div>
                    <div>
                        <label>E-Mail Address:</label>
                        <div class="inputDiv">duzejicuj@mailinator.com</div>
                    </div>
                    <div>
                        <label>Training Provider:</label>
                        <div class="inputDiv">Training4Employment</div>
                    </div>
                    <div>
                        <label>Course Start Date:</label>
                        <div class="inputDiv">1981-04-15</div>
                    </div>
                    <div>
                        <label>Course End Date:</label>
                        <div class="inputDiv">2000-04-10</div>
                    </div>
                </div>
            </div>

            <div class="panelCard" style="margin-top:20px;">
                <h4 class="bgStrip">Introduction</h4>
                <div style="padding: 0px 10px;">
                    <div class="alertNotification">
                        <img src="{{ $notificationSrc }}" class="img-fluid" alt="">
                        <span>This workbook must be completed and submitted to Training4Employment before any further
                            face-to-face training</span>
                    </div>
                    <p>This online form has been created based on the Security Guard Self-Study (Top-Up) Workbook from
                        Highfield Products.</p>
                    <p>This workbook has been developed to support you in achieving the requirements of the self-study
                        learning outcomes and assessment criteria from the Highfield Level 2 Award for Security Officers
                        in the Private Security Industry (Top Up) Unit 2: Principles of Minimising Personal Risk for
                        Security Officers in the Private Security Industry.</p>
                </div>
            </div>
        </div>
        <div class="clear-fix"></div>
        <div class="page2" style="margin-top:30px;">
            <div class="panelCard" style="display: block;clear: both;overflow: auto;padding-bottom: 17px;">
                <h4 class="bgStrip">Knowledge Questions</h4>
                <div style="padding: 0px 10px;">
                    <h4 class="bgGray">LO1 Know how to minimise risk to personal safety at work.</h4>
                    <div class="questions">
                        <label>AC1.1 Identify responsibilities for personal safety at work.</label>
                        <p>All employees and employers have basic responsibilities that they must follow to help ensure
                            personal safety is maintained at work.</p>
                        <p><strong>Question 1 a:</strong> Identify <strong>SIX</strong> employee responsibilities for
                            personal safety at work when working as a security officer.</p>
                        <div style="clear:both;">
                            <label style="float:left;width:3%;">1.</label>
                            <div class="inputDiv" style="margin-bottom:10px;float:left;width:95%;">
                                {{ $formData['data']['Question 1 a'][0] }}</div>
                        </div>
                        <div style="clear:both;">
                            <label style="float:left;width:3%;">2.</label>
                            <div class="inputDiv" style="margin-bottom:10px;float:left;width:95%;">
                                {{ $formData['data']['Question 1 a'][1] }}</div>
                        </div>
                        <div style="clear:both;">
                            <label style="float:left;width:3%;">3.</label>
                            <div class="inputDiv" style="margin-bottom:10px;float:left;width:95%;">
                                {{ $formData['data']['Question 1 a'][2] }}</div>
                        </div>
                        <div style="clear:both;">
                            <label style="float:left;width:3%;">4.</label>
                            <div class="inputDiv" style="margin-bottom:10px;float:left;width:95%;">
                                {{ $formData['data']['Question 1 a'][3] }}</div>
                        </div>
                        <div style="clear:both;">
                            <label style="float:left;width:3%;">5.</label>
                            <div class="inputDiv" style="margin-bottom:10px;float:left;width:95%;">
                                {{ $formData['data']['Question 1 a'][4] }}</div>
                        </div>
                        <div style="clear:both;">
                            <label style="float:left;width:3%;">6.</label>
                            <div class="inputDiv" style="margin-bottom:10px;float:left;width:95%;">
                                {{ $formData['data']['Question 1 a'][5] }}</div>
                        </div>

                        <label style="margin:15px 0px;display:block;">Question 1 b: Identify SEVEN employer
                            responsibilities.</label>

                        <div style="clear:both;">
                            <label style="float:left;width:3%;">1.</label>
                            <div class="inputDiv" style="margin-bottom:10px;float:left;width:95%;">
                                {{ $formData['data']['Question 1 b'][0] }}</div>
                        </div>
                        <div style="clear:both;">
                            <label style="float:left;width:3%;">2.</label>
                            <div class="inputDiv" style="margin-bottom:10px;float:left;width:95%;">
                                {{ $formData['data']['Question 1 b'][1] }}</div>
                        </div>
                        <div style="clear:both;">
                            <label style="float:left;width:3%;">3.</label>
                            <div class="inputDiv" style="margin-bottom:10px;float:left;width:95%;">
                                {{ $formData['data']['Question 1 b'][2] }}</div>
                        </div>
                        <div style="clear:both;">
                            <label style="float:left;width:3%;">4.</label>
                            <div class="inputDiv" style="margin-bottom:10px;float:left;width:95%;">
                                {{ $formData['data']['Question 1 b'][3] }}</div>
                        </div>
                        <div style="clear:both;">
                            <label style="float:left;width:3%;">5.</label>
                            <div class="inputDiv" style="margin-bottom:10px;float:left;width:95%;">
                                {{ $formData['data']['Question 1 b'][4] }}</div>
                        </div>
                        <div style="clear:both;">
                            <label style="float:left;width:3%;">6.</label>
                            <div class="inputDiv" style="margin-bottom:10px;float:left;width:95%;">
                                {{ $formData['data']['Question 1 b'][5] }}</div>
                        </div>
                        <div style="clear:both;">
                            <label style="float:left;width:3%;">7.</label>
                            <div class="inputDiv" style="margin-bottom:10px;float:left;width:95%;">
                                {{ $formData['data']['Question 1 b'][6] }}</div>
                        </div>
                        {{-- border --}}
                        <div style="border-bottom:solid 1px #ccc;margin:20px 0px;clear:both;"></div>
                        {{-- border --}}
                        <label>AC1.2 Identify situations that might compromise personal safety.</label>
                        <p>As a security officer, you should always be aware of situations that could compromise your
                            safety.</p>
                        <p><strong>Question 2:</strong> Identify <strong>FOUR</strong> of the most common situations
                            that might compromise your personal safety.</p>
                        <div style="clear:both;">
                            <label style="float:left;width:3%;">1.</label>
                            <div class="inputDiv" style="margin-bottom:10px;float:left;width:95%;">
                                {{ $formData['data']['Question 2'][0] }}</div>
                        </div>
                        <div style="clear:both;">
                            <label style="float:left;width:3%;">2.</label>
                            <div class="inputDiv" style="margin-bottom:10px;float:left;width:95%;">
                                {{ $formData['data']['Question 2'][1] }}</div>
                        </div>
                        <div style="clear:both;">
                            <label style="float:left;width:3%;">3.</label>
                            <div class="inputDiv" style="margin-bottom:10px;float:left;width:95%;">
                                {{ $formData['data']['Question 2'][2] }}</div>
                        </div>
                        <div style="clear:both;">
                            <label style="float:left;width:3%;">4.</label>
                            <div class="inputDiv" style="margin-bottom:10px;float:left;width:95%;">
                                {{ $formData['data']['Question 2'][3] }}</div>
                        </div>
                        {{-- border --}}
                        <div style="border-bottom:solid 1px #ccc;margin:20px 0px;clear:both;"></div>
                        {{-- border --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="clear-fix"></div>
        <div class="page3" style="margin-top:30px;">
            <div class="panelCard" style="display: block;clear: both;overflow: auto;padding-bottom: 17px;">
                <h4 class="bgStrip">Knowledge Questions</h4>
                <div style="padding: 0px 10px;">
                    <div class="questions">
                        <label>AC1.3 Identify the risks of ignoring personal safety in conflict situations.</label>
                        <p>Whenever you are dealing with conflict situations, there is an increased level of risk and
                            potential for escalation.</p>
                        <p><strong>Question 3:</strong> Identify <strong>THREE</strong> risks of ignoring personal
                            safety in conflict situations.</p>
                        <div style="clear:both;">
                            <label style="float:left;width:3%;">1.</label>
                            <div class="inputDiv" style="margin-bottom:10px;float:left;width:95%;">
                                {{ $formData['data']['Question 3'][0] }}</div>
                        </div>
                        <div style="clear:both;">
                            <label style="float:left;width:3%;">2.</label>
                            <div class="inputDiv" style="margin-bottom:10px;float:left;width:95%;">
                                {{ $formData['data']['Question 3'][1] }}</div>
                        </div>
                        <div style="clear:both;">
                            <label style="float:left;width:3%;">3.</label>
                            <div class="inputDiv" style="margin-bottom:10px;float:left;width:95%;">
                                {{ $formData['data']['Question 3'][2] }}</div>
                        </div>

                        {{-- border --}}
                        <div style="border-bottom:solid 1px #ccc;margin:20px 0px;clear:both;"></div>
                        {{-- border --}}

                        <label>AC1.4 State the personal safety benefits of undertaking dynamic risk assessments.</label>
                        <p>A dynamic risk assessment is a systematic way of assessing the risk of the potential for
                            violence before approaching or responding to a situation.</p>
                        <p><strong>Question 4: State the personal safety benefits of undertaking dynamic risk
                                assessments.</p>
                        <div style="clear:both;">
                            <div class="inputDiv" style="margin-bottom:10px;float:left;width:95%;">
                                {{ $formData['data']['Question 4'] }}</div>
                        </div>
                        {{-- border --}}
                        <div style="border-bottom:solid 1px #ccc;margin:20px 0px;clear:both;"></div>
                        {{-- border --}}

                        <label>AC1.5 List ways to minimise risk to personal safety.</label>
                        <p>It is important that you can minimise risks to your personal safety when working as a
                            security officer.</p>
                        <p><strong>Question 5:</strong> List <strong>SIX</strong> ways to minimise risk to personal
                            safety.</p>
                        <div style="clear:both;">
                            <label style="float:left;width:3%;">1.</label>
                            <div class="inputDiv" style="margin-bottom:10px;float:left;width:95%;">
                                {{ $formData['data']['Question 5'][0] }}</div>
                        </div>
                        <div style="clear:both;">
                            <label style="float:left;width:3%;">2.</label>
                            <div class="inputDiv" style="margin-bottom:10px;float:left;width:95%;">
                                {{ $formData['data']['Question 5'][1] }}</div>
                        </div>
                        <div style="clear:both;">
                            <label style="float:left;width:3%;">3.</label>
                            <div class="inputDiv" style="margin-bottom:10px;float:left;width:95%;">
                                {{ $formData['data']['Question 5'][2] }}</div>
                        </div>
                        <div style="clear:both;">
                            <label style="float:left;width:3%;">4.</label>
                            <div class="inputDiv" style="margin-bottom:10px;float:left;width:95%;">
                                {{ $formData['data']['Question 5'][3] }}</div>
                        </div>
                        <div style="clear:both;">
                            <label style="float:left;width:3%;">5.</label>
                            <div class="inputDiv" style="margin-bottom:10px;float:left;width:95%;">
                                {{ $formData['data']['Question 5'][4] }}</div>
                        </div>
                        <div style="clear:both;">
                            <label style="float:left;width:3%;">6.</label>
                            <div class="inputDiv" style="margin-bottom:10px;float:left;width:95%;">
                                {{ $formData['data']['Question 5'][5] }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="clear-fix"></div>
        <div class="page4" style="margin-top:30px;">
            <div class="panelCard" style="display: block;clear: both;overflow: auto;padding-bottom: 17px;">
                <h4 class="bgStrip">Knowledge Questions</h4>
                <div style="padding: 0px 10px;">
                    <div class="questions">
                        <label>AC1.6 Recognise the different types of personal protective equipment relevant to the role
                            of a security officer.</label>
                        <p>Personal protective equipment (PPE) is used to help protect you from harm when carrying out
                            your job role.</p>
                        <p><strong>Question 6 a:</strong> Identify <strong>EIGHT</strong> different types of personal
                            protective equipment that you may wear as a security officer.</p>
                        <div style="clear:both;">
                            <label style="float:left;width:3%;">1.</label>
                            <div class="inputDiv" style="margin-bottom:10px;float:left;width:95%;">
                                {{ $formData['data']['Question 6 a'][0] }}</div>
                        </div>
                        <div style="clear:both;">
                            <label style="float:left;width:3%;">2.</label>
                            <div class="inputDiv" style="margin-bottom:10px;float:left;width:95%;">
                                {{ $formData['data']['Question 6 a'][1] }}</div>
                        </div>
                        <div style="clear:both;">
                            <label style="float:left;width:3%;">3.</label>
                            <div class="inputDiv" style="margin-bottom:10px;float:left;width:95%;">
                                {{ $formData['data']['Question 6 a'][2] }}</div>
                        </div>
                        <div style="clear:both;">
                            <label style="float:left;width:3%;">4.</label>
                            <div class="inputDiv" style="margin-bottom:10px;float:left;width:95%;">
                                {{ $formData['data']['Question 6 a'][3] }}</div>
                        </div>
                        <div style="clear:both;">
                            <label style="float:left;width:3%;">5.</label>
                            <div class="inputDiv" style="margin-bottom:10px;float:left;width:95%;">
                                {{ $formData['data']['Question 6 a'][4] }}</div>
                        </div>
                        <div style="clear:both;">
                            <label style="float:left;width:3%;">6.</label>
                            <div class="inputDiv" style="margin-bottom:10px;float:left;width:95%;">
                                {{ $formData['data']['Question 6 a'][5] }}</div>
                        </div>
                        <div style="clear:both;">
                            <label style="float:left;width:3%;">7.</label>
                            <div class="inputDiv" style="margin-bottom:10px;float:left;width:95%;">
                                {{ $formData['data']['Question 6 a'][6] }}</div>
                        </div>
                        <div style="clear:both;">
                            <label style="float:left;width:3%;">8.</label>
                            <div class="inputDiv" style="margin-bottom:10px;float:left;width:95%;">
                                {{ $formData['data']['Question 6 a'][7] }}</div>
                        </div>
                        <p><strong>Question 6 b:</strong> Identify <strong>SIX</strong> different types of personal
                            protective equipment that can be used to help maintain your safety when working as a
                            security officer.</p>
                        <div style="clear:both;">
                            <label style="float:left;width:3%;">1.</label>
                            <div class="inputDiv" style="margin-bottom:10px;float:left;width:95%;">
                                {{ $formData['data']['Question 6 b'][0] }}</div>
                        </div>
                        <div style="clear:both;">
                            <label style="float:left;width:3%;">2.</label>
                            <div class="inputDiv" style="margin-bottom:10px;float:left;width:95%;">
                                {{ $formData['data']['Question 6 b'][1] }}</div>
                        </div>
                        <div style="clear:both;">
                            <label style="float:left;width:3%;">3.</label>
                            <div class="inputDiv" style="margin-bottom:10px;float:left;width:95%;">
                                {{ $formData['data']['Question 6 b'][2] }}</div>
                        </div>
                        <div style="clear:both;">
                            <label style="float:left;width:3%;">4.</label>
                            <div class="inputDiv" style="margin-bottom:10px;float:left;width:95%;">
                                {{ $formData['data']['Question 6 b'][3] }}</div>
                        </div>
                        <div style="clear:both;">
                            <label style="float:left;width:3%;">5.</label>
                            <div class="inputDiv" style="margin-bottom:10px;float:left;width:95%;">
                                {{ $formData['data']['Question 6 b'][4] }}</div>
                        </div>
                        <div style="clear:both;">
                            <label style="float:left;width:3%;">6.</label>
                            <div class="inputDiv" style="margin-bottom:10px;float:left;width:95%;">
                                {{ $formData['data']['Question 6 b'][5] }}</div>
                        </div>

                        {{-- border --}}
                        <div style="border-bottom:solid 1px #ccc;margin:20px 0px;clear:both;"></div>
                        {{-- border --}}

                        <label>AC1.7 State the purpose of using body-worn cameras (BWC).</label>
                        <p>Body-worn cameras (BWC) have many benefits and as such are becoming more popular within the
                            private security industry and well as within law enforcement.</p>
                        <p><strong>Question 7:</strong> State the purpose of body-worn cameras.</p>
                        <div style="clear:both;">
                            <div class="inputDiv" style="margin-bottom:10px;float:left;width:95%;">
                                {{ $formData['data']['Question 7'] }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="clear-fix"></div>
        <div class="page5" style="margin-top:30px;">
            <div class="panelCard" style="display: block;clear: both;overflow: auto;padding-bottom: 17px;">
                <h4 class="bgStrip">Knowledge Questions</h4>
                <div style="padding: 0px 10px;">
                    <div class="questions">
                        <label>AC1.8 Identify strategies that can assist personal safety in conflict situations.</label>
                        <p>There are several problem-solving strategies that may help de-escalate a situation.</p>
                        <p><strong>Question 8:</strong> Identify <strong>EIGHT</strong> strategies that can assist
                            personal safety in conflict situations.</p>
                        <div style="clear:both;">
                            <label style="float:left;width:3%;">1.</label>
                            <div class="inputDiv" style="margin-bottom:10px;float:left;width:95%;">
                                {{ $formData['data']['Question 8'][0] }}</div>
                        </div>
                        <div style="clear:both;">
                            <label style="float:left;width:3%;">2.</label>
                            <div class="inputDiv" style="margin-bottom:10px;float:left;width:95%;">
                                {{ $formData['data']['Question 8'][1] }}</div>
                        </div>
                        <div style="clear:both;">
                            <label style="float:left;width:3%;">3.</label>
                            <div class="inputDiv" style="margin-bottom:10px;float:left;width:95%;">
                                {{ $formData['data']['Question 8'][2] }}</div>
                        </div>
                        <div style="clear:both;">
                            <label style="float:left;width:3%;">4.</label>
                            <div class="inputDiv" style="margin-bottom:10px;float:left;width:95%;">
                                {{ $formData['data']['Question 8'][3] }}</div>
                        </div>
                        <div style="clear:both;">
                            <label style="float:left;width:3%;">5.</label>
                            <div class="inputDiv" style="margin-bottom:10px;float:left;width:95%;">
                                {{ $formData['data']['Question 8'][4] }}</div>
                        </div>
                        <div style="clear:both;">
                            <label style="float:left;width:3%;">6.</label>
                            <div class="inputDiv" style="margin-bottom:10px;float:left;width:95%;">
                                {{ $formData['data']['Question 8'][5] }}</div>
                        </div>
                        <div style="clear:both;">
                            <label style="float:left;width:3%;">7.</label>
                            <div class="inputDiv" style="margin-bottom:10px;float:left;width:95%;">
                                {{ $formData['data']['Question 8'][6] }}</div>
                        </div>
                        <div style="clear:both;">
                            <label style="float:left;width:3%;">8.</label>
                            <div class="inputDiv" style="margin-bottom:10px;float:left;width:95%;">
                                {{ $formData['data']['Question 8'][7] }}</div>
                        </div>
                        {{-- border --}}
                        <div style="border-bottom:solid 1px #ccc;margin:20px 0px;clear:both;"></div>
                        {{-- border --}}
                        <label>AC1.9 Describe limits of own responsibility in physical intervention situations.</label>
                        <p>Physical intervention is a non-pain compliant method of escorting an individual to the destination of your choice.</p>
                        <div style="padding: 0px 10px;">
                            <div class="alertNotificationLight">
                                <img src="{{ $keyPointSrc }}" class="img-fluid" alt="">
                                <span>KEY POINT <br>You must be trained in how to correctly apply holds prior to using them.</span>
                            </div>
                        </div>
                        <div class="clear-fix"></div>
                        <p><strong>Question 9:</strong> Describe the limits of your responsibility in physical intervention situations..</p>
                        <div style="clear:both;">
                            <div class="inputDiv" style="margin-bottom:10px;float:left;width:95%;">
                                {{ $formData['data']['Question 9'] }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="clear-fix"></div>
        <div class="page6" style="margin-top:30px;">
            <div class="panelCard" style="display: block;clear: both;overflow: auto;padding-bottom: 17px;">
                <h4 class="bgStrip">Knowledge Questions</h4>
                <div style="padding: 0px 10px;">
                    <div class="questions">
                        <label>AC1.10 Identify types of harm that can occur during physical interventions.</label>
                        <p>Any forceful restraint can lead to medical complications.</p>
                        <p><strong>Question 10:</strong> Identify <strong>SIX</strong> types of harm that can occur during physical interventions.</p>
                        <div style="clear:both;">
                            <label style="float:left;width:3%;">1.</label>
                            <div class="inputDiv" style="margin-bottom:10px;float:left;width:95%;">
                                {{ $formData['data']['Question 10'][0] }}</div>
                        </div>
                        <div style="clear:both;">
                            <label style="float:left;width:3%;">2.</label>
                            <div class="inputDiv" style="margin-bottom:10px;float:left;width:95%;">
                                {{ $formData['data']['Question 10'][1] }}</div>
                        </div>
                        <div style="clear:both;">
                            <label style="float:left;width:3%;">3.</label>
                            <div class="inputDiv" style="margin-bottom:10px;float:left;width:95%;">
                                {{ $formData['data']['Question 10'][2] }}</div>
                        </div>
                        <div style="clear:both;">
                            <label style="float:left;width:3%;">4.</label>
                            <div class="inputDiv" style="margin-bottom:10px;float:left;width:95%;">
                                {{ $formData['data']['Question 10'][3] }}</div>
                        </div>
                        <div style="clear:both;">
                            <label style="float:left;width:3%;">5.</label>
                            <div class="inputDiv" style="margin-bottom:10px;float:left;width:95%;">
                                {{ $formData['data']['Question 10'][4] }}</div>
                        </div>
                        <div style="clear:both;">
                            <label style="float:left;width:3%;">6.</label>
                            <div class="inputDiv" style="margin-bottom:10px;float:left;width:95%;">
                                {{ $formData['data']['Question 10'][5] }}</div>
                        </div>
                        {{-- border --}}
                        <div style="border-bottom:solid 1px #ccc;margin:20px 0px;clear:both;"></div>
                        {{-- border --}}
                        <label>AC1.11 Identify types of harm that can occur during physical interventions.</label>
                        <p>Mental alertness is vital while working as a security officer. There are many advantages to ensuring you look after your mental well-being.</p>
                        <p><strong>Question 11:</strong> Identify <strong>FIVE</strong> personal advantages of mental alertness at work.</p>
                        <div style="clear:both;">
                            <label style="float:left;width:3%;">1.</label>
                            <div class="inputDiv" style="margin-bottom:10px;float:left;width:95%;">
                                {{ $formData['data']['Question 11'][0] }}</div>
                        </div>
                        <div style="clear:both;">
                            <label style="float:left;width:3%;">2.</label>
                            <div class="inputDiv" style="margin-bottom:10px;float:left;width:95%;">
                                {{ $formData['data']['Question 11'][1] }}</div>
                        </div>
                        <div style="clear:both;">
                            <label style="float:left;width:3%;">3.</label>
                            <div class="inputDiv" style="margin-bottom:10px;float:left;width:95%;">
                                {{ $formData['data']['Question 11'][2] }}</div>
                        </div>
                        <div style="clear:both;">
                            <label style="float:left;width:3%;">4.</label>
                            <div class="inputDiv" style="margin-bottom:10px;float:left;width:95%;">
                                {{ $formData['data']['Question 11'][3] }}</div>
                        </div>
                        <div style="clear:both;">
                            <label style="float:left;width:3%;">5.</label>
                            <div class="inputDiv" style="margin-bottom:10px;float:left;width:95%;">
                                {{ $formData['data']['Question 11'][4] }}</div>
                        </div>
                        {{-- border --}}
                        <div style="border-bottom:solid 1px #ccc;margin:20px 0px;clear:both;"></div>
                        {{-- border --}}
                        <label>AC1.12 State the benefits of reflecting on personal safety experiences.</label>
                        <p>Reflection is a useful tool to enable you and your colleagues to learn from past experiences.</p>
                        <p><strong>Question 12:</strong> State the benefits of reflecting on personal safety experiences.</p>
                        <div style="clear:both;">
                            <div class="inputDiv" style="margin-bottom:10px;float:left;width:95%;">
                                {{ $formData['data']['Question 12'] }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="page7" style="margin-top:30px;">
            <div class="panelCard" style="display: block;clear: both;overflow: auto;padding-bottom: 17px;">
                <h4 class="bgStrip">Knowledge Questions</h4>
                <div style="padding: 0px 10px;">
                    <div class="questions">
                        <h4 class="bgGray">LO2 Know what actions to take in relation to global (or critical) incidents.</h4>
                        <label>AC2.1 Know government guidance in relation to global (or critical) incidents.</label>
                        <p>As a security officer, it is important to know what actions you should take and where you can find additional information and guidance when dealing with global or critical incidents.</p>
                        <p><strong>Question 13:</strong> Describe the government guidance in relation to global (or critical) incidents.</p>
                        <div style="clear:both;">
                            <div class="inputDiv" style="margin-bottom:10px;float:left;width:95%;">
                                {{ $formData['data']['Question 13'] }}</div>
                        </div>
                        <div style="clear:both;">
                            <label>Learner Signature</label>
                            <div class="inputDiv" style="margin-bottom:10px;">
                                <img src="{{ $signatureData }}" alt=""></div>
                        </div>
                        <div style="clear:both;">
                            <label>Date, Time Completed</label>
                            <div class="inputDiv" style="margin-bottom:10px;">
                                {{ $formData['data']['assessment_date'] }}</div>
                        </div>

                        {{-- border --}}
                        {{-- <div style="border-bottom:solid 1px #ccc;margin:20px 0px;clear:both;"></div> --}}
                        {{-- border --}}

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
